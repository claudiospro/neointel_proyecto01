<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../../../lib/html/html.php";
include "../../../model/classes/ModeloSave.php";

$save = new ModeloSave();
// -------------------------------------------------------- INPUT
$in['id'] = Utilidades::clear_input_id($_POST['id']);
$in['nombre'] = Utilidades::clear_input_text($_POST['nombre']);
$in ['info_update'] = date('Y-m-d H:i:s');
// -------------------------------------------------------- Data
$save->getUbigeo($in);

// -------------------------------------------------------- TEST
// Html::printr($in);
// Html::printr($ou);


// -------------------------------------------------------- OUT