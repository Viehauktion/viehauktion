<div id="auctions_layer" class="sublayer hide">
<!--AUCTIONS-BEGIN-->

      <?

 $auctions=$gBase->UserAuctions;
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

 
  <div id="userauctionstoapprove" >
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

<!--AUCTIONS-END-->















<!--AUCTIONS-BEGIN-->

  <div id="userauctions_layer">
    <div class="pull-right"> <a href="?view=edit_auction&is_auction=yes" class="btn" type="button" id="addAuction" ><?  echo($texts['profile_add_auction']); ?></a>
</div>
    <h2><? echo($texts['profile_my_auctions']); ?></h2>



      <?

 $auctions=$gBase->UserAuctions;
$counter=0;

if(count($auctions)>1){



   ?>
  




 <table class="table table-striped">
    <tr>
      <td><? echo($texts['profile_category']); ?></td>
      <td><? echo($texts['add_auction_date']); ?></td>
      <td><? echo($texts['auction_amount']); ?></td>
      <td><? echo($texts['auction_min_entitity_price_without_euro']); ?></td>
      <td><? echo($texts['auction_last_bid']); ?></td>
      <td></td>
      <td></td>
   
    </tr>
    <?
    for($i=0; $i<count($auctions)-1; $i++){

      if( $auctions[$i]["is_auction"]=="yes" && $auctions[$i]["status"]!="ended"){
$counter++;
      ?>

<tr>



<td><a class="tooltipbtn" data-toggle="tooltip" data-placement="top" title="<? echo($texts['profile_category_long_'.$auctions[$i]["category_id"]]); ?>" ><? echo($texts['profile_category_'.$auctions[$i]["category_id"]]); ?></a></td>


  <?
   if( $auctions[$i]["is_main"]=="yes"){

      ?>
 <td><a class="tooltipbtn" data-toggle="tooltip" data-placement="top" title="<? echo($texts[$auctions[$i]["status"]]); ?>" ><? echo(date("d.m.Y", strtotime($auctions[$i]["start_time"]))); ?></a></td>
 
<? 
}else{
?>

<td><? echo(date("d.m.Y", strtotime($auctions[$i]["end_time"]))); ?></td>
<? 
}
?>

  <td><? echo($auctions[$i]["amount_of_animals"]); ?></td>
  <td><? echo(formatPrice($auctions[$i]["min_entity_price"])); ?></td>
  <td><? echo(formatPrice($auctions[$i]["current_entity_price"])); ?></td>
   <?
   if( $auctions[$i]["status"]=="pending" ||  $auctions[$i]["status"]=="preview" ){

      ?>
  <td> <a href="?view=edit_auction&is_auction=yes&auction_id=<? echo($auctions[$i]["id"]); ?>&category_id=<? echo($auctions[$i]["category_id"]); ?>" class="btn" type="button" id="addAuction" ><?  echo($texts['profile_edit_auction']); ?></a></td>
  <td> <a href="?view=profile&action=remove_auction&auction_id=<? echo($auctions[$i]["id"]); ?>&category_id=<? echo($auctions[$i]["category_id"]); ?>#auctions" onclick = "if (! confirm('<? echo($texts['profile_delete_auction_question']); ?>')) { return false; }" class="btn" type="button"  ><?  echo($texts['profile_delete_auction']); ?></a></td>



<?
      }else if( $auctions[$i]["status"]=="scheduled"){

      ?>


  <td colspan="2"><? echo($texts['profile_auction_locked']); ?></td>

<?
      }else if( $auctions[$i]["status"]=="going"){

      ?>


  <td colspan="2"> <a href="?view=profile&action=remove_auction&auction_id=<? echo($auctions[$i]["id"]); ?>&category_id=<? echo($auctions[$i]["category_id"]); ?>#auctions" onclick = "if (! confirm('<? echo($texts['profile_delete_auction_question']); ?>')) { return false; }" class="btn" type="button"  ><?  echo($texts['profile_delete_auction']); ?></a></td>




 <?
      }else if( $auctions[$i]["status"]=="confirmed"){

      ?>
<td> <a href="?from=profile&view=show_full_auction&action=get_auction_details&is_auction=yes&auction_id=<? echo($auctions[$i]["id"]); ?>&category_id=<? echo($auctions[$i]["category_id"]); ?>" class="btn" type="button" id="addAuction" ><?  echo($texts['profile_buyer_details']); ?></a></td>

 <td> <a href="?view=add_rating&action=get_auction_details&auction_id=<? echo($auctions[$i]["id"]); ?>&category_id=<? echo($auctions[$i]["category_id"]); ?>" class="btn" type="button" id="addAuction" ><?  echo($texts['profile_rate_partner']); ?></a></td>

 <?

     }else{

      echo("<td></td>");
      echo("<td></td>");



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
  $pages=(int)$auctions["number_of_rows"]/$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"]+1;
  $active=1;
if ($_REQUEST['page']!='') {
  $active=$_REQUEST['page'];
}
 for ($i=1; $i <= $pages; $i++) { 
  if($i==$active){
    echo('<li class="active"><a href="?view=profile&action=get_user_actions&page='.$i.'#auctions"  >'.$i.'</a></li>');
  }else{
   echo('<li ><a href="?view=profile&action=get_user_actions&page='.$i.'#auctions" >'.$i.'</a></li>');
   }
 }

?>
 
   
  </ul>
</div>


  <?
}

if($counter==0){
  
   echo($texts['profile_no_auction']);
  
  }

?>
<br/>

    
  </div>

</div>
<!--AUCTIONS-END-->