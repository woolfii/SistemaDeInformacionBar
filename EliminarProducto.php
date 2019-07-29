<?php
include("conexion.php");
$producto = $_POST['producto'];
$producto =  substr ($producto,0, strlen($producto) - 1);

$eliminar = "DELETE FROM productos WHERE nombre='$producto'";
$elimino = mysqli_query($conexion, $eliminar);
if( $elimino == true ) {
    echo json_encode("si");
}else {
   echo json_encode("no");
}
?>

