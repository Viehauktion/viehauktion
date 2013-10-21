<div id="registration">


<form method="post" action="?" enctype="multipart/form-data" >
  <fieldset>
    <legend><? echo($texts['registration_headline']); ?></legend>
    <p><? echo($texts['registration_description']); ?></p>
    
    <div class="alert alert-error hide"  >
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4><? echo($texts['error']); ?></h4>
 <span id="error_message"></span>
</div>

<input type="hidden" name="action" value="register_user" />
<input type="hidden" name="view" value="profile" />

  <input type="checkbox" id="registration_is_seller" onclick="toggleSeller();" name="is_seller" >   <span class="help"><? echo($texts['registration_is_seller']); ?><span><br/><br/>
  <input type="checkbox" id="registration_is_buyer" onclick="toggleBuyer();" name="is_buyer" >   <span class="help"><? echo($texts['registration_is_buyer']); ?><span><br/><br/>
<h4><? echo($texts['registration_account']); ?></h4>
    <input type="text" id="registration_email" name="email" placeholder="<? echo($texts['registration_email']); ?>"><br/>
     <input type="password"  id="registration_password" name="password" placeholder="<? echo($texts['registration_password']); ?>"><br/>
      <input type="password"  id="registration_password_again" placeholder="<? echo($texts['registration_password_again']); ?>"><br/>
     
<h4><? echo($texts['registration_address']); ?></h4>


	<input type="text" id="registration_company" name="company" placeholder="<? echo($texts['registration_company_optional']); ?>"><br/>
    <input type="text" id="registration_firstname" name="firstname" placeholder="<? echo($texts['registration_firstname']); ?>"><br/>
        <input type="text" id="registration_lastname" name="lastname" placeholder="<? echo($texts['registration_lastname']); ?>"><br/>
         <input type="text" id="registration_street" name="street" placeholder="<? echo($texts['registration_street']); ?>">&nbsp;
           <input type="text" id="registration_number" name="number" placeholder="<? echo($texts['registration_number']); ?>"><br/>
             <input type="text" id="registration_postcode" name="postcode" placeholder="<? echo($texts['registration_postcode']); ?>">&nbsp;
            <input type="text"id="registration_city" name="city" placeholder="<? echo($texts['registration_city']); ?>"><br/><br/>

   <input type="text"id="registration_phone" name="phone" placeholder="<? echo($texts['registration_phone']); ?>"><br/>

<h4><? echo($texts['registration_business']); ?></h4>
<div id="buyer_mandantory" class="hide">
<p> <? echo($texts['registration_insurance']); ?></p>


<input id="insureance" name="insurance" type="file" style="display:none">


<div class="input-append">
<input id="filePreview" class="input-large" type="text">
<a class="btn" onclick="$('input[id=insureance]').click();"><? echo($texts['registration_browse']); ?></a>
</div><br/>
<script type="text/javascript">
$('input[id=insureance]').change(function() {
$('#filePreview').val($(this).val());
});
</script>

 <input type="text" id="registration_hrb_nr" name="hrb_nr" placeholder="<? echo($texts['registration_hrb']); ?>"><br/>
  <input type="text" id="registration_retail_nr" name="retail_nr" placeholder="<? echo($texts['registration_retail']); ?>"><br/>



</div>
<div id="seller_mandantory" class="hide">

   <p> <? echo($texts['registration_seller_mandatory']); ?></p>
   <input type="text"id="registration_stall_nr" name="stall_nr" placeholder="<? echo($texts['registration_stall']); ?>"><br/>

 
</div>


  <input type="text" id="registration_vat_nr" name="vat_nr" placeholder="<? echo($texts['registration_vat']); ?>"><br/>
<br/>
      <input type="checkbox" id="registration_agb">   <span class="help"><? echo($texts['registration_agb']); ?><span><br/>
   <br/>
    <p><? echo($texts['registration_newsletter_hint']); ?></p>
      <br/>
      <input type="checkbox" id="registration_newsletter" name="newsletter">   <span class="help"><? echo($texts['registration_newsletter']); ?><span><br/><br/>
   
    <br/><br/>
    <button  class="btn btn-primary" id="registration_submit" ><? echo($texts['registration_submit']); ?></button>
  </fieldset>
</form>

</div>





<script type="text/javascript">

var is_buyer=false;
var is_seller=false;

function toggleSeller(){

	if(is_seller){

		is_seller=false;
		$("#seller_mandantory").hide();

	}else{

		is_seller=true;
		$("#seller_mandantory").show();
	}


}

function toggleBuyer(){

	if(is_buyer){

		is_buyer=false;
		$("#buyer_mandantory").hide();

	}else{

		is_buyer=true;
		$("#buyer_mandantory").show();
	}

}


$("#registration_submit").click(function(){
	
	errorflag=false;
	$("#error_message").empty();
	

		if((!$("#registration_is_buyer").is(':checked'))&&(!$("#registration_is_seller").is(':checked'))){
				 
				 
				 
		$("#error_message").append('<? echo($texts['registration_error_role']); ?><br/>');
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



		if($("#registration_firstname").val()==''){
	
		$("#error_message").append('<? echo($texts['registration_error_firstname']); ?><br/>');
		errorflag=true;
	
		}
		if($("#registration_lastname").val()==''){
	
		$("#error_message").append('<? echo($texts['registration_error_lastname']); ?><br/>');
		errorflag=true;
	
		}
		if($("#registration_street").val()==''){
	
		$("#error_message").append('<? echo($texts['registration_error_street']); ?><br/>');
		errorflag=true;
	
		}
		if($("#registration_number").val()==''){
	
		$("#error_message").append('<? echo($texts['registration_error_number']); ?><br/>');
		errorflag=true;
	
		}
		if($("#registration_postcode").val()==''){
	
		$("#error_message").append('<? echo($texts['registration_error_postcode']); ?><br/>');
		errorflag=true;
	
		}

		if($("#registration_city").val()==''){
	
		$("#error_message").append('<? echo($texts['registration_error_city']); ?><br/>');
		errorflag=true;
	
		}

		if($("#registration_vat").val()==''){
	
		$("#error_message").append('<? echo($texts['registration_error_vat']); ?><br/>');
		errorflag=true;
	
		}



		if(is_buyer){
				if($("#filePreview").val()==''){
			
				$("#error_message").append('<? echo($texts['registration_error_insurance']); ?><br/>');
				errorflag=true;
			
				}

				if($("#registration_hrb_nr").val()==''){
	
				$("#error_message").append('<? echo($texts['registration_error_hrb_nr']); ?><br/>');
				errorflag=true;
	
				}

				if($("#registration_retail_nr").val()==''){
	
				$("#error_message").append('<? echo($texts['registration_error_retail_nr']); ?><br/>');
				errorflag=true;
	
				}

		}

	if(is_seller){
				

				if($("#registration_stall_nr").val()==''){
	
				$("#error_message").append('<? echo($texts['registration_error_stall_nr']); ?><br/>');
				errorflag=true;
	
				}

		}





		



			 if(!$("#registration_agb").is(':checked')){
				 
				 
				 
				 $("#error_message").append('<? echo($texts['registration_error_agb']); ?><br/>');
		errorflag=true;
				 
				 }
			
			
		if(errorflag){
				 $(".alert-error").show();

    			$(document).scrollTop(0);
				 return false;
		}
					
     
    });
	

</script>

