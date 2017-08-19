<?php
require('../fpdf.php');

class PDF extends FPDF
{
// Page header
function Header()
{
	// Logo
	$this->Image('logo.png',10,6,30);
	// Arial bold 15
	$this->SetFont('Arial','B',15);
	// Move to the right
	$this->Cell(80);
	// Title
	$this->Cell(30,10,'Title',1,0,'C');
	// Line break
	$this->Ln(20);
}

// Page footer
function Footer()
{
	$this->SetY(-100);
	$w = array(8,13,50,9,10, 35, 40,35); //Width		
		$this->Cell(array_sum($w),5,'','B',0,'C',false);
		$this->Ln();
		$this->Cell(array_sum($w),5,'Status/Condition','LR',0,'L',false);
		$this->Ln();
		$header = array('', '','Unused', '','Terminated Subs./Good or Defective','','','Others: ');
		$border = array('L', 'LTB', 'L', 'LTB', 'L','LTB', 'L', 'R'); //Border
		$w = array(5,7,51,7,48, 7, 40,35); //Width
		
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],6,$header[$i],$border[$i],0,'L',false);
		$this->Ln();
		
		$this->Cell(array_sum($w),1,'','LR',0,'C',false);
		$this->Ln();
		$header = array('', '','Defective', '','Wrong Issuance','','','');
		$border = array('L', 'LTB', 'L', 'LTB', 'L','', '', 'R'); //Border
		$w = array(5,7,51,7,48, 7, 40,35); //Width
		
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],6,$header[$i],$border[$i],0,'L',false);
		$this->Ln();
				
		$this->Cell(array_sum($w),2,'','LR',0,'C',false);
		$this->Ln();
		$header = array('Returned by:', '','Date:','', 'Received by:','','Date:','','Posted in SAP by Date:');
		$border = array('LT', 'T', 'T','TR', 'T', 'T','T','TR', 'TR'); //Border
		$w = array(16,34,8,12,25,45, 10, 12, 38); //Width
		
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],6,$header[$i],$border[$i],0,'L',false);
		$this->Ln();
		
		$this->SetFont('Arial','B',7);
		$header = array('', 'Marianz','','', '','','','','');
		$border = array('L', '', '','R', '', '','','R', 'R'); //Border
		$w = array(16,34,8,12,25,45, 10, 12, 38); //Width
		
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],3,$header[$i],$border[$i],0,'L',false);
		$this->Ln();
		$this->SetFont('Arial','',5);
		$header = array('', '(Signature over Printed Name)','','', '','(Signature over Printed Name)','','','');
		$border = array('L', '', '','R', '', '','','R', 'R'); //Border
		$w = array(16,34,8,12,25,45, 10, 12, 38); //Width
		
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],3,$header[$i],$border[$i],0,'L',false);
		$this->Ln();
		
		$this->SetFont('Arial','',7);
		$header = array('Approved by:', '','Date:','', 'Doc. Recv. For posting by:','','Date:','','SAP Material Doc. No.');
		$border = array('LT', 'T', 'T','TR', 'T', 'T','T','TR', 'TR'); //Border
		$w = array(16,34,8,12,25,45, 10, 12, 38); //Width
		
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],6,$header[$i],$border[$i],0,'L',false);
		$this->Ln();
		
		$this->SetFont('Arial','B',7);
		$header = array('', 'Rey','','', '','','','','');
		$border = array('L', '', '','R', '', '','','R', 'R'); //Border
		$w = array(16,34,8,12,25,45, 10, 12, 38); //Width
		
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],3,$header[$i],$border[$i],0,'L',false);
		$this->Ln();
		
		$this->SetFont('Arial','',5);
		$header = array('', '(Signature over Printed Name)','','', '','(Signature over Printed Name)','','','');
		$border = array('L', '', '','R', '', '','','R', 'R'); //Border
		$w = array(16,34,8,12,25,45, 10, 12, 38); //Width
		
		for($i=0;$i<count($header);$i++)
			$this->Cell($w[$i],3,$header[$i],$border[$i],0,'L',false);
		$this->Ln();
		
		$this->Cell(array_sum($w),5,'','T',0,'C',false);
		$this->Ln();
		
		
		
	// Position at 1.5 cm from bottom
	//$this->SetY(-15);
	// Arial italic 8
	$this->SetFont('Arial','I',8);
	// Page number
	$this->Cell(0,10,'Page '.$this->PageNo().'/{nb}',0,0,'C');
}
}

// Instanciation of inherited class
$pdf = new PDF();
$pdf->AliasNbPages();
$pdf->AddPage();
$pdf->SetFont('Times','',12);
for($i=1;$i<=400;$i++)
	$pdf->Cell(0,10,'Printing line number '.$i,0,1);
$pdf->Output();
?>
