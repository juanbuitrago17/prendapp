<?php
session_start();
$usuario = $_SESSION['usuario'];
$rol = $_SESSION["rol"];

if(empty($usuario) || empty($rol)){
    header('Location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Crear Venta</title>
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
        <div class="form-c" >
              <div class="box">
    
    <form id="form7" method="post" action="crearVenta.php" onsubmit="return validarFormulario()">

    <div class="input-box">
             <label for="cedula">Seleccione el nombre del comprador:</label>
                <select name="cedula"  class="input-control" id="cedula">
                <?php
                    $valida = true;
                    include_once "conexion.php";
                    $sql= mysqli_query($conn,"SELECT cedula, nombre FROM usuario");
                    if($sql!== false){
                        while($fila =mysqli_fetch_assoc($sql)){
                            echo "<option  style='color:black' value='" . $fila['cedula'] . "'>" . $fila['nombre'] . "</option>";
                        }
                    }
                ?>
                </select>
            </div>

            <div class="input-box">
            <label for="id_inventario">Seleccione el id del inventario:</label>
            <select name="id_inventario" class="input-control" id="id_inventario">
                <?php
                    include_once "conexion.php";
                    $sql= mysqli_query($conn,"SELECT id_inventario FROM inventario");
                    if($sql!== false){
                        while($fila =mysqli_fetch_assoc($sql)){
                            echo "<option style='color:black' value='" . $fila['id_inventario'] . "'>" . $fila['id_inventario'] . "</option>";
                        }
                    }
                ?>
                </select>
            </div>

          <div class="input-box" >
          <label for="cantidadProductos">Ingrese la cantidad de productos:</label>
          <input type="text" id="cantidadProductos" name="cantidadProductos" class="input-control" ></input>
            <span class="p" id="cantidadError"></span>
          </div>
          
        <div class="input-box">
            <label for="total">Total de la venta:</label>
            <input type="text" id="total" name="total" class="input-control"></input>
              <span class="p" id="totalError"></span>
        </div>

         <center><input type="submit" value="CREAR" name="crearVenta" class="button button2"></td> </center><br />
       
        <br/>
        
         <h3>  <a href="indexVenta.php" class="t-text">VOLVER</a></h3>
        
     
    </form> 
    </div>
    </div>
	</section>
    <?php
if(isset($_POST["crearVenta"])){
    $cedula = $_POST["cedula"];
    $id_inventario = $_POST["id_inventario"];
    $fechaCreacion = date("Y-m-d");
    $cantidadProductos = $_POST["cantidadProductos"];
    $total = $_POST["total"];

    if($valida == True){
        include_once "conexion.php";
    $sql= "INSERT INTO venta(cedula,id_inventario,fechaCreacion,cantidadProductos,total) VALUES ('$cedula','$id_inventario','$fechaCreacion','$cantidadProductos','$total')";

    function seCreo(){
        echo "<script>alert('Se registró la venta'); window.location.href = 'indexVenta.php';</script>";
    }
    function noSeCreo() {
        echo "<script>alert('No se pudo registrar la venta');</script>";
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
<script>
    function validarFormulario(){
        document.getElementById("cantidadError").textContent = "";
        document.getElementById("totalError").textContent = "";
        
        var cantidad = document.getElementById('cantidadProductos').value;
        if(cantidad.trim()== ""){
            document.getElementById("cantidadError").textContent = "La cantidad del producto es requerida";
            return false;
        }else if(!/^[0-9]+$/.test(cantidad)){
             document.getElementById("cantidadError").textContent = "La cantidad debe ser numerica ";
            return false;
        }
        
        var total = document.getElementById('total').value;
        if(total.trim()== ""){
            document.getElementById("totalError").textContent = "La compra total es requerida";
            return false;
        }else if(!/^[0-9]+$/.test(total)){
             document.getElementById("totalError").textContent = "El total no es numerico, sin puntos ";
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