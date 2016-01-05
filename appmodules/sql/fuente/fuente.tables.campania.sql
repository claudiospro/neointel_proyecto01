DROP TABLE IF EXISTS fuente_campania;
CREATE TABLE fuente_campania(
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT DEFAULT 1,
	info_update TIMESTAMP,
	info_update_user INT,
	info_status TINYINT(1) DEFAULT 1,
	--
	id BIGINT NOT NULL AUTO_INCREMENT,
	nombre VARCHAR(300) NOT NULL,
        --
	PRIMARY KEY (id) 
) ENGINE = MYISAM
;

DROP TABLE IF EXISTS fuente_campania_history;
CREATE TABLE fuente_campania_history(
	info_create TIMESTAMP DEFAULT CURRENT_TIMESTAMP,
	info_create_user INT DEFAULT 1,
	info_status TINYINT(1) DEFAULT 1,
	--
	id BIGINT NOT NULL AUTO_INCREMENT,
        campania_id BIGINT NOT NULL DEFAULT 0,
	nombre VARCHAR(300) NOT NULL,
        --
        FOREIGN KEY (campania_id) REFERENCES fuente_campania(id),
	PRIMARY KEY (id) 
) ENGINE = MYISAM
;
