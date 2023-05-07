START TRANSACTION;
SET AUTOCOMMIT = OFF;

CREATE TABLE IF NOT EXISTS Anunciante(
    Codigo int NOT NULL AUTO_INCREMENT,
    Nome varchar(100),
    CPF varchar(14),
    Email varchar(100),
    SenhaHash varchar(255),
    Telefone varchar(20),
    PRIMARY KEY (Codigo)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Categoria(
    Codigo int NOT NULL AUTO_INCREMENT,
    Nome varchar(100),
    Descricao varchar(500),
    PRIMARY KEY (Codigo)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Anuncio(
    Codigo int NOT NULL AUTO_INCREMENT,
    Titulo varchar(100),
    Descricao varchar(500),
    Preco decimal(10,2),
    DataHora datetime DEFAULT CURRENT_TIMESTAMP(),
    CEP varchar(10),
    Bairro varchar(100),
    Cidade varchar(100),
    Estado varchar(2),
    CodCategoria int,
    CodAnunciante int,
    PRIMARY KEY (Codigo),
    FOREIGN KEY (CodCategoria) REFERENCES Categoria(Codigo),
    FOREIGN KEY (CodAnunciante) REFERENCES Anunciante(Codigo)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Interesse(
    Codigo int NOT NULL AUTO_INCREMENT,
    Mensagem varchar(500),
    DataHora datetime DEFAULT CURRENT_TIMESTAMP(),
    Contato varchar(20),
    CodAnuncio int,
    PRIMARY KEY (Codigo),
    FOREIGN KEY (CodAnuncio) REFERENCES Anuncio(Codigo)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS Foto(
    CodAnuncio int NOT NULL,
    NomeArqFoto varchar(100)
) ENGINE = InnoDB;

CREATE TABLE IF NOT EXISTS EnderecosAJAX(
    CEP varchar(10),
    Bairro varchar(100),
    Cidade varchar(100),
    Estado varchar(2)
) ENGINE = InnoDB;

COMMIT;