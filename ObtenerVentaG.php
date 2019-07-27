<?php
include("conexion.php");
$info = array();
$query = $conexion->query("SELECT DISTINCT cuenta FROM ventasactivas");
$mesas = $query->fetch_all();
$total = 0;

foreach($mesas as $mesa ) {//ciclo para crear un array luego json con nombre de producto y precio de cada uno segun la mesa y mesero 
    $query2 = $conexion->query("SELECT producto FROM ventasactivas WHERE cuenta='$mesa[0]'");
    $prodeMesa = $query2->fetch_all();
    foreach($prodeMesa as $prod) {
        $query3 = $conexion->query("SELECT precio FROM productos WHERE nombre ='$prod[0]' ");
        $precio = $query3->fetch_assoc();
        $p = (int)$precio["precio"];
        $total += $p;
    }
    array_push($info, $mesa[0]);
    array_push($info, $total);
    $total = 0;
}
echo json_encode($info);
?>