<?php
session_start();
include("conexion.php");
$mesa= $_POST['mesa'];
$mesa = substr ($mesa,0, strlen($mesa) - 1);//para eliminar el ultimo caracteres agregado en indexM.php
$mesero = $_POST['mesero'];

$existe = existe_mesero($mesero, $conexion);//Se comprueba que exista al mesero al que se le quiere pasar la cuenta

if($existe >0){
    $sql = "UPDATE mesas SET usuario='$mesero' WHERE mesa='$mesa' ";
    $si = mysqli_query($conexion, $sql);
    if($si) {
        echo json_encode("cambio");
    }else {
        echo json_encode("!cambio");
    }
}else {
    echo json_encode("!mesero");
}

function existe_mesero($nombre,$conexion){
	$query = "SELECT * FROM usuarios WHERE nombre = '$nombre';";
	$resultado = mysqli_query($conexion, $query);
	$existe_mesero= mysqli_num_rows( $resultado );
	return $existe_mesero;
} 

  
?> 
