<?php
include "../../../../../lib/mysql/dbconnector.php";
include "../../../../../lib/mysql/utilidades.php";

$cnn= new DBConnector_Alternative();

$conn = mysqli_connect($cnn->servername, $cnn->username, $cnn->password, $cnn->dbname) or die("Connection failed: " . mysqli_connect_error());
$sql_columns= "
d1.nombre, 
d1.id,
d1.sinonimo_id
";


$sql_ini = "
SELECT unido.*, @rownum:=@rownum+1 row_num  FROM (
  SELECT
  " . $sql_columns . "
  FROM ubigeo_direccion_tipo d1 
) unido, (SELECT @rownum:=0) R
WHERE 1=1
";

// storing  request (ie, get/post) global array to a variable  
$requestData= $_REQUEST;

if (isset($requestData['codigo'])) {
    $sql_ini.= ' AND sinonimo_id="' . $requestData['codigo'] . '"';
}

// print $sql_ini;

// getting total number records without any search
$sql = $sql_ini;
$query=mysqli_query($conn, $sql) or die("01");

$totalData = mysqli_num_rows($query);
$totalFiltered = $totalData;  // when there is no search parameter then total number rows = total number filtered rows.

$sql = $sql_ini;

$query=mysqli_query($conn, $sql) or die("02");
$totalFiltered = mysqli_num_rows($query); // when there is a search parameter then we have to modify total number filtered rows as per search result.
$sql.=" ORDER BY ". (intval($requestData['order'][0]['column'])+1)." ".$requestData['order'][0]['dir']." LIMIT ".$requestData['start']." ,".$requestData['length']." ";
/* $requestData['order'][0]['column'] contains colmun index, $requestData['order'][0]['dir'] contains order such as asc/desc  */

// print $sql;
$query=mysqli_query($conn, $sql) or die("03");

$data = array();
while( $row=mysqli_fetch_array($query) ) {
    $nestedData = array();

    $nestedData[] = utf8_encode($row['nombre']);

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
