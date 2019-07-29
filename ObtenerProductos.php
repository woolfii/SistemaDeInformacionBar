<?php 
include("conexion.php");
$query = $conexion->query("SELECT nombre,cantidad,precio,categoria FROM productos");
$data = $query->fetch_all();
echo json_encode($data);
?>