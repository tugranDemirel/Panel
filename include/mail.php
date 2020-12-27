<?php
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'database-connection.php';
require 'src/Exception.php';
require 'src/PHPMailer.php';
require 'src/SMTP.php';

$query = $conn->prepare("SELECT * FROM mail_setting");
$query->execute();
$getQuery = $query->fetch(PDO::FETCH_ASSOC);

function Mail($nameSurname, $subject, $content, $email)
{
    // Instantiation and passing `true` enables exceptions
    $mail = new PHPMailer(true);

    try
    {
        //Server settings
        $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
        $mail->isSMTP();                                            // Send using SMTP
        // smtp sunucusu
        $mail->Host       = $getQuery['mail_host'];                    // Set the SMTP server to send through
        $mail->SMTPAuth   = true;                                   // Enable SMTP authentication
        // mail
        $mail->Username   = $getQuery['mail_sender'];                     // SMTP username
        //sifre
        $mail->Password   = $getQuery['mail_password'];                               // SMTP password
        $mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;         // Enable TLS encryption; `PHPMailer::ENCRYPTION_SMTPS` encouraged
        // port
        $mail->Port       = 587;                                    // TCP port to connect to, use 465 for `PHPMailer::ENCRYPTION_SMTPS` above
        $mail->CharSet('UTF-8');
        //Recipients
        // mail gönderen ve adı
        $mail->setFrom($getQuery['mail_sender'], $getQuery['mail_reply_name_surname']);
        // kime gidecek
        $mail->addAddress($email, $nameSurname);     // Add a recipient
        // yanıtlanırken kime gitsin
        $mail->addReplyTo($getQuery['mail_reply'], $getQuery['mail_reply_name_surname']);

        // Content
        $mail->isHTML(true);                                  // Set email format to HTML
        // gidecek konu
        $mail->Subject = 'RE:'.$subject;
        // icerik
        $mail->Body    = $content;
        $mail->AltBody = $content;

        $mail->send();
        return true;
    }
    catch (Exception $e)
    {
        return false;
    }
}