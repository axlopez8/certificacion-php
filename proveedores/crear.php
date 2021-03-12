
<?php

include_once "../Conexion.php";
$Nombre = trim ($_POST['nombre']);
$Nit = trim($_POST['nit']);
$Telefono = trim($_POST['telefono']);
$Email = trim($_POST['email']);
$Persona = trim($_POST['persona']);

if($Nombre != "" && $Nit != "" && $Telefono != "" && $Email != "" && $Persona != ""  ){
    $editar="INSERT INTO `proveedores` (`idProveedor`, `Nombre_Empresa`, `Nit_Empresa`, `Telefono_Empresa`, `Email_Empresa`, `FK_Persona`) VALUES (NULL, '$Nombre', '$Nit', '$Telefono', '$Email', '$Persona')";
    
    if(mysqli_query($conexion, $editar)) {
        echo "Registro editado";
    }else{
        echo "Parece que algo salio mal";
    }
}