<?php


	/*
    |-----------------------------------------------------------------------------------------------------------------------------------
    | globale Variablen     VIEHAUKTION - BASE - Allgemeine globale Variablen
    |
    |---------------------------------------------------------------------------------------------------------------------------------*/


	$GLOBALS["VIEHAUKTION"]["BASE"]["APPNAME"]			= "viehauktion.com";
	$GLOBALS["VIEHAUKTION"]["BASE"]["HTTPROOT"] 		= "http://www.viehauktion.com/"; 

		$GLOBALS["VIEHAUKTION"]["BASE"]["PASSWORDGENERATORSECRET"] ="geheimzusatz";
	

	/*
    |-----------------------------------------------------------------------------------------------------------------------------------
    | globale Variablen     VIEHAUKTION - DATABASE - Allgemeine Grundeinstellungen der MySQL Datenbank
    |
    |---------------------------------------------------------------------------------------------------------------------------------*/

	$GLOBALS["VIEHAUKTION"]["DATABASE"]["HOST"]="viehauctiondb.cwpbmck0bxwf.eu-west-1.rds.amazonaws.com";
	//$GLOBALS["VIEHAUKTION"]["DATABASE"]["HOST"]="localhost";
	$GLOBALS["VIEHAUKTION"]["DATABASE"]["USER"]="viehuser";
	$GLOBALS["VIEHAUKTION"]["DATABASE"]["USERPASSWORD"]="v1eh4uction";
	$GLOBALS["VIEHAUKTION"]["DATABASE"]["NAME"]="viehauktion";
	
	
	
	
	/*
    |-----------------------------------------------------------------------------------------------------------------------------------
    | globale Variablen    VIEHAUKTION - E-MAIL-CONF
    |
    |---------------------------------------------------------------------------------------------------------------------------------*/

	$GLOBALS["VIEHAUKTION"]["EMAIL"]["SENDERNAME"]="Service | Viehauktion.com";
	$GLOBALS["VIEHAUKTION"]["EMAIL"]["SENDERADDRESS"]="service@viehauktion.com";
	$GLOBALS["VIEHAUKTION"]["EMAIL"]["SERVER"]="smtp.mandrillapp.com";
	$GLOBALS["VIEHAUKTION"]["EMAIL"]["USERNAME"]="simon.meyborg@viehauktion.com";
	$GLOBALS["VIEHAUKTION"]["EMAIL"]["PASSWORD"]="-R4gV30ldAB6Tjlvnfnq0w";
	
		$GLOBALS["VIEHAUKTION"]["EMAIL"]["ACTIVATOR"]="meyborg@syborgstudios.com";



		/*
    |-----------------------------------------------------------------------------------------------------------------------------------
    | globale Variablen    VIEHAUKTION - Invoice and stuff
    |
    |---------------------------------------------------------------------------------------------------------------------------------*/

	$GLOBALS["VIEHAUKTION"]["STORNO"]["TIME"]=120;
	$GLOBALS["VIEHAUKTION"]["STORNO"]["MONEY"]=30;
	$GLOBALS["VIEHAUKTION"]["VAT"]=19;
	$GLOBALS["VIEHAUKTION"]["PROVISION"]=0.40;
	$GLOBALS["VIEHAUKTION"]["FERKEL_PROVISION"]=0.15;
	$GLOBALS["VIEHAUKTION"]["REMINDER_ONE"]=5;
	$GLOBALS["VIEHAUKTION"]["REMINDER_TWO"]=10;

	$GLOBALS["VIEHAUKTION"]["PAGEELEMENTS"]=10;
	$GLOBALS["VIEHAUKTION"]["SMALLPAGEELEMENTS"]=5;

		
	/*
    |-----------------------------------------------------------------------------------------------------------------------------------
    | globale Variablen    VIEHAUKTION - AMAZON
    |
    |---------------------------------------------------------------------------------------------------------------------------------*/

		$GLOBALS["VIEHAUKTION"]["AMAZON"]["ID"]="AKIAIVIIEFOEB7DQN6GA";
		$GLOBALS["VIEHAUKTION"]["AMAZON"]["KEY"]="IRELEZ5ZbBV1xLsHOJDbQhgMw515JtsCT77XNJz3";	
		$GLOBALS["VIEHAUKTION"]["AMAZON"]["BUCKET"]="viehauktion";

		$GLOBALS["VIEHAUKTION"]["AMAZON"]["INVOICEURL"]="http://invoices.viehauktion.com/";
		$GLOBALS["VIEHAUKTION"]["AMAZON"]["DOCUMENTSURL"]="http://documents.viehauktion.com/";
	
	
	?>