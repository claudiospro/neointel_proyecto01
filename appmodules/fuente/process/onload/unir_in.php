<?php
$in['campania_id'] = '0';
if ( isset($_POST['campania_id'])) {
    $in['campania_id'] = $_POST['campania_id'];
}

$in['a_y_b'] = null;
$in['a_menos_b'] = null;
if ( isset($_POST['campania_id'])) {
    $onLoad = new ModeloOnload();
    $in['tipo'] = 'a_y_b';
    $in['a_y_b'] = $onLoad->getDataUnida($in);
    $in['tipo'] = 'a_menos_b';
    $in['a_menos_b'] = $onLoad->getDataUnida($in);
}

function indexar() {
    /* global $onLoad; */
    /* $in['campania_id'] = Utilidades::clear_input_id($_POST['campania_id']); */
    /* $in['fecha']       = date('Y-m-d H:i:s'); */
    /* $in['user_id']     = 1; */
    /* $onLoad->getDireccionFuenteIndexar($in); */
}


function imprimir_tabla_a_y_b($data) {
    global $onLoad;
    echo '<table>';
    echo '<tr>';
    echo '<th>Ubigeo</th><th colspan="2">Dirección</th><th>Teléfono</th>';
    echo '</tr>';
    foreach ($data as $row) {
        echo '<tr>';
        echo '<td>' . utf8_encode($row['ubigeo_nombre']) . '</td>';
        echo '<td>';
        echo '<span>' . utf8_encode($row['direccion_tipo_nombre']) . '</span>';
        echo '<span>' . utf8_encode($row['direccion_nombre']) . '</span>';
        echo '</td>';
        echo '<td>' . utf8_encode($row['direccion_numero']) . '</td>';
        echo '<td>' . utf8_encode($row['telefono']) . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}

function imprimir_tabla_a_menos_b($data) {
    global $onLoad;
    echo '<table>';
    echo '<tr>';
    echo '<th>Ubigeo</th><th colspan="2">Dirección</th>';
    echo '</tr>';
    foreach ($data as $row) {
        echo '<tr>';
        echo '<td>' . utf8_encode($row['ubigeo_nombre']) . '</td>';
        echo '<td>';
        echo '<span>' . utf8_encode($row['direccion_tipo_nombre']) . '</span>';
        echo '<span>' . utf8_encode($row['direccion_nombre']) . '</span>';
        echo '</td>';
        echo '<td>' . utf8_encode($row['direccion_numero']) . '</td>';
        echo '</tr>';
    }
    echo '</table>';
}
