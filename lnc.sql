-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 13-Jul-2023 às 12:29
-- Versão do servidor: 10.4.24-MariaDB
-- versão do PHP: 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `lnc`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `arquivos`
--

CREATE TABLE `arquivos` (
  `Seq.` int(11) NOT NULL,
  `LNC` int(11) DEFAULT NULL,
  `Data Adicao` datetime DEFAULT NULL,
  `Nome` varchar(255) DEFAULT NULL,
  `Local` varchar(255) DEFAULT NULL,
  `Formato` varchar(10) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `claims`
--

CREATE TABLE `claims` (
  `Seq.` int(11) NOT NULL,
  `LNC` int(11) DEFAULT NULL,
  `Ano` int(11) DEFAULT NULL,
  `Data de Abertura` date DEFAULT NULL,
  `Forn` varchar(255) DEFAULT NULL,
  `Item` varchar(50) DEFAULT NULL,
  `Descricao` varchar(255) DEFAULT NULL,
  `Encontrado` varchar(50) DEFAULT NULL,
  `Especificado` varchar(50) DEFAULT NULL,
  `8D` bit(1) DEFAULT NULL,
  `Arquivo` bit(1) DEFAULT NULL,
  `Resp` varchar(60) DEFAULT NULL,
  `Data Criacao` datetime NOT NULL,
  `Data Edicao` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `claims`
--

INSERT INTO `claims` (`Seq.`, `LNC`, `Ano`, `Data de Abertura`, `Forn`, `Item`, `Descricao`, `Encontrado`, `Especificado`, `8D`, `Arquivo`, `Resp`, `Data Criacao`, `Data Edicao`) VALUES
(2, 1, 2023, '2023-07-12', 'Ensinger', 'C100017', 'Isso é um teste', NULL, NULL, NULL, NULL, NULL, '2023-07-12 08:29:43', NULL),
(12, 50, 2023, '2023-07-12', 'Ensinger', 'C001017', 'fsafsaf', NULL, NULL, NULL, NULL, NULL, '2023-07-12 16:34:00', NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--

CREATE TABLE `fornecedores` (
  `Seq.` int(11) NOT NULL,
  `Forn` varchar(255) DEFAULT NULL,
  `Contato` varchar(255) DEFAULT NULL,
  `Telefone` varchar(255) DEFAULT NULL,
  `Email` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `fornecedores`
--

INSERT INTO `fornecedores` (`Seq.`, `Forn`, `Contato`, `Telefone`, `Email`) VALUES
(1, 'Ensinger Indústria de Plásticos Técnicos Ltda.', 'Carlos Leandro L. da Rosa', '(51) 3579-8834', 'carlos@ensinger.com.br');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pecas`
--

CREATE TABLE `pecas` (
  `Seq.` int(11) NOT NULL,
  `Cod` varchar(50) DEFAULT NULL,
  `Descricao` varchar(255) DEFAULT NULL,
  `Forn` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pecas`
--

INSERT INTO `pecas` (`Seq.`, `Cod`, `Descricao`, `Forn`) VALUES
(1, 'C100017', 'Carcaça do Termostato BA EA211 (04E 121 117L)', 'Ensinger'),
(2, 'C100002', 'Carcaça Bruta BA EA111 (030 121 019B)', 'Deluma'),
(3, 'C011002', 'Pistão BO EA211 (154 017 802KT)', 'Igus');

-- --------------------------------------------------------

--
-- Estrutura da tabela `views`
--

CREATE TABLE `views` (
  `Seq.` int(11) NOT NULL,
  `Data Visita` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `arquivos`
--
ALTER TABLE `arquivos`
  ADD PRIMARY KEY (`Seq.`);

--
-- Índices para tabela `claims`
--
ALTER TABLE `claims`
  ADD PRIMARY KEY (`Seq.`);

--
-- Índices para tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  ADD PRIMARY KEY (`Seq.`);

--
-- Índices para tabela `pecas`
--
ALTER TABLE `pecas`
  ADD PRIMARY KEY (`Seq.`);

--
-- Índices para tabela `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`Seq.`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `arquivos`
--
ALTER TABLE `arquivos`
  MODIFY `Seq.` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=35;

--
-- AUTO_INCREMENT de tabela `claims`
--
ALTER TABLE `claims`
  MODIFY `Seq.` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT de tabela `fornecedores`
--
ALTER TABLE `fornecedores`
  MODIFY `Seq.` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `pecas`
--
ALTER TABLE `pecas`
  MODIFY `Seq.` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT de tabela `views`
--
ALTER TABLE `views`
  MODIFY `Seq.` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
