<?php
header("Content-type: application/xls");
header("Content-Disposition: attachment; filename = Excel.xls");
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
    <?php
    include_once "conexion.php";

    $sql= mysqli_query($conn,"SELECT * FROM inventario");
    if($sql !== false){
        if(mysqli_num_rows($sql)> 0){
          ?>
            
            <table style=" padding-top: 40px;" id="inventario">
            <thead>
            <tr><th>Id_Inventario</th>
            <th>Id_Producto</th>
            <th>Cantidad</th>
            <th>FechaCreacion</th>
            <th>FechaActualizacion</th>
            <th>Actualizar</th>
            <th>Eliminar</th>
        </tr>
        </thead>
            <?PHP
 while ($mostrar = mysqli_fetch_assoc($sql)){ 
    echo "<tr><td>".$mostrar['id_inventario']. "</td>
    <td>".$mostrar['id_producto']. "</td>
    <td>".$mostrar['cantidad']. "</td>
    <td>".$mostrar['fechaCreacion']. "</td>
    <td>".$mostrar['fechaActualizacion']. "</td>
   </tr>";
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

</body>
</html>