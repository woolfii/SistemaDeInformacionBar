<?php 
    $conexion=mysqli_connect('localhost','root','','bar');
    session_start();
 ?>
<!DOCTYPE html>
<html>
<head>
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
        <?php 
		$sql="SELECT * from mesas";
		$result=mysqli_query($conexion,$sql);

		while($mostrar=mysqli_fetch_array($result)){
		 ?>

		<tr>
			<td> <?php echo $mostrar['mesa'] ?> </td>
			<td> <button onclick="window.location = 'capturaProductos.php'">pedido</button> </td>
			<td> <button onclick="">desgloce de cuenta</button> </td>
			<td> <button onclick="">imprimir cuenta</button> </td>
		</tr>
	<?php 
	}
	 ?>
         </table>
 <br>
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
// Get the modal
var modal = document.getElementById("myModal");

// Get the button that opens the modal
var btn = document.getElementById("myBtn");

// Get the <span> element that closes the modal
var span = document.getElementsByClassName("close")[0];

// When the user clicks the button, open the modal 
btn.onclick = function() {
  modal.style.display = "block";
}

// When the user clicks on <span> (x), close the modal
span.onclick = function() {
  modal.style.display = "none";
}

// When the user clicks anywhere outside of the modal, close it
window.onclick = function(event) {
  if (event.target == modal) {
    modal.style.display = "none";
  }
}
</script>

</body>
</html>