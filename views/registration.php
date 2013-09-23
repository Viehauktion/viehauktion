<div id="registration">


<form>
  <fieldset>
    <legend><? echo($texts['registration_headline']); ?></legend>
    <p><? echo($texts['registration_description']); ?></p>
    
    <div class="alert-error hide"  >
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
<input type="text" id="registration_company" placeholder="<? echo($texts['registration_company']); ?>"><br/>
       <input type="text" id="registration_firstname" placeholder="<? echo($texts['registration_firstname']); ?>"><br/>
        <input type="text" id="registration_lastname" placeholder="<? echo($texts['registration_lastname']); ?>"><br/>
         <input type="text" id="registration_street" placeholder="<? echo($texts['registration_street']); ?>">&nbsp;
           <input type="text" id="registration_number" placeholder="<? echo($texts['registration_number']); ?>"><br/>
             <input type="text" id="registration_postcode" placeholder="<? echo($texts['registration_postcode']); ?>">&nbsp;
            <input type="text"id="registration_city" placeholder="<? echo($texts['registration_city']); ?>"><br/><br/>

   <input type="text"id="registration_phone" placeholder="<? echo($texts['registration_phone']); ?>"><br/>
  <input type="checkbox" id="registration_is_seller">   <span class="help"><? echo($texts['registration_is_seller']); ?><span><br/><br/>
  <input type="checkbox" id="registration_is_buyer">   <span class="help"><? echo($texts['registration_is_buyer']); ?><span><br/><br/>

      <input type="checkbox" id="registration_agb">  <span class="help"><? echo($texts['registration_agb']); ?><span><br/>
   <br/>
    
    
      <input type="checkbox" id="registration_newsletter">   <span class="help"><? echo($texts['registration_newsletter']); ?><span><br/><br/>
   
    <br/><br/>
    <button onclick="return false" class="btn btn-primary" id="registration_submit"><? echo($texts['registration_submit']); ?></button>
  </fieldset>
</form>

</div>





<script type="text/javascript">

$("#registration_submit").click(function(){
	
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
		
		
		  if($("#registration_password_again").val()!=$("#registration_password").val()){
	
		$("#error_message").append('<? echo($texts['registration_error_password_again']); ?><br/>');
		errorflag=true;
		
		}


		if((!$("#registration_is_buyer").is(':checked'))&&(!$("#registration_is_seller").is(':checked'))){
				 
				 
				 
				 $("#error_message").append('<? echo($texts['registration_error_role']); ?><br/>');
		errorflag=true;
				 
				 }
			



			 if(!$("#registration_agb").is(':checked')){
				 
				 
				 
				 $("#error_message").append('<? echo($texts['registration_error_agb']); ?><br/>');
		errorflag=true;
				 
				 }
			
			
		if(errorflag){
				 $(".alert-error").show();
				 return false;
		}else{
			
			
		   $.getJSON("index.php", { "action": "register_user", "view": "registration", "mode":"ajax", "username":$("#registration_username").val(), "email":$("#registration_email").val(), "password":$("#registration_password").val(),"company":$("#registration_company").val(), "firstname":$("#registration_firstname").val(), "lastname":$("#registration_lastname").val(), "street":$("#registration_street").val(), "number":$("#registration_number").val(),  "postcode":$("#registration_postcode").val(), "city":$("#registration_city").val(), "phone":$("#registration_phone").val(), "is_buyer":$("#registration_is_buyer").val(),"is_seller":$("#registration_is_seller").val(), "newsletter":$("#registration_is_newsletter").val(), "sid":"<? echo($_COOKIE["PHPSESSID"]); ?>"},
			
			  function(data){
			 				 session_id=data.conf.session_id;
							 	errorflag=false;
								
								
							  $("#error_message").empty();
							 if(data.error=="USERNAME_ALREADY_REGISTERED"){
								 
				 $("#error_message").append('<? echo($texts['registration_error_username_already_registered']); ?><br/>');
				 errorflag=true;
				 
								 }
								 
							 if(data.error=="EMAIL_ALREADY_REGISTERED"){
								 
				 $("#error_message").append('<? echo($texts['registration_error_email_already_registered']); ?><br/>');
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

