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

    <title>Mi cafeteria</title>
    <link rel="icon" type="icon" href="img/favicon.ico">
    <link rel="stylesheet" href="css/rey.css">
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
                      $cafe = "SELECT Cafeteria, Ubicacion FROM cafeteria WHERE ID='$ID'";
                      $res = mysqli_query($conexion, $cafe); 
                      $res2 =mysqli_fetch_array($res);
                      $nom = $res2['Cafeteria'];
                      $ubi =$res2['Ubicacion'];
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
                                  <a class="nav-link text-light lead-x" href="productos.php"style="font-weight:bold;">MIS PRODUCTOS</a>
                              </li>
                              <li>
                                  <a class="nav-link text-light lead-x" href="edit-cafeteria.php"style="font-weight:bold;">EDITAR CAFETERIA</a>
                              </li>
                              <li>
                                    <a class="nav-link text-light lead-x" href="verorden.php"style="font-weight:bold;">VISUALIZAR ORDENES</a>
                              </li>
                              <li>
                                    <a class="nav-link text-light lead-x" href="cerrar.php"style="font-weight:bold;">CERRAR SESION</a>
                              </li>
                      </div>
                  </nav>
              </div>
          </div>
          <!--Menu lateral-->
          <div class="row no-gutters">
              <div class="col-lg-1 d-none d-lg-block border-right"> </div>
              <!--Seccion media de la derecha-->
                <div class="col-lg-4 d-flex" style="background-color: #181818;">
                  <div class="container align-self-center px-5 content">
                      <h3 class="lead-xl "><?php echo $ubi;?></h3>
                      <BR>
                        <h2 class="text-uppercase font-weight-bold mb-4" style="color:antiquewhite"> Horario:</h2>
                        <h4 class="text-uppercase font-weight-bold mb-4" style="color:rgb(255, 255, 255)">8:00 A.M. - 5:00 P.M.</h4>
                        <h4 class="text-uppercase font-weight-bold mb-4" style="color:rgb(255, 255, 255)">de Lunes a Viernes</h4>
                  </div>
                </div>
              <!--Separacion media de la izquierda (carrousel)-->
              <div class="col-lg-7 d-flex">
                  <img back src="img/CC1 (1).jpg" class="img-fluid" width="800%">
              </div>
          </div>
          </div>

      </section>
</body>
</html>