<?php
require_once 'db_connection.php';

// Verificar si el email existe en la tabla de usuarios
function emailExists($email) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE Email = :email");
    $stmt->bindParam(':email', $email);
    $stmt->execute();

    return $stmt->rowCount() > 0;
}

// Crear un nuevo usuario en la tabla de usuarios
function createUser($nombre, $apellidoPaterno, $apellidoMaterno, $direccion, $email, $telefono, $password) {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO usuarios (Nombre, ApellidoPaterno, ApellidoMaterno, Direccion, Email, Telefono, Password) VALUES (:nombre, :apellidoPaterno, :apellidoMaterno, :direccion, :email, :telefono, :password)");
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':apellidoPaterno', $apellidoPaterno);
    $stmt->bindParam(':apellidoMaterno', $apellidoMaterno);
    $stmt->bindParam(':direccion', $direccion);
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':telefono', $telefono);
    $stmt->bindParam(':password', $password);

    return $stmt->execute();
}

// Obtener usuario por email y contraseña
function getUserByEmailAndPassword($email, $password) {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM usuarios WHERE Email = :email AND Password = :password");
    $stmt->bindParam(':email', $email);
    $stmt->bindParam(':password', $password);
    $stmt->execute();

    return $stmt->fetch(PDO::FETCH_ASSOC);
}

// Obtener todos los productos
function getAllProducts() {
    global $conn;

    $stmt = $conn->prepare("SELECT * FROM productos");
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}
// Obtener un producto por su ID
function getProductById($id) {
    global $conn;
    $query = "SELECT * FROM productos WHERE IdProducto = :id";
    $stmt = $conn->prepare($query);
    $stmt->bindParam(':id', $id);
    $stmt->execute();
    return $stmt->fetch(PDO::FETCH_ASSOC);
}
// Buscar productos por término de búsqueda
function searchProducts($searchTerm) {
    global $conn;

    $searchTerm = "%$searchTerm%";

    $stmt = $conn->prepare("SELECT * FROM productos WHERE Nombre LIKE :searchTerm");
    $stmt->bindParam(':searchTerm', $searchTerm);
    $stmt->execute();

    return $stmt->fetchAll(PDO::FETCH_ASSOC);
}

// Crear un nuevo producto
function createProduct($nombre, $descripcion, $stock, $precioVenta) {
    global $conn;

    $stmt = $conn->prepare("INSERT INTO productos (Nombre, Descripcion, Stock, PrecioVenta) VALUES (:nombre, :descripcion, :stock, :precioVenta)");
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':stock', $stock);
    $stmt->bindParam(':precioVenta', $precioVenta);

    return $stmt->execute();
}


// Actualizar un producto existente
function updateProduct($id, $nombre, $descripcion, $stock, $precioVenta) {
    global $conn;

    $stmt = $conn->prepare("UPDATE productos SET Nombre = :nombre, Descripcion = :descripcion, Stock = :stock, PrecioVenta = :precioVenta WHERE IdProducto = :id");
    $stmt->bindParam(':nombre', $nombre);
    $stmt->bindParam(':descripcion', $descripcion);
    $stmt->bindParam(':stock', $stock);
    $stmt->bindParam(':precioVenta', $precioVenta);
    $stmt->bindParam(':id', $id);

    return $stmt->execute();
}

// Eliminar un producto
function deleteProduct($id){
    global $conn;

    $stmt = $conn->prepare("DELETE FROM productos WHERE IdProducto = :id");
    $stmt->bindParam(':id', $id);

    return $stmt->execute();
}
?>
