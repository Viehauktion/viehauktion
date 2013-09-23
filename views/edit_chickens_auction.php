<div id="chickens_auction" class="hide">     
  <form  class="form-horizontal" method="get" action="?action=edit_action">
    <fieldset>

      <div class="alert-error hide"  >
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4><? echo($texts['error']); ?></h4>
        <span id="error_message"></span> </div>
     
      
      <input type="hidden" id="auction_id" name="auction_id" value="<? echo($gBase->CurrentAuction['id']); ?>" />
       <input type="hidden" id="start_date" name="start_date" value="<? echo($gBase->CurrentAuction['id']); ?>" />
      <div class="control-group">
        <label class="control-label" for="auction_amount"><? echo($texts['auction_amount']); ?></label>
        <div class="controls">
          <input type="text" id="auction_amount" name="auction_amount" placeholder="<? echo($texts['auction_amount']); ?>">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="auction_min_entitity_price"><? echo($texts['auction_min_entitity_price']); ?></label>
        <div class="controls">
          <input type="text" id="auction_min_entitity_price" name="auction_min_entitity_price" placeholder="">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="auction_origin"><? echo($texts['auction_origin']); ?></label>
        <div class="controls">
          <input type="text" id="auction_origin" name="auction_origin" placeholder="">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="form"><? echo($texts['auction_chickens_form']); ?></label>
        <div class="controls">
          <input type="checkbox" id="form" name="form" />
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="auction_chickens_form_value"><? echo($texts['auction_chickens_form_entity']); ?></label>
        <div class="controls">
          <input type="text" id="auction_chickens_form_value" name="auction_chickens_form_value" placeholder="">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="autoform"><? echo($texts['auction_chickens_autoform']); ?></label>
        <div class="controls">
          <input type="checkbox" id="autoform" name="autoform" />
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="auction_chickens_autoform_value"><? echo($texts['auction_chickens_autoform_entity']); ?></label>
        <div class="controls">
          <input type="text" id="auction_chickens_autoform_value" name="auction_chickens_autoform_value" placeholder="">
        </div>
      </div>
      <span class="help-block"><? echo($texts['auction_chickens_calssification_hint']); ?></span><br/>
      <div class="control-group">
        <label class="control-label" for="auction_chickens_qs"><? echo($texts['auction_chickens_qs']); ?></label>
        <div class="controls">
          <select name="auction_chickens_qs"  id="auction_chickens_qs">
            <option value="yes" ><? echo($texts['yes']); ?></option>
            <option value="no" ><? echo($texts['no']); ?></option>
          </select>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="auction_chickens_samonelle_state"><? echo($texts['auction_chickens_samonelle_state']); ?></label>
        <div class="controls">
          <select name="auction_chickens_samonelle_state"  id="auction_chickens_samonelle_state">
            <option value="0" ><? echo($texts['auction_chickens_samonelle_state_unkown']); ?></option>
            <option value="1" ><? echo($texts['auction_chickens_samonelle_state_1']); ?></option>
            <option value="2" ><? echo($texts['auction_chickens_samonelle_state_2']); ?></option>
            <option value="3" ><? echo($texts['auction_chickens_samonelle_state_3']); ?></option>
          </select>
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="address"><? echo($texts['auction_address']); ?></label>
        <div class="controls">
          <select name="address"  id="address">
            <? 
	  	  for($i=0; $i<count($gBase->UserAddresses); $i++){
		  
		  echo('<option value="'.$gBase->UserAddresses[$i]['id'].'" >'.$gBase->UserAddresses[$i]['street'].' '.$gBase->UserAddresses[$i]['number'].', '.$gBase->UserAddresses[$i]['postcode'].' '.$gBase->UserAddresses[$i]['city'].'</option>'); 
		  
		  }
      ?>
          </select>
          <button onclick="return false" class="btn btn-primary" id="add_auction_address"><? echo($texts['auction_add_address']); ?></button>
        </div>
      </div>
      <span class="help-block"><? echo($texts['auction_address_hint']); ?></span><br/>
      
      
        <div class="control-group">
        <label class="control-label" for="auction_loading_stations_amount"><? echo($texts['auction_loading_stations_amount']); ?></label>
        <div class="controls">
         
          
          <select  name="auction_loading_stations_amount" id="auction_loading_stations_amount">
            <option value="1" >1</option>
            <option value="2" >2</option>
            <option value="3" >3</option>
            <option value="4" >4</option>
            <option value="5" >5</option>
            <option value="6" >6</option>
            <option value="7" >7</option>
            <option value="8" >8</option>
            <option value="9" >9</option>
        
          </select>
        </div>
      </div>
      
            
        <div class="control-group">
        <label class="control-label" for="auction_loading_stations_distance"><? echo($texts['auction_loading_stations_distance']); ?></label>
        <div class="controls">
          <input type="text" name="auction_loading_stations_distance" id="auction_loading_stations_distance" placeholder="" value="0">
        </div>
      </div>
      
         <div class="control-group">
        <label class="control-label" for="auction_loading_stations_vehicle"><? echo($texts['auction_loading_stations_vehicle']); ?></label>
        <div class="controls">
      
          <select name="auction_loading_stations_vehicle" id="auction_loading_stations_vehicle">
            <option value="0" ><? echo($texts['vehicle_1']); ?></option>
            <option value="1" ><? echo($texts['vehicle_2']); ?></option>
            <option value="2" ><? echo($texts['vehicle_3']); ?></option>
            <option value="3" ><? echo($texts['vehicle_4']); ?></option>
          </select>
        </div>
      </div>
      
    
        <div class="control-group">
        <label class="control-label" for="auction_loading_stations_availability"><? echo($texts['auction_loading_stations_availability']); ?></label>
        <div class="controls">
          <input type="text" name="auction_loading_stations_availability" id="auction_loading_stations_availability" placeholder="">
        </div>
      </div>
        <div class="control-group">
        <label class="control-label" for="auction_loading_stations_availability_til"><? echo($texts['auction_loading_stations_availability_til']); ?></label>
        <div class="controls">
          <input type="text" name="auction_loading_stations_availability_til" id="auction_loading_stations_availability_til" placeholder="">
        </div>
      </div>
      

      
      <div class="control-group">
        <label class="control-label" for="auction_additional_informations"><? echo($texts['auction_additional_informations']); ?></label>
        <div class="controls">
          <textarea id="auction_additional_informations" name="auction_additional_informations" rows="3"></textarea>
        </div>
      </div>
      <button onclick="return false" class="btn btn-primary" id="auction_submit"><? echo($texts['registration_submit']); ?></button>
    </fieldset>
  </form>
  
  </div>
  <script type="text/javascript">

$("#chickens_auction #auction_submit").click(function(){
	
	errorflag=false;
	$("#chickens_auction #error_message").empty();
	
		if($("#auction_amount").val()==''){
	
		$("#chickens_auction #error_message").append('<? echo($texts['auction_amount_error']); ?><br/>');
		errorflag=true;

		}
		
	 	if($("#auction_min_entitity_price").val()==''){
	
		$("#chickens_auction #error_message").append('<? echo($texts['auction_min_entitity_price_error']); ?><br/>');
		errorflag=true;

		}
		
	  	if($("#auction_origin").val()==''){
	
		$("#chickens_auction #error_message").append('<? echo($texts['auction_origin_error']); ?><br/>');
		errorflag=true;

		}
		
		if((!$("#form").is(':checked')) &&(!$("#autoform").is(':checked')) ){
	
		$("#auction #error_message").append('<? echo($texts['auction_classification_error']); ?><br/>');
		errorflag=true;

		}
		
		
		if(($("#form").is(':checked')) && $("#auction_chickens_form_value").val()==''){
		
		
		$("#chickens_auction #error_message").append('<? echo($texts['auction_chickens_form_value_error']); ?><br/>');
		errorflag=true;

		}
	 
	 	if(($("#autoform").is(':checked')) && $("#auction_chickens_autoform_value").val()==''){
		
		
		$("#chickens_auction #error_message").append('<? echo($texts['auction_chickens_autoform_value_error']); ?><br/>');
		errorflag=true;

		}
	 
	 
	 	 	if($("#auction_loading_stations_distance").val()==''){
	
		$("#chickens_auction #error_message").append('<? echo($texts['auction_loading_stations_distance_error']); ?><br/>');
		errorflag=true;

		}
		
		
		
	    if($("#auction_loading_stations_availability").val()==''){
	
		$("#chickens_auction #error_message").append('<? echo($texts['auction_loading_stations_availability_error']); ?><br/>');
		errorflag=true;

		}
		
		
		  if($("#auction_loading_stations_availability_til").val()==''){
	
		$("#chickens_auction #error_message").append('<? echo($texts['auction_loading_stations_availability_error']); ?><br/>');
		errorflag=true;

		}
		
	 
	 
			
		if(errorflag){
				 $(".alert-error").show();
				 return false;
		}else{
			
			 $("#chickens_auction form").submit();
		 
    
		}
					
     
    });
	

</script>