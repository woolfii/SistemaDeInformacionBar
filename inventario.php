<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bienvenido</title>
    <?php include("menuG.php");?>
    <link rel="stylesheet" href="EstilosInventario.css">
</head>
<body>
<div id="div"></div><!--div que lista prouctos-->

<div id="myModalp" class="modal"><!--formulario modal para modificar nombre de producto-->
  <div class="modal-content">
    <span class="close">&times;</span><br><br>
    Producto:<input id="p" autofocus ><br><br>
    <button id="aceptap">Aceptar</button>
  </div>
</div>

<div id="myModalnc" class="modal"><!--formulario modal para modificar cantidad -->
  <div class="modal-content">
    <span class="close">&times;</span><br><br>
    Cantidad:<input type="number" id="nc" autofocus ><br><br>
    <button id="aceptanc">Aceptar</button>
  </div>
</div>

<div id="myModalnp" class="modal"><!--formulario modal para modificar precio -->
  <div class="modal-content">
    <span class="close">&times;</span><br><br>
    Precio:<input type="number" id="np" autofocus ><br><br>
    <button id="aceptanp">Aceptar</button>
  </div>
</div>

<div id="myModalc" class="modal"><!--formulario modal para modificar catego-->
  <div class="modal-content">
    <span class="close">&times;</span><br><br>
    catego:<input id="c" autofocus ><br><br>
    <button id="aceptac">Aceptar</button>
  </div>
</div>

<script>
$(document).ready(function(){ 
    $.ajax({
        type:"POST",
        url:"ObtenerProductos.php",
        dataType:"json",
        success:function(data) {  
            var i=0;
            if(i==0) {//setear encabezado
                $('#div').append('<button id="agp">Agregar Producto</button>');
                $('#div').append('<tr id="trp"> <th id="p">Producto</th> <th id="c">Cantidad</th> <th id="P">Precio</th> <th id="C">Categoria</th> <th id="e">Eliminar</th>  <th id="m">Modificar</th></tr>');
                i=1;
            }
            $.each(data, function(i, item) {
                var cantidad = parseInt(item[1])
                $('#p').append('<tr><td>'+item[0]+' </td></tr>');
                if(cantidad<20){
                    $('#c').append('<tr class="urg"><td >'+item[1]+' </td></tr>');   
                }else if(cantidad<70 && cantidad>20) {
                    $('#c').append('<tr class"casi_urg"><td>'+item[1]+' </td></tr>');   
                }else{
                    $('#c').append('<tr class"bien"><td>'+item[1]+' </td></tr>');   
                }
                $('#P').append('<tr><td>'+item[2]+' </td></tr>');
                $('#C').append('<tr><td>'+item[3]+' </td></tr>');
                $('#e').append('<tr><td> <button class="btnE" id="'+item[0]+'e" > Borrar </button> </td></tr>');
                $('#m').append('<tr><td> <button class="btnM" id="'+item[0]+'m" > Modificar </button> </td></tr>');
            });
            $('#agp').on('click',function(){//boton nuevo producto
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
                                alert("El usuario no ha podido ser registrado!");          
                            }
                        }
                    });  
                }); 
            });
            $('.btnE').on('click',function(){//boton eliminar producto
                var producto = this.id;
                $.ajax({
                    type:"POST",
                    url:"EliminarProducto.php",
                    dataType:"json",
                    data:{producto:producto},
                    success:function(exito) { 
                        if(exito == "si") {
                            alert("El producto ha sido eliminado exitosamente!");
                            location.reload();
                        }else if(exito == "no") {
                            alert("El producto no ha podido ser eliminado!");          
                        }
                    }
                });  
            });
        }
        
    });   
});

    

    




    //funciones de cierre de los modales
    var modalp = document.getElementById("myModalp");
    var modalnc = document.getElementById("myModalnc");
    var modalnp = document.getElementById("myModalnp");
    var modalc = document.getElementById("myModalc");
    var cerrp = document.getElementsByClassName("close")[0];
    var cerrnc = document.getElementsByClassName("close")[1];
    var cerrnp = document.getElementsByClassName("close")[2];
    var cerrc = document.getElementsByClassName("close")[3];
    cerrp.onclick = function() {
        modalp.style.display = "none";
    }
    cerrnc.onclick = function() {
        modalnc.style.display = "none";
    }
    cerrnp.onclick = function() {
        modalnp.style.display = "none";
    }
    cerrc.onclick = function() {
        modalc.style.display = "none";
    }

    window.onclick = function(event) {
        if (event.target == modalp  || event.target == modalnc || event.target == modalnp || event.target == modalc ) {
            modalp.style.display = "none";
            modalnc.style.display = "none";
            modalnp.style.display = "none";
            modalc.style.display = "none";
        }
    }</script>
</body>
</html>