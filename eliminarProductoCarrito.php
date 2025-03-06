<?php session_start(); 
$id_producto = $_POST['id_producto'];
unset($_SESSION['carrito'][$id_producto]);
header("Location: ".$_SERVER['HTTP_REFERER']."");
?>