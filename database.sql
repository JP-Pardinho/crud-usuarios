CREATE DATABASE crud_usuarios;
USE crud_usuarios;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100),
    email VARCHAR(100),
    senha VARCHAR(100)
);
    
-- criar a senha criptografada, usa a função password rach