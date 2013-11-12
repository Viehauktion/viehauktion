<?PHP


//error_reporting(E_ERROR | E_WARNING | E_PARSE);

ini_set('default_charset','utf-8');
	
require_once('globals.inc.php');

require_once('DB.inc.php');

require_once("SRBill.class.php");


require_once("amazonS3/S3.php");

include("./phpmailer/class.phpmailer.php");


$lang='de';

include('locale/'.$lang.'.php');


/*
//Cronjob - Versendet Mails nach einer bestätigten Auktion, generiert Rechnung und lädt sie auf den S3 Bucket
//
*/



function connectDB() {
		// erstelle die Verbindung zur Datenbank um den clip dem Watschdog zu uebergeben
		$lHost = $GLOBALS["VIEHAUKTION"]["DATABASE"]["HOST"];
		$lUser = $GLOBALS["VIEHAUKTION"]["DATABASE"]["USER"];
		$lPassword = $GLOBALS["VIEHAUKTION"]["DATABASE"]["USERPASSWORD"];
		$lDBName = $GLOBALS["VIEHAUKTION"]["DATABASE"]["NAME"];
		
		return new DB($lHost, $lUser, $lPassword, $lDBName);
	}
	
		function sendEmail($emailTemplate, $lSearch, $lReplacement, $subject, $lRecipient, $attachmentPath) {
					
					$eMail = file_get_contents($emailTemplate);
					$finalEmail = str_replace($lSearch, $lReplacement, $eMail);
				
			
							$mail = new PHPMailer();

					
							$mail->IsSMTP();                                      // Set mailer to use SMTP
							$mail->Host = $GLOBALS["VIEHAUKTION"]["EMAIL"]["SERVER"];                 // Specify main and backup server
							$mail->Port = 587;                                    // Set the SMTP port
							$mail->SMTPAuth = true;                               // Enable SMTP authentication
							$mail->Username = $GLOBALS["VIEHAUKTION"]["EMAIL"]["USERNAME"];                // SMTP username
							$mail->Password = $GLOBALS["VIEHAUKTION"]["EMAIL"]["PASSWORD"];                  // SMTP password
							$mail->SMTPSecure = 'tls';                            // Enable encryption, 'ssl' also accepted


							$mail->From = $GLOBALS["VIEHAUKTION"]["EMAIL"]["SENDERADDRESS"];
							$mail->FromName = $GLOBALS["VIEHAUKTION"]["EMAIL"]["SENDERNAME"];
							$mail->AddAddress($lRecipient, $lRecipient);
							if($attachmentPath!=''){
							$mail->AddAttachment($attachmentPath);
							}
							$mail->IsHTML(true); // send as HTML
							
							$mail->Subject = $subject;
							$mail->Body = $finalEmail;
							
							
							if(!$mail->Send()) {
								return false;
								 }
							
							$mail->ClearAddresses();
							$mail->ClearAttachments();
							
							return true;
							
			
				}
			

	function formatPrice($price){

		$priceString="".$price;

		$splittedPrice=explode(".", $priceString);
		if(count($splittedPrice)==1){

			$priceString.=".00";
		}else{
		if(strlen($splittedPrice[1])=="1"){
			$priceString.="0";
		}

}



return $priceString;

	}


$lDB=connectDB();
			if (!$lDB->failed){
			
$invoices=array();

if($invoices=$lDB->getInvoicesByStatusAndDate("open", date("Y-m-d H:i:s", strtotime("-20 days")))){



	for($i=0; $i<count($invoices); $i++){


															$seller=$lDB->getUserWithAddressByID($invoices[$i]["recipient_id"]);



															$lSearch = array();
															
															$lSearch[0] = "___TOTAL___";
															$lSearch[1] = "___SITENAME___";

															$lSearch[2] = "___SELLERFIRSTNAME___";
															$lSearch[3] = "___SELLERLASTNAME___";
															$lSearch[4] = "___SELLERSTREET___";
															$lSearch[5] = "___SELLERNUMBER___";
															$lSearch[6] = "___SELLERPOSTCODE___";
															$lSearch[7] = "___SELLERCITY___";
															$lSearch[8] = "___SELLERPHONE___";
															$lSearch[9] = "___SELLEREMAIL___";

															$lSearch[10] = "___DATE___";
															$lSearch[11] = "___SUBJECT___";
														

															$lReplacement = array();
															$lReplacement[0] = $invoices[$i]['total'];
															$lReplacement[1] =$GLOBALS["VIEHAUKTION"]["BASE"]["APPNAME"];
															
															$lReplacement[2] =  htmlentities ( $seller["firstname"], ENT_QUOTES, "UTF-8");
															$lReplacement[3] =  htmlentities ( $seller["lastname"], ENT_QUOTES, "UTF-8");
															$lReplacement[4] =  htmlentities ( $seller["street"], ENT_QUOTES, "UTF-8");
															$lReplacement[5] =  htmlentities ( $seller["number"], ENT_QUOTES, "UTF-8");
															$lReplacement[6] =  htmlentities ( $seller["postcode"], ENT_QUOTES, "UTF-8");
															$lReplacement[7] =  htmlentities ( $seller["city"], ENT_QUOTES, "UTF-8");
															$lReplacement[8] =  htmlentities ( $seller["phone"], ENT_QUOTES, "UTF-8");
															$lReplacement[9] =  htmlentities ( $seller["email"], ENT_QUOTES, "UTF-8");


					
															$lReplacement[10] =  date("d.m.Y", strtotime($invoices[$i]['date']));
															$lReplacement[11] = htmlentities ( $texts['first_reminder_subject'], ENT_QUOTES, "UTF-8");
														

															
														
															

															

																$sellersubject=$texts['first_reminder_subject'];
							
																

																$attachmentPath="./invoices/first_reminder_".$invoices[$i]["filename"];

																$pdf = new SRBill('P', 'mm', 'A4');
																$pdf->AliasNbPages();
																$pdf->AddPage();

																$pdf->printRecipient($seller["company"], $seller["firstname"]." ".$seller["lastname"], $seller["street"].' '.$seller["number"], $seller["postcode"].' '.$seller["city"],  $seller["country"]);
								

																$pdf->SetLeftMargin(20);
																$pdf->SetRightMargin(20);

																$date=date("d.m.Y");

																$pdf->printReminderData($texts['first_reminder'],  $GLOBALS["VIEHAUKTION"]["REMINDER_ONE"], $invoices[$i]["invoice_number"], $invoices[$i]["auction_id"], $invoices[$i]['user_id'], $date, $invoices[$i]["amount_of_animals"], $invoices[$i]["provision"], $invoices[$i]["vat"], 10); 


																$pdfStream=$pdf->Output($attachmentPath,"F");



																$s3 = new S3($GLOBALS["VIEHAUKTION"]["AMAZON"]["ID"], $GLOBALS["VIEHAUKTION"]["AMAZON"]["KEY"]);


																$result=$s3->putObjectFile("./invoices/first_reminder_".$invoices[$i]["filename"], $GLOBALS["VIEHAUKTION"]["AMAZON"]["BUCKET"], "invoices/first_reminder_".$invoices[$i]["filename"], S3::ACL_PUBLIC_READ);
			
			
																

																if(sendEmail('./mails/first_reminder.'.$lang.'.html', $lSearch, $lReplacement, $sellersubject, $seller['email'], $attachmentPath)){

																			$invoices[$i]["status"]="first_reminder";
																			$lDB->updateInvoice($invoices[$i]);
																}
																
																

															@unlink("./invoices/first_reminder_".$invoices[$i]["filename"]);
										}


}





$invoices=array();

if($invoices=$lDB->getInvoicesByStatusAndDate("first_reminder", date("Y-m-d H:i:s", strtotime("-40 days")))){



	for($i=0; $i<count($invoices); $i++){


															$seller=$lDB->getUserWithAddressByID($invoices[$i]["recipient_id"]);



															$lSearch = array();
															
															$lSearch[0] = "___TOTAL___";
															$lSearch[1] = "___SITENAME___";

															$lSearch[2] = "___SELLERFIRSTNAME___";
															$lSearch[3] = "___SELLERLASTNAME___";
															$lSearch[4] = "___SELLERSTREET___";
															$lSearch[5] = "___SELLERNUMBER___";
															$lSearch[6] = "___SELLERPOSTCODE___";
															$lSearch[7] = "___SELLERCITY___";
															$lSearch[8] = "___SELLERPHONE___";
															$lSearch[9] = "___SELLEREMAIL___";

															$lSearch[10] = "___DATE___";
															$lSearch[11] = "___SUBJECT___";
														

															$lReplacement = array();
															$lReplacement[0] = $invoices[$i]['total'];
															$lReplacement[1] =$GLOBALS["VIEHAUKTION"]["BASE"]["APPNAME"];
															
															$lReplacement[2] =  htmlentities ( $seller["firstname"], ENT_QUOTES, "UTF-8");
															$lReplacement[3] =  htmlentities ( $seller["lastname"], ENT_QUOTES, "UTF-8");
															$lReplacement[4] =  htmlentities ( $seller["street"], ENT_QUOTES, "UTF-8");
															$lReplacement[5] =  htmlentities ( $seller["number"], ENT_QUOTES, "UTF-8");
															$lReplacement[6] =  htmlentities ( $seller["postcode"], ENT_QUOTES, "UTF-8");
															$lReplacement[7] =  htmlentities ( $seller["city"], ENT_QUOTES, "UTF-8");
															$lReplacement[8] =  htmlentities ( $seller["phone"], ENT_QUOTES, "UTF-8");
															$lReplacement[9] =  htmlentities ( $seller["email"], ENT_QUOTES, "UTF-8");


					
															$lReplacement[10] =  date("d.m.Y", strtotime($invoices[$i]['date']));
															$lReplacement[11] = htmlentities ( $texts['second_reminder_subject'], ENT_QUOTES, "UTF-8");
														

															
														
															

															

																$sellersubject=$texts['second_reminder_subject'];
							
																

																$attachmentPath="./invoices/second_reminder_".$invoices[$i]["filename"];

																$pdf = new SRBill('P', 'mm', 'A4');
																$pdf->AliasNbPages();
																$pdf->AddPage();

																$pdf->printRecipient($seller["company"], $seller["firstname"]." ".$seller["lastname"], $seller["street"].' '.$seller["number"], $seller["postcode"].' '.$seller["city"],  $seller["country"]);
								

																$pdf->SetLeftMargin(20);
																$pdf->SetRightMargin(20);

																$date=date("d.m.Y");

																$pdf->printReminderData($texts['second_reminder'],  $GLOBALS["VIEHAUKTION"]["REMINDER_TWO"], $invoices[$i]["invoice_number"], $invoices[$i]["auction_id"], $invoices[$i]['user_id'], $date, $invoices[$i]["amount_of_animals"], $invoices[$i]["provision"], $invoices[$i]["vat"], 10); 


																$pdfStream=$pdf->Output($attachmentPath,"F");



																$s3 = new S3($GLOBALS["VIEHAUKTION"]["AMAZON"]["ID"], $GLOBALS["VIEHAUKTION"]["AMAZON"]["KEY"]);


																$result=$s3->putObjectFile("./invoices/second_reminder_".$invoices[$i]["filename"], $GLOBALS["VIEHAUKTION"]["AMAZON"]["BUCKET"], "invoices/second_reminder_".$invoices[$i]["filename"], S3::ACL_PUBLIC_READ);
			
			
																

																if(sendEmail('./mails/second_reminder.'.$lang.'.html', $lSearch, $lReplacement, $sellersubject, $seller['email'], $attachmentPath)){

																			$invoices[$i]["status"]="second_reminder";
																			$lDB->updateInvoice($invoices[$i]);
																}
																
																

															@unlink("./invoices/second_reminder_".$invoices[$i]["filename"]);
										}


}







						}

				

	
?>