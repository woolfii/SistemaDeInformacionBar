<?php
include("conexion.php");
$query = $conexion->query("SELECT nombre FROM usuarios");
$names = $query->fetch_all();
echo json_encode($names);
?>