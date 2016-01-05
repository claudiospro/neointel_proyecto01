<?php 
class ModeloSelect {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function campaniaId($in) {
        $this->q->fields = array(
            "id" => ""
            , "nombre" => ""
        );
        $this->q->sql = '
        SELECT id,nombre FROM fuente_campania WHERE info_status=1 ORDER BY 2 
        ';
        $this->q->data = NULL;
        $data = $this->q->exe();
        $combo = new OptionComboSimple0();
        $combo->set_option(1);
        $combo->set_format(array('id', 'nombre'));
        $combo->imprimir($data);
    }
}
