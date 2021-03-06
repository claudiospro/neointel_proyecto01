<?php
$in['campania_id'] = '0';
if ( isset($_POST['campania_id'])) {
    $in['campania_id'] = $_POST['campania_id'];
}

$in['data'] = null;
if ( isset($_POST['campania_id'])) {
    $onLoad = new ModeloOnload();
    $in['data'] = $onLoad->getDireccionFuente($in);
}

function indexar() {
    global $onLoad;
    $in['campania_id'] = Utilidades::clear_input_id($_POST['campania_id']);
    $in['fecha']       = date('Y-m-d H:i:s');
    $in['user_id']     = 1;
    $onLoad->getDireccionFuenteIndexar($in);
}


function imprimir_tabla($data) {
    $indexar = true;
    global $onLoad;
    echo '<table>';
    echo '<tr>';
    echo '<th>Orden</th><th colspan="2">Direccion</th><th>Municipio</th><th>Provincia</th><th>Autonoma</th><th width="100"></th><th>Estado</th>';
    echo '</tr>';
    $i = 1;
    foreach ($data as $row) {
        $row['estado_str'] = '';
        if ($row['estado'] == '0') { // ubigeos direcciones
            $indexar = false;
            $row['estado_str'] .= 'No existe';
        } elseif ($row['estado'] == '1') { // todo esta bien
            $row['estado_str'] .= 'OK';
        } else { // que mal, ubigeo
            $row['estado'] = 2;
            $indexar = false;
            $row['estado_str'] .= 'Redundante';
        }
        echo '<tr class="item_tipo_' . $row['estado'] . '">';
        echo '<td>' . $i++ . '</td>';
        echo '<td>' . $row['direccion_tipo'] . '</td>';
        echo '<td>' . $row['nombre'] . '</td>';
        echo '<td>' . utf8_encode($row['ubigeo_nombre']) . '</td>';
        echo '<td>' . utf8_encode($row['parent_nombre']) . '</td>';
        echo '<td>' . utf8_encode($row['abuelo_nombre']) . '</td>';

        echo '<td>' . 
            '<span>' . $row['direccion_tipo'] . '</span> ' . 
            '<span>' . ucfirst(strtolower(($row['nombre']))) . '</span> ' . 
            '<span>' . utf8_encode($row['ubigeo_nombre']) . '</span>' . 
            '</td>';
        echo '<td>' . $row['estado_str'] . '</td>';        
        echo '</tr>';
    }
    echo '</table>';
    return $indexar;
}
