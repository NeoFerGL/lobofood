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
                                    <a class="nav-link text-light lead-x" href="#"style="font-weight:bold;">Cerrar sesion</a>
                                </li>
                        </div>
                    </nav>
                </div>
            </div>            
            </div>
        </section>
        <div class="container2">
            <div class="form-box">
                <a href="productos.php">
                    <div style="text-align: left;">
                    <svg xmlns="http://www.w3.org/2000/svg" width="40" height="25" fill="currentColor" class="bi bi-arrow-left" viewBox="0 0 16 16">
                        <path fill-rule="evenodd" d="M15 8a.5.5 0 0 0-.5-.5H2.707l3.147-3.146a.5.5 0 1 0-.708-.708l-4 4a.5.5 0 0 0 0 .708l4 4a.5.5 0 0 0 .708-.708L2.707 8.5H14.5A.5.5 0 0 0 15 8z"/>
                    </svg>
                    </div>
                </a>
                <div class="logos-lobos">
                    <img src="img/lobo_chef-removebg-preview.png" alt="lobito-chef">
                </div>
                <form class="" name="updateProducto" method="post" action="actualizar_producto.php">
                    <p>Que producto desea actualizar?</p>
                    <select name="nombre" class ="seleccion">
                    <?php
$conexion = mysqli_connect("localhost", "root", "", "lobofood");
$ID = $_SESSION['ID'];
$consulta = "SELECT nombrep FROM producto WHERE id='$ID'";
$resultado = mysqli_query($conexion, $consulta);
while ($fila = mysqli_fetch_array($resultado)) {
  echo '<option name="'.$fila['nombrep'].'">'.$fila['nombrep'].'</option>';
}
?>
                    </select>
                    <button type="submit" class="submit-btn" name="btn-cp" style="margin-left: 10%;">Ir al producto</button>
                </form>
                <br>
                <form class="" name="borrarProducto" method="post" action="actualizar.php">
                    <p>Que producto desea borrar?</p>
                    <select name="nombre" class ="seleccion">
                    <?php
$conexion = mysqli_connect("localhost", "root", "", "lobofood");
$ID = $_SESSION['ID'];
$consulta = "SELECT nombrep FROM producto WHERE id='$ID'";
$resultado = mysqli_query($conexion, $consulta);
while ($fila = mysqli_fetch_array($resultado)) {
  echo '<option name="'.$fila['nombrep'].'">'.$fila['nombrep'].'</option>';
}
?>
                    </select>
                    <button type="submit" class="submit-btn" name="btn-dp" style="margin-left: 10%; background: linear-gradient(to right,rgba(240, 15, 15, 0.8),rgba(243, 103, 22, 0.8));">Borrar</button>
                </form>
            </div> 
        </div>
    </body>
</html>