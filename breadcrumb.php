<?PHP

	$breadcrumb=array();
	$breadlinks=array();
	array_push($breadcrumb, $texts['navi_news']);  array_push($breadlinks, "home");

	switch ($View) {
		
		
			case 'profile':  array_push($breadcrumb, $texts['signin_profil']);  array_push($breadlinks, "profile"); break;
			case 'edit_profile': array_push($breadcrumb, $texts['signin_profil']); array_push($breadlinks, "profile"); 
								 array_push($breadcrumb, $texts['edit_profile_headline']);  break;

			case 'edit_auction': array_push($breadcrumb, $texts['signin_profil']); array_push($breadlinks, "profile"); 
								 if($_REQUEST['is_auction']=='no'){
								 	if($_REQUEST['auction_id']!=""){
								 		array_push($breadcrumb, $texts['edit_offer_headline']); 
								 	}else{
								 		array_push($breadcrumb, $texts['add_offer_headline']); 
								 	}
								 
								}else{
									if($_REQUEST['auction_id']!=""){
										array_push($breadcrumb, $texts['edit_auction_headline']); 	
									}else{
										array_push($breadcrumb, $texts['add_auction_headline']); 	
									}
								 
								}
								break;

		

			case "show_full_auction": if($gBase->CurrentAuction["status"]=="ended"){
										if($_REQUEST['from']!=''){
											//Coming fro, profile
											array_push($breadcrumb, $texts['signin_profil']);  array_push($breadlinks, "profile"); 

											if($gBase->CurrentAuction["is_auction"]=="yes"){
											array_push($breadcrumb, $texts['show_auction_detail']);  
												}else{
											array_push($breadcrumb, $texts['show_offer_detail']);  
										
											}
										}else{





										}



										}else{


											if($_REQUEST['is_auction']=='no'){
												array_push($breadcrumb, $texts['navi_market']);  array_push($breadlinks, "market");
												array_push($breadcrumb, $gBase->RawData["state_name"]);  array_push($breadlinks, "market");
												array_push($breadcrumb, $gBase->RawData["county_name"]); array_push($breadlinks, "show_next_auction&action=get_next_auction&is_auction=no&county_id=".$_REQUEST['county_id']."&state_id=".$_REQUEST['state_id']);
												array_push($breadcrumb, $texts['show_auction_detail']);  
												
											}else{
												array_push($breadcrumb, $texts['navi_auction']);  array_push($breadlinks, "market");
												array_push($breadcrumb, $gBase->RawData["state_name"]);  array_push($breadlinks, "market");
												array_push($breadcrumb, $gBase->RawData["county_name"]); array_push($breadlinks, "show_next_auction&action=get_next_auction&is_auction=yes&county_id=".$_REQUEST['county_id']."&state_id=".$_REQUEST['state_id']);
												array_push($breadcrumb, $texts['show_auction_detail']);  
											}




									}

									break;


				case "show_running_auction": 
										


												array_push($breadcrumb, $texts['navi_auction']);  array_push($breadlinks, "auction");
												array_push($breadcrumb, $gBase->CurrentAuction["state_name"]);  array_push($breadlinks, "auction");
												array_push($breadcrumb, $gBase->CurrentAuction["county_name"]);
												
											




									

									break;					


				case "show_next_auction": if($_REQUEST['is_auction']=='no'){
												array_push($breadcrumb, $texts['navi_market']);  array_push($breadlinks, "market");
												array_push($breadcrumb, $gBase->RawData["state_name"]);  array_push($breadlinks, "market");
												array_push($breadcrumb, $gBase->RawData["county_name"]); 

												
											}else{
												array_push($breadcrumb, $texts['navi_auction']);  array_push($breadlinks, "market");
												array_push($breadcrumb, $gBase->RawData["state_name"]);  array_push($breadlinks, "market");
												array_push($breadcrumb, $gBase->RawData["county_name"]); 

											}
											break;

				case "add_rating":		array_push($breadcrumb, $texts['add_rating_headline']);  break;					


				case "market": array_push($breadcrumb, $texts['navi_market']);
											break;

				case "registration": array_push($breadcrumb,$texts['registration_headline']);
									break;
				case "auctions": array_push($breadcrumb, $texts['navi_auction']); 
											break;	


				case "faq": 
							array_push($breadcrumb, $texts["faq_headline"]);  break;
				
				case "how_it_works": 
							array_push($breadcrumb, $texts["how_it_works_headline"]);  break;
				case "team": 
							array_push($breadcrumb, $texts["team_headline"]);  break;
				case "agb": 
							array_push($breadcrumb, $texts['modal_agb_headline']);  break;																									
				case "imprint": 
							array_push($breadcrumb, $texts['modal_imprint_headline']);  break;								




			
			
		}
		

?>