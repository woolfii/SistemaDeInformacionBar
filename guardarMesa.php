<?php
session_start();
include("conexion.php");
$mesa= $_POST['mesa'];
$user = $_SESSION['u_usuario'];

$pdo=new PDO("mysql:dbname=bar;host=127.0.0.1","root","");
$existe = existe_mesa($mesa, $conexion);
if($existe>0 || $mesa == "") {
	echo '<script language="javascript">alert("Esta mesa esta ocupada!");window.location.href="indexM.php"</script>'; 

} else {
	$statement = $pdo->prepare("INSERT INTO mesas(mesa, usuario) VALUES('$mesa','$user')");
    $statement->execute();
	header('Location: indexM.php'); 
}
//checo que el nombre de mesa no este ocupado
function existe_mesa($nombre,$conexion){
	$query = "SELECT mesa FROM mesas WHERE mesa = '$nombre';";
	$resultado = mysqli_query($conexion, $query);
	$existe_mesa= mysqli_num_rows( $resultado );
	return $existe_mesa;
}    
?> 
