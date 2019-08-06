<?php 
    include("conexion.php");
    session_start();
    if(isset($_SESSION['u_usuario'])){
    }
    else{
      header("location: signup.html");
    }
    $misero = $_SESSION['u_usuario'];
 ?>
<!DOCTYPE html>
<html>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="Estilos/IndexM.css">
  </head>
  <body>
    <div id="div"></div> 
    <div id="botones">
      <button class="myBtnclass" id="myBtn" >Abrir Mesa</button> 
      <button class="myBtnclass" id="myBtn2" onclick="window.location = 'logout.php'">Salir</button>        
    </div>


    <div id="myModal" class="modal">
      <div class="modal-content">
        <span class="close">&times;</span><br><br>
        <form action="guardarMesa.php" method="POST">
            <p>Nombre de la mesa:</p><input name="mesa" autofocus><br><br>
            <input  id="btnX" type="submit" name="enviar" value="Abrir">
        </form>  
      </div>
    

    <script>
      $(document).ready(function(){
        var mesero = '<?php echo $misero; ?>';
        $.ajax({
          type:"POST",
          url:"GetMesas.php",
          dataType:"json",
          data:{mesero,mesero},
          success:function(data) { 
            var i=0;
            if(i==0) {//setear encabezado
              $('#div').append('<tr id="trp"> <th>Mesa</th> <th>Capturar</th> <th>Ver</th> <th>Cobrar</th>  </tr>');
              i=1;
            }
            $.each(data, function(i, item) {
              $('#div').append('<tr id="'+item+'"> <td>'+item+'</td> <td><button class="btnPedido" id="'+item+'1">pedido</button></td> <td><button class="btnDesgloce" id="'+item+'2">Desglozar</button></td> <td><button class="btnImprimir" id="'+item+'3">Imprimir</button></td> </tr>');
            })
            $('.btnPedido').on('click',function(){
              var mesa = this.id;
              window.location.href = "capturaProductos.php?mesa=" + mesa;
            });
            $('.btnDesgloce').on('click',function(){
              var mesa = this.id;
              window.location.href = "DesgloceDeCuenta.php?mesa=" + mesa;
            });
            $('.btnImprimir').on('click',function(){
              var mesa = this.id;
              var id = mesa.slice(0, -1);
              window.location.href = "ImprimirMesa.php?mesa=" + mesa;
              $('#'+id+'').remove();
            });
          }
        }); 
        
      });

      var modal = document.getElementById("myModal");
      var btn = document.getElementById("myBtn");
      var span = document.getElementsByClassName("close")[0];
      
      btn.onclick = function() {
        modal.style.display = "block";
      }
      
      span.onclick = function() {
        modal.style.display = "none";
      }
      
      window.onclick = function(event) {
        if (event.target == modal) {
          modal.style.display = "none";
        }
      }
    </script>

  </body>
</html>