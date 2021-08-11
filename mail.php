<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

require('PHPMailer/Exception.php');
require('PHPMailer/SMTP.php');
require('PHPMailer/PHPMailer.php');

$result = "";
if(isset($_POST["submit-msg"])){
    //Create an instance; passing `true` enables exceptions
    $mail = new PHPMailer(true);
    
    try {
        //Server settings
        // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
        $mail->isSMTP();                                            //Send using SMTP
        $mail->Host       = 'smtp.gmail.com';                     //Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
        $mail->Username   = 'sekarmadukusumawardani@gmail.com';                     //SMTP username
        $mail->Password   = 'sekar123';                               //SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;            //Enable implicit TLS encryption
        // $mail->Port       = 587;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
        $mail->Port       = 465;                                    //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
    
        //Recipients
        $mail->setFrom($_POST["email"], $_POST["name"]);
        $mail->addAddress('azarnuzy@gmail.com');
        $mail->addReplyTo($_POST["email"], $_POST["name"]);
    
        //Content
        $mail->isHTML(true);                                  //Set email format to HTML
        $mail->Subject = 'Contact Form: ' . $_POST["subject"];
        $mail->Body = $_POST["message"];
    
        $mail->send();
        $result = '<div class="sent-message">Thank you ' . $_POST["name"] . ' for contacting us. We will get back to you soon!</div>';
    } catch (Exception $e) {
        // echo "Mailer Error: {$mail->ErrorInfo}";
        $result = '<div class="error-message">Something went wrong. Please try again.</div>';
    }
}