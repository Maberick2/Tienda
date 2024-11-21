<?php
session_start();
include 'conexion.php';

if (!isset($_SESSION['usuario'])) {
    header("Location: registro.php");
    exit();
}

$mensaje = "";
$color = "#2ecc71"; // Color inicial para el mensaje de éxito

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $id_producto = $_POST['id_producto'];

    // Verificar si el producto existe
    $stmt = $conexion->prepare("SELECT id FROM productos WHERE id = ?");
    $stmt->bind_param("i", $id_producto);
    $stmt->execute();
    $stmt->store_result();

    if ($stmt->num_rows > 0) {
        // Si el producto existe, proceder a eliminarlo
        $stmt->close();
        $stmt = $conexion->prepare("DELETE FROM productos WHERE id = ?");
        $stmt->bind_param("i", $id_producto);

        if ($stmt->execute()) {
            // Mensaje de éxito
            $mensaje = "Producto eliminado exitosamente.";
        } else {
            // Mensaje de error
            $mensaje = "Error al eliminar el producto: " . $conexion->error;
        }
    } else {
        // Producto no existente
        $mensaje = "Producto no existente.";
        $color = "#e74c3c"; // Rojo para el mensaje de error
    }

    $stmt->close();
}
?>

<!-- Formulario para eliminar producto -->
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Eliminar Producto</title>
    <link rel="stylesheet" href="eliminar.css">
    <style>
        /* Estilos para la notificación centrada */
        .notification {
            visibility: hidden;
            min-width: 250px;
            color: white;
            text-align: center;
            padding: 15px;
            position: fixed;
            z-index: 1;
            left: 50%;
            top: 50%;
            transform: translate(-50%, -50%); /* Centrar en la pantalla */
            font-size: 17px;
            border-radius: 4px;
        }

        .notification.show {
            visibility: visible;
            animation: fadein 0.5s, fadeout 0.5s 2.5s;
        }

        @keyframes fadein {
            from {opacity: 0;}
            to {opacity: 1;}
        }

        @keyframes fadeout {
            from {opacity: 1;}
            to {opacity: 0;}
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

    <h2>Eliminar Producto</h2>

    <!-- Formulario para eliminar producto -->
    <form method="POST" action="eliminar_producto.php">
        <input type="number" name="id_producto" placeholder="ID del Producto" required>
        <button type="submit">Eliminar Producto</button>
    </form>

    <!-- Notificación flotante -->
    <div id="notification" class="notification" style="background-color: <?php echo $color; ?>;"><?php echo htmlspecialchars($mensaje); ?></div>

    <script>
        // Mostrar la notificación si hay un mensaje
        document.addEventListener("DOMContentLoaded", function() {
            var mensaje = "<?php echo $mensaje; ?>";
            if (mensaje !== "") {
                var notification = document.getElementById("notification");
                notification.classList.add("show");
                setTimeout(function() {
                    notification.classList.remove("show");
                }, 1000); // Notificación visible durante 3 segundos
            }
        });
    </script>

    <!-- Footer -->
    <footer>
        <p>&copy; 2024 Tienda. Todos los derechos reservados.</p>
    </footer>
</body>
</html>
