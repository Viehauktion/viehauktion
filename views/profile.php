<div id="profile">

<?

if($Action=="activate_user" && $gBase->Error!=null){

 ?>

<div class="alert alert-error alert-block" >
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4><? echo($texts['error']); ?></h4>
<? echo($texts['activation_failed']); ?><br/>
</div>

<?
}
?>




<? 

if($gBase->User!=null){


if($gBase->User['active']==0){

?>
<div class="alert alert-block" >
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4><? echo($texts['attention']); ?></h4>
<? echo($texts['registration_not_yet_activated']); ?><br/>
<a href="#" id="sendActivationAgain" ><? echo($texts["registration_send_again"]); ?></a>
</div>

<script type="text/javascript">

$("#sendActivationAgain").click(function(){


$.getJSON("index.php", { "action": "send_activationmail_again", "view": "profile", "mode":"ajax", "sid":"<? echo($_COOKIE["PHPSESSID"]); ?>"},
      
        function(data){
               session_id=data.conf.session_id;

               if(data.error==null){
               
                    alert('<? echo($texts['profile_send_again_success']);?>');
                }else{

                    alert('<? echo($texts['profile_send_again_error']);?>');
                }
              
             });
return false;


});

</script>


<?
}else{

  if($Action=="activate_user"){

 ?>

<div class="alert alert-success">
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4><? echo($texts['success']); ?></h4>
<? echo($texts['profile_activated_success']); ?><br/>

</div>


<?
}
}
?>

<ul id="subnavigation" class="nav nav-tabs">
  <li class="active"><a href="#userdata" id="userdata_link" onclick="showSubnavigation('userdata')"><? echo($texts['profile_my_data']); ?></a></li>
 
 <?
if($gBase->User['is_seller']=="yes"){

?>
  <li><a href="#auctions" id="auctions_link" onclick="showSubnavigation('auctions')"><? echo($texts['profile_my_auctions']); ?></a></li>
  <li><a href="#offers" id="offers_link" onclick="showSubnavigation('offers')"><? echo($texts['profile_my_offers']); ?></a></li>
 <?
}

if($gBase->User['is_buyer']=="yes"){

?>
  <li><a href="#won_auctions" id="won_auctions_link" onclick="showSubnavigation('won_auctions')"><? echo($texts['profile_auctions_won']); ?></a></li>
  <li><a href="#won_offers" id="won_offers_link" onclick="showSubnavigation('won_offers')"><? echo($texts['profile_offers_won']); ?></a></li>
 <?
}
?>

  <li><a href="#invoices" id="invoices_link" onclick="showSubnavigation('invoices')"><? echo($texts['profile_my_invoices']); ?></a></li>

</ul>




  <div id="userdata_layer" class="sublayer">
    <h2><? echo($texts['profile_my_data']); ?></h2>
    <h4><? echo($texts['registration_address']); ?></h4>
    <p>
      <? echo($texts['registration_company']); ?>:&nbsp;<? echo($gBase->User['company']); ?><br/>
      <? echo($texts['registration_email']); ?>:&nbsp;<? echo($gBase->User['email']); ?><br/>
      <? echo($texts['registration_firstname']); ?>:&nbsp;<? echo($gBase->User['firstname']); ?><br/>
      <? echo($texts['registration_lastname']); ?>:&nbsp;<? echo($gBase->User['lastname']); ?><br/>
      <? echo($texts['registration_street']); ?>:&nbsp;<? echo($gBase->UserAddresses[0]['street'].' '.$gBase->UserAddresses[0]['number']); ?><br/>
      <? echo($texts['registration_city']); ?>:&nbsp;<? echo($gBase->UserAddresses[0]['postcode'].' '.$gBase->UserAddresses[0]['city']); ?><br/>
   
   <h4><? echo($texts['registration_business']); ?></h4> 
 <?
if($gBase->User['is_seller']=="yes"){

?>

     <? echo($texts['registration_stall']); ?>:&nbsp;<? echo($gBase->User['stall_nr']); ?><br/>
   

<?
}

if($gBase->User['is_buyer']=="yes"){

?>
  <? echo($texts['registration_hrb']); ?>:&nbsp;<? echo($gBase->User['hrb_nr']); ?><br/>
      <? echo($texts['registration_retail']); ?>:&nbsp;<? echo($gBase->User['retail_nr']); ?><br/>
     
 <?
}
?>

 <? echo($texts['registration_vat']); ?>:&nbsp;<? echo($gBase->User['retail_nr']); ?><br/>

    </p>

    <br/>  <br/>
    <a href="?view=edit_profile" class="btn" type="button" id="editUserdata" ><?  echo($texts['edit_profile_data']); ?></a>
  
    <a href="#changePasswordModal" class="btn" type="button" id="editPassword" data-toggle="modal" ><?  echo($texts['edit_password']); ?></a>
    
  </div>
  
  
     <?

 
if($gBase->User['is_seller']=="yes"){

?>




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
  <td><? echo(formatPrice($auctions[$i]["min_entity_price"])); ?></td>
  <td><? echo(formatPrice($auctions[$i]["current_entity_price"])); ?></td>
  <td> <a href="?from=profile&view=show_full_auction&action=get_auction_details&is_auction=yes&auction_id=<? echo($auctions[$i]["id"]); ?>" class="btn" type="button" id="addAuction" ><?  echo($texts['profile_buyer_details']); ?></a></td>
  <!--<td> <a href="?view=profile&action=confirm_auction&is_auction=yes&auction_id=<? echo($auctions[$i]["id"]); ?>" onclick = "if (! confirm('<? echo($texts['profile_confirm_question']); ?>')) { return false; }" class="btn" type="button" ><?  echo($texts['profile_confirm_sell']); ?></a></td>-->
  <td> <a href="?view=profile&action=cancel_auction&auction_id=<? echo($auctions[$i]["id"]); ?>" onclick = "if (! confirm('<? echo($texts['profile_delete_auction_question']); ?>')) { return false; }" class="btn" type="button"  ><?  echo($texts['profile_deny_sell']); ?></a></td>
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
    </p>
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


    <p>
      <?

 $auctions=$gBase->UserAuctions;
$counter=0;

if(count($auctions)>1){



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
    for($i=0; $i<count($auctions)-1; $i++){

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
  <td><? echo(formatPrice($auctions[$i]["min_entity_price"])); ?></td>
  <td><? echo(formatPrice($auctions[$i]["current_entity_price"])); ?></td>
   <?
   if( $auctions[$i]["status"]=="pending" ||  $auctions[$i]["status"]=="preview" ){

      ?>
  <td> <a href="?view=edit_auction&is_auction=yes&auction_id=<? echo($auctions[$i]["id"]); ?>" class="btn" type="button" id="addAuction" ><?  echo($texts['profile_edit_auction']); ?></a></td>
  <td> <a href="?view=profile&action=remove_auction&auction_id=<? echo($auctions[$i]["id"]); ?>#auctions" onclick = "if (! confirm('<? echo($texts['profile_delete_auction_question']); ?>')) { return false; }" class="btn" type="button"  ><?  echo($texts['profile_delete_auction']); ?></a></td>



<?
      }else if( $auctions[$i]["status"]=="scheduled"){

      ?>


  <td colspan="2"><? echo($texts['profile_auction_locked']); ?></td>

<?
      }else if( $auctions[$i]["status"]=="going"){

      ?>


  <td colspan="2"> <a href="?view=profile&action=remove_auction&auction_id=<? echo($auctions[$i]["id"]); ?>#auctions" onclick = "if (! confirm('<? echo($texts['profile_delete_auction_question']); ?>')) { return false; }" class="btn" type="button"  ><?  echo($texts['profile_delete_auction']); ?></a></td>




 <?
      }else if( $auctions[$i]["status"]=="confirmed"){

      ?>
<td> <a href="?from=profile&view=show_full_auction&action=get_auction_details&is_auction=yes&auction_id=<? echo($auctions[$i]["id"]); ?>" class="btn" type="button" id="addAuction" ><?  echo($texts['profile_buyer_details']); ?></a></td>

 <td> <a href="?view=add_rating&action=get_auction_details&auction_id=<? echo($auctions[$i]["id"]); ?>" class="btn" type="button" id="addAuction" ><?  echo($texts['profile_rate_partner']); ?></a></td>

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

    </p>
  </div>

</div>
<!--AUCTIONS-END-->


<!--OFFERS-BEGIN-->
<div id="offers_layer" class="sublayer hide">
      <?

 $auctions=$gBase->UserOffers;

$counter=0;


$auctionToApprove=false;

for($j=0;$j<count($auctions)-1;$j++){

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
        <td><? echo($texts['offer_creation_date']); ?></td>
      <td><? echo($texts['auction_amount']); ?></td>
      <td><? echo($texts['auction_min_entitity_price']); ?></td>
      <td><? echo($texts['auction_buying_location']); ?></td>
      <td><? echo($texts['auction_origin']); ?></td>
      <td></td>
      <td></td>
       <td></td>
    </tr>
    <?
    for($i=0; $i<count($auctions); $i++){

      if( $auctions[$i]["is_auction"]=="no"){
$counter++;

            $metadata=json_decode($auctions[$i]["metadata"], true);
      ?>

<tr>
  <td><? echo(date("d.m.Y", strtotime($auctions[$i]["created"]))); ?></td>
  <td><? echo($auctions[$i]["amount_of_animals"]); ?></td>
  <td><? echo(formatPrice($auctions[$i]["min_entity_price"])); ?></td>
 <td><? echo($auctions[$i]["city"]); ?></td>
    <td><? echo($metadata["auction_origin"]); ?></td>
  <td> <a href="?from=profile&view=show_full_auction&action=get_auction_details&is_auction=yes&auction_id=<? echo($auctions[$i]["id"]); ?>" class="btn" type="button" id="addAuction" ><?  echo($texts['profile_buyer_details']); ?></a></td>
  <td> <a href="?view=profile&action=confirm_auction&is_auction=yes&auction_id=<? echo($auctions[$i]["id"]); ?>" onclick = "if (! confirm('<? echo($texts['profile_confirm_question']); ?>')) { return false; }" class="btn" type="button" ><?  echo($texts['profile_confirm_sell']); ?></a></td>
  <td> <a href="?view=profile&action=cancel_auction&auction_id=<? echo($auctions[$i]["id"]); ?>" onclick = "if (! confirm('<? echo($texts['profile_delete_auction_question']); ?>')) { return false; }" class="btn" type="button"  ><?  echo($texts['profile_deny_sell']); ?></a></td>
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
    echo('<li class="active"><a href="?view=profile&action=get_user_offers&page='.$i.'#offers"  >'.$i.'</a></li>');
  }else{
   echo('<li ><a href="?view=profile&action=get_user_offers&page='.$i.'#offers" >'.$i.'</a></li>');
   }
 }

?>
 
   
  </ul>
</div>

<br/>
 
    </p>
  </div>


  <?
}




?>


<!--OFFERS-End-->


<div id="useroffers_layer">
  <div class="pull-right"><a href="?view=edit_auction&is_auction=no" class="btn" type="button" id="addAuction" ><?  echo($texts['profile_add_offer']); ?></a>
</div>
    <h2><? echo($texts['profile_my_offers']); ?></h2>
    <p>
      <?

 $auctions=$gBase->UserOffers;

$counter=0;
if(count($auctions)>1){

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
    for($i=0; $i<count($auctions)-1; $i++){

      if( $auctions[$i]["is_auction"]=="no" && $auctions[$i]["status"]!="ended"){
$counter++;

            $metadata=json_decode($auctions[$i]["metadata"], true);
      ?>

<tr>
  <td><? echo(date("d.m.Y", strtotime($auctions[$i]["created"]))); ?></td>
  <td><? echo($auctions[$i]["amount_of_animals"]); ?></td>
  <td><? echo(formatPrice($auctions[$i]["min_entity_price"])); ?></td>
 <td><? echo($auctions[$i]["city"]); ?></td>
    <td><? echo($metadata["auction_origin"]); ?></td>

 <?
   if( $auctions[$i]["status"]=="offering" || $auctions[$i]["status"]=="preview"){

      ?>
    <td> <a href="?view=profile&action=remove_auction&auction_id=<? echo($auctions[$i]["id"]); ?>#offers" onclick = "if (! confirm('<? echo($texts['profile_delete_auction_question']); ?>')) { return false; }" class="btn" type="button"  ><?  echo($texts['profile_delete_auction']); ?></a></td>


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
    echo('<li class="active"><a href="?view=profile&action=get_user_offers&page='.$i.'#offers"  >'.$i.'</a></li>');
  }else{
   echo('<li ><a href="?view=profile&action=get_user_offers&page='.$i.'#offers" >'.$i.'</a></li>');
   }
 }

?>
 
   
  </ul>
</div>


  <?
}

if($counter==0){
  
   echo($texts['profile_no_offers']);
  
  }

?>
<br/>
 
    </p>
  </div>


</div>

<!--OFFERS-End-->



  <?
}
?>



<div id="won_auctions_layer" class="sublayer hide" >

     <?
if($gBase->User['is_buyer']=="yes"){
?>


  <div id="won_auctions">
    <h2><? echo($texts['profile_auctions_won']); ?></h2>
    <p>
      <?

$won_auctions=$gBase->UserWonAuctions;
$counter=0;
if(count($won_auctions)>1){

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
    for($i=0; $i<count($won_auctions)-1; $i++){

 if( $won_auctions[$i]["is_auction"]=="yes"){
  $counter++;
?>


<tr>
  <td><? echo($won_auctions[$i]["end_time"]); ?></td>
  <td><? echo($won_auctions[$i]["amount_of_animals"]); ?></td>
  <td><? echo(formatPrice($won_auctions[$i]["current_entity_price"])); ?></td>
  <td><? echo($won_auctions[$i]["city"]); ?></td>
  <td> <a href="?from=profile&view=show_full_auction&action=get_auction_details&is_auction=yes&auction_id=<? echo($won_auctions[$i]["id"]); ?>" class="btn" type="button" id="showAuction" ><?  echo($texts['auction_details']); ?></a></td>
 
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
    </p>
  </div>




</div>


<div id="won_offers_layer" class="sublayer hide" >

<div id="won_offers" >
    <h2><? echo($texts['profile_offers_won']); ?></h2>
    <p>
      <?

$won_auctions=$gBase->UserWonOffers;
$counter=0;
if(count($won_auctions)>1){

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
    for($i=0; $i<count($won_auctions)-1; $i++){
 if( $won_auctions[$i]["is_auction"]=="no"){
$counter++;
?>

<tr>
  <td><? echo($won_auctions[$i]["end_time"]); ?></td>
  <td><? echo($won_auctions[$i]["amount_of_animals"]); ?></td>
  <td><? echo(formatPrice($won_auctions[$i]["current_entity_price"])); ?></td>
  <td><? echo($won_auctions[$i]["city"]); ?></td>
  <td> <a href="?from=profile&view=show_full_auction&action=get_auction_details&is_auction=no&auction_id=<? echo($won_auctions[$i]["id"]); ?>" class="btn" type="button" id="showAuction" ><?  echo($texts['auction_details']); ?></a></td>
 
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
    echo('<li class="active"><a href="?view=profile&action=get_user_won_offers&page='.$i.'#won_offers"  >'.$i.'</a></li>');
  }else{
   echo('<li ><a href="?view=profile&action=get_user_won_offers&page='.$i.'#won_offers" >'.$i.'</a></li>');
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
    </p>
  </div>






<?
}
?>

</div>











<div id="invoices_layer"  class="sublayer hide"> 
      <h2><? echo($texts['profile_my_invoices']); ?></h2>
      
       <p>
      <?

$invoices=$gBase->UserInvoices;
$counter=0;
if(count($invoices)>1){

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
  for($i=0; $i<count($invoices)-1; $i++){
 
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
  <td><? echo(formatPrice($invoices[$i]["total"])); ?></td>
  <td> <a href="?action=get_invoice&invoice_id=<? echo($invoices[$i]["invoice_number"]); ?>" class="btn" type="button" target="_blank"  ><?  echo($texts['profile_get_invoice']); ?></a></td>
 
</tr>

  <?

  }

?>

</table>

<div class="pagination">
  <ul>
<?
  $pages=(int)$invoices["number_of_rows"]/$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"]+1;
  $active=1;
if ($_REQUEST['page']!='') {
  $active=$_REQUEST['page'];
}
 for ($i=1; $i <= $pages; $i++) { 
  if($i==$active){
    echo('<li class="active"><a href="?view=profile&action=get_user_invoices&page='.$i.'#invoices"  >'.$i.'</a></li>');
  }else{
   echo('<li ><a href="?view=profile&action=get_user_invoices&page='.$i.'#invoices" >'.$i.'</a></li>');
   }
 }

?>
 
   
  </ul>
</div>


<?


}else{
   echo($texts['profile_no_invoice']);
  
  }


?>
    </p>

<?

}else{

?>
    <h2><? echo($texts['profile_not_logged_in_headline']); ?></h2>

<p><? echo($texts['profile_not_logged_in']); ?></p>

<?

}
?>

</div>



<script type="text/javascript">


$( document ).ready(function() {
if(window.location.hash.length>2){
  $("#profile .sublayer").hide();

      $("#profile "+window.location.hash+"_layer").show();
      $(window.location.hash+"_link").tab('show');
    }
});


$('#subnavigation a').click(function (e) {
  
  $(this).tab('show');

})

function showSubnavigation(layer){

     

      $("#profile .sublayer").hide();

      $("#profile #"+layer+"_layer").show();
  
}




</script>
