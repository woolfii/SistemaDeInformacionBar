<?php 
include("conexion.php");
$datos = $_POST["datos"];
$datosd = json_decode($datos);
$data = $datosd->datos[0];
$mesa = $datosd->mesa;
$mesero = $datosd->mesero;
foreach($datosd->datos as $product) {
    $query = "INSERT INTO ventasactivas (producto, usuario, cuenta) VALUES('$product', '$mesero', '$mesa');";
    $resultado = mysqli_query($conexion, $query);	
    $sql = "UPDATE productos SET cantidad = cantidad-1 WHERE nombre='$product' ";
    mysqli_query($conexion, $sql);
}
echo json_encode($resultado);

?>