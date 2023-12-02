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
    <link href="stylesPagina.css" rel="stylesheet" />
    <link href="stylesImagenes.css" rel="stylesheet" />
</head>
<body>
    <header>
        <div class="ancho">
        <div class="logo">
            <img src="Imagenes/Prendapp-1.png" alt="Logo Empresa"/>
            <h1>PRENDAPP</h1>
            <h2>COMPRA AQUI</h2>
        </div>
            <ul>
                <li><a href="#nostros">Nosotros</a></li>
                <li><a href="#contacto">Contacto</a></li>
                
                <li style="float:right"><a class="active" href="cerrarSesion.php" >Cerrar Sesion </a></li>
                <li style="float:right"><a class="active" href="paginaClientes.php" >Regresar</a></li>
            <ul>
            </div>
</header>
<nav> 
    <br><br />
    <br />
<h1>Detalles de producto</h1>
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
</div>
<div class="contenedor" id="contenedor">
<?php
if($resultado->num_rows == 1){
?>
<h3>Nombre del producto:  <?php echo $producto['nombre']  ?></h3> <br/><br/>
<h3>Recomendado para clima:  <?php echo $producto['clima']  ?></h3> <br/><br/>
<h3>La talla del producto:  <?php echo $producto['talla']  ?></h3> <br/><br/>
<h3>El color del producto:  <?php echo $producto['color']  ?></h3> <br/><br/>
<h3>El producto esta diseñado para el genero:  <?php echo $producto['genero']  ?></h3> <br/><br/>
<h3>El producto tiene un valor de :  <?php echo "COP ". $producto['precio']  ?></h3> <br/><br/>
<?php echo "<img src='" .$producto['url_imagen']."' width='100%' alt='".$producto['nombre']."' />"?><br/><br/>

<form id="administrarInventario" method="post" action="venta.php">
<label for='cantidad_producto'>Seleccione la cantidad del producto:</label>
<select name='cantidad_producto'  id='cantidad_producto'>
<?php
$contar = 1;
while($producto['cantidad']>=$contar){
 echo  "<option value='".$contar."'style='color:black'>" . $contar . "</option>";
 $contar ++; 
}  
echo"</select><br><br>";
?>        
<input type="hidden" id="id_producto"
name="id_producto" value="<?php echo $producto['id_producto'];?>"/>
<input type="hidden" id="id_inventario"
name="id_inventario" value="<?php echo $producto['id_inventario'];?>"/>
<input type="hidden" id="precio"
name="precio" value="<?php echo $producto['precio'];?>"/>
<input type="hidden" id="cantidad"
name="cantidad" value="<?php echo $producto['cantidad'];?>"/>
<button type="submit" value="Comprar" name="venta" >Comprar</button>


</form>
</div>
<div>        
</div>
</nav> 
<?php
}
?>

</body>
</html>