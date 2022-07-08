<?php
 
require "./libs/PHPMailer/Exception.php";
require "./libs/PHPMailer/OAuth.php";
require "./libs/PHPMailer/PHPMailer.php";
require "./libs/PHPMailer/POP3.php";
require "./libs/PHPMailer/SMTP.php";
 
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;
 
//print_r($_POST);
 
echo '<br> <br>';
class Mensagem {
 
    private $para = null;
    private $assunto = null;
    private $mensagem = null;
 
    public function __get($atributo) {
        return $this->$atributo;
    }
 
    public function __set($atributo, $valor) {
        $this->$atributo = $valor;
    }
 
    public function mensagemValida() {
        if(empty($this->para) || empty($this->assunto) || empty($this->mensagem)) {
            return false;
        }
 
        return true;
 
    }
}
 
$mensagem = new Mensagem();
 
$mensagem->__set('mensagem', $_POST['mensagem']);
$mensagem->__set('assunto', $_POST['assunto']);
$mensagem->__set('para', $_POST['para']);
 
//print_r($mensagem);
 
if(!$mensagem->mensagemValida()) {
    echo 'Mensagem não é válida';
} 
 
$mail = new PHPMailer(true);
 
try {
    //Server settings
    $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp-mail.outlook.com';                     //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'dhionathanappsend@outlook.com.br';                     //SMTP username
    $mail->Password   = 'sendmail123';                               //SMTP password
    $mail->SMTPSecure = 'PHPMailer::ENCRYPTION_STARTTLS';            //Enable implicit TLS encryption
    $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
 
    //Recipients
    $mail->setFrom('dhionathanappsend@outlook.com.br', 'Dhionathan');
    $mail->addAddress('dhionathanappsend@outlook.com.br', 'Dhionathan');     //Add a recipient
    //$mail->addReplyTo('info@example.com', 'Information');
    //$mail->addCC('cc@example.com');
    //$mail->addBCC('bcc@example.com');
 
    //Attachments
    //$mail->addAttachment('/var/tmp/file.tar.gz');         //Add attachments
    //$mail->addAttachment('/tmp/image.jpg', 'new.jpg');    //Optional name
 
    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    $mail->Subject = 'PHPMailler Test';
    $mail->Body    = '<h3 style="color:red;"><strong>PHPMailler Request</strong></h3>';
    $mail->AltBody = 'PHPMailler Request';
 
    $mail->send();
    echo 'Message has been sent';
} catch (Exception $e) {
    echo "Não foi possível enviar este e-mail, por favor tente novamente ";
    echo "Detalhes do erro: {$mail->ErrorInfo}";
}
?>
