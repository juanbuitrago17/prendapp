<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PRENDAPP</title>
    <link href="stylesPagina.css" rel="stylesheet" />
    <link href="stylesImagenes.css" rel="stylesheet" />
    <link href="stylesTablas.css" rel="stylesheet">
</head>
<body>
    <header>
        <div class="ancho">
        <div class="logo">
            <img src="Imagenes%20cliente/Prendapp-1.png" alt="Logo Empresa"/>
            <h1>PRENDAPP</h1>
            <h2>COMPRA AQUI</h2>
        </div>
            <ul>
                <li><a href="#nostros">Nosotros</a></li>
                <li><a href="#contacto">Contacto</a></li>
                
                <li style="float:right"><a class="active" href="cerrarSesion.php" >Cerrar Sesion</a></li>
                <li style="float:right"><a class="active" href="crearProductos.php" >Crear Producto</a></li>
                <li style="float:right"></li>
                
                </form>
            </ul>
        </div>
    </header>
    <nav> 
        <br>
    <?php
    include_once "conexion.php";

    $sql= mysqli_query($conn,"SELECT id_producto,nombre FROM producto");
    if($sql !== false){
        if(mysqli_num_rows($sql)> 0){
            echo "<table><tr><th>Id Producto</th><th>Nombre Producto</th><th>Cantidad</th><th>Actualizar</th></tr>";
            while ($mostrar = mysqli_fetch_assoc($sql)){ 
            echo "<tr><td>".$mostrar['id_producto']. "</td>
            <td>".$mostrar['nombre']. "</td>
            <td>".$mostrar['nombre']. "</td>
            <td><form method='post' action='actualizarProducto.php'>
            <input type='hidden' name='id_producto' value='".$mostrar['id_producto']."'>
            <button type='submit' class='a button3' onclick='return confirm(\"¿Estás seguro de que quieres actualizar este Producto?\")'>Actualizar</button>
        </form></td></tr>";
            }
            echo "</table>";
            
        } else{
            echo "No existe la tabla";
        }
    }else {
        echo "Error al ejecutar la tabla: ".mysqli_error($conn);
    }
    mysqli_close($conn);
    ?>
    </nav> 




</body>
</html>