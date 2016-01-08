$(document).ready(function() {
    var option_empty='<option value=""></option>';
    var prefixId = '#ubigeo_direcciones_';
    var prefixClass = '.ubigeo_direcciones_';
    var dataTable_direccion = '';
    var dataTable_direccion_sinonimos = '';
    var dataTable_direccion_tipo = '';
    var dataTable_direccion_tipo_sinonimos = '';
    
    // --------------------------------------------------------------- load
    ubigeo_direcciones_tabla();
    ubigeo_direcciones_tipo_tabla();

    // ------------------------------------------------------------ eventos
    // direccion
    $(prefixId+'tabla .search-input-text').on('keyup click', function (event) {
        var i = $(this).attr('data-column');
        var v = $(this).val();

        if (event.which == 13) {
            dataTable_direccion.columns(i).search(v).draw();
            if (v=='') {
                $(this).css('background-color','transparent');
            } else {
                $(this).css('background-color','#D3FFE4');
            }
        }
    });
    $(prefixId+'add').on('click', function (event) {
        ubigeo_direcciones_edit($(this));
    });
    $(prefixId+'tabla tbody').on('click', '.edit', function (event) {
        ubigeo_direcciones_edit($(this));
    });    
    $(prefixId+'edit_modal_tipo').autocomplete({
        source: './process/ajax/autocomplete/ubigeo_direccion_tipo_sinonimo_key_text.php',
        search: function( event, ui ) {
            $(this).css('background-color','transparent');
            $(prefixId+'edit_modal_tipo_id_temp').val('0');
        },
        select: function( event, ui ) {
            $(this)
                .val(ui.item.label)
                .css('background-color','#76ff74');
            $(prefixId+'edit_modal_tipo_id_temp').val(ui.item.id);
            return false;
        }
    });
    $(prefixId+'edit_modal_ubigeo').autocomplete({
        source: './process/ajax/autocomplete/ubigeo_ubigeos_key_text.php',
        search: function( event, ui ) {
            $(this).css('background-color','transparent');
            $(prefixId+'edit_modal_ubigeo_id_temp').val('0');
        },
        select: function( event, ui ) {
            $(this)
                .val(ui.item.label)
                .css('background-color','#76ff74');
            $(prefixId+'edit_modal_ubigeo_id_temp').val(ui.item.id);
            return false;
        }, 
    });
    //          
    $(prefixId+'edit_modal_tipo_editar').on('click', function (event) {
        ubigeo_direcciones_edit_modal_tipo_editar();
    });
    $(prefixId+'edit_modal_ubigeo_editar').on('click', function (event) {
        ubigeo_direcciones_edit_modal_ubigeo_editar();
    });
    $(prefixId+'edit_modal_save').on('click', function (event) {
        var ou = '';
        ou = ubigeo_direcciones_edit_modal_save();
        if (ou == '0') event.stopPropagation();
    });
    // direccion sinonimo
    $(prefixId+'similar_modal_tabla .search-input-text').on('keyup click', function (event) {
        var i = $(this).attr('data-column');
        var v = $(this).val();

        if (event.which == 13) {
            dataTable_direccion_sinonimos.columns(i).search(v).draw();
            if (v=='') {
                $(this).css('background-color','transparent');
            } else {
                $(this).css('background-color','#D3FFE4');
            }
        }
    });
    $(prefixId+'tabla tbody').on('click', '.similar', function (event) {
        ubigeo_direcciones_similar($(this));
    });
    $(prefixId+'similar_modal_tabla').on('click', 'a', function (event) {
        ubigeo_direcciones_similar_modal_tabla_select($(this));
    });
    // direccion tipo
    $(prefixId+'tipo_tabla .search-input-text').on('keyup click', function (event) {
        var i = $(this).attr('data-column');
        var v = $(this).val();

        if (event.which == 13) {
            dataTable_direccion_tipo.columns(i).search(v).draw();
            if (v=='') {
                $(this).css('background-color','transparent');
            } else {
                $(this).css('background-color','#D3FFE4');
            }
        }
    });
    $(prefixId+'tipo_add').on('click', function (event) {
        ubigeo_direcciones_tipo_edit($(this));
    });
    $(prefixId+'tipo_tabla tbody').on('click', '.edit', function (event) {
        ubigeo_direcciones_tipo_edit($(this));
    });
    $(prefixId+'tipo_edit_modal_save').on('click', function (event) {
        var ou = '';
        ou = ubigeo_direcciones_tipo_edit_modal_save();
        if (ou == '0') event.stopPropagation();
    });
    // direccion tipo similar
    $(prefixId+'tipo_tabla tbody').on('click', '.similar', function (event) {
        ubigeo_direcciones_tipo_similar($(this));
    });
    $(prefixId+'tipo_similar_modal_sinonimo_texto').autocomplete({
        source: './process/ajax/autocomplete/ubigeo_direccion_tipo_sinonimo_key_text.php',
        search: function( event, ui ) {
            $(this).css('background-color','transparent');
            $(prefixId+'tipo_similar_modal_sinonimo_id').val('0');
        },
        select: function( event, ui ) {
            $(this)
                .val(ui.item.label)
                .css('background-color','#76ff74');
            $(prefixId+'tipo_similar_modal_sinonimo_id').val(ui.item.id);
            return false;
        }
    });
    $(prefixId+'tipo_similar_modal_sinonimo_save').on('click', function (event) {
        ubigeo_direcciones_tipo_similar_modal_sinonimo_save();
    });
    
    // ---------------------------------------------------------- funciones
    // ----------------------- direccion
    function ubigeo_direcciones_tabla () {
        dataTable_direccion = $(prefixId+'tabla').DataTable({
            "processing" : true,
            "serverSide" : true,
            "lengthChange": false,
            // "searching": false,
            "info": false,
            //"bAutoWidth" : false,

            // "scrollY": false,
            // "scrollX": true,
            
            "pageLength" : 50,
            "order"      : [ 1, 'asc' ],
            "aoColumnDefs": [ { 'bSortable': false, 'aTargets': [ 4 ] } ],
            "ajax": {
                url :"./process/ajax/table/ubigeo_direccion_listado_onload_tbody.php", 
                type: "post",
            },
        });
        $(prefixId+'tabla_filter').hide();
    }
    //
    function ubigeo_direcciones_edit(item) {
        var enviar = {
            'codigo' : item.attr('codigo'),            
        }
        // c(enviar);
        if (enviar.codigo == '0') {
            ubigeo_direcciones_clear();
        } else {
            $.ajax({
                type: "POST",
                data: enviar,
                url: './process/ajax/edit/ubigeo_direcciones_edit_click.php',
                success: function(data) {
                    // c(data);
                    var json = jQuery.parseJSON(data);
                    // c(json);
                    ubigeo_direcciones_clear_edit(json);
                }
            });
        }
    }
    function ubigeo_direcciones_clear() {
        var datos = {
            'tipo_id' : '0',
            'tipo_nombre' : '',
            'direccion_id' : '0',
            'direccion_nombre' : '',
            'ubigeo_id' : '0',
            'ubigeo_nombre' : '',
            'save': 'Añadir'
        }
        ubigeo_direcciones_clear_edit(datos);
    }
    function ubigeo_direcciones_clear_edit(datos) {
        $(prefixId+'edit_modal_tipo_id').val(datos.tipo_id);
        $(prefixId+'edit_modal_tipo_nombre').html(datos.tipo_nombre);
        $(prefixId+'edit_modal_direccion_id').val(datos.direccion_id);
        $(prefixId+'edit_modal_direccion_nombre').val(datos.direccion_nombre);
        $(prefixId+'edit_modal_ubigeo_id').val(datos.ubigeo_id);
        $(prefixId+'edit_modal_ubigeo_nombre').html(datos.ubigeo_nombre);        
        $(prefixId+'edit_modal_save').text(datos.save);
        //
        $(prefixId+'edit_modal_tipo')
            .val('')
            .css('background-color','transparent');
        $(prefixId+'edit_modal_tipo_id_temp').val('0');
        $(prefixId+'edit_modal_ubigeo')
            .val('')
            .css('background-color','transparent');
        $(prefixId+'edit_modal_ubigeo_id_temp').val('0');
    }
    function ubigeo_direcciones_edit_modal_tipo_editar() {
        var enviar = {
            'id'   : $(prefixId+'edit_modal_tipo_id_temp').val(),
            'nombre': $(prefixId+'edit_modal_tipo').val(),
        }
        //c(enviar);
        if (enviar.id !='0') {
            $(prefixId+'edit_modal_tipo_id').val(enviar.id);
            $(prefixId+'edit_modal_tipo_nombre').html(enviar.nombre);
        } else {
            alert('Seleccionar Tipo');
        }
    }
    function ubigeo_direcciones_edit_modal_ubigeo_editar() {
        var enviar = {
            'id'   : $(prefixId+'edit_modal_ubigeo_id_temp').val(),
            'nombre': $(prefixId+'edit_modal_ubigeo').val(),
        }
        if (enviar.id !='0') {
            $(prefixId+'edit_modal_ubigeo_id').val(enviar.id);
            $(prefixId+'edit_modal_ubigeo_nombre').html(enviar.nombre);
        } else {
            alert('Seleccionar Ubigeo');
        }
    }
    function ubigeo_direcciones_edit_modal_save() {
        var ou = '1';
        var enviar = {
            'id'       : $(prefixId+'edit_modal_direccion_id').val(),
            'nombre'   : $(prefixId+'edit_modal_direccion_nombre').val(),
            'tipo_id'  : $(prefixId+'edit_modal_tipo_id').val(),
            'ubigeo_id': $(prefixId+'edit_modal_ubigeo_id').val(),
        }
        // c(enviar);
        if (enviar.tipo_id!='0' && enviar.nombre.trim() !='' && enviar.ubigeo_id!='0') {
            var flag = {
                '1': 'Se guardo exitosamente',
                '0': 'Error: Existe ese nombre'
            }
            flag_simple('./process/ajax/save/ubigeo_direccion_click_save.php', enviar, flag);
            if (enviar.id !=0) {
                dataTable_direccion
                    .search(enviar.id)
                    .draw();
                dataTable_direccion
                    .search('');                
            } else {
                dataTable_direccion
                    .draw();
            }
        } else {
            ou = '0'
            if (enviar.tipo_id  =='0') alert('Seleccione Tipo');
            if (enviar.nombre.trim() =='') alert('Seleccione Nombre');
            if (enviar.ubigeo_id=='0') alert('Seleccione Ubigeo');
        }
        
        return ou;
    }
    // direccion sinonimo
    function ubigeo_direcciones_similar(item) {
        $(prefixId+'similar_modal_title').html(
            item.parent().parent().find("td").eq(0).text() + ' ' +
            item.parent().parent().find("td").eq(1).text()
        );
        $(prefixId+'similar_modal_id').val(item.attr('codigo'));
        dataTable_direccion_sinonimos = $(prefixId+'similar_modal_tabla').DataTable({
            "processing" : true,
            "serverSide" : true,
            "lengthChange": false,
            "info": false,
            "pageLength" : 10,
            "bDestroy": true,
            "order": [ 1, 'asc' ],
            "aoColumnDefs": [ { 'bSortable': false, 'aTargets': [ 3 ] } ],
            "ajax": {
                url :"./process/ajax/table/ubigeo_direccion_sinonimos_listado_click_tbody.php", 
                type: "post",
            },
        });
        $(prefixId+'similar_modal_tabla_filter').hide();
    }
    function ubigeo_direcciones_similar_modal_tabla_select(item) {
        var ou = 1;
        var enviar = {
            'id': $(prefixId+'similar_modal_id').val(),
            'sinonimo_id': item.attr('codigo'),
        }
        // c(enviar);
        $.ajax({
	    type: "POST",
	    data: enviar,
	    url: './process/ajax/save/ubigeo_direccion_sinonimo_add_click_save.php',
	    success: function(data) {}
        });
        dataTable_direccion
            .search(enviar.id)
            .draw();
        dataTable_direccion
            .search('');
        return ou;
    }
    // ----------------------- direccion tipo
    function ubigeo_direcciones_tipo_tabla () {
        dataTable_direccion_tipo = $(prefixId+'tipo_tabla').DataTable({
            "processing" : true,
            "serverSide" : true,
            "lengthChange": false,
            // "searching": false,
            "info": false,
            //"bAutoWidth" : false,

            // "scrollY": false,
            // "scrollX": true,
            
            "pageLength" : 20,
            // "order"      : [ 0, 'desc' ],
            "aoColumnDefs": [ { 'bSortable': false, 'aTargets': [ 2 ] } ],
            "ajax": {
                url :"./process/ajax/table/ubigeo_direccion_tipo_listado_onload_tbody.php", 
                type: "post",
            },
        });
        $(prefixId+'tipo_tabla_filter').hide();
    }
    //
    function ubigeo_direcciones_tipo_edit(item) {
        var enviar = {
            'codigo' : item.attr('codigo'),            
        }
        // c(enviar);
        if (enviar.codigo == '0') {
            ubigeo_direcciones_tipo_clear();
        } else {
            $.ajax({
                type: "POST",
                data: enviar,
                url: './process/ajax/edit/ubigeo_direcciones_tipo_edit_click.php',
                success: function(data) {
                    // c(data);
                    var json = jQuery.parseJSON(data);
                    // c(json);
                    ubigeo_direcciones_tipo_clear_edit(json);
                }
            });
        }
    }
    function ubigeo_direcciones_tipo_clear() {
        var enviar = {
            'id'    : '0',
            'nombre': '',
            'save'  : 'Añadir'
        }
        // c(datos);
        ubigeo_direcciones_tipo_clear_edit(enviar)
        $(prefixId+'tipo_tabla tbody tr').removeClass('edit-item');
    }
    function ubigeo_direcciones_tipo_clear_edit(datos) {
        $(prefixId+'tipo_edit_modal_id').val(datos.id);
        $(prefixId+'tipo_edit_modal_nombre').val(datos.nombre);
        $(prefixId+'tipo_edit_modal_save').text(datos.save);
    }
    function ubigeo_direcciones_tipo_edit_modal_save() {
        var ou = '1';
        var enviar = {
            'id'    : $(prefixId+'tipo_edit_modal_id').val(),
            'nombre': $(prefixId+'tipo_edit_modal_nombre').val()
        }
        //c(enviar);
        if (enviar.nombre.trim() !='') {
            var flag = {
                '1': 'Se guardo exitosamente',
                '0': 'Error: Existe ese nombre'
            }
            
            flag_simple('./process/ajax/save/ubigeo_direccion_tipo_click_save.php'
                        , enviar
                        , flag
                       );
            if (enviar.id !=0) {
                dataTable_direccion_tipo
                    .search(enviar.id)
                    .draw();
                dataTable_direccion_tipo
                    .search('');                
            } else {
                dataTable_direccion_tipo
                    .draw();
            }
        } else {
            ou = '0'
            if (enviar.nombre.trim() =='') alert('Seleccione Nombre');
        }

        return ou;
    }
    //
    function ubigeo_direcciones_tipo_similar(item) {
        $(prefixId+'tipo_similar_modal_id').val(item.attr('tipo_id'));
        $(prefixId+'tipo_similar_modal_title').html(
            item.parent().parent().find("td").eq(0).text()
        );
        $(prefixId+'tipo_similar_modal_sinonimo_texto')
            .val('')
            .css('background-color','transparent');
        // c(enviar);
        ubigeo_direcciones_tipo_similar_tabla(item.attr('sinonimo_id'));
    }
    function ubigeo_direcciones_tipo_similar_tabla(id) {
        var enviar = {
            'codigo' : id,
        }
        // c(enviar);
        dataTable_direccion_tipo_sinonimos = $(prefixId+'tipo_similar_modal_tabla').DataTable({
            "processing" : true,
            "serverSide" : true,
            "lengthChange": false,
            "info": false,
            "pageLength" : 5,
            "bDestroy": true,
            "ajax": {
                url :"./process/ajax/table/ubigeo_direccion_tipo_sinonimos_listado_click_tbody.php", 
                type: "post",
                data: enviar,
            },
        });
        $(prefixId+'tipo_similar_modal_tabla_filter').hide();
    }
    function ubigeo_direcciones_tipo_similar_modal_sinonimo_save() {
        var enviar = {
            'id': $(prefixId+'tipo_similar_modal_id').val(),
            'sinonimo_id': $(prefixId+'tipo_similar_modal_sinonimo_id').val()
        }
        if (enviar.sinonimo_id!='0') {
            none_simple('./process/ajax/save/ubigeo_direccion_tipo_sinonimo_add_click_save.php',
                        enviar
                       );
            $(prefixId+'tipo_similar_modal_sinonimo_texto')
                .val('')
                .css('background-color','transparent');
            ubigeo_direcciones_tipo_similar_tabla(enviar.id);
            dataTable_direccion_tipo
                .search(enviar.id)
                .draw();
            dataTable_direccion_tipo
                .search('');
        } else {
            alert('Seleccione Sinonimo');
        }

    }
});
