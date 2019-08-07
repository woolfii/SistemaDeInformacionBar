<?php 
include("conexion.php");
$nuevoPIN = $_POST["pin"];
$pin = password_hash($nuevoPIN,PASSWORD_DEFAULT);
$mesero = $_POST["mes"];
$mes =  substr ($mesero,0, strlen($mesero) - 1);

$updp = "UPDATE usuarios SET pin='$pin' WHERE nombre='$mes' ";
mysqli_query($conexion, $updp);
echo json_encode("actualizo");

?>