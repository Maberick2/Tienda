<?php
session_start();
include 'conexion.php';

function registrarProducto($conexion, $nombre, $precio, $descripcion, $imagen_url) {
    if (!isset($_SESSION['usuario'])) {
        return "Acceso denegado.";
    }

    // Validar que la URL no esté vacía y sea válida
    if (filter_var($imagen_url, FILTER_VALIDATE_URL) === false) {
        return "La URL de la imagen no es válida.";
    }

    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conexion->prepare("INSERT INTO productos (nombre, precio, descripcion, imagen) VALUES (?, ?, ?, ?)");
    $stmt->bind_param("sdss", $nombre, $precio, $descripcion, $imagen_url);

    if ($stmt->execute()) {
        return true; // Registro exitoso
    } else {
        return "Error al registrar el producto: " . mysqli_error($conexion);
    }

    $stmt->close();
}

// Lógica original
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $imagen_url = $_POST['imagen_url'];

    $resultado = registrarProducto($conexion, $nombre, $precio, $descripcion, $imagen_url);
    
    if ($resultado === true) {
        header("Location: index.php");
    } else {
        echo $resultado;
    }
}
?>
