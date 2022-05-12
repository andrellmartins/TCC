-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 02-Maio-2022 às 04:09
-- Versão do servidor: 10.4.17-MariaDB
-- versão do PHP: 7.3.27

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Banco de dados: `clinica`
--
CREATE DATABASE IF NOT EXISTS `clinica` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `clinica`;

-- --------------------------------------------------------

--
-- Estrutura da tabela `cargos`
--

CREATE TABLE `cargos` (
  `id` int(11) NOT NULL,
  `cargo` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `classes` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `extends` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `convenios` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `farmaceutico` (
  `id` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `crf` varchar(11) NOT NULL,
  `id_uf_crf` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `farmaceutico`
--

INSERT INTO `farmaceutico` (`id`, `id_funcionario`, `crf`, `id_uf_crf`) VALUES
(19, 1, '31231', 29),
(20, 2, '56156', 41),
(21, 3, '65156', 29),
(25, 11, '15615', 29),
(26, 12, '26516', 29);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id` int(11) NOT NULL,
  `id_pessoa` int(11) NOT NULL,
  `id_cargo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`id`, `id_pessoa`, `id_cargo`) VALUES
(1, 49, 4),
(2, 50, 4),
(3, 51, 4),
(11, 69, 4),
(12, 70, 4),
(14, 73, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `medico`
--

CREATE TABLE `medico` (
  `id` int(11) NOT NULL,
  `id_funcionario` int(11) NOT NULL,
  `crm` varchar(11) NOT NULL,
  `id_uf_crm` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `medico`
--

INSERT INTO `medico` (`id`, `id_funcionario`, `crm`, `id_uf_crm`) VALUES
(5, 14, '56156', 29);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `id_pessoa` int(11) NOT NULL,
  `id_convenio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `pais`
--

CREATE TABLE `pais` (
  `id` int(11) NOT NULL,
  `pais` varchar(100) NOT NULL,
  `sigla` varchar(2) NOT NULL,
  `cod_ibge` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pais`
--

INSERT INTO `pais` (`id`, `pais`, `sigla`, `cod_ibge`) VALUES
(1, 'Brasil', 'BR', 55);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pessoas`
--

CREATE TABLE `pessoas` (
  `id` int(11) NOT NULL,
  `nome` varchar(200) NOT NULL,
  `ender` varchar(200) NOT NULL,
  `telefone` varchar(20) DEFAULT NULL,
  `cpf` varchar(14) DEFAULT NULL,
  `pis` varchar(14) DEFAULT NULL,
  `id_tipo` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pessoas`
--

INSERT INTO `pessoas` (`id`, `nome`, `ender`, `telefone`, `cpf`, `pis`, `id_tipo`) VALUES
(49, 'asmdlkamsdkl', 'aklsdmaklsdm', '+32 (12) 3 1231-3212', '132.165.123-15', '123.15612.31-4', 2),
(50, 'alskdmakl', 'kalsmdkla', '+61 (56) 1 5156-1561', '561.651.651-65', '156.15615.61-5', 2),
(51, 'klasmdkl', 'klamsdkl', '+54 (65) 4 5815-6156', '156.156.156-15', '156.15615.61-5', 2),
(69, 'aksdkla', 'lkasmd', '+65 (16) 5 1561-6515', '156.156.156-15', '156.15615.61-6', 2),
(70, 'asdmlkadmkl', 'lkamslkadmkl', '+87 (48) 9 1951-9616', '156.156.156-15', '561.65156.15-6', 2),
(73, 'aksdmakl', 'laksmkladm', '+89 (48) 9 4984-98', '489.489.489-48', '984.89848.98', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabelas`
--

CREATE TABLE `tabelas` (
  `id` int(11) NOT NULL,
  `nomeTabela` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tabelas`
--

INSERT INTO `tabelas` (`id`, `nomeTabela`) VALUES
(1, 'cargos'),
(2, 'classes'),
(3, 'convenios'),
(4, 'farmaceutico'),
(5, 'funcionario'),
(6, 'medico'),
(7, 'pacientes'),
(8, 'pais'),
(9, 'pessoas'),
(10, 'tabelas'),
(11, 'tabelas_coluna'),
(12, 'tipo_pessoa'),
(13, 'uf'),
(14, 'usuarios');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tabelas_coluna`
--

CREATE TABLE `tabelas_coluna` (
  `id` int(11) NOT NULL,
  `nome` varchar(100) NOT NULL,
  `tamanho` int(11) NOT NULL,
  `decimais` int(11) DEFAULT NULL,
  `id_tabela` int(11) NOT NULL,
  `id_tipo` int(11) NOT NULL,
  `obrigatorio` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tabelas_coluna`
--

INSERT INTO `tabelas_coluna` (`id`, `nome`, `tamanho`, `decimais`, `id_tabela`, `id_tipo`, `obrigatorio`) VALUES
(1, 'cpf', 11, NULL, 9, 2, 1),
(2, 'ender', 200, NULL, 9, 2, 1),
(3, 'id_tipo', 1, NULL, 9, 6, 1),
(4, 'nome', 200, NULL, 9, 2, 1),
(5, 'pis', 11, NULL, 9, 2, 1),
(6, 'telefone', 15, NULL, 9, 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_coluna`
--

CREATE TABLE `tipo_coluna` (
  `id` int(11) NOT NULL,
  `tipo` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tipo_coluna`
--

INSERT INTO `tipo_coluna` (`id`, `tipo`) VALUES
(1, 'data'),
(2, 'texto'),
(3, 'arquivo'),
(4, 'inteiro'),
(5, 'decimal'),
(6, 'referencia');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tipo_pessoa`
--

CREATE TABLE `tipo_pessoa` (
  `id` int(11) NOT NULL,
  `tipo` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `tipo_pessoa`
--

INSERT INTO `tipo_pessoa` (`id`, `tipo`) VALUES
(2, 'farmaceutico'),
(4, 'funcionario'),
(1, 'medico'),
(3, 'paciente');

-- --------------------------------------------------------

--
-- Estrutura da tabela `uf`
--

CREATE TABLE `uf` (
  `id` int(11) NOT NULL,
  `id_pais` int(11) NOT NULL,
  `uf` varchar(100) NOT NULL,
  `cod_ibge` int(11) NOT NULL,
  `sigla` varchar(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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

CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL,
  `id_pessoa` int(11) NOT NULL,
  `usuario` varchar(100) DEFAULT NULL,
  `senha` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `usuarios`
--

INSERT INTO `usuarios` (`id`, `id_pessoa`, `usuario`, `senha`) VALUES
(22, 49, 'teste', 'asdwasd'),
(44, 69, 'asdwasdw', 'asdwasdw'),
(45, 70, 'aaa', 'aaa'),
(48, 73, 'bbb', 'bbb');

--
-- Índices para tabelas despejadas
--

--
-- Índices para tabela `cargos`
--
ALTER TABLE `cargos`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `classes`
--
ALTER TABLE `classes`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `nome` (`nome`),
  ADD KEY `extends` (`extends`);

--
-- Índices para tabela `convenios`
--
ALTER TABLE `convenios`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `farmaceutico`
--
ALTER TABLE `farmaceutico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_funcionario` (`id_funcionario`),
  ADD KEY `id_uf_crf` (`id_uf_crf`);

--
-- Índices para tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_cargo` (`id_cargo`),
  ADD KEY `id_pessoa` (`id_pessoa`);

--
-- Índices para tabela `medico`
--
ALTER TABLE `medico`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_funcionario` (`id_funcionario`),
  ADD KEY `id_uf_crm` (`id_uf_crm`);

--
-- Índices para tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_pessoa` (`id_pessoa`),
  ADD KEY `id_convenio` (`id_convenio`);

--
-- Índices para tabela `pais`
--
ALTER TABLE `pais`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sigla` (`sigla`,`cod_ibge`);

--
-- Índices para tabela `pessoas`
--
ALTER TABLE `pessoas`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tipo` (`id_tipo`);

--
-- Índices para tabela `tabelas`
--
ALTER TABLE `tabelas`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tabelas_coluna`
--
ALTER TABLE `tabelas_coluna`
  ADD PRIMARY KEY (`id`),
  ADD KEY `id_tabela` (`id_tabela`),
  ADD KEY `id_tipo` (`id_tipo`);

--
-- Índices para tabela `tipo_coluna`
--
ALTER TABLE `tipo_coluna`
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `tipo_pessoa`
--
ALTER TABLE `tipo_pessoa`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `tipo` (`tipo`);

--
-- Índices para tabela `uf`
--
ALTER TABLE `uf`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `sigla` (`sigla`,`id_pais`),
  ADD KEY `id_pais` (`id_pais`);

--
-- Índices para tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `usuario` (`usuario`),
  ADD KEY `id_pessoa` (`id_pessoa`);

--
-- AUTO_INCREMENT de tabelas despejadas
--

--
-- AUTO_INCREMENT de tabela `cargos`
--
ALTER TABLE `cargos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `classes`
--
ALTER TABLE `classes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT de tabela `convenios`
--
ALTER TABLE `convenios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `farmaceutico`
--
ALTER TABLE `farmaceutico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `medico`
--
ALTER TABLE `medico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT de tabela `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `pais`
--
ALTER TABLE `pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=75;

--
-- AUTO_INCREMENT de tabela `tabelas`
--
ALTER TABLE `tabelas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT de tabela `tabelas_coluna`
--
ALTER TABLE `tabelas_coluna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tipo_coluna`
--
ALTER TABLE `tipo_coluna`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT de tabela `tipo_pessoa`
--
ALTER TABLE `tipo_pessoa`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `uf`
--
ALTER TABLE `uf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=50;

--
-- Restrições para despejos de tabelas
--

--
-- Limitadores para a tabela `classes`
--
ALTER TABLE `classes`
  ADD CONSTRAINT `classes_ibfk_1` FOREIGN KEY (`extends`) REFERENCES `classes` (`nome`);

--
-- Limitadores para a tabela `farmaceutico`
--
ALTER TABLE `farmaceutico`
  ADD CONSTRAINT `farmaceutico_ibfk_1` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id`),
  ADD CONSTRAINT `farmaceutico_ibfk_2` FOREIGN KEY (`id_uf_crf`) REFERENCES `uf` (`id`);

--
-- Limitadores para a tabela `funcionario`
--
ALTER TABLE `funcionario`
  ADD CONSTRAINT `funcionario_ibfk_1` FOREIGN KEY (`id_cargo`) REFERENCES `cargos` (`id`),
  ADD CONSTRAINT `funcionario_ibfk_2` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoas` (`id`);

--
-- Limitadores para a tabela `medico`
--
ALTER TABLE `medico`
  ADD CONSTRAINT `medico_ibfk_1` FOREIGN KEY (`id_funcionario`) REFERENCES `funcionario` (`id`),
  ADD CONSTRAINT `medico_ibfk_2` FOREIGN KEY (`id_uf_crm`) REFERENCES `uf` (`id`);

--
-- Limitadores para a tabela `pacientes`
--
ALTER TABLE `pacientes`
  ADD CONSTRAINT `pacientes_ibfk_1` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoas` (`id`),
  ADD CONSTRAINT `pacientes_ibfk_2` FOREIGN KEY (`id_convenio`) REFERENCES `convenios` (`id`);

--
-- Limitadores para a tabela `pessoas`
--
ALTER TABLE `pessoas`
  ADD CONSTRAINT `pessoas_ibfk_1` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_pessoa` (`id`);

--
-- Limitadores para a tabela `tabelas_coluna`
--
ALTER TABLE `tabelas_coluna`
  ADD CONSTRAINT `tabelas_coluna_ibfk_1` FOREIGN KEY (`id_tabela`) REFERENCES `tabelas` (`id`),
  ADD CONSTRAINT `tabelas_coluna_ibfk_3` FOREIGN KEY (`id_tipo`) REFERENCES `tipo_coluna` (`id`);

--
-- Limitadores para a tabela `uf`
--
ALTER TABLE `uf`
  ADD CONSTRAINT `uf_ibfk_1` FOREIGN KEY (`id_pais`) REFERENCES `pais` (`id`);

--
-- Limitadores para a tabela `usuarios`
--
ALTER TABLE `usuarios`
  ADD CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`id_pessoa`) REFERENCES `pessoas` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
