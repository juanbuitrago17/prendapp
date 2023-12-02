<?php
session_start();
$cedula = $_SESSION['cedula'];
$rol= $_SESSION['rol'];
if(empty($cedula) || empty($rol)){
    header('Location:login.php');
}
?>

<!DOCTYPE html>

<html lang="en">
<head>
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Actualizar Inventario</title>
    <link href="stylesCrear.css" rel="stylesheet" />
    <link href="stylesTablas.css" rel="stylesheet">
</head>
<body>
<?php
include_once "conexion.php";

if ($_SERVER["REQUEST_METHOD"] == "POST" && isset($_POST['id_inventario'])) {
    $id_inventario = $_POST['id_inventario'];

    $sql = "SELECT * FROM inventario WHERE id_inventario = '$id_inventario'";
    $result = mysqli_query($conn, $sql);

    if ($result !== false && mysqli_num_rows($result) > 0) {
        $inventario = mysqli_fetch_assoc($result);
    }
}
?>
    
    <section class="form-d">
        <div class="form-c" >
              <div class="box">
    
    <form id="form6" method="post" action="actualizarInventario.php">
    
           
    <div class="input-box">
            <input type="hidden" name="id_inventario" value="<?php echo isset($inventario['id_inventario']) ? $inventario['id_inventario'] : ''; ?>" class="input-control"></input>
            <?php
            $valida = true;
            if($_SERVER["REQUEST_METHOD"] == "POST"){
                $id_inventario = $_POST["id_inventario"];
                if(empty($id_inventario)){
                    echo"<p class='p'>El campo es obligatorio</p>";
                    $valida = false;
                }
            }
            ?>
        </div>
        
        <div class="input-box">
            <label for="cantidad">Ingrese la cantidad de productos:</label>
            <input type="text" name="cantidad" value="<?php echo isset($inventario['cantidad']) ? $inventario['cantidad'] : ''; ?>"  class="input-control"></input>
            <?php
            if (isset($_POST["actualizarInventario"])) {
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
        }
            ?>
        </div>

         <center><input type="submit" value="Actualizar" name="actualizarInventario" class="button button2"></td> </center><br />
        <br /><br />

        <?php
            if($rol=="ADMINISTRADOR"){
                echo "<h3>  <a href='indexInventario.php' class='t-text'>VOLVER</a></h3>";
            }else {
                echo "<h3>  <a href='inventario.php' class='t-text'>VOLVER</a></h3>";
            }
        ?>
        
     
    </form>
     
    </div>
    </div>
		
	</section>
    <?php
    
if (isset($_POST["actualizarInventario"])) {

    $id_inventario = $_POST["id_inventario"];
    $cantidad = $_POST["cantidad"];
    $fechaActualizacion = date("Y-m-d");

    if($valida == True){
    include_once "conexion.php";

    $sql = "UPDATE inventario SET cantidad='$cantidad', fechaActualizacion='$fechaActualizacion' WHERE id_inventario='$id_inventario'";

    function seCreo(){
    
        $paginaDestino = 'inventario.php' ;
        if($rol=="ADMINISTRADOR"){
            $paginaDestino =  'indexInventario.php'; 
        }
    
        echo "<script>alert('Se actualizo el inventario'); window.location.href = '$paginaDestino';</script>";
    }
    function noSeCreo()
    {
        echo "<script>alert('No se pudo actualizar el inventario');</script>";
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