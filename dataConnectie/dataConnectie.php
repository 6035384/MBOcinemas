<?php

class Database {
    private $host;
    private $dbname;
    private $username;
    private $password;
    private $port;
    private $pdo;

    public function __construct($host, $dbname, $username, $password, $port) {
        $this->host = $host;
        $this->dbname = $dbname;
        $this->username = $username;
        $this->password = $password;
        $this->port = $port;
    }

    public function connect() {
        try {
            $this->pdo = new PDO("mysql:host={$this->host};port={$this->port};dbname={$this->dbname};", $this->username, $this->password);
            $this->pdo->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
        } catch (PDOException $e) {
            echo "Fout bij database: " . $e->getMessage();
            exit();
        }
    }

    public function getPDO() {
        return $this->pdo;
    }
}

$host = "localhost";
$dbname = "cinema.sql";
$username = "123";
$port = "3306";
$password = "";

$database = new Database($host, $dbname, $username, $password, $port);
$database->connect();
$pdo = $database->getPDO();

?>
