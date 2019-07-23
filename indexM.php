<?php 
    $conexion = mysqli_connect('localhost','root','','bar');
    session_start();
    $misero = $_SESSION['u_usuario'];
 ?>
<!DOCTYPE html>
<html>
  <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="EstilosModalAbrirMesa.css">
  </head>
  <body>
    <table id="tabla">
      <tr>
        <th>Mesa</th>
        <th>Capturar</th> 
        <th>ver</th>
        <th>cobrar</th>
      </tr>
      <?php //ciclo while con el cual se crea una fila por cada mesa encontrada que coincida con el
        $sql = "SELECT * from mesas";
        $result = mysqli_query($conexion,$sql);
        while($mostrar=mysqli_fetch_array($result)){
        ?>
      <tr>
        <td> <?php echo $mostrar['mesa'] ?> </td>
        <td> <button class="btnPedido" id="<?php echo $mostrar['mesa'] ?>1">pedido</button> </td>
        <td> <button class="btnDesgloce" id="<?php echo $mostrar['mesa'] ?>2">desgloce de cuenta</button> </td>
        <td> <button class="btnImprimir" id="<?php echo $mostrar['mesa'] ?>3">imprimir cuenta</button> </td>
      </tr>
        <?php 
        }
      ?>
    </table><br>
    <button class="myBtnclass" onclick="window.location = 'logout.php'">Salir</button>        
    <button class="myBtnclass" id="myBtn">Abrir Mesa</button>


    <div id="myModal" class="modal">

      <div class="modal-content">
        <span class="close">&times;</span> <br><br>
        <form action="guardarMesa.php" method="POST">
            Nombre de la mesa:<input name="mesa"><br><br>
            <input  type="submit" name="enviar" value="Abrir">
        </form>
        
      </div>

    </div>

    <script>
      $(document).ready(function(){
        $('.btnPedido').on('click',function(){
          var mesa = this.id;
          window.location.href = "capturaProductos.php?mesa=" + mesa;
        });
        $('.btnDesgloce').on('click',function(){
          var mesa = this.id;
          window.location.href = "DesgloceDeCuenta.php?mesa=" + mesa;
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