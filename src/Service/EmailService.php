<?php
namespace MinhasTarefas\Service;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService
{
    private $mail;

    public function __construct()
    {
        $this->mail = new PHPMailer(true);
        $this->mail->isSMTP();
        $this->mail->Host  = $_ENV['MAIL_HOST'];
        $this->mail->Username  = $_ENV['MAIL_USER'];
        $this->mail->Password  = $_ENV['MAIL_PASS'];
        $this->mail->Port = $_ENV['MAIL_PORT'];
        $this->mail->SMTPSecure = $_ENV['MAIL_SECURE'];
        $this->mail->SMTPAuth  = true;
        $this->mail->SMTPSecure = PHPMailer::CHARSET_UTF8;
        $this->mail->isHTML(true);
    }

    public function remetente($email_remetente)
    {
        $this->mail->setFrom($email_remetente);
    }

    public function detinatario($destinatario)
    {
        $this->mail->addAddress($destinatario);
    }
    public function enviarEmailBoasVindas($nome)
    {
        try {
            $this->mail->Subject = 'Bem-Vindo ao sistema';  
            $this->mail->Body = "<h1>olá <\h1> $nome, Bem vinco ao sistema";
            $this->mail->AltBody = "Olá $nome, Bem vindo ao nosso sistema, estamos felizes em te receber";
            $this->mail->send();
            echo 'A mensagem de boas vindas foi envuadi' . PHP_EOL;
        } catch (Exception $e) {
            echo "A mensagem não pode ser enviada. Error: {$this->mail->Errorinfo}";
        }
    }
    public function enviarEmailRecuperarSenha($nome)
    {
        try {
            $this->mail->Subject = 'Bem-Vindo ao sistema';
            $this->mail->Body = "<h1>olá <\h1> $nome, Bem vinco ao sistema";
            $this->mail->AltBody = "Olá $nome, Bem vindo ao nosso sistema, estamos felizes em te receber";
            $this->mail->send();
            echo 'A mensagem de boas vindas foi envuadi' . PHP_EOL;
        } catch (Exception $e) {
            echo "A mensagem não pode ser enviada. Error: {$this->mail->Errorinfo}";
        }
    }
}
