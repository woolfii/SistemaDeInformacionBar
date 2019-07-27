<?php 
include("conexion.php");
$nuevoPIN = $_POST["pin"];
$mesero = $_POST["mes"];
$mes =  substr ($mesero,0, strlen($mesero) - 1);
$updp = "UPDATE usuarios SET pin='$nuevoPIN' WHERE nombre='$mes' ";
mysqli_query($conexion, $updp);
echo json_encode("actualizo");

?>