<?php
/*
 * para paginas
*/

// ---------------------------------------------- ini-libs
include "../../lib/html/html.php";
include "../autentificacion/logica.php";
user_log('Campania', '../autentificacion/');
// ---------------------------------------------- ini-header

Html::$files['header']['css'][] = '../../static/ubigeo/css/ubigeo_tree.css?v=1.0';

Html::$title = 'Tree Ubigeo';
Html::$path = '../..';

Html::header();
// ---------------------------------------------- ini-body
include "../autentificacion/menu.php";
?>

<div class="row">
  <div class="large-12 columns">
    <div id="ubigeo_tree_list">
      <ol id="parent_item_0">
      </ol>
    </div>
  </div>
</div>

<?php

include('./view/content/modales/ubigeo_tree_click_modal.php');

// ---------------------------------------------- ini-footer
Html::$files['footer']['js'][] = '../../static/ubigeo/js/ubigeo_tree2.js?v=1.1';
Html::$files['footer']['js'][] = '../../static/reutilizables/js/ajax.js?v=1.0';
Html::footer();
