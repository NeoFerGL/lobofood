<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lobofood";

$conn = new mysqli($servername, $username, $password, $dbname);
$id_usuario = $_SESSION['matricula'];
$carrito = $_SESSION['carrito'];
// Establecer la zona horaria a México
date_default_timezone_set('America/Mexico_City');
// Obtener la fecha actual
$fecha = date('Y-m-d');

// Obtener la hora actual
$hora_actual = date('H:i:s');

// Calcular 5 minutos después de la hora actual
$nueva_hora = date('H:i:s', strtotime($hora_actual . ' + 2 minutes'));
$sql = "INSERT INTO orden (numorden,matricula,fecha,hora) VALUES ('NUll',$id_usuario,'$fecha','$nueva_hora')";
mysqli_query($conn, $sql);

$id_orden = mysqli_insert_id($conn);

foreach ($carrito as $producto) {
    $id_producto = $producto['idproducto'];
    $cantidad = $producto['cantidad'];
    $precio_unitario = $producto['precio'] * $producto['cantidad'];
    $sql = "INSERT INTO productoaorden (idproductoaorden,idproducto, numorden, cantidad, total) VALUES ('NUll',$id_producto,$id_orden, $cantidad, $precio_unitario)";
    mysqli_query($conn, $sql);

    // Restar la cantidad de productos en la tabla productos
    $sql_update = "UPDATE producto SET stock = stock - $cantidad WHERE idproducto = $id_producto";
    mysqli_query($conn, $sql_update);
}

mysqli_close($conn);
