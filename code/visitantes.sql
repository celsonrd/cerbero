-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 17-Set-2018 às 18:04
-- Versão do servidor: 5.6.17
-- PHP Version: 5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `visitantes`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `local`
--

CREATE TABLE IF NOT EXISTS `local` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `local` varchar(30) NOT NULL,
  `responsavel` varchar(30) NOT NULL,
  `id_pai` int(5) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `local`
--

INSERT INTO `local` (`id`, `local`, `responsavel`, `id_pai`) VALUES
(1, 'GU GARANHUS', 'CMT DO BATALHÃ£O', NULL),
(2, '71Âº BIMTZ', 'CMT DO BATALHÃ£O', 1),
(3, 'EOCP', 'CAP MELO', 2),
(4, 'VILA MILITAR', 'CMT DO BATALHÃ£O', 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `militar`
--

CREATE TABLE IF NOT EXISTS `militar` (
  `id_mil` int(10) NOT NULL AUTO_INCREMENT,
  `cpf` varchar(20) NOT NULL,
  `grd` varchar(20) NOT NULL,
  `nome_mil` varchar(50) NOT NULL,
  PRIMARY KEY (`id_mil`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=5 ;

--
-- Extraindo dados da tabela `militar`
--

INSERT INTO `militar` (`id_mil`, `cpf`, `grd`, `nome_mil`) VALUES
(1, '234.234.234-32', 'CAP', 'JADSON JOSEGUIMARAES DIAS'),
(2, '132.341.232-13', 'TEN CEL', 'ALEXANDRE DE CASTRO GOYANNA'),
(3, '143.242.342-34', 'TEN CEL', 'TESTE MIL'),
(4, '354.534.534-53', 'CEL', 'TESTE MIL 2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `usuario`
--

CREATE TABLE IF NOT EXISTS `usuario` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `email` varchar(50) NOT NULL,
  `senha` varchar(100) NOT NULL,
  `funcao` int(1) NOT NULL,
  `status` int(1) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=3 ;

--
-- Extraindo dados da tabela `usuario`
--

INSERT INTO `usuario` (`id`, `nome`, `email`, `senha`, `funcao`, `status`) VALUES
(1, 'Jadson Dias', 'jadsondia@hotmail.com', '3b90e0f0194abef06fba6a54dfbe8ca3', 1, 1),
(2, 'RAMOS OLIVEIRA', 'ramos@gmail.com', 'cc8138f1d212565f1182a0389099c7e5', 2, 1);

-- --------------------------------------------------------

--
-- Estrutura da tabela `veiculos`
--

CREATE TABLE IF NOT EXISTS `veiculos` (
  `id_veiculo` int(5) NOT NULL AUTO_INCREMENT,
  `tipo` int(1) NOT NULL COMMENT '1-carro;2-moto',
  `id_mil` int(10) DEFAULT NULL,
  `id_visitante` int(10) DEFAULT NULL,
  `marca` varchar(30) NOT NULL,
  `modelo` varchar(30) NOT NULL,
  `cor` varchar(30) NOT NULL,
  `placa` varchar(7) NOT NULL,
  `venc_crlv` varchar(10) DEFAULT NULL,
  `status` tinyint(1) NOT NULL,
  PRIMARY KEY (`id_veiculo`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Extraindo dados da tabela `veiculos`
--

INSERT INTO `veiculos` (`id_veiculo`, `tipo`, `id_mil`, `id_visitante`, `marca`, `modelo`, `cor`, `placa`, `venc_crlv`, `status`) VALUES
(1, 1, NULL, 7, 'VOLKS', 'GOL', 'BRANCO', 'ORH6495', NULL, 0);

-- --------------------------------------------------------

--
-- Estrutura da tabela `visitantes`
--

CREATE TABLE IF NOT EXISTS `visitantes` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nome` varchar(50) NOT NULL,
  `cpf` varchar(14) NOT NULL,
  `sexo` varchar(1) NOT NULL,
  `idMil` varchar(15) DEFAULT NULL,
  `rg` varchar(20) DEFAULT NULL,
  `dn` varchar(10) DEFAULT NULL,
  `fone` varchar(15) DEFAULT NULL,
  `foto` varchar(1500) DEFAULT NULL,
  `omOrigem` varchar(20) DEFAULT NULL,
  `idMilResp` varchar(20) DEFAULT NULL COMMENT 'id do militar da OM no sisbol',
  `nomeMilRespRes` varchar(30) DEFAULT NULL COMMENT 'nome do militar responsavel se for da reserva',
  `acessoLivre` tinyint(1) NOT NULL DEFAULT '0',
  `solicita_autorizacao` int(1) DEFAULT NULL COMMENT 'TRUE se cadastro entiver preenchido aguardando liberação da 2ª seção',
  `fim_acesso_livre` varchar(30) DEFAULT NULL,
  `id_local_acesso` int(1) DEFAULT NULL,
  `alerta` int(1) NOT NULL DEFAULT '0',
  `motivoAlerta` varchar(100) DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=12 ;

--
-- Extraindo dados da tabela `visitantes`
--

INSERT INTO `visitantes` (`id`, `nome`, `cpf`, `sexo`, `idMil`, `rg`, `dn`, `fone`, `foto`, `omOrigem`, `idMilResp`, `nomeMilRespRes`, `acessoLivre`, `solicita_autorizacao`, `fim_acesso_livre`, `id_local_acesso`, `alerta`, `motivoAlerta`) VALUES
(7, 'Jadson Dias', '071.264.374-83', 'M', '', '7285155 sds/pe', '14/06/1989', '(87) 99902-1369', '../fotos/5b7461446976b.jpeg', '', NULL, NULL, 0, NULL, NULL, NULL, 0, NULL),
(8, 'teste', '071.264.364-83', 'F', '', '13212312 sds/pe', '14/06/1989', '(87) 99902-1236', NULL, '', NULL, NULL, 0, NULL, NULL, 1, 0, NULL),
(9, 'Alice de Melo Dias', '098.123.434-51', 'F', '', '879131344sds/pe', '25/07/2018', '(87) 99902-1313', '../fotos/5b83dee4cb618.jpeg', '', NULL, NULL, 0, NULL, NULL, NULL, 0, NULL),
(10, 'Alessandra Freitas', '036.091.212-31', 'F', '', '981312313 sds/pe', '19/03/1979', '(87) 99902-3131', '../fotos/5b8fb76c723fa.jpeg', '', '0115723454', NULL, 0, NULL, NULL, NULL, 0, NULL),
(11, 'JoÃ£o Miguel de Melo Dias ', '831.231.231-21', 'M', '', '31231311 ssp/pe', '19/03/2013', '(87) 90231-2131', '../fotos/5b8fb89f04081.jpeg', '', '1', NULL, 1, NULL, '20/10/2018', 4, 0, NULL);

-- --------------------------------------------------------

--
-- Estrutura da tabela `visitas`
--

CREATE TABLE IF NOT EXISTS `visitas` (
  `id_visita` int(10) NOT NULL AUTO_INCREMENT,
  `id_visitante` int(5) NOT NULL,
  `stamp_entrada` varchar(20) NOT NULL,
  `stamp_saida` varchar(20) DEFAULT NULL,
  `id_local` int(5) NOT NULL,
  `modelo` varchar(20) DEFAULT NULL,
  `cor` varchar(20) DEFAULT NULL,
  `placa` varchar(7) DEFAULT NULL,
  PRIMARY KEY (`id_visita`),
  KEY `id_visitante` (`id_visitante`),
  KEY `id_local` (`id_local`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Extraindo dados da tabela `visitas`
--

INSERT INTO `visitas` (`id_visita`, `id_visitante`, `stamp_entrada`, `stamp_saida`, `id_local`, `modelo`, `cor`, `placa`) VALUES
(1, 7, '1534353767', '1535368859', 3, 'BRANCO', 'GOL', 'ORH6495'),
(2, 9, '1535368962', '1535368977', 4, 'BRANCO', 'PALIO', 'HJM8712'),
(3, 11, '1536145606', NULL, 2, 'BRANCO', 'GOL', 'ORH6495');

--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `visitas`
--
ALTER TABLE `visitas`
  ADD CONSTRAINT `visitas_ibfk_1` FOREIGN KEY (`id_visitante`) REFERENCES `visitantes` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `visitas_ibfk_2` FOREIGN KEY (`id_local`) REFERENCES `local` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
