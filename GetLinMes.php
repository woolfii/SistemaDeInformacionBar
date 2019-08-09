<?php
//vendedor del mes
include("conexion.php");
$mesero = $_GET["mesa"];
$query = $conexion->query("SELECT DISTINCT MONTH(fecha) FROM ventas WHERE usuario='$mesero' ORDER BY fecha");
$fechas = $query->fetch_all();
$meses = array();
foreach($fechas as $fecha){
    $query2 = $conexion->query("SELECT SUM(total),fecha FROM ventas WHERE MONTH(fecha) ='$fecha[0]'");
    $total = $query2->fetch_assoc();
    array_push($meses,$total);
}
?>
<html>
  <head>
  <link rel="stylesheet" href="estilos/GetLinMes.css">
    <!--Load the AJAX API-->
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
                echo "['".$fila["fecha"]."',".$fila["SUM(total)"]."],";
                
            }
            ?>
        ]);

        var options = {
          title: 'Venta Historica del Mesero',
          legend: { position: 'bottom' }
        };

        var chart = new google.visualization.LineChart(document.getElementById('curve_chart'));

        chart.draw(data, options);
      }
    </script>
  </head>

  <body>
    <button id="myBtn2" onclick="window.location = 'aver.php'">volver</button>   
    <div id="curve_chart" style="width: 1100px; height: 500px"></div>
  </body>
</html>