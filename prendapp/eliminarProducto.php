<?php
include_once "conexion.php";
if (isset($_POST['id_producto'])) {
    $id_producto = $_POST['id_producto'];

    $sql = "DELETE FROM producto WHERE id_producto = '$id_producto'";
    
    if (mysqli_query($conn, $sql)) {
        
        
echo "<script>alert('Producto eliminado correctamente'); window.location.href = 'indexProducto.php';</script>";
    } else {
        echo "Error al intentar eliminar el usuario: " . mysqli_error($conn);
    }
} else {
    echo "No se proporcionó el parámetro 'id_producto' en la URL.";
}

mysqli_close($conn);
?>