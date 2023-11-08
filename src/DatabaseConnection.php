<?php

namespace Unialfa;

use PDO;

class DatabaseConnection {
    private $host;
    private $port;
    private $username;
    private $password;
    private $dbname;
    private $charset;

    private $pdo;

    public function __construct($host, $port, $username, $password, $dbname, $charset = 'utf8') {
        $this->host = $host;
        $this->port = $port;
        $this->username = $username;
        $this->password = $password;
        $this->dbname = $dbname;
        $this->charset = $charset;

        $this->connect();
    }

    private function connect() {
        $dsn = "mysql:host=$this->host;dbname=$this->dbname;charset=$this->charset";
        $options = [
            PDO::ATTR_ERRMODE            => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];

        try {
            $this->pdo = new PDO($dsn, $this->username, $this->password, $options);
        } catch (\PDOException $e) {
            throw new \PDOException($e->getMessage(), (int)$e->getCode());
        }
    }

    public function query($query, $params = []) {
        $statement = $this->pdo->prepare($query);
        $statement->execute($params);
        return $statement;
    }

    // Adicione mais métodos conforme necessário, como insert, update, delete, etc.

    public function closeConnection() {
        $this->pdo = null;
    }
}