<?php
/*
 * para paginas
*/

// ---------------------------------------------- ini-libs
include "../autentificacion/logica.php";
user_log('Campania', '../autentificacion/');

include "../../lib/html/html.php";
include "../../lib/mysql/dbconnector.php";
include "../../lib/mysql/utilidades.php";
include "../../lib/mysql/conexion01.php";
include "./model/classes/ModeloOnload.php";
include "./process/onload/ubigeos_in.php";

// ---------------------------------------------- ini-header

Html::$files['header']['css'][] = '../../static/fuente/css/fuente_ubigeos.css?v=1.0';

Html::$title = 'Ubigeos';
Html::$path = '../..';

Html::header();

// Html::printr($_POST);
// Html::printr($in);

// ---------------------------------------------- ini-body
include "../autentificacion/menu.php";
?>

<form action="ubigeos.php" method="post" enctype="multipart/form-data">
  <div class="row">
    <div class="large-10 columns">
      <label class="">Campañia</label>
    </div>
    <div class="large-2 columns text-right">
      <a href="https://www.google.es/maps/" target="_blank">Google Maps</a>
    </div>
  </div>
  <div class="row">
    <div class="large-10 columns">
      <select id="campania_id_select"
              class="no-margin"
              name="campania_id">
        <option value="1">Vodafone 2015</option>
        <option value="2">Vodafone 2016</option>
      </select>
    </div>
    <div class="large-2 columns text-right">
      <input class="button no-margin"
             name="submit"
             type="submit"
             value="Examinar"
      >
    </div>
  </div>
</form>

<div class="row">
  <div class="large-12 columns">
    <div class="callout secondary">
      <?php
      $indexar = false;
      if ($in['data']) {
          $indexar = imprimir_tabla($in['data']);
      }
      ?>
    </div>
  </div>
</div>

<div class="row">
  <div class="large-12 columns text-center">
    <?php if ($indexar) {
        indexar();
        echo '<div class="callout success">
                  Indexado
              </div>';
    } 
    ?>
  </div>
</div>
<div class="row">
  <div class="large-12 columns">
      <ul class="breadcrumbs">
        <li><a href="./subir.php">Impotar</a></li>
        <li>Ubigeos</li>
        <li><a href="./direcciones_tipos.php" title="de Direcciones">Tipo</a></li>
        <li><a href="./direcciones.php">Dirección</a></li>
        <li><a href="./unir.php">Unir</a></li>
      </ul>
  </div>
</div>

<?php


// ---------------------------------------------- ini-footer
Html::$files['footer']['js'][] = '../../static/reutilizables/js/ajax.js?v=1.0';

Html::$files['footer']['js'][] = '../../static/fuente/js/fuente_ubigeos.js?v=1.0';
Html::$files['footer']['js'][] = '../../static/fuente/js/fuente_campania_id.js?v=1.0';
Html::footer();
