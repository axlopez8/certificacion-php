<?php
$servername = "localhost:3309";
$username = "root";
$database = "tersabd";
$password = "";

$conexion = mysqli_connect($servername, $username, $password, $database) or die("No fue posible conectar al servicio de base de datos. Error: " . $conexion->connect_error);
