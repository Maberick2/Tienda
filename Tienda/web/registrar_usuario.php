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
    
    if ($stmt->execute()) {
        // Redirigir al usuario a la página de inicio o de login
        header("Location: iniciar_sesion.php");
        exit();  // Asegúrate de que el script se detenga después de la redirección
    } else {
        echo "Error al registrar: " . mysqli_error($conexion);
    }

    $stmt->close();
}
?>
