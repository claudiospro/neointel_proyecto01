<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/utilidades.php";

$cnn= new DBConnector_Alternative();

$conn = mysqli_connect($cnn->servername, $cnn->username, $cnn->password, $cnn->dbname) or die("Connection failed: " . mysqli_connect_error());
$sql_columns= "
d1.nombre, 
d2.nombre sinonimo_nombre,
d1.id,
d1.sinonimo_id
";


$sql_ini = "
SELECT unido.*, @rownum:=@rownum+1 row_num  FROM (
  SELECT
  " . $sql_columns . "
  FROM ubigeo_direccion_tipo d1 
  JOIN ubigeo_direccion_tipo d2 ON d2.id=d1.sinonimo_id
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
    $sql_filter.=' AND LOWER(nombre) LIKE "%' . strtolower($requestData['columns'][0]['search']['value']) . '%"';
}
if( !empty($requestData['columns'][1]['search']['value']) ) {
    $sql_filter.=' AND LOWER(sinonimo_nombre) LIKE "%' . strtolower($requestData['columns'][1]['search']['value']) . '%"';
}


$sql.= $sql_filter;

$sql_donde = '';
$pagina ='';
if ( !empty($requestData['search']['value']) && trim($requestData['search']['value']) != '' )  {
    // esto es para recuperar la pagina (es muy importante)
    $sql_donde.= 'SELECT * FROM (' . $sql;
    $sql_donde.= ' ORDER BY '. (intval($requestData['order'][0]['column'])+1) . ' ' . $requestData['order'][0]['dir'];
    $sql_donde.= ') unido2 WHERE id=' . intval($requestData['search']['value']) ;
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


$query=mysqli_query($conn, $sql) or die("02");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
if ($pagina != '')
    $requestData['start'] = $pagina; 
$sql.=" ORDER BY ". (intval($requestData['order'][0]['column'])+1)." ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']." ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */

// print $sql;
$query=mysqli_query($conn, $sql) or die("03");

$data = array();
while( $row=mysqli_fetch_array($query) ) {
    $nestedData = array();

    $nestedData[] = utf8_encode($row['nombre']);
    $nestedData[] = utf8_encode($row['sinonimo_nombre']);
    $nestedData[] = sprintf(
        '
<a class="button tiny edit no-margin" data-open="ubigeo_direcciones_tipo_edit_modal" codigo="%1$d" title="Editar">
   <i class="fi-pencil medium"></i>
</a>
<a class="button tiny similar secondary no-margin" data-open="ubigeo_direcciones_tipo_similar_modal" tipo_id="%1$d" sinonimo_id="%2$d" title="Sinonimos">
   <i class="fi-archive medium"></i>
</a>
        '
        , $row['id']
        , $row['sinonimo_id']
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
