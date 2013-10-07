<?PHP


error_reporting(E_ERROR | E_WARNING | E_PARSE);

ini_set('default_charset','utf-8');
	
require_once('globals.inc.php');

require_once('DB.inc.php');

require_once("SRBill.class.php");


require_once("amazonS3/S3.php");

include("./phpmailer/class.phpmailer.php");




function connectDB() {
		// erstelle die Verbindung zur Datenbank um den clip dem Watschdog zu uebergeben
		$lHost = $GLOBALS["VIEHAUKTION"]["DATABASE"]["HOST"];
		$lUser = $GLOBALS["VIEHAUKTION"]["DATABASE"]["USER"];
		$lPassword = $GLOBALS["VIEHAUKTION"]["DATABASE"]["USERPASSWORD"];
		$lDBName = $GLOBALS["VIEHAUKTION"]["DATABASE"]["NAME"];
		
		return new DB($lHost, $lUser, $lPassword, $lDBName);
	}
	
		function sendEmail($emailTemplate, $lSearch, $lReplacement, $subject, $lRecipient) {
					
					$eMail = file_get_contents($emailTemplate);
					$finalEmail = str_replace($lSearch, $lReplacement, $eMail);
				
			
							$mail = new PHPMailer();
							
							$mail->IsSMTP(); // send via SMTP
							$mail->Host = $GLOBALS["VIEHAUKTION"]["EMAIL"]["SERVER"]; // SMTP servers
							$mail->SMTPAuth = false; // turn on SMTP authentication
							
							
							$mail->From = $GLOBALS["VIEHAUKTION"]["EMAIL"]["SENDERADDRESS"];
							$mail->FromName = $GLOBALS["VIEHAUKTION"]["EMAIL"]["SENDERNAME"];
							$mail->AddAddress($lRecipient, $lRecipient);
							
							$mail->IsHTML(false); // send as HTML
							
							$mail->Subject = $subject;
							$mail->Body = $finalEmail;
							
							
							if(!$mail->Send()) {
								return false;
								 }
							
							$mail->ClearAddresses();
							$mail->ClearAttachments();
							
							return true;
							
			
				}
				



$lDB=connectDB();
			if (!$lDB->failed){
			
$endedAuctions=array();
if($endedAuctions=$lDB->getEndedAuction("confirmed")){



	for($i=0; $i<count($endedAuctions); $i++){


															$seller=$lDB->getUserWithAddressByID($endedAuctions[$i]["user_id"]);


															$buyer=$lDB->getUserWithAddressByID($endedAuctions[$i]["buyer_id"]);


															$lSearch = array();
															
															$lSearch[0] = "___PRICE___";
															$lSearch[1] = "___SITENAME___";

															$lSearch[2] = "___SELLERFIRSTNAME___";
															$lSearch[3] = "___SELLERLASTNAME___";
															$lSearch[4] = "___SELLERSTREET___";
															$lSearch[5] = "___SELLERNUMBER___";
															$lSearch[6] = "___SELLERPOSTCODE___";
															$lSearch[7] = "___SELLERCITY___";
															$lSearch[8] = "___SELLERPHONE___";
															$lSearch[9] = "___SELLEREMAIL___";


															$lSearch[10] = "___BUYERFIRSTNAME___";
															$lSearch[11] = "___BUYERLASTNAME___";
															$lSearch[12] = "___BUYERSTREET___";
															$lSearch[13] = "___BUYERNUMBER___";
															$lSearch[14] = "___BUYERPOSTCODE___";
															$lSearch[15] = "___BUYERCITY___";
															$lSearch[16] = "___BUYERPHONE___";
															$lSearch[17] = "___BUYEREMAIL___";

															$lSearch[18] = "___PROVISION___";
															$lSearch[19] = "___INVOICELINK___";


															$lReplacement = array();
															$lReplacement[0] =$endedAuctions[$i]["current_entity_price"];
															$lReplacement[1] =$GLOBALS["VIEHAUKTION"]["BASE"]["APPNAME"];
															
															$lReplacement[2] = $seller["firstname"];
															$lReplacement[3] = $seller["lastname"];
															$lReplacement[4] = $seller["street"];
															$lReplacement[5] = $seller["number"];
															$lReplacement[6] = $seller["postcode"];
															$lReplacement[7] = $seller["city"];
															$lReplacement[8] = $seller["phone"];
															$lReplacement[9] = $seller["email"];


															$lReplacement[10] = $buyer["firstname"];
															$lReplacement[11] = $buyer["lastname"];
															$lReplacement[12] = $buyer["street"];
															$lReplacement[13] = $buyer["number"];
															$lReplacement[14] = $buyer["postcode"];
															$lReplacement[15] = $buyer["city"];
															$lReplacement[16] = $buyer["phone"];
															$lReplacement[17] = $buyer["email"];


															$lReplacement[16] = $buyer["phone"];
															$lReplacement[17] = $buyer["email"];


															$sellersubject='';
															$buyersubject='';
															$flag=0;

															if($endedAuctions[$i]["bids"]==0){

																$sellersubject='Leider war Ihre Auktion nicht erfolgreich.';
																
																if(sendEmail('./mails/failure_to_seller.de.txt', $lSearch, $lReplacement, $sellersubject, $seller['email'])){
																	$flag=3;
																}


															}else{
																$sellersubject='Ihre Auktion war erfolgreich!';
																$buyersubject='Sie haben eine Auktion gewonnen!';

																$metadata=$lDB->getAuctionMetadataByAuctionId($endedAuctions[$i]["id"]);


																$invoice=array();
																$invoice["auction_id"]=$endedAuctions[$i]["id"];
																$invoice["user_id"]=$endedAuctions[$i]["user_id"];
																$invoice["recipient_id"]=$endedAuctions[$i]["user_id"];
																$invoice["type"]="provision";
																$invoice["buyer_id"]=$endedAuctions[$i]["buyer_id"];
																$invoice["price"]=$endedAuctions[$i]["current_entity_price"];
																$invoice["vat"]=$GLOBALS["VIEHAUKTION"]["VAT"];
																$invoice["provision"]=$GLOBALS["VIEHAUKTION"]["PROVISION"];
																$invoice["amount_of_animals"]=$metadata["amount_of_animals"];
																$invoice["filename"]="provision_".$endedAuctions[$i]["id"]."_".$endedAuctions[$i]["user_id"].".pdf";
																$invoice["downloaded"]=0;

																$lDB->addInvoice($invoice);

																$currentInvoice=$lDB->getInvoiceByAuctionId($endedAuctions[$i]["id"]);

																

																$pdf = new SRBill('P', 'mm', 'A4');
																$pdf->AliasNbPages();
																$pdf->AddPage();

																$pdf->printRecipient($seller["company"], $seller["firstname"]." ".$seller["lastname"], $seller["street"].' '.$seller["number"], $seller["postcode"].' '.$seller["city"],  $seller["country"]);
								

																$pdf->SetLeftMargin(20);
																$pdf->SetRightMargin(20);

																$date=date("d.m.Y");

																$pdf->printBillData($currentInvoice["invoice_number"], $endedAuctions[$i]["id"], $endedAuctions[$i]['user_id'], $date, $metadata["amount_of_animals"], $currentInvoice["provision"], $currentInvoice["vat"], 10); 

																$pdf->printBuyer("", $buyer["firstname"]." ".$buyer["lastname"], $buyer["street"].' '.$buyer["number"], $buyer["postcode"].' '.$buyer["city"],  $buyer["country"]);
																
																$pdfStream=$pdf->Output("./invoices/".$invoice["filename"],"F");



																$s3 = new S3($GLOBALS["VIEHAUKTION"]["AMAZON"]["ID"], $GLOBALS["VIEHAUKTION"]["AMAZON"]["KEY"]);


																$result=$s3->putObjectFile("./invoices/".$invoice["filename"], $GLOBALS["VIEHAUKTION"]["AMAZON"]["BUCKET"], "invoices/".$invoice["filename"], S3::ACL_PUBLIC_READ);
			
			
															

																if(sendEmail('./mails/success_to_seller.de.txt', $lSearch, $lReplacement, $sellersubject, $seller['email'])){

																	$flag=1;
																}

																if(sendEmail('./mails/success_to_buyer.de.txt', $lSearch, $lReplacement, $buyersubject, $buyer['email'])){
																	if($flag==1){
																			$flag=3;
																		}else{
																			$flag=2;

																		}

																}

																


															}



															if($flag==3){

																$endedAuctions[$i]["mail_status"]="mail_complete";

															}else if($flag==2){
																$endedAuctions[$i]["mail_status"]="buyer_sent";
															}else if($flag==1){	
																$endedAuctions[$i]["mail_status"]="seller_sent";

															}else{
																$endedAuctions[$i]["mail_status"]="seller_error";
															}


															$lDB->updateAuction($endedAuctions[$i]);

														}



						}

					}

	

?>