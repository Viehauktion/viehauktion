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
	
	
//Page footer
		function Footer() {
			// Spaltenbreite für die Footer Table
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
			$this->Cell($lWidth, 0, 'FA Tüb. St.-Nr.  86320/67014', 0, 0, 'L');									

			$this->Ln(4);			
				$this->SetFont('Arial', 'B', 8);
			$this->Cell($lWidth, 0, 'Tel (+49) 07071 / 85888 - 7', 0, 0, 'L');
				$this->SetFont('Arial', '', 8);
			$this->Cell($lWidth, 0, 'BIC  INGDDEFF', 0, 0, 'L');
			$this->Cell($lWidth, 0, 'Geschäftsführung:  Simon Meyborg', 0, 0, 'L');												
		}
		
		// Setze den Empfänger
		function printRecipient($pCompany, $pName, $pStreet, $pCity, $pCountry) {			
			$this->SetY(43);
			$this->SetX(24);
			$this->SetFont('Arial', 'B', 11);
			$this->Cell(100, 4, "An", 0, 1, 'L');
			$this->SetX(24);
			$this->Cell(100, 4, $pCompany, 0, 1, 'L');
			$this->SetX(24);
			$this->Cell(100, 4, $pName, 0, 1, 'L');
			$this->SetX(24);
			$this->Cell(100, 4, $pStreet, 0, 1, 'L');
			$this->SetY(60);
			$this->SetX(24);
			$this->Cell(100, 4, $pCity, 0, 1, 'L');
			$this->SetX(24);
			$this->Cell(100, 4, $pCountry, 0, 1, 'L');
		}
		
	
		function printBuyer($pCompany, $pName, $pStreet, $pCity, $pCountry) {			
			$this->SetXY(50,190);
			$this->SetFont('Arial', '', 10);
			$this->Cell(100, 4, "Die Tiere wurden ersteigert von:", 0, 1, 'L');
			$this->SetX(60);
			$this->Cell(100, 4, $pCompany, 0, 1, 'L');
			$this->SetX(60);
			$this->Cell(100, 4, $pName, 0, 1, 'L');
			$this->SetX(60);
			$this->Cell(100, 4, $pStreet, 0, 1, 'L');
			$this->SetX(60);
			$this->Cell(100, 4, $pCity, 0, 1, 'L');
			$this->SetX(60);
			$this->Cell(100, 4, $pCountry, 0, 1, 'L');
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
			
		    $nettoprice=round(($pBruttoPrice/(100+$pVAT))*100,2);
			
			$this->SetY(110);
			$this->SetFont('Arial', '', '10');
			$this->SetX(24);
			
			$this->Cell(80, 4, "Es wurden erfolgreich $pAmountOfAnimals Tiere auf viehauktion.com versteigert.", 0, 1, 'L');
			$this->SetX(24);
			$this->Cell(80, 4, "Wir berechnen pro Tier eine Provision von $nettoprice € ( ".round($pBruttoPrice,2)."0 € inkl. Mehrwertsteuer ).", 0, 1, 'L');
			$this->SetY(130);
			$this->SetX(24);
			$this->Cell(80, 4, "Daraus ergibt sich ein Rechnungbetrag von: ", 0, 1, 'L');
			$totalNettoPrice=round($pAmountOfAnimals*$nettoprice,2);
			$this->SetY(140);
			$this->SetX(24);

			$this->Cell(80, 4, "Leistung:                                   ".$pAmountOfAnimals." Tiere á ".$nettoprice." €  =     ".$totalNettoPrice." €", 0, 1, 'L');
			$vatPrice=round(($totalNettoPrice/100)*19,2);
			$this->SetX(24);
			$this->Cell(80, 4, "Mehrwertsteuer ($pVAT %):                                                +".$vatPrice." €", 0, 1, 'L');
				$this->SetX(24);
			$this->Cell(80, 4, "________________________________________________________", 0, 1, 'L');
			$totalBruttoPrice=round($vatPrice+$totalNettoPrice,2);
$this->SetX(24);
$this->SetFont('Arial', 'B', '10');
			$this->Cell(80, 4, "Gesamtbetrag:                                                               ".$totalBruttoPrice." €", 0, 0, 'L');



					$this->SetY(170);

					$this->SetX(24);
					$this->Cell(175, 4, "Bitte überweisen Sie den Gesamtbetrag unter Nennung der Rechnungs-Nr.", 0, 1, 'L');
					$this->SetX(24);
					$this->Cell(175, 4, "binnen 14 Tagen auf das untengenannte Konto.", 0, 1, 'L');





		}
		
		
		
				

			
			
		
	}
	

?>