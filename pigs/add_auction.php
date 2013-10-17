<div id="addAuction">


<form>
  <fieldset>
    <legend><? echo($texts['add_auction_headline']); ?></legend>
    <p><? echo($texts['add_auction_description']); ?></p>
    
    <div class="alert alert-error hide"  >
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4><? echo($texts['error']); ?></h4>
 <span id="error_message"></span>
</div>

    <input type="text" id="registration_username" placeholder="<? echo($texts['registration_username']); ?>"><br/>
        <span class="help-block"><? echo($texts['registration_username_hint']); ?></span><br/>
    <input type="text" id="registration_email" placeholder="<? echo($texts['registration_email']); ?>"><br/>
     <input type="password"  id="registration_password" placeholder="<? echo($texts['registration_password']); ?>"><br/>
      <input type="password"  id="registration_password_again" placeholder="<? echo($texts['registration_password_again']); ?>"><br/>
      <br/><br/>

       <input type="text" id="registration_firstname" placeholder="<? echo($texts['registration_firstname']); ?>"><br/>
        <input type="text" id="registration_lastname" placeholder="<? echo($texts['registration_lastname']); ?>"><br/>
         <input type="text" id="registration_street" placeholder="<? echo($texts['registration_street']); ?>">&nbsp;
           <input type="text" id="registration_number" placeholder="<? echo($texts['registration_number']); ?>"><br/>
             <input type="text" id="registration_postcode" placeholder="<? echo($texts['registration_postcode']); ?>">&nbsp;
            <input type="text"id="registration_city" placeholder="<? echo($texts['registration_city']); ?>"><br/>

  
      <input type="checkbox" id="registration_agb">  <span class="help"><? echo($texts['registration_agb']); ?><span><br/>
   <br/>
    
    
      <input type="checkbox" id="registration_newsletter">   <span class="help"><? echo($texts['registration_newsletter']); ?><span><br/><br/>
   
    <br/><br/>
    <button onclick="return false" class="btn btn-primary" id="registration_submit"><? echo($texts['registration_submit']); ?></button>
  </fieldset>
</form>

</div>



