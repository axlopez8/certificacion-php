<?php

include_once "../Conexion.php";
$Id = trim ($_POST['id']);
$Nombre = trim ($_POST['nombre']);
$Nit = trim($_POST['nit']);
$Telefono = trim($_POST['telefono']);
$Email = trim($_POST['email']);
$Persona = trim($_POST['persona']);

if($Id != "" && $Nombre != "" && $Nit != "" && $Telefono != "" && $Email != "" && $Persona != ""  ){
    $editar="UPDATE `proveedores` SET `Nombre_Empresa` = '$Nombre', `Nit_Empresa` = '$Nit', `Telefono_Empresa` = '$Telefono', `Email_Empresa` = '$Email', `FK_Persona` = '$Persona`'  WHERE `proveedores`.`idProveedor` = $Id";
    
    if(mysqli_query($conexion, $editar)) {
        echo "Registro editado";
    }else{
        echo "Parece que algo salio mal";
    }
}