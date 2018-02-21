<?php
require_once('PHPMailer-master/class.phpmailer.php');

$mail = new PHPMailer(); // create a new object
$mail->IsSMTP(); // enable SMTP
$mail->SMTPDebug = 1; // debugging: 1 = errors and messages, 2 = messages only
$mail->SMTPAuth = true; // authentication enabled
$mail->SMTPSecure = 'ssl'; // secure transfer enabled REQUIRED for Gmail
$mail->Host = 'pop.orange.fr';
$mail->Port = 995; // or 587
$mail->IsHTML(true);
$mail->Username = 'charles.goedefroit@orange.fr';
$mail->Password = 'password';
$mail->SetFrom('charles.goedefroit@orange.fr');
$mail->Subject = 'Test';
$mail->Body = 'hello';
$mail->AddAddress('charles.goedefroit@gmail.com');

 if!($mail->Send()) {
    echo "Mailer Error: " . $mail->ErrorInfo;
 } else {
    echo "Message has been sent";
 }
 ?>
