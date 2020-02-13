-- phpMyAdmin SQL Dump
-- version 4.2.7.1
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: 13-Fev-2020 às 19:28
-- Versão do servidor: 5.5.39
-- PHP Version: 5.4.31

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_arquivo`
--

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_arquivos`
--

CREATE TABLE IF NOT EXISTS `tb_arquivos` (
  `cod_empresa` varchar(3) COLLATE latin1_bin NOT NULL,
  `cod_arquivo` varchar(2) COLLATE latin1_bin NOT NULL,
  `des_arquivo` varchar(50) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_autorizados`
--

CREATE TABLE IF NOT EXISTS `tb_autorizados` (
  `cod_autorizado` varchar(4) COLLATE latin1_bin NOT NULL COMMENT 'Identificador do Autorizado',
  `nom_autorizado` varchar(50) COLLATE latin1_bin NOT NULL COMMENT 'Nome do Autorizado',
  `emp_autorizado` varchar(50) COLLATE latin1_bin NOT NULL COMMENT 'Empresa do Autorizado',
  `cel_autorizado` varchar(15) COLLATE latin1_bin NOT NULL,
  `tel_autorizado` varchar(15) COLLATE latin1_bin DEFAULT NULL,
  `set_autorizado` varchar(40) COLLATE latin1_bin NOT NULL,
  `fun_autorizado` varchar(40) COLLATE latin1_bin NOT NULL,
  `log_autorizado` varchar(35) COLLATE latin1_bin DEFAULT NULL,
  `email_autorizado` varchar(60) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin COMMENT='Informações do pessoas autorizadas a ter acesso as informacoes dos documentos';

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_caixas`
--

CREATE TABLE IF NOT EXISTS `tb_caixas` (
  `cod_empresa` varchar(3) COLLATE latin1_bin NOT NULL,
  `cod_setor` varchar(3) COLLATE latin1_bin NOT NULL,
  `cod_caixa` varchar(5) COLLATE latin1_bin NOT NULL,
  `des_caixa` varchar(50) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_corredores`
--

CREATE TABLE IF NOT EXISTS `tb_corredores` (
  `cod_empresa` varchar(3) COLLATE latin1_bin NOT NULL,
  `cod_arquivo` varchar(2) COLLATE latin1_bin NOT NULL,
  `cod_corredor` varchar(3) COLLATE latin1_bin NOT NULL,
  `des_corredor` varchar(50) COLLATE latin1_bin NOT NULL,
  `sig_corredor` varchar(15) COLLATE latin1_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_documentos`
--

CREATE TABLE IF NOT EXISTS `tb_documentos` (
  `cod_documento` varchar(20) COLLATE latin1_bin NOT NULL COMMENT 'Identificador do Documento (Codigo Empresa + identificador do Documento)',
  `cod_empresa` varchar(3) COLLATE latin1_bin NOT NULL,
  `cod_arquivo` varchar(2) COLLATE latin1_bin NOT NULL,
  `cod_corredor` varchar(3) COLLATE latin1_bin NOT NULL,
  `cod_estante` varchar(3) COLLATE latin1_bin NOT NULL,
  `cod_prateleira` varchar(2) COLLATE latin1_bin NOT NULL,
  `cod_caixa` varchar(5) COLLATE latin1_bin NOT NULL,
  `cod_setor` varchar(3) COLLATE latin1_bin NOT NULL,
  `tip_documento` varchar(4) COLLATE latin1_bin NOT NULL,
  `no_ini_documento` varchar(20) COLLATE latin1_bin NOT NULL,
  `no_fin_documento` varchar(20) COLLATE latin1_bin NOT NULL,
  `dt_ini_documento` date NOT NULL,
  `dt_fin_documento` date NOT NULL,
  `dt_des_documento` date NOT NULL,
  `dt_arq_documento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `cod_status` varchar(2) COLLATE latin1_bin NOT NULL,
  `des_documento` text COLLATE latin1_bin NOT NULL,
  `ref_exe_documento` varchar(4) COLLATE latin1_bin NOT NULL,
  `ref_cal_documento` varchar(4) COLLATE latin1_bin NOT NULL,
  `cod_status_ant` varchar(2) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_empresas`
--

CREATE TABLE IF NOT EXISTS `tb_empresas` (
  `cod_empresa` varchar(3) COLLATE latin1_bin NOT NULL,
  `des_empresa` varchar(255) COLLATE latin1_bin NOT NULL,
  `ati_empresa` char(1) COLLATE latin1_bin NOT NULL DEFAULT 'S',
  `pad_empresa` char(1) COLLATE latin1_bin NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin COMMENT='Informações das empresas';

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_estantes`
--

CREATE TABLE IF NOT EXISTS `tb_estantes` (
  `cod_empresa` varchar(3) COLLATE latin1_bin NOT NULL,
  `cod_arquivo` varchar(2) COLLATE latin1_bin NOT NULL,
  `cod_corredor` varchar(3) COLLATE latin1_bin NOT NULL,
  `cod_estante` varchar(3) COLLATE latin1_bin NOT NULL,
  `des_estante` varchar(50) COLLATE latin1_bin NOT NULL,
  `sig_estante` varchar(15) COLLATE latin1_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_menus`
--

CREATE TABLE IF NOT EXISTS `tb_menus` (
`id_menu` int(11) NOT NULL,
  `seq_menu` varchar(10) COLLATE latin1_bin NOT NULL,
  `nome_menu` varchar(255) COLLATE latin1_bin NOT NULL,
  `icone_menu` varchar(255) COLLATE latin1_bin NOT NULL,
  `href_menu` varchar(255) COLLATE latin1_bin NOT NULL,
  `tipo_menu` char(1) COLLATE latin1_bin NOT NULL COMMENT 'Tipo 0-Submenu 1-Acao',
  `lib_menu` varchar(1) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=35 ;

--
-- Extraindo dados da tabela `tb_menus`
--

INSERT INTO `tb_menus` (`id_menu`, `seq_menu`, `nome_menu`, `icone_menu`, `href_menu`, `tipo_menu`, `lib_menu`) VALUES
(1, '01', 'Empresas', 'fa fa-building', 'empresa', '1', '1'),
(2, '02', 'Autorizados', 'fa fa-unlock-alt', '#', '0', '1'),
(4, '02.1', 'Cadastro', 'fa fa-users', 'autorizado', '1', '1'),
(5, '02.2', 'Acesso Empresa', 'fa fa-key', 'setorautorizado&filtroAut=', '1', '1'),
(6, '02.3', 'Acesso ao Sistema', 'fa fa-windows', 'acesso', '1', '1'),
(7, '03', 'Localização', 'fa fa-globe', '#', '0', '1'),
(8, '03.1', 'Arquivo', 'fa fa-archive', 'arquivo', '1', '1'),
(9, '03.2', 'Corredor', 'fa fa-door-closed', 'corredor&filtroEmp=', '1', '1'),
(10, '03.3', 'Estante', 'fa fa-th', 'estante&filtroEmp=', '1', '1'),
(11, '03.4', 'Prateleira', 'fa fa-tasks', 'prateleira&filtroEmp=', '1', '1'),
(13, '03.5', 'Caixa', 'fa fa-box-open', 'caixa&filtroEmp=', '1', '1'),
(14, '04', 'Setor', 'fa fa-info-circle', 'setor', '1', '1'),
(15, '05', 'Tipo Documento', 'fa fa-file-code', 'tipodocumento', '1', '1'),
(16, '06', 'Documentos', 'fa fa-tasks', '#', '0', '1'),
(17, '06.1', 'Documento', 'fa fa-file-alt', 'documento&filCodAut=&status=f', '1', '1'),
(18, '06.2', 'Solicitaçao', '', '', '1', '1'),
(19, '06.3', 'Destruir', 'fa fa-trash-alt', '', '1', '1'),
(20, '06.4', 'Historico', 'fa fa-history', '', '1', '1'),
(27, '07', 'Ferramenta', 'fa fa-cogs', '#', '0', '1'),
(28, '07.1', 'Cadastro Usuario', 'fa fa-users', 'usuario', '1', '1'),
(29, '07.2', 'Liberar Login', 'fa fa-unlock-alt', 'liberausuario', '1', '1'),
(30, '07.3', 'SQL', 'fa fa-database', 'comandosql&status=f', '1', '1'),
(31, '08', 'Historico Versões', 'fa fa-history', 'historico', '1', '1'),
(32, '09', 'Contato', 'fa fa-id-card', '', '1', '1'),
(33, '10', 'Sobre', 'fa fa-question-circle', 'sobre', '1', '1'),
(34, '11', 'Sair', 'fa fa-power-off', 'sair', '1', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_menu_usuarios`
--

CREATE TABLE IF NOT EXISTS `tb_menu_usuarios` (
`id_menu_usuario` int(11) NOT NULL,
  `id_menu` int(11) NOT NULL,
  `id_usu` int(11) NOT NULL,
  `sta_menu` char(1) COLLATE latin1_bin NOT NULL,
  `sta_inc` char(1) COLLATE latin1_bin NOT NULL,
  `sta_alt` char(1) COLLATE latin1_bin NOT NULL,
  `sta_con` char(1) COLLATE latin1_bin NOT NULL,
  `sta_exc` char(1) COLLATE latin1_bin NOT NULL,
  `sta_rel` char(1) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=59 ;

--
-- Extraindo dados da tabela `tb_menu_usuarios`
--

INSERT INTO `tb_menu_usuarios` (`id_menu_usuario`, `id_menu`, `id_usu`, `sta_menu`, `sta_inc`, `sta_alt`, `sta_con`, `sta_exc`, `sta_rel`) VALUES
(2, 2, 1, '1', '1', '1', '1', '1', '1'),
(3, 4, 1, '1', '1', '1', '1', '1', '1'),
(4, 5, 1, '1', '1', '1', '1', '1', '1'),
(5, 6, 1, '1', '1', '1', '1', '1', '1'),
(6, 7, 1, '1', '1', '1', '1', '1', '1'),
(7, 8, 1, '1', '1', '1', '1', '1', '1'),
(8, 9, 1, '1', '1', '1', '1', '1', '1'),
(9, 10, 1, '1', '1', '1', '1', '1', '1'),
(10, 11, 1, '1', '1', '1', '1', '1', '1'),
(11, 13, 1, '1', '1', '1', '1', '1', '1'),
(12, 14, 1, '1', '1', '1', '1', '1', '1'),
(13, 15, 1, '1', '1', '1', '1', '1', '1'),
(14, 16, 1, '1', '1', '1', '1', '1', '1'),
(15, 17, 1, '1', '1', '1', '1', '1', '1'),
(16, 18, 1, '1', '1', '1', '1', '1', '1'),
(17, 19, 1, '1', '1', '1', '1', '1', '1'),
(18, 20, 1, '1', '1', '1', '1', '1', '1'),
(19, 27, 1, '1', '1', '1', '1', '1', '1'),
(20, 28, 1, '1', '1', '1', '1', '1', '1'),
(21, 29, 1, '1', '1', '1', '1', '1', '1'),
(22, 30, 1, '1', '1', '1', '1', '1', '1'),
(23, 31, 1, '1', '1', '1', '1', '1', '1'),
(24, 32, 1, '1', '1', '1', '1', '1', '1'),
(25, 33, 1, '1', '1', '1', '1', '1', '1'),
(27, 2, 2, '1', '1', '1', '1', '1', '1'),
(28, 4, 2, '1', '1', '1', '1', '1', '1'),
(29, 5, 2, '1', '1', '1', '1', '1', '1'),
(30, 6, 2, '1', '1', '1', '1', '1', '1'),
(31, 7, 2, '1', '1', '1', '1', '1', '1'),
(32, 8, 2, '1', '1', '1', '1', '1', '1'),
(33, 9, 2, '1', '1', '1', '1', '1', '1'),
(34, 10, 2, '1', '1', '1', '1', '1', '1'),
(35, 11, 2, '1', '1', '1', '1', '1', '1'),
(36, 13, 2, '1', '1', '1', '1', '1', '1'),
(37, 14, 2, '1', '1', '1', '1', '1', '1'),
(38, 15, 2, '1', '1', '1', '1', '1', '1'),
(39, 16, 2, '1', '1', '1', '1', '1', '1'),
(40, 17, 2, '1', '1', '1', '1', '1', '1'),
(41, 18, 2, '1', '1', '1', '1', '1', '1'),
(42, 19, 2, '1', '1', '1', '1', '1', '1'),
(43, 20, 2, '1', '1', '1', '1', '1', '1'),
(44, 27, 2, '1', '1', '1', '1', '1', '1'),
(45, 28, 2, '1', '1', '1', '1', '1', '1'),
(46, 29, 2, '1', '1', '1', '1', '1', '1'),
(47, 30, 2, '1', '1', '1', '1', '1', '1'),
(48, 31, 2, '1', '1', '1', '1', '1', '1'),
(49, 32, 2, '1', '1', '1', '1', '1', '1'),
(50, 33, 2, '1', '1', '1', '1', '1', '1'),
(51, 1, 1, '', '1', '1', '1', '1', '1'),
(52, 1, 2, '', '1', '1', '1', '1', '1'),
(55, 34, 1, '1', '1', '1', '1', '1', '1');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_prateleiras`
--

CREATE TABLE IF NOT EXISTS `tb_prateleiras` (
  `cod_empresa` varchar(3) COLLATE latin1_bin NOT NULL,
  `cod_arquivo` varchar(2) COLLATE latin1_bin NOT NULL,
  `cod_corredor` varchar(3) COLLATE latin1_bin NOT NULL,
  `cod_estante` varchar(3) COLLATE latin1_bin NOT NULL,
  `cod_prateleira` varchar(2) COLLATE latin1_bin NOT NULL,
  `des_prateleira` varchar(50) COLLATE latin1_bin NOT NULL,
  `sig_prateleira` varchar(15) COLLATE latin1_bin DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_referencia`
--

CREATE TABLE IF NOT EXISTS `tb_referencia` (
  `cod_empresa` varchar(3) COLLATE latin1_bin NOT NULL,
  `id_documento` varchar(16) COLLATE latin1_bin NOT NULL DEFAULT '0000000000000000'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_setores`
--

CREATE TABLE IF NOT EXISTS `tb_setores` (
  `cod_empresa` varchar(3) COLLATE latin1_bin NOT NULL,
  `cod_setor` varchar(3) COLLATE latin1_bin NOT NULL,
  `des_setor` varchar(50) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_setores_autorizados`
--

CREATE TABLE IF NOT EXISTS `tb_setores_autorizados` (
`id_setaut` int(11) NOT NULL,
  `cod_autorizado` varchar(4) COLLATE latin1_bin NOT NULL,
  `cod_empresa` varchar(3) COLLATE latin1_bin NOT NULL,
  `cod_setor` varchar(3) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=14 ;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_status`
--

CREATE TABLE IF NOT EXISTS `tb_status` (
  `cod_status` char(2) COLLATE latin1_bin NOT NULL,
  `des_status` varchar(30) COLLATE latin1_bin NOT NULL,
  `tip_status` char(1) COLLATE latin1_bin NOT NULL DEFAULT '2'
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

--
-- Extraindo dados da tabela `tb_status`
--

INSERT INTO `tb_status` (`cod_status`, `des_status`, `tip_status`) VALUES
('01', 'Normal', '1'),
('02', 'Em Poder de Terceiros', '2');

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_tipo_documentos`
--

CREATE TABLE IF NOT EXISTS `tb_tipo_documentos` (
  `cod_empresa` varchar(3) COLLATE latin1_bin NOT NULL,
  `cod_documento` varchar(4) COLLATE latin1_bin NOT NULL,
  `des_documento` varchar(50) COLLATE latin1_bin NOT NULL,
  `sig_documento` varchar(20) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_bin;

-- --------------------------------------------------------

--
-- Estrutura da tabela `tb_usuarios`
--

CREATE TABLE IF NOT EXISTS `tb_usuarios` (
`id_usu` int(11) NOT NULL COMMENT 'Identificado do Usuario',
  `log_usuario` varchar(35) COLLATE latin1_bin NOT NULL COMMENT 'Login do Usuario',
  `sen_usuario` varchar(50) COLLATE latin1_bin NOT NULL COMMENT 'Senha do Usuario',
  `sta_usuario` varchar(30) COLLATE latin1_bin NOT NULL DEFAULT '""' COMMENT 'Status de Usuario Logado-Guarda MAC da Maquina',
  `per_usuario` char(1) COLLATE latin1_bin NOT NULL DEFAULT '0' COMMENT 'Perfil do usuario  0-Padrao 1-Administrador',
  `nome_usuario` varchar(50) COLLATE latin1_bin NOT NULL
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 COLLATE=latin1_bin AUTO_INCREMENT=22 ;

--
-- Extraindo dados da tabela `tb_usuarios`
--

INSERT INTO `tb_usuarios` (`id_usu`, `log_usuario`, `sen_usuario`, `sta_usuario`, `per_usuario`, `nome_usuario`) VALUES
(1, 'administrador@email.com', 'bXJwYmFhbg==', '', '1', 'administrador'),
(2, 'supervisor@email.com', 'bXJwYmFhbg==', '', '1', 'supervisor');

-- --------------------------------------------------------

--
-- Stand-in structure for view `view_documentos`
--
CREATE TABLE IF NOT EXISTS `view_documentos` (
`Identificador` varchar(20)
,`CodTipo` varchar(4)
,`Tipo` varchar(50)
,`NumeroInicialDoc` varchar(20)
,`NumeroFinalDoc` varchar(20)
,`DataInicialDoc` date
,`DataFinalDoc` date
,`DataDestruicao` date
,`DataArquivamento` timestamp
,`DescricaoDocumento` text
,`AnoExercicio` varchar(4)
,`AnoCalendario` varchar(4)
,`CodEmpresa` varchar(3)
,`Empresa` varchar(255)
,`CodArquivo` varchar(2)
,`Arquivo` varchar(50)
,`CodCorredor` varchar(3)
,`Corredor` varchar(50)
,`CodEstante` varchar(3)
,`Estante` varchar(50)
,`CodPrateleira` varchar(2)
,`Prateleira` varchar(50)
,`CodCaixa` varchar(5)
,`Caixa` varchar(50)
,`CodSetor` varchar(3)
,`Setor` varchar(50)
,`CodStatus` char(2)
,`Status` varchar(30)
);
-- --------------------------------------------------------

--
-- Structure for view `view_documentos`
--
DROP TABLE IF EXISTS `view_documentos`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `view_documentos` AS select `documento`.`cod_documento` AS `Identificador`,`tipo`.`cod_documento` AS `CodTipo`,`tipo`.`des_documento` AS `Tipo`,`documento`.`no_ini_documento` AS `NumeroInicialDoc`,`documento`.`no_fin_documento` AS `NumeroFinalDoc`,`documento`.`dt_ini_documento` AS `DataInicialDoc`,`documento`.`dt_fin_documento` AS `DataFinalDoc`,`documento`.`dt_des_documento` AS `DataDestruicao`,`documento`.`dt_arq_documento` AS `DataArquivamento`,`documento`.`des_documento` AS `DescricaoDocumento`,`documento`.`ref_exe_documento` AS `AnoExercicio`,`documento`.`ref_cal_documento` AS `AnoCalendario`,`empresa`.`cod_empresa` AS `CodEmpresa`,`empresa`.`des_empresa` AS `Empresa`,`arquivo`.`cod_arquivo` AS `CodArquivo`,`arquivo`.`des_arquivo` AS `Arquivo`,`corredor`.`cod_corredor` AS `CodCorredor`,`corredor`.`des_corredor` AS `Corredor`,`estante`.`cod_estante` AS `CodEstante`,`estante`.`des_estante` AS `Estante`,`prateleira`.`cod_prateleira` AS `CodPrateleira`,`prateleira`.`des_prateleira` AS `Prateleira`,`caixa`.`cod_caixa` AS `CodCaixa`,`caixa`.`des_caixa` AS `Caixa`,`setor`.`cod_setor` AS `CodSetor`,`setor`.`des_setor` AS `Setor`,`status`.`cod_status` AS `CodStatus`,`status`.`des_status` AS `Status` from (((((((((`tb_documentos` `documento` join `tb_empresas` `empresa` on((`documento`.`cod_empresa` = `empresa`.`cod_empresa`))) join `tb_arquivos` `arquivo` on(((`documento`.`cod_empresa` = `arquivo`.`cod_empresa`) and (`documento`.`cod_arquivo` = `arquivo`.`cod_arquivo`)))) join `tb_corredores` `corredor` on(((`documento`.`cod_empresa` = `corredor`.`cod_empresa`) and (`documento`.`cod_arquivo` = `corredor`.`cod_arquivo`) and (`documento`.`cod_corredor` = `corredor`.`cod_corredor`)))) join `tb_estantes` `estante` on(((`documento`.`cod_empresa` = `estante`.`cod_empresa`) and (`documento`.`cod_arquivo` = `estante`.`cod_arquivo`) and (`documento`.`cod_corredor` = `estante`.`cod_corredor`) and (`documento`.`cod_estante` = `estante`.`cod_estante`)))) join `tb_prateleiras` `prateleira` on(((`documento`.`cod_empresa` = `prateleira`.`cod_empresa`) and (`documento`.`cod_arquivo` = `prateleira`.`cod_arquivo`) and (`documento`.`cod_corredor` = `prateleira`.`cod_corredor`) and (`documento`.`cod_estante` = `prateleira`.`cod_estante`) and (`documento`.`cod_prateleira` = `prateleira`.`cod_prateleira`)))) join `tb_caixas` `caixa` on(((`documento`.`cod_empresa` = `caixa`.`cod_empresa`) and (`documento`.`cod_setor` = `caixa`.`cod_setor`) and (`documento`.`cod_caixa` = `caixa`.`cod_caixa`)))) join `tb_setores` `setor` on(((`documento`.`cod_empresa` = `setor`.`cod_empresa`) and (`documento`.`cod_setor` = `setor`.`cod_setor`)))) join `tb_tipo_documentos` `tipo` on(((`documento`.`cod_empresa` = `tipo`.`cod_empresa`) and (`documento`.`tip_documento` = `tipo`.`cod_documento`)))) join `tb_status` `status` on((`documento`.`cod_status` = `status`.`cod_status`)));

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_arquivos`
--
ALTER TABLE `tb_arquivos`
 ADD PRIMARY KEY (`cod_empresa`,`cod_arquivo`);

--
-- Indexes for table `tb_autorizados`
--
ALTER TABLE `tb_autorizados`
 ADD PRIMARY KEY (`cod_autorizado`);

--
-- Indexes for table `tb_caixas`
--
ALTER TABLE `tb_caixas`
 ADD PRIMARY KEY (`cod_empresa`,`cod_setor`,`cod_caixa`);

--
-- Indexes for table `tb_corredores`
--
ALTER TABLE `tb_corredores`
 ADD PRIMARY KEY (`cod_empresa`,`cod_arquivo`,`cod_corredor`);

--
-- Indexes for table `tb_documentos`
--
ALTER TABLE `tb_documentos`
 ADD PRIMARY KEY (`cod_documento`);

--
-- Indexes for table `tb_empresas`
--
ALTER TABLE `tb_empresas`
 ADD PRIMARY KEY (`cod_empresa`), ADD KEY `des_empresa` (`des_empresa`);

--
-- Indexes for table `tb_estantes`
--
ALTER TABLE `tb_estantes`
 ADD PRIMARY KEY (`cod_empresa`,`cod_arquivo`,`cod_corredor`,`cod_estante`);

--
-- Indexes for table `tb_menus`
--
ALTER TABLE `tb_menus`
 ADD PRIMARY KEY (`id_menu`), ADD UNIQUE KEY `seq_menu` (`seq_menu`);

--
-- Indexes for table `tb_menu_usuarios`
--
ALTER TABLE `tb_menu_usuarios`
 ADD PRIMARY KEY (`id_menu_usuario`), ADD KEY `fk_menu` (`id_menu`), ADD KEY `fk_usuario` (`id_usu`);

--
-- Indexes for table `tb_prateleiras`
--
ALTER TABLE `tb_prateleiras`
 ADD PRIMARY KEY (`cod_empresa`,`cod_arquivo`,`cod_corredor`,`cod_estante`,`cod_prateleira`);

--
-- Indexes for table `tb_referencia`
--
ALTER TABLE `tb_referencia`
 ADD PRIMARY KEY (`cod_empresa`);

--
-- Indexes for table `tb_setores`
--
ALTER TABLE `tb_setores`
 ADD PRIMARY KEY (`cod_empresa`,`cod_setor`);

--
-- Indexes for table `tb_setores_autorizados`
--
ALTER TABLE `tb_setores_autorizados`
 ADD PRIMARY KEY (`id_setaut`), ADD KEY `fk_setor_setaut` (`cod_empresa`,`cod_setor`), ADD KEY `fk_autorizado_setaut` (`cod_autorizado`);

--
-- Indexes for table `tb_status`
--
ALTER TABLE `tb_status`
 ADD PRIMARY KEY (`cod_status`);

--
-- Indexes for table `tb_tipo_documentos`
--
ALTER TABLE `tb_tipo_documentos`
 ADD PRIMARY KEY (`cod_empresa`,`cod_documento`);

--
-- Indexes for table `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
 ADD PRIMARY KEY (`id_usu`), ADD UNIQUE KEY `log_usuario` (`log_usuario`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_menus`
--
ALTER TABLE `tb_menus`
MODIFY `id_menu` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=35;
--
-- AUTO_INCREMENT for table `tb_menu_usuarios`
--
ALTER TABLE `tb_menu_usuarios`
MODIFY `id_menu_usuario` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=59;
--
-- AUTO_INCREMENT for table `tb_setores_autorizados`
--
ALTER TABLE `tb_setores_autorizados`
MODIFY `id_setaut` int(11) NOT NULL AUTO_INCREMENT,AUTO_INCREMENT=14;
--
-- AUTO_INCREMENT for table `tb_usuarios`
--
ALTER TABLE `tb_usuarios`
MODIFY `id_usu` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Identificado do Usuario',AUTO_INCREMENT=22;
--
-- Constraints for dumped tables
--

--
-- Limitadores para a tabela `tb_arquivos`
--
ALTER TABLE `tb_arquivos`
ADD CONSTRAINT `fk_empresa` FOREIGN KEY (`cod_empresa`) REFERENCES `tb_empresas` (`cod_empresa`);

--
-- Limitadores para a tabela `tb_caixas`
--
ALTER TABLE `tb_caixas`
ADD CONSTRAINT `fk_empresa_setor` FOREIGN KEY (`cod_empresa`, `cod_setor`) REFERENCES `tb_setores` (`cod_empresa`, `cod_setor`);

--
-- Limitadores para a tabela `tb_corredores`
--
ALTER TABLE `tb_corredores`
ADD CONSTRAINT `fk_empresa_arquivo` FOREIGN KEY (`cod_empresa`, `cod_arquivo`) REFERENCES `tb_arquivos` (`cod_empresa`, `cod_arquivo`);

--
-- Limitadores para a tabela `tb_estantes`
--
ALTER TABLE `tb_estantes`
ADD CONSTRAINT `fk_empresa_arquivo_corredor` FOREIGN KEY (`cod_empresa`, `cod_arquivo`, `cod_corredor`) REFERENCES `tb_corredores` (`cod_empresa`, `cod_arquivo`, `cod_corredor`);

--
-- Limitadores para a tabela `tb_menu_usuarios`
--
ALTER TABLE `tb_menu_usuarios`
ADD CONSTRAINT `fk_menu` FOREIGN KEY (`id_menu`) REFERENCES `tb_menus` (`id_menu`),
ADD CONSTRAINT `fk_usuario` FOREIGN KEY (`id_usu`) REFERENCES `tb_usuarios` (`id_usu`);

--
-- Limitadores para a tabela `tb_prateleiras`
--
ALTER TABLE `tb_prateleiras`
ADD CONSTRAINT `fk_empresa_arquivo_corredor_estante` FOREIGN KEY (`cod_empresa`, `cod_arquivo`, `cod_corredor`, `cod_estante`) REFERENCES `tb_estantes` (`cod_empresa`, `cod_arquivo`, `cod_corredor`, `cod_estante`);

--
-- Limitadores para a tabela `tb_setores`
--
ALTER TABLE `tb_setores`
ADD CONSTRAINT `fk_empresa_set` FOREIGN KEY (`cod_empresa`) REFERENCES `tb_empresas` (`cod_empresa`);

--
-- Limitadores para a tabela `tb_setores_autorizados`
--
ALTER TABLE `tb_setores_autorizados`
ADD CONSTRAINT `fk_autorizado_setaut` FOREIGN KEY (`cod_autorizado`) REFERENCES `tb_autorizados` (`cod_autorizado`),
ADD CONSTRAINT `fk_empresa_setaut` FOREIGN KEY (`cod_empresa`) REFERENCES `tb_empresas` (`cod_empresa`),
ADD CONSTRAINT `fk_setor_setaut` FOREIGN KEY (`cod_empresa`, `cod_setor`) REFERENCES `tb_setores` (`cod_empresa`, `cod_setor`);

--
-- Limitadores para a tabela `tb_tipo_documentos`
--
ALTER TABLE `tb_tipo_documentos`
ADD CONSTRAINT `fk_empresa_tip` FOREIGN KEY (`cod_empresa`) REFERENCES `tb_empresas` (`cod_empresa`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
