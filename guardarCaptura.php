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
}
echo json_encode($resultado);

//for ($i=0; $i<count($datosd->datos); $i++ ) {
 //       $producto[$i] = $product;
  //  }
?>