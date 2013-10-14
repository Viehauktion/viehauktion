<?PHP


$areOffersToday=false; 

 if(count($gBase->RawData["todays_offers"])>0){
	


			$areOffersToday=true;

 	

 }



?>


   <h2><? echo($texts['navi_market']); ?></h2>



      <p><? if($areOffersToday){
 echo($texts['offers_today']);
      }else{
 echo($texts['offers_no_offer_today']);

      }
      ?>

</p>


<? if($areOffersToday){


$_form_action="get_next_auction";
$_form_view="show_next_auction";
$is_auction="no";
include("select_auction.php");
} 



?>




<div id="next_offers">

    <h2><? echo($texts['next_offers']); ?></h2>
    <p>


      <?

$auctions=$gBase->RawData['latest_offers'];

if(count($auctions)>0){

   ?>
  




 <table class="table table-striped span8">
    <tr>
      <td><? echo($texts['offer_creation_date']); ?></td>
      <td><? echo($texts['auction_amount']); ?></td>
      <td><? echo($texts['auction_min_entitity_price']); ?></td>
      <td><? echo($texts['auction_buying_location']); ?></td>
          <td><? echo($texts['auction_origin']); ?></td>
     
      <td></td>
    </tr>
    <?

    for($i=0; $i<count($auctions); $i++){

            $metadata=json_decode($auctions[$i]["metadata"], true);
      ?>

<tr>
  <td><? echo(date("d.m.y H:i", strtotime($auctions[$i]["created"]))); ?></td>
  <td><? echo($auctions[$i]["amount_of_animals"]); ?></td>
  <td><? echo($auctions[$i]["min_entity_price"]); ?></td>
  <td><? echo($auctions[$i]["city"]); ?></td>
    <td><? echo($metadata["auction_origin"]); ?></td>
  <td> <a href="?view=show_full_auction&action=get_auction_details&is_auction=no&auction_id=<? echo($auctions[$i]["id"]); ?>&state_id=<? echo($auctions[$i]['state_id']); ?>&county_id=<? echo($auctions[$i]["county_id"]); ?>" class="btn" type="button" id="showAuction" ><?  echo($texts['auction_details']); ?></a></td>
 
</tr>

      <?

  }

  ?>


</table>

   <?

  }

  ?>



  <div class="pagination">
  <ul>
<?
  $pages=(int)$auctions["number_of_rows"]/$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"]+1;
  $active=1;
if ($_REQUEST['page']!='') {
  $active=$_REQUEST['page'];
}
 for ($i=1; $i <= $pages; $i++) { 
  if($i==$active){
    echo('<li class="active"><a href="?view=market&action=get_latest_offers&page='.$i.'"  >'.$i.'</a></li>');
  }else{
   echo('<li ><a href="?view=market&action=get_latest_offers&page='.$i.'" >'.$i.'</a></li>');
   }
 }

?>
 
   
  </ul>
</div>
  
</p>

</div>



