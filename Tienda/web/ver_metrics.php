<?php
$metrics = [];

if (file_exists('metrics.log')) {
    $lines = file('metrics.log'); // Lee todas las líneas del archivo
    foreach ($lines as $line) {
        $decoded_line = json_decode(trim($line), true);
        if (is_array($decoded_line)) {
            // Agrega cada métrica al array $metrics
            foreach ($decoded_line as $metric) {
                $metrics[] = $metric;
            }
        }
    }
} else {
    echo "El archivo metrics.log no existe.";
    exit();
}
?>

<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Métricas</title>
    <link rel="stylesheet" href="lol.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.1.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body>
    <div class="container">
        <h1>Métricas</h1>
        <table class="table">
            <thead>
                <tr>
                    <th>Métrica</th>
                    <th>Estado/Valor</th>
                    <th>Timestamp</th>
                </tr>
            </thead>
            <tbody>
                <?php if (!empty($metrics)): ?>
                    <?php foreach ($metrics as $metric): ?>
                        <tr>
                            <td><?php echo htmlspecialchars($metric['metric'] ?? 'No disponible'); ?></td>
                            <td><?php echo htmlspecialchars(isset($metric['status']) ? $metric['status'] : ($metric['value'] ?? 'No disponible')); ?></td>
                            <td><?php echo htmlspecialchars($metric['timestamp'] ?? 'No disponible'); ?></td>
                        </tr>
                    <?php endforeach; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="3">No hay métricas disponibles.</td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</body>
</html>
