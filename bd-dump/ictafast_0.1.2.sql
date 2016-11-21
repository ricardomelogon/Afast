/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50137
Source Host           : localhost:3306
Source Database       : ictafast

Target Server Type    : MYSQL
Target Server Version : 50137
File Encoding         : 65001

Date: 2016-07-04 21:29:43
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `administrador`
-- ----------------------------
DROP TABLE IF EXISTS `administrador`;
CREATE TABLE `administrador` (
  `id_administrador` int(11) NOT NULL,
  `login_administrador` varchar(20) NOT NULL,
  `senha_administrador` varchar(20) NOT NULL,
  `nome_administrador` varchar(200) NOT NULL,
  PRIMARY KEY (`id_administrador`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of administrador
-- ----------------------------
INSERT INTO `administrador` VALUES ('1', 'admin', 'admin', 'Admin');

-- ----------------------------
-- Table structure for `afastamento`
-- ----------------------------
DROP TABLE IF EXISTS `afastamento`;
CREATE TABLE `afastamento` (
  `id_afastamento` int(11) NOT NULL,
  `dt_inicio_afastamento` date NOT NULL,
  `dt_fim_afastamento` date NOT NULL,
  `observ_afastamento` varchar(200) DEFAULT NULL,
  `id_ocorrencia` int(11) NOT NULL,
  `id_docente` int(11) NOT NULL,
  PRIMARY KEY (`id_afastamento`),
  KEY `FK_afastamento_ocorrencia` (`id_ocorrencia`),
  KEY `FK_afastamento_docente` (`id_docente`),
  CONSTRAINT `FK_afastamento_docente` FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id_docente`) ON UPDATE CASCADE,
  CONSTRAINT `FK_afastamento_ocorrencia` FOREIGN KEY (`id_ocorrencia`) REFERENCES `ocorrencia` (`id_ocorrencia`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of afastamento
-- ----------------------------

-- ----------------------------
-- Table structure for `curso`
-- ----------------------------
DROP TABLE IF EXISTS `curso`;
CREATE TABLE `curso` (
  `id_curso` int(11) NOT NULL DEFAULT '0',
  `nome_curso` varchar(200) DEFAULT NULL,
  PRIMARY KEY (`id_curso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of curso
-- ----------------------------

-- ----------------------------
-- Table structure for `docente`
-- ----------------------------
DROP TABLE IF EXISTS `docente`;
CREATE TABLE `docente` (
  `id_docente` int(11) NOT NULL,
  `nome_docente` varchar(200) NOT NULL,
  `siape_docente` varchar(200) NOT NULL,
  `email_docente` varchar(200) DEFAULT NULL,
  `tipo_docente` varchar(20) NOT NULL,
  PRIMARY KEY (`id_docente`),
  KEY `id_docente` (`id_docente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of docente
-- ----------------------------
INSERT INTO `docente` VALUES ('1', 'ALESSANDRO CALDEIRA ALVES', '1792929', 'caldeirak@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('2', 'ALEXANDRE GUTENBERG DA COSTA MOURA', '1571808', 'alex.gutenberg@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('3', 'ALEXANDRE RAMOS FONSECA', '1647302', 'arfonseca@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('4', 'AMANDA ROCHA CHAVES', '1679997', 'amanda.chaves@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('5', 'ANDERSON LUIZ PEDROSA PORTO', '1717270', 'ander.porto@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('6', 'ANTONIO GENILTON SANT\'ANNA', '1614854', 'agsantanna@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('7', 'ARLINDO FOLLADOR NETO', '1761790', 'arlindo.neto@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('8', 'BETH', '2063221', 'bethania.avelar@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('9', 'CAIO OLINDO DE MIRANDA S. JUNIOR', '1610457', 'c.olindo@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('10', 'CARLOS IGN', '1718386', 'carlos.ignacio@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('11', 'CAROLINA CRUZ MENDES BUOSI', '1976737', 'mendes.carolina@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('12', 'DOUGLAS FREDERICO GUIMARAES SANTIAGO', '1761985', 'douglas.santiago@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('13', 'EDIVALDO DOS SANTOS FILHO', '2239115', 'edivaldo.santos@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('14', 'EMILIANA MARA LOPES SIM', '1695227', 'emiliana.simoes@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('15', 'FILADELFO CARDOSO SANTOS', '369195', 'filadelfo@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('16', 'HENRIQUE APARECIDO DE JESUS LOURES MOUR', '1998778', 'henrique.mourao@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('17', 'JUAN PEDRO BRETAS ROA', '1609629', 'juan.roa@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('18', 'LEONARDO GOMES', '1827386', 'leonardo.gomes@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('19', 'L', '1357463', 'l.pantoja@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('20', 'MANOEL JOS', '1655727', 'manoel.pires@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('21', 'MARCELO MOREIRA BRITTO', '1820517', 'marcelo.britto@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('22', 'MARCOS ANT', '2020381', 'marcos.rodrigues@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('23', 'MICHELY SANTOS OLIVEIRA', '1026415', 'michelyoliveira@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('24', 'M', '1865326', 'monica.valadao@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('25', 'M', '1804206', 'monica.andrade@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('26', 'OLAVO COSME DA SILVA', '1718506', 'olavo.cosme@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('27', 'PAULO C', '1489701', 'paulo.andrade@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('28', 'RAQUEL ANNA SAPUNARU', '1827400', 'raquel.sapunaru@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('29', 'RICARDO LUIS DOS REIS', '1969894', 'ricardo.reis@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('30', 'ROBERTA MARIA FERREIRA ALVES', '1848360', 'roberta.alves@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('31', 'RONALDO LUIS THOMASINI', '2063242', 'ronaldo.thomasini@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('32', 'VICTOR HUGO DE OLIVEIRA MUNHOZ', '2304543', 'victor.munhoz@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('33', 'JANA', '2134959', '', '');
INSERT INTO `docente` VALUES ('34', 'CARLOS ALBERTO GOIS SUZART', '1875890', 'eng.suzart@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('35', 'FRANCIELE MARIA PELISSARI MOLINA', '2058175', 'franciele.pelissari@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('36', 'GISELLE PEREIRA CARDOSO', '1996132', 'giselle.cardoso@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('37', 'GUSTAVO MOLINA', '2038605', 'gustavo.molina@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('38', 'JOYCE MARIA GOMES DA COSTA', '1929180', 'joyce.costa@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('39', 'LARISSA DE OLIVEIRA FERREIRA ROCHA', '1996432', 'larissa.rocha@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('40', 'MARCELINO SERRETTI LEONEL', '1679461', 'mserretti@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('41', 'MONALISA PEREIRA DUTRA ANDRADE', '1969851', 'monalisa.dutra@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('42', 'POLIANA MENDES DE SOUZA', '2018126', 'poliana.souza@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('43', 'ULISSES BARROS DE ABREU MAIA', '1750321', 'ulisses@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('44', 'TATIANA NUNES AMARAL', '2308875', 'tatiana.amaral@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('45', 'ALESSANDRA MENDES CARVALHO VASCONCELOS', '2157391', 'alessandra.carvalho@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('46', 'GISLAINE AMOR', '1651454', 'gislainexand@hotmail.com', '');
INSERT INTO `docente` VALUES ('47', 'HUMBERTO LUIS SIQUEIRA REIS', '2250075', 'humbertosiqueira@gmail.com', '');
INSERT INTO `docente` VALUES ('48', 'JOS', '1268900', 'jose.leal@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('49', 'JULIANO ALVES SENNA', '1572282', 'jsenna@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('50', 'MATHEUS HENRIQUE KUCHENBECKER DO AMARAL', '1958563', 'matheusk@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('51', 'RUBIA RIBEIRO VIANA', '1357011', 'rrviana@gmail.com', '');
INSERT INTO `docente` VALUES ('52', 'SORAYA DE CARVALHO NEVES (COOR. PRO TEMP.)', '2491239', 'soraneves@yahoo.com.br', '');
INSERT INTO `docente` VALUES ('53', 'PEDRO ', '322001', 'pangelo@ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('54', 'HUMBERTO LUIS SIQUEIRA REIS', '2250075', 'humberto.reis@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('55', 'EVELYN APARECIDA MECENERO SANCHEZ BIZAN', '1114886', 'evelyn.sanchez@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('56', 'CARLOS ALEXANDRE OLIVEIRA DE SOUZA', '1352886', 'carlos.souza@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('57', 'DANILO OLZON DIONYSIO DE SOUZA', '2662163', 'danilo.olzon@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('58', 'ELTON DI', '2147917', 'elton.bonificacio@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('59', 'EULER GUIMAR', '1625872', 'euler.horta@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('60', 'LIBARDO ANDR', '1996155', 'l.gonzales@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('61', 'MATHEUS DOS SANTOS GUZELLA', '2165700', 'matheus.guzella@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('62', 'MOIS', '2972214', 'moises.torres@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('63', 'RICARDO AUGUSTO GON', '2075180', 'ricardo.augusto@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('64', 'SOLANGE DE SOUZA', '2934876', 'solange.souza@ict.uvjm.edu.br', '');
INSERT INTO `docente` VALUES ('65', 'THIAGO HENRIQUE LARA PINTO', '2089131', 'thiago.lara@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('66', 'THIAGO PARENTE LIMA', '1996351', 'thiagopl@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('67', 'THONSON FERREIRA COSTA', '2216412', 'thonson.ferreira@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('68', 'TIAGO MENDES', '2068263', 'tiago.mendes@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('69', 'VICTOR AUGUSTO NASCIMENTO MAGALH', '2034829', 'victor.nascimento@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('70', 'ANAMARIA DE OLIVEIRA CARDOSO', '2075068', 'anamaria.cardoso@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('71', 'ARLETE BARBOSA DOS REIS', '1717420', 'arlete.reis@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('72', 'D', '1718386', 'debora.vilela@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('73', 'FLAVIANA TAVARES VIEIRA TEIXEIRA', '1661929', 'flaviana.tavares@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('74', 'JO', '2038031', 'joao.silveira@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('75', 'JOS', '2020433', 'jose.alberto@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('76', 'JOS', '2137568', 'izaquiel@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('77', 'LUCAS FRANCO FERREIRA', '1750341', 'lucas.franco@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('78', 'MATHEUS HENRIQUE GRANZOTTO', '2123294', 'matheus.henrique@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('79', 'ROG', '2123299', 'rogerio.melo@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('80', 'SANDRA MATIAS DAMASCENO', '2181833', 'sandra.matias@ict.ufvjm.edu.br', '');
INSERT INTO `docente` VALUES ('81', 'TARCILA MANTOVAN ATOLINI', '2038063', 'tarcila.atolini@ict.ufvjm.edu.br', '');

-- ----------------------------
-- Table structure for `exercicio`
-- ----------------------------
DROP TABLE IF EXISTS `exercicio`;
CREATE TABLE `exercicio` (
  `id_exercicio` int(11) NOT NULL DEFAULT '0',
  `id_docente` int(11) DEFAULT NULL,
  `id_curso` int(11) DEFAULT NULL,
  `dt_inicio_exercicio` date DEFAULT NULL,
  `dt_fim_exercicio` date DEFAULT NULL,
  PRIMARY KEY (`id_exercicio`),
  KEY `FK_docente` (`id_docente`),
  KEY `FK_curso` (`id_curso`),
  CONSTRAINT `FK_curso` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON UPDATE CASCADE,
  CONSTRAINT `FK_docente` FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id_docente`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of exercicio
-- ----------------------------

-- ----------------------------
-- Table structure for `ocorrencia`
-- ----------------------------
DROP TABLE IF EXISTS `ocorrencia`;
CREATE TABLE `ocorrencia` (
  `id_ocorrencia` int(11) NOT NULL,
  `tipo_ocorrencia` varchar(200) NOT NULL,
  `codigo_ocorrencia` varchar(200) NOT NULL,
  PRIMARY KEY (`id_ocorrencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of ocorrencia
-- ----------------------------
INSERT INTO `ocorrencia` VALUES ('1', '', '03-148');
INSERT INTO `ocorrencia` VALUES ('2', 'Afastamento para Acompanhar C', '03-101');
INSERT INTO `ocorrencia` VALUES ('3', 'Afastamento para Estudos ou Miss', '03-111');
INSERT INTO `ocorrencia` VALUES ('4', 'Afastamento para exerc', '03-108');
INSERT INTO `ocorrencia` VALUES ('5', 'Afastamento para exerc', '03-107');
INSERT INTO `ocorrencia` VALUES ('6', 'Afastamento para exerc', '03-110');
INSERT INTO `ocorrencia` VALUES ('7', 'Afastamento para exerc', '03-109');
INSERT INTO `ocorrencia` VALUES ('8', 'Afastamento para Mandato Federal, Estadual ou Distrital', '03-106');
INSERT INTO `ocorrencia` VALUES ('9', 'Afastamento para Servir a outro ', '03-152');
INSERT INTO `ocorrencia` VALUES ('10', 'Afastamento para Servir em Organismo Internacional', '03-112');
INSERT INTO `ocorrencia` VALUES ('11', 'Afastamento por Inquerito Administrativo', '03-120');
INSERT INTO `ocorrencia` VALUES ('12', 'Afastamento Preventivo', '03-122');
INSERT INTO `ocorrencia` VALUES ('13', 'Afastamento Sindic', '03-121');
INSERT INTO `ocorrencia` VALUES ('14', 'Alistar como Eleitor', '03-125');
INSERT INTO `ocorrencia` VALUES ('15', 'Aposentadoria', '05-000');
INSERT INTO `ocorrencia` VALUES ('16', 'Atraso ou Sa', '03-141');
INSERT INTO `ocorrencia` VALUES ('17', 'Aus', '03-050');
INSERT INTO `ocorrencia` VALUES ('18', 'Casamento', '03-126');
INSERT INTO `ocorrencia` VALUES ('19', 'Comparecimento a Congresso, Confer', '03-145');
INSERT INTO `ocorrencia` VALUES ('20', 'Compensa', '00-001');
INSERT INTO `ocorrencia` VALUES ('21', 'Condena', '03-128');
INSERT INTO `ocorrencia` VALUES ('22', 'Curso - ESG', '03-139');
INSERT INTO `ocorrencia` VALUES ('23', 'Demiss', '02-114');
INSERT INTO `ocorrencia` VALUES ('24', 'Deslocamento para Nova Sede', '03-151');
INSERT INTO `ocorrencia` VALUES ('25', 'Doa', '03-124');
INSERT INTO `ocorrencia` VALUES ('26', 'Exclus', '02-110');
INSERT INTO `ocorrencia` VALUES ('27', 'Exonera', '02-108');
INSERT INTO `ocorrencia` VALUES ('28', 'Exonera', '02-109');
INSERT INTO `ocorrencia` VALUES ('29', 'Exonera', '02-105');
INSERT INTO `ocorrencia` VALUES ('30', 'Exonera', '02-106');
INSERT INTO `ocorrencia` VALUES ('31', 'Exonera', '02-107');
INSERT INTO `ocorrencia` VALUES ('32', 'Falecimento do Servidor', '02-101');
INSERT INTO `ocorrencia` VALUES ('33', 'Falecimento', '03-127');
INSERT INTO `ocorrencia` VALUES ('34', 'Falta Justificada', '03-143');
INSERT INTO `ocorrencia` VALUES ('35', 'Falta n', '03-142');
INSERT INTO `ocorrencia` VALUES ('36', 'Falta por Greve', '03-146');
INSERT INTO `ocorrencia` VALUES ('37', 'F', '03-144');
INSERT INTO `ocorrencia` VALUES ('38', 'Hora-Extra', '00-002');
INSERT INTO `ocorrencia` VALUES ('39', 'Inqu', '03-008');
INSERT INTO `ocorrencia` VALUES ('40', 'J', '03-147');
INSERT INTO `ocorrencia` VALUES ('41', 'Licen', '03-115');
INSERT INTO `ocorrencia` VALUES ('42', 'Licen', '03-149');
INSERT INTO `ocorrencia` VALUES ('43', 'Licen', '03-114');
INSERT INTO `ocorrencia` VALUES ('44', 'Licen', '03-137');
INSERT INTO `ocorrencia` VALUES ('45', 'Licen', '03-136');
INSERT INTO `ocorrencia` VALUES ('46', 'Licen', '03-105');
INSERT INTO `ocorrencia` VALUES ('47', 'Licen', '03-113');
INSERT INTO `ocorrencia` VALUES ('48', 'Licen', '03-104');
INSERT INTO `ocorrencia` VALUES ('49', 'Licen', '03-123');
INSERT INTO `ocorrencia` VALUES ('50', 'Licen', '03-102');
INSERT INTO `ocorrencia` VALUES ('51', 'Licen', '03-100');
INSERT INTO `ocorrencia` VALUES ('52', 'Licen', '03-133');
INSERT INTO `ocorrencia` VALUES ('53', 'Licen', '03-117');
INSERT INTO `ocorrencia` VALUES ('54', 'Licen', '03-116');
INSERT INTO `ocorrencia` VALUES ('55', 'Licen', '03-103');
INSERT INTO `ocorrencia` VALUES ('56', 'Lota', '03-135');
INSERT INTO `ocorrencia` VALUES ('57', 'Participa', '03-129');
INSERT INTO `ocorrencia` VALUES ('58', 'Participa', '03-138');
INSERT INTO `ocorrencia` VALUES ('59', 'Participa', '03-130');
INSERT INTO `ocorrencia` VALUES ('60', 'Penalidade Disciplinar', '03-119');
INSERT INTO `ocorrencia` VALUES ('61', 'Posse em outro Cargo Inacumul', '02-122');
INSERT INTO `ocorrencia` VALUES ('62', 'Redistribui', '02-100');
INSERT INTO `ocorrencia` VALUES ('63', 'Remo', '02-103');
INSERT INTO `ocorrencia` VALUES ('64', 'Remo', '02-104');
INSERT INTO `ocorrencia` VALUES ('65', 'Retorno ao ', '02-102');
INSERT INTO `ocorrencia` VALUES ('66', 'Suspens', '03-118');
INSERT INTO `ocorrencia` VALUES ('67', 'Transfer', '02-111');
INSERT INTO `ocorrencia` VALUES ('68', 'Transfer', '02-112');
INSERT INTO `ocorrencia` VALUES ('69', 'Viagem ', '03-150');
INSERT INTO `ocorrencia` VALUES ('70', 'Acidente de Trabalho - CLT', '03-030');
INSERT INTO `ocorrencia` VALUES ('71', 'Aposentadoria Pelo INSS - CLT', '02-031');
INSERT INTO `ocorrencia` VALUES ('72', 'Aux', '03-029');
INSERT INTO `ocorrencia` VALUES ('73', 'Casamento - CLT', '03-037');
INSERT INTO `ocorrencia` VALUES ('74', 'Demiss', '02-011');
INSERT INTO `ocorrencia` VALUES ('75', 'Dispensa de Emprego por Justa causa - CLT', '02-010');
INSERT INTO `ocorrencia` VALUES ('76', 'Dispensa de Emprego a Pedido - CLT', '02-017');
INSERT INTO `ocorrencia` VALUES ('77', 'Dispensa de Emprego sem Justa Causa - CLT', '02-009');
INSERT INTO `ocorrencia` VALUES ('78', 'Falecimento Pessoa da Fam', '03-040');
INSERT INTO `ocorrencia` VALUES ('79', 'Licen', '03-014');
INSERT INTO `ocorrencia` VALUES ('80', 'Licen', '03-018');
INSERT INTO `ocorrencia` VALUES ('81', 'Suspens', '03-041');
INSERT INTO `ocorrencia` VALUES ('82', 'T', '02-030');
