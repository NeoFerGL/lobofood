<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/acceso_vendedor.css">
    <link rel="icon" type="icon" href="img/favicon.ico">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <!-- <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css"> -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>
<body>
    <div class="container">
        <div class="form-box"> 
            <a href="registro.php">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="25" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                </svg>
            </a>
            <div class="logos-lobos">
                <img src="img/lobo_chef-removebg-preview.png" alt="lobito-usuario">
            </div>
            <!--INICIO DE SESION PARA LA CAFETERIA-->
            <form id="login" onsubmit="return validarAcCaf()" action="acceso_cafeteria.php" method="post" class="input-group">
                <input type="text" class="input-field" name="usuario" id="nombre" placeholder="Nombre de la cafetería">
                <input type="password" class="input-field" name="pass" id="pass" placeholder="Contraseña">
                <?php
                // Verificar si se ha enviado el formulario y hay un error en la contraseña
                if (isset($_GET['error']) && $_GET['error'] == "Contraseña") {
                    echo '<div class="w3-panel w3-pale-red w3-border">
                    La contraseña no es correcta
                    </div>';
                }
                ?>
                <?php
                // Verificar si se ha enviado el formulario y hay un error en el usuario
                if (isset($_GET['error']) && $_GET['error'] == "usuario") {
                    echo '<div class="w3-panel w3-pale-red w3-border">
                    La cafetería no esta registrada.
                    </div>';
                }
                ?>
                <div id="mensaje" style="display: none;" class="w3-panel w3-pale-red w3-border"></div>
                <button type="submit" class="submit-btn" name="btn-acss-caf">Acceder</button> 
            </form>
        </div>

    </div>

     <script>
       
        //FUNCION PARA VALIDAR EL INICIO DE SESION DE LA CAFETERIA
        function validarAcCaf() {
        var usuario = document.getElementById("nombre").value;
        var pass = document.getElementById("pass").value;
        var mensaje = document.getElementById("mensaje");

        if (usuario.trim() == "" || pass.trim() == "") {
        mensaje.innerHTML = "Por favor, complete todos los campos";
        mensaje.style.display = "block";
        return false;
        }

        return true;
        }
        

     </script>
</body>
</html> 