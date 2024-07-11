<?php 
namespace MinhasTarefas\Service;

class SqlService
{
    private $host;
    private $database_name;
    private $username;
    private $password;
    public $conexao;

    public function __construct()
    {       
        $this->host = $_ENV['DB_HOST'];
        $this->database_name = $_ENV['DB_NAME'];
        $this->username = $_ENV['DB_USER'];
        $this->password = $_ENV['DB_PASS'];
    }

    public function dbConnection()
    {
        $this->conexao = null;
        try {
            $this->conexao = new \PDO(
                "mysql:host={$this->host};dbname={$this->database_name}",
                $this->username,
                $this->password
            );
            $this->conexao->setAttribute(
                \PDO::ATTR_ERRMODE,
                \PDO::ERRMODE_EXCEPTION
            );
        } catch (\PDOException $exception) {
            echo 'Connection error: ' . $exception->getMessage();
        }
        return $this->conexao;
    }
}
