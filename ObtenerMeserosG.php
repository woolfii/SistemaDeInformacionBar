<?php
include("conexion.php");
$query = $conexion->query("SELECT nombre FROM usuarios where rol= 2");
$names = $query->fetch_all();
echo json_encode($names);
?>