<?php

namespace Controllers;

use Controllers\BookingController as BookingController;
use PHPMailer\PHPMailer\PHPMailer as PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception as Exception;
use Models\Coupon as Coupon;
use DB\CouponDAO as CouponDAO;


require 'PHPMailer/src/Exception.php';
require 'PHPMailer/src/PHPMailer.php';
require 'PHPMailer/src/SMTP.php';

class MailController
{

    function sendMail($statusId, $idBooking, $price)
    {
        $mail = new PHPMailer(true); //Create an instance; passing `true` enables exceptions

        try {
            // Ajustes del servidor
            //$mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
            $mail->isSMTP();                                              //Send using SMTP
            $mail->Host       = 'smtp.gmail.com';                         //Set the SMTP server to send through
            $mail->SMTPAuth   = true;                                     //Enable SMTP authentication
            $mail->Username   = 'lab4pethero@gmail.com';                  //SMTP username
            $mail->Password   = 'oqhldwdadwmoqvze';                      //SMTP password
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
            $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`

            // Receptor
            $mail->setFrom('lab4pethero@gmail.com', 'Pet Hero');
            $mail->addAddress($_SESSION['email'], $_SESSION['nickname']);     //Add a recipient

            // Contenido del mail
            $mail->isHTML(true);                                  //Set email format to HTML
            $mail->Subject = "Your Pet Hero payment details";

            $value_to_add = "To pay: $" . $price;
            $mail->Body = file_get_contents('PHPMailer/email.html');
            $mail->Body = str_replace("Pet Hero Team", "$value_to_add", $mail->Body);

            $mail->AltBody = 'Plain text';

            $mail->CharSet = 'UTF-8';
            $mail->send();

            $bookingController = new BookingController();
            $bookingController->updateStatus($statusId, $idBooking);

            try {
                $coupon = new Coupon($price, $idBooking);
                $couponDAO = new CouponDAO();
                $couponDAO->add($coupon);
                echo "Payment details were sent to your email. Check it out!";
            } catch (Exception $e) {
                echo 'Error while sending Payment details';
            }
        } catch (Exception $e) {
            $message = "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
        }
    }
}