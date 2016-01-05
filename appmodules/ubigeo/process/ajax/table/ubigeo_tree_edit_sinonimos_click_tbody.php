<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/conexion01.php";
include "../../../../../lib/mysql/utilidades.php";
include "../../../../../lib/html/html.php";
include "../../../model/classes/ModeloTable.php";

$table = new ModeloTable();
// -------------------------------------------------------- INPUT
$in['ubigeo_id'] = Utilidades::clear_input_id($_POST['id']);

// -------------------------------------------------------- Data
$ou = $table->listSinonimos($in);


// -------------------------------------------------------- TEST
// Html::printr($in);
// Html::printr($ou);


// -------------------------------------------------------- OUT

if (is_array($ou)) {
    foreach ($ou as $row) {
        imprimir($row);
    }
}

function imprimir($row) {
    echo '<tr sinonimo_id="' . $row['id'] . '">';
    echo '<td>'. utf8_encode($row['nombre']) . '</td>';
    echo '<td>';
    echo '<a class="editar button tiny success no-margin" title="Editar"><i class="fi-pencil medium"></i></a>';
    echo '<a class="eliminar button tiny alert no-margin" title="Eliminar"><i class="fi-x medium"></i></a>';
    echo '</td>';
    echo '</tr>';
}