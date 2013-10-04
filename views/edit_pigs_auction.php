<?php
$category_id=1;
$nextDates=array();

$lDB=connectDB();
      if (!$lDB->failed){

            $auctionCategory=array();
            $auctionCategory=$lDB->getAuctionCategoryById($category_id);
      


            $auctionDays=explode("_",$auctionCategory['days']);
            $additionalDays=0;
            for($i=0;$i<count($auctionDays)-1;$i++){
      

              if($auctionDays[$i]>date("N")){

                $additionalDays=$auctionDays[$i]-date("N");

              }elseif ($auctionDays[$i]==date("N")&&$auctionCategory['start_time']>date("H:i:s",  strtotime("+10 minute"))){

                $additionalDays=0;
                

              }else{

                $additionalDays=$auctionDays[$i]+7-date("N");

              }


                $date=array();
                $date['readable_date']=date("d.m.y", strtotime("+".$additionalDays." day"))." ".$auctionCategory['start_time']." ".$texts['add_auction_time_entity'];
                $date['submitable_date']=date("Y-m-d", strtotime("+".$additionalDays." day"))." ".$auctionCategory['start_time'];
                $date['additional_days']=$additionalDays;

                array_push($nextDates,$date);

              }

                for($i=0;$i<count($nextDates);$i++){

                  for($j=0;$j<count($nextDates);$j++){

                    if($nextDates[$i]['additional_days']<$nextDates[$j]['additional_days']){
                      $tmpDate=$nextDates[$i];
                      $nextDates[$i]=$nextDates[$j];
                      $nextDates[$j]=$tmpDate;


                    }

                  }

                }
              
     }


$oldValues=nil;

    if($_REQUEST['auction_id']!=''){

     for($i=0; $i<count($gBase->UserAuctions); $i++){

        if($_REQUEST['auction_id']==$gBase->UserAuctions[$i]['auction_id']){

               /* $oldValues['auction_id']=$gBase->UserAuctions[$i]['auction_id'];
                $oldValues['category_id']=$gBase->UserAuctions[$i]['category_id'];
                $oldValues['auction_date']=$gBase->UserAuctions[$i]['auction_date'];
                $oldValues['amount_of_animals']=$gBase->UserAuctions[$i]['amount_of_animals'];
                $oldValues['auction_min_entitity_price']=$gBase->UserAuctions[$i]['amount_of_animals'];*/
                
                $oldValues=json_decode($gBase->UserAuctions[$i]['metadata'], true);
             

        }

     }
}


?>


<div id="pigs_auction">     
  <form  class="form-horizontal" id="auction_form" method="get" action="?">
    <fieldset>

      <div class="alert-error hide"  >
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h4><? echo($texts['error']); ?></h4>
        <span id="error_message"></span> </div>

        <input type="hidden" id="action" name="action" value="edit_auction" />
        <input type="hidden" id="view" name="view" value="profile" />
      <input type="hidden" id="category_id" name="category_id" value="<? echo($category_id); ?>" />
      <input type="hidden" id="auction_id" name="auction_id" value="<? echo($_REQUEST['auction_id']); ?>" />
      <input type="hidden" id="is_auction" name="is_auction" value="<? echo($_REQUEST['is_auction']); ?>" />
      <input type="hidden" id="is_preview" name="is_preview" value="" />
      <?
      if($_REQUEST['is_auction']=="yes"){
        ?>



<label class="radio">
  <input type="radio" name="is_main_auction" id="main_auction" value="yes" onclick="changeTime('main');" checked>
  <? echo($texts['auction_main_auction']); ?>
</label>
<label class="radio">
  <input type="radio" name="is_main_auction" id="side_auction" value="no" onclick="changeTime('side');">
  <? echo($texts['auction_side_auction']); ?>
</label>

<br/>
<br/>

  <div class="control-group" id="main_time">
        <label class="control-label" for="auction_date"><? echo($texts['add_auction_date']); ?></label>
        <div class="controls">
          <select name="auction_date"  id="auction_date">
            <?
             for($i=0;$i<count($nextDates);$i++){

              echo('<option value="'.$nextDates[$i]['submitable_date'].'"');

              if($nextDates[$i]['submitable_date']==$oldValues['auction_date']){

                  echo(" selected ");

              }

                echo(' >'.$nextDates[$i]['readable_date'].'</option>');
             }

            ?>
            
      
          </select>
        </div>
      </div>
 <?
     }
        ?>




<div class="hide" id="side_time">
   <div class="control-group">
        <label class="control-label" for="auction_amount"><? echo($texts['add_auction_end']); ?></label>
      <div class="controls">

  <div id="endtime" class="input-append date">
    <input data-format="dd-MM-yyyy hh:mm" name="endtime" type="text"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
  </div>
</div>
 </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="auction_amount"><? echo($texts['auction_amount']); ?></label>
        <div class="controls">
          <input type="text" id="auction_amount" name="auction_amount" placeholder="<? echo($texts['auction_amount_placeholder']);  ?>" value="<? if($oldValues!=nil) echo($oldValues['auction_amount']); ?>" >
        </div>
      </div>

      <div class="control-group">
      
        <label class="control-label" for="auction_min_entitity_price"><? if($_REQUEST['is_auction']=="yes"){ echo($texts['auction_min_entitity_price']);}else{echo($texts['offer_entitity_price']);} ?></label>
        <div class="controls">
          <input type="text" id="auction_min_entitity_price" name="auction_min_entitity_price" placeholder="<? echo($texts['auction_min_entitity_price_placeholer']); ?>" value="<? if($oldValues!=nil) echo($oldValues['auction_min_entitity_price']); ?>" >
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="auction_origin"><? echo($texts['auction_origin']); ?></label>
        <div class="controls">
          <input type="text" id="auction_origin" name="auction_origin" placeholder="<? echo($texts['auction_origin_placeholder']); ?>" value="<? if($oldValues!=nil) echo($oldValues['auction_origin']); ?>">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="form"><? echo($texts['auction_pigs_form']); ?></label>
        <div class="controls">
          <input type="checkbox" id="form" name="form"
<? if($oldValues['form']=="on"){

echo ' checked="checked" ';

}
?>

           />
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="auction_pigs_form_value"><? echo($texts['auction_pigs_form_entity']); ?></label>
        <div class="controls">
          <input type="text" id="auction_pigs_form_value" name="auction_pigs_form_value" placeholder="<? echo($texts['auction_pigs_form_entity_placeholder']); ?>" value="<? if($oldValues!=nil) echo($oldValues['auction_pigs_form_value']); ?>">
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="autoform"><? echo($texts['auction_pigs_autoform']); ?></label>
        <div class="controls">
          <input type="checkbox" id="autoform" name="autoform" />
        </div>
      </div>
      <div class="control-group">
        <label class="control-label" for="auction_pigs_autoform_value"><? echo($texts['auction_pigs_autoform_entity']); ?></label>
        <div class="controls">
          <input type="text" id="auction_pigs_autoform_value" name="auction_pigs_autoform_value" placeholder="<? echo($texts['auction_pigs_autoform_entity_placeholder']); ?>" value="<? if($oldValues!=nil) echo($oldValues['auction_pigs_autoform_value']); ?>">
        </div>
      </div>
      <span class="help-block"><? echo($texts['auction_pigs_calssification_hint']); ?></span><br/>
    










  <div class="control-group">
        <label class="control-label" for="auction_pigs_qs"><? echo($texts['auction_pigs_qs']); ?></label>
        <div class="controls">
          <select name="auction_pigs_qs"  id="auction_pigs_qs">
            <option value="yes" <? if($oldValues['auction_pigs_qs']=="yes"){

echo ' selected="selected" ';

}
?> ><? echo($texts['yes']); ?></option>
            <option value="no" <? if($oldValues['auction_pigs_qs']=="no"){

echo ' selected="selected" ';

}
?> > <? echo($texts['no']); ?></option>
          </select>
        </div>
      </div>


      <div class="control-group">
        <label class="control-label" for="auction_pigs_samonelle_state"><? echo($texts['auction_pigs_samonelle_state']); ?></label>
        <div class="controls">
          <select name="auction_pigs_samonelle_state"  id="auction_pigs_samonelle_state">
            <option value="0"
            <? if($oldValues['auction_pigs_samonelle_state']=="0"){

echo ' selected="selected" ';

}
?> ><? echo($texts['auction_pigs_samonelle_state_unkown']); ?></option>
            <option value="1" <? if($oldValues['auction_pigs_samonelle_state']=="1"){

echo ' selected="selected" ';

}
?>  ><? echo($texts['auction_pigs_samonelle_state_1']); ?></option>
            <option value="2" <? if($oldValues['auction_pigs_samonelle_state']=="2"){

echo ' selected="selected" ';

}
?>  ><? echo($texts['auction_pigs_samonelle_state_2']); ?></option>
            <option value="3" <? if($oldValues['auction_pigs_samonelle_state']=="3"){

echo ' selected="selected" ';

}
?> 

><? echo($texts['auction_pigs_samonelle_state_3']); ?></option>
          </select>
        </div>
      </div>



      <div class="control-group">
        <label class="control-label" for="address"><? echo($texts['auction_address']); ?></label>
        <div class="controls">
          <select name="address"  id="address">
            <? 
        for($i=0; $i<count($gBase->UserAddresses); $i++){
      
            echo('<option');

if($oldValues['address']==$gBase->UserAddresses[$i]['id']){
  echo(' selected="selected" ');

}
            echo(' value="'.$gBase->UserAddresses[$i]['id'].'" >'.$gBase->UserAddresses[$i]['street'].' '.$gBase->UserAddresses[$i]['number'].', '.$gBase->UserAddresses[$i]['postcode'].' '.$gBase->UserAddresses[$i]['city'].'</option>'); 
      
      }
      ?>
          </select>
          <a href="#addAddressModal" role="button"  data-toggle="modal" class="btn btn-primary" id="add_auction_address"><? echo($texts['auction_add_address']); ?></a>
        </div>
      </div>









      <span class="help-block"><? echo($texts['auction_address_hint']); ?></span><br/>
      
      
        <div class="control-group">
        <label class="control-label" for="auction_loading_stations_amount"><? echo($texts['auction_loading_stations_amount']); ?></label>
        <div class="controls">
         
          
          <select  name="auction_loading_stations_amount" id="auction_loading_stations_amount">
            <option value="1" <? if($oldValues['auction_loading_stations_amount']=="1"){

echo (' selected="selected" ');

}
?> >1</option>
            <option value="2" <? if($oldValues['auction_loading_stations_amount']=="2"){

echo (' selected="selected" ');

}
?>  >2</option>
            <option value="3"<? if($oldValues['auction_loading_stations_amount']=="3"){

echo (' selected="selected" ');

}
?> >3</option>
            <option value="4" <? if($oldValues['auction_loading_stations_amount']=="4"){

echo (' selected="selected" ');

}
?>  >4</option>
            <option value="5" <? if($oldValues['auction_loading_stations_amount']=="5"){

echo (' selected="selected" ');

}
?>  >5</option>
            <option value="6"  <? if($oldValues['auction_loading_stations_amount']=="6"){

echo (' selected="selected" ');

}
?> >6</option>
            <option value="7" <? if($oldValues['auction_loading_stations_amount']=="7"){

echo (' selected="selected" ');

}
?> >7</option>
            <option value="8" <? if($oldValues['auction_loading_stations_amount']=="8"){

echo (' selected="selected" ');

}
?> >8</option>
            <option value="9" <? if($oldValues['auction_loading_stations_amount']=="9"){
echo (' selected="selected" ');

}
?> >9</option>
        
          </select>
        </div>
      </div>
      
            
        <div class="control-group">
        <label class="control-label" for="auction_loading_stations_distance"><? echo($texts['auction_loading_stations_distance']); ?></label>
        <div class="controls">
          <input type="text" name="auction_loading_stations_distance" id="auction_loading_stations_distance" placeholder="" value="<? if($oldValues!=nil) echo($oldValues['auction_loading_stations_distance']); ?>">
        </div>
      </div>











      
         <div class="control-group">
        <label class="control-label" for="auction_loading_stations_vehicle"><? echo($texts['auction_loading_stations_vehicle']); ?></label>
        <div class="controls">
      
          <select name="auction_loading_stations_vehicle" id="auction_loading_stations_vehicle">
            <option value="0" <? if($oldValues['auction_loading_stations_vehicle']=="0"){

echo ' selected="selected" ';

}
?>  ><? echo($texts['vehicle_1']); ?></option>
            <option value="1" <? if($oldValues['auction_loading_stations_vehicle']=="1"){

echo ' selected="selected" ';

}
?>  ><? echo($texts['vehicle_2']); ?></option>
            <option value="2"  <? if($oldValues['auction_loading_stations_vehicle']=="2"){

echo ' selected="selected" ';

}
?> ><? echo($texts['vehicle_3']); ?></option>
            <option value="3" <? if($oldValues['auction_loading_stations_vehicle']=="3"){

echo ' selected="selected" ';

}
?>  ><? echo($texts['vehicle_4']); ?></option>
          </select>
        </div>
      </div>
      
    
        <div class="control-group">
        <label class="control-label" for="auction_loading_stations_availability"><? echo($texts['auction_loading_stations_availability']); ?></label>
        <div class="controls">
          <input type="text" name="auction_loading_stations_availability" id="auction_loading_stations_availability" placeholder="<? echo($texts['auction_loading_stations_availability_placeholder']); ?>" value="<? if($oldValues!=nil) echo($oldValues['auction_loading_stations_availability']); ?>">
        </div>
      </div>
        <div class="control-group">
        <label class="control-label" for="auction_loading_stations_availability_til"><? echo($texts['auction_loading_stations_availability_til']); ?></label>
        <div class="controls">
          <input type="text" name="auction_loading_stations_availability_til" id="auction_loading_stations_availability_til" placeholder="<? echo($texts['auction_loading_stations_availability_til_placeholder']); ?>" value="<? if($oldValues!=nil) echo($oldValues['auction_loading_stations_availability_til']); ?>">
        </div>
      </div>
      

      
      <div class="control-group">
        <label class="control-label" for="auction_additional_informations"><? echo($texts['auction_additional_informations']); ?></label>
        <div class="controls">
          <textarea id="auction_additional_informations" name="auction_additional_informations" rows="3"><? if($oldValues!=nil) echo($oldValues['auction_additional_informations']); ?></textarea>
        </div>
      </div>
       <button onclick="return false" class="btn btn-primary" id="auction_preview"><? echo($texts['auction_preview']); ?></button><button onclick="return false" class="btn btn-primary" id="auction_submit"><? echo($texts['auction_submit']); ?></button>
    </fieldset>
  </form>
  
  </div>
  <script type="text/javascript">



        
    $('#endtime').datetimepicker({
      language: 'de-DE'
    });


 picker=$('#endtime').data('datetimepicker');
picker.setLocalDate(new Date());

$("#pigs_auction #auction_preview").click(function(){
      $("#pigs_auction #view").val("show_running_auction");
      $("#pigs_auction #is_preview").val("yes");
      //$("#pigs_auction #auction_form").attr("target", "_blank");
      sendForm();


   });

$("#pigs_auction #auction_submit").click(function(){

      $("#pigs_auction #view").val("profile");
      $("#pigs_auction #is_preview").val("no");
      sendForm();


   });

function changeTime(toTime){

if(toTime=='side'){

  $("#main_time").hide();
  $("#side_time").show();
}else{
  $("#side_time").hide();
  $("#main_time").show();
}

}

function sendForm(){

  


	
	errorflag=false;
	$("#pigs_auction #error_message").empty();
	
		if($("#auction_amount").val()==''){
	
		$("#pigs_auction #error_message").append('<? echo($texts['auction_amount_error']); ?><br/>');
		errorflag=true;

		}
		
	 	if($("#auction_min_entitity_price").val()==''){
	
		$("#pigs_auction #error_message").append('<? echo($texts['auction_min_entitity_price_error']); ?><br/>');
		errorflag=true;

		}
		



	  	if($("#auction_origin").val()==''){
	
		$("#pigs_auction #error_message").append('<? echo($texts['auction_origin_error']); ?><br/>');
		errorflag=true;

		}
		
		if((!$("#form").is(':checked')) &&(!$("#autoform").is(':checked')) ){
	
		$("#pigs_auction #error_message").append('<? echo($texts['auction_classification_error']); ?><br/>');
		errorflag=true;

		}
		
		
		if(($("#form").is(':checked')) && $("#auction_pigs_form_value").val()==''){
		
		
		$("#pigs_auction #error_message").append('<? echo($texts['auction_pigs_form_value_error']); ?><br/>');
		errorflag=true;

		}
	 
	 	if(($("#autoform").is(':checked')) && $("#auction_pigs_autoform_value").val()==''){
		
		
		$("#pigs_auction #error_message").append('<? echo($texts['auction_pigs_autoform_value_error']); ?><br/>');
		errorflag=true;

		}
	 
	 
	 	 	if(($("#auction_loading_stations_amount").val()!="1") && ($("#auction_loading_stations_distance").val()=='')){
	
		$("#pigs_auction #error_message").append('<? echo($texts['auction_loading_stations_distance_error']); ?><br/>');
		errorflag=true;

		}
		
		
		
	    if($("#auction_loading_stations_availability").val()==''){
	
		$("#pigs_auction #error_message").append('<? echo($texts['auction_loading_stations_availability_error']); ?><br/>');
		errorflag=true;

		}
		
		
		  if($("#auction_loading_stations_availability_til").val()==''){
	
		$("#pigs_auction #error_message").append('<? echo($texts['auction_loading_stations_availability_error']); ?><br/>');
		errorflag=true;

		}
		
	 
	 //VALIDATE POINT KOMMA Thing


			
		if(errorflag){
				 $(".alert-error").show();
         $(".alert-error").scrollTop(300)
				 return false;
		}else{
			
			 $("#pigs_auction form").submit();
		 
    
		}
					
     
  }
	

</script>