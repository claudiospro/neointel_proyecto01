<?php 
class ModeloTree {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function ubigeoTreeOnload() {
        $this->q->fields = array(
            "id" => ""
            , "nombre" => ""
            , "parentId" => ""
        );
        $this->q->sql = '
SELECT ubi.id, 
       CONCAT(ubi.nombre, "--||@!", tip.nombre) descripcion, 
       ubi.parent_id  
FROM ubigeo ubi
LEFT JOIN ubigeo_tipo tip ON tip.id=ubi.tipo_id
              ';
        $this->q->data = NULL;
        $data = $this->q->exe();
        // $data= buildTree($data);
        return $data;
    }
    function ubigeoParentOnload($in) {
        $this->q->fields = array(
            "id" => ""
            , "nombre" => ""
            , "tipo_nombre" => ""
        );
        $this->q->sql = '
SELECT u.id, u.nombre, t.nombre tipo_nombre FROM 
ubigeo u join ubigeo_tipo t ON t.id=u.tipo_id
WHERE u.parent_id="' . $in['parent_id'] . '"
ORDER BY 2
              ';
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data;
    }
}
