<?php

require_once __DIR__ . '/../models/ProductoModel.php';

class ProductoController
{
    private ProductoModel $modelo;

    public function __construct(PDO $conexion)
    {
        $this->modelo = new ProductoModel($conexion);
    }

    public function index(): void
    {
        $termino = trim($_GET['termino'] ?? '');

        $productos = $termino !== ''
            ? $this->modelo->buscarPorNombre($termino)
            : $this->modelo->listarTodos();

        $mensaje = $_SESSION['mensaje'] ?? null;
        $tipoMensaje = $_SESSION['tipo_mensaje'] ?? null;
        unset($_SESSION['mensaje'], $_SESSION['tipo_mensaje']);

        $csrfToken = $this->obtenerTokenCSRF();

        require __DIR__ . '/../views/index.php';
    }

    public function guardar(): void
    {
        $nombre = trim($_POST['nombre'] ?? '');
        $descripcion = trim($_POST['descripcion'] ?? '');
        $categoria = trim($_POST['categoria'] ?? '');
        $precio = $_POST['precio'] ?? '';
        $cantidad = $_POST['cantidad'] ?? '';

        $errores = $this->validar($nombre, $descripcion, $categoria, $precio, $cantidad);

        if (!empty($errores)) {
            $_SESSION['mensaje'] = implode(' ', $errores);
            $_SESSION['tipo_mensaje'] = 'error';
            $this->redirigir();
        }

        $creado = $this->modelo->crear(
            $nombre,
            $descripcion,
            $categoria,
            (float) $precio,
            (int) $cantidad
        );

        $_SESSION['mensaje'] = $creado
            ? 'Producto registrado correctamente.'
            : 'No se pudo registrar el producto.';
        $_SESSION['tipo_mensaje'] = $creado ? 'exito' : 'error';

        $this->redirigir();
    }

    public function eliminar(): void
    {
        $id = $_POST['id'] ?? null;
        $token = $_POST['csrf_token'] ?? '';

        if (!$this->validarTokenCSRF($token)) {
            $_SESSION['mensaje'] = 'Solicitud inválida. Intenta nuevamente.';
            $_SESSION['tipo_mensaje'] = 'error';
            $this->redirigir();
        }

        if (!ctype_digit((string) $id)) {
            $_SESSION['mensaje'] = 'Identificador de producto inválido.';
            $_SESSION['tipo_mensaje'] = 'error';
            $this->redirigir();
        }

        $eliminado = $this->modelo->eliminarPorId((int) $id);

        $_SESSION['mensaje'] = $eliminado
            ? 'Producto eliminado correctamente.'
            : 'No se pudo eliminar el producto.';
        $_SESSION['tipo_mensaje'] = $eliminado ? 'exito' : 'error';

        $this->redirigir();
    }

    private function validar(string $nombre, string $descripcion, string $categoria, $precio, $cantidad): array
    {
        $errores = [];

        if ($nombre === '' || mb_strlen($nombre) < 3) {
            $errores[] = 'El nombre debe tener al menos 3 caracteres.';
        } elseif (mb_strlen($nombre) > 100) {
            $errores[] = 'El nombre no puede superar los 100 caracteres.';
        }

        if (mb_strlen($descripcion) > 255) {
            $errores[] = 'La descripción no puede superar los 255 caracteres.';
        }

        if ($categoria === '') {
            $errores[] = 'La categoría es obligatoria.';
        } elseif (mb_strlen($categoria) > 50) {
            $errores[] = 'La categoría no puede superar los 50 caracteres.';
        }

        if ($precio === '' || !is_numeric($precio) || (float) $precio <= 0) {
            $errores[] = 'El precio debe ser un número mayor que 0.';
        }

        if ($cantidad === '' || !ctype_digit((string) $cantidad) || (int) $cantidad < 0) {
            $errores[] = 'La cantidad debe ser un número entero mayor o igual a 0.';
        }

        return $errores;
    }

    private function obtenerTokenCSRF(): string
    {
        if (empty($_SESSION['csrf_token'])) {
            $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
        }

        return $_SESSION['csrf_token'];
    }

    private function validarTokenCSRF(string $token): bool
    {
        return $token !== '' && hash_equals($_SESSION['csrf_token'] ?? '', $token);
    }

    private function redirigir(): void
    {
        header('Location: index.php');
        exit;
    }
}
