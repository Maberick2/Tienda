<?php
include 'conexion.php';

$search = isset($_GET['search']) ? mysqli_real_escape_string($conexion, $_GET['search']) : '';

$sql = "SELECT * FROM productos WHERE nombre LIKE '%$search%' OR descripcion LIKE '%$search%'";
$resultado = mysqli_query($conexion, $sql);

if (!$resultado) {
    die("Error en la consulta: " . mysqli_error($conexion));
}

$productos = array();

while ($producto = mysqli_fetch_assoc($resultado)) {
    $productos[] = $producto;
}

if (empty($productos)) {
    header("Location: index.php");
} else {
    echo json_encode($productos);
}
?>
