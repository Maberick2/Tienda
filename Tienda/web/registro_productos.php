<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: registro.php");
    exit();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registrar Producto</title>
    <link rel="stylesheet" href="jose.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
</head>
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

    <h2>Registrar Producto</h2>
    <form method="POST" action="guardar_producto.php">
    <div class="input-container">
        <input type="text" name="nombre" placeholder="Nombre del Producto" required>
        <i class="fas fa-tag"></i> <!-- Ícono de etiqueta -->
    </div>
    
    <div class="input-container">
        <input type="number" name="precio" placeholder="Precio" step="0.01" required>
        <i class="fas fa-dollar-sign"></i> <!-- Ícono de dólar -->
    </div>
    
    <div class="input-container">
        <textarea name="descripcion" placeholder="Descripción" required></textarea>
        <i class="fas fa-align-left"></i> <!-- Ícono de descripción -->
    </div>
    
    <div class="input-container">
        <input type="url" name="imagen_url" placeholder="URL de la imagen" required>
        <i class="fas fa-image"></i> <!-- Ícono de imagen -->
    </div>
    
    <button type="submit">Registrar Producto</button>
</form>

    <footer>
        <p>&copy; 2024 Tienda. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
