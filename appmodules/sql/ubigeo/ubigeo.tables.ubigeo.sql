DROP TABLE IF EXISTS ubigeo_tipo;
CREATE TABLE ubigeo_tipo (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT DEFAULT 1,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	--
	id BIGINT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(300) NULL,
        --
	PRIMARY KEY (id) 
) ENGINE = MYISAM
;
DROP TABLE IF EXISTS ubigeo_tipo_history;
CREATE TABLE ubigeo_tipo_history (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT DEFAULT 1,
	info_status TINYINT(1) DEFAULT 1,
	--
	id BIGINT NOT NULL AUTO_INCREMENT,
	tipo_id BIGINT NOT NULL,
	nombre VARCHAR(300) NULL,
	--
	FOREIGN KEY (tipo_id) REFERENCES ubigeo_tipo(id),
	PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ubigeo;
CREATE TABLE ubigeo (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT DEFAULT 1,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	--
	id BIGINT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(300) NOT NULL,
        tipo_id BIGINT NOT NULL DEFAULT 0,
        parent_id BIGINT NOT NULL DEFAULT 0,
        nivel INT,
        --
        FOREIGN KEY (tipo_id) REFERENCES ubigeo_tipo(id),
	PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ubigeo_history;
CREATE TABLE ubigeo_history (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT DEFAULT 1,
	info_status TINYINT(1) DEFAULT 1,
	--
	id BIGINT NOT NULL AUTO_INCREMENT,
        ubigeo_id BIGINT NOT NULL DEFAULT 0,
	nombre VARCHAR(300) NULL,
        tipo_id BIGINT NOT NULL  DEFAULT 0,
        parent_id BIGINT NOT NULL DEFAULT 0,
        nivel INT,
        --
        FOREIGN KEY (ubigeo_id) REFERENCES ubigeo(id),
	PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ubigeo_sinonimo;
CREATE TABLE ubigeo_sinonimo (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT DEFAULT 1,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	--
	id BIGINT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(300) NOT NULL,
        ubigeo_id BIGINT NOT NULL DEFAULT 0,
        nivel INT,
        --
        FOREIGN KEY (ubigeo_id) REFERENCES ubigeo(id),
	PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS ubigeo_sinonimo_history;
CREATE TABLE ubigeo_sinonimo_history (
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT DEFAULT 1,
	info_status TINYINT(1) DEFAULT 1,
	--
	id BIGINT NOT NULL AUTO_INCREMENT,
        sinonimo_id BIGINT NOT NULL DEFAULT 0,
	nombre VARCHAR(300) NOT NULL,
        ubigeo_id BIGINT NOT NULL DEFAULT 0,
        nivel INT,
        --
        FOREIGN KEY (sinonimo_id) REFERENCES ubigeo_sinonimo(id),
	PRIMARY KEY (id) 
) ENGINE = MYISAM
;

