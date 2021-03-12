<?php
include_once "../Conexion.php";
$idProveedor = trim ($_POST['idProveedor']);


if($idProveedor != "" ){
    $borrar=" DELETE FROM `proveedores` WHERE `idProveedor`= $idProveedor";
    
    if(mysqli_query($conexion, $borrar)) {
        echo "Registro borrado";
    }else{
        echo "Parece que algo salio mal";
    }
}
