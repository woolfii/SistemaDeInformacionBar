
<html>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <?php
    session_start();
    if(isset($_SESSION['u_usuario'])){
    }
    else{
      header("location: signup.html");
    }

    include("menuG.php");
    ?>
    <link rel="stylesheet" href="estilos/Select.css">
  </head>

  <body>
    <script>      
            $.ajax({
                type:"POST",
                url:"GetMesOfVentas.php",
                dataType:"json",
                success:function(data) { 
                    $.each(data, function(i, item) {
                        $('#selected').append('<option value="'+item+' ">'+item+' </option> ');
                    })
                    $("#selected").change(function(){
                        var mesa = document.getElementById('selected').value;
                        window.location.href = "GetLinMes.php?mesa=" + mesa;
                    });
                }
            }); 
    
    </script>
      <div>
		<button class="btnMen"  onclick="window.location = 'VentaDelDia.php'">Vendedor del dia</button>
		<button class="btnMen"  onclick="window.location = 'VendedorDelMes.php'">Vendedor del mes </button>
		<button class="btnMen"  onclick="window.location = 'LineaMes.php'">Venta Dia|Mes</button>
		<button class="btnMen"  onclick="window.location = 'LineaYear.php'">Venta Mes|Ano</button>
		<select class="btnMen"  id="selected"><option value="Mesero:">Mesero:</option></select>
	</div>
 
  </body>
</html>