<?php 
$mesero = $_POST["mesero"];
include("conexion.php");
$query = $conexion->query("SELECT mesa FROM mesas WHERE usuario='$mesero'");
$resultado = $query->fetch_all();
echo json_encode($resultado);

?>