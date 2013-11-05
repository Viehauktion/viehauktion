<?php
	require_once ('fpdf/fpdf.php');

	class SRBill extends FPDF {
		//Page header
		function Header() {
			//Logo
				$this->Image(getcwd().'/img/syborgbill.jpg', 0, 0, 211, 22);
			//Arial bold 15
			$this->SetFont('Arial', 'B', 22);
			//Move to the right
			$this->Cell(150);
			// Überschrift
			$this->SetTextColor(150,150,150);
			
			$this->Cell(30, 40, 'Rechnung', 0, 0, 'L');
			//Line break
			$this->Ln(20);
		}
	

	function formatPrice($price){

		$priceString="".$price;

		$splittedPrice=explode(".", $priceString);
		if(count($splittedPrice)==1){

			$priceString.=".00";
		}else{
		if(strlen($splittedPrice[1])=="1"){
			$priceString.="0";
		}

}



return $priceString;

	}
	
//Page footer
		function Footer() {
			// Spaltenbreite für die Footer Table
			$lWidth = 60;
			//Position at 4.5 cm from bottom
			$this->SetX(24);
			$this->SetY(-45);
			//Arial 8
			$this->SetFont('Arial', 'B', 8);
			
			$this->Cell($lWidth, 0, '2M Viehauktionen UG (haftungsbeschränkt)', 0, 0, 'L');
		
			$this->Cell($lWidth, 0, 'www.viehauktion.com', 0, 0, 'L');
				$this->SetFont('Arial', '', 8);
			$this->Cell($lWidth, 0, '', 0, 0, 'L');
			
			$this->Ln(4);
				$this->SetFont('Arial', 'B', 8);
			$this->Cell($lWidth, 0, 'Bahnhofstrasse 6', 0, 0, 'L');
				$this->SetFont('Arial', '', 8);
			$this->Cell($lWidth, 0, 'Volkbank Löningen 28065061 ', 0, 0, 'L');
			$this->Cell($lWidth, 0, '', 0, 0, 'L');

			$this->Ln(4);
				$this->SetFont('Arial', 'B', 8);
			$this->Cell($lWidth, 0, '49699 Lindern', 0, 0, 'L');
				$this->SetFont('Arial', '', 8);
			$this->Cell($lWidth, 0, 'Konto 1205934000', 0, 0, 'L');
			$this->Cell($lWidth, 0, 'Ust-ID beantragt ', 0, 0, 'L');						
			
			$this->Ln(4);			
				$this->SetFont('Arial', 'B', 8);
			$this->Cell($lWidth, 0, 'E-Mail:  info@viehauktion.com', 0, 0, 'L');
				$this->SetFont('Arial', '', 8);
			$this->Cell($lWidth, 0, 'IBAN DE25280650611205934000', 0, 0, 'L');
			$this->Cell($lWidth, 0, 'St.-Nr.  beantragt', 0, 0, 'L');									

			$this->Ln(4);			
				$this->SetFont('Arial', 'B', 8);
			$this->Cell($lWidth, 0, 'Tel (+49) 5957 / 486', 0, 0, 'L');
				$this->SetFont('Arial', '', 8);
			$this->Cell($lWidth, 0, 'BIC  GENODEF1LOG', 0, 0, 'L');
			$this->Cell($lWidth, 0, 'Geschäftsführung:  Felix Meyborg', 0, 0, 'L');												
		}
		
		// Setze den Empfänger
		function printRecipient($pCompany, $pName, $pStreet, $pCity, $pCountry) {			
			$this->SetY(43);
			$this->SetX(24);
			$this->SetFont('Arial', 'B', 11);
			$this->Cell(100, 4, "An", 0, 1, 'L');
			$this->SetX(24);
			$this->Cell(100, 4, utf8_decode($pCompany), 0, 1, 'L');
			$this->SetX(24);
			$this->Cell(100, 4, utf8_decode($pName), 0, 1, 'L');
			$this->SetX(24);
			$this->Cell(100, 4, utf8_decode($pStreet), 0, 1, 'L');
			$this->SetY(60);
			$this->SetX(24);
			$this->Cell(100, 4, utf8_decode($pCity), 0, 1, 'L');
			$this->SetX(24);
			$this->Cell(100, 4, utf8_decode($pCountry), 0, 1, 'L');
		}
		
	
		function printBuyer($pCompany, $pName, $pStreet, $pCity, $pCountry) {			
			$this->SetXY(50,190);
			$this->SetFont('Arial', '', 10);
			$this->Cell(100, 4, "Die Tiere wurden ersteigert von:", 0, 1, 'L');
			$this->SetX(60);
			$this->Cell(100, 4, utf8_decode($pCompany), 0, 1, 'L');
			$this->SetX(60);
			$this->Cell(100, 4, utf8_decode($pName), 0, 1, 'L');
			$this->SetX(60);
			$this->Cell(100, 4, utf8_decode($pStreet), 0, 1, 'L');
			$this->SetX(60);
			$this->Cell(100, 4, utf8_decode($pCity), 0, 1, 'L');
			$this->SetX(60);
			$this->Cell(100, 4, utf8_decode($pCountry), 0, 1, 'L');
		}
		
		
		function printBillData($pBillNo, $pAuctionID, $pUserID, $pDate, $pAmountOfAnimals, $pNettoPrice, $pVAT, $pFontSize) {
			
			$this->SetY(75);
			$this->SetFont('Arial', 'B', $pFontSize);
			$this->SetX(24);
			$this->Cell(100, 4, "Rechnung-Nr.:", 0, 1, 'L');
			$this->SetX(24);
			$this->Cell(100, 4, "Auktions-Nr.:", 0, 1, 'L');
			$this->Ln(3);
			$this->SetX(24);
			$this->Cell(100, 4, "Kunden-Nr.:", 0, 1, 'L');
			$this->SetX(24);
			$this->Cell(100, 4, "Datum:", 0, 1, 'L');
			$this->SetX(24);
			$this->Cell(100, 4, "Leistungszeitraum:", 0, 1, 'L');
			
			
			
			
			$this->SetY(75);
			$this->SetX(75);
			$this->SetFont('Arial', '', $pFontSize);
			$this->Cell(100, 4, $pBillNo, 0, 1, 'L');
			$this->SetX(75);
			$this->Cell(100, 4, $pAuctionID, 0, 1, 'L');
			$this->Ln(3);
			$this->SetX(75);
			$this->Cell(100, 4, $pUserID, 0, 1, 'L');
			$this->SetX(75);
			$this->Cell(100, 4, $pDate, 0, 1, 'L');
			$this->SetX(75);
			$this->Cell(100, 4, $pDate, 0, 1, 'L');
			$this->SetX(75);
			
		    $bruttoprice=$this->formatPrice(($pNettoPrice*(100+$pVAT))/100);
			
			$this->SetY(110);
			$this->SetFont('Arial', '', '10');
			$this->SetX(24);
			
			$this->Cell(80, 4, "Es wurden erfolgreich $pAmountOfAnimals Tiere auf viehauktion.com versteigert.", 0, 1, 'L');
			$this->SetX(24);
			$this->Cell(80, 4, "Wir berechnen pro Tier eine Provision von ".number_format($pNettoPrice, 2, '.', '')." € ( ".number_format($bruttoprice, 2, '.', '')." € inkl. Mehrwertsteuer ).", 0, 1, 'L');
			$this->SetY(130);
			$this->SetX(24);
			$this->Cell(80, 4, "Daraus ergibt sich ein Rechnungbetrag von: ", 0, 1, 'L');
			$totalNettoPrice=$this->formatPrice($pAmountOfAnimals*$pNettoPrice);
			$this->SetY(140);
			$this->SetX(24);

			$this->Cell(80, 4, "Leistung:                                   ".$pAmountOfAnimals." Tiere á ".number_format($pNettoPrice, 2, '.', '')." €  =     ".number_format($totalNettoPrice, 2, '.', '')." €", 0, 1, 'L');
			$vatPrice=($totalNettoPrice/100)*19;
			$this->SetX(24);
			$this->Cell(80, 4, "Mehrwertsteuer ($pVAT %):                                                  +".number_format($vatPrice, 2, '.', '')." €", 0, 1, 'L');
				$this->SetX(24);
			$this->Cell(80, 4, "________________________________________________________", 0, 1, 'L');
			$totalBruttoPrice=$vatPrice+$totalNettoPrice;
			$this->SetX(24);
			$this->SetFont('Arial', 'B', '10');
			$this->Cell(80, 4, "Gesamtbetrag:                                                               ".number_format($totalBruttoPrice, 2, '.', '')." €", 0, 0, 'L');



					$this->SetY(170);

					$this->SetX(24);
					$this->Cell(175, 4, "Bitte überweisen Sie den Gesamtbetrag unter Nennung der Rechnungs-Nr.", 0, 1, 'L');
					$this->SetX(24);
					$this->Cell(175, 4, "binnen 14 Tagen auf das untengenannte Konto.", 0, 1, 'L');





		}




		function printStornoData($isAuction, $pBillNo, $pAuctionID, $pUserID, $pDate,  $pnettoPrice, $pVAT, $pFontSize) {
			
			$this->SetY(75);
			$this->SetFont('Arial', 'B', $pFontSize);
			$this->SetX(24);
			$this->Cell(100, 4, "Rechnung-Nr.:", 0, 1, 'L');
			$this->SetX(24);
			$this->Cell(100, 4, "Auktions-Nr.:", 0, 1, 'L');
			$this->Ln(3);
			$this->SetX(24);
			$this->Cell(100, 4, "Kunden-Nr.:", 0, 1, 'L');
			$this->SetX(24);
			$this->Cell(100, 4, "Datum:", 0, 1, 'L');
			$this->SetX(24);
			$this->Cell(100, 4, "Leistungszeitraum:", 0, 1, 'L');
			
			
			
			
			$this->SetY(75);
			$this->SetX(75);
			$this->SetFont('Arial', '', $pFontSize);
			$this->Cell(100, 4, $pBillNo, 0, 1, 'L');
			$this->SetX(75);
			$this->Cell(100, 4, $pAuctionID, 0, 1, 'L');
			$this->Ln(3);
			$this->SetX(75);
			$this->Cell(100, 4, $pUserID, 0, 1, 'L');
			$this->SetX(75);
			$this->Cell(100, 4, $pDate, 0, 1, 'L');
			$this->SetX(75);
			$this->Cell(100, 4, $pDate, 0, 1, 'L');
			$this->SetX(75);
			
		    $bruttoprice=$pnettoPrice/(100)*119;
			
			$this->SetY(110);
			$this->SetFont('Arial', '', '10');
			$this->SetX(24);
			$leistung="";
			if($isAuction){
				$this->Cell(80, 4, "Sie stornierten die erfolgreiche Auktion mit Nr. '".$pAuctionID."'. ", 0, 1, 'L');
				$leistung="Stornierung der erfolgreichen Auktion mit Nr. '".$pAuctionID."'. ";
			}else{
				$this->Cell(80, 4, "Sie stornierten den erfolgreichen Kauf/Verkauf mit Nr. '".$pAuctionID."'. ", 0, 1, 'L');
				$leistung="Stornierung des erfolgreichen Kaufs/Verkaufs mit Nr. '".$pAuctionID."'. ";
			}
				$this->SetX(24);
			$this->Cell(80, 4, "Hierfür berechnen wir Ihnen einen Verwaltungsgebühr von ".number_format($pnettoPrice, 2, '.', '')." € (exkl. Mehrwertsteuer ).", 0, 1, 'L');
			$this->SetY(130);
			$this->SetX(24);
			$this->Cell(80, 4, "Daraus ergibt sich ein Rechnungbetrag von: ", 0, 1, 'L');
			
			$this->SetY(140);
			$this->SetX(24);

			$this->Cell(80, 4, "Leistung:                       ".$leistung.": ".number_format($pnettoPrice, 2, '.', '')." €  =     ".number_format($pnettoPrice, 2, '.', '')." €", 0, 1, 'L');
			$vatPrice=($pnettoPrice/100)*$pVAT;
			$this->SetX(24);
			$this->Cell(80, 4, "Mehrwertsteuer ($pVAT %):                                                +".number_format($vatPrice, 2, '.', '')." €", 0, 1, 'L');
			$this->SetX(24);
			$this->Cell(80, 4, "________________________________________________________", 0, 1, 'L');
			
			$this->SetX(24);
			$this->SetFont('Arial', 'B', '10');
			$this->Cell(80, 4, "Gesamtbetrag:                                                               ".number_format($bruttoprice, 2, '.', '')." €", 0, 0, 'L');



					$this->SetY(170);

					$this->SetX(24);
					$this->Cell(175, 4, "Bitte überweisen Sie den Gesamtbetrag unter Nennung der Rechnungs-Nr.", 0, 1, 'L');
					$this->SetX(24);
					$this->Cell(175, 4, "binnen 14 Tagen auf das untengenannte Konto.", 0, 1, 'L');





		}
		
		
		
				

			
			
		
	}
	

?>