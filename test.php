<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/src/Exception.php';
require 'vendor/src/PHPMailer.php';
require 'vendor/src/SMTP.php';

$mail = new PHPMailer(true);

try {
    $mail->isSMTP();
    $mail->Host = 'smtp.gmail.com';
    $mail->SMTPAuth = true;
    $mail->Username = 'chukkamamatha72@gmail.com';
    $mail->Password = 'nyrjzutsknrmzwmn'; // Put your App Password here
    $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
    $mail->Port = 587;

    $mail->setFrom('chukkamamatha72@gmail.com', 'E-Learning Portal');
    $mail->addAddress('lagudulokesh2001@gmail.com'); // Replace with an email you can check

    $mail->Subject = 'PHPMailer Test';
    $mail->Body = 'This is a test email.';

    $mail->send();

    echo "Email sent successfully!";
} catch (Exception $e) {
    echo "Mailer Error: " . $mail->ErrorInfo;
}
?>