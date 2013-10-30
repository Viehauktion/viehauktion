<div id="edit_profile">

<legend>
    <h2><? echo($texts['edit_profile_headline']); ?></h2>
</legend>
 <p><? echo($texts['edit_profile_description']); ?></p>
<form method="post" action="?" enctype="multipart/form-data" >
  <fieldset>

   
    
    <div class="alert alert-error hide"  >
  <button type="button" class="close" data-dismiss="alert">&times;</button>
  <h4><? echo($texts['error']); ?></h4>
 <span id="error_message"></span>
</div>

<input type="hidden" name="action" value="edit_user" />
<input type="hidden" name="view" value="profile" />

  <input type="checkbox" id="registration_is_seller" onclick="toggleSeller();" name="is_seller"  <? if($gBase->User['is_seller']=="yes"){ echo('checked="checked"'); } ?> >   <span class="help"><? echo($texts['registration_is_seller']); ?><span><br/><br/>
  <input type="checkbox" id="registration_is_buyer" onclick="toggleBuyer();" name="is_buyer"  <? if($gBase->User['is_buyer']=="yes"){ echo('checked="checked"'); } ?> >   <span class="help"><? echo($texts['registration_is_buyer']); ?><span><br/><br/>
<h4><? echo($texts['registration_account']); ?></h4>
    <input type="text" id="registration_email" name="email" placeholder="<? echo($texts['registration_email']); ?>" value="<? echo($gBase->User['email']); ?>"><br/>
 <hr>    
<h4><? echo($texts['registration_address']); ?></h4>


	<input type="text" id="registration_company" name="company" placeholder="<? echo($texts['registration_company']); ?>" value="<? echo($gBase->User['company']); ?>"><br/>
    <input type="text" id="registration_firstname" name="firstname" placeholder="<? echo($texts['registration_firstname']); ?>" value="<? echo($gBase->User['firstname']); ?>"><br/>
        <input type="text" id="registration_lastname" name="lastname" placeholder="<? echo($texts['registration_lastname']); ?>" value="<? echo($gBase->User['lastname']); ?>"><br/>
         <input type="text" id="registration_street" name="street" placeholder="<? echo($texts['registration_street']); ?>" value="<? echo($gBase->UserAddresses[0]['street']); ?>" >&nbsp;
           <input type="text" id="registration_number" name="number" placeholder="<? echo($texts['registration_number']); ?>" value="<? echo($gBase->UserAddresses[0]['number']); ?>"><br/>
             <input type="text" id="registration_postcode" name="postcode" placeholder="<? echo($texts['registration_postcode']); ?>" value="<? echo($gBase->UserAddresses[0]['postcode']); ?>">&nbsp;
            <input type="text"id="registration_city" name="city" placeholder="<? echo($texts['registration_city']); ?>" value="<? echo($gBase->UserAddresses[0]['city']); ?>"><br/><br/>


<table>
      <tr><td>
  
          <label class="control-label" for="state"><? echo($texts['state']); ?>:</label>
           </td><td class="rightSide">
         
            <select name="state"  id="state" onchange="getCounties()">
              <option value="1" <? if($gBase->UserAddresses[0]['state_id']=='1') echo('selected="selected"'); ?> >Bayern</option>
              <option value="2" <? if($gBase->UserAddresses[0]['state_id']=='2') echo('selected="selected"'); ?> >Baden-Württemberg</option>
              <option value="3" <? if($gBase->UserAddresses[0]['state_id']=='3') echo('selected="selected"'); ?> >Rheinland-Pfalz</option>
              <option value="4" <? if($gBase->UserAddresses[0]['state_id']=='4') echo('selected="selected"'); ?> >Mecklenburg-Vorpommern</option>
              <option value="5" <? if($gBase->UserAddresses[0]['state_id']=='5') echo('selected="selected"'); ?> >Sachsen-Anhalt</option>
              <option value="6" <? if($gBase->UserAddresses[0]['state_id']=='6') echo('selected="selected"'); ?> >Brandenburg</option>
              <option value="7"  <? if($gBase->UserAddresses[0]['state_id']=='7') echo('selected="selected"'); ?>  >Niedersachsen</option>
              <option value="8" <? if($gBase->UserAddresses[0]['state_id']=='8') echo('selected="selected"'); ?> >Schleswig-Holstein</option>
              <option value="9" <? if($gBase->UserAddresses[0]['state_id']=='9') echo('selected="selected"'); ?> >Nordrhein-Westfalen</option>
              <option value="10" <? if($gBase->UserAddresses[0]['state_id']=='10') echo('selected="selected"'); ?> >Thüringen</option>
              <option value="11" <? if($gBase->UserAddresses[0]['state_id']=='11') echo('selected="selected"'); ?> >Hessen</option>
              <option value="12" <? if($gBase->UserAddresses[0]['state_id']=='12') echo('selected="selected"'); ?> >Sachsen</option>
              <option value="13" <? if($gBase->UserAddresses[0]['state_id']=='13') echo('selected="selected"'); ?> >Berlin</option>
              <option value="14" <? if($gBase->UserAddresses[0]['state_id']=='14') echo('selected="selected"'); ?> >Saarland</option>
              <option value="15" <? if($gBase->UserAddresses[0]['state_id']=='15') echo('selected="selected"'); ?> >Bremen</option>
              <option value="16" <? if($gBase->UserAddresses[0]['state_id']=='16') echo('selected="selected"'); ?> >Hamburg</option>
            </select>
         </td></tr>
	<tr><td>
          <label class="control-label" for="county"><? echo($texts['county']); ?>:</label>
          </td><td class="rightSide">            
          <select name="county" class="counties"  id="county" >
            </select>
        </td></tr>
      
     </table>

<table>

<script type="text/javascript">

countyid='<? echo($gBase->UserAddresses[0]['county_id']); ?>';





  $.getJSON("index.php", { "action": "get_counties", "view": "add_address_modal", "mode":"ajax", "state_id":'<? echo($gBase->UserAddresses[0]['state_id']); ?>', "sid":"<? echo($_COOKIE["PHPSESSID"]); ?>"},
			
			  function(data){
			 				 session_id=data.conf.session_id;
							 	html="";
								$(".counties").empty();
							for(i=0;i<data.raw_data.length;i++){
								html+='<option value="'+data.raw_data[i].id+'"';

								if(countyid==data.raw_data[i].id){
									html+='selected="selected"';
								}

								html+='>'+data.raw_data[i].name+'</option>';
								}	
						
			 				$(".counties").append(html);
						 });
	
	

</script>

	<tr><td>
<p><? echo($texts['registration_phone_label']); ?>:</p>
</td><td class="rightSide">
   <input type="text"id="registration_phone" name="phone" placeholder="<? echo($texts['registration_phone']); ?>" value="<? echo($gBase->User['phone']); ?>"><br/>
 </td></tr> 
</table>
<hr>
<h4><? echo($texts['registration_business']); ?></h4>
<div id="buyer_mandantory" <? if($gBase->User['is_buyer']=="no"){ echo('class="hide"'); } ?> >
<p> <? echo($texts['registration_insurance']); ?></p>


<input id="insureance" name="insurance" type="file" style="display:none">


<table>
	<tr><td>
<p><? echo($texts['registration_insurance_label']); ?>:</p>
</td><td class="rightSide">	

<div class="input-append">
<input id="filePreview" class="input-large" type="text">
<a class="btn" onclick="$('input[id=insureance]').click();"><? echo($texts['registration_browse']); ?></a>
</div><br/>
<script type="text/javascript">
$('input[id=insureance]').change(function() {
$('#filePreview').val($(this).val());
});
</script>
 </td></tr> 
	<tr><td>
<p><? echo($texts['registration_hrb_label']); ?>:</p>
</td><td class="rightSide">
 <input type="text" id="registration_hrb_nr" name="hrb_nr" placeholder="<? echo($texts['registration_hrb']); ?>" value="<? echo($gBase->User['hrb_nr']); ?>"><br/>
 </td></tr> 
 <tr><td>
  <p><? echo($texts['registration_retail_label']); ?>:</p>
</td><td class="rightSide">
  <input type="text" id="registration_retail_nr" name="retail_nr" placeholder="<? echo($texts['registration_retail']); ?>" value="<? echo($gBase->User['retail_nr']); ?>"><br/>
 </td></tr> 
</table>


</div>
<div id="seller_mandantory" <? if($gBase->User['is_seller']=="no"){ echo('class="hide"'); } ?> >

   <p> <? echo($texts['registration_seller_mandatory']); ?></p>
   <table>
	<tr><td>
<p><? echo($texts['registration_stall_label']); ?>:</p>
		</td><td class="rightSide">
   <input type="text"id="registration_stall_nr" name="stall_nr" placeholder="<? echo($texts['registration_stall']); ?>" value="<? echo($gBase->User['stall_nr']); ?>"><br/>
 </td></tr> 
 </table>
 
</div>

<table>
	<tr><td>
<p><? echo($texts['registration_vat_label']); ?>:</p>
		</td><td class="rightSide">
  <input type="text"id="registration_vat_nr" name="vat_nr" placeholder="<? echo($texts['registration_vat']); ?>" value="<? echo($gBase->User['vat_nr']); ?>"><br/>
 </td></tr> 
 </table>

      <br/>
      <input type="checkbox" id="registration_newsletter" name="newsletter">   <span class="help"><? echo($texts['registration_newsletter']); ?><span><br/><br/>
      <br/>
       <br/>
    
   <input type="password"  id="registration_password" name="password" placeholder="<? echo($texts['registration_password']); ?>"  ><br/>
    <br/><br/>
    <button  class="btn btn-primary"  id="edit_profile_submit" ><? echo($texts['edit_profile_submit']); ?></button>
  </fieldset>
</form>


</div>





<script type="text/javascript">



var is_buyer=false;
<? if($gBase->User['is_buyer']=="yes"){
echo('is_buyer=true');
}?>


var is_seller=false;
<? if($gBase->User['is_seller']=="yes"){
echo('is_seller=true');
}?>


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



$("#edit_profile_submit").click(function(){
	
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





		

			
		if(errorflag){
				 $(".alert-error").show();
				 $(document).scrollTop(0);
				 return false;
		}		
     
    });
	

</script>

