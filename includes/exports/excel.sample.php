<?php
//require_once '../libraries/PHPExcel/PHPExcel/IOFactory.php';
require_once '../libraries/PHPExcel/Classes/PHPExcel.php';

$excel2 = PHPExcel_IOFactory::createReader('Excel2007');
$excel2 = $excel2->load('template_2.xlsx'); // Empty Sheet
$excel2->setActiveSheetIndex(0);
$excel2->getActiveSheet()
	->setCellValue('A8', '24611486')
    ->setCellValue('B8', 'INST')
    ->setCellValue('C8', '23585302')       
    ->setCellValue('D8', 'MICHAEL CHARLES AGANA KIPPING')
	->setCellValue('E8', '9178841603')
    ->setCellValue('F8', 'WORLDMEDF-130534-2 FGHF')
    ->setCellValue('G8', 'PROVIDE BROADBAND W/ DEL-SOFTSWITCH')       
    ->setCellValue('H8', '23/08/2016')
    ->setCellValue('I8', '13:00')       
    ->setCellValue('J8', '17:00')     
    ->setCellValue('K8', 'NEW')  
    ->setCellValue('L8', 'COM-788798715465456');

$excel2->setActiveSheetIndex(1);
$excel2->getActiveSheet()->setCellValue('A7', '4')
    ->setCellValue('C7', '5');
$objWriter = PHPExcel_IOFactory::createWriter($excel2, 'Excel2007');
$objWriter->save('Nimit New.xlsx');
?>