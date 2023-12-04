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
    <link href="stylesPaginas.css" rel="stylesheet"/>
    <link href="stylesImagenes.css" rel="stylesheet" />
    <link href="stylesTablas.css" rel="stylesheet">
    <link href="styleHeaders.css" rel="stylesheet"  >
    <link href="estylePie.css" rel="stylesheet">
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
                
                <li style="float:right"><a class="active" href="cerrarSesion.php" >Cerrar Sesion</a></li>
                <li style="float:right"><a class="active" href="crearProductos.php" >Crear Producto</a></li>
                <li style="float:right"><a class="active" href="paginaClientes.php" >Regresar</a></li>
            </ul>
        </div>
    </header>
    <nav> 
        <br><br />
     <br />
    <h1 class="letras">Administrar Inventario</h1>
    <br/><br/>

    <h3 class="letras">Seleccionar producto</h3>
    <div>
    <form id="administrarInventario" method="post" action="inventario.php">
    
    <div>
    <?php
    include_once "conexion.php";

    $consulta = "SELECT id_producto, nombre FROM producto WHERE cedula = ?";
    if($productosActuales = $conn->prepare($consulta)){

        $productosActuales->bind_param('i',$usuario);

        $productosActuales->execute();

        $productosActuales->bind_result($id_producto, $nombre);

       echo "<label for='id_producto' class='letras'>Seleccione el nombre del producto:</label>";
       echo "<select name='id_producto'  id='id_producto'>";
        while($productosActuales->fetch()){
            echo "<option value='" . $id_producto . "'style='color:black'>" . $nombre . "</option>";
        }
        echo "</select><br><br>";
        $productosActuales->close();
    }
    
    ?>
    </div>
    <div>
    <label for="cantidad" class="letras">Ingrese la cantidad de productos:</label>
    <input type="text" name="cantidad" class="input-control">
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
    </div>
    <div>
        <button type="submit" value="Agregar" name="administrarInventario" >Agregar</button>
    </div>
    </form>
    <?php
     if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST["administrarInventario"])){
        $id_producto = $_POST["id_producto"];
        $cantidad = $_POST["cantidad"];
        $FechaCreacion = date("Y-m-d");
    
        if($valida == True){
        include_once "conexion.php";
        $buscar= mysqli_query($conn,"SELECT * FROM inventario WHERE id_producto = '$id_producto'");
        
        if(mysqli_num_rows($buscar)> 0){
            $filaProducto = mysqli_fetch_assoc($buscar);
            $nuevaCantidad = $cantidad  + $filaProducto['cantidad'];
            $nuevaCantidadProducto="UPDATE inventario SET cantidad = '$nuevaCantidad' WHERE id_producto = '$id_producto'";
            
        }else{

        $sql= "INSERT INTO inventario(id_producto,cantidad,fechaCreacion) VALUES ('$id_producto','$cantidad','$FechaCreacion')";

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

    <h3 class="letras">Inventario</h3>
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
                  <button type='submit' class='a button3' onclick='return confirm(\"¿Estás seguro de que quieres actualizar este Inventario?\")'>Actualizar</button>
              </form></td>
              <td><form method='post' action='actualizarProducto.php'>
              <input type='hidden' name='id_producto' value='".$id_producto."'>
              <button type='submit' class='a button3' onclick='return confirm(\"¿Estás seguro de que quieres actualizar este Inventario?\")'>Actualizar Producto</button>
          </form></td></tr>";
        }
        echo "</table><br><br>";
        $inventariosActuales->close();
    }
    mysqli_close($conn);
    ?>
    </div>
    </nav> 
    
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