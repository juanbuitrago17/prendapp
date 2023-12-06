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

            <form id="form3" method="post" action="crearProductos.php">
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
                        <input type="text" name="nombre"  class="input-control"></input>
                        <?php
                        $valida = true;
                        if($_SERVER["REQUEST_METHOD"] == "POST"){
                            $nombre = $_POST["nombre"];
                            if(empty($nombre)){
                                echo"<p class='p'>El campo es obligatorio</p>";
                                $valida = false;
                            }
                        }
                        ?>
                    </div>
                    <div class="input-box">
                        <label for="precio">Ingrese el precio del producto:</label>
                        <input type="text" name="precio" class="input-control"></input>
                        <?php
                        if($_SERVER["REQUEST_METHOD"] == "POST"){
                            $precio = $_POST["precio"];
                            if(empty($precio)){
                                echo"<p class='p'>El campo es obligatorio</p>";
                                $valida = false;
                            }else{
                                if(!preg_match("/^\d+(\.\d{1,2})?$/", $precio)){
                                    echo "<p class='p'>Ingrese un precio válido</p>";
                                    $valida = false;
                                }
                            }
                        }
                        ?>
                    </div>
                    <div class="input-box">
                        <label for="clima">Ingrese el clima del producto:</label>
                        <input type="text" name="clima"  class="input-control"></input>
                        <?php
                        if($_SERVER["REQUEST_METHOD"] == "POST"){
                            $clima = $_POST["clima"];
                            if(empty($clima)){
                                echo"<p class='p'>El campo es obligatorio</p>";
                                $valida = false;
                            }else{
                                if(!preg_match("/^(Calido|Frio|Templado|Otro|calido|frio|templado|otro)$/", $clima)){
                                    echo "<p class='p'>Ingrese un clima válida</p>";
                                    $valida = false;
                                }
                            }
                        }
                        ?>
                    </div>

                    <div class="input-box">
                        <label for="genero">Ingrese el genero del producto:</label>
                        <input type="text" name="genero"  class="input-control"></input>
                        <?php
                        if($_SERVER["REQUEST_METHOD"] == "POST"){
                            $genero = $_POST["genero"];
                            if(empty($genero)){
                                echo"<p class='p'>El campo es obligatorio</p>";
                                $valida = false;
                            }else{
                                if(!preg_match("/^(Masculino|Femenino|masculino|femenino|Otro)$/", $genero)){
                                    echo "<p class='p'>Ingrese un género válido</p>";
                                    $valida = false;
                                }
                            }
                        }
                        ?>
                    </div>
                    

                    <div class="input-box">
                        <label for="talla">Ingrese la talla del producto: </label>
                        <input type="text" name="talla"  class="input-control"></input>
                        <?php
                        if($_SERVER["REQUEST_METHOD"] == "POST"){
                            $talla = $_POST["talla"];
                            if(empty($talla)){
                                echo"<p class='p'>El campo es obligatorio</p>";
                                $valida = false;
                            }else{
                                if(!preg_match("/^[XSMLXL]{1,2}$/", $talla)){
                                    echo "<p class='p'>Ingrese una talla válida</p>";
                                    $valida = false;
                                }
                            }
                        }
                        ?>
                    </div>
                    
                    <div class="input-box">
                        <label for="color">Ingrese el color del producto: </label>
                        <input type="text" name="color"   class="input-control" onkeypress="return validateColorInput(event)" ></input>
                        <?php
                            if($_SERVER["REQUEST_METHOD"] == "POST"){
                                $color = $_POST["color"];
                                if(empty($color)){
                                    echo"<p class='p'>El campo es obligatorio</p>";
                                    $valida = false;
                                }
                            }
                        ?>
                    </div>
                    <div class="input-box">
                        <label for="url_imagen">Ingrese la url de la imagen del producto:</label>
                        <input type="text" name="url_imagen"  class="input-control"></input>
                        <?php
                        $valida = true;
                        if($_SERVER["REQUEST_METHOD"] == "POST"){
                            $url_imagen = $_POST["url_imagen"];
                            if(empty($url_imagen)){
                                echo"<p class='p'>El campo es obligatorio</p>";
                                $valida = false;
                            }
                        }
                        ?>
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

    if($valida == True){
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
}
?>
</body>
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