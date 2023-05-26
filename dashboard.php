<?php
session_start();
require_once 'includes/functions.php';

// Si el usuario no ha iniciado sesión, redirigir a la página de inicio de sesión
if (!isset($_SESSION['user_id'])) {
    header('Location: index.php');
    exit();
}

// Obtener todos los productos
$products = getAllProducts();

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    // Buscar productos por término de búsqueda
    $searchTerm = $_POST['search'];
    $products = searchProducts($searchTerm);
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Panel de control</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Bienvenido al panel de control</h1>
        <form method="post" action="">
            <input type="text" name="search" placeholder="Buscar productos">
            <input type="submit" value="Buscar">
        </form>
        <h2>Productos</h2>
        <table>
            <thead>
                <tr>
                    <th>IdProducto</th>
                    <th>Nombre</th>
                    <th>Descripción</th>
                    <th>Stock</th>
                    <th>Precio de Venta</th>
                    <th>Acciones</th>
                </tr>
            </thead>
            <tbody>
                <?php foreach ($products as $product) : ?>
                    <tr>
                        <td><?php echo $product['IdProducto']; ?></td>
                        <td><?php echo $product['Nombre']; ?></td>
                        <td><?php echo $product['Descripcion']; ?></td>
                        <td><?php echo $product['Stock']; ?></td>
                        <td><?php echo $product['PrecioVenta']; ?></td>
                        <td>
                            <a href="edit_product.php?id=<?php echo $product['IdProducto']; ?>">Editar</a>
                            <a href="delete_product.php?id=<?php echo $product['IdProducto']; ?>">Eliminar</a>
                        </td>
                    </tr>
                <?php endforeach; ?>
            </tbody>
        </table>
        <a href="create_product.php">Agregar nuevo producto</a>
        <br>
        <a href="logout.php">Cerrar sesión</a>
    </div>
</body>
</html>
