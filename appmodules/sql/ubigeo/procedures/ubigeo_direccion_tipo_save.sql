DROP PROCEDURE IF EXISTS ubigeo_direccion_tipo_save;
SELECT 'CREATE PROCEDURE ubigeo_direccion_tipo_save' AS 'MENSAJE';
DELIMITER $$ 

CREATE PROCEDURE ubigeo_direccion_tipo_save(
    in_id BIGINT
  , in_nombre VARCHAR(300)
  , in_date VARCHAR(100)
  , in_user_id INT
)
BEGIN
    DECLARE ou_id BIGINT;
    DECLARE pr_count_name INT ;

    SELECT COUNT(id) INTO pr_count_name FROM ubigeo_direccion_tipo
    WHERE LOWER(nombre)=LOWER(in_nombre) AND id!=in_id
    ;

    IF pr_count_name = 0 THEN
      IF in_id=0 THEN
         INSERT INTO ubigeo_direccion_tipo
         (nombre, info_create, info_create_user)
         VALUES(in_nombre, in_date, in_user_id)
         ; 
         SELECT last_insert_id() INTO ou_id
         ;
         UPDATE ubigeo_direccion_tipo SET
         sinonimo_id=ou_id       
         WHERE id=ou_id
         ;
      ELSE
         UPDATE ubigeo_direccion_tipo SET
         nombre=in_nombre,
         info_update=in_date,
         info_update_user=in_user_id
         WHERE id=in_id
         ;
         SET ou_id = in_id;
      END IF
      ;
      INSERT INTO ubigeo_direccion_tipo_history
      (tipo_id, nombre, info_create, info_create_user)
      VALUES(ou_id, in_nombre, in_date, in_user_id)
      ;
      SELECT '1'
      ;      
    ELSE
      SELECT '0'
      ;
    END IF
    ;
     
END $$
DELIMITER ;

-- SET @id=2
--   , @nombre='change'
--   , @fecha='2015-12-13'
--   , @user_id=1
-- ;

-- CALL ubigeo_direccion_tipo_save(
--     @id
--   , @nombre
--   , @fecha
--   , @user_id
-- )
-- ;

-- SELECT * FROM ubigeo_direccion_tipo
-- ;

