<?php 
    include("conexion.php");
    session_start();
    $misero = $_SESSION['u_usuario'];
    $mesa= $_GET['mesa'];
    $mesa = substr ($mesa,0, strlen($mesa) - 1);//para eliminar el ultimo caracteres agregado en indexM.php
    /*  echo $mesa;
    $query = $conexion->query("SELECT producto FROM ventasactivas WHERE nombre='$misero' AND cuenta='$mesa' ");
        $name = $productos[$i];
        $query2 = $conexion->query("SELECT precio FROM productos WHERE nombre ='".$name."' ");
        $resultado2 = $query2->fetch_assoc();
        array_push($precios, $resultado2);

    */
    $productos = array();
    $query = $conexion->query("SELECT producto FROM ventasactivas WHERE usuario='jerma66' AND cuenta='22' ");
    $resultado = $query->fetch_all();
    foreach($resultado as $name ) {
        array_push($productos, $name[0]);
        $query2 = $conexion->query("SELECT precio FROM productos WHERE nombre ='$name[0]' ");
        $resultado2 = $query2->fetch_assoc();
        array_push($productos, $resultado2);
    }
    echo json_encode($productos);
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
     <meta charset="UTF-8">
     <meta name="viewport" content="width=device-width, initial-scale=1.0">
     <meta http-equiv="X-UA-Compatible" content="ie=edge">
     <title>Cuenta<?php echo $mesa; ?></title>
 </head>
 <body>
     
 </body>
 </html>
