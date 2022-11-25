<?php

namespace Controllers;

use PHPMailer\PHPMailer\PHPMailer as PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception as Exception;
use Controllers\AuthController as AuthController;

require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class MailController
{
    private $auth;

    public function __construct()
    {
        $this->auth = new AuthController();
    }

    public function sendMail($subject, $body, $email, $nickname = "")
    {
        $mail = new PHPMailer(true); //Create an instance; passing `true` enables exceptions

        try {
            // Ajustes del servidor
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                              //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                         //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                     //Enable SMTP authentication
            $mail->Username   = 'lusideces@gmail.com';                  //SMTP username
            $mail->Password   = 'ygepfuhqwvgsawkd';                      //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;             //Enable implicit TLS encryption
            $mail->Port       = 465;                                     //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            // Receptor
            $mail->setFrom('lusideces@gmail.com', 'Pet Hero');
            $mail->addAddress($email, $nickname);     //Add a recipient

            // Contenido del mail
            $mail->isHTML(true);                                              //Set email format to HTML
            $mail->Subject = $subject;

            $mail->Body = $body;

            $mail->AltBody = 'Plain text';

            $mail->CharSet = 'UTF-8';
            $mail->send();
        } catch (Exception $ex) {
            throw $ex;
        }
    }

    public function sendCouponMail($price)
    {
        $subject = "Your Pet Hero payment details";

        $value_to_add = "To pay: $" . $price;
        $body = file_get_contents('PHPMailer/email.html');
        $body = str_replace("Price", "$value_to_add", $body);

        $this->sendMail($subject, $body, $_SESSION['email'], $_SESSION['nickname']);
    }

    public function sendPassRecoveryMail($email)
    {

        $subject = "Reset your Pet Hero password";

        $encryptedEmail = $this->auth->urlsafe_b64encode($email);

        $body = "Click on the link to reset your password: http://localhost" . FRONT_ROOT . "Auth/showResetPassword/" . $encryptedEmail;

        $this->sendMail($subject, $body, $email);
    }
}