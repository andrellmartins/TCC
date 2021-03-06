-- phpMyAdmin SQL Dump
-- version 5.0.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Tempo de geração: 01-Jun-2022 às 01:36
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
(26, 12, '26516', 29),
(27, 15, '21321', 29);

-- --------------------------------------------------------

--
-- Estrutura da tabela `funcionario`
--

CREATE TABLE `funcionario` (
  `id` int(11) NOT NULL,
  `id_pessoa` int(11) NOT NULL,
  `id_cargo` int(11) NOT NULL,
  `salario` float NOT NULL,
  `pis` varchar(14) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `funcionario`
--

INSERT INTO `funcionario` (`id`, `id_pessoa`, `id_cargo`, `salario`, `pis`) VALUES
(1, 49, 4, 0, ''),
(2, 50, 4, 0, ''),
(3, 51, 4, 0, ''),
(11, 69, 4, 0, ''),
(12, 70, 4, 0, ''),
(14, 73, 2, 0, ''),
(15, 76, 3, 0, '156.15615.61-5'),
(16, 78, 2, 0, '156.15615.61-5'),
(17, 79, 2, 0, '156.15615.61-5');

-- --------------------------------------------------------

--
-- Estrutura da tabela `lote`
--

CREATE TABLE `lote` (
  `id` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `validade` date NOT NULL,
  `lote` varchar(40) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Estrutura da tabela `medicamentos`
--

CREATE TABLE `medicamentos` (
  `id` int(11) NOT NULL,
  `id_produto` int(11) NOT NULL,
  `laboratorio` varchar(250) NOT NULL,
  `principio_ativo` varchar(400) NOT NULL,
  `nome_comercial` varchar(250) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(5, 14, '56156', 29),
(6, 16, '56156', 29),
(7, 17, '56156', 29);

-- --------------------------------------------------------

--
-- Estrutura da tabela `pacientes`
--

CREATE TABLE `pacientes` (
  `id` int(11) NOT NULL,
  `id_pessoa` int(11) NOT NULL,
  `id_convenio` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pacientes`
--

INSERT INTO `pacientes` (`id`, `id_pessoa`, `id_convenio`) VALUES
(2, 81, 1),
(3, 82, 1),
(4, 83, 1);

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
  `telefone` varchar(20) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `data_nasc` date NOT NULL,
  `sexo` varchar(10) NOT NULL,
  `deletado` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Extraindo dados da tabela `pessoas`
--

INSERT INTO `pessoas` (`id`, `nome`, `ender`, `telefone`, `cpf`, `data_nasc`, `sexo`, `deletado`) VALUES
(49, 'asmdlkamsdkl', 'aklsdmaklsdm', '+32 (12) 3 1231-3212', '132.165.123-15', '0000-00-00', '', 1),
(50, 'alskdmakl', 'kalsmdkla', '+61 (56) 1 5156-1561', '561.651.651-65', '0000-00-00', '', 1),
(51, 'klasmdkl', 'klamsdkl', '+54 (65) 4 5815-6156', '156.156.156-15', '0000-00-00', '', 0),
(69, 'aksdkla', 'lkasmd', '+65 (16) 5 1561-6515', '156.156.156-15', '0000-00-00', '', 0),
(70, 'asdmlkadmkl', 'lkamslkadmkl', '+87 (48) 9 1951-9616', '156.156.156-15', '0000-00-00', '', 0),
(73, 'aksdmakl', 'laksmkladm', '+89 (48) 9 4984-98', '489.489.489-48', '0000-00-00', '', 0),
(76, 'teste', 'aslkdmakldsmklmlk', '+16 (51) 1 6510-3215', '132.041.023-15', '0000-00-00', '', 0),
(78, 'teste', 'teste', '+32 (12) 3 1231-3212', '000.000.000-0', '0000-00-00', '', 0),
(79, 'teste', 'teste', '+32 (12) 3 1231-3212', '000.000.000-0', '0000-00-00', '', 0),
(81, 'carlos', 'rua do padeiro, 123', '+41 (99) 9 9999-9999', '009.086.669-00', '0000-00-00', '', 1),
(82, 'aaa', 'aaa', '+32 (15) 6 3216-5132', '566.951.289-87', '0000-00-00', '', 1),
(83, 'aklsmkadm', 'lkamsdklamdklm', '+62 (93) 1 9815-6189', '009.086.669-00', '0000-00-00', '', 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

CREATE TABLE `produtos` (
  `id` int(11) NOT NULL,
  `id_func_cadastro` int(11) NOT NULL,
  `descrição` varchar(250) NOT NULL,
  `data_cadastro` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

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
(48, 73, 'bbb', 'bbb'),
(51, 76, 'carlos', 'carlos'),
(53, 78, 'teste3', 'teste3'),
(54, 79, 'asdw', 'asdw'),
(56, 81, 'carlos1', 'carlos1'),
(57, 82, 'asdwa', 'asdwa'),
(58, 83, '231asd231asd', 'as32d1a23sd1');

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
-- Índices para tabela `lote`
--
ALTER TABLE `lote`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lote_cadastro` (`id_produto`);

--
-- Índices para tabela `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `medicamento_produto` (`id_produto`);

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
  ADD PRIMARY KEY (`id`);

--
-- Índices para tabela `produtos`
--
ALTER TABLE `produtos`
  ADD PRIMARY KEY (`id`),
  ADD KEY `func_cadastro` (`id_func_cadastro`);

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT de tabela `funcionario`
--
ALTER TABLE `funcionario`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT de tabela `lote`
--
ALTER TABLE `lote`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `medicamentos`
--
ALTER TABLE `medicamentos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `medico`
--
ALTER TABLE `medico`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT de tabela `pacientes`
--
ALTER TABLE `pacientes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT de tabela `pais`
--
ALTER TABLE `pais`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT de tabela `pessoas`
--
ALTER TABLE `pessoas`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=84;

--
-- AUTO_INCREMENT de tabela `produtos`
--
ALTER TABLE `produtos`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT de tabela `uf`
--
ALTER TABLE `uf`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=55;

--
-- AUTO_INCREMENT de tabela `usuarios`
--
ALTER TABLE `usuarios`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=59;

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
-- Limitadores para a tabela `lote`
--
ALTER TABLE `lote`
  ADD CONSTRAINT `lote_cadastro` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`);

--
-- Limitadores para a tabela `medicamentos`
--
ALTER TABLE `medicamentos`
  ADD CONSTRAINT `medicamento_produto` FOREIGN KEY (`id_produto`) REFERENCES `produtos` (`id`);

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
-- Limitadores para a tabela `produtos`
--
ALTER TABLE `produtos`
  ADD CONSTRAINT `id_func_produto_funcionario` FOREIGN KEY (`id_func_cadastro`) REFERENCES `funcionario` (`id`);

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
