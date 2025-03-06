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

    // Actualizar el estado de la orden a 1 (completada)
    $sql = "UPDATE orden SET estado = 1 WHERE numorden = ?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $numorden);

    if ($stmt->execute() === TRUE) {
        $message = "La orden se ha completado correctamente.";
        echo "<script>alert(" . json_encode($message) . "); window.location.href = 'verorden.php';</script>";
    } else {
        $error = "Error al completar la orden: " . $stmt->error;
        echo "<script>alert(" . json_encode($error) . ");</script>";
    }

    $stmt->close();
    $conn->close();
} else {
    $message = "No se proporcionó el número de orden.";
    echo "<script>alert(" . json_encode($message) . "); window.location.href = 'verorden.php';</script>";
}
?>
