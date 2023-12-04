<!DOCTYPE html>
<html lang="en">
<head >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Crear Venta</title>
    <link href="stylesCrear.css" rel="stylesheet" />
    <link href="styleTablas.css" rel="stylesheet">
</head>
<body>
    
    <section class="form-d">
        <div class="form-c" >
              <div class="box">
    
    <form id="form7" method="post" action="crearVenta.php">

    <div class="input-box">
             <label for="cedula">Seleccione el nombre del comprador:</label>
                <select name="cedula"  class="input-control" id="cedula">
                <?php
                    $valida = true;
                    include_once "conexion.php";
                    $sql= mysqli_query($conn,"SELECT cedula, nombre FROM usuario");
                    if($sql!== false){
                        while($fila =mysqli_fetch_assoc($sql)){
                            echo "<option  style='color:black' value='" . $fila['cedula'] . "'>" . $fila['nombre'] . "</option>";
                        }
                    }
                ?>
                </select>
            </div>

            <div class="input-box">
            <label for="id_inventario">Seleccione el id del inventario:</label>
            <select name="id_inventario" class="input-control" id="id_inventario">
                <?php
                    include_once "conexion.php";
                    $sql= mysqli_query($conn,"SELECT id_inventario FROM inventario");
                    if($sql!== false){
                        while($fila =mysqli_fetch_assoc($sql)){
                            echo "<option style='color:black' value='" . $fila['id_inventario'] . "'>" . $fila['id_inventario'] . "</option>";
                        }
                    }
                ?>
                </select>
            </div>

          <div class="input-box" >
          <label for="cantidadProductos">Ingrese la cantidad de productos:</label>
          <input type="text" name="cantidadProductos" class="input-control" ></input>
          <?php
          $valida = true;
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
            ?>
          </div>
        <div class="input-box">
            <label for="total">Total de la venta:</label>
            <input type="text" name="total" class="input-control"></input>
            <?php
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
            ?>
        </div>

         <center><input type="submit" value="CREAR" name="crearVenta" class="button button2"></td> </center><br />
       
        <br/>
        
         <h3>  <a href="indexVenta.php" class="t-text">VOLVER</a></h3>
        
     
    </form> 
    </div>
    </div>
	</section>
    <?php
if(isset($_POST["crearVenta"])){
    $cedula = $_POST["cedula"];
    $id_inventario = $_POST["id_inventario"];
    $fechaCreacion = date("Y-m-d");
    $cantidadProductos = $_POST["cantidadProductos"];
    $total = $_POST["total"];

    if($valida == True){
        include_once "conexion.php";
    $sql= "INSERT INTO venta(cedula,id_inventario,fechaCreacion,cantidadProductos,total) VALUES ('$cedula','$id_inventario','$fechaCreacion','$cantidadProductos','$total')";

    function seCreo(){
        echo "<script>alert('Se registró la venta'); window.location.href = 'indexVenta.php';</script>";
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