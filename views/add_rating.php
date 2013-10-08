<div id="add_rating">


<form class="form-horizontal">
  <fieldset>
    <legend><? echo($texts['add_rating_headline']); ?></legend>
    <p><? echo($texts['add_rating_description']); ?></p>
    
		    <div class="alert-error hide"  >
		  <button type="button" class="close" data-dismiss="alert">&times;</button>
		  <h4><? echo($texts['error']); ?></h4>
		 <span id="error_message"></span>
		</div>


	<div class="control-group">
        <label class="control-label" for="patient"><? echo($texts['add_rating_about']); ?></label>
        <div class="controls">
         


<? if( ($gBase->CurrentAuction["auction"]["status"]=="ended" || $gBase->CurrentAuction["auction"]["status"]=="confirmed") && $gBase->CurrentAuction["auction"]["buyer_id"]==$gBase->User["id"]){ ?>

<div id="seller_box"> 
  <h2><? echo($texts['seller']); ?></h2>
     <p>
     	<? echo($gBase->CurrentAuction["seller"]["firstname"]." ".$gBase->CurrentAuction["seller"]["lastname"]); ?><br />
		<? echo($gBase->CurrentAuction["address"]["street"]." ".$gBase->CurrentAuction["address"]["number"]); ?><br />
		<? echo($gBase->CurrentAuction["address"]["postcode"]." ".$gBase->CurrentAuction["address"]["city"]); ?><br />
		<? echo($texts['registration_phone'].": ".$gBase->CurrentAuction["seller"]["phone"]."<br />".$texts['registration_email'].": ".$gBase->CurrentAuction["seller"]["email"]); ?><br />
     </p>
       
</div>

<? 
}
?>


<? if(($gBase->CurrentAuction["auction"]["status"]=="ended" || $gBase->CurrentAuction["auction"]["status"]=="confirmed")  && $gBase->CurrentAuction["auction"]["user_id"]==$gBase->User["id"]){ ?>

<div id="buyer_box"> 
  <h2><? echo($texts['buyer']); ?></h2>
     <p>
     	<? echo($gBase->CurrentAuction["buyer"]["firstname"]." ".$gBase->CurrentAuction["buyer"]["lastname"]); ?><br />
		<? echo($gBase->CurrentAuction["buyer"]["address"]["street"]." ".$gBase->CurrentAuction["buyer"]["address"]["number"]); ?><br />
		<? echo($gBase->CurrentAuction["buyer"]["address"]["postcode"]." ".$gBase->CurrentAuction["buyer"]["address"]["city"]); ?><br />
	
		<? echo($texts['registration_phone'].": ".$gBase->CurrentAuction["buyer"]["phone"]."<br />".$texts['registration_email'].": ".$gBase->CurrentAuction["buyer"]["email"]); ?><br />
     </p>
       
</div>

<? 
}
?>


        </div>
      </div>
   

   	<div class="control-group">
        <label class="control-label" for="ratingIcons"><? echo($texts['add_rating']); ?></label>
        <div class="controls">
          <div id="ratingIcons"><img src="assets/pig_icon_empty.png" onclick="rate(1)" height="30" width="50" /><img src="assets/pig_icon_empty.png" onclick="rate(2)" height="30" width="50" /><img src="assets/pig_icon_empty.png" onclick="rate(3)" height="30" width="50" /><img src="assets/pig_icon_empty.png" onclick="rate(4)" height="30" width="50" /><img src="assets/pig_icon_empty.png" onclick="rate(5)" height="30" width="50" /> </div>
        </div>
      </div>
    
    
       <div class="control-group">
        <label class="control-label" for="comment"><? echo($texts['add_coment']); ?></label>
        <div class="controls">
          <textarea id="comment" name="comment" rows="3"></textarea>
        </div>
      </div>

       <button onclick="return false" class="btn btn-primary" id="rating_submit"><? echo($texts['add_rate_now']); ?></button>
    </fieldset>
  </form>

</div>





<script type="text/javascript">

var currentRating=0;


function rate(rating){
$("#ratingIcons").empty();

	html="";
currentRating=rating;
	for(i=0;i<rating; i++){
	html+='<img src="assets/pig_icon_full.png" onclick="rate('+(i+1)+')" height="30" width="50" />';

	}
	for(i=rating;i<5; i++){
		html+='<img src="assets/pig_icon_empty.png" onclick="rate('+(i+1)+')" height="30" width="50" />';
	}

	$("#ratingIcons").html(html);
	
}




$("#rating_submit").click(function(){
	
	errorflag=false;
	$("#error_message").empty();

	if(currentRating==0){

	$("#error_message").append('<? echo($texts['add_no_rating_error']); ?><br/>');
	errorflag=true;

	}
	
			
			
		if(errorflag){
				 $(".alert-error").show();
				 return false;
		}else{
			
			
		   $.getJSON("index.php", { "action": "rate_user", "view": "add_rating", "mode":"ajax", "rating":currentRating, "comment":$("#comment").val(), "auction_id":"<? echo($gBase->CurrentAuction['auction']['id']); ?>", "sid":"<? echo($_COOKIE["PHPSESSID"]); ?>"},
			
			  function(data){
	 				 session_id=data.conf.session_id;
					 errorflag=false;
						
						
					  $("#error_message").empty();
					  alert('<? echo($texts['add_rating_success']); ?>');
					
					  window.open("?view=profile", "_self");
	
			 				
						 });
    
		}
					
     
    });
	

</script>

