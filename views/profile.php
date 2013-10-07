<div id="profile">
  <div id="userdata">
    <h2><? echo($texts['profile_my_data']); ?></h2>
    <p> <? echo($texts['registration_username']); ?>:&nbsp;<? echo($gBase->User['username']); ?><br/>
      <? echo($texts['registration_email']); ?>:&nbsp;<? echo($gBase->User['email']); ?><br/>
      <? echo($texts['registration_firstname']); ?>:&nbsp;<? echo($gBase->User['firstname']); ?><br/>
      <? echo($texts['registration_lastname']); ?>:&nbsp;<? echo($gBase->User['lastname']); ?><br/>
      <? echo($texts['registration_street']); ?>:&nbsp;<? echo($gBase->UserAddresses[0]['street'].' '.$gBase->UserAddresses[0]['number']); ?><br/>
      <? echo($texts['registration_city']); ?>:&nbsp;<? echo($gBase->UserAddresses[0]['postcode'].' '.$gBase->UserAddresses[0]['city']); ?><br/>
    </p>
    <a href="?view=edit_profile" class="btn" type="button" id="editUserdata" ><?  echo($texts['edit']); ?></a>
  
    <a href="#changePasswordModal" class="btn" type="button" id="editPassword" data-toggle="modal" ><?  echo($texts['edit_password']); ?></a>
    
  </div>
  
  
     <?

 
if($gBase->User['is_seller']=="yes"){

?>





<!--AUCTIONS-BEGIN-->

      <?

 $auctions=$gBase->UserAuctions;
$counter=0;

$auctionToApprove=false;

for($j=0;$j<count($auctions);$j++){

  if($auctions[$j]['status']=="ended"){
    $auctionToApprove=true;
    break;
  }
}


if($auctionToApprove){



   ?>

  <div id="userauctionstoapprove">
    <h2><? echo($texts['profile_my_auctions_to_approve']); ?></h2>
    <p>



 <table class="table table-striped span8">
    <tr>
      <td><? echo($texts['add_auction_date']); ?></td>
      <td><? echo($texts['auction_amount']); ?></td>
      <td><? echo($texts['auction_min_entitity_price']); ?></td>
      <td><? echo($texts['auction_last_bid']); ?></td>
     <td></td>
      <td></td>
      <td></td>
    </tr>
    <?
    for($i=0; $i<count($auctions); $i++){

      if($auctions[$i]["is_auction"]=="yes" && $auctions[$i]['status']=="ended"){
$counter++;
      ?>

<tr>
 
 <td><? echo(date("d.m.Y", strtotime($auctions[$i]["end_time"]))); ?></td>
  <td><? echo($auctions[$i]["amount_of_animals"]); ?></td>
  <td><? echo($auctions[$i]["min_entity_price"]); ?></td>
  <td><? echo($auctions[$i]["current_entity_price"]); ?></td>
  <td> <a href="?from=profile&view=show_full_auction&action=get_auction_details&is_auction=yes&auction_id=<? echo($auctions[$i]["id"]); ?>" class="btn" type="button" id="addAuction" ><?  echo($texts['profile_buyer_details']); ?></a></td>
  <td> <a href="?view=profile&action=confirm_auction&is_auction=yes&auction_id=<? echo($auctions[$i]["id"]); ?>" onclick = "if (! confirm('<? echo($texts['profile_confirm_question']); ?>')) { return false; }" class="btn" type="button" ><?  echo($texts['profile_confirm_sell']); ?></a></td>
  <td> <a href="?view=profile&action=cancel_auction&auction_id=<? echo($auctions[$i]["id"]); ?>" onclick = "if (! confirm('<? echo($texts['profile_delete_auction_question']); ?>')) { return false; }" class="btn" type="button"  ><?  echo($texts['profile_deny_sell']); ?></a></td>
</tr>

      <?
}
  }
  ?>
</table>

    </p>
  </div>



  <?
}



?>

<!--AUCTIONS-END-->















<!--AUCTIONS-BEGIN-->

  <div id="userauctions">
    <div class="pull-right"> <a href="?view=edit_auction&is_auction=yes" class="btn" type="button" id="addAuction" ><?  echo($texts['profile_add_auction']); ?></a>
</div>
    <h2><? echo($texts['profile_my_auctions']); ?></h2>


    <p>
      <?

 $auctions=$gBase->UserAuctions;
$counter=0;

if(count($auctions)>0){



   ?>
  




 <table class="table table-striped span8">
    <tr>
      <td><? echo($texts['add_auction_date']); ?></td>
      <td><? echo($texts['auction_amount']); ?></td>
      <td><? echo($texts['auction_min_entitity_price']); ?></td>
      <td><? echo($texts['auction_last_bid']); ?></td>
      <td></td>
      <td></td>
   
    </tr>
    <?
    for($i=0; $i<count($auctions); $i++){

      if( $auctions[$i]["is_auction"]=="yes" && $auctions[$i]["status"]!="ended"){
$counter++;
      ?>

<tr>
 

  <?
   if( $auctions[$i]["is_main"]=="yes"){

      ?>
 <td><? echo(date("d.m.Y", strtotime($auctions[$i]["start_time"]))); ?></td>
 
<? 
}else{
?>

<td><? echo(date("d.m.Y", strtotime($auctions[$i]["end_time"]))); ?></td>
<? 
}
?>

  <td><? echo($auctions[$i]["amount_of_animals"]); ?></td>
  <td><? echo($auctions[$i]["min_entity_price"]); ?></td>
  <td><? echo($auctions[$i]["current_entity_price"]); ?></td>
   <?
   if( $auctions[$i]["status"]=="pending" ||  $auctions[$i]["status"]=="preview" ){

      ?>
  <td> <a href="?view=edit_auction&is_auction=yes&auction_id=<? echo($auctions[$i]["id"]); ?>" class="btn" type="button" id="addAuction" ><?  echo($texts['profile_edit_auction']); ?></a></td>
  <td> <a href="?view=profile&action=remove_auction&auction_id=<? echo($auctions[$i]["id"]); ?>" onclick = "if (! confirm('<? echo($texts['profile_delete_auction_question']); ?>')) { return false; }" class="btn" type="button"  ><?  echo($texts['profile_delete_auction']); ?></a></td>



<?
      }else if( $auctions[$i]["status"]=="going"){

      ?>


  <td colspan="2"> <a href="?view=profile&action=remove_auction&auction_id=<? echo($auctions[$i]["id"]); ?>" onclick = "if (! confirm('<? echo($texts['profile_delete_auction_question']); ?>')) { return false; }" class="btn" type="button"  ><?  echo($texts['profile_delete_auction']); ?></a></td>




 <?
      }else if( $auctions[$i]["status"]=="confirmed"){

      ?>

  <td colspan="2"> <a href="?action=get_invoice&is_auction=yes&auction_id=<? echo($auctions[$i]["id"]); ?>" class="btn" type="button" id="addAuction" ><?  echo($texts['profile_get_invoice']); ?></a></td>
  

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




  <?
}

if($counter==0){
	
	 echo($texts['profile_no_auction']);
	
	}

?>
<br/>

    </p>
  </div>

<!--AUCTIONS-END-->


<!--OFFERS-BEGIN-->

      <?

 $auctions=$gBase->UserAuctions;

$counter=0;


$auctionToApprove=false;

for($j=0;$j<count($auctions);$j++){

  if($auctions[$j]['status']=="ended" && $auctions[$j]['is_auction']=="no" ){
    $auctionToApprove=true;
    break;
  }
}



if($auctionToApprove){

   ?>

<div id="userofferstoconfirm">

    <h2><? echo($texts['profile_my_offers_to_confirm']); ?></h2>
    <p>


 <table class="table table-striped span8">
    <tr>
      <td><? echo($texts['add_auction_date']); ?></td>
      <td><? echo($texts['auction_amount']); ?></td>
      <td><? echo($texts['offer_entitity_price']); ?></td>
      <td></td>
      <td></td>
       <td></td>
    </tr>
    <?
    for($i=0; $i<count($auctions); $i++){

      if( $auctions[$i]["is_auction"]=="no"){
$counter++;
      ?>

<tr>
  <td><? echo(date("d.m.Y", strtotime($auctions[$i]["start_time"]))); ?></td>
  <td><? echo($auctions[$i]["amount_of_animals"]); ?></td>
  <td><? echo($auctions[$i]["min_entity_price"]); ?></td>

  <td> <a href="?from=profile&view=show_full_auction&action=get_auction_details&is_auction=yes&auction_id=<? echo($auctions[$i]["id"]); ?>" class="btn" type="button" id="addAuction" ><?  echo($texts['profile_buyer_details']); ?></a></td>
  <td> <a href="?view=profile&action=confirm_auction&is_auction=yes&auction_id=<? echo($auctions[$i]["id"]); ?>" onclick = "if (! confirm('<? echo($texts['profile_confirm_question']); ?>')) { return false; }" class="btn" type="button" ><?  echo($texts['profile_confirm_sell']); ?></a></td>
  <td> <a href="?view=profile&action=cancel_auction&auction_id=<? echo($auctions[$i]["id"]); ?>" onclick = "if (! confirm('<? echo($texts['profile_delete_auction_question']); ?>')) { return false; }" class="btn" type="button"  ><?  echo($texts['profile_deny_sell']); ?></a></td>
</tr>

      <?
}
  }
  ?>
</table>




<br/>
 
    </p>
  </div>


  <?
}




?>


<!--OFFERS-End-->


<div id="useroffers">
  <div class="pull-right"><a href="?view=edit_auction&is_auction=no" class="btn" type="button" id="addAuction" ><?  echo($texts['profile_add_offer']); ?></a>
</div>
    <h2><? echo($texts['profile_my_offers']); ?></h2>
    <p>
      <?

 $auctions=$gBase->UserAuctions;

$counter=0;
if(count($auctions)>0){

   ?>
  




 <table class="table table-striped span8">
    <tr>
      <td><? echo($texts['add_auction_date']); ?></td>
      <td><? echo($texts['auction_amount']); ?></td>
      <td><? echo($texts['offer_entitity_price']); ?></td>

      <td></td>
      <td></td>
    </tr>
    <?
    for($i=0; $i<count($auctions); $i++){

      if( $auctions[$i]["is_auction"]=="no" && $auctions[$i]["status"]!="ended"){
$counter++;
      ?>

<tr>
  <td><? echo($auctions[$i]["start_time"]); ?></td>
  <td><? echo($auctions[$i]["amount_of_animals"]); ?></td>
  <td><? echo($auctions[$i]["min_entity_price"]); ?></td>



 <?
   if( $auctions[$i]["status"]=="offering" || $auctions[$i]["status"]=="preview"){

      ?>
  <td> <a href="?view=edit_auction&is_auction=no&auction_id=<? echo($auctions[$i]["id"]); ?>" class="btn" type="button" id="addAuction" ><?  echo($texts['profile_edit_auction']); ?></a></td>
  <td> <a href="?view=profile&action=remove_auction&auction_id=<? echo($auctions[$i]["id"]); ?>" onclick = "if (! confirm('<? echo($texts['profile_delete_auction_question']); ?>')) { return false; }" class="btn" type="button"  ><?  echo($texts['profile_delete_auction']); ?></a></td>


 <?
      }else if( $auctions[$i]["status"]=="confirmed"){

      ?>

  <td colspan="2"> <a href="?action=get_invoice&is_auction=yes&auction_id=<? echo($auctions[$i]["id"]); ?>" class="btn" type="button" id="addAuction" ><?  echo($texts['profile_get_invoice']); ?></a></td>


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




  <?
}

if($counter==0){
  
   echo($texts['profile_no_offers']);
  
  }

?>
<br/>
 
    </p>
  </div>




<!--OFFERS-End-->



  <?
}
?>






     <?
if($gBase->User['is_buyer']=="yes"){
?>


  <div id="won_auctions">
    <h2><? echo($texts['profile_auctions_won']); ?></h2>
    <p>
      <?

$won_auctions=$gBase->UserWonAuctions;
$counter=0;
if(count($won_auctions)>0){

?>

   <table class="table table-striped span8">
    <tr>
      <td><? echo($texts['add_auction_date']); ?></td>
      <td><? echo($texts['auction_amount']); ?></td>
      <td><? echo($texts['auction_buying_price']); ?></td>
      <td><? echo($texts['auction_buying_location']); ?></td>
      <td></td>
      <td></td>
    </tr>

<?
    for($i=0; $i<count($won_auctions); $i++){

 if( $won_auctions[$i]["is_auction"]=="yes"){
  $counter++;
?>


<tr>
  <td><? echo($won_auctions[$i]["end_time"]); ?></td>
  <td><? echo($won_auctions[$i]["amount_of_animals"]); ?></td>
  <td><? echo($won_auctions[$i]["current_entity_price"]); ?></td>
  <td><? echo($won_auctions[$i]["city"]); ?></td>
  <td> <a href="?from=profile&view=show_full_auction&action=get_auction_details&is_auction=yes&auction_id=<? echo($won_auctions[$i]["id"]); ?>" class="btn" type="button" id="showAuction" ><?  echo($texts['auction_details']); ?></a></td>
 
</tr>

	<?
}
	}
?>

</table>


<?


}

if($counter==0){
	 echo($texts['profile_no_auction_won']);
	
	}


?>
    </p>
  </div>






<div id="won_offers">
    <h2><? echo($texts['profile_offers_won']); ?></h2>
    <p>
      <?

$won_auctions=$gBase->UserWonAuctions;
$counter=0;
if(count($won_auctions)>0){

?>

   <table class="table table-striped span8">
    <tr>
      <td><? echo($texts['bought_offer_date']); ?></td>
      <td><? echo($texts['auction_amount']); ?></td>
      <td><? echo($texts['auction_buying_price']); ?></td>
      <td><? echo($texts['auction_buying_location']); ?></td>
      <td></td>
      <td></td>
    </tr>

<?
    for($i=0; $i<count($won_auctions); $i++){
 if( $won_auctions[$i]["is_auction"]=="no"){
$counter++;
?>

<tr>
  <td><? echo($won_auctions[$i]["end_time"]); ?></td>
  <td><? echo($won_auctions[$i]["amount_of_animals"]); ?></td>
  <td><? echo($won_auctions[$i]["current_entity_price"]); ?></td>
  <td><? echo($won_auctions[$i]["city"]); ?></td>
  <td> <a href="?from=profile&view=show_full_auction&action=get_auction_details&is_auction=no&auction_id=<? echo($won_auctions[$i]["id"]); ?>" class="btn" type="button" id="showAuction" ><?  echo($texts['auction_details']); ?></a></td>
 
</tr>

  <?
}
  }
?>

</table>


<?


}

if($counter==0){
   echo($texts['profile_no_auction_won']);
  
  }


?>
    </p>
  </div>






<?
}
?>


</div>
