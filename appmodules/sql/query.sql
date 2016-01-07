-- SELECT u.nombre ubigeo_nombre,
--        dt.nombre direccion_tipo_nombre,
--        d.nombre direccion_nombre,
--        fa.direccion_numero,
--        fb.telefono
-- FROM fuente_a fa
-- LEFT JOIN fuente_b fb ON fb.direccion_sinonimo_id=fa.direccion_sinonimo_id
--       AND fb.direccion_numero=fa.direccion_numero
-- LEFT JOIN ubigeo_direccion_tipo dt ON dt.id=fa.direccion_tipo_sinonimo_id
-- LEFT JOIN ubigeo_direccion d ON d.id=fa.direccion_sinonimo_id
-- LEFT JOIN ubigeo u ON u.id=fa.ubigeo_localidad_id
-- WHERE fb.telefono IS NULL
-- ;

-- SELECT u.nombre ubigeo_nombre,
--        dt.nombre direccion_tipo_nombre,
--        d.nombre direccion_nombre,
--        fa.direccion_numero,
--        fb.telefono
-- FROM fuente_a fa
-- LEFT JOIN fuente_b fb ON fb.direccion_sinonimo_id=fa.direccion_sinonimo_id
--       AND fb.direccion_numero=fa.direccion_numero
-- LEFT JOIN ubigeo_direccion_tipo dt ON dt.id=fa.direccion_tipo_sinonimo_id
-- LEFT JOIN ubigeo_direccion d ON d.id=fa.direccion_sinonimo_id
-- LEFT JOIN ubigeo u ON u.id=fa.ubigeo_localidad_id
-- WHERE fb.telefono 
--          fb.telefono IS NULL
-- ;

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
  WHERE fa.campania_id="1"
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
  WHERE fb.campania_id="1"
  GROUP BY 1,2,3)
) unido
GROUP BY 1,2,3
;


SELECT
  fa.direccion_tipo_sinonimo_id, fa.direccion_nombre nombre, fa.ubigeo_localidad_id ubigeo_id,
  t.nombre direccion_tipo , u.nombre ubigeo_nombre , p.nombre parent_nombre, a.nombre abuelo_nombre
  FROM fuente_a fa
  LEFT JOIN ubigeo_direccion_tipo t ON t.id=fa.direccion_tipo_sinonimo_id
  LEFT JOIN ubigeo u ON u.id=fa.ubigeo_localidad_id
  LEFT JOIN ubigeo p ON p.id=u.parent_id
  LEFT JOIN ubigeo a ON a.id=p.parent_id
WHERE fa.direccion_nombre= 'ABADES'
;
