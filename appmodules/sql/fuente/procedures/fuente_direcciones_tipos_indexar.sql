DROP PROCEDURE IF EXISTS fuente_direcciones_tipos_indexar;
SELECT 'CREATE PROCEDURE fuente_direcciones_tipos_indexar' AS 'MENSAJE';
DELIMITER $$ 

CREATE PROCEDURE fuente_direcciones_tipos_indexar(
    in_compania_id BIGINT
  , in_date VARCHAR(100)
  , in_user_id INT
)
BEGIN
  DECLARE done INT DEFAULT FALSE;
  DECLARE pr_nombre TEXT;
  DECLARE pr_tipo_id BIGINT;
  DECLARE pr_sinonimo_id BIGINT;
  
  DECLARE cur1 CURSOR FOR SELECT DISTINCT unido.nombre, unido.tipo_id, unido.sinonimo_id
  FROM(
    SELECT DISTINCT a.direccion_tipo_nombre nombre, t.id tipo_id, sinonimo_id  FROM fuente_a a
    LEFT JOIN ubigeo_direccion_tipo t ON LOWER(t.nombre)=LOWER(a.direccion_tipo_nombre)
    WHERE a.campania_id = in_compania_id
    UNION
    SELECT DISTINCT b.direccion_tipo_nombre nombre, t.id tipo_id, sinonimo_id FROM fuente_b b
    LEFT JOIN ubigeo_direccion_tipo t ON LOWER(t.nombre)=LOWER(b.direccion_tipo_nombre)
    WHERE b.campania_id = in_compania_id
  ) unido
  ;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

  OPEN cur1
  ;  
  read_loop: LOOP
  FETCH cur1 INTO pr_nombre, pr_tipo_id, pr_sinonimo_id;
    IF done THEN
      LEAVE read_loop;
    END IF
    ;
    UPDATE fuente_a
    SET direccion_tipo_id = pr_tipo_id,
        direccion_tipo_sinonimo_id = pr_sinonimo_id,
        info_update_user = in_user_id,
        info_update = in_date
    WHERE LOWER(pr_nombre) = LOWER(direccion_tipo_nombre)
      AND campania_id = in_compania_id
   ;
    UPDATE fuente_b
    SET direccion_tipo_id = pr_tipo_id,
        direccion_tipo_sinonimo_id = pr_sinonimo_id,
        info_update_user = in_user_id,
        info_update = in_date
    WHERE LOWER(pr_nombre) = LOWER(direccion_tipo_nombre)
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

-- CALL fuente_direcciones_tipos_indexar(
--   @compania_id
-- , @fecha
-- , @user_id
-- )
-- ;


