<?php

session_start();

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/controllers/ProductoController.php';
require_once __DIR__ . '/controllers/AuthController.php';

try {
    $database = new Database();
    $conexion = $database->getConnection();
    $autenticador = new AuthController($conexion);

    $accion = $_GET['accion'] ?? 'listar';

    if ($accion === 'logout') {
        $autenticador->logout();
    } elseif (empty($_SESSION['usuario_id'])) {
        $autenticador->login();
    } else {
        $controlador = new ProductoController($conexion);

        switch ($accion) {
            case 'guardar':
                $controlador->guardar();
                break;

            case 'eliminar':
                $controlador->eliminar();
                break;

            case 'listar':
            default:
                $controlador->index();
                break;
        }
    }
} catch (PDOException $e) {
    error_log('Error de base de datos: ' . $e->getMessage());
    http_response_code(500);
    require __DIR__ . '/views/error.php';
}
