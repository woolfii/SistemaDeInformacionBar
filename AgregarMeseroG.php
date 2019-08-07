<?php
include("conexion.php");
$mesero = $_POST['mesero'];
$contra = $_POST['pin'];
$pin = password_hash($contra,PASSWORD_DEFAULT);
      
$disponible = nombre_libre ($mesero, $conexion);

if($disponible > 0 || $mesero == "" || $pin == "") {
	echo json_encode("no");

}else if($disponible < 1){
	$agregar = "INSERT INTO usuarios(pin, nombre,rol) VALUES('$pin','$mesero',2)";
    mysqli_query($conexion, $agregar);
	echo json_encode("si");
}

//verifica pin y nombre esten disponibles
function nombre_libre($nombre,$conexion){
	$query = "SELECT * FROM usuarios WHERE nombre = '$nombre' ;";
	$resultado = mysqli_query($conexion, $query);
	$nombre_libre = mysqli_num_rows( $resultado );
	return $nombre_libre ;
}    
?> 