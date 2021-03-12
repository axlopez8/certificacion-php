<?php

include_once "../Conexion.php";
$id = trim ($_POST['id']);
$Nombres = trim ($_POST['Nombres']);
$Apellidos = trim($_POST['Apellidos']);
$DPI = trim($_POST['DPI']);
$NIT = trim($_POST['NIT']);
$Telefono = trim($_POST['Telefono']);
$Email = trim($_POST['Email']);

if($id != "" && $Nombres != "" && $Apellidos != "" && $DPI != "" && $NIT != "" && $Telefono != "" && $Email != ""  ){
    $editar="UPDATE `personas` SET `Nombres`= '$Nombres',`Apellidos`='$Apellidos',`DPI`=$DPI,`NIT`='$NIT',`Telefono`=$Telefono,`Email`='$Email' WHERE idPersona=$id";
    
    if(mysqli_query($conexion, $editar)) {
        echo "Registro editado";
    }else{
        echo "Parece que algo salio mal";
    }
}