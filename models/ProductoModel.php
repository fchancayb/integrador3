<?php

class ProductoModel
{
    private PDO $conexion;

    public function __construct(PDO $conexion)
    {
        $this->conexion = $conexion;
    }

    public function crear(string $nombre, string $descripcion, string $categoria, float $precio, int $cantidad): bool
    {
        $sql = "INSERT INTO productos (nombre, descripcion, categoria, precio, cantidad)
                VALUES (:nombre, :descripcion, :categoria, :precio, :cantidad)";

        $stmt = $this->conexion->prepare($sql);

        return $stmt->execute([
            ':nombre' => $nombre,
            ':descripcion' => $descripcion,
            ':categoria' => $categoria,
            ':precio' => $precio,
            ':cantidad' => $cantidad,
        ]);
    }

    public function listarTodos(): array
    {
        $stmt = $this->conexion->query("SELECT * FROM productos ORDER BY id DESC");

        return $stmt->fetchAll();
    }

    public function buscarPorNombre(string $termino): array
    {
        $sql = "SELECT * FROM productos
                WHERE nombre LIKE :termino OR categoria LIKE :termino
                ORDER BY id DESC";

        $stmt = $this->conexion->prepare($sql);
        $stmt->execute([':termino' => "%{$termino}%"]);

        return $stmt->fetchAll();
    }

    public function eliminarPorId(int $id): bool
    {
        $stmt = $this->conexion->prepare("DELETE FROM productos WHERE id = :id");

        return $stmt->execute([':id' => $id]);
    }
}
