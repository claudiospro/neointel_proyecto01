<?php $pre = 'ubigeo_direcciones_similar_modal' ?>
<div class="large reveal" id="<?php echo $pre ?>" data-reveal>
  <h2 id="<?php echo $pre ?>_title" ></h2>
  <input id="<?php echo $pre ?>_id"
         type="hidden">
  <table id="<?php echo $pre ?>_tabla" width="100%">
    <thead>
      <tr>
        <td colspan="2" class="th">Direcciones</td>
        <td class="th">Ubigeo</td>
        <td rowspan="3" class="th" width="100">Acciones</td>
      </tr>
      <tr>
        <td>
          <input id="<?php echo $pre ?>_tabla_tipo"
                 class="no-margin search-input-text"
                 data-column="0"
                 type="text">
        </td>
        <td>
          <input id="<?php echo $pre ?>_tabla_nombre"
                 class="no-margin search-input-text"
                 data-column="1"
                 type="text">
        </td>
        <td>
          <input id="<?php echo $pre ?>_tabla_ubigeo"
                 class="no-margin search-input-text"
                 data-column="2"
                 type="text">
        </td>
      </tr>
      <tr>
        <th>Tipo</th>
        <th>Nombre</th>
        <th>Nombre</th>
      </tr>
    </thead>
  </table>
</div>
