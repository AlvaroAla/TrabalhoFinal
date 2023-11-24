-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Tempo de geração: 24/11/2023 às 02:18
-- Versão do servidor: 10.4.22-MariaDB
-- Versão do PHP: 7.4.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `dcs`
--

-- --------------------------------------------------------

--
-- Estrutura para tabela `combustivel`
--

CREATE TABLE `combustivel` (
  `idcombustivel` int(11) NOT NULL,
  `nome` varchar(20) NOT NULL,
  `idconsumo` char(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `combustivel`
--

INSERT INTO `combustivel` (`idcombustivel`, `nome`, `idconsumo`) VALUES
(1, 'biocombustivel', 'combustivelPerfil'),
(2, 'etanol', 'combustivelPerfil'),
(3, 'gnv', 'combustivelPerfil');

-- --------------------------------------------------------

--
-- Estrutura para tabela `consumo`
--

CREATE TABLE `consumo` (
  `idconsumo` char(20) NOT NULL,
  `nome` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `consumo`
--

INSERT INTO `consumo` (`idconsumo`, `nome`) VALUES
('combustivelPerfil', 'combustivel'),
('energiaPerfil', 'energia');

-- --------------------------------------------------------

--
-- Estrutura para tabela `itens`
--

CREATE TABLE `itens` (
  `iditem` int(11) NOT NULL,
  `modelo` varchar(20) NOT NULL,
  `consumomedio` decimal(10,2) DEFAULT NULL,
  `consumoeletricidade` decimal(10,2) DEFAULT NULL,
  `cpfdono` char(11) NOT NULL,
  `tipoconsumoenergia` char(20) DEFAULT NULL,
  `tipoconsumocombustivel` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `itens`
--

INSERT INTO `itens` (`iditem`, `modelo`, `consumomedio`, `consumoeletricidade`, `cpfdono`, `tipoconsumoenergia`, `tipoconsumocombustivel`) VALUES
(1, 'Foston S09 Pro', NULL, '0.37', '12345678932', 'energiaPerfil', NULL),
(3, 'fusca', '15.00', NULL, '12345678932', NULL, NULL),
(4, 'montana', '18.00', NULL, '143', NULL, 2);

-- --------------------------------------------------------

--
-- Estrutura para tabela `usuarios`
--

CREATE TABLE `usuarios` (
  `cpf` char(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `dtnasc` date DEFAULT NULL,
  `telefone` char(15) NOT NULL,
  `email` varchar(30) NOT NULL,
  `senha` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Despejando dados para a tabela `usuarios`
--

INSERT INTO `usuarios` (`cpf`, `nome`, `dtnasc`, `telefone`, `email`, `senha`) VALUES
('123', 'teste', '2002-12-12', '123', 'teste@t.com', '202cb962ac59075b964b07152d234b70'),
('12345678932', 'picapau', '1940-11-25', '11111111111', 'picapau@ymail.com', '12345'),
('143', 'teste2', '2002-12-12', '123', 'teste2@t.com', 'c20ad4d76fe97759aa27a0c99bff6710'),
('152', 'teste3', '2002-12-12', '123', 'teste3@t.com', '202cb962ac59075b964b07152d234b70'),
('174', 'teste4', '2002-12-12', '123', 'teste4@t.com', '202cb962ac59075b964b07152d234b70'),
('22222222222', 'Jose', '2002-12-12', '11111111111', 'jose@blablabla.com', 'e10adc3949ba59abbe56e057f20f883e'),
('44444444444', 'Josefa', '1972-10-05', '33333333333', 'josefa@ggg.com', '12356');

--
-- Índices para tabelas despejadas
--

--
-- Índices de tabela `combustivel`
--
ALTER TABLE `combustivel`
  ADD PRIMARY KEY (`idcombustivel`),
  ADD KEY `idconsumo` (`idconsumo`);

--
-- Índices de tabela `consumo`
--
ALTER TABLE `consumo`
  ADD PRIMARY KEY (`idconsumo`);

--
-- Índices de tabela `itens`
--
ALTER TABLE `itens`
  ADD PRIMARY KEY (`iditem`),
  ADD KEY `cpfdono` (`cpfdono`),
  ADD KEY `tipoconsumoenergia` (`tipoconsumoenergia`),
  ADD KEY `tipoconsumocombustivel` (`tipoconsumocombustivel`);

--
-- Índices de tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`cpf`);

--
-- AUTO_INCREMENT para tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `itens`
--
ALTER TABLE `itens`
  MODIFY `iditem` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- Restrições para tabelas despejadas
--

--
-- Restrições para tabelas `combustivel`
--
ALTER TABLE `combustivel`
  ADD CONSTRAINT `combustivel_ibfk_1` FOREIGN KEY (`idconsumo`) REFERENCES `consumo` (`idconsumo`);

--
-- Restrições para tabelas `itens`
--
ALTER TABLE `itens`
  ADD CONSTRAINT `itens_ibfk_1` FOREIGN KEY (`cpfdono`) REFERENCES `usuarios` (`cpf`),
  ADD CONSTRAINT `itens_ibfk_2` FOREIGN KEY (`tipoconsumoenergia`) REFERENCES `consumo` (`idconsumo`),
  ADD CONSTRAINT `itens_ibfk_3` FOREIGN KEY (`tipoconsumocombustivel`) REFERENCES `combustivel` (`idcombustivel`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
