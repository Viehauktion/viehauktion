<?php


error_reporting(0);

if($_POST['message']!=""){}


	require_once("phpmailer/class.phpmailer.php");

					$emailMessage=$_POST['name']."(".$_POST['email'].") writes:".$_POST['message'];


	
					$mail = new phpmailer();
			
					$mail->From     = "feedback@viehauktion.com";
					$mail->FromName = "feedback@viehauktion.com";
					$mail->Host     = "localhost";
					
					$mail->Mailer   = "smtp";
					
                    $mail->AddReplyTo($_POST['email'], $_POST['email']);
			
					$mail->Subject   = "Message from ".$_POST['name'];
					$mail->AddAddress("meyborg@syborgstudios.com");
					$mail->Body    = $emailMessage;
			 		
					$mail->IsHTML(true);
			
					$result=$mail->send();

}
                                        


?>
