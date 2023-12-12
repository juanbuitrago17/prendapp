<?php
include_once "conexion.php";
if($_SERVER["REQUEST_METHOD"] == "POST"){
    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];
    if(empty($usuario)){
        header("Location: login.php?error=1");  
        }
    if(empty($contrasena)){
        header("Location: login.php?error=2");     
    }
    $consulta= "SELECT * FROM usuario WHERE username='$usuario' AND password='$contrasena' ";
    $resultado=$conn->query($consulta);
    if ($resultado->num_rows == 1){
        $fila = $resultado->fetch_assoc();
        session_start();
        $rolActual = $fila["rol"];
        $cedula = $fila["cedula"];
        $nombreUsuario = $fila["nombre"];
        $_SESSION["usuario"]=$fila["username"];
        $_SESSION["rol"] = $rolActual;
        $_SESSION["cedula"] = $cedula;
        $_SESSION["nombre"] = $nombreUsuario;
        switch($rolActual){
            case 'CLIENTE':
            case 'VENDEDOR':
                header("Location: paginaClientes.php");
                break;
            case 'ADMINISTRADOR':
                header("Location: indexUsuario.php");
                break;
        }
    }else {
    header("Location: login.php?error=3");    
}
}
mysqli_close($conn);
    
    
?>
