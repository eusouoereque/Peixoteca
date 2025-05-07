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

-- Inserir usuários (criadores)
INSERT INTO usuarios (nome, login, senha) VALUES
('Admin', 'admin', '$2y$10$qTCE2onRzn4IE48IbMP04OYmYq.7lVxn6wRt2zov7Pfcx8rD4Gu/y');

-- Inserir habitats
INSERT INTO habitats (descricao) VALUES
('Recifes de Coral'),
('Mar Aberto'),
('Manguezal'),
('Fundo Rochoso'),
('Região Abissal');

-- Inserir animais
INSERT INTO animais (
  nome_popular,
  nome_cientifico,
  id_categoria,
  id_criador,
  id_habitat,
  localizacao,
  quantidade
) VALUES
('Peixe-Palhaço', 'Amphiprion ocellaris', 1, 1, 1, 'Recifes de coral do Indo-Pacífico', 10),
('Polvo-Comum', 'Octopus vulgaris', 7, 1, 2, 'Costas rochosas e fundo arenoso', 5),
('Estrela-do-mar', 'Asterias rubens', 3, 1, 4, 'Costas rochosas do Atlântico Norte', 15),
('Golfinho-Rotador', 'Stenella longirostris', 4, 1, 2, 'Águas tropicais do oceano', 2),
('Tartaruga-Verde', 'Chelonia mydas', 5, 1, 2, 'Áreas costeiras tropicais', 3),
('Esponja-do-Mar', 'Spongia officinalis', 8, 1, 1, 'Recifes e cavernas submarinas', 20),
('Camarão-Rosa', 'Farfantepenaeus paulensis', 2, 1, 3, 'Manguezais e estuários brasileiros', 30),
('Lula-Gigante', 'Architeuthis dux', 7, 1, 5, 'Profundezas do oceano Atlântico', 1),
('Rotífero-Marinho', 'Brachionus plicatilis', 9, 1, 3, 'Águas salobras e marinhas costeiras', 1000),
('Nereis', 'Nereis diversicolor', 6, 1, 3, 'Sedimentos de manguezais e estuários', 40);