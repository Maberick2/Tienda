<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: registro.php");
    exit();
}

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST['id_producto'];
    $nombre = $_POST['nombre'];
    $precio = $_POST['precio'];
    $descripcion = $_POST['descripcion'];
    $imagen_url = $_POST['imagen_url'];

    $stmt = $conexion->prepare("UPDATE productos SET nombre = ?, precio = ?, descripcion = ?, imagen = ? WHERE id = ?");
    $stmt->bind_param("sdssi", $nombre, $precio, $descripcion, $imagen_url, $id_producto);

    if ($stmt->execute()) {
        header("Location: index.php");
    } else {
        echo "Error al modificar el producto: " . mysqli_error($conexion);
    }

    $stmt->close();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Modificar Producto</title>
    <link rel="stylesheet" href="modificar.css"> 
<body>
<header>
        <nav>
            <div class="logo">
                <h1>Tienda</h1>
            </div>
            <ul class="nav-links">
                <li><a href="index.php">Inicio</a></li>
                <li><a href="productos.php">Ver Productos</a></li>
                <li><a href="registro_productos.php">Registrar Producto</a></li>
                <li><a href="modificar_producto.php">Modificar</a></li>
                <li><a href="eliminar_producto.php">Eliminar</a></li>
                <li><a href="cerrar_sesion.php">Cerrar sesión</a></li>
                <li><span>Hola, <?php echo isset($_SESSION['usuario']) ? htmlspecialchars($_SESSION['usuario']) : 'invitado'; ?>!</span></li>
            </ul>
        </nav>
    </header>
    <h2>Modificar Producto</h2>
    <form method="POST" action="modificar_producto.php">
    <div class="input-container">
    <input type="number" name="id_producto" placeholder="ID del Producto" required>
        <input type="text" name="nombre" placeholder="Nuevo Nombre del Producto" required>
        <input type="number" name="precio" placeholder="Nuevo Precio" step="0.01" required>
        <textarea name="descripcion" placeholder="Nueva Descripción" required></textarea>
        <input type="url" name="imagen_url" placeholder="Nueva URL de la imagen" required>
        <button type="submit">Modificar Producto</button>
    </div>
    </form>
    <footer>
        <p>&copy; 2024 Tienda. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
