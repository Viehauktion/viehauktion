<?PHP


error_reporting(E_ERROR);

ini_set('default_charset','utf-8');
	
require_once('globals.inc.php');

require_once('DB.inc.php');




require_once('Base.class.php');


include("./phpmailer/class.phpmailer.php");

include("User.inc.php");

include("Auction.inc.php");
include("Invoices.inc.php");
include("Ratings.inc.php");


require_once("SRBill.class.php");


require_once("amazonS3/S3.php");


	
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
	

	
function getNextAuctions($auction_category){



$nextDates=array();

$lDB=connectDB();
      if (!$lDB->failed){

            $auctionCategory=array();
            $auctionCategory=$lDB->getAuctionCategoryById($auction_category);
      


            $auctionDays=explode("_",$auctionCategory['days']);
            $additionalDays=0;
            for($i=0;$i<count($auctionDays)-1;$i++){
      

              if($auctionDays[$i]>date("N")){

                $additionalDays=$auctionDays[$i]-date("N");

              }elseif ($auctionDays[$i]==date("N")&&$auctionCategory['start_time']>date("H:i:s",  strtotime("+10 minute"))){

                $additionalDays=0;
                

              }else{

                $additionalDays=$auctionDays[$i]+7-date("N");

              }


                $date=array();
                $date['readable_date']=date("d.m.y", strtotime("+".$additionalDays." day"))." ".$auctionCategory['start_time'];
                $date['submitable_date']=date("Y-m-d", strtotime("+".$additionalDays." day"))." ".$auctionCategory['start_time'];
                $date['additional_days']=$additionalDays;

                array_push($nextDates,$date);

              }

                for($i=0;$i<count($nextDates);$i++){

                  for($j=0;$j<count($nextDates);$j++){

                    if($nextDates[$i]['additional_days']<$nextDates[$j]['additional_days']){
                      $tmpDate=$nextDates[$i];
                      $nextDates[$i]=$nextDates[$j];
                      $nextDates[$j]=$tmpDate;


                    }

                  }

                }
              
     }

return $nextDates;

}
		
	$hasInvite=false;

	$Action =  $_REQUEST["action"]; 
	$View =  $_REQUEST["view"]; 
	if($View==""){
		$View="home";
		}
	$Mode=  $_REQUEST["mode"]; 
	$lang='de';
	

    $category_id=$_REQUEST["category_id"];
    if($category_id==""){
	$category_id='1';	
	}	
	   switch ($Action) {
		   
		   			
					
					case 'register_user': registerUser(true,  $_REQUEST['password'], $_REQUEST['email'], $_REQUEST['company'], $_REQUEST['firstname'], $_REQUEST['lastname'],$_REQUEST['street'],$_REQUEST['number'],$_REQUEST['postcode'],$_REQUEST['city'], $_REQUEST['county'],$_REQUEST['state'], $_REQUEST['phone'], $_REQUEST['is_buyer'], $_REQUEST['is_seller'], $_REQUEST['newsletter'], $_REQUEST['hrb_nr'], $_REQUEST['retail_nr'], $_REQUEST['stall_nr'], $_REQUEST['vat_nr'], $lang); break;
					case 'edit_user': registerUser(false, $_REQUEST['password'], $_REQUEST['email'], $_REQUEST['company'], $_REQUEST['firstname'], $_REQUEST['lastname'],$_REQUEST['street'],$_REQUEST['number'],$_REQUEST['postcode'],$_REQUEST['city'], $_REQUEST['county'],$_REQUEST['state'], $_REQUEST['phone'], $_REQUEST['is_buyer'], $_REQUEST['is_seller'], $_REQUEST['newsletter'], $_REQUEST['hrb_nr'], $_REQUEST['retail_nr'], $_REQUEST['stall_nr'], $_REQUEST['vat_nr'],  $lang); break;
					

					case 'login_user': loginUser($_REQUEST['identifier'], $_REQUEST['password']);  break;
					case 'logout_user': logoutUser();  break;
					case 'generate_new_password': generateNewUserPassword($_REQUEST['identifier'], $lang);  break;
					case 'change_password': changePassword($_REQUEST['old_password'], $_REQUEST['new_password']);   break;
					case 'change_email':  changeEmail($gBase->User, $_REQUEST['user_email'], $_REQUEST['user_oldpassword']);  break;
					case 'change_username':  changeUsername($gBase->User, $_REQUEST['username'], $_REQUEST['user_oldpassword']);  break;
					
					
					case 'get_counties':  getCounties($_REQUEST['state_id']);  break;
					
					case 'add_address':	addAddress($_REQUEST['street'], $_REQUEST['number'], $_REQUEST['postcode'],$_REQUEST['city'], $_REQUEST['county_id'],$_REQUEST['state_id']); break;
					
				
		
					//case "get_invoice":  getInvoice($_REQUEST['auction_id']); break; 
					case "get_invoice":  getInvoice($_REQUEST['invoice_id']); break; 

					case "remove_auction": removeAuction($_REQUEST['auction_id']); break;
					case "cancel_auction": cancelAuction($_REQUEST['auction_id']); break;	



					case "send_activationmail_again": sendActivationMailAgain($lang); break;
					case "activate_user":	activateUser($_REQUEST['user_id'], $_REQUEST['user_email'], $_REQUEST['activationcode']); break;

					case "edit_auction":  editAuction($_REQUEST['category_id'], $_REQUEST['auction_id'], $_REQUEST['is_preview'], $_REQUEST['is_auction'], $_REQUEST['is_main_auction'],$_REQUEST['is_vezg'], $_REQUEST['auction_date'], $_REQUEST['endtime'], $_REQUEST['auction_amount'], $_REQUEST['auction_min_entitity_price'], $_REQUEST['auction_origin'], $_REQUEST['auction_classification_mask'], $_REQUEST['auction_pigs_classification_mask_value'], $_REQUEST['auction_pigs_qs'], $_REQUEST['auction_pigs_samonelle_state'], $_REQUEST['address'], $_REQUEST['auction_loading_stations_amount'], $_REQUEST['auction_loading_stations_distance'], $_REQUEST['auction_loading_stations_vehicle'], $_REQUEST['auction_loading_stations_availability'], $_REQUEST['auction_loading_stations_availability_til'], $_REQUEST['is_public'], $_REQUEST['auction_additional_informations']); getUserAuctions($gBase->User['id'], false); break;
					case "save_auction":	saveAuction($_REQUEST['auction_id'], $_REQUEST['is_auction'], "yes"); break;

					case "get_pending_auction_states":	getPendingStates($_REQUEST['is_auction'], $category_id); break;
					case "get_pending_auction_counties":	getPendingCounties($_REQUEST['state_id'], $_REQUEST['is_auction'], $category_id); break;
					case "get_next_auction":		getNextAuction($_REQUEST['county_id'],$_REQUEST['state_id'], $_REQUEST['is_auction'], $category_id); break;
					case "get_running_auction":		getRunningAuction($_REQUEST['county_id'],$_REQUEST['state_id'], $_REQUEST['auction_id'], $category_id); break;

					case "confirm_auction":			confirmAuction($_REQUEST['auction_id']); break;
					case "get_auction_details":		getAuctionDetails($_REQUEST['auction_id'], $_REQUEST['county_id'], $_REQUEST['state_id']); break;
					case "buy_offer":				buyOffer($_REQUEST['auction_id']); break;

					case "bid_on_running_auction":  bidOnRunningAution($_REQUEST['county_id'], $_REQUEST['auction_id'], $_REQUEST['bid'],$category_id); break;

					case "check_code":		$hasInvite=checkCode($_REQUEST['invite_code']); break;
				

					case "rate_user": rateUser($_REQUEST['auction_id'], $_REQUEST['comment'], $_REQUEST['rating']); break;	
		
					case 'get_user_actions': getUserAuctions($gBase->User['id'], false, $_REQUEST['page']); break;
					case 'get_user_won_actions': getUserAuctions($gBase->User['id'], true, $_REQUEST['page']); break;
					case 'get_user_offers': getUserOffers($gBase->User['id'], false, $_REQUEST['page']); break;
					case 'get_user_won_offers': getUserOffers($gBase->User['id'], true, $_REQUEST['page']); break;
					case 'get_user_invoices': getUserInvoices($gBase->User['id'], $_REQUEST['page']); break;
					case 'get_ratings_about': getUserRatings($gBase->User['id'], true, $_REQUEST['page']); break;
					case 'get_ratings_from': getUserRatings($gBase->User['id'], false, $_REQUEST['page']); break;
					case 'get_latest_offers': getLatestAuctions(false, $_REQUEST['page']); break;

					case 'get_user':	getUsers($_REQUEST['page']); break;
					case 'get_buyer_to_confirm': getBuyerToConfirm($_REQUEST['page']); break;

					case 'delete_user':	 changeUserStatus($_REQUEST['user_id'], 3); getBuyerToConfirm(1); getUsers(1);break;
					case 'confirm_user':	 changeUserStatus($_REQUEST['user_id'], 2); getBuyerToConfirm(1);  getUsers(1);  break;
					case 'imitate_user':	 imitateUser($_REQUEST['user_id']); break;
					case 'show_full_user':	getUserDetails($_REQUEST['user_id'], $_REQUEST['auction_id']); break;
					case 'get_finished_offers': getFinishedOffers($_REQUEST['page']); break;
					case 'get_finished_auctions': getFinishedAuctions($_REQUEST['page']); break;


		}
		switch ($View) {
		
		
			case 'profile': if($Action==''){$gBase->RawData=array();getUserAuctions($gBase->User['id'], true); 
							getUserAuctions($gBase->User['id'], false); 
							getUserOffers($gBase->User['id'], true); 
							getUserOffers($gBase->User['id'], false);
							getUserRatings($gBase->User['id'], true);
							getUserRatings($gBase->User['id'], false);
							getUserInvoices($gBase->User['id']);} break;
			case 'auctions': getLatestAuctions($category_id, true); checkTodaysAuctions($category_id); break;
			case 'market':	if($Action==''){ getLatestAuctions($category_id,false);} checkTodaysOffers($category_id); break;

			case 'edit_auction':  getCurrentAuction($_REQUEST['auction_id']); break;
			case 'backend':		if($Action==''){ getBuyerToConfirm(1); getUsers(1);  getFinishedOffers(1); getFinishedAuctions(1);} break;


			
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