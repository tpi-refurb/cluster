<?php
require_once ('../libraries/PHPExcel/Classes/PHPExcel.php');
require_once ('../setup.php');

$objPHPExcel = PHPExcel_IOFactory::createReader('Excel2007');
$objPHPExcel = $objPHPExcel->load('template_2.xlsx');
$sheet1 = $objPHPExcel->getActiveSheet()->copy();

$table ='TELCOMTRIXLUZ';
$date		= decode_url((isset($_GET['dt']) && $_GET['dt'] != '') ? $_GET['dt'] : date('Y-m-d'));
$pdt		= plain_date($date);
$fdt		= force_date($date);
$ddt		= dotted_date($date);

$filename	= $table.' '.$ddt.'.xlsx';

$style = array(
    'font' => array('bold' => true, 'size' => 20,),
    'alignment' => array('horizontal' => \PHPExcel_Style_Alignment::HORIZONTAL_LEFT,),
);

$alphabet = range('A', 'Z');
$cols = array('ord_no', 'JobType','ServiceNo', 'FullName','ContactNo','CabinetNo','JobDescription','ApptDate','ApptSlotFrom','ApptSlotTo','HistoryStatus');
$colCount = count($cols);

$sql_query = "SELECT * FROM cluster.view_clus_".$pdt;
$rs = $db->getResults($sql_query);
if(count($rs)>0){
	foreach($rs as $r){
		$assigned_to		= $r['installer_1'];
		$assigned_partner	= $r['installer_2'];
		$installername_1	= $r['Installer1'];
		$installername_2	= $r['Installer2'];
		
		/* Clone sheet1 from template */
		$new_sheet = clone $sheet1;
		
		$new_sheet->setCellValueExplicit('B5',$installername_1,PHPExcel_Cell_DataType::TYPE_STRING);
		$new_sheet->setCellValueExplicit('B6',$installername_2,PHPExcel_Cell_DataType::TYPE_STRING);
		$new_sheet->setCellValueExplicit('L6',$fdt,PHPExcel_Cell_DataType::TYPE_STRING);
		
		$q ="SELECT * FROM clus_orders WHERE assigned_to =".$assigned_to." AND assigned_partner =".$assigned_partner." AND assigned_date ='".$fdt."';";
		$rows = $db->getResults($q);
		if(count($rows)>0){
			$rowIndex =8;
			foreach($rows as $row){
				$colIndx =0;
				foreach($cols as $col){
					$val =$row[$col];
					
					$new_sheet->setCellValueExplicit($alphabet[$colIndx].$rowIndex,$val,PHPExcel_Cell_DataType::TYPE_STRING);
					//$new_sheet->getStyle($alphabet[$colIndx].$rowIndex)->applyFromArray($styleArray);					
					$new_sheet->getStyle($alphabet[$colIndx].$rowIndex)->applyFromArray($style);
					$colIndx +=1;
				}
				$rowIndex +=1;				
			}			
		}
		/* Set installer_1 name to sheet name */
		$sheet_title = $installername_1;
		$new_sheet->setTitle($sheet_title);
		$objPHPExcel->addSheet($new_sheet);
        unset($new_sheet);
	}
	$objPHPExcel->setActiveSheetIndex(1);
	unset($sheet1);
	unset($style);
	

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