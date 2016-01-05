<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../../../lib/html/html.php";
include "../../../model/classes/ModeloSave.php";

$save = new ModeloSave();
// -------------------------------------------------------- INPUT
$in['ubigeo_id'] = Utilidades::clear_input_id($_POST['ubigeo_id']);
$in['id'] = Utilidades::clear_input_id($_POST['sinonimo_id']);
$in['nombre'] = Utilidades::sanear_string($_POST['sinonimo_nombre']);
$in['nombre'] = Utilidades::clear_input_text($in['nombre']);
$in['nivel'] = Utilidades::clear_input_id($_POST['ubigeo_nivel']);
$in['date'] = date('Y-m-d H:i:s');
$in['user_id'] = 1;

// -------------------------------------------------------- Data
echo $save->setSinonimo($in);

// -------------------------------------------------------- TEST
// Html::printr($in);
// Html::printr($ou);

// -------------------------------------------------------- OUT