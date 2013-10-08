<?php
	

	
	require_once("globals.inc.php");
	require_once("DB.inc.php");
	

	class Base {
	
	
		var $User;
		var $Error;
		var $UserAuctions;
		var $UserWonAuctions;
		var $UserOffers;
		var $UserSearchs;
		var $UserAddresses;
		var $UserInvoices;
		
		var $CurrentAuction;
	
		var $RawData;
		
		function Base() {
		
					
						
						$this->User=$_SESSION["User"];
						$this->UserAuctions=$_SESSION["UserAuctions"];
						$this->UserWonAuctions=$_SESSION["UserWonAuctions"];
						$this->UserOffers=$_SESSION["UserOffers"];
						$this->UserSearchs=$_SESSION["UserSearchs"];
						$this->UserAddresses=$_SESSION["UserAddresses"];
						$this->UserInvoices=$_SESSION["UserInvoices"];
						$this->CurrentAuction=$_SESSION["CurrentAuction"];
						
			
	

		}

		function saveToSession() {
	
	
			
			$_SESSION["User"] 	= $this->User;
			$_SESSION["UserAuctions"] 	= $this->UserAuctions;
			$_SESSION["UserWonAuctions"] 	= $this->UserWonAuctions;
			$_SESSION["UserOffers"] 	= $this->UserOffers;
			$_SESSION["UserSearchs"] 	= $this->UserSearchs;
			$_SESSION["UserInvoices"]= $this->UserInvoices;
			$_SESSION["UserAddresses"]= $this->UserAddresses;
			$_SESSION["CurrentAuction"]=$this->CurrentAuction;
		
			
		}

	
	

	
		function printJSON() {
			

			
				$output=array();
				$output['conf']['session_id']=session_id();
				$output['conf']['action']=$_REQUEST['action'];
				$output['conf']['view']=$_REQUEST['view'];
				$output['conf']['mode']=$_REQUEST['mode'];
				
				$output['user']=$this->User;
				$output["user_auctions"] = $this->UserAuctions;
				$output["user_won_auctions"] 	= $this->UserWonAuctions;
				$output["user_searchs"] 	= $this->UserSearchs;
				$output["user_offers"] 	= $this->UserOffers;
				$output["user_addresses"] 	= $this->UserAddresses;
				$output["user_invoices"] 	= $this->UserInvoices;
				$output["current_auction"] 	= $this->CurrentAuction;
				$output["raw_data"] 	= $this->RawData;
				$output['error']=$this->Error;
			
				echo json_encode($output);
				
					

										
		}





	}

?>