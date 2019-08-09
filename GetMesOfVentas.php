<?php 
include("conexion.php");
$query = $conexion->query("SELECT DISTINCT usuario FROM ventas");
$resultado = $query->fetch_all();
echo json_encode($resultado);

?>