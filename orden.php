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

    <title>Orden</title>
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
                                <a class="nav-link text-light lead-x" href="cerrar.php" style="font-weight:bold;">Cerrar sesión</a>
                            </li>
                        </ul>
                    </div>
                </nav>
            </div>
        </div>

        <footer class="text-muted py-5">
            <div class="container">
                <p class="float-end mb-1">
                    <a href="#" class="text-ligh lead"></a>
                </p>
            </div>
        </footer>

    </section>
    <?php
    $numorden = $_GET['numorden'];
    $n_orden = $numorden;

    // Realizar la consulta para obtener la fecha y hora de la orden
    $servername = "localhost";
    $username = "root";
    $password = "";
    $dbname = "lobofood";
    $conn = new mysqli($servername, $username, $password, $dbname);

    $sql = "SELECT fecha, hora, estado FROM orden WHERE numorden = '$numorden'";
    $resultado = $conn->query($sql);

    if ($resultado->num_rows > 0) {
        $row = $resultado->fetch_assoc();
        $fecha = $row['fecha'];
        $hora = $row['hora'];
        $estado = $row['estado'];
    }
    // Cerrar la conexión a la base de datos
    $conn->close();
    ?>

    <!--Este div me servirá para mostrar los datos de la orden-->
    <div class="container bg-dark">
        <h1 class="text-center text-white">ORDEN #<?php echo $numorden; ?></h1>
        <div class="text-center text-white">
            <p>Fecha: <?php echo $fecha; ?></p>
            <p>Hora: <?php echo $hora; ?></p>
        </div>
    </div>



    <div class="container text-white bg-light">
        <table class="table table-striped">
            <thead>
                <tr>
                    <th scope="col">Producto</th>
                    <th scope="col">Precio</th>
                    <th scope="col">Cantidad</th>
                    <th scope="col">Subtotal</th>
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

                $sql = "SELECT p.nombrep, p.precio, pao.cantidad, pao.total 
                FROM productoaorden AS pao 
                INNER JOIN producto AS p ON pao.idproducto = p.idproducto
                WHERE pao.numorden = '$numorden'";


                $resultado = $conn->query($sql);

                while ($data = $resultado->fetch_assoc()) {
                ?>
                    <tr>
                        <td><?php echo $data['nombrep']; ?></td>
                        <td><?php echo "$" . $data['precio']; ?></td>
                        <td><?php echo $data['cantidad']; ?></td>
                        <td><?php echo "$" . $data['total']; ?></td>
                    </tr>
                <?php
                }
                ?>
            </tbody>
            <tfoot class="text-white">
                <tr>
                    <td>
                        <?php
                        $conn = mysqli_connect("localhost", "root", "", "lobofood");
                        if (!$conn) {
                            die("Error de conexión: " . mysqli_connect_error());
                        }
                        $iduser = $_SESSION['matricula'];

                        $sql = "SELECT SUM(total) as total 
                        FROM productoaorden AS pao 
                        INNER JOIN producto AS p ON pao.idproducto = p.idproducto
                        WHERE pao.numorden = (
                            SELECT numorden 
                            FROM orden 
                            WHERE matricula = $iduser 
                            ORDER BY numorden DESC 
                            LIMIT 1
                        )";

                        $result = mysqli_query($conn, $sql);

                        $total_venta = 0;

                        if ($row = mysqli_fetch_assoc($result)) {
                            $total_venta = $row["total"];
                        }

                        echo "<span style='color: black;'>Total de la compra: $" . $total_venta . "</span>";

                        mysqli_close($conn);
                        ?>
                    </td>
                </tr>
            </tfoot>
        </table>


    </div>

    <div class="container">
        <a class="btn btn-success mr-3" href="historial_compras.php">Regresar</a>
        <a class="btn btn-danger ml-3 <?php echo ($estado === '0' || $estado === '1') ? 'disabled' : ''; ?>" href="cancelar_orden.php?numorden=<?php echo $n_orden; ?>">Cancelar Orden</a>
    </div>

</body>

</html>