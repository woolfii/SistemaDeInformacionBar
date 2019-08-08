<?php
include("conexion.php");
date_default_timezone_set("America/Mexico_City");
$fecha_actual = date('Y-m-d H:i:s');
$query = $conexion->query("SELECT DISTINCT usuario FROM ventasactivas ");
$meseros = $query->fetch_all();
$MCT = array();
$MTF = array();
$total = 0;
$ventaDelDia = 0;

foreach($meseros as $mesero) {//se crea array mesero cuenta total de la venta Activa
    $query2 = $conexion->query("SELECT DISTINCT cuenta FROM ventasactivas WHERE usuario = '$mesero[0]' ");
    $cuentas = $query2->fetch_all();
    array_push($MTF,$mesero[0]);
    $ventaDelDia = 0;
    foreach($cuentas as $cuenta) {
        $query3 = $conexion->query("SELECT producto FROM ventasactivas WHERE cuenta='$cuenta[0]' ");
        $productos = $query3->fetch_all();
        array_push($MCT,$mesero[0]);
        array_push($MCT,$cuenta[0]);
        foreach($productos as $producto ) {
            $query4 = $conexion->query("SELECT precio FROM productos WHERE nombre ='$producto[0]' ");
            $precio = $query4->fetch_assoc();
            $p = intval($precio["precio"]);
            $total += $p;
        }       
        $ventaDelDia += $total;
        array_push($MCT,$total); 
        $total = 0;
 
    }
    array_push($MTF,$ventaDelDia); 
}
$l = count($MCT);
for($i=0; $i<($l-2); $i++) {//se agrega a la tabla ventasdiarias el mesero,la cuenta y el total
    $user = $MCT[$i];
    $mesa = $MCT[$i+1];
    $tot = $MCT[$i+2];
    $agregar = $conexion->query("INSERT INTO ventasdiarias(usuario, mesa, total,fecha) VALUES('$user','$mesa','$tot','$fecha_actual')");
    mysqli_query($conexion, $agregar);
    $i = $i+2;
}
$j = count($MTF);
for($i=0; $i<($j-1); $i++) {//se agrega a la tabla ventasdiarias el mesero,la cuenta y el total
    $usua = $MTF[$i];
    $vt = $MTF[$i+1];
    $agregar = $conexion->query("INSERT INTO ventas(usuario,total,fecha) VALUES('$usua','$vt','$fecha_actual')");
    mysqli_query($conexion, $agregar);
    $i = $i+1;
}
$vaciar = $conexion->query("TRUNCATE TABLE ventasactivas");
mysqli_query($conexion, $vaciar);
$vaciar2 = $conexion->query("TRUNCATE TABLE mesas");
mysqli_query($conexion, $vaciar2);
header('Location: aver.php');
?>