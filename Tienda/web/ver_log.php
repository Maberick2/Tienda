<?php
if (file_exists('metrics.log')) {
    echo "<pre>" . htmlspecialchars(file_get_contents('metrics.log')) . "</pre>";
} else {
    echo "El archivo metrics.log no existe.";
}
?>
