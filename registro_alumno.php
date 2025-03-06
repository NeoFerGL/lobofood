<?php
session_start();
// Variables de conexión a la base de datos
$host = "localhost";
$user = "root";
$password = "";
$database = "lobofood";

// Conexión a la base de datos
$conn = mysqli_connect($host, $user, $password, $database);

// Verificar la conexión
if (mysqli_connect_errno()) {
    die("Error de conexión: " . mysqli_connect_error());
} else {
    // Verificar si se envió el formulario
    if(isset($_POST['btn-rgu'])){
    $matricula = $_POST["matricula"];
    $pass = $_POST["pass"];
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);//Para encriptar la contraseña del usuario
    $nom = trim($_POST["nombre"]);
    $pat = trim($_POST["apellidoPaterno"]);
    $mat = trim($_POST["apellidoMaterno"]);
    
    // Validar si la matrícula ya existe
    $consulta = "SELECT COUNT(*) as cantidad FROM usuarios WHERE matricula='$matricula'";
    $resultado = mysqli_query($conn, $consulta);
    $fila = mysqli_fetch_assoc($resultado);
    $cantidad = $fila['cantidad'];
    if($cantidad > 0) {
        //echo "La matrícula ya está registrada. Registro rechazado";
        header("Location: registro.php?error=matricula");
    } else {
        // Insertar el nuevo usuario
        $agregar = "INSERT INTO usuarios(matricula, contraseña, nombre, paterno, materno) VALUES ('$matricula','$hashed_password','$nom','$pat','$mat')";
        $resultado = mysqli_query($conn, $agregar);
        if($resultado){
            $_SESSION["matricula"] = $matricula;
            header("Location: interfaz_usuario.php");  
        }
    }
}

}
?>