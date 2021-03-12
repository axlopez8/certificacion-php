<?php
include_once "../Conexion.php";
$idproducto = trim ($_POST['idproducto']);


if($idproducto != "" ){
    $borrar=" DELETE FROM `productos` WHERE `idProducto`= $idproducto";
    
    if(mysqli_query($conexion, $borrar)) {
        echo "Registro borrado";
    }else{
        echo "Parece que algo salio mal";
    }
}
