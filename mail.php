<?php
//Import PHPMailer classes into the global namespace
//These must be at the top of your script, not inside a function
include 'includes/PHPMailer.php';
include 'includes/SMTP.php';
include 'includes/Exception.php';

//namespaces
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\SMTP;
use PHPMailer\PHPMailer\Exception;

//Instantiation and passing `true` enables exceptions
$mail = new PHPMailer(true);

// try {
    //Server settings
    // $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      //Enable verbose debug output
    $mail->isSMTP();                                            //Send using SMTP
    $mail->Host       = 'smtp.gmail.com';                      //Set the SMTP server to send through
    $mail->SMTPAuth   = true;                                   //Enable SMTP authentication
    $mail->Username   = 'YOUR_EMAIL';                 //SMTP username
    $mail->Password   = 'YOUR_PASSWORD';                            //SMTP password
    $mail->SMTPSecure = "tls";            //Enable implicit TLS encryption
    $mail->Port       = 587;             //TCP port to connect to; use 587 if you have set `SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS`
  
    //Recipients
    $mail->setFrom('YOUR_EMAIL', 'YOUR_NAME');

    //Content
    $mail->isHTML(true);                                  //Set email format to HTML
    
// } catch (Exception $e) {
// }

?>

