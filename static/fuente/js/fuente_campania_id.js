$(document).ready(function() {
    // --------------------------------------------------------------- load
    fuente_campania_id_campania_id();
    // ------------------------------------------------------------ eventos
    function fuente_campania_id_campania_id() {
        var enviar = {}
        element_simple('./process/ajax/select/fuente_campania_select.php',
                       '#campania_id_select',
                       enviar
                      );
    }

    // ---------------------------------------------------------- funciones

    
});
