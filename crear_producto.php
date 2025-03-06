<?php
$host = "localhost";
$user = "root";
$password = ""; 
$database = "lobofood";

$conn = mysqli_connect($host, $user, $password, $database);
session_start();
if (mysqli_connect_errno()) {
    die("Error de conexión: " . mysqli_connect_error());
} else {
    if(isset($_POST['btn-cp'])){
        $imagen = $_POST["imagen"];
        $nombre = $_POST["nombreProducto"];
        $precio = $_POST["precio"];
        $stock = $_POST["stock"];
        $categoria = $_POST["categoria"];
        $ID = $_SESSION['ID'];

        $consulta = "SELECT COUNT(*) as cantidad FROM producto WHERE nombrep='$nombre'";
        $resultado = mysqli_query($conn, $consulta);
        $fila = mysqli_fetch_assoc($resultado);
        $cantidad = $fila['cantidad'];
        if($cantidad > 0) {
            echo "El producto ya está registrada. Registro rechazado";
        } else {
            $agregar = "INSERT INTO producto(idproducto, foto, nombrep, categoria, precio, stock, ID) VALUES ('$','$imagen','$nombre','$categoria','$precio','$stock','$ID')";
            $resultado = mysqli_query($conn, $agregar);
            if($resultado){
                header("location:../proyecto/productos.php");
                //echo "El producto se creo correctamente";  
            }
        }
    }
}
?>