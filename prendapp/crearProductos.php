<!DOCTYPE html>

<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Crear Producto</title>
    <link href="stylesCrear.css" rel="stylesheet" />
    <link href="stylesTablas.css" rel="stylesheet">
</head>
<body>
    <section class="form-d">
        <div class="form-c">
            <div class="box">

            <form id="form3" method="post" action="crearProductos.php">
                    <div class="input-box">
                        <label for="cedula">Seleccione el nombre del vendedor:</label>
                        <select name="cedula" class="input-control" id="cedula">
                            <?php
                            include_once "conexion.php";
                            $sql= mysqli_query($conn,"SELECT cedula, nombre FROM usuario");
                            if($sql!== false){
                            while($fila =mysqli_fetch_assoc($sql)){
                                echo "<option value='" . $fila['cedula'] . "'>" . $fila['nombre'] . "</option>";
                            }}
                            ?>
                            </select>
                    </div>

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

                    <h3><a href="indexProducto.php" class="t-text">VOLVER</a></h3>


                </form>

            </div>
        </div>

    </section>
    <?php
   if(isset($_POST["crearProducto"])){
    $cedula = $_POST["cedula"];
    $nombre = $_POST["nombre"];
    $precio = $_POST["precio"];
    $clima = $_POST["clima"];
    $genero = $_POST["genero"];
    $talla= $_POST["talla"];
    $color = $_POST["color"];

    if($valida == True){
    include_once "conexion.php";
    $sql= "INSERT INTO producto(cedula,nombre,precio,clima,genero,talla,color) VALUES ('$cedula','$nombre','$precio','$clima','$genero','$talla','$color')";
    
    
    function seCreo(){
        echo "<script>alert('Se registró el producto'); window.location.href = 'indexProducto.php';</script>";
    }
    function noSeCreo() {
        echo "<script>alert('No se pudo registrar el producto');</script>";
    }
    if (mysqli_query($conn, $sql)) {
        echo seCreo();
    } else {
        echo noSeCreo();
    }
    mysqli_close($conn);

}
}
?>
</body>
</html>