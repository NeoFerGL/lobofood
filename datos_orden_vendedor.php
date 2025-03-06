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

<body class="bg-dark">
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
                                    <a class="nav-link text-light lead-x" href="cerrar.php"style="font-weight:bold;">CERRAR SESION</a>
                              </li>
                      </div>
                  </nav>
              </div>
          </div>
    <br>
    <?php
$numorden = $_GET['numorden'];

// Obtener los datos de la orden (nombre de usuario, fecha, hora)
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "lobofood";
$conn = new mysqli($servername, $username, $password, $dbname);

$sql = "SELECT usuarios.nombre AS nombre_usuario, orden.fecha, orden.hora, orden.estado 
        FROM orden 
        INNER JOIN usuarios ON orden.matricula = usuarios.matricula
        WHERE orden.numorden = $numorden";

$resultado = $conn->query($sql);

if ($data = $resultado->fetch_assoc()) {
    $nombre_usuario = $data['nombre_usuario'];
    $fecha = $data['fecha'];
    $hora = $data['hora'];
    $estado = $data['estado'];
}

?>

<!--Este div me servirá para mostrar los datos de la orden-->
<div class="container bg-dark">
    <h1 class="text-center text-white">ORDEN #<?php echo $numorden; ?></h1>
    <p class="text-center text-white">Usuario: <?php echo $nombre_usuario; ?></p>
    <p class="text-center text-white">Fecha: <?php echo $fecha; ?></p>
    <p class="text-center text-white">Hora Final: <?php echo $hora; ?></p>
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
        $numorden = $_GET['numorden'];

        $sql = "SELECT p.nombrep, p.precio, pao.cantidad, pao.total 
            FROM productoaorden AS pao 
            INNER JOIN producto AS p ON pao.idproducto = p.idproducto
            WHERE pao.numorden = $numorden";

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

                $sql = "SELECT SUM(total) as total 
                    FROM productoaorden 
                    WHERE numorden = $numorden";

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
        <a class="btn btn-success mr-3" href="verorden.php">Regresar</a>
        <a class="btn btn-danger ml-3 <?php echo ($estado === '0' || $estado === '1') ? 'disabled' : ''; ?>" href="completar_orden.php?numorden=<?php echo $numorden;?>">Completo</a>
    </div>
</body>

</html>