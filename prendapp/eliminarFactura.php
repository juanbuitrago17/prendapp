<?php
include_once "conexion.php";
if (isset($_POST['id_factura'])) {
    $id_factura = $_POST['id_factura'];

    $sql = "DELETE FROM factura WHERE  id_factura = '$id_factura'";
    
    if (mysqli_query($conn, $sql)) {
        
        
echo "<script>alert('factura eliminada correctamente'); window.location.href = 'indexFactura.php';</script>";
    } else {
        echo "Error al intentar eliminar la venta: " . mysqli_error($conn);
    }
} else {
    echo "No se proporcionó el parámetro 'id_factura' en la URL.";
}

mysqli_close($conn);
?>