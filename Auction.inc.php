<?PHP

	

	
	function getUserAuctions($user_id, $asWinner=false, $page=1){
	global $gBase;

		
			$start=$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"]*$page-$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"];
		
	
		$lDB=connectDB();
		if (!$lDB->failed){
	
					
									$userAuctions=$lDB->getUserAuctions($user_id, $asWinner,$start,$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"],"yes");
									

												if($asWinner){
													
					
													$gBase->UserWonAuctions=$userAuctions;

													}else{
													$gBase->UserAuctions=$userAuctions;

													}
											
									
						
						
						
								
								
		}
	
	}
	

	function getUserOffers($user_id, $asWinner=false, $page=1){
	global $gBase;
	
		$start=$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"]*$page-$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"];

		$lDB=connectDB();
		if (!$lDB->failed){
	
					
									$userOffers=$lDB->getUserAuctions($user_id, $asWinner,$start,$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"],"no");
									

												if($asWinner){
													$gBase->UserWonOffers=$userOffers;
													}else{
													$gBase->UserOffers=$userOffers;

													}
											
									
						
						
						
								
								
		}
	
	}
	
	function getLatestAuctions($category_id, $is_auction, $page=1){
		global $gBase;
	
		$start=$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"]*$page-$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"];

		$lDB=connectDB();
		if (!$lDB->failed){
					$latestAuctions=array();

					if($is_auction){
								if($latestAuctions=$lDB->getLatestAuctions($category_id,$start,$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"],"pending", "yes")){

											$gBase->RawData['latest_auctions']=$latestAuctions;
									}
					}else{

								if($latestAuctions=$lDB->getLatestAuctions($category_id,$start,$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"],"offering", "no")){

											$gBase->RawData['latest_offers']=$latestAuctions;
									}


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
	
	

	function saveAuction($auction_id, $is_auction, $is_main_auction){

	global $gBase;
		
			$lDB=connectDB();
			if (!$lDB->failed){
			
				if($auction_id!=""){
				//Update Auction	
			
				$auctionArray=array();
				if($auctionArray=$lDB->getAuctionById($auction_id)){
				

					if($is_auction=="yes"){
								if($is_main_auction=="yes"){
								$auctionArray['status']="pending"; 
							}else{
								$auctionArray['status']="going"; 
							}
						}else{
								$auctionArray['status']="offering"; 
						}

						$lDB->updateAuction($auctionArray);

						$log=array();
						$log['auction_id']=$auction_id;
						$log['event']='Saving auction';
						$log['actor']=$gBase->User['id'];
						$log['ip']=getRealIpAddr();

						$lDB->addLog($log);

				}
			}
		}


	}
	
	
	function editAuction($category_id, $auction_id, $is_preview, $is_auction, $is_main_auction,$is_vezg, $auction_date, $auction_endtime, $auction_amount, $auction_min_entitity_price, $auction_origin, $auction_classification_mask, $auction_pigs_classification_mask_value, $auction_pigs_qs, $auction_pigs_samonelle_state, $address, $auction_loading_stations_amount, $auction_loading_stations_distance, $auction_loading_stations_vehicle, $auction_loading_stations_availability, $auction_loading_stations_availability_til, $is_public,  $auction_additional_informations){
	
		global $gBase;
		
			$lDB=connectDB();
			if (!$lDB->failed){
			
				if($auction_id!=""){
				//Update Auction	
			
				$auctionArray=array();
				if($auctionArray=$lDB->getAuctionById($auction_id)){
					
					if(($auctionArray['status']=='preview')||($auctionArray['status']=='pending')||($auctionArray['status']=='offering')){

					if($auctionArray['user_id']==$gBase->User['id']){
					
					
						$auctionArray['user_id']=$gBase->User['id'];

					if($is_preview!="yes"){


						


						if($is_auction=="yes"){
								if($is_main_auction=="yes"){
								$auctionArray['status']="pending"; 
							}else{
								$auctionArray['status']="going"; 
							}
						}else{
								$auctionArray['status']="offering"; 
								$auctionArray['is_vezg']=$is_vezg;
								$auctionArray['start_time']=$auction_date;
						}
					}
						

						$auction_min_entitity_price=str_replace ( ',' , ".", $auction_min_entitity_price);

						$auctionArray['min_entity_price']=$auction_min_entitity_price;
						$auctionArray['current_entity_price']=$auction_min_entitity_price;
						$auctionArray['bids']=0;
						$auctionArray['is_auction']=$is_auction;
						$auctionArray['buyer_id']=0;
						$auctionArray['category_id']=$category_id;
						$auctionArray['is_main']=$is_main_auction;
					
							$auctionArray['is_public']=$is_public;
					
						
						if($is_main_auction=="yes"){
							$auctionArray['start_time']=$auction_date;
						}else{
							$auctionArray['start_time']=date("Y-m-d H:i:s");
							$auctionArray['end_time']=date("Y-m-d H:i:s", strtotime($auction_endtime));
						}
					
						$auctionAddressArray=array();
						$auctionAddressArray=$lDB->getUserAddressesById($address);
						$auctionArray['county_id']=$auctionAddressArray['county_id'];
						$auctionArray['state_id']=$auctionAddressArray['state_id'];
						$auctionArray['city']=$auctionAddressArray['city'];
						$lDB->updateAuction($auctionArray);



						$auctionMetadataArray=array();

						$auctionMetadataArray=$lDB->getAuctionMetadataByAuctionId($auction_id);


						
						$auctionMetadataArray['user_address_id']=mysql_real_escape_string($address);
						$auctionMetadataArray['amount_of_animals']=mysql_real_escape_string($auction_amount);
						

						


						$auctionMetadataArray['metadata']=mysql_real_escape_string(json_encode($_REQUEST));
			

						$lDB->updateAuctionMetadata($auctionMetadataArray);


						

						$log=array();
						$log['auction_id']=$auction_id;
						$log['event']='Editing auction';
						$log['actor']=$gBase->User['id'];
						$log['ip']=getRealIpAddr();

						$lDB->addLog($log);	
		 	 	 	 	 	 	

		 	 	 	 	 	 	if($is_preview=="yes"){

							previewAuction($auction_id);
						}
						
					}else{
						
						$gBase->Error="EDITING_NOT_ALLOWED";
								
						return false;	
						
					}
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
							if($is_main_auction=="yes"){
								$auctionArray['status']="pending"; 
							}else{
								$auctionArray['status']="going"; 
							}
						
								
						}else{
								$auctionArray['status']="offering"; 
								$auctionArray['is_vezg']=$is_vezg;
								$auctionArray['start_time']=$auction_date;
						}
						}

						$auction_min_entitity_price=str_replace ( ',' , ".", $auction_min_entitity_price);

						$auctionArray['min_entity_price']=$auction_min_entitity_price;
						$auctionArray['current_entity_price']=$auction_min_entitity_price;
						$auctionArray['bids']=0;
						$auctionArray['buyer_id']=0;
						$auctionArray['category_id']=$category_id;
						$auctionArray['is_auction']=$is_auction;

						$auctionArray['is_public']=$is_public;

						if($is_main_auction=="yes"){
							$auctionArray['start_time']=$auction_date;
						}else{
							$auctionArray['start_time']=date("Y-m-d H:i:s");
							$auctionArray['end_time']=date("Y-m-d H:i:s", strtotime($auction_endtime));
						}

					
						$auctionAddressArray=array();
						$auctionAddressArray=$lDB->getUserAddressesById($address);
						$auctionArray['county_id']=$auctionAddressArray['county_id'];
						$auctionArray['city']=$auctionAddressArray['city'];
						$auctionArray['state_id']=$auctionAddressArray['state_id'];

						$auctionArray['is_main']=$is_main_auction;

						


						
					

						$lDB->addAuction($auctionArray);

						$auctionArray=$lDB->getLatestAuctionByUserId($gBase->User['id']);

						$auctionMetadataArray=array();
						$auctionMetadataArray['user_address_id']=mysql_real_escape_string($address);
						$auctionMetadataArray['amount_of_animals']=mysql_real_escape_string($auction_amount);
						$auctionMetadataArray['auction_id']=mysql_real_escape_string($auctionArray['id']);

						


						$auctionMetadataArray['metadata']=mysql_real_escape_string(json_encode($_REQUEST));
			

						$lDB->addAuctionMetadata($auctionMetadataArray);


					


						$log=array();
						$log['auction_id']=$auction_id;
						$log['event']='Creating auction';
						$log['actor']=$gBase->User['id'];
						$log['ip']=getRealIpAddr();

						$lDB->addLog($log);	
								
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

								if($gBase->User['id']==$auctionArray['user_id']||$gBase->User['role']=='admin'){
									if(($auctionArray['status']=='pending')||($auctionArray['status']=='preview')||($auctionArray['status']=='offering')){
								$auctionArray['status']="deleted";
								$lDB->updateAuction($auctionArray);

								$log=array();
						$log['auction_id']=$auction_id;
						$log['event']='Removing auction';
						$log['actor']=$gBase->User['id'];
						$log['ip']=getRealIpAddr();

						$lDB->addLog($log);	



						if($auctionArray['is_auction']=="yes"){
						
							getUserAuctions($gBase->User['id'], false); 
							
							
						}else{

							getUserOffers($gBase->User['id'], false);
						}
					}

								}


							}
						}
					}
				}
			

function cancelAuction($auction_id){

global $gBase;
		
			$lDB=connectDB();
			if (!$lDB->failed){
			
				if($auction_id!=""){
				//Update Auction	
			
				$auctionArray=array();
				if($auctionArray=$lDB->getAuctionById($auction_id)){

						$type="";
						if($gBase->User['id']==$auctionArray['user_id']){
							$auctionArray['status']="seller_canceled";
							$participiant=$lDB->getUserWithAddressByID($auctionArray['buyer_id']);
							$type="Verkauf";

						}else{
							$auctionArray['status']="buyer_canceled";
							$participiant=$lDB->getUserWithAddressByID($auctionArray['user_id']);
								$type="Kauf";
						}
								
								$invoice=array();
								$invoice["auction_id"]=$auctionArray["id"];
								$invoice["recipient_id"]=$gBase->User['id'];
								$invoice["type"]="storno";
								$invoice["total"]=$GLOBALS["VIEHAUKTION"]["STORNO"]["MONEY"];
								$invoice["user_id"]=$auctionArray["user_id"];
								$invoice["buyer_id"]=$auctionArray["buyer_id"];
								$invoice["provision"]=0;
								$invoice["vat"]=$GLOBALS["VIEHAUKTION"]["VAT"];
								$invoice["filename"]=time()."_storno_".$auctionArray["id"]."_".$invoice["recipient_id"].".pdf";
								$invoice["downloaded"]=0;

								$lDB->addInvoice($invoice);

								$currentInvoice=$lDB->getInvoiceByAuctionId($auctionArray["id"]);
								$recipient=$lDB->getUserWithAddressByID($gBase->User['id']);
								

									$pdf = new SRBill('P', 'mm', 'A4');
									$pdf->AliasNbPages();
									$pdf->AddPage();
									$pdf->printRecipient($recipient["company"], $recipient["firstname"]." ".$recipient["lastname"], $recipient["street"].' '.$recipient["number"], $recipient["postcode"].' '.$recipient["city"],  $recipient["country"]);
								
									$pdf->SetLeftMargin(20);
									$pdf->SetRightMargin(20);

									$date=date("d.m.Y");
									$is_auction=false;
									if($auctionArray["is_auction"]=="yes"){
										$is_auction=true;
									}
									$pdf->printStornoData($is_auction,$currentInvoice["invoice_number"], $invoice["auction_id"], $invoice["recipient_id"], $date, $GLOBALS["VIEHAUKTION"]["STORNO"]["MONEY"], $currentInvoice["vat"], 10); 

									
									$pdfStream=$pdf->Output("./invoices/".$invoice["filename"],"F");



									$s3 = new S3($GLOBALS["VIEHAUKTION"]["AMAZON"]["ID"], $GLOBALS["VIEHAUKTION"]["AMAZON"]["KEY"]);


									$result=$s3->putObjectFile("./invoices/".$invoice["filename"], $GLOBALS["VIEHAUKTION"]["AMAZON"]["BUCKET"], "invoices/".$invoice["filename"], S3::ACL_PUBLIC_READ);

									$lDB->updateAuction($auctionArray);



									$lSearch = array();
															
									$lSearch[0] = "___TOTAL___";
									$lSearch[1] = "___SITENAME___";

									$lSearch[2] = "___RECIPIENTFIRSTNAME___";
									$lSearch[3] = "___RECIPIENTLASTNAME___";
									$lSearch[4] = "___TYPE___";
									$lSearch[5] = "___NUMBER___";
									$lSearch[6] = "___INVOICE___";
									$lSearch[7] = "___PARTICIPANTFIRSTNAME___";
									$lSearch[8] = "___PARTICIPANTLASTNAME___";
								



									$lReplacement = array();
									$lReplacement[0] =$GLOBALS["VIEHAUKTION"]["STORNO"]["MONEY"];
									$lReplacement[1] =$GLOBALS["VIEHAUKTION"]["BASE"]["APPNAME"];
						
									$lReplacement[2] = $recipient["firstname"];
									$lReplacement[3] = $recipient["lastname"];
									
									$lReplacement[4] = $type;
									
									$lReplacement[5] = $invoice["auction_id"];
									$lReplacement[6] = $GLOBALS["VIEHAUKTION"]["AMAZON"]["BUCKET"]["URL"].$invoice["filename"];
									$lReplacement[7] = $participiant["firstname"];
									$lReplacement[8] = $participiant["lastname"];
									



									$recipientsubject='Sie haben einen '.$type.' abgelehnt.';
									$participiantsubject='Die Gegenseite hat den '.$type.' abgelehnt.';
									
										
									sendEmail('./mails/cancel_to_recipient.de.html', $lSearch, $lReplacement,$recipientsubject, $recipient['email'], "./invoices/".$invoice["filename"]);
									sendEmail('./mails/cancel_to_participiant.de.html', $lSearch, $lReplacement, $participiantsubject, $participiant['email'],'');
										


									$log=array();
						$log['auction_id']=$auction_id;
						$log['event']='Cancel auction';
						$log['actor']=$gBase->User['id'];
						$log['ip']=getRealIpAddr();

						$lDB->addLog($log);	




							}
						}
					}


}




/*---------------------
//
//	Running/Pending Auctions
//
____________________________*/

function getPendingStates($is_auction, $category_id){

	global $gBase;
		
			$lDB=connectDB();
			if (!$lDB->failed){

				$statesArray=array();
				if($statesArray=$lDB->getStatesOfPendingAuctions($is_auction, $category_id)){

					

					$gBase->RawData=$statesArray;




				}else{
				$gBase->RawData=null;
					}
			}

}


function getPendingCounties($state_id, $is_auction, $category_id){

	global $gBase;
		
			$lDB=connectDB();
			if (!$lDB->failed){

				$countyArray=array();
				if($countyArray=$lDB->getCountiesOfPendingAuctions($state_id, $is_auction, $category_id)){

					

					$gBase->RawData=$countyArray;




				}else{
				$gBase->RawData=null;
}
			}

}

function getNextAuction($county_id, $state_id, $is_auction, $category_id){

	global $gBase;
		
			$lDB=connectDB();
			$auctionArray=array();
			if (!$lDB->failed){

					$gBase->RawData=$lDB->getNextAuctions($county_id, $is_auction, $category_id);
					$county=$lDB->getCountyById($county_id);
					$state=$lDB->getStateById($state_id);
					$gBase->RawData["county_name"]=$county["name"];
					$gBase->RawData["state_name"]=$state["name"];
					

			}

}
		

			
function bidOnRunningAution($county_id, $auction_id, $bid, $category_id){

global $gBase;
		
		if($gBase->User['is_buyer']=="yes" && $gBase->User['active']=='2')
	$bid=str_replace ( ',' , ".", $bid);
if($gBase->CurrentAuction["current_entity_price"]<$bid){

	$lDB=connectDB();
			if (!$lDB->failed){

				if($currentAuction=$lDB->getRunningAuction($county_id, $category_id)){
					if($currentAuction["current_entity_price"]<$bid){

						
						$endTime="";
							if(strtotime($currentAuction["end_time"])<strtotime("+30 Seconds")){

								$endTime=date("Y-m-d H:i:s",strtotime("+30 Seconds"));
							}else{

								$endTime=$currentAuction["end_time"];
							}

							$lDB->updateBid($auction_id, $bid, $currentAuction["bids"]+1, $gBase->User['id'], $endTime);
						
							$log=array();
						$log['auction_id']=$auction_id;
						$log['event']='Bids '.$bid;
						$log['actor']=$gBase->User['id'];
						$log['ip']=getRealIpAddr();

						$lDB->addLog($log);	
										

							getCurrentAuctionFromDB($county_id, "", $category_id);

					}

				}
			}

}

}

function getRunningAuction($county_id, $state_id, $auction_id, $category_id){

	global $gBase;
		


			if($auction_id!=""){

				
										$memcache = new Memcache;

									
										$memcache->connect('127.0.0.1', 11211);
										if(!$gBase->CurrentAuction=$memcache->get($auction_id)){
									
													getCurrentAuctionFromDB($county_id, "", $category_id);
													return;

										}
		
										$gBase->RawData=$memcache->get($county_id);
										$gBase->CurrentAuction['current_time']=date("H:i:s");
										$gBase->CurrentAuction['running']="yes";


										if($gBase->CurrentAuction["buyer_id"]==$gBase->User['id']){
											$gBase->CurrentAuction["is_buyer"] ="yes";
										}else{
											$gBase->CurrentAuction["is_buyer"] ="no";


										}
										if($gBase->CurrentAuction["user_id"]==$gBase->User['id']){
											$gBase->CurrentAuction["is_seller"] ="yes";
										}else{
											$gBase->CurrentAuction["is_seller"] ="no";


										}
										$gBase->CurrentAuction["user_id"]=""; 
										$gBase->CurrentAuction["buyer_id"]=""; 

										if(strtotime($gBase->CurrentAuction["start_time"])>time()){
											$gBase->CurrentAuction['running']="no";
										}
	
										if($gBase->CurrentAuction["end_time"]=="0000-00-00 00:00:00"){

									

											if(strtotime($gBase->CurrentAuction["start_time"])<=strtotime("+30 seconds")){
											
												$lDB=connectDB();
													if (!$lDB->failed){
												
															$lDB->setFirstAuctionRunning($gBase->CurrentAuction['auction_id']);
															getCurrentAuctionFromDB($county_id, $state_id, $category_id);

													}
											
											}
											return;

										}else if(strtotime($gBase->CurrentAuction["end_time"])>time()) {
								
											return;
											
									

										}else{

											$lDB=connectDB();
													if (!$lDB->failed){

															$lDB->closeAuction($auction_id);
															$memcache->delete($auction_id);



															


														


													}
										}
										

			}

		getCurrentAuctionFromDB($county_id, $state_id, $category_id);

			
		
}



	
function getFinishedAuctions($page){


global $gBase;
		if($gBase->User['role'] == "admin") {
		$lDB=connectDB();
		$start=$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"]*$page-$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"];
		if (!$lDB->failed){


			$gBase->RawData["auctions"]=$lDB->getAuctionsByNotStatusAndIsAuction("pending", "yes", $start, $GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"]);
		
			

		}
	}

}


function getFinishedOffers($page){


global $gBase;
		if($gBase->User['role'] == "admin") {
		$lDB=connectDB();

		$start=$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"]*$page-$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"];

		if (!$lDB->failed){


			$gBase->RawData["offers"]=$lDB->getAuctionsByNotStatusAndIsAuction("offering", "no", $start, $GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"]);
			
			

		}
	}

}




function getCurrentAuctionFromDB($county_id, $state_id, $category_id){
global $gBase;

	$lDB=connectDB();
			if (!$lDB->failed){

			

									if($currentAuction=$lDB->getRunningAuction($county_id, $category_id)){

										$gBase->CurrentAuction["auction_id"] =$currentAuction["id"];
										$gBase->CurrentAuction["amount_of_annimals"] =$currentAuction["amount_of_animals"];
										$gBase->CurrentAuction["min_entity_price"] =$currentAuction["min_entity_price"];
										$gBase->CurrentAuction["current_entity_price"] =$currentAuction["current_entity_price"];
										$gBase->CurrentAuction["start_time"] =$currentAuction["start_time"];
										
										
										$gBase->CurrentAuction["end_time"] =$currentAuction["end_time"];
										$gBase->CurrentAuction["supposed_end_time"] =$currentAuction["end_time"];
										if($gBase->CurrentAuction["supposed_end_time"]=='0000-00-00 00:00:00'){
											$gBase->CurrentAuction["supposed_end_time"] =date('Y-m-d H:i:s', (strtotime($currentAuction["start_time"])+120));
										}

										$gBase->CurrentAuction["bids"] =$currentAuction["bids"];
										$gBase->CurrentAuction["user_id"] =$currentAuction["user_id"];
										$gBase->CurrentAuction["user_rating"]=$lDB->getUserRating($currentAuction["user_id"]);
										$gBase->CurrentAuction["buyer_id"] =$currentAuction["buyer_id"];
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

										if($currentAuction['is_public']=="yes"){
											$userArray=$lDB->getUserByID($gBase->CurrentAuction["user_id"]);
											$gBase->CurrentAuction["seller_name"]=$userArray['firstname']." ".$userArray["lastname"];
										}else{
											$gBase->CurrentAuction["seller_name"]="";

										}

										$gBase->CurrentAuction["is_auction"] ="yes";
										
										$gBase->CurrentAuction['current_time']=date("H:i:s");

										$metadata=json_decode($currentAuction["metadata"], true);
									
										$address=array();
										$address=$lDB->getAddressById($metadata['address']);
										$gBase->CurrentAuction['city']=$address['city'];
										$gBase->CurrentAuction['postcode']=$address['postcode'];

										$gBase->CurrentAuction['metadata']=$metadata;


										$county=$lDB->getCountyById($county_id);
										$state=$lDB->getStateById($state_id);
										$gBase->CurrentAuction["county_name"]=$county["name"];
										$gBase->CurrentAuction["state_name"]=$state["name"];

										$memcache = new Memcache;

										$key = $gBase->CurrentAuction["auction_id"]; 
										$row = $gBase->CurrentAuction; 
										$result=$memcache->connect('127.0.0.1', 11211);

										
										$memcache->set($key, $row, MEMCACHE_COMPRESSED, 400);


										$gBase->RawData=$lDB->getTodaysRunningAuctions($county_id, date("Y-m-d"));
										$memcache->set($county_id, $gBase->RawData, MEMCACHE_COMPRESSED, 400);
	


										$gBase->CurrentAuction["user_id"]=""; 
										$gBase->CurrentAuction["buyer_id"]=""; 
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

												$gBase->CurrentAuction["supposed_end_time"] =$currentAuction["end_time"];
										if($gBase->CurrentAuction["supposed_end_time"]=='0000-00-00 00:00:00'){
											$gBase->CurrentAuction["supposed_end_time"] =date('Y-m-d H:i:s', (strtotime($currentAuction["start_time"])+120));
										}


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


										if($currentAuction['is_public']=="yes"){
											$userArray=$lDB->getUserByID($gBase->CurrentAuction["user_id"]);
											$gBase->CurrentAuction["seller_name"]=$userArray['firstname']." ".$userArray["lastname"];
										}else{
											$gBase->CurrentAuction["seller_name"]="";

										}

										$gBase->CurrentAuction["user_rating"]=$lDB->getUserRating($currentAuction["user_id"]);
										$gBase->CurrentAuction["county_id"] =$currentAuction["county_id"];
										$gBase->CurrentAuction["state_id"] =$currentAuction["state_id"];
										if($currentAuction["is_auction"]=="yes"){
										$gBase->CurrentAuction["is_auction"] ="yes";
									}else{
										$gBase->CurrentAuction["is_auction"] ="no";

									}
										
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

function checkTodaysAuctions($category_id){

	global $gBase;
		
			$lDB=connectDB();
			if (!$lDB->failed){
				$gBase->RawData["todays_auctions"]=$lDB->getPendingAuctions($category_id);
			}

}



function checkTodaysOffers($category_id){

	global $gBase;
		
			$lDB=connectDB();
			if (!$lDB->failed){
				$gBase->RawData["todays_offers"]=$lDB->getPendingOffers($category_id);
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
					$fullAuction["user_rating"]=$lDB->getUserRating($auctionArray["user_id"]);
					$address=$lDB->getUserAddressesById($metadataArray["user_address_id"]);

					$fullAuction["auction_ratings"]=$lDB->getAuctionRating($auction_id);

					if($auctionArray["user_id"]==$gBase->User['id']){

						$fullAuction["is_seller"]="yes";
					}else{

						$fullAuction["is_seller"]="no";
					}

					if((($auctionArray["buyer_id"]==$gBase->User['id'])||($auctionArray["user_id"]==$gBase->User['id'])) && ($auctionArray["status"]=="ended" || $auctionArray["status"]=="confirmed" )){
						$sellerArray=array();
						$sellerArray=$lDB->getUserByID($auctionArray["user_id"]);
						$fullAuction["seller"]=$sellerArray;
						$fullAuction["seller_rating"]=$lDB->getUserRating($auctionArray["user_id"]);

						$fullAuction["address"]=$address;
					}

					$fullAuction["address"]["postcode"]=$address['postcode'];

					$buyer_address=$lDB->getInvoiceAddressByUserId($auctionArray["buyer_id"]);
				
					if($auctionArray["buyer_id"]!="" && ($auctionArray["status"]=="ended" || $auctionArray["status"]=="confirmed")){
							$buyerArray=array();
							$buyerArray=$lDB->getUserByID($auctionArray["buyer_id"]);
							$fullAuction["buyer"]=$buyerArray;
							$fullAuction["buyer_rating"]=$lDB->getUserRating($auctionArray["buyer_id"]);
							$fullAuction["buyer"]["address"]=$buyer_address;
					}


						if($auctionArray['is_public']=="yes"){
											$userArray=$lDB->getUserByID($auctionArray["user_id"]);
											$fullAuction["seller_name"]=$userArray['firstname']." ".$userArray["lastname"];
										}else{
											$fullAuction["seller_name"]="";

										}


						$gBase->CurrentAuction=$fullAuction;


					if($county_id==''){
						$county_id=$auctionArray['county_id'];
					}
					if($state_id==''){
						$state_id=$address['state_id'];
					}
					$county=$lDB->getCountyById($county_id);
					$state=$lDB->getStateById($state_id);
					$gBase->RawData["county_name"]=$county["name"];
					$gBase->RawData["state_name"]=$state["name"];
					
					

			}


}


function confirmAuction($auction_id){

global $gBase;
		
			$lDB=connectDB();
			if (!$lDB->failed){
					$auctionArray=array();
					$auctionArray=$lDB->getAuctionById($auction_id);

					if($auctionArray["user_id"]==$gBase->User['id']){
					
					$auctionArray["status"]="confirmed";
					$auctionArray["mail_status"]="";
				
						$lDB->updateAuction($auctionArray);
					}

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
					$auctionArray["end_time"]=date("Y-m-d H:i:s");
					$auctionArray["buyer_id"]=$gBase->User['id'];
					if($lDB->updateAuction($auctionArray)){

						$gBase->RawData="true";

							$log=array();
						$log['auction_id']=$auction_id;
						$log['event']='Buys offer';
						$log['actor']=$gBase->User['id'];
						$log['ip']=getRealIpAddr();

						$lDB->addLog($log);	

					}else{

						$gBase->RawData="false";
					}
					}

				}


			}


		
	?>