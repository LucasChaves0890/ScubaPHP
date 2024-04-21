<?php

namespace Services;

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require_once __DIR__ . '/../../vendor/autoload.php';

class EmailService {
    private $mailer;

    public function __construct() {
        $this->mailer = new PHPMailer();

        $this->mailer->isSMTP();
        $this->mailer->Host       = 'sandbox.smtp.mailtrap.io'; 
        $this->mailer->SMTPAuth   = true;             
        $this->mailer->Port       = 2525;                 
        $this->mailer->Username   = 'fa0047e6bfd10d'; 
        $this->mailer->Password   = 'cdf78b66013098';           
    }

    public function sendEmail($destinatario, $assunto, $corpo) {
        try {
            $this->mailer->setFrom('lucaschaves0890@gmail.com', 'Lucas Chaves');
            $this->mailer->addAddress($destinatario);

            $this->mailer->isHTML(true);
            $this->mailer->Subject = $assunto;
            $this->mailer->Body    = $corpo;

            $this->mailer->send();

        } catch (Exception $e) {
            echo "Erro ao enviar o e-mail: {$this->mailer->ErrorInfo}";
        }
    }
}
