<?php 
namespace MinhasTarefas\Model;

class Usuario{
    private string $table_name = "usuario";
    private $conexao;

    public int $id;
    public $nome;
    public $email;
    public $login;
    public $senha;

    public function __construct($db) {
        $this->conexao = $db;
    }

    // Criar usuário
    public function create() {
        $query = 'INSERT INTO ' . $this->table_name . ' SET nome = :nome, email = :email, login = :login, senha = :senha';
        $stmt = $this->conexao->prepare($query);
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->login = htmlspecialchars(strip_tags($this->login));
        $this->senha = password_hash($this->senha, PASSWORD_DEFAULT);
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':email', $this->email);
        $stmt->bindParam(':login', $this->login);
        $stmt->bindParam(':senha', $this->senha);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Ler usuários
    public function getAll() {
        $query = 'SELECT * FROM ' . $this->table_name;
        $stmt = $this->conexao->prepare($query);
        $stmt->execute();
        return $stmt->fetchAll(\PDO::FETCH_ASSOC);
    }

    // Obter usuário pelo ID
    public function getUserById($id) {
        $query = 'SELECT * FROM ' . $this->table_name . ' WHERE id = :id';
        $stmt = $this->conexao->prepare($query);
        $stmt->bindParam(':id', $id);
        $stmt->execute();
        $row = $stmt->fetch(\PDO::FETCH_ASSOC);
        if ($row) {
            $this->id = $row['id'];
            $this->nome = $row['nome'];
            $this->nome = $row['email'];
            $this->login = $row['login'];
            $this->senha = $row['senha'];
            return $row;
        }
        return [];
    }


    // Atualizar usuário
    public function update() {
        $query = 'UPDATE ' . $this->table_name . ' SET nome = :nome, email = :email, login = :login, senha = :senha WHERE id = :id';
        $stmt = $this->conexao->prepare($query);
        $this->nome = htmlspecialchars(strip_tags($this->nome));
        $this->login = htmlspecialchars(strip_tags($this->login));
        $this->email = htmlspecialchars(strip_tags($this->email));
        $this->senha = password_hash($this->senha, PASSWORD_DEFAULT);
        $this->id = htmlspecialchars(strip_tags($this->id));
        $stmt->bindParam(':nome', $this->nome);
        $stmt->bindParam(':login', $this->login);
        $stmt->bindParam(':senha', $this->senha);
        $stmt->bindParam(':id', $this->id);
        if ($stmt->execute()) {
            return true;
        }
        return false;
    }

    // Deletar usuário
    public function remove() {
        $query = 'DELETE FROM ' . $this->table_name . ' WHERE id = :id';
        $stmt = $this->conexao->prepare($query);

        $this->id = (int) $this->id;
        $stmt->bindParam(':id', $this->id);

        if ($stmt->execute()) {
            return true;
        }
        return false;
    }
}

