<?php

require_once __DIR__ . '/../config/database.php';

$conexion = (new Database())->getConnection();
$totalUsuarios = (int) $conexion->query('SELECT COUNT(*) AS total FROM usuarios')->fetch()['total'];

$mensaje = null;
$creado = false;

if ($totalUsuarios > 0) {
    $mensaje = 'Ya existe al menos un usuario registrado. Por seguridad, este script no permite crear más.';
} elseif ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $usuario = trim($_POST['usuario'] ?? '');
    $contrasena = $_POST['contrasena'] ?? '';

    if ($usuario === '' || $contrasena === '') {
        $mensaje = 'Usuario y contraseña son obligatorios.';
    } else {
        $stmt = $conexion->prepare('INSERT INTO usuarios (usuario, password) VALUES (:usuario, :password)');
        $stmt->execute([
            ':usuario' => $usuario,
            ':password' => password_hash($contrasena, PASSWORD_BCRYPT),
        ]);

        $creado = true;
        $mensaje = 'Usuario creado correctamente. Ya puedes iniciar sesión y eliminar este archivo (database/crear_admin.php).';
    }
}

$mostrarFormulario = $totalUsuarios === 0 && !$creado;
?>
<!DOCTYPE html>
<html lang="es">
<head>
    <meta charset="UTF-8">
    <title>Crear usuario administrador</title>
</head>
<body>
    <h1>Crear usuario administrador</h1>

    <?php if ($mensaje): ?>
        <p><?php echo htmlspecialchars($mensaje); ?></p>
    <?php endif; ?>

    <?php if ($mostrarFormulario): ?>
        <form method="POST">
            <label>Usuario: <input type="text" name="usuario" required></label><br>
            <label>Contraseña: <input type="password" name="contrasena" required></label><br>
            <button type="submit">Crear</button>
        </form>
    <?php endif; ?>
</body>
</html>
