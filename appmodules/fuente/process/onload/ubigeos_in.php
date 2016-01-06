<?php
$in['campania_id'] = '0';
if ( isset($_POST['campania_id'])) {
    $in['campania_id'] = $_POST['campania_id'];
}

$in['data'] = null;
if ( isset($_POST['campania_id'])) {
    $onLoad = new ModeloOnload();
    $in['data'] = $onLoad->getUbigeos4Fuente($in);
}

class dd {
    public $indexar = false;
    function imprimir_tabla($data) {
        $onLoad = new ModeloOnload();
        echo '<table>';
        echo '<tr><th>Nombre</th><th>Estado</th></tr>';
        foreach ($data as $row) {
            $row['estado_str'] = '';
            if ($row['estado'] == '0') { // no hay: buscar en wikipedia, ubigeos                
                $row['estado_str'] .= 'No existe: ';
                $row['estado_str'] .= '<a target="_black" href="https://es.wikipedia.org/w/index.php?title=Especial%3ABuscar&profile=default&search=' . $row['nombre'] . '+%28Espa%C3%B1a%29&fulltext=Search">Wikipedia</a>';
                $row['estado_str'] .= ' | ';
                $row['estado_str'] .= '<a target="_black" href="../ubigeo/tree2.php">Ubigeos</a>';
            } elseif ($row['estado'] == '1') { // todo esta bien
                $this->indexar = true;
                $row['estado_str'] .= 'OK';
                $row['nombre'] .= ' (' . $onLoad->getUbigeos4Ubigeo($row['nombre']) . ')';
            } else { // que mal, bucar padres y abuelos
                $row['estado_str'] .= 'Redundante:<br>';
                $tmp = $onLoad->getUbigeos4FuenteRedundantes($row['nombre']);
                $row['estado_str'] .= '<ol>';
                foreach ($tmp as $r) {
                    $row['estado_str'] .= '<li>';
                    $row['estado_str'] .= utf8_encode($r['a']) . '->' . utf8_encode($r['p']);
                    $row['estado_str'] .= '</li>';
                }
                $row['estado_str'] .= '</ol>';
                $row['estado_str'] .= '<a target="_black" href="../ubigeo/tree2.php">Ubigeos</a>';
            }
            echo '<tr>';
            echo '<td>' . utf8_encode($row['nombre']) . '</td>';
            echo '<td>' . $row['estado_str'] . '</td>';
            echo '</tr>';
        }
        echo '</table>';
    }
}
function indexar() {
    $onLoad = new ModeloOnload();
    $in['campania_id'] = Utilidades::clear_input_id($_POST['campania_id']);
    $in['fecha']       = date('Y-m-d H:i:s');
    $in['user_id']     = 1;
    $onLoad->getUbigeos4indexar($in);
}