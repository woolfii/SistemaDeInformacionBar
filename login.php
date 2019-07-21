<?php
session_start();
$usuario = $_POST['usuario'];
$contrasenia = $_POST['contrasenia'];
include("conexion.php");

//verifica si hay usuario registrado y si la contrasena coincide.
$proceso = $conexion->query("SELECT * FROM usuarios WHERE nombre='$usuario' AND pin='$contrasenia' AND rol=1 ");//patron
  
if($resultado = mysqli_fetch_array($proceso)){
	$_SESSION['u_usuario'] = $usuario;
	header("location: IndexG.php");
}
else{	
	$proceso2 = $conexion->query("SELECT * FROM usuarios WHERE nombre='$usuario' AND pin='$contrasenia' AND rol=2 ");//mesero
    if($resultado2 = mysqli_fetch_array($proceso2)){
	    $_SESSION['u_usuario'] = $usuario;
	    header("location: indexM.php");
    }
    else{
		header("location: signup.html");
    }
}



?>