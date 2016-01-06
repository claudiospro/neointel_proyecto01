<?php
$in['campania_id'] = '0';
if ( isset($_POST['campania_id'])) {
    $in['campania_id'] = $_POST['campania_id'];
}

$in['data'] = null;
if ( isset($_POST['campania_id'])) {
    $onLoad = new ModeloOnload();
    $in['data'] = $onLoad->getDireccionTipoFuente($in);
}


function imprimir_tabla($data) {
    $indexar = true;
    global $onLoad;
    echo '<table>';
    echo '<tr>';
    echo '<th>Nombre</th><th>Estado</th><th>Ejemplo</th>';
    echo '</tr>';
    $search = array();
    foreach ($data as $row) {
        if (array_search($row['nombre'], $search) === False) {
            $search[] = $row['nombre'];
            $row['estado_str'] = '';
            if ($row['estado'] == '0') { // no hay: ubigeos
                $indexar = false;
                $row['estado_str'] .= 'No existe';
                $row['estado_str'] .= '<br>'; 
            } elseif ($row['estado'] == '1') { // todo esta bien
                $row['estado_str'] .= 'OK';
            } else { // que mal, ubigeo
                $indexar = false;
                $row['estado_str'] .= 'Redundante';
                $row['estado_str'] .= '<br>';
                $row['estado_str'] .= '';
            }
            echo '<tr>';
            echo '<td>' . utf8_encode($row['nombre']) . '</td>';
            echo '<td>' . $row['estado_str'] . '</td>';
            echo '<td style="color: rgb(164, 164, 164); font-size: 0.8em;">' . utf8_decode($row['nombre']) . ' ' . utf8_encode($row['direccion']) . ', ' . utf8_encode($row['ubigeo']) . '</td>';
            echo '</tr>';
        }

    }
    echo '</table>';
    return $indexar;
}
function indexar() {
    global $onLoad;
    $in['campania_id'] = Utilidades::clear_input_id($_POST['campania_id']);
    $in['fecha']       = date('Y-m-d H:i:s');
    $in['user_id']     = 1;
    $onLoad->getDireccionTipoFuenteIndexar($in);
}