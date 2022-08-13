-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 14-Ago-2022 às 00:57
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";

--
-- Banco de dados: `clinica`
--
CREATE DATABASE IF NOT EXISTS `clinica` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `clinica`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargos`
--

DROP TABLE IF EXISTS `cargos`;
CREATE TABLE IF NOT EXISTS `cargos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `cargo` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `cargos`
--

INSERT INTO `cargos` (`id`, `cargo`) VALUES
(1, 'assistente administrativo'),
(2, 'médico'),
(3, 'farmaceutico'),
(4, 'enfermeira');

-- --------------------------------------------------------

--
-- Estrutura da tabela `classes`
--

DROP TABLE IF EXISTS `classes`;
CREATE TABLE IF NOT EXISTS `classes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(100) NOT NULL,
  `extends` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `nome` (`nome`),
  KEY `extends` (`extends`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `classes`
--

INSERT INTO `classes` (`id`, `nome`, `extends`) VALUES
(1, 'model', NULL),
(2, 'pessoas', 'model');

-- --------------------------------------------------------

--
-- Estrutura da tabela `convenios`
--

DROP TABLE IF EXISTS `convenios`;
CREATE TABLE IF NOT EXISTS `convenios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `convenios`
--

INSERT INTO `convenios` (`id`, `nome`) VALUES
(1, 'unimed'),
(2, 'clinipam'),
(3, 'evangélico saúde'),
(4, 'bradesco'),
(5, 'alcance'),
(6, 'hospitalar');

-- --------------------------------------------------------

--
-- Estrutura da tabela `farmaceutico`
--

DROP TABLE IF EXISTS `farmaceutico`;
CREATE TABLE IF NOT EXISTS `farmaceutico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_funcionario` int(11) NOT NULL,
  `crf` varchar(11) NOT NULL,
  `id_uf_crf` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `crf_unico` (`crf`),
  KEY `id_funcionario` (`id_funcionario`),
  KEY `id_uf_crf` (`id_uf_crf`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

DROP TABLE IF EXISTS `funcionario`;
CREATE TABLE IF NOT EXISTS `funcionario` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pessoa` int(11) NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `salario` float NOT NULL,
  `pis` varchar(14) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_cargo` (`id_cargo`),
  KEY `id_pessoa` (`id_pessoa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`id`, `id_pessoa`, `id_cargo`, `salario`, `pis`) VALUES
(1, 1, 2, 0, '643.84714.71-4');

-- --------------------------------------------------------

--
-- Estrutura da tabela `lote`
--

DROP TABLE IF EXISTS `lote`;
CREATE TABLE IF NOT EXISTS `lote` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `validade` date NOT NULL,
  `data-cadastro` date NOT NULL DEFAULT current_timestamp(),
  `lote` varchar(40) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `lote_cadastro` (`id_produto`),
  KEY `lote_id_funcionario_funcionario_id` (`id_funcionario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `lote`
--

INSERT INTO `lote` (`id`, `id_produto`, `id_funcionario`, `validade`, `data-cadastro`, `lote`) VALUES
(1, 1, 1, '2025-01-01', '2022-08-13', '150'),
(2, 1, 1, '2025-01-01', '2022-08-13', '151'),
(3, 1, 1, '2026-01-01', '2022-08-13', '152');

-- --------------------------------------------------------

--
-- Estrutura da tabela `medicamentos`
--

DROP TABLE IF EXISTS `medicamentos`;
CREATE TABLE IF NOT EXISTS `medicamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `laboratorio` varchar(250) NOT NULL,
  `principio_ativo` varchar(400) NOT NULL,
  `nome_comercial` varchar(250) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `medicamento_produto` (`id_produto`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `medicamentos`
--

INSERT INTO `medicamentos` (`id`, `id_produto`, `laboratorio`, `principio_ativo`, `nome_comercial`) VALUES
(1, 1, 'GSK', 'diclofenado ', 'Cataflam');

-- --------------------------------------------------------

--
-- Estrutura da tabela `medico`
--

DROP TABLE IF EXISTS `medico`;
CREATE TABLE IF NOT EXISTS `medico` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_funcionario` int(11) NOT NULL,
  `crm` varchar(11) NOT NULL,
  `id_uf_crm` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_funcionario` (`id_funcionario`),
  KEY `id_uf_crm` (`id_uf_crm`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `medico`
--

INSERT INTO `medico` (`id`, `id_funcionario`, `crm`, `id_uf_crm`) VALUES
(1, 1, '31438', 48);

-- --------------------------------------------------------

--
-- Estrutura da tabela `movimentacoes`
--

DROP TABLE IF EXISTS `movimentacoes`;
CREATE TABLE IF NOT EXISTS `movimentacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_produto` int(11) NOT NULL,
  `id_lote` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `qtd` int(11) NOT NULL,
  `data-cadastro` date NOT NULL DEFAULT current_timestamp(),
  PRIMARY KEY (`id`),
  KEY `id_produto_produtos_id` (`id_produto`),
  KEY `movimentacoes_id_lote_lotes_id` (`id_lote`),
  KEY `movimentacoes_id_funcionario_funcionario_id` (`id_funcionario`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `movimentacoes`
--

INSERT INTO `movimentacoes` (`id`, `id_produto`, `id_lote`, `id_funcionario`, `qtd`, `data-cadastro`) VALUES
(1, 1, 1, 1, 50, '2022-08-13'),
(2, 1, 2, 1, 51, '2022-08-13'),
(3, 1, 3, 1, 52, '2022-08-13');

-- --------------------------------------------------------

--
-- Estrutura da tabela `pacientes`
--

DROP TABLE IF EXISTS `pacientes`;
CREATE TABLE IF NOT EXISTS `pacientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pessoa` int(11) NOT NULL,
  `id_convenio` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `id_pessoa` (`id_pessoa`),
  KEY `id_convenio` (`id_convenio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pais`
--

DROP TABLE IF EXISTS `pais`;
CREATE TABLE IF NOT EXISTS `pais` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `pais` varchar(100) NOT NULL,
  `sigla` varchar(2) NOT NULL,
  `cod_ibge` int(11) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sigla` (`sigla`,`cod_ibge`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pais`
--

INSERT INTO `pais` (`id`, `pais`, `sigla`, `cod_ibge`) VALUES
(1, 'Brasil', 'BR', 55);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

DROP TABLE IF EXISTS `pessoas`;
CREATE TABLE IF NOT EXISTS `pessoas` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(200) NOT NULL,
  `ender` varchar(200) NOT NULL,
  `telefone` varchar(20) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `data_nasc` date NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `deletado` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pessoas`
--

INSERT INTO `pessoas` (`id`, `nome`, `ender`, `telefone`, `cpf`, `data_nasc`, `sexo`, `deletado`) VALUES
(1, 'teste', 'teste', '+99 (99) 9 9999-9999', '704.337.460-09', '2000-01-01', 'M', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_func_cadastro` int(11) NOT NULL,
  `descricao` varchar(250) NOT NULL,
  `data_cadastro` date NOT NULL DEFAULT current_timestamp(),
  `fabricante` varchar(200) NOT NULL,
  `deletado` tinyint(1) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`),
  KEY `func_cadastro` (`id_func_cadastro`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`id`, `id_func_cadastro`, `descricao`, `data_cadastro`, `fabricante`, `deletado`) VALUES
(1, 1, 'Pomada Anti-inflamatória', '2022-08-13', 'CATAFLAM', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `uf`
--

DROP TABLE IF EXISTS `uf`;
CREATE TABLE IF NOT EXISTS `uf` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pais` int(11) NOT NULL,
  `uf` varchar(100) NOT NULL,
  `cod_ibge` int(11) NOT NULL,
  `sigla` varchar(2) NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `sigla` (`sigla`,`id_pais`),
  KEY `id_pais` (`id_pais`)
) ENGINE=InnoDB AUTO_INCREMENT=55 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `uf`
--

INSERT INTO `uf` (`id`, `id_pais`, `uf`, `cod_ibge`, `sigla`) VALUES
(28, 1, 'Rondônia', 11, 'RO'),
(29, 1, 'Acre', 12, 'AC'),
(30, 1, 'Amazonas', 13, 'AM'),
(31, 1, 'Roraima', 14, 'RR'),
(32, 1, 'Pará', 15, 'PA'),
(33, 1, 'Amapá', 16, 'AP'),
(34, 1, 'Tocantins', 17, 'TO'),
(35, 1, 'Maranhão', 21, 'MA'),
(36, 1, 'Piauí', 22, 'PI'),
(37, 1, 'Ceará', 23, 'CE'),
(38, 1, 'Rio Grande do Norte', 24, 'RN'),
(39, 1, 'Paraíba', 25, 'PB'),
(40, 1, 'Pernambuco', 26, 'PE'),
(41, 1, 'Alagoas', 27, 'AL'),
(42, 1, 'Sergipe', 28, 'SE'),
(43, 1, 'Bahia', 29, 'BA'),
(44, 1, 'Minas Gerais', 31, 'MG'),
(45, 1, 'Espírito Santo', 32, 'ES'),
(46, 1, 'Rio de Janeiro', 33, 'RJ'),
(47, 1, 'São Paulo', 35, 'SP'),
(48, 1, 'Paraná', 41, 'PR'),
(49, 1, 'Santa Catarina', 42, 'SC'),
(50, 1, 'Rio Grande do Sul (*)', 43, 'RS'),
(51, 1, 'Mato Grosso do Sul', 50, 'MS'),
(52, 1, 'Mato Grosso', 51, 'MT'),
(53, 1, 'Goiás', 52, 'GO'),
(54, 1, 'Distrito Federal', 53, 'DF');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
CREATE TABLE IF NOT EXISTS `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_pessoa` int(11) NOT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `usuario` (`usuario`),
  KEY `id_pessoa` (`id_pessoa`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_pessoa`, `usuario`, `senha`) VALUES
(1, 1, 'aaa', 'aaa');

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_extends_classes_nome` FOREIGN KEY (`extends`) REFERENCES `classes` (`nome`);

--
-- Limitadores para a tabela `farmaceutico`
--
ALTER TABLE `farmaceutico`
  ADD CONSTRAINT `farmaceutico_id_funcionario_funcionario_id` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id`),
  ADD CONSTRAINT `farmaceutico_id_uf_crf_uf_id` FOREIGN KEY (`id_uf_crf`) REFERENCES `uf` (`id`);

--
-- Limitadores para a tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `funcionario_id_cargo_cargos_id` FOREIGN KEY (`id_cargo`) REFERENCES `cargos` (`id`),
  ADD CONSTRAINT `funcionario_id_pessoa_pessoas_id` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoas` (`id`);

--
-- Limitadores para a tabela `lote`
--
ALTER TABLE `lote`
  ADD CONSTRAINT `lote_id_funcionario_funcionario_id` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id`),
  ADD CONSTRAINT `lote_id_produto_produtos_id` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`);

--
-- Limitadores para a tabela `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD CONSTRAINT `medicamento_id_produto_produto_id` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`);

--
-- Limitadores para a tabela `medico`
--
ALTER TABLE `medico`
  ADD CONSTRAINT `medico_id_funcionario_funcionario_id` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id`),
  ADD CONSTRAINT `medico_id_uf_crm_uf_id` FOREIGN KEY (`id_uf_crm`) REFERENCES `uf` (`id`);

--
-- Limitadores para a tabela `movimentacoes`
--
ALTER TABLE `movimentacoes`
  ADD CONSTRAINT `movimentacoes_id_funcionario_funcionario_id` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id`),
  ADD CONSTRAINT `movimentacoes_id_lote_lotes_id` FOREIGN KEY (`id_lote`) REFERENCES `lote` (`id`);

--
-- Limitadores para a tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `pacientes_id_convenio_convenios_id` FOREIGN KEY (`id_convenio`) REFERENCES `convenios` (`id`),
  ADD CONSTRAINT `pacientes_id_pessoa_pessoa_id` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoas` (`id`);

--
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `produtos_id_func_cadastro_funcionario_id` FOREIGN KEY (`id_func_cadastro`) REFERENCES `funcionario` (`id`);

--
-- Limitadores para a tabela `uf`
--
ALTER TABLE `uf`
  ADD CONSTRAINT `uf_id_pais_pais_id` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id`);

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_id_pessoa_pessoas_id` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoas` (`id`);
COMMIT;
