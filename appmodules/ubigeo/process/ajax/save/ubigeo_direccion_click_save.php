<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../../../lib/html/html.php";
include "../../../model/classes/ModeloSave.php";

$save = new ModeloSave();
// -------------------------------------------------------- INPUT
$in['id'] = Utilidades::clear_input_id($_POST['id']);
$in['nombre'] = Utilidades::clear_input_text(Utilidades::sanear_string($_POST['nombre']));
$in['tipo_id'] = Utilidades::clear_input_id($_POST['tipo_id']);
$in['ubigeo_id'] = Utilidades::clear_input_id($_POST['ubigeo_id']);
$in['date'] = date('Y-m-d H:i:s');
$in['user_id'] = 1;
// -------------------------------------------------------- Data
$ou = $save->setDireccion($in);

// -------------------------------------------------------- TEST
// Html::printr($in);
// Html::printr($ou);

// -------------------------------------------------------- OUT
echo $ou['flag'];