<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Pagina de inicio</title>
    <link href="stylesCrear.css" rel="stylesheet" />
    <link href="stylesTablas.css" rel="stylesheet">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<body>
 <section class="form-d">
     <div class="form-c" >
			<div class="box">
    <h3>Bienvenidos</h3>

  <center><img src="Imagenes%20cliente/Prendapp-1.png" alt="Imagen de inicio de sesión" /></center>
 <form name="form11" method="post" action="login.php" >

    <div class="input-box" >
     <label for="usuario">Usuario:</label>
    <input type="text" name="usuario"   class="input-control" ></input>
    <?php
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $usuario = $_POST["usuario"];
        if(empty($usuario)){
            echo"<p class='p'>El campo es obligatorio</p>";
        }
    }    
    ?>
    </div>
        
      <div class="input-box" >
     <label for="contrasena">Contraseña:</label>
    <input type="password" name="contrasena"    class="input-control" ></input>
    <?php
   
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $contrasena = $_POST["contrasena"];
        if(empty($contrasena)){
            echo"<p class='p'>El campo es obligatorio</p>";
        }
    ?>
    <?php
    
    session_start();
    include_once "conexion.php";
    if($_SERVER["REQUEST_METHOD"] == "POST"){

    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];
    
    $consulta= "SELECT * FROM usuario WHERE username='$usuario' AND password='$contrasena' ";
    $resultado=$conn->query($consulta);
    
    if ($resultado->num_rows == 1){
        $_SESSION["usuario"]=$usuario;
        if($usuario == "juanpablo17" && $contrasena == "1234567"){
            header("Location: indexUsuario.php");
        }else{
            header("Location: paginaClientes.php");
        }
        
    }else {
        echo"<p class='p'>Usuario y/o contraseña no son validos</p>";
    }
  
}
mysqli_close($conn);
    }

?>
     </div>    
     <center><input type="submit" value="Ingresar" name="ingresa" class="button button2"></td> </center><br />

</form>
     <p>No tienes una cuenta?/<a href="creaUsuarioLogin.php" class="t-text">Crear cuenta </a></p>
    </div>
</div>
</section>
</body>
</html>