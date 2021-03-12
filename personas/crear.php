<?php

include_once "../Conexion.php";

$Nombres = trim ($_POST['Nombres']);
$Apellidos = trim($_POST['Apellidos']);
$DPI = trim($_POST['DPI']);
$NIT = trim($_POST['NIT']);
$Telefono = trim($_POST['Telefono']);
$Email = trim($_POST['Email']);

if($Nombres != "" && $Apellidos != "" && $DPI != "" && $NIT != "" && $Telefono != "" && $Email != ""   ){
    $crear="INSERT INTO `personas` (`idPersona`, `Nombres`, `Apellidos`, `DPI`, `NIT`, `Telefono`, `Email`) VALUES (NULL, '$Nombres', '$Apellidos', '$DPI', '$NIT', '$Telefono', '$Email')";
    
    if(mysqli_query($conexion, $crear)) {
        echo "Registro creado";
    }else{
        echo "Parece que algo salio mal";
    }
}
