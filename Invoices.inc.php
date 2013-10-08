<?PHP



function getUserInvoices($recipient_id){

	global $gBase;
	
		$lDB=connectDB();
	
		if (!$lDB->failed){
			$userInvoices=array();

			if($userInvoices=$lDB->getInvoicesByRecipientId($recipient_id)){
	
							$gBase->UserInvoices=$userInvoices;
						}

		}

}



function getInvoice($invoice_id){




		global $gBase;
		
			$lDB=connectDB();
			if (!$lDB->failed){
			
				if($invoice_id!=""){
				//Update Auction	
			
				$invoiceArray=array();
				if($invoiceArray=$lDB->getInvoiceById($invoice_id)){
					
					if($invoiceArray['recipient_id']==$gBase->User['id']){
					
						
						$invoiceArray['downloaded']=$invoiceArray['downloaded']+1;
								$lDB->updateInvoice($invoiceArray);
								

						header("Location: ".$GLOBALS["VIEHAUKTION"]["AMAZON"]["INVOICEURL"].$invoiceArray['filename']);

		 	 	 	 	 	 	
						
					}else{
						
						$gBase->Error="INVOICE_NOT_ALLOWED";
								
						return false;	
						
					}
					
			    }else{
					
					
				$gBase->Error="INVOICE_NOT_FOUND";
								
				return false;	
					
				}
			}
		}

}


?>