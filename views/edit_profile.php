<div id="edit_profile">


<form>
  <fieldset>
    <legend><? echo($texts['edit_profile_headline']); ?></legend>
    <p><? echo($texts['edit_profile_description']); ?></p>
    
    <div class="alert-error hide"  >
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4><? echo($texts['error']); ?></h4>
 <span id="error_message"></span>
</div>

    <input type="text" id="registration_username" placeholder="<? echo($texts['registration_username']); ?>"  value="<? echo($gBase->User['username']); ?>"><br/>
        <span class="help-block"><? echo($texts['registration_username_hint']); ?></span><br/>
    <input type="text" id="registration_email" placeholder="<? echo($texts['registration_email']); ?>"  value="<? echo($gBase->User['email']); ?>"><br/>
         <br/><br/>
<input type="text" id="registration_company" placeholder="<? echo($texts['registration_company']); ?>" value="<? echo($gBase->User['company']); ?>"><br/>
       <input type="text" id="registration_firstname" placeholder="<? echo($texts['registration_firstname']); ?>" value="<? echo($gBase->User['firstname']); ?>"><br/>
        <input type="text" id="registration_lastname" placeholder="<? echo($texts['registration_lastname']); ?>" value="<? echo($gBase->User['lastname']); ?>"><br/>
         <input type="text" id="registration_street" placeholder="<? echo($texts['registration_street']); ?>" value="<? echo($gBase->UserAddresses[0]['street']); ?>">&nbsp;
           <input type="text" id="registration_number" placeholder="<? echo($texts['registration_number']); ?>"  value="<? echo($gBase->UserAddresses[0]['number']); ?>"><br/>
             <input type="text" id="registration_postcode" placeholder="<? echo($texts['registration_postcode']); ?>" value="<? echo($gBase->UserAddresses[0]['postcode']); ?>">&nbsp;
            <input type="text"id="registration_city" placeholder="<? echo($texts['registration_city']); ?>"  value="<? echo($gBase->UserAddresses[0]['city']); ?>"><br/><br/>

   <input type="text"id="registration_phone" placeholder="<? echo($texts['registration_phone']); ?>"  value="<? echo($gBase->User['phone']); ?>"><br/>
  <input type="checkbox" id="registration_is_seller" <? if($gBase->User['is_seller']=="yes"){ echo('checked="checked"'); } ?> >   <span class="help"><? echo($texts['registration_is_seller']); ?><span><br/><br/>
  <input type="checkbox" id="registration_is_buyer" <? if($gBase->User['is_buyer']=="yes"){ echo('checked="checked"'); } ?> >   <span class="help"><? echo($texts['registration_is_buyer']); ?><span><br/><br/>

    
   <br/>
    
    
      <input type="checkbox" id="registration_newsletter">   <span class="help"><? echo($texts['registration_newsletter']); ?><span><br/><br/>
   
   <br/>
       <br/>
    
   <input type="password"  id="registration_password" placeholder="<? echo($texts['registration_password']); ?>"  ><br/>
    <br/><br/>
    <button onclick="return false" class="btn btn-primary" id="edit_profile_submit"><? echo($texts['edit_profile_submit']); ?></button>
  </fieldset>
</form>

</div>





<script type="text/javascript">

$("#edit_profile_submit").click(function(){
	
	errorflag=false;
	$("#error_message").empty();
	if($("#registration_username").val()==''){
	
		$("#error_message").append('<? echo($texts['registration_error_username']); ?><br/>');
		errorflag=true;

		}
		
	   if($("#registration_email").val()==''){
	
		$("#error_message").append('<? echo($texts['registration_error_email']); ?><br/>');
		errorflag=true;
		
		}
			
        if($("#registration_password").val()==''){
	
		$("#error_message").append('<? echo($texts['registration_error_password']); ?><br/>');
		errorflag=true;
	
		}
		
		



		if((!$("#registration_is_buyer").is(':checked'))&&(!$("#registration_is_seller").is(':checked'))){
				 
				 
				 
				 $("#error_message").append('<? echo($texts['registration_error_role']); ?><br/>');
		errorflag=true;
				 
				 }
			


			
		if(errorflag){
				 $(".alert-error").show();
				 return false;
		}else{
			
			
		   $.getJSON("index.php", { "action": "edit_user", "view": "registration", "mode":"ajax", "username":$("#registration_username").val(), "email":$("#registration_email").val(), "password":$("#registration_password").val(),"company":$("#registration_company").val(), "firstname":$("#registration_firstname").val(), "lastname":$("#registration_lastname").val(), "street":$("#registration_street").val(), "number":$("#registration_number").val(),  "postcode":$("#registration_postcode").val(), "city":$("#registration_city").val(), "phone":$("#registration_phone").val(), "is_buyer":$("#registration_is_buyer").val(),"is_seller":$("#registration_is_seller").val(), "newsletter":$("#registration_is_newsletter").val(), "sid":"<? echo($_COOKIE["PHPSESSID"]); ?>"},
			
			  function(data){
			 				 session_id=data.conf.session_id;
							 	errorflag=false;
								
								
							  $("#error_message").empty();
							 if(data.error=="USERNAME_ALREADY_REGISTERED"){
								 
				 $("#error_message").append('<? echo($texts['registration_error_username_already_registered']); ?><br/>');
				 errorflag=true;
				 
								 }
								 
	 			if(data.error=="WRONG_PASSWORD"){
								 
				 $("#error_message").append('<? echo($texts['edit_profile_error_wrong_password']); ?><br/>');
				 errorflag=true;
				 
								 }


								 
								 
								 
								 if(errorflag){
				 $(".alert-error").show();
				 return false;
		}else{
			 $(".alert-error").hide();
			
			window.open("?view=profile", "_self");
			
			
		}
			 				
						 });
    
		}
					
     
    });
	

</script>

