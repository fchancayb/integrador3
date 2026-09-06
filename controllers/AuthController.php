<?php

require_once __DIR__ . '/../models/UsuarioModel.php';

class AuthController
{
    private UsuarioModel $modelo;

    public function __construct(PDO $conexion)
    {
        $this->modelo = new UsuarioModel($conexion);
    }

    public function login(): void
    {
        if ($_SERVER['REQUEST_METHOD'] === 'POST') {
            $this->procesarLogin();
            return;
        }

        $mensaje = $_SESSION['mensaje'] ?? null;
        $tipoMensaje = $_SESSION['tipo_mensaje'] ?? null;
        unset($_SESSION['mensaje'], $_SESSION['tipo_mensaje']);

        require __DIR__ . '/../views/login.php';
    }

    public function logout(): void
    {
        $_SESSION = [];
        session_destroy();

        header('Location: index.php?accion=login');
        exit;
    }

    private function procesarLogin(): void
    {
        $usuario = trim($_POST['usuario'] ?? '');
        $contrasena = $_POST['contrasena'] ?? '';

        $datosUsuario = $usuario !== '' ? $this->modelo->buscarPorUsuario($usuario) : null;

        if ($datosUsuario && password_verify($contrasena, $datosUsuario['password'])) {
            session_regenerate_id(true);
            $_SESSION['usuario_id'] = $datosUsuario['id'];
            $_SESSION['usuario_nombre'] = $datosUsuario['usuario'];

            header('Location: index.php');
            exit;
        }

        $_SESSION['mensaje'] = 'Usuario o contraseña incorrectos.';
        $_SESSION['tipo_mensaje'] = 'error';

        header('Location: index.php?accion=login');
        exit;
    }
}
