<?php
session_start();
require_once 'includes/functions.php';

if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $email = $_POST['email'];
    $password = $_POST['password'];

    $user = getUserByEmailAndPassword($email, $password);

    if ($user) {
        $_SESSION['user_id'] = $user['IdUsuario'];
        header('Location: dashboard.php');
        exit();
    } else {
        echo "Usuario no encontrado. Por favor, verifica tus credenciales.";
    }
}
?>
