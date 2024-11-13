-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Tempo de geração: 13/11/2024 às 13:45
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
-- Banco de dados: `api_rest`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuario`
--

DROP TABLE IF EXISTS `usuario`;
CREATE TABLE IF NOT EXISTS `usuario` (
  `id_usuario` int NOT NULL AUTO_INCREMENT,
  `nome_usuario` varchar(220) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `telefone_usuario` varchar(20) COLLATE utf8mb3_unicode_ci NOT NULL,
  `email_usuario` varchar(220) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `endereco_usuario` varchar(440) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `senha_usuario` varchar(220) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci NOT NULL,
  `recuperar_senha` varchar(255) CHARACTER SET utf8mb3 COLLATE utf8mb3_unicode_ci DEFAULT NULL,
  `statusAdministrador_usuario` enum('c','a','b') COLLATE utf8mb3_unicode_ci NOT NULL DEFAULT 'c',
  PRIMARY KEY (`id_usuario`),
  UNIQUE KEY `unique_email_usuario` (`email_usuario`)
) ENGINE=InnoDB AUTO_INCREMENT=181 DEFAULT CHARSET=utf8mb3 COLLATE=utf8mb3_unicode_ci;

--
-- Despejando dados para a tabela `usuario`
--

INSERT INTO `usuario` (`id_usuario`, `nome_usuario`, `telefone_usuario`, `email_usuario`, `endereco_usuario`, `senha_usuario`, `recuperar_senha`, `statusAdministrador_usuario`) VALUES
(180, 'Amanda', '551155653199', 'amandaveigafurtado@gmail.com', 'Rua 2, 55, Apto 2A - Bairro 7, SP/SP - CEP: 55653199', '$2y$10$ukW0X4EwHKzwqWB8vghFceDYJNUE2njQ/xwiGJ2puFLrUOesBlyUm', NULL, 'c');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
