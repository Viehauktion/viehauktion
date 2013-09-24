
<?PHP
class DB {
		var $DBHost;
		var $DBUser;
		var $DBPassword;
		var $DBName;
		var $failed;

		var $MySQL_Connection;
		

		/**
		* Stellt Verbindung zur miniCG Datenbank her
        * @param 	Hostname des DB Servers
        * @param 	DB Benutzername
        * @param 	Passwort des DB benutzers
        * @param 	Name der Datenbank
        * @return 	<code>true</code> wenn erfolgreich, <code>false</code> sonst
        * 
        */
		function DB ($lHost, $lUser, $lPassword, $lDBName) {
			$this->DBHost 		= $lHost;
			$this->DBUser 		= $lUser;
			$this->DBPassword 	= $lPassword;
			$this->DBName 		= $lDBName;

			$this->MySQL_Connection = mysql_connect($this->DBHost, $this->DBUser, $this->DBPassword);

			$lDBList = @mysql_list_dbs();
			$lDB_Found = false;

			while ($row = @mysql_fetch_object($lDBList)) {
			   if ($row->Database == $lDBName) $lDB_Found = true;
			}

			if ($lDB_Found) {
				// Datenbank existiert auf dem DB Server
				$lMySQL_DB = @mysql_select_db ($this->DBName);
			} else {
				// Datenbank existiert nicht auf dem DB Server
                
			}
			$this->failed = !(($this->MySQL_Connection) && $lMySQL_DB);
		}
		
		/**
		*
		* Genau wie mysql_query nur gibt es die Fehlermeldung und das Query aus, wenn im DEBUG Modus
        * @param 	SQL Query
        * @return 	SQL Resource wenn erfolgreich, sonst Fehlermeldung
		*/
		
		function mysql_query_ex ($lSQLQuery) {
			$result = mysql_query("SET NAMES utf8");
			
			$SQLResult = @mysql_query($lSQLQuery);

			if ($SQLResult) {
			//	$GLOBALS["MINICG"]["BASE"]["LOG"]->addString('OK', true);
			} else {
				//$GLOBALS["MINICG"]["BASE"]["LOG"]->addString('ERROR', true);
			}

			return $SQLResult;
		}
		



		/*------------------------------
		//
		//	USER    DB
		//
		--------------------------------*/
		

       function addUser($userArray) {
		
		
				$lSQLQuery = "INSERT INTO `users` ( `" . implode('`, `', array_keys($userArray)) . "`, `date`) VALUES ('" . implode("' ,'", $userArray) . "', NOW());";
				$lResult = $this->mysql_query_ex($lSQLQuery);
				if ($lResult) {
					
						
							return true;
							
					
					}
			
			return false;
		}
		
		
		
		function getUser($username) {
			
			
			if ($username) {
		
					$lSQLQuery = "SELECT * FROM `users` WHERE `username` = '".mysql_real_escape_string($username)."' LIMIT 1";
					$lResult = $this->mysql_query_ex($lSQLQuery);
					if ($lResult) {
					
							$lArray = mysql_fetch_assoc($lResult);
							return $lArray;
					}
			
					return false;	
		
			}
			return false;
		}
		
		
		function getUserByID($userid) {
			
			
			if ($userid) {
		
					$lSQLQuery = "SELECT * FROM `users` WHERE `id` = '".mysql_real_escape_string($userid)."' LIMIT 1";
					$lResult = $this->mysql_query_ex($lSQLQuery);
					if ($lResult) {
					
							$lArray = mysql_fetch_assoc($lResult);
							return $lArray;
					}
			
					return false;	
		
			}
			return false;
		}
		
		
		
		
		function getUserByUsernameWithPassword($username, $user_password){
			
			
			if ($username) {
		
					$lSQLQuery = "SELECT * FROM `users` WHERE `username` = '".mysql_real_escape_string($username)."' AND `password`='".mysql_real_escape_string($user_password)."' LIMIT 1";
					$lResult = $this->mysql_query_ex($lSQLQuery);
					if ($lResult) {
					
							$lArray = mysql_fetch_assoc($lResult);
							return $lArray;
					}
			
					return false;	
		
			}
			return false;
			
			
			}
		
		function getUserByEmailWithPassword($useremail, $user_password){
			
			
			if ($useremail) {
		
					$lSQLQuery = "SELECT * FROM `users` WHERE `email` = '".mysql_real_escape_string($useremail)."' AND `password`='".mysql_real_escape_string($user_password)."' LIMIT 1";
					$lResult = $this->mysql_query_ex($lSQLQuery);
					if ($lResult) {
					
							$lArray = mysql_fetch_assoc($lResult);
							return $lArray;
					}
			
					return false;	
		
			}
			return false;
			
			
			}
			
			
		function getUserByEmail($user_email){
			
				if ($user_email) {
		
					$lSQLQuery = "SELECT * FROM `users` WHERE `email` = '".mysql_real_escape_string($user_email)."' LIMIT 1";
					$lResult = $this->mysql_query_ex($lSQLQuery);
					if ($lResult) {
					
							$lArray = mysql_fetch_assoc($lResult);
							return $lArray;
					}
			
					return false;	
		
			}
			return false;
			
			
			
			
		}	
		
		
				
			
		function getUserByUsername($username){
			
				if ($username) {
		
					$lSQLQuery = "SELECT * FROM `users` WHERE `username` = '".mysql_real_escape_string($username)."' LIMIT 1";
					$lResult = $this->mysql_query_ex($lSQLQuery);
					if ($lResult) {
					
							$lArray = mysql_fetch_assoc($lResult);
							return $lArray;
					}
			
					return false;	
		
			}
			return false;
			
			
			
			
		}	
		
		
		
		
		function updateUser($userArray) {
		
			$lSQLQuery = "UPDATE `users` SET ";
			
			
			for($i=0; $i<count($userArray); $i++){
				
									if($value = current($userArray)){
					
									if(key($userArray)!='id'){
									$lSQLQuery .="`".key($userArray)."`='".mysql_real_escape_string($value)."', ";
									}
									
					} 
					next($userArray);
			}
					
					
			$lSQLQuery=substr($lSQLQuery, 0, (strlen($lSQLQuery)-2));
			
			
			$lSQLQuery .=" WHERE `id` = '".mysql_real_escape_string($userArray['id'])."'";
			
			
		
			
				$lResult = $this->mysql_query_ex($lSQLQuery);
				if ($lResult) {
			
					return true ;
				}
			
			return false;	
		
		}











	

       function addUserAddress($userAddress) {
		
		
				$lSQLQuery = "INSERT INTO `user_addresses` ( `" . implode('`, `', array_keys($userAddress)) . "`) VALUES ('" . implode("' ,'", $userAddress) . "');";
				$lResult = $this->mysql_query_ex($lSQLQuery);
				if ($lResult) {
					
						
							return true;
							
					
					}
			
			return false;
		}
		
		

	  function getUserAddresses($userid){
	
			
			$lSQLQuery = "SELECT * FROM `user_addresses` WHERE `user_id` =  '".mysql_real_escape_string($userid)."'";
	
	
	
				$list= array();
						$j=0;
						$lResult = $this->mysql_query_ex($lSQLQuery);
						
						if ($lResult) {
							while($lRow = mysql_fetch_assoc($lResult)){
							$list[$j]=$lRow;
							
							$j++;
							}
						}
				
				return $list;
				
				
	
	}
 function getInvoiceAddressByUserId($user_id){

				$lSQLQuery = "SELECT * FROM  `user_addresses` WHERE  `user_id` =".$user_id." AND  `type`='invoice';";
				

					$lResult = $this->mysql_query_ex($lSQLQuery);
					if ($lResult) {
					
							$lArray = mysql_fetch_assoc($lResult);
							return $lArray;
							
							
					}
			
					return false;	
			

 }



function getUserWithAddressByID($user_id){

				$lSQLQuery = "SELECT * FROM  users INNER JOIN user_addresses ON users.id = user_addresses.user_id WHERE  users.id ='".$user_id."' AND  user_addresses.type='invoice';";
				

					$lResult = $this->mysql_query_ex($lSQLQuery);
					if ($lResult) {
					
							$lArray = mysql_fetch_assoc($lResult);
							return $lArray;
							
							
					}
			
					return false;	
			

 }

  function getUserAddressesById($addressid){
	
			
			$lSQLQuery = "SELECT * FROM `user_addresses` WHERE `id` =  '".mysql_real_escape_string ( $addressid)."';";
	
	
	
				$lResult = $this->mysql_query_ex($lSQLQuery);
					if ($lResult) {
					
							$lArray = mysql_fetch_assoc($lResult);
							return $lArray;
							
							
					}
			
					return false;	
			
				
	
	}


	function updateAddress($userAddress) {
		
			$lSQLQuery = "UPDATE `user_addresses` SET ";
			
			
			for($i=0; $i<count($userAddress); $i++){
				
									if($value = current($userAddress)){
					
									if(key($userAddress)!='id'){
									$lSQLQuery .="`".key($userAddress)."`='".mysql_real_escape_string($value)."', ";
									}
									
					} 
					next($userAddress);
			}
					
					
			$lSQLQuery=substr($lSQLQuery, 0, (strlen($lSQLQuery)-2));
			
			
			$lSQLQuery .=" WHERE `id` = '".mysql_real_escape_string($userAddress['id'])."'";
			
		
		
			
				$lResult = $this->mysql_query_ex($lSQLQuery);
				if ($lResult) {
			
					return true ;
				}
			
			return false;	
		
		}



  		function getUserAuctions($userid, $asWinner=false){
			$lSQLQuery ="";
			
		if($asWinner){
			
			$lSQLQuery = "SELECT * FROM auctions INNER JOIN auction_metadata ON auctions.id = auction_metadata.auction_id WHERE auctions.buyer_id =  '".mysql_real_escape_string($userid)."' AND auctions.status!='deleted' ;";
			}else{
		
		$lSQLQuery = "SELECT * FROM auctions INNER JOIN auction_metadata ON auctions.id = auction_metadata.auction_id WHERE auctions.user_id =  '".mysql_real_escape_string($userid)."' AND auctions.status!='deleted';";
		}


		
				$list= array();
						$j=0;
						$lResult = $this->mysql_query_ex($lSQLQuery);
						
						if ($lResult) {
							while($lRow = mysql_fetch_assoc($lResult)){
							$list[$j]=$lRow;
							
							$j++;
							}
						}
				
				return $list;
				
				
	
		}






		function getAuctionById($auction_id){
	
			
				$lSQLQuery = "SELECT * FROM auctions WHERE id =  '".mysql_real_escape_string($auction_id)."'";
				

					$lResult = $this->mysql_query_ex($lSQLQuery);
					if ($lResult) {
					
							$lArray = mysql_fetch_assoc($lResult);
							return $lArray;
							
							
					}
			
					return false;	
			
		
		}




		function updateAuction($auctionArray) {
		
			$lSQLQuery = "UPDATE `auctions` SET ";
			
			
			for($i=0; $i<count($auctionArray); $i++){
				
									if($value = current($auctionArray)){
					
									if(key($auctionArray)!='id'){
									$lSQLQuery .="`".key($auctionArray)."`='".mysql_real_escape_string($value)."', ";
									}
									
					} 
					next($auctionArray);
			}
					
					
			$lSQLQuery=substr($lSQLQuery, 0, (strlen($lSQLQuery)-2));
			
			
			$lSQLQuery .=" WHERE `id` = '".mysql_real_escape_string($auctionArray['id'])."'";
			
				
		
			
				$lResult = $this->mysql_query_ex($lSQLQuery);
				if ($lResult) {
			
					return true ;
				}
			
			return false;	
		
		}


		function getLatestAuctionByUserId($user_id){
	
			
				$lSQLQuery = "SELECT * FROM auctions WHERE `user_id` =  '".mysql_real_escape_string($user_id)."' ORDER BY `created` DESC LIMIT 1;";
					$lResult = $this->mysql_query_ex($lSQLQuery);
					if ($lResult) {
					
							$lArray = mysql_fetch_assoc($lResult);
							return $lArray;
							
							
					}
			
					return false;	
			
		
		}


		function getAuctionCategoryById($category_id){
	
			
				$lSQLQuery = "SELECT * FROM auction_categories WHERE `id` =  '".mysql_real_escape_string($category_id)."';";
					$lResult = $this->mysql_query_ex($lSQLQuery);
					if ($lResult) {
					
							$lArray = mysql_fetch_assoc($lResult);
							return $lArray;
							
							
					}
			
					return false;	
			
		
		}

     	 function addAuction($auctionArray) {
		
		
				$lSQLQuery = "INSERT INTO `auctions` ( `" . implode('`, `', array_keys($auctionArray)) . "`, `created`) VALUES ('" . implode("' ,'", $auctionArray) . "', NOW());";
				$lResult = $this->mysql_query_ex($lSQLQuery);
				if ($lResult) {
					
						
							return true;
							
					
					}
			
			return false;
		}
		

		function getAuctionMetadataByAuctionId($auction_id){
	
			
				$lSQLQuery = "SELECT * FROM `auction_metadata` WHERE `auction_id` =  '".mysql_real_escape_string($auction_id)."' LIMIT 1;";
					$lResult = $this->mysql_query_ex($lSQLQuery);
					if ($lResult) {
					
							$lArray = mysql_fetch_assoc($lResult);
							return $lArray;
							
							
					}
			
					return false;	
			
		
		}


		
		 function addAuctionMetadata($metaArray) {
		
		
				$lSQLQuery = "INSERT INTO `auction_metadata` ( `" . implode('`, `', array_keys($metaArray)) . "`) VALUES ('" . implode("' ,'", $metaArray) . "');";
				$lResult = $this->mysql_query_ex($lSQLQuery);
				if ($lResult) {
					
						
							return true;
							
					
					}
			
			return false;
		}
		

function getEndedAuction(){



			$lSQLQuery = "SELECT * FROM `auctions` WHERE `status`=  'ended' AND `mail_status`='';";
	

				
				$list= array();
						$j=0;
						$lResult = $this->mysql_query_ex($lSQLQuery);
						
						if ($lResult) {
							while($lRow = mysql_fetch_assoc($lResult)){
							$list[$j]=$lRow;
							
							$j++;
							}
						}
				if(count($list)){
				return $list;
			}else{

				return false;
			}



}

	function updateAuctionMetadata($auctionArray) {
		
			$lSQLQuery = "UPDATE `auction_metadata` SET ";
			
			
			for($i=0; $i<count($auctionArray); $i++){
				
									if($value = current($auctionArray)){
					
									if(key($auctionArray)!='auction_id'){
									$lSQLQuery .="`".key($auctionArray)."`='".$value."', ";
									}
									
					} 
					next($auctionArray);
			}
					
					
			$lSQLQuery=substr($lSQLQuery, 0, (strlen($lSQLQuery)-2));
			
			
			$lSQLQuery .=" WHERE `auction_id` = '".$auctionArray['auction_id']."'";
			
		
		
			
				$lResult = $this->mysql_query_ex($lSQLQuery);
				if ($lResult) {
			
					return true ;
				}
			
			return false;	
		
		}


  		function getCountiesByStateId($state_id){
	
			
	
			
			$lSQLQuery = "SELECT * FROM `county` WHERE `state_id` =  '".mysql_real_escape_string($state_id)."'";

	
	
				$list= array();
						$j=0;
						$lResult = $this->mysql_query_ex($lSQLQuery);
						
						if ($lResult) {
							while($lRow = mysql_fetch_assoc($lResult)){
							$list[$j]=$lRow;
							
							$j++;
							}
						}
				
				return $list;
				
				
	
		}


		function getStateById($state_id){
	
			
				$lSQLQuery = "SELECT * FROM `state` WHERE `id` =  '".mysql_real_escape_string($state_id)."';";

					$lResult = $this->mysql_query_ex($lSQLQuery);
					if ($lResult) {
					
							$lArray = mysql_fetch_assoc($lResult);
							return $lArray;
							
							
							
					}
			
					return false;	
		}
   

		function getCountyById($county_id){
	
			
				$lSQLQuery = "SELECT * FROM `county` WHERE `id` =  '".mysql_real_escape_string($county_id)."';";

					$lResult = $this->mysql_query_ex($lSQLQuery);
					if ($lResult) {
					
							$lArray = mysql_fetch_assoc($lResult);
							return $lArray;
							
							
							
					}
			
					return false;	
		}
   


		function getCountiesOfPendingAuctions($state_id, $is_auction){


			$lSQLQuery = "";
			if($is_auction=="no"){

				$lSQLQuery ="SELECT DISTINCT  county_id, state_id, name FROM auctions INNER JOIN county ON auctions.county_id=county.id WHERE auctions.status =  'offering' AND county.state_id='".$state_id."'";

			}else{
				$lSQLQuery ="SELECT DISTINCT  county_id, state_id, name FROM auctions INNER JOIN county ON auctions.county_id=county.id WHERE auctions.status =  'pending' AND county.state_id='".$state_id."'";
			}
	
	
				$list= array();
						$j=0;
						$lResult = $this->mysql_query_ex($lSQLQuery);
						
						if ($lResult) {
							while($lRow = mysql_fetch_assoc($lResult)){
							$list[$j]=$lRow;
							
							$j++;
							}
						}
				
				return $list;


		}


		function getPendingAuctions(){


			$lSQLQuery = "SELECT DISTINCT start_time, state_id FROM auctions INNER JOIN county ON auctions.county_id=county.id WHERE auctions.status =  'pending';";

	
	
				$list= array();
						$j=0;
						$lResult = $this->mysql_query_ex($lSQLQuery);
						
						if ($lResult) {
							while($lRow = mysql_fetch_assoc($lResult)){
							$list[$j]=$lRow;
							
							$j++;
							}
						}
				
				return $list;


		}



		function getPendingOffers(){


			$lSQLQuery = "SELECT DISTINCT state_id FROM auctions INNER JOIN county ON auctions.county_id=county.id WHERE auctions.status =  'offering';";

	
	
				$list= array();
						$j=0;
						$lResult = $this->mysql_query_ex($lSQLQuery);
						
						if ($lResult) {
							while($lRow = mysql_fetch_assoc($lResult)){
							$list[$j]=$lRow;
							
							$j++;
							}
						}
				
				return $list;


		}





 		function getNextAuctions($county_id, $is_auction){

				$lSQLQuery = "";

			 if($is_auction=="yes"){
					$lSQLQuery = "SELECT * FROM auctions INNER JOIN auction_metadata ON auctions.id = auction_metadata.auction_id WHERE auctions.county_id =  '".mysql_real_escape_string($county_id)."' AND auctions.status='pending' ORDER BY auctions.id ASC LIMIT 1;";
	

			 }else{

					 $lSQLQuery = "SELECT * FROM auctions INNER JOIN auction_metadata ON auctions.id = auction_metadata.auction_id WHERE auctions.county_id =  '".mysql_real_escape_string($county_id)."' AND auctions.status='offering' ORDER BY auctions.id ASC LIMIT 1;";
	
			 }
				
				$list= array();
						$j=0;
						$lResult = $this->mysql_query_ex($lSQLQuery);
						
						if ($lResult) {
							while($lRow = mysql_fetch_assoc($lResult)){
							$list[$j]=$lRow;
							
							$j++;
							}
						}
				
				return $list;


 		}



		function getCurrentAuction($auction_id){
	
			
				$lSQLQuery = "SELECT * FROM auctions INNER JOIN auction_metadata ON auctions.id = auction_metadata.auction_id WHERE auctions.id =  '".mysql_real_escape_string($auction_id)."'LIMIT 1;";
	
					$lResult = $this->mysql_query_ex($lSQLQuery);
					if ($lResult) {
					
							$lArray = mysql_fetch_assoc($lResult);
						}
		}
   
   
		function getRunningAuction($county_id){
	
			
				$lSQLQuery = "SELECT * FROM auctions INNER JOIN auction_metadata ON auctions.id = auction_metadata.auction_id WHERE auctions.county_id =  '".mysql_real_escape_string($county_id)."' AND auctions.status='running' AND auctions.end_time>NOW() ORDER BY auctions.id ASC LIMIT 1;";
	
					$lResult = $this->mysql_query_ex($lSQLQuery);
					if ($lResult) {
					
							$lArray = mysql_fetch_assoc($lResult);
							
							
							
				if($lArray==false){

					//THERE IS NO
					$nextStartTime=date("Y-m-d H:i:s", strtotime("+30 seconds"));
					$nextEndTime=date("Y-m-d H:i:s", strtotime("+2 minutes 30 seconds"));


					$lSQLQuery2 = "UPDATE  `auctions` SET  `status` =  'running',`end_time` = '".$nextEndTime."',`start_time` =  '".$nextStartTime."' WHERE  `start_time` < NOW() AND `county_id`='".$county_id."' AND `status`='pending' LIMIT 1;";

			

					$lResult2 = $this->mysql_query_ex($lSQLQuery2);
					if ($lResult2) {
			
					


												$lSQLQuery3 = "SELECT * FROM auctions INNER JOIN auction_metadata ON auctions.id = auction_metadata.auction_id WHERE auctions.county_id =  '".mysql_real_escape_string($county_id)."' AND auctions.status='running' AND auctions.end_time>NOW() ORDER BY auctions.id ASC LIMIT 1;";
								
												$lResult3 = $this->mysql_query_ex($lSQLQuery3);
												if ($lResult3) {
												
														$lArray3 = mysql_fetch_assoc($lResult3);
														return $lArray3;
														
														
												}



					}
				}else{


					return $lArray;
				}
				
			}
		
		}


function getAuctionLikeRunningAction($auction_id){

			$lSQLQuery = "SELECT * FROM auctions INNER JOIN auction_metadata ON auctions.id = auction_metadata.auction_id WHERE auctions.id =  '".mysql_real_escape_string($auction_id)."' LIMIT 1;";
	
					$lResult = $this->mysql_query_ex($lSQLQuery);
					if ($lResult) {
					
							$lArray = mysql_fetch_assoc($lResult);
							return $lArray;

							}
							return false;

}




	function getAddressById($address_id){

				$lSQLQuery = "SELECT * FROM `user_addresses` WHERE `id` = '".mysql_real_escape_string($address_id)."'";
				
				
					
					$lResult = $this->mysql_query_ex($lSQLQuery);
					if ($lResult) {
					
							$lArray = mysql_fetch_assoc($lResult);
							return $lArray;
							
							
							
					}
			
					return false;	

	}


function updateBid($auction_id, $bid, $number_of_bids, $buyer_id, $end_time){

		$lSQLQuery = "UPDATE  `auctions` SET  `current_entity_price` =  '".$bid."', `buyer_id` =  '".$buyer_id."', `bids` =  '".$number_of_bids."', `end_time` =  '".$end_time."' WHERE  `auctions`.`id` =".$auction_id.";";



				$lResult = $this->mysql_query_ex($lSQLQuery);
				if ($lResult) {
					
						
							return true;
							
					
					}
			
			return false;


}



function closeAuction($auction_id){

		$lSQLQuery = "UPDATE  `auctions` SET  `status` =  'ended' WHERE  `auctions`.`id` =".$auction_id.";";



				$lResult = $this->mysql_query_ex($lSQLQuery);
				if ($lResult) {
					
						
							return true;
							
					
					}
			
			return false;


}



	



  		function getInviteCode($code){
	
			
	
			
			$lSQLQuery = "SELECT * FROM `invite_codes` WHERE `code` =  '".mysql_real_escape_string($code)."'";

	
					$lResult = $this->mysql_query_ex($lSQLQuery);
					if ($lResult) {
					
							$lArray = mysql_fetch_assoc($lResult);
							return $lArray;
							
							
							
					}
				
				return false;
	
		}




function updateInviteCode($codeArray) {
		
			$lSQLQuery = "UPDATE `invite_codes` SET ";
			
			
			for($i=0; $i<count($codeArray); $i++){
				
									if($value = current($codeArray)){
					
									if(key($codeArray)!='id'){
									$lSQLQuery .="`".key($codeArray)."`='".$value."', ";
									}
									
					} 
					next($codeArray);
			}
					
					
			$lSQLQuery=substr($lSQLQuery, 0, (strlen($lSQLQuery)-2));
			
			
			$lSQLQuery .=" WHERE `id` = '".$codeArray['id']."'";
			
		
		
			
				$lResult = $this->mysql_query_ex($lSQLQuery);
				if ($lResult) {
			
					return true ;
				}
			
			return false;	
		
		}





       function addInvoice($invoiceArray) {
		
		
				$lSQLQuery = "INSERT INTO `invoices` ( `" . implode('`, `', array_keys($invoiceArray)) . "`, `date`) VALUES ('" . implode("' ,'", $invoiceArray) . "', NOW());";
				$lResult = $this->mysql_query_ex($lSQLQuery);
				if ($lResult) {
					
						
							return true;
							
					
					}
			
			return false;
		}




		 function getInvoiceByAuctionId($auction_id){
	
			
			$lSQLQuery = "SELECT * FROM `invoices` WHERE `auction_id` =  '".mysql_real_escape_string($auction_id)."';";
	
	
	
				$lResult = $this->mysql_query_ex($lSQLQuery);
					if ($lResult) {
					
							$lArray = mysql_fetch_assoc($lResult);
							return $lArray;
							
							
					}
			
					return false;	
			
				
	
	}

		
			
}


?>