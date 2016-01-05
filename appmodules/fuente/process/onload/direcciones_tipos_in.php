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
    echo '<th>Nombre</th><th>Estado</th>';
    echo '</tr>';
    foreach ($data as $row) {
        $row['estado_str'] = '';
        if ($row['estado'] == '0') { // no hay: ubigeos
            $indexar = false;
            $row['estado_str'] .= 'No existe';
            $row['estado_str'] .= '<br>';
            $row['estado_str'] .= '<a target="_black" href="../ubigeo/direcciones.php">Ubigeos</a>';
 
        } elseif ($row['estado'] == '1') { // todo esta bien
            $row['estado_str'] .= 'OK';
        } else { // que mal, ubigeo
            $indexar = false;
            $row['estado_str'] .= 'Redundante';
            $row['estado_str'] .= '<br>';
            $row['estado_str'] .= '<a target="_black" href="../ubigeo/direcciones.php">Ubigeos</a>';
        }
        echo '<tr>';
        echo '<td>';
        echo utf8_decode($row['nombre']);
        echo '</td>';
        echo '<td>';
        echo $row['estado_str'];
        echo '</td>';        
        echo '</tr>';
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