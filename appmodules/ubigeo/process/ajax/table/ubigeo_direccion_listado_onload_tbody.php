<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/utilidades.php";

$cnn= new DBConnector_Alternative();

$conn = mysqli_connect($cnn->servername, $cnn->username, $cnn->password, $cnn->dbname) or die("Connection failed: " . mysqli_connect_error());

$sql_columns= "
  t.nombre tipo_nombre
, d.nombre direccion_nombre
, s.nombre sinonimo_nombre
, u.nombre ubigeo_nombre
, d.tipo_id
, d.id direccion_id
, d.ubigeo_id
, d.sinonimo_id
";

$sql_ini = "
SELECT unido.*, @rownum:=@rownum+1 row_num  FROM (
  SELECT
  " . $sql_columns . "
  FROM ubigeo_direccion d
  LEFT JOIN ubigeo_direccion_tipo t ON t.id=d.tipo_id
  LEFT JOIN ubigeo_direccion s ON s.id=d.sinonimo_id
  LEFT JOIN ubigeo u ON u.id=d.ubigeo_id
) unido, (SELECT @rownum:=0) R
WHERE 1=1
";

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;


// getting total number records without any search
$sql = $sql_ini;
$query=mysqli_query($conn, $sql) or die("01");

$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$sql = $sql_ini;

$sql_filter = '';
if( !empty($requestData['columns'][0]['search']['value']) ) {
    $sql_filter.=' AND LOWER(tipo_nombre) LIKE "%' . strtolower($requestData['columns'][0]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][1]['search']['value']) ) {
    $sql_filter.=' AND LOWER(direccion_nombre) LIKE "%' . strtolower($requestData['columns'][1]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][2]['search']['value']) ) {
    $sql_filter.=' AND LOWER(sinonimo_nombre) LIKE "%' . strtolower($requestData['columns'][2]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][3]['search']['value']) ) {
    $sql_filter.=' AND LOWER(ubigeo_nombre) LIKE "%' . strtolower($requestData['columns'][3]['search']['value']) . '%"';
}
$sql.= $sql_filter;

$sql_donde = '';
$pagina ='';
if ( !empty($requestData['search']['value']) && trim($requestData['search']['value']) != '' )  {
    // esto es para recuperar la pagina (es muy importante)
    $sql_donde.= 'SELECT * FROM (' . $sql;
    $sql_donde.= ' ORDER BY '. (intval($requestData['order'][0]['column'])+1) . ' ' . $requestData['order'][0]['dir'];
    $sql_donde.= ') unido2 WHERE direccion_id=' . intval($requestData['search']['value']) ;
    $query=mysqli_query($conn, $sql_donde) or die("01.5");
    while( $row=mysqli_fetch_array($query) ) $pagina = $row['row_num'];
    $pagina -= 1;
    if ($pagina > 0) {
        $pagina-= ($pagina % $requestData['length']);
        if ($pagina > 0) {
            $pagina /= $requestData['length'];
        }
    }
    $pagina *= $requestData['length'];
}
if ($pagina != '')
    $requestData['start'] = $pagina;

$query=mysqli_query($conn, $sql) or die("02");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.

$sql.=" ORDER BY ". (intval($requestData['order'][0]['column'])+1)." ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']." ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */

// print $sql;
$query=mysqli_query($conn, $sql) or die("03");

$data = array();
while( $row=mysqli_fetch_array($query) ) {
    $nestedData = array();
    $nestedData[] = utf8_encode($row['tipo_nombre']);
    $nestedData[] = utf8_encode($row['direccion_nombre']);
    $nestedData[] = utf8_encode($row['sinonimo_nombre']);
    $nestedData[] = utf8_encode($row['ubigeo_nombre']);
    $nestedData[] = sprintf(
        '
<a class="button tiny edit no-margin" data-open="ubigeo_direcciones_edit_modal" codigo="%1$d" title="Editar">
   <i class="fi-pencil medium"></i>
</a>
<a class="button tiny similar secondary no-margin" data-open="ubigeo_direcciones_similar_modal" codigo="%1$d" title="Sinonimos">
   <i class="fi-archive medium"></i>
</a>
        '
        , $row['direccion_id']
    );

    $data[] = $nestedData;
}

$json_data = array(
    "draw"            => intval( $requestData['draw'] ) // for every request/draw by clientside , they send a number as a parameter, when they recieve a response/data they first check the draw number, so we are sending same number in draw.
    , "recordsTotal"    => intval( $totalData ) // total number of records
    , "recordsFiltered" => intval( $totalFiltered ) // total number of records after searching, if there is no searching then totalFiltered = totalData
    , "data"            => $data   // total data array
    , "sql"             => $sql
);

echo json_encode($json_data);  // send data as json format
