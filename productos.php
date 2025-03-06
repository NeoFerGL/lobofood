<?php session_start(); ?>
<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
 
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/css/bootstrap.min.css">
    <script src="https://cdn.jsdelivr.net/npm/jquery@3.6.0/dist/jquery.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.1/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@4.6.1/dist/js/bootstrap.bundle.min.js"></script>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link href="https://fonts.googleapis.com/css2?family=Oswald:wght@200;600&display=swap" rel="stylesheet">
    <script type="module" src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@5.5.2/dist/ionicons/ionicons.js"></script>

    <title>Mis Productos</title>
    <link rel="icon" type="icon" href="img/favicon.ico">
    <link rel="stylesheet" href="css/rey.css">
    <link rel="stylesheet" href="css/productos.css">
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
                                    <a class="nav-link text-light lead-x" href="cerrar.php"style="font-weight:bold;">Cerrar sesion</a>
                              </li>
                      </div>
                  </nav>
              </div>
          </div>
          
        <div class="row no-gutters">
          <div class="col-lg-1 d-none d-lg-block border-right"> </div>
                <div class="col-lg-4 d-flex" style="background-color: #181818;">
                    <ul class="quitar">
                        <li style="--clr:#00ade1">
                            <a href="crear_producto_Interfaz.php" data-text="&nbsp;Agregar">&nbsp;Agregar&nbsp;</a>
                        </li>
                        <li style="--clr:#ffdd1c">
                            <a href="update.php" data-text="&nbsp;Actualizar">&nbsp;Actualizar&nbsp;</a>
                        </li>
                        <li style="--clr:#ff6493">
                            <a href="update.php" data-text="&nbsp;Eliminar">&nbsp;Eliminar&nbsp;</a>
                        </li>
                    </ul>
                </div>
        </div>
          <div class="navbar navbar-dark bg-dark shadow-lg">
              <a class="text-uppercase text-light lead-xl " id="fcc">Alimentos</a>
          </div>
    <div class="container align-content-center">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-sm-3 g-3">
      <?php
      $conexion = mysqli_connect("localhost", "root", "", "lobofood");
$ID = $_SESSION['ID']; 
$consulta = "SELECT * FROM producto WHERE categoria='Alimento' AND id='$ID'";
$resultado = mysqli_query($conexion, $consulta);

while ($fila = mysqli_fetch_array($resultado)) {

    echo                     '<div class="col">';
    echo                        '<div class="item card shadow-sm">
                                <img src="img/productos/'. $fila['foto'] .'" class="item-image img-fluid" alt="producto" width="100%" height="100%">';
    //$image = $fila['foto'];
    //echo '<img src="data:image/jpg;base64,' . base64_encode($image) . '">';
                                echo '<div class="card-body" style ="text-align: center">';
    echo                           '<p class="item-title card-text text-dark lead-xl">' . $fila['nombrep'] . '</p></a>';
    echo                           '<p class="item-price card-text text-dark lead-x"><small class="text-muted lead-xl">$'. $fila['precio'] .'</small></p>';
    echo                           '<p class="item-price card-text text-dark lead-x"><small class="text-muted lead-xl">Disponibles:'. $fila['stock'] .'</small></p>';
    echo                           '<div class="d-flex justify-content-between align-self-center">
                                        <div class="btn-group" style="width: 100%;">
                                            <button type="button" class="btn btn-secondary addToCart" style="font-weight:bold; font-size: large;">Agregar a Cuenta</button>
                                        </div>
                                        <small class="text-muted lead-xl"></small>
                                    </div>
                                </div>
                            </div>
                        </div>';
}

mysqli_close($conexion);
?> 
        </div>
    </div>
    <footer class="text-muted py-5">
              <div class="container">
                  <p class="float-end mb-1">
                      <a href="#" class="text-ligh lead"><ion-icon name="arrow-up-outline"></ion-icon></a>
                  </p>
              </div>
    </footer>
    <div class="navbar navbar-dark bg-dark shadow-lg">
              <a class="text-uppercase text-light lead-xl " id="fcc">Bebidas</a>
          </div>
    <div class="container align-content-center">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-sm-3 g-3">
      <?php
$conexion = mysqli_connect("localhost", "root", "", "lobofood");

$consulta = "SELECT * FROM producto WHERE categoria='Bebida' AND id='$ID'";
$resultado = mysqli_query($conexion, $consulta);

while ($fila = mysqli_fetch_array($resultado)) {

    echo                     '<div class="col">';
    echo                        '<div class="item card shadow-sm">
                                <img src="img/productos/'. $fila['foto'] .'" class="item-image img-fluid" alt="producto" width="100%" height="100%">
                                <div class="card-body" style ="text-align: center">';
    echo                           '<p class="item-title card-text text-dark lead-xl">' . $fila['nombrep'] . '</p></a>';
    echo                           '<p class="item-price card-text text-dark lead-x"><small class="text-muted lead-xl">$'. $fila['precio'] .'</small></p>';
    if($fila['stock']==0)
    {
        echo                           '<p class="item-price card-text text-dark lead-x"><small class="text-muted lead-xl"> AGOTADO </small></p>';
    }
    else
    {
        echo                           '<p class="item-price card-text text-dark lead-x"><small class="text-muted lead-xl">Disponibles:'. $fila['stock'] .'</small></p>';
    }
    echo                           '<div class="d-flex justify-content-between align-self-center">
                                        <div class="btn-group" style="width: 100%;">
                                            <button type="button" class="btn btn-secondary addToCart" style="font-weight:bold; font-size: large;">Agregar a Cuenta</button>
                                        </div>
                                        <small class="text-muted lead-xl"></small>
                                    </div>
                                </div>
                            </div>
                        </div>';
}

mysqli_close($conexion);
?> 
        </div>
    </div>
    <footer class="text-muted py-5">
              <div class="container">
                  <p class="float-end mb-1">
                      <a href="#" class="text-ligh lead"><ion-icon name="arrow-up-outline"></ion-icon></a>
                  </p>
              </div>
    </footer>
    <div class="navbar navbar-dark bg-dark shadow-lg">
              <a class="text-uppercase text-light lead-xl " id="fcc">Snacks</a>
          </div>
    <div class="container align-content-center">
        <div class="row row-cols-1 row-cols-sm-2 row-cols-sm-3 g-3">
      <?php
$conexion = mysqli_connect("localhost", "root", "", "lobofood");

$consulta = "SELECT * FROM producto WHERE categoria='Snack' AND id='$ID'";
$resultado = mysqli_query($conexion, $consulta);

while ($fila = mysqli_fetch_array($resultado)) {

    echo                     '<div class="col">';
    echo                        '<div class="item card shadow-sm">
                                <img src="img/productos/'. $fila['foto'] .'" class="item-image img-fluid" alt="Chicago" width="100%" height="100%">
                                <div class="card-body" style ="text-align: center">';
    echo                           '<p class="item-title card-text text-dark lead-xl">' . $fila['nombrep'] . '</p></a>';
    echo                           '<p class="item-price card-text text-dark lead-x"><small class="text-muted lead-xl">$'. $fila['precio'] .'</small></p>';
    echo                           '<p class="item-price card-text text-dark lead-x"><small class="text-muted lead-xl">Disponibles:'. $fila['stock'] .'</small></p>';
    echo                           '<div class="d-flex justify-content-between align-self-center">
                                        <div class="btn-group" style="width: 100%;">
                                            <button type="button" class="btn btn-secondary addToCart" style="font-weight:bold; font-size: large;">Agregar a Cuenta</button>
                                        </div>
                                        <small class="text-muted lead-xl"></small>
                                    </div>
                                </div>
                            </div>
                        </div>';
}

mysqli_close($conexion);
?> 
        </div>
    </div>
    <footer class="text-muted py-5">
              <div class="container">
                  <p class="float-end mb-1">
                      <a href="#" class="text-ligh lead"><ion-icon name="arrow-up-outline"></ion-icon></a>
                  </p>
              </div>
    </footer>
      </section>
</body>
</html>