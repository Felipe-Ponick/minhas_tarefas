<?php
include_once '../models/Tarefa.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;
use Dotenv\Dotenv;

require '../vendor/autoload.php';

class TarefaController {
    public function __construct() {
        $dotenv = Dotenv::createImmutable(__DIR__ . '/../');
        $dotenv->load();
    }

    public function cadastrar() {
        $database = new Database();
        $db = $database->getConnection();

        $tarefa = new Tarefa($db);

        $data = json_decode(file_get_contents("php://input"), true);

        if (isset($data['id_usuario'], $data['titulo'], $data['descricao'])) {
            $tarefa->id_usuario = $data['id_usuario'];
            $tarefa->titulo = $data['titulo'];
            $tarefa->descricao = $data['descricao'];
            $tarefa->created_at = date('Y-m-d H:i:s');

            if ($tarefa->create()) {
                $this->sendEmail($data['id_usuario'], $data['titulo']);
                echo json_encode(array("message" => "Tarefa criada com sucesso."));
            } else {
                echo json_encode(array("message" => "Erro ao criar tarefa."));
            }
        } else {
            echo json_encode(array("message" => "Dados incompletos para criar tarefa."));
        }
    }

    private function sendEmail($id_usuario, $titulo) {
        $mail = new PHPMailer(true);

        try {
            // Configurações do Mailtrap a partir das variáveis de ambiente
            $mail->SMTPDebug = 0;
            $mail->isSMTP();
            $mail->Host       = $_ENV['MAIL_HOST'];
            $mail->SMTPAuth   = true;
            $mail->Username   = $_ENV['MAIL_USER'];
            $mail->Password   = $_ENV['MAIL_PASS'];
            $mail->SMTPSecure = $_ENV['MAIL_SECURE'];
            $mail->Port       = $_ENV['MAIL_PORT'];

            // Recipiente
            $mail->setFrom('no-reply@minhas_tarefas.com', 'Minhas Tarefas');
            $mail->addAddress('usuario@exemplo.com'); // Endereço do destinatário

            // Conteúdo do e-mail
            $mail->isHTML(true);
            $mail->Subject = 'Nova Tarefa Cadastrada';
            $mail->Body    = "Uma nova tarefa foi cadastrada para o usuário com ID $id_usuario. <br>Título: $titulo";

            $mail->send();
        } catch (Exception $e) {
            echo "Erro ao enviar o e-mail. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}
?>
