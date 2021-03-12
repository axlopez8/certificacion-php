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
						<h2>Tabla Clientes</h2>
					</div>
					<div class="col-sm-6">
						<a href="#AñadirRegistro" class="btn btn-success" data-toggle="modal"><i class="material-icons">&#xE147;</i> <span>Añadir Cliente</span></a>						
					</div>
				</div>
			</div>
			<table class="table table-striped table-hover">
				<thead>
					<tr>
						<th>ID</th>
						<th>Persona</th>
						<th>Venta</th>
						<th> </th>

					</tr>
				</thead>
				<tbody>
				<?php
				include_once '../Conexion.php';
				$consulta = "SELECT C.idCliente, P.Nombres, V.Direccion_Venta, C.FK_Persona FROM clientes AS C INNER JOIN personas AS P ON C.FK_Persona=P.idPersona INNER JOIN ventas AS V ON C.FK_Venta=V.idVenta";
																											
				$resultado = mysqli_query($conexion, $consulta) or die ("Si esta leyendo estoy significa que la consulta esta mal");
				While($columna=mysqli_fetch_array($resultado)){
					
				
			?>
					<tr>
						
						<td> <?php echo $columna[0] ?> </td>
						<td> <?php echo $columna[1] ?></td>
						<td> <?php echo $columna[2] ?></td>
						


						<td>
							<a href="#EditarRegistro" class="edit" data-toggle="modal"><i class="material-icons" data-toggle="tooltip" title="Edit" onclick='EdiForm(<?php echo $columna[0] ?>,<?php echo $columna[3] ?>,<?php echo $columna[4] ?>)'> &#xE254;</i></a>
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
					<h4 class="modal-title">Añadir Cliente</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>
				<div class="modal-body">					
					<div id="SEL2" class="form-group">  
                            
                            <label>Nombre de la Persona</label> 

                            <select id="persona" class="form-control"  required>
                            <option selected >---- Nombre de las Personas ----</option>
                           
                            <?php
                                $consulta2 = "SELECT idPersona, Nombres from personas";
								$resultado2 = mysqli_query($conexion, $consulta2) or die ("Si esta leyendo estoy significa que la consulta esta mal");
								While($columna2=mysqli_fetch_array($resultado2)){
                            ?>
                            <option value="<?php echo $columna2[0]?>" ><?php echo $columna2[1]?></option>
                            <?php
                                }  
                            ?>
                            </select>
                            
                        </div>
						<div id="SEL2" class="form-group">  
                            
                            <label>Nombre de la Venta</label> 

                            <select id="venta" class="form-control"  required>
                            <option selected >---- Nombre de las Ventas ----</option>
                           
                            <?php
                                $consulta2 = "SELECT idVenta, Direccion_Venta from ventas";
								$resultado2 = mysqli_query($conexion, $consulta2) or die ("Si esta leyendo estoy significa que la consulta esta mal");
								While($columna2=mysqli_fetch_array($resultado2)){
                            ?>
                            <option value="<?php echo $columna2[0]?>" ><?php echo $columna2[1]?></option>
                            <?php
                                }  
                            ?>
                            </select>
                            
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
					<h4 class="modal-title">Editar Clientes</h4>
					<button type="button" class="close" data-dismiss="modal" aria-hidden="true">&times;</button>
				</div>

				<div class="modal-body">
				
					<div class="form-group">
						<label>ID</label>
						<input type="number" id="id2" class="form-control" readonly>
					</div>		
				<div id="SEL2" class="form-group">  
                            
                            <label>Nombre de la Persona</label> 

                            <select id="persona2" class="form-control"  required>
                            <option selected >---- Nombre de las Personas ----</option>
                           
                            <?php
                                $consulta2 = "SELECT idPersona, Nombres from personas";
								$resultado2 = mysqli_query($conexion, $consulta2) or die ("Si esta leyendo estoy significa que la consulta esta mal");
								While($columna2=mysqli_fetch_array($resultado2)){
                            ?>
                            <option value="<?php echo $columna2[0]?>" ><?php echo $columna2[1]?></option>
                            <?php
                                }  
                            ?>
                            </select>
                            
                        </div>
						<div id="SEL2" class="form-group">  
                            
                            <label>Direcciones de la Venta</label> 

                            <select id="venta2" class="form-control"  required>
                            <option selected >---- Direcciones de las Ventas ----</option>
                           
                            <?php
                                $consulta2 = "SELECT idVenta, Direccion_Venta from ventas";
								$resultado2 = mysqli_query($conexion, $consulta2) or die ("Si esta leyendo estoy significa que la consulta esta mal");
								While($columna2=mysqli_fetch_array($resultado2)){
                            ?>
                            <option value="<?php echo $columna2[0]?>" ><?php echo $columna2[1]?></option>
                            <?php
                                }  
                            ?>
                            </select>
                            
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
	var persona = $('#persona').val();
	var venta = $('#venta').val();
	var parametros = 'persona=' + persona + '&venta=' + venta;
	
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
function eliminar(id,persona){
	var C = confirm('Desea eliminar '+persona);
    if (C == true) {
	var parametros = 'idcliente=' + id;
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
function EdiForm(Id,persona,venta){
	$("#id2").val(Id);
	$("#persona2").val(persona);
	$("#venta2").val(venta);
};

function Editar(){
	var ide = $('#id2').val();
	var personae = $('#persona2').val();
	var ventae =  $('#venta2').val();
	var parametros = 'persona=' + personae + '&venta=' + ventae + '&id=' + ide;
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
