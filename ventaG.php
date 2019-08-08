<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <?php include("menuG.php");?>
    <link rel="stylesheet" href="estilos/EstiloVentaG.css">
</head>
<body>

    <table>
        <div id="div"></div><!--div donde va el desgloce --> 
    </table>
    <div id="total"></div>
    <button id="btnFD">Matar cuentas</button>
<script>
$(document).ready(function(){ 
    $.ajax({
        type:'POST',
        url:'ObtenerVentaG.php',
        dataType: "json",
        success:function(info) {
            var i=0,t=0;
            if(i==0) {
                $('#div').append('<tr > <th class="trp" id="c">Cuenta</th> <th class="trp" id="t">Total</th> </tr>');
                i=1;
            }
            for(var j=0;j<info.length;j++){
                $('#div').append('<tr> <td>'+info[j]+'</td> <td>$'+info[(j+1)]+'</td></tr>');
                t += info[(j+1)];
                j++;
            }
            $('#total').append('<tr ><td>Total: $'+t +'</td></tr>');
        }
    }); 
    $('#btnFD').on('click',function(){
        location.href = "matarCuentas.php";
    });
});           
</script>  
</body>
</html>