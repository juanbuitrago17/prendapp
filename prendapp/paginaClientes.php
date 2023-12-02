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
    
    <link href="stylesImagenes.css" rel="stylesheet" />
   <link href="stylesPagina.css" rel="stylesheet" />
</head>
<body>
    <header>
        <div class="ancho">
        <div class="logo">
            <img src="Imagenes/Prendapp-1.png" alt="Logo Empresa"/>
            <h1>PRENDAPP</h1>
            <h2>COMPRA AQUI</h2>
        </div>
            <ul>
                <li><a href="#nostros">Nosotros</a></li>
                <li><a href="#contacto">Contacto</a></li>
                
                <li style="float:right"><a class="active" href="cerrarSesion.php" >Cerrar Sesion </a></li>
                <li style="float:right">
                <?php
                if($rol == 'CLIENTE'){
                    echo"<a class='active' href='formularioVendedor.php' >Quiero Vender</a>";
                }elseif ($rol == 'VENDEDOR') {
                    echo "<a class='active' href='inventario.php' >Vender </a>";
                }
                ?>
                </li>
                </form>
            </ul>
        </div>
    </header>
    <nav>   
    <br /><br />
     <br />
    <h1>Lo nuevo en Chaquetas</h1>
    <div class="galeria">
                <img src="Imagenes/chaqueta2.jpg" alt="" />
                <img src="Imagenes/chaqueta3.jpg" alt="" />
                <img src="Imagenes/chaqueta4.jpg" alt="" />
                <img src="Imagenes/chaqueta5.jpg" alt=""/>
                <img src="Imagenes/chaqueta6.jpg" alt=""/>
    </div>
    </nav>
    <section>
        <div class="sixco">
        <nav id="header">
            <h1>-----TENDENCIA------</h1>
              <img class="carrito" src="Imagenes cliente/cart.svg" alt="carrito"/>
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
              <a href='detalles.php?id_producto=".$producto['id_producto']."' ><img src='" .$producto['url_imagen']."' width='100%' alt='".$producto['nombre']."' /></a> 
               <div class='informacion'>
                   <p>".$producto['nombre']."</p>
                   <p class='precio'>COP ".$producto['precio']."</p>
                   Detalle
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
</body>
</html>