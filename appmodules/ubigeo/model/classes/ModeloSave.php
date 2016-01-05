<?php 
class ModeloSave {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function getUbigeo($in) {
        $this->q->fields = array();
        $this->q->sql = '
        UPDATE ubigeo SET nombre="' . $in['nombre'] . '", info_update="' . $in['info_update'] . '" 
        WHERE id="' . $in['id'] . '"
        ';
        print $this->q->sql;
        
        $this->q->data = NULL;
        $this->q->exe();
    }
    function setSinonimo($in) {
        $this->q->fields = array('flag' => '');
        $this->q->sql = '
CALL ubigeo_tree_diccionario_save(
        "' . $in['id'] . '"
      , "' . $in['nombre'] . '"
      , "' . $in['ubigeo_id'] . '"
      , "' . $in['nivel'] . '"
      , "' . $in['date'] . '"
      , "' . $in['user_id'] . '"
    )
        ';
        // print $this->q->sql;
        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data[0]['flag'];
    }
    // 
    function setDireccion($in) {
        $this->q->fields = array('flag' => '');
        $this->q->sql = '
        CALL ubigeo_direccion_save(
          "' . $in['id'] . '"
        , "' . $in['nombre'] . '"
        , "' . $in['tipo_id'] . '"
        , "' . $in['ubigeo_id'] . '"
        , "' . $in['date'] . '"
        , "' . $in['user_id'] . '"
        )
        ';
        // print $this->q->sql;
        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data[0];
    }
    function setSinonimoDireccion($in) {
        $this->q->fields = array();
        $this->q->sql = '
        CALL ubigeo_direccion_sinonimo_save(
          "' . $in['id'] . '"
        , "' . $in['sinonimo_id'] . '"
        , "' . $in['date'] . '"
        , "' . $in['user_id'] . '"
        )
        ';
        print $this->q->sql;
        
        $this->q->data = NULL;
        $this->q->exe();
    }
    function getSinonimoDireccionParent($in) {
        $this->q->fields = array('id' => '');
        $this->q->sql = '
        CALL ubigeo_direccion_sinonimo_parent_set(
        "' . $in['sinonimo_id'] . '"
        )
        ';
        // print $this->q->sql;
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data[0]['id'];
    }
    // 
    function setDireccionTipo($in) {
        $this->q->fields = array('flag' => '');
        $this->q->sql = '
        CALL ubigeo_direccion_tipo_save(
          "' . $in['id'] . '"
        , "' . $in['nombre'] . '"
        , "' . $in['date'] . '"
        , "' . $in['user_id'] . '"
        )
        ';
        // print $this->q->sql;
        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data[0];
    }
    function setSinonimoDireccionTipo($in) {
        $this->q->fields = array();
        $this->q->sql = '
        CALL ubigeo_direccion_tipo_sinonimo_save(
          "' . $in['id'] . '"
        , "' . $in['sinonimo_id'] . '"
        , "' . $in['date'] . '"
        , "' . $in['user_id'] . '"
        )
        ';
        print $this->q->sql;
        
        $this->q->data = NULL;
        $this->q->exe();
    }
    function getSinonimoDireccionTipoParent($in) {
        $this->q->fields = array('id' => '');
        $this->q->sql = '
        CALL ubigeo_direccion_tipo_sinonimo_parent_set(
        "' . $in['sinonimo_id'] . '"
        )
        ';
        print $this->q->sql;
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data[0]['id'];
    }
}
