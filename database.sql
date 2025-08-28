CREATE DATABASE crud_usuarios;
USE crud_usuarios;

CREATE TABLE IF NOT EXISTS usuarios (
    id INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(100) NOT NULL, 
    email VARCHAR(100),
    dataNascimento DATE,
    senha VARCHAR(100)
);
    
-- criar a senha criptografada, usa a função password rach