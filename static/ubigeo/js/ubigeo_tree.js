$(document).ready(function() {
    var option_empty='<option value=""></option>';
    var prefixId = '#ubigeo_tree_';
    var prefixClass = '.ubigeo_tree_';
    // --------------------------------------------------------------- load
    ubigeo_tree_list();
    $(prefixClass+'ocultar').prop('checked', false);
    ubigeo_tree_list_a_edit_tipo_id();
    // ------------------------------------------------------------ eventos
    $(prefixId+'list').on( 'click', 'li a.list', function () {
        ubigeo_tree_list_a($(this));
    });
    $(prefixId+'list').on( 'click', 'li a.edit', function () {
        ubigeo_tree_list_a_edit($(this));
    });
    $(prefixClass+'ocultar').on( 'change', function () {
        ubigeo_tree_list_ocultar($(this));
    });
    $(prefixId+'edit_modal_save').on( 'click', function () {
        ubigeo_tree_list_a_edit_save();
    });
    $(prefixId+'edit_modal_sinonimo_save').on( 'click', function () {
        ubigeo_tree_edit_sinonimo_save();
    });
    $(prefixId+'edit_modal_sinonimo_clear').on( 'click', function () {
        ubigeo_tree_edit_sinonimo_clear();
    });
    $(prefixId+'edit_modal_sinonimo_table tbody').on( 'click', '.editar', function () {
        ubigeo_tree_edit_sinonimo_edit($(this));
    });
    $(prefixId+'edit_modal_sinonimo_table tbody').on( 'click', '.eliminar', function () {
        ubigeo_tree_edit_sinonimo_delete($(this));
    });
    // ---------------------------------------------------------- funciones
    function ubigeo_tree_list() {
        element_simple( './process/ajax/tree/ubigeo_tree_onload_treeUl.php'
                        , prefixId+'list'
                        , null
                      );
    }
    function ubigeo_tree_list_a(item) {
        // var display = item.next().css('display');
        var display = item.parent().find("ol").eq(0).css('display');
        // a(display);
        if (display == 'block') {
            item.parent().find("ol").eq(0).css('display', 'none');
        } else if (display == 'none') {
            item.parent().find("ol").eq(0).css('display', 'block');
        }
        $(prefixClass+'ocultar').prop('checked', false);
    }
    function ubigeo_tree_list_ocultar(item) {
        var ol = '';
        if (item.attr('level')=='2') {
            ol = 'ol ol';
        } else if (item.attr('level')=='3') {
            ol = 'ol ol ol';
        } else if (item.attr('level')=='4') {
            ol = 'ol ol ol ol';
        }
        if (item.is(':checked')==true) {
            $(prefixId+'list '+ol).css('display','none');
        } else if (item.is(':checked')==false) {
            $(prefixId+'list '+ol).css('display','block');
        }
    }
    // edit
    function ubigeo_tree_list_a_edit(item) {
        var enviar = {
            'codigo': item.attr('codigo')
        }
        // c(enviar);
        $.ajax({
	    type: "POST",
	    data: enviar,
	    url: './process/ajax/edit/ubigeo_tree_ubigeo_edit_click.php',
	    success: function(data) {
                var json = jQuery.parseJSON(data);
                //c(json);
                $(prefixId+'edit_modal_id').val(json.id);
                $(prefixId+'edit_modal_nivel').val(json.nivel);
                $(prefixId+'edit_modal_nombre').val(json.nombre);
                $(prefixId+'edit_modal_tipo_id').val(json.tipo_id);
                
                ubigeo_tree_edit_sinonimo_clear();
                ubigeo_tree_list_a_edit_sinonimos_table(json.id);
	    }
	});
    }
    function ubigeo_tree_list_a_edit_tipo_id() {
        select_simple('./process/ajax/select/ubigeo_tree_tipo_id_onload_select.php'
                      , prefixId+'edit_modal_tipo_id'
                      , null
                     );
    }
    function ubigeo_tree_list_a_edit_sinonimos_table(id) {
        var enviar = {
            'id': id
        }
        element_simple(
            './process/ajax/table/ubigeo_tree_edit_sinonimos_click_tbody.php',
            prefixId+'edit_modal_sinonimo_table tbody',
            enviar
        );
    }
    // save
    function ubigeo_tree_list_a_edit_save() {
        var enviar = {
            'id': $(prefixId+'edit_modal_id').val()
            , 'nombre': $(prefixId+'edit_modal_nombre').val()
        }
        // c(enviar);
        if (enviar.nombre.trim()!='') {
            none_simple(
                './process/ajax/save/ubigeo_tree_ubigeo_click_save.php'
                , enviar
            );
            // ubigeo_tree_list();
            $('#ubigeo_tree_list #list-item-'+enviar.id+' a.list').html(enviar.nombre);
            $('#ubigeo_tree_list .list-item a.list').removeClass('active');
            $('#ubigeo_tree_list #list-item-'+enviar.id+' a.list').addClass('active');
            alert('Guardado');
        } else {
            alert('Nombre obligatorio');
        }
    }    
    // sinonimos
    function ubigeo_tree_edit_sinonimo_save() {
        var enviar = {
            'ubigeo_id'        : $(prefixId+'edit_modal_id').val()
            , 'ubigeo_nivel'   : $(prefixId+'edit_modal_nivel').val()
            , 'sinonimo_id'    : $(prefixId+'edit_modal_sinonimo_id').val()
            , 'sinonimo_nombre': $(prefixId+'edit_modal_sinonimo_nombre').val()
        }
        // c(enviar);
        if (enviar.sinonimo_nombre.trim()!='') {
            none_simple('./process/ajax/save/ubigeo_tree_sinonimo_click_save.php', enviar);
            ubigeo_tree_edit_sinonimo_clear();
            ubigeo_tree_list_a_edit_sinonimos_table(enviar.ubigeo_id);

            $('#ubigeo_tree_list .list-item a.list').removeClass('active');
            $('#ubigeo_tree_list #list-item-'+enviar.ubigeo_id+' a.list').addClass('active');
        } else {
            alert('Texto obligatorio');
        }
    }
    function ubigeo_tree_edit_sinonimo_clear() {
        var datos = {
            'sinonimo_id'    : '0',
            'sinonimo_nombre': '',
            'save'           : 'Añadir'
        }
        // c(datos);
        ubigeo_tree_edit_sinonimo_edit_clear(datos);
        $(prefixId+'edit_modal_sinonimo_table tbody tr').removeClass('edit-item');
    }
    function ubigeo_tree_edit_sinonimo_edit(item) {
        var datos = {
            'sinonimo_id'    : item.parent().parent().attr('sinonimo_id'),
            'sinonimo_nombre': item.parent().parent().find("td").eq(0).text(),
            'save'           : 'Editar'
        }
        // c(datos);
        ubigeo_tree_edit_sinonimo_edit_clear(datos);
        $(prefixId+'edit_modal_sinonimo_table tbody tr').removeClass('edit-item');
        item.parent().parent().addClass('edit-item');
    }
    function ubigeo_tree_edit_sinonimo_edit_clear(datos) {
        $(prefixId+'edit_modal_sinonimo_id').val(datos.sinonimo_id);
        $(prefixId+'edit_modal_sinonimo_nombre').val(datos.sinonimo_nombre);
        $(prefixId+'edit_modal_sinonimo_save').text(datos.save);
    }
    function ubigeo_tree_edit_sinonimo_delete(item) {
        var enviar = {
            'sinonimo_id': item.parent().parent().attr('sinonimo_id'),
        }
        // c(enviar);
        delete_simple(
            './process/ajax/delete/ubigeo_tree_sinonimo_click_delete.php', 
            item.parent().parent(),
            enviar
        );
        ubigeo_tree_edit_sinonimo_clear()
    }

});
