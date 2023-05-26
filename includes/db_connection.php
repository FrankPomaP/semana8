<?php
$host = 'localhost';
$db_name = 'eval02';
$username = 'root';
$password = 'usbw';

try {
    $conn = new PDO("mysql:host=$host;dbname=$db_name", $username, $password);
    $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
} catch(PDOException $e) {
    die("Error al conectar con la base de datos: " . $e->getMessage());
}
?>
