   <?
if($_REQUEST['is_auction']=="yes"){
?>
<div id="next_auction">

    <h2><? echo($texts['next_auctions']); ?><?
      if($category_id=='1'){
      echo(' - '.$texts['pigs']." ".$texts['in']." ".$gBase->RawData["county_name"]);
}else{
  echo(' - '.$texts['ferkel']." ".$texts['in']." ".$gBase->RawData["county_name"]);
}
?> </h2>
<div class="row">


      <?

$auctions=$gBase->RawData;

if(count($auctions)>0){

   ?>
  





 <table class="table table-striped span8">
    <tr>
      <td><? echo($texts['add_auction_date']); ?></td>
      <td><? echo($texts['auction_amount']); ?></td>
      <td><? echo($texts['offer_min_entitity_price_without_euro']); ?></td>
       <td><? echo($texts['auction_city']); ?></td>
      <td><? echo($texts['auction_origin']); ?></td>
      <td></td>

    </tr>
    <?

    for($i=0; $i<count($auctions)-2; $i++){

      $metadata=json_decode($auctions[$i]["metadata"], true);
      ?>

<tr>
  <td><? echo(date("d.m.Y", strtotime($auctions[$i]["start_time"]))); ?></td>
  <td><? echo($auctions[$i]["amount_of_animals"]); ?></td>
  <td><? echo(formatPrice($auctions[$i]["min_entity_price"])); ?></td>
  <td><? echo(formatPrice($auctions[$i]["current_entity_price"])); ?></td>
  <td><? echo($metadata["auction_origin"]); ?></td>
   <td> <a href="?view=show_full_auction&action=get_auction_details&is_auction=yes&category_id=<? echo($auctions[$i]["category_id"]); ?>&auction_id=<? echo($auctions[$i]["id"]); ?>&state_id=<? echo($auctions[$i]["state_id"]); ?>&county_id=<? echo($auctions[$i]["county_id"]); ?>" class="btn" type="button" id="showAuction" ><?  echo($texts['auction_details']); ?></a></td>
 
  </tr>

      <?

  }

  ?>


</table>

   <?

  }

  ?>
  
</div>
</div>

<? }else{
?>



<div id="next_offers">

    <h2><? echo($texts['next_offers']); ?><?
      if($category_id=='1'){
      echo(' - '.$texts['pigs']." ".$texts['in']." ".$gBase->RawData["county_name"]);
}else{
  echo(' - '.$texts['ferkel']." ".$texts['in']." ".$gBase->RawData["county_name"]);
}
?> </h2>
 

<div class="row">
      <?

$auctions=$gBase->RawData;

if(count($auctions)>0){

   ?>
  




 <table class="table table-striped span8">
    <tr>
      <td><? echo($texts['offer_creation_date']); ?></td>
      <td><? echo($texts['auction_amount']); ?></td>
      <td><? echo($texts['auction_min_entitity_price']); ?></td>
      <td><? echo($texts['auction_buying_location']); ?></td>
     
      <td></td>
    </tr>
    <?

    for($i=0; $i<count($auctions)-2; $i++){

      
      ?>

<tr>
  <td><? echo(date("d.m.Y", strtotime($auctions[$i]["created"]))); ?></td>
  <td><? echo(formatPrice($auctions[$i]["amount_of_animals"])); ?></td>
  <td><? echo(formatPrice($auctions[$i]["min_entity_price"])); ?>
<?
if($auctions[$i]["is_vezg"]=="yes"){

    ?>
<p><? echo($texts['to_date'].' '.$texts['vezg_date'].": ".date("d.m.Y", strtotime($auctions[$i]['start_time']))); ?></p>
    <?
  }

  ?>
  </td>
  <td><? echo($auctions[$i]["city"]); ?></td>
  <td> <a href="?view=show_full_auction&action=get_auction_details&is_auction=no&auction_id=<? echo($auctions[$i]["id"]); ?>&state_id=<? echo($_REQUEST['state_id']); ?>&county_id=<? echo($_REQUEST["county_id"]); ?>" class="btn" type="button" id="showAuction" ><?  echo($texts['auction_details']); ?></a></td>
 
</tr>

      <?

  }

  ?>


</table>

   <?

  }

  ?>
  

</div>
</div>







<?

}
?>
