DROP PROCEDURE IF EXISTS fuente_direcciones_indexar;
SELECT 'CREATE PROCEDURE fuente_direcciones_indexar' AS 'MENSAJE';
DELIMITER $$ 

CREATE PROCEDURE fuente_direcciones_indexar(
    in_compania_id BIGINT
  , in_date VARCHAR(100)
  , in_user_id INT
)
BEGIN
  DECLARE done INT DEFAULT FALSE;
  DECLARE pr_nombre TEXT;
  DECLARE pr_id BIGINT;
  DECLARE pr_sinonimo_id BIGINT;
  
  DECLARE cur1 CURSOR FOR SELECT unido.*
  FROM (
  (SELECT fa.direccion_nombre nombre, d.id, d.sinonimo_id
  FROM fuente_a fa
  LEFT JOIN ubigeo_direccion d ON LOWER(d.nombre)=LOWER(fa.direccion_nombre)
  WHERE fa.campania_id=1 AND fa.direccion_id=0)  
  UNION
  (SELECT fb.direccion_nombre nombre, d.id, d.sinonimo_id
  FROM fuente_b fb
  LEFT JOIN ubigeo_direccion d ON LOWER(d.nombre)=LOWER(fb.direccion_nombre)
  WHERE fb.campania_id=1 AND fb.direccion_id=0)
  ) unido
  ;
  DECLARE CONTINUE HANDLER FOR NOT FOUND SET done = TRUE;

  OPEN cur1
  ;
  read_loop: LOOP
  FETCH cur1 INTO pr_nombre, pr_id, pr_sinonimo_id;
    IF done THEN
      LEAVE read_loop;
    END IF
    ;
    UPDATE fuente_a
    SET direccion_id = pr_id,
        direccion_sinonimo_id = pr_sinonimo_id,
        info_update_user = in_user_id,
        info_update = in_date
    WHERE LOWER(pr_nombre) = LOWER(direccion_nombre)
      AND campania_id = in_compania_id
    ;
    UPDATE fuente_b
    SET direccion_id = pr_id,
        direccion_sinonimo_id = pr_sinonimo_id,
        info_update_user = in_user_id,
        info_update = in_date
    WHERE LOWER(pr_nombre) = LOWER(direccion_nombre)
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

-- CALL fuente_direcciones_indexar(
--   @compania_id
-- , @fecha
-- , @user_id
-- )
-- ;


