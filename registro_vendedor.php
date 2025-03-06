<?php
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
}
else {
    // Verificar si se envió el formulario
    //echo ("Conexión establecida");
    if(isset($_POST['btn_rg'])){
    $cafeteria = trim($_POST["cafeteria"]);
    $due = trim($_POST["dueño"]);
    $pass = $_POST["pass"];
    $hashed_password = password_hash($pass, PASSWORD_DEFAULT);//Para encriptar la contraseña de la cafeteria
    $tel = $_POST["tel"];
    $ubic = trim($_POST["ubic"]);
    
    //Validar si la cafeteria ya existe
    $consulta = "SELECT COUNT(*) as cantidad FROM cafeteria WHERE Cafeteria='$cafeteria'";
    $resultado = mysqli_query($conn, $consulta);
    $fila = mysqli_fetch_assoc($resultado);
    $cantidad = $fila['cantidad'];
    if($cantidad > 0) {
        //echo "La cafeteria ya está registrada. Registro rechazado";
        header("Location: registrovendedor.php?error=cafeteria");
    } else {
        // Insertar el nuevo usuario
        $agregar = "INSERT INTO cafeteria(ID, Cafeteria, Dueño, Contraseña, Telefono, Ubicacion) VALUES ('','$cafeteria','$due','$hashed_password','$tel','$ubic')";
        $resultado = mysqli_query($conn, $agregar);
        if($resultado){
            header("location:../proyecto/acceso_cafeteria.html");
            //echo "El registro fue exitoso, aquí estará la interfaz para la cafeteria registrada";  
        }
    }
   }
}
?>