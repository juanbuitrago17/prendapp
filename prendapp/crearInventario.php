<!DOCTYPE html>

<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Crear Inventario</title>
    <link href="stylesCrear.css" rel="stylesheet" />
    <link href="styleTablasYBotones.css" rel="stylesheet">
</head>
<body>
    
    <section class="form-d">
        <div class="form-c" >
              <div class="box">
    
    <form id="form5" method="post" action="crearInventario.php">
        
    <div class="input-box">
             <label for="id_producto">Seleccione el nombre del producto:</label>
                <select name="id_producto" class="input-control" id="id_producto">
                    <?php
                    $valida = true;
                    include_once "conexion.php";
                    $sql= mysqli_query($conn,"SELECT id_producto, nombre FROM producto");
                    if($sql!== false){
                        while($fila =mysqli_fetch_assoc($sql)){
                            echo "<option value='" . $fila['id_producto'] . "'style='color:black'>" . $fila['nombre'] . "</option>";
                        }
                    }
                    ?>
                </select>
                    </div>
        
        <div class="input-box">
            <label for="cantidad">Ingrese la cantidad de productos:</label>
            <input type="text" name="cantidad"  class="input-control"></input>
            <?php
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $cantidad = $_POST["cantidad"];
                if(empty($cantidad)){
                    echo"<p class='p'>El campo es obligatorio</p>";
                    $valida = false;
                }else{
                    if(!preg_match("/^[0-9]+$/", $cantidad)){
                        echo "<p class='p'>El campo no tiene el formato correcto</p>";
                        $valida = false;
                    }
                }
            }
            ?>
        </div>

        
        <center><input type="submit" value="CREAR" name="crearInventario" class="button button2"></td> </center><br />
       
        <br /><br />
        
         <h3>  <a href="indexInventario.php" class="t-text">VOLVER</a></h3>
        
     
    </form>
     
    </div>
    </div>
		
	</section>
    <?php
if(isset($_POST["crearInventario"])){
    $id_producto = $_POST["id_producto"];
    $cantidad = $_POST["cantidad"];
    $FechaCreacion = date("Y-m-d");
   
    if($valida == True){
    include_once "conexion.php";
    $sql= "INSERT INTO inventario(id_producto,cantidad,fechaCreacion) VALUES ('$id_producto','$cantidad','$FechaCreacion')";

    function seCreo(){
        echo "<script>alert('Se registró el Inventario'); window.location.href = 'indexInventario.php';</script>";
    }
    function noSeCreo() {
        echo "<script>alert('No se pudo registrar el Inventario');</script>";
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
