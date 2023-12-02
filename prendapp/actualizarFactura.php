<!DOCTYPE html>
<html lang="en">
<head >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Actualizar Factura</title>
    <link href="stylesCrear.css" rel="stylesheet" />
    <link href="stylesTablas.css" rel="stylesheet">
</head>
<body>
<?php
include_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_factura'])) {
    $id_factura = $_POST['id_factura'];

    $sql = "SELECT * FROM factura WHERE id_factura = '$id_factura'";
    $result = mysqli_query($conn, $sql);

    if ($result !== false && mysqli_num_rows($result) > 0) {
        $factura = mysqli_fetch_assoc($result);
    }
}
?>
    
    <section class="form-d">
        <div class="form-c" >
              <div class="box">
    
    <form id="form10" method="post" action="actualizarFactura.php">
    
          <div class="input-box" >
          <input type="hidden" name="id_factura" value="<?php echo isset($factura['id_factura']) ? $factura['id_factura'] : ''; ?>"  class="input-control" ></input>
          <?php
           $valida = true;
           if (isset($_POST["actualizarFactura"])) {
            if($_SERVER["REQUEST_METHOD"] == "POST"){
            $id_factura = $_POST["id_factura"];
            if(empty($id_factura)){
                echo"<p class='p'>El campo es obligatorio</p>"; 
                $valida = false; 
            }
        }
    }
            ?>
          <div class="input-box" >
          <label for="total">Total de la compra:</label>
          <input type="text" name="total" value="<?php echo isset($factura['totalCompra']) ? $factura['totalCompra'] : ''; ?>" class="input-control" ></input>
          <?php
          $valida = true;
          if (isset($_POST["actualizarFactura"])) {
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $total = $_POST["total"];
                if(empty($total)){
                    echo"<p class='p'>El campo es obligatorio</p>";
                    $valida = false;
                }else{
                    if(!preg_match("/^\d+(\.\d{1,2})?$/", $total)){
                        echo "<p class='p'>Ingrese el total de la compra  válido</p>";
                        $valida = false;
                    }
                }
            }
        }
            ?>
          </div>
          <div class="input-box" >
          <label for="cantidadProductos">Cantidad de productos de la compra:</label>
          <input type="text" name="cantidadProductos" value="<?php echo isset($factura['cantidadProductos']) ? $factura['cantidadProductos'] : ''; ?>" class="input-control" ></input>
          <?php
          if (isset($_POST["actualizarFactura"])) {
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $cantidadProductos = $_POST["cantidadProductos"];
                if(empty($cantidadProductos)){
                    echo"<p class='p'>El campo es obligatorio</p>";
                    $valida = false;
                }else{
                    if(!preg_match("/^[0-9]+$/", $cantidadProductos)){
                        echo "<p class='p'>Ingrese un código válido</p>";
                        $valida = false;
                    }
                }
            }
        }
            ?>
          </div>

         <center><input type="submit" value="Actualizar" name="actualizarFactura" class="button button2"></td> </center><br />
       
        <br/>
        
         <h3>  <a href="indexFactura.php" class="t-text">VOLVER</a></h3>
        
     
    </form> 
    </div>
    </div>
	</section>
    <?php
if(isset($_POST["actualizarFactura"])){

    $id_factura = $_POST["id_factura"];
    $total = $_POST["total"];
    $cantidadProductos = $_POST["cantidadProductos"];

    if($valida == True){
     include_once "conexion.php";
    $sql= "UPDATE factura SET totalCompra='$total',  cantidadProductos='$cantidadProductos'  WHERE id_factura='$id_factura'";

    function seCreo(){
        echo "<script>alert('Se actualizo la factura'); window.location.href = 'indexFactura.php';</script>";
    }
    function noSeCreo() {
        echo "<script>alert('No se pudo registrar la factura');</script>";
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