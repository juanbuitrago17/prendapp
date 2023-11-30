<?php
include_once "conexion.php";
if (isset($_POST['id_venta'])) {
    $id_venta = $_POST['id_venta'];

    $sql = "DELETE FROM venta WHERE  id_venta = '$id_venta'";
    
    if (mysqli_query($conn, $sql)) {
        
        
echo "<script>alert('venta eliminada correctamente'); window.location.href = 'indexVenta.php';</script>";
    } else {
        echo "Error al intentar eliminar la venta: " . mysqli_error($conn);
    }
} else {
    echo "No se proporcionó el parámetro 'id_venta' en la URL.";
}

mysqli_close($conn);
?>