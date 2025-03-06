<?php
session_start();

if (!empty($_GET['numorden'])) {
    $numorden = $_GET['numorden'];

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

    // Obtener los detalles de los productos de la orden
    $sql_productos = "SELECT idproducto, cantidad FROM productoaorden WHERE numorden = ?";
    $stmt_productos = $conn->prepare($sql_productos);
    $stmt_productos->bind_param("i", $numorden);
    $stmt_productos->execute();
    $resultado_productos = $stmt_productos->get_result();

    // Verificar si hay resultados
    if ($resultado_productos->num_rows > 0) {
        // Recorrer los productos
        while ($row = $resultado_productos->fetch_assoc()) {
            $idproducto = $row['idproducto'];
            $cantidad = $row['cantidad'];

            // Actualizar el stock de cada producto
            $sql_stock = "UPDATE producto SET stock = stock + ? WHERE idproducto = ?";
            $stmt_stock = $conn->prepare($sql_stock);
            $stmt_stock->bind_param("ii", $cantidad, $idproducto);
            if ($stmt_stock->execute() !== TRUE) {
                echo "Error al actualizar el stock del producto con ID: $idproducto";
            }
        }
    } else {
        echo "No se encontraron productos asociados a la orden.";
    }

    // Actualizar el estado de la orden a 0
    $sql = "UPDATE orden SET estado = 0 WHERE numorden = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $numorden);

    if ($stmt->execute() === TRUE) {
        $message = "La orden se ha cancelado correctamente.";
        echo "<script>alert(" . json_encode($message) . "); window.location.href = 'interfaz_usuario.php';</script>";
    } else {
        $error = "Error al cancelar la orden: " . $stmt->error;
        echo "<script>alert(" . json_encode($error) . ");</script>";
    }

    $stmt_productos->close();
    $stmt_stock->close();
    $stmt->close();
    $conn->close();
} else {
    $message = "No se proporcionó el número de orden.";
    echo "<script>alert(" . json_encode($message) . "); window.location.href = 'interfaz_usuario.php';</script>";
}
?>