<?php
// Establecer el límite de tiempo de ejecución del script a 0 (sin límite)
set_time_limit(0);

date_default_timezone_set('America/Mexico_City');

// Establecer el intervalo de tiempo en segundos para la repetición de la consulta
$intervalo = 30; // Consulta cada 60 segundos

// Establecer la conexión con la base de datos
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lobofood";
$conn = new mysqli($servername, $username, $password, $dbname);

// Verificar si hay algún error en la conexión
if ($conn->connect_error) {
    die("Error en la conexión: " . $conn->connect_error);
}

while (true) {
    // Obtener la fecha y hora actual
    $fechaHoraActual = date("Y-m-d H:i:s");

    // Obtener las órdenes con estado nulo
    $sql = "SELECT numorden, fecha, hora FROM orden WHERE estado IS NULL";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        // Recorrer las órdenes
        while ($row = $resultado->fetch_assoc()) {
            $numorden = $row['numorden'];
            $fechaOrden = $row['fecha'];
            $horaOrden = $row['hora'];

            // Combinar la fecha y hora de la orden en un solo formato
            $fechaHoraOrden = $fechaOrden . " " . $horaOrden;

            echo 'orden= '.$fechaHoraOrden.'';
            echo 'actual= '.$fechaHoraActual.'';

            // Comparar la fecha y hora de la orden con la fecha y hora actual
            if (strtotime($fechaHoraOrden) < strtotime($fechaHoraActual)) {
                // Actualizar el estado de la orden a 0
                $sqlActualizar = "UPDATE orden SET estado = 0 WHERE numorden = ?";
                $stmt = $conn->prepare($sqlActualizar);
                $stmt->bind_param("i", $numorden);

                $numorden = $row['numorden'];

            // Actualizar el estado de la orden a 0
            $sql_update = "UPDATE orden SET estado = 0 WHERE numorden = ?";
            $stmt_update = $conn->prepare($sql_update);
            $stmt_update->bind_param("i", $numorden);
            $stmt_update->execute();

            // Obtener los productos y cantidades asociados a la orden
            $sql_productos = "SELECT idproducto, cantidad FROM productoaorden WHERE numorden = ?";
            $stmt_productos = $conn->prepare($sql_productos);
            $stmt_productos->bind_param("i", $numorden);
            $stmt_productos->execute();
            $resultado_productos = $stmt_productos->get_result();

            // Actualizar el stock de cada producto
            while ($row_productos = $resultado_productos->fetch_assoc()) {
                $idproducto = $row_productos['idproducto'];
                $cantidad = $row_productos['cantidad'];

                // Actualizar el stock en la tabla producto
                $sql_stock = "UPDATE producto SET stock = stock + ? WHERE idproducto = ?";
                $stmt_stock = $conn->prepare($sql_stock);
                $stmt_stock->bind_param("ii", $cantidad, $idproducto);
                $stmt_stock->execute();
            }

                if ($stmt->execute() === TRUE) {
                    echo "La orden #" . $numorden . " ha sido actualizada a estado 0.<br>";
                } else {
                    echo "Error al actualizar el estado de la orden #" . $numorden . ": " . $stmt->error . "<br>";
                }

                $stmt->close();
            } else {
                echo "La orden #" . $numorden . " aún no ha alcanzado la fecha y hora límite.<br>";
            }
        }
    } else {
        echo "No se encontraron órdenes con estado nulo.<br>";
    }

    // Esperar el intervalo de tiempo antes de realizar la siguiente consulta
    sleep($intervalo);
}

$conn->close();
