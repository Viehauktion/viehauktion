<?PHP


$areOffersToday=false; 

 if(count($gBase->RawData)>0){
	


			$areOffersToday=true;

 	

 }



?>


   <h2><? echo($texts['navi_auction']); ?></h2>



      <p><? if($areOffersToday){
 echo($texts['offers_today']);
      }else{
 echo($texts['offers_no_offer_today']);

      }
      ?>

</p>


<? if($areOffersToday){


$_form_action="get_next_auction";
$_form_view="show_next_auction";
$is_auction="no";
include("select_auction.php");
} 



?>






