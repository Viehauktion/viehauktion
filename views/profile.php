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
 

  <li><a href="#auctions" id="auctions_link" onclick="showSubnavigation('auctions')"><? echo($texts['profile_my_auctions']); ?></a></li>
  <li><a href="#offers" id="offers_link" onclick="showSubnavigation('offers')"><? echo($texts['profile_my_offers']); ?></a></li>

  <li><a href="#won_auctions" id="won_auctions_link" onclick="showSubnavigation('won_auctions')"><? echo($texts['profile_auctions_won']); ?></a></li>
  <li><a href="#won_offers" id="won_offers_link" onclick="showSubnavigation('won_offers')"><? echo($texts['profile_offers_won']); ?></a></li>
 

  <li><a href="#invoices" id="invoices_link" onclick="showSubnavigation('invoices')"><? echo($texts['profile_my_invoices']); ?></a></li>


</ul>


<?
include("profile_userdata.php");
include("profile_seller_auctions.php");
include("profile_seller_offers.php");
include("profile_buyer_auctions.php");
include("profile_buyer_offers.php");
include("profile_invoices.php");
?>

  
     
















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

 $(".tooltipbtn").tooltip();

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
