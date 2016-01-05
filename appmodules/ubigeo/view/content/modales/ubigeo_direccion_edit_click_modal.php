<?php $pre = 'ubigeo_direcciones_edit_modal' ?>
<div class="large reveal" id="<?php echo $pre ?>" data-reveal>

  <div class="row">
    <div class="small-2 columns">
      <label for="<?php echo $pre ?>_tipo"
             class="text-right middle no-margin">Tipo</label>
   </div>
    <div class="small-9 columns">
      <label id="<?php echo $pre ?>_tipo_nombre"
             class="middle no-margin">
        Label</label>
    </div>
    <div class="small-1 columns">
      &nbsp;
    </div>
  </div>
  <div class="row">
    <div class="small-2 columns">
      &nbsp;
    </div>
    <div class="small-9 columns">
      <input id="<?php echo $pre ?>_tipo_id"
             type="hidden">
      <input id="<?php echo $pre ?>_tipo_id_temp"
             type="hidden">
      <input id="<?php echo $pre ?>_tipo"
             class=""
             type="text">
    </div>
    <div class="small-1 columns">
      <a id="<?php echo $pre ?>_tipo_editar"
         class="button edit no-margin"
         title="Editar">
        <i class="fi-pencil medium"></i>
      </a>
    </div>
  </div>

  <div class="row">
    <div class="small-2 columns">
      <label for="<?php echo $pre ?>_direcion_nombre"
             class="text-right middle">Nombre
      </label>
    </div>
    <div class="small-9 columns">
      <input id="<?php echo $pre ?>_direccion_id"
             type="hidden">
      <input id="<?php echo $pre ?>_direccion_nombre"
             class="no-margin"
             type="text">
    </div>
    <div class="small-1 columns">
      
    </div>
  </div>
  
  <div class="row">
    <div class="small-2 columns">
      <label for="<?php echo $pre ?>_ubigeo"
             class="text-right middle no-margin">Ubigeo</label>
    </div>
    <div class="small-9 columns">
      <label id="<?php echo $pre ?>_ubigeo_nombre" class="middle no-margin">Label</label>
    </div>
    
    <div class="small-1 columns">
      &nbsp;
    </div>
  </div>
  <div class="row">
    <div class="small-2 columns">
      &nbsp;
    </div>
    <div class="small-9 columns">
      <input id="<?php echo $pre ?>_ubigeo_id"
             type="hidden">
      <input id="<?php echo $pre ?>_ubigeo_id_temp"
             type="hidden">
      <input id="<?php echo $pre ?>_ubigeo"
             class=""
             type="text">
    </div>
    <div class="small-1 columns">
      <a id="<?php echo $pre ?>_ubigeo_editar"
         class="button edit no-margin"
         title="Editar">
        <i class="fi-pencil medium"></i>
      </a>
    </div>
  </div>
  
  <div class="row">
    <div class="small-12 columns text-right">
      <button id="<?php echo $pre ?>_save"
              class="button no-margin"
              data-close>
        Editar
      </button>
    </div>
  </div>
</div>

