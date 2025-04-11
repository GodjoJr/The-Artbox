<?php


class Database extends PDO
{
    private string $host;
    private string $port;
    private string $user;
    private string $password;
    private string $database;
    private string $dsn;
    private PDO $pdo;

    public function __construct()
    {
        $config = require 'config.php';

        $this->host = $config['host'];
        $this->port = $config['port'];
        $this->user = $config['user'];
        $this->password = $config['password'];
        $this->database = $config['database'];

        $this->dsn = 'mysql:host=' . $this->host . ';port=' . $this->port . ';dbname=' . $this->database;
        try {
            $this->pdo = new PDO($this->dsn, $this->user, $this->password);
        } catch (PDOException | Exception $e) {
            echo $e->getMessage();
        }

    }

    public function get(string $table = 'oeuvres', array $data = [], array $where = [])
    {
        try {

            $columns = (count($data)) ? implode(', ', $data) : '*';

            $query = "SELECT $columns FROM $table";

            if (count($where) > 0) {
                $conditions = [];
                foreach ($where as $key => $value) {
                    $conditions[] = "$key = :$key";
                }
                $query .= ' WHERE ' . implode(' AND ', $conditions);
            }
            $statement = $this->pdo->prepare($query);

            $statement->execute($where); 

            return $statement->fetchAll(PDO::FETCH_ASSOC);
        } catch (PDOException | Exception $e) {
            echo $e->getMessage();
        }
    }

    public function insert(string $table, array $data = [])
    {
        try {
            $columns = implode(', ', array_keys($data));

            $placeholders = ':' . implode(', :', array_keys($data));

            $query = "INSERT INTO $table ($columns) VALUES ($placeholders)";

            $statement = $this->pdo->prepare($query);
            $statement->execute($data);

        } catch (PDOException | Exception $e) {
            echo $e->getMessage();
        }
    }
}