<?php
//vendedor del mes
include("conexion.php");
$query = $conexion->query("SELECT DISTINCT MONTH(fecha) FROM ventadeldia  ORDER BY fecha");
$fechas = $query->fetch_all();
$meses = array();
foreach($fechas as $fecha){
    $query2 = $conexion->query("SELECT SUM(venta),fecha FROM ventadeldia WHERE MONTH(fecha) ='$fecha[0]'");
    $total = $query2->fetch_assoc();
    array_push($meses,$total);
}

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
            foreach($meses as $fila){
                echo "['".$fila["fecha"]."',".$fila["SUM(venta)"]."],";
                
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