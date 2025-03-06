<?php
//Conexion
$conex = new mysqli("localhost","root","","lobofood");

//Verificar si se envio el formulario
if(isset($_POST['btn-accs'])){
    $usuario = $_POST['usuario'];
    $pass = $_POST['pass'];

    //Buscar la matricula en la base de datos
    $consulta = "SELECT * FROM usuarios WHERE matricula='$usuario'";
    $resultado=mysqli_query($conex,$consulta);

    //Si se encontro la matricula en la base de datos
    if(mysqli_num_rows($resultado) == 1){ 

    //Obtener la contraseña encriptada del usuario
    $fila = mysqli_fetch_assoc($resultado);
    $hashed_password = $fila["contraseña"];

        //Verificar si la contraseña encriptada de la db coincide con la del inicio
        if(password_verify($pass,$hashed_password)){
            //Iniciar sesion
            session_start();
            $_SESSION['usuario'] = $usuario;
            $_SESSION['matricula'] = $fila["matricula"];
            header("location:../proyecto/interfaz_usuario.php");
        }
        else{
            //echo "La contraseña no es correcta";
            header("Location: registro.php?error=contraseña");
        }
    }
    else{
        //echo "La matricula no esta registrada";
        header("Location: registro.php?error=usuario");
    }
}

?>