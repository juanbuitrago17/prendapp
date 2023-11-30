<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>PRENDAPP</title>
    <link href="stylesPagina.css" rel="stylesheet" />
    <link href="stylesImagenes.css" rel="stylesheet" />
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
                <li style="float:right"><a class="active" href="login.php" >Cerrar Sesion</a></li>
                
                <li style="float:right"><form name="form12" method="post" action="paginaCliente.php">
                <input type="submit" value="Vender" name="vendedor" class="activo"></li>
                <?php
                session_start();
                include_once "conexion.php";
                if($_SESSION["rol"]=="Cliente"){
                    header("Location: registraseVendedor.php");
                }elseif($_SESSION["rol"]=="Vendedor"){
                    header("Location: paginaVendedor.html");
                }
                mysqli_close($conn);
                ?>
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
         <div>
             <img src="Imagenes%20cliente/producto1.jpg" alt="producto1" />
            <div class="informacion">
                <p>producto 1</p>
                <p class="precio">$80<span>.000</span> </p>
                <button>Comprar</button>
            </div>
        </div>
        <div>
            <img src="Imagenes%20cliente/producto2.jpg" alt="producto2"/>
                <div class="informacion">
                    <p>producto 2</p>
                    <p class="precio">$85<span>.000</span> </p>
                    <button>Comprar</button>
                </div>
            </div>
            <div>
                <img src="Imagenes%20cliente/producto4.jpg" alt="producto4" />
                    <div class="informacion">
                        <p>producto 3</p>
                        <p class="precio">$90<span>.000</span> </p>
                        <button>Comprar</button>
                    </div>
                </div>
                <div>
                    <img src="Imagenes%20cliente/producto5.jpg" alt="producto5"/>
                        <div class="informacion">
                            <p>producto 4</p>
                            <p class="precio">$70<span>.000</span> </p>
                            <button>Comprar</button>
                        </div>
                </div>

            </div>
        <script src="Javascr/java.js"></script>
</body>
</html>