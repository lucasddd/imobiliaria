-- MySQL dump 10.13  Distrib 5.7.20, for Linux (x86_64)
--
-- Host: localhost    Database: imobiliaria
-- ------------------------------------------------------
-- Server version	5.7.20-0ubuntu0.16.04.1

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `clientes`
--

DROP TABLE IF EXISTS `clientes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `clientes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cpf` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `datanascimento` date DEFAULT NULL,
  `endereco` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `bairro` varchar(90) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cidade` varchar(90) COLLATE utf8_unicode_ci DEFAULT NULL,
  `cep` varchar(8) COLLATE utf8_unicode_ci DEFAULT NULL,
  `telefone` varchar(12) COLLATE utf8_unicode_ci DEFAULT NULL,
  `rg` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `criadoem` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `clientes`
--

LOCK TABLES `clientes` WRITE;
/*!40000 ALTER TABLE `clientes` DISABLE KEYS */;
INSERT INTO `clientes` VALUES (1,'BELTRAO JUVENAL DA SILVA','18883518292','1985-01-24','RUA JUSCELINO KUBSCHEQUE, 345','CENTRO','UNAI','38610000','038998982005','132456',1,'2018-11-11 23:36:13'),(2,'ANGÃ©LICA SILVA GUIMARÃ£ES','04761789590','2018-06-05','RUA CINCO DE MAIO','CENTRO','UNAI','38610000','038999614565','',1,'2018-11-11 23:50:03'),(3,'MARIA APARECIDA RODRIGUES','32335540521','2018-11-21','RUA JOÃ£O RODRIGUES, 361','6565464','PARACATU','38610000','01125125468','1321321',1,'2018-11-11 23:57:39'),(4,'MARCOS DA SILVA HONORIO','77859368200','2011-09-14','RUA JOSE FRANCISCO BELTRAO, 421','CENTRO','UNAI','38600000','38998552045','mg15997568',1,'2018-11-27 02:02:03');
/*!40000 ALTER TABLE `clientes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `imoveis`
--

DROP TABLE IF EXISTS `imoveis`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `imoveis` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `endereco` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `bairro` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  `tipo_imovel_id` int(11) DEFAULT NULL,
  `foto1` varchar(90) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto2` varchar(90) COLLATE utf8_unicode_ci DEFAULT NULL,
  `foto3` varchar(90) COLLATE utf8_unicode_ci DEFAULT NULL,
  `situacao` int(11) DEFAULT NULL,
  `criadoem` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `proprietario_id` int(11) DEFAULT NULL,
  `valor_venda` float(10,2) NOT NULL DEFAULT '0.00',
  `valor_locacao` float(10,2) NOT NULL DEFAULT '0.00',
  `qt_quartos` int(11) DEFAULT NULL,
  `qt_suites` int(11) DEFAULT NULL,
  `qt_banheiros` int(11) DEFAULT NULL,
  `obs` text COLLATE utf8_unicode_ci,
  `area_construida` float DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `tipo_imovel_id` (`tipo_imovel_id`),
  KEY `situacao` (`situacao`),
  KEY `proprietario_id` (`proprietario_id`),
  CONSTRAINT `imoveis_ibfk_1` FOREIGN KEY (`tipo_imovel_id`) REFERENCES `tipo_imovel` (`id`),
  CONSTRAINT `imoveis_ibfk_2` FOREIGN KEY (`situacao`) REFERENCES `situacoes_imovel` (`id`),
  CONSTRAINT `imoveis_ibfk_3` FOREIGN KEY (`proprietario_id`) REFERENCES `clientes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `imoveis`
--

LOCK TABLES `imoveis` WRITE;
/*!40000 ALTER TABLE `imoveis` DISABLE KEYS */;
INSERT INTO `imoveis` VALUES (1,'RUA CANJIRICA 1258','CENTRO',1,'1-1543550103.jpeg','2-1543550103.png',NULL,1,'2018-11-30 03:55:03',1,145.00,129.00,0,0,0,'',7),(2,'RUA DOZE DE ABRIL LLLLL, 2321','CENTRO UNAI',1,'1-1543777911.jpeg','2-1543777911.png',NULL,1,'2018-11-30 04:01:32',1,50000.00,12000.00,4,2,3,'',6),(3,'RUA QUINZE DE ABRIL, 921','CENTRO',4,NULL,NULL,NULL,1,'2018-12-02 14:43:37',2,12.99,14.99,0,0,0,'observaÃ§Ãµes do imÃ³vel.',41.95),(4,'RUA CELSO DORNELAS, 521','CENTRO',1,NULL,NULL,'3-1543777946.png',1,'2018-12-02 14:53:49',3,12.99,14.99,0,0,2,'observaÃ§Ãµes do imÃ³vel.lsdlsk',43.95),(5,'RUA LUZIA PERIERA DE NORONHA, 415','PARAOPEPABA',2,'1-1543784632.jpeg',NULL,NULL,1,'2018-12-02 21:03:52',1,30000.00,2795.21,2,0,1,'adÃ§aldfladjlskdj',99.52);
/*!40000 ALTER TABLE `imoveis` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locacoes`
--

DROP TABLE IF EXISTS `locacoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `locacoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `locador_id` int(11) DEFAULT NULL,
  `data_locacao` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `valor_mensal` float(10,2) NOT NULL DEFAULT '0.00',
  `valor_venda` float(10,2) DEFAULT NULL,
  `valor_comissao` float(10,2) NOT NULL,
  `data_encerramento` date DEFAULT NULL,
  `status` tinyint(1) NOT NULL DEFAULT '1',
  `imovel_id` int(11) DEFAULT NULL,
  `dia_vencimento` int(11) NOT NULL DEFAULT '1',
  `dia_repasse` int(11) NOT NULL DEFAULT '1',
  PRIMARY KEY (`id`),
  KEY `locador_id` (`locador_id`),
  KEY `imovel_id` (`imovel_id`),
  CONSTRAINT `locacoes_ibfk_1` FOREIGN KEY (`locador_id`) REFERENCES `clientes` (`id`),
  CONSTRAINT `locacoes_ibfk_2` FOREIGN KEY (`imovel_id`) REFERENCES `imoveis` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locacoes`
--

LOCK TABLES `locacoes` WRITE;
/*!40000 ALTER TABLE `locacoes` DISABLE KEYS */;
/*!40000 ALTER TABLE `locacoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `pagamentos`
--

DROP TABLE IF EXISTS `pagamentos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `pagamentos` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `data_pagamento` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `imovel_id` int(11) DEFAULT NULL,
  `valor_pagamento` float(10,2) NOT NULL,
  `valor_comissao` float(10,2) NOT NULL,
  `valor_repasse` float(10,2) NOT NULL,
  `mes_referencia` date DEFAULT NULL,
  `data_repasse` date DEFAULT NULL,
  `observacao` text COLLATE utf8_unicode_ci,
  PRIMARY KEY (`id`),
  KEY `imovel_id` (`imovel_id`),
  CONSTRAINT `pagamentos_ibfk_1` FOREIGN KEY (`imovel_id`) REFERENCES `imoveis` (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `pagamentos`
--

LOCK TABLES `pagamentos` WRITE;
/*!40000 ALTER TABLE `pagamentos` DISABLE KEYS */;
/*!40000 ALTER TABLE `pagamentos` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permissoes`
--

DROP TABLE IF EXISTS `permissoes`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `permissoes` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `permissao` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permissoes`
--

LOCK TABLES `permissoes` WRITE;
/*!40000 ALTER TABLE `permissoes` DISABLE KEYS */;
INSERT INTO `permissoes` VALUES (1,'ADMIN'),(2,'USUARIO');
/*!40000 ALTER TABLE `permissoes` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `situacoes_imovel`
--

DROP TABLE IF EXISTS `situacoes_imovel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `situacoes_imovel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `situacoes_imovel`
--

LOCK TABLES `situacoes_imovel` WRITE;
/*!40000 ALTER TABLE `situacoes_imovel` DISABLE KEYS */;
INSERT INTO `situacoes_imovel` VALUES (1,'DISPONÍVEL'),(2,'REFORMA'),(3,'VENDIDO'),(4,'LOCADO');
/*!40000 ALTER TABLE `situacoes_imovel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_cliente`
--

DROP TABLE IF EXISTS `tipo_cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_cliente` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_cliente`
--

LOCK TABLES `tipo_cliente` WRITE;
/*!40000 ALTER TABLE `tipo_cliente` DISABLE KEYS */;
INSERT INTO `tipo_cliente` VALUES (1,'LOCATÃ¡RIO'),(2,'LOCADOR');
/*!40000 ALTER TABLE `tipo_cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_imovel`
--

DROP TABLE IF EXISTS `tipo_imovel`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `tipo_imovel` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `descricao` varchar(90) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_imovel`
--

LOCK TABLES `tipo_imovel` WRITE;
/*!40000 ALTER TABLE `tipo_imovel` DISABLE KEYS */;
INSERT INTO `tipo_imovel` VALUES (1,'CASA'),(2,'APTO'),(3,'COMÃ©RCIO'),(4,'FAZENDA');
/*!40000 ALTER TABLE `tipo_imovel` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuarios`
--

DROP TABLE IF EXISTS `usuarios`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!40101 SET character_set_client = utf8 */;
CREATE TABLE `usuarios` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `nome` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `senha` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `cpf` varchar(11) COLLATE utf8_unicode_ci NOT NULL,
  `status` tinyint(1) DEFAULT '0',
  `permissao_id` int(11) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `email` (`email`),
  UNIQUE KEY `cpf` (`cpf`),
  KEY `permissao_id` (`permissao_id`),
  CONSTRAINT `usuarios_ibfk_1` FOREIGN KEY (`permissao_id`) REFERENCES `permissoes` (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuarios`
--

LOCK TABLES `usuarios` WRITE;
/*!40000 ALTER TABLE `usuarios` DISABLE KEYS */;
INSERT INTO `usuarios` VALUES (1,'LUCAS FERREIRA','admin@admin.com','e10adc3949ba59abbe56e057f20f883e','4512972562',1,1);
/*!40000 ALTER TABLE `usuarios` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2018-12-03 21:11:16
