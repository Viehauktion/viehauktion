<?PHP



function getUserInvoices($recipient_id, $page=1){

	global $gBase;
	

			$start=$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"]*$page-$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"];
		

		$lDB=connectDB();
	
		if (!$lDB->failed){
			$userInvoices=array();

			if($userInvoices=$lDB->getInvoicesByRecipientId($recipient_id,$start,$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"])){
	
							$gBase->UserInvoices=$userInvoices;
						}

		}

}






function getInvoices($page=1){

	global $gBase;
	

			$start=$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"]*$page-$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"];
		

		$lDB=connectDB();
	
		if (!$lDB->failed){
			$userInvoices=array();

						if($userInvoices=$lDB->getInvoices('', $start,$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"])){
	
							$gBase->RawData['invoices']=$userInvoices;
						}

						if($userInvoices=$lDB->getInvoices('open', $start,$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"])){
	
							$gBase->RawData['open_invoices']=$userInvoices;
						}

		}

}


function updateInvoice($invoice_id, $status){



		global $gBase;
		
			$lDB=connectDB();
			if (!$lDB->failed){
			
				if($invoice_id!=""){
				//Update Auction	
			
				$invoiceArray=array();
				if($invoiceArray=$lDB->getInvoiceById($invoice_id)){
					$invoiceArray['status']=$status;
							$lDB->updateInvoice($invoiceArray);
						}
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
					
					if($invoiceArray['recipient_id']==$gBase->User['id'] || $gBase->User['role']=='admin'){
					
						
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