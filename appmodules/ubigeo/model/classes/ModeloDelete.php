<?php 
class ModeloDelete {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function setSinonimo($in) {
        $this->q->fields = array(
        );
        $this->q->sql = '
        DELETE FROM ubigeo_sinonimo WHERE id="' . $in['id'] . '"
        ';
        print $this->q->sql;
        $this->q->data = NULL;
        $this->q->exe();

    }
}
