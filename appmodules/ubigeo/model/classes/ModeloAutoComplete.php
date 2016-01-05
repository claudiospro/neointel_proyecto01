<?php 
class ModeloAutoComplete {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function direccionTipoSinonimos($in) {
        $this->q->fields = array(
            'nombre' => '',
            'id' => ''
        );
        $this->q->sql = '
SELECT
  t1.nombre
, t1.id
FROM ubigeo_direccion_tipo t1
WHERE LOWER(t1.nombre) like "%' . strtolower($in['nombre']) . '%"
        ';
        // print $this->q->sql;        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
    function ubigeos_4($in) {
        $this->q->fields = array(
            'nombre' => '',
            'id' => ''
        );
        $this->q->sql = '
SELECT nombre, ubigeo_id FROM ubigeo_sinonimo 
WHERE nivel=4 AND LOWER(nombre) LIKE "%' . strtolower($in['nombre']) . '%"
        ';
        // print $this->q->sql;        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
}
