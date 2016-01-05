SELECT fa.direccion_sinonimo_id,
       fa.direccion_tipo_sinonimo_id,
       fa.ubigeo_localidad_id,
       fa.direccion_numero,
       fb.telefono
FROM fuente_a fa
LEFT JOIN fuente_b fb ON fb.direccion_sinonimo_id=fa.direccion_sinonimo_id and fb.direccion_numero=fa.direccion_numero
;
