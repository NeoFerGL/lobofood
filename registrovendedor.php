<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/estilos_login2.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="icon" type="icon" href="img/favicon.ico">
    
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
                <img src="img/lobo_chef-removebg-preview.png" alt="lobito-chef">
            </div>
            <form  onsubmit="return validarFormulario()" action="registro_vendedor.php" method="post" class="input-group" id="registrar" >
                <input type="text" class="input-field" name="cafeteria" placeholder="Nombre de la cafetería" >
				<input type="text" class="input-field" name="dueño" placeholder="Propietario" >
                <input type="password" class="input-field" name="pass" placeholder="Contraseña" minlength="4" maxlength="8">
                <input type="tel" class="input-field" name="tel" placeholder="Teléfono" >
                <input type="text" class="input-field" name="ubic" placeholder="Ubicación">
                <?php
                // Verificar si se ha enviado el formulario y hay un error en la contraseña
                if (isset($_GET['error']) && $_GET['error'] == "cafeteria") {
                    echo '<div class="w3-panel w3-pale-red w3-border">
                    La cafeteria ya esta registrada.
                    </div>';
                }
                ?>
                <div id="mensaje" style="display: none;" class="w3-panel w3-pale-red w3-border"></div>
                <button type="submit" name="btn_rg" class="submit-btn">Registrarse</button>
            </form>
        </div>
    </div>
    <script>
        //VALIDAR EL REGISTRO DE LA CAFETERIA
        function validarFormulario() {
          // Obtener los valores de los campos de entrada
          var cafeteria = document.forms["registrar"]["cafeteria"].value;
          var dueno = document.forms["registrar"]["dueño"].value;
          var pass = document.forms["registrar"]["pass"].value;
          var tel = document.forms["registrar"]["tel"].value;
          var ubic = document.forms["registrar"]["ubic"].value;
          var mensaje = document.getElementById("mensaje");
        
          // Verificar si los campos requeridos están llenos
          if (cafeteria == "" || dueno == "" || pass == "" || tel == "" || ubic == "") {
            mensaje.style.display = "block";
            mensaje.innerHTML = "No se permiten campos vacíos.";
            return false;
          }
           // Validar contraseña que contenga letras y números
           var letras = /[a-zA-Z]/;
           var numeros = /[0-9]/;
           if(!letras.test(pass) || !numeros.test(pass)) {
            mensaje.style.display = "block";
            mensaje.innerHTML = "La contraseña debe contener letras y numeros.";
           return false;
            }
            // Verificar si el teléfono cumple con los requisitos de formato
            var regexTel = /^\d{10}$/;
            if (!regexTel.test(tel)) {
                mensaje.innerHTML = "El número de teléfono debe tener 10 dígitos.";
                return false;
            }
          // Si todo está bien, enviar el formulario
          return true;
        }
        </script>
        
</body>
</html>