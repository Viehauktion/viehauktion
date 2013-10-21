<div id="backend">
<h1><? echo($texts['backend_headline']); ?></h1>
<ul id="subnavigation" class="nav nav-tabs">
  <li class="active"><a href="#users" id="users_link" onclick="showSubnavigation('users')"><? echo($texts['backend_user_management']); ?></a></li>
  <li><a href="#auctions" id="auctions_link" onclick="showSubnavigation('auctions')"><? echo($texts['backend_auctions_management']); ?></a></li>
 <li><a href="#offers" id="offers_link" onclick="showSubnavigation('offers')"><? echo($texts['backend_offers_management']); ?></a></li>
</ul>


<div id="users_layer" class="sublayer hide">

<div id="buyer_to_confirm">

    <h2><? echo($texts['backend_buyer_to_confirm']); ?></h2>
    <p>


      <?

$users=$gBase->RawData["buyer_to_confirm"];

if(count($users)>0){

   ?>
  





 <table class="table table-striped span8">
    <tr>
      <td><? echo($texts['registration_company']); ?></td>
      <td><? echo($texts['registration_firstname']); ?></td>
      <td><? echo($texts['registration_lastname']); ?></td>
      <td><? echo($texts['backend_registered_at']); ?></td>
      <td></td>
      <td></td>
       <td></td>

    </tr>
    <?

    for($i=0; $i<count($users)-1; $i++){

    
      ?>

    <tr>
      <td><? echo($users[$i]["company"]); ?></td>
      <td><? echo($users[$i]["firstname"]); ?></td>
      <td><? echo($users[$i]["lastname"]); ?></td>
      <td><? echo($users[$i]["date"]); ?></td>
      <td><a href="?view=show_full_user&action=show_full_user&user_id=<? echo($users[$i]["id"]);?>#users" class="btn" type="button" ><?  echo($texts['show_user']); ?></a></td>
     <td><a href="?view=backend&action=confirm_user&user_id=<? echo($users[$i]["id"]);?>#users" class="btn" type="button" ><?  echo($texts['activate_user']); ?></a></td>
     <td><a href="?view=backend&action=remove_user&user_id=<? echo($users[$i]["id"]);?>#users" class="btn" type="button" ><?  echo($texts['delete_user']); ?></a></td>
    </tr>

      <?

  }

  ?>


</table>



<div class="pagination">
  <ul>
<?
  $pages=(int)$users["number_of_rows"]/$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"]+1;
  $active=1;
if ($_REQUEST['page']!='') {
  $active=$_REQUEST['page'];
}
 for ($i=1; $i <= $pages; $i++) { 
  if($i==$active){
    echo('<li class="active"><a href="?view=backend&action=get_buyer_to_confirm&page='.$i.'#users"  >'.$i.'</a></li>');
  }else{
   echo('<li ><a href="?view=backend&action=get_buyer_to_confirm&page='.$i.'#users" >'.$i.'</a></li>');
   }
 }

?>
 
   
  </ul>
</div>


   <?

  }

  ?>
  
</p>

</div>



<div id="buyer_to_confirm">

    <h2><? echo($texts['backend_latest_user']); ?></h2>
    <p>


      <?

$users=$gBase->RawData["users"];

if(count($users)>0){

   ?>
  





 <table class="table table-striped span8">
    <tr>
      <td><? echo($texts['registration_company']); ?></td>
      <td><? echo($texts['registration_firstname']); ?></td>
      <td><? echo($texts['registration_lastname']); ?></td>
      <td><? echo($texts['backend_seller_buyer']); ?></td>
      <td><? echo($texts['backend_status']); ?></td>
      <td><? echo($texts['backend_registered_at']); ?></td>
      <td></td>
      <td></td>
       <td></td>

    </tr>
    <?

    for($i=0; $i<count($users)-1; $i++){
  
  $status="";
      if($users[$i]["active"]==0){
        $status=$texts['backend_not_activated'];
      }elseif ($users[$i]["active"]==1) {
        $status=$texts['backend_activated'];
      
      }elseif ($users[$i]["active"]==2) {
        $status=$texts['backend_confirmed'];
      }elseif ($users[$i]["active"]==3) {

          $status=$texts['backend_deleted'];
      }
    
      ?>

    <tr>
      <td><? echo($users[$i]["company"]); ?></td>
      <td><? echo($users[$i]["firstname"]); ?></td>
      <td><? echo($users[$i]["lastname"]); ?></td>
      <td><? echo($users[$i]["is_seller"]."/".$users[$i]["is_buyer"]); ?></td>
      <td><? echo($status); ?></td>
      <td><? echo($users[$i]["date"]); ?></td>
      <td><a href="?view=show_full_user&action=show_full_user&user_id=<? echo($users[$i]["id"]);?>" class="btn" type="button" ><?  echo($texts['show_user']); ?></a></td>
      <td><a href="?view=profile&action=imitate_user&user_id=<? echo($users[$i]["id"]);?>" class="btn" type="button" ><?  echo($texts['imitate_user']); ?></a></td>
      <td><a href="?view=backend&action=remove_user&user_id=<? echo($users[$i]["id"]);?>" class="btn" type="button" ><?  echo($texts['delete_user']); ?></a></td>
    </tr>

      <?

  }

  ?>


</table>



<div class="pagination">
  <ul>
<?
  $pages=(int)$users["number_of_rows"]/$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"]+1;
  $active=1;
if ($_REQUEST['page']!='') {
  $active=$_REQUEST['page'];
}
 for ($i=1; $i <= $pages; $i++) { 
  if($i==$active){
    echo('<li class="active"><a href="?view=backend&action=get_user&page='.$i.'#users"  >'.$i.'</a></li>');
  }else{
   echo('<li ><a href="?view=backend&action=get_user&page='.$i.'#users" >'.$i.'</a></li>');
   }
 }

?>
 
   
  </ul>
</div>


   <?

  }

  ?>
  
</p>

</div>

</div>




<div id="auctions_layer" class="sublayer hide">


     <h2><? echo($texts['backend_notpending_auctions']); ?></h2>
    <p>


      <?

$auctions=$gBase->RawData["auctions"];

if(count($auctions)>0){

   ?>
  





 <table class="table table-striped span8">
    <tr>
      <td><? echo($texts['add_auction_date']); ?></td>
      <td><? echo($texts['auction_min_entitity_price']); ?></td>
      <td><? echo($texts['auction_highest_price']); ?></td>
       <td><? echo($texts['backend_status']); ?></td>
      <td><? echo($texts['auction_origin']); ?></td>
      <td></td>

    </tr>
    <?

    for($i=0; $i<count($auctions); $i++){

      $metadata=json_decode($auctions[$i]["metadata"], true);
      ?>

<tr>
  <td><? echo($auctions[$i]["start_time"]); ?></td>
  <td><? echo($auctions[$i]["min_entity_price"]); ?></td>
  <td><? echo($auctions[$i]["current_entity_price"]); ?></td>
  <td><? echo($auctions[$i]["status"]); ?></td>
  <td><? echo($metadata["auction_origin"]); ?></td>
   <td> <a href="?view=show_full_auction&action=get_auction_details&is_auction=yes&auction_id=<? echo($auctions[$i]["id"]); ?>&state_id=<? echo($auctions[$i]["state_id"]); ?>&county_id=<? echo($auctions[$i]["county_id"]); ?>" class="btn" type="button" id="showAuction" ><?  echo($texts['auction_details']); ?></a></td>
 
  </tr>

      <?

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
    echo('<li class="active"><a href="?view=backend&action=get_finished_auctions&page='.$i.'#auctions"  >'.$i.'</a></li>');
  }else{
   echo('<li ><a href="?view=backend&action=get_finished_auctions&page='.$i.'#auctions" >'.$i.'</a></li>');
   }
 }

?>
 
   
  </ul>
</div>


   <?

  }

  ?>
  
</p>


 </div> 





<div id="offers_layer" class="sublayer hide">


     <h2><? echo($texts['backend_notpending_auctions']); ?></h2>
    <p>


      <?

$auctions=$gBase->RawData["offers"];

if(count($auctions)>0){

   ?>
  





 <table class="table table-striped span8">
    <tr>
      <td><? echo($texts['add_auction_date']); ?></td>
      <td><? echo($texts['auction_min_entitity_price']); ?></td>
      <td><? echo($texts['auction_highest_price']); ?></td>
       <td><? echo($texts['backend_status']); ?></td>
      <td><? echo($texts['auction_origin']); ?></td>
      <td></td>

    </tr>
    <?

    for($i=0; $i<count($auctions); $i++){

      $metadata=json_decode($auctions[$i]["metadata"], true);
      ?>

<tr>
  <td><? echo($auctions[$i]["start_time"]); ?></td>
  <td><? echo($auctions[$i]["min_entity_price"]); ?></td>
  <td><? echo($auctions[$i]["current_entity_price"]); ?></td>
  <td><? echo($auctions[$i]["status"]); ?></td>
  <td><? echo($metadata["auction_origin"]); ?></td>
   <td> <a href="?view=show_full_auction&action=get_auction_details&is_auction=no&auction_id=<? echo($auctions[$i]["id"]); ?>&state_id=<? echo($auctions[$i]["state_id"]); ?>&county_id=<? echo($auctions[$i]["county_id"]); ?>" class="btn" type="button" id="showAuction" ><?  echo($texts['auction_details']); ?></a></td>
 
  </tr>

      <?

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
    echo('<li class="active"><a href="?view=backend&action=get_finished_offers&page='.$i.'#offers"  >'.$i.'</a></li>');
  }else{
   echo('<li ><a href="?view=backend&action=get_finished_offers&page='.$i.'#offers" >'.$i.'</a></li>');
   }
 }

?>
 
   
  </ul>
</div>


   <?

  }

  ?>
  
</p>


 </div> 




</div>




<script type="text/javascript">


$( document ).ready(function() {
if(window.location.hash.length>2){
  $("#backend .sublayer").hide();

      $("#backend "+window.location.hash+"_layer").show();
      $(window.location.hash+"_link").tab('show');
    }
});


$('#subnavigation a').click(function (e) {
  
  $(this).tab('show');

})

function showSubnavigation(layer){

     

      $("#backend .sublayer").hide();

      $("#backend #"+layer+"_layer").show();
  
}




</script>

