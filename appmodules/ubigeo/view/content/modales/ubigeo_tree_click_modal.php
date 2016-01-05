<div class="large reveal" id="ubigeo_tree_edit_modal" data-reveal>
  <input id="ubigeo_tree_edit_modal_id"
         type="hidden">
  <input id="ubigeo_tree_edit_modal_nivel"
         type="hidden">


  <div class="row">
    <div class="small-3 columns">
      <label for="ubigeo_tree_edit_modal_nombre"
             class="text-right middle">Nombre</label>
    </div>
    <div class="small-9 columns">
      <input id="ubigeo_tree_edit_modal_nombre"
             type="text"
             placeholder="">
    </div>
  </div>
  
  <div class="row">
    <div class="small-3 columns">
      <label for="ubigeo_tree_edit_modal_tipo_id"
             class="text-right middle">Tipo</label>
    </div>
    <div class="small-9 columns">
      <select id="ubigeo_tree_edit_modal_tipo_id" disabled>
        <option value=""></option>
      </select>
    </div>
  </div>

  <div class="row">
    <div class="small-12 columns text-right">
      <button id="ubigeo_tree_edit_modal_save"
              class="button no-margin">Editar</button>
    </div>
  </div>
  <fieldset class="fieldset">
    <legend>Sinonimos</legend>
    <div class="row">
      <input id="ubigeo_tree_edit_modal_sinonimo_id"
             type="hidden" value="0">
      <div class="small-9 columns">
        <input id="ubigeo_tree_edit_modal_sinonimo_nombre"
               type="text">
      </div>
      <div class="small-3 columns text-right">
        <a id="ubigeo_tree_edit_modal_sinonimo_clear"
           class="button secondary no-margin">Limpiar</a>
        <a id="ubigeo_tree_edit_modal_sinonimo_save"
           class="button success no-margin">Añadir</a>
      </div>
    </div>
    <div class="small-12 columns">
      <table id="ubigeo_tree_edit_modal_sinonimo_table"
             width="100%">
        <thead>
          <tr>
            <th>Nombre</th>
            <th width="100">Acciones</th>
          </tr>
        </thead>
        <tbody>
        </tbody>
      </table>
    </div>
  </fieldset>
</div>

