-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 03/11/2024 às 23:39
-- Versão do servidor: 8.2.0
-- Versão do PHP: 8.2.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `tcc_receitas`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `categoria_culinaria`
--

DROP TABLE IF EXISTS `categoria_culinaria`;
CREATE TABLE IF NOT EXISTS `categoria_culinaria` (
  `id_categoria_culinaria` int NOT NULL AUTO_INCREMENT,
  `nome_categoria_culinaria` varchar(100) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  PRIMARY KEY (`id_categoria_culinaria`),
  UNIQUE KEY `nome_categoria_culinaria` (`nome_categoria_culinaria`) USING BTREE
) ENGINE=InnoDB AUTO_INCREMENT=45 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

DROP TABLE IF EXISTS `categoria_ingrediente`;
CREATE TABLE IF NOT EXISTS `categoria_ingrediente` (
  `id_categoria_ingrediente` int NOT NULL AUTO_INCREMENT,
  `nome_categoria_ingrediente` varchar(400) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id_categoria_ingrediente`),
  UNIQUE KEY `unique_nome_categoria_ingrediente` (`nome_categoria_ingrediente`)
) ENGINE=InnoDB AUTO_INCREMENT=30 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--


-- --------------------------------------------------------

--
-- Estrutura para tabela `ingrediente`
--

DROP TABLE IF EXISTS `ingrediente`;
CREATE TABLE IF NOT EXISTS `ingrediente` (
  `id_ingrediente` int NOT NULL AUTO_INCREMENT,
  `nome_ingrediente` varchar(220) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `nome_plural_ingrediente` varchar(220) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `imagem_ingrediente` varchar(220) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '../../css/img/ingrediente/no_image.png',
  `fk_id_categoria_ingrediente` int DEFAULT NULL,
  PRIMARY KEY (`id_ingrediente`),
  UNIQUE KEY `nome_ingrediente` (`nome_ingrediente`,`nome_plural_ingrediente`),
  KEY `fk_categoria_ingrediente` (`fk_id_categoria_ingrediente`)
) ENGINE=InnoDB AUTO_INCREMENT=413 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;


DROP TABLE IF EXISTS `ingrediente_quantidade`;
CREATE TABLE IF NOT EXISTS `ingrediente_quantidade` (
  `id_ingrediente_quantidade` int NOT NULL AUTO_INCREMENT,
  `nome_singular_ingrediente_quantidade` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `nome_plural_ingrediente_quantidade` varchar(40) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id_ingrediente_quantidade`),
  UNIQUE KEY `nome_singular_ingrediente_quantidade` (`nome_singular_ingrediente_quantidade`,`nome_plural_ingrediente_quantidade`)
) ENGINE=InnoDB AUTO_INCREMENT=39 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Despejando dados para a tabela `ingrediente_quantidade`
--

INSERT INTO `ingrediente_quantidade` (`id_ingrediente_quantidade`, `nome_singular_ingrediente_quantidade`, `nome_plural_ingrediente_quantidade`) VALUES
(28, '1/2 colher de sobremesa', '1/2 colheres de sobremesa'),
(20, '1/2 xícara de chá', '1/2 xícaras de chá'),
(24, '1/3 xícara de chá', '1/3 xícaras de chá'),
(21, '1/4 xícara de chá', '1/4 xícaras de chá'),
(23, '1/8 xícara de chá', '1/8 xícaras de chá'),
(25, '2/3 xícara de chá', '2/3 xícaras de chá'),
(22, '3/4 xícara de chá', '3/4 xícaras de chá'),
(1, 'a gosto', 'a gosto'),
(37, 'caixa', 'caxais'),
(12, 'colher de café', 'colheres de café'),
(13, 'colher de chá', 'colheres de chá'),
(14, 'colher de sobremesa', 'colheres de sobremesa'),
(15, 'colher de sopa', 'colheres de sopa'),
(9, 'copo', 'copos'),
(16, 'copo americano', 'copos americanos'),
(17, 'copo requeijão', 'copos de requeijão'),
(4, 'fatia', 'fatias'),
(26, 'garrafa', 'garrafas'),
(7, 'grama', 'gramas'),
(38, 'lata', 'latas'),
(10, 'litro', 'litros'),
(11, 'mililitro', 'mililitros'),
(18, 'pacote', 'pacotes'),
(2, 'pedaço', 'pedaços'),
(5, 'pitada', 'pitadas'),
(3, 'punhado', 'punhados'),
(6, 'quilo', 'quilos'),
(27, 'saco', 'sacos'),
(8, 'unidade', 'unidades'),
(19, 'xícara de chá', 'xícaras de chá');

-- --------------------------------------------------------

--
-- Estrutura para tabela `lista_de_ingredientes`
--

DROP TABLE IF EXISTS `lista_de_ingredientes`;
CREATE TABLE IF NOT EXISTS `lista_de_ingredientes` (
  `fk_id_receita` int DEFAULT NULL,
  `fk_id_ingrediente` int DEFAULT NULL,
  `qtdIngrediente_lista` decimal(10,3) DEFAULT NULL,
  `tipoQtdIngrediente_lista` int NOT NULL,
  KEY `fk_id_ingrediente` (`fk_id_ingrediente`),
  KEY `fk_id_ingrediente_quantidade` (`tipoQtdIngrediente_lista`) USING BTREE,
  KEY `fk_id_receita` (`fk_id_receita`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Despejando dados para a tabela `lista_de_ingredientes`
--

INSERT INTO `lista_de_ingredientes` (`fk_id_receita`, `fk_id_ingrediente`, `qtdIngrediente_lista`, `tipoQtdIngrediente_lista`) VALUES
(1, 396, 1.000, 20),
(1, 95, 1.000, 19),
(1, 397, 7.000, 15),
(1, 89, 4.000, 15),
(1, 398, 4.000, 15),
(2, 88, 1.000, 37),
(2, 89, 0.500, 37),
(2, 401, 1.000, 15),
(2, 400, 90.750, 7),
(2, 402, 1.000, 15),
(3, 88, 200.000, 7),
(3, 408, 50.000, 7),
(3, 409, 50.000, 7),
(3, 110, 1.000, 1),
(3, 215, 2.000, 15),
(3, 405, 1.000, 15),
(4, 110, 1.000, 1),
(4, 409, 50.000, 7),
(4, 410, 100.000, 7),
(4, 211, 50.000, 7),
(4, 89, 0.500, 37),
(4, 88, 1.000, 38),
(46, 3, 1.000, 16),
(48, 2, 1.000, 28),
(49, 328, 1.000, 28),
(50, 328, 1.000, 28),
(51, 98, 1.000, 28),
(52, 98, 1.000, 28),
(53, 98, 1.000, 28),
(55, 328, 1.000, 28);

-- --------------------------------------------------------

--
-- Estrutura para tabela `porcao_quantidade`
--

DROP TABLE IF EXISTS `porcao_quantidade`;
CREATE TABLE IF NOT EXISTS `porcao_quantidade` (
  `id_porcao` int NOT NULL AUTO_INCREMENT,
  `nome_singular_porcao` varchar(40) COLLATE utf8mb3_unicode_ci NOT NULL,
  `nome_plural_porcao` varchar(40) COLLATE utf8mb3_unicode_ci NOT NULL,
  PRIMARY KEY (`id_porcao`),
  UNIQUE KEY `nome_singular_porcao` (`nome_singular_porcao`,`nome_plural_porcao`)
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Despejando dados para a tabela `porcao_quantidade`
--

INSERT INTO `porcao_quantidade` (`id_porcao`, `nome_singular_porcao`, `nome_plural_porcao`) VALUES
(9, 'copo', 'copos'),
(4, 'fatia', 'fatias'),
(7, 'grama', 'gramas'),
(10, 'litro', 'litros'),
(11, 'mililitro', 'mililitros'),
(2, 'pedaço', 'pedaços'),
(5, 'pessoa', 'pessoas'),
(1, 'porção', 'porções'),
(3, 'prato', 'pratos'),
(6, 'quilo', 'quilos'),
(8, 'unidade', 'unidades'),
(12, 'xícara', 'xícaras');

-- --------------------------------------------------------

--
-- Estrutura para tabela `receita`
--

DROP TABLE IF EXISTS `receita`;
CREATE TABLE IF NOT EXISTS `receita` (
  `id_receita` int NOT NULL AUTO_INCREMENT,
  `nome_receita` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `numeroPorcao_receita` decimal(10,3) NOT NULL,
  `tipoPorcao_receita` int NOT NULL,
  `tempoPreparoHora_receita` int NOT NULL,
  `tempoPreparoMinuto_receita` int NOT NULL,
  `modoPreparo_receita` text CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci NOT NULL,
  `imagem_receita` varchar(220) CHARACTER SET utf8mb4 COLLATE utf8mb4_unicode_ci DEFAULT '../css/img/receita/no_image.png',
  `categoria_receita` int DEFAULT NULL,
  `fk_id_usuario` int NOT NULL,
  PRIMARY KEY (`id_receita`),
  KEY `fk_tipoPorcao` (`tipoPorcao_receita`),
  KEY `fk_categoria_receita` (`categoria_receita`),
  KEY `fk_id_usuario` (`fk_id_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Despejando dados para a tabela `receita`
--

INSERT INTO `receita` (`id_receita`, `nome_receita`, `numeroPorcao_receita`, `tipoPorcao_receita`, `tempoPreparoHora_receita`, `tempoPreparoMinuto_receita`, `modoPreparo_receita`, `imagem_receita`, `categoria_receita`, `fk_id_usuario`) VALUES
(1, 'Soda Italiana Cremosa', 2.000, 1, 0, 5, '1. Preencha um copo alto com ¾ de xícara de gelo.\n2. Despeje o xarope sobre o gelo.\n3. Adicione a água com gás.\n4. Finalize com creme de leite e/ou chantilly.\n5. Misture e aproveite!', '../css/img/receita/italian-cream-soda.png', 25, 1),
(2, 'Brigadeiro de Pistache', 25.000, 1, 8, 20, '1. Em uma panela, coloque o Leite Moça, o Creme de Leite, o pistache triturado, a pasta de pistache e a glucose de milho e misture bem.\r\n2. Leve ao fogo médio, mexendo sempre, por cerca de 8 minutos, ou até desgrudar do fundo da panela.\r\n3. Coloque em um prato untado com manteiga e deixe descansar por cerca de 8 horas.\r\n4. Com as mãos untadas, enrole em forma de brigadeiros, passe no pistache triturado e sirva.', '../css/img/receita/brigadeiro-de-pistache.png', 29, 1),
(3, 'Brigadeiro Casadinho de Morango e Ninho', 12.000, 8, 1, 45, '1. Em uma panela, adicione o leite condensado, o leite em pó e a manteiga para fazer o brigadeiro de Ninho.\r\n\r\n2. Cozinhe em fogo baixo, mexendo sempre até que a mistura desgrude do fundo da panela (ponto de brigadeiro).\r\n\r\n3. Retire o brigadeiro de Ninho do fogo e deixe esfriar até estar em temperatura ambiente para modelar.\r\n\r\n4. Em outra panela, adicione o leite condensado, o chocolate branco, a manteiga e o pó para preparo de morango para fazer o brigadeiro de morango.\r\n\r\n5. Cozinhe em fogo baixo, mexendo até que a mistura desgrude do fundo da panela (mesmo ponto do brigadeiro de Ninho).\r\n\r\n6. Retire o brigadeiro de morango do fogo e deixe esfriar até atingir a temperatura ideal para modelar.\r\n\r\n7. Com a ajuda de uma balança, pese 4 gramas de brigadeiro de Ninho e faça uma bolinha.\r\n\r\n8. Pese 4 gramas de brigadeiro de morango e faça outra bolinha.\r\n\r\n9. Achate as bolinhas separadamente antes de enrolá-las para garantir uma divisão perfeita no meio do doce.\r\n\r\n10. Una as duas partes (Ninho e morango) e enrole para formar o casadinho.\r\n\r\n11. Passe os casadinhos imediatamente no açúcar refinado, enquanto ainda há gordura ativada para que o açúcar adira bem à superfície.\r\n\r\n12. Coloque os casadinhos em forminhas, cuidando para que a divisão entre os dois sabores (Ninho e morango) fique bem no meio do doce.\r\n\r\n13. Os casadinhos estão prontos para serem servidos!\r\n\r\nDica: O truque para uma divisão perfeita entre os dois sabores é achatar as bolinhas antes de enrolá-las. Isso garante que a separação fique visível e o resultado seja esteticamente bonito.', '../css/img/receita/casadinho-morango.png', 29, 1),
(4, 'Brigadeiro Romeu e Julieta', 12.000, 1, 0, 90, '1. Em uma panela, misture o Leite Moça, o  Creme de Leite, o queijo ralado e o chocolate branco picado. Leve ao fogo médio, mexendo sempre, por cerca de 8-10 minutos até que o brigadeiro fique no ponto de enrolar.\r\n2. Transfira para um prato untado, cubra com plástico-filme e deixe esfriar por completo.\r\n3. Após, porcione quantidades do brigadeiro, faça bolinhas, abra-as na palma da mão e recheie-as com alguns pedaços da goiabada picada. Feche e boleie para obter um brigadeiro. Passe-os brigadeiros no açúcar cristal, coloque-os em forminhas próprias e sirva.', '../css/img/receita/brigadeiro-romeu-e-julieta.png', 29, 1),
(46, 'teste', 1.000, 2, 1, 2, 'aaaaaaaaaaa', '../css/img/receita/receita_6727f426a8c062.13523945.png', 5, 0),
(48, 'imagem', 1.000, 5, 0, 1, 'aaaaaaaaaaaaaaaaa', '../css/img/receita/receita_6727fa83b14704.79212071.png', 44, 0),
(49, 'bbbbbbbbbbbb', 1.000, 2, 0, 1, 'aaa', '../css/img/receita/receita_6727fd8bd7fc99.66511598.png', 6, 0),
(50, 'bbbbbbbbbbbb', 1.000, 2, 0, 1, 'aaa', '../css/img/receita/receita_672803a8a59fa6.92058067.png', 6, 0),
(51, '55555555555555555', 1.000, 10, 0, 1, 'aaaaaaaaa', '', 11, 0),
(52, '55555555555555555', 1.000, 10, 0, 1, 'aaaaaaaaa', '../css/img/receita/receita_672804299f32a2.05236364.png', 11, 0),
(53, '55555555555555555', 1.000, 10, 0, 1, 'aaaaaaaaa', '', 11, 0),
(55, 'hggg', 1.000, 2, 0, 1, 'aa', '', 10, 0);


DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(220) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `email_usuario` varchar(220) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `senha_usuario` varchar(220) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `recuperar_senha` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `imagem_usuario` varchar(220) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT '../css/img/usuario/no_image.png',
  `statusAdministrador_usuario` char(1) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'c',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `unique_nome_usuario` (`nome_usuario`),
  UNIQUE KEY `unique_email_usuario` (`email_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=168 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome_usuario`, `email_usuario`, `senha_usuario`, `recuperar_senha`, `imagem_usuario`, `statusAdministrador_usuario`) VALUES
(1, 'Admin2', 'amandaveigafurtado@gmail.com', '$2y$10$QZEMW75b3179MRkwDPWsJ.FvMeSFvyB2b7KmbBir2y/G/PL9iWbEC', '$2y$10$dK3SGRRgT8jfSGLCjeM91Og0PQze0TMsOC1YIjTB9N69Vvy5Ftifu', '../css/img/usuario/672160106667a_67201a63d8546_no_image.png', 'a'),
(163, 'Usuario 1', 'a@gmail.com', '$2y$10$QZEMW75b3179MRkwDPWsJ.FvMeSFvyB2b7KmbBir2y/G/PL9iWbEC', NULL, '../css/img/ingrediente/no_image.png', 'c'),
(165, 'Usuario 21', 'a21', 'aa2', NULL, '../css/img/ingrediente/no_image.png', 'b'),
(166, '07/10@gmail.com', '07/10@gmail.com', '$2y$10$4Xe5NhKvxAY8L1gmHDV0IuLRwNQFaKpmVDWC9T0mE.5HbxHnS8foq', NULL, '../css/img/ingrediente/no_image.png', 'b'),
(167, '09/10@gmail.com', '09/10@gmail.co', '$2y$10$lDDrwTno97ZXyrZ.9GtXm.gdcItsQhZ9.U7iMqJg/pXs5oL7Y8pc6', NULL, '../css/img/ingrediente/no_image.png', 'c');

-- --------------------------------------------------------

--
-- Estrutura stand-in para view `view_lista_ingredientes`
-- (Veja abaixo para a visão atual)
--
DROP VIEW IF EXISTS `view_lista_ingredientes`;
CREATE TABLE IF NOT EXISTS `view_lista_ingredientes` (
`fk_id_ingrediente` int
,`fk_id_receita` int
,`nome_receita` varchar(220)
,`qtdIngrediente_lista` decimal(10,3)
,`tipoQtdIngrediente_lista` int
);

-- --------------------------------------------------------

--
-- Estrutura para view `view_lista_ingredientes`
--
DROP TABLE IF EXISTS `view_lista_ingredientes`;

DROP VIEW IF EXISTS `view_lista_ingredientes`;
CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_lista_ingredientes`  AS SELECT `li`.`fk_id_receita` AS `fk_id_receita`, `li`.`fk_id_ingrediente` AS `fk_id_ingrediente`, `li`.`qtdIngrediente_lista` AS `qtdIngrediente_lista`, `li`.`tipoQtdIngrediente_lista` AS `tipoQtdIngrediente_lista`, `r`.`nome_receita` AS `nome_receita` FROM (`lista_de_ingredientes` `li` left join `receita` `r` on((`li`.`fk_id_receita` = `r`.`id_receita`))) ;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `comentario`
--
ALTER TABLE `comentario`
  ADD CONSTRAINT `fk_comentario_receita` FOREIGN KEY (`fk_id_receita`) REFERENCES `receita` (`id_receita`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_comentario_usuario` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `ingrediente`
--
ALTER TABLE `ingrediente`
  ADD CONSTRAINT `fk_categoria_ingrediente` FOREIGN KEY (`fk_id_categoria_ingrediente`) REFERENCES `categoria_ingrediente` (`id_categoria_ingrediente`);

--
-- Restrições para tabelas `lista_de_ingredientes`
--
ALTER TABLE `lista_de_ingredientes`
  ADD CONSTRAINT `fk_id_ingrediente` FOREIGN KEY (`fk_id_ingrediente`) REFERENCES `ingrediente` (`id_ingrediente`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_id_receita` FOREIGN KEY (`fk_id_receita`) REFERENCES `receita` (`id_receita`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tipoQtdIngrediente_lista` FOREIGN KEY (`tipoQtdIngrediente_lista`) REFERENCES `ingrediente_quantidade` (`id_ingrediente_quantidade`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `receita`
--
ALTER TABLE `receita`
  ADD CONSTRAINT `fk_categoria_receita` FOREIGN KEY (`categoria_receita`) REFERENCES `categoria_culinaria` (`id_categoria_culinaria`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_tipoPorcao` FOREIGN KEY (`tipoPorcao_receita`) REFERENCES `porcao_quantidade` (`id_porcao`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Restrições para tabelas `sugestao`
--
ALTER TABLE `sugestao`
  ADD CONSTRAINT `fk_sugestao_usuario` FOREIGN KEY (`fk_id_usuario`) REFERENCES `usuario` (`id_usuario`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
