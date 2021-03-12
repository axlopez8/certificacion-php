<?php

include_once "../Conexion.php";
$nombre = trim ($_POST['nombre']);
$cantidad = trim($_POST['cantidad']);
$preciocompra = trim($_POST['preciocompra']);
$precioventa = trim($_POST['precioventa']);
$proveedor = trim($_POST['proveedor']);

if($nombre != "" && $cantidad != "" && $preciocompra != "" && $precioventa != "" && $proveedor != ""  ){
    $crear="INSERT INTO `productos` (`idProducto`, `Nombre`, `Cantidad`, `Precio_Compra`, `Precio_Venta`, `FK_Proveedor`) VALUES (NULL, '$nombre', '$cantidad', '$preciocompra', '$precioventa', '$proveedor')";
    
    if(mysqli_query($conexion, $crear)) {
        echo "Registro creado";
    }else{
        echo "Parece que algo salio mal";
    }
}
