<?php
session_start();
$usuario = $_SESSION['usuario'];
$rol = $_SESSION["rol"];

if(empty($usuario) || empty($rol)){
    header('Location:login.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-1BmE4kWBq78iYhFldvKuhfTAU6auU8tT94WrHftjDbrCEXSU1oBoqyl2QvZ6jIW3" crossorigin="anonymous">
    <link rel="stylesheet" href="tablas.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    <title>BASE DE DATOS</title>
</head>
<body>

<nav class="navbar navbar-light bg-ligh fixed-top"  style="background-color:purple;" >
  <div class="container-fluid"  >
    <a class="navbar-brand" href="#" >
        <img src="imagenes/Prendapp-1.png" alt="logo" width="80" height="50">PRENDAPP
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h5 class="offcanvas-title" id="offcanvasNavbarLabel">Datos</h5>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body" style="background-color:#eeeeee;">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Usuarios</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Inventario</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Productos</a>
          </li>
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="#">Ventas</a>
          </li>
          
            <li class="nav-item dropdown">
                <a class="nav-link dropdown-toggle" href="#" id="offcanvasNavbarDropdown" role="button" data-bs-toggle="dropdown" aria-expanded="false">
                Menu de inicio
                </a>
                <ul class="dropdown-menu" aria-labelledby="offcanvasNavbarDropdown">
                <li><a class="dropdown-item" href="login.php">Cerrar Sesion</a></li>
                <li>
                    <hr class="dropdown-divider">
                </li>
                
            </li>
        </ul>
       
      </div>
    </div>
  </div>
</nav>


    <?php
    include_once "conexion.php";

    $sql= mysqli_query($conn,"SELECT * FROM usuario");
    if($sql !== false){
        if(mysqli_num_rows($sql)> 0){
            echo "<br><input type='button' value='Crear' name='agregar' onclick='paginaRegistro()' style='position: absolute;top: 50%; right:450px;'class='button  '>";
            echo "<table>
            echo <thead>
            <tr>
            <th>Cedula</th><th>Nombre</th>
            <th>FechaCreacion</th>
            <th>edad</th>
            <th>Telefono</th>
            <th>Correo</th>
            <th>Direccion</th>
            <th>Ciudad</th>
            <th>Username</th>
            <th>Rol</th>
            <th>Actualizar</th>
            <th>Eliminar</th>
            </tr>";
            while ($mostrar = mysqli_fetch_assoc($sql)){ 
            echo "<tr><td>".$mostrar['cedula']. "</td>
            <td>".$mostrar['nombre']. "</td>
            <td>".$mostrar['fechaCreacion']. "</td>
            <td>".$mostrar['edad']. "</td>
            <td>".$mostrar['telefono']. "</td>
            <td>".$mostrar['correo']. "</td>
            <td>".$mostrar['direccion']. "</td>
            <td>".$mostrar['ciudad']. "</td>
            <td>".$mostrar['username']. "</td>
            <td>".$mostrar['rol']. "</td>
            <td><form method='post' action='actualizarUsuario.php'>
            <input type='hidden' name='cedula' value='".$mostrar['cedula']."'>
            <button  type='submit' class='btn-primary'><a href=''style='color:black'  onclick='return confirm(\"¿Estás seguro de que quieres actualizar este usuario?\")'>Actualizar</button>
            </form></td>
            <td><form method='post' action='eliminarUsuario.php'>
            <input type='hidden' name='cedula' value='".$mostrar['cedula']."'>
            <button type='submit' class='btn-danger'><a href=''style='color:black' onclick='return confirm(\"¿Estás seguro de que quieres eliminar este usuario?\")'>Eliminar</button>
            </form></td></tr>";
            }
        }
            echo "</table>";
}
            
   
    else {
        echo "Error al ejecutar la tabla: ".mysqli_error($conn);
    }
    mysqli_close($conn);

   

?>
<br><br><br><br>
<br><br><br><br>
<br><br><br><br>

<footer class="pie-pagina">
            <h2 class="h-2">PRENDAPP</h2>
            
           
            <br>
           
            <p class="pt" style="font-size: 12px;" >
            <img  class="img-t" src="imagenes/Prendapp-1.png" alt="Descripción de la imagen">
            &nbsp;
            Bogota-Colombia
            310546986-3124596564&
            PRENDAPP@gmail.com
            </p>
            <br>
           <h5 style="font-size: 12px; color:white;" >Siguenos en Redes sociales</h5>
           
           
           
            <a href="https://www.facebook.com" class="social-icon" target="_blank"><i class="fab fa-facebook-f"></i></a>
            <a href="https://www.twitter.com" class="social-icon" target="_blank"><i class="fab fa-twitter"></i></a>
            <a href="https://www.instagram.com" class="social-icon" target="_blank"><i class="fab fa-instagram"></i></a>
            <a href="https://api.whatsapp.com/send?phone=1234567890" class="social-icon" target="_blank"><i class="fab fa-whatsapp"></i></a>
            <br>
            <p class="pi">&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;
                &nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;&nbsp;Copyright ©2023 My Website. Todos los derechos reservados a PRENDAPP.</p>
        </footer>

 

    
<script>
    function paginaRegistro(){
        window.location = "crearUsuario.php";   
    }
</script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>

</body>
</html>