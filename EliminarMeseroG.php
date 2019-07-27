<?php
include("conexion.php");
$mesero = $_POST['mesero'];
$mesero =  substr ($mesero,0, strlen($mesero) - 1);

$eliminar = "DELETE FROM usuarios WHERE nombre='$mesero'";
$elimino = mysqli_query($conexion, $eliminar);
if( $elimino == true ) {
    echo json_encode("si");
}else {
   echo json_encode("no");
}


