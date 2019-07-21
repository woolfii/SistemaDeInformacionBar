<?php
$server = "localhost";
$user = "root";
$password = "";
$bd = "bar";
	$conexion = mysqli_connect($server, $user, $password, $bd);
	if (!$conexion){ 
		die('Error de Conexión: ' . mysqli_connect_errno());	
	}	
?>