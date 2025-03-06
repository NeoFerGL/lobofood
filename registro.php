<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Login</title>
    <link rel="stylesheet" href="css/estilosLogin.css">
    <link rel="icon" type="icon" href="img/favicon.ico">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
</head>

<body>
    <div class="container">
        <div class="form-box">
            <a href="index.html">
                <svg xmlns="http://www.w3.org/2000/svg" width="40" height="25" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                    <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z" />
                </svg>
            </a>
            <div class="button-box">
                <div id="elegir"></div>
                <button type="button" class="toggle-btn" onclick="login()">Iniciar Sesión</button>
                <button type="button" class="toggle-btn" onclick="registrar()">Registrarse</button>
            </div>
            <div class="logos-lobos">
                <img src="img/lobo_usu-removebg-preview.png" alt="lobito-usuario">
            </div>
            <!--INICIO DE SESION PARA EL ALUMNO-->
            <form id="login" onsubmit="return validarAcUsu()" action="acceso_usuario.php" method="post" class="input-group">
                <input type="text" class="input-field" name="usuario" id="nombre" placeholder="Matrícula" maxlength="9">
                <input type="password" class="input-field" name="pass" id="pass" placeholder="Contraseña" maxlength="8">
                <?php
                // Verificar si se ha enviado el formulario y hay un error en la contraseña
                if (isset($_GET['error']) && $_GET['error'] == "contraseña") {
                    echo '<div class="w3-panel w3-pale-red w3-border">
                    La contraseña no es correcta
                    </div>';
                }
                ?>
                <?php
                // Verificar si se ha enviado el formulario y hay un error en el usuario
                if (isset($_GET['error']) && $_GET['error'] == "usuario") {
                    echo '<div class="w3-panel w3-pale-red w3-border">
                    La matrícula no esta registrada.
                    </div>';
                }
                ?>

                <div id="mensaje_caf" style="display: none;" class="w3-panel w3-pale-red w3-border"></div>
                <button type="submit" class="submit-btn" name="btn-accs">Acceder</button>
                <a class="fas" href="accesocafeteria.php" style="color: black; font-size: 22px; text-decoration: none;">&#xf805;</a><a class="fas">Soy cafetería</a>
            </form>

            <!--REGISTRO PARA EL ALUMNO-->
            <form class="input-group" id="registrar" name="registro" onsubmit="return validarFormulario()" method="post" action="registro_alumno.php">
                <input type="text" class="input-field" name="matricula" id="matricula" placeholder="Matrícula" maxlength="9">
                <input type="password" class="input-field" name="pass" id="contra" placeholder="Contraseña" maxlength="8">
                <input type="text" class="input-field" name="nombre" id="nombre" placeholder="Nombre">
                <input type="text" class="input-field" name="apellidoPaterno" id="apellidoPaterno" placeholder="Apellido paterno">
                <input type="text" class="input-field" name="apellidoMaterno" id="apellidoMaterno" placeholder="Apellido materno">
                <?php
                // Verificar si se ha enviado el formulario y hay un error en la contraseña
                if (isset($_GET['error']) && $_GET['error'] == "matricula") {
                    echo '<div class="w3-panel w3-pale-red w3-border">
                    La matricula ya esta registrada.
                    </div>';
                }
                ?>
                <div id="mensaje" style="display: none;" class="w3-panel w3-pale-red w3-border"></div>
                <button type="submit" class="submit-btn" name="btn-rgu">Registrarse</button>
                <a class="fas" href="registrovendedor.php" style="color: black; font-size: 22px; text-decoration: none;">&#xf805;</a><a class="fas">¿Tienes una cafetería?</a>
            </form>

        </div>

    </div>
    <script>
        var x = document.getElementById("login");
        var y = document.getElementById("registrar");
        var z = document.getElementById("elegir");
        var k = document.getElementById("link");

        function login() {
            x.style.left = "50px";
            y.style.left = "450px";
            z.style.left = "0px";
            k.style.display = "none";
        }

        function registrar() {
            x.style.left = "-400px";
            y.style.left = "50px";
            z.style.left = "120px";
            k.style.display = "block";
        }

        //FUNCION PARA VALIDAR EL REGISTRO DEL ALUMNO
        function validarFormulario() {
            var matricula = document.forms["registro"]["matricula"].value;
            var password = document.forms["registro"]["pass"].value;
            var nombre = document.forms["registro"]["nombre"].value;
            var apellidoPaterno = document.forms["registro"]["apellidoPaterno"].value;
            var apellidoMaterno = document.forms["registro"]["apellidoMaterno"].value;
            //var expresion = /^[a-zA-Z\s]*$/;
            var mensaje = document.getElementById("mensaje");

            //Validar que no haya campos vacios
            if (matricula == " " || password == " " || nombre == " " || apellidoPaterno == "" || apellidoMaterno == "") {
                mensaje.style.display = "block";
                mensaje.innerHTML = "No se permiten campos vacios.";
            }
            // Validar matrícula
            if (matricula == "" || isNaN(matricula) || matricula.length != 9) {
                mensaje.style.display = "block";
                mensaje.innerHTML = "Ingresa una matrícula válida.";
                return false;
            }

            // Validar contraseña que contenga letras y números
            var letras = /[a-zA-Z]/;
            var numeros = /[0-9]/;
            if (!letras.test(password) || !numeros.test(password)) {
                mensaje.style.display = "block";
                mensaje.innerHTML = "La contraseña debe contener letras y numeros.";
                return false;
            }
            // Validar nombre sin espacios
            if (nombre == "" || !/^[a-zA-Z]+$/.test(nombre)) {
                mensaje.style.display = "block";
                mensaje.innerHTML = "Ingresa un nombre válido.";
                return false;
            }

            /*validar nombre con espacios
            if (!expresion.test(nombre.value)) {
             mensaje.style.display = "block";
             mensaje.innerHTML ="El campo solo puede contener letras y espacios en blanco.";
             nombre.value = nombre.value.replace(/[^a-zA-Z\s]/g, "");
            return false;
            }*/

            // Validar apellido paterno
            if (apellidoPaterno == "" || !/^[a-zA-Z]+$/.test(apellidoPaterno)) {
                mensaje.style.display = "block";
                mensaje.innerHTML = "Ingresa un apellido paterno válido.";
                return false;
            }

            // Validar apellido materno
            if (apellidoMaterno == "" || !/^[a-zA-Z]+$/.test(apellidoMaterno)) {
                mensaje.style.display = "block";
                mensaje.innerHTML = "Ingresa un apellido materno válido.";
                return false;
            }
            return true; //Se acepta la validacion y puede pasar al php

        }

        //FUNCION PARA VALIDAR EL INICIO DE SESION DE LA CAFETERIA
        function validarAcUsu() {
            var nombre = document.getElementById("nombre").value;
            var pass = document.getElementById("pass").value;

            if (nombre == "" || pass == "") {
                document.getElementById("mensaje_caf").style.display = "block";
                document.getElementById("mensaje_caf").innerHTML = "Por favor complete todos los campos.";
                return false;
            } else {
                return true;
            }
        }
    </script>
</body>

</html>