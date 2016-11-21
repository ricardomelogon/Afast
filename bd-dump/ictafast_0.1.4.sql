/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : ictafast

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-07-11 16:46:00
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `administrador`
-- ----------------------------
DROP TABLE IF EXISTS `administrador`;
CREATE TABLE `administrador` (
  `id_administrador` int(11) NOT NULL,
  `login_administrador` varchar(20) NOT NULL,
  `senha_administrador` varchar(40) NOT NULL,
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
  KEY `FK_afastamento_ocorrencia` (`id_ocorrencia`) USING BTREE,
  KEY `FK_afastamento_docente` (`id_docente`) USING BTREE,
  CONSTRAINT `afastamento_ibfk_1` FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id_docente`) ON UPDATE CASCADE,
  CONSTRAINT `afastamento_ibfk_2` FOREIGN KEY (`id_ocorrencia`) REFERENCES `ocorrencia` (`id_ocorrencia`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

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
INSERT INTO `curso` VALUES ('0', 'Bacharelado em Ciência e Tecnologia');
INSERT INTO `curso` VALUES ('1', 'Engenharia de Alimentos');
INSERT INTO `curso` VALUES ('2', 'Engenharia Geológica');
INSERT INTO `curso` VALUES ('3', 'Engenharia Mecânica');
INSERT INTO `curso` VALUES ('4', 'Engenharia Química');
INSERT INTO `curso` VALUES ('5', 'Não Alocado em Curso');

-- ----------------------------
-- Table structure for `docente`
-- ----------------------------
DROP TABLE IF EXISTS `docente`;
CREATE TABLE `docente` (
  `id_docente` int(11) NOT NULL,
  `nome_docente` varchar(200) NOT NULL,
  `siape_docente` varchar(200) NOT NULL,
  `email_docente` varchar(200) DEFAULT NULL,
  `efetivo_docente` varbinary(1) NOT NULL,
  PRIMARY KEY (`id_docente`),
  KEY `id_docente` (`id_docente`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of docente
-- ----------------------------
INSERT INTO `docente` VALUES ('1', 'ALESSANDRO CALDEIRA ALVES', '1792929', 'caldeirak@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('2', 'ALEXANDRE GUTENBERG DA COSTA MOURA', '1571808', 'alex.gutenberg@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('3', 'ALEXANDRE RAMOS FONSECA', '1647302', 'arfonseca@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('4', 'AMANDA ROCHA CHAVES', '1679997', 'amanda.chaves@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('5', 'ANDERSON LUIZ PEDROSA PORTO', '1717270', 'ander.porto@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('6', 'ANTONIO GENILTON SANT\'ANNA', '1614854', 'agsantanna@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('7', 'ARLINDO FOLLADOR NETO', '1761790', 'arlindo.neto@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('8', 'BETHANIA ALVES DE AVELAR FREITAS', '2063221', 'bethania.avelar@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('9', 'CAIO OLINDO DE MIRANDA S. JUNIOR', '1610457', 'c.olindo@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('10', 'CARLOS IGNÁCIO', '1718386', 'carlos.ignacio@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('11', 'CAROLINA CRUZ MENDES BUOSI', '1976737', 'mendes.carolina@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('12', 'DOUGLAS FREDERICO GUIMARAES SANTIAGO', '1761985', 'douglas.santiago@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('13', 'EDIVALDO DOS SANTOS FILHO', '2239115', 'edivaldo.santos@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('14', 'EMILIANA MARA LOPES SIMÕES', '1695227', 'emiliana.simoes@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('15', 'FILADELFO CARDOSO SANTOS', '369195', 'filadelfo@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('16', 'HENRIQUE APARECIDO DE JESUS LOURES MOURÃO', '1998778', 'henrique.mourao@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('17', 'JUAN PEDRO BRETAS ROA', '1609629', 'juan.roa@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('18', 'LEONARDO GOMES', '1827386', 'leonardo.gomes@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('19', 'LÍLIAN ARAÚJO PANTOJA', '1357463', 'l.pantoja@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('20', 'MANOEL JOSÉ MENDES', '1655727', 'manoel.pires@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('21', 'MARCELO MOREIRA BRITTO', '1820517', 'marcelo.britto@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('22', 'MARCOS ANTÔNIO RODRIGUES DOS SANTOS', '2020381', 'marcos.rodrigues@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('23', 'MICHELY SANTOS OLIVEIRA', '1026415', 'michelyoliveira@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('24', 'MÔNICA APARECIDA CRUVINEL VALADÃO', '1865326', 'monica.valadao@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('25', 'MÔNICA MARTINS ANDRADE TOLENTINO', '1804206', 'monica.andrade@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('26', 'OLAVO COSME DA SILVA', '1718506', 'olavo.cosme@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('27', 'PAULO CÉSAR DE RESENDE ANDRADE', '1489701', 'paulo.andrade@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('28', 'RAQUEL ANNA SAPUNARU', '1827400', 'raquel.sapunaru@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('29', 'RICARDO LUIS DOS REIS', '1969894', 'ricardo.reis@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('30', 'ROBERTA MARIA FERREIRA ALVES', '1848360', 'roberta.alves@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('31', 'RONALDO LUIS THOMASINI', '2063242', 'ronaldo.thomasini@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('32', 'VICTOR HUGO DE OLIVEIRA MUNHOZ', '2304543', 'victor.munhoz@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('33', 'JANAÍNA MATOSO SANTOS', '2134959', '', 0x30);
INSERT INTO `docente` VALUES ('34', 'CARLOS ALBERTO GOIS SUZART', '1875890', 'eng.suzart@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('35', 'FRANCIELE MARIA PELISSARI MOLINA', '2058175', 'franciele.pelissari@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('36', 'GISELLE PEREIRA CARDOSO', '1996132', 'giselle.cardoso@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('37', 'GUSTAVO MOLINA', '2038605', 'gustavo.molina@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('38', 'JOYCE MARIA GOMES DA COSTA', '1929180', 'joyce.costa@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('39', 'LARISSA DE OLIVEIRA FERREIRA ROCHA', '1996432', 'larissa.rocha@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('40', 'MARCELINO SERRETTI LEONEL', '1679461', 'mserretti@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('41', 'MONALISA PEREIRA DUTRA ANDRADE', '1969851', 'monalisa.dutra@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('42', 'POLIANA MENDES DE SOUZA', '2018126', 'poliana.souza@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('43', 'ULISSES BARROS DE ABREU MAIA', '1750321', 'ulisses@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('44', 'TATIANA NUNES AMARAL', '2308875', 'tatiana.amaral@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('45', 'ALESSANDRA MENDES CARVALHO VASCONCELOS', '2157391', 'alessandra.carvalho@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('46', 'GISLAINE AMOR', '1651454', 'gislainexand@hotmail.com', 0x31);
INSERT INTO `docente` VALUES ('47', 'HUMBERTO LUIS SIQUEIRA REIS', '2250075', 'humbertosiqueira@gmail.com', 0x31);
INSERT INTO `docente` VALUES ('48', 'JOSÉ MARIA LEAL', '1268900', 'jose.leal@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('49', 'JULIANO ALVES SENNA', '1572282', 'jsenna@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('50', 'MATHEUS HENRIQUE KUCHENBECKER DO AMARAL', '1958563', 'matheusk@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('51', 'RUBIA RIBEIRO VIANA', '1357011', 'rrviana@gmail.com', 0x31);
INSERT INTO `docente` VALUES ('52', 'SORAYA DE CARVALHO NEVES', '2491239', 'soraneves@yahoo.com.br', 0x31);
INSERT INTO `docente` VALUES ('53', 'PEDRO ÂNGELO DE ALMEIDA ABREU ', '322001', 'pangelo@ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('54', 'HUMBERTO LUIS SIQUEIRA REIS', '2250075', 'humberto.reis@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('55', 'EVELYN APARECIDA MECENERO SANCHEZ BIZAN', '1114886', 'evelyn.sanchez@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('56', 'CARLOS ALEXANDRE OLIVEIRA DE SOUZA', '1352886', 'carlos.souza@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('57', 'DANILO OLZON DIONYSIO DE SOUZA', '2662163', 'danilo.olzon@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('58', 'ELTON DIÊGO BONIFÁCIO', '2147917', 'elton.bonificacio@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('59', 'EULER GUIMARÃES HORTA', '1625872', 'euler.horta@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('60', 'LIBARDO ANDRÉS GONZÁLES', '1996155', 'l.gonzales@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('61', 'MATHEUS DOS SANTOS GUZELLA', '2165700', 'matheus.guzella@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('62', 'MOISÉS DE MATOS TORRES', '2972214', 'moises.torres@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('63', 'RICARDO AUGUSTO GONÇALVES', '2075180', 'ricardo.augusto@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('64', 'SOLANGE DE SOUZA', '2934876', 'solange.souza@ict.uvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('65', 'THIAGO HENRIQUE LARA PINTO', '2089131', 'thiago.lara@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('66', 'THIAGO PARENTE LIMA', '1996351', 'thiagopl@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('67', 'THONSON FERREIRA COSTA', '2216412', 'thonson.ferreira@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('68', 'TIAGO MENDES', '2068263', 'tiago.mendes@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('69', 'VICTOR AUGUSTO NASCIMENTO MAGALHÃES', '2034829', 'victor.nascimento@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('70', 'ANAMARIA DE OLIVEIRA CARDOSO', '2075068', 'anamaria.cardoso@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('71', 'ARLETE BARBOSA DOS REIS', '1717420', 'arlete.reis@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('72', 'DÉBORA VILELA FRANCO', '1718386', 'debora.vilela@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('73', 'FLAVIANA TAVARES VIEIRA TEIXEIRA', '1661929', 'flaviana.tavares@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('74', 'JOÃO VINÍCIOS WIRBITZKI DA SILVEIRA', '2038031', 'joao.silveira@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('75', 'JOSÉ ALBERTO DE SOUSA', '2020433', 'jose.alberto@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('76', 'JOSÉ IZAQUIEL SANTOS DA SILVA', '2137568', 'izaquiel@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('77', 'LUCAS FRANCO FERREIRA', '1750341', 'lucas.franco@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('78', 'MATHEUS HENRIQUE GRANZOTTO', '2123294', 'matheus.henrique@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('79', 'ROGÉRIO ALEXANDRE ALVES DE MELO', '2123299', 'rogerio.melo@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('80', 'SANDRA MATIAS DAMASCENO', '2181833', 'sandra.matias@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('81', 'TARCILA MANTOVAN ATOLINI', '2038063', 'tarcila.atolini@ict.ufvjm.edu.br', 0x31);

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
  KEY `FK_docente` (`id_docente`) USING BTREE,
  KEY `FK_curso` (`id_curso`) USING BTREE,
  CONSTRAINT `exercicio_ibfk_1` FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON UPDATE CASCADE,
  CONSTRAINT `exercicio_ibfk_2` FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id_docente`) ON UPDATE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of exercicio
-- ----------------------------
INSERT INTO `exercicio` VALUES ('0', '1', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('1', '2', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('2', '3', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('3', '4', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('4', '5', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('5', '6', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('6', '7', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('7', '8', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('8', '9', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('9', '10', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('10', '11', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('11', '12', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('12', '13', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('13', '14', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('14', '15', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('15', '16', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('16', '17', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('17', '18', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('18', '19', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('19', '20', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('20', '21', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('21', '22', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('22', '23', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('23', '24', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('24', '25', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('25', '26', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('26', '27', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('27', '28', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('28', '29', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('29', '30', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('30', '31', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('31', '32', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('32', '33', '0', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('33', '34', '1', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('34', '35', '1', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('35', '36', '1', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('36', '37', '1', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('37', '38', '1', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('38', '39', '1', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('39', '40', '1', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('40', '41', '1', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('41', '42', '1', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('42', '43', '1', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('43', '44', '1', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('44', '45', '2', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('45', '46', '2', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('46', '47', '2', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('47', '48', '2', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('48', '49', '2', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('49', '50', '2', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('50', '51', '2', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('51', '52', '2', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('52', '53', '2', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('53', '54', '2', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('54', '55', '2', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('55', '56', '3', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('56', '57', '3', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('57', '58', '3', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('58', '59', '3', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('59', '60', '3', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('60', '61', '3', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('61', '62', '3', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('62', '63', '3', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('63', '64', '3', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('64', '65', '3', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('65', '66', '3', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('66', '67', '3', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('67', '68', '3', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('68', '69', '3', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('69', '70', '4', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('70', '71', '4', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('71', '72', '4', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('72', '73', '4', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('73', '74', '4', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('74', '75', '4', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('75', '76', '4', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('76', '77', '4', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('77', '78', '4', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('78', '79', '4', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('79', '80', '4', '2016-07-01', null);
INSERT INTO `exercicio` VALUES ('80', '81', '4', '2016-07-01', null);

-- ----------------------------
-- Table structure for `ocorrencia`
-- ----------------------------
DROP TABLE IF EXISTS `ocorrencia`;
CREATE TABLE `ocorrencia` (
  `id_ocorrencia` int(11) NOT NULL,
  `tipo_ocorrencia` varchar(200) NOT NULL,
  `codigo_ocorrencia` varchar(200) NOT NULL,
  PRIMARY KEY (`id_ocorrencia`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 ROW_FORMAT=COMPACT;

-- ----------------------------
-- Records of ocorrencia
-- ----------------------------
INSERT INTO `ocorrencia` VALUES ('1', 'À Disposição da Justiça Eleitoral', '03-148');
INSERT INTO `ocorrencia` VALUES ('2', 'Afastamento para Acompanhar Cônjuge ou Companheiro', '03-101');
INSERT INTO `ocorrencia` VALUES ('3', 'Afastamento para Estudos ou Missão no Exterior', '03-111');
INSERT INTO `ocorrencia` VALUES ('4', 'Afastamento para exercício Mandato Eletivo para Prefeito', '03-108');
INSERT INTO `ocorrencia` VALUES ('5', 'Afastamento para exercício Mandato Eletivo para Prefeito', '03-107');
INSERT INTO `ocorrencia` VALUES ('6', 'Afastamento para exercício Mandato Eletivo para Vereador', '03-110');
INSERT INTO `ocorrencia` VALUES ('7', 'Afastamento para exercício Mandato Eletivo para Vereador', '03-109');
INSERT INTO `ocorrencia` VALUES ('8', 'Afastamento para Mandato Federal, Estadual ou Distrital', '03-106');
INSERT INTO `ocorrencia` VALUES ('9', 'Afastamento para Servir a outro Órgão ou Entidade', '03-152');
INSERT INTO `ocorrencia` VALUES ('10', 'Afastamento para Servir em Organismo Internacional', '03-112');
INSERT INTO `ocorrencia` VALUES ('11', 'Afastamento por Inquerito Administrativo', '03-120');
INSERT INTO `ocorrencia` VALUES ('12', 'Afastamento Preventivo', '03-122');
INSERT INTO `ocorrencia` VALUES ('13', 'Afastamento Sindicância', '03-121');
INSERT INTO `ocorrencia` VALUES ('14', 'Alistar como Eleitor', '03-125');
INSERT INTO `ocorrencia` VALUES ('15', 'Aposentadoria', '05-000');
INSERT INTO `ocorrencia` VALUES ('16', 'Atraso ou Saída Antecipada', '03-141');
INSERT INTO `ocorrencia` VALUES ('17', 'Ausência Prevista', '03-050');
INSERT INTO `ocorrencia` VALUES ('18', 'Casamento', '03-126');
INSERT INTO `ocorrencia` VALUES ('19', 'Comparecimento a Congresso, Conferência ou Similares', '03-145');
INSERT INTO `ocorrencia` VALUES ('20', 'Compensação', '00-001');
INSERT INTO `ocorrencia` VALUES ('21', 'Condenação a Pena Privativa de Liberdade', '03-128');
INSERT INTO `ocorrencia` VALUES ('22', 'Curso - ESG', '03-139');
INSERT INTO `ocorrencia` VALUES ('23', 'Demissão', '02-114');
INSERT INTO `ocorrencia` VALUES ('24', 'Deslocamento para Nova Sede', '03-151');
INSERT INTO `ocorrencia` VALUES ('25', 'Doação Voluntária de Sangue', '03-124');
INSERT INTO `ocorrencia` VALUES ('26', 'Exclusão por Decisão Judicial', '02-110');
INSERT INTO `ocorrencia` VALUES ('27', 'Exoneração Cargo Comissionado', '02-108');
INSERT INTO `ocorrencia` VALUES ('28', 'Exoneração Cargo Comissionado', '02-109');
INSERT INTO `ocorrencia` VALUES ('29', 'Exoneração Cargo Efetivo, à pedido', '02-105');
INSERT INTO `ocorrencia` VALUES ('30', 'Exoneração Cargo Efetivo', '02-106');
INSERT INTO `ocorrencia` VALUES ('31', 'Exoneração Cargo Efetivo', '02-107');
INSERT INTO `ocorrencia` VALUES ('32', 'Falecimento do Servidor', '02-101');
INSERT INTO `ocorrencia` VALUES ('33', 'Falecimento', '03-127');
INSERT INTO `ocorrencia` VALUES ('34', 'Falta Justificada', '03-143');
INSERT INTO `ocorrencia` VALUES ('35', 'Falta não Justificada', '03-142');
INSERT INTO `ocorrencia` VALUES ('36', 'Falta por Greve', '03-146');
INSERT INTO `ocorrencia` VALUES ('37', 'Férias', '03-144');
INSERT INTO `ocorrencia` VALUES ('38', 'Hora-Extra', '00-002');
INSERT INTO `ocorrencia` VALUES ('39', 'Inquérito Policial', '03-008');
INSERT INTO `ocorrencia` VALUES ('40', 'Júri', '03-147');
INSERT INTO `ocorrencia` VALUES ('41', 'Licença Adoção ou Guarda Judicial', '03-115');
INSERT INTO `ocorrencia` VALUES ('42', 'Licença Adoção ou Guarda Judicial', '03-149');
INSERT INTO `ocorrencia` VALUES ('43', 'Licença Gestante', '03-114');
INSERT INTO `ocorrencia` VALUES ('44', 'Licença para Atividade Política', '03-137');
INSERT INTO `ocorrencia` VALUES ('45', 'Licença para Atividade Política', '03-136');
INSERT INTO `ocorrencia` VALUES ('46', 'Licença para o Desempenho de Mandato Classista', '03-105');
INSERT INTO `ocorrencia` VALUES ('47', 'Licença para Tratamento da Própria Saúde', '03-113');
INSERT INTO `ocorrencia` VALUES ('48', 'Licença para Trato de Enteresse Particular', '03-104');
INSERT INTO `ocorrencia` VALUES ('49', 'Licença Paternidade', '03-123');
INSERT INTO `ocorrencia` VALUES ('50', 'Licença por Convocação Militar', '03-102');
INSERT INTO `ocorrencia` VALUES ('51', 'Licença por Doença em Pessoa da Família', '03-100');
INSERT INTO `ocorrencia` VALUES ('52', 'Licença por Doença em Pessoa da Família', '03-133');
INSERT INTO `ocorrencia` VALUES ('53', 'Licença por Doença Especificada em Lei', '03-117');
INSERT INTO `ocorrencia` VALUES ('54', 'Licença por Motivo de Acidente em Serviço ou Doença Profissional', '03-116');
INSERT INTO `ocorrencia` VALUES ('55', 'Licença Prêmio por Assiduidade', '03-103');
INSERT INTO `ocorrencia` VALUES ('56', 'Lotação Provisória - Afastamento para Acompanhar Cônjuge ou Companheiro', '03-135');
INSERT INTO `ocorrencia` VALUES ('57', 'Participação em Competição Desportiva Nacional ou Exterior', '03-129');
INSERT INTO `ocorrencia` VALUES ('58', 'Participação em Processo de Liquidação em Outro Órgão', '03-138');
INSERT INTO `ocorrencia` VALUES ('59', 'Participação em Programa de Treinamento', '03-130');
INSERT INTO `ocorrencia` VALUES ('60', 'Penalidade Disciplinar', '03-119');
INSERT INTO `ocorrencia` VALUES ('61', 'Posse em outro Cargo Inacumulável', '02-122');
INSERT INTO `ocorrencia` VALUES ('62', 'Redistribuição', '02-100');
INSERT INTO `ocorrencia` VALUES ('63', 'Remoção à Pedido', '02-103');
INSERT INTO `ocorrencia` VALUES ('64', 'Remoção de Ofício', '02-104');
INSERT INTO `ocorrencia` VALUES ('65', 'Retorno ao Órgão de Origem', '02-102');
INSERT INTO `ocorrencia` VALUES ('66', 'Suspensão Disciplinar', '03-118');
INSERT INTO `ocorrencia` VALUES ('67', 'Transferência à Pedido', '02-111');
INSERT INTO `ocorrencia` VALUES ('68', 'Transferência de Ofício', '02-112');
INSERT INTO `ocorrencia` VALUES ('69', 'Viagem à Serviço', '03-150');
INSERT INTO `ocorrencia` VALUES ('70', 'Acidente de Trabalho - CLT', '03-030');
INSERT INTO `ocorrencia` VALUES ('71', 'Aposentadoria Pelo INSS - CLT', '02-031');
INSERT INTO `ocorrencia` VALUES ('72', 'Auxílio Doença - CLT', '03-029');
INSERT INTO `ocorrencia` VALUES ('73', 'Casamento - CLT', '03-037');
INSERT INTO `ocorrencia` VALUES ('74', 'Demissão - CLT', '02-011');
INSERT INTO `ocorrencia` VALUES ('75', 'Dispensa de Emprego por Justa causa - CLT', '02-010');
INSERT INTO `ocorrencia` VALUES ('76', 'Dispensa de Emprego a Pedido - CLT', '02-017');
INSERT INTO `ocorrencia` VALUES ('77', 'Dispensa de Emprego sem Justa Causa - CLT', '02-009');
INSERT INTO `ocorrencia` VALUES ('78', 'Falecimento Pessoa da Família - CLT', '03-040');
INSERT INTO `ocorrencia` VALUES ('79', 'Licença Gestante - CLT', '03-014');
INSERT INTO `ocorrencia` VALUES ('80', 'Licença Para Tratamento de Saúde - CLT', '03-018');
INSERT INTO `ocorrencia` VALUES ('81', 'Suspensão Contrato de Trabalho - CLT', '03-041');
INSERT INTO `ocorrencia` VALUES ('82', 'Término de contrato - CLT', '02-030');
