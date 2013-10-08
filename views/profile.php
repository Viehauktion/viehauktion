<div id="profile">



<ul id="subnavigation" class="nav nav-tabs">
  <li class="active"><a href="#" onclick="showSubnavigation('userdata')"><? echo($texts['profile_my_data']); ?></a></li>
  <li><a href="#" onclick="showSubnavigation('auctions')"><? echo($texts['profile_my_auctions']); ?></a></li>
  <li><a href="#" onclick="showSubnavigation('offers')"><? echo($texts['profile_my_offers']); ?></a></li>
  <li><a href="#" onclick="showSubnavigation('won_auctions')"><? echo($texts['profile_auctions_won']); ?></a></li>
  <li><a href="#" onclick="showSubnavigation('won_offers')"><? echo($texts['profile_offers_won']); ?></a></li>
  <li><a href="#" onclick="showSubnavigation('invoices')"><? echo($texts['profile_my_invoices']); ?></a></li>

</ul>


  <div id="userdata" class="sublayer">
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




<div id="auctions" class="sublayer hide">
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

 
  <div id="userauctionstoapprove" >
    <h2><? echo($texts['profile_my_auctions_to_approve']); ?></h2>
    <p>



 <table class="table table-striped span8">
    <tr>
      <td><? echo($texts['add_auction_date']); ?></td>
      <td><? echo($texts['auction_amount']); ?></td>
      <td><? echo($texts['auction_min_entitity_price']); ?></td>
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
 
 <td><? echo(date("d.m.Y", strtotime($auctions[$i]["end_time"]))); ?></td>
  <td><? echo($auctions[$i]["amount_of_animals"]); ?></td>
  <td><? echo($auctions[$i]["min_entity_price"]); ?></td>
  <td><? echo($auctions[$i]["current_entity_price"]); ?></td>
  <td> <a href="?from=profile&view=show_full_auction&action=get_auction_details&is_auction=yes&auction_id=<? echo($auctions[$i]["id"]); ?>" class="btn" type="button" id="addAuction" ><?  echo($texts['profile_buyer_details']); ?></a></td>
  <!--<td> <a href="?view=profile&action=confirm_auction&is_auction=yes&auction_id=<? echo($auctions[$i]["id"]); ?>" onclick = "if (! confirm('<? echo($texts['profile_confirm_question']); ?>')) { return false; }" class="btn" type="button" ><?  echo($texts['profile_confirm_sell']); ?></a></td>-->
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

 <td colspan="2"> <a href="?view=add_rating&action=get_auction_details&auction_id=<? echo($auctions[$i]["id"]); ?>" class="btn" type="button" id="addAuction" ><?  echo($texts['profile_rate_partner']); ?></a></td>

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

</div>
<!--AUCTIONS-END-->


<!--OFFERS-BEGIN-->
<div id="offers" class="sublayer hide">
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

  <td colspan="2"> <a href="?view=add_rating&action=get_auction_details&auction_id=<? echo($auctions[$i]["id"]); ?>" class="btn" type="button" id="addAuction" ><?  echo($texts['profile_rate_partner']); ?></a></td>


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




<div id="won_auctions" class="sublayer hide" >

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




</div>


<div id="won_offers" class="sublayer hide" >

<div id="won_offers" >
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






</div>




<div id="invoices"  class="sublayer hide"> 
      <h2><? echo($texts['profile_my_invoices']); ?></h2>
      
       <p>
      <?

$invoices=$gBase->UserInvoices;
$counter=0;
if(count($invoices)>0){

?>

   <table class="table table-striped span8">
    <tr>
      <td><? echo($texts['invoice_date']); ?></td>
      <td><? echo($texts['invoice_number']); ?></td>
      <td><? echo($texts['invoice_type']); ?></td>
      <td><? echo($texts['invoice_total']); ?></td>
      <td></td>
   
    </tr>

<?
  for($i=0; $i<count($invoices); $i++){
 
?>

<tr>
  <td><? echo(date("d.m.Y", strtotime($invoices[$i]["date"]))); ?></td>
  <td><? echo($invoices[$i]["invoice_number"]); ?></td>
  <td><? 
  if($invoices[$i]['type']=='provision'){
  echo($texts["invoice_provision"]); 
}else{
 echo($texts["invoice_storno"]); 
}
?>
</td>
  <td><? echo($invoices[$i]["total"]); ?></td>
  <td> <a href="?action=get_invoice&invoice_id=<? echo($invoices[$i]["invoice_number"]); ?>" class="btn" type="button" target="_blank"  ><?  echo($texts['profile_get_invoice']); ?></a></td>
 
</tr>

  <?

  }

?>

</table>


<?


}else{
   echo($texts['profile_no_invoice']);
  
  }


?>
    </p>



</div>



<script type="text/javascript">

$('#subnavigation a').click(function (e) {
  e.preventDefault();
  $(this).tab('show');
})

function showSubnavigation(layer){

     

      $("#profile .sublayer").hide();

      $("#profile #"+layer).show();
  
}
</script>
