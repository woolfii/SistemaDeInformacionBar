<?php
include("conexion.php");
$categoria= $_POST['categoria'];
$disponible = nombre_libre($categoria, $conexion);

if($disponible > 0 || $categoria == "") {
	echo json_encode("no");
}else if($disponible < 1){
	$agregar = "INSERT INTO categorias (catego) VALUES ('$categoria')";
    mysqli_query($conexion, $agregar);
	echo json_encode("si");
}

function nombre_libre($producto,$conexion){//verifica que este libre el nombre de producto
	$query = "SELECT * FROM categorias WHERE catego = '$producto' ;";
	$resultado = mysqli_query($conexion, $query);
	$nombre_libre = mysqli_num_rows( $resultado );
	return $nombre_libre ;
}  

?> 