/*
Navicat MySQL Data Transfer

Source Server         : localhost
Source Server Version : 50505
Source Host           : localhost:3306
Source Database       : ictafast

Target Server Type    : MYSQL
Target Server Version : 50505
File Encoding         : 65001

Date: 2016-06-22 14:33:13
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
  `data_afastamento` date NOT NULL,
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
-- Table structure for `docente`
-- ----------------------------
DROP TABLE IF EXISTS `docente`;
CREATE TABLE `docente` (
  `id_docente` int(11) NOT NULL,
  `nome_docente` varchar(200) NOT NULL,
  `siape_docente` varchar(200) NOT NULL,
  `curso_docente` varchar(200) DEFAULT NULL,
  `email_docente` varchar(200) DEFAULT NULL,
  `efetivo_docente` varbinary(1) DEFAULT NULL,
  PRIMARY KEY (`id_docente`),
  KEY `id_docente` (`id_docente`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- ----------------------------
-- Records of docente
-- ----------------------------
INSERT INTO `docente` VALUES ('1', 'ALESSANDRO CALDEIRA ALVES', '1792929', 'Bacharelado em Ciência e Tecnologia', 'caldeirak@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('2', 'ALEXANDRE GUTENBERG DA COSTA MOURA', '1571808', 'Bacharelado em Ciência e Tecnologia', 'alex.gutenberg@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('3', 'ALEXANDRE RAMOS FONSECA', '1647302', 'Bacharelado em Ciência e Tecnologia', 'arfonseca@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('4', 'AMANDA ROCHA CHAVES', '1679997', 'Bacharelado em Ciência e Tecnologia', 'amanda.chaves@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('5', 'ANDERSON LUIZ PEDROSA PORTO', '1717270', 'Bacharelado em Ciência e Tecnologia', 'ander.porto@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('6', 'ANTONIO GENILTON SANT\'ANNA', '1614854', 'Bacharelado em Ciência e Tecnologia', 'agsantanna@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('7', 'ARLINDO FOLLADOR NETO', '1761790', 'Bacharelado em Ciência e Tecnologia', 'arlindo.neto@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('8', 'BETHÂNIA ALVES DE AVELAR FREITAS', '2063221', 'Bacharelado em Ciência e Tecnologia', 'bethania.avelar@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('9', 'CAIO OLINDO DE MIRANDA S. JUNIOR', '1610457', 'Bacharelado em Ciência e Tecnologia', 'c.olindo@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('10', 'CARLOS IGNÁCIO', '1718386', 'Bacharelado em Ciência e Tecnologia', 'carlos.ignacio@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('11', 'CAROLINA CRUZ MENDES BUOSI', '1976737', 'Bacharelado em Ciência e Tecnologia', 'mendes.carolina@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('12', 'DOUGLAS FREDERICO GUIMARAES SANTIAGO', '1761985', 'Bacharelado em Ciência e Tecnologia', 'douglas.santiago@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('13', 'EDIVALDO DOS SANTOS FILHO', '2239115', 'Bacharelado em Ciência e Tecnologia', 'edivaldo.santos@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('14', 'EMILIANA MARA LOPES SIMÕES', '1695227', 'Bacharelado em Ciência e Tecnologia', 'emiliana.simoes@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('15', 'FILADELFO CARDOSO SANTOS', '369195', 'Bacharelado em Ciência e Tecnologia', 'filadelfo@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('16', 'HENRIQUE APARECIDO DE JESUS LOURES MOURÃO', '1998778', 'Bacharelado em Ciência e Tecnologia', 'henrique.mourao@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('17', 'JUAN PEDRO BRETAS ROA', '1609629', 'Bacharelado em Ciência e Tecnologia', 'juan.roa@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('18', 'LEONARDO GOMES', '1827386', 'Bacharelado em Ciência e Tecnologia', 'leonardo.gomes@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('19', 'LÍLIAN ARAÚJO PANTOJA', '1357463', 'Bacharelado em Ciência e Tecnologia', 'l.pantoja@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('20', 'MANOEL JOSÉ MENDES', '1655727', 'Bacharelado em Ciência e Tecnologia', 'manoel.pires@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('21', 'MARCELO MOREIRA BRITTO', '1820517', 'Bacharelado em Ciência e Tecnologia', 'marcelo.britto@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('22', 'MARCOS ANTÔNIO RODRIGUES DOS SANTOS', '2020381', 'Bacharelado em Ciência e Tecnologia', 'marcos.rodrigues@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('23', 'MICHELY SANTOS OLIVEIRA', '1026415', 'Bacharelado em Ciência e Tecnologia', 'michelyoliveira@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('24', 'MÔNICA APARECIDA CRUVINEL VALADÃO', '1865326', 'Bacharelado em Ciência e Tecnologia', 'monica.valadao@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('25', 'MÔNICA MARTINS ANDRADE TOLENTINO', '1804206', 'Bacharelado em Ciência e Tecnologia', 'monica.andrade@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('26', 'OLAVO COSME DA SILVA', '1718506', 'Bacharelado em Ciência e Tecnologia', 'olavo.cosme@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('27', 'PAULO CÉSAR DE RESENDE ANDRADE', '1489701', 'Bacharelado em Ciência e Tecnologia', 'paulo.andrade@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('28', 'RAQUEL ANNA SAPUNARU', '1827400', 'Bacharelado em Ciência e Tecnologia', 'raquel.sapunaru@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('29', 'RICARDO LUIS DOS REIS', '1969894', 'Bacharelado em Ciência e Tecnologia', 'ricardo.reis@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('30', 'ROBERTA MARIA FERREIRA ALVES', '1848360', 'Bacharelado em Ciência e Tecnologia', 'roberta.alves@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('31', 'RONALDO LUIS THOMASINI', '2063242', 'Bacharelado em Ciência e Tecnologia', 'ronaldo.thomasini@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('32', 'VICTOR HUGO DE OLIVEIRA MUNHOZ', '2304543', 'Bacharelado em Ciência e Tecnologia', 'victor.munhoz@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('33', 'JANAÍNA MATOSO SANTOS', '2134959', 'Bacharelado em Ciência e Tecnologia', '', 0x30);
INSERT INTO `docente` VALUES ('34', 'CARLOS ALBERTO GOIS SUZART', '1875890', 'Engenharia de Alimentos', 'eng.suzart@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('35', 'FRANCIELE MARIA PELISSARI MOLINA', '2058175', 'Engenharia de Alimentos', 'franciele.pelissari@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('36', 'GISELLE PEREIRA CARDOSO', '1996132', 'Engenharia de Alimentos', 'giselle.cardoso@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('37', 'GUSTAVO MOLINA', '2038605', 'Engenharia de Alimentos', 'gustavo.molina@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('38', 'JOYCE MARIA GOMES DA COSTA', '1929180', 'Engenharia de Alimentos', 'joyce.costa@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('39', 'LARISSA DE OLIVEIRA FERREIRA ROCHA', '1996432', 'Engenharia de Alimentos', 'larissa.rocha@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('40', 'MARCELINO SERRETTI LEONEL', '1679461', 'Engenharia de Alimentos', 'mserretti@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('41', 'MONALISA PEREIRA DUTRA ANDRADE', '1969851', 'Engenharia de Alimentos', 'monalisa.dutra@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('42', 'POLIANA MENDES DE SOUZA', '2018126', 'Engenharia de Alimentos', 'poliana.souza@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('43', 'ULISSES BARROS DE ABREU MAIA', '1750321', 'Engenharia de Alimentos', 'ulisses@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('44', 'TATIANA NUNES AMARAL', '2308875', 'Engenharia de Alimentos', 'tatiana.amaral@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('45', 'ALESSANDRA MENDES CARVALHO VASCONCELOS', '2157391', 'Engenharia Geológica', 'alessandra.carvalho@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('46', 'GISLAINE AMORÉS BATTILANI', '1651454', 'Engenharia Geológica', 'gislainexand@hotmail.com', 0x31);
INSERT INTO `docente` VALUES ('47', 'HUMBERTO LUIS SIQUEIRA REIS', '2250075', 'Engenharia Geológica', 'humbertosiqueira@gmail.com', 0x31);
INSERT INTO `docente` VALUES ('48', 'JOSÉ MARIA LEAL', '1268900', 'Engenharia Geológica', 'jose.leal@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('49', 'JULIANO ALVES SENNA', '1572282', 'Engenharia Geológica', 'jsenna@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('50', 'MATHEUS HENRIQUE KUCHENBECKER DO AMARAL', '1958563', 'Engenharia Geológica', 'matheusk@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('51', 'RUBIA RIBEIRO VIANA', '1357011', 'Engenharia Geológica', 'rrviana@gmail.com', 0x31);
INSERT INTO `docente` VALUES ('52', 'SORAYA DE CARVALHO NEVES (COOR. PRO TEMP.)', '2491239', 'Engenharia Geológica', 'soraneves@yahoo.com.br', 0x31);
INSERT INTO `docente` VALUES ('53', 'PEDRO ÂNGELO DE ALMEIDA ABREU (COO. NUGEO)', '322001', 'Engenharia Geológica', 'pangelo@ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('54', 'HUMBERTO LUIS SIQUEIRA REIS', '2250075', 'Engenharia Geológica', 'humberto.reis@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('55', 'EVELYN APARECIDA MECENERO SANCHEZ BIZAN', '1114886', 'Engenharia Geológica', 'evelyn.sanchez@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('56', 'CARLOS ALEXANDRE OLIVEIRA DE SOUZA', '1352886', 'Engenharia Mecânica', 'carlos.souza@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('57', 'DANILO OLZON DIONYSIO DE SOUZA', '2662163', 'Engenharia Mecânica', 'danilo.olzon@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('58', 'ELTON DIÊGO BONIFÁCIO', '2147917', 'Engenharia Mecânica', 'elton.bonificacio@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('59', 'EULER GUIMARÃES HORTA', '1625872', 'Engenharia Mecânica', 'euler.horta@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('60', 'LIBARDO ANDRÉS GONZÁLES', '1996155', 'Engenharia Mecânica', 'l.gonzales@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('61', 'MATHEUS DOS SANTOS GUZELLA', '2165700', 'Engenharia Mecânica', 'matheus.guzella@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('62', 'MOISÉS DE MATOS TORRES', '2972214', 'Engenharia Mecânica', 'moises.torres@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('63', 'RICARDO AUGUSTO GONÇALVES', '2075180', 'Engenharia Mecânica', 'ricardo.augusto@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('64', 'SOLANGE DE SOUZA', '2934876', 'Engenharia Mecânica', 'solange.souza@ict.uvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('65', 'THIAGO HENRIQUE LARA PINTO', '2089131', 'Engenharia Mecânica', 'thiago.lara@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('66', 'THIAGO PARENTE LIMA', '1996351', 'Engenharia Mecânica', 'thiagopl@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('67', 'THONSON FERREIRA COSTA', '2216412', 'Engenharia Mecânica', 'thonson.ferreira@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('68', 'TIAGO MENDES', '2068263', 'Engenharia Mecânica', 'tiago.mendes@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('69', 'VICTOR AUGUSTO NASCIMENTO MAGALHÃES', '2034829', 'Engenharia Mecânica', 'victor.nascimento@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('70', 'ANAMARIA DE OLIVEIRA CARDOSO', '2075068', 'Engenharia Química', 'anamaria.cardoso@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('71', 'ARLETE BARBOSA DOS REIS', '1717420', 'Engenharia Química', 'arlete.reis@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('72', 'DÉBORA VILELA FRANCO', '1718386', 'Engenharia Química', 'debora.vilela@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('73', 'FLAVIANA TAVARES VIEIRA TEIXEIRA', '1661929', 'Engenharia Química', 'flaviana.tavares@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('74', 'JOÃO VINÍCIOS WIRBITZKI DA SILVEIRA', '2038031', 'Engenharia Química', 'joao.silveira@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('75', 'JOSÉ ALBERTO DE SOUSA', '2020433', 'Engenharia Química', 'jose.alberto@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('76', 'JOSÉ IZAQUIEL SANTOS DA SILVA', '2137568', 'Engenharia Química', 'izaquiel@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('77', 'LUCAS FRANCO FERREIRA', '1750341', 'Engenharia Química', 'lucas.franco@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('78', 'MATHEUS HENRIQUE GRANZOTTO', '2123294', 'Engenharia Química', 'matheus.henrique@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('79', 'ROGÉRIO ALEXANDRE ALVES DE MELO', '2123299', 'Engenharia Química', 'rogerio.melo@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('80', 'SANDRA MATIAS DAMASCENO', '2181833', 'Engenharia Química', 'sandra.matias@ict.ufvjm.edu.br', 0x31);
INSERT INTO `docente` VALUES ('81', 'TARCILA MANTOVAN ATOLINI', '2038063', 'Engenharia Química', 'tarcila.atolini@ict.ufvjm.edu.br', 0x31);

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
