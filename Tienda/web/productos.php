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
    <title>Productos</title>
    <link rel="stylesheet" href="Prod.css">
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
    
    <section>
        <h2>Productos Disponibles</h2>

        <!-- Campo de búsqueda -->
        <input type="text" id="buscador-productos" placeholder="Buscar productos...">

        <div id="productos-container">
            <!-- Aquí se mostrarán los productos con sus imágenes -->
        </div>
    </section>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Tienda. Todos los derechos reservados.</p>
    </footer>

    <script src="script.js"></script>
</body>
</html>
