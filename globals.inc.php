<?php


	/*
    |-----------------------------------------------------------------------------------------------------------------------------------
    | globale Variablen     VIEHAUKTION - BASE - Allgemeine globale Variablen
    |
    |---------------------------------------------------------------------------------------------------------------------------------*/


	$GLOBALS["VIEHAUKTION"]["BASE"]["APPNAME"]			= "viehauktion.com";
	$GLOBALS["VIEHAUKTION"]["BASE"]["HTTPROOT"] 		= "http://www.viehauktion.com/"; 
	//$GLOBALS["VIEHAUKTION"]["BASE"]["IMAGESROOT"] 	= 'http://quartett.s3-external-3.amazonaws.com/';
		
		$GLOBALS["VIEHAUKTION"]["BASE"]["PASSWORDGENERATORSECRET"] ="geheimzusatz";
	

	/*
    |-----------------------------------------------------------------------------------------------------------------------------------
    | globale Variablen     VIEHAUKTION - DATABASE - Allgemeine Grundeinstellungen der MySQL Datenbank
    |
    |---------------------------------------------------------------------------------------------------------------------------------*/

	#$GLOBALS["VIEHAUKTION"]["DATABASE"]["HOST"]="robstardb.cm4zsefieiuw.eu-west-1.rds.amazonaws.com";
	$GLOBALS["VIEHAUKTION"]["DATABASE"]["HOST"]="localhost";
	$GLOBALS["VIEHAUKTION"]["DATABASE"]["USER"]="viehauktionuser";
	$GLOBALS["VIEHAUKTION"]["DATABASE"]["USERPASSWORD"]="I?fw%MK";
	$GLOBALS["VIEHAUKTION"]["DATABASE"]["NAME"]="viehauktion";
	
	
	
	
	/*
    |-----------------------------------------------------------------------------------------------------------------------------------
    | globale Variablen    VIEHAUKTION - E-MAIL-CONF
    |
    |---------------------------------------------------------------------------------------------------------------------------------*/

	$GLOBALS["VIEHAUKTION"]["EMAIL"]["SENDERNAME"]="Service | Viehauktion.com";
	$GLOBALS["VIEHAUKTION"]["EMAIL"]["SENDERADDRESS"]="service@viehauktion.com";
	$GLOBALS["VIEHAUKTION"]["EMAIL"]["SERVER"]="localhost";
	

		
	/*
    |-----------------------------------------------------------------------------------------------------------------------------------
    | globale Variablen    VIEHAUKTION - AMAZON
    |
    |---------------------------------------------------------------------------------------------------------------------------------*/

		$GLOBALS["VIEHAUKTION"]["AMAZON"]["ID"]="AKIAIVIIEFOEB7DQN6GA";
		$GLOBALS["VIEHAUKTION"]["AMAZON"]["KEY"]="IRELEZ5ZbBV1xLsHOJDbQhgMw515JtsCT77XNJz3";
			
		$GLOBALS["VIEHAUKTION"]["AMAZON"]["BUCKET"]="viehauktion";
	
	
	?>