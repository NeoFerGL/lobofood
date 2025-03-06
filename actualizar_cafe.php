<?php
$host = "localhost";
$user = "root";
$password = ""; 
$database = "lobofood";

$conn = mysqli_connect($host, $user, $password, $database);
session_start();
$ID = $_SESSION['ID'];
    if(isset($_POST['btn_ac'])){
        $cafeteria = trim($_POST["cafeteria"]);
        $due = trim($_POST["dueño"]);
        $pass = $_POST["pass"];
        $hashed_password = password_hash($pass, PASSWORD_DEFAULT);//Para encriptar la contraseña de la cafeteria
        $tel = $_POST["tel"];
        $ubic = trim($_POST["ubic"]);
        if($pass ==NULL){
            $actualizar = "UPDATE cafeteria SET Cafeteria='$cafeteria', Dueño='$due', Telefono='$tel', Ubicacion='$ubic' WHERE ID='$ID' ";
            $resultado = mysqli_query($conn, $actualizar);
        }else{
            $actualizar = "UPDATE cafeteria SET Contraseña='$hashed_password', Cafeteria='$cafeteria', Dueño='$due', Telefono='$tel', Ubicacion='$ubic' WHERE ID='$ID' ";
            $resultado = mysqli_query($conn, $actualizar);
        }
        if($resultado){
            header("location:../proyecto/cafeteria.php");
                //echo "El producto se creo correctamente";  
            }
    }
    if(isset($_POST['btn_dc'])){
        $consulta = "DELETE FROM cafeteria WHERE ID='$ID'";
        $resultado = mysqli_query($conn, $consulta);
        if($resultado){
            header("location:../proyecto/registro.html");
                //echo "El producto se creo correctamente";  
            }
    }