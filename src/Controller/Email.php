<?php

namespace MinhasTarefas\Service;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

class EmailService {
    public function sendEmail($to, $subject, $body) {
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
            $mail->addAddress($to); // Endereço do destinatário

            // Conteúdo do e-mail
            $mail->isHTML(true);
            $mail->Subject = $subject;
            $mail->Body    = $body;

            $mail->send();
        } catch (Exception $e) {
            echo "Erro ao enviar o e-mail. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}

?>
