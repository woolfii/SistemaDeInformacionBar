<?php
include("conexion.php");
$Query = $conexion->query("SELECT mesa,usuario,impresa FROM mesas");
$mesas = $Query->fetch_all();
echo json_encode($mesas);
?>