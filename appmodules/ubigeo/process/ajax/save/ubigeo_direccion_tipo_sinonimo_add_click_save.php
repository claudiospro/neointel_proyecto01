<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../../../lib/html/html.php";
include "../../../model/classes/ModeloSave.php";

$save = new ModeloSave();
// -------------------------------------------------------- INPUT
$in['id']          = Utilidades::clear_input_id($_POST['id']);
$in['sinonimo_id'] = Utilidades::clear_input_id($_POST['sinonimo_id']);

if ($in['id'] != $in['sinonimo_id']) {
    $in['sinonimo_id'] = $save->getSinonimoDireccionTipoParent($in);
}

$in['date']        = date('Y-m-d H:i:s');
$in['user_id']     = 1;
// -------------------------------------------------------- Data
$ou = $save->setSinonimoDireccionTipo($in);

// -------------------------------------------------------- TEST
Html::printr($in);
// Html::printr($ou);

// -------------------------------------------------------- OUT
