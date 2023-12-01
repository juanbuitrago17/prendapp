<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link href="stylesCrud.css" rel="stylesheet">
    <link href="stylesTablas.css" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Muli:300,700&display=swap" rel="stylesheet">
    <link href="https://unpkg.com/ionicons@4.5.10-0/dist/css/ionicons.min.css" rel="stylesheet">
    <title>BASE DE DATOS</title>
</head>
<body>
<div class="d-flex" id="content-wrapper">
        <div id="sidebar-container" class="bg-primary">
            <div class="logo"> <img src="Imagenes%20cliente/Prendapp-1.png" alt="Logo Empresa" style="height: 58px; width: 86px" />
                <h4 class="text-light font-weight-bold mb-0" >DATOS</h4>
            </div>
            <div class="menu">
                <a href="indexInventario.php" class="d-block text-light p-3 border-0"><i class="icon ion-md-settings lead mr-2"></i>
                    INVENTARIO</a>
                <a href="indexFactura.php" class="d-block text-light p-3 border-0"><i class="icon ion-md-settings lead mr-2"></i>
                    FACTURA</a>
                <a href="indexProducto.php" class="d-block text-light p-3 border-0"><i class="icon ion-md-settings lead mr-2"></i>
                    PRODUCTO</a>
                <a href="indexVenta.php" class="d-block text-light p-3 border-0"><i class="icon ion-md-settings lead mr-2"></i>
                    VENTA</a>
                
            </div>
        </div>

        <div class="w-100">
            <nav class="navbar navbar-expand-lg navbar-light bg-light border-bottom">
                <div class="container">

                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                        aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
                        <span class="navbar-toggler-icon"></span>
                    </button>

                    <div class="collapse navbar-collapse" id="navbarSupportedContent">
                        <form class="form-inline position-relative d-inline-block my-2">
                        </form>
                        <ul class="navbar-nav ml-auto mt-2 mt-lg-0">
                            <li class="nav-item dropdown">

                                <a class="nav-link text-dark dropdown-toggle" href="#" id="navbarDropdown" role="button"
                                    data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                    <img src="Imagenes%20cliente/user.png" class="img-fluid rounded-circle avatar mr-2"
                                        alt="https://generated.photos/" />
                                    <styl style="color: aliceblue;">
                                    Menu
                                </a>
                                <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <div class="dropdown-divider"></div>
                                    <a class="dropdown-item" href="cerrarSesion.php">Cerrar sesion</a>
                                    </div>
                            </li>
                        </ul>
                    </div>
                </div>
            </nav>
            <div id="content" class="bg-grey w-100">

                <section class="bg-light py-3">
                    <div class="container">
                        <div class="row">
                            <div class="col-lg-9 col-md-8">
                                <h1 class="font-weight-bold mb-0" style="color: aliceblue;">Bienvenido:</h1>
                                <p class="lead text-muted">Listado De Usuarios</p>
    <?php
    include_once "conexion.php";

    $sql= mysqli_query($conn,"SELECT * FROM usuario");
    if($sql !== false){
        if(mysqli_num_rows($sql)> 0){
            echo "<br><input type='button' value='Crear' name='agregar' onclick='paginaRegistro()' class='button '>";
            echo "<table><tr><th>Cedula</th></th><th>Nombre</th><th>FechaCreacion</th><th>edad</th><th>Telefono</th><th>Correo</th><th>Direccion</th><th>Ciudad</th><th>Username</th><th>Rol</th><th>Actualizar</th><th>Eliminar</th></tr>";
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
            <button type='submit' class='a button3' onclick='return confirm(\"¿Estás seguro de que quieres actualizar este usuario?\")'>Actualizar</button>
            </form></td>
            <td><form method='post' action='eliminarUsuario.php'>
            <input type='hidden' name='cedula' value='".$mostrar['cedula']."'>
            <button type='submit' class='a button3' onclick='return confirm(\"¿Estás seguro de que quieres eliminar este usuario?\")'>Eliminar</button>
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
<script>
    function paginaRegistro(){
        window.location = "crearUsuario.php";   
    }
</script>
<script src="https://code.jquery.com/jquery-3.3.1.slim.min.js"
    integrity="sha384-q8i/X+965DzO0rT7abK41JStQIAqVgRVzpbzo5smXKp4YfRvH+8abtTE1Pi6jizo"
    crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"
    integrity="sha384-UO2eT0CpHqdSJQ6hJty5KVphtPhzWj9WO1clHTMGa3JDZwrnQq4sF86dIHNDz0W1"
    crossorigin="anonymous"></script>
<script src="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"
    integrity="sha384-JjSmVgyd0p3pXB1rRibZUAYoIIy6OrQ6VrjIEaFf/nJGzIxFDsf4x0xIM+B07jRM"
    crossorigin="anonymous"></script>
<script src="https://cdn.jsdelivr.net/npm/chart.js@2.9.3/dist/Chart.min.js" integrity="sha256-R4pqcOYV8lt7snxMQO/HSbVCFRPMdrhAFMH+vr9giYI=" crossorigin="anonymous"></script>
<script src="Javascr/mov.js"></script>
</body>
</html>