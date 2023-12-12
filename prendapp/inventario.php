<?php
session_start();
$usuario = $_SESSION['cedula'];
$rol = $_SESSION["rol"];

if(empty($usuario) || empty($rol)){
    header('Location:login.php');
}
?>


<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PRENDAPP</title>
    
    <link href="styleInventario.css" rel="stylesheet"/>
    <link href="styleHeader.css" rel="stylesheet"  >
    <link href="stylePie.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
</head>
<body>
<header>
        <div class="ancho">
        <div class="logo">
            <img src="Imagenes/Prendapp-1.png" alt="Logo Empresa">
            <h1>PRENDAPP</h1>
            <h2 style="margin-left: 1400px;">COMPRA AQUI</h2>
        </div>
            <ul>
            <li><a href="nosotros.php">Nosotros</a></li>
                <li><a href="#contacto">Contacto</a></li>
                
                <li style="float:right"><a href="cerrarSesion.php" >Cerrar Sesion</a></li>
                <li style="float:right"><a href="crearProductos.php" >Crear Producto</a></li>
                <li style="float:right"><a href="paginaClientes.php" >Regresar</a></li>
            </ul>
        </div>
    </header>
        <br><br />
     <br />
    <center><h1 class="letras">ADMINISTAR INVENTARIO</h1></center>
    <br/><br/>
    <div class="contenedor">
  <div><h3 class="letras">Seleccionar producto</h3></div><br/>
  <div><form id="administrarInventario" method="post" action="inventario.php">
  <?php
    include_once "conexion.php";

    $consulta = "SELECT id_producto, nombre FROM producto WHERE cedula = ?";
    if($productosActuales = $conn->prepare($consulta)){

        $productosActuales->bind_param('i',$usuario);

        $productosActuales->execute();

        $productosActuales->bind_result($id_producto, $nombre);

       echo "<label for='id_producto' class='letras'>Seleccione el nombre del producto:</label>";
       echo "<select name='id_producto' class='select' id='id_producto'>";
        while($productosActuales->fetch()){
            echo "<option value='" . $id_producto . "'style='color:#11294d;'>" . $nombre . "</option>";
        }
        echo "</select></div><br/>";
        $productosActuales->close();
    }
    
    ?>
    

    <div>
    <label for="cantidad" class="letras">Ingrese la cantidad de productos:</label>
    <input class="cantidad" type="text" name="cantidad" class="input-control">
    <?php
        $valida = true;
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $cantidad = $_POST["cantidad"];
            if(empty($cantidad)){
                echo"<p class='p'>El campo es obligatorio</p>";
                $valida = false;
            }else{
                if(!preg_match("/^[0-9]+$/", $cantidad)){
                    echo "<p class='p'>El campo no tiene el formato correcto</p>";
                    $valida = false;
                }
            }
        }
    ?>
   
    <br><br>
    
    <div>
        <button type="submit" class="button" value="Agregar" name="administrarInventario" >Agregar</button>
    </div>
    </form>
  </div>
</div>
    <?php
     if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["administrarInventario"])){
        $id_producto = $_POST["id_producto"];
        $cantidad = $_POST["cantidad"];
        $fechaCreacion = date("Y-m-d");
        $fechaActualizacion2 = date("Y-m-d");
        if($valida == True){
        include_once "conexion.php";
        $buscar= mysqli_query($conn,"SELECT * FROM inventario WHERE id_producto = '$id_producto'");
        
        if(mysqli_num_rows($buscar)> 0){
            $filaProducto = mysqli_fetch_assoc($buscar);
            $nuevaCantidad = $cantidad  + $filaProducto['cantidad'];
            $nuevaCantidadProducto="UPDATE inventario SET cantidad = '$nuevaCantidad' WHERE id_producto = '$id_producto'";
            if (mysqli_query($conn, $nuevaCantidadProducto)) {
                echo "<script>alert('El producto ya existia en el inventario,la cantidad se sumo a el inventario');</script>";
            }
            
        }else{

       $sql = "INSERT INTO inventario(id_producto,cantidad,fechaCreacion,fechaActualizacion) VALUES ('$id_producto','$cantidad','$fechaCreacion','$fechaActualizacion2')";

        function seCreo(){
            echo "<script>alert('Se registró el Inventario');</script>";
        }
        function noSeCreo() {
            echo "<script>alert('No se pudo registrar el Inventario');</script>";
        }
        if (mysqli_query($conn, $sql)) {
            echo seCreo();
        } else {
            echo noSeCreo();
        }
        
        }
    }
    }
    ?>
    </div>
    <br/><br/>

    <center><h3 class="letras">INVENTARIO</h3></center>
    <br/><br/>


    <div>
    <?php
    $sql = "SELECT i.id_inventario, p.id_producto, p.nombre AS nombre_producto, i.cantidad FROM inventario i JOIN producto p ON i.id_producto = p.id_producto WHERE p.cedula = ?";
    if($inventariosActuales = $result = $conn->prepare($sql)){

        $inventariosActuales->bind_param('i', $usuario);

        $inventariosActuales->execute();

        $inventariosActuales->bind_result($id_inventario, $id_producto, $nombre_producto, $cantidad);

        echo "<table><tr><th>Id_Inventario</th><th>Id_Producto</th><th>Nombre del Producto</th><th>Cantidad</th><th>Actualizar Inventario</th><th>Actualizar Producto</th></tr>";
        while($inventariosActuales->fetch()){
            echo "<tr><td>".$id_inventario. "</td>
                  <td>".$id_producto. "</td>
                  <td>".$nombre_producto. "</td>
                  <td>".$cantidad. "</td>
                  <td><form method='post' action='actualizarInventario.php'>
                  <input type='hidden' name='id_inventario' value='".$id_inventario."'>
                  <button type='submit' class='link' onclick='return confirm(\"¿Estás seguro de que quieres actualizar este Inventario?\")'>Actualizar</button>
              </form></td>
              <td><form method='post' action='actualizarProducto.php'>
              <input type='hidden' name='id_producto' value='".$id_producto."'>
              <button type='submit' class='link' onclick='return confirm(\"¿Estás seguro de que quieres actualizar este Inventario?\")'>Actualizar Producto</button>
          </form></td></tr>";
        }
        echo "</table><br><br>";
        $inventariosActuales->close();
    }
    mysqli_close($conn);
    ?>
    </div>
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