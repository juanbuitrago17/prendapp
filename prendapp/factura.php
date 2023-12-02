<?php
session_start();
$usuario = $_SESSION['cedula'];
$rol = $_SESSION["rol"];

if(empty($usuario) || empty($rol)){
    header('Location:login.php');
}
?>

<!DOCTYPE html>
<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Factura</title>
</head>
<body>
<nav> 
    <br><br />
    <br />
<h1>FACTURA</h1>
<br/><br/>
<?php
include_once "conexion.php";
$idVenta = $_GET['id_producto'];
$idProducto = $_GET['id_venta'];
if(!empty($idVenta)){
   $sql = "SELECT * FROM venta WHERE id_venta =". $idVenta;

    $resultado=$conn->query($sql); 
    

    $factura = $resultado->fetch_assoc();
   
}
mysqli_close($conn);
?>
<h3> nombre : <?php echo $usuario;?></h3>
<h3> Id_factura: <?php echo $factura['id_venta']?></h3>
<h3>fechaCreacion:<?php echo $factura['fechaCreacion']?></h3>
<h3>nombre del producto:<?php echo $idProducto?></h3>
<h3>Cantidad de productos:<?php echo $factura['cantidadProductos']?></h3>
<h3>Total:<?php echo $factura['total']?></h3>

<?php
$id_venta =$factura['id_venta'];
$fechaCreacion = date("Y-m-d");
$totalCompra = $factura['total'];
$cantidaProductos = $factura['cantidadProductos'];
include_once "conexion.php";
$sqlInsert= "INSERT INTO factua(id_venta,fechaCreacion,totalCompra,cantidadProductos) VALUES ('$id_venta','$fechaCreacion','$totalCompra','$cantidadProductos')";
mysqli_query($conn, $sqlInsert);
mysqli_close($conn);
?>
</body>
</html>