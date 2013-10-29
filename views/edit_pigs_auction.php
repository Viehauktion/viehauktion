<?php

$nextDates=getNextAuctions(1);


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


<div id="pigs_auction" class="span9">     
  <form  class="form-horizontal" id="auction_form" method="get" action="?">
 

      <div class="alert alert-error hide"  >
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h3><? echo($texts['error']); ?></h3>
        <span id="error_message"></span> </div>

        <input type="hidden" id="action" name="action" value="edit_auction" />
        <input type="hidden" id="view" name="view" value="profile" />
      <input type="hidden" id="category_id" name="category_id" value="1" />
      <input type="hidden" id="auction_id" name="auction_id" value="<? echo($_REQUEST['auction_id']); ?>" />
      <input type="hidden" id="is_auction" name="is_auction" value="<? echo($_REQUEST['is_auction']); ?>" />
       <input type="hidden" id="is_main_auction" name="is_main_auction" value="yes" />
      <input type="hidden" id="is_preview" name="is_preview" value="" />
    <div id="auction_main_data"> 
  <h3><? echo($texts['edit_auction_main_data_headline']); ?></h3>
      <?
      if($_REQUEST['is_auction']=="yes"){
        ?>



<!--<label class="radio">
  <input type="radio" name="is_main_auction" id="main_auction" value="yes" onclick="changeTime('main');" checked>
  <? echo($texts['auction_main_auction']); ?>
</label>
<label class="radio">
  <input type="radio" name="is_main_auction" id="side_auction" value="no" onclick="changeTime('side');">
  <? echo($texts['auction_side_auction']); ?>
</label>
-->

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
    <input data-format="dd-MM-yyyy hh:mm" name="endtime" id="endtime" type="text"></input>
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

<? if($_REQUEST['is_auction']=="yes"){
  
  ?>


      <div class="control-group">
      
        <label class="control-label" for="auction_min_entitity_price"><? echo($texts['auction_min_entitity_price']); ?></label>
        <div class="controls">
          <input type="text" id="auction_min_entitity_price" name="auction_min_entitity_price" placeholder="<? echo($texts['auction_min_entitity_price_placeholer']); ?>" value="<? if($oldValues!=nil) echo($oldValues['auction_min_entitity_price']); ?>" >
        </div>
      </div>


<?
}else{

            $vezgDates=array();

            $vezgday=5;
   
            $additionalDays=0;
            $difference=$vezgday-date("N");
            
            if($difference<0){
              $difference+=7;
            }

            $additionalDays=$difference;


            for($i=-1; $i<2;$i++){
                $nextdays=$additionalDays+($i*7);
                  $date=array();

                if($nextdays<0){
                  
                    $date["readable_date"]=date("d.m.Y", strtotime("-".(($nextdays)*(-1))." day"));
                    $date["submitable_date"]=date("Y-m-d", strtotime("-".(($nextdays)*(-1))." day"))." 00:00:00";
               

               
                }else{
                   
                    $date["readable_date"]=date("d.m.Y", strtotime("+".$nextdays." day"));
                    $date["submitable_date"]=date("Y-m-d", strtotime("+".$nextdays." day"))." 00:00:00";
                    

                }
                
              array_push($vezgDates,$date);
            }

              


?>

 <div id="vezg_radios">

<label class="radio">
 <input type="radio" name="is_vezg" id="is_own_price" value="yes" onclick="changePrice('own');" checked>
  <? echo($texts['is_own_price']); ?>
</label>
<label class="radio">
  <input type="radio" name="is_vezg" id="is_vezg" value="no" onclick="changePrice('vezg');">
  <? echo($texts['is_vezg_price']); ?>
</label>
</div><br/>


    <div id="own" class="control-group">
        <label class="control-label" for="auction_min_entitity_price"><? echo($texts['offer_entitity_price']); ?></label>
        <div class="controls">
          <input type="text" id="auction_min_entitity_price" name="auction_min_entitity_price" placeholder="<? echo($texts['auction_min_entitity_price_placeholer']); ?>" value="<? if($oldValues!=nil) echo($oldValues['auction_min_entitity_price']); ?>" >
        </div>
    </div>




<div id="vezg" class="hide">
     <div class="control-group" >
        <label class="control-label" for="auction_date"><? echo($texts['vezg_date']); ?></label>
        <div class="controls">
          <select name="auction_date"  id="auction_date">
            <?
             for($i=0;$i<count($vezgDates);$i++){

              echo('<option value="'.$vezgDates[$i]["submitable_date"].'"');

              if(($vezgDates[$i]["submitable_date"])==$oldValues['start_time']){

                  echo(" selected ");

              }

                echo(' >'.$vezgDates[$i]["readable_date"].'</option>');
             }

            ?>
            
      
          </select>
        </div>
      </div>

</div>      


<script type="text/javascript">


function changePrice(price_system){

  if(price_system=='own'){

    $("#vezg").hide();
    is_vezg="no";
    $("#auction_min_entitity_price").attr("placeholder", "<? echo($texts['auction_min_entitity_price_placeholer']); ?>");

  }else{
    is_vezg="yes";
  $("#vezg").show();
    $("#auction_min_entitity_price").attr("placeholder", "<? echo($texts['vezg_price_placeholer']); ?>");



  }

}
</script>

<?

}

?>





  <div class="control-group">
        <label class="control-label" for="auction_genes"><? echo($texts['auction_genes']); ?></label>
        <div class="controls">
          <input type="text" id="auction_genes" name="auction_genes" placeholder="<? echo($texts['auction_genes_placholder']); ?>" value="<? if($oldValues!=nil) echo($oldValues['auction_genes']); ?>">
        </div>
      </div>


      <div class="control-group">
        <label class="control-label" for="auction_origin"><? echo($texts['auction_origin']); ?></label>
        <div class="controls">
          <input type="text" id="auction_origin" name="auction_origin" placeholder="<? echo($texts['auction_origin_placeholder']); ?>" value="<? if($oldValues!=nil) echo($oldValues['auction_origin']); ?>">
        </div>
      </div>
<h5><? echo($texts['hint']); ?></h5>
<p><? echo($texts['auction_optional_hint']); ?></p>
</div>



<hr>



<div id="auction_classification_data"> 
  <h3><? echo($texts['edit_auction_classifiction_data_headline']); ?></h3>
            <span class="help-block"><? echo($texts['auction_pigs_calssification_hint']); ?></span><br/>







      
        <div class="control-group">
        <label class="control-label" for="auction_classification_mask"><? echo($texts['auction_classification_mask']); ?></label>
        <div class="controls">
         
          
          <select  name="auction_classification_mask" id="auction_classification_mask" >
            <option value="FOM" <? if($oldValues['auction_classification_mask']=="FOM"){
echo (' selected="selected" ');
}

?> ><? echo($texts['auction_pigs_fom']) ;?></option>

  <option value="AUTOFOM" <? if($oldValues['auction_classification_mask']=="AUTOFOM"){
echo (' selected="selected" ');
}
?> ><? echo($texts['auction_pigs_autofom']) ;?></option>
        
        
          </select>
        </div>
      </div>




<div id="classification_mask">
    <div class="control-group">
      <label class="control-label" for="auction_pigs_classification_mask_value"><? echo($texts['auction_pigs_fom_entity']); ?></label>
        <div class="controls">
          <input type="text" id="auction_pigs_classification_mask_value" name="auction_pigs_classification_mask_value" placeholder="<? echo($texts['auction_pigs_fom_entity_placeholder']); ?>" value="<? if($oldValues!=nil) echo($oldValues['auction_pigs_classification_mask_value']); ?>">
        </div>
    </div>
  </div>

<script type="text/javascript">

$("#auction_classification_mask").change(
  function(){

checkedClassificationMask()

  });


function  checkedClassificationMask(){

html="";
   
if($("#auction_classification_mask").val()=="FOM"){
html='<div class="control-group"><label class="control-label" for="auction_pigs_classification_mask_value"><? echo($texts['auction_pigs_fom_entity']); ?></label><div class="controls"><input type="text" id="auction_pigs_classification_mask_value" name="auction_pigs_classification_mask_value" placeholder="<? echo($texts['auction_pigs_fom_entity_placeholder']); ?>" value="<? if($oldValues!=nil) echo($oldValues['auction_pigs_classification_mask_value']); ?>"></div></div>';
  
}else{

html='<div class="control-group"> <label class="control-label" for="auction_pigs_classification_mask_value"><? echo($texts['auction_pigs_autofom_entity']); ?></label><div class="controls"><input type="text" id="auction_pigs_classification_mask_value" name="auction_pigs_classification_mask_value" placeholder="<? echo($texts['auction_pigs_autofom_entity_placeholder']); ?>" value="<? if($oldValues!=nil) echo($oldValues['auction_pigs_classification_mask_value']); ?>"></div></div>';
}
  
  $("#classification_mask").html(html);

  }


  checkedClassificationMask();

</script>





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



</div>



<hr>

<div id="auction_transportation_data"> 
  <h3><? echo($texts['edit_auction_transportation_data_headline']); ?></h3>
 <span class="help-block"><? echo($texts['auction_address_hint']); ?></span><br/>
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

  <div id="from_time" class="input-append date">
    <input data-format="dd.MM.yyyy" name="auction_loading_stations_availability" id="auction_loading_stations_availability" value="<? if($oldValues!=nil) echo($oldValues['auction_loading_stations_availability']); ?>"  type="text"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
  </div>
</div>
 </div>


   <div class="control-group">
        <label class="control-label" for="auction_loading_stations_availability_til"><? echo($texts['auction_loading_stations_availability_til']); ?></label>
      <div class="controls">

  <div id="till_time" class="input-append date">
    <input data-format="dd.MM.yyyy" name="auction_loading_stations_availability_til" id="auction_loading_stations_availability_til" value="<? if($oldValues!=nil) echo($oldValues['auction_loading_stations_availability_til']); ?>" type="text"></input>
    <span class="add-on">
      <i data-time-icon="icon-time" data-date-icon="icon-calendar">
      </i>
    </span>
  </div>
</div>
 </div>
   
 </div>


<hr>

<div id="auction_final">     


     <div class="control-group">
        <label class="control-label" for="needs_original"><? echo($texts['auction_needs_original']); ?></label>
        <div class="controls">
          <input type="checkbox" id="needs_original" name="needs_original"
<? if($oldValues['needs_original']=="yes"){

echo ' checked="checked" ';

}
?>

           />
        </div>
      </div>



       <div class="control-group">
        <label class="control-label" for="is_public"><? echo($texts['auction_pigs_offer_openly']); ?></label>
        <div class="controls">
          <input type="checkbox" id="is_public" name="is_public"
<? if($oldValues['is_public']=="yes"){

echo ' checked="checked" ';

}
?>

           />
        </div>
      </div>

      <div class="control-group">
        <label class="control-label" for="auction_additional_informations"><? echo($texts['auction_additional_informations']); ?></label>
        <div class="controls">
          <textarea id="auction_additional_informations" name="auction_additional_informations" rows="3"><? if($oldValues!=nil) echo($oldValues['auction_additional_informations']); ?></textarea>
        </div>
      </div>
      <?
  if($gBase->User["is_seller"]=="yes"){
?>
       <button onclick="return false" class="btn btn-primary" id="auction_preview"><? echo($texts['auction_preview']); ?></button><button onclick="return false" class="btn btn-primary" id="auction_submit"><? echo($texts['auction_submit']); ?></button>
 <?
 }
?>

</div>

 
  </form>
  
  </div>
  <script type="text/javascript">


var is_vezg="no";
        
    $('#endtime').datetimepicker({
      language: 'de-DE'
    });


    
    $('#from_time').datetimepicker({
      language: 'de-DE'
    });

$('#till_time').datetimepicker({
      language: 'de-DE'
    });

 picker=$('#endtime').data('datetimepicker');
picker.setLocalDate(new Date());



$("#pigs_auction #auction_preview").click(function(){
      $("#pigs_auction #view").val("show_full_auction");
      $("#pigs_auction #is_preview").val("yes");
      //$("#pigs_auction #auction_form").attr("target", "_blank");

  if($("#is_auction").val()=="yes"){
      sendForm('view=show_full_auction&action=get_auction_details', true);
    }else{
      sendForm('view=show_full_auction&action=get_auction_details', true);
    }


   });

$("#pigs_auction #auction_submit").click(function(){

      $("#pigs_auction #view").val("profile");
      $("#pigs_auction #is_preview").val("no");

      if($("#is_auction").val()=="yes"){
      sendForm('view=profile#auctions', false);
}else{
   sendForm('view=profile#offers', false);
}

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


      <?
  if($gBase->User["is_seller"]=="yes"){
?>

function sendForm(nextview, is_preview){

  price=$("#auction_min_entitity_price").val();
  price=price.replace("€","");
  price=price.replace(" ","");

  is_public="no";

  needs_original="no";

$("#auction_min_entitity_price").val(price);

$("#auction_min_entitity_price").val(price);

if($("#is_public").is(':checked')){

    is_public="yes";
}

if($("#needs_original").is(':checked')){

    needs_original="yes";
}


	
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
		
		
    if($("#auction_pigs_classification_mask_value").val()==''){
	
  if($("#auction_classification_mask").val()=="FOM"){
		$("#pigs_auction #error_message").append('<? echo($texts['auction_pigs_fom_value_error']); ?><br/>');
		errorflag=true;
}else{

      $("#pigs_auction #error_message").append('<? echo($texts['auction_pigs_fom_value_error']); ?><br/>');
    errorflag=true;
}



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
         $(document).scrollTop(0);
				 return false;
		}else{
			


 $.getJSON("index.php", { "action": $("#action").val(), "view": "profile", "mode":"ajax", "category_id":$("#category_id").val(), "auction_id":$("#auction_id").val(), "is_auction":$("#is_auction").val(), "is_main_auction":$("#is_main_auction").val(), "is_vezg": is_vezg, "is_preview":$("#is_preview").val(),"auction_date":$("#auction_date").val(),"endtime":$("#endtime").val(),"auction_amount":$("#auction_amount").val(),"auction_min_entitity_price":$("#auction_min_entitity_price").val(), "auction_genes":$("#auction_genes").val(), "auction_origin":$("#auction_origin").val(),"auction_classification_mask":$("#auction_classification_mask").val(),"auction_pigs_classification_mask_value":$("#auction_pigs_classification_mask_value").val(),"auction_pigs_qs":$("#auction_pigs_qs").val(),"auction_pigs_samonelle_state":$("#auction_pigs_samonelle_state").val(),"address":$("#address").val(),"auction_loading_stations_amount":$("#auction_loading_stations_amount").val(),"auction_loading_stations_distance":$("#auction_loading_stations_distance").val(),"auction_loading_stations_vehicle":$("#auction_loading_stations_vehicle").val(),"auction_loading_stations_availability":$("#auction_loading_stations_availability").val(), "auction_loading_stations_availability_til":$("#auction_loading_stations_availability_til").val(), "needs_original":needs_original, "is_public": is_public, "auction_additional_informations":$("#auction_additional_informations").val(), "sid":"<? echo($_COOKIE["PHPSESSID"]); ?>"},
      
        function(data){
           
               session_id=data.conf.session_id;
                errorflag=false;
                
                currentID="";

                if(is_preview){

                  is_preview="&is_preview=yes&auction_id="+data.current_auction.auction_id+"&is_auction="+data.current_auction.is_auction+"&state_id="+data.current_auction.state_id+"&county_id="+data.current_auction.county_id;
   window.open("?"+nextview+is_preview, "_self");
              
                }else{

 window.open("?"+nextview, "_self");
                }
 
          
      

    
              
             });

  

      






		 
    
		}
					
     
  }
	

  <?
}
?>

</script>