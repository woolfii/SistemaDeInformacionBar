<?php 
include("conexion.php");
$producto = $_POST['prod'];
$producto = substr ($producto,0, strlen($producto) - 1);
$query = $conexion->query("SELECT nombre,cantidad,precio,categoria FROM productos WHERE nombre = '$producto'");
$resultado = $query->fetch_all();
echo json_encode($resultado);

?>