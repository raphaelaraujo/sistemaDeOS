-- phpMyAdmin SQL Dump
-- version 4.8.4
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: 19-Mar-2021 às 17:57
-- Versão do servidor: 5.7.24
-- versão do PHP: 5.6.40

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ordem`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `categorias`
--

DROP TABLE IF EXISTS `categorias`;
CREATE TABLE IF NOT EXISTS `categorias` (
  `categoria_id` int(11) NOT NULL AUTO_INCREMENT,
  `categoria_nome` varchar(45) NOT NULL,
  `categoria_ativa` tinyint(1) DEFAULT NULL,
  `categoria_data_alteracao` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`categoria_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `categorias`
--

INSERT INTO `categorias` (`categoria_id`, `categoria_nome`, `categoria_ativa`, `categoria_data_alteracao`) VALUES
(1, 'Games', 1, '2021-03-19 11:54:24'),
(3, 'Pneu', 1, '2021-03-19 15:27:10');

-- --------------------------------------------------------

--
-- Estrutura da tabela `clientes`
--

DROP TABLE IF EXISTS `clientes`;
CREATE TABLE IF NOT EXISTS `clientes` (
  `cliente_id` int(11) NOT NULL AUTO_INCREMENT,
  `cliente_data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `cliente_tipo` tinyint(1) DEFAULT NULL,
  `cliente_nome` varchar(45) NOT NULL,
  `cliente_sobrenome` varchar(150) NOT NULL,
  `cliente_data_nascimento` date NOT NULL,
  `cliente_cpf_cnpj` varchar(20) NOT NULL,
  `cliente_rg_ie` varchar(20) NOT NULL,
  `cliente_email` varchar(50) NOT NULL,
  `cliente_telefone` varchar(20) NOT NULL,
  `cliente_celular` varchar(20) NOT NULL,
  `cliente_cep` varchar(10) NOT NULL,
  `cliente_endereco` varchar(155) NOT NULL,
  `cliente_numero_endereco` varchar(20) NOT NULL,
  `cliente_bairro` varchar(45) NOT NULL,
  `cliente_complemento` varchar(145) NOT NULL,
  `cliente_cidade` varchar(105) NOT NULL,
  `cliente_estado` varchar(2) NOT NULL,
  `cliente_ativo` tinyint(1) NOT NULL,
  `cliente_obs` tinytext,
  `cliente_data_alteracao` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`cliente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `clientes`
--

INSERT INTO `clientes` (`cliente_id`, `cliente_data_cadastro`, `cliente_tipo`, `cliente_nome`, `cliente_sobrenome`, `cliente_data_nascimento`, `cliente_cpf_cnpj`, `cliente_rg_ie`, `cliente_email`, `cliente_telefone`, `cliente_celular`, `cliente_cep`, `cliente_endereco`, `cliente_numero_endereco`, `cliente_bairro`, `cliente_complemento`, `cliente_cidade`, `cliente_estado`, `cliente_ativo`, `cliente_obs`, `cliente_data_alteracao`) VALUES
(1, '2020-09-03 17:58:27', 1, 'Fabio Raphael', 'Araújo Furtado', '1993-05-17', '015.780.752-54', '4585369', 'raphaelaraujo075@gmail.com', '(91) 8064-7336', '(91) 98064-7336', '66640-445', 'Rua Chico Mendes (Res Carmelândia)', '17', 'Mangueirãi', 'Carmelândia', 'Belém', 'PA', 0, 'Teste de edit', '2021-03-12 14:32:00'),
(2, '2021-03-12 14:29:11', 1, 'Arthur', 'Furtado', '1990-01-19', '010.063.860-09', '4545786', 'arthur@gmail.com', '(91) 3279-2183', '(91) 96484-6446', '66690-395', 'Rua Oswaldo Cruz', '600', 'Águas Lindas', 'Cond. Porta do Sol', 'BELEM', 'PA', 1, 'Cliente tem carro vermelho bonito', '2021-03-12 14:29:11'),
(3, '2021-03-12 14:31:50', 2, 'Softbean', 'Inc.', '2019-01-20', '38.853.034/0001-00', '123', 'contato@softbean.com.br', '(91) 3279-2188', '(91) 98584-8566', '66690-395', 'Rua Oswaldo Cruz', '600', 'Águas Lindas', 'Cond. Porta do Sol', 'BELEM', 'PA', 1, 'Cliente desenvolve sites e sistemas web', '2021-03-12 14:31:50');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contas_pagar`
--

DROP TABLE IF EXISTS `contas_pagar`;
CREATE TABLE IF NOT EXISTS `contas_pagar` (
  `conta_pagar_id` int(11) NOT NULL AUTO_INCREMENT,
  `conta_pagar_fornecedor_id` int(11) DEFAULT NULL,
  `conta_pagar_data_vencimento` date DEFAULT NULL,
  `conta_pagar_data_pagamento` datetime DEFAULT NULL,
  `conta_pagar_valor` varchar(15) DEFAULT NULL,
  `conta_pagar_status` tinyint(1) DEFAULT NULL,
  `conta_pagar_obs` tinytext,
  `conta_pagar_data_alteracao` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`conta_pagar_id`),
  KEY `fk_conta_pagar_id_fornecedor` (`conta_pagar_fornecedor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=latin1 COMMENT='		';

--
-- Extraindo dados da tabela `contas_pagar`
--

INSERT INTO `contas_pagar` (`conta_pagar_id`, `conta_pagar_fornecedor_id`, `conta_pagar_data_vencimento`, `conta_pagar_data_pagamento`, `conta_pagar_valor`, `conta_pagar_status`, `conta_pagar_obs`, `conta_pagar_data_alteracao`) VALUES
(1, 2, '2021-03-13', '2021-03-12 00:00:00', '800.00', 1, NULL, '2021-03-12 20:45:18'),
(2, 2, '2021-03-12', NULL, '500.00', 0, NULL, '2021-03-12 20:45:22'),
(3, 1, '2021-03-11', NULL, '300.00', 0, NULL, '2021-03-12 20:45:26'),
(4, 1, '2021-03-16', NULL, '100.00', 0, NULL, '2021-03-12 20:45:30'),
(5, 2, '2021-03-13', NULL, '100.00', 0, NULL, '2021-03-12 20:47:03');

-- --------------------------------------------------------

--
-- Estrutura da tabela `contas_receber`
--

DROP TABLE IF EXISTS `contas_receber`;
CREATE TABLE IF NOT EXISTS `contas_receber` (
  `conta_receber_id` int(11) NOT NULL AUTO_INCREMENT,
  `conta_receber_cliente_id` int(11) NOT NULL,
  `conta_receber_data_vencimento` date DEFAULT NULL,
  `conta_receber_data_pagamento` datetime DEFAULT NULL,
  `conta_receber_valor` varchar(20) DEFAULT NULL,
  `conta_receber_status` tinyint(1) DEFAULT NULL,
  `conta_receber_obs` tinytext,
  `conta_receber_data_alteracao` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`conta_receber_id`),
  KEY `fk_conta_receber_id_cliente` (`conta_receber_cliente_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `contas_receber`
--

INSERT INTO `contas_receber` (`conta_receber_id`, `conta_receber_cliente_id`, `conta_receber_data_vencimento`, `conta_receber_data_pagamento`, `conta_receber_valor`, `conta_receber_status`, `conta_receber_obs`, `conta_receber_data_alteracao`) VALUES
(1, 1, '2020-02-28', '2020-02-28 17:48:21', '150,226.22', 0, NULL, '2020-02-29 01:36:29'),
(2, 2, '2020-02-21', '2020-02-28 18:33:19', '350.00', 1, NULL, '2020-02-28 21:33:19'),
(3, 3, '2020-02-28', '2020-02-28 17:22:47', '56.00', 1, NULL, '2020-02-28 20:22:47');

-- --------------------------------------------------------

--
-- Estrutura da tabela `formas_pagamentos`
--

DROP TABLE IF EXISTS `formas_pagamentos`;
CREATE TABLE IF NOT EXISTS `formas_pagamentos` (
  `forma_pagamento_id` int(11) NOT NULL AUTO_INCREMENT,
  `forma_pagamento_nome` varchar(45) DEFAULT NULL,
  `forma_pagamento_aceita_parc` tinyint(1) DEFAULT NULL,
  `forma_pagamento_ativa` tinyint(1) DEFAULT NULL,
  `forma_pagamento_data_alteracao` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`forma_pagamento_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `formas_pagamentos`
--

INSERT INTO `formas_pagamentos` (`forma_pagamento_id`, `forma_pagamento_nome`, `forma_pagamento_aceita_parc`, `forma_pagamento_ativa`, `forma_pagamento_data_alteracao`) VALUES
(1, 'Cartão de crédito', 0, 1, '2020-02-14 23:46:46'),
(2, 'Dinheiro', 0, 1, '2020-01-29 21:43:54'),
(3, 'Boleto bancário', 1, 0, '2020-01-29 21:44:14');

-- --------------------------------------------------------

--
-- Estrutura da tabela `fornecedores`
--

DROP TABLE IF EXISTS `fornecedores`;
CREATE TABLE IF NOT EXISTS `fornecedores` (
  `fornecedor_id` int(11) NOT NULL AUTO_INCREMENT,
  `fornecedor_data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `fornecedor_razao` varchar(200) DEFAULT NULL,
  `fornecedor_nome_fantasia` varchar(145) DEFAULT NULL,
  `fornecedor_cnpj` varchar(20) DEFAULT NULL,
  `fornecedor_ie` varchar(20) DEFAULT NULL,
  `fornecedor_telefone` varchar(20) DEFAULT NULL,
  `fornecedor_celular` varchar(20) DEFAULT NULL,
  `fornecedor_email` varchar(100) DEFAULT NULL,
  `fornecedor_contato` varchar(45) DEFAULT NULL,
  `fornecedor_cep` varchar(10) DEFAULT NULL,
  `fornecedor_endereco` varchar(145) DEFAULT NULL,
  `fornecedor_numero_endereco` varchar(20) DEFAULT NULL,
  `fornecedor_bairro` varchar(45) DEFAULT NULL,
  `fornecedor_complemento` varchar(45) DEFAULT NULL,
  `fornecedor_cidade` varchar(45) DEFAULT NULL,
  `fornecedor_estado` varchar(2) DEFAULT NULL,
  `fornecedor_ativo` tinyint(1) DEFAULT NULL,
  `fornecedor_obs` tinytext,
  `fornecedor_data_alteracao` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`fornecedor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `fornecedores`
--

INSERT INTO `fornecedores` (`fornecedor_id`, `fornecedor_data_cadastro`, `fornecedor_razao`, `fornecedor_nome_fantasia`, `fornecedor_cnpj`, `fornecedor_ie`, `fornecedor_telefone`, `fornecedor_celular`, `fornecedor_email`, `fornecedor_contato`, `fornecedor_cep`, `fornecedor_endereco`, `fornecedor_numero_endereco`, `fornecedor_bairro`, `fornecedor_complemento`, `fornecedor_cidade`, `fornecedor_estado`, `fornecedor_ativo`, `fornecedor_obs`, `fornecedor_data_alteracao`) VALUES
(1, '2020-09-03 15:50:02', 'Yra Tecnologia', 'Yra Inc - New', '55.467.821/0001-24', '809.307.365.959', '(91) 3279-2183', '(91) 98064-7336', 'yrainc@gmail.com', 'Fulano de Tal', '66640-445', 'Rua Chico Mendes', '17', 'Mangueirão', 'Conj. Carmelândia', 'Belém', 'PA', 1, 'Fornecedor vende produtos de tecnologia voltadas para desenvolvimento web', '2021-03-19 13:50:01'),
(2, '2021-03-12 14:40:09', 'Softbean', 'Softbean', '38.853.034/0001-00', '456789', '(91) 3279-2189', '(91) 98064-7335', 'contato@softbean.com.br', NULL, '66690-395', 'Rua Oswaldo Cruz', '600', 'Águas Lindas', 'Cond. Porta do Sol', 'Belém', 'PA', 0, 'Cliente desenvolve e da suporte a sistema web', '2021-03-19 13:52:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `groups`
--

DROP TABLE IF EXISTS `groups`;
CREATE TABLE IF NOT EXISTS `groups` (
  `id` mediumint(8) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `description` varchar(100) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `groups`
--

INSERT INTO `groups` (`id`, `name`, `description`) VALUES
(1, 'admin', 'Administrator'),
(2, 'vendedor', 'Vendedor');

-- --------------------------------------------------------

--
-- Estrutura da tabela `login_attempts`
--

DROP TABLE IF EXISTS `login_attempts`;
CREATE TABLE IF NOT EXISTS `login_attempts` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `login` varchar(100) NOT NULL,
  `time` int(11) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Estrutura da tabela `marcas`
--

DROP TABLE IF EXISTS `marcas`;
CREATE TABLE IF NOT EXISTS `marcas` (
  `marca_id` int(11) NOT NULL AUTO_INCREMENT,
  `marca_nome` varchar(45) NOT NULL,
  `marca_ativa` tinyint(1) DEFAULT NULL,
  `marca_data_alteracao` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`marca_id`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `marcas`
--

INSERT INTO `marcas` (`marca_id`, `marca_nome`, `marca_ativa`, `marca_data_alteracao`) VALUES
(5, 'GoodYear', 1, '2021-03-19 13:42:32'),
(6, 'HP', 1, '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordem_tem_servicos`
--

DROP TABLE IF EXISTS `ordem_tem_servicos`;
CREATE TABLE IF NOT EXISTS `ordem_tem_servicos` (
  `ordem_ts_id` int(11) NOT NULL AUTO_INCREMENT,
  `ordem_ts_id_servico` int(11) DEFAULT NULL,
  `ordem_ts_id_ordem_servico` int(11) DEFAULT NULL,
  `ordem_ts_quantidade` int(11) DEFAULT NULL,
  `ordem_ts_valor_unitario` varchar(45) DEFAULT NULL,
  `ordem_ts_valor_desconto` varchar(45) DEFAULT NULL,
  `ordem_ts_valor_total` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`ordem_ts_id`),
  KEY `fk_ordem_ts_id_servico` (`ordem_ts_id_servico`),
  KEY `fk_ordem_ts_id_ordem_servico` (`ordem_ts_id_ordem_servico`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1 COMMENT='Tabela de relacionamento entre as tabelas servicos e ordem_servico';

--
-- Extraindo dados da tabela `ordem_tem_servicos`
--

INSERT INTO `ordem_tem_servicos` (`ordem_ts_id`, `ordem_ts_id_servico`, `ordem_ts_id_ordem_servico`, `ordem_ts_quantidade`, `ordem_ts_valor_unitario`, `ordem_ts_valor_desconto`, `ordem_ts_valor_total`) VALUES
(1, 1, 1, 1, '80.00', '0', '80.00'),
(2, 2, 2, 4, '80.00', '0', '320.00'),
(3, 3, 3, 1, '120.00', '0', '120.00');

-- --------------------------------------------------------

--
-- Estrutura da tabela `ordens_servicos`
--

DROP TABLE IF EXISTS `ordens_servicos`;
CREATE TABLE IF NOT EXISTS `ordens_servicos` (
  `ordem_servico_id` int(11) NOT NULL AUTO_INCREMENT,
  `ordem_servico_forma_pagamento_id` int(11) DEFAULT NULL,
  `ordem_servico_cliente_id` int(11) DEFAULT NULL,
  `ordem_servico_data_emissao` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `ordem_servico_data_conclusao` varchar(100) DEFAULT NULL,
  `ordem_servico_equipamento` varchar(80) DEFAULT NULL,
  `ordem_servico_marca_equipamento` varchar(80) DEFAULT NULL,
  `ordem_servico_modelo_equipamento` varchar(80) DEFAULT NULL,
  `ordem_servico_acessorios` tinytext,
  `ordem_servico_defeito` tinytext,
  `ordem_servico_valor_desconto` varchar(25) DEFAULT NULL,
  `ordem_servico_valor_total` varchar(25) DEFAULT NULL,
  `ordem_servico_status` tinyint(1) DEFAULT NULL,
  `ordem_servico_obs` tinytext,
  `ordem_servico_data_alteracao` timestamp NULL DEFAULT NULL ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`ordem_servico_id`),
  KEY `fk_ordem_servico_id_cliente` (`ordem_servico_cliente_id`),
  KEY `fk_ordem_servico_id_forma_pagto` (`ordem_servico_forma_pagamento_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `ordens_servicos`
--

INSERT INTO `ordens_servicos` (`ordem_servico_id`, `ordem_servico_forma_pagamento_id`, `ordem_servico_cliente_id`, `ordem_servico_data_emissao`, `ordem_servico_data_conclusao`, `ordem_servico_equipamento`, `ordem_servico_marca_equipamento`, `ordem_servico_modelo_equipamento`, `ordem_servico_acessorios`, `ordem_servico_defeito`, `ordem_servico_valor_desconto`, `ordem_servico_valor_total`, `ordem_servico_status`, `ordem_servico_obs`, `ordem_servico_data_alteracao`) VALUES
(1, 1, 1, '2020-02-14 20:30:35', NULL, 'Fone de ouvido', 'Awell', 'AV1801', 'Mouse e carregador', 'Não sai aúdio no lado esquerdo', 'R$ 0.00', '490.00', 1, '', '2021-03-12 22:27:20'),
(2, 2, 2, '2020-02-14 20:48:53', NULL, 'Notebook gamer', 'Awell', 'FONE01', 'Mouse e carregador', 'Não carrega', 'R$ 0.00', '80.00', 1, '', '2021-03-12 22:28:21'),
(3, 1, 3, '2020-02-17 23:53:26', NULL, 'Notebook Sony', 'Sony', 'FONE01', 'Mouse e carregador', 'Tela trincada', 'R$ 0.00', '120.00', 0, 'Vem buscar pela manhã', '2020-02-28 22:51:34');

-- --------------------------------------------------------

--
-- Estrutura da tabela `produtos`
--

DROP TABLE IF EXISTS `produtos`;
CREATE TABLE IF NOT EXISTS `produtos` (
  `produto_id` int(11) NOT NULL AUTO_INCREMENT,
  `produto_codigo` varchar(45) DEFAULT NULL,
  `produto_data_cadastro` datetime DEFAULT NULL,
  `produto_categoria_id` int(11) NOT NULL,
  `produto_marca_id` int(11) NOT NULL,
  `produto_fornecedor_id` int(11) NOT NULL,
  `produto_descricao` varchar(145) DEFAULT NULL,
  `produto_unidade` varchar(25) DEFAULT NULL,
  `produto_codigo_barras` varchar(45) DEFAULT NULL,
  `produto_ncm` varchar(15) DEFAULT NULL,
  `produto_preco_custo` varchar(45) DEFAULT NULL,
  `produto_preco_venda` varchar(45) DEFAULT NULL,
  `produto_estoque_minimo` varchar(10) DEFAULT NULL,
  `produto_qtde_estoque` varchar(10) DEFAULT NULL,
  `produto_ativo` tinyint(1) DEFAULT NULL,
  `produto_obs` tinytext,
  `produto_data_alteracao` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00' ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`produto_id`),
  KEY `produto_categoria_id` (`produto_categoria_id`,`produto_marca_id`,`produto_fornecedor_id`),
  KEY `fk_produto_marca_id` (`produto_marca_id`),
  KEY `fk_produto_forncedor_id` (`produto_fornecedor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `produtos`
--

INSERT INTO `produtos` (`produto_id`, `produto_codigo`, `produto_data_cadastro`, `produto_categoria_id`, `produto_marca_id`, `produto_fornecedor_id`, `produto_descricao`, `produto_unidade`, `produto_codigo_barras`, `produto_ncm`, `produto_preco_custo`, `produto_preco_venda`, `produto_estoque_minimo`, `produto_qtde_estoque`, `produto_ativo`, `produto_obs`, `produto_data_alteracao`) VALUES
(1, '72495380', NULL, 3, 5, 1, 'Notebook gamer', 'UN', '4545', '5656', '1.800,00', '15.031,00', '2', '10', 1, 'Produto já está auditado', '2021-03-19 15:31:01'),
(2, '50412637', NULL, 1, 5, 1, 'Fone de ouvido gamer', 'UN', '9999', '9999', '112,00', '125.844,00', '1', '46', 1, '', '2021-03-19 15:30:52'),
(3, '41697502', NULL, 1, 5, 1, 'Mouse usb', 'UN', '9999', '5555', '9,99', '15,22', '2', '3', 1, '', '2021-03-19 13:41:52');

-- --------------------------------------------------------

--
-- Estrutura da tabela `servicos`
--

DROP TABLE IF EXISTS `servicos`;
CREATE TABLE IF NOT EXISTS `servicos` (
  `servico_id` int(11) NOT NULL AUTO_INCREMENT,
  `servico_nome` varchar(145) DEFAULT NULL,
  `servico_preco` varchar(15) DEFAULT NULL,
  `servico_descricao` tinytext,
  `servico_ativo` tinyint(1) DEFAULT NULL,
  `servico_data_alteracao` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`servico_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `servicos`
--

INSERT INTO `servicos` (`servico_id`, `servico_nome`, `servico_preco`, `servico_descricao`, `servico_ativo`, `servico_data_alteracao`) VALUES
(1, 'Limpeza geral', '50,00', 'Lorem Ipsum é simplesmente uma simulação de texto da indústria tipográfica e de impressos, e vem sendo utilizado desde o século XVI, quando um impressor desconhecido pegou uma bandeja de tipos e os embaralhou para fazer um livro de modelos de tipos. Lorem', 1, '2021-03-18 13:25:02'),
(2, 'Solda elétrica', '80,00', 'Solda elétrica', 0, '2021-03-18 13:00:16'),
(3, 'Restauração de componentes', '120,00', 'Restauração de componentes', 1, '2020-02-13 22:11:29');

-- --------------------------------------------------------

--
-- Estrutura da tabela `sistema`
--

DROP TABLE IF EXISTS `sistema`;
CREATE TABLE IF NOT EXISTS `sistema` (
  `sistema_id` int(11) NOT NULL AUTO_INCREMENT,
  `sistema_razao_social` varchar(145) DEFAULT NULL,
  `sistema_nome_fantasia` varchar(145) DEFAULT NULL,
  `sistema_cnpj` varchar(25) DEFAULT NULL,
  `sistema_ie` varchar(25) DEFAULT NULL,
  `sistema_telefone_fixo` varchar(25) DEFAULT NULL,
  `sistema_telefone_movel` varchar(25) NOT NULL,
  `sistema_email` varchar(100) DEFAULT NULL,
  `sistema_site_url` varchar(100) DEFAULT NULL,
  `sistema_cep` varchar(25) DEFAULT NULL,
  `sistema_endereco` varchar(145) DEFAULT NULL,
  `sistema_numero` varchar(25) DEFAULT NULL,
  `sistema_cidade` varchar(45) DEFAULT NULL,
  `sistema_estado` varchar(2) DEFAULT NULL,
  `sistema_txt_ordem_servico` tinytext,
  `sistema_data_alteracao` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`sistema_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `sistema`
--

INSERT INTO `sistema` (`sistema_id`, `sistema_razao_social`, `sistema_nome_fantasia`, `sistema_cnpj`, `sistema_ie`, `sistema_telefone_fixo`, `sistema_telefone_movel`, `sistema_email`, `sistema_site_url`, `sistema_cep`, `sistema_endereco`, `sistema_numero`, `sistema_cidade`, `sistema_estado`, `sistema_txt_ordem_servico`, `sistema_data_alteracao`) VALUES
(1, 'System Ordem Inc.', 'Sistema de Ordem Now', '45.825.545/4554-55', '15-469019-8', '(91) 99999-9999', '(55) 55555-5555', 'ordemnow@contato.com.br', 'http://localhost/ordem/', '66666-666', 'Rua Oswaldo Cruz', '600', 'BELEM', 'PA', 'Nossa empresa é a sua marca', '2020-08-31 22:51:55');

-- --------------------------------------------------------

--
-- Estrutura da tabela `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `ip_address` varchar(45) NOT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `email` varchar(254) NOT NULL,
  `activation_selector` varchar(255) DEFAULT NULL,
  `activation_code` varchar(255) DEFAULT NULL,
  `forgotten_password_selector` varchar(255) DEFAULT NULL,
  `forgotten_password_code` varchar(255) DEFAULT NULL,
  `forgotten_password_time` int(11) UNSIGNED DEFAULT NULL,
  `remember_selector` varchar(255) DEFAULT NULL,
  `remember_code` varchar(255) DEFAULT NULL,
  `created_on` int(11) UNSIGNED NOT NULL,
  `last_login` int(11) UNSIGNED DEFAULT NULL,
  `active` tinyint(1) UNSIGNED DEFAULT NULL,
  `first_name` varchar(50) DEFAULT NULL,
  `last_name` varchar(50) DEFAULT NULL,
  `company` varchar(100) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_email` (`email`),
  UNIQUE KEY `uc_activation_selector` (`activation_selector`),
  UNIQUE KEY `uc_forgotten_password_selector` (`forgotten_password_selector`),
  UNIQUE KEY `uc_remember_selector` (`remember_selector`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users`
--

INSERT INTO `users` (`id`, `ip_address`, `username`, `password`, `email`, `activation_selector`, `activation_code`, `forgotten_password_selector`, `forgotten_password_code`, `forgotten_password_time`, `remember_selector`, `remember_code`, `created_on`, `last_login`, `active`, `first_name`, `last_name`, `company`, `phone`) VALUES
(1, '127.0.0.1', 'administrator', '$2y$12$hfjpKjYjXx0qTa9T96vFmuA05eJV6c3aPwzHOR/vsJ7T893fNhCOq', 'admin@admin.com', NULL, '', NULL, NULL, NULL, NULL, NULL, 1268889823, 1616152190, 1, 'Admin', 'istrator', 'ADMIN', '0'),
(2, '::1', 'raphaelaraujo075', '$2y$12$j6Vvc6lKFbA6ht8JYc7PWOzLBtGTvRwhqMfpnr34.bCjzVQp52Zce', 'raphaelaraujo075@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1597676523, 1599146846, 1, 'Raphael', 'Furtado', NULL, NULL),
(3, '::1', 'yasminpassinho', '$2y$10$s6FXEsNyppM.JEMOZ5fy..MXDHxeVZ5E7X6ifYWTX7dPNwrPCuHPe', 'yasminpassinho@gmail.com', NULL, NULL, NULL, NULL, NULL, NULL, NULL, 1597764478, 1598914524, 1, 'Yasmin', 'Furtado', NULL, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `users_groups`
--

DROP TABLE IF EXISTS `users_groups`;
CREATE TABLE IF NOT EXISTS `users_groups` (
  `id` int(11) UNSIGNED NOT NULL AUTO_INCREMENT,
  `user_id` int(11) UNSIGNED NOT NULL,
  `group_id` mediumint(8) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `uc_users_groups` (`user_id`,`group_id`),
  KEY `fk_users_groups_users1_idx` (`user_id`),
  KEY `fk_users_groups_groups1_idx` (`group_id`)
) ENGINE=InnoDB AUTO_INCREMENT=12 DEFAULT CHARSET=utf8;

--
-- Extraindo dados da tabela `users_groups`
--

INSERT INTO `users_groups` (`id`, `user_id`, `group_id`) VALUES
(4, 1, 1),
(10, 2, 1),
(11, 3, 2);

-- --------------------------------------------------------

--
-- Estrutura da tabela `vendedores`
--

DROP TABLE IF EXISTS `vendedores`;
CREATE TABLE IF NOT EXISTS `vendedores` (
  `vendedor_id` int(11) NOT NULL AUTO_INCREMENT,
  `vendedor_codigo` varchar(10) NOT NULL,
  `vendedor_data_cadastro` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `vendedor_nome_completo` varchar(145) NOT NULL,
  `vendedor_cpf` varchar(25) NOT NULL,
  `vendedor_rg` varchar(25) NOT NULL,
  `vendedor_telefone` varchar(15) DEFAULT NULL,
  `vendedor_celular` varchar(15) DEFAULT NULL,
  `vendedor_email` varchar(45) DEFAULT NULL,
  `vendedor_cep` varchar(15) DEFAULT NULL,
  `vendedor_endereco` varchar(45) DEFAULT NULL,
  `vendedor_numero_endereco` varchar(25) DEFAULT NULL,
  `vendedor_complemento` varchar(45) DEFAULT NULL,
  `vendedor_bairro` varchar(45) DEFAULT NULL,
  `vendedor_cidade` varchar(45) DEFAULT NULL,
  `vendedor_estado` varchar(2) DEFAULT NULL,
  `vendedor_ativo` tinyint(1) DEFAULT NULL,
  `vendedor_obs` tinytext,
  `vendedor_data_alteracao` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`vendedor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Extraindo dados da tabela `vendedores`
--

INSERT INTO `vendedores` (`vendedor_id`, `vendedor_codigo`, `vendedor_data_cadastro`, `vendedor_nome_completo`, `vendedor_cpf`, `vendedor_rg`, `vendedor_telefone`, `vendedor_celular`, `vendedor_email`, `vendedor_cep`, `vendedor_endereco`, `vendedor_numero_endereco`, `vendedor_complemento`, `vendedor_bairro`, `vendedor_cidade`, `vendedor_estado`, `vendedor_ativo`, `vendedor_obs`, `vendedor_data_alteracao`) VALUES
(2, '03841956', '2020-01-29 22:22:27', 'Sara Betina', '582.071.790-23', '25.287.429-8', '(41) 3884-4444', '(41) 88884-4444', 'sara@gmail.com', '80530-000', 'Rua das vendas', '45', '', 'Centro', 'Joinville', 'SC', 0, '', '2020-09-04 14:06:11'),
(3, '14923560', '2021-03-18 12:17:59', 'Mônica Cruz', '612.772.500-30', '346931204', '(91) 3232-5454', '(91) 99999-4545', 'monica@gmail.com', '80650-000', 'Rua dos Funcionários', '213', 'Edifício do Estudo', 'Centro', 'Ananindeua', 'PA', 0, 'Está de férias', '2021-03-18 12:18:30');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `contas_pagar`
--
ALTER TABLE `contas_pagar`
  ADD CONSTRAINT `fk_conta_pagar_id_fornecedor` FOREIGN KEY (`conta_pagar_fornecedor_id`) REFERENCES `fornecedores` (`fornecedor_id`);

--
-- Limitadores para a tabela `contas_receber`
--
ALTER TABLE `contas_receber`
  ADD CONSTRAINT `fk_conta_receber_id_cliente` FOREIGN KEY (`conta_receber_cliente_id`) REFERENCES `clientes` (`cliente_id`);

--
-- Limitadores para a tabela `ordem_tem_servicos`
--
ALTER TABLE `ordem_tem_servicos`
  ADD CONSTRAINT `fk_ordem_ts_id_ordem_servico` FOREIGN KEY (`ordem_ts_id_ordem_servico`) REFERENCES `ordens_servicos` (`ordem_servico_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_ordem_ts_id_servico` FOREIGN KEY (`ordem_ts_id_servico`) REFERENCES `servicos` (`servico_id`);

--
-- Limitadores para a tabela `ordens_servicos`
--
ALTER TABLE `ordens_servicos`
  ADD CONSTRAINT `fk_ordem_servico_id_cliente` FOREIGN KEY (`ordem_servico_cliente_id`) REFERENCES `clientes` (`cliente_id`),
  ADD CONSTRAINT `fk_ordem_servico_id_forma_pagto` FOREIGN KEY (`ordem_servico_forma_pagamento_id`) REFERENCES `formas_pagamentos` (`forma_pagamento_id`);

--
-- Limitadores para a tabela `users_groups`
--
ALTER TABLE `users_groups`
  ADD CONSTRAINT `fk_users_groups_groups1` FOREIGN KEY (`group_id`) REFERENCES `groups` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_groups_users1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`) ON DELETE CASCADE ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
