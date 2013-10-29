<?PHP


$areAuctionsToday=false; 
$areAlreadyRunning=false;

 for($i=0; $i<count($gBase->RawData["todays_auctions"]); $i++){


   if(strtotime($gBase->RawData["todays_auctions"][$i]["start_time"])<strtotime("+10 Minutes")){

      $areSoonRunning=true;
    }

    if(strtotime($gBase->RawData["todays_auctions"][$i]["start_time"])<time()){

      $areAlreadyRunning=true;
    }

 	if(substr($gBase->RawData["todays_auctions"][$i]["start_time"], 0, 10)==date("Y-m-d")){

			$areAuctionsToday=true;

 	}

 }



?>

<div class="row">
  <div class="span12">
   <h2><? echo($texts['navi_auction']); ?></h2>


    <div class="well">
    <?

      if($areAlreadyRunning){
          echo($texts['auctions_already_running']);
      }else if($areSoonRunning){
         echo($texts['auctions_soon_running']);
       
      }else if($areAuctionsToday){
         echo($texts['auctions_auction_today']."<br/><br/>");

         $nextDates=getNextAuctions(1);
      

          echo($texts['auctions_start_auction'].": ".$nextDates[0]['readable_date']);
    


    }else{
      echo($texts['auctions_no_auction_today']."<br/><br/>");

    
      $nextDates=getNextAuctions(1);
      

      echo($texts['auctions_next_auction'].": ".$nextDates[0]['readable_date']);
    }
    ?>
    </div>
  </div>
</div>

<? if($areSoonRunning||$areAlreadyRunning){

$_form_action="get_running_auction";
$_form_view="show_running_auction";

}else{

$_form_action="get_next_auction";
$_form_view="show_next_auction";

} 

$is_auction="yes";
include("select_auction.php");

?>
<hr>

<div id="next_auction">

    <h2><? echo($texts['next_auctions']); ?></h2>
    <p>


      <?

$auctions=$gBase->RawData["latest_auctions"];

if(count($auctions)>0){

   ?>
  




 <table class="table table-striped span8">
    <tr>
      <td><? echo($texts['add_auction_date']); ?></td>
      <td><? echo($texts['auction_amount']); ?></td>
      <td><? echo($texts['auction_min_entitity_price']); ?></td>
       <td><? echo($texts['auction_city']); ?></td>
      <td><? echo($texts['auction_origin']); ?></td>
      <td></td>

    </tr>
    <?

    for($i=0; $i<count($auctions)-1; $i++){

      $metadata=json_decode($auctions[$i]["metadata"], true);
      ?>

<tr>
  <td><? echo(date('d.m.y H:i', strtotime($auctions[$i]["start_time"]))); ?></td>
  <td><? echo($auctions[$i]["amount_of_animals"]); ?></td>
  <td><? echo(formatPrice($auctions[$i]["min_entity_price"])); ?></td>
  <td><? echo(formatPrice($auctions[$i]["current_entity_price"])); ?></td>
  <td><? echo($metadata["auction_origin"]); ?></td>
   <td> <a href="?view=show_full_auction&action=get_auction_details&is_auction=yes&auction_id=<? echo($auctions[$i]["id"]); ?>&state_id=<? echo($auctions[$i]["state_id"]); ?>&county_id=<? echo($auctions[$i]["county_id"]); ?>" class="btn" type="button" id="showAuction" ><?  echo($texts['auction_details']); ?></a></td>
 
  </tr>

      <?

  }

  ?>


</table>

   <?

  }

  ?>
  
</p>

</div>





