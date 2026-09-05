<?php

session_start();

require_once __DIR__ . '/config/database.php';
require_once __DIR__ . '/controllers/ProductoController.php';

$database = new Database();
$conexion = $database->getConnection();
$controlador = new ProductoController($conexion);

$accion = $_GET['accion'] ?? 'listar';

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
