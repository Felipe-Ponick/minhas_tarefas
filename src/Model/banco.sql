CREATE TABLE usuario (
    id_usuario int primary key auto_increment,
    nome varchar(100) not null,
    email varchar(100) not null unique,
    login varchar(50) not null unique,
    senha varchar(256) not null);
