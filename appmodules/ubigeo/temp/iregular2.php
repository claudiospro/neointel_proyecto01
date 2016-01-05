
<?php
include "../../../lib/html/html.php";
include "../../../lib/mysql/dbconnector.php";
include "../../../lib/mysql/utilidades.php";

Html::$path = '../..';
Html::header();

$cnn= new DBConnector_Alternative();

$conn = mysqli_connect(
    $cnn->servername, 
    $cnn->username, 
    $cnn->password, 
    $cnn->dbname
) or die("Connection failed: " . mysqli_connect_error())
;
// $conn->set_charset("utf8")

$in = $_GET;

$sql = 
'
SELECT id, nombre 
FROM ubigeo 
WHERE parent_id=" ' . $in['parent'] . ' "
AND nivel="4" 
AND nombre like "%(%"
AND nombre like "%)%"
';

$query=mysqli_query($conn, $sql) or die("03");

while($r=mysqli_fetch_array($query)) {
    $r['nombre'] = sanear_string($r['nombre']);
    $l = explode(' (', $r['nombre']);    
    $l[1] = str_replace(')','',$l[1]);
    $ll = explode(' , ', $l[1]);
    if (count($ll)>1) {
        $l[1] = $ll[0];
        $l[2] = $ll[1];
    }
    $ll = explode(', ', $l[1]);
    if (count($ll)>1) {
        $l[1] = $ll[0];
        $l[2] = $ll[1];
    }
    $ll = explode('/', $l[1]);
    if (count($ll)>1) {
        $l[1] = $ll[0];
        $l[2] = $ll[1];
    }     
    $ll = explode(' <> ', $l[1]);
    if (count($ll)>1) {
        $l[1] = $ll[0];
        $l[2] = $ll[1];
    }     
    $doble = array();
    foreach ($l as $d) {
        $d = trim($d);
        if (array_search($d, $doble) === false) {
            $doble[] = $d;
        } else {
            continue;
        }
        if ($in['t']=='1') {
            printf( 'INSERT INTO ubigeo_sinonimo (nombre, ubigeo_id, nivel) VALUES ("%s", "%s", "4"); <br>',
            $d,
            $r['id']
            );
        } else {
            echo $d .'<br>';
        }            
    }
    // echo '-- ------ <br>';
}

Html::footer();

function sanear_string($string) {

    $string = trim($string);
    $string = utf8_encode($string);

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

    return $string;
}

function reemplazar_sp_chars($str){
    $str = utf8_decode($str);
    $str=strtr($str,
    "ÀÁÂÃÄÅàáâãäåÈÉÊËèéêëÌÍÎÏìíîïÒÓÔÕÖØòóôõöøÙÚÛÜùúûüÇçÑñÿ",
    "AAAAAAaaaaaaEEEEeeeeIIIIiiiiOOOOOOooooooUUUUuuuuCcNny");
    return $str;
}
function limpiar($String){
    $String = str_replace(array('á','à','â','ã','ª','ä'),"a",$String);
    $String = str_replace(array('Á','À','Â','Ã','Ä'),"A",$String);
    $String = str_replace(array('Í','Ì','Î','Ï'),"I",$String);
    $String = str_replace(array('í','ì','î','ï'),"i",$String);
    $String = str_replace(array('é','è','ê','ë'),"e",$String);
    $String = str_replace(array('É','È','Ê','Ë'),"E",$String);
    $String = str_replace(array('ó','ò','ô','õ','ö','º'),"o",$String);
    $String = str_replace(array('Ó','Ò','Ô','Õ','Ö'),"O",$String);
    $String = str_replace(array('ú','ù','û','ü'),"u",$String);
    $String = str_replace(array('Ú','Ù','Û','Ü'),"U",$String);
    $String = str_replace("ç","c",$String);
    $String = str_replace("Ç","C",$String);
    $String = str_replace("Ý","Y",$String);
    $String = str_replace("ý","y",$String);
     
    $String = str_replace("&aacute;","a",$String);
    $String = str_replace("&Aacute;","A",$String);
    $String = str_replace("&eacute;","e",$String);
    $String = str_replace("&Eacute;","E",$String);
    $String = str_replace("&iacute;","i",$String);
    $String = str_replace("&Iacute;","I",$String);
    $String = str_replace("&oacute;","o",$String);
    $String = str_replace("&Oacute;","O",$String);
    $String = str_replace("&uacute;","u",$String);
    $String = str_replace("&Uacute;","U",$String);
    return $String;
}


