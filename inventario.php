
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Bienvenido</title>
    <?php include("menuG.php");?>
    <link rel="stylesheet" href="estilos/EstilosInventario.css">
</head>
<body>
<div id="div"></div><!--div que lista prouctos-->

<div id="myModal" class="modal"><!--formulario modal para agregar producto !-->
  <div class="modal-content">
    <span class="close">&times;</span><br><br><br>
    <div id="conte">
        Producto:<br><input id="prodmod" autofocus ><br><br>
        Cantidad:<br><input type="number" id="cantmod" ><br><br>
        Precio:<br><input type="number" id="precmod"  ><br><br>
        Categoria:<select id="selected"></select>  <br><br>
        <button class="btnMod" id="aceptamod">Aceptar</button>
    </div>
  </div>
</div>

<div id="myModal2" class="modal"><!--formulario modal para modificar nombre de producto-->
  <div class="modal-content">
    <span class="close">&times;</span><br><br><br>
    <div id="conte">
        Producto:<br><input id="prodmod2" autofocus ><br><br>
        Cantidad:<br><input type="number" id="cantmod2" ><br><br>
        Precio:<br><input type="number" id="precmod2"  ><br><br>
        Categoria:<select id="selected2"></select>  <br><br>
        <button class="btnMod" id="aceptamod2">Aceptar</button>
    </div>
  </div>
</div>

<div id="myModal3" class="modal"><!--formulario modal para modificar nombre de producto-->
  <div class="modal-content">
    <span class="close">&times;</span><br><br><br>
    <div id="conte">
        Categoria:<br><input id="cati3" autofocus ><br><br>
        <button class="btnMod" id="aceptamod3">Aceptar</button>
    </div>
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
                $('#div').append('<button id="agp">Agregar producto</button><button id="agc">Agregar categoria</button>');
                $('#div').append('<tr id="trp"> <th >Producto</th> <th>Precio</th> <th>Categoria</th> <th >Eliminar</th>  <th >Modificar</th> <th>Cantidad</th></tr>');
                i=1;
            }
            $.each(data, function(i, item) {//crear tabla
                var cantidad = parseInt(item[1])
                if(cantidad<20){
                    $('#div').append('<tr > <td>'+item[0]+' </td> <td>$'+item[2]+'</td> <td>'+item[3]+' </td> <td><button class="btnE" id="'+item[0]+'e" >Borrar</button></td> <td> <button class="btnM" id="'+item[0]+'m" > Modificar </button> </td>  <td class="urg" >'+item[1]+'</td>  </tr>');   
                }else if(cantidad<70 && cantidad>20) {
                    $('#div').append('<tr > <td>'+item[0]+' </td> <td>$'+item[2]+'</td> <td>'+item[3]+' </td> <td><button class="btnE" id="'+item[0]+'e" >Borrar</button></td> <td> <button class="btnM" id="'+item[0]+'m" > Modificar </button> </td>  <td class="casi_urg" >'+item[1]+'</td>  </tr>'); 
                }else{
                    $('#div').append('<tr > <td>'+item[0]+' </td> <td>$'+item[2]+'</td> <td>'+item[3]+' </td> <td><button class="btnE" id="'+item[0]+'e" >Borrar</button></td> <td> <button class="btnM" id="'+item[0]+'m" > Modificar </button> </td>  <td class="bien" >'+item[1]+'</td>  </tr>'); 
                }
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
            $('#agc').on('click',function(){//boton nuevo producto
                document.getElementById('myModal3').style.display = "block"; 
                $('#aceptamod3').on('click',function(){
                    var categoria = document.getElementById('cati3').value;
                    $.ajax({
                        type:"POST",
                        url:"SetCat.php",
                        dataType:"json",
                        data:{categoria:categoria},
                        success:function(exito) {  
                            if(exito == "si") {
                                alert("La nueva categoria ha sido creada!");
                                location.reload();
                            }else if(exito == "no") {
                                alert("La categoria ya existe!");          
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
    var modal3 = document.getElementById("myModal3");
    var cerr3 = document.getElementsByClassName("close")[2];

    cerr.onclick = function() {
        modal.style.display = "none";
    }
    cerr2.onclick = function() {
        modal2.style.display = "none";
    }
    cerr3.onclick = function() {
        modal3.style.display = "none";
    }
    window.onclick = function(event) {
        if (event.target == modal  || event.target == modal2 || event.target == modal3) {
            modal.style.display = "none";
            modal2.style.display = "none";
            modal3.style.display = "none";
        }
    }

    </script>
</body>
</html>