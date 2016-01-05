<?php $pre = 'ubigeo_direcciones_tipo_similar_modal' ?>
<div class="large reveal" id="<?php echo $pre ?>" data-reveal>
  <h2 id="<?php echo $pre ?>_title" ></h2>
  <ul class="tabs" data-tabs id="<?php echo $pre ?>_panel">
    <li class="tabs-title is-active">
      <a href="#<?php echo $pre ?>_panel01" aria-selected="true">Listado</a>
    </li>
    <li class="tabs-title">
      <a href="#<?php echo $pre ?>_panel02">Referencia</a>
    </li>
  </ul>

  <div class="tabs-content" data-tabs-content="<?php echo $pre ?>_panel">
    <div class="tabs-panel is-active" id="<?php echo $pre ?>_panel01">
      <table id="<?php echo $pre ?>_tabla" >
        <thead>
          <tr>
            <th>Nombre</th>
          </tr>
        </thead>
      </table>
    </div>
    <div class="tabs-panel" id="<?php echo $pre ?>_panel02">
      <input id="<?php echo $pre ?>_id"
             type="hidden"
             value="0">
      <input id="<?php echo $pre ?>_sinonimo_id"
             type="hidden"
             value="0"> 
      <div class="row">
        <div class="large-10 columns">
          <input id="<?php echo $pre ?>_sinonimo_texto"
                 class="no-margin"
                 type="text">
        </div>
        <div class="large-2 columns">
          <button id="<?php echo $pre ?>_sinonimo_save"
                  class="button no-margin">
            Añadir
          </button>
        </div>
      </div>
    </div>
  </div>
</div>
