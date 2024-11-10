<?php
// Incluir o autoload do Composer para carregar o PHPMailer
require 'vendor/autoload.php';

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

// Verifica se o formulário foi submetido
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $email = $_POST['email'];

    // Verifique e sanitize o e-mail
    if (filter_var($email, FILTER_VALIDATE_EMAIL)) {
        
        // Instancia o PHPMailer
        $mail = new PHPMailer(true);

        try {
            // Configurações do servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Substitua pelo servidor SMTP
            $mail->SMTPAuth = true;
            $mail->Username = 'smartclassenterprise@gmail.com'; // Substitua pelo seu e-mail
            $mail->Password = 'smartClass12';  // Substitua pela sua senha de e-mail
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;  // Porta SMTP (normalmente 587 para TLS)

            // Configurações do e-mail
            $mail->setFrom('seuemail@seudominio.com', 'Nome do Remetente');
            $mail->addAddress($email);  // E-mail do destinatário

            // Conteúdo do e-mail
            $mail->isHTML(true);
            $mail->Subject = 'Confirmação de Inscrição';
            $mail->Body = '<h1>Obrigado por se inscrever!</h1><p>Estamos felizes em tê-lo(a) conosco.</p>';
            $mail->AltBody = 'Obrigado por se inscrever! Estamos felizes em tê-lo(a) conosco.'; // Para clientes de e-mail que não suportam HTML

            // Envia o e-mail
            $mail->send();
            echo 'Mensagem enviada com sucesso!';
        } catch (Exception $e) {
            echo "Erro ao enviar mensagem: {$mail->ErrorInfo}";
        }
    } else {
        echo 'E-mail inválido.';
    }
}
?>
