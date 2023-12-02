<?php
include_once "conexion.php";
if (isset($_POST['cedula'])) {
    $cedula = $_POST['cedula'];

    $sql = "DELETE FROM usuario WHERE cedula = '$cedula'";
    
    if (mysqli_query($conn, $sql)) {
        
        
echo "<script>alert('Usuario eliminado correctamente'); window.location.href = 'indexUsuario.php';</script>";
    } else {
        echo "Error al intentar eliminar el usuario: " . mysqli_error($conn);
    }
} else {
    echo "No se proporcionó el parámetro 'cedula' en la URL.";
}

mysqli_close($conn);
?>