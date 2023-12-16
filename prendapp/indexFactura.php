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
    <link  rel="stylesheet" href="styleCrudsTable.css">
    <link rel="stylesheet" href="styleTablasYBotones.css">
    <link type="text/css" rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/twitter-bootstrap/5.3.0/css/bootstrap.min.css">
    <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/1.13.7/css/dataTables.bootstrap5.min.css">
    <link type="text/css" rel="stylesheet" href="https://cdn.datatables.net/buttons/2.4.2/css/buttons.bootstrap5.min.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.1.0/css/all.min.css">
    
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
            <a class="href" class="nav-link active" aria-current="page" href="indexInventario.php" > <h5>Inventario</h5></a>
          </li>
          <li class="nav-item" >
            <a class="href" class="nav-link active" aria-current="page" href="indexUsuario.php" ><h5> Usuario</h5></a>
          </li>
          <li class="nav-item" >
            <a class="href" class="nav-link active" aria-current="page" href="indexProducto.php" ><h5> Producto</h5></a>
          </li>
          <li class="nav-item" >
            <a class="href" class="nav-link active" aria-current="page" href="indexVenta.php" ><h5> Venta</h5></a>
          </li>
          <li class="nav-item" >
            <a class="href" class="nav-link active" aria-current="page" href="cerrarSesion.php" ><h5> Cerrar sesion</h5></a>
          </li>
          
           
        
        </ul>
       
      </div>
    </div>
  </div>
</nav>

<br><br><br><br>
       
     <div style="text-align:center;" >
        <h1 style="color: blueviolet;">Bienvenido</h1>
        <p >Listado De Facturas</p>
        
    </div>
    <input type='button' style="font-size:20px;padding:2px;width:80px;" value='Crear' name='agregar' onclick='paginaRegistro()' class='button '><br><br>
 <?php
    include_once "conexion.php";

    $sql= mysqli_query($conn,"SELECT * FROM factura");
    if($sql !== false){
        if(mysqli_num_rows($sql)> 0){
          ?>
<table id="example" class="display nowrap" style="width:100%">
      <thead>
            <tr><th>Id_factura</th>
            <th>Id_venta</th>
            <th>fechaCreacion</th>
            <th>TotalCompra</th>
            <th>CantidadProductos</th>
            <th>Actualizar</th>
            <th>Eliminar</th>
            </tr>
        </thead>
        <tbody>
            <?PHP
            while ($mostrar = mysqli_fetch_assoc($sql)){ 
                echo "<tr><td>".$mostrar['id_factura']. "</td>
                <td>".$mostrar['id_venta']. "</td>
                <td>".$mostrar['fechaCreacion']. "</td>
                <td>".$mostrar['totalCompra']. "</td>
                <td>".$mostrar['cantidadProductos']. "</td>
                <td><form method='post' action='actualizarFactura.php'>
                <input type='hidden' name='id_factura' value='".$mostrar['id_factura']."'>
                <button type='submit' class='a button3' onclick='return confirm(\"¿Estás seguro de que quieres actualizar esta factura?\")'>Actualizar</button>
            </form></td>
                <td><form method='post' action='eliminarFactura.php'>
                <input type='hidden' name='id_factura' value='".$mostrar['id_factura']."'>
                <button type='submit' class='a button3' onclick='return confirm(\"¿Estás seguro de que quieres eliminar esta factura?\")'>Eliminar</button>
            </form></td></tr>";
            }
        }
            
}
            
   
    else {
        echo "Error al ejecutar la tabla: ".mysqli_error($conn);
    }
    mysqli_close($conn);

   

?>
</tbody></table>
 <br><br>


   
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js" integrity="sha384-ka7Sk0Gln4gmtz2MlQnikT1wXgYsOg+OMhuP+IlRH9sENBO0LRn5q+8nbTov4+1p" crossorigin="anonymous"></script>
<script src="https://code.jquery.com/jquery-3.7.0.js" type="text/Javascript"></script>
<script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js" type="text/Javascript"></script>
<script src="https://cdn.datatables.net/1.13.7/js/dataTables.bootstrap5.min.js" type="text/Javascript"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/dataTables.buttons.min.js" type="text/Javascript"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.bootstrap5.min.js" type="text/Javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.10.1/jszip.min.js" type="text/Javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js" type="text/Javascript"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js" type="text/Javascript"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.html5.min.js" type="text/Javascript"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.print.min.js" type="text/Javascript"></script>
<script src="https://cdn.datatables.net/buttons/2.4.2/js/buttons.colVis.min.js" type="text/Javascript"></script>
<script>
   $(document).ready(function() {
    var table = $('#example').DataTable( {
        lengthChange: false,
        buttons: {
           buttons: [
               {
                   extend: 'copy',
                   text: 'Copiar',
                   className: 'btn btn-secondary'
               },
               {
                   extend: 'excel',
                   text: 'Exportar a Excel',
                   className: 'btn btn-success'
               },
               {
                   extend: 'pdf',
                   text: 'Exportar a pdf',
                   className: 'btn btn-danger'
               },
               {
                   extend: 'colvis',
                   text: 'Filtrar columnas'
               }
               ]
             
        }
        /*buttons: [ 'copy', 'excel', 'pdf', 'colvis' ]*/
    } );
 
    table.buttons().container()
        .appendTo( '#example_wrapper .col-md-6:eq(0)' );
} );
</script>
<script>
    function paginaRegistro(){
         window.location = "crearFactura.php";
    }
</script> 
<script>
  document.querySelector('.navbar-toggler').style.backgroundColor = 'whitesmoke';
</script>
</body>
<footer style="min-height:40vh" class="pie-pagina">
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
</html>