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
include "./process/onload/direcciones_tipos_in.php";

// ---------------------------------------------- ini-header

Html::$files['header']['css'][] = '../../static/fuente/css/fuente_direcciones_tipos.css?v=1.0';

Html::$title = 'Tipo de Direcciones';
Html::$path = '../..';

Html::header();

// Html::printr($_POST);
// Html::printr($in);

// ---------------------------------------------- ini-body
include "../autentificacion/menu.php";
?>

<form action="direcciones_tipos.php" method="post" enctype="multipart/form-data">
  <div class="row">
    <div class="large-12 columns">
      <label class="">Campañia</label>
    </div>
  </div>
  <div class="row">
    <div class="large-10 columns">
      <select id="campania_id_select"
              class="no-margin"
              name="campania_id">

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
        <li><a href="./ubigeos.php">Ubigeos</a></li>
        <li>Tipo</li>
        <li><a href="./direcciones.php">Dirección</a></li>
        <li><a href="./unir.php">Unir</a></li>
      </ul>
  </div>
</div>

<?php


// ---------------------------------------------- ini-footer
Html::$files['footer']['js'][] = '../../static/reutilizables/js/ajax.js?v=1.0';

Html::$files['footer']['js'][] = '../../static/fuente/js/fuente_direcciones_tipos.js?v=1.0';
Html::$files['footer']['js'][] = '../../static/fuente/js/fuente_campania_id.js?v=1.0';
Html::footer();
