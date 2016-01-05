<?php 
class ModeloSave {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function test($in) {
        $this->q->fields = array();
        $this->q->sql = '
CALL fuente_ubigeo_indexar(
  "' . $in['compania_id'] . '"
, "' . $in['fecha'] . '"
, "' . $in['user_id'] . '"
)
        ';
        // print $this->q->sql;
        
        $this->q->data = NULL;
        $this->q->exe();
    }
}
