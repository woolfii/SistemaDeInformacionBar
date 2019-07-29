<?php
include("conexion.php");
$prod = $_POST['prod'];
$prod = substr ($prod,0, strlen($prod) - 1);
$producto = $_POST['producto'];
$cantidad= $_POST['cantidad'];
$precio= $_POST['precio'];
$categoria= $_POST['categoria'];


if( $cantidad == "" || $precio == "" || $categoria== ""|| $producto== "") {
	echo json_encode("no");
}else {
	$agregar = "UPDATE productos SET nombre='$producto',cantidad='$cantidad', precio='$precio', categoria='$categoria' WHERE nombre='$prod'";
    mysqli_query($conexion, $agregar);
	echo json_encode("si");
}


?> 