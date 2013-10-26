<div id="loginModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="loginModal" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="aboutUsModalLabel"><? echo($texts['login_headline']); ?></h3>
  </div>
  <div class="modal-body">
    <div id="login">
      <form>
        <fieldset>
          <p><? echo($texts['login_description']); ?></p>
          <div class="alert alert-error hide"  >
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4><? echo($texts['error']); ?></h4>
            <span id="error_message"></span> </div>
          <div class="alert-success hide"  >
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4><? echo($texts['hint']); ?></h4>
            <span id="success_message"></span> </div>
          <input type="text" id="login_identifier" placeholder="<? echo($texts['login_username']); ?>">
          <br/>
          <input type="password" id="login_password"  placeholder="<? echo($texts['registration_password']); ?>">
          <br/>
          <br/>
          <br/>
          <button onclick="return false"  type="submit" class="btn btn-primary" id="login_submit"><? echo($texts['login_submit']); ?></button>
        </fieldset>
      </form>
      <a  href="#" onclick="showRecover(); return false;" >
      <?  echo($texts['login_password_lost']); ?>
      </a>&nbsp;-&nbsp;<a href="?view=registration" >
      <?  echo($texts['login_register']); ?>
      </a> </div>
    <div id="recover" class="hide">
      <form>
        <fieldset>
          <p><? echo($texts['recover_description']); ?></p>
          <div class="alert alert-error hide"  >
            <button type="button" class="close" data-dismiss="alert">&times;</button>
            <h4><? echo($texts['error']); ?></h4>
            <span id="error_message"></span> </div>
          <input type="text" id="recover_identifier" placeholder="<? echo($texts['login_username']); ?>">
          <br/>
          <br/>
          <button onclick="return false"  type="submit" class="btn btn-primary" id="recover_submit"><? echo($texts['recover_submit']); ?></button>
        </fieldset>
      </form>
      <a href="#" onclick="showLogin(); return false;" >
      <?  echo($texts['login_headline']); ?>
      </a>&nbsp;-&nbsp;<a href="?view=registration" >
      <?  echo($texts['login_register']); ?>
      </a> </div>
  </div>
</div>
<script type="text/javascript">

$("#login_submit").click(function(){
	
	errorflag=false;
	$("#login #error_message").empty();
	
		if($("#login_identifier").val()==''){
	
		$("#login #error_message").append('<? echo($texts['login_error_identifier']); ?><br/>');
		errorflag=true;

		}
		
	   if($("#login_password").val()==''){
	
		$("#login #error_message").append('<? echo($texts['login_error_password']); ?><br/>');
		errorflag=true;
		
		}
			
       
			
		if(errorflag){
			
			
				 $("#login .alert-error").show();
				 return false;
		}else{
			
			
		   $.getJSON("index.php", { "action": "login_user", "view": "<? echo($View); ?>", "mode":"ajax", "identifier":$("#login_identifier").val(), "password":$("#login_password").val(), "sid":"<? echo($_COOKIE["PHPSESSID"]); ?>"},
			
			  function(data){
			 				 session_id=data.conf.session_id;
							 	errorflag=false;
								
								
							  $("#login #error_message").empty();
							 if(data.error=="CREDENTIALS_INVALID"){
								 
				 $("#login #error_message").append('<? echo($texts['login_credentials_invalid']); ?><br/>');
				 errorflag=true;
				 
								 }
								 
						
								 
								 
								 
								 if(errorflag){
				 $("#login .alert-error").show();
				 return false;
		}else{
			 $("#login .alert-error").hide();
			
		  window.open("?view=profile", "_self");
			
			
		}
			 				
						 });
    
		}
					
     
    });
	
	
	
	$("#recover_submit").click(function(){
	
	errorflag=false;
	$("#recover #error_message").empty();
	
		if($("#recover_identifier").val()==''){
	
		$("#recover #error_message").append('<? echo($texts['login_error_identifier']); ?><br/>');
		errorflag=true;

		}
		
	
       
			
		if(errorflag){
			
			
				 $("#recover .alert-error").show();
				 return false;
		}else{
			
			
		   $.getJSON("index.php", { "action": "generate_new_password", "view": "<? echo($View); ?>", "mode":"ajax", "identifier":$("#recover_identifier").val(), "sid":"<? echo($_COOKIE["PHPSESSID"]); ?>"},
			
			  function(data){
			 				 session_id=data.conf.session_id;
							 	errorflag=false;
								
								
							  $("#recover  #error_message").empty();
							 if(data.error=="NO_USER"){
								 
									 $("#recover #error_message").append('<? echo($texts['recover_error_no_user']); ?><br/>');
									 errorflag=true;
				 
								 }
								 
						
								 
								 
								 
								 if(errorflag){
				 $("#recover  .alert-error").show();
				 return false;
		}else{
			 $("#recover .alert-error").hide();
			
			
		  		showLogin();
		  
			
				 $("#login #success_message").append('<? echo($texts['recover_success']); ?><br/>');
				  $("#login .alert-success").show();
				 
			
		}
			 				
						 });
    
		}
					
     
    });
	
	
	
	
	function showRecover(){
			$("#login").hide();
		$("#recover").show();
		
		
		}
	function showLogin(){
		
		$("#login").show();
		$("#recover").hide();
		}	

</script>



<div id="changePasswordModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="changePasswordModal" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="aboutUsModalLabel"><? echo($texts['change_password_headline']); ?></h3>
  </div>
  <div class="modal-body">
   
    <div id="change_password" >
      <form>
        <fieldset>
          <p><? echo($texts['change_password_description']); ?></p>
          <div class="alert alert-error hide"  >
            <button type="button"  class="close" data-dismiss="alert">&times;</button>
            <h4><? echo($texts['error']); ?></h4>
            <span id="error_message"></span> </div>
            <input  type="password"  id="change_password_new_password" placeholder="<? echo($texts['change_password_new_password']); ?>">
            <input type="password" id="change_password_new_password_again" placeholder="<? echo($texts['change_password_new_password_again']); ?>">
            <input  type="password" id="change_password_old_password" placeholder="<? echo($texts['change_password_old_password']); ?>">
          <br/>
          <br/>
          <button onclick="return false"  type="submit" class="btn btn-primary" id="change_password_submit"><? echo($texts['change_password_submit']); ?></button>
        </fieldset>
      </form>
      </div>
  </div>
</div>



<script type="text/javascript">
$("#change_password_submit").click(function(){

errorflag=false;
	$("#change_password  #error_message").empty();
	
	
		
	   if($("#change_password_new_password").val()==''){
	
		$("#change_password #error_message").append('<? echo($texts['change_password_error_password']); ?><br/>');
		errorflag=true;
		
	   }


	   if($("#change_password_new_password_again").val()==''){
	
		$("#change_password #error_message").append('<? echo($texts['change_password_error_password_again']); ?><br/>');
		errorflag=true;
		
	   }



	   if($("#change_password_new_password_again").val()!=$("#change_password_new_password").val()){
	
		$("#change_password #error_message").append('<? echo($texts['change_password_error_password_dont_match']); ?><br/>');
		errorflag=true;
		
	   }


	   if($("#change_password_old_password").val()==''){
	
		$("#change_password #error_message").append('<? echo($texts['change_password_error_old_password']); ?><br/>');
		errorflag=true;
		
	   }




		
		if(errorflag){
			
			
				 $("#change_password .alert-error").show();
				 return false;
		}else{
			
			
		   $.getJSON("index.php", { "action": "change_password", "view": "<? echo($View); ?>", "mode":"ajax", "new_password":$("#change_password_new_password").val(), "old_password":$("#change_password_old_password").val(), "sid":"<? echo($_COOKIE["PHPSESSID"]); ?>"},
			
			  function(data){
			 				 session_id=data.conf.session_id;
							 errorflag=false;
								
								
							 $("#recover  #error_message").empty();
							 if(data.error=="WRONG_PASSWORD"){
								 
									 $("#change_password #error_message").append('<? echo($texts['change_password_wrong_password_error']); ?><br/>');
									 errorflag=true;
				 
							}
				
								 
						if(errorflag){
				 					$("#change_password  .alert-error").show();
									 return false;
						    }else{


 								$("#change_password  .alert-error").hide();
			
			 					 $("#changePasswordModal").modal('toggle');
		  						alert("<? echo($texts["change_password_success"]); ?>");

		

			
				 
			
		}
			 				
						 });
		}




	});


</script>



<div id="formsModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="formsModal" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="formsModalLabel"><? echo($texts['modal_forms_headline']); ?></h3>
  </div>
  <div class="modal-body">
<?

echo($texts['forms']);

?>

  </div>
</div>



<div id="imprintModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="imprintModal" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="aboutUsModalLabel"><? echo($texts['modal_imprint_headline']); ?></h3>
  </div>
  <div class="modal-body">
    <p><strong><? echo($texts['page_title']); ?></strong></p>
    <p><? echo($texts['page_organisation']); ?><br />
      <? echo($texts['page_address']); ?>
    <p><? echo($texts['page_phone']); ?><br />
      <? echo($texts['email_label']); ?> <? echo($texts['email_link']); ?></p>
    <p><? echo($texts['page_vat']); ?></p>
    <? echo($texts['google_disclaimer']); ?> </div>
</div>


<script type="text/javascript">


function submitFeedback(){

    
    var name=$("#contact_name").val();
    var email=$("#contact_email").val();
     var message=$("#contact_message").val();
     
     
     if(name==""){
         
         alert("<? echo($texts['contact_name_error']); ?>");
             return;
     }
     
      if(email==""){
         
          alert("<? echo($texts['contact_email_error']); ?>");
         return;
     }
     
     
     var emailCheck=/^[a-z0-9!#$%&'*+/=?^_`{|}~-]+(?:\.[a-z0-9!#$%&'*+/=?^_`{|}~-]+)*@(?:[a-z0-9](?:[a-z0-9-]*[a-z0-9])?\.)+[a-z0-9](?:[a-z0-9-]*[a-z0-9])?$/i;
      
       if(!emailCheck.test(email))
    {
         
         alert("<? echo($texts['contact_email_error']); ?>");
         return;
     }
     
     if(message==""){
         
            alert("<? echo($texts['contact_message_error']); ?>");
         return;
     }
     
     
     
     $.post("contact.php", { "email": email, "name": name, "message":message },
  function(data){
       $('#closeFeedbackBtn').click();
      alert("<? echo($texts['contact_message_success']); ?>");
 
       

  });

    
    
}


</script>

<div id="contactModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" id="closeFeedbackBtn" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="contactLabel"><? echo($texts['modal_contact_headline']); ?></h3>
  </div>
  <div class="modal-body">
    <p class="modalDescription"><? echo($texts['modal_contact_description']); ?></p>
    <h4 class="lefty"><? echo($texts['modal_contact_name']); ?></h4>
    <div class="btn-group">
      <div   class="input-prepend" >
        <input class="frontPage" id="contact_name" type="text"  placeholder="<? echo($texts['modal_contact_name_placeholder']); ?>" value="<? if($gBase->User!=null){ echo($gBase->User["firstname"]." ".$gBase->User["lastname"]); }?>" />
      </div>
    </div>
    <h4 class="lefty"><? echo($texts['modal_contact_email']); ?></h4>
    <div class="btn-group">
      <div   class="input-prepend" >
        <input class="frontPage" id="contact_email" type="text"  placeholder="<? echo($texts['modal_contact_email_placeholder']); ?>" value="<? if($gBase->User!=null){ echo($gBase->User["email"]); }?>" />
      </div>
    </div>
    <h4 class="lefty"><? echo($texts['modal_contact_message']); ?></h4>
    <div class="btn-group">
      <div   class="input-prepend" >
        <textarea rows="3" id="contact_message" class="frontPage"></textarea>
      </div>
    </div>
    <div class="clearfix">
      <button type="button"   class="btn btn-primary" onClick="submitFeedback()" ><? echo($texts['modal_contact_submit']); ?></button>
    </div>
  </div>
</div>



<div id="addAddressModal" class="modal hide fade" tabindex="-1" role="dialog" aria-labelledby="contactLabel" aria-hidden="true">
  <div class="modal-header">
    <button type="button" class="close" id="closeAddAddressBtn" data-dismiss="modal" aria-hidden="true">×</button>
    <h3 id="contactLabel"><? echo($texts['modal_add_address_headline']); ?></h3>
  </div>
  <div class="modal-body">
    <p class="modalDescription"><? echo($texts['modal_add_address_description']); ?></p>
    <form  class="form-horizontal" method="get" action="?action=edit_auction">
      <fieldset>
        <div class="alert alert-error hide"  >
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <h4><? echo($texts['error']); ?></h4>
          <span id="error_message"></span> </div>
        <div class="control-group">
          <label class="control-label" for="state"><? echo($texts['registration_street']); ?></label>
          <div class="controls">
            <input type="text" id="street" placeholder="<? echo($texts['registration_street']); ?>">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="state"><? echo($texts['registration_number']); ?></label>
          <div class="controls">
            <input type="text" id="number" placeholder="<? echo($texts['registration_number']); ?>">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="state"><? echo($texts['registration_postcode']); ?></label>
          <div class="controls">
            <input type="text" id="postcode" placeholder="<? echo($texts['registration_postcode']); ?>">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="state"><? echo($texts['registration_city']); ?></label>
          <div class="controls">
            <input type="text"id="city" placeholder="<? echo($texts['registration_city']); ?>">
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="state"><? echo($texts['state']); ?></label>
          <div class="controls">
            <select name="state"  id="state" onchange="getCounties()">
              <option value="1">Bayern</option>
              <option value="2">Baden-Württemberg</option>
              <option value="3">Rheinland-Pfalz</option>
              <option value="4">Mecklenburg-Vorpommern</option>
              <option value="5">Sachsen-Anhalt</option>
              <option value="6">Brandenburg</option>
              <option value="7" selected="selected" >Niedersachsen</option>
              <option value="8">Schleswig-Holstein</option>
              <option value="9">Nordrhein-Westfalen</option>
              <option value="10">Thüringen</option>
              <option value="11">Hessen</option>
              <option value="12">Sachsen</option>
              <option value="13">Berlin</option>
              <option value="14">Saarland</option>
              <option value="15">Bremen</option>
              <option value="16">Hamburg</option>
            </select>
          </div>
        </div>
        <div class="control-group">
          <label class="control-label" for="county"><? echo($texts['county']); ?></label>
          <div class="controls">
            <select name="county" class="counties"  id="county" >
            </select>
          </div>
        </div>
        <button onclick="return false" class="btn btn-primary" id="add_address_submit"><? echo($texts['registration_submit']); ?></button>
      </fieldset>
    </form>
  </div>
</div>
<script type="text/javascript">


<?
if($View=='edit_auction'){
  ?>

 $.getJSON("index.php", { "action": "get_counties", "view": "add_address_modal", "mode":"ajax", "state_id":"7", "sid":"<? echo($_COOKIE["PHPSESSID"]); ?>"},
			
			  function(data){
			 				 session_id=data.conf.session_id;
							 	html="";
								$(".counties").empty();
							for(i=0;i<data.raw_data.length;i++){
								html+='<option value="'+data.raw_data[i].id+'" >'+data.raw_data[i].name+'</option>';
								}	
						
			 				$(".counties").append(html);
			 				
						 });
<?
}
?>
function getCounties(){



  $.getJSON("index.php", { "action": "get_counties", "view": "add_address_modal", "mode":"ajax", "state_id":$("#state").val(), "sid":"<? echo($_COOKIE["PHPSESSID"]); ?>"},
			
			  function(data){
			 				 session_id=data.conf.session_id;
							 	html="";
								$(".counties").empty();
							for(i=0;i<data.raw_data.length;i++){
								html+='<option value="'+data.raw_data[i].id+'" >'+data.raw_data[i].name+'</option>';
								}	
						
			 				$(".counties").append(html);
						 });
	
	}
	
	
	$("#add_address_submit").click(function(){
		
		 $.getJSON("index.php", { "action": "add_address", "view": "add_address_modal", "mode":"ajax", "street":$("#street").val(), "number":$("#number").val(), "postcode":$("#postcode").val(), "city":$("#city").val(), "state_id":$("#state").val(), "county_id":$("#county").val(), "sid":"<? echo($_COOKIE["PHPSESSID"]); ?>"},
			
			  			function(data){
			 				 session_id=data.conf.session_id;
							
								html="";
							$("#address").empty();
							for(i=0;i<data.user_addresses.length;i++){
								
								if(i==data.user_addresses.length-1){
									html+='<option value="'+data.user_addresses[i].id+'" selected="selected" >'+data.user_addresses[i].street+' '+data.user_addresses[i].number+', '+data.user_addresses[i].postcode+' '+data.user_addresses[i].city+'</option>';
									}else{
								html+='<option value="'+data.user_addresses[i].id+'" >'+data.user_addresses[i].street+' '+data.user_addresses[i].number+', '+data.user_addresses[i].postcode+' '+data.user_addresses[i].city+'</option>';
								}
								
		  
								}	
						
			 				$("#address").append(html);
							$("#closeAddAddressBtn").click();
							
							
							
						 });
		
		});
	

</script> 
