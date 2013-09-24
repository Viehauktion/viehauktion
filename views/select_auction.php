



	

   <h3><? echo($texts['select_running_headline']); ?></h3>
      <p><? echo($texts['select_running_auction_description']); ?></p>
 <form  class="form-horizontal" method="get"  id="select_running_auction">
      <fieldset>
        <div class="alert-error hide"  >
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <h4><? echo($texts['error']); ?></h4>
          <span id="error_message"></span> 
       </div>
        
      <input type="hidden" name="action" value="<? echo($_form_action); ?>" />
      <input type="hidden" name="view" value="<? echo($_form_view); ?>" />
      <input type="hidden" name="is_auction" value="<? echo($is_auction); ?>" />
        <div class="control-group">
          <label class="control-label" for="state_id"><? echo($texts['state']); ?></label>
          <div class="controls">
            <select name="state_id"  id="state_id" onchange="getPendingCounties()">
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
          <label class="control-label" for="county_id"><? echo($texts['county']); ?></label>
          <div class="controls">
            <select name="county_id"  id="county_id" >
            </select>
          </div>
        </div>
        <button onclick="submitSelectAuctionForm();" class="btn btn-primary" ><? echo($texts['select_running_auction_submit']); ?></button>
      </fieldset>
    </form>




<script type="text/javascript">

function getPendingCounties(){



  $.getJSON("index.php", { "action": "get_pending_auction_counties", "view": "add_address_modal", "mode":"ajax", "state_id":$("#state_id").val(), "is_auction":"<? echo($is_auction); ?>", "sid":"<? echo($_COOKIE["PHPSESSID"]); ?>"},
			
			  				 function(data){
			 				 session_id=data.conf.session_id;
							 	html="";
								$("#county_id").empty();
							for(i=0;i<data.raw_data.length;i++){
								html+='<option value="'+data.raw_data[i].county_id+'" >'+data.raw_data[i].name+'</option>';
								}	
						
			 				$("#county_id").append(html);
						 });
	
	}




	function submitSelectAuctionForm(){


			if($("#county_id").val()!=null){

				$("#select_running_auction").submit();


			}else{

				


				return false;

			}


	}


getPendingCounties();
</script>

