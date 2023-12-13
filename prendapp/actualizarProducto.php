<?php
session_start();
$cedula = $_SESSION['cedula'];
$rol = $_SESSION["rol"];
if(empty($cedula) || empty($rol)){
    header('Location:login.php');
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Actualizar Producto</title>
    <link href="stylesCrear.css" rel="stylesheet" />
    <link href="styleTablasYBotones.css" rel="stylesheet">
    <link href="stylePie.css" rel="stylesheet" />
    <link href="styleHeader.css" rel="stylesheet" />
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
<?php
include_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_producto'])) {
    $id_producto = $_POST['id_producto'];
    $sql = "SELECT * FROM producto WHERE id_producto = '$id_producto'";
    $result = mysqli_query($conn, $sql);

    if ($result !== false && mysqli_num_rows($result) > 0) {
        $producto = mysqli_fetch_assoc($result);
        
    }
}
?>
    <section class="form-d">
        <div class="form-c">
            <div class="box">

            <form id="form4" method="post" action="actualizarProducto.php"  onsubmit="return validarFormulario()">

            <div class="input-box">
            
            <input type="hidden" name="id_producto" value="<?php echo isset($producto['id_producto']) ? $producto['id_producto'] : ''; ?>"  class="input-control"></input>
            <?php
            $valida = true;
            if (isset($_POST["actualizarUsuarios"])) {
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $id_producto = $_POST["id_producto"];
                if(empty($id_producto)){
                    echo"<p class='p'>El campo es obligatorio</p>";
                    $valida = false;
                }
            }
        }
            ?>
        </div>

                    <div class="input-box">
                        <label for="nombre">Ingrese el nombre del producto:</label>
                        <input type="text" id="nombre"  name="nombre" value="<?php echo isset($producto['nombre']) ? $producto['nombre'] : ''; ?>" class="input-control"></input>
                        <span class="p" id="nombreError"></span>
                    </div>
                    
                    <div class="input-box">
                        <label for="precio">Ingrese el precio del producto:</label>
                        <input type="text" id="precio" name="precio" value="<?php echo isset($producto['precio']) ? $producto['precio'] : ''; ?>" class="input-control"></input>
                        <span class="p" id="precioError"></span>
                    </div>
                    
                    <div class="input-box">
                        <label for="clima">Ingrese el clima del producto:</label>
                        <input type="text" id="clima" name="clima" value="<?php echo isset($producto['clima']) ? $producto['clima'] : ''; ?>" class="input-control"></input>
                        <span class="p" id="climaError"></span>
                    </div>

                    <div class="input-box">
                        <label for="genero">Ingrese el genero del producto:</label>
                        <input type="text" id="genero" name="genero" value="<?php echo isset($producto['genero']) ? $producto['genero'] : ''; ?>" class="input-control"></input>
                        <span class="p" id="generoError"></span>
                    </div>

                    <div class="input-box">
                        <label for="talla">Ingrese la talla del producto: </label>
                        <input type="text" id="talla" name="talla" value="<?php echo isset($producto['talla']) ? $producto['talla'] : ''; ?>" class="input-control"></input>
                        <span class="p" id="tallaError"></span>
                    </div>
                    
                    <div class="input-box">
                        <label for="color">Ingrese el color del producto: </label>
                        <input type="text" id="color name="color" value="<?php echo isset($producto['color']) ? $producto['color'] : ''; ?>"  class="input-control" onkeypress="return validateColorInput(event)" ></input>
                        <span class="p" id="colorError"></span>
                    </div>
                    <div class="input-box">
                        <label for="url_imagen">Ingrese la url de la imagen del producto:</label>
                        <input type="text" id="url_imagen" name="url_imagen" value="<?php echo isset($producto['url_imagen']) ? $producto['url_imagen'] : ''; ?>" class="input-control"></input>
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


            <center><input type="submit" value="Actualizar" name="actualizarProducto" class="button button2"></td> </center><br />
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
    
if(isset($_POST["actualizarProducto"])){
    $id_producto = $_POST["id_producto"];
    $nombre = $_POST["nombre"];
    $color = $_POST["color"];
    $genero = $_POST["genero"];
    $talla = $_POST["talla"];
    $precio = $_POST["precio"];
    $clima = $_POST["clima"];
    $url_imagen = $_POST["url_imagen"];
    $rol = $_SESSION["rol"];
    
    echo $rol;
    if($valida == True){
        include_once "conexion.php";
    
    $sql = "UPDATE producto SET nombre='$nombre', color='$color', genero='$genero', talla='$talla', precio='$precio', clima='$clima', url_imagen='$url_imagen' WHERE id_producto='$id_producto'";
    function seCreo($rol){ 
        if($rol=="ADMINISTRADOR"){
            echo "<script>alert('Se actualizo el producto'); window.location.href = 'indexProducto.php';</script>";
            }else {
                echo "<script>alert('Se actualizo el producto'); window.location.href = 'inventario.php';</script>";
            }
    } 
    
    function noSeCreo() { 
        echo "<script>alert('No se pudo actualizar el producto');</script>"; 
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