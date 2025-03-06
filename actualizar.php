<?php
$host = "localhost";
$user = "root";
$password = ""; 
$database = "lobofood";

$conn = mysqli_connect($host, $user, $password, $database);
session_start();
$ID = $_SESSION['ID'];
    if(isset($_POST['btn-cp'])){
        $imagen = $_POST["imagen"];
        $nombre = $_POST["nombreProducto"];
        $precio = $_POST["precio"];
        $stock = $_POST["stock"];
        $categoria = $_POST["categoria"];
        $IDP = $_POST["IDP"];
        if($imagen ==NULL){
            $actualizar = "UPDATE producto SET nombrep='$nombre', categoria='$categoria', precio='$precio', stock='$stock' WHERE idproducto='$IDP' AND id='$ID'";
            $resultado = mysqli_query($conn, $actualizar);
        }else{
            $actualizar = "UPDATE producto SET foto='$imagen', nombrep='$nombre', categoria='$categoria', precio='$precio', stock='$stock' WHERE idproducto='$IDP' AND id='$ID'";
            $resultado = mysqli_query($conn, $actualizar);
        }
        if($resultado){
            header("location:../proyecto/productos.php");
                //echo "El producto se creo correctamente";  
            }
    }
    if(isset($_POST['btn-dp'])){
        $nombre = $_POST["nombre"];
        $consulta = "DELETE FROM producto WHERE nombrep ='$nombre' AND id='$ID'";
        $resultado = mysqli_query($conn, $consulta);
        if($resultado){
            header("location:../proyecto/productos.php");
                //echo "El producto se creo correctamente";  
            }
    }