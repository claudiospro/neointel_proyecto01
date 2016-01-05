DROP PROCEDURE IF EXISTS ubigeo_direccion_save;
SELECT 'CREATE PROCEDURE ubigeo_direccion_save' AS 'MENSAJE';
DELIMITER $$ 

CREATE PROCEDURE ubigeo_direccion_save(
    in_id BIGINT
  , in_nombre VARCHAR(300)
  , in_tipo_id BIGINT
  , in_ubigeo_id BIGINT
  , in_date VARCHAR(100)
  , in_user_id INT
)
BEGIN
    DECLARE ou_id BIGINT;
    DECLARE pr_count_name INT;

    SELECT COUNT(id) INTO pr_count_name FROM ubigeo_direccion
    WHERE LOWER(nombre)=LOWER(in_nombre) AND id!=in_id
    ;

    IF pr_count_name = 0 THEN
      IF in_id=0 THEN
         INSERT INTO ubigeo_direccion
         (nombre, tipo_id, ubigeo_id, info_create, info_create_user)
         VALUES(in_nombre, in_tipo_id, in_ubigeo_id, in_date, in_user_id)
         ; 
         SELECT last_insert_id() INTO ou_id
         ;
         UPDATE ubigeo_direccion SET
         sinonimo_id=ou_id       
         WHERE id=ou_id
         ;
      ELSE
         UPDATE ubigeo_direccion SET
         nombre=in_nombre,
         tipo_id=in_tipo_id,
         ubigeo_id=in_ubigeo_id,
         info_update=in_date,
         info_update_user=in_user_id
         WHERE id=in_id
         ;
         SET ou_id = in_id;
      END IF
      ;
      INSERT INTO ubigeo_direccion_history
      (direccion_id, nombre, tipo_id, ubigeo_id, info_create, info_create_user)
      VALUES(ou_id, in_nombre, in_tipo_id, in_ubigeo_id, in_date, in_user_id)
      ;
      SELECT '1';      
    ELSE
      SELECT '0';
    END IF
    ;
     
END $$
DELIMITER ;

-- SET @id=2
--   , @nombre='change'
--   , @tipo_id=4
--   , @ubigeo_id=5
--   , @fecha='2015-12-16'
--   , @user_id=2
-- ;

-- CALL ubigeo_direccion_save(
--     @id
--   , @nombre
--   , @tipo_id
--   , @ubigeo_id
--   , @fecha
--   , @user_id
-- )
-- ;

-- SELECT * FROM ubigeo_direccion
-- ;

