<?php 
class ModeloTable {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function listSinonimos($in) {
        $this->q->fields = array(
            "id" => ""
            , "nombre" => ""
        );
        $this->q->sql = '
        SELECT id, nombre FROM ubigeo_sinonimo WHERE ubigeo_id="' . $in['ubigeo_id'] . '"
        ';
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
}
