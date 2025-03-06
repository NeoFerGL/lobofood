<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
    <head>
        <meta charset="UTF-8">
        <meta http-equiv="X-UA-Compatible" content="IE=edge">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
        <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
        <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;600&display=swap" rel="stylesheet">
        <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
        <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>


        <title>Actualizar Producto</title>
        <link rel="stylesheet" href="css/rey.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="stylesheet" href="https://www.w3schools.com/w3css/4/w3.css">
        <link rel="icon" type="icon" href="img/favicon.ico">
    </head>
    <body>
        <section>
            <div class="row no-gutters">
                <div class="col-1 d-none d-lg-block border-right">
                    <div class="d-flex h-25">
                        <div class="align-content-center mx-auto lead-xl">
                            <a href="cafeteria.php">  <img src="img/lobo-logo.png" class="img-fluid" style="height: 70px;"></a>
                        </div>
                    </div>
                </div>
                <?php $conexion = mysqli_connect("localhost", "root", "", "lobofood");
                      $ID = $_SESSION['ID'];
                      $cafe = "SELECT Cafeteria FROM cafeteria WHERE ID='$ID'";
                      $res = mysqli_query($conexion, $cafe); 
                      $res2 =mysqli_fetch_array($res);
                      $nom = $res2['Cafeteria'];
                      ?>
                <!-- Primera divicion menu de arriba a la izquierda-->
                <div class="col-lg-11">
                    <nav class="navbar navbar-expand-sm">
                        <a class="navbar-brand text-light" href="cafeteria.php">  <span class="font-weight-bold t" style="font-size:x-large" ><?php echo $nom;?></span></a>
                        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                            <ion-icon class="lead-xl text-light" name="menu-outline"></ion-icon>
                        </button>
                        <!-- Primera divicion menu de arriba a la derecha-->
                        <div class="collapse navbar-collapse" id="navbarSupportedContent">
                            <ul class="navbar-nav ms-lg-auto">
                                <li class="nav-item">
                                    <a class="nav-link text-light lead-x" href="productos.php"style="font-weight:bold;">Mis productos</a>
                                </li>
                                <li>
                                    <a class="nav-link text-light lead-x" href="edit-cafeteria.php"style="font-weight:bold;">Editar cafeteria</a>
                                </li>
                                <li>
                                    <a class="nav-link text-light lead-x" href="verorden.php"style="font-weight:bold;">Visualizar Ordenes</a>
                              </li>
                                <li>
                                    <a class="nav-link text-light lead-x" href="#"style="font-weight:bold;">Cerrar Sesion</a>
                                </li>
                        </div>
                    </nav>
                </div>
            </div>            
            </div>
        </section>
        <div class="container2">
            <div class="form-box">
                <a href="update.php">
                    <div style="text-align: left;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="25" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                    </svg>
                    </div>
                </a>
                <div class="logos-lobos">
                    <img src="img/lobo_chef-removebg-preview.png" alt="lobito-chef">
                </div>
    <?php
    $conexion = mysqli_connect("localhost", "root", "", "lobofood");
$nombre = $_POST["nombre"];
$consulta = "SELECT * FROM producto WHERE nombrep= '$nombre'";
$resultado = mysqli_query($conexion, $consulta);
while ($fila = mysqli_fetch_array($resultado)) {
     $imagen =$fila['foto'];
     $precio = $fila['precio'];
     $stock = $fila['stock'];
     $categoria = $fila['categoria'];
     $IDP = $fila['idproducto'];

  }
    ?>
                <form class="input-group" name="actualizarProducto" method="post" action="actualizar.php">
                    </select>
                    <input type="file" class="input-field" name="imagen" accept=".jpg, .jpeg, .png">
                    <input type="text" class="input-field" name="nombreProducto" placeholder="Nombre del Producto" <?php echo 'value="'.$nombre.'"'; ?> required>
                    <input type="text" class="input-field" name="precio" placeholder="Precio" pattern="[0-9]{1,3}" <?php echo 'value="'.$precio.'"'; ?> required>
                    <input type="number" class="input-field" name="stock" min="0" max="150" placeholder="Stock disponible" <?php echo 'value="'.$stock.'"'; ?> required>
                    <select name="categoria" class="seleccion">
                        <?php
                        if($categoria == "Alimento")
                        echo '
                        <option name="alimento" selected>Alimento</option>
                        <option name="bebida">Bebida</option>
                        <option name="snack">Snack</option>';
                        if($categoria == "Bebida")
                        echo '
                        <option name="alimento">Alimento</option>
                        <option name="bebida" selected>Bebida</option>
                        <option name="snack">Snack</option>';
                        if($categoria == "Snack")
                        echo '
                        <option name="alimento">Alimento</option>
                        <option name="bebida">Bebida</option>
                        <option name="snack" selected>Snack</option>';
                        ?>
                    </select>
                    <input type="hidden" name="IDP" <?php echo 'value="'.$IDP.'"'; ?>>
                    <button type="submit" class="submit-btn" name="btn-cp" style="margin-left: 10%;">Actualizar</button>
                </form>
            </div> 
        </div>
    </body>
</html>