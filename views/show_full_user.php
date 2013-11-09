<div id="backend">



<div id="user_layer" class="sublayer">

<div id="user_detail">

    <h2><? echo($texts['backend_user_detail']); ?></h2>
    <p>
 <? echo($texts['registration_company'].": ".$gBase->RawData["user_data"]["company"]); ?><br/>     
<? echo($gBase->RawData["user_data"]["firstname"]." ".$gBase->RawData["user_data"]["lastname"]); ?><br/>
<? echo($texts['registration_phone'].": ".$gBase->RawData["user_data"]["phone"]); ?><br/>
<? echo($texts['registration_email'].": ".$gBase->RawData["user_data"]["email"]); ?><br/>
<br/>

<?
      
 if($gBase->User['role']=="admin"){
?>
<? echo($texts['backend_registered_at'].": ".$gBase->RawData["user_data"]["date"]); ?><br/>
<? echo($texts['backend_last_log_in'].": ".$gBase->RawData["user_data"]["last_login"]); ?><br/>
<br/>

<?
}
?>

<? echo($texts['backend_is_seller'].": ".$texts[$gBase->RawData["user_data"]["is_seller"]]); ?><br/>

<? echo($texts['backend_is_buyer'].": ".$texts[$gBase->RawData["user_data"]["is_buyer"]]); ?><br/>
<br/>

<? echo($texts['registration_hrb_label'].": ".$gBase->RawData["user_data"]["hrb_nr"]); ?><br/>
<? echo($texts['registration_retail_label'].": ".$gBase->RawData["user_data"]["retail_nr"]); ?><br/>
<br/>

<? echo($texts['registration_stall_label'].": ".$gBase->RawData["user_data"]["stall_nr"]); ?><br/>
<? echo($texts['registration_vat_label'].": ".$gBase->RawData["user_data"]["vat_nr"]); ?><br/>
            <?
      if($gBase->User['role']=="admin"){
?>
<? echo($texts['backend_has_newsletter'].": ".$gBase->RawData["user_data"]["is_newsletter"]); ?><br/>
<?

}

?>

<? 
  $status="";
      if($gBase->RawData["user_data"]["active"]==0){
        $status=$texts['backend_not_activated'];
      }elseif ($gBase->RawData["user_data"]["active"]==1) {
        $status=$texts['backend_activated'];
      
      }elseif ($gBase->RawData["user_data"]["active"]==2) {
        $status=$texts['backend_confirmed'];
      }elseif ($gBase->RawData["user_data"]["active"]==3) {

          $status=$texts['backend_deleted'];
      }
 ?>
 <? echo($texts['backend_status'].": ".$status); ?><br/>

    </p>

</div>




<div id="user_addresses">

    <h2><? echo($texts['backend_user_addresses']); ?></h2>
    <p>




      <?

$users=$gBase->RawData["user_addresses"];

if(count($users)>0){

   ?>
  





 <table class="table table-striped span8">
    <tr>
      <td><? echo($texts['registration_street']); ?></td>
      <td><? echo($texts['registration_number']); ?></td>
      <td><? echo($texts['registration_postcode']); ?></td>
      <td><? echo($texts['registration_city']); ?></td>
       <td><? echo($texts['backend_address_type']); ?></td>
      <td></td>
      

    </tr>
    <?

    for($i=0; $i<count($users); $i++){

    
      ?>

    <tr>
      <td><? echo($users[$i]["street"]); ?></td>
      <td><? echo($users[$i]["number"]); ?></td>
      <td><? echo($users[$i]["postcode"]); ?></td>
      <td><? echo($users[$i]["city"]); ?></td>
      <td><? echo($texts["address_".$users[$i]["type"]]); ?></td>
      <td><a href="https://maps.google.de/maps?f=q&source=s_q&hl=de&geocode=&q=<? echo($users[$i]["street"].'+'.$users[$i]["number"].','.$users[$i]["postcode"].'+'.$users[$i]["city"]); ?>" class="btn" type="button" target="_blank" ><?  echo($texts['backend_address_show_on_map']); ?></a></td>
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

     


<div id="user_addresses">

    <h2><? echo($texts['backend_user_files']); ?></h2>
    <p>




      <?

$users=$gBase->RawData["user_files"];

if(count($users)>0){

   ?>
  





 <table class="table table-striped span8">
    <tr>
      <td><? echo($texts['backend_user_files_type']); ?></td>
      <td><? echo($texts['backend_user_files_date']); ?></td>
      <td></td>

    </tr>
    <?

    for($i=0; $i<count($users); $i++){

    
      ?>

    <tr>
      <td><? echo($texts["documents_".$users[$i]["type"]]); ?></td>
      <td><? echo($users[$i]["uploaded"]); ?></td>
      <td><a href="<? echo($GLOBALS["VIEHAUKTION"]["AMAZON"]["DOCUMENTSURL"].$users[$i]["filename"]); ?>" class="btn" type="button" target="_blank" ><?  echo($texts['backend_user_files_download']); ?></a></td>
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

     

      <?

if($gBase->User["role"]=='admin'){

   ?>



<div id="user_ratings_from">

    <h2><? echo($texts['backend_user_ratings_from']); ?></h2>
    <p>




      <?

$users=$gBase->RawData["ratings_from_user"];

if(count($users)>0){

   ?>
  





 <table class="table table-striped span8">
    <tr>
      <td><? echo($texts['backend_rating_points']); ?></td>
      <td><? echo($texts['backend_rating_comment']); ?></td>
      <td><? echo($texts['backend_rating_date']); ?></td>
      <td></td>
    

    </tr>
    <?

    for($i=0; $i<count($users)-1; $i++){

    
      ?>

    <tr>
      <td><? echo($users[$i]["rating"]); ?></td>
      <td><? echo($users[$i]["comment"]); ?></td>
      <td><? echo($users[$i]["date"]); ?></td>

            <?
      if($gBase->User['role']=="admin"){
?>


       <td><a href="?view=show_full_user&action=show_full_user&user_id=<? echo($users[$i]["about_id"]); ?>" class="btn" type="button" target="_blank" ><?  echo($texts['backend_rating_to_about']); ?></a></td>
<?
}else{

echo "<td></td>";
}
  ?>
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

      <?

}

   ?>








<div id="user_ratings_about">

    <h2><? echo($texts['backend_user_ratings_about']); ?></h2>
    <p>




      <?

$users=$gBase->RawData["ratings_about_user"];

if(count($users)>0){

   ?>
  





 <table class="table table-striped span8">
    <tr>
      <td><? echo($texts['backend_rating_points']); ?></td>
      <td><? echo($texts['backend_rating_comment']); ?></td>
      <td><? echo($texts['backend_rating_date']); ?></td>
      <td></td>
    

    </tr>
    <?

    for($i=0; $i<count($users)-1; $i++){

    
      ?>

    <tr>
      <td><? echo($users[$i]["rating"]); ?></td>
      <td><? echo($users[$i]["comment"]); ?></td>
      <td><? echo($users[$i]["date"]); ?></td>
      <?
      if($gBase->User['role']=="admin"){
?>


      <td><a href="?view=show_full_user&action=show_full_user&user_id=<? echo($users[$i]["writer_id"]); ?>" class="btn" type="button"  ><?  echo($texts['backend_rating_to_writer']); ?></a></td>
<?
}else{

echo "<td></td>";
}
  ?>


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





</div>










</div>



