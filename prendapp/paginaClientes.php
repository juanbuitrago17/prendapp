<?php
session_start();
$usuario = $_SESSION['usuario'];
$rol = $_SESSION["rol"];

if(empty($usuario) || empty($rol)){
    header('Location:login.php');
}
?>


<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PRENDAPP</title>
    <link href="styleClienteImagenes.css" rel="stylesheet"/>
    <link href="stylesPaginas.css" rel="stylesheet"/>
   <link href="stylePie.css" rel="stylesheet" />
   <link href="styleHeader.css" rel="stylesheet"/>
   <link href="styleBuscador.css" rel="stylesheet"/>
   <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
</head>
<body>
<header>
        <div class="ancho">
        <div class="logo">
            <img src="Imagenes/Prendapp-1.png" alt="Logo Empresa">
            <h1>PRENDAPP</h1>
            <h2 style="margin-left: 1400px;">COMPRA AQUI</h2>
        </div>
            <ul>
            <li><a href="nosotros.php">Nosotros</a></li>
                <li><a href="#contacto">Contacto</a></li>
                
                <li style="float:right"><a  href="cerrarSesion.php" >Cerrar Sesion </a></li>
                <li style="float:right">
                <?php
                if($rol == 'CLIENTE'){
                    echo"<a  href='formularioVendedor.php' >Quiero Vender</a>";
                }elseif ($rol == 'VENDEDOR') {
                    echo "<a  href='inventario.php' >Vender </a>";
                }
                ?>
                </li>
            </ul>
        </div>
    </header>
    
    <nav>   
    <br /><br />
     <br />
    <form method="post" id="buscador" class="formulario"  action="paginaClientes.php">
        <input type="search" class ="buscador" name="buscador" placeholder="Buscar Producto">
        <input type="submit" class="button1" value="Buscar">
        <button type="button" class="button" onclick="mostrar()">Regresar</button>
</form>
<br /><br />
    </nav>
<nav>
    <div id="contenedorBusqueda">
    <?php
    if(isset( $_POST['buscador'])){
    include_once "conexion.php";
    
    $buscador = $_POST['buscador'];
    $sql = mysqli_query($conn,"SELECT * FROM producto WHERE nombre LIKE '%$buscador%' OR  color LIKE '%$buscador%' OR  talla LIKE '%$buscador%' OR  genero LIKE '%$buscador%' OR  precio LIKE '%$buscador%'");
    
        if($sql !== false){
            if(mysqli_num_rows($sql)> 0){    
               echo "<section>
        <div class='sixco'>
        <nav id='header'>
        <h1 class='letras'>-----BUSQUEDA------</h1>
        </nav>
        </div>
    </section>
    <div class='contenedor' id='contenedor'>";
            while ($mostrar = mysqli_fetch_assoc($sql)){ 
                echo " <div>
              <a href='detalles.php?id_producto=".$mostrar['id_producto']."' ><img src='" .$mostrar['url_imagen']."' width='100%' alt='".$mostrar['nombre']."' /> </a>
               <div class='informacion'>
                   <p>".$mostrar['nombre']."</p>
                   <p class='precio'>COP ".$mostrar['precio']."</p> 
               </div>
             </div>";
            }
        }else{
            echo "<h1 class='letras'>UPS EL PRODUCTO QUE BUSCASTE NO EXISTE</h1>";
        }
    }
    else {
        echo "Error al ejecutar la tabla: ".mysqli_error($conn);
    }

    }
    
    ?>
    
</div>
</nav>
<br /><br />
<nav> 

</div>
<div id="contenedorProductos">
<h1 class="letras">LO NUEVO EN CHAQUETAS</h1>
    <div class="galeria">
    <?php include_once "conexion.php"; 
    $sql= mysqli_query($conn,"SELECT * FROM producto"); 
    if($sql !== false){ 
        if(mysqli_num_rows($sql)> 0)
        { $i = 1; 
        while (($producto = mysqli_fetch_assoc($sql)) && $i <= 7 )
        {   
            echo "<img  src='" . $producto['url_imagen'] . "' alt='" . $producto['nombre'] . "' style='cursor: pointer;' onclick=\"window.location.href='detalles.php?id_producto=" . $producto['id_producto'] . "'\" />";
        $i ++; }
         } 
         } else { echo "Error al ejecutar la tabla: ".mysqli_error($conn); } ?>
    </div>
    </nav>
    <section>
        <div class="sixco">
        <nav id="header">
            <h1 class="letras">-----TENDENCIA------</h1>
        </nav>
        </div>
    </section>
    
        <div class="contenedor" id="contenedor">
        <?php
    include_once "conexion.php";

    $sql= mysqli_query($conn,"SELECT * FROM producto");
    if($sql !== false){
        if(mysqli_num_rows($sql)> 0){  
            while ($producto = mysqli_fetch_assoc($sql)){ 
              echo " <div>
              <a href='detalles.php?id_producto=".$producto['id_producto']."' ><img src='" .$producto['url_imagen']."' width='100%' alt='".$producto['nombre']."' /> </a>
               <div class='informacion'>
                   <p>".$producto['nombre']."</p>
                   <p class='precio'>COP ".$producto['precio']."</p> 
               </div>
             </div>";
            }
        }
}

    else {
        echo "Error al ejecutar la tabla: ".mysqli_error($conn);
    }

    mysqli_close($conn);

    

?>
</div>

</nav>
</body>
</div>
<script>
    function mostrar() {
        
        document.getElementById('buscador').reset();
        document.getElementById('contenedorBusqueda').style.display = 'none';
        document.getElementById('contenedorProductos').style.display = 'inline';
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