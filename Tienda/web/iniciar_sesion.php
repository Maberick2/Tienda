<?php
session_start();
include 'conexion.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $username = $_POST['username'];
    $password = $_POST['password'];

    // Preparar la consulta para evitar inyecciones SQL
    $stmt = $conexion->prepare("SELECT password FROM usuarios WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        $stmt->bind_result($hashed_password);
        $stmt->fetch();

        // Verificar la contraseña ingresada con el hash
        if (password_verify($password, $hashed_password)) {
            $_SESSION['usuario'] = $username;
            header("Location: index.php");
            exit();
        } else {
            echo "Usuario o contraseña incorrectos.";
        }
    } else {
        echo "Usuario o contraseña incorrectos.";
    }

    $stmt->close();
}
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Iniciar Sesión</title>
    <link rel="stylesheet" href="registro.css">
    <style>
        /* Estilos para la notificación */
        .notification {
            padding: 15px;
            background-color: #4CAF50; /* Color de fondo verde */
            color: white; /* Color del texto */
            margin-bottom: 15px; /* Espaciado inferior */
            border-radius: 5px; /* Bordes redondeados */
            display: flex;
            justify-content: space-between;
            align-items: center;
        }
        .notification .close {
            cursor: pointer;
            font-weight: bold;
        }
    </style>
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
        <h2>Iniciar Sesión</h2>
     
        <form action="iniciar_sesion.php" method="POST">
            <label for="username">Nombre de Usuario:</label>
            <input type="text" id="username" name="username" required>

            <label for="password">Contraseña:</label>
            <input type="password" id="password" name="password" required>

            <button type="submit">Iniciar Sesión</button>
            <button type="button" onclick="window.location.href='registro.php';">Registrarse</button>

        </form>
    </section>
    <footer>
        <p>&copy; 2024 Tienda. Todos los derechos reservados.</p>
    </footer>
</body>
</html>

