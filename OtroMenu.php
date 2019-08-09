<!DOCTYPE html>
<html lang="en">
<head>
	<meta charset="UTF-8">
	<meta name="viewport" content="width=device-width, initial-scale=1.0">
	<meta http-equiv="X-UA-Compatible" content="ie=edge">
	<title>Document</title>
	<style>
 	
		button{
		margin-top: 15px;
		margin-left:100px;
		background-color:rgba(4, 0, 44, .95);
		color:white;
		padding:10px;
		border:solid;
		border-width:thin ;
		border-radius: 7px;
		border-color:white;
		}button:hover{
		background-color:white;
		color:rgba(4, 0, 44, .95); 
		}
	</style>
</head>
<body>
	<div>
		<button class="btnMen"  onclick="window.location = 'VentaDelDia.php'">Vendedor del dia</button>
		<button class="btnMen"  onclick="window.location = 'VendedorDelMes.php'">Vendedor del mes </button>
		<button class="btnMen"  onclick="window.location = 'LineaMes.php'">Venta Dia|Mes</button>
		<button class="btnMen"  onclick="window.location = 'LineaYear.php'">Venta Mes|Ano</button>
		<button class="btnMen"  onclick="window.location = 'Aver.php'">Venta Mesero|Mes</button>
	</div>
</body>
</html>