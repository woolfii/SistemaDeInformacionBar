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
    <link rel="stylesheet" href="estilos/EstilosMeserosG.css">
    <title>Bienvenido</title>
    <?php
    include("menuG.php");
    ?>
</head>
<body>

    <div id="div"></div><!--div que lista usuarios -->

    <div id="myModalN" class="modal"><!--formulario modal para cambiar nombre -->
      <div class="modal-content">
        <span class="close">&times;</span><br><br>
        <div id="conte">
            Nuevo nombre:<input id="nn" autofocus ><br><br>
            <button class="btnMod" id="aceptaCN">Aceptar</button>
        </div>
      </div>
    </div>
    
    <div id="myModalP" class="modal"><!--formulario modal para cambiar pin-->
      <div class="modal-content">
        <span class="close">&times;</span><br><br>
        <div id="conte">
            Nuevo PIN:<br><input id="np" type="password" autofocus ><br><br>
            <button class="btnMod" id="aceptaCP">Aceptar</button>
        </div>
      </div>
    </div>

    <div id="myModalAM" class="modal"><!--formulario modal para agregar mesero-->
      <div class="modal-content">
        <span class="close">&times;</span><br><br>
        <div id="conte">
            Nombre:<br><input id="nm" autofocus ><br><br>
            PIN:<br><input id="pm" type="password" ><br><br>
            <button class="btnMod" id="aceptaAM">Aceptar</button>
        </div>
      </div>
    </div>

<script>
$(document).ready(function(){ 
    $.ajax({
        type:'POST',
        url:'ObtenerMeserosG.php',
        dataType: "json",
        success:function(meseros) {
            var i=0;
            if(i==0) {//
                $('#div').append('<button id="agm">Agregar Mesero</button>');
                $('#div').append('<tr id="trp"> <th >Mesero</th> <th >Cambiar</th> <th >Eliminar</th> </tr>');
                i=1;
            }
            $.each(meseros, function(i, item) {
                $('#div').append('<tr><td>'+item+'</td> <td><button class="changep" id="'+item+'p">PIN</button> <button class="changen" id="'+item+'n">Nombre</button></td>  <td><button class="eliminarm" id="'+item+'e">Borrar</button></td> </tr>');
            });
            $('#agm').on('click',function(){//boton agregar mesero
                document.getElementById('myModalAM').style.display = "block";
                $('#aceptaAM').on('click',function(){
                    var mesero = document.getElementById('nm').value;
                    var pin = document.getElementById('pm').value;
                    $.ajax({
                        type:"POST",
                        url:"AgregarMeseroG.php",
                        dataType:"json",
                        data:{mesero:mesero,pin:pin},
                        success:function(exito) {  
                            if(exito == "si") {
                                alert("El usuario ha sido registrado exitosamente!");
                                location.reload();
                            }else if(exito == "no") {
                                alert("El usuario no ha podido ser registrado! \n Quizas el nombre ya ha sido ocupado!");          
                            }
                        }
                    });  
                }); 
            });
            $('.eliminarm').on('click',function(){//boton eliminar mesero
                var mesero = this.id;
                $.ajax({
                    type:"POST",
                    url:"EliminarMeseroG.php",
                    dataType:"json",
                    data:{mesero:mesero},
                    success:function(exito) { 
                        if(exito == "si") {
                            alert("El usuario ha sido eliminado exitosamente!");
                            location.reload();
                        }else if(exito == "no") {
                            alert("El usuario no ha podido ser eliminado!");          
                        }
                    }
                });  
            }); 
            
            $('.changep').on('click',function(){
                document.getElementById('myModalP').style.display = "block";
                var mes = this.id;
                $("#aceptaCP").on('click',function(){
                    var pin = document.getElementById('np').value;  
                    $.ajax({
                        type:"POST",
                        url:"UpdatePIN.php",
                        dataType:"json",
                        data:{mes:mes,pin:pin},
                        success:function(act) {  
                            if(act == "actualizo") {
                                alert("Se actualizo el PIN exitosamente!");
                                document.getElementById('myModalP').style.display = "none";
                            }else if(act == "!actualizo") {
                                alert("No se ha podido cambiar el PIN!");
                            }
                        }
                    });                     
                });

            });
            $('.changen').on('click',function(){
                document.getElementById('myModalN').style.display = "block";
                var mes = this.id;
                $("#aceptaCN").on('click',function(){
                    var name = document.getElementById('nn').value;  
                    $.ajax({
                        type:"POST",
                        url:"UpdateName.php",
                        dataType:"json",
                        data:{mes:mes,name:name},
                        success:function(act) {  
                            console.log(act);
                            if(act == "actualizo") {
                                alert("Se actualizo el nombre exitosamente!");
                                location.reload();
                            }else if(act == "!actualizo") {
                                alert("No se ha podido cambiar el nombre! \nQuizas el nombre ya ha sido ocupado!");
                            }
                        }
                    });                     
                });

            });
        }
    });
});
    //funciones de cierre de los modales
    var modalN = document.getElementById("myModalN");
    var modalP = document.getElementById("myModalP");
    var modalAM = document.getElementById("myModalAM");
    var cerrn = document.getElementsByClassName("close")[0];
    var cerrp = document.getElementsByClassName("close")[1];
    var cerram = document.getElementsByClassName("close")[2];
    cerrn.onclick = function() {
        modalN.style.display = "none";
    }  
    cerrp.onclick = function() {
        modalP.style.display = "none";
    } 
    cerram.onclick = function() {
        modalAM.style.display = "none";
    } 
    window.onclick = function(event) {
        if (event.target == modalN  || event.target == modalP || event.target == modalAM) {
            modalN.style.display = "none";
            modalP.style.display = "none";
            modalAM.style.display = "none";
        }
    }
</script>
</body>
</html>
