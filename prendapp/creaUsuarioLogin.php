<!DOCTYPE html>

<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Crear Usuario</title>
    <link href="stylePie.css" rel="stylesheet" />
    <link href="styleHeader.css" rel="stylesheet" />
    <link href="stylesCrear.css" rel="stylesheet" />
    <link href="styleTablasYBotones.css" rel="stylesheet">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">

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

    
    <form name="form1" method="post" action="crearUsuario.php" onsubmit="return validarFormulario()">
      
        <div class="input-box">
            <label for="cedula">Ingrese su cedula:</label>
            <input type="text" id="cedula" name="cedula"  class="input-control"></input>
            <span class="p" id="cedulaError"></span>
        </div>


        <div class="input-box">
            <label for="nombre">Ingrese su nombre completo:</label>
            <input type="text" id="nombre" name="nombre"  class="input-control"></input>
            <span class="p" id="nombreError"></span>
            </div>
            
            <div class="input-box" >
                <label for="telefono">Ingrese su telefono:</label>
                <input type="text" id="telefono" name="telefono"  class="input-control" ></input>
               <span class="p" id="telefonoError"></span>
        </div>
           

            <div class="input-box" >
        <label for="correo">Ingrese un correo:</label>
      <input type="text" id="correo" name="correo"   class="input-control" ></input>
      <span class="p" id="correoError"></span>
         </div>
       
       <div class="input-box" >
       <label for="direccion">Ingrese su direccion:</label>
      <input type="text" id="direccion" name="direccion"  class="input-control" ></input>
      <span class="p" id="direccionError"></span>
       </div>
       
      <div class="input-box">
       <label for="txtciudad">Ingrese su ciudad:</label>
      <input type="text" id="ciudad" name="ciudad"   class="input-control" ></input>
      <span class="p" id="ciudadError"></span>
        </div>

          <div class="input-box" >
       <label for="username">Ingrese un usuario:</label>
      <input type="text" id="username name="username" class="input-control" ></input>
      <span class="p" id="usernameError"></span>
      </div>

      <div class="input-box" >
       <label for="password">Ingrese una contraseña:</label>
      <input type="password"  id=password name="password" ID="password"  class="input-control"  ></input>
      <span class="p" id="passwordError"></span>
     
      </div>
    <div class="input-box">
    <label for="confirmacion">Confirme la contraseña:</label>
    <input type="password" name="confirmacion" ID="confirmacion" class="input-control"></input>
    <?php
         if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $confirmacion = $_POST["confirmacion"];
            $password = $_POST["password"];

            if (empty($confirmacion) || $password !== $confirmacion) {
                echo "<p style='color: red;'>Las contraseñas no coinciden</p>";
                $valida = false;
            }
        }
      ?>
     
    </div>
    <center>
    <button type="button" onclick="togglePasswordVisibility()" class='button button2'>
        Mostrar/ocultar contraseña
    </button>
    </center>
            
        <br/><br />
       
      <center><input type="submit" value="CREAR" name="crearUsuarios" class="button button2"></td> </center><br />
       
        <br />
        
         <h3><a href="login.php" class="t-text">VOLVER</a></h3>
        
     
    </form>
     
    </div>
    </div>
		
	</section>
    <script>
    function togglePasswordVisibility() {
        var password = document.getElementById("password");
        var confirmacion = document.getElementById("confirmacion");
        if (password.type === "password") {
            password.type = "text";
        } else {
            password.type = "password";
        }
        
        if (confirmacion.type === "password") {
            confirmacion.type = "text";
        } else {
            confirmacion.type = "password";
        }

    }
   
</script>
<?php
if(isset($_POST["crearUsuarios"])){
    $cedula = $_POST["cedula"];
    $nombre = $_POST["nombre"];
    $fechaCreacion = date("Y-m-d");
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];
    $direccion= $_POST["direccion"];
    $ciudad = $_POST["ciudad"];
    $usuario = $_POST["username"];
    $password = $_POST["password"];

    if($valida == True){
    include_once "conexion.php";
    $sql= "INSERT INTO usuario(cedula,nombre,fechaCreacion,telefono,correo,direccion,ciudad,username,password) VALUES ('$cedula','$nombre','$fechaCreacion','$telefono','$correo','$direccion','$ciudad','$usuario','$password')";


    function seCreo(){
        $paginaDestino = "login.php";
        echo "<script>alert('Se registró el usuario'); window.location.href ='$paginaDestino';</script>";
    }
    function noSeCreo() {
        echo "<script>alert('No se pudo registrar el usuario');</script>";
    }
    if (mysqli_query($conn, $sql)) {
        echo seCreo();
    } else {
        echo noSeCreo();
    }
    mysqli_close($conn);
}
}
?>
</body>
<script>
    function validarFormulario(){
        document.getElementById("cedulaError").textContent = "";
        document.getElementById("nombreError").textContent = "";
        document.getElementById("telefonoError").textContent = "";
        document.getElementById("correoError").textContent = "";
        document.getElementById("direccionError").textContent = "";
        document.getElementById("ciudadError").textContent = "";
        document.getElementById("usernameError").textContent = "";
        document.getElementById("passwordError").textContent = "";
       
        var cedula = document.getElementById('cedula').value;
        if(cedula.trim()== ""){
            document.getElementById("cedulaError").textContent = "La cedula es requerida";
            return false;
        }else if(!/^\d{8,10}$/.test(cedula)){
            document.getElementById("cedulaError").textContent = "La cedula debe tener entre 8 y 10 dígitos";
            return false;
        }
        
        var nombre = document.getElementById('nombre').value;
        if(nombre.trim()== ""){
            document.getElementById("nombreError").textContent = "El nombre es requerido";
            return false;
        }else if(!/^[a-zA-Z\s]+$/.test(nombre)){
             document.getElementById("nombreError").textContent = "El nombre solo debe contener letras ";
            return false;
        }
        
        var telefono = document.getElementById('telefono').value;
        if(telefono.trim()== ""){
            document.getElementById("telefonoError").textContent = "El telefono es requerido";
            return false;
        }else if(!/^\d{10}$/.test(telefono)){
             document.getElementById("telefonoError").textContent = "El teléfono debe tener 10 dígitos";
            return false;
        }
        
        var correo = document.getElementById('correo').value;
        if(correo.trim()== ""){
            document.getElementById("correoError").textContent = "El correo es requerido";
            return false;
        }else if(!/^\w+([\.-]?\w+)*@\w+([\.-]?\w+)*(\.\w{2,3})+$/.test(correo)){
             document.getElementById("correoError").textContent = "El correo electrónico no es válido";
            return false;
        }
        
        var direccion = document.getElementById('direccion').value;
        if(direccion.trim()== ""){
            document.getElementById("direccionError").textContent = "La direccion es requerida";
            return false;
        }
        
         var ciudad = document.getElementById('ciudad').value;
        if(ciudad.trim()== ""){
            document.getElementById("ciudadError").textContent = "La ciudad es requerida";
            return false;
        }else if(!/^[a-zA-Z\s]+$/.test(ciudad)){
             document.getElementById("ciudadError").textContent = "La ciudad no debe tener numeros";
            return false;
        }
        
         var username = document.getElementById('username').value;
        if(username.trim()== ""){
            document.getElementById("username").textContent = "El usuario es requerido";
            return false;
        }
        
         var password = document.getElementById('password').value;
        if(password.trim()== ""){
            document.getElementById("password").textContent = "La contraseña es requerida";
            return false;
        }
        
        return  true;
    }
</script>
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