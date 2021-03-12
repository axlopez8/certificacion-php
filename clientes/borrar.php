<?php
include_once "../Conexion.php";
$id = trim ($_POST['idcliente']);


if($id!= "" ){
    $borrar=" DELETE FROM `clientes` WHERE `idCliente`= $id";
    
    if(mysqli_query($conexion, $borrar)) {
        echo "Registro borrado";
    }else{
        echo "Parece que algo salio mal";
    }
}
