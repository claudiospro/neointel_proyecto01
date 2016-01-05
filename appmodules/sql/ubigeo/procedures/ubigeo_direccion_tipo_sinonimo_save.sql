DROP PROCEDURE IF EXISTS ubigeo_direccion_tipo_sinonimo_save;
SELECT 'CREATE PROCEDURE ubigeo_direccion_tipo_sinonimo_save' AS 'MENSAJE';
DELIMITER $$ 

CREATE PROCEDURE ubigeo_direccion_tipo_sinonimo_save(
    in_id BIGINT
  , in_sinonimo_id BIGINT
  , in_date VARCHAR(100)
  , in_user_id INT
)
BEGIN
    DECLARE ou_count BIGINT;
    
    SELECT COUNT(id) INTO ou_count
    FROM ubigeo_direccion_tipo
    WHERE sinonimo_id=in_id
    ;
    IF ou_count < 2 THEN
       UPDATE ubigeo_direccion_tipo SET
        sinonimo_id=in_sinonimo_id,
        info_update=in_date,
        info_update_user=in_user_id
       WHERE id=in_id
       ;
       INSERT INTO ubigeo_direccion_tipo_history
              (tipo_id, sinonimo_id, info_create, info_create_user)
       VALUES (in_id, in_sinonimo_id, in_date, in_user_id)
       ;    
    END IF;


END $$
DELIMITER ;

-- SET @id=2
--   , @nombre='change'
--   , @fecha='2015-12-13'
--   , @user_id=1
-- ;

-- CALL ubigeo_direccion_tipo_sinonimo_save(
--     @id
--   , @nombre
--   , @fecha
--   , @user_id
-- )
-- ;

-- SELECT * FROM ubigeo_direccion_tipo
-- ;

