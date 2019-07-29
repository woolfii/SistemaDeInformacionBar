<?php
include("conexion.php");
$producto = $_POST['producto'];
$cantidad= $_POST['cantidad'];
$precio= $_POST['precio'];
$categoria= $_POST['categoria'];

$disponible = nombre_libre($producto, $conexion);

if($disponible > 0 || $cantidad == "" || $precio == "" || $categoria== ""|| $producto== "") {
	echo json_encode("no");
}else if($disponible < 1){
	$agregar = "INSERT INTO productos(nombre, cantidad, precio, categoria) VALUES('$producto','$cantidad','$precio','$categoria')";
    mysqli_query($conexion, $agregar);
	echo json_encode("si");
}

//verifica pin y nombre esten disponibles
function nombre_libre($producto,$conexion){
	$query = "SELECT * FROM productos WHERE nombre = '$producto' ;";
	$resultado = mysqli_query($conexion, $query);
	$nombre_libre = mysqli_num_rows( $resultado );
	return $nombre_libre ;
}    
?> 