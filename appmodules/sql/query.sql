SELECT u.nombre ubigeo_nombre,
       dt.nombre direccion_tipo_nombre,
       d.nombre direccion_nombre,
       fa.direccion_numero,
       fb.telefono
FROM fuente_a fa
LEFT JOIN fuente_b fb ON fb.direccion_sinonimo_id=fa.direccion_sinonimo_id
      AND fb.direccion_numero=fa.direccion_numero
LEFT JOIN ubigeo_direccion_tipo dt ON dt.id=fa.direccion_tipo_sinonimo_id
LEFT JOIN ubigeo_direccion d ON d.id=fa.direccion_sinonimo_id
LEFT JOIN ubigeo u ON u.id=fa.ubigeo_localidad_id
WHERE fb.telefono IS NULL
;

SELECT u.nombre ubigeo_nombre,
       dt.nombre direccion_tipo_nombre,
       d.nombre direccion_nombre,
       fa.direccion_numero,
       fb.telefono
FROM fuente_a fa
LEFT JOIN fuente_b fb ON fb.direccion_sinonimo_id=fa.direccion_sinonimo_id
      AND fb.direccion_numero=fa.direccion_numero
LEFT JOIN ubigeo_direccion_tipo dt ON dt.id=fa.direccion_tipo_sinonimo_id
LEFT JOIN ubigeo_direccion d ON d.id=fa.direccion_sinonimo_id
LEFT JOIN ubigeo u ON u.id=fa.ubigeo_localidad_id
WHERE fb.telefono 
         fb.telefono IS NULL
;
