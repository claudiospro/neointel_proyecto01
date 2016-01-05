DROP PROCEDURE IF EXISTS ubigeo_tree_diccionario_save;
SELECT 'CREATE PROCEDURE ubigeo_tree_diccionario_save' AS 'MENSAJE';
DELIMITER $$ 

CREATE PROCEDURE ubigeo_tree_diccionario_save(
        in_id BIGINT
      , in_nombre VARCHAR(300)
      , in_ubigeo_id BIGINT
      , in_nivel INT
      , in_date VARCHAR(100)
      , in_user_id INT
    )
BEGIN
    DECLARE ou_id BIGINT;
    DECLARE pr_count_name INT;

    SELECT COUNT(id) INTO pr_count_name FROM ubigeo_sinonimo
    WHERE LOWER(nombre)=LOWER(in_nombre) AND id!=in_id
    ;
    IF pr_count_name = 0 THEN
       IF in_id=0 THEN
          INSERT INTO ubigeo_sinonimo
          (nombre, ubigeo_id, nivel, info_create, info_create_user)
          VALUES(in_nombre, in_ubigeo_id, in_nivel, in_date, in_user_id)
          ; 
          SELECT last_insert_id() INTO ou_id;
       ELSE
          UPDATE ubigeo_sinonimo SET
          nombre=in_nombre,
          ubigeo_id=in_ubigeo_id,
          nivel=in_nivel,
          info_update=in_date,
          info_update_user=in_user_id
          WHERE id=in_id
          ;
          SET ou_id = in_id;
       END IF
       ;
       INSERT INTO ubigeo_sinonimo_history
       (sinonimo_id, nombre, ubigeo_id, nivel, info_create, info_create_user)
       VALUES(ou_id, in_nombre, in_ubigeo_id, in_nivel, in_date, in_user_id)
       ;
       SELECT '1';
    ELSE
        SELECT '0';
    END IF
    ;
END $$
DELIMITER ;
