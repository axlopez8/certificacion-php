<?php

include_once "../Conexion.php";
$id = trim ($_POST['id']);
$nombre = trim ($_POST['nombre']);
$cantidad = trim($_POST['cantidad']);
$preciocompra = trim($_POST['preciocompra']);
$precioventa = trim($_POST['precioventa']);
$proveedor = trim($_POST['proveedor']);

if($id != "" && $nombre != "" && $cantidad != "" && $preciocompra != "" && $precioventa != "" && $proveedor != ""  ){
    $editar="UPDATE `productos` SET `Nombre` = '$nombre', `Cantidad` = '$cantidad', `Precio_Compra` = '$preciocompra', `Precio_Venta` = '$precioventa', `FK_Proveedor` = '$proveedor`'  WHERE `productos`.`idProducto` = $id";
    
    if(mysqli_query($conexion, $editar)) {
        echo "Registro editado";
    }else{
        echo "Parece que algo salio mal";
    }
}