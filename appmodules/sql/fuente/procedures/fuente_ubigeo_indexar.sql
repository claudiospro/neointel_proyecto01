DROP PROCEDURE IF EXISTS fuente_ubigeo_indexar;
SELECT 'CREATE PROCEDURE fuente_ubigeo_indexar' AS 'MENSAJE';
DELIMITER $$ 

CREATE PROCEDURE fuente_ubigeo_indexar(
    in_compania_id BIGINT
  , in_date VARCHAR(100)
  , in_user_id INT
)
BEGIN
  DECLARE done INT DEFAULT FALSE;
  DECLARE pr_nombre TEXT;
  DECLARE pr_fuente VARCHAR(10);
  DECLARE pr_ubigeo_id BIGINT;
  DECLARE cur1 CURSOR FOR SELECT DISTINCT unido.nombre, unido.ubigeo_id
  FROM(
    SELECT DISTINCT fuente_a.ubigeo_localidad_nombre nombre, ubigeo_sinonimo.ubigeo_id
    FROM fuente_a
    JOIN ubigeo_sinonimo ON LOWER(ubigeo_sinonimo.nombre) = LOWER(fuente_a.ubigeo_localidad_nombre)
                       AND ubigeo_sinonimo.nivel=4
    WHERE campania_id = in_compania_id
    UNION
    SELECT DISTINCT fuente_b.ubigeo_ciudad_nombre nombre, ubigeo_sinonimo.ubigeo_id
    FROM fuente_b
    JOIN ubigeo_sinonimo ON LOWER(ubigeo_sinonimo.nombre) = LOWER(fuente_b.ubigeo_ciudad_nombre)
                       AND ubigeo_sinonimo.nivel=4
    WHERE campania_id = in_compania_id
  ) unido
  ;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

  OPEN cur1
  ;  
  read_loop: LOOP
  FETCH cur1 INTO pr_nombre, pr_ubigeo_id;
    IF done THEN
      LEAVE read_loop;
    END IF
    ;
    UPDATE fuente_a
    SET ubigeo_localidad_id = pr_ubigeo_id,
        info_update_user = in_user_id,
        info_update = in_date
    WHERE LOWER(pr_nombre) = LOWER(ubigeo_localidad_nombre)
      AND campania_id = in_compania_id
   ;
    UPDATE fuente_b
    SET ubigeo_ciudad_id = pr_ubigeo_id,
        info_update_user = in_user_id,
        info_update = in_date
    WHERE LOWER(pr_nombre) = LOWER(ubigeo_ciudad_nombre)
      AND campania_id = in_compania_id
    ;
  END LOOP
  ;
  CLOSE cur1
  ;
END $$
DELIMITER ;

-- SET
--   @compania_id=1
-- , @fecha='2015-12-16'
-- , @user_id=2
-- ;

-- CALL fuente_ubigeo_indexar(
--   @compania_id
-- , @fecha
-- , @user_id
-- )
-- ;


