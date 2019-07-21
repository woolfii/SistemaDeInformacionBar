<?php 
    $conexion=mysqli_connect('localhost','root','','bar');
    session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="capturaProductos.css">
    <title>Captura productos</title>
</head>
<body>
    <table id="tabla">
        <tr>
            <th>Productos</th>
            <th> <?php 
            $sql="SELECT * from categorias";
            $result=mysqli_query($conexion,$sql);

            while($mostrar=mysqli_fetch_array($result)){
            ?>
                <input type="button" id="actu" value="<?php echo $mostrar['catego'] ?>">
                
            <?php 
            }
            ?>  
            </th>
        </tr>
        <tr>
            <th ></th>
            <th ></th>
        </tr>
    </table>
    <div id="PxC">f</div>
<script>

$(function(){
  tabla();
});

function tabla() {
  $.ajax({
    url: "productos.php",
    type:'POST',
    success:function(res){
      var js = JSON.parse(res);
      var tabla;
      console.log(res);
      for( var i = 0; i<js.length; i++) {
        tabla += '<button>'+js[i].nombre +'</button>';
      }
      $('#PxC').html(tabla);
    }
  });
}
$('#actu').click(function(){
  tabla();
});
</script>
</body>

</html>