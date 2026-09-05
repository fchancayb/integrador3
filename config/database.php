<?php

class Database
{
    private string $host = 'localhost';
    private string $dbName = 'integradora';
    private string $user = 'root';
    private string $password = '';

    public function getConnection(): PDO
    {
        $dsn = "mysql:host={$this->host};dbname={$this->dbName};charset=utf8mb4";

        return new PDO($dsn, $this->user, $this->password, [
            PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
        ]);
    }
}
