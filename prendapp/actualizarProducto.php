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
    <link href="styleTablas.css" rel="stylesheet">
</head>
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

            <form id="form4" method="post" action="actualizarProducto.php">

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
                        <input type="text" name="nombre" value="<?php echo isset($producto['nombre']) ? $producto['nombre'] : ''; ?>" class="input-control"></input>
                        <?php
                        $valida = true;
                        if(isset($_POST["actualizarProducto"])){   
                        if($_SERVER["REQUEST_METHOD"] == "POST"){  
                        $nombre = $_POST["nombre"]; 
                            
                            if(empty($nombre)){
                                echo"<p class='p'>El campo es obligatorio</p>";
                                $valida = false;
                            }
                        }
                    }
                        ?>
                    </div>
                    <div class="input-box">
                        <label for="precio">Ingrese el precio del producto:</label>
                        <input type="text" name="precio" value="<?php echo isset($producto['precio']) ? $producto['precio'] : ''; ?>" class="input-control"></input>
                        <?php
                        if(isset($_POST["actualizarProducto"])){
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
                    }
                        ?>
                    </div>
                    <div class="input-box">
                        <label for="clima">Ingrese el clima del producto:</label>
                        <input type="text" name="clima" value="<?php echo isset($producto['clima']) ? $producto['clima'] : ''; ?>" class="input-control"></input>
                        <?php
                        if(isset($_POST["actualizarProducto"])){  
                        if($_SERVER["REQUEST_METHOD"] == "POST"){
                            $clima = $_POST["clima"];
                        
                            if(empty($clima)){
                                echo"<p class='p'>El campo es obligatorio</p>";
                                $valida = false;
                            }else{
                                if(!preg_match("/^(Calido|Frio|Templado|Otro)$/i", $clima)){
                                    echo "<p class='p'>Ingrese un clima válida</p>";
                                    $valida = false;
                                }
                            }
                        }
                    }
                        ?>
                    </div>


                    

                    <div class="input-box">
                        <label for="genero">Ingrese el genero del producto:</label>
                        <input type="text" name="genero" value="<?php echo isset($producto['genero']) ? $producto['genero'] : ''; ?>" class="input-control"></input>
                        <?php
                        if(isset($_POST["actualizarProducto"])){  
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
                        }
                        ?>
                    </div>
                    

                    <div class="input-box">
                        <label for="talla">Ingrese la talla del producto: </label>
                        <input type="text" name="talla" value="<?php echo isset($producto['talla']) ? $producto['talla'] : ''; ?>" class="input-control"></input>
                        <?php
                        if(isset($_POST["actualizarProducto"])){
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
                     }
                        ?>
                    </div>

                    
                    <div class="input-box">
                        <label for="color">Ingrese el color del producto: </label>
                        <input type="text" name="color" value="<?php echo isset($producto['color']) ? $producto['color'] : ''; ?>"  class="input-control" onkeypress="return validateColorInput(event)" ></input>
                        <?php
                        if(isset($_POST["actualizarProducto"])){
                            if($_SERVER["REQUEST_METHOD"] == "POST"){
                                $color = $_POST["color"];     
                                if(empty($color)){
                                    echo"<p class='p'>El campo es obligatorio</p>";
                                    $valida = false;
                                }
                            }
                        }
                        ?>
                    </div>
                    <div class="input-box">
                        <label for="url_imagen">Ingrese la url de la imagen del producto:</label>
                        <input type="text" name="url_imagen" value="<?php echo isset($producto['url_imagen']) ? $producto['url_imagen'] : ''; ?>" class="input-control"></input>
                        <?php
                        if(isset($_POST["actualizarProducto"])){
                        if($_SERVER["REQUEST_METHOD"] == "POST"){
                            $url_imagen = $_POST["url_imagen"];
                            if(empty($url_imagen)){
                                echo"<p class='p'>El campo es obligatorio</p>";
                                $valida = false;
                            }
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
        echo "hola";
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
</html>