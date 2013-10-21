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
			


$futureHour=date("Y-m-d H:i:s", strtotime("+1 hour"));

$auctionsToLock=$lDB->lockAuctionsForHour($futureHour);

}


	

?>