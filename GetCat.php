<?php 
include("conexion.php");
$query = $conexion->query("SELECT catego FROM categorias");
$resultado = $query->fetch_all();
echo json_encode($resultado);

?>