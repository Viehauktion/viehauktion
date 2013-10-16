<?PHP

	require_once("globals.inc.php");
	require_once("DB.inc.php");
	

	
	function registerUser($is_new, $password,  $email, $company, $firstname, $lastname,$street,$number,$postcode,$city, $phone, $is_buyer, $is_seller, $is_newsletter,$hrb_nr, $retail_nr, $stall_nr, $vat_nr, $lang){
	global $gBase;
		
		$lDB=connectDB();





		if (!$lDB->failed){
	
			
					
						
						
									if(($userArray=$lDB->getUserByEmail(strtolower($email))) && ($email!=$gBase->User['email'])){
									
									
												

												if($is_new){

													header("Location: ".$GLOBALS["VIEHAUKTION"]["BASE"]["HTTPROOT"]."?view=registration&error=user_already_registered");
													exit;  
												}else{

													header("Location: ".$GLOBALS["VIEHAUKTION"]["BASE"]["HTTPROOT"]."?view=edit_profile&error=user_already_registered");
													exit;  
												}

												return false;
									}
						



									$userArray=array();


									if(!$is_new){

										$userArray=$lDB->getUserByID($gBase->User["id"]);
										if(md5($password)!=$userArray['password']){
												$gBase->Error="WRONG_PASSWORD";


													//header("Location: ".$GLOBALS["VIEHAUKTION"]["BASE"]["HTTPROOT"]."?view=edit_profile&error=wrong_password");
													//exit;  
											return false;
										}


									}else{

											$userArray['password']=md5($password);


									}
									$userArray['company']=mysql_escape_string($company);
				
							
									
									$userArray['email']=mysql_escape_string(strtolower($email));
								
									$userArray['firstname']=mysql_escape_string($firstname);
									$userArray['lastname']=mysql_escape_string($lastname);
									$userArray['email']=mysql_escape_string($email);
									$userArray['phone']=mysql_escape_string($phone);

									$userArray['hrb_nr']=mysql_escape_string($hrb_nr);
									$userArray['retail_nr']=mysql_escape_string($retail_nr);
									$userArray['stall_nr']=mysql_escape_string($stall_nr);
									$userArray['vat_nr']=mysql_escape_string($vat_nr);

									$userArray['agb']="1";
									if($is_buyer=='on'){
									$userArray['is_buyer']="yes";


								}else{
										$userArray['is_buyer']="no";
								}

								if($is_seller=="on"){
								$userArray['is_seller']="yes";
								}else{
								$userArray['is_seller']="no";	
								}
								

													
					

									if($is_newsletter=="on"){
									$userArray['is_newsletter']="yes";
									}else{
									$userArray['is_newsletter']="no";	
									}
								

									if($is_new){
									 $lDB->addUser($userArray);
									 $userArray=$lDB->getUserByEmail(strtolower($email));
									}else{
								
										$lDB->updateUser($userArray);

									}



									if($is_buyer=='on'){

									$lTmpFile = $_FILES['insurance']['tmp_name'];
									$lTmpFileRealName = $_FILES['insurance']['name'];
									$newFileName=$userArray['id']."_".time()."_".$lTmpFileRealName;
									
									if (is_uploaded_file($lTmpFile)) {

										$s3 = new S3($GLOBALS["VIEHAUKTION"]["AMAZON"]["ID"], $GLOBALS["VIEHAUKTION"]["AMAZON"]["KEY"]);


										$result=$s3->putObjectFile($lTmpFile, $GLOBALS["VIEHAUKTION"]["AMAZON"]["BUCKET"], "documents/".$newFileName, S3::ACL_PUBLIC_READ);
										
										$userfiledata=array();
										if((!$is_new) && $userfiledata=$lDB->getUserFileDataByOwnerAndType($userArray['id'], "insurance")){

											$userfiledata['filename']=$newFileName;
											$userfiledata['uploaded']=date("Y-m-d H:i:s");
											$lDB->updateUserFileData($userfiledata);
										}else{

											$userfiledata=array();
											$userfiledata['user_id']=$userArray['id'];
											$userfiledata['type']="insurance";
											$userfiledata['filename']=$newFileName;
											$lDB->addUserFileData($userfiledata);
										
										}



										}
									}


									

									
									
								
								
									$userAddress=array();
										if(!$is_new){

											$userAddress=$lDB->getInvoiceAddressByUserId($gBase->User['id']);
										}


									$userAddress['street']=$street;
									$userAddress['number']=$number;
									$userAddress['postcode']=$postcode;
									$userAddress['city']=$city;
									$userAddress['user_id']=$userArray['id'];
									$userAddress['type']="invoice";
									
										if($is_new){
											$lDB->addUserAddress($userAddress);
										}else{
										
											$lDB->updateAddress($userAddress);
										}
									
									
									
									$gBase->User=$userArray;
									$gBase->UserAddresses=$lDB->getUserAddresses($userArray['id']);
					


									if($is_new){
									$lSearch = array();
								
									$lSearch = array();
									$lSearch[] = "___FIRSTNAME___";
									$lSearch[] = "___LASTNAME___";
									$lSearch[] = "___SITENAME___";
									$lSearch[] = "___LINK___";
									
									$code=substr(md5($userArray['id'].$userArray['email']), 0, 8);
									$activationLink=$GLOBALS["VIEHAUKTION"]["BASE"]["HTTPROOT"]."?view=profile&action=activate_user&user_id=".$gBase->User['id']."&user_email=".$gBase->User['email']."&activationcode=".$code."&lang=".$lang."#userdata";
									$subject='';
									
									switch($lang){
										
										case "de": $subject="Aktivieren Sie Ihren Account."; break;
										case "en": $subject="Activate your account."; break;
										default: $subject="Activate your account.";
										
										}
									
									
								
									$lReplacement = array();
									$lReplacement[] =$userArray['firstname'];
									$lReplacement[] =$userArray['laststname'];
									$lReplacement[] =$GLOBALS["VIEHAUKTION"]["BASE"]["APPNAME"];
									$lReplacement[] =$activationLink;
									
									$lRecipient=$userArray['email'];
				
									if(sendEmail('./mails/activationmail.'.$lang.'.txt', $lSearch, $lReplacement, $subject, $email)){
										
										
											
											return true;
										
										
										
									}
								}

									return true;
				
						
										}
								
								
				}
				
			
			
			
		
	
	

function sendActivationMailAgain($lang){
	

		
			global $gBase;
									

									$lSearch = array();
									$lSearch[] = "___FIRSTNAME___";
									$lSearch[] = "___LASTNAME___";
									$lSearch[] = "___SITENAME___";
									$lSearch[] = "___LINK___";
									
									$code=substr(md5($gBase->User['id'].$gBase->User['email']), 0, 8);
									$activationLink=$GLOBALS["VIEHAUKTION"]["BASE"]["HTTPROOT"]."?view=profile&action=activate_user&user_id=".$gBase->User['id']."&user_email=".$gBase->User['email']."&activationcode=".$code."&lang=".$lang."#userdata";
									
									$subject='';
									
									switch($lang){
										
										case "de": $subject="BestätigenSie Ihre E-Mailadresse"; break;
										case "en": $subject="Activate your account."; break;
										default: $subject="Activate your account.";
										
										}
									
									
									$lReplacement = array();
									$lReplacement[] =$gBase->User['firstname'];
									$lReplacement[] =$gBase->User['laststname'];
									$lReplacement[] =$GLOBALS["VIEHAUKTION"]["BASE"]["APPNAME"];
									$lReplacement[] =$activationLink;
									
									$lRecipient=$gBase->User['email'];
				
									if(sendEmail('./mails/activationmail.'.$lang.'.txt', $lSearch, $lReplacement, $subject, $lRecipient)){
										
										
											return true;
										
										
										
									}else{

										$gBase->Error="EMAIL_NOT_SEND";
									}
								

	
	
	}

	function activateUser($user_id, $email, $code){
	global $gBase;

			if($code==substr(md5($user_id.$email), 0, 8)){

			
		
							$lDB=connectDB();
						if (!$lDB->failed){
							$userArray=array();
							if($userArray=$lDB->getUserByEmail(strtolower($email))){
									if($userArray["active"]==0){
									$userArray["active"]=1;
								}
									$lDB->updateUser($userArray);
									$gBase->User=$userArray;
									$gBase->UserAddresses=$lDB->getUserAddresses($userArray['id']);

							}

						}
			}else{

				$gBase->Error="INVALID_CODE";
			}


	}

			
	function loginUser($identifier, $user_password){
			global $gBase;
		
							$lDB=connectDB();
						if (!$lDB->failed){
	
	
			
									if($userArray=$lDB->getUserByUsernameWithPassword($identifier, md5($user_password))){
									
									 $gBase->User=$userArray;
											$gBase->UserAddresses=$lDB->getUserAddresses($userArray['id']);

									   return true;
									}else if($userArray=$lDB->getUserByEmailWithPassword($identifier, md5($user_password))){
									
									 $gBase->User=$userArray;
											$gBase->UserAddresses=$lDB->getUserAddresses($userArray['id']);

									   return true;
										
										}else{
										
										
										$gBase->Error="CREDENTIALS_INVALID";
										return false;
										
									}
									
									
						}
						
				
				
			}
				
				
				
		   function logoutUser(){
			
				global $gBase;
				$gBase->User=NULL;
				
					session_destroy();
			
			
			}		
		
		
		
			function generateNewUserPassword($identifier, $lang){
	global $gBase;
			
			
					$lDB = connectDB();
					
						$userArray=array();
			
						if (!$lDB->failed){
								
								    if($userArray=$lDB->getUserByEmail($identifier)){
									
								
									}else if($userArray=$lDB->getUserByUsername($identifier)){
									
									
									}else{
										
										$gBase->Error="NO_USER";
										return false;
										
								}
									
									$newpassword=CreateCode(5);
									
									$userArray['password']=md5($newpassword);
									$lDB->updateUser($userArray);
									
									
									//var_dump($userArray);
									$lSearch = array();
									$lSearch[] = "___FIRSTNAME___";
									$lSearch[] = "___LASTNAME___";
									$lSearch[] = "___SITENAME___";
									$lSearch[] = "___EMAIL___";
									$lSearch[] = "___PASSWORD___";
									

									$lReplacement = array();
									$lReplacement[] =$userArray['firstname'];
									$lReplacement[] =$userArray['lastname'];
									$lReplacement[] =$GLOBALS["VIEHAUKTION"]["BASE"]["APPNAME"];
									$lReplacement[] =$userArray['email'];
									$lReplacement[] =$newpassword;
									
									$lRecipient=$userArray['email'];
									$subject='';
									
									switch($lang){
										
										case "de": $subject="Ihr neues Passwort."; break;
										case "en": $subject="Your new password."; break;
										default: $subject="Your new password.";
										
										}
									
				
									if(sendEmail('./mails/newpassword.'.$lang.'.txt', $lSearch, $lReplacement,	$subject, $userArray['email'])){
										
										
										

											return ture;
										
										
										
									}
									
									
									
									
								
						}
				
				
			}

		
		
		function changeEmail($User, $user_email, $user_oldpassword){
			
			
			global $gBase;
		
							$lDB=connectDB();
						if (!$lDB->failed){
	
			
									if($userArray=$lDB->getUserWithPassword($User['username'], md5( $user_oldpassword))){
									
									$userArray['email']=$user_email;
									$userArray['active']='0';
									
									$lDB->updateUser($userArray);
									
									
									 $gBase->User=$userArray;
									
									 
									 
									  $gBase->User=$userArray;
								
					
									$lSearch = array();
									$lSearch[] = "___USERNAME___";
									$lSearch[] = "___APPNAME___";
									$lSearch[] = "___LINK___";
									
									$code=substr(md5($userArray['ID'].$userArray['email']), 0, 8);
									$activationLink=$GLOBALS["VIEHAUKTION"]["BASE"]["HTTPROOT"]."activateuser.php?user_id=".$userArray['ID']."&user_email=".$userArray['Email']."&activationcode=".$code."&lang=".$userArray['Lang'];
									
									$subject='';
									
									switch($lang){
										
										case "de": $subject="Aktiviere Deinen Ihren Account."; break;
										case "en": $subject="Activate your account."; break;
										default: $subject="Activate your account.";
										
										}
									
									
									$lReplacement = array();
									$lReplacement[] =$userArray['username'];
									$lReplacement[] =$GLOBALS["VIEHAUKTION"]["BASE"]["APPNAME"];
									$lReplacement[] =$activationLink;
									
									$lRecipient=$userArray['email'];
				
									if(sendEmail('./mails/activationmail.'.$lang.'.txt', $lSearch, $lReplacement, $subject, $userArray['email'])){
										
										
											
											return true;
										
										
										
									}
									 
									 
									 
									 
									 
									}
			
						}
			
			}
		
		
		function changePassword($user_oldpassword, $user_newpassword){
			
				global $gBase;
		
							$lDB=connectDB();
						if (!$lDB->failed){
	
			
									if($userArray=$lDB->getUserByID($gBase->User['id'])){
									if($userArray['password']==md5($user_oldpassword)){
									$userArray['password']=md5($user_newpassword);
									
									$lDB->updateUser($userArray);
									
									
									 $gBase->User=$userArray;
									 
									 
									}else{

										$gBase->Error="WRONG_PASSWORD";
										return false;


									}
								}
						}
			
			}
		
				function sendEmail($emailTemplate, $lSearch, $lReplacement, $subject, $lRecipient) {
					
					$eMail = file_get_contents($emailTemplate);
					$finalEmail = str_replace($lSearch, $lReplacement, $eMail);
				
		
							$mail = new PHPMailer();
							
							$mail->IsSMTP(); // send via SMTP
							$mail->Host = $GLOBALS["VIEHAUKTION"]["EMAIL"]["SERVER"]; // SMTP servers
							$mail->SMTPAuth = false; // turn on SMTP authentication
							
							
							$mail->From = $GLOBALS["VIEHAUKTION"]["EMAIL"]["SENDERADDRESS"];
							$mail->FromName = $GLOBALS["VIEHAUKTION"]["EMAIL"]["SENDERNAME"];
							$mail->AddAddress($lRecipient, $lRecipient);
							
							$mail->IsHTML(false); // send as HTML
							
							$mail->Subject = $subject;
							$mail->Body = $finalEmail;
							
							
							if(!$mail->Send()) {
								return false;
								 }
							
							$mail->ClearAddresses();
							$mail->ClearAttachments();
							
							return true;
							
			
				}
				
				
				
				
				function CreateCode($laenge) {   
				$zeichen = "1234567890abcdefghijklmnopqrstuvwxyz";   
				mt_srand( (double) microtime() * 1000000); 
				$out='';
				for ($i=1;$i<=$laenge;$i++){ 
				$out.= $zeichen[mt_rand(0,(strlen($zeichen)-1))];       
				  }         
				return $out;  
				 
				}
				
				
				
				function addAddress($street, $number, $postcode, $city, $county_id,$state_id){
					
					global $gBase;
		
		$lDB=connectDB();
		if (!$lDB->failed){
	
			
								if($gBase->User!=null){
						
								
								
									$userAddress=array();
									$userAddress['street']=$street;
									$userAddress['number']=$number;
									$userAddress['postcode']=$postcode;
									$userAddress['city']=$city;
									$userAddress['user_id']=$gBase->User['id'];
									$userAddress['type']="stall";
									$userAddress['state_id']=$state_id;
									$userAddress['county_id']=$county_id;
									
									$lDB->addUserAddress($userAddress);
									
									$gBase->UserAddresses=$lDB->getUserAddresses($gBase->User['id']);
									}
		}
					
		}



		function getBuyerToConfirm($page){

								
						global $gBase;
		if($gBase->User['role'] == "admin") {
		$lDB=connectDB();
		if (!$lDB->failed){

				$start=$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"]*$page-$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"];

				 $gBase->RawData["buyer_to_confirm"]=$lDB->getUsers($start, $GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"], 1, "yes");
 				
		}
	}
		}
	

		function getUsers($page){

								
						global $gBase;
			if($gBase->User['role'] == "admin") {
					$lDB=connectDB();
					if (!$lDB->failed){

							$start=$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"]*$page-$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"];

									 $gBase->RawData["users"]=$lDB->getUsers($start, $GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"], 0, "");

					}
				}
		}
			
		function changeUserStatus($user_id, $activate_status){

		global $gBase;
		if($gBase->User['role'] == "admin") {
		$lDB=connectDB();
		if (!$lDB->failed){

			$userArray=array();

				if($userArray=$lDB->getUserByID($user_id)){


					$userArray["active"]=$activate_status;
					$lDB->updateUser($userArray);

				}


		}
	}


		}


	function getUserDetails($user_id){


		global $gBase;
		if($gBase->User['role'] == "admin") {
		$lDB=connectDB();
		if (!$lDB->failed){
			$userArray=array();
				if($userArray=$lDB->getUserByID($user_id)){
					$gBase->RawData=array();
					$gBase->RawData["user_data"]=$userArray;
					$gBase->RawData["user_addresses"]=$lDB->getUserAddresses($user_id);
					$gBase->RawData["user_files"]=$lDB->getUserFiles($user_id);
					$gBase->RawData["ratings_about_user"]=$lDB->getRatingForUserId($user_id);
					$gBase->RawData["ratings_from_user"]=$lDB->getRatingFromUserId($user_id);



				}

		}
	}

		
	}


	function imitateUser($user_id){


		global $gBase;
		if($gBase->User['role'] == "admin") {
		$lDB=connectDB();
		if (!$lDB->failed){
	
			$userArray=array();
			if($userArray=$lDB->getUserByID($user_id)){

 							$gBase->User=$userArray;
							$gBase->UserAddresses=$lDB->getUserAddresses($userArray['id']);
					}

		}
	}



	}


?>