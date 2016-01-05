DROP TABLE IF EXISTS fuente_a;
CREATE TABLE fuente_a(
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT DEFAULT 1,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	--
	id BIGINT NOT NULL AUTO_INCREMENT,
        campania_id BIGINT,
        direccion_id BIGINT,
        direccion_sinonimo_id BIGINT,
        direccion_tipo_id BIGINT,
        direccion_tipo_sinonimo_id BIGINT,
        direccion_tipo_nombre TEXT,
        direccion_nombre TEXT,
        direccion_numero VARCHAR(50),
        ubigeo_localidad_id BIGINT,
        ubigeo_localidad_nombre TEXT,
        ubigeo_provincia_id BIGINT,
        ubigeo_provincia_nombre TEXT,
        --
	PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS fuente_b;
CREATE TABLE fuente_b(
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT DEFAULT 1,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	--
	id BIGINT NOT NULL AUTO_INCREMENT,
        campania_id BIGINT,
        direccion_id BIGINT,
        direccion_sinonimo_id BIGINT,
        direccion_tipo_id BIGINT,
        direccion_tipo_sinonimo_id BIGINT,
        direccion_tipo_nombre TEXT,
        direccion_nombre TEXT,
        direccion_numero VARCHAR(50),
        ubigeo_ciudad_id BIGINT,
        ubigeo_ciudad_nombre TEXT,
        ubigeo_provincia_id BIGINT,
        ubigeo_provincia_nombre TEXT,
        telefono VARCHAR(500),
        --
	PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS fuente_ab;
CREATE TABLE fuente_ab(
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT DEFAULT 1,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
        -- 
	id BIGINT NOT NULL AUTO_INCREMENT,
        a_id BIGINT NOT NULL DEFAULT 0,
        b_id BIGINT NOT NULL DEFAULT 0,
        --
	PRIMARY KEY (id) 
);
