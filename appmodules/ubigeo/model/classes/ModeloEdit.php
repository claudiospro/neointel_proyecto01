<?php 
class ModeloEdit {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function setUbigeo($in) {
        $this->q->fields = array(
            "id" => ""
            , "nombre" => ""
            , "tipo_id" => ""
            , "parent_id" => ""
            , "nivel" => ""
        );
        $this->q->sql = '
        SELECT id, nombre, tipo_id, parent_id, nivel FROM ubigeo WHERE id="' . $in['id'] . '"
        ';
        $this->q->data = NULL;
        $data = $this->q->exe();
        $ou = array(
            'id'          => $data[0]['id']
            , 'nivel'     => $data[0]['nivel']
            , 'nombre'    => utf8_encode($data[0]['nombre'])
            , 'tipo_id'   => $data[0]['tipo_id']
            , 'parent_id' => $data[0]['parent_id']
            
        );
        return $ou;
    }
    function getDireccion($in) {
        $this->q->fields = array(
            'tipo_id' => '',
            'tipo_nombre' => '',
            'direccion_id' => '',
            'direccion_nombre' => '',
            'ubigeo_id' => '',
            'ubigeo_nombre' => ''
        );
        $this->q->sql = '
SELECT
  d.tipo_id
, t.nombre tipo_nombre
, d.id direccion_id
, d.nombre direccion_nombre
, d.ubigeo_id
, u.nombre ubigeo_nombre
FROM ubigeo_direccion d
LEFT JOIN ubigeo_direccion_tipo t ON t.id=d.tipo_id
LEFT JOIN ubigeo u ON u.id=d.ubigeo_id
WHERE d.id="' . $in['id'] . '"
        ';
        // print $this->q->sql;
        $this->q->data = NULL;
        $data = $this->q->exe();
        $ou = array(
            'tipo_id'          => $data[0]['tipo_id'],
            'tipo_nombre'      => utf8_encode($data[0]['tipo_nombre']),
            'direccion_id'     => $data[0]['direccion_id'],
            'direccion_nombre' => utf8_encode($data[0]['direccion_nombre']),
            'ubigeo_id'        => $data[0]['ubigeo_id'],
            'ubigeo_nombre'    => utf8_encode($data[0]['ubigeo_nombre']),
            'save' => 'Editar'
        );
        return $ou;
    }
    function getDireccionTipo($in) {
        $this->q->fields = array(
            "id" => "",
            "nombre" => "",
        );
        $this->q->sql = '
        SELECT id, nombre FROM ubigeo_direccion_tipo WHERE id="' . $in['id'] . '"
        ';
        // print $this->q->sql;
        $this->q->data = NULL;
        $data = $this->q->exe();
        $ou = array(
            'id'     => $data[0]['id'],
            'nombre' => utf8_encode($data[0]['nombre']),
            'save'   => 'Editar'
        );
        return $ou;
    }
}
