<?php
require_once ('../libraries/PHPExcel/Classes/PHPExcel.php');
require_once ('../setup.php');


$table ='FOR-GOOGLEDRIVE-';
$date		= decode_url((isset($_GET['dt']) && $_GET['dt'] != '') ? $_GET['dt'] : date('Y-m-d'));
$pdt		= plain_date($date);
$fdt		= force_date($date);
$ddt		= dotted_date($date);

$filename	= $table.' '.$ddt.'.xlsx';

$objPHPExcel = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objPHPExcel->load('template.xlsx');
$objPHPExcel->getProperties()->setCreator("Telcomtrix Philippines Inc.")
							 ->setLastModifiedBy("Telcomtrix Philippines Inc.")
							 ->setTitle($filename)
							 ->setSubject("Dispatch Summary ".$ddt)
							 ->setDescription("This document is generated from Cluster Helper.")
							 ->setKeywords("")
							 ->setCategory("Developer: Marian'O");


$sheet1 = $objPHPExcel->getActiveSheet()->copy();






$company_style = array(
    'font' => array('bold' => true, 'size' => 12,),
    'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_LEFT,),
);
$address_style = array(
    'font' => array('size' => 8,),
    'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_LEFT,'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,),
);


$team_style = array(
    'font' => array('bold' => true, 'size' => 9,),
    'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_LEFT,),
);
$team_outline = array(
	'borders' => array(
		'outline' => array(
			'style' => PHPExcel_Style_Border::BORDER_THIN
		)
	)
);

$column_style = array(
	'borders' => array('allborders' => array('style' => PHPExcel_Style_Border::BORDER_THIN)),
	'fill' => array('type' => PHPExcel_Style_Fill::FILL_SOLID,'color' => array('rgb' => 'A4A4A4')),
    'font' => array('bold' => true, 'size' => 8,'color' => array('rgb' => 'FFFFFF'),),
    'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,),
);

$row_style = array(
	'borders' => array(
          'allborders' => array(
              'style' => PHPExcel_Style_Border::BORDER_THIN
          )
      ),
    'font' => array('size' => 8,),
    'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,),
);


$border_bottom = array(
'borders' => array('top' => array('style' => PHPExcel_Style_Border::BORDER_THIN,)),
    'font' => array('size' => 8,),
    'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_CENTER,'vertical' => \PHPExcel_Style_Alignment::VERTICAL_CENTER,),
);

$alphabet = range('A', 'Z');
$cols = array('ord_no', 'ServiceNo', 'FullName','InstAddress','CabinetNo','assigned_date','OKNo','ApptSlotFrom','ApptSlotTo','HistoryStatus','JobDescription');
$widths = array(8, 14, 20,100,14,9,25,5,5,5,30);
$colCount = count($cols);

$sql_query = "SELECT * FROM cluster.view_clus_".$pdt;
$rs = $db->getResults($sql_query);
if(count($rs)>0){
	$all_index = 5;
	$all_sheet = $objPHPExcel->createSheet((count($rs)+1));	
	$all_sheet->setShowGridlines(false);
	
	$objDrawing = new PHPExcel_Worksheet_Drawing();
	$objDrawing->setName('Telcomtrix');
	$objDrawing->setDescription('Telcomtrix Logo');
	$objDrawing->setPath('logo.png');
	$objDrawing->setHeight(52);
	$objDrawing->setCoordinates('A1');
	$objDrawing->setWorksheet($all_sheet);
	
	$objDrawing = new PHPExcel_Worksheet_Drawing();
	$objDrawing->setName('Globe');
	$objDrawing->setDescription('Globe Logo');
	$objDrawing->setPath('globe.png');
	$objDrawing->setHeight(36);
	$objDrawing->setCoordinates('L1');
	$objDrawing->setOffsetY(10);
	$objDrawing->setOffsetX(130);
	$objDrawing->setWorksheet($all_sheet);

	foreach($rs as $r){
		$assigned_to		= $r['installer_1'];
		$assigned_partner	= $r['installer_2'];
		$installername_1	= $r['Installer1'];
		$installername_2	= $r['Installer2'];
		
		/*Report Header */
	

		$all_sheet->setCellValueExplicit('B1','Telcomtrix Phils., Inc.',PHPExcel_Cell_DataType::TYPE_STRING);
		$all_sheet->mergeCells('B1:K1');
		$all_sheet->getStyle('B1:K1')->applyFromArray($company_style);
		$all_sheet->setCellValueExplicit('B2','241 Pasadena Dr., Santolan Rd.,',PHPExcel_Cell_DataType::TYPE_STRING);
		$all_sheet->mergeCells('B2:K2');
		$all_sheet->setCellValueExplicit('B3',' San Juan City, Manila, Philippines 1500',PHPExcel_Cell_DataType::TYPE_STRING);
		$all_sheet->mergeCells('B3:K3');
		$all_sheet->getStyle('B2:K3')->applyFromArray($address_style);
		
		$all_sheet->setCellValueExplicit('L1','Accredited',PHPExcel_Cell_DataType::TYPE_STRING);
		$all_sheet->setCellValueExplicit('L3','Contractor',PHPExcel_Cell_DataType::TYPE_STRING);
		$all_sheet->getStyle('L1:L3')->applyFromArray($address_style);
		$all_sheet->getStyle('L1:L3')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_RIGHT);
		
		$all_sheet->setCellValueExplicit('A4','DISPATCH SUMMARY',PHPExcel_Cell_DataType::TYPE_STRING);
		$all_sheet->mergeCells('A4:L4');		
		$all_sheet->getStyle('A4:L4')->applyFromArray($company_style);
		$all_sheet->getStyle('A4:L4')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		
		$all_sheet->setCellValueExplicit('A'.$all_index,'TEAM',PHPExcel_Cell_DataType::TYPE_STRING);
		$all_sheet->setCellValueExplicit('B'.$all_index,$installername_1,PHPExcel_Cell_DataType::TYPE_STRING);
		$all_sheet->getStyle('B'.$all_index)->applyFromArray($team_style);
		$all_sheet->mergeCells('B'.$all_index.':J'.$all_index);
		$all_sheet->setCellValueExplicit('B'.($all_index+1),$installername_2,PHPExcel_Cell_DataType::TYPE_STRING);
		$all_sheet->getStyle('B'.($all_index+1))->applyFromArray($team_style);
		$all_sheet->mergeCells('B'.($all_index+1).':J'.($all_index+1));
		$all_sheet->setCellValueExplicit('K'.$all_index,'DATE',PHPExcel_Cell_DataType::TYPE_STRING);
		$all_sheet->setCellValueExplicit('K'.($all_index+1),$fdt,PHPExcel_Cell_DataType::TYPE_STRING);
		$all_sheet->getStyle('K'.($all_index+1))->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
		#$all_sheet->mergeCells('L'.($all_index+1).':N'.($all_index+1));
		
		
		$all_sheet->getStyle('A'.$all_index.':A'.($all_index+1))->applyFromArray($team_outline);
		$all_sheet->getStyle('B'.$all_index.':J'.($all_index+1))->applyFromArray($team_outline);
		$all_sheet->getStyle('K'.$all_index.':K'.($all_index+1))->applyFromArray($team_outline);
		
		$all_index +=2;	
		/* Column Header */
		$colIndx =0;
		foreach($cols as $col){
			$all_sheet->setCellValueExplicit($alphabet[$colIndx].$all_index,$col,PHPExcel_Cell_DataType::TYPE_STRING);
			$all_sheet->getStyle($alphabet[$colIndx].$all_index)->applyFromArray($column_style);
			$colIndx +=1;
		}
		$all_index +=1;		
		
		$q ="SELECT * FROM clus_orders WHERE assigned_to =".$assigned_to." AND assigned_partner =".$assigned_partner." AND assigned_date ='".$fdt."';";
		$rows = $db->getResults($q);
		if(count($rows)>0){
			$rowIndex =8;
			foreach($rows as $row){
				$colIndx =0;
				foreach($cols as $col){
					$val =$row[$col];
					$all_sheet->setCellValueExplicit($alphabet[$colIndx].$all_index,$val,PHPExcel_Cell_DataType::TYPE_STRING);
					$all_sheet->getStyle($alphabet[$colIndx].$all_index)->getAlignment()->setWrapText(true);					
					$all_sheet->getColumnDimension($alphabet[$colIndx])->setAutoSize(false);
					$all_sheet->getColumnDimension($alphabet[$colIndx])->setWidth($widths[$colIndx]);
					$all_sheet->getStyle($alphabet[$colIndx].$all_index)->applyFromArray($row_style);
					
					
					$colIndx +=1;
				}
				$rowIndex +=1;
				$all_index +=1;				
			}
		}		
		$all_index +=2; //Add row spacer every tech pair
	}
	
	$all_sheet->setTitle("ALL");
	foreach($all_sheet->getRowDimensions() as $rd) {
		$rd->setRowHeight(-1);
	}
	
	$all_index +=2; //Add row spacer every tech pair
	$all_sheet->setCellValueExplicit('A'.$all_index,'Checked by:',PHPExcel_Cell_DataType::TYPE_STRING);
	$all_sheet->setCellValueExplicit('F'.$all_index,'Approved by:',PHPExcel_Cell_DataType::TYPE_STRING);
	$all_sheet->getStyle('A'.$all_index.':L'.$all_index)->applyFromArray($address_style);	
	$all_index +=2; //Add row spacer every tech pair
	
	$all_sheet->setCellValueExplicit('B'.$all_index,$config->dispatch_checked_by,PHPExcel_Cell_DataType::TYPE_STRING);
	$all_sheet->setCellValueExplicit('G'.$all_index,$config->dispatch_approved_by,PHPExcel_Cell_DataType::TYPE_STRING);
	$all_sheet->mergeCells('B'.$all_index.':C'.$all_index);
	$all_sheet->mergeCells('G'.$all_index.':I'.$all_index);
	$all_sheet->getStyle('A'.$all_index.':L'.$all_index)->applyFromArray($team_style);
	$all_sheet->getStyle('A'.$all_index.':L'.$all_index)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);	
	$all_index +=1; //Add row spacer every tech pair
	$all_sheet->setCellValueExplicit('B'.$all_index,'Telcomtrix Representative',PHPExcel_Cell_DataType::TYPE_STRING);
	$all_sheet->setCellValueExplicit('G'.$all_index,'Globe FO/  Representative',PHPExcel_Cell_DataType::TYPE_STRING);
	$all_sheet->mergeCells('B'.$all_index.':C'.$all_index);
	$all_sheet->mergeCells('G'.$all_index.':I'.$all_index);
	$all_sheet->getStyle('B'.$all_index.':C'.$all_index)->applyFromArray($border_bottom);
	$all_sheet->getStyle('G'.$all_index.':I'.$all_index)->applyFromArray($border_bottom);
	
	// Delete Template Sheet
	$objPHPExcel->removeSheetByIndex(
		$objPHPExcel->getIndex(
			$objPHPExcel->getSheetByName('template')
		)
	);
	
	$objPHPExcel->setActiveSheetIndex(0);
	
	unset($sheet1);
	unset($all_sheet);
	unset($row_style);
	unset($column_style);
	

// Redirect output to a client’s web browser (Excel2007)
header('Content-Type: application/vnd.openxmlformats-officedocument.spreadsheetml.sheet');
header('Content-Disposition: attachment;filename="'.$filename.'"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel2007');
$objWriter->save('php://output');
exit;
}

?>