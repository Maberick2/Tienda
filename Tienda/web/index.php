<?php
session_start();

$start_time = microtime(true);

$metrics = [];

if (!isset($_SESSION['usuario'])) {
    $metrics[] = [
        'metric' => 'Verificación de sesión',
        'status' => 'Fallida',
        'timestamp' => date('Y-m-d H:i:s')
    ];
    header("Location: registro.php");
    exit();
} else {
    $metrics[] = [
        'metric' => 'Verificación de sesión',
        'status' => 'Exitosa',
        'timestamp' => date('Y-m-d H:i:s')
    ];
}

$load_time = microtime(true) - $start_time;
$metrics[] = [
    'metric' => 'Tiempo de carga',
    'value' => $load_time,
    'timestamp' => date('Y-m-d H:i:s')
];

file_put_contents('metrics.log', json_encode($metrics) . PHP_EOL, FILE_APPEND);

?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Tienda Mejorada</title>
    <link rel="stylesheet" href="luis.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
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

    <section class="carousel-section">
        <div id="carouselExampleCaptions" class="carousel slide" data-bs-ride="carousel">
            <div class="carousel-indicators">
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="0" class="active" aria-current="true" aria-label="Slide 1"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="1" aria-label="Slide 2"></button>
                <button type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide-to="2" aria-label="Slide 3"></button>
            </div>
            <div class="carousel-inner">
                <div class="carousel-item active">
                    <img src="https://via.placeholder.com/800x300?text=Imagen+1" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Primera imagen</h5>
                        <p>ferefr.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://via.placeholder.com/800x300?text=Imagen+2" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Segunda imagen</h5>
                        <p>efki.</p>
                    </div>
                </div>
                <div class="carousel-item">
                    <img src="https://via.placeholder.com/800x300?text=Imagen+3" class="d-block w-100" alt="...">
                    <div class="carousel-caption d-none d-md-block">
                        <h5>Tercera imagen</h5>
                        <p>vrr.</p>
                    </div>
                </div>
            </div>
            <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="prev">
                <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Previous</span>
            </button>
            <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleCaptions" data-bs-slide="next">
                <span class="carousel-control-next-icon" aria-hidden="true"></span>
                <span class="visually-hidden">Next</span>
            </button>
        </div>
    </section>

    <section class="welcome-section">
        <h1>Bienvenido a nuestra Tienda</h1>
        <p>Explora nuestros productos y regístrate para gestionar tu cuenta.</p>
    </section>

    <footer>
        <p>&copy; 2024 Tienda. Todos los derechos reservados.</p>
    </footer>

    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
