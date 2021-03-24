-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 24-Mar-2021 às 19:31
-- Versão do servidor: 10.4.11-MariaDB
-- versão do PHP: 7.2.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `empresa`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `empresa`
--

CREATE TABLE `empresa` (
  `id` int(11) NOT NULL,
  `uf` varchar(2) NOT NULL,
  `nome_fantasia` varchar(255) NOT NULL,
  `cnpj` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `empresa`
--

INSERT INTO `empresa` (`id`, `uf`, `nome_fantasia`, `cnpj`) VALUES
(6, 'PR', 'SANEAGO', '01616929000102');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `id` int(11) NOT NULL,
  `empresa` int(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `documento` varchar(14) NOT NULL,
  `tipo_pessoa` int(11) NOT NULL COMMENT '1- pessoa fisica 2 - pessoa juridica',
  `rg` varchar(20) DEFAULT NULL,
  `data_nascimento` date DEFAULT NULL,
  `inscricao` varchar(255) DEFAULT NULL,
  `uf_cnpj` varchar(2) DEFAULT NULL,
  `telefone` varchar(255) NOT NULL,
  `updated_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `fornecedores`
--

INSERT INTO `fornecedores` (`id`, `empresa`, `nome`, `documento`, `tipo_pessoa`, `rg`, `data_nascimento`, `inscricao`, `uf_cnpj`, `telefone`, `updated_at`, `created_at`) VALUES
(53, 6, 'fornecedor', '13262039675', 1, '44444444', '1997-09-07', NULL, NULL, '34984219187', '2021-03-24 21:32:32', '2021-03-24 21:32:32'),
(54, 6, 'fornecedor 02', '01616929000102', 2, NULL, NULL, '003305021.00-52', 'GO', '3433124017;34984219187', '2021-03-24 21:33:07', '2021-03-24 21:33:07');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `empresa`
--
ALTER TABLE `empresa`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `empresa`
--
ALTER TABLE `empresa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=56;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
