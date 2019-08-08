<?php
include("conexion.php");
$prod = $_POST['prod'];
$prod = substr ($prod,0, strlen($prod) - 1);
$producto = $_POST['producto'];
$cantidad= $_POST['cantidad'];
$precio= $_POST['precio'];
$categoria= $_POST['categoria'];

$disponible = nombre_libre($producto, $conexion);

if($disponible > 0 || $cantidad == "" || $precio == "" || $categoria== ""|| $producto== "") {

	$agregar = "UPDATE productos SET cantidad='$cantidad', precio='$precio', categoria='$categoria' WHERE nombre='$prod'";
    mysqli_query($conexion, $agregar);
	echo json_encode("si");

}else if($disponible < 1){
	$agregar = "UPDATE productos SET nombre='$producto',cantidad='$cantidad', precio='$precio', categoria='$categoria' WHERE nombre='$prod'";
    mysqli_query($conexion, $agregar);
	echo json_encode("si");
}

function nombre_libre($producto,$conexion){//verifica que este libre el nombre de producto
	$query = "SELECT * FROM productos WHERE nombre = '$producto' ;";
	$resultado = mysqli_query($conexion, $query);
	$nombre_libre = mysqli_num_rows( $resultado );
	return $nombre_libre ;
}  

?> 