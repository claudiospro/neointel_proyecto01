<?php
/*
 * para paginas
*/

// ---------------------------------------------- ini-libs
include ("../../lib/html/html.php");
include "../autentificacion/logica.php";
user_log('Campania', '../autentificacion/');
// ---------------------------------------------- ini-header
Html::$files['header']['css'][] = '../../lib/vendor/data_table/DataTables-1.10.9/css/dataTables.foundation.min.css';
Html::$files['header']['css'][] = '../../lib/vendor/jquery-ui-1.11.4.custom/jquery-ui.min.css';
Html::$files['header']['css'][] = '../../static/ubigeo/css/ubigeo_direccion.css?v=1.0';

Html::$title = 'Direcciones';
Html::$path = '../..';

Html::header();
// ---------------------------------------------- ini-body
include "../autentificacion/menu.php";
?>

<ul class="tabs" data-tabs id="ubigeo_direcciones_panel">
  <li class="tabs-title is-active">
    <a href="#ubigeo_direcciones_panel01" aria-selected="true">Direcciones</a>
  </li>
  <li class="tabs-title">
    <a href="#ubigeo_direcciones_panel02">Tipo</a>
  </li>
</ul>

<div class="tabs-content" data-tabs-content="example-tabs">
  <div class="tabs-panel is-active" id="ubigeo_direcciones_panel01">
    <div class="text-right">
      <a id="ubigeo_direcciones_add"
         class="button success add no-margin"
         data-open="ubigeo_direcciones_edit_modal"
         title="Añadir"
         codigo="0"
      >
        <i class="fi-plus medium"></i>
      </a>      
    </div>
    <table id="ubigeo_direcciones_tabla"
           width="100%">
      <thead>
        <tr>
          <td colspan="3" class="th">Direcciones</td>
          <td class="th">Ubigeo</td>
          <td rowspan="3" class="th" width="100">Acciones</td>
        </tr>
        <tr>
          <td>
            <input id="ubigeo_direcciones_table_tipo"
                   class="no-margin search-input-text"
                   data-column="0"
                   type="text">
          </td>
          <td>
            <input id="ubigeo_direcciones_table_nombre"
                   class="no-margin search-input-text"
                   data-column="1"
                   type="text">
          </td>
          <td>
            <input id="ubigeo_direcciones_table_sinonimo"
                   class="no-margin search-input-text"
                   data-column="2"
                   type="text">
          </td>
          <td>
            <input id="ubigeo_direcciones_table_ubigeo"
                   class="no-margin search-input-text"
                   data-column="3"
                   type="text">
          </td>
        </tr>
        <tr>
          <th>Tipo</th>
          <th>Nombre</th>
          <th>Sinonimo</th>
          <th>Nombre</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>    
  </div>
  
  <div class="tabs-panel" id="ubigeo_direcciones_panel02">
    <div class="text-right">
      <a id="ubigeo_direcciones_tipo_add"
         class="button success add no-margin"
         data-open="ubigeo_direcciones_tipo_edit_modal"
         title="Añadir"
         codigo="0"
      >
        <i class="fi-plus medium"></i>
      </a>      
    </div>
    <table id="ubigeo_direcciones_tipo_tabla"
           width="100%">
      <thead>
        <tr>
        </tr>
        <tr>
          <td>
            <input id="ubigeo_direcciones_tipo_table_nombre"
                   class="no-margin search-input-text"
                   data-column="0"
                   type="text">
          </td>
          <td>
            <input id="ubigeo_direcciones_tipo_table_sinonimo"
                   class="no-margin search-input-text"
                   data-column="1"
                   type="text">
          </td>
          <td rowspan="2" class="th" width="100">
            Acciones
          </td>
        </tr>
        <tr>
          <th>Nombre</th>
          <th>Sinonimo</th>
        </tr>
      </thead>
      <tbody>
      </tbody>
    </table>    
  </div>
</div>
<?php
// modales
include './view/content/modales/ubigeo_direccion_edit_click_modal.php';
include './view/content/modales/ubigeo_direccion_sinonimos_click_modal.php';

include './view/content/modales/ubigeo_direccion_tipo_edit_click_modal.php';
include './view/content/modales/ubigeo_direccion_tipo_sinonimos_click_modal.php';

// ---------------------------------------------- ini-footer
Html::$files['footer']['js'][] = '../../lib/vendor/data_table/datatables.min.js';
Html::$files['footer']['js'][] = '../../lib/vendor/data_table/DataTables-1.10.9/js/dataTables.foundation.min.js';
Html::$files['footer']['js'][] = '../../lib/vendor/jquery-ui-1.11.4.custom/jquery-ui.min.js';
Html::$files['footer']['js'][] = '../../static/reutilizables/js/ajax.js?v=1.0';
Html::$files['footer']['js'][] = '../../static/ubigeo/js/ubigeo_direccion.js?v=1.0';

Html::footer();
