<?php 
    include("conexion.php");

    $misero = $_SESSION['u_usuario'];
    $mesa= $_GET['mesa'];
    $mesa = substr ($mesa,0, strlen($mesa) - 1);//para eliminar el ultimo caracteres agregado en indexM.php
    session_start();
			if(isset($_SESSION['u_usuario'])){
			}
			else{
				header("location: signup.html");
			}

 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cuenta<?php echo $mesa; ?></title>
    <link rel="stylesheet" href="Estilos/DesgloceDeCuenta.css">
 </head>
 <body>
    <table>
        <tr>
            <td class="tdm"> Producto </td>
            <td class="tdm"> Precio </td>
        </tr>
        <tr>
            <td > <div id="productos"></div> </td>
            <td > <div id="precios"></div> </td>  
        </tr>
    </table>
    <div id="total"></div>
    <button onclick="window.location = 'indexM.php'">Volver</button>

<script>
    var mesero = '<?php echo $misero ?>';
    var mesa = '<?php echo $mesa ?>';
    $(document).ready(function(){
        var dat = {mesero:mesero,mesa:mesa};
        var obj = JSON.stringify(dat);
        var total = 0; 
        $.ajax({
                type:'POST',
                url:'obtenerDesgloce.php',
                dataType: "json",
                data:{datos:obj},
                success:function(propre){
                    $.each(propre, function(i, item) {
                        if(i%2 == 0 ){
                            $('#productos').append('<tr><th>'+item +'</th></tr>');   
                        }else {
                            $('#precios').append('<tr><th> $'+item.precio +'</th></tr>');
                            total += parseInt(item.precio);
                        }
                        
                    })
                    $('#total ').append('<tr ><td>Total: $'+total +'</td></tr>');
                }
        });        
    });
</script>
</body>
</html>
