<?php
//vendedor del mes
include("conexion.php");
$query = $conexion->query("SELECT DISTINCT usuario FROM ventas");
$meseros = $query->fetch_all();

$MT = array();
foreach($meseros as $mesero){
    $query2 = $conexion->query("SELECT usuario,SUM(total) FROM ventas WHERE usuario ='$mesero[0]'");
    $total = $query2->fetch_assoc();
    array_push($MT,$total);
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
        var data = new google.visualization.DataTable();
        data.addColumn('string', 'Mesero');
        data.addColumn('number', 'Venta');
        data.addRows([
        <?php
        foreach($MT as $fila){
            echo "['".$fila["usuario"]."',".$fila["SUM(total)"]."],";
        }
        ?>
        ]);
        

        var options = {'title':'Vendedor del Mes',
                       'width':1100,
                       'height':600};
        var chart = new google.visualization.BarChart(document.getElementById('chart_div'));
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
    <!--Div that will hold the pie chart-->
    <div id="chart_div"></div>
  </body>
</html>