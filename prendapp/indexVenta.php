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
    <link rel="stylesheet" href="styleCrud.css">
    <link rel="stylesheet" href="styleTablasYBotones.css">
    <link rel="stylesheet" href="//cdn.datatables.net/1.13.7/css/jquery.dataTables.min.css">
    
    <title>BASE DE DATOS</title>
</head>
<body>

<nav class="navbar navbar-light bg-ligh fixed-top"  style="background-color:purple;" >
  <div class="container-fluid"  >
    <a class="navbar-brand" >
    <h3 style="color: white;"><img src="Imagenes/Prendapp-1.png"   alt="logo" width="80" height="50">PRENDAPP</h3>
    </a>
    <button style="color: #11294d;" class="navbar-toggler" type="button" data-bs-toggle="offcanvas" data-bs-target="#offcanvasNavbar" aria-controls="offcanvasNavbar">
      <span  class="navbar-toggler-icon"></span>
    </button>
    <div class="offcanvas offcanvas-end" tabindex="-1" id="offcanvasNavbar" aria-labelledby="offcanvasNavbarLabel">
      <div class="offcanvas-header">
        <h3 class="offcanvas-title" id="offcanvasNavbarLabel" style="color:purple;">DATOS</h3>
        <button type="button" class="btn-close text-reset" data-bs-dismiss="offcanvas" aria-label="Close"></button>
      </div>
      <div class="offcanvas-body" style="background-color:#eeeeee;">
        <ul class="navbar-nav justify-content-end flex-grow-1 pe-3">
          <li class="nav-item" >
            <a class="href" class="nav-link active" aria-current="page" href="indexFactura.php" > <h5>Factura</h5></a>
          </li>
          <li class="nav-item" >
            <a class="href" class="nav-link active" aria-current="page" href="indexInventario.php" ><h5> Inventario</h5></a>
          </li>
          <li class="nav-item" >
            <a class="href" class="nav-link active" aria-current="page" href="indexProducto.php" ><h5> Producto</h5></a>
          </li>
          <li class="nav-item" >
            <a class="href" class="nav-link active" aria-current="page" href="indexUsuario.php" ><h5> Usuario</h5></a>
          </li>
          <li class="nav-item" >
            <a class="href" class="nav-link active" aria-current="page" href="cerrarSesion.php" ><h5> Cerrar sesion</h5></a>
          </li>
          
           
        
        </ul>
       
      </div>
    </div>
  </div>
</nav>

<br><br><br><br><br><br>
       
    <div style="text-align:center;" >
        <h1 style="color: blueviolet;">Bienvenido</h1>
        <p >Listado De Ventas</p>
        
    </div>
    <input type='button' style="font-size:20px;padding:2px;width:100px;" value='Imprimir' name='agregar' onclick="window.print();" class='button '>
     <input type='button' style="font-size:20px;padding:2px;width:100px;" value='Excel' name='agregar' onclick="paginaExcel();" class='button '>
    <input type='button' style="font-size:20px;padding:2px;width:80px;" value='Crear' name='agregar' onclick='paginaRegistro()' class='button '><br><br>
    <?php
    include_once "conexion.php";

    $sql= mysqli_query($conn,"SELECT * FROM venta");
    if($sql !== false){
        if(mysqli_num_rows($sql)> 0){
          ?>
            
            <table style=" padding-top: 40px;" id="venta">
            <thead>
            <tr><th>Id_venta</th>
            <th>Cedula</th>
            <th>Id_inventario</th>
            <th>FechaCreacion</th>
            <th>CantidadProductos</th>
            <th>Total</th>
            <th>Actualizar</th>
            <th>Eliminar</th></tr>
        </thead>
            <?PHP
            while ($mostrar = mysqli_fetch_assoc($sql)){ 
                echo "<tr><td>".$mostrar['id_venta']. "</td>
                <td>".$mostrar['cedula']. "</td>
                <td>".$mostrar['id_inventario']. "</td>
                <td>".$mostrar['fechaCreacion']. "</td>
                <td>".$mostrar['cantidadProductos']. "</td>
                <td>".$mostrar['total']. "</td>
                <td><form method='post' action='actualizarVenta.php'>
                <input type='hidden' name='id_venta' value='".$mostrar['id_venta']."'>
                <button type='submit' class='a button3' onclick='return confirm(\"¿Estás seguro de que quieres actualizar esta venta?\")'>Actualizar</button>
            </form></td>
                <td><form method='post' action='eliminarVenta.php'>
                <input type='hidden' name='id_venta' value='".$mostrar['id_venta']."'>
                <button type='submit' class='a button3' onclick='return confirm(\"¿Estás seguro de que quieres eliminar esta venta?\")'>Eliminar</button>
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
            
<br><br><br><br>


<footer class="pie-pagina">
            <h2 class="h-2">PRENDAPP</h2>
            
           
            <br>
           
            <p class="pt" style="font-size: 12px;" >
            <img  class="img-t" src="Imagenes/Prendapp-1.png" alt="Descripción de la imagen">
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
        window.location = "crearVenta.php";
    }
    function paginaExcel(){
        window.location = "generalExcelVenta.php"; 
    }
</script>   

<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js" integrity="sha512-v2CJ7UaYy4JwqLDIrZUI/4hqeoQieOmAZNXBeQyjo21dadnwR+8ZaIJVT8EE2iyI61OV8e6M8PP2/4hpQINQ/g==" crossorigin="anonymous" referrerpolicy="no-referrer"></script>
<script src="//cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
<script> $('#venta thead th').each( function () {
        var title = $('#venta tfoot th').eq( $(this).index() ).text();
       // $(this).html( '&amp;lt;input type=&amp;quot;text&amp;quot; placeholder=&amp;quot;Search '+title+'&amp;quot; /&amp;gt;' );
    } );
 
    // DataTable
    var table = $('#venta').DataTable();
 
    // Apply the search
    table.columns().eq( 0 ).each( function ( colIdx ) {
        $( 'input', table.column( colIdx ).header() ).on( 'keyup change', function () {
            table
                .column( colIdx )
                .search( this.value )
                .draw();
        } );
    } );</script>
<script>
  document.querySelector('.navbar-toggler').style.backgroundColor = 'whitesmoke';
</script>

</body>
</html>