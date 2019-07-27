<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include("menuG.php");?>
    <link rel="stylesheet" href="EstiloVentaG.css">
</head>
<body>

    <div id="div"></div><!--div donde va el desgloce -->
    <button id="btnFD">Finalizar Dia</button>
<script>
$(document).ready(function(){ 
    $.ajax({
        type:'POST',
        url:'ObtenerVentaG.php',
        dataType: "json",
        success:function(info) {
            var i=0,t=0;
            if(i==0) {
                $('#div').append('<tr class="trp"> <th id="c">Cuenta</th> <th id="t">Total</th> </tr>');
                i=1;
            }
            $.each(info, function(i, item) {
                if(i % 2 == 0) {
                    $('#c').append('<tr><td>'+item+'</td></tr>');
                }
                else {
                    $('#t').append('<tr><td> $'+item+'</td></tr');
                    t += item;
                }
            });
            $('#c').append('<tr><td> Total: </td></tr>');
            $('#t').append('<tr><td> $'+t+'</td></tr>');
        }
    }); 
    $('btnFD').on('click',function(){

    });
});           
</script>  
</body>
</html>