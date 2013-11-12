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
			
$endedAuctions=array();
if($endedAuctions=$lDB->getEndedAuction("confirmed","confirmed","")){



	for($i=0; $i<count($endedAuctions); $i++){
	if($endedAuctions[$i]['county_id']!=0){

															$seller=$lDB->getUserWithAddressByID($endedAuctions[$i]["user_id"]);


															$buyer=$lDB->getUserWithAddressByID($endedAuctions[$i]["buyer_id"]);

															$seller_metada=array();
															if($seller_metada=$lDB->getUserMetadata($endedAuctions[$i]["user_id"])){

																
																	if($endedAuctions[$i]["is_auction"]=="yes"){
																			$seller_metada['sold_auctions']=$seller_metada['sold_auctions']+1;
																	}else{
																			$seller_metada['sold_offers']=$seller_metada['sold_offers']+1;
																	}
																	$lDB->updateUserMetadata($seller_metada);

															}else{
																	$seller_metada['user_id']=$endedAuctions[$i]["user_id"];
																	if($endedAuctions[$i]["is_auction"]=="yes"){
																			$seller_metada['sold_auctions']=1;
																	}else{
																			$seller_metada['sold_offers']=1;
																	}
																	$lDB->addUserMetadata($seller_metada);
															}



															$buyer_metada=array();
															if($buyer_metada=$lDB->getUserMetadata($endedAuctions[$i]["buyer_id"])){

																
																	if($endedAuctions[$i]["is_auction"]=="yes"){
																			$buyer_metada['bought_auctions']=$buyer_metada['bought_auctions']+1;
																	}else{
																			$buyer_metada['bought_offers']=$seller_metada['bought_offers']+1;
																	}
																	$lDB->updateUserMetadata($buyer_metada);

															}else{
																	$buyer_metada['user_id']=$endedAuctions[$i]["buyer_id"];
																	if($endedAuctions[$i]["is_auction"]=="yes"){
																			$buyer_metada['bought_auctions']=1;
																	}else{
																			$buyer_metada['bought_offers']=1;
																	}
																	$lDB->addUserMetadata($buyer_metada);
															}

															


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
															$lSearch[19] = "___SUBJECT___";
$lSearch[19] = "___VEZG___";

															$lReplacement = array();
															$lReplacement[0] =$endedAuctions[$i]["current_entity_price"];
															$lReplacement[1] =$GLOBALS["VIEHAUKTION"]["BASE"]["APPNAME"];
															
															$lReplacement[2] =  htmlentities ( $seller["firstname"], ENT_QUOTES, "UTF-8");
															$lReplacement[3] =  htmlentities ( $seller["lastname"], ENT_QUOTES, "UTF-8");
															$lReplacement[4] =  htmlentities ( $seller["street"], ENT_QUOTES, "UTF-8");
															$lReplacement[5] =  htmlentities ( $seller["number"], ENT_QUOTES, "UTF-8");
															$lReplacement[6] =  htmlentities ( $seller["postcode"], ENT_QUOTES, "UTF-8");
															$lReplacement[7] =  htmlentities ( $seller["city"], ENT_QUOTES, "UTF-8");
															$lReplacement[8] =  htmlentities ( $seller["phone"], ENT_QUOTES, "UTF-8");
															$lReplacement[9] =  htmlentities ( $seller["email"], ENT_QUOTES, "UTF-8");


															$lReplacement[10] =  htmlentities ( $buyer["firstname"], ENT_QUOTES, "UTF-8");
															$lReplacement[11] =  htmlentities ( $buyer["lastname"], ENT_QUOTES, "UTF-8");
															$lReplacement[12] =  htmlentities ( $buyer["street"], ENT_QUOTES, "UTF-8");
															$lReplacement[13] =  htmlentities ( $buyer["number"], ENT_QUOTES, "UTF-8");
															$lReplacement[14] =  htmlentities ( $buyer["postcode"], ENT_QUOTES, "UTF-8");
															$lReplacement[15] =  htmlentities ( $buyer["city"], ENT_QUOTES, "UTF-8");
															$lReplacement[16] =  htmlentities ( $buyer["phone"], ENT_QUOTES, "UTF-8");
															$lReplacement[17] =  htmlentities ( $buyer["email"], ENT_QUOTES, "UTF-8");


															$lReplacement[16] = $buyer["phone"];
															$lReplacement[17] = $buyer["email"];
															$lReplacement[18] = "";
															$lReplacement[19] = "";

																if($endedAuctions[$i]["is_vezg"]=="yes"){
																	$lReplacement[20]=$texts['mail_vezg_date'].date("d.m.Y", strtotime($endedAuctions[$i]["start_time"]));
															}else{

																$lReplacement[20]="";
															}
														
															


															$sellersubject='';
															$buyersubject='';
															$flag=0;

																$sellersubject=$texts['confirmed_auction_seller_subject'];
																$buyersubject=$texts['confirmed_auction_buyer_subject'];

																$metadata=$lDB->getAuctionMetadataByAuctionId($endedAuctions[$i]["id"]);


																$attachmentPath="";
																if($lDB->getNumberOfUserAuctions($endedAuctions[$i]["user_id"], "confirmed")>0){

																$invoice=array();
																$invoice["auction_id"]=$endedAuctions[$i]["id"];
																$invoice["user_id"]=$endedAuctions[$i]["user_id"];
																$invoice["recipient_id"]=$endedAuctions[$i]["user_id"];
																$invoice["type"]="provision";
																$invoice["buyer_id"]=$endedAuctions[$i]["buyer_id"];
																$invoice["price"]=$endedAuctions[$i]["current_entity_price"];
																$invoice["vat"]=$GLOBALS["VIEHAUKTION"]["VAT"];
																
																$invoice["provision"]=$GLOBALS["VIEHAUKTION"]["PROVISION"];
																if($endedAuctions[$i]["category_id"]=='2'){
																	$invoice["provision"]=$GLOBALS["VIEHAUKTION"]["FERKEL_PROVISION"];
																}

																$total=$invoice["provision"]*$metadata["amount_of_animals"]*(100+$GLOBALS["VIEHAUKTION"]["VAT"])/100;
																$invoice["total"]=number_format($total, 2, '.', '');
																$lReplacement[18]=$total;

																$invoice["amount_of_animals"]=$metadata["amount_of_animals"];
																$invoice["filename"]="provision_".$endedAuctions[$i]["id"]."_".$endedAuctions[$i]["user_id"].".pdf";
																$invoice["downloaded"]=0;

																$lDB->addInvoice($invoice);

																$currentInvoice=$lDB->getInvoiceByAuctionId($endedAuctions[$i]["id"]);

																$attachmentPath="./invoices/".$invoice["filename"];

																$pdf = new SRBill('P', 'mm', 'A4');
																$pdf->AliasNbPages();
																$pdf->AddPage();

																$pdf->printRecipient($seller["company"], $seller["firstname"]." ".$seller["lastname"], $seller["street"].' '.$seller["number"], $seller["postcode"].' '.$seller["city"],  $seller["country"]);
								

																$pdf->SetLeftMargin(20);
																$pdf->SetRightMargin(20);

																$date=date("d.m.Y");

																$pdf->printBillData($currentInvoice["invoice_number"], $endedAuctions[$i]["id"], $endedAuctions[$i]['user_id'], $date, $metadata["amount_of_animals"], $currentInvoice["provision"], $currentInvoice["vat"], 10); 


																$pdf->printBuyer("", $buyer["firstname"]." ".$buyer["lastname"], $buyer["street"].' '.$buyer["number"], $buyer["postcode"].' '.$buyer["city"],  $buyer["country"],  $endedAuctions[$i]["current_entity_price"], $lReplacement[20]);
																
																$pdfStream=$pdf->Output($attachmentPath,"F");



																$s3 = new S3($GLOBALS["VIEHAUKTION"]["AMAZON"]["ID"], $GLOBALS["VIEHAUKTION"]["AMAZON"]["KEY"]);


																$result=$s3->putObjectFile("./invoices/".$invoice["filename"], $GLOBALS["VIEHAUKTION"]["AMAZON"]["BUCKET"], "invoices/".$invoice["filename"], S3::ACL_PUBLIC_READ);
			
			
																}


															


																$offer_inset="";
																if($endedAuctions[$i]["is_auction"]=="no"){
																	$offer_inset="offer_";
																}
																if($attachmentPath==""){
																		$lReplacement[19]=$sellersubject;
																	if(sendEmail('./mails/success_'.$offer_inset.'without_invoice_to_seller.'.$lang.'.html', $lSearch, $lReplacement, $sellersubject, $seller['email'], $attachmentPath)){

																	$flag=1;
																	}
																}else{
																			$lReplacement[19]=$sellersubject;
																	if(sendEmail('./mails/success_'.$offer_inset.'to_seller.'.$lang.'.html', $lSearch, $lReplacement, $sellersubject, $seller['email'], $attachmentPath)){

																		$flag=1;
																	}

																}
																			$lReplacement[19]=$buyersubject;
																if(sendEmail('./mails/success_'.$offer_inset.'to_buyer.'.$lang.'.html', $lSearch, $lReplacement, $buyersubject, $buyer['email'],"")){
																	if($flag==1){
																			$flag=3;
																		}else{
																			$flag=2;

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
	@unlink("./invoices/".$invoice["filename"]);
														}


}
						}

					}

	
?>