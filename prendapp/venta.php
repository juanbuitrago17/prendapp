<?php
session_start();
$cedula = $_SESSION['cedula'];
$rol = $_SESSION["rol"];

if(empty($cedula) || empty($rol)){
    header('Location:login.php');
}
?>

<?php
print_r($_POST);

if(isset($_POST["venta"] )){
$id_producto = $_POST["id_producto"];
    include_once "conexion.php";

    $id_inventario = $_POST['id_inventario'];
    $fechaCreacion = date("Y-m-d");
    $cantidadProductos = $_POST["cantidad_producto"];
    $total = $cantidadProductos * $_POST['precio'];
    
    $sql= "INSERT INTO venta(cedula,id_inventario,fechaCreacion,cantidadProductos,total) VALUES ('$cedula','$id_inventario','$fechaCreacion','$cantidadProductos','$total')";
    if (mysqli_query($conn, $sql)) { 

    $id_venta = mysqli_insert_id($conn);
    

    
    $cantidadNueva = $_POST['cantidad'] - $cantidadProductos;
    $fechaActualizacion = date("Y-m-d");
    $actualize ="UPDATE inventario SET cantidad='$cantidadNueva', fechaActualizacion='$fechaActualizacion' WHERE id_inventario='$id_inventario'";
    if (mysqli_query($conn, $actualize)) { 
        
    }
    ?>


   <center> <a class='active' href='paginaClientes.php' >Volver</a></center>
   </center><input type="button" name="General" value="Imprimir P&aacute;gina" onclick="window.print();"></center>
    <?php
}
   
    mysqli_close($conn);
    
}
?> 