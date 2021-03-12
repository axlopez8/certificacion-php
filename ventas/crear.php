<?php

include_once "../Conexion.php";
$Total_Monto = trim($_POST['Total_Monto']);
$Total_Pagado = trim($_POST['Total_Pagado']);
$cliente = trim($_POST['cliente']);
$direccion = trim($_POST['direccion']);
$Estado = trim($_POST['estado']);
$Producto1 = trim($_POST['Producto1']);
$Cantidad1 = trim($_POST['cantidad1']);
$Subtotal1 = trim($_POST['subtotal1']);

if ($Estado == "Cancelado") {
    $Estado = 1;
}
if ($Estado == "Deuda") {
    $Estado = 2;
}


if ($Total_Monto != "" && $Total_Pagado != "" && $cliente != "" && $direccion != "" && $Estado != "" && $Producto1 != "" && $Cantidad1 != ""  && $Subtotal1 != "") {

    $crear = "INSERT INTO `ventas`(`idVenta`, `FK_Cliente`, `Direccion_Venta`, `Total_monto`, `total_pagado`, `FK_Estado`) VALUES (null,$cliente,'$direccion',$Total_Monto,$Total_Pagado,$Estado)";

    if (mysqli_query($conexion, $crear)) {
        $venta = mysqli_insert_id($conexion);
        if (isset($_POST['cantidad3']) && isset($_POST['Producto3']) && isset($_POST['cantidad2']) && isset($_POST['Producto2'])) {
            $Producto2 = trim($_POST['Producto2']);
            $Cantidad2 = trim($_POST['cantidad2']);
            $Producto3 = trim($_POST['Producto3']);
            $Cantidad3 = trim($_POST['cantidad3']);
            $Subtotal2 = trim($_POST['subtotal2']);
            $Subtotal3 = trim($_POST['subtotal3']);
            
            
				
            $detalle1 = "INSERT INTO `detalles_ventas`(`idDetalle_Venta`, `FK_Producto`, `Cantidad`, `Sub_Total`, `FK_Venta`) VALUES (null,$Producto1,$Cantidad1,$Subtotal1,$venta)";
            mysqli_query($conexion,$detalle1);sumarcantidad($Cantidad1,$Producto1,$conexion);
            $detalle2 = "INSERT INTO `detalles_ventas`(`idDetalle_Venta`, `FK_Producto`, `Cantidad`, `Sub_Total`, `FK_Venta`) VALUES (null,$Producto2,$Cantidad2,$Subtotal2,$venta)";
            mysqli_query($conexion,$detalle2);sumarcantidad($Cantidad2,$Producto2,$conexion);
            $detalle3 = "INSERT INTO `detalles_ventas`(`idDetalle_Venta`, `FK_Producto`, `Cantidad`, `Sub_Total`, `FK_Venta`) VALUES (null,$Producto3,$Cantidad3,$Subtotal3,$venta)";
            mysqli_query($conexion,$detalle3);sumarcantidad($Cantidad3,$Producto3,$conexion);
        } else if (isset($_POST['cantidad2']) && isset($_POST['Producto2'])) {
            $Producto2 = trim($_POST['Producto2']);
            $Cantidad2 = trim($_POST['cantidad2']);
            $Subtotal2 = trim($_POST['subtotal2']);
            
            $detalle1 = "INSERT INTO `detalles_ventas`(`idDetalle_Venta`, `FK_Producto`, `Cantidad`, `Sub_Total`, `FK_Venta`) VALUES (null,$Producto1,$Cantidad1,$Subtotal1,$venta)";
            mysqli_query($conexion,$detalle1);sumarcantidad($Cantidad1,$Producto1,$conexion);
            $detalle2 = "INSERT INTO `detalles_ventas`(`idDetalle_Venta`, `FK_Producto`, `Cantidad`, `Sub_Total`, `FK_Venta`) VALUES (null,$Producto2,$Cantidad2,$Subtotal2,$venta)";
            mysqli_query($conexion,$detalle2);sumarcantidad($Cantidad2,$Producto2,$conexion);
        } else{
            $detalle1 = "INSERT INTO `detalles_ventas`(`idDetalle_Venta`, `FK_Producto`, `Cantidad`, `Sub_Total`, `FK_Venta`) VALUES (null,$Producto1,$Cantidad1,$Subtotal1,$venta)";
            mysqli_query($conexion,$detalle1);sumarcantidad($Cantidad1,$Producto1,$conexion);
        }
    } else {
        echo "Parece que algo salio mal";
        echo $crear;
    }
}

function sumarcantidad($can,$pro,$con){
    $resultado = mysqli_query($con, "SELECT Cantidad FROM productos WHERE idProducto= $pro");
    while ($columna = mysqli_fetch_array($resultado)) {
        $cantidadv=$columna[0];
        $cantidadn=$cantidadv-$can;
        mysqli_query($con,"UPDATE productos SET Cantidad=$cantidadn WHERE idProducto=$pro");
                };
}