<?

switch ($category_id) {
	case '1':
		include('show_running_pigs_auction.php');
		break;
	case '2':
		include('show_running_ferkel_auction.php');
		break;
	default:
		include('show_running_pigs_auction.php');
		break;
}

?>
