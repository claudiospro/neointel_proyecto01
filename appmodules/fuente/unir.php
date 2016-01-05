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
include "./process/onload/unir_in.php";

// ---------------------------------------------- ini-header

Html::$files['header']['css'][] = '../../static/fuente/css/fuente_unir.css?v=1.0';

Html::$title = 'Unir Data';
Html::$path = '../..';

Html::header();

// Html::printr($_POST);
// Html::printr($in);

// ---------------------------------------------- ini-body
include "../autentificacion/menu.php";
?>

<form action="unir.php" method="post" enctype="multipart/form-data">
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
    <ul class="tabs" data-tabs id="example-tabs">
      <li class="tabs-title is-active"><a href="#panel1" aria-selected="true">Datos</a></li>
      <li class="tabs-title"><a href="#panel2">No encontrados</a></li>
    </ul>
    <div class="tabs-content" data-tabs-content="example-tabs">      
      <div class="tabs-panel is-active" id="panel1">
        <a href="./process/link/excel/fuente_unir_datos_a_y_b_excel_link.php" target="_blank">Excel</a>
        <div class="callout secondary">
          <?php
          if ($in['a_y_b']) {
              // Html::printr($in['a_y_b']);
              imprimir_tabla_a_y_b($in['a_y_b']);
          }
          ?>
        </div>
      </div>
      <div class="tabs-panel" id="panel2">
        <div class="callout secondary">
          <?php
          if ($in['a_menos_b']) {
              // Html::printr($in['a_menos_b']);
              imprimir_tabla_a_menos_b($in['a_menos_b']);
          }
          ?>
        </div>
      </div>
    </div>
  </div>
</div>

<div class="row">
  <div class="large-12 columns text-right">
  </div>
</div>
<div class="row">
  <div class="large-12 columns">
      <ul class="breadcrumbs">
        <li><a href="./subir.php">Impotar</a></li>
        <li><a href="./ubigeos.php">Ubigeos</a></li>
        <li><a href="./direcciones_tipos.php" title="de Direcciones">Tipo</a></li>
        <li><a href="./direcciones.php">Dirección</a></li>
        <li>Unir</li>
      </ul>
  </div>
</div>

<?php


// ---------------------------------------------- ini-footer
Html::$files['footer']['js'][] = '../../static/reutilizables/js/ajax.js?v=1.0';

Html::$files['footer']['js'][] = '../../static/fuente/js/fuente_unir.js?v=1.0';
Html::$files['footer']['js'][] = '../../static/fuente/js/fuente_campania_id.js?v=1.0';
Html::footer();
