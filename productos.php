<?php
include("conexion.php");
$data = array();
$cat= $_POST["cat"];
  $query = $conexion->query("SELECT * FROM productos WHERE categoria = '".$cat."'");
  if($query->num_rows > 0){
    for($i = 0; $product = $query->fetch_assoc(); $i++) {
      $products[$i] = $product;
    }
    $data['status'] = 'ok';
    $data['result'] = $products;
  }else{
    $data['status'] = 'err';
    $data['result'] = '';
  }
  echo json_encode($data);

?>       