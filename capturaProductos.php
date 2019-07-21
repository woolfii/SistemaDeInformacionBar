<?php 
    $conexion=mysqli_connect('localhost','root','','bar');
    session_start();
 ?>
<!DOCTYPE html>
<html lang="en">
<head>
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="capturaProductos.css">
    <title>Captura productos</title>

    <style>
        #BEP{
            display:none;
            }
    </style>
</head>
<body>
    <table id="tabla">
        <tr>
            <th>Productos</th>
            <th> <?php 
            $sql="SELECT * from categorias";
            $result=mysqli_query($conexion,$sql);

            while($mostrar=mysqli_fetch_array($result)){
            ?>
                <input type="button" class="getCat" id="<?php echo $mostrar['catego'] ?>" value="<?php echo $mostrar['catego'] ?>">
                
            <?php 
            }
            ?>  
            </th>
        </tr>
        <tr>
            <th ><div id="PE"></div><button id="BEP">Eliminar producto</button></th>
            <th >
                <div id="PxC"></div>
                <button id="BTNa">ACEPTAR</button>
                <button id="BTNc" onclick="window.location = 'indexM.php'">CANCELAR</button>
            </th>
        </tr>
    </table>
    
<script>
$(document).ready(function(){
    var iCnt = 0;
    var productos = [];
    $('.getCat').on('click',function(){
        var cat = this.id;
        $.ajax({
            type:'POST',
            url:'productos.php',
            dataType: "json",
            data:{cat:cat},
            success:function(data){
                $('#PxC').empty();
                if(data.status == 'ok'){
                    $.each(data.result, function(i, item) {
                        $('#PxC').append(' <button id="'+data.result[i].nombre+'" class="productoPresionado"> '+ data.result[i].nombre + ' </button>  ');
                    })
                    $('.productoPresionado').on('click',function(){
                        var valor = this.id;
                        iCnt = iCnt + 1;                       
                        $('#PE').append('<tr id=tb' + iCnt + '><th>'+ valor +'</th></tr>');
                        document.getElementById("BEP").style.display = "inline";
                        productos.push(valor);
                    });
                    
                }else{
                } 
            }
        });
        });
    $('#BEP').on('click',function(){
        if (iCnt != 0) {
            $('#tb'+ iCnt).remove();
            iCnt = iCnt - 1;
            productos.pop();                           
        }
    });
    $('#BTNa').on('click',function(){
        var products = {mesero:"uanjo",mesa:"mesa",datos:productos};
        var obj = JSON.stringify(products);
        $.ajax({
            type:'POST',
            url:'guardarCaptura.php',
            dataType: "json",
            data:{datos:obj},
        });    
    });
});
</script>
</body>

</html>