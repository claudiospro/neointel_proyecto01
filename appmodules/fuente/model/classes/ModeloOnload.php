<?php 
class ModeloOnload {
    private $q;
    function __construct() {
        $this->q = new Query();        
    }
    function getUbigeos4Fuente($in) {
        $this->q->fields = array('nombre' => '', 'estado' => '');
        $this->q->sql = '
SELECT DISTINCT unido.nombre , 
       (SELECT COUNT(s.id) FROM ubigeo_sinonimo s WHERE LOWER(s.nombre) =LOWER(unido.nombre) AND s.nivel=4 ) estado
FROM(
SELECT DISTINCT ubigeo_localidad_nombre nombre FROM fuente_a
WHERE campania_id = "' . $in['campania_id'] . '"
UNION
SELECT DISTINCT ubigeo_ciudad_nombre nombre FROM fuente_b
WHERE campania_id = "' . $in['campania_id'] . '"
) unido
        ';
        // print $this->q->sql;
        
        $this->q->data = NULL;
        return $this->q->exe();
    }
    function getUbigeos4FuenteRedundantes($nombre) {
        $this->q->fields = array('a' => '', 'p' => '');
        $this->q->sql = '
SELECT a.nombre, p.nombre FROM ubigeo_sinonimo s 
LEFT JOIN ubigeo u ON u.id = s.ubigeo_id
LEFT JOIN ubigeo p ON p.id = u.parent_id
LEFT JOIN ubigeo a ON a.id = p.parent_id
WHERE LOWER(s.nombre) = LOWER("' . $nombre . '")
        ';
        // print $this->q->sql;
        
        $this->q->data = NULL;
        return $this->q->exe();
    }
    function getUbigeos4Ubigeo($nombre) {
        $this->q->fields = array('ubigeo' => '');
        $this->q->sql = '
SELECT u.nombre FROM ubigeo_sinonimo s 
LEFT JOIN ubigeo u ON u.id = s.ubigeo_id
WHERE LOWER(s.nombre) = LOWER("' . $nombre . '")
        ';
        // print $this->q->sql;
        
        $this->q->data = NULL;
        $data = $this->q->exe();
        return $data[0]['ubigeo'];
    }
    function getUbigeos4indexar($in) {
        $this->q->fields = array();
        $this->q->sql = '
CALL fuente_ubigeo_indexar(
  "' . $in['campania_id'] . '"
, "' . $in['fecha'] . '"
, "' . $in['user_id'] . '"
)
        ';
        // print $this->q->sql;
        
        $this->q->data = NULL;
        $this->q->exe();
    }
    //
    function getDireccionTipoFuente($in) {
        $this->q->fields = array('nombre' => '', 'estado' => '');
        $this->q->sql = '
SELECT DISTINCT unido.nombre , 
       (SELECT COUNT(dt.id) FROM ubigeo_direccion_tipo dt WHERE LOWER(dt.nombre) =LOWER(unido.nombre) ) estado
FROM(
SELECT DISTINCT direccion_tipo_nombre nombre FROM fuente_a
WHERE campania_id = "' . $in['campania_id'] . '"
UNION
SELECT DISTINCT direccion_tipo_nombre nombre FROM fuente_b
WHERE campania_id = "' . $in['campania_id'] . '"
) unido
        ';
        // print $this->q->sql;
        
        $this->q->data = NULL;
        return $this->q->exe();
    }
    function getDireccionTipoFuenteIndexar($in) {
        $this->q->fields = array();
        $this->q->sql = '
CALL fuente_direcciones_tipos_indexar(
  "' . $in['campania_id'] . '"
, "' . $in['fecha'] . '"
, "' . $in['user_id'] . '"
)
        ';
        // print $this->q->sql;
        
        $this->q->data = NULL;
        $this->q->exe();
    }
    // 
    function getDireccionFuente($in) {
        $this->q->fields = array(
            'direccion_tipo_sinonimo_id' => '', 
            'nombre' => '',
            'ubigeo_id' => '', 
            'direccion_tipo' => '',            
            'ubigeo_nombre' => '', 
            'parent_nombre' => '',
            'abuelo_nombre' => '',
            'estado' => ''
            
        );
        $this->q->sql = '
SELECT unido.*,
       (SELECT COUNT(d.id) FROM ubigeo_direccion d
        LEFT JOIN ubigeo_direccion_tipo t ON t.id = d.tipo_id
        WHERE LOWER(d.nombre) = LOWER(unido.nombre)
          AND t.sinonimo_id = unido.direccion_tipo_sinonimo_id
          AND d.ubigeo_id = unido.ubigeo_id          
       ) estado
FROM (
  (SELECT
  fa.direccion_tipo_sinonimo_id, fa.direccion_nombre nombre, fa.ubigeo_localidad_id ubigeo_id,
  t.nombre direccion_tipo, u.nombre ubigeo_nombre, p.nombre parent_nombre, a.nombre abuelo_nombre
  FROM fuente_a fa
  LEFT JOIN ubigeo_direccion_tipo t ON t.id=fa.direccion_tipo_sinonimo_id
  LEFT JOIN ubigeo u ON u.id=fa.ubigeo_localidad_id
  LEFT JOIN ubigeo p ON p.id=u.parent_id
  LEFT JOIN ubigeo a ON a.id=p.parent_id
  WHERE fa.campania_id="' . $in['campania_id'] . '"
  GROUP BY 1,2,3)  
  UNION
  (SELECT
  fb.direccion_tipo_sinonimo_id, fb.direccion_nombre nombre, fb.ubigeo_ciudad_id ubigeo_id,
  t.nombre direccion_tipo, u.nombre ubigeo_nombre, p.nombre parent_nombres, a.nombre abuelo_nombre
  FROM fuente_b fb
  LEFT JOIN ubigeo_direccion_tipo t ON t.id=fb.direccion_tipo_sinonimo_id
  LEFT JOIN ubigeo u ON u.id=fb.ubigeo_ciudad_id
  LEFT JOIN ubigeo p ON p.id=u.parent_id
  LEFT JOIN ubigeo a ON a.id=p.parent_id
  WHERE fb.campania_id="' . $in['campania_id'] . '"
  GROUP BY 1,2,3)
) unido
GROUP BY 1,2,3
        ';
        // echo '<pre>';
        // print $this->q->sql;
        // echo '</pre>';
        $this->q->data = NULL;
        return $this->q->exe();
    }
    function getDireccionFuenteIndexar($in) {
        $this->q->fields = array();
        $this->q->sql = '
CALL fuente_direcciones_indexar(
  "' . $in['campania_id'] . '"
, "' . $in['fecha'] . '"
, "' . $in['user_id'] . '"
)
        ';
        // print $this->q->sql;
        
        $this->q->data = NULL;
        $this->q->exe();
    }

    function getDataUnida($in) {
        $this->q->fields = array(
            'ubigeo_nombre' => '', 
            'direccion_tipo_nombre' => '', 
            'direccion_nombre' => '', 
            'direccion_numero' => '', 
            'telefono' => ''
        );
        $this->q->sql = '
SELECT u.nombre ubigeo_nombre,
       dt.nombre direccion_tipo_nombre,
       d.nombre direccion_nombre,
       fa.direccion_numero,
       fb.telefono
FROM fuente_a fa
LEFT JOIN fuente_b fb ON fb.direccion_sinonimo_id=fa.direccion_sinonimo_id
      AND fb.direccion_numero=fa.direccion_numero
      -- AND fb.campania_id="' . $in['campania_id'] . '"
LEFT JOIN ubigeo_direccion_tipo dt ON dt.id=fa.direccion_tipo_sinonimo_id
LEFT JOIN ubigeo_direccion d ON d.id=fa.direccion_sinonimo_id
LEFT JOIN ubigeo u ON u.id=fa.ubigeo_localidad_id
WHERE fa.campania_id="' . $in['campania_id'] . '"
        ';
        if ($in['tipo'] == 'a_y_b') {
            $this->q->sql .= ' AND fb.telefono IS NOT NULL';
        } elseif ($in['tipo'] == 'a_menos_b') {
            $this->q->sql .= ' AND fb.telefono IS NULL';
        }
        /* echo '<pre>'; */
        /* print $this->q->sql; */
        /* echo '</pre><hr>'; */
        $this->q->data = NULL;
        return $this->q->exe();
    }
}
