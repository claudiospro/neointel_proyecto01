<?php

include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../model/classes/ModeloOnload.php";

$onLoad = new ModeloOnload();
$in['campania_id'] = $_GET['campania_id'];
$in['tipo'] = 'a_y_b';
$data = $onLoad->getDataUnida($in);
// print_r($data);


error_reporting(E_ALL);
ini_set('display_errors', TRUE);
ini_set('display_startup_errors', TRUE);
date_default_timezone_set('America/Lima');

if (PHP_SAPI == 'cli')
	die('This example should only be run from a Web Browser');

/** Include PHPExcel */
require_once  '../../../../../lib/vendor/phpExcel-1.8.0/Classes/PHPExcel.php';


// Create new PHPExcel object
$objPHPExcel = new PHPExcel();

// Set document properties
$objPHPExcel->getProperties()->setCreator("Claudio Rodriguez Ore");


// Add some data
$objPHPExcel->setActiveSheetIndex(0)
            ->setCellValue('A1', 'Municipio')
            ->setCellValue('B1', 'Dirección')
            ->setCellValue('C1', 'Número')
            ->setCellValue('D1', 'Teléfono')
    ;

$t = count($data);
for ($i=0; $i<$t; $i++) {
    $j = $i + 2;
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $j, utf8_encode($data[$i]['ubigeo_nombre']))
                ->setCellValue('B' . $j, utf8_encode($data[$i]['direccion_tipo_nombre'] . ' ' . $data[$i]['direccion_nombre']))
                ->setCellValue('C' . $j, utf8_encode($data[$i]['direccion_numero']))
                ->setCellValue('D' . $j, utf8_encode($data[$i]['telefono']))
        ;
}

// Rename worksheet
$objPHPExcel->getActiveSheet()->setTitle('Data');


// Set active sheet index to the first sheet, so Excel opens this as the first sheet
$objPHPExcel->setActiveSheetIndex(0);

// Redirect output to a client’s web browser (Excel5)
header('Content-Type: application/vnd.ms-excel');
header('Content-Disposition: attachment;filename="data-' . date('Y-m-d His') . '.xls"');
header('Cache-Control: max-age=0');
// If you're serving to IE 9, then the following may be needed
header('Cache-Control: max-age=1');

// If you're serving to IE over SSL, then the following may be needed
header ('Expires: Mon, 26 Jul 1997 05:00:00 GMT'); // Date in the past
header ('Last-Modified: '.gmdate('D, d M Y H:i:s').' GMT'); // always modified
header ('Cache-Control: cache, must-revalidate'); // HTTP/1.1
header ('Pragma: public'); // HTTP/1.0

$objWriter = PHPExcel_IOFactory::createWriter($objPHPExcel, 'Excel5');
$objWriter->save('php://output');
exit;
