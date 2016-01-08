<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../../../lib/html/html.php";
include "../../../model/classes/ModeloAutoComplete.php";

$auto = new ModeloAutoComplete();
// -------------------------------------------------------- INPUT
$in = null;
$in['nombre'] = Utilidades::clear_input_text(Utilidades::sanear_string($_REQUEST['term']));

// -------------------------------------------------------- Data
$ou = $auto->ubigeos_4($in);

// -------------------------------------------------------- TEST
// Html::printr($in);
// Html::printr($ou);

// -------------------------------------------------------- OUT
$i = 0;

$json = array();
if (is_array($ou)) {
    foreach ($ou as $row) {
        $tmp = array();
        $tmp['value']           = utf8_encode($row['nombre']);
        $tmp['label']           = utf8_encode($row['nombre']);
        $tmp['id']              = utf8_encode($row['id']);
        $json[]=$tmp;
    }
}
// Html::printr($ou);

echo json_encode($json);
