<!DOCTYPE html>

<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Crear Usuario</title>
    <link href="stylesCrear.css" rel="stylesheet"/>
    <link href="styleTablas.css" rel="stylesheet"/>
</head>
<body>
    
    <section class="form-d">
        <div class="form-c" >
              <div class="box">

    
    <form name="form1" method="post" action="crearUsuario.php">
      
        <div class="input-box">
            <label for="cedula">Ingrese su cedula:</label>
            <input type="text" name="cedula"  class="input-control"></input>
            <?php
            $valida = true;
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $cedula = $_POST["cedula"];
                if(empty($cedula)){
                    echo"<p class='p'>El campo es obligatorio</p>";
                    $valida = false;
                }else{
                    if(!preg_match("/^\d{8,10}$/", $cedula)){
                        echo "<p class='p'>La cedula debe tener entre 8 y 10 dígitos</p>";
                        $valida = false;
                    }
                }
            }
            ?>
        </div>


        <div class="input-box">
            <label for="nombre">Ingrese su nombre completo:</label>
            <input type="text" name="nombre"  class="input-control"></input>
            <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $nombre = $_POST["nombre"];
                if(empty($nombre)){
                    echo"<p class='p'>El campo es obligatorio</p>";
                    $valida = false;
                    
                }else{
                    if(!preg_match("/^[a-zA-Z\s]+$/", $nombre)){
                        echo "<p class='p'>El campo no tiene el formato correcto</p>";
                        $valida = false;
                    } 
                }
            }
            
           ?>
            </div>
            <div class="input-box" >
                <label for="telefono">Ingrese su telefono:</label>
                <input type="text" name="telefono"  class="input-control" ></input>
                <?php
                    if ($_SERVER["REQUEST_METHOD"] == "POST") {
                        $telefono = $_POST["telefono"];
                        if (empty($telefono)) {
                            echo "<p style='color: red;'>El campo teléfono es obligatorio</p>";
                            $valida = false;
                        } else {
                            if (!preg_match("/^\d{10}$/", $telefono)) {
                                echo "<p style='color: red;'>El teléfono debe tener 10 dígitos</p>";
                                $valida = false;
                            }
                        }
                    }
                ?>
        </div>
           

            <div class="input-box" >
        <label for="correo">Ingrese un correo:</label>
      <input type="text" name="correo"   class="input-control" ></input>
      <?php
      if($_SERVER["REQUEST_METHOD"] == "POST"){
                $correo = $_POST["correo"];
                if(empty($correo)){
                    echo"<p class='p'>El campo es obligatorio</p>";
                    $valida = false;
                }else{
                    if (!preg_match("/^[a-zA-Z0-9._%+-]+@[a-zA-Z0-9.-]+\.[a-zA-Z]{2,}$/", $correo)){
                        echo "<p class='p'>El campo no es un correo</p>";
                        $valida = false;
                    } 
                }
            }
        ?>
         </div>
       
       <div class="input-box" >
       <label for="direccion">Ingrese su direccion:</label>
      <input type="text" name="direccion"  class="input-control" ></input>
      <?php
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            $direccion = $_POST["direccion"];
            if(empty($direccion)){
                echo "<p style='color: red;'>El campo direccion es obligatorio</p>"; 
                $valida = false;
            }
        }
      ?>
       </div>
      <div class="input-box">
       <label for="txtciudad">Ingrese su ciudad:</label>
      <input type="text" name="ciudad"   class="input-control" ></input>
      <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $ciudad = $_POST["ciudad"];
                if(empty($ciudad)){
                    echo"<p class='p'>El campo es obligatorio</p>";
                    $valida = false;
                }else{
                    if(!preg_match("/^[a-zA-Z\s]+$/", $ciudad)){
                        echo "<p class='p'>Ingrese una ciudad  válida</p>";
                        $valida = false;
                    }
                }
            }
            ?>
        </div>

          <div class="input-box" >
       <label for="username">Ingrese un usuario:</label>
      <input type="text" name="username" class="input-control" ></input>
      <?php
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $username = $_POST["username"];
            if (empty($username)) {
                echo "<p style='color: red;'>El campo usuario es obligatorio</p>";
                $valida = false;
            }
        }
        ?>
      </div>

      <div class="input-box" >
       <label for="password">Ingrese una contraseña:</label>
      <input type="password" name="password" ID="password"  class="input-control"  ></input>
      <?php
         if ($_SERVER["REQUEST_METHOD"] == "POST") {
            $password = $_POST["password"];
            if (empty($password)) {
                echo "<p style='color: red;'>El campo contraseña es obligatorio</p>";
                $valida = false;
            }
        }
      ?>
     
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
        
         <h3><a href="indexUsuario.php" class="t-text">VOLVER</a></h3>
        
     
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
        echo "<script>alert('Se registró el usuario'); window.location.href = 'indexUsuario.php';</script>";
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
</html>