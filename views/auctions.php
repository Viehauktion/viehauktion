<?PHP


$areAuctionsToday=false; 

 for($i=0; $i<count($gBase->RawData); $i++){
	

 	if(substr($gBase->RawData[$i]["start_time"], 0, 10)==date("Y-m-d")){

			$areAuctionsToday=true;

 	}

 }



?>


   <h2><? echo($texts['navi_auction']); ?></h2>



      <p><? if($areAuctionsToday){
 echo($texts['auctions_auction_today']);
      }else{
 echo($texts['auctions_no_auction_today']);

      }
      ?>

</p>


<? if($areAuctionsToday){

$_form_action="get_running_auction";
$_form_view="show_running_auction";

}else{

$_form_action="get_next_auction";
$_form_view="show_next_auction";

} 

$is_auction="yes";
include("select_auction.php");

?>






