<?PHP


error_reporting(E_ERROR | E_WARNING | E_PARSE);

ini_set('default_charset','utf-8');
	
require_once('globals.inc.php');

require_once('DB.inc.php');




require_once('Base.class.php');


include("./phpmailer/class.phpmailer.php");

include("User.inc.php");

include("Auction.inc.php");

require_once("SRBill.class.php");


//require_once("amazonS3/S3.php");


	
	if($_REQUEST["mode"]=="ajax"){
	$_REQUEST['sid'] ? session_id($_REQUEST['sid']) : session_id(md5(time().$_SERVER['REMOTE_ADDR'].rand()));
	}else{
	$_COOKIE["PHPSESSID"] ? session_id($_COOKIE["PHPSESSID"]) : session_id(md5(time().$_SERVER['REMOTE_ADDR'].rand()));
	}
	session_start();
	
	
	
	
	$gBase = new Base();
	
	
	

	function connectDB() {
		// erstelle die Verbindung zur Datenbank um den clip dem Watschdog zu uebergeben
		$lHost = $GLOBALS["VIEHAUKTION"]["DATABASE"]["HOST"];
		$lUser = $GLOBALS["VIEHAUKTION"]["DATABASE"]["USER"];
		$lPassword = $GLOBALS["VIEHAUKTION"]["DATABASE"]["USERPASSWORD"];
		$lDBName = $GLOBALS["VIEHAUKTION"]["DATABASE"]["NAME"];
		
		return new DB($lHost, $lUser, $lPassword, $lDBName);
	}
	



	function getCounties($state_id){
		
	
		global $gBase;
			
		$lDB=connectDB();
		if (!$lDB->failed){
	
				$counties=array();
				$counties=$lDB->getCountiesByStateId($state_id);
				
				
				 $gBase->RawData=$counties;
		}
		
	}

		
	function generateJSON(){

		global $gBase;
	
		$gBase->printJSON();
	
				
	}
		
	

	function checkCode($invite_code){

		global $gBase;
			
		$lDB=connectDB();
		if (!$lDB->failed){
			$codeArray=array();
			if($codeArray=$lDB->getInviteCode($invite_code)){


				setcookie("hasInviteCode", "yes");
				$codeArray["usuage"]=$codeArray["usuage"]+1;
				$lDB->updateInviteCode($codeArray);

				return true;
			}



			return false;
		}
		return false;

	}
	
	
	function setSetToPlay($setId){
		global $gBase;
				$lDB=connectDB();
				
				if (!$lDB->failed){
					
					if($lDB->addGame($setId,$gBase->User['user_id'])){
					
					$gamesessionarray=$lDB->getUsersInitialLastGame($gBase->User['user_id']);
					
				
					$game=array();
					$game['player_array']=array();
					
					$player=array();
					$player['user_id']=$gBase->User['user_id'];
					$player['facebook_id']=$gBase->User['facebook_id'];
					$player['username']=$gBase->User['firstname'];
					$player['card_indexes_array']=array();
					$player['last_checked_move']=1;
					$player2['plays_next_move']=1;
					
					$game['player_array'][0]['player']=$player;
					
				
					
					$game['move']=1;
	
					$game['calling_user_index']=$gBase->User['user_id'];
					$game['game_holder']=$gBase->User['user_id'];
		
					$game['number_of_cards_per_player']=0;
	
					$game['number_of_cards_in_game']=$game['set']['number_of_cards'];
				
					
				
					$game['set']=getLocaleSet($setId, $gBase->User['lang']);
					$game['set']['titles']=$lDB->getSetTitles($setId, $gBase->User['lang']);
					$game['set']['colors']=$lDB->getSetColors($setId);
					
			
					
					session_unset();
					session_destroy();
					
					/*session_id($gamesessionarray[0]['game_session_id']);
					session_start();
					*/
					
					
					$_REQUEST['game_session_id']=$gamesessionarray[0]['game_session_id'];
					
					$gBase = new Base('game');
					$gBase->Game=$game;
					
					
					
					
					
					}
					
					
				}
		
		}
		
		
	$hasInvite=false;

	$Action =  $_REQUEST["action"]; 
	$View =  $_REQUEST["view"]; 
	if($View==""){
		$View="home";
		}
	$Mode=  $_REQUEST["mode"]; 
	$lang='de';
		
	   switch ($Action) {
		   
		   			
					
					case 'register_user': registerUser(true, $_REQUEST['username'],  $_REQUEST['password'], $_REQUEST['email'], $_REQUEST['company'], $_REQUEST['firstname'], $_REQUEST['lastname'],$_REQUEST['street'],$_REQUEST['number'],$_REQUEST['postcode'],$_REQUEST['city'], $_REQUEST['phone'], $_REQUEST['is_buyer'], $_REQUEST['is_seller'], $_REQUEST['newsletter'], $lang); break;
					case 'edit_user': registerUser(false, $_REQUEST['username'],  $_REQUEST['password'], $_REQUEST['email'], $_REQUEST['company'], $_REQUEST['firstname'], $_REQUEST['lastname'],$_REQUEST['street'],$_REQUEST['number'],$_REQUEST['postcode'],$_REQUEST['city'], $_REQUEST['phone'], $_REQUEST['is_buyer'], $_REQUEST['is_seller'], $_REQUEST['newsletter'], $lang); break;
					

					case 'login_user': loginUser($_REQUEST['identifier'], $_REQUEST['password']);  break;
					case 'logout_user': logoutUser();  break;
					case 'generate_new_password': generateNewUserPassword($_REQUEST['identifier'], $lang);  break;
					case 'change_password': changePassword($_REQUEST['old_password'], $_REQUEST['new_password']);   break;
					case 'change_email':  changeEmail($gBase->User, $_REQUEST['user_email'], $_REQUEST['user_oldpassword']);  break;
					case 'change_username':  changeUsername($gBase->User, $_REQUEST['username'], $_REQUEST['user_oldpassword']);  break;
					
					
					case 'get_counties':  getCounties($_REQUEST['state_id']);  break;
					
					case 'add_address':	addAddress($_REQUEST['street'], $_REQUEST['number'], $_REQUEST['postcode'],$_REQUEST['city'], $_REQUEST['county_id'],$_REQUEST['state_id']); break;
					
				
					case "edit_auction":  editAuction($_REQUEST['category_id'], $_REQUEST['auction_id'], $_REQUEST['is_preview'], $_REQUEST['is_auction'], $_REQUEST['auction_date'], $_REQUEST['auction_amount'], $_REQUEST['auction_min_entitity_price'], $_REQUEST['auction_origin'], $_REQUEST['form'], $_REQUEST['auction_pigs_form_value'], $_REQUEST['autoform'], $_REQUEST['auction_pigs_autoform_value'], $_REQUEST['auction_pigs_qs'], $_REQUEST['auction_pigs_samonelle_state'], $_REQUEST['address'], $_REQUEST['auction_loading_stations_amount'], $_REQUEST['auction_loading_stations_distance'], $_REQUEST['auction_loading_stations_vehicle'], $_REQUEST['auction_loading_stations_availability'], $_REQUEST['auction_loading_stations_availability_til'], $_REQUEST['auction_additional_informations']); getUserAuctions($gBase->User['id'], false); break;
					

					case "get_invoice":  getInvoice($_REQUEST['auction_id']); break; 


					case "remove_auction": removeAuction($_REQUEST['auction_id']); break;	



					case "send_activationmail_again": sendActivationMailAgain($_REQUEST['email'], $lang); break;


					case "get_pending_auction_states":	getPendingStates($_REQUEST['start_time']); break;
					case "get_pending_auction_counties":	getPendingCounties($_REQUEST['state_id'], $_REQUEST['is_auction']); break;
					case "get_next_auction":		getNextAuction($_REQUEST['county_id'],$_REQUEST['state_id'], $_REQUEST['is_auction']); break;
					case "get_running_auction":		getRunningAuction($_REQUEST['county_id'], $_REQUEST['auction_id']); break;


					case "get_auction_details":		getAuctionDetails($_REQUEST['auction_id'], $_REQUEST['county_id'], $_REQUEST['state_id']); break;
					case "buy_offer":				buyOffer($_REQUEST['auction_id']); break;

					case "bid_on_running_auction":  bidOnRunningAution($_REQUEST['county_id'], $_REQUEST['auction_id'], $_REQUEST['bid']); break;

					case "check_code":		$hasInvite=checkCode($_REQUEST['invite_code']); break;
					
		}
		switch ($View) {
		
		
			case 'profile': getUserAuctions($gBase->User['id'], true); getUserAuctions($gBase->User['id'], false); break;
			case 'auctions': checkTodaysAuctions(); break;
			case 'market':	checkTodaysOffers(); break;

			case 'edit_auction':  getCurrentAuction($_REQUEST['auction_id']); break;
			
		}
		
	
			
		
			if($_COOKIE["hasInviteCode"]=="yes" || $hasInvite){




			if($Mode=='ajax'){
						generateJSON();
				}else{
					
					include('locale/'.$lang.'.php');
					include('breadcrumb.php');
					include('views/framework.php');
			}
		

			}else{
	include('locale/'.$lang.'.php');
					include('views/invite.php');

			}
		
		$gBase->saveToSession();
		
		
		if($_REQUEST['debug']=='yes'){
			
			echo('<p>');
		generateJSON();
		echo('</p>');
		}

	

?>