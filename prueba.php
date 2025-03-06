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

    <title>Mi Tienda</title>
    <link rel="icon" type="icon" href="img/favicon.ico">
    <link rel="stylesheet" href="css/rey.css">
    <link rel="stylesheet" href="css/productos.css">
    <!-- link del icono del carrito -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.4.2/css/all.min.css">
    <!-- <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script> -->

</head>

<body>
    <section>

    <div class="row no-gutters">
            <div class="col-1 d-none d-lg-block border-right">
                <div class="d-flex h-25">
                    <div class="align-content-center mx-auto lead-xl">
                        <a href="interfaz_usuario.php"> <img src="img/lobo-logo.png" class="img-fluid" style="height: 70px;"></a>
                    </div>
                </div>
            </div>
            <?php $conexion = mysqli_connect("localhost", "root", "", "lobofood");
            $matricula = $_SESSION['matricula'];
            $usuario = "SELECT nombre FROM usuarios WHERE matricula='$matricula'";
            $res = mysqli_query($conexion, $usuario);
            $res2 = mysqli_fetch_array($res);
            $nom = $res2['nombre'];
            ?>
             
            <?php
            if (isset($_SESSION['carrito'])) {
                $mi_carrito = $_SESSION['carrito'];
            }
            //contamos nuestro carrito
            if (isset($_SESSION['carrito'])) {
                for ($i = 0; $i <= count($mi_carrito) - 1; $i++) {
                    if (isset($mi_carrito[$i])) {
                        if ($mi_carrito[$i] != NULL) {
                            if (!isset($mi_carrito['carrito'])) {
                                $mi_carrito['cantidad'] = '0';
                            } else {
                                $mi_carrito['cantidad'] = $mi_carrito['cantidad'];
                            }
                            $total_cantidad = $mi_carrito['cantidad'];
                            $total_cantidad++;
                            if (!isset($totalCantidad)) {
                                $totalCantidad = '0';
                            } else {
                                $totalCantidad = $totalCantidad;
                            }
                            $totalCantidad += $total_cantidad;
                        }
                    }
                }
            }
            //declaramos variables
            if (!isset($totalCantidad)) {
                $totalCantidad = '';
            } else {
                $totalCantidad = $totalCantidad;
            }
            ?>

            <?php
            //tomar nombre si es usuario nuevo 
            if (isset($_GET['nom'])) {
                $nom = $_GET['nom'];
            }
            ?>

            <!-- Primera divicion menu de arriba a la izquierda-->
            <div class="col-lg-11">
                  <nav class="navbar navbar-expand-sm">
                      <a class="navbar-brand text-light" href="cafeteria.php">  <span class="font-weight-bold t" style="font-size:x-large" >Bienvenido <?php echo $nom; ?></span></a>
                      <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                          <ion-icon class="lead-xl text-light" name="menu-outline"></ion-icon>
                      </button>
                      <!-- Primera divicion menu de arriba a la derecha-->
                      <div class="collapse navbar-collapse" id="navbarSupportedContent">
                      <li class="nav-item">
                                <a class="nav-link text-light lead-x" href="carrito.php" style="font-weight:bold; cursor:pointer;" data-bs-toggle="modal" data-bs-target="#modal_cart" >Mi carrito <i class="fas fa-shopping-cart">
                                    <?php echo $totalCantidad; ?>
                                </i></a>
                            </li>
                            <li>
                                <a class="nav-link text-light lead-x" href="historial_compras.php" style="font-weight:bold;">Historial</a>
                            </li>
                            <li>
                                <a class="nav-link text-light lead-x" href="cerrar.php" style="font-weight:bold;">Cerrar sesion</a>
                            </li>
                      </div>
                  </nav>
              </div>
        </div> 


        <div class="navbar navbar-dark bg-dark shadow-lg">
            <a class="text-uppercase text-light lead-xl " id="fcc">Alimentos</a>
        </div>
        <div class="container align-content-center">
            <div class="row row-cols-1 row-cols-sm-2 row-cols-sm-3 g-3">
                <?php
                $conexion = mysqli_connect("localhost", "root", "", "lobofood");
                $consulta = "SELECT * FROM producto WHERE categoria='Alimento'";
                $resultado = mysqli_query($conexion, $consulta); ?>

                <?php while ($fila = mysqli_fetch_array($resultado)) { ?>

                    <form id="formulario" name="formulario" method="post" action="carrito_comprobar.php">
                        <div class="col">
                            <div class="item card shadow-sm">
                                <img src="img/productos/<?php echo $fila['foto']; ?>" class="item-image img-fluid" alt="producto" width="100%" height="100%">
                                <div class="card-body" style="text-align: center">
                                    <p class="item-title card-text text-dark lead-xl"> <?php echo $fila['nombrep']; ?> </p>
                                    <p class="item-price card-text text-dark lead-x"><small class="text-muted lead-xl">$ <?php echo $fila['precio']; ?></small></p>
                                    <p class="item-price card-text text-dark lead-x"><small class="text-muted lead-xl"> Disponibles: <?php echo $fila['stock']; ?> </small></p>
                                    
                                    <input name="idproducto" type="hidden" id="idproducto" value="<?php echo $fila['idproducto']; ?>" />
                                    <input name="foto" type="hidden" id="foto" value="<?php echo $fila['foto']; ?>" />
                                    <input name="nombrep" type="hidden" id="nombrep" value="<?php echo $fila['nombrep']; ?>" />
                                    <input name="precio" type="hidden" id="precio" value="<?php echo $fila['precio']; ?>" />
                                    <input name="stock" type="hidden" id="stock" value="<?php echo $fila['stock']; ?>" />
                                    <input name="cantidad" type="hidden" id="cantidad" value="1" class="pl-2" />

                                    <div class="d-flex justify-content-between align-self-center">
                                        <div class="btn-group" style="width: 100%;">
                                            <button class="btn btn-secondary addToCart" type="submit" style="font-weight:bold; font-size: large;" onclick="agregarAlCarrito()">
                                            Agregar a Cuenta <i class="fas fa-shopping-cart"></i></button>
                                        </div>
                                        <small class="text-muted lead-xl"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                <?php } ?>
                <?php
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
                $consulta = "SELECT * FROM producto WHERE categoria='Bebida'";
                $resultado = mysqli_query($conexion, $consulta); ?>

                <?php while ($fila = mysqli_fetch_array($resultado)) { ?>

                    <form id="formulario" name="formulario" method="post" action="carrito_comprobar.php">
                        <div class="col">
                            <div class="item card shadow-sm">
                                <img src="img/productos/<?php echo $fila['foto']; ?>" class="item-image img-fluid" alt="producto" width="100%" height="100%">
                                <div class="card-body" style="text-align: center">
                                    <p class="item-title card-text text-dark lead-xl"> <?php echo $fila['nombrep']; ?> </p>
                                    <p class="item-price card-text text-dark lead-x"><small class="text-muted lead-xl">$ <?php echo $fila['precio']; ?></small></p>
                                    <p class="item-price card-text text-dark lead-x"><small class="text-muted lead-xl"> Disponibles: <?php echo $fila['stock']; ?> </small></p>
                                    
                                    <input name="idproducto" type="hidden" id="idproducto" value="<?php echo $fila['idproducto']; ?>" />
                                    <input name="foto" type="hidden" id="foto" value="<?php echo $fila['foto']; ?>" />
                                    <input name="nombrep" type="hidden" id="nombrep" value="<?php echo $fila['nombrep']; ?>" />
                                    <input name="precio" type="hidden" id="precio" value="<?php echo $fila['precio']; ?>" />
                                    <input name="stock" type="hidden" id="stock" value="<?php echo $fila['stock']; ?>" />
                                    <input name="cantidad" type="hidden" id="cantidad" value="1" class="pl-2" />

                                    <div class="d-flex justify-content-between align-self-center">
                                        <div class="btn-group" style="width: 100%;">
                                            <button class="btn btn-secondary addToCart" type="submit" style="font-weight:bold; font-size: large;">Agregar a Cuenta <i class="fas fa-shopping-cart"></i></button>
                                        </div>
                                        <small class="text-muted lead-xl"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                        <?php } ?>
                        <?php
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
                $consulta = "SELECT * FROM producto WHERE categoria='Snack'";
                $resultado = mysqli_query($conexion, $consulta); ?>

                <?php while ($fila = mysqli_fetch_array($resultado)) { ?>

                    <form id="formulario" name="formulario" method="post" action="carrito_comprobar.php">
                        <div class="col">
                            <div class="item card shadow-sm">
                                <img src="img/productos/<?php echo $fila['foto']; ?>" class="item-image img-fluid" alt="producto" width="100%" height="100%">
                                <div class="card-body" style="text-align: center">
                                    <p class="item-title card-text text-dark lead-xl"> <?php echo $fila['nombrep']; ?> </p>
                                    <p class="item-price card-text text-dark lead-x"><small class="text-muted lead-xl">$ <?php echo $fila['precio']; ?></small></p>
                                    <p class="item-price card-text text-dark lead-x"><small class="text-muted lead-xl"> Disponibles: <?php echo $fila['stock']; ?> </small></p>
                                    
                                    <input name="idproducto" type="hidden" id="idproducto" value="<?php echo $fila['idproducto']; ?>" />
                                    <input name="foto" type="hidden" id="foto" value="<?php echo $fila['foto']; ?>" />
                                    <input name="nombrep" type="hidden" id="nombrep" value="<?php echo $fila['nombrep']; ?>" />
                                    <input name="precio" type="hidden" id="precio" value="<?php echo $fila['precio']; ?>" />
                                    <input name="stock" type="hidden" id="stock" value="<?php echo $fila['stock']; ?>" />
                                    <input name="cantidad" type="hidden" id="cantidad" value="1" class="pl-2" />

                                    <div class="d-flex justify-content-between align-self-center">
                                        <div class="btn-group" style="width: 100%;">
                                            <button class="btn btn-secondary addToCart" type="submit" style="font-weight:bold; font-size: large;">Agregar a Cuenta <i class="fas fa-shopping-cart"></i></button>
                                        </div>
                                        <small class="text-muted lead-xl"></small>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </form>
                        <?php } ?>
                        <?php
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