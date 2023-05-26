<?php
session_start();
require_once 'includes/functions.php';

// Si el usuario ya ha iniciado sesión, redirigir al panel de control
if (isset($_SESSION['user_id'])) {
    header('Location: dashboard.php');
    exit();
}

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $nombre = $_POST['nombre'];
    $apellidoPaterno = $_POST['apellidoPaterno'];
    $apellidoMaterno = $_POST['apellidoMaterno'];
    $direccion = $_POST['direccion'];
    $email = $_POST['email'];
    $telefono = $_POST['telefono'];
    $password = $_POST['password'];

    if (emailExists($email)) {
        $registerError = "Ya existe una cuenta con ese email. Por favor, utiliza otro email.";
    } else {
        $result = createUser($nombre, $apellidoPaterno, $apellidoMaterno, $direccion, $email, $telefono, $password);

        if ($result) {
            $_SESSION['user_id'] = $conn->lastInsertId();
            header('Location: dashboard.php');
            exit();
        } else {
            $registerError = "Ocurrió un error al registrar el usuario. Por favor, inténtalo de nuevo.";
        }
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <title>Registrarse</title>
    <link rel="stylesheet" type="text/css" href="css/style.css">
</head>
<body>
    <div class="container">
        <h1>Registrarse</h1>
        <?php if (isset($registerError)) : ?>
            <div class="error"><?php echo $registerError; ?></div>
        <?php endif; ?>
        <form method="post" action="">
            <input type="text" name="nombre" placeholder="Nombre" required><br>
            <input type="text" name="apellidoPaterno" placeholder="Apellido Paterno" required><br>
            <input type="text" name="apellidoMaterno" placeholder="Apellido Materno" required><br>
            <input type="text" name="direccion" placeholder="Dirección" required><br>
            <input type="email" name="email" placeholder="Email" required><br>
            <input type="text" name="telefono" placeholder="Teléfono" required><br>
            <input type="password" name="password" placeholder="Contraseña" required><br>
            <input type="submit" value="Registrarse">
        </form>
        <p>¿Ya tienes una cuenta? <a href="index.html">Inicia sesión aquí</a></p>
    </div>
</body>
</html>
