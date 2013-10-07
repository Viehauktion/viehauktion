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
			// �berschrift
			$this->SetTextColor(150,150,150);
			
			$this->Cell(30, 40, 'Rechnung', 0, 0, 'L');
			//Line break
			$this->Ln(20);
		}
	
	
//Page footer
		function Footer() {
			// Spaltenbreite f�r die Footer Table
			$lWidth = 60;
			//Position at 4.5 cm from bottom
			$this->SetX(24);
			$this->SetY(-45);
			//Arial 8
			$this->SetFont('Arial', 'B', 8);
			
			$this->Cell($lWidth, 0, 'SYBORG STUDIOS | Virtual Tour Architect', 0, 0, 'L');
		
			$this->Cell($lWidth, 0, 'www.syborgstudios.com | www.virtualtourarchitect.com', 0, 0, 'L');
				$this->SetFont('Arial', '', 8);
			$this->Cell($lWidth, 0, '', 0, 0, 'L');
			
			$this->Ln(4);
				$this->SetFont('Arial', 'B', 8);
			$this->Cell($lWidth, 0, 'Ruhrstrasse 114', 0, 0, 'L');
				$this->SetFont('Arial', '', 8);
			$this->Cell($lWidth, 0, 'ING Diba 50010517 ', 0, 0, 'L');
			$this->Cell($lWidth, 0, '', 0, 0, 'L');

			$this->Ln(4);
				$this->SetFont('Arial', 'B', 8);
			$this->Cell($lWidth, 0, '22761 Hamburg', 0, 0, 'L');
				$this->SetFont('Arial', '', 8);
			$this->Cell($lWidth, 0, 'Konto 5531710 762', 0, 0, 'L');
			$this->Cell($lWidth, 0, 'Ust-ID DE253919539 ', 0, 0, 'L');						
			
			$this->Ln(4);			
				$this->SetFont('Arial', 'B', 8);
			$this->Cell($lWidth, 0, 'e-Mail  buchhaltung@syborgstudios.com', 0, 0, 'L');
				$this->SetFont('Arial', '', 8);
			$this->Cell($lWidth, 0, 'IBAN DE27500105175531710762', 0, 0, 'L');
			$this->Cell($lWidth, 0, 'FA T�b. St.-Nr.  86320/67014', 0, 0, 'L');									

			$this->Ln(4);			
				$this->SetFont('Arial', 'B', 8);
			$this->Cell($lWidth, 0, 'Tel (+49) 07071 / 85888 - 7', 0, 0, 'L');
				$this->SetFont('Arial', '', 8);
			$this->Cell($lWidth, 0, 'BIC  INGDDEFF', 0, 0, 'L');
			$this->Cell($lWidth, 0, 'Gesch�ftsf�hrung:  Simon Meyborg', 0, 0, 'L');												
		}
		
		// Setze den Empf�nger
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
		
		
		function printBillData($pBillNo, $pAuctionID, $pUserID, $pDate, $pAmountOfAnimals, $pBruttoPrice, $pVAT, $pFontSize) {
			
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
			
		    $nettoprice=($pBruttoPrice/(100+$pVAT))*100;
			
			$this->SetY(110);
			$this->SetFont('Arial', '', '10');
			$this->SetX(24);
			
			$this->Cell(80, 4, "Es wurden erfolgreich $pAmountOfAnimals Tiere auf viehauktion.com versteigert.", 0, 1, 'L');
			$this->SetX(24);
			$this->Cell(80, 4, "Wir berechnen pro Tier eine Provision von $nettoprice � ( ".number_format($pBruttoPrice, 2, '.', '')."0 � inkl. Mehrwertsteuer ).", 0, 1, 'L');
			$this->SetY(130);
			$this->SetX(24);
			$this->Cell(80, 4, "Daraus ergibt sich ein Rechnungbetrag von: ", 0, 1, 'L');
			$totalNettoPrice=$pAmountOfAnimals*$nettoprice;
			$this->SetY(140);
			$this->SetX(24);

			$this->Cell(80, 4, "Leistung:                                   ".$pAmountOfAnimals." Tiere � ".number_format($nettoprice, 2, '.', '')." �  =     ".number_format($totalNettoPrice, 2, '.', '')." �", 0, 1, 'L');
			$vatPrice=($totalNettoPrice/100)*19;
			$this->SetX(24);
			$this->Cell(80, 4, "Mehrwertsteuer ($pVAT %):                                                +".number_format($vatPrice, 2, '.', '')." �", 0, 1, 'L');
				$this->SetX(24);
			$this->Cell(80, 4, "________________________________________________________", 0, 1, 'L');
			$totalBruttoPrice=$vatPrice+$totalNettoPrice;
			$this->SetX(24);
			$this->SetFont('Arial', 'B', '10');
			$this->Cell(80, 4, "Gesamtbetrag:                                                               ".number_format($totalBruttoPrice, 2, '.', '')." �", 0, 0, 'L');



					$this->SetY(170);

					$this->SetX(24);
					$this->Cell(175, 4, "Bitte �berweisen Sie den Gesamtbetrag unter Nennung der Rechnungs-Nr.", 0, 1, 'L');
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
			$this->Cell(80, 4, "Hierf�r berechnen wir Ihnen einen Verwaltungsgeb�hr von ".number_format($pnettoPrice, 2, '.', '')." � (exkl. Mehrwertsteuer ).", 0, 1, 'L');
			$this->SetY(130);
			$this->SetX(24);
			$this->Cell(80, 4, "Daraus ergibt sich ein Rechnungbetrag von: ", 0, 1, 'L');
			
			$this->SetY(140);
			$this->SetX(24);

			$this->Cell(80, 4, "Leistung:                       ".$leistung.": ".number_format($pnettoPrice, 2, '.', '')." �  =     ".number_format($pnettoPrice, 2, '.', '')." �", 0, 1, 'L');
			$vatPrice=($pnettoPrice/100)*$pVAT;
			$this->SetX(24);
			$this->Cell(80, 4, "Mehrwertsteuer ($pVAT %):                                                +".number_format($vatPrice, 2, '.', '')." �", 0, 1, 'L');
			$this->SetX(24);
			$this->Cell(80, 4, "________________________________________________________", 0, 1, 'L');
			
			$this->SetX(24);
			$this->SetFont('Arial', 'B', '10');
			$this->Cell(80, 4, "Gesamtbetrag:                                                               ".number_format($bruttoprice, 2, '.', '')." �", 0, 0, 'L');



					$this->SetY(170);

					$this->SetX(24);
					$this->Cell(175, 4, "Bitte �berweisen Sie den Gesamtbetrag unter Nennung der Rechnungs-Nr.", 0, 1, 'L');
					$this->SetX(24);
					$this->Cell(175, 4, "binnen 14 Tagen auf das untengenannte Konto.", 0, 1, 'L');





		}
		
		
		
				

			
			
		
	}
	

?>