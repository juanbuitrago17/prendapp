<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Login</title>
    <link href="stylePie.css" rel="stylesheet" />
    <link href="styleHeader.css" rel="stylesheet" />
    <link href="stylesCrear.css" rel="stylesheet" />
   <link href="styleTablasYBotones.css" rel="stylesheet" />
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">

<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.3.1/jquery.min.js"></script>
</head>
<header>
        <div class="ancho">
        <div class="logo">
            <img src="Imagenes/Prendapp-1.png" alt="Logo Empresa">
            <h1>PRENDAPP</h1>
            <h2 style="margin-left: 1400px;">COMPRA AQUI</h2>
        </div>
            <ul>
                <li><a href="#contacto">Contacto</a></li>
            </ul>
        </div>
    </header>
<body>
 <section class="form-d">
     <div class="form-c" >
			<div class="box">
    <h3 class="letras">Bienvenidos</h3>

  <center><img src="Imagenes/Prendapp-1.png" alt="Imagen de inicio de sesión" /></center>
 <form name="form11" method="post" action="login.php" >

    <div class="input-box" >
     <label for="usuario" class="letras">Usuario:</label>
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
     <label for="contrasena" class="letras">Contraseña:</label>
    <input type="password" name="contrasena"    class="input-control" ></input>
    <?php
   
    if($_SERVER["REQUEST_METHOD"] == "POST"){
        $contrasena = $_POST["contrasena"];
        if(empty($contrasena)){
            echo"<p class='p'>El campo es obligatorio</p>";
        }
    ?>
    <?php
    
    include_once "conexion.php";
    if($_SERVER["REQUEST_METHOD"] == "POST"){

    $usuario = $_POST["usuario"];
    $contrasena = $_POST["contrasena"];
    
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

        print_r($_SESSION);

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
        echo"<p class='p'>Usuario y/o contraseña no son validos</p>";
    }
  
}
mysqli_close($conn);
    }

?>
     </div>    
     <center><input type="submit" value="Ingresar" name="ingresa" class="button button2"></td> </center><br />

</form>
     <p class="letras">No tienes una cuenta?/<a href="creaUsuarioLogin.php" class="t-text">Crear cuenta </a></p>
    </div>
</div>
</section>
</body>
<footer style="min-height:30vh">
    <h2 id="contacto" >PRENDAPP</h2>
    <br>    
    <p class="pt">
        <img  class="img-t" src="Imagenes/Prendapp-1.png" alt="Descripción de la imagen">
        &nbsp;
        Bogota-Colombia
        310546986-3124596564&
        PRENDAPP@gmail.com
        </p>
        <br><br>
        <h5>Siguenos en Redes sociales</h5>
           
           
        <a href="https://www.facebook.com" class="social-icon" target="_blank"><i class="fab fa-facebook-f"></i></a>
        <a href="https://www.twitter.com" class="social-icon" target="_blank"><i class="fab fa-twitter"></i></a>
        <a href="https://www.instagram.com" class="social-icon" target="_blank"><i class="fab fa-instagram"></i></a>
        <a href="https://api.whatsapp.com/send?phone=1234567890" class="social-icon" target="_blank"><i class="fab fa-whatsapp"></i></a>
        <p class="py">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
            &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Copyright ©2023 My Website. Todos los derechos reservados a PRENDAPP.</p>
</footer>
</html>