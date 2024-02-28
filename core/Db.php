<?php
namespace core;

class DB {

    private $host = '';
    private $username = '';
    private $password = '';
    private $database = '';
    private $port = '';
    private $charset = '';

    private $pdo;
    private $options;
    private $dsn;

    public function __construct() {
        $this->dsn = "mysql:host={$this->host};port={$this->port};dbname={$this->database};charset={$this->charset}";

        $this->options = [
            PDO::ATTR_ERRMODE  => PDO::ERRMODE_EXCEPTION,
            PDO::ATTR_DEFAULT_FETCH_MODE => PDO::FETCH_ASSOC,
            PDO::ATTR_EMULATE_PREPARES   => false,
        ];
    }

    static function connection() {
        try {
            return $this->pdo = new PDO($this->dsn, $this->username, $this->password, $this->options);
        } catch (PDOException $e) {
            throw new PDOException($e->getMessage(), (int)$e->getCode());
        }
    }
}
