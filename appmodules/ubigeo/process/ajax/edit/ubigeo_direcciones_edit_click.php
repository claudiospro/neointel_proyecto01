<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../../../lib/html/html.php";
include "../../../model/classes/ModeloEdit.php";

$edit = new ModeloEdit();
// -------------------------------------------------------- INPUT
$in['id'] = Utilidades::clear_input_id($_POST['codigo']);

// -------------------------------------------------------- Data
$ou = $edit->getDireccion($in);
// -------------------------------------------------------- TEST
// Html::printr($in);
// Html::printr($ou);

// -------------------------------------------------------- OUT
echo json_encode($ou);