<?php
//vendedor del mes
session_start();
			if(isset($_SESSION['u_usuario'])){
			}
			else{
				header("location: signup.html");
			}

include("conexion.php");
$query = ("SELECT  venta,fecha FROM ventadeldia WHERE MONTH(fecha) = MONTH(CURDATE()) ORDER BY fecha");
$res = $conexion->query($query);
?>
<html>
  <head>
  <link rel="stylesheet" href="Estilos/VentaDelDia.css">
    <?php
    include("menuG.php");
    ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = google.visualization.arrayToDataTable([
          ['fecha', 'venta'],
            <?php
            while($fila = $res->fetch_assoc()){
           echo "['".$fila["fecha"]."',".$fila["venta"]."],";
            }
            ?>
        ]);

        var options = {
          title: 'Venta diaria durante el mes',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
  </head>

  <body>
  <div>
		<button class="btnMen"  onclick="window.location = 'VentaDelDia.php'">Vendedor del dia</button>
		<button class="btnMen"  onclick="window.location = 'VendedorDelMes.php'">Vendedor del mes </button>
		<button class="btnMen"  onclick="window.location = 'LineaMes.php'">Venta Dia|Mes</button>
		<button class="btnMen"  onclick="window.location = 'LineaYear.php'">Venta Mes|Ano</button>
		<button class="btnMen"  onclick="window.location = 'Aver.php'">Venta Mesero|Mes</button>
	</div>
    <div id="curve_chart" style="width: 1100px; height: 500px"></div>
  </body>
</html>