<?php
session_start();
$usuario = $_SESSION['usuario'];
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
    <link href="styleDetalles.css" rel="stylesheet">
    <link href="styleHeader.css" rel="stylesheet"  >
    <link href="stylePie.css" rel="stylesheet" />
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
</head>
<body><header>
        <div class="ancho">
        <div class="logo">
            <img src="Imagenes/Prendapp-1.png" alt="Logo Empresa">
            <h1>PRENDAPP</h1>
            <h2 style="margin-left: 1400px;">COMPRA AQUI</h2>
        </div>
            <ul>
            
            <li><a href="nosotros.php">Nosotros</a></li>
                <li><a href="#contacto">Contacto</a></li>
                
                <li style="float:right"><a href="cerrarSesion.php" >Cerrar Sesion </a></li>
                <li style="float:right"><a href="paginaClientes.php" >Regresar</a></li>
            </ul>
        </div>
    </header>
    
           
<nav> 
    <br><br />
    <br />
<center> <h1  class="letras">DETALLES DEL PRODUCTO</h1></center>
<br/><br/>


<div> 
<?php
include_once "conexion.php";
$idProducto = $_GET['id_producto'];
if(!empty($idProducto)){
   $sql = "SELECT * FROM producto AS p
   INNER JOIN inventario AS i ON i.id_producto = p.id_producto
   WHERE p.id_producto =" . $idProducto;

    $resultado=$conn->query($sql); 
    

    $producto = $resultado->fetch_assoc();
    
}

?>
<?php
if($resultado->num_rows == 1){
?>
<div class="contenedor">
  <div class="producto">
  <?php echo "<img class='imagen' src='" .$producto['url_imagen']."' alt='".$producto['nombre']."' />"?>
   <div class="description"> 
  <div class="text"><strong>Nombre: </strong><?php echo $producto['nombre']  ?></div>
   <div class="text"><strong>color: </strong><?php echo $producto['color']  ?></div>
   <div class="text"><strong>Talla: </strong><?php echo $producto['talla']  ?></div>
   <div class="text"><strong>Genero: </strong><?php echo $producto['genero']  ?></div>
  <div class="text"><strong>Clima: </strong><?php echo $producto['clima']  ?></div>
  <div class="text"><strong>precio: </strong><?php echo "COP " . $producto['precio'] ?></div>
    </div>
    </div>
</div>
  <div class="comprar">
    <div >
<?php
if($producto['cantidad']>= 1){
?>   
<form id="administrarInventario" method="post"action="venta.php">
  <label for='cantidad_producto' class="letras">Seleccione la cantidad del producto:</label> 
    <select  name='cantidad_producto'  id='cantidad_producto' class="select">
    <?php
    $contar = 1;
    while($producto['cantidad']>=$contar){
    echo  "<option value='".$contar."'style='color:black'>" . $contar . "</option>";
    $contar ++; 
    }  
    echo"</select></div> ";
    ?> 
    <input type="hidden" id="id_producto"
    name="id_producto" value="<?php echo $producto['id_producto'];?>"/>
    <input type="hidden" id="nombre"
    name="nombre" value="<?php echo $producto['nombre'];?>"/>
    <input type="hidden" id="id_inventario"
    name="id_inventario" value="<?php echo $producto['id_inventario'];?>"/>
    <input type="hidden" id="precio"
    name="precio" value="<?php echo $producto['precio'];?>"/>
    <input type="hidden" id="cantidad"
    name="cantidad" value="<?php echo $producto['cantidad'];?>"/>
    <div><button type="submit" value="Comprar" name="venta" class="button" >Comprar</button></div>
    </form>
    </div>
    <?php
    }else{ 
        echo "<div>" ;
        echo "<h3 class='letras'>LO SENTIMOS ESTE PRODUCTO ESTA  AGOTADO </h3>";
        "</div>";
    }

}
?>
</div>
       
<br><br><br><br>

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