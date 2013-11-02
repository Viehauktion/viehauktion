<?



  
if($_REQUEST["is_preview"]=="yes"){
	if($_REQUEST["is_auction"]=="yes"){
	echo('<h2>'.$texts['edit_auction_headline'].' - '.$texts["overview"].' (2/2)</h2>');
		echo('<p>'.$texts['edit_auction_overview_description'].'.</p><hr>');
}else{
	echo('<h2>'.$texts['edit_offer_headline'].' - '.$texts["overview"].' (2/2)</h2>');
	echo('<p>'.$texts['edit_offer_overview_description'].'.</p><hr>');
}

}


  



switch ($category_id) {
	case '1':
		include('show_full_pigs_auction.php');
		break;
	case '2':
		include('show_full_ferkel_auction.php');
		break;
	default:
		include('show_full_pigs_auction.php');
		break;
}

?>
