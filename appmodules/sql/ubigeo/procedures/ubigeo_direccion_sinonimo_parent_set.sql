

DROP PROCEDURE IF EXISTS ubigeo_direccion_sinonimo_parent_set;
DELIMITER $$ 

CREATE PROCEDURE ubigeo_direccion_sinonimo_parent_set(
  in_id BIGINT
)
BEGIN
    DECLARE ou_parent_id BIGINT;    
    SET @@max_sp_recursion_depth = 254 ;

    SELECT sinonimo_id INTO ou_parent_id
    FROM ubigeo_direccion
    WHERE id= in_id
    ;
    IF ou_parent_id = in_id THEN
       SELECT ou_parent_id;
    ELSE
       CALL ubigeo_direccion_sinonimo_parent_set(ou_parent_id);
    END IF
    ;
END $$
DELIMITER ;


-- SET @id = '1'
-- ;

-- CALL ubigeo_direccion_sinonimo_parent_set(
--     @id
-- );
