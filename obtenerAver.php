<?php
include("conexion.php");
$query4 = $conexion->query("SELECT usuario,total FROM ventas");
$precio = $query4->fetch_all();
echo json_encode($precio);
?>