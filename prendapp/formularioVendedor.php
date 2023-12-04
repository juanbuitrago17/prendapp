<?php
session_start();
$cedula = $_SESSION['cedula'];
if(empty($cedula) ){
    header('Location:login.php');
}
?>


<!DOCTYPE html>
<html lang="en">
<head >
<meta http-equiv="Content-Type" content="text/html; charset=utf-8"/>
    <title>Crear Venta</title>
    <link href="stylesCrear.css" rel="stylesheet" />
    <link href="styleTablasYBotones.css" rel="stylesheet">
</head>
<body>
    
    <section class="form-d">
        <div class="form-c" >
              <div class="box">
    
    <form id="formularioVendedor" method="post" action="formularioVendedor.php">

    <div class="input-box">
             <label for="edad">Edad:</label>
             <input type="text" name="edad" class="input-control" id="edad">
                <?php
                $valida = true;
                if($_SERVER["REQUEST_METHOD"] == "POST"){
                $edad = $_POST["edad"];
                if(empty($edad)){
                    echo"<p class='p'>El campo es obligatorio</p>";
                    $valida = false;
                }else{
                    if(!preg_match("/^[0-9]+$/", $edad)){
                        echo "<p class='p'>Ingrese una edad válida</p>";
                        $valida = false;
                    }
                }
            }
            ?>
          </div>

         <center><input type="submit" value="CREAR" name="crearVendedor" class="button button2"></td> </center><br />
       
        <br/>
        
         <h3>  <a href="paginaClientes.php" class="t-text">VOLVER</a></h3>
        
     
    </form> 
    </div>
    </div>
	</section>
    <?php
if(isset($_POST["crearVendedor"])){
    $edad = $_POST["edad"];
    $rol = "VENDEDOR";

    if($valida == True){
        include_once "conexion.php";
    $sql="UPDATE usuario SET rol='$rol', edad='$edad' WHERE cedula ='$cedula'";
    function seCreo(){
        echo "<script>alert('Se registró el vendedor'); window.location.href = 'inventario.php';</script>";
    }
    function noSeCreo() {
        echo "<script>alert('No se pudo registrar el vendedor');</script>";
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