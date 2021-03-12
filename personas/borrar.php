<?php
include_once "../Conexion.php";
$idPersona = trim ($_POST['idPersona']);


if($idPersona != "" ){
    $borrar=" DELETE FROM `personas` WHERE `idPersona`= $idPersona";
    
    if(mysqli_query($conexion, $borrar)) {
        echo "Registro borrado";
    }else{
        echo "Parece que algo salio mal";
    }
}
