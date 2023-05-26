<?php
ini_set('display_errors', 1);
error_reporting(E_ALL);

session_start();
require_once 'includes/functions.php';

// Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $id = $_POST['id'];
    $nombre = $_POST['nombre'];
    $descripcion = $_POST['descripcion'];
    $stock = $_POST['stock'];
    $precioVenta = $_POST['precioVenta'];

    $result = updateProduct($id, $nombre, $descripcion, $stock, $precioVenta);

    if ($result) {
        header('Location: dashboard.php');
        exit();
    } else {
        $editError = "Ocurrió un error al actualizar el producto. Por favor, inténtalo de nuevo.";
    }
} else {
    if (isset($_GET['id'])) {
        $id = $_GET['id'];
        $product = getProductById($id);

        if (!$product) {
            header('Location: dashboard.php');
            exit();
        }
    } else {
        header('Location: dashboard.php');
        exit();
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Editar producto</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Editar producto</h1>
        <?php if (isset($editError)) : ?>
            <div class="error"><?php echo $editError; ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <input type="hidden" name="id" value="<?php echo $product['IdProducto']; ?>">
            <input type="text" name="nombre" placeholder="Nombre" value="<?php echo $product['Nombre']; ?>" required><br>
            <input type="text" name="descripcion" placeholder="Descripción" value="<?php echo $product['Descripcion']; ?>" required><br>
            <input type="number" name="stock" placeholder="Stock" value="<?php echo $product['Stock']; ?>" required><br>
            <input type="number" name="precioVenta" placeholder="Precio de Venta" value="<?php echo $product['PrecioVenta']; ?>" required><br>
            <input type="submit" value="Guardar cambios">
        </form>
    </div>
</body>
</html>
