<?php
namespace MinhasTarefas\Controller;

use MinhasTarefas\Model\Usuario;
use MinhasTarefas\Service\SqlService;
use MinhasTarefas\Service\EmailService;

class UsuarioController{

    private $sql_service;
    private $email_service;
    private $usuario;

    public function __construct(SqlService $sql, EmailService $email, Usuario $usuario)
    {
        $this->sql_service = $sql;
        $this->email_service = $email;
        $this->usuario = $usuario;
    }

    public function cadastrarUsuario(array $request)
    {
        $this->usuario->nome = $request['nome'];
        $this->usuario->email = $request['email'];
        $this->usuario->login = $request['login'];
        $this->usuario->senha = $request['senha'];
        $this->usuario->create();
        $this->email_service->detinatario($this->usuario->email);
        $this->email_service->enviarEmailBoasVindas('fdsa');
    }
}