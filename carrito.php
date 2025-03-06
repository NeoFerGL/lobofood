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

    <title>Mi Carrito</title>
    <link rel="icon" type="icon" href="img/favicon.ico">
    <link rel="stylesheet" href="css/rey.css">
    <link rel="stylesheet" href="css/productos.css">
    <link rel="stylesheet" href="css/carrito.css">
    <!-- link del icono de bote de basura -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
    <script>
        $(function() {
            $('.shoppingCartItemQuantity').on('change', function() {
                var productId = $(this).data('product-id');
                var quantity = parseInt($(this).val()); // Convertir la cantidad ingresada a número
                var maxQuantity = parseInt($(this).attr('max')); // Convertir el stock máximo a número

                // Verifica si la cantidad ingresada es mayor al stock del producto
                if (quantity > maxQuantity) {
                    $(this).val(maxQuantity); // Establece la cantidad máxima permitida en el input
                    $('#stock-error-' + productId).show(); // Muestra el mensaje de error si estaba oculto
                    return false; // Detiene la ejecución de la función
                } else {
                    $('#stock-error-' + productId).hide(); // Oculta el mensaje de error
                }

                // Si la cantidad es válida, realiza la petición Ajax para actualizar la cantidad del producto en el carrito
                $.ajax({
                    url: 'actualizarCantidadProductoCarrito.php',
                    method: 'POST',
                    data: {
                        id_producto: productId,
                        cantidad: quantity
                    },
                    success: function(response) {
                        // Si la actualización fue exitosa, actualizar el valor de la variable en el carrito
                        if (response === 'OK') {
                            location.reload();
                        }
                    }
                });
            });
        });

        function comprobar_boton() {
            var carrito = <?php echo json_encode($_SESSION['carrito']); ?>;
            console.log(carrito);
            if (carrito.length === 0) {
                alert('El carrito está vacío');
            } else {
                if (confirm('¿Está seguro que desea continuar con la orden?, Si desea continuar el tiempo para recoger su pedido en la cafetería comenzará de inmediato.')) {
                    $.ajax({
                        url: 'procesar_orden.php',
                        method: 'POST',
                        success: function(response) {
                            // Si la orden se procesó correctamente, redirigir al usuario a la página de ticket
                            window.location.href = 'ticket.php';
                        }
                    });
                }
            }
        }
    </script>
</head>

<body>
    <section>

        <div class="row no-gutters">
            <div class="col-1 d-none d-lg-block border-right">
                <div class="d-flex h-25">
                    <div class="align-content-center mx-auto lead-xl">
                        <a href="cafeteria.php"> <img src="img/lobo-logo.png" class="img-fluid" style="height: 70px;"></a>
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

        <div class="navbar navbar-dark bg-dark shadow-lg">
            <a class="text-uppercase text-light lead-xl " id="fcc">Mi Carrito</a>
        </div>
        </div>
        <br>
        <!-- START SECTION SHOPPING CART -->
        <section class="shopping-cart">
            <div class="container">
                <div class="row">
                    <div class="col-6">
                        <div class="shopping-cart-header">
                            <h5 class="text-white">Producto</h5>
                        </div>
                    </div>
                    <div class="col-2">
                        <div class="shopping-cart-header">
                            <h5 class="text-truncate text-white">Precio</h5>
                        </div>
                    </div>
                    <div class="col-4">
                        <div class="shopping-cart-header">
                            <h5 class="text-white">Cantidad</h5>
                        </div>
                    </div>
                </div>

                <!-- ? START SHOPPING CART ITEMS -->
                <div class="shopping-cart-items shoppingCartItemsContainer" id="shoppingCartItemsContainer">
                    <?php
                    $total = 0; // inicializar la variable $total
                    if (isset($_SESSION['carrito'])) {
                        $mi_carrito = $_SESSION['carrito'];
                        foreach ($mi_carrito as $id => $producto) { //recorre el array de carrito_comprobar para obtener los datos almcenados
                            $subtotal = $producto['precio'] * $producto['cantidad'];
                            $total += $subtotal; // sumar el subtotal al total
                    ?>
                            <div class="row shoppingCartItem">
                                <div class="col-6">
                                    <div class="shopping-cart-item d-flex align-items-center h-100 border-bottom pb-2 pt-3">
                                        <img src="img/productos/<?php echo $producto['foto']; ?>" class="shopping-cart-image img-thumbnail img-fluid">
                                        <h5 class="shopping-cart-item-title shoppingCartItemTitle text-truncate ml-3 mb-0 text-white"><?php echo $producto['nombrep']; ?></h5>
                                    </div>
                                </div>
                                <div class="col-2">
                                    <div class="shopping-cart-price d-flex align-items-center h-100 border-bottom pb-2 pt-3">
                                        <p class="item-price mb-0 shoppingCartItemPrice text-white">$<?php echo $producto['precio']; ?></p>
                                    </div>
                                </div>
                                <div class="col-4">
                                    <div class="shopping-cart-quantity d-flex justify-content-between align-items-center h-100 border-bottom pb-2 pt-3">
                                        <input class="shopping-cart-quantity-input shoppingCartItemQuantity" type="number" value="<?php echo $producto['cantidad']; ?>" max="<?php echo $producto['stock']; ?>" min="1" data-product-id="<?php echo $id; ?>">
                                        <span class="stock-error-message" id="stock-error-<?php echo $id; ?>" style="display:none; color:red; text-align:center;">La cantidad seleccionada excede el stock disponible.</span>

                                        <form method="post" action="eliminarProductoCarrito.php">
                                            <input type="hidden" name="id_producto" value="<?php echo $id; ?>"> <!-- pasar el identificador único como variable POST -->
                                            <button class="btn btn-danger buttonDelete" type="submit" name="eliminar"><i class="fa fa-trash" style="font-size:24px"></i></button> <!-- agregar un botón de tipo submit para enviar el formulario -->
                                        </form>
                                    </div>
                                </div>
                            </div>
                    <?php
                        }
                    }

                    ?>
                </div>

                <!-- ? END SHOPPING CART ITEMS -->
                <!-- START TOTAL -->
                <div class="row">
                    <div class="col-12">
                        <div class="shopping-cart-total d-flex align-items-center ml-auto">
                            <p class="mb-0 text-white">Total</p>
                            <p class="ml-4 mb-0 shoppingCartTotal text-white">$<?php echo $total; ?></p> <!-- imprimir el valor de $total -->
                            <a href="interfaz_usuario.php" class="btn btn-success ml-3 comprarButton">
                                Regresar
                            </a>
                            <a type="button" href="borrar_carrito.php" class="btn btn-success ml-3 comprarButton">
                                Limpiar
                            </a>
                            <a id="btn-apartar" type="submit" name="apartar" class="btn btn-success ml-3 comprarButton" onclick="comprobar_boton();">
                                Apartar
                            </a>


                        </div>
                    </div>
                </div>
            </div>
            <!-- END TOTAL -->

        </section>

        <footer class="text-muted py-5">
            <div class="container">
                <p class="float-end mb-1">
                    <a href="#" class="text-ligh lead"><ion-icon name="arrow-up-outline"></ion-icon></a>
                </p>
            </div>
        </footer>
    </section>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>


</body>

</html>