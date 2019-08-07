
<?php
include("conexion.php");
$query = $conexion->query("SELECT pin,rol FROM usuarios WHERE nombre='pepe' ");
$resultado = $query->fetch_assoc();
print_r($resultado);
 ?>