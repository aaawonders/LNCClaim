-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 28-Jul-2023 às 21:29
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

--
-- Extraindo dados da tabela `arquivos`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `claims`
--


--
-- Estrutura da tabela `claimsby`
--

-- Extraindo dados da tabela `claimsby`
--

INSERT INTO `claimsby` (`Seq`, `Resp`, `LNC`, `Data`) VALUES
(1, 'Cláudio Idalgo', '050/23', '2023-07-28 15:49:58'),
(2, 'Cláudio Idalgo', '066/23', '2023-07-28 11:10:58');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `pecas`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

CREATE TABLE `pessoas` (
  `Seq` int(11) NOT NULL,
  `ID` int(11) DEFAULT NULL,
  `Nome` varchar(60) DEFAULT NULL,
  `Sobrenome` varchar(60) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pessoas`
--

INSERT INTO `pessoas` (`Seq`, `ID`, `Nome`, `Sobrenome`) VALUES
(1, 1, 'André', 'Silva'),
(2, 2, 'Sander', 'Benevides'),
(3, 3, 'Daniela', 'Mendes'),
(4, 4, 'Cláudio', 'Idalgo'),
(5, 5, 'Agnaldo', 'Bedin'),
(6, 6, 'Marli', 'Previatto'),
(7, 7, 'Fábio', 'França');

-- --------------------------------------------------------

--
-- Estrutura da tabela `views`
--

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
-- Índices para tabela `claimsby`
--
ALTER TABLE `claimsby`
  ADD PRIMARY KEY (`Seq`);

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
-- Índices para tabela `pessoas`
--
ALTER TABLE `pessoas`
  ADD PRIMARY KEY (`Seq`);

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
  MODIFY `Seq.` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT de tabela `claims`
--
ALTER TABLE `claims`
  MODIFY `Seq.` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT de tabela `claimsby`
--
ALTER TABLE `claimsby`
  MODIFY `Seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
-- AUTO_INCREMENT de tabela `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `Seq` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `views`
--
ALTER TABLE `views`
  MODIFY `Seq.` int(11) NOT NULL AUTO_INCREMENT;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
