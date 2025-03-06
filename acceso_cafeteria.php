<?php
//Conexion
$conex = new mysqli("localhost","root","","lobofood");

//Verificar si se envio el formulario
if(isset($_POST['btn-acss-caf'])){
    $usuario = $_POST['usuario']; 
    $pass = $_POST['pass'];

    //Buscar la matricula en la base de datos
    $consulta = "SELECT * FROM cafeteria WHERE Cafeteria='$usuario'";
    $resultado=mysqli_query($conex,$consulta);

    //Si se encontro la matricula en la base de datos
    if(mysqli_num_rows($resultado) == 1){

    //Obtener la contraseña encriptada del usuario
    $fila = mysqli_fetch_assoc($resultado);
    $hashed_password = $fila["Contraseña"];

        //Verificar si la contraseña encriptada de la db coincide con la del inicio
        if(password_verify($pass,$hashed_password)){
            //Iniciar sesion
            session_start();
            $_SESSION['usuario'] = $usuario;
            $_SESSION['ID'] = $fila["ID"];
            header("location:../proyecto/cafeteria.php");
        }
        else{
            //echo "La contraseña no es correcta";
            header("Location: accesocafeteria.php?error=Contraseña");
        }
    }
    else{
        //echo "La cafeteria no esta registrada";
        header("Location: accesocafeteria.php?error=usuario");
    }
}

?>