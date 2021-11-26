-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 26-Nov-2021 às 06:42
-- Versão do servidor: 10.4.20-MariaDB
-- versão do PHP: 8.0.8

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `engsoft2`
--
CREATE DATABASE IF NOT EXISTS `engsoft2` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `engsoft2`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

CREATE TABLE IF NOT EXISTS `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `celular` varchar(20) DEFAULT NULL,
  `cpf` varchar(14) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `compras`
--

CREATE TABLE IF NOT EXISTS `compras` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `vendedor` int(11) NOT NULL,
  `cliente` int(11) NOT NULL,
  `produto` int(11) NOT NULL,
  `valor` float NOT NULL,
  `valorDesconto` float NOT NULL,
  `valorTotal` float NOT NULL,
  `parcelas` int(11) NOT NULL,
  `valorParcela` float NOT NULL,
  `formaPagamento` char(1) NOT NULL,
  `dtVenda` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(255) NOT NULL,
  `valor` varchar(20) NOT NULL,
  `qtdEstoque` int(11) NOT NULL,
  `estoqueMinimo` int(11) NOT NULL,
  `validade` date DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendedores`
--

CREATE TABLE IF NOT EXISTS `vendedores` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `matricula` varchar(11) NOT NULL,
  `nome` varchar(255) NOT NULL,
  `endereco` varchar(255) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `salarioBase` varchar(10) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `vendedor_matricula` (`matricula`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
