CREATE DATABASE pozopetrolero;
USE pozopetrolero;

DROP TABLE IF EXISTS pozos;

CREATE TABLE pozos (
id_pozo INT(5) NOT NULL AUTO_INCREMENT,
nombre VARCHAR(20),
profundidad DECIMAL(10,3),
PRIMARY KEY(id_pozo)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8; 

DROP TABLE IF EXISTS mediciones;

CREATE TABLE mediciones (
id_medicion INT(5) NOT NULL AUTO_INCREMENT,
pozo INT(10) NOT NULL,
medicion DOUBLE(10,3),
fecha DATE,
PRIMARY KEY(id_medicion)
) ENGINE=InnoDB AUTO_INCREMENT=1 DEFAULT CHARSET=utf8;