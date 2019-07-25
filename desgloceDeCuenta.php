<?php 
    include("conexion.php");
    session_start();
    $misero = $_SESSION['u_usuario'];
    $mesa= $_GET['mesa'];
    $mesa = substr ($mesa,0, strlen($mesa) - 1);//para eliminar el ultimo caracteres agregado en indexM.php
    
 ?>
 <!DOCTYPE html>
 <html lang="en">
 <head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Cuenta<?php echo $mesa; ?></title>
 </head>
 <body>
    <table>
        <tr>
            <td> Producto </td>
            <td> Precio </td>
        </tr>
        <tr>
            <td > <div id="productos"></div> </td>
            <td > <div id="precios"></div> </td>  
        </tr>
    </table>
    <button onclick="window.location = 'indexM.php'">volver</button>

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
                    console.log(propre);
                    $.each(propre, function(i, item) {
                        if(i%2 == 0 ){
                            $('#productos').append('<tr><th>'+item +'</th></tr>');   
                        }else {
                            $('#precios').append('<tr><th> $'+item.precio +'</th></tr>');
                            total += parseInt(item.precio);
                        }
                        
                    })
                    $('#productos').append('<tr><th>Total: </th></tr>');  
                    $('#precios').append('<tr><th> $'+total +'</th></tr>');
                    console.log(total);   
                }
        });        
    });
    </script>
 </body>
 </html>
