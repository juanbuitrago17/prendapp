<?php
session_start();
$cedula = $_SESSION['cedula'];
$rol= $_SESSION['rol'];
if(empty($cedula) || empty($rol)){
    header('Location:login.php');
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Crear Producto</title>
    <link href="stylePie.css" rel="stylesheet" />
    <link href="styleHeader.css" rel="stylesheet" />
    <link href="stylesCrear.css" rel="stylesheet" />
    <link href="styleTablasYBotones.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
</head>
<header>
        <div class="ancho">
        <div class="logo">
            <img src="Imagenes/Prendapp-1.png" alt="Logo Empresa">
            <h1>PRENDAPP</h1>
            <h2 style="margin-left: 1400px;">COMPRA AQUI</h2>
        </div>
            <ul>
                <li><a href="#contacto">Contacto</a></li>
                
                <li style="float:right"><a  href="cerrarSesion.php" >Cerrar Sesion </a></li>
            </ul>
        </div>
    </header>
<body>
    <section class="form-d">
        <div class="form-c">
            <div class="box">

            <form id="form3" method="post" action="crearProductos.php" onsubmit="return validarFormulario()">
                <?php
                if($rol=="ADMINISTRADOR"){

                
                ?>
                    <div class="input-box">
                        <label for="cedula">Seleccione el nombre del vendedor:</label>
                        <select name="cedula" class="input-control" id="cedula">
                            <?php

                            include_once "conexion.php";
                            $sql= mysqli_query($conn,"SELECT cedula, nombre FROM usuario");
                            if($sql!== false){
                            while($fila =mysqli_fetch_assoc($sql)){
                                echo "<option value='" . $fila['cedula'] . "'style='color:black'>" . $fila['nombre'] . "</option>";
                            }}
                            ?>
                            </select>
                    </div>
                <?php
                }
                ?>
                    <div class="input-box">
                        <label for="nombre">Ingrese el nombre del producto:</label>
                        <input type="text" id="nombre" name="nombre"  class="input-control"></input>
                        <span class="p" id="nombreError"></span>
                    </div>
                    
                    <div class="input-box">
                        <label for="precio">Ingrese el precio del producto:</label>
                        <input type="text" id="precio" name="precio" class="input-control"></input>
                        <span class="p" id="precioError"></span>
                    </div>
                    
                    <div class="input-box">
                        <label for="clima">Ingrese el clima del producto:</label>
                        <input type="text" id="clima" name="clima"  class="input-control"></input>
                        <span class="p" id="climaError"></span>
                    </div>

                    <div class="input-box">
                        <label for="genero">Ingrese el genero del producto:</label>
                        <input type="text" id="genero" name="genero"  class="input-control"></input>
                        <span class="p" id="generoError"></span>
                    </div>
                    

                    <div class="input-box">
                        <label for="talla">Ingrese la talla del producto: </label>
                        <input type="text" id="talla" name="talla"  class="input-control"></input>
                       <span class="p" id="tallaError"></span>
                    </div>
                    
                    <div class="input-box">
                        <label for="color">Ingrese el color del producto: </label>
                        <input type="text" id="color" name="color"   class="input-control" onkeypress="return validateColorInput(event)" ></input>
                       <span class="p" id="colorError"></span>
                    </div>
                    
                    <div class="input-box">
                        <label for="url_imagen">Ingrese la url de la imagen del producto:</label>
                        <input type="text" id="url_imagen" name="url_imagen"  class="input-control"></input>
                        <span class="p" id="imagenError"></span>
                    </div>
                    
                    
                    <script>
                        function validateColorInput(event) {
                            var keyCode = event.keyCode || event.which;
                            var key = String.fromCharCode(keyCode);

                            
                            var pattern = /^[A-Za-z\s]+$/;

                            if (!pattern.test(key)) {
                                event.preventDefault();
                                return false;
                            }
                        }
                    </script>


                    <center><input type="submit" value="CREAR" name="crearProducto" class="button button2"></td> </center><br />
                    <br />
  
                    <br />
                    <?php
                if($rol=="ADMINISTRADOR"){
                    echo "<h3><a href='indexProducto.php' class='t-text'>VOLVER</a></h3>";
                }else {
                   echo "<h3><a href='inventario.php' class='t-text'>VOLVER</a></h3>";
                }
                ?>
                    
                </form>

            </div>
        </div>

    </section>
    <?php
   if(isset($_POST["crearProducto"])){
    $cedulaVendedor = $_POST["cedula"] ?? $cedula;
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $clima = $_POST["clima"];
    $genero = $_POST["genero"];
    $talla= $_POST["talla"];
    $color = $_POST["color"];
    $url_imagen = $_POST["url_imagen"];

   
    include_once "conexion.php";
    $sql= "INSERT INTO producto(cedula,nombre,precio,clima,genero,talla,color,url_imagen) VALUES ('$cedulaVendedor','$nombre','$precio','$clima','$genero','$talla','$color','$url_imagen')";
    
    
    function seCreo($rol){
        $paginaDestino = 'inventario.php' ;

        if($rol=="ADMINISTRADOR"){
            $paginaDestino =  'indexProducto.php'; 
        }
        echo "<script>alert('Se registró el producto'); window.location.href = '$paginaDestino';</script>";
    }
    function noSeCreo() {
        echo "<script>alert('No se pudo registrar el producto');</script>";
    }
    if (mysqli_query($conn, $sql)) {
        echo seCreo($rol);
    } else {
        echo noSeCreo();
    }
    mysqli_close($conn);


}
?>
</body>
<script>
    function validarFormulario(){
        document.getElementById("nombreError").textContent = "";
        document.getElementById("precioError").textContent = "";
        document.getElementById("climaError").textContent = "";
        document.getElementById("generoError").textContent = "";
        document.getElementById("tallaError").textContent = "";
        document.getElementById("colorError").textContent = "";
        document.getElementById("imagenError").textContent = "";
       
        var nombre = document.getElementById('nombre').value;
        if(nombre.trim()== ""){
            document.getElementById("nombreError").textContent = "El nombre del producto es requerido";
            return false;
        }
        
        var precio = document.getElementById('precio').value;
        if(precio.trim()== ""){
            document.getElementById("precioError").textContent = "El precio del producto es requerido";
            return false;
        }else if(!/^[0-9]+$/.test(precio)){
             document.getElementById("precioError").textContent = "El total no es numerico, sin puntos ";
            return false;
        }
        
        var clima = document.getElementById('clima').value;
        if(clima.trim()== ""){
            document.getElementById("climaError").textContent = "El clima del producto es requerido";
            return false;
        }else if(!/^(Calido|Frio|Templado|Otro|calido|frio|templado|otro)$/.test(clima)){
             document.getElementById("climaError").textContent = "El clima del producto no es valido ";
            return false;
        }
        
        var genero = document.getElementById('genero').value;
        if(genero.trim()== ""){
            document.getElementById("generoError").textContent = "El genero del producto es requerido";
            return false;
        }else if(!/^(Masculino|Femenino|masculino|femenino|Otro)$/.test(genero)){
             document.getElementById("generoError").textContent = "El genero del producto no es valido ";
            return false;
        }
        
        var talla = document.getElementById('talla').value;
        if(talla.trim()== ""){
            document.getElementById("tallaError").textContent = "La talla del producto es requerida";
            return false;
        }else if(!/^[XSMLXL]{1,2}$/.test(talla)){
             document.getElementById("tallaError").textContent = "La talla del producto no es valida ";
            return false;
        }
        
         var color = document.getElementById('color').value;
        if(color.trim()== ""){
            document.getElementById("colorError").textContent = "El color del producto es requerido";
            return false;
        }
        
         var url = document.getElementById('url_imagen').value;
        if(url.trim()== ""){
            document.getElementById("imagenError").textContent = "la url_imagen del producto es requerida";
            return false;
        }
        
        
        return  true;
    }
</script>
<footer style="min-height:30vh">
    <h2 id="contacto" >PRENDAPP</h2>
    <br>    
    <p class="pt">
        <img  class="img-t" src="Imagenes/Prendapp-1.png" alt="Descripción de la imagen">
        &nbsp;
        Bogota-Colombia
        310546986-3124596564&
        PRENDAPP@gmail.com
        </p>
        <br><br>
        <h5>Siguenos en Redes sociales</h5>
           
           
        <a href="https://www.facebook.com" class="social-icon" target="_blank"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.twitter.com" class="social-icon" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="https://www.instagram.com" class="social-icon" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://api.whatsapp.com/send?phone=1234567890" class="social-icon" target="_blank"><i class="fab fa-whatsapp"></i></a>
        <p class="py">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Copyright ©2023 My Website. Todos los derechos reservados a PRENDAPP.</p>
</footer>
</html>