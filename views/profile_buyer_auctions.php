<div id="won_auctions_layer" class="sublayer hide" >



  <div id="won_auctions">
    <h2><? echo($texts['profile_auctions_won']); ?></h2>



  <?

 $auctions=$gBase->UserWonAuctions;
$counter=0;

$auctionToApprove=false;

for($j=0;$j<count($auctions)-1;$j++){

  if($auctions[$j]['status']=="ended"){
    $auctionToApprove=true;
    break;
  }
}


if($auctionToApprove){



   ?>

 
  <div id="buyerauctionstoapprove" >
    <h2><? echo($texts['profile_my_auctions_to_approve']); ?></h2>
   



 <table class="table table-striped">
    <tr>
      <td><? echo($texts['profile_category']); ?></td>
      <td><? echo($texts['add_auction_date']); ?></td>
      <td><? echo($texts['auction_amount']); ?></td>
      <td><? echo($texts['auction_min_entitity_price_without_euro']); ?></td>
      <td><? echo($texts['auction_last_bid']); ?></td>
     <td></td>
      <!--<td></td>-->
      <td></td>
    </tr>
    <?
    for($i=0; $i<count($auctions); $i++){

      if($auctions[$i]["is_auction"]=="yes" && $auctions[$i]['status']=="ended"){
$counter++;
      ?>

<tr>
 <td><a class="tooltipbtn" data-toggle="tooltip" data-placement="top" title="<? echo($texts['profile_category_long_'.$auctions[$i]["category_id"]]); ?>" ><? echo($texts['profile_category_'.$auctions[$i]["category_id"]]); ?></a></td>

 <td><? echo(date("d.m.Y", strtotime($auctions[$i]["end_time"]))); ?></td>
  <td><? echo($auctions[$i]["amount_of_animals"]); ?></td>
  <td><? echo(formatPrice($auctions[$i]["min_entity_price"])); ?></td>
  <td><? echo(formatPrice($auctions[$i]["current_entity_price"])); ?></td>
  <td> <a href="?from=profile&view=show_full_auction&action=get_auction_details&is_auction=yes&auction_id=<? echo($auctions[$i]["id"]); ?>&category_id=<? echo($auctions[$i]["category_id"]); ?>" class="btn" type="button" id="addAuction" ><?  echo($texts['profile_buyer_details']); ?></a></td>
  <!--<td> <a href="?view=profile&action=confirm_auction&is_auction=yes&auction_id=<? echo($auctions[$i]["id"]); ?>&category_id=<? echo($auctions[$i]["category_id"]); ?>" onclick = "if (! confirm('<? echo($texts['profile_confirm_question']); ?>')) { return false; }" class="btn" type="button" ><?  echo($texts['profile_confirm_sell']); ?></a></td>-->
  <td> <a href="?view=profile&action=cancel_auction&auction_id=<? echo($auctions[$i]["id"]); ?>&category_id=<? echo($auctions[$i]["category_id"]); ?>" onclick = "if (! confirm('<? echo($texts['profile_storno_auction_question']); ?>')) { return false; }" class="btn" type="button"  ><?  echo($texts['profile_deny_sell']); ?></a></td>
</tr>

      <?
}
  }
  ?>
</table>


  </div>



  <?
}



?>





    
      <?

$won_auctions=$gBase->UserWonAuctions;
$counter=0;



if(count($won_auctions)>1){

?>

   <table class="table table-striped">
    <tr>
       <td><? echo($texts['profile_category']); ?></td>
      <td><? echo($texts['add_auction_date']); ?></td>
      <td><? echo($texts['auction_amount']); ?></td>
      <td><? echo($texts['auction_buying_price']); ?></td>
      <td><? echo($texts['auction_buying_location']); ?></td>
      <td></td>
      <td></td>
      <td></td>
    </tr>

<?
    for($i=0; $i<count($won_auctions)-1; $i++){

 if( $won_auctions[$i]["is_auction"]=="yes"){
  $counter++;
?>


<tr>
  <td><a class="tooltipbtn" data-toggle="tooltip" data-placement="top" title="<? echo($texts['profile_category_long_'.$won_auctions[$i]["category_id"]]); ?>" ><? echo($texts['profile_category_'.$won_auctions[$i]["category_id"]]); ?></a></td>

  <td><a class="tooltipbtn" data-toggle="tooltip" data-placement="top" title="<? echo($texts[$won_auctions[$i]["status"]]); ?>" ><? echo(date("d.m.Y", strtotime($won_auctions[$i]["end_time"]))); ?></a></td>
  <td><? echo($won_auctions[$i]["amount_of_animals"]); ?></td>
  <td><? echo(formatPrice($won_auctions[$i]["current_entity_price"])); ?></td>
  <td><? echo($won_auctions[$i]["city"]); ?></td>


  <td> <a href="?from=profile&view=show_full_auction&action=get_auction_details&is_auction=yes&auction_id=<? echo($won_auctions[$i]["id"]); ?>&category_id=<? echo($won_auctions[$i]["category_id"]); ?>" class="btn" type="button" id="showAuction" ><?  echo($texts['auction_details']); ?></a></td>
 
<?
    
     if( $won_auctions[$i]["status"]=="confirmed"){

      ?>

  <td> <a href="?view=add_rating&action=get_auction_details&auction_id=<? echo($won_auctions[$i]["id"]); ?>&category_id=<? echo($auctions[$i]["category_id"]); ?>" class="btn" type="button" id="addAuction" ><?  echo($texts['profile_rate_partner']); ?></a></td>


 <?

     }else{

      echo('<td></td>');
     }
     ?>

</tr>

  <?
}
  }
?>

</table>


<div class="pagination">
  <ul>
<?
  $pages=(int)$won_auctions["number_of_rows"]/$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"]+1;
  $active=1;
if ($_REQUEST['page']!='') {
  $active=$_REQUEST['page'];
}
 for ($i=1; $i <= $pages; $i++) { 
  if($i==$active){
    echo('<li class="active"><a href="?view=profile&action=get_user_won_auctions&page='.$i.'#won_auctions"  >'.$i.'</a></li>');
  }else{
   echo('<li ><a href="?view=profile&action=get_user_won_auctions&page='.$i.'#won_auctions" >'.$i.'</a></li>');
   }
 }

?>
 
   
  </ul>
</div>

<?


}

if($counter==0){
   echo($texts['profile_no_auction_won']);
  
  }


?>
    
  </div>




</div>