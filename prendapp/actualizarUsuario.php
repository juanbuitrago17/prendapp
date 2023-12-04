<?php
session_start();
$cedula = $_SESSION['cedula'];

if(empty($cedula)){
    header('Location:login.php');
}
?>


<!DOCTYPE html>

<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Actualizar Usuario</title>
    <link href="stylesCrear.css" rel="stylesheet" />
    <link href="styleTablas.css" rel="stylesheet">
</head>
<body>
<?php
include_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['cedula'])) {
    $cedula = $_POST['cedula'];

    $sql = "SELECT * FROM usuario WHERE cedula = '$cedula'";
    $result = mysqli_query($conn, $sql);

    if ($result !== false && mysqli_num_rows($result) > 0) {
        $usuario = mysqli_fetch_assoc($result);
    }
}
?>      
    <section class="form-d">
        <div class="form-c" >
              <div class="box">

    
    <form name="form2" method="post" action="actualizarUsuario.php">
      
        <div class="input-box">
            <label for="cedula">Ingrese su cedula:</label>
            <input type="text" name="cedula" value="<?php echo isset($usuario['cedula']) ? $usuario['cedula'] : ''; ?>"  class="input-control"></input>
            <?php
            $valida = true;
            if (isset($_POST["actualizarUsuarios"])) {
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
        }
            ?>
        </div>


        <div class="input-box">
            <label for="nombre">Ingrese su nombre:</label>
            <input type="text" name="nombre" value="<?php echo isset($usuario['nombre']) ? $usuario['nombre'] : ''; ?>"  class="input-control"></input>
            <?php
            if (isset($_POST["actualizarUsuarios"])) {
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
        }
            
           ?>
            </div>

          <div class="input-box" >
       <label for="telefono">Ingrese su telefono:</label>
      <input type="text" name="telefono" value="<?php echo isset($usuario['telefono']) ? $usuario['telefono'] : ''; ?>"  class="input-control" ></input>
      <?php 
      if (isset($_POST["actualizarUsuarios"])) {
        $telefono = $_POST["telefono"];
            if ($_SERVER["REQUEST_METHOD"] == "POST") {
                
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
        }
        ?>
        </div>

        <div class="input-box" >
        <label for="correo">Ingrese un correo:</label>
      <input type="text" name="correo"  TextMode="Email" value="<?php echo isset($usuario['correo']) ? $usuario['correo'] : ''; ?>" class="input-control" ></input>
      <?php

      if (isset($_POST["actualizarUsuarios"])) {
        $correo = $_POST["correo"];
      if($_SERVER["REQUEST_METHOD"] == "POST"){
               
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
        }
        ?>
         </div>
       
       <div class="input-box" >
       <label for="direccion">Ingrese su direccion:</label>
      <input type="text" name="direccion" value="<?php echo isset($usuario['direccion']) ? $usuario['direccion'] : ''; ?>"  class="input-control" ></input>
      <?php
      if (isset($_POST["actualizarUsuarios"])) {
        $direccion = $_POST["direccion"];
        if($_SERVER["REQUEST_METHOD"] == "POST"){
            
            if(empty($direccion)){
                echo "<p style='color: red;'>El campo direccion es obligatorio</p>"; 
                $valida = false;
            }
        }
    }
      ?>
       </div>
      <div class="input-box">
       <label for="txtciudad">Ingrese su ciudad:</label>
      <input type="text" name="ciudad" value="<?php echo isset($usuario['ciudad']) ? $usuario['ciudad'] : ''; ?>"   class="input-control" ></input>
      <?php
      if (isset($_POST["actualizarUsuarios"])) {
            $ciudad = $_POST["ciudad"];
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                if(empty($ciudad)){
                    echo"<p class='p'>El campo ciudad es obligatorio</p>";
                    $valida = false;
                }else{
                    if(!preg_match("/^[a-zA-Z\s]+$/", $ciudad)){
                        echo "<p class='p'>Ingrese una ciudad  válida</p>";
                        $valida = false;
                    }
                }
            }
        }
            ?>
 </div>
          <div class="input-box" >
       <label for="username">Ingrese un usuario:</label>
      <input type="text" name="username" value="<?php echo isset($usuario['username']) ? $usuario['username'] : ''; ?>" class="input-control" ></input>
      <?php
      if (isset($_POST["actualizarUsuarios"])) {
        $usuario = $_POST["username"];
        if ($_SERVER["REQUEST_METHOD"] == "POST") {
            
            if (empty($usuario)) {
                echo "<p style='color: red;'>El campo usuario es obligatorio</p>";
                $valida = false;
            }
        }
    }
        ?>
      </div>

                <center><input type="submit" value="Actualizar" name="actualizarUsuarios" class="button button2"></td> </center><br />
       
       <br />
       
        <h3><a href="indexUsuario.php" class="t-text">VOLVER</a></h3>
       
    
   </form>   
        

            </form>
        </div>
    
    </div>
</div>
</section>

<?php
if (isset($_POST["actualizarUsuarios"])) {
    $cedula = $_POST["cedula"];
    $nombre = $_POST["nombre"];
    $telefono = $_POST["telefono"];
    $correo = $_POST["correo"];
    $direccion= $_POST["direccion"];
    $ciudad = $_POST["ciudad"];
    $usuario = $_POST["username"];

    if($valida == True){
    include_once "conexion.php";
    $sql = "UPDATE usuario SET cedula='$cedula', nombre='$nombre',telefono='$telefono', correo='$correo',  direccion='$direccion',ciudad='$ciudad',username='$usuario' WHERE cedula='$cedula'";
 
    function seCreo()
    {
        echo "<script>alert('Se actualizo el usuario'); window.location.href = 'indexUsuario.php';</script>";
    }

    function noSeCreo()
    {
        echo "<script>alert('No se pudo actualizar el usuario');</script>";
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