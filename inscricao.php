
<?php
/*
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
}*/
?>

<?php
    session_start();

    require_once "vendor/autoload.php";

    use PHPMailer\PHPMailer\PHPMailer;
    use PHPMailer\PHPMailer\SMTP;
    use PHPMailer\PHPMailer\Exception;

    //

    $mail = new PHPMailer();

    try {

            //Server settings
            $mail->CharSet      = "utf-8";
            $mail->SMTPDebug    = SMTP::DEBUG_SERVER;                                 // Habilitar saída de depuração detalhada
            $mail->isSMTP(true);                                                        // Enviar usando SMTP
            $mail->Host         = 'smtp.gmail.com';                                     // Host
            $mail->SMTPAuth     = true;                                                 // Habilitar autenticação SMTP
            $mail->Username     = 'smartclassenterprise@gmail.com';             
            $mail->Password     = "eeft cqdt ydbc qxli";                      
            $mail->SMTPSecure   = PHPMailer::ENCRYPTION_SMTPS;                          // Habilitar criptografia TLS implícita
            $mail->Port         = 465;

            //Recipients
            $mail->setFrom($_POST['email'], $_POST['nome']);                            // Rementente
            $mail->addAddress('rebecapereira825@gmail.com', 'Rebeca Pereira');           // Destinatário
            //$mail->addReplyTo('info@example.com', 'Information');                     // E-mail de resposta
            //$mail->addCC('cc@example.com');                                           // cópia
            //$mail->addBCC('bcc@example.com');                                         // Cópia oculta
    
            // Anexos
            //$mail->addAttachment('/var/tmp/file.tar.gz');                             // Adicionar Anexos
            //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');
    
            //Content
            //$mail->isHTML(true);                                                        // Defina o formato do e-mail para HTML
            //$mail->Subject = $_POST['assunto'];
            //$mail->Body    = $_POST['mensagem'];                                        // Corpo do e-mail no formato HTML
            //$mail->AltBody = $_POST['mensagem'];                                        // Corpo do e-mail no formato texto

            $mail->isHTML(true);
            $mail->Subject = 'Confirmação de Inscrição';
            $mail->Body = '<h1>Obrigado por se inscrever!</h1><p>Estamos felizes em tê-lo(a) conosco.</p>';
            $mail->AltBody = 'Obrigado por se inscrever! Estamos felizes em tê-lo(a) conosco.';

        if ($mail->send()) {
            $_SESSION['msgSuccess'] = "E-mail enviado com sucesso.";
            return header("Location: index.php?pagina=home.php");
        } else {
            $_SESSION['msgError'] = "ERROR: Error ao tentar enviar e-mail: " . $mail->ErrorInfo;
            return header("Location: index.php?pagina=home.php");
        }

    } catch (\Exception $e) {
        $_SESSION['msgError'] = "ERROR: Error ao tentar enviar e-mail: " . $mail->ErrorInfo;
        return header("Location: index.php?pagina=home.php");
    }