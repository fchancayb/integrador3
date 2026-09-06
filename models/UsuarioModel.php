<?php

class UsuarioModel
{
    private PDO $conexion;

    public function __construct(PDO $conexion)
    {
        $this->conexion = $conexion;
    }

    public function buscarPorUsuario(string $usuario): ?array
    {
        $stmt = $this->conexion->prepare('SELECT * FROM usuarios WHERE usuario = :usuario');
        $stmt->execute([':usuario' => $usuario]);

        $fila = $stmt->fetch();

        return $fila ?: null;
    }
}
