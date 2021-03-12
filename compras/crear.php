<?php

include_once "../Conexion.php";
$Total_Monto = trim($_POST['Total_Monto']);
$Total_Pagado = trim($_POST['Total_Pagado']);
$Proveedor = trim($_POST['proveedor']);
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


if ($Total_Monto != "" && $Total_Pagado != "" && $Proveedor != "" && $Estado != "" && $Producto1 != "" && $Cantidad1 != ""  && $Subtotal1 != "") {

    $crear = "INSERT INTO compras (`idCompra`, `Total_Monto`, `Total_Pagado`, `FK_Proveedor`, `FK_Estado`) VALUES (NULL, '$Total_Monto', '$Total_Pagado','$Proveedor','$Estado')";

    if (mysqli_query($conexion, $crear)) {
        $factura = mysqli_insert_id($conexion);
        if (isset($_POST['cantidad3']) && isset($_POST['Producto3']) && isset($_POST['cantidad2']) && isset($_POST['Producto2'])) {
            $Producto2 = trim($_POST['Producto2']);
            $Cantidad2 = trim($_POST['cantidad2']);
            $Producto3 = trim($_POST['Producto3']);
            $Cantidad3 = trim($_POST['cantidad3']);
            $Subtotal2 = trim($_POST['subtotal2']);
            $Subtotal3 = trim($_POST['subtotal3']);
            
            
				
            $detalle1 = "INSERT INTO detalles_compras (`idDetalle_Compra`, `FK_Producto`, `Cantidad`, `sub_total`, `FK_Compra`) VALUES (NULL, '$Producto1', '$Cantidad1', '$Subtotal1', '$factura')";
            mysqli_query($conexion,$detalle1);sumarcantidad($Cantidad1,$Producto1,$conexion);
            $detalle2 = "INSERT INTO detalles_compras (`idDetalle_Compra`, `FK_Producto`, `Cantidad`, `sub_total`, `FK_Compra`) VALUES (NULL, '$Producto2', '$Cantidad2', '$Subtotal2', '$factura')";
            mysqli_query($conexion,$detalle2);sumarcantidad($Cantidad2,$Producto2,$conexion);
            $detalle3 = "INSERT INTO detalles_compras (`idDetalle_Compra`, `FK_Producto`, `Cantidad`, `sub_total`, `FK_Compra`) VALUES (NULL, '$Producto3', '$Cantidad3', '$Subtotal3', '$factura')";
            mysqli_query($conexion,$detalle3);sumarcantidad($Cantidad3,$Producto3,$conexion);
        } else if (isset($_POST['cantidad2']) && isset($_POST['Producto2'])) {
            $Producto2 = trim($_POST['Producto2']);
            $Cantidad2 = trim($_POST['cantidad2']);
            $Subtotal2 = trim($_POST['subtotal2']);
            
            $detalle1 = "INSERT INTO detalles_compras (`idDetalle_Compra`, `FK_Producto`, `Cantidad`, `sub_total`, `FK_Compra`) VALUES (NULL, '$Producto1', '$Cantidad1', '$Subtotal1', '$factura')";
            mysqli_query($conexion,$detalle1);sumarcantidad($Cantidad1,$Producto1,$conexion);
            $detalle2 = "INSERT INTO detalles_compras (`idDetalle_Compra`, `FK_Producto`, `Cantidad`, `sub_total`, `FK_Compra`) VALUES (NULL, '$Producto2', '$Cantidad2', '$Subtotal2', '$factura')";
            mysqli_query($conexion,$detalle2);sumarcantidad($Cantidad2,$Producto2,$conexion);
        } else{
            $detalle1 = "INSERT INTO detalles_compras (`idDetalle_Compra`, `FK_Producto`, `Cantidad`, `sub_total`, `FK_Compra`) VALUES (NULL, '$Producto1', '$Cantidad1', '$Subtotal1', '$factura')";
            mysqli_query($conexion,$detalle1);sumarcantidad($Cantidad1,$Producto1,$conexion);
        }
    } else {
        echo "Parece que algo salio mal";
    }
}

function sumarcantidad($can,$pro,$con){
    $resultado = mysqli_query($con, "SELECT Cantidad FROM productos WHERE idProducto= $pro");
    while ($columna = mysqli_fetch_array($resultado)) {
        $cantidadv=$columna[0];
        $cantidadn=$cantidadv+$can;
        mysqli_query($con,"UPDATE productos SET Cantidad=$cantidadn WHERE idProducto=$pro");
                };
}