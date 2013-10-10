<?


?>


<div id="auction_details">

<h2><? if($_REQUEST['is_auction']=='yes'){ echo($texts['auction']);}else{ echo($texts['offer']);} ?></h2>

<div class="clearfix">

<div class="leftView">

<p>
	<table>
		<tr><td><strong><? if($_REQUEST['is_auction']=='yes'){echo($texts["auction_id"]) ;}else{ echo($texts["offer_id"]) ;}?>:</strong></td><td id="auction_id"><? echo($gBase->CurrentAuction["auction"]["id"]);?></td></tr>
		<tr><td><strong><? echo($texts['auction_amount']); ?>:</strong></td><td id="amount_of_animals"><? echo($gBase->CurrentAuction["metadata"]["amount_of_animals"]);?></td></tr>
		<tr><td><strong><? echo($texts['auction_city']); ?>:</strong></td><td  id="city"><? echo($gBase->CurrentAuction["auction"]["city"]);?></td></tr>
	
	</table>
</p>

	<?
		if($gBase->CurrentAuction["is_seller"]=="yes"){		
echo("<p >".$texts['auction_is_seller']."</p>");
		}

		?>
<p>
	<table>
		<tr><td ><strong><? if($_REQUEST['is_auction']=='yes'){echo($texts['auction_your_end_price']) ;}else{ echo($texts['offer_entitity_price']) ;}?>:</strong></td><td  id="curent_price"><? echo($gBase->CurrentAuction["auction"]["current_entity_price"]);?></td></tr>

	</table>
</p>



<? if($_REQUEST['is_auction']=='no' && $gBase->CurrentAuction["auction"]["status"]=="offering"){ ?>

<div id="bid_box"> 

     <p><? echo($texts['buy_offer_description']); ?></p>
     <? if($gBase->User['is_buyer']=="yes"){ ?>
        <button onclick = "if (! confirm('<? echo($texts['buy_offer_question']); ?>')){ return false; }else{ buyOffer(); }" class="btn btn-primary" id="auction_bid_submit"><? echo($texts['offer_buy_submit']); ?></button>
 <? }else if($gBase->User['is_buyer']=="no"){ ?>
 <button onclick = "alert('<? echo($texts['buy_offer_no_buyer_error']); ?>'); return false;" class="btn btn-primary" id="auction_bid_submit"><? echo($texts['offer_buy_submit']); ?></button>

  <? }else{ ?>
 <button onclick = "alert('<? echo($texts['buy_offer_not_logged_in_error']); ?>'); return false;" class="btn btn-primary" id="auction_bid_submit"><? echo($texts['offer_buy_submit']); ?></button>

  <?
}
  ?>
</div>

<? 
}
?>




<? if( ($gBase->CurrentAuction["auction"]["status"]=="ended" || $gBase->CurrentAuction["auction"]["status"]=="confirmed") && $gBase->CurrentAuction["auction"]["buyer_id"]==$gBase->User["id"]){ ?>

<div id="seller_box"> 
  <h2><? echo($texts['seller']); ?></h2>
     <p>
     	<? echo($gBase->CurrentAuction["seller"]["firstname"]." ".$gBase->CurrentAuction["seller"]["lastname"]); ?><br />
		<? echo($gBase->CurrentAuction["address"]["street"]." ".$gBase->CurrentAuction["address"]["number"]); ?><br />
		<? echo($gBase->CurrentAuction["address"]["postcode"]." ".$gBase->CurrentAuction["address"]["city"]); ?><br />
		<? echo($texts['registration_phone'].": ".$gBase->CurrentAuction["seller"]["phone"]."<br />".$texts['registration_email'].": ".$gBase->CurrentAuction["seller"]["email"]); ?><br />
     </p>
       
</div>

<? 
}
?>


<? if(($gBase->CurrentAuction["auction"]["status"]=="ended" || $gBase->CurrentAuction["auction"]["status"]=="confirmed")  && $gBase->CurrentAuction["auction"]["user_id"]==$gBase->User["id"]){ ?>

<div id="buyer_box"> 
  <h2><? echo($texts['buyer']); ?></h2>
     <p>
     	<? echo($gBase->CurrentAuction["buyer"]["firstname"]." ".$gBase->CurrentAuction["buyer"]["lastname"]); ?><br />
		<? echo($gBase->CurrentAuction["buyer"]["address"]["street"]." ".$gBase->CurrentAuction["buyer"]["address"]["number"]); ?><br />
		<? echo($gBase->CurrentAuction["buyer"]["address"]["postcode"]." ".$gBase->CurrentAuction["buyer"]["address"]["city"]); ?><br />
	
		<? echo($texts['registration_phone'].": ".$gBase->CurrentAuction["buyer"]["phone"]."<br />".$texts['registration_email'].": ".$gBase->CurrentAuction["buyer"]["email"]); ?><br />
     </p>
       
</div>

<? 
}
?>



<? if($_REQUEST['is_auction']=='yes'){ ?>
<p>
	<table>
		<tr><td><strong><? echo($texts['auction_end_time']) ;?>:</strong></td><td id="end_time" ><? echo(substr($gBase->CurrentAuction["auction"]["end_time"], 10));?></td></tr>
		<tr><td><strong><? echo($texts['auction_bids']); ?>:</strong></td><td id="bids" ><? echo($gBase->CurrentAuction["auction"]["bids"]);?></td></tr>
	</table>
</p>
<? 
}
?>


<? if($_REQUEST['is_auction']=='no'){ ?>
<p>
	<table>
		<tr><td><strong><? echo($texts['offer_creation_date']) ;?>:</strong></td><td id="end_time" ><? echo(substr($gBase->CurrentAuction["auction"]["created"], 0, 10));?></td></tr>
	
	</table>
</p>
<? 
}
?>

<!--
METADATA
-->


<p>
	<table>
		<tr><td><strong><? echo($texts['auction_origin']) ;?>:</strong></td><td id="origin"><? echo($gBase->CurrentAuction["metadata"]["metadata"]["auction_origin"]);?></td></tr>
		<?
		if($gBase->CurrentAuction["metadata"]["metadata"]["form"]=="on"){
			?>
		<tr><td><strong><? echo($texts['auction_pigs_form']); ?>:</strong></td><td id="form"><? echo($texts["yes"]);?></td></tr>
		<tr><td><strong><? echo($texts['auction_pigs_form_entity']); ?>:</strong></td><td id="form_value" ><? echo($gBase->CurrentAuction["metadata"]["metadata"]["auction_pigs_form_value"]);?></td></tr>
<?}else{
	?>

	<tr><td><strong><? echo($texts['auction_pigs_form']); ?>:</strong></td><td id="form"><? echo($texts["no"]);?></td></tr>
	<tr><td><strong><? echo($texts['auction_pigs_form_entity']); ?>:</strong></td><td id="form_value" >-</td></tr>

	
	<?
}
?>

<?
		if($gBase->CurrentAuction["metadata"]["metadata"]["autoform"]=="on"){
			?>
		<tr><td><strong><? echo($texts['auction_pigs_autoform']); ?>:</strong></td><td id="autoform"><? echo($texts["yes"]);?></td></tr>
		<tr><td><strong><? echo($texts['auction_pigs_autoform_entity']); ?>:</strong></td><td id="autoform_value"><? echo($gBase->CurrentAuction["metadata"]["metadata"]["auction_pigs_autoform_value"]);?></td></tr>
<?}else{
	?>

	<tr><td><strong><? echo($texts['auction_pigs_autoform']); ?>:</strong></td><td id="autoform"><? echo($texts["no"]);?></td></tr>
		<tr><td><strong><? echo($texts['auction_pigs_autoform_entity']); ?>:</strong></td><td id="autoform_value">-</td></tr>

	
	<?
}
?>

<tr><td><strong><? echo($texts['auction_pigs_qs']); ?>:</strong></td><td id="qs"><? echo($texts[$gBase->CurrentAuction["metadata"]["metadata"]["auction_pigs_qs"]]);?></td></tr>

<?
$samonelle_status="";
switch ($gBase->CurrentAuction["metadata"]["metadata"]["auction_pigs_samonelle_state"]) {
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


</div>
<div class="rightView">


<img src="http://maps.googleapis.com/maps/api/staticmap?center=<? echo($gBase->CurrentAuction["address"]["postcode"]."+".$gBase->CurrentAuction["auction"]["city"]); ?>&zoom=10&size=500x300&maptype=roadmap&sensor=false" />


</div>
</div>

<div class="clearfix">
<p>
	<table>
		<tr><td><strong><? echo($texts['auction_loading_stations_amount']) ;?>:</strong></td><td id="stations_amount"><? echo($gBase->CurrentAuction["metadata"]["metadata"]["auction_loading_stations_amount"]);?></td></tr>
		<tr><td><strong><? echo($texts['auction_loading_stations_distance']); ?>:</strong></td><td id="stations_distance" ><? echo($gBase->CurrentAuction["metadata"]["metadata"]["auction_loading_stations_distance"]);?></td></tr>
	
<?
$vehicle="";
switch ($gBase->CurrentAuction["metadata"]["metadata"]["auction_loading_stations_vehicle"]) {
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

<tr><td><strong><? echo($texts['auction_loading_stations_availability']); ?>:</strong></td><td id="stations_availability"><? echo($gBase->CurrentAuction["metadata"]["metadata"]["auction_loading_stations_availability"]." ".$texts['auction_loading_stations_availability_til']." ".$gBase->CurrentAuction["metadata"]["auction_loading_stations_availability_til"]);?></td></tr>
<tr><td><strong><? echo($texts['auction_additional_informations']); ?>:</strong></td><td id="additional_informations"><? echo($gBase->CurrentAuction["metadata"]["metadata"]["auction_additional_informations"]);?></td></tr>
	</table>
</p>

  </div>

</div>



<script type="text/javascript">




currentAuctionID='<? echo($gBase->CurrentAuction["auction"]["id"]);?>';

function buyOffer(){



  $.getJSON("index.php", { "action": "buy_offer", "view": "show_running_auction", "mode":"ajax","auction_id":currentAuctionID, "sid":"<? echo($_COOKIE["PHPSESSID"]); ?>"},
			
			  			function(data){
			 				 session_id=data.conf.session_id;
							
								location.reload();


						 });
	
	}





  $.getJSON("http://maps.googleapis.com/maps/api/geocode/json=", { "address": "49699+lindern", "sensor": "true"},
			
			  			function(data){
			 				 
			 				 alert(data);


						 });
	



</script>

<?

?>