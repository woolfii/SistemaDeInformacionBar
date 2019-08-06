<?php 
    session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="estilos/EstiloIndexG.css">
    <title>Bienvenido</title>
    <?php
    include("menuG.php");
    ?>
</head>
<body>
<table>
   <div id="div"></div><!--div donde va el desgloce --> 
</table>
    

    <div id="myModal" class="modal"><!--formulario modal para cambiar mesero -->
      <div class="modal-content">
        <span class="close">&times;</span><br><br>
        <div id="conte">
           Nuevo mesero:<br><input id="mes" autofocus><br><br>
            <button id="aceptaC">Aceptar</button> 
        </div>
        
      </div>
    </div>

<script>
$(document).ready(function(){ 
    $.ajax({
        type:'POST',
        url:'mesasG.php',
        dataType: "json",
        success:function(mesas) {
            var i=0;
            if(i==0) {//si ya esta impresa
                    $('#div').append('<tr id="trm"> <th>Cuenta</th> <th>Mesero</th> <th>Desgloce</th>  <th>Reasignar</th>  <th>Imprimir</th> </tr>');
                    i=1;
                }
            $.each(mesas, function(i, item) {
                if(item[2]=="si") {
                    $('#div').append('<tr> <td>'+item[0]+'</td> <td>'+item[1]+'</td> <td><button id="'+item[0]+'d" class="btnD">Desglozar</button></td> <td><button id="'+item[0]+'c" class="btnC">Cambiar</button></td> <td class="i"><button id="'+item[0]+'i" class="btnI">Imprimir</button></td> </tr>');
                }
                else {
                    $('#div').append('<tr> <td>'+item[0]+'</td> <td>'+item[1]+'</td> <td><button id="'+item[0]+'d" class="btnD">Desglozar</button></td> <td><button id="'+item[0]+'c" class="btnC">Cambiar</button></td> <td class="n"><button id="'+item[0]+'i" class="btnI">Imprimir</button></td>  </tr>');
                }
            });
            $('.btnD').on('click',function(){
                var mesa = this.id;
                window.location.href = "DesgloceDeCuentaG.php?mesa=" + mesa;

            });
            $('.btnI').on('click',function(){
                var mesa = this.id;
                window.location.href = "ImprimirMesaG.php?mesa=" + mesa;
            });
            $('.btnC').on('click',function(){
                var mesa = this.id;
                modal.style.display = "block";
                $('#aceptaC').on('click',function(){
                    var mesero = document.getElementById('mes').value;
                    $.ajax({
                        type:'POST',
                        url:'CambiarMesero.php',
                        dataType: "json",
                        data:{mesa:mesa,mesero:mesero},
                        success:function(mesas) {
                            if(mesas == "cambio"){
                                alert("La mesa ha sido reasignada!");
                                location.reload();
                                
                            }else if(mesas == "!cambio") {
                                alert("Ocurrio un error! \nRecarge la pagina he intente de nuevo \nVerifica que hallas escrito correctamente el nombre");
                            }
                            else if(mesas == "!mesero") {
                                alert("Ocurrio un error! \nAsegurate que el mesero este registrado \nVerifica que hallas escrito correctamente el nombre");
                            }
                        } 
                    });

                }); 
            });

        }
    });//se carga la tabla principal
 

});
    var modal = document.getElementById("myModal");
    var span = document.getElementsByClassName("close")[0];

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
