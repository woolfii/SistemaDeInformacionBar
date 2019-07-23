<?php 
    include("conexion.php");
    $datos = $_POST["datos"];
    $datosd = json_decode($datos);
    $mesa = $datosd->mesa;
    $mesero = $datosd->mesero;
    $productos = array();
    $query = $conexion->query("SELECT producto FROM ventasactivas WHERE usuario='".$mesero."' AND cuenta='".$mesa."' ");
    $resultado = $query->fetch_all();
    foreach($resultado as $name ) {//ciclo para crear un array luego json con nombre de producto y precio de cada uno segun la mesa y mesero 
        array_push($productos, $name[0]);
        $query2 = $conexion->query("SELECT precio FROM productos WHERE nombre ='$name[0]' ");
        $resultado2 = $query2->fetch_assoc();
        array_push($productos, $resultado2);
    }
    echo json_encode($productos);
 ?>