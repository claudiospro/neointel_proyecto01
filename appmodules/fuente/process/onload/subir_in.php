<?php
$in['campania_id'] = '0';
if ( isset($_POST['campania_id'])) {
    $in['campania_id'] = $_POST['campania_id'];
}

$in['fuente_tipo'] = '2';
if ( isset($_POST['fuente_tipo']) && $_POST['fuente_tipo'] == 'on' ) {
    $in['fuente_tipo'] = '1';
}

$in['fuente'] = false;
if ( isset($_FILES['fuente']) && $_FILES['fuente']['size'] > 0) {
    $in['fuente'] = $_FILES['fuente']['tmp_name'];
}

function imprimir_table($data) {
    $file = fopen($data, "r");
    $i= 0;
    echo '<table>';
    while(! feof($file)) {
        $row = fgetcsv($file);
        if (is_array($row)) {
            echo '<tr>';
            echo '<th>';
            echo ++$i;
            echo '</th>';
            foreach ($row as $field) {
                echo '<td>';
                echo $field;
                echo '</td>';
            }
            echo '</tr>';
        }
    }
    echo '</table>';
    fclose($file);
}
function getNameFromNumber_test() {
    for ($i=0;$i<=1000;$i++) {
        $number = $i;
        $letter = getNameFromNumber($number);
        echo $number . '==' . $letter . '<br>';
    }
}
function getNameFromNumber($num) {
    $numeric = ($num - 1) % 26;
    $letter = chr(65 + $numeric);
    $num2 = intval(($num - 1) / 26);
    if ($num2 > 0) {
        return getNameFromNumber($num2) . $letter;
    } else {
        return $letter;
    }
}
function getNameFromNumber0($num) {
    $numeric = $num % 26;
    $letter = chr(65 + $numeric);
    $num2 = intval($num / 26);
    if ($num2 > 0) {
        return getNameFromNumber($num2 - 1) . $letter;
    } else {
        return $letter;
    }
}
function num_to_letters_test() {
    for ($i=0;$i<=1000;$i++) {
        $number = $i;
        $letter = num_to_letters($number, true);
        echo $number . '==' . $letter . '<br>';
    }    
}
function num_to_letters($num, $uppercase = true) {
    $letters = '';
    while ($num > 0) {
        $code = ($num % 26 == 0) ? 26 : $num % 26;
        $letters .= chr($code + 64);
        $num = ($num - $code) / 26;
    }
    return ($uppercase) ? strtoupper(strrev($letters)) : strrev($letters);
}
function letters_to_num_test() {
    echo letters_to_num('A') .'<br>';
    echo letters_to_num('Z') .'<br>';
    echo letters_to_num('AAA') .'<br>';
}
function letters_to_num($letters) {
    $num = 0;
    $arr = array_reverse(str_split($letters));

    for ($i = 0; $i < count($arr); $i++) {
        $num += (ord(strtolower($arr[$i])) - 96) * (pow(26,$i));
    }
    return $num;
}

function sql_fuente_1($data, $campania) {
    $file = fopen($data, "r");
    // head
    $row = fgetcsv($file);
    $j=0;
    $h = array();
    $search = array();
    foreach ($row as $field) {
        if ('MUNICIPIO' == sanear_string(strtoupper($field))) {
            $h['municipio'] = $j;
        }
        if ('CALLE' == sanear_string(strtoupper($field))) {
            $h['calle'] = $j;
        }
        if ('NUMERO' == sanear_string(strtoupper($field))) {
            $h['numero'] = $j;
        }
        $j++;
    }    
    // body
    if(isset($h['municipio']) && isset($h['calle']) && isset($h['numero'])) {
        $i= 0;
        while(! feof($file)) {
            $i++;
            $row = fgetcsv($file);
            if (is_array($row)) {
                $sql = 'INSERT INTO fuente_a(ubigeo_localidad_nombre, direccion_tipo_nombre, direccion_nombre, direccion_numero, campania_id)  VALUES ("%s", "%s", "%s", "%s", "%s");' ."\n";
                $municipio = sanear_string(sql_clear($row[$h['municipio']]));
                $calle = sanear_string(sql_clear($row[$h['calle']]));
                $numero = sanear_string(sql_clear($row[$h['numero']]));
                $index = $municipio . $calle . $numero;

                if (array_search($index, $search) === False) {
                    $search[] = $index;
                    $calle_tipo = '';
                    $l = explode(" ", $calle, 2);
                    if (count($l) == 2) {
                        $calle_tipo = $l[0];
                        $calle = $l[1];
                    }                
                    printf($sql, $municipio, $calle_tipo, $calle, $numero, $campania);
                }
            }
        }
    } else {
        echo "-- Los siguientes campos no existen: ";
        if(!isset($h['municipio']))
            echo "Municipio, ";
        if(!isset($h['calle']))
            echo "Calle, ";
        if(!isset($h['numero']))
            echo "Numero, ";
    }

    fclose($file);
}
function sql_fuente_2($data, $campania) {
    $file = fopen($data, "r");
    // head
    $row = fgetcsv($file);
    $j=0;
    $h = array();
    foreach ($row as $field) {
        if ('CIUDAD' == strtoupper(sanear_string($field))) {
            $h['ciudad'] = $j;
        }
        if ('DIRECCION' == strtoupper(sanear_string($field))) {
            $h['direccion'] = $j;
        }
        if ('TELEFONO' == strtoupper(sanear_string($field))) {
            $h['telefono'] = $j;
        }
        $j++;
    }
    if(isset($h['ciudad']) && isset($h['direccion']) && isset($h['telefono'])) {
        // body
        $i= 0;
        while(! feof($file)) {
            $i++;
            $row = fgetcsv($file);
            $ciudad = sanear_string(sql_clear($row[$h['ciudad']]));
            $direccion = sanear_string(sql_clear($row[$h['direccion']]));            
            $direccion_numero = ''; 
            $direccion_tipo = '';
            $direccion = strrev($direccion);
            $l = explode(" ,", $direccion, 2);
            if (count($l) == 2) {
                $direccion_numero = strrev($l[0]);
                $direccion = strrev($l[1]);
            } else {
                $direccion = strrev($direccion);
            }
            $l = explode(" ", $direccion, 2);
            
            if (count($l) == 2) {
                $direccion_tipo = $l[0];
                $direccion = $l[1];
            }            
            $telefono = sanear_string(sql_clear($row[$h['telefono']]));
            $telefono = str_replace('.', '', $telefono);
            $telefono = str_replace('+', '', $telefono);
            $telefono = preg_replace("/(\d+) (\d+)/i","$2", $telefono);
            if (is_array($row)) {
                $sql = 'INSERT INTO fuente_b(ubigeo_ciudad_nombre, direccion_tipo_nombre, direccion_nombre, direccion_numero, telefono, campania_id)  VALUES ("%s", "%s", "%s", "%s", "%s", "%s");' ."\n";
                printf($sql, $ciudad, $direccion_tipo, $direccion, $direccion_numero, $telefono, $campania);
            }
        }        
    } else {
        echo "-- Los siguientes campos no existen: ";
        if(!isset($h['ciudad']))
            echo "Ciudad, ";
        if(!isset($h['direccion']))
            echo "Direccion, ";
        if(!isset($h['telefono']))
            echo "Telefono, ";
    }
    fclose($file);
}

function sql_clear ($sql) {
    $sql = str_replace('\\', '\\\\', $sql);
    $sql = str_replace('"', '\"', $sql);
    $sql = trim($sql);
    return $sql;
} 
function sanear_string($string) {

    $string = trim($string);
    // $string = utf8_encode($string);

    $string = str_replace(
        array('á', 'à', 'ä', 'â', 'ª', 'Á', 'À', 'Â', 'Ä'),
        array('a', 'a', 'a', 'a', 'a', 'A', 'A', 'A', 'A'),
        $string
    );

    $string = str_replace(
        array('é', 'è', 'ë', 'ê', 'É', 'È', 'Ê', 'Ë'),
        array('e', 'e', 'e', 'e', 'E', 'E', 'E', 'E'),
        $string
    );

    $string = str_replace(
        array('í', 'ì', 'ï', 'î', 'Í', 'Ì', 'Ï', 'Î'),
        array('i', 'i', 'i', 'i', 'I', 'I', 'I', 'I'),
        $string
    );

    $string = str_replace(
        array('ó', 'ò', 'ö', 'ô', 'Ó', 'Ò', 'Ö', 'Ô'),
        array('o', 'o', 'o', 'o', 'O', 'O', 'O', 'O'),
        $string
    );

    $string = str_replace(
        array('ú', 'ù', 'ü', 'û', 'Ú', 'Ù', 'Û', 'Ü'),
        array('u', 'u', 'u', 'u', 'U', 'U', 'U', 'U'),
        $string
    );

    $string = str_replace(
        array('ç', 'Ç'),
        array('c', 'C'),
        $string
    );
    $string = str_replace(
        array('Ð', 'ð'),
        array('Ñ', 'ñ'),
        $string
    );
    return $string;
}