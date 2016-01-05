<?php
include ("./logica.php");
include "../../lib/mysql/utilidades.php";
if ($_SERVER["REQUEST_METHOD"] == "POST") {
  $pass = Utilidades::clear_input($_POST["pass"]);
  logIn( $pass );
}
header('Location: ../autentificacion');

