<?php

include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../model/classes/ModeloOnload.php";

function num_to_letters($num, $uppercase = true) {
    $letters = '';
    while ($num > 0) {
        $code = ($num % 26 == 0) ? 26 : $num % 26;
        $letters .= chr($code + 64);
        $num = ($num - $code) / 26;
    }
    return ($uppercase) ? strtoupper(strrev($letters)) : strrev($letters);
}

$onLoad = new ModeloOnload();
$in['campania_id'] = $_GET['campania_id'];
$in['tipo'] = 'a_y_b';
$data = $onLoad->getDataUnida($in);



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
$t = count($data);
for ($i=2; $i<=$t; $i++) {
    $objPHPExcel->setActiveSheetIndex(0)
                ->setCellValue('A' . $i, utf8_encode($data[$i-1]['ubigeo_nombre']))
                ->setCellValue('B' . $i, utf8_encode($data[$i-1]['direccion_tipo_nombre'] . ' ' . $data[$i-1]['direccion_nombre']))
                ->setCellValue('C' . $i, utf8_encode($data[$i-1]['direccion_numero']))
                ->setCellValue('D' . $i, utf8_encode($data[$i-1]['telefono']))
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
