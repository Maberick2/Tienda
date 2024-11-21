<?php
$servername = "db"; // Nombre del servicio MySQL definido en docker-compose.yml
$username = "root";
$password = "root";
$dbname = "tienda";

$conexion = mysqli_connect($servername, $username, $password, $dbname);
if (!$conexion) {
    die("Error de conexión: " . mysqli_connect_error());
}
?>
