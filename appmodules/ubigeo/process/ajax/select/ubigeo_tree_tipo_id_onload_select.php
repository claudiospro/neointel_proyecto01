<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../../../lib/html/html.php";
include "../../../../../lib/html/tabla.php";
include "../../../model/classes/ModeloSelect.php";

$select = new ModeloSelect();
// -------------------------------------------------------- INPUT
$in = null;

// -------------------------------------------------------- Data
$select->listTipoId($in);

// -------------------------------------------------------- TEST
// Html::printr($in);
// Html::printr($ou);


// -------------------------------------------------------- OUT
echo json_encode($ou);