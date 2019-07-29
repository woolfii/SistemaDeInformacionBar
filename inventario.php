
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

<div id="myModal" class="modal"><!--formulario modal para modificar nombre de producto-->
  <div class="modal-content">
    <span class="close">&times;</span><br><br>
    Producto:<input id="prodmod" autofocus ><br><br>
    Cantidad:<input type="number" id="cantmod" ><br><br>
    Precio:<input type="number" id="precmod"  ><br><br>
    catego:<select id="selected"></select>  <br><br>
    <button id="aceptamod">Aceptar</button>
  </div>
</div>
<div id="myModal2" class="modal"><!--formulario modal para modificar nombre de producto-->
  <div class="modal-content">
    <span class="close">&times;</span><br><br>
    Producto:<input id="prodmod2" autofocus ><br><br>
    Cantidad:<input type="number" id="cantmod2" ><br><br>
    Precio:<input type="number" id="precmod2"  ><br><br>
    catego:<select id="selected2"></select>  <br><br>
    <button id="aceptamod2">Aceptar</button>
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
            $.each(data, function(i, item) {//crear tabla
                var cantidad = parseInt(item[1])
                $('#p').append('<tr><td>'+item[0]+' </td></tr>');
                if(cantidad<20){
                    $('#c').append('<tr class="urg"><td >'+item[1]+' </td></tr>');   
                }else if(cantidad<70 && cantidad>20) {
                    $('#c').append('<tr class="casi_urg"><td>'+item[1]+' </td></tr>');   
                }else{
                    $('#c').append('<tr class="bien"><td>'+item[1]+' </td></tr>');   
                }
                $('#P').append('<tr><td>'+item[2]+' </td></tr>');
                $('#C').append('<tr><td>'+item[3]+' </td></tr>');
                $('#e').append('<tr><td> <button class="btnE" id="'+item[0]+'e" > Borrar </button> </td></tr>');
                $('#m').append('<tr><td> <button class="btnM" id="'+item[0]+'m" > Modificar </button> </td></tr>');
            });
            $.ajax({//se crean las ocpiones de categorias dinamicamente
                type:"POST",
                url:"GetCat.php",
                dataType:"json",
                success:function(data) { 
                    $.each(data, function(i, item) {
                            $('#selected').append('<option value="'+item+' ">'+item+' </option> ');
                            $('#selected2').append('<option value="'+item+' ">'+item+' </option> ');
                        })
                }
            });    
            $('#agp').on('click',function(){//boton nuevo producto
                document.getElementById('myModal').style.display = "block";
                $('#aceptamod').on('click',function(){
                    var producto = document.getElementById('prodmod').value;
                    var cantidad = document.getElementById('cantmod').value;
                    var precio = document.getElementById('precmod').value;
                    var categoria = document.getElementById('selected').value;
                    $.ajax({
                        type:"POST",
                        url:"AgregarProducto.php",
                        dataType:"json",
                        data:{producto:producto,cantidad:cantidad,precio:precio,categoria:categoria},
                        success:function(exito) {  
                            if(exito == "si") {
                                alert("El producto ha sido registrado exitosamente!");
                                location.reload();
                            }else if(exito == "no") {
                                alert("El producto no ha podido ser registrado!\nAsegurate de haber llenado todos los campos");          
                            }
                        }
                    });  
                }); 
            });
            $('.btnM').on('click',function(){
                var prod = this.id;
                $.ajax({
                    type:"POST",
                    url:"GetProd.php",
                    dataType:"json",
                    data:{prod:prod},
                    success:function(desgloce){
                        $.each(desgloce, function(i, des) {
                            $("#prodmod2").val(des[0]);
                            $("#cantmod2").val(des[1]);
                            $("#precmod2").val(des[2]);
                        })   
                        document.getElementById('myModal2').style.display = "block";
                    }
                });
                $('#aceptamod2').on('click',function(){
                    var producto = document.getElementById('prodmod2').value;
                    var cantidad = document.getElementById('cantmod2').value;
                    var precio = document.getElementById('precmod2').value;
                    var categoria = document.getElementById('selected2').value;
                    console.log(prod);
                    $.ajax({
                        type:"POST",
                        url:"SetProd.php",
                        dataType:"json",
                        data:{prod:prod,producto:producto,cantidad:cantidad,precio:precio,categoria:categoria},
                        success:function(exito) {  
                            if(exito == "si") {
                                alert("El producto ha sido actualizado!");
                                location.reload();
                            }else if(exito == "no") {
                                alert("El producto no ha podido ser actualizado!\nAsegurate de haber llenado todos los campos");          
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
    var modal = document.getElementById("myModal");
    var cerr = document.getElementsByClassName("close")[0];
    var modal2 = document.getElementById("myModal2");
    var cerr2 = document.getElementsByClassName("close")[1];
    cerr.onclick = function() {
        modal.style.display = "none";
    }
    cerr2.onclick = function() {
        modal2.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal ) {
            modal.style.display = "none";
        }
    }
    window.onclick = function(event) {
        if (event.target == modal2 ) {
            modal2.style.display = "none";
        }
    }
    </script>
</body>
</html>