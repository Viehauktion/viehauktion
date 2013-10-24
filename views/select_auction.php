
<h3><? echo($texts['select_running_headline']); ?></h3>
      <p><? echo($texts['select_running_auction_description']); ?></p>
 <form  class="form-horizontal" method="get"  id="select_running_auction">
      <fieldset>
        <div class="alert alert-error hide"  >
          <button type="button" class="close" data-dismiss="alert">&times;</button>
          <h4><? echo($texts['error']); ?></h4>
          <span id="error_message"></span> 
       </div>
        
      <input type="hidden" name="action" value="<? echo($_form_action); ?>" />
      <input type="hidden" name="view" value="<? echo($_form_view); ?>" />
      <input type="hidden" name="is_auction" value="<? echo($is_auction); ?>" />
        <div class="control-group" id="states">
          <label class="control-label" for="state_id_for_auction"><? echo($texts['state']); ?></label>
          <div class="controls" >
            <select name="state_id"  id="state_id_for_auction" onchange="getPendingCountiesForAuction()">
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
        <div class="control-group" id="counties">
         
        </div>


        <button onclick="submitSelectAuctionForm();" class="btn btn-primary" id="select_auctions_button" ><? if($is_auction=="yes"){

if($areAuctionsToday){
          echo($texts['select_running_auction_submit']);
}else{
    echo($texts['select_pending_auction_submit']);
}
      }else{ echo($texts['select_filter_offers']);} ?></button>


      </fieldset>
    </form>




<script type="text/javascript">




function getPendingStatesForAuction(){



  $.getJSON("index.php", { "action": "get_pending_auction_states", "view": "add_address_modal", "mode":"ajax", "is_auction":"<? echo($is_auction); ?>", "sid":"<? echo($_COOKIE["PHPSESSID"]); ?>"},
      
                 function(data){
               session_id=data.conf.session_id;
                html="";
                selectedValue="";
              if(data.raw_data!=null){

                 html+='<label class="control-label" for="state_id_for_auction"><? echo($texts['state']); ?></label><div class="controls" ><select name="state_id"  id="state_id_for_auction" onchange="getPendingCountiesForAuction()">';
                
                 for(i=0;i<data.raw_data.length;i++){


                        if(i==0){
                          selectedValue=data.raw_data[i].state_id;

                        }

                        if(data.raw_data[i].state_id=='7'){
                          selectedValue=data.raw_data[i].state_id;
                        }
                        html+='<option value="'+data.raw_data[i].state_id+'"  >'+data.raw_data[i].name+' ('+data.raw_data[i].number_of_auctions+')</option>';

                 }
                html+='</select></div>';

              $("#states").html(html);
          
              $("#state_id_for_auction").val(selectedValue);
              getPendingCountiesForAuction();

                }else{

<? if($is_auction=='yes'){
?>
$("#states").html('<? echo($texts['select_running_no_auctions_at_all']); ?>');
<?
}else{
?>

$("#states").html('<? echo($texts['select_running_no_offers_at_all']); ?>');
<?
}
?>
 $("#select_auctions_button").hide();
                
                  
                }

             });
  
  }





function getPendingCountiesForAuction(){



  $.getJSON("index.php", { "action": "get_pending_auction_counties", "view": "add_address_modal", "mode":"ajax", "state_id":$("#state_id_for_auction").val(), "is_auction":"<? echo($is_auction); ?>", "sid":"<? echo($_COOKIE["PHPSESSID"]); ?>"},
			
			  				 function(data){
			 				 session_id=data.conf.session_id;
							 	html="";

							if(data.raw_data[0].county_id!=null){

           
          
                  html+='<label class="control-label" for="county_id"><? echo($texts['county']); ?></label><div class="controls" ><select name="county_id"  id="county_id_for_auction" >';
            
							for(i=0;i<data.raw_data.length;i++){
								html+='<option value="'+data.raw_data[i].county_id+'" >'+data.raw_data[i].name+' ('+data.raw_data[i].number_of_auctions+')</option>';
								}	
						html+='</select></div>';

			 				$("#counties").html(html);
              $("#select_auctions_button").show();

                }else{

                $("#counties").html('<? echo($texts['select_running_no_auctions']); ?>');
                  $("#select_auctions_button").hide();
                }

						 });
	
	}




	function submitSelectAuctionForm(){


			if($("#county_id").val()!=null){

				$("#select_running_auction").submit();


			}else{

				


				return false;

			}


	}


getPendingStatesForAuction();
</script>

