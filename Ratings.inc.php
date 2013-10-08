<?PHP

function rateUser($auction_id, $comment, $rating){

global $gBase;
	
		$lDB=connectDB();
	
		if (!$lDB->failed){

			if($auction_id!=""){
				//Update Auction
				$ratingArray=array();
				if($ratingArray=$lDB->getRatingByAuctionIdandWriterId($auction_id, $gBase->User['id'])){
						$ratingArray['comment']=$comment;
						$ratingArray['rating']=$rating;

						$lDB->updateRating($ratingArray);

				}else{
						$auctionArray=array();
						$ratingArray=array();
						if($auctionArray=$lDB->getAuctionById($auction_id)){
						$about_id=0;
						if($gBase->User['id']==$auctionArray['user_id']){
							$about_id=$auctionArray['buyer_id'];
						}else{
							$about_id=$auctionArray['user_id'];
						}
						$ratingArray['auction_id']=$auction_id;
						$ratingArray['writer_id']=$gBase->User['id'];
						$ratingArray['about_id']=$about_id;
						$ratingArray['comment']=$comment;
						$ratingArray['rating']=$rating;
						if($about_id!=0){
						$lDB->addRating($ratingArray);
						}
						}

				}


			
		
				



		}

}


}




?>