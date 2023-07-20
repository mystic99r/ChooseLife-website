<?php 
// Import PHPMailer classes into the global namespace 
use PHPMailer\PHPMailer\PHPMailer; 
use PHPMailer\PHPMailer\SMTP; 
use PHPMailer\PHPMailer\Exception; 
 
// Include library files 
require 'PHPMailer/Exception.php'; 
require 'PHPMailer/PHPMailer.php'; 
require 'PHPMailer/SMTP.php'; 
 
// Create an instance; Pass `true` to enable exceptions 
$mail = new PHPMailer; 
 
// Server settings 
//$mail->SMTPDebug = SMTP::DEBUG_SERVER;    //Enable verbose debug output 
$mail->isSMTP();                            // Set mailer to use SMTP 
$mail->Host = 'smtp.gmail.com';           // Specify main and backup SMTP servers 
$mail->SMTPAuth = true;                     // Enable SMTP authentication 
$mail->Username = 'ravhad934@gmail.com';       // SMTP username 
$mail->Password = 'ravhad_57';         // SMTP password 
$mail->SMTPSecure = 'ssl';                  // Enable TLS encryption, `ssl` also accepted 
$mail->Port = 587;                          // TCP port to connect to 
 
// Sender info 
$mail->setFrom('ravhad934@gmail.com', 'Avhad Roshan Dnyaneshwar'); 
$mail->addReplyTo('ravhad000@gmail.com', 'SenderName'); 
 
// Add a recipient 
$mail->addAddress('ravhad000@gmail.com'); 

//$mail->addCC('cc@example.com'); 
//$mail->addBCC('bcc@example.com'); 
 
// Set email format to HTML 
$mail->isHTML(true); 
 
// Mail subject 
$mail->Subject = 'Email from Localhost by Roshan'; 
 
// Mail body content 
$bodyContent = '<h1>How to Send Email from Localhost using PHP by Roshan</h1>'; 
$bodyContent .= '<p>This HTML email is sent from the localhost server using PHP by <b>akanksha</b></p>'; 
$mail->Body    = $bodyContent; 
 
// Send email 
if(!$mail->send()) { 
    echo 'Message could not be sent. Mailer Error: '.$mail->ErrorInfo; 
} else { 
    echo 'Message has been sent.';
}