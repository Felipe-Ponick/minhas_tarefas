<?php
class Tarefa {
    private $conn;
    private $table_name = "tarefa";

    public $id;
    public $id_usuario;
    public $titulo;
    public $descricao;
    public $created_at;

    public function __construct($db) {
        $this->conn = $db;
    }

    public function create() {
        $query = "INSERT INTO " . $this->table_name . " SET id_usuario=:id_usuario, titulo=:titulo, descricao=:descricao, created_at=:created_at";

        $stmt = $this->conn->prepare($query);

        $this->id_usuario = htmlspecialchars(strip_tags($this->id_usuario));
        $this->titulo = htmlspecialchars(strip_tags($this->titulo));
        $this->descricao = htmlspecialchars(strip_tags($this->descricao));
        $this->created_at = htmlspecialchars(strip_tags($this->created_at));

        $stmt->bindParam(":id_usuario", $this->id_usuario);
        $stmt->bindParam(":titulo", $this->titulo);
        $stmt->bindParam(":descricao", $this->descricao);
        $stmt->bindParam(":created_at", $this->created_at);

        if ($stmt->execute()) {
            return true;
        }

        return false;
    }
}
?>
