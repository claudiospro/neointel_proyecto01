<?php 
class ModeloSelect {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function listTipoId($in) {
        $this->q->fields = array(
            "id" => ""
            , "nombre" => ""
        );
        $this->q->sql = '
        SELECT id, nombre FROM ubigeo_tipo WHERE info_status=1 
        ';
        $this->q->data = NULL;
        $data = $this->q->exe();
        $combo = new OptionComboSimple();
        // $combo->set_option(0);
        $combo->set_format(array('id', 'nombre'));
        $combo->imprimir($data);
    }
}
