<?php
session_start();
$usuario = $_POST['usuario'];
$contra= $_POST['contrasenia'];
include("conexion.php");

$query = $conexion->query("SELECT pin,rol FROM usuarios WHERE nombre='$usuario' ");
$resultado = $query->fetch_assoc();
if(password_verify ( $contra ,$resultado["pin"])){
	$_SESSION['u_usuario'] = $usuario;
	if($resultado["rol"]==1) {
		header("location: IndexG.php");
	}else if($resultado["rol"]==2) {
		header("location: Indexm.php");
	}
	
}
else{	
	header("location: signup.html");
}



?>