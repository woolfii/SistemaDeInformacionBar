<?php
include("conexion.php");
$query = $conexion->query("SELECT MAX(fecha) FROM ventas");
$date = $query->fetch_assoc();
$fecha_actual = $date["MAX(fecha)"];
$query4 = ("SELECT usuario,total FROM ventas WHERE fecha='$fecha_actual' ");
$res = $conexion->query($query4);
?>
<html>
  <head>
    <!--Load the AJAX API-->
    <?php
    include("menuG.php");
    ?>
    <script type="text/javascript" src="https://www.gstatic.com/charts/loader.js"></script>
    <script type="text/javascript">
      google.charts.load('current', {'packages':['corechart']});
      google.charts.setOnLoadCallback(drawChart);

      function drawChart() {
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Mesero');
        data.addColumn('number', 'Venta');
        data.addRows([
        <?php
        while($fila = $res->fetch_assoc()){
            echo "['".$fila["usuario"]."',".$fila["total"]."],";
        }
        ?>
        ]);
        

        var options = {'title':'Venta Del Dia',
                       'width':1100,
                       'height':600};
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
        chart.draw(data, options);
      }
    </script>
  </head>

  <body>
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>
  </body>
</html>