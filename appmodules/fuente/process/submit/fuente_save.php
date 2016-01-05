<?php
include "../../../../lib/mysql/dbconnector.php";
include "../../../../lib/mysql/conexion01.php";
include "../../../../lib/mysql/utilidades.php";
include "../../../../lib/html/html.php";
// include "../../model/classes/ModeloSubimit.php";

// -------------------------------------------------------- INPUT
$in['sql'] = utf8_decode($_POST['sql']);


// -------------------------------------------------------- MODEL
$cnn= new DBConnector_Alternative();
$conn = mysqli_connect($cnn->servername, $cnn->username, $cnn->password, $cnn->dbname) or die("Connection failed: " . mysqli_connect_error());
$ou = mysqli_multi_query($conn, $in['sql']) or die("error");

// $submit = new Modelosubmit();
// $ou = $submit->setDireccion($in);

// -------------------------------------------------------- MODEL
// HTML::printr($in);
// HTML::printr($ou);
    
header('Location: ../../subir.php');