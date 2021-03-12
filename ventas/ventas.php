<!DOCTYPE html>
<html lang="en">

<head>
	<meta charset="utf-8">
	<meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
	<title>Tersa.gt</title>
	<link rel="stylesheet" href="../css/estilos.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Roboto|Varela+Round">
	<link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
	<link rel="stylesheet" href="https://fonts.googleapis.com/icon?family=Material+Icons">
	<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/font-awesome/4.7.0/css/font-awesome.min.css">
	<script src="https://code.jquery.com/jquery-3.5.1.min.js"></script>
	<script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
	<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/js/bootstrap.min.js"></script>

</head>

<body>
	<div class="container-xl">
		<div class="table-responsive">
			<div class="table-wrapper">
				<div class="table-title">
					<div class="row">
						<div class="col-sm-6">
							<h2>Tabla Ventas</h2>
						</div>
						<div class="col-sm-6">
							<a href="#AñadirRegistro" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Añadir Venta</span></a>
						</div>
					</div>
				</div>
				<?php
				include_once '../Conexion.php';
				$consulta = "SELECT idVenta,P.Nombres,P.Apellidos,P.NIT,Direccion_Venta,Total_monto,total_pagado,E.Nombre FROM `ventas` AS V INNER JOIN clientes AS C ON V.FK_Cliente=C.idCliente INNER JOIN personas AS P ON C.FK_Persona=P.idPersona INNER JOIN estados_deudas AS E ON V.FK_Estado=E.idEstado";
				$resultado = mysqli_query($conexion, $consulta) or die("Si esta leyendo estoy significa que la consulta esta mal compras");
				while ($columna = mysqli_fetch_array($resultado)) {


				?>
					<div class="card bg-secondary text-white mb-3">
						<div class="card-body">
							<h5 class="card-title">Venta No.<?php echo $columna[0] ?></h5>
							<p class="card-text m-auto">Cliente:<?php echo $columna[1] . " ". $columna[2] ?></p>
							<p class="card-text m-auto">NIT:<?php echo $columna[3] ?></p>
							<p class="card-text m-auto">Direccion:<?php echo $columna[4] ?></p>
						</div>
						<div class="card-body">
							<div class="table-responsive-sm">
								<table class="table table-striped table-bordered table-sm">
									<thead class="thead-dark">
										<tr>
											<th class="text-center" scope="col">Cantidad.</th>
											<th class="text-center" scope="col">Producto</th>
											<th class="text-center" scope="col">Precio</th>
											<th class="text-center" scope="col">Sub Total</th>
										</tr>
									</thead>

									<tbody>
										<?php
										$consultad = "SELECT idDetalle_Venta, P.Nombre, P.Precio_Venta, DV.Cantidad, DV.Sub_Total FROM detalles_ventas AS DV INNER JOIN productos AS P ON DV.FK_Producto=P.idProducto WHERE FK_Venta=$columna[0]";
										$resultadod = mysqli_query($conexion, $consultad) or die("Si esta leyendo estoy significa que la consulta esta mal detalles");
										$total = 0;
										while ($columnad = mysqli_fetch_array($resultadod)) {
										?>
											<tr>
												<td class="text-center table-secondary"><?php echo $columnad[3] ?> </td>
												<td class="table-secondary"><?php echo $columnad[1] ?> </td>
												<td class="text-center table-secondary"><?php echo $columnad[2]; $total = $total + floatval($columnad[4] )?> </td>
												<td class="table-secondary"><?php echo $columnad[4] ?> </td>
											</tr>
										<?php } ?>
										<tr>
											<td class="table-dark text-right" colspan="3">SubTotal</td>
											<td class="table-secondary text-center">Q.<?php echo $total;$total = 0; ?></td>
										</tr>
									</tbody>
								</table>
							</div>
						</div>
						<div class="card-footer">
							<p class="card-subtitle">Total: Q.<?php echo $columna[5]; ?></p>
							<p class="card-subtitle">Pago: Q.<?php echo $columna[6]; ?> </p>
							<p class="card-subtitle">Estado: <?php echo $columna[7]; ?> </p>
						</div>
					</div>
				<?php } ?>
			</div>
			<br>
			<br>
			<br>
			<center><button style="background-color:green" class="btn btn-secondary btn-lg active" onclick="window.location.href='/Proyectos%20PHP/menu.php'"> MENU</button></center>
		</div>
	</div>
	<!-- Edit Modal HTML -->
	<div id="AñadirRegistro" class="modal fade">
		<div class="modal-dialog">
			<div class="modal-content">
				<form action="crear.php" method="POST">
					<div class="modal-header">
						<h4 class="modal-title">Añadir Venta</h4>
						<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
					</div>
					<div id="SEL2" class="form-group">

						<label>Nombre del cliente</label>

						<select id="cliente" class="form-control" required>
							<option selected>---- Nombre de los Clientes ----</option>

							<?php
							$consulta2 = "SELECT idCliente, P.Nombres, P.Apellidos FROM clientes AS C INNER JOIN personas AS P ON C.FK_Persona=P.idPersona";
							$resultado2 = mysqli_query($conexion, $consulta2) or die("Si esta leyendo estoy significa que la consulta esta mal");
							$consulta3 = "SELECT idProducto, Nombre, Precio_Venta, Cantidad FROM productos";
							$resultado3 = mysqli_query($conexion, $consulta3) or die("Si esta leyendo estoy significa que la consulta esta mal");

							while ($columna2 = mysqli_fetch_array($resultado2)) {
							?>
								<option value="<?php echo $columna2[0] ?>"><?php echo $columna2[1] . " " . $columna2[2] ?></option>
							<?php
							}
							?>
						</select>

					</div>
					<div class="form-group">
							<label>Direccion_Venta</label>
							<input type="text" id="direccion" class="form-control" required >
						</div>
					<?php
					$resultadop = mysqli_query($conexion, $consulta3) or die("Si esta leyendo estoy significa que la consulta esta mal");
					
					while ($columna3 = mysqli_fetch_array($resultadop)) {
					?>
						<input type="hidden" id="p<?php echo $columna3[0] ?>" value="<?php echo $columna3[2] ?>" />
					<?php
					}
					
					?>
					<div id="Pro1" class="form-group">

						<label>Producto</label>

						<select id="Producto1" class="form-control" required>
							<option selected>---- Productos ----</option>

							<?php
							while ($columna3 = mysqli_fetch_array($resultado3)) {
							?>
								<option value="<?php echo $columna3[0] ?>"><?php echo $columna3[1] ?> -- <?php echo $columna3[2] ?></option>

							<?php
							}
							?>
						</select>

						<input type="number" id="cantidad1" class="form-control" required>

					</div>
					<div id="Pro2" class="form-group">

						<label>Producto</label>

						<select id="Producto2" class="form-control" required>
							<option selected>---- Productos ----</option>

							<?php
							$resultadop = mysqli_query($conexion, $consulta3) or die("Si esta leyendo estoy significa que la consulta esta mal");

							while ($columna3 = mysqli_fetch_array($resultadop)) {
							?>
								<option value="<?php echo $columna3[0] ?>"><?php echo $columna3[1] ?> -- <?php echo $columna3[2] ?></option>

							<?php
							}
							?>
						</select>

						<input type="number" id="cantidad2" class="form-control" required>

					</div>
					<div id="Pro3" class="form-group">

						<label>Producto</label>

						<select id="Producto3" class="form-control" required>
							<option selected>---- Productos ----</option>

							<?php
							$resultadop = mysqli_query($conexion, $consulta3) or die("Si esta leyendo estoy significa que la consulta esta mal");

							while ($columna3 = mysqli_fetch_array($resultadop)) {
							?>
								<option value="<?php echo $columna3[0] ?>"><?php echo $columna3[1] ?> -- <?php echo $columna3[2] ?></option>

							<?php
							}
							?>
						</select>

						<input type="number" id="cantidad3" class="form-control" required>

					</div>
					<div class="modal-body">
						<div class="form-group">
							<label>Total_Monto</label>
							<input type="number" id="monto" class="form-control" required readonly>
						</div>
						<div class="form-group">
							<label>Total_Pagado</label>
							<input type="number" id="pago" class="form-control" required>
						</div>

						<div class="form-group">
							<label>Estado</label>
							<input type="text" id="estado" class="form-control" readonly required>
						</div>
					</div>
					<div class="modal-footer">
						<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
						<input type="button" class="btn btn-success" value="Agregar" onclick="agregar()">
					</div>
				</form>
			</div>
		</div>
	</div>
</body>

</html>
<script src="https://code.jquery.com/jquery-3.5.1.min.js" integrity="sha256-9/aliU8dGd2tb6OSsuzixeV4y/faTqgFtohetphbbj0=" crossorigin="anonymous"></script>
<script>
	var monto1 = 0
	var monto2 = 0
	var monto3 = 0
	$(document).on("change", "#pago", function() {
		if (document.getElementById("pago").value >= document.getElementById("monto").value) {
			document.getElementById('estado').value = "Cancelado"
		} else {
			document.getElementById('estado').value = "Deuda"
		}
	});

	$(document).on("change", "#cantidad1", function() {
		var d = document.getElementById("Producto1").value
		monto1 = document.getElementById("p" + d).value * document.getElementById("cantidad1").value
		document.getElementById("monto").value = monto1 + monto2 + monto3
	});
	$(document).on("change", "#cantidad2", function() {
		var d = document.getElementById("Producto2").value
		monto2 = document.getElementById("p" + d).value * document.getElementById("cantidad2").value
		document.getElementById("monto").value = monto1 + monto2 + monto3
	});
	$(document).on("change", "#cantidad3", function() {
		var d = document.getElementById("Producto3").value
		monto3 = document.getElementById("p" + d).value * document.getElementById("cantidad3").value
		document.getElementById("monto").value = monto1 + monto2 + monto3
	});

	// java script para agregar valores de registros.
	function agregar() {
		var Total_Monto = $('#monto').val();
		var Total_Pagado = $('#pago').val();
		var cliente = $('#cliente').val();
		var estado = $('#estado').val();
		var direccion = $('#direccion').val();
		var parametros = null;
		var subtotal1 = monto1;
		var subtotal2 = monto2;
		var subtotal3 = monto3;

		if($('#cantidad1').val()> 0 && $('#Producto1').val()> 0 && $('#cantidad2').val()> 0 && $('#Producto2').val()> 0 && $('#cantidad3').val()> 0 && $('#Producto3').val()> 0){
			var producto1 = $('#Producto1').val();
			var producto2 = $('#Producto2').val();
			var producto3 = $('#Producto3').val();
			var cantidad1 = $('#cantidad1').val();
			var cantidad2 = $('#cantidad2').val();
			var cantidad3 = $('#cantidad3').val();
			parametros = 'Total_Monto=' + Total_Monto + '&Total_Pagado=' + Total_Pagado + '&cliente=' + cliente + '&direccion=' + direccion + '&estado=' + estado + '&Producto1=' + producto1 + '&Producto2=' + producto2 + '&Producto3=' + producto3
			+ '&cantidad1=' + cantidad1 + '&cantidad2=' + cantidad2 + '&cantidad3=' + cantidad3 + '&subtotal1=' + subtotal1 + '&subtotal2=' + subtotal2 + '&subtotal3=' + subtotal3;
			
		} else if($('#cantidad1').val()> 0 && $('#Producto1').val()> 0 && $('#cantidad2').val()> 0 && $('#Producto2').val()> 0 ){
			var producto1 = $('#Producto1').val();
			var producto2 = $('#Producto2').val();
			var cantidad1 = $('#cantidad1').val();
			var cantidad2 = $('#cantidad2').val();
			parametros = 'Total_Monto=' + Total_Monto + '&Total_Pagado=' + Total_Pagado + '&cliente=' + cliente + '&direccion=' + direccion + '&estado=' + estado + '&Producto1=' + producto1 + '&Producto2=' + producto2 
			+ '&cantidad1=' + cantidad1 + '&cantidad2=' + cantidad2 + '&subtotal1=' + subtotal1 + '&subtotal2=' + subtotal2;
			
		} else if($('#cantidad1').val()> 0 && $('#Producto1').val()> 0){
			var producto1 = $('#Producto1').val();
			var cantidad1 = $('#cantidad1').val();
			parametros = 'Total_Monto=' + Total_Monto + '&Total_Pagado=' + Total_Pagado + '&cliente=' + cliente + '&direccion=' + direccion + '&estado=' + estado + '&Producto1=' + producto1 + '&cantidad1=' + cantidad1 + '&subtotal1=' + subtotal1;
		} 

		$.ajax({
			method: "POST",
			url: "crear.php",
			data: parametros,
			success: function() {
				location.reload();
			}
		})
		 
	};
</script>