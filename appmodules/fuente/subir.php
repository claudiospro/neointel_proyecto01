<?php
/*
 * para paginas
*/

// ---------------------------------------------- ini-libs
include "../autentificacion/logica.php";
user_log('Campania', '../autentificacion/');

include "../../lib/html/html.php";
include "../../lib/mysql/utilidades.php";
include "./process/onload/subir_in.php";

// ---------------------------------------------- ini-header

Html::$files['header']['css'][] = '../../static/fuente/css/fuente_subir.css?v=1.0';

Html::$title = 'Subir Fuentes';
Html::$path = '../..';

Html::header();

// Html::printr($_FILES);
// Html::printr($_POST);
// Html::printr($in);

// ---------------------------------------------- ini-body
include "../autentificacion/menu.php";
?>

<form action="subir.php" method="post" enctype="multipart/form-data">
  <div class="row">
    <div class="large-3 columns text-right">
      <label class="middle no-margin">Campañia</label>
    </div>
    <div class="large-3 columns">
      <select id="campania_id_select"
              class="no-margin"
              name="campania_id">
      </select>
    </div>
    <div class="large-2 columns">
    </div>
  </div>
  <div class="row">
    <div class="large-3 columns">
      <div class="row">
        <div class="large-12 columns">
          <label class="float-left">Fuente</label>
          <div class="switch tiny no-margin">
            <input class="switch-input" id="yes-no" type="checkbox" name="fuente_tipo">
            <label class="switch-paddle" for="yes-no">
              <span class="switch-active" aria-hidden="true">1</span>
              <span class="switch-inactive" aria-hidden="true">2</span>
            </label>
          </div>
        </div>
        <div class="large-12 columns">
          1: es de los huecos <br>
          2: es de los teléfonos
        </div>
      </div>
    </div>
    <div class="large-9 columns">
      <input class=""
             name="fuente"
             type="file"
      >
      <input class="button no-margin"
             name="submit"
             type="submit"
             value="Examinar"
      >
    </div>
  </div>
</form>

<form action="./process/submit/fuente_save.php" method="POST">
  <div class="row">
    <div class="large-12 columns">
      <div class="callout secondary">
        <?php      
        if ($in['fuente']) {
            echo '<textarea name="sql" readonly rows="5">';
            if ($in['fuente_tipo'] == '1') sql_fuente_1($in['fuente'], $in['campania_id']);
            if ($in['fuente_tipo'] == '2') sql_fuente_2($in['fuente'], $in['campania_id']);
            echo '</textarea>';
        }
        ?>
      </div>
    </div>
  </div>
  <div class="row">
    <div class="large-12 columns text-right">
      <?php if ($in['fuente']): ?>
        <button id="guardar-sql"
                class="button success no-margin"
                type="submit">
          Guardar
        </button>
      <?php endif ?>
    </div>
  </div>  
</form>

<div class="row">
  <div class="large-12 columns">
    <ul class="breadcrumbs">
      <li>Impotar</li>
      <li><a href="./ubigeos.php">Ubigeos</a></li>
      <li><a href="./direcciones_tipos.php" title="de Direcciones">Tipo</a></li>
      <li><a href="./direcciones.php">Dirección</a></li>
      <li><a href="./unir.php">Unir</a></li>
    </ul>
  </div>
</div>
<?php


// ---------------------------------------------- ini-footer
Html::$files['footer']['js'][] = '../../static/reutilizables/js/ajax.js?v=1.0';

Html::$files['footer']['js'][] = '../../static/fuente/js/fuente_subir.js?v=1.0';
Html::$files['footer']['js'][] = '../../static/fuente/js/fuente_campania_id.js?v=1.0';
Html::footer();
