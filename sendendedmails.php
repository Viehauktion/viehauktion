<?PHP


error_reporting(E_ERROR | E_WARNING | E_PARSE);

ini_set('default_charset','utf-8');
	
require_once('globals.inc.php');

require_once('DB.inc.php');

require_once("SRBill.class.php");


require_once("amazonS3/S3.php");

include("./phpmailer/class.phpmailer.php");

$lang='de';

include('locale/'.$lang.'.php');



/*
//Cronjob - Versendet Mails nach dem Ende der Auktion und setzt Auktionen,
//die nach einer in globals definierten Zeit nicht gecancelt wurden auf confirmed.
*/

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
if($endedAuctions=$lDB->getEndedAuction("ended","","")){



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
															$lSearch[18] = "___TILLTIME___";


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
															$lReplacement[18] = date("d.m.Y - H:i", 
															strtotime($endedAuctions[$i]["end_time"])+60*$GLOBALS["VIEHAUKTION"]["STORNO"]["TIME"])." Uhr";



															$sellersubject='';
															$buyersubject='';
															$flag=0;

															if(($endedAuctions[$i]["bids"]==0) && ($endedAuctions[$i]["is_auction"]=="yes")){

																$sellersubject=$texts['failure_auction_seller_subject'];
																
																if(sendEmail('./mails/failure_to_seller.'.$lang.'.txt', $lSearch, $lReplacement, $sellersubject, $seller['email'])){
																	$flag=3;
																}


															}else{


																$sellersubject=$texts['success_auction_seller_subject'];
															
																$buyersubject=$texts['success_auction_buyer_subject'];

																if($endedAuctions[$i]['is_auction']=='no'){

																	$sellersubject=$texts['success_offer_buyer_subject'];
															
																	$buyersubject=$texts['success_offer_seller_subject'];
																}

																$metadata=$lDB->getAuctionMetadataByAuctionId($endedAuctions[$i]["id"]);


																$invoice=array();
																$invoice["auction_id"]=$endedAuctions[$i]["id"];
																$invoice["user_id"]=$endedAuctions[$i]["user_id"];
																$invoice["buyer_id"]=$endedAuctions[$i]["buyer_id"];
																$invoice["price"]=$endedAuctions[$i]["current_entity_price"];
																$invoice["vat"]=19;
																$invoice["provision"]=0.4;
																$invoice["amount_of_animals"]=$metadata["amount_of_animals"];
																$invoice["filename"]=$endedAuctions[$i]["id"]."_".$endedAuctions[$i]["user_id"].".pdf";
																$invoice["downloaded"]=0;

																$lDB->addInvoice($invoice);

																
																$offer_inset="";
																if($endedAuctions[$i]["is_auction"]=="no"){
																	$offer_inset="offer_";
																}

																if(sendEmail('./mails/ended_'.$offer_inset.'to_seller.'.$lang.'.txt', $lSearch, $lReplacement, $sellersubject, $seller['email'])){

																	$flag=1;
																}

																if(sendEmail('./mails/ended_'.$offer_inset.'to_buyer.'.$lang.'.txt', $lSearch, $lReplacement, $buyersubject, $buyer['email'])){
																	if($flag==1){
																			$flag=3;
																		}else{
																			$flag=2;

																		}

																}
																


															}



															if($flag==3){

																$endedAuctions[$i]["mail_status"]="ended_mail_complete";

															}else{

																$endedAuctions[$i]["mail_status"]="ended_mail_failed";
															}


															$lDB->updateAuction($endedAuctions[$i]);

														}



						}



						$auctionsToConfirm=array();
$passedStornoTime=date("y-m-d H:i:s", strtotime("-".$GLOBALS["VIEHAUKTION"]["STORNO"]["TIME"]."Minute"));

if($auctionsToConfirm=$lDB->getEndedAuction("ended","ended_mail_complete", $passedStornoTime)){



	for($i=0; $i<count($auctionsToConfirm); $i++){

	
		$auctionsToConfirm[$i]["mail_status"]="confirmed";
		$auctionsToConfirm[$i]["status"]="confirmed";
	
		$lDB->updateAuction($auctionsToConfirm[$i]);
		

	}
}

					}

	

?>