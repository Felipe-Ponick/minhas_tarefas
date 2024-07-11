<?php

use Dotenv\Dotenv;
use MinhasTarefas\Controller\UsuarioController;
use MinhasTarefas\Controller\TarefaController;
use MinhasTarefas\Model\Usuario;
use MinhasTarefas\Model\Tarefa;
use MinhasTarefas\Service\SqlService;
use MinhasTarefas\Service\EmailService;

require_once "../vendor/autoload.php";

$dotenv = Dotenv::createImmutable("../");
$dotenv->safeLoad();

$metodo = $_SERVER['REQUEST_METHOD'];
$path = $_SERVER['PATH_INFO'] ?? '/';

// Debugging output
echo "Path: $path, Method: $metodo";

if(($path == null || $path == "/login") && $metodo == "GET"){
    include_once "../views/login.php"; // Corrigido para "login.php"
    exit;
}

if($path == "/cadastro" && $metodo == "GET"){
    include_once "../views/cadastro.php";
    exit;
}

if($path == "/cadastro" && $metodo == "POST"){
    $sql = new SqlService();
    $emailService = new EmailService();
    $usuario = new Usuario($sql->dbConnection());
    $usuarioController = new UsuarioController($sql, $emailService, $usuario);
    $usuarioController->cadastrarUsuario($_POST);
    include_once "../views/login.php";
    exit;
}

// Adicionando a rota para cadastrar tarefas
if($path == "/tarefas/cadastrar" && $metodo == "GET"){
    include_once "../views/cadastro_tarefa.php";
    exit;
}

if($path == "/tarefas/cadastrar" && $metodo == "POST"){
    $sql = new SqlService();
    $emailService = new EmailService();
    $tarefa = new Tarefa($sql->dbConnection());
    $tarefaController = new TarefaController($sql, $emailService, $tarefa);
    $tarefaController->cadastrarTarefa($_POST);
    echo json_encode(["message" => "Tarefa cadastrada com sucesso."]);
    exit;
}

echo '<body style="display:flex; justify-content:center"><h1>Página não encontrada!</h1></body>';

?>
