<?


?>


<div id="running_auction">
<p>
	<table>
		<tr><td><strong><? echo($texts["auction_id"]) ;?>:</strong></td><td id="auction_id"><? echo($gBase->CurrentAuction["auction_id"]);?></td></tr>
		<tr><td><strong><? echo($texts['auction_amount']); ?>:</strong></td><td id="amount_of_animals"><? echo($gBase->CurrentAuction["amount_of_annimals"]);?></td></tr>
		<tr><td><strong><? echo($texts['auction_city']); ?>:</strong></td><td  id="city"><? echo($gBase->CurrentAuction["city"]);?></td></tr>
	
	</table>
</p>

<p id="is_buyer"></p>
<p id="is_seller"></p>

<p>
	<table>
		<tr><td ><strong><? echo($texts['auction_current_price']) ;?>:</strong></td><td  id="curent_price"><? echo($gBase->CurrentAuction["current_entity_price"]);?></td></tr>

	</table>
</p>


<div id="bid_box"> 

      <!--<div class="control-group">
        <label class="control-label" for="your_bid"><? echo($texts['auction_your_bid']); ?></label>
        <div class="controls">
          <input type="text" id="your_bid" name="your_bid" placeholder="<? echo($texts['auction_your_bid_placeholder_1']." ".($gBase->CurrentAuction["current_entity_price"]+0.005)." ".$texts['auction_your_bid_placeholder_2']);  ?>"  >
        </div>
      </div>-->


	  <div class="control-group">
          <label class="control-label" for="your_bid"><? echo($texts['auction_your_bid']); ?></label>
          <div class="controls">
            <select name="your_bid"  id="your_bid" >
              
            </select>
          </div>
        </div>

        <button onclick="submitBid()" class="btn btn-primary" id="auction_bid_submit"><? echo($texts['auction_bid_submit']); ?></button>

</div>



<div id="waiting_box"> 
	<p> <? echo($texts['auction_is_waiting']) ;?></p>
	<table>
		<tr><td><strong><? echo($texts['auction_start_time']) ;?>:</strong></td><td id="start_time" ><? echo($gBase->CurrentAuction["start_time"]);?></td></tr>
	</table>	
     

</div>





<?
		if($gBase->CurrentAuction["is_buyer"]=="yes"){		
echo("<p>".$texts['auction_is_buyer']."</p>");
		}

		?>

<p>
	<table>
		<tr><td><strong><? echo($texts['auction_end_time']) ;?>:</strong></td><td id="end_time" ><? echo(substr($gBase->CurrentAuction["end_time"], 10));?></td></tr>
		<tr><td><strong><? echo($texts['auction_bids']); ?>:</strong></td><td id="bids" ><? echo($gBase->CurrentAuction["bids"]);?></td></tr>

		<tr><td><strong><? echo($texts['auction_current_time']) ;?>:</strong></td><td id="current_time"><? echo($gBase->CurrentAuction["current_time"]);?></td></tr>
	</table>
</p>


<!--
METADATA
-->


<p>
	<table>
		<tr><td><strong><? echo($texts['auction_origin']) ;?>:</strong></td><td id="origin"><? echo($gBase->CurrentAuction["metadata"]["auction_origin"]);?></td></tr>
		<?
		if($gBase->CurrentAuction["metadata"]["form"]=="on"){
			?>
		<tr><td><strong><? echo($texts['auction_pigs_form']); ?>:</strong></td><td id="form"><? echo($texts["yes"]);?></td></tr>
		<tr><td><strong><? echo($texts['auction_pigs_form_entity']); ?>:</strong></td><td id="form_value" ><? echo($gBase->CurrentAuction["metadata"]["auction_pigs_form_value"]);?></td></tr>
<?}else{
	?>

	<tr><td><strong><? echo($texts['auction_pigs_form']); ?>:</strong></td><td id="form"><? echo($texts["no"]);?></td></tr>
	<tr><td><strong><? echo($texts['auction_pigs_form_entity']); ?>:</strong></td><td id="form_value" >-</td></tr>

	
	<?
}
?>

<?
		if($gBase->CurrentAuction["metadata"]["autoform"]=="on"){
			?>
		<tr><td><strong><? echo($texts['auction_pigs_autoform']); ?>:</strong></td><td id="autoform"><? echo($texts["yes"]);?></td></tr>
		<tr><td><strong><? echo($texts['auction_pigs_autoform_entity']); ?>:</strong></td><td id="autoform_value"><? echo($gBase->CurrentAuction["metadata"]["auction_pigs_autoform_value"]);?></td></tr>
<?}else{
	?>

	<tr><td><strong><? echo($texts['auction_pigs_autoform']); ?>:</strong></td><td id="autoform"><? echo($texts["no"]);?></td></tr>
		<tr><td><strong><? echo($texts['auction_pigs_autoform_entity']); ?>:</strong></td><td id="autoform_value">-</td></tr>

	
	<?
}
?>

<tr><td><strong><? echo($texts['auction_pigs_qs']); ?>:</strong></td><td id="qs"><? echo($texts[$gBase->CurrentAuction["metadata"]["auction_pigs_qs"]]);?></td></tr>

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
<tr><td><strong><? echo($texts['auction_pigs_samonelle_state']); ?>:</strong></td><td id="samonelle_state"><? echo($samonelle_status);?></td></tr>


	</table>
</p>


<p>
	<table>
		<tr><td><strong><? echo($texts['auction_loading_stations_amount']) ;?>:</strong></td><td id="stations_amount"><? echo($gBase->CurrentAuction["metadata"]["auction_loading_stations_amount"]);?></td></tr>
		<tr><td><strong><? echo($texts['auction_loading_stations_distance']); ?>:</strong></td><td id="stations_distance" ><? echo($gBase->CurrentAuction["metadata"]["auction_loading_stations_distance"]);?></td></tr>
	
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
	<tr><td><strong><? echo($texts['auction_loading_stations_vehicle']); ?>:</strong></td><td id="stations_vehicle"><? echo($vehicle);?></td></tr>

<tr><td><strong><? echo($texts['auction_loading_stations_availability']); ?>:</strong></td><td id="stations_availability"><? echo($gBase->CurrentAuction["metadata"]["auction_loading_stations_availability"]." ".$texts['auction_loading_stations_availability_til']." ".$gBase->CurrentAuction["metadata"]["auction_loading_stations_availability_til"]);?></td></tr>
<tr><td><strong><? echo($texts['auction_additional_informations']); ?>:</strong></td><td id="additional_informations"><? echo($gBase->CurrentAuction["metadata"]["auction_additional_informations"]);?></td></tr>
	</table>
</p>





</div>



<? 
if($_REQUEST["is_preview"]!="yes"){

?>
<div id="schedule">


<div id="comming_up"> 
<h3><? echo($texts['running_auctions_comming_up']); ?></h3>
     <table id="coming_up_table" class="table table-striped">


	</table>
</div>

<div id="finished" > 
<h3><? echo($texts['running_auctions_finished']); ?></h3>
     <table id="finished_table" class="table table-striped">
			

	 </table>
</div>

</div>

<?	
}
?>

<script type="text/javascript">


var scheduleNeedsUpdate=true;

<? 

if($_REQUEST['is_preview']!="yes"){

?>
window.setInterval("getRunningAuction()", 2000);

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

function displayResponse(data){

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

								

								

								$("#auction_id").html(data.current_auction.auction_id);
								$("#amount_of_animals").html(data.current_auction.amount_of_animals);
								$("#city").html(data.current_auction.city);
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

									$("#curent_price").html(currentbidstring);


									$("#your_bid").empty();
										for(i=1;i<11;i++){
											nextBid=Runden2Dezimal(currentbid+0.01*i);
											splitted=nextBid.toString().split(".");
											
											nextbidstring=""+nextBid;

										if(splitted.length>1){
											if(splitted[1].length<2){

												nextbidstring+="0";
											}
											if(splitted[1].length<1){
												nextbidstring+="0";
											}
										}else{

											nextbidstring+=".00";
										}
											html+='<option value="'+nextbidstring+'" >'+nextbidstring+' €/kg</option>';
										}	
						
			 						$("#your_bid").append(html);
			 					}

								//}


								$("#end_time").html(data.current_auction.end_time);
								$("#bids").html(data.current_auction.bids);
								$("#start_time").html(data.current_auction.start_time);
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


										if(data.raw_data[i].status=="pending"){

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
										pendingHTML+='<tr><td><strong><? echo($texts['auction_min_entitity_price']) ;?>:</strong></td><td >'+data.raw_data[i].min_entity_price+'</td></tr>';
										pendingHTML+='<tr><td><strong><? echo($texts['auction_highest_price']); ?>:</strong></td><td >'+data.raw_data[i].current_entity_price+'</td></tr>';
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
										finishedHTML+='<tr><td><strong><? echo($texts['auction_min_entitity_price']) ;?>:</strong></td><td >'+data.raw_data[i].min_entity_price+'</td></tr>';
										finishedHTML+='<tr><td><strong><? echo($texts['auction_highest_price']); ?>:</strong></td><td >'+data.raw_data[i].current_entity_price+'</td></tr>';
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