<?php

include_once "../Conexion.php";
$id = trim ($_POST['id']);
$persona = trim ($_POST['persona']);
$venta = trim($_POST['venta']);

if($id != "" && $persona != "" && $venta != ""  ){
    $editar="UPDATE `clientes` SET `FK_Persona` = '$persona`', `FK_Venta` = '$venta`'   WHERE `clientes`.`idCliente` = $id";
    
    if(mysqli_query($conexion, $editar)) {
        echo "Registro editado";
    }else{
        echo "Parece que algo salio mal";
    }
}