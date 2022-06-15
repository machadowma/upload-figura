CREATE DATABASE cadastro_de_figuras;

USE cadastro_de_figuras;

CREATE TABLE figura (
	id INTEGER AUTO_INCREMENT PRIMARY KEY
    ,nome_arquivo VARCHAR(1000)
    ,criado_em TIMESTAMP DEFAULT CURRENT_TIMESTAMP
);


