<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../../../lib/html/html.php";
include "../../../model/classes/ModeloDelete.php";

$delete = new ModeloDelete();
// -------------------------------------------------------- INPUT
$in['id'] = Utilidades::clear_input_id($_POST['sinonimo_id']);
// -------------------------------------------------------- Data
$delete->setSinonimo($in);

// -------------------------------------------------------- TEST
// Html::printr($in);
// Html::printr($ou);


// -------------------------------------------------------- OUT