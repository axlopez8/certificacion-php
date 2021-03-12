<?php

include_once "../Conexion.php";
$persona = trim ($_POST['persona']);
$venta = trim($_POST['venta']);

if($persona != "" && $venta != "" ){
    $crear="INSERT INTO `clientes` (`idCliente`, `FK_Persona`, `FK_Venta`) VALUES (NULL, '$persona', '$venta' )";
    
    if(mysqli_query($conexion, $crear)) {
        echo "Registro creado";
    }else{
        echo "Parece que algo salio mal";
    }
}
