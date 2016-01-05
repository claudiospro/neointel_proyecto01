DROP TABLE IF EXISTS ubigeo_direccion_tipo;
CREATE TABLE ubigeo_direccion_tipo(
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT DEFAULT 1,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	--
	id BIGINT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(300) NOT NULL,
        sinonimo_id BIGINT NOT NULL DEFAULT 0,
        --
	PRIMARY KEY (id)
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ubigeo_direccion_tipo_history;
CREATE TABLE ubigeo_direccion_tipo_history(
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT DEFAULT 1,
	info_status TINYINT(1) DEFAULT 1,
	--
	id BIGINT NOT NULL AUTO_INCREMENT,
        tipo_id BIGINT NOT NULL DEFAULT 0,
	nombre VARCHAR(300) NOT NULL,
        sinonimo_id BIGINT NOT NULL DEFAULT 0,
        --
        FOREIGN KEY (tipo_id) REFERENCES ubigeo_direccion_tipo(id),
	PRIMARY KEY (id)
) ENGINE = MYISAM
;


DROP TABLE IF EXISTS ubigeo_direccion;
CREATE TABLE ubigeo_direccion(
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT DEFAULT 1,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	--
	id BIGINT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(300) NOT NULL,
        tipo_id BIGINT NOT NULL DEFAULT 0,
        ubigeo_id BIGINT NOT NULL DEFAULT 0,
        sinonimo_id BIGINT NOT NULL DEFAULT 0,
        --
        FOREIGN KEY (tipo_id) REFERENCES ubigeo_direccion_tipo(id),
        FOREIGN KEY (ubigeo_id) REFERENCES ubigeo(id),
	PRIMARY KEY (id)
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ubigeo_direccion_history;
CREATE TABLE ubigeo_direccion_history(
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT DEFAULT 1,
	info_status TINYINT(1) DEFAULT 1,
	--
	id BIGINT NOT NULL AUTO_INCREMENT,
        direccion_id BIGINT NOT NULL DEFAULT 0,
	nombre VARCHAR(300) NOT NULL,
        tipo_id BIGINT NOT NULL DEFAULT 0,
        ubigeo_id BIGINT NOT NULL DEFAULT 0,
        sinonimo_id BIGINT NOT NULL DEFAULT 0,
        --
        FOREIGN KEY (direccion_id) REFERENCES ubigeo_direccion(id),
	PRIMARY KEY (id)
) ENGINE = MYISAM
;
