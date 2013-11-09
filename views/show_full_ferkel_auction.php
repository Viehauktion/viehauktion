<?


?>


<div id="auction_details" class="span6">

<h2><? if($_REQUEST['is_auction']=='yes'){ echo($texts['auction'].' - '.$texts['ferkel']);}else{ echo($texts['offer'].' - '.$texts['ferkel']);} ?></h2>

<div id="googlemap">
<img src="http://maps.googleapis.com/maps/api/staticmap?center=<? echo($gBase->CurrentAuction["address"]["postcode"]."+".$gBase->CurrentAuction["auction"]["city"]); ?>&zoom=10&size=500x300&maptype=roadmap&sensor=false" />

</div>

<div  id="main_data" class="leftView well">

<p>
	<table class="table">
		<tr><td><strong><? if($_REQUEST['is_auction']=='yes'){echo($texts["auction_id"]) ;}else{ echo($texts["offer_id"]) ;}?>:</strong></td><td id="auction_id"><? echo($gBase->CurrentAuction["auction"]["id"]);?></td></tr>
		<tr><td><strong><? echo($texts['auction_amount']); ?>:</strong></td><td id="amount_of_animals"><? echo($gBase->CurrentAuction["metadata"]["amount_of_animals"]);?></td></tr>

		<tr><td  class="leftSide"><strong><? if($_REQUEST['is_auction']=='yes'){ echo($texts['auction_ferkel_min_entity_price']); }else{ echo($texts['offer_ferkel_min_entity_price']); } ?>:</strong></td><td id="min_entity_price" ><? echo($gBase->CurrentAuction["auction"]["min_entity_price"]);?> €


<?

	if($gBase->CurrentAuction["auction"]["is_vezg"]=="yes"){

		?>
<br/><? echo($texts['to_date'].' '.$texts['vezg_date'].": ".date("d.m.Y", strtotime($gBase->CurrentAuction["auction"]['start_time']))); ?>
		<?
	}

	?>

		</td></tr>
		
		<tr><td><strong><? echo($texts['auction_city']); ?>:</strong></td><td  id="city"><? echo($gBase->CurrentAuction["auction"]["city"]);?></td></tr>
		<tr><td class="leftSide"><strong><? echo($texts['auction_user_name']); ?>:</strong></td><td  id="user_name" ><? if($gBase->CurrentAuction["seller_name"]!=''){ echo($gBase->CurrentAuction["seller_name"]); }else{ echo($texts["seller_anonym"]);}?></td></tr>
<tr><td class="leftSide"><strong><? echo($texts['auction_user_rating']); ?>:</strong></td><td  id="user_rating" >
		<div class="emptyPigsRating"  ></div>
	<div class="fullPigsRating" style="width:<? echo(($gBase->CurrentAuction["user_rating"]["rating"]*33.33)); ?>px" ></div>


	<div class="amountOfRatings"><? echo("(".$gBase->CurrentAuction["user_rating"]["amount"].")");?></div>
</td></tr>
	


<!--
METADATA
-->
	<tr><td><strong><? echo($texts['auction_origin']) ;?>:</strong></td><td id="origin"><? echo($gBase->CurrentAuction["metadata"]["metadata"]["auction_origin"]);?></td></tr>
		<tr><td><strong><? echo($texts['auction_ferkel_stalls']) ;?>:</strong></td><td id="stalls"><? echo($gBase->CurrentAuction["metadata"]["metadata"]["auction_stalls"]);?></td></tr>
		<tr><td><strong><? echo($texts['auction_genes']) ;?>:</strong></td><td id="genes"><? echo($gBase->CurrentAuction["metadata"]["metadata"]["auction_genes"]);?></td></tr>
		<tr><td><strong><? echo($texts['auction_ferkel_health']) ;?>:</strong></td><td id="health"><? echo($gBase->CurrentAuction["metadata"]["metadata"]["auction_health"]);?></td></tr>
		<tr><td><strong><? echo($texts['auction_ferkel_status']) ;?>:</strong></td><td id="status"><? echo($gBase->CurrentAuction["metadata"]["metadata"]["auction_status"]);?></td></tr>

		
		
<tr><td><strong><? echo($texts['auction_loading_stations_availability']); ?>:</strong></td><td id="stations_availability"><? echo($gBase->CurrentAuction["metadata"]["metadata"]["auction_loading_stations_availability"]." ".$texts['auction_loading_stations_availability_til']." ".$gBase->CurrentAuction["metadata"]["metadata"]["auction_loading_stations_availability_til"]);?></td></tr>
<tr><td><strong><? echo($texts['auction_additional_informations']); ?>:</strong></td><td id="additional_informations"><? echo($gBase->CurrentAuction["metadata"]["metadata"]["auction_additional_informations"]);

if($gBase->CurrentAuction["metadata"]["metadata"]["needs_original"]=="yes"){

	echo('<br/><br/>'.$texts['auction_original_needed']); 
}

?></td></tr>
	</table>
</p>



  </div>









  <? 
if($_REQUEST["is_preview"]=="yes"){

if($_REQUEST['is_auction']=="yes"){
?>
    <a href="?view=edit_auction&is_auction=<? echo($_REQUEST['is_auction']);?>&auction_id=<? echo($gBase->CurrentAuction["auction"]["id"]);?>&is_auction=<? echo($_REQUEST['is_auction']); ?>" class="btn btn-primary" id="auction_preview"><? echo($texts['back']); ?></a>&nbsp;<a href="?view=profile&action=save_auction&auction_id=<? echo($gBase->CurrentAuction["auction"]["id"]);?>&is_auction=<? echo($_REQUEST['is_auction']);?>#auctions"  class="btn btn-primary" id="auction_submit"><? echo($texts['auction_submit']); ?></a>
<?	

}else{

?>
<a href="?view=edit_auction&is_auction=<? echo($_REQUEST['is_auction']);?>&auction_id=<? echo($gBase->CurrentAuction["auction"]["id"]);?>&is_auction=<? echo($_REQUEST['is_auction']); ?>" class="btn btn-primary" id="auction_preview"><? echo($texts['back']); ?></a>&nbsp;<a href="?view=profile&action=save_auction&auction_id=<? echo($gBase->CurrentAuction["auction"]["id"]);?>&is_auction=<? echo($_REQUEST['is_auction']);?>#offers"  class="btn btn-primary" id="auction_submit"><? echo($texts['auction_submit']); ?></a>

<?

}

}
?>
  


</div>


<div class="rightView span5 pull-right">







	
<div id="time_box" > 
	<div id="highestBid" class="well">
	<table>
		<tr><td ><strong><? if($_REQUEST['is_auction']=='yes'){echo($texts['auction_your_end_price']) ;}else{ echo($texts['offer_entitity_price']) ;}?>:</strong></td><td  id="curent_price"><? echo($gBase->CurrentAuction["auction"]["current_entity_price"].'€');?></td></tr>

	</table>
	<?

	if($gBase->CurrentAuction["auction"]["is_vezg"]=="yes"){

		?>
<p><? echo($texts['to_date'].' '.$texts['vezg_date'].": ".date("d.m.Y", strtotime($gBase->CurrentAuction["auction"]['start_time']))); ?></p>
		<?
	}

	?>
</div>


<?
		

		if($gBase->CurrentAuction["is_seller"]=="yes"){		
echo("<p >".$texts['auction_is_seller']."</p>");
		}

		?>




<? if( ($gBase->CurrentAuction["auction"]["status"]=="ended" || $gBase->CurrentAuction["auction"]["status"]=="confirmed") && ($gBase->CurrentAuction["auction"]["buyer_id"]==$gBase->User["id"] || $gBase->User['role']=='admin')){ ?>

<div id="seller_box"> 
  <h2><? echo($texts['seller']); ?></h2>
     <p>
     	<a href="?view=show_full_user&action=show_full_user&user_id=<? echo($gBase->CurrentAuction["auction"]["user_id"]);?>&auction_id=<? echo($gBase->CurrentAuction["auction"]["id"]);?>" ><? echo($gBase->CurrentAuction["seller"]["firstname"]." ".$gBase->CurrentAuction["seller"]["lastname"]); ?></a><br />
		<? echo($gBase->CurrentAuction["address"]["street"]." ".$gBase->CurrentAuction["address"]["number"]); ?><br />
		<? echo($gBase->CurrentAuction["address"]["postcode"]." ".$gBase->CurrentAuction["address"]["city"]); ?><br />
		
		<? echo($texts['registration_phone'].": ".$gBase->CurrentAuction["seller"]["phone"]."<br />".$texts['registration_email'].": ".$gBase->CurrentAuction["seller"]["email"]); ?><br />
     <br/>
  <a href="?view=show_full_user&action=show_full_user&user_id=<? echo($gBase->CurrentAuction["auction"]["user_id"]);?>&auction_id=<? echo($gBase->CurrentAuction["auction"]["id"]);?>" class="btn" type="button" ><? echo(
$texts['show_seller_detail']); ?></a><br/><br/>
     </p>
       
</div>

<? 
}
?>


<? if(($gBase->CurrentAuction["auction"]["status"]=="ended" || $gBase->CurrentAuction["auction"]["status"]=="confirmed")  && ($gBase->CurrentAuction["auction"]["user_id"]==$gBase->User["id"] || $gBase->User['role']=='admin')){ ?>

<div id="buyer_box"> 
  <h2><? echo($texts['buyer']); ?></h2>
     <p>
     	<a href="?view=show_full_user&action=show_full_user&user_id=<? echo($gBase->CurrentAuction["auction"]["buyer_id"]);?>&auction_id=<? echo($gBase->CurrentAuction["auction"]["id"]);?>" ><? echo($gBase->CurrentAuction["buyer"]["firstname"]." ".$gBase->CurrentAuction["buyer"]["lastname"]); ?></a><br />
		<? echo($gBase->CurrentAuction["buyer"]["address"]["street"]." ".$gBase->CurrentAuction["buyer"]["address"]["number"]); ?><br />
		<? echo($gBase->CurrentAuction["buyer"]["address"]["postcode"]." ".$gBase->CurrentAuction["buyer"]["address"]["city"]); ?><br />
	
		<? echo($texts['registration_phone'].": ".$gBase->CurrentAuction["buyer"]["phone"]."<br />".$texts['registration_email'].": ".$gBase->CurrentAuction["buyer"]["email"]); ?><br />
   <br/>
  <a href="?view=show_full_user&action=show_full_user&user_id=<? echo($gBase->CurrentAuction["auction"]["buyer_id"]);?>&auction_id=<? echo($gBase->CurrentAuction["auction"]["id"]);?>"  class="btn" type="button" ><? echo(
$texts['show_buyer_detail']); ?></a><br/><br/>
     </p>
       
</div>

<? 
}
?>



<? if($_REQUEST['is_auction']=='yes'){ ?>
<p>
	<table>
		<tr><td><strong><? echo($texts['auction_start_time']) ;?>:</strong></td><td id="start_time" ><? echo(" ".date("d.m.Y H:i:s", strtotime($gBase->CurrentAuction["auction"]["start_time"])));?></td></tr>
<? if($gBase->CurrentAuction["auction"]["end_time"]!='0000-00-00 00:00:00'){ ?>
		<tr><td><strong><? echo($texts['auction_end_time']) ;?>:</strong></td><td id="end_time" ><? echo(" ".date("d.m.Y H:i:s", strtotime($gBase->CurrentAuction["auction"]["end_time"])));?></td></tr>
<? 
}
?>
		<tr><td><strong><? echo($texts['auction_bids']); ?>:</strong></td><td id="bids" ><? echo(" ".$gBase->CurrentAuction["auction"]["bids"]);?></td></tr>
	</table>
</p>
<? 
}
?>


<? if($_REQUEST['is_auction']=='no'){ ?>
<p>
	<table>
		<tr><td><strong><? echo($texts['offer_creation_date']) ;?>:</strong></td><td id="end_time" ><? echo(" ".date("d.m.y", strtotime($gBase->CurrentAuction["auction"]["created"])));?></td></tr>
	
	</table>
</p>
<? 
}
?>



</div>




<? if($_REQUEST['is_auction']=='no' && $gBase->CurrentAuction["auction"]["status"]=="offering"){ ?>

<div id="bid_box" class="well"> 

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



  <? 
if($_REQUEST["is_preview"]=="yes"){

if($_REQUEST['is_auction']=="yes"){
?>
    <a href="?view=edit_auction&is_auction=<? echo($_REQUEST['is_auction']);?>&auction_id=<? echo($gBase->CurrentAuction["auction"]["id"]);?>&is_auction=<? echo($_REQUEST['is_auction']); ?>" class="btn btn-primary" id="auction_preview"><? echo($texts['back']); ?></a>&nbsp;<a href="?view=profile&action=save_auction&auction_id=<? echo($gBase->CurrentAuction["auction"]["id"]);?>&is_auction=<? echo($_REQUEST['is_auction']);?>#auctions"  class="btn btn-primary" id="auction_submit"><? echo($texts['auction_submit']); ?></a>
<?	

}else{

?>
<a href="?view=edit_auction&is_auction=<? echo($_REQUEST['is_auction']);?>&auction_id=<? echo($gBase->CurrentAuction["auction"]["id"]);?>&is_auction=<? echo($_REQUEST['is_auction']); ?>" class="btn btn-primary" id="auction_preview"><? echo($texts['back']); ?></a>&nbsp;<a href="?view=profile&action=save_auction&auction_id=<? echo($gBase->CurrentAuction["auction"]["id"]);?>&is_auction=<? echo($_REQUEST['is_auction']);?>#offers"  class="btn btn-primary" id="auction_submit"><? echo($texts['auction_submit']); ?></a>

<?

}

}
?>
  



</div>


<script type="text/javascript">




currentAuctionID='<? echo($gBase->CurrentAuction["auction"]["id"]);?>';

function buyOffer(){



	<?
	if($gBase->User!=null){

		if($gBase->User["is_buyer"]=="no"){

				echo("alert('".$texts['auction_not_buyer_error']."')");

		}else if(($gBase->User['active']!='1') && ($gBase->User['active']!='2')){

				echo("alert('".$texts['auction_not_activated_buyer_error']."')");

		}else if($gBase->CurrentAuction["is_seller"]=="yes"){		
			echo("alert('".$texts['auction_not_buy_own_stuff']."')");
		}else{ 
			
			?>


  $.getJSON("index.php", { "action": "buy_offer", "view": "show_running_auction", "mode":"ajax","auction_id":currentAuctionID, "sid":"<? echo($_COOKIE["PHPSESSID"]); ?>"},
			
			  			function(data){
			 				 session_id=data.conf.session_id;
							
								location.reload();


						 });


  <?  		
		}

  	}else{

		echo("alert('".$texts['auction_not_loggedin_error']."')");

  	} 


  	?>
	
	}





  $.getJSON("http://maps.googleapis.com/maps/api/geocode/json=", { "address": "49699+lindern", "sensor": "true"},
			
			  			function(data){
			 				 
			 				 alert(data);


						 });
	



</script>

<?

?>