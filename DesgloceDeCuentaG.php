<?php 
    include("conexion.php");
    session_start();
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
     <title>Document</title>
 </head>
 <body>
 <table>
        <tr>
            <th> Producto </th>
            <th> Precio </th>
        </tr>
        <tr>
            <td > <div id="productos"></div> </td>
            <td > <div id="precios"></div> </td>  
        </tr>
    </table>
    <button onclick="window.location = 'indexG.php'">volver</button>
 <script>
    var mesa = '<?php echo $mesa ?>';
    $(document).ready(function(){
        var dat = {mesa:mesa};
        var obj = JSON.stringify(dat);
        var total = 0; 
        $.ajax({
                type:'POST',
                url:'obtenerDesgloceG.php',
                dataType: "json",
                data:{datos:obj},
                success:function(propre){
                    $.each(propre, function(i, item) {
                        if(i%2 == 0 ){
                            $('#productos').append('<tr><td>'+item +'</td></tr>');   
                        }else {
                            $('#precios').append('<tr><td> $'+item.precio +'</td></tr>');
                            total += parseInt(item.precio);
                        }
                        
                    })
                    $('#productos').append('<tr><th>Total: </th></tr>');  
                    $('#precios').append('<tr><th> $'+total +'</th></tr>');
                }
        });        
    });
</script>     
</body>
</html>