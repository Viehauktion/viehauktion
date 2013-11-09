<?php

$nextDates=getNextAuctions(2);


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


<div id="ferkel_auction" class="span9 hide">     
  <form  class="form-horizontal" id="auction_form" method="get" action="?">
 

      <div class="alert alert-error hide"  >
        <button type="button" class="close" data-dismiss="alert">&times;</button>
        <h3><? echo($texts['error']); ?></h3>
        <span id="error_message"></span> </div>

        <input type="hidden" id="action" name="action" value="edit_auction" />
        <input type="hidden" id="view" name="view" value="profile" />
      <input type="hidden" id="category_id" name="category_id" value="2" />
      <input type="hidden" id="auction_id" name="auction_id" value="<? echo($_REQUEST['auction_id']); ?>" />
      <input type="hidden" id="is_auction" name="is_auction" value="<? echo($_REQUEST['is_auction']); ?>" />
        <input type="hidden" id="address" name="address" value="<? echo($gBase->UserAddresses[$i]['id']); ?>" />
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
      
        <label class="control-label" for="auction_min_entitity_price"><? echo($texts['auction_ferkel_min_entity_price']); ?></label>
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




    <div id="own" class="control-group">
        <label class="control-label" for="auction_min_entitity_price"><? echo($texts['offer_ferkel_min_entity_price']); ?></label>
        <div class="controls">
          <input type="text" id="auction_min_entitity_price" name="auction_min_entitity_price" placeholder="<? echo($texts['auction_min_entitity_price_placeholer']); ?>" value="<? if($oldValues!=nil) echo($oldValues['auction_min_entitity_price']); ?>" >
        </div>
    </div>





<?

}

?>


     <div class="control-group">
        <label class="control-label" for="auction_origin"><? echo($texts['auction_ferkel_origin']); ?></label>
        <div class="controls">
          <input type="text" id="auction_origin" name="auction_origin" placeholder="<? echo($texts['auction_origin_placeholder']); ?>" value="<? if($oldValues!=nil) echo($oldValues['auction_origin']); ?>">
        </div>
      </div>

     <div class="control-group">
        <label class="control-label" for="auction_stalls"><? echo($texts['auction_ferkel_stalls']); ?></label>
        <div class="controls">
          <input type="text" id="auction_stalls" name="auction_stalls" placeholder="<? echo($texts['auction_ferkel_stalls_placeholder']); ?>" value="<? if($oldValues!=nil) echo($oldValues['auction_stalls']); ?>">
        </div>
      </div>



  <div class="control-group">
        <label class="control-label" for="auction_genes"><? echo($texts['auction_genes']); ?></label>
        <div class="controls">
          <input type="text" id="auction_genes" name="auction_genes" placeholder="<? echo($texts['auction_genes_placholder']); ?>" value="<? if($oldValues!=nil) echo($oldValues['auction_genes']); ?>">
        </div>
      </div>


 


      <div class="control-group">
        <label class="control-label" for="auction_status"><? echo($texts['auction_ferkel_status']); ?></label>
        <div class="controls">
          <input type="text" id="auction_status" name="auction_status" placeholder="<? echo($texts['auction_ferkel_status_placeholder']); ?>" value="<? if($oldValues!=nil) echo($oldValues['auction_status']); ?>">
        </div>
      </div>




      <div class="control-group">
        <label class="control-label" for="auction_health"><? echo($texts['auction_ferkel_health']); ?></label>
        <div class="controls">
          <input type="text" id="auction_health" name="auction_health" placeholder="<? echo($texts['auction_ferkel_health_placeholder']); ?>" value="<? if($oldValues!=nil) echo($oldValues['auction_health']); ?>">
        </div>
      </div>


<h5><? echo($texts['hint']); ?></h5>
<p><? echo($texts['auction_optional_hint']); ?></p>
</div>




<hr>

<div id="auction_final">    



  <h3><? echo($texts['edit_auction_ferkel_transportation_data_headline']); ?></h3>





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
  
       <button onclick="return false" class="btn btn-primary" id="auction_preview"><? echo($texts['auction_preview']); ?></button>
       <!--<button onclick="return false" class="btn btn-primary" id="auction_submit"><? echo($texts['auction_submit']); ?></button>-->


</div>

 
  </form>
  
  </div>
  <script type="text/javascript">



        
  


    
    $('#ferkel_auction #from_time').datetimepicker({
      language: 'de-DE'
    });

$('#ferkel_auction #till_time').datetimepicker({
      language: 'de-DE'
    });





$("#ferkel_auction #auction_preview").click(function(){
      $("#ferkel_auction #view").val("show_full_auction");
      $("#ferkel_auction #is_preview").val("yes");
      //$("#ferkel_auction #auction_form").attr("target", "_blank");

  if($("#ferkel_auction #is_auction").val()=="yes"){
      sendForm('view=show_full_auction&action=get_auction_details', true);
    }else{
      sendForm('view=show_full_auction&action=get_auction_details', true);
    }


   });

$("#ferkel_auction #auction_submit").click(function(){

      $("#ferkel_auction #view").val("profile");
      $("#ferkel_auction #is_preview").val("no");

      if($("#ferkel_auction #is_auction").val()=="yes"){
      sendForm('view=profile#auctions', false);
}else{
   sendForm('view=profile#offers', false);
}

   });





function sendForm(nextview, is_preview){

  price=$("#ferkel_auction #auction_min_entitity_price").val();
  price=price.replace("€","");
  price=price.replace(" ","");

  is_public="no";

  

$("#ferkel_auction #auction_min_entitity_price").val(price);

$("#ferkel_auction #auction_min_entitity_price").val(price);

if($("#ferkel_auction #is_public").is(':checked')){

    is_public="yes";
}



	
	errorflag=false;
	$("#ferkel_auction #error_message").empty();
	
		if($("#ferkel_auction #auction_amount").val()==''){
	
		$("#ferkel_auction #error_message").append('<? echo($texts['auction_amount_error']); ?><br/>');
		errorflag=true;

		}
		
	 	if($("#ferkel_auction #auction_min_entitity_price").val()==''){
	
		$("#ferkel_auction #error_message").append('<? echo($texts['auction_min_entitity_price_error']); ?><br/>');
		errorflag=true;

		}
		



	  if($("#ferkel_auction #auction_origin").val()==''){
	
		$("#ferkel_auction #error_message").append('<? echo($texts['auction_origin_error']); ?><br/>');
		errorflag=true;

		}
		
		
    if($("#ferkel_auction #auction_stalls").val()==''){
  
    $("#ferkel_auction #error_message").append('<? echo($texts['auction_stalls_error']); ?><br/>');
    errorflag=true;

    }


 if($("#ferkel_auction #auction_genes").val()==''){
  
    $("#ferkel_auction #error_message").append('<? echo($texts['auction_genes_error']); ?><br/>');
    errorflag=true;

    }

     if($("#ferkel_auction #auction_status").val()==''){
  
    $("#ferkel_auction #error_message").append('<? echo($texts['auction_status_error']); ?><br/>');
    errorflag=true;

    }





	 
	 
	 //VALIDATE POINT KOMMA Thing


			
		if(errorflag){
				 $(".alert-error").show();
         $(document).scrollTop(0);
				 return false;
		}else{
			


 $.getJSON("index.php", { "action": $("#ferkel_auction #action").val(), "view": "profile", "mode":"ajax", "category_id":$("#ferkel_auction #category_id").val(), "address":$("#address").val(), "auction_id":$("#ferkel_auction #auction_id").val(), "is_auction":$("#ferkel_auction #is_auction").val(), "is_main_auction":$("#ferkel_auction #is_main_auction").val(), "is_vezg":"no", "is_preview":$("#ferkel_auction #is_preview").val(),"auction_date":$("#ferkel_auction #auction_date").val(),"endtime":$("#ferkel_auction #endtime").val(),"auction_amount":$("#ferkel_auction #auction_amount").val(),"auction_min_entitity_price":$("#ferkel_auction #auction_min_entitity_price").val(), "auction_genes":$("#ferkel_auction #auction_genes").val(), "auction_origin":$("#ferkel_auction #auction_origin").val(), "auction_stalls":$("#ferkel_auction #auction_stalls").val(), "auction_health":$("#ferkel_auction #auction_health").val(), "auction_status":$("#ferkel_auction #auction_status").val(),"auction_loading_stations_availability":$("#ferkel_auction #auction_loading_stations_availability").val(), "auction_loading_stations_availability_til":$("#ferkel_auction #auction_loading_stations_availability_til").val(), "is_public": is_public, "auction_additional_informations":$("#ferkel_auction #auction_additional_informations").val(), "sid":"<? echo($_COOKIE["PHPSESSID"]); ?>"},
      
        function(data){
           
               session_id=data.conf.session_id;
                errorflag=false;
                
                currentID="";

                if(is_preview){

                  is_preview="&is_preview=yes&auction_id="+data.current_auction.auction_id+"&is_auction="+data.current_auction.is_auction+"&state_id="+data.current_auction.state_id+"&county_id="+data.current_auction.county_id+"&category_id="+2;
   window.open("?"+nextview+is_preview, "_self");
              
                }else{

 window.open("?"+nextview, "_self");
                }
 
          
      

    
              
             });

  

      






		 
    
		}
					
     
  }
	



</script>