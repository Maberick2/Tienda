<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];
    $email = $_POST['email'];

    // Hash de la contraseña
    $hashed_password = password_hash($password, PASSWORD_DEFAULT);

    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conexion->prepare("INSERT INTO usuarios (username, password, email) VALUES (?, ?, ?)");
    $stmt->bind_param("sss", $username, $hashed_password, $email);
    header("Location: iniciar_sesion.php");
    
    if ($stmt->execute()) {
        // Mostrar un mensaje en la misma página
        $mensaje = "Registro exitoso. Ahora puedes iniciar sesión.";
    } else {
        $mensaje = "Error al registrar: " . mysqli_error($conexion);
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Registro</title>
    <link rel="stylesheet" href="registro.css">
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
        <h2>Registro</h2>
        
        <!-- Mostrar el mensaje si existe -->
        <?php if (isset($mensaje)): ?>
            <p><?php echo $mensaje; ?></p>
        <?php endif; ?>

        <form action="registro.php" method="POST">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <label for="email">Correo Electrónico:</label>
            <input type="email" id="email" name="email" required>

            <button type="submit">Registrar</button>
            <button type="button" onclick="window.location.href='iniciar_sesion.php';">Iniciar sesión</button>

        </form>
    </section>
    
    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Tienda. Todos los derechos reservados.</p>
    </footer>
    
</body>
</html>
