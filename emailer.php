<?php
require 'phpmailer/5.2.10/PHPMailerAutoload.php';


class Emailer {

	function __construct($connection, $request, $recipients, $data) {
		$this->con 			= $connection;
		$this->request 		= $request;
		$this->recipients 	= $recipients;
		$this->data 		= $data;
	}

	function generate(){
		$mail = new PHPMailer(true);

		switch ($this->request) {
			case 'booking_confirmation':
				
				foreach ($this->recipients as $key => $email) {
					$mail->addAddress($email);	
				}
				$subject = 'Booking Confirmed';
				$message = $this->getBookingConfirmTemplate();
				
				break;
			default:
				break;
		}
		
		try {
	    	$mail->isSMTP();
		    $mail->Host       = MAIL_HOST;
		    $mail->SMTPAuth   = true;
		    $mail->Username   = MAIL_USERNAME;  
			$mail->Password   = MAIL_PASSWORD;
		    $mail->SMTPSecure = 'ssl';
		    $mail->Port       = MAIL_PORT;
		    $mail->isHTML(true);
			$mail->Subject = $subject;
    		$mail->Body    = $message;
    		$mail->setFrom(MAIL_ADDRESS,'Shravani Tourism Support');
    		$mail->send();
    	}catch (Exception $e) {
		    echo "Message could not be sent. Mailer Error: {$mail->ErrorInfo}";
		}
	}


	function sanitize_my_email($field) {
	    $field = filter_var($field, FILTER_SANITIZE_EMAIL);
	    if (filter_var($field, FILTER_VALIDATE_EMAIL)) {
	        return true;
	    } else {
	        return false;
	    }
	}

	function getBookingConfirmTemplate(){
		$ticket = $this->data["ticket"];
		$name 	= $this->data["name"];

		$message = '<!DOCTYPE html>';
		$message .= '<html>';
		$message .= '<head>';
		$message .= '<title>Booking Sucessful</title>';
		$message .= '<meta charset="utf-8">';
		$message .= '<meta name="viewport" content="width=device-width, initial-scale=1">';
		$message .= '<link href="css/shravani.css" rel="stylesheet">';
		$message .= '<link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css">';
		$message .= '<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>';
		$message .= '<script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.14.7/umd/popper.min.js"></script>';
		$message .= '<script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.3.1/js/bootstrap.min.js"></script>';
		$message .= '<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">';
		$message .= '</head>';
		$message .= '<body>';
		$message .= '<table width="50%" align="center" cellpadding="50px" cellspacing="40px" border="1px" bordercolor="#808080" bgcolor="#808080">';
		$message .= '<tr>';
		$message .= '<td>';
		$message .= '<table width="90%"  align="center" cellpadding="20px" cellspacing="10px" border="1px" bordercolor="#fff" border-redius="5Px" bgcolor="#fff">';
		$message .= '<tr>';
		$message .= '<td align="center"><img src="'.LIVEROOT.'images/logo.png"></td>';
		$message .= '</tr>';
		$message .= '<tr>';
		$message .= '<td>';
		$message .= '<table width="95%"  align="center" cellpadding="10px" cellspacing="20px" border="1px" bordercolor="#dcdcdc"  bgcolor="#dcdcdc">';
		$message .= '<tr>';
		$message .= '<td width="100%" align="center" style="font-size:150%; color:#484848;">Booking Successfull</td>';
		$message .= '</tr>';
		$message .= '<tr>';
		$message .= '<td width="100%" align="center" style="font-size:100%; color:#484848;">Dear '.$name.'</td>';
		$message .= '</tr>';
		$message .= '<tr>';
		$message .= '<td width="100%" align="center" style="font-size:100%; color:#484848;">Your Booking has been confirmed.</br><a href="http://localhost/shravani_tourism/receipt.php?ticket='.$ticket.'">Click here to download receipt.</a></td>';
		$message .= '</tr>';
		$message .= '</table>';
		$message .= '</body>';
		$message .= '</html>';
		return $message;
	}

}
?>