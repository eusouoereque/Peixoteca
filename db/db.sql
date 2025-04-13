CREATE DATABASE peixoteca;

USE peixoteca;

CREATE TABLE `usuarios` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `login` varchar(255) NOT NULL,
  `senha` varchar(255) NOT NULL
);

CREATE TABLE `categorias` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL
);

CREATE TABLE `habitats` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL
);

CREATE TABLE `animais` (
  `id` integer PRIMARY KEY AUTO_INCREMENT,
  `nome_popular` varchar(255) NOT NULL,
  `nome_cientifico` varchar(255) NOT NULL,
  `id_categoria` integer NOT NULL,
  `id_criador` integer NOT NULL,
  `id_habitat` integer NOT NULL,
  `localizacao` text NOT NULL,
  `quantidade` integer NOT NULL
);

ALTER TABLE `animais` ADD FOREIGN KEY (`id_categoria`) REFERENCES `categorias` (`id`);

ALTER TABLE `animais` ADD FOREIGN KEY (`id_criador`) REFERENCES `usuarios` (`id`);

ALTER TABLE `animais` ADD FOREIGN KEY (`id_habitat`) REFERENCES `habitats` (`id`);

INSERT INTO categorias (descricao) VALUES
('Peixes'),
('Crustáceos'),
('Equinodermos'),
('Mamíferos'),
('Répteis'),
('Vermes marinhos'),
('Moluscos'),
('Esponjas'),
('Rotíferos');