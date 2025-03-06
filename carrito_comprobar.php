<?php session_start();
//aqui empiza el carrito
if(isset($_SESSION['carrito']) || isset($_POST['nombrep'])){
    if(isset($_SESSION['carrito'])){ 
        $mi_carrito=$_SESSION['carrito'];
        if(isset($_POST['nombrep'])){
            $idproducto=$_POST['idproducto'];
            $foto=$_POST['foto']; 
            $nombrep=$_POST['nombrep'];
            $precio=$_POST['precio'];
            $stock=$_POST['stock'];  
            $cantidad=$_POST['cantidad']; 
            $donde=-1;
            // Busca el producto en el carrito
            foreach ($mi_carrito as $key => $producto) {
                if ($producto['idproducto'] == $idproducto) {
                    $donde = $key;
                    break;
                }
            }
            
             // Obtener el stock del producto de la base de datos
            $conexion = mysqli_connect("localhost", "root", "", "lobofood");
            $consulta = "SELECT stock FROM producto WHERE idproducto = $idproducto";
            $resultado = mysqli_query($conexion, $consulta);
            $producto = mysqli_fetch_assoc($resultado);
            $stock = $producto['stock'];


            // Si el producto ya está en el carrito, actualiza su cantidad
            if($donde != -1){
                $cuanto=$mi_carrito[$donde]['cantidad'] + $cantidad;

                if ($cuanto > $stock) {
                    $cuanto = $stock;
                } 

                $mi_carrito[$donde]['cantidad'] = $cuanto;
            }else{

                if ($cantidad > $stock) {
                    $cantidad = $stock;
                }

                // Si el producto no está en el carrito, agrégalo
                $mi_carrito[]=array("idproducto"=>$idproducto, "foto"=>$foto, "nombrep"=>$nombrep, "precio"=>$precio, "stock"=>$stock, "cantidad"=>$cantidad);
            }
        }
    }else{
        // Si el carrito está vacío, agrega el producto
        $idproducto=$_POST['idproducto'];
        $foto=$_POST['foto'];
        $nombrep=$_POST['nombrep'];
        $precio=$_POST['precio'];
        $stock=$_POST['stock'];
        $cantidad=$_POST['cantidad'];
        $mi_carrito[]=array("idproducto"=>$idproducto, "foto"=>$foto, "nombrep"=>$nombrep, "precio"=>$precio, "stock"=>$stock, "cantidad"=>$cantidad);        
    }
    $_SESSION['carrito']=$mi_carrito;
}
header("Location: ".$_SERVER['HTTP_REFERER']."");
?>