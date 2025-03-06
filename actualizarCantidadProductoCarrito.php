<?php
session_start();

if (isset($_SESSION['carrito'])) {
    $mi_carrito = $_SESSION['carrito'];
    $id_producto = $_POST['id_producto']; 
    $cantidad = $_POST['cantidad'];

    if (isset($mi_carrito[$id_producto])) {
        $mi_carrito[$id_producto]['cantidad'] = $cantidad;
        $_SESSION['carrito'] = $mi_carrito;
        echo 'OK';
    } 
}

?>
