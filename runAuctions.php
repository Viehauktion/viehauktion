<?PHP


error_reporting(E_ERROR | E_WARNING | E_PARSE);

ini_set('default_charset','utf-8');
	
require_once('globals.inc.php');

require_once('DB.inc.php');

require_once("SRBill.class.php");


require_once("amazonS3/S3.php");


include("./phpmailer/class.phpmailer.php");

include("Auction.inc.php");

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
	
		



$lDB=connectDB();
			if (!$lDB->failed){
			
$auctionsToStart=array();
if($auctionsToStart=$lDB->getTodaysMainAuctions()){



							for($i=0; $i<count($auctionsToStart); $i++){
									if($auctionsToStart[$i]['state_id']!='0'){
									//$call=$GLOBALS["VIEHAUKTION"]["BASE"]["HTTPROOT"]."?action=get_running_auction&mode=ajax&is_auction=yes&state_id=".$auctionsToStart[$i]['state_id']."&county_id=".$auctionsToStart[$i]['county_id'];
									

										$result=$lDB->getRunningAuction($auctionsToStart[$i]['county_id'], $auctionsToStart[$i]['category_id']);
									
										


										/*if(!$result){

															$lDB->closeAuction($auctionsToStart[$i]['id']);
										echo("close Auctio1".$auctionsToStart[$i]['id']);
																break;
										}*/


										if ((strtotime($result["end_time"])<time()) && ($result["end_time"]!='0000-00-00 00:00:00') && ($auctionsToStart[$i]['status']=='running')) {
																$lDB->closeAuction($auctionsToStart[$i]['id']);
																
										}
									// getCurrentAuctionFromDB($auctionsToStart[$i]['county_id'], $auctionsToStart[$i]['state_id']);
								}

							}



						}

					}

	

?>