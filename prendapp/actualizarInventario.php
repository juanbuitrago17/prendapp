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
    <title>Actualizar Inventario</title>
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

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_inventario'])) {
    $id_inventario = $_POST['id_inventario'];

    $sql = "SELECT * FROM inventario WHERE id_inventario = '$id_inventario'";
    $result = mysqli_query($conn, $sql);

    if ($result !== false && mysqli_num_rows($result) > 0) {
        $inventario = mysqli_fetch_assoc($result);
    }
}
?>
    
    <section class="form-d">
        <div class="form-c" >
              <div class="box">
    
    <form id="form6" method="post" action="actualizarInventario.php" onsubmit="return validarFormulario()">
    
           
    <div class="input-box">
            <input type="hidden" name="id_inventario" value="<?php echo isset($inventario['id_inventario']) ? $inventario['id_inventario'] : ''; ?>" class="input-control"></input>
            <?php
            $valida = true;
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $id_inventario = $_POST["id_inventario"];
                if(empty($id_inventario)){
                    echo"<p class='p'>El campo es obligatorio</p>";
                    $valida = false;
                }
            }
            ?>
        </div>
        
        <div class="input-box">
            <label for="cantidad">Ingrese la cantidad de productos:</label>
            <input type="text" id="cantidad" name="cantidad" value="<?php echo isset($inventario['cantidad']) ? $inventario['cantidad'] : ''; ?>"  class="input-control"></input>
            <span class="p" id="cantidadError"></span>
        </div>

         <center><input type="submit" value="Actualizar" name="actualizarInventario" class="button button2"></td> </center><br />
        <br /><br />

        <?php
            if($rol=="ADMINISTRADOR"){
                echo "<h3>  <a href='indexInventario.php' class='t-text'>VOLVER</a></h3>";
            }else {
                echo "<h3>  <a href='inventario.php' class='t-text'>VOLVER</a></h3>";
            }
        ?>
        
     
    </form>
     
    </div>
    </div>
		
	</section>
    <?php
    
if (isset($_POST["actualizarInventario"])) {

    $id_inventario = $_POST["id_inventario"];
    $cantidad = $_POST["cantidad"];
    $fechaActualizacion = date("Y-m-d");

    if($valida == True){
    include_once "conexion.php";

    $sql = "UPDATE inventario SET cantidad='$cantidad', fechaActualizacion='$fechaActualizacion' WHERE id_inventario='$id_inventario'";

    function seCreo($rol){
    
        $paginaDestino = 'inventario.php' ;
        if($rol=="ADMINISTRADOR"){
            $paginaDestino =  'indexInventario.php'; 
        }
    
        echo "<script>alert('Se actualizo el inventario'); window.location.href = '$paginaDestino';</script>";
    }
    function noSeCreo()
    {
        echo "<script>alert('No se pudo actualizar el inventario');</script>";
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
        document.getElementById("cantidad").textContent = "";
        
        var cantidad = document.getElementById('cantidad').value;
        if(cantidad.trim()== ""){
            document.getElementById("cantidadError").textContent = "La cantidad del producto es requerida";
            return false;
        }else if(!/^[0-9]+$/.test(cantidad)){
             document.getElementById("cantidadError").textContent = "La cantidad debe ser numerica ";
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