<?

$nextDates=getNextAuctions(1);

?>

<div id="aktive_auction">
<div  class="span12">
<h2><? echo($texts['show_auction_headline']); ?></h2>
</div>	
<div id="running_auction" class="span6">
	<div id="googlemap">
<img  id="map" src="http://maps.googleapis.com/maps/api/staticmap?center=<? echo($gBase->CurrentAuction["postcode"]."+".$gBase->CurrentAuction["city"]); ?>&zoom=10&size=500x300&maptype=roadmap&sensor=false" />
</div>


<div id="auction_over" class="hide well"> 
<h3><? echo($texts['show_auction_over_headline']); ?></h3>
<p><? echo($texts['show_auction_over_description_1'].' <strong>'.$nextDates[0]['readable_date'].'</strong> '.$texts['show_auction_over_description_2']); ?></p>
</div>	


<div id="main_data" class="well"> 	
<p >
	<table class="table">
		<tr><td  class="leftSide"><strong><? echo($texts["auction_id"]) ;?>:</strong></td><td id="auction_id" class="rightSide"><? echo($gBase->CurrentAuction["auction_id"]);?></td></tr>
		<tr><td  class="leftSide"><strong><? echo($texts['auction_amount']); ?>:</strong></td><td id="amount_of_animals" class="rightSide"><? echo($gBase->CurrentAuction["amount_of_annimals"]);?></td></tr>
		<tr><td class="leftSide"><strong><? echo($texts['auction_city']); ?>:</strong></td><td  id="city" class="rightSide"><? echo($gBase->CurrentAuction["city"]);?></td></tr>
		<tr><td class="leftSide"><strong><? echo($texts['auction_user_rating']); ?>:</strong></td><td  id="user_rating" class="rightSide">

		<div class="emptyPigsRating"  ></div>
	<div class="fullPigsRating" style="width:<? echo(($gBase->CurrentAuction["user_rating"]["rating"]*33.33)); ?>px" ></div>


	<div class="amountOfRatings"><? echo("(".$gBase->CurrentAuction["user_rating"]["amount"].")");?></div>
</td></tr>
	
	

		<tr><td class="leftSide"><strong><? echo($texts['auction_origin']) ;?>:</strong></td><td id="origin" class="rightSide"><? echo($gBase->CurrentAuction["metadata"]["auction_origin"]);?></td></tr>
		<?
		if($gBase->CurrentAuction["metadata"]["form"]=="on"){
			?>
		<tr><td class="leftSide"><strong><? echo($texts['auction_pigs_form']); ?>:</strong></td><td id="form" class="rightSide"><? echo($texts["yes"]);?></td></tr>
		<tr><td class="leftSide"><strong><? echo($texts['auction_pigs_form_entity']); ?>:</strong></td><td id="form_value" class="rightSide" ><? echo($gBase->CurrentAuction["metadata"]["auction_pigs_form_value"]);?></td></tr>
<?}else{
	?>

	<tr><td class="leftSide"><strong><? echo($texts['auction_pigs_form']); ?>:</strong></td><td id="form" class="rightSide"><? echo($texts["no"]);?></td></tr>
	<tr><td class="leftSide"><strong><? echo($texts['auction_pigs_form_entity']); ?>:</strong></td><td id="form_value" class="rightSide" >-</td></tr>

	
	<?
}
?>

<?
		if($gBase->CurrentAuction["metadata"]["autoform"]=="on"){
			?>
		<tr><td class="leftSide"><strong><? echo($texts['auction_pigs_autoform']); ?>:</strong></td><td id="autoform" class="rightSide"><? echo($texts["yes"]);?></td></tr>
		<tr><td class="leftSide"><strong><? echo($texts['auction_pigs_autoform_entity']); ?>:</strong></td><td id="autoform_value" class="rightSide"><? echo($gBase->CurrentAuction["metadata"]["auction_pigs_autoform_value"]);?></td></tr>
<?}else{
	?>

	<tr><td class="leftSide"><strong><? echo($texts['auction_pigs_autoform']); ?>:</strong></td><td id="autoform" class="rightSide"><? echo($texts["no"]);?></td></tr>
		<tr><td class="leftSide"><strong><? echo($texts['auction_pigs_autoform_entity']); ?>:</strong></td><td id="autoform_value" class="rightSide">-</td></tr>

	
	<?
}
?>

<tr><td><strong><? echo($texts['auction_pigs_qs']); ?>:</strong></td><td id="qs" class="rightSide"><? echo($texts[$gBase->CurrentAuction["metadata"]["auction_pigs_qs"]]);?></td></tr>

<?
$samonelle_status="";
switch ($gBase->CurrentAuction["metadata"]["auction_pigs_samonelle_state"]) {
	case '0':
		$samonelle_status=$texts['auction_pigs_samonelle_state_unkown'];
		break;
	case '1':
		$samonelle_status=$texts['auction_pigs_samonelle_state_1'];
		break;
	case '2':
		$samonelle_status=$texts['auction_pigs_samonelle_state_2'];
		break;
	case '3':
		$samonelle_status=$texts['auction_pigs_samonelle_state_3'];
		break;			
	
	
}

?>
<tr><td class="leftSide"><strong><? echo($texts['auction_pigs_samonelle_state']); ?>:</strong></td><td id="samonelle_state" class="rightSide"><? echo($samonelle_status);?></td></tr>



		<tr><td class="leftSide"><strong><? echo($texts['auction_loading_stations_amount']) ;?>:</strong></td><td id="stations_amount" class="rightSide"><? echo($gBase->CurrentAuction["metadata"]["auction_loading_stations_amount"]);?></td></tr>
		<tr><td class="leftSide"><strong><? echo($texts['auction_loading_stations_distance']); ?>:</strong></td><td id="stations_distance" class="rightSide" ><? echo($gBase->CurrentAuction["metadata"]["auction_loading_stations_distance"]);?></td></tr>
	
<?
$vehicle="";
switch ($gBase->CurrentAuction["metadata"]["auction_loading_stations_vehicle"]) {
	case '1':
		$vehicle=$texts['vehicle_1'];
		break;
	case '2':
		$vehicle=$texts['vehicle_2'];
		break;
	case '3':
		$vehicle=$texts['vehicle_3'];
		break;		
	case '4':
		$vehicle=$texts['vehicle_4'];
		break;	

	
}

?>
	<tr><td class="leftSide"><strong><? echo($texts['auction_loading_stations_vehicle']); ?>:</strong></td><td id="stations_vehicle" class="rightSide"><? echo($vehicle);?></td></tr>

<tr><td class="leftSide"><strong><? echo($texts['auction_loading_stations_availability']); ?>:</strong></td><td id="stations_availability" class="rightSide"><? echo($gBase->CurrentAuction["metadata"]["auction_loading_stations_availability"]." ".$texts['auction_loading_stations_availability_til']." ".$gBase->CurrentAuction["metadata"]["auction_loading_stations_availability_til"]);?></td></tr>
<tr><td class="leftSide"><strong><? echo($texts['auction_additional_informations']); ?>:</strong></td><td id="additional_informations" class="rightSide"><? echo($gBase->CurrentAuction["metadata"]["auction_additional_informations"]);?></td></tr>
	</table>
</p>


</div>


</div>




<div class="rightView span5 pull-right">



<div id="time_box" > 
	<div id="highestBid" class="well">
<table >
		<tr ><td ><strong><? echo($texts['auction_current_price']) ;?>:</strong></td><td  id="curent_price"  class="rightSide"><strong><? echo($gBase->CurrentAuction["current_entity_price"]);?></strong></td></tr>
</table>
</div>

<p id="is_buyer">
<?
		if($gBase->CurrentAuction["is_buyer"]=="yes"){		
echo("<p>".$texts['auction_is_buyer']."</p>");
		}

		?>
</p>
<p id="is_seller"></p>
<p>
	<table>
		<tr><td><strong><? echo($texts['auction_end_time']) ;?>:</strong></td><td id="end_time" class="rightSide" ><? echo(substr($gBase->CurrentAuction["end_time"], 10));?></td></tr>
		<tr><td><strong><? echo($texts['auction_current_time']) ;?>:</strong></td><td id="current_time"  class="rightSide"><? echo($gBase->CurrentAuction["current_time"]);?></td></tr>
	
		<tr><td><strong><? echo($texts['auction_bids']); ?>:</strong></td><td id="bids" class="rightSide" ><? echo($gBase->CurrentAuction["bids"]);?></td></tr>

		
		
	</table>
</p>
</div>

<div id="bid_box" class="well hide"> 

      <!--<div class="control-group">
        <label class="control-label" for="your_bid"><? echo($texts['auction_your_bid']); ?></label>
        <div class="controls">
          <input type="text" id="your_bid" name="your_bid" placeholder="<? echo($texts['auction_your_bid_placeholder_1']." ".($gBase->CurrentAuction["current_entity_price"]+0.005)." ".$texts['auction_your_bid_placeholder_2']);  ?>"  >
        </div>
      </div>-->


	  <div class="control-group">
          <label class="control-label" for="your_bid"><strong><? echo($texts['auction_your_bid']); ?>:</strong></label>
          <div class="controls">
            <select name="your_bid"  id="your_bid" >
              
            </select>
          </div>
        </div>

        <button onclick="submitBid()" class="btn btn-primary" id="auction_bid_submit"><? echo($texts['auction_bid_submit']); ?></button>

</div>



<div id="waiting_box" class="well"> 
	<p> <? echo($texts['auction_is_waiting']) ;?></p>
	<table>
		<tr><td><strong><? echo($texts['auction_start_time']) ;?>:</strong></td><td id="start_time" ><? echo(substr($gBase->CurrentAuction["start_time"],10));?></td></tr>
	</table>	
     

</div>











<? 
if($_REQUEST["is_preview"]!="yes"){

?>
<div id="schedule">


<div id="comming_up"> 
<h3><? echo($texts['running_auctions_comming_up']); ?></h3>
     <table id="coming_up_table" class="table table-hover">


	</table>
</div>

<div id="finished" > 
<h3><? echo($texts['running_auctions_finished']); ?></h3>
     <table id="finished_table" class="table table-hover">
			

	 </table>
</div>

</div>
</div>



<?	
}
?>

</div>




<script type="text/javascript">


var scheduleNeedsUpdate=true;
var aktivInterval;


<? 

if($_REQUEST['is_preview']!="yes"){

?>
aktivInterval=window.setInterval("getRunningAuction()", 2000);

currentAuctionID='<? echo($gBase->CurrentAuction["id"]);?>';
<?
}
?>
function getRunningAuction(){



  $.getJSON("index.php", { "action": "get_running_auction", "view": "show_running_auction", "mode":"ajax", "county_id":"<? echo($_REQUEST["county_id"]); ?>","auction_id":currentAuctionID, "sid":"<? echo($_COOKIE["PHPSESSID"]); ?>"},
			
			  				 function(data){
			 				 session_id=data.conf.session_id;
							
							displayResponse(data)


						 });
	
	}



function submitBid(){


	<?
	if($gBase->User!=null){

		if($gBase->User["is_buyer"]=="no"){

				echo("alert('".$texts['auction_not_buyer_error']."')");

		}else if($gBase->User['active']!='2'){

				echo("alert('".$texts['auction_not_activated_buyer_error']."')");

		}else{ 
			?>

		

  		$.getJSON("index.php", { "action": "bid_on_running_auction", "view": "show_running_auction", "mode":"ajax","county_id":"<? echo($_REQUEST["county_id"]); ?>","auction_id":currentAuctionID,"bid":$("#your_bid").val(), "sid":"<? echo($_COOKIE["PHPSESSID"]); ?>"},
			
			  				 function(data){
			 				 session_id=data.conf.session_id;
							 	displayResponse(data);
						 });

<?  		
		}

  	}else{

		echo("alert('".$texts['auction_not_loggedin_error']."')");

  	} 


  	?>
	
}


var currentbid=0;
function Runden2Dezimal(x) { Ergebnis = Math.round(x * 100) / 100 ; return Ergebnis; }
function Runden3Dezimal(x) { Ergebnis = Math.round(x * 1000) / 1000 ; return Ergebnis; }

function displayResponse(data){



								if(data.current_auction==null){

 									 window.clearInterval(aktivInterval);

 									$("#auction_over").show();
									$("#main_data").hide();
									$("#bid_box").hide();
									$("#time_box").hide();
									$("#googlemap").hide();
									$("#waiting_box").hide();

									return;
								}

								if(data.current_auction.auction_id==null){

										return;
								}

								currentAuctionID=data.current_auction.auction_id;

								if(data.current_auction.running=="no"){
									$("#waiting_box").show();
									$("#bid_box").hide();
									scheduleNeedsUpdate=true;


}else{
									$("#waiting_box").hide();
									$("#bid_box").show();
								}
								


								if(data.current_auction.is_buyer=="yes"){
									$("#is_buyer").html("<? echo($texts["auction_is_buyer"]); ?>");
								}else{
									$("#is_buyer").html("");
								}

								if(data.current_auction.is_seller=="yes"){
									$("#is_seller").html("<? echo($texts["auction_is_seller"]); ?>");
								}else{
									$("#is_seller").html("");
								}

								if(data.current_auction.user_rating.amount==0){
									$("#user_rating").html('<? echo($texts['show_auction_empty_rating']) ?>');
								}else{

									width=(data.current_auction.user_rating.rating*33.3);
								$("#user_rating").html('<div class="emptyPigsRating"  ></div><div class="fullPigsRating" style="width:'+width+'px" ></div><div class="amountOfRatings">('+data.current_auction.user_rating.amount+')</div>');


								}

								$("#auction_id").html(data.current_auction.auction_id);
								$("#amount_of_animals").html(data.current_auction.amount_of_animals);
								$("#city").html(data.current_auction.city);

								$("#map").attr('src', 'http://maps.googleapis.com/maps/api/staticmap?center='+data.current_auction.postcode+"+"+data.current_auction.city+'&zoom=10&size=500x370&maptype=roadmap&sensor=false');




								//if($("#curent_price").html()!=data.current_auction.current_entity_price){

									

									html="";
									if(currentbid!=parseFloat(data.current_auction.current_entity_price)){

									
									

									currentbid=parseFloat(data.current_auction.current_entity_price);
									splitted=currentbid.toString().split(".");
											
											currentbidstring=""+currentbid;

											if(splitted.length>1){
											if(splitted[1].length<2){

												currentbidstring+="0";
											}
											if(splitted[1].length<1){
												currentbidstring+="0";
											}
										}else{

											currentbidstring+=".00"
										}

									$("#curent_price").html(currentbidstring+ " €");


									$("#your_bid").empty();
										for(i=1;i<11;i++){
											nextBid=Runden3Dezimal(currentbid+0.005*i);
											splitted=nextBid.toString().split(".");
											
											nextbidstring=""+nextBid;

										if(splitted.length>1){
											if(splitted[1].length<3){

												nextbidstring+="0";
											}
											if(splitted[1].length<2){

												nextbidstring+="0";
											}
											if(splitted[1].length<1){
												nextbidstring+="0";
											}
										}else{

											nextbidstring+=".000";
										}
											html+='<option value="'+nextbidstring+'" >'+nextbidstring+' €/kg</option>';
										}	
						
			 						$("#your_bid").append(html);
			 					}

								//}


								$("#end_time").html(data.current_auction.end_time.substr(10,10));
								$("#bids").html(data.current_auction.bids);
								$("#start_time").html(data.current_auction.start_time.substr(10,10));
								$("#current_time").html(data.current_auction.current_time);
								$("#origin").html(data.current_auction.auction_origin);
								$("#form").html(data.current_auction.metadata.form);
								$("#form_value").html(data.current_auction.metadata.auction_pigs_form_value);
								$("#autoform").html(data.current_auction.metadata.autoform);
								$("#autoform_value").html(data.current_auction.metadata.auction_pigs_autoform_value);
								$("#qs").html(data.current_auction.metadata.auction_pigs_qs);
								$("#samonelle_state").html(data.current_auction.metadata.auction_pigs_samonelle_state);
								$("#stations_amount").html(data.current_auction.metadata.auction_loading_stations_amount);
								$("#stations_distance").html(data.current_auction.metadata.auction_loading_stations_distance);
								$("#stations_vehicle").html(data.current_auction.metadata.auction_loading_stations_vehicle);
								$("#stations_availability").html(data.current_auction.metadata.auction_loading_stations_availability+' <? echo($texts['auction_loading_stations_availability_til']);?> '+data.current_auction.metadata.auction_loading_stations_availability_til);
								$("#additional_informations").html(data.current_auction.metadata.auction_additional_informations);

						if(scheduleNeedsUpdate){
							scheduleNeedsUpdate=false;
								pendingHTML="";
								finishedHTML="";

								for(i=0; i<data.raw_data.length; i++){


										if(data.raw_data[i].status=="scheduled"){

											pendingHTML+='<tr>';
								     	pendingHTML+='<td>';     	
								     	pendingHTML+='<table class="table">';
										pendingHTML+='<tr><td><strong><? echo($texts["auction_id"]) ;?>:</strong></td><td >'+data.raw_data[i].id+'</td></tr>';
										pendingHTML+='<tr><td><strong><? echo($texts['auction_amount']); ?>:</strong></td><td >'+data.raw_data[i].amount_of_animals+'</td></tr>';
										pendingHTML+='<tr><td><strong><? echo($texts['auction_city']); ?>:</strong></td><td  >'+data.raw_data[i].city+'</td></tr>';
										pendingHTML+='</table>';
										pendingHTML+='</td>';
										pendingHTML+='<td>';     	
								     	pendingHTML+='<table class="table">';
										pendingHTML+='<tr><td><strong><? echo($texts['auction_min_entitity_price']) ;?>:</strong></td><td >'+data.raw_data[i].min_entity_price+' €</td></tr>';
										pendingHTML+='<tr><td><strong><? echo($texts['auction_highest_price']); ?>:</strong></td><td >'+data.raw_data[i].current_entity_price+' €</td></tr>';
										pendingHTML+='<tr><td><strong><? echo($texts['auction_bids_done']); ?>:</strong></td><td >'+data.raw_data[i].bids+'</td></tr>';
										pendingHTML+='</table>';
										pendingHTML+='</td>';
										pendingHTML+='</tr>';


										}

										if(data.raw_data[i].status=="ended"){

										finishedHTML+='<tr>';
								     	finishedHTML+='<td>';     	
								     	finishedHTML+='<table  class="table">';
										finishedHTML+='<tr><td><strong><? echo($texts["auction_id"]) ;?>:</strong></td><td >'+data.raw_data[i].id+'</td></tr>';
										finishedHTML+='<tr><td><strong><? echo($texts['auction_amount']); ?>:</strong></td><td >'+data.raw_data[i].amount_of_animals+'</td></tr>';
										finishedHTML+='<tr><td><strong><? echo($texts['auction_city']); ?>:</strong></td><td  >'+data.raw_data[i].city+'</td></tr>';
										finishedHTML+='</table>';
										finishedHTML+='</td>';
										finishedHTML+='<td>';     	
								     	finishedHTML+='<table class="table">';
										finishedHTML+='<tr><td><strong><? echo($texts['auction_min_entitity_price_without_euro']) ;?>:</strong></td><td >'+data.raw_data[i].min_entity_price+' €</td></tr>';
										finishedHTML+='<tr><td><strong><? echo($texts['auction_highest_price']); ?>:</strong></td><td >'+data.raw_data[i].current_entity_price+' €</td></tr>';
										finishedHTML+='<tr><td><strong><? echo($texts['auction_bids_done']); ?>:</strong></td><td >'+data.raw_data[i].bids+'</td></tr>';
										finishedHTML+='</table>';
										finishedHTML+='</td>';
										finishedHTML+='</tr>';
										}

								}
								$("#coming_up_table").html(pendingHTML);

								$("#finished_table").html(finishedHTML);
							}	    	

}


</script>

<?

?>