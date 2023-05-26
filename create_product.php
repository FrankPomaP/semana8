<?php
session_start();
require_once 'includes/functions.php';

// Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Crear un nuevo producto
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $stock = $_POST['stock'];
    $precioVenta = $_POST['precioVenta'];

    $result = createProduct($nombre, $descripcion, $stock, $precioVenta);

    if ($result) {
        header('Location: dashboard.php');
        exit();
    } else {
        $createError = "Ocurrió un error al crear el producto. Por favor, inténtalo de nuevo.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Agregar nuevo producto</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Agregar nuevo producto</h1>
        <?php if (isset($createError)) : ?>
            <div class="error"><?php echo $createError; ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <input type="text" name="nombre" placeholder="Nombre" required><br>
            <input type="text" name="descripcion" placeholder="Descripción" required><br>
            <input type="number" name="stock" placeholder="Stock" required><br>
            <input type="number" step="0.01" name="precioVenta" placeholder="Precio de Venta" required><br>
            <input type="submit" value="Agregar">
        </form>
        <a href="dashboard.php">Volver al panel de control</a>
    </div>
</body>
</html>
