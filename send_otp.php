<?php

use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/src/Exception.php';
require 'vendor/src/PHPMailer.php';
require 'vendor/src/SMTP.php';

function sendOTP($email, $otp)
{
    // Step 4.3.5
    $mail = new PHPMailer(true);

    // Step 4.3.6
    try {

        $mail->isSMTP();

        $mail->Host = 'smtp.gmail.com';

        $mail->SMTPAuth = true;

        $mail->Username = 'chukkamamatha72@gmail.com';

        $mail->Password = 'nyrjzutsknrmzwmn';

        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;

        $mail->Port = 587;

        $mail->setFrom('chukkamamatha72@gmail.com', 'E-Learning_Portal');

        $mail->addAddress($email);

        $mail->Subject = "Email Verification OTP";

        $mail->Body = "Your OTP for E-Learning Portal is: " . $otp;

        $mail->send();

        return true;

    } catch (Exception $e)
{
    return false;
}

    }


?>