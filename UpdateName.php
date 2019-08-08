<?php 
include("conexion.php");
$nuevonombre = $_POST["name"];
$mesero = $_POST["mes"];
$mes =  substr ($mesero,0, strlen($mesero) - 1);
$disponible = nombre_libre($nuevonombre, $conexion);

if($disponible > 0 ) {
    echo json_encode("!actualizo");
}else if($disponible < 1 ){
    $updp = "UPDATE usuarios SET nombre='$nuevonombre' WHERE nombre='$mes' ";
    mysqli_query($conexion, $updp);
    echo json_encode("actualizo");  
}



function nombre_libre($nuevonombre,$conexion){
	$query = "SELECT * FROM usuarios WHERE nombre = '$nuevonombre' ;";
	$resultado = mysqli_query($conexion, $query);
	$nombre_libre = mysqli_num_rows( $resultado );
	return $nombre_libre ;
}  
?>