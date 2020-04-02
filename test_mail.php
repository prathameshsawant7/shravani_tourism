<?php
include_once("configs/defines.php");
include("configs/settings.php");
include("emailer.php");
$est =new settings();
$con=$est->connection();
session_start();

$request = "booking_confirmation";
$recipients = array('prathameshsandeepsawant@gmail.com');
$data = array("ticket"=>"5CFEC7B39798BA4F24DE","name"=>"PS");

$emailer = new Emailer($con, $request, $recipients, $data);
$emailer->generate();





// require 'phpmailer/5.2.10/PHPMailerAutoload.php';

// #echo 1;exit;
// // Instantiation and passing `true` enables exceptions
// $mail = new PHPMailer(true);#echo 1;exit;
// try {
//     //Server settings
//    # $mail->SMTPDebug = SMTP::DEBUG_SERVER;                      // Enable verbose debug output
//     $mail->isSMTP();                                            // Send using SMTP
//     $mail->Host       = 'mail.shravanitourism.com';                    // Set the SMTP server to send through
//     $mail->SMTPAuth   = true;
//     $mail->Username   = 'support@shravanitourism.com';  
// 	$mail->Password   = 'iB61@#bF36fu';                               // SMTP password
//     // #$mail->SMTPSecure = PHPMailer::ENCRYPTION_STARTTLS;
//    $mail->SMTPSecure = 'ssl';#PHPMailer::ENCRYPTION_SMTPS;
//     #$mail->Port       = 587;
//     $mail->Port       = 465; 

// // $mail->SMTPAuth = false;
// // $mail->SMTPAutoTLS = false; 
// // $mail->Port = 465; 

//     //Recipients
//     $mail->setFrom('support@shravanitourism.com');
// 	$mail->addAddress('prathameshsandeepsawant@gmail.com');

//     // Content
//     $mail->isHTML(true);                                  // Set email format to HTML
//     $mail->Subject = 'Here is the subject';
//     $mail->Body    = 'This is the HTML message body <b>in bold!</b>';
//    # $mail->AltBody = 'This is the body in plain text for non-HTML mail clients';

//     $mail->send();
//     echo 'Message has been sent';
// } catch (Exception $e) {
//     echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
// }









?>