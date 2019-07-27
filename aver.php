
<?php 
include("conexion.php");
$q = $conexion->query("SELECT usuario FROM mesas WHERE mesa='22' ");
$r = $q->fetch_assoc();

//$mesero = $r["usuario"];
?>