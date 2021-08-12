<?php
namespace Database;


use PDO;
use PDOException;

class DB
{
    protected $pdo;
    public function __construct()
    {
        try {
            $this->pdo = new PDO($this->getDsn(), $this->getUsername(), $this->getPassword());
        } catch (PDOException $e) {
            //Логирование;
            echo 'Fail: check logs';
        }
    }

    private $host = '127.0.0.1';
    private $username = 'root';
    private $password = '123123';
    private $db = 'database';


    private function getDsn()
    {
        return "mysql:dbname={$this->getDb()};host={$this->getHost()}";
    }

    /**
     * По идее эта штука должна быть более универсальной
     * @param string $table
     * @param string $column
     * @param string $operator
     * @param $value
     */
    public static function whereIn($value): array
    {
        $in = str_repeat('?,', count($value) - 1) . '?';
        $query = "SELECT * FROM users WHERE id IN ($in)";

        $pdoPrepare = (new DB)->getPdo()->prepare($query);
        $pdoPrepare->execute($value);

        while ($user = $pdoPrepare->fetchObject()) {
            $data[] = $user;
        }

        return $data;
    }

    /**
     * @return string
     */
    private function getHost(): string
    {
        return $this->host;
    }

    /**
     * @return string
     */
    private function getUsername(): string
    {
        return $this->username;
    }

    /**
     * @return string
     */
    private function getPassword(): string
    {
        return $this->password;
    }

    /**
     * @return string
     */
    private function getDb(): string
    {
        return $this->db;
    }

    /**
     * @return PDO
     */
    public function getPdo(): PDO
    {
        return $this->pdo;
    }
}
