<!DOCTYPE html>
<html lang="en">
<head >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Actualizar Factura</title>
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
<?php
include_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_factura'])) {
    $id_factura = $_POST['id_factura'];

    $sql = "SELECT * FROM factura WHERE id_factura = '$id_factura'";
    $result = mysqli_query($conn, $sql);

    if ($result !== false && mysqli_num_rows($result) > 0) {
        $factura = mysqli_fetch_assoc($result);
    }
}
?>
    
    <section class="form-d">
        <div class="form-c" >
              <div class="box">
    
    <form id="form10" method="post" action="actualizarFactura.php">
    
          <div class="input-box" >
          <input type="hidden" name="id_factura" value="<?php echo isset($factura['id_factura']) ? $factura['id_factura'] : ''; ?>"  class="input-control" ></input>
          <?php
           $valida = true;
           if (isset($_POST["actualizarFactura"])) {
            if($_SERVER["REQUEST_METHOD"] == "POST"){
            $id_factura = $_POST["id_factura"];
            if(empty($id_factura)){
                echo"<p class='p'>El campo es obligatorio</p>"; 
                $valida = false; 
            }
        }
    }
            ?>
          <div class="input-box" >
          <label for="total">Total de la compra:</label>
          <input type="text" name="total" value="<?php echo isset($factura['totalCompra']) ? $factura['totalCompra'] : ''; ?>" class="input-control" ></input>
          <?php
          $valida = true;
          if (isset($_POST["actualizarFactura"])) {
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $total = $_POST["total"];
                if(empty($total)){
                    echo"<p class='p'>El campo es obligatorio</p>";
                    $valida = false;
                }else{
                    if(!preg_match("/^\d+(\.\d{1,2})?$/", $total)){
                        echo "<p class='p'>Ingrese el total de la compra  válido</p>";
                        $valida = false;
                    }
                }
            }
        }
            ?>
          </div>
          <div class="input-box" >
          <label for="cantidadProductos">Cantidad de productos de la compra:</label>
          <input type="text" name="cantidadProductos" value="<?php echo isset($factura['cantidadProductos']) ? $factura['cantidadProductos'] : ''; ?>" class="input-control" ></input>
          <?php
          if (isset($_POST["actualizarFactura"])) {
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $cantidadProductos = $_POST["cantidadProductos"];
                if(empty($cantidadProductos)){
                    echo"<p class='p'>El campo es obligatorio</p>";
                    $valida = false;
                }else{
                    if(!preg_match("/^[0-9]+$/", $cantidadProductos)){
                        echo "<p class='p'>Ingrese un código válido</p>";
                        $valida = false;
                    }
                }
            }
        }
            ?>
          </div>

         <center><input type="submit" value="Actualizar" name="actualizarFactura" class="button button2"></td> </center><br />
       
        <br/>
        
         <h3>  <a href="indexFactura.php" class="t-text">VOLVER</a></h3>
        
     
    </form> 
    </div>
    </div>
	</section>
    <?php
if(isset($_POST["actualizarFactura"])){

    $id_factura = $_POST["id_factura"];
    $total = $_POST["total"];
    $cantidadProductos = $_POST["cantidadProductos"];

    if($valida == True){
     include_once "conexion.php";
    $sql= "UPDATE factura SET totalCompra='$total',  cantidadProductos='$cantidadProductos'  WHERE id_factura='$id_factura'";

    function seCreo(){
        echo "<script>alert('Se actualizo la factura'); window.location.href = 'indexFactura.php';</script>";
    }
    function noSeCreo() {
        echo "<script>alert('No se pudo registrar la factura');</script>";
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