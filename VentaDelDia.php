<?php
include("conexion.php");
session_start();
			if(isset($_SESSION['u_usuario'])){
			}
			else{
				header("location: signup.html");
			}

$query = $conexion->query("SELECT MAX(fecha) FROM ventas");
$date = $query->fetch_assoc();
$fecha_actual = $date["MAX(fecha)"];
$query4 = ("SELECT usuario,total FROM ventas WHERE fecha='$fecha_actual' ");
$res = $conexion->query($query4);
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
        while($fila = $res->fetch_assoc()){
            echo "['".$fila["usuario"]."',".$fila["total"]."],";
        }
        ?>
        ]);
        

        var options = {'title':'Venta Del Dia',
                       'width':1100,
                       'height':600};
        var chart = new google.visualization.PieChart(document.getElementById('chart_div'));
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