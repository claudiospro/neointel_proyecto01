  SELECT DISTINCT unido.nombre, unido.ubigeo_id
  FROM(
    SELECT DISTINCT fuente_a.ubigeo_localidad_nombre nombre, ubigeo_sinonimo.ubigeo_id
    FROM fuente_a
    JOIN ubigeo_sinonimo ON LOWER(ubigeo_sinonimo.nombre) = LOWER(fuente_a.ubigeo_localidad_nombre)
                       AND ubigeo_sinonimo.nivel=4
    WHERE campania_id = 1
    UNION
    SELECT DISTINCT fuente_b.ubigeo_ciudad_nombre nombre, ubigeo_sinonimo.ubigeo_id
    FROM fuente_b
    JOIN ubigeo_sinonimo ON LOWER(ubigeo_sinonimo.nombre) = LOWER(fuente_b.ubigeo_ciudad_nombre)
                       AND ubigeo_sinonimo.nivel=4
    WHERE campania_id = 1
  ) unido
  ;
