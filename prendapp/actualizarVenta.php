<!DOCTYPE html>
<html lang="en">
<head >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Actualizar Venta</title>
    <link href="stylesCrear.css" rel="stylesheet" />
    <link href="styleTablas.css" rel="stylesheet">
</head>
<body>
<?php
include_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_venta'])) {
    $id_venta = $_POST['id_venta'];

    $sql = "SELECT * FROM venta WHERE id_venta = '$id_venta'";
    $result = mysqli_query($conn, $sql);

    if ($result !== false && mysqli_num_rows($result) > 0) {
        $venta = mysqli_fetch_assoc($result);
    }
}
?>
    
    <section class="form-d">
        <div class="form-c" >
              <div class="box">
    
    <form id="form8" method="post" action="actualizarVenta.php">
    
          <div class="input-box" >
          <input type="hidden" name="id_venta" value="<?php echo isset($venta['id_venta']) ? $venta['id_venta'] : ''; ?>"  class="input-control" ></input>
          <?php
           $valida = true;
           if (isset($_POST["actualizarVenta"])) {
            if($_SERVER["REQUEST_METHOD"] == "POST"){
            $id_venta = $_POST["id_venta"];
            if(empty($id_venta)){
                echo"<p class='p'>El campo es obligatorio</p>"; 
                $valida = false; 
            }
        }
    }
            ?>
          </div>

          <div class="input-box" >
          <label for="cantidadProductos">Ingrese la cantidad de productos:</label>
          <input type="text" name="cantidadProductos" value="<?php echo isset($venta['cantidadProductos']) ? $venta['cantidadProductos'] : ''; ?>" class="input-control" ></input>
          <?php
          if (isset($_POST["actualizarVenta"])) {
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
        <div class="input-box">
            <label for="total">Total de la venta:</label>
            <input type="text" name="total" value="<?php echo isset($venta['total']) ? $venta['total'] : ''; ?>" class="input-control"></input>
            <?php
            if (isset($_POST["actualizarVenta"])) {
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $total = $_POST["total"];
                if(empty($total)){
                    echo"<p class='p'>El campo es obligatorio</p>";
                    $valida = false;
                }else{
                    if(!preg_match("/^\d+(\.\d{1,2})?$/", $total)){
                        echo "<p class='p'>El campo no tiene el formato correcto</p>";
                        $valida = false;
                    }
                }
            }
        }
            ?>
        </div>


         <center><input type="submit" value="Actualizar" name="actualizarVenta" class="button button2"></td> </center><br />
       
        <br/>
        
         <h3>  <a href="indexVenta.php" class="t-text">VOLVER</a></h3>
        
     
    </form> 
    </div>
    </div>
	</section>
    <?php
if(isset($_POST["actualizarVenta"])){

    $id_venta = $_POST["id_venta"];
    $cantidadProductos = $_POST["cantidadProductos"];
    $total = $_POST["total"];

    if($valida == True){
     include_once "conexion.php";
    $sql= "UPDATE venta SET cantidadProductos='$cantidadProductos',  total='$total' WHERE id_venta='$id_venta'";

    function seCreo(){
        echo "<script>alert('Se actualizo la venta'); window.location.href = 'indexVenta.php';</script>";
    }
    function noSeCreo() {
        echo "<script>alert('No se pudo registrar la venta');</script>";
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