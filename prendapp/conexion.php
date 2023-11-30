<?php
$server = "localhost";
$username = "root";
$pass = "";
$dbname= "prendapp";

$conn = new mysqli($server,$username,$pass,$dbname);

if(!$conn){
    exit("Fallo la conexion". mysqli_connect_error());
}

?>