<?PHP

	

	
	function getUserAuctions($user_id, $asWinner=false){
	global $gBase;
	
		$lDB=connectDB();
		if (!$lDB->failed){
	
					
									$userAuctions=$lDB->getUserAuctions($user_id, $asWinner);
												if($asWinner){
													$gBase->UserWonAuctions=$userAuctions;
													}else{
													$gBase->UserAuctions=$userAuctions;

													}
											
									
						
						
						
								
								
		}
	
	}
	
	
	
	function  getCurrentAuction($auction_id=""){
		
			global $gBase;
		
		
		if($auction_id==""){
			$gBase->CurrentAuction=NULL;
			
			
		}else{
		$lDB=connectDB();
		if (!$lDB->failed){
	
	
									if($currentAuction=$lDB->getCurrentAuction($auction_id)){
	
										$gBase->CurrentAuction=$currentAuction;
	
									}
									
									
		}
		
		
		}
				
	}
	
	

	
	
	
	function editAuction($category_id, $auction_id, $is_preview, $is_auction, $auction_date, $auction_amount, $auction_min_entitity_price, $auction_origin, $form, $auction_pigs_form_value, $autoform, $auction_pigs_autoform_value, $auction_pigs_qs, $auction_pigs_samonelle_state, $address, $auction_loading_stations_amount, $auction_loading_stations_distance, $auction_loading_stations_vehicle, $auction_loading_stations_availability, $auction_loading_stations_availability_til, $auction_additional_informations){
	
		global $gBase;
		
			$lDB=connectDB();
			if (!$lDB->failed){
			
				if($auction_id!=""){
				//Update Auction	
			
				$auctionArray=array();
				if($auctionArray=$lDB->getAuctionById($auction_id)){
					
					if($auctionArray['user_id']==$gBase->User['id']){
					
					
						$auctionArray['user_id']=$gBase->User['id'];

					if($is_preview!="yes"){


						


						if($is_auction=="yes"){
								$auctionArray['status']="pending"; 
						}else{
								$auctionArray['status']="offering"; 
						}
					}
						

						$auction_min_entitity_price=str_replace ( ',' , ".", $auction_min_entitity_price);

						$auctionArray['min_entity_price']=$auction_min_entitity_price;
						$auctionArray['current_entity_price']=$auction_min_entitity_price;
						$auctionArray['bids']=0;
						$auctionArray['is_auction']=$is_auction;
						$auctionArray['buyer_id']=0;
						$auctionArray['category_id']=$category_id;

						$auctionArray['start_time']=$auction_date;

					
						$auctionAddressArray=array();
						$auctionAddressArray=$lDB->getUserAddressesById($address);
						$auctionArray['county_id']=$auctionAddressArray['county_id'];
						$auctionArray['city']=$auctionAddressArray['city'];
						$lDB->updateAuction($auctionArray);



						$auctionMetadataArray=array();

						$auctionMetadataArray=$lDB->getAuctionMetadataByAuctionId($auction_id);


						
						$auctionMetadataArray['user_address_id']=mysql_real_escape_string($address);
						$auctionMetadataArray['amount_of_animals']=mysql_real_escape_string($auction_amount);
						

						


						$auctionMetadataArray['metadata']=mysql_real_escape_string(json_encode($_REQUEST));
			

						$lDB->updateAuctionMetadata($auctionMetadataArray);


						if($is_preview=="yes"){

							previewAuction($auction_id);
						}

						 	
		 	 	 	 	 	 	
						
					}else{
						
						$gBase->Error="EDITING_NOT_ALLOWED";
								
						return false;	
						
					}
					
			    }else{
					
					
				$gBase->Error="AUCTION_NOT_FOUND";
								
				return false;	
					
				}
				
				
				
					
				}else{
				//Create new Auction	


						$auctionArray=array();
						$auctionArray['user_id']=$gBase->User['id'];

						if($is_preview=="yes"){
							$auctionArray['status']='preview';

						}else{
						if($is_auction=="yes"){
								$auctionArray['status']="pending"; 
						}else{
								$auctionArray['status']="offering"; 
						}
						}

						$auction_min_entitity_price=str_replace ( ',' , ".", $auction_min_entitity_price);

						$auctionArray['min_entity_price']=$auction_min_entitity_price;
						$auctionArray['current_entity_price']=$auction_min_entitity_price;
						$auctionArray['bids']=0;
						$auctionArray['buyer_id']=0;
						$auctionArray['category_id']=$category_id;
						$auctionArray['is_auction']=$is_auction;
						$auctionArray['start_time']=$auction_date;

					
						$auctionAddressArray=array();
						$auctionAddressArray=$lDB->getUserAddressesById($address);
						$auctionArray['county_id']=$auctionAddressArray['county_id'];
						$auctionArray['city']=$auctionAddressArray['city'];



						


						
					

						$lDB->addAuction($auctionArray);

						$auctionArray=$lDB->getLatestAuctionByUserId($gBase->User['id']);

						$auctionMetadataArray=array();
						$auctionMetadataArray['user_address_id']=mysql_real_escape_string($address);
						$auctionMetadataArray['amount_of_animals']=mysql_real_escape_string($auction_amount);
						$auctionMetadataArray['auction_id']=mysql_real_escape_string($auctionArray['id']);

						


						$auctionMetadataArray['metadata']=mysql_real_escape_string(json_encode($_REQUEST));
			

						$lDB->addAuctionMetadata($auctionMetadataArray);


						if($is_preview=="yes"){

							previewAuction($auctionArray['id']);
						}



					
				}
		}
			
		
	}
			
			


	function removeAuction($auction_id){
		global $gBase;
		
			$lDB=connectDB();
			if (!$lDB->failed){
			
				if($auction_id!=""){
				//Update Auction	
			
				$auctionArray=array();
				if($auctionArray=$lDB->getAuctionById($auction_id)){
								$auctionArray['status']="deleted";
								$lDB->updateAuction($auctionArray);
							}
						}
					}
				}
			





function getInvoice($auction_id){




		global $gBase;
		
			$lDB=connectDB();
			if (!$lDB->failed){
			
				if($auction_id!=""){
				//Update Auction	
			
				$auctionArray=array();
				if($auctionArray=$lDB->getAuctionById($auction_id)){
					
					if($auctionArray['user_id']==$gBase->User['id']){
					
								$invoideAddress=array();
								 for($i=0; $i<count($gBase->UserAddresses); $i++){
								 		if($gBase->UserAddresses[$i]['type']=='invoice'){
												$invoideAddress=$gBase->UserAddresses[$i];

								 		}

								 }

								 $metadata=$lDB->getAuctionMetadataByAuctionId($auction_id);
					

						 		$pdf = new SRBill('P', 'mm', 'A4');
								$pdf->AliasNbPages();
								$pdf->AddPage();

								$pdf->printRecipient("", $gBase->User["firstname"]." ".$gBase->User["lastname"], $invoideAddress["street"].' '.$invoideAddress["number"], $invoideAddress["postcode"].' '.$invoideAddress["city"],  $invoideAddress["country"]);
								

								$pdf->SetLeftMargin(20);
								$pdf->SetRightMargin(20);
										$date=date("d.m.Y",strtotime($auctionArray["end_time"]));

								$pdf->printBillData($auctionArray["id"], $auctionArray["id"], $gBase->User['id'], $date, $metadata["amount_of_animals"], 0.40, 19, 10); 

								$buyerAddress=$lDB->getInvoiceAddressByUserId($auctionArray["buyer_id"]);
		
								$buyer=$lDB->getUserByID($auctionArray["buyer_id"]);

								$pdf->printBuyer("", $buyer["firstname"]." ".$buyer["lastname"], $buyerAddress["street"].' '.$buyerAddress["number"], $buyerAddress["postcode"].' '.$buyerAddress["city"],  $buyerAddress["country"]);
								
								$pdfStream=$pdf->Output("","S");




								header("Pragma: public");
								header("Expires: 0");
								header("Cache-Control: must-revalidate, post-check=0, pre-check=0");
								header("Cache-Control: public");
								header("Content-Description: File Transfer");
								header("Content-Type: application/pdf");

								$header="Content-Disposition: attachment; filename=Rechnung_Viehauktion_".$auctionArray["id"].".pdf\n";
								header($header );
								header("Content-Transfer-Encoding: binary \n");
								header("Content-Length: ".strlen($pdfStream)."\n\n");

								echo($pdfStream);








		 	 	 	 	 	 	
						
					}else{
						
						$gBase->Error="EDITING_NOT_ALLOWED";
								
						return false;	
						
					}
					
			    }else{
					
					
				$gBase->Error="AUCTION_NOT_FOUND";
								
				return false;	
					
				}
			}
		}

}






/*---------------------
//
//	Running/Pending Auctions
//
____________________________*/




function getPendingCounties($state_id, $is_auction){

	global $gBase;
		
			$lDB=connectDB();
			if (!$lDB->failed){

				$countyArray=array();
				if($countyArray=$lDB->getCountiesOfPendingAuctions($state_id, $is_auction)){

					

					$gBase->RawData=$countyArray;




				}


			}

}

function getNextAuction($county_id, $state_id, $is_auction){

	global $gBase;
		
			$lDB=connectDB();
			$auctionArray=array();
			if (!$lDB->failed){

					$gBase->RawData=$lDB->getNextAuctions($county_id, $is_auction);
					$county=$lDB->getCountyById($county_id);
					$state=$lDB->getStateById($state_id);
					$gBase->RawData["county_name"]=$county["name"];
					$gBase->RawData["state_name"]=$state["name"];
					

			}

}
		
function getRunningAuctionOld($county_id){

	global $gBase;
		
			$lDB=connectDB();
			if (!$lDB->failed){

					$gBase->CurrentAuction=$lDB->getRunningAuction($county_id);
					$gBase->CurrentAuction['current_time']=date("H:i:s");
									

			}

}
			
function bidOnRunningAution($county_id, $auction_id, $bid){

global $gBase;
		
		
	$bid=str_replace ( ',' , ".", $bid);
if($gBase->CurrentAuction["current_entity_price"]<$bid){

	$lDB=connectDB();
			if (!$lDB->failed){

				if($currentAuction=$lDB->getRunningAuction($county_id)){
					if($currentAuction["current_entity_price"]<$bid){

						
						$endTime="";
							if(strtotime($currentAuction["end_time"])<strtotime("+30 Seconds")){

								$endTime=date("Y-m-d H:i:s",strtotime("+30 Seconds"));
							}else{

								$endTime=$currentAuction["end_time"];
							}

							$lDB->updateBid($auction_id, $bid, $currentAuction["bids"]+1, $gBase->User['id'], $endTime);

							getCurrentAuctionFromDB($county_id);

					}

				}
			}

}

}

function getRunningAuction($county_id, $auction_id){

	global $gBase;
		


			if($auction_id!=""){

				
										$memcache = new Memcache;

									
										$memcache->connect('127.0.0.1', 11211);
										if(!$gBase->CurrentAuction=$memcache->get($auction_id)){
													getCurrentAuctionFromDB($county_id);
													return;

										}

										$gBase->CurrentAuction['current_time']=date("H:i:s");
										$gBase->CurrentAuction['running']="yes";


										if(strtotime($gBase->CurrentAuction["start_time"])>time()){
											$gBase->CurrentAuction['running']="no";
										}

										if (strtotime($gBase->CurrentAuction["end_time"])>time()) {
											return;
										}else{

											$lDB=connectDB();
													if (!$lDB->failed){

															$lDB->closeAuction($auction_id);
															$memcache->delete($auction_id);



															


														


													}
										}
										

			}

		getCurrentAuctionFromDB($county_id);
		
}
	

function getCurrentAuctionFromDB($county_id){
global $gBase;

	$lDB=connectDB();
			if (!$lDB->failed){

			

									if($currentAuction=$lDB->getRunningAuction($county_id)){
	
										$gBase->CurrentAuction["auction_id"] =$currentAuction["id"];
										$gBase->CurrentAuction["amount_of_annimals"] =$currentAuction["amount_of_animals"];
										$gBase->CurrentAuction["min_entity_price"] =$currentAuction["min_entity_price"];
										$gBase->CurrentAuction["current_entity_price"] =$currentAuction["current_entity_price"];
										$gBase->CurrentAuction["start_time"] =$currentAuction["start_time"];
										$gBase->CurrentAuction["end_time"] =$currentAuction["end_time"];
										$gBase->CurrentAuction["bids"] =$currentAuction["bids"];
										if($currentAuction["buyer_id"]==$gBase->User['id']){
											$gBase->CurrentAuction["is_buyer"] ="yes";
										}else{
											$gBase->CurrentAuction["is_buyer"] ="no";


										}
											if($currentAuction["user_id"]==$gBase->User['id']){
											$gBase->CurrentAuction["is_seller"] ="yes";
										}else{
											$gBase->CurrentAuction["is_seller"] ="no";


										}

										$gBase->CurrentAuction["is_auction"] ="yes";
										
										$gBase->CurrentAuction['current_time']=date("H:i:s");

										$metadata=json_decode($currentAuction["metadata"], true);
									
										$address=array();
										$address=$lDB->getAddressById($metadata['address']);
										$gBase->CurrentAuction['city']=$address['city'];
										$gBase->CurrentAuction['metadata']=$metadata;

										$memcache = new Memcache;

										$key = $gBase->CurrentAuction["auction_id"]; 
										$row = $gBase->CurrentAuction; 
										$result=$memcache->connect('127.0.0.1', 11211);

										
										$memcache->set($key, $row, MEMCACHE_COMPRESSED, 400);

								
	
									}else{
										$gBase->CurrentAuction=null;

									}
									

			}


}





function previewAuction($auction_id){

global $gBase;

	$lDB=connectDB();
			if (!$lDB->failed){

	
if($currentAuction=$lDB->getAuctionLikeRunningAction($auction_id)){

										$gBase->CurrentAuction["auction_id"] =$currentAuction["id"];
										$gBase->CurrentAuction["amount_of_annimals"] =$currentAuction["amount_of_animals"];
										$gBase->CurrentAuction["min_entity_price"] =$currentAuction["min_entity_price"];
										$gBase->CurrentAuction["current_entity_price"] =$currentAuction["current_entity_price"];
										$gBase->CurrentAuction["start_time"] =$currentAuction["start_time"];
										$gBase->CurrentAuction["end_time"] =$currentAuction["end_time"];
										$gBase->CurrentAuction["bids"] =$currentAuction["bids"];
										if($currentAuction["buyer_id"]==$gBase->User['id']){
											$gBase->CurrentAuction["is_buyer"] ="yes";
										}else{
											$gBase->CurrentAuction["is_buyer"] ="no";


										}
											if($currentAuction["user_id"]==$gBase->User['id']){
											$gBase->CurrentAuction["is_seller"] ="yes";
										}else{
											$gBase->CurrentAuction["is_seller"] ="no";


										}

										$gBase->CurrentAuction["is_auction"] ="yes";
										
										$gBase->CurrentAuction['current_time']=date("H:i:s");

										$metadata=json_decode($currentAuction["metadata"], true);
									
										$address=array();
										$address=$lDB->getAddressById($metadata['address']);
										$gBase->CurrentAuction['city']=$address['city'];
										$gBase->CurrentAuction['metadata']=$metadata;

										

								
	
									}else{
										$gBase->CurrentAuction=null;

									}

}
}

function checkTodaysAuctions(){

	global $gBase;
		
			$lDB=connectDB();
			if (!$lDB->failed){
				$gBase->RawData=$lDB->getPendingAuctions();
			}

}



function checkTodaysOffers(){

	global $gBase;
		
			$lDB=connectDB();
			if (!$lDB->failed){
				$gBase->RawData=$lDB->getPendingOffers();
			}

}




function getAuctionDetails($auction_id, $county_id, $state_id){


global $gBase;
		
			$lDB=connectDB();
			if (!$lDB->failed){

					$fullAuction=array();

					$auctionArray=array();
					$auctionArray=$lDB->getAuctionById($auction_id);
				

					$fullAuction["auction"]=$auctionArray;

					$metadataArray=array();
					$metadataArray=$lDB->getAuctionMetadataByAuctionId($auction_id);
					$fullAuction["metadata"]=$metadataArray;
					$fullAuction["metadata"]["metadata"]=json_decode($metadataArray["metadata"], true);
					$address=$lDB->getUserAddressesById($metadataArray["user_address_id"]);
					if((($auctionArray["buyer_id"]==$gBase->User['id'])||($auctionArray["user_id"]==$gBase->User['id'])) && ($auctionArray["status"]=="ended" || $auctionArray["status"]=="sold")){
						$sellerArray=array();
						$sellerArray=$lDB->getUserByID($auctionArray["user_id"]);
						$fullAuction["seller"]=$sellerArray;
				
						$fullAuction["address"]=$address;
					}

					$fullAuction["address"]["postcode"]=$address['postcode'];

					if($auctionArray["buyer_id"]!="" && ($auctionArray["status"]=="ended" || $auctionArray["status"]=="sold")){
							$buyerArray=array();
							$buyerArray=$lDB->getUserByID($auctionArray["buyer_id"]);
							$fullAuction["buyer"]=$buyerArray;
					}


						$gBase->CurrentAuction=$fullAuction;


					$county=$lDB->getCountyById($county_id);
					$state=$lDB->getStateById($state_id);
					$gBase->RawData["county_name"]=$county["name"];
					$gBase->RawData["state_name"]=$state["name"];
					
					

			}


}



function buyOffer($auction_id){


global $gBase;
		
			$lDB=connectDB();
			if (!$lDB->failed){

					$auctionArray=array();
					$auctionArray=$lDB->getAuctionById($auction_id);
					if($auctionArray["is_auction"]=="no" && $auctionArray["status"]=="offering"){
					$auctionArray["status"]="ended";
					$auctionArray["buyer_id"]=$gBase->User['id'];
					if($lDB->updateAuction($auctionArray)){

						$gBase->RawData="true";

					}else{

						$gBase->RawData="false";
					}
					}

				}


			}


		
	?>