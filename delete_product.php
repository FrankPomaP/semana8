<?php
session_start();
require_once 'includes/functions.php';

// Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Obtener el ID del producto de la URL
if (isset($_GET['id'])) {
    $productId = $_GET['id'];

    // Eliminar el producto por ID
    $result = deleteProduct($productId);

    if ($result) {
        header('Location: dashboard.php');
        exit();
    } else {
        $deleteError = "Ocurrió un error al eliminar el producto. Por favor, inténtalo de nuevo.";
    }
} else {
    header('Location: dashboard.php');
    exit();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Eliminar producto</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Eliminar producto</h1>
        <?php if (isset($deleteError)) : ?>
            <div class="error"><?php echo $deleteError; ?></div>
        <?php endif; ?>
        <p>¿Estás seguro de que quieres eliminar este producto?</p>
        <form method="post" action="">
            <input type="submit" value="Eliminar">
        </form>
        <a href="dashboard.php">Cancelar</a>
    </div>
</body>
</html>
