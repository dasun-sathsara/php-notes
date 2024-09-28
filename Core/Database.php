<?php

namespace Core;

use PDO;
use PDOException;
use PDOStatement;

class Database
{
    private $connection;

    public function __construct(array $config)
    {
        try {
            $username = $config['username'];
            $password = $config['password'];

            unset($config['username']);
            unset($config['password']);

            $dsn = "mysql:" . http_build_query($config, "", ";");
            $this->connection = new PDO($dsn, $username, $password);

            // set the PDO error mode to exception
            $this->connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            die("Connection failed: " . $e->getMessage());
        }
    }

    public function query(string $sql, array $params = []): PDOStatement
    {
        $statement = $this->connection->prepare($sql);
        $statement->execute($params);

        return $statement;
    }

    public function fetchOne(string $sql, array $params = []): array|false
    {
        return $this->query($sql, $params)->fetch(PDO::FETCH_ASSOC);
    }

    public function fetchAll(string $sql, array $params = []): array
    {
        return $this->query($sql, $params)->fetchAll(PDO::FETCH_ASSOC);
    }
}
