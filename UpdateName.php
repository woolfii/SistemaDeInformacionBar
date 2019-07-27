<?php 
include("conexion.php");
$nuevonombre = $_POST["name"];
$mesero = $_POST["mes"];
$mes =  substr ($mesero,0, strlen($mesero) - 1);
$updp = "UPDATE usuarios SET nombre='$nuevonombre' WHERE nombre='$mes' ";
mysqli_query($conexion, $updp);
echo json_encode("actualizo");
?>