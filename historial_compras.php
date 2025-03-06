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

    <title>Datos de orden</title>
    <link rel="icon" type="icon" href="img/favicon.ico">
    <link rel="stylesheet" href="css/rey.css">
    <link rel="stylesheet" href="css/cronometro.css">

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
            <?php
            $conexion = mysqli_connect("localhost", "root", "", "lobofood");
            $nom = '';

            if (!empty($_SESSION['matricula'])) {
                $usuario = "SELECT nombre FROM usuarios WHERE matricula='{$_SESSION['matricula']}'";
                $res = mysqli_query($conexion, $usuario);
                $nom = mysqli_fetch_array($res)['nombre'] ?? '';
            }
            ?>

            <!-- Primera divicion menu de arriba a la izquierda-->
            <div class="col-lg-11">
                <nav class="navbar navbar-expand-sm">
                    <a class="navbar-brand text-light" href="">
                        <span class="font-weight-bold t" style="font-size:x-large">Bienvenido <?php echo $nom; ?></span>
                    </a>
                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarNavDropdown" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <ion-icon class="lead-xl text-light" name="menu-outline"></ion-icon>
                    </button>
                    <!-- Primera divicion menu de arriba a la derecha-->
                    <div class="collapse navbar-collapse" id="navbarNavDropdown">
                        <ul class="navbar-nav ms-lg-auto">
                            <li>
                                <a class="nav-link text-light lead-x" href="interfaz_usuario.php" style="font-weight:bold;">Inicio</a>
                            </li>
                            <li>
                                <a class="nav-link text-light lead-x" href="historial_compras.php" style="font-weight:bold;">Historial</a>
                            </li>
                            <li>
                                <a class="nav-link text-light lead-x" href="cerrar.php" style="font-weight:bold;">Cerrar sesión</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

      

    </section>
    <!--Este div me servira para mostrar los datos de la orden-->
    <div class="container bg-dark">
        <h1 class="text-center text-white">Historial</h1>
    </div>

    <div class="container text-white bg-light">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Número de Orden</th>
                    <th scope="col">Fecha</th>
                    <th scope="col">Hora Final</th>
                    <th scope="col">Total</th>
                    <th scope="col">Estado</th>
                </tr>
            </thead>
            <tbody>
                <?php
                $servername = "localhost";
                $username = "root";
                $password = "";
                $dbname = "lobofood";
                $conn = new mysqli($servername, $username, $password, $dbname);
                $iduser = $_SESSION['matricula'];

                $sql = "SELECT pao.numorden, SUM(pao.total) AS total_orden, o.fecha, o.hora, o.estado
                FROM productoaorden AS pao
                INNER JOIN orden AS o ON pao.numorden = o.numorden
                WHERE o.matricula = '" . $iduser . "'
                GROUP BY pao.numorden";

                $resultado = $conn->query($sql);

                while ($data = $resultado->fetch_assoc()) {
                ?>
                    <tr>
                        <th scope="row">
                            <a href="orden.php?numorden=<?php echo $data['numorden']; ?>"><?php echo "#" . $data['numorden']; ?></a>
                        </th>
                        <th scope="row"> <?php echo $data['fecha'] ?> </th>
                        <th scope="row"> <?php echo $data['hora'] ?> </th>
                        <th scope="row"> <?php echo "$" . $data['total_orden'] ?> </th>
                        <th scope="row">
                            <?php
                            $estado = $data['estado'];
                            if ($estado === NULL) {
                                echo "En proceso";
                            } elseif ($estado == 0) {
                                echo "Cancelado";
                            } elseif ($estado == 1) {
                                echo "Completado";
                            }
                            ?>
                        </th>
                    </tr>
                <?php
                }

                $conn->close();
                ?>

            </tbody>
        </table>

    </div>

    <div class="container">
        <a class="btn btn-success" href="interfaz_usuario.php">Regresar</a>
    </div>

</body>

</html>