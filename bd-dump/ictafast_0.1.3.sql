/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50137
Source Host           : localhost:3306
Source Database       : ictafast

Target Server Type    : MYSQL
Target Server Version : 50137
File Encoding         : 65001

Date: 2016-07-07 19:26:26
*/

SET FOREIGN_KEY_CHECKS=0;

-- ----------------------------
-- Table structure for `administrador`
-- ----------------------------
DROP TABLE IF EXISTS `administrador`;
CREATE TABLE `administrador` (
`id_administrador`  int(11) NOT NULL ,
`login_administrador`  varchar(20) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`senha_administrador`  varchar(40) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`nome_administrador`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`id_administrador`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
ROW_FORMAT=Compact

;

-- ----------------------------
-- Records of administrador
-- ----------------------------
BEGIN;
INSERT INTO `administrador` (`id_administrador`, `login_administrador`, `senha_administrador`, `nome_administrador`) VALUES ('1', 'admin', 'admin', 'Admin');
COMMIT;

-- ----------------------------
-- Table structure for `afastamento`
-- ----------------------------
DROP TABLE IF EXISTS `afastamento`;
CREATE TABLE `afastamento` (
`id_afastamento`  int(11) NOT NULL ,
`dt_inicio_afastamento`  date NOT NULL ,
`dt_fim_afastamento`  date NOT NULL ,
`observ_afastamento`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`id_ocorrencia`  int(11) NOT NULL ,
`id_docente`  int(11) NOT NULL ,
PRIMARY KEY (`id_afastamento`),
FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id_docente`) ON DELETE RESTRICT ON UPDATE CASCADE,
FOREIGN KEY (`id_ocorrencia`) REFERENCES `ocorrencia` (`id_ocorrencia`) ON DELETE RESTRICT ON UPDATE CASCADE,
INDEX `FK_afastamento_ocorrencia` USING BTREE (`id_ocorrencia`) ,
INDEX `FK_afastamento_docente` USING BTREE (`id_docente`) 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
ROW_FORMAT=Compact

;

-- ----------------------------
-- Records of afastamento
-- ----------------------------
BEGIN;
COMMIT;

-- ----------------------------
-- Table structure for `curso`
-- ----------------------------
DROP TABLE IF EXISTS `curso`;
CREATE TABLE `curso` (
`id_curso`  int(11) NOT NULL DEFAULT 0 ,
`nome_curso`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
PRIMARY KEY (`id_curso`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
ROW_FORMAT=Compact

;

-- ----------------------------
-- Records of curso
-- ----------------------------
BEGIN;
INSERT INTO `curso` (`id_curso`, `nome_curso`) VALUES ('0', 'Bacharelado em Ciência e Tecnologia'), ('1', 'Engenharia de Alimentos'), ('2', 'Engenharia Geológica'), ('3', 'Engenharia Mecânica'), ('4', 'Engenharia Química'), ('5', 'Não Alocado em Curso');
COMMIT;

-- ----------------------------
-- Table structure for `docente`
-- ----------------------------
DROP TABLE IF EXISTS `docente`;
CREATE TABLE `docente` (
`id_docente`  int(11) NOT NULL ,
`nome_docente`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`siape_docente`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`email_docente`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NULL DEFAULT NULL ,
`efetivo_docente`  varbinary(1) NOT NULL ,
PRIMARY KEY (`id_docente`),
INDEX `id_docente` USING BTREE (`id_docente`) 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
ROW_FORMAT=Compact

;

-- ----------------------------
-- Records of docente
-- ----------------------------
BEGIN;
INSERT INTO `docente` (`id_docente`, `nome_docente`, `siape_docente`, `email_docente`, `efetivo_docente`) VALUES ('1', 'ALESSANDRO CALDEIRA ALVES', '1792929', 'caldeirak@ict.ufvjm.edu.br', 0x31), ('2', 'ALEXANDRE GUTENBERG DA COSTA MOURA', '1571808', 'alex.gutenberg@ict.ufvjm.edu.br', 0x31), ('3', 'ALEXANDRE RAMOS FONSECA', '1647302', 'arfonseca@ict.ufvjm.edu.br', 0x31), ('4', 'AMANDA ROCHA CHAVES', '1679997', 'amanda.chaves@ict.ufvjm.edu.br', 0x31), ('5', 'ANDERSON LUIZ PEDROSA PORTO', '1717270', 'ander.porto@ict.ufvjm.edu.br', 0x31), ('6', 'ANTONIO GENILTON SANT\'ANNA', '1614854', 'agsantanna@ict.ufvjm.edu.br', 0x31), ('7', 'ARLINDO FOLLADOR NETO', '1761790', 'arlindo.neto@ict.ufvjm.edu.br', 0x31), ('8', 'BETHANIA ALVES DE AVELAR FREITAS', '2063221', 'bethania.avelar@ict.ufvjm.edu.br', 0x31), ('9', 'CAIO OLINDO DE MIRANDA S. JUNIOR', '1610457', 'c.olindo@ict.ufvjm.edu.br', 0x31), ('10', 'CARLOS IGNÁCIO', '1718386', 'carlos.ignacio@ict.ufvjm.edu.br', 0x31), ('11', 'CAROLINA CRUZ MENDES BUOSI', '1976737', 'mendes.carolina@ict.ufvjm.edu.br', 0x31), ('12', 'DOUGLAS FREDERICO GUIMARAES SANTIAGO', '1761985', 'douglas.santiago@ict.ufvjm.edu.br', 0x31), ('13', 'EDIVALDO DOS SANTOS FILHO', '2239115', 'edivaldo.santos@ict.ufvjm.edu.br', 0x31), ('14', 'EMILIANA MARA LOPES SIMÕES', '1695227', 'emiliana.simoes@ict.ufvjm.edu.br', 0x31), ('15', 'FILADELFO CARDOSO SANTOS', '369195', 'filadelfo@ict.ufvjm.edu.br', 0x31), ('16', 'HENRIQUE APARECIDO DE JESUS LOURES MOURÃO', '1998778', 'henrique.mourao@ict.ufvjm.edu.br', 0x31), ('17', 'JUAN PEDRO BRETAS ROA', '1609629', 'juan.roa@ict.ufvjm.edu.br', 0x31), ('18', 'LEONARDO GOMES', '1827386', 'leonardo.gomes@ict.ufvjm.edu.br', 0x31), ('19', 'LÍLIAN ARAÚJO PANTOJA', '1357463', 'l.pantoja@ict.ufvjm.edu.br', 0x31), ('20', 'MANOEL JOSÉ MENDES', '1655727', 'manoel.pires@ict.ufvjm.edu.br', 0x31), ('21', 'MARCELO MOREIRA BRITTO', '1820517', 'marcelo.britto@ict.ufvjm.edu.br', 0x31), ('22', 'MARCOS ANTÔNIO RODRIGUES DOS SANTOS', '2020381', 'marcos.rodrigues@ict.ufvjm.edu.br', 0x31), ('23', 'MICHELY SANTOS OLIVEIRA', '1026415', 'michelyoliveira@ict.ufvjm.edu.br', 0x31), ('24', 'MÔNICA APARECIDA CRUVINEL VALADÃO', '1865326', 'monica.valadao@ict.ufvjm.edu.br', 0x31), ('25', 'MÔNICA MARTINS ANDRADE TOLENTINO', '1804206', 'monica.andrade@ict.ufvjm.edu.br', 0x31), ('26', 'OLAVO COSME DA SILVA', '1718506', 'olavo.cosme@ict.ufvjm.edu.br', 0x31), ('27', 'PAULO CÉSAR DE RESENDE ANDRADE', '1489701', 'paulo.andrade@ict.ufvjm.edu.br', 0x31), ('28', 'RAQUEL ANNA SAPUNARU', '1827400', 'raquel.sapunaru@ict.ufvjm.edu.br', 0x31), ('29', 'RICARDO LUIS DOS REIS', '1969894', 'ricardo.reis@ict.ufvjm.edu.br', 0x31), ('30', 'ROBERTA MARIA FERREIRA ALVES', '1848360', 'roberta.alves@ict.ufvjm.edu.br', 0x31), ('31', 'RONALDO LUIS THOMASINI', '2063242', 'ronaldo.thomasini@ict.ufvjm.edu.br', 0x31), ('32', 'VICTOR HUGO DE OLIVEIRA MUNHOZ', '2304543', 'victor.munhoz@ict.ufvjm.edu.br', 0x31), ('33', 'JANAÍNA MATOSO SANTOS', '2134959', '', 0x30), ('34', 'CARLOS ALBERTO GOIS SUZART', '1875890', 'eng.suzart@ict.ufvjm.edu.br', 0x31), ('35', 'FRANCIELE MARIA PELISSARI MOLINA', '2058175', 'franciele.pelissari@ict.ufvjm.edu.br', 0x31), ('36', 'GISELLE PEREIRA CARDOSO', '1996132', 'giselle.cardoso@ict.ufvjm.edu.br', 0x31), ('37', 'GUSTAVO MOLINA', '2038605', 'gustavo.molina@ict.ufvjm.edu.br', 0x31), ('38', 'JOYCE MARIA GOMES DA COSTA', '1929180', 'joyce.costa@ict.ufvjm.edu.br', 0x31), ('39', 'LARISSA DE OLIVEIRA FERREIRA ROCHA', '1996432', 'larissa.rocha@ict.ufvjm.edu.br', 0x31), ('40', 'MARCELINO SERRETTI LEONEL', '1679461', 'mserretti@ict.ufvjm.edu.br', 0x31), ('41', 'MONALISA PEREIRA DUTRA ANDRADE', '1969851', 'monalisa.dutra@ict.ufvjm.edu.br', 0x31), ('42', 'POLIANA MENDES DE SOUZA', '2018126', 'poliana.souza@ict.ufvjm.edu.br', 0x31), ('43', 'ULISSES BARROS DE ABREU MAIA', '1750321', 'ulisses@ict.ufvjm.edu.br', 0x31), ('44', 'TATIANA NUNES AMARAL', '2308875', 'tatiana.amaral@ict.ufvjm.edu.br', 0x31), ('45', 'ALESSANDRA MENDES CARVALHO VASCONCELOS', '2157391', 'alessandra.carvalho@ict.ufvjm.edu.br', 0x31), ('46', 'GISLAINE AMOR', '1651454', 'gislainexand@hotmail.com', 0x31), ('47', 'HUMBERTO LUIS SIQUEIRA REIS', '2250075', 'humbertosiqueira@gmail.com', 0x31), ('48', 'JOSÉ MARIA LEAL', '1268900', 'jose.leal@ict.ufvjm.edu.br', 0x31), ('49', 'JULIANO ALVES SENNA', '1572282', 'jsenna@ict.ufvjm.edu.br', 0x31), ('50', 'MATHEUS HENRIQUE KUCHENBECKER DO AMARAL', '1958563', 'matheusk@ict.ufvjm.edu.br', 0x31), ('51', 'RUBIA RIBEIRO VIANA', '1357011', 'rrviana@gmail.com', 0x31), ('52', 'SORAYA DE CARVALHO NEVES', '2491239', 'soraneves@yahoo.com.br', 0x31), ('53', 'PEDRO ÂNGELO DE ALMEIDA ABREU ', '322001', 'pangelo@ufvjm.edu.br', 0x31), ('54', 'HUMBERTO LUIS SIQUEIRA REIS', '2250075', 'humberto.reis@ict.ufvjm.edu.br', 0x31), ('55', 'EVELYN APARECIDA MECENERO SANCHEZ BIZAN', '1114886', 'evelyn.sanchez@ict.ufvjm.edu.br', 0x31), ('56', 'CARLOS ALEXANDRE OLIVEIRA DE SOUZA', '1352886', 'carlos.souza@ict.ufvjm.edu.br', 0x31), ('57', 'DANILO OLZON DIONYSIO DE SOUZA', '2662163', 'danilo.olzon@ict.ufvjm.edu.br', 0x31), ('58', 'ELTON DIÊGO BONIFÁCIO', '2147917', 'elton.bonificacio@ict.ufvjm.edu.br', 0x31), ('59', 'EULER GUIMARÃES HORTA', '1625872', 'euler.horta@ict.ufvjm.edu.br', 0x31), ('60', 'LIBARDO ANDRÉS GONZÁLES', '1996155', 'l.gonzales@ict.ufvjm.edu.br', 0x31), ('61', 'MATHEUS DOS SANTOS GUZELLA', '2165700', 'matheus.guzella@ict.ufvjm.edu.br', 0x31), ('62', 'MOISÉS DE MATOS TORRES', '2972214', 'moises.torres@ict.ufvjm.edu.br', 0x31), ('63', 'RICARDO AUGUSTO GONÇALVES', '2075180', 'ricardo.augusto@ict.ufvjm.edu.br', 0x31), ('64', 'SOLANGE DE SOUZA', '2934876', 'solange.souza@ict.uvjm.edu.br', 0x31), ('65', 'THIAGO HENRIQUE LARA PINTO', '2089131', 'thiago.lara@ict.ufvjm.edu.br', 0x31), ('66', 'THIAGO PARENTE LIMA', '1996351', 'thiagopl@ict.ufvjm.edu.br', 0x31), ('67', 'THONSON FERREIRA COSTA', '2216412', 'thonson.ferreira@ict.ufvjm.edu.br', 0x31), ('68', 'TIAGO MENDES', '2068263', 'tiago.mendes@ict.ufvjm.edu.br', 0x31), ('69', 'VICTOR AUGUSTO NASCIMENTO MAGALHÃES', '2034829', 'victor.nascimento@ict.ufvjm.edu.br', 0x31), ('70', 'ANAMARIA DE OLIVEIRA CARDOSO', '2075068', 'anamaria.cardoso@ict.ufvjm.edu.br', 0x31), ('71', 'ARLETE BARBOSA DOS REIS', '1717420', 'arlete.reis@ict.ufvjm.edu.br', 0x31), ('72', 'DÉBORA VILELA FRANCO', '1718386', 'debora.vilela@ict.ufvjm.edu.br', 0x31), ('73', 'FLAVIANA TAVARES VIEIRA TEIXEIRA', '1661929', 'flaviana.tavares@ict.ufvjm.edu.br', 0x31), ('74', 'JOÃO VINÍCIOS WIRBITZKI DA SILVEIRA', '2038031', 'joao.silveira@ict.ufvjm.edu.br', 0x31), ('75', 'JOSÉ ALBERTO DE SOUSA', '2020433', 'jose.alberto@ict.ufvjm.edu.br', 0x31), ('76', 'JOSÉ IZAQUIEL SANTOS DA SILVA', '2137568', 'izaquiel@ict.ufvjm.edu.br', 0x31), ('77', 'LUCAS FRANCO FERREIRA', '1750341', 'lucas.franco@ict.ufvjm.edu.br', 0x31), ('78', 'MATHEUS HENRIQUE GRANZOTTO', '2123294', 'matheus.henrique@ict.ufvjm.edu.br', 0x31), ('79', 'ROGÉRIO ALEXANDRE ALVES DE MELO', '2123299', 'rogerio.melo@ict.ufvjm.edu.br', 0x31), ('80', 'SANDRA MATIAS DAMASCENO', '2181833', 'sandra.matias@ict.ufvjm.edu.br', 0x31), ('81', 'TARCILA MANTOVAN ATOLINI', '2038063', 'tarcila.atolini@ict.ufvjm.edu.br', 0x31);
COMMIT;

-- ----------------------------
-- Table structure for `exercicio`
-- ----------------------------
DROP TABLE IF EXISTS `exercicio`;
CREATE TABLE `exercicio` (
`id_exercicio`  int(11) NOT NULL DEFAULT 0 ,
`id_docente`  int(11) NULL DEFAULT NULL ,
`id_curso`  int(11) NULL DEFAULT NULL ,
`dt_inicio_exercicio`  date NULL DEFAULT NULL ,
`dt_fim_exercicio`  date NULL DEFAULT NULL ,
PRIMARY KEY (`id_exercicio`),
FOREIGN KEY (`id_curso`) REFERENCES `curso` (`id_curso`) ON DELETE RESTRICT ON UPDATE CASCADE,
FOREIGN KEY (`id_docente`) REFERENCES `docente` (`id_docente`) ON DELETE RESTRICT ON UPDATE CASCADE,
INDEX `FK_docente` USING BTREE (`id_docente`) ,
INDEX `FK_curso` USING BTREE (`id_curso`) 
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
ROW_FORMAT=Compact

;

-- ----------------------------
-- Records of exercicio
-- ----------------------------
BEGIN;
INSERT INTO `exercicio` (`id_exercicio`, `id_docente`, `id_curso`, `dt_inicio_exercicio`, `dt_fim_exercicio`) VALUES ('0', '1', '0', '2016-07-01', null), ('1', '2', '0', '2016-07-01', null), ('2', '3', '0', '2016-07-01', null), ('3', '4', '0', '2016-07-01', null), ('4', '5', '0', '2016-07-01', null), ('5', '6', '0', '2016-07-01', null), ('6', '7', '0', '2016-07-01', null), ('7', '8', '0', '2016-07-01', null), ('8', '9', '0', '2016-07-01', null), ('9', '10', '0', '2016-07-01', null), ('10', '11', '0', '2016-07-01', null), ('11', '12', '0', '2016-07-01', null), ('12', '13', '0', '2016-07-01', null), ('13', '14', '0', '2016-07-01', null), ('14', '15', '0', '2016-07-01', null), ('15', '16', '0', '2016-07-01', null), ('16', '17', '0', '2016-07-01', null), ('17', '18', '0', '2016-07-01', null), ('18', '19', '0', '2016-07-01', null), ('19', '20', '0', '2016-07-01', null), ('20', '21', '0', '2016-07-01', null), ('21', '22', '0', '2016-07-01', null), ('22', '23', '0', '2016-07-01', null), ('23', '24', '0', '2016-07-01', null), ('24', '25', '0', '2016-07-01', null), ('25', '26', '0', '2016-07-01', null), ('26', '27', '0', '2016-07-01', null), ('27', '28', '0', '2016-07-01', null), ('28', '29', '0', '2016-07-01', null), ('29', '30', '0', '2016-07-01', null), ('30', '31', '0', '2016-07-01', null), ('31', '32', '0', '2016-07-01', null), ('32', '33', '0', '2016-07-01', null), ('33', '34', '1', '2016-07-01', null), ('34', '35', '1', '2016-07-01', null), ('35', '36', '1', '2016-07-01', null), ('36', '37', '1', '2016-07-01', null), ('37', '38', '1', '2016-07-01', null), ('38', '39', '1', '2016-07-01', null), ('39', '40', '1', '2016-07-01', null), ('40', '41', '1', '2016-07-01', null), ('41', '42', '1', '2016-07-01', null), ('42', '43', '1', '2016-07-01', null), ('43', '44', '1', '2016-07-01', null), ('44', '45', '2', '2016-07-01', null), ('45', '46', '2', '2016-07-01', null), ('46', '47', '2', '2016-07-01', null), ('47', '48', '2', '2016-07-01', null), ('48', '49', '2', '2016-07-01', null), ('49', '50', '2', '2016-07-01', null), ('50', '51', '2', '2016-07-01', null), ('51', '52', '2', '2016-07-01', null), ('52', '53', '2', '2016-07-01', null), ('53', '54', '2', '2016-07-01', null), ('54', '55', '2', '2016-07-01', null), ('55', '56', '3', '2016-07-01', null), ('56', '57', '3', '2016-07-01', null), ('57', '58', '3', '2016-07-01', null), ('58', '59', '3', '2016-07-01', null), ('59', '60', '3', '2016-07-01', null), ('60', '61', '3', '2016-07-01', null), ('61', '62', '3', '2016-07-01', null), ('62', '63', '3', '2016-07-01', null), ('63', '64', '3', '2016-07-01', null), ('64', '65', '3', '2016-07-01', null), ('65', '66', '3', '2016-07-01', null), ('66', '67', '3', '2016-07-01', null), ('67', '68', '3', '2016-07-01', null), ('68', '69', '3', '2016-07-01', null), ('69', '70', '4', '2016-07-01', null), ('70', '71', '4', '2016-07-01', null), ('71', '72', '4', '2016-07-01', null), ('72', '73', '4', '2016-07-01', null), ('73', '74', '4', '2016-07-01', null), ('74', '75', '4', '2016-07-01', null), ('75', '76', '4', '2016-07-01', null), ('76', '77', '4', '2016-07-01', null), ('77', '78', '4', '2016-07-01', null), ('78', '79', '4', '2016-07-01', null), ('79', '80', '4', '2016-07-01', null), ('80', '81', '4', '2016-07-01', null);
COMMIT;

-- ----------------------------
-- Table structure for `ocorrencia`
-- ----------------------------
DROP TABLE IF EXISTS `ocorrencia`;
CREATE TABLE `ocorrencia` (
`id_ocorrencia`  int(11) NOT NULL ,
`tipo_ocorrencia`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
`codigo_ocorrencia`  varchar(200) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL ,
PRIMARY KEY (`id_ocorrencia`)
)
ENGINE=InnoDB
DEFAULT CHARACTER SET=utf8 COLLATE=utf8_general_ci
ROW_FORMAT=Compact

;

-- ----------------------------
-- Records of ocorrencia
-- ----------------------------
BEGIN;
INSERT INTO `ocorrencia` (`id_ocorrencia`, `tipo_ocorrencia`, `codigo_ocorrencia`) VALUES ('1', '', '03-148'), ('2', 'Afastamento para Acompanhar C', '03-101'), ('3', 'Afastamento para Estudos ou Miss', '03-111'), ('4', 'Afastamento para exerc', '03-108'), ('5', 'Afastamento para exerc', '03-107'), ('6', 'Afastamento para exerc', '03-110'), ('7', 'Afastamento para exerc', '03-109'), ('8', 'Afastamento para Mandato Federal, Estadual ou Distrital', '03-106'), ('9', 'Afastamento para Servir a outro ', '03-152'), ('10', 'Afastamento para Servir em Organismo Internacional', '03-112'), ('11', 'Afastamento por Inquerito Administrativo', '03-120'), ('12', 'Afastamento Preventivo', '03-122'), ('13', 'Afastamento Sindic', '03-121'), ('14', 'Alistar como Eleitor', '03-125'), ('15', 'Aposentadoria', '05-000'), ('16', 'Atraso ou Sa', '03-141'), ('17', 'Aus', '03-050'), ('18', 'Casamento', '03-126'), ('19', 'Comparecimento a Congresso, Confer', '03-145'), ('20', 'Compensa', '00-001'), ('21', 'Condena', '03-128'), ('22', 'Curso - ESG', '03-139'), ('23', 'Demiss', '02-114'), ('24', 'Deslocamento para Nova Sede', '03-151'), ('25', 'Doa', '03-124'), ('26', 'Exclus', '02-110'), ('27', 'Exonera', '02-108'), ('28', 'Exonera', '02-109'), ('29', 'Exonera', '02-105'), ('30', 'Exonera', '02-106'), ('31', 'Exonera', '02-107'), ('32', 'Falecimento do Servidor', '02-101'), ('33', 'Falecimento', '03-127'), ('34', 'Falta Justificada', '03-143'), ('35', 'Falta n', '03-142'), ('36', 'Falta por Greve', '03-146'), ('37', 'F', '03-144'), ('38', 'Hora-Extra', '00-002'), ('39', 'Inqu', '03-008'), ('40', 'J', '03-147'), ('41', 'Licen', '03-115'), ('42', 'Licen', '03-149'), ('43', 'Licen', '03-114'), ('44', 'Licen', '03-137'), ('45', 'Licen', '03-136'), ('46', 'Licen', '03-105'), ('47', 'Licen', '03-113'), ('48', 'Licen', '03-104'), ('49', 'Licen', '03-123'), ('50', 'Licen', '03-102'), ('51', 'Licen', '03-100'), ('52', 'Licen', '03-133'), ('53', 'Licen', '03-117'), ('54', 'Licen', '03-116'), ('55', 'Licen', '03-103'), ('56', 'Lota', '03-135'), ('57', 'Participa', '03-129'), ('58', 'Participa', '03-138'), ('59', 'Participa', '03-130'), ('60', 'Penalidade Disciplinar', '03-119'), ('61', 'Posse em outro Cargo Inacumul', '02-122'), ('62', 'Redistribui', '02-100'), ('63', 'Remo', '02-103'), ('64', 'Remo', '02-104'), ('65', 'Retorno ao ', '02-102'), ('66', 'Suspens', '03-118'), ('67', 'Transfer', '02-111'), ('68', 'Transfer', '02-112'), ('69', 'Viagem ', '03-150'), ('70', 'Acidente de Trabalho - CLT', '03-030'), ('71', 'Aposentadoria Pelo INSS - CLT', '02-031'), ('72', 'Aux', '03-029'), ('73', 'Casamento - CLT', '03-037'), ('74', 'Demiss', '02-011'), ('75', 'Dispensa de Emprego por Justa causa - CLT', '02-010'), ('76', 'Dispensa de Emprego a Pedido - CLT', '02-017'), ('77', 'Dispensa de Emprego sem Justa Causa - CLT', '02-009'), ('78', 'Falecimento Pessoa da Fam', '03-040'), ('79', 'Licen', '03-014'), ('80', 'Licen', '03-018'), ('81', 'Suspens', '03-041'), ('82', 'T', '02-030');
COMMIT;
