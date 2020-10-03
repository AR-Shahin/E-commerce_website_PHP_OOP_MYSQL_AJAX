<?php

namespace App\classes;
require_once '../../vendor/autoload.php';
use App\classes\DBoperation;

class Mail extends DBoperation
{
	
	public function sendMailToAdmin($name,$email,$sub,$text){
			$to = 'mdshahinmije96@gmail.com';
			$subject = $sub;
			$from = $email;//Its not valid email Address
			 
			// To send HTML mail, the Content-type header must be set
			$headers  = 'MIME-Version: 1.0' . "\r\n";
			$headers .= 'Content-type: text/html; charset=iso-8859-1' . "\r\n";
			 
			// Create email headers
			$headers .= 'From: '.$from."\r\n".
			    'Reply-To: '.$from."\r\n" .
			    'X-Mailer: PHP/' . phpversion();
			 
			// Compose a simple HTML email message
			$message = '<html><body>';
			$message .= '<h1 style="color:#f40;">Hi Admin</h1>'.$text;
			
			$message .= '</body></html>';
			 
			// Sending email
			if(mail($to, $subject, $message, $headers)){
			   return true;
			} else{
			    return false;
			}
	}
}

?>