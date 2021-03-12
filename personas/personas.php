<!DOCTYPE html>
<html lang="en">
<head>
<meta charset="utf-8">
<meta name="viewport" content="width=device-width, iNITial-scale=1, shrink-to-fit=no">
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
						<h2>Tabla Personas</h2>
					</div>
					<div class="col-sm-6">
						<a href="#AñadirRegistro" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Añadir Persona</span></a>						
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Nombres</th>
						<th>Apellidos</th>
						<th>DPI</th>
						<th>NIT</th>
						<th>Telefono</th>
						<th>Email</th>
						<th> </th>

					</tr>
				</thead>
				<tbody>
				<?php
				include_once '../Conexion.php';
				$consulta = "SELECT p.idPersona, p.Nombres, P.Apellidos, P.DPI, P.NIT, P.Telefono, P.Email FROM personas AS P";
				$resultado = mysqli_query($conexion, $consulta) or die ("Si esta leyendo estoy significa que la consulta esta mal");
				While($columna=mysqli_fetch_array($resultado)){
					
				
			?>
					<tr>
						
						<td> <?php echo $columna[0] ?> </td>
						<td> <?php echo $columna[1] ?></td>
						<td> <?php echo $columna[2] ?></td>
						<td> <?php echo $columna[3] ?></td>
						<td> <?php echo $columna[4] ?></td>
						<td> <?php echo $columna[5] ?> </td>
						<td> <?php echo $columna[6] ?> </td>



						<td>
							<a href="#EditarRegistro" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit" onclick='EdiForm(<?php echo $columna[0] ?>,"<?php echo $columna[1] ?>","<?php echo $columna[2] ?>",<?php echo$columna[3] ?>,"<?php echo $columna[4] ?>",<?php echo $columna[5]?>, "<?php echo $columna[6] ?>")'> &#xE254;</i></a>
							<a href=""  class="delete" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Delete" onclick="eliminar(<?php echo $columna[0]?>,'<?php echo $columna[1]?>')">&#xE872;</i></a>
						</td>
					</tr>
					<?php
				}
					?>
					
				</tbody>
			</table>        
			
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
			<form action="crear.php" method="POST" >
				<div class="modal-header">						
					<h4 class="modal-title">Añadir Persona</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>Nombres</label>
						<input type="text" id="Nombres" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Apellidos</label>
						<input type="text" id="Apellidos" class="form-control" required>
					</div>
					<div class="form-group">
						<label>DPI</label>
						<input type="text" id="DPI" step="0.01" class="form-control" required>

					</div>
					<div class="form-group">
						<label>NIT</label>
						<input type="number" id="NIT" step="0.01" class="form-control" required>

					</div>
					<div class="form-group">
						<label>Telefono</label>
						<input type="number" id="Telefono" step="0.01" class="form-control" required>

					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" id="Email" step="0.01" class="form-control" required>

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
<!-- Edit Modal HTML -->
<div id="EditarRegistro" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
		<form action="" method="POST" >
				<div class="modal-header">						
					<h4 class="modal-title">Editar Persona</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div class="form-group">
						<label>ID</label>
						<input type="number" id="id2" class="form-control" readonly>
					</div>
					<div class="form-group">
						<label>Nombres</label>
						<input type="text" id="Nombres2" class="form-control" required>
					</div>
					<div class="form-group">
						<label>Apellidos</label>
						<input type="text" id="Apellidos2" class="form-control" required>
					</div>
					<div class="form-group">
						<label>DPI</label>
						<input type="text" id="DPI2" step="0.01" class="form-control" required>

					</div>
					<div class="form-group">
						<label>NIT</label>
						<input type="number" id="NIT2" step="0.01" class="form-control" required>

					</div>
					<div class="form-group">
						<label>Telefono</label>
						<input type="number" id="Telefono2" step="0.01" class="form-control" required>

					</div>
					<div class="form-group">
						<label>Email</label>
						<input type="text" id="Email2" step="0.01" class="form-control" required>

					</div>						
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancelar">
					<input type="button" class="btn btn-success" value="Editar" onclick="Editar()">
				</div>
			</form>
		</div>
	</div>
</div>
<!-- Delete Modal HTML -->
<div id="deleteEmployeeModal" class="modal fade">
	<div class="modal-dialog">
		<div class="modal-content">
			<form>
				<div class="modal-header">						
					<h4 class="modal-title">Delete Employee</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<p>Are you sure you want to delete these Records?</p>
					<p class="text-warning"><small>This action cannot be undone.</small></p>
				</div>
				<div class="modal-footer">
					<input type="button" class="btn btn-default" data-dismiss="modal" value="Cancel">
					<input type="submit" class="btn btn-danger" value="Delete">
				</div>
			</form>
		</div>
	</div>
</div>
</body>
</html>
<script>
// java script para agregar valores de registros.
function agregar(){
	var Nombres = $('#Nombres').val();
	var Apellidos =  $('#Apellidos').val();
	var DPI = $('#DPI').val();
	var NIT = $('#NIT').val();
	var Telefono = $('#Telefono').val();
	var Email = $('#Email').val();
	var parametros = '&Nombres=' + Nombres + '&Apellidos=' + Apellidos + '&DPI=' + DPI + '&NIT=' + NIT + '&Telefono=' + Telefono + '&Email=' + Email;
	
	$.ajax({
		method: "POST",
		url: "crear.php",
		data: parametros,
		success:function(){
			location.reload();
		}
	})
}; 

// java script para eliminar valores de registros.
function eliminar(id,Nombres){
	var C = confirm('Desea eliminar '+Nombres);
    if (C == true) {
	var parametros = 'idPersona=' + id;
	$.ajax({
		method: "POST",
		url: "borrar.php",
		data: parametros,
		success:function(){
					location.reload();
				}
	})
	}
};

// java script para obtener valores de registros.
function EdiForm(Id,Nombres,Apellidos,DPI,NIT,Telefono,Email){
	console.log (Id,Nombres,Apellidos,DPI,NIT,Telefono,Email)
	$("#id2").val(Id);
	$("#Nombres2").val(Nombres);
	$("#Apellidos2").val(Apellidos);
	$("#DPI2").val(DPI);
	$("#NIT2").val(NIT);
	$("#Telefono2").val(Telefono);
	$("#Email2").val(Email);
};

function Editar(){
	var ide = $('#id2').val();
	var Nombrese = $('#Nombres2').val();
	var Apellidose =  $('#Apellidos2').val();
	var DPIe = $('#DPI2').val();
	var NITe = $('#NIT2').val();
	var Telefonoe = $('#Telefono2').val();
	var Emaile = $('#Email2').val();
	var parametros = 'Nombres=' + Nombrese + '&Apellidos=' + Apellidose + '&DPI=' + DPIe + '&NIT=' + NITe
	+ '&Telefono=' + Telefonoe + '&Email=' + Emaile + '&id=' + ide;
	$.ajax({
		method: "POST",
		url: "editar.php",
		data: parametros,
		success:function(){
			location.reload();
		}
	})
};
</script>
