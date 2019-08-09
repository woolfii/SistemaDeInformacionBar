<?php
session_start();
include("conexion.php");
$usuario = $_POST['usuario'];
$usuario = $conexion->real_escape_string($usuario);
$contra= $_POST['contrasenia'];


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