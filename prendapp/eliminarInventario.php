<?php
include_once "conexion.php";
if (isset($_POST['id_inventario'])) {
    $id_inventario = $_POST['id_inventario'];

    $sql = "DELETE FROM inventario WHERE  id_inventario = '$id_inventario'";
    
    if (mysqli_query($conn, $sql)) {
        
        
echo "<script>alert('Inventario eliminado correctamente'); window.location.href = 'indexInventario.php';</script>";
    } else {
        echo "Error al intentar eliminar el usuario: " . mysqli_error($conn);
    }
} else {
    echo "No se proporcionó el parámetro 'cedula' en la URL.";
}

mysqli_close($conn);
?>