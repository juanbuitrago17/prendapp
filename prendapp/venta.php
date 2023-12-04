<?php
session_start();
$cedula = $_SESSION['cedula'];
$rol = $_SESSION["rol"];
$nombreUsuario = $_SESSION["nombre"];

if(empty($cedula) || empty($rol)){
    header('Location:login.php');
}
?>
<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Factura</title>
<link href="styleFactura.css" rel="stylesheet"/>
<body>
<?php

if(isset($_POST["venta"] )){
$id_producto = $_POST["id_producto"];
$nombreProducto = $_POST["nombre"];
$precioProducto = $_POST['precio'];
    include_once "conexion.php";

    $id_inventario = $_POST['id_inventario'];
    $fechaCreacion = date("Y-m-d");
    $cantidadProductos = $_POST["cantidad_producto"];
    $total = $cantidadProductos * $precioProducto;
    
    $sql= "INSERT INTO venta(cedula,id_inventario,fechaCreacion,cantidadProductos,total) VALUES ('$cedula','$id_inventario','$fechaCreacion','$cantidadProductos','$total')";
    if (mysqli_query($conn, $sql)) { 

        $id_venta = mysqli_insert_id($conn);
    

    
    $cantidadNueva = $_POST['cantidad'] - $cantidadProductos;
    $fechaActualizacion = date("Y-m-d");
    $actualize ="UPDATE inventario SET cantidad='$cantidadNueva', fechaActualizacion='$fechaActualizacion' WHERE id_inventario='$id_inventario'";
    if (mysqli_query($conn, $actualize)) { 
        
    

    $sqlFactura = "INSERT INTO factura(id_venta,fechaCreacion,totalCompra,cantidadProductos) VALUES ('$id_venta','$fechaCreacion','$total','$cantidadProductos')";
    if (mysqli_query($conn, $sqlFactura)){

    $id_factura = mysqli_insert_id($conn);
    
    }
    ?>
    <div class="factura">
  <div class="logo">
    <img src="Imagenes/Prendapp-1.png" alt="Logo empresa">
  </div>
  <div class="consecutivo">Factura - <?php echo $id_factura; ?></div>
  <div class="detalles">
    <div><strong>Fecha Comprador:</strong> <?php echo $fechaCreacion; ?></div>
    <div><strong>Nombre Comprador:</strong> <?php echo $nombreUsuario ?></div>
  </div>
  <div class="productos">
    <div class="producto cabecera">    
      <div>Id</div>
      <div>Nombre</div>
      <div>Cantidad</div>
      <div>Precio Unitario</div>
    </div>
    <div class="producto">    
      <div><?php echo $id_producto; ?></div>
      <div><?php echo $nombreProducto; ?></div>
      <div><?php echo $cantidadProductos; ?></div>
      <div><?php echo $precioProducto; ?></div>
    </div>
  </div>
  <div class="producto totales">
    <div></div>
    <div></div>
    <div>Total</div>
    <div><?php echo $total; ?></div>
  </div>
  
  <div class="acciones">
    <button id="imprimir" onclick="window.print();">Imprimir</button><br/>
  </div>
</div>
    <div>
   <center> <a class='active' href='paginaClientes.php' style="text-decoration:none;">Volver</a></center>
    <?php
    }
}
   
    mysqli_close($conn);
    
}
?> 
</body>
</html>