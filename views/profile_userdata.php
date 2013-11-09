<div id="userdata_layer" class="sublayer">


    <div id="about_user" class="span6">
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

     <? echo($texts['registration_stall_label']); ?>:&nbsp;<? echo($gBase->User['stall_nr']); ?><br/>
   

<?
}

if($gBase->User['is_buyer']=="yes"){

?>
  <? echo($texts['registration_hrb_label']); ?>:&nbsp;<? echo($gBase->User['hrb_nr']); ?><br/>
      <? echo($texts['registration_retail_label']); ?>:&nbsp;<? echo($gBase->User['retail_nr']); ?><br/>
     
 <?
}
?>

 <? echo($texts['registration_vat_label']); ?>:&nbsp;<? echo($gBase->User['retail_nr']); ?><br/>

    </p>

    <br/>  <br/>
    <a href="?view=edit_profile" class="btn" type="button" id="editUserdata" ><?  echo($texts['edit_profile_data']); ?></a>
  
    <a href="#changePasswordModal" class="btn" type="button" id="editPassword" data-toggle="modal" ><?  echo($texts['edit_password']); ?></a>
    
</div>


<?
include('profile_ratings.php')

?>
  
  
  </div>