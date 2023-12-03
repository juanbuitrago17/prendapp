<?php
session_start();
$cedula = $_SESSION['cedula'];
$rol = $_SESSION["rol"];

if(empty($cedula) || empty($rol)){
    header('Location:login.php');
}
?>

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

    echo "Numero de factura: " . $id_factura."<br/>";
    echo "Fecha de compra: ". $fechaCreacion."<br/>";
    echo "Nombre del producto: ".$nombreProducto."<br/>"; 
    echo "Cantidad de productos comprados: ".$cantidadProductos."<br/>";
    echo "Presio unitario: ". $precioProducto."<br/>";
    echo "Total de la compra: ".  $total."<br/>";
    ?>

   <center> <a class='active' href='paginaClientes.php' >Volver</a></center>
   </center><input type="button" name="General" value="Imprimir P&aacute;gina" onclick="window.print();"></center>
    <?php
    }
}
   
    mysqli_close($conn);
    
}
?> 