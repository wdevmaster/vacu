-- MySQL dump 10.13  Distrib 8.0.12, for Win64 (x86_64)
--
-- Host: localhost    Database: fincas
-- ------------------------------------------------------
-- Server version	8.0.12

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
 SET NAMES utf8 ;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `animal`
--

DROP TABLE IF EXISTS `animal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `animal` (
  `codigo` int(11) NOT NULL,
  `fecha_nacimiento` datetime NOT NULL,
  `sexo` varchar(45) NOT NULL,
  `lote_nacimientoId` int(11) NOT NULL,
  `madreCodigo` int(11) DEFAULT NULL,
  `padreCodigo` int(11) DEFAULT NULL,
  `raza_codigo` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  `lote_actual_Id` int(11) NOT NULL,
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `animal`
--

LOCK TABLES `animal` WRITE;
/*!40000 ALTER TABLE `animal` DISABLE KEYS */;
/*!40000 ALTER TABLE `animal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `cliente`
--

DROP TABLE IF EXISTS `cliente`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `cliente` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `telf` varchar(45) DEFAULT NULL,
  `negocioId` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `cliente`
--

LOCK TABLES `cliente` WRITE;
/*!40000 ALTER TABLE `cliente` DISABLE KEYS */;
/*!40000 ALTER TABLE `cliente` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `condicion_corporal`
--

DROP TABLE IF EXISTS `condicion_corporal`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `condicion_corporal` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `negocioId` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `condicion_corporal`
--

LOCK TABLES `condicion_corporal` WRITE;
/*!40000 ALTER TABLE `condicion_corporal` DISABLE KEYS */;
/*!40000 ALTER TABLE `condicion_corporal` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `configuracion`
--

DROP TABLE IF EXISTS `configuracion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `configuracion` (
  `idconfiguracion` int(11) NOT NULL AUTO_INCREMENT,
  `clave` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `valor` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idconfiguracion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `configuracion`
--

LOCK TABLES `configuracion` WRITE;
/*!40000 ALTER TABLE `configuracion` DISABLE KEYS */;
INSERT INTO `configuracion` VALUES (1,'USER_SINC','ultimo usuario sincronizando','0'),(2,'DATE_SINC','fecha y hora de ultima sincronizacion',NULL);
/*!40000 ALTER TABLE `configuracion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `enfermedad`
--

DROP TABLE IF EXISTS `enfermedad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `enfermedad` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `negocioId` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `enfermedad`
--

LOCK TABLES `enfermedad` WRITE;
/*!40000 ALTER TABLE `enfermedad` DISABLE KEYS */;
/*!40000 ALTER TABLE `enfermedad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `estado_fisico`
--

DROP TABLE IF EXISTS `estado_fisico`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `estado_fisico` (
  `codigo` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `active` tinyint(4) NOT NULL,
  `condicion_corporal_codigo` int(11) NOT NULL,
  `locomocion_codigo` int(11) NOT NULL,
  `animal_codigo` int(11) NOT NULL,
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `estado_fisico`
--

LOCK TABLES `estado_fisico` WRITE;
/*!40000 ALTER TABLE `estado_fisico` DISABLE KEYS */;
/*!40000 ALTER TABLE `estado_fisico` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `finca`
--

DROP TABLE IF EXISTS `finca`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `finca` (
  `idfinca` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `negocioId` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`idfinca`,`negocioId`),
  KEY `fk_finca_negocio_idx` (`negocioId`),
  CONSTRAINT `fk_finca_negocio` FOREIGN KEY (`negocioId`) REFERENCES `negocio` (`idnegocio`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `finca`
--

LOCK TABLES `finca` WRITE;
/*!40000 ALTER TABLE `finca` DISABLE KEYS */;
INSERT INTO `finca` VALUES (1,1,'Mi finca',1,1);
/*!40000 ALTER TABLE `finca` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `ingreso`
--

DROP TABLE IF EXISTS `ingreso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `ingreso` (
  `codigo` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `animal_codigo` int(11) DEFAULT NULL,
  `loteId` int(11) DEFAULT NULL,
  `active` tinyint(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `ingreso`
--

LOCK TABLES `ingreso` WRITE;
/*!40000 ALTER TABLE `ingreso` DISABLE KEYS */;
/*!40000 ALTER TABLE `ingreso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `inseminador`
--

DROP TABLE IF EXISTS `inseminador`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `inseminador` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `negocioId` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `inseminador`
--

LOCK TABLES `inseminador` WRITE;
/*!40000 ALTER TABLE `inseminador` DISABLE KEYS */;
/*!40000 ALTER TABLE `inseminador` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lactancia`
--

DROP TABLE IF EXISTS `lactancia`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lactancia` (
  `codigo` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `leche` decimal(10,0) NOT NULL,
  `concentrado` decimal(10,0) NOT NULL,
  `peso` decimal(10,0) NOT NULL,
  `animal_codigo` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lactancia`
--

LOCK TABLES `lactancia` WRITE;
/*!40000 ALTER TABLE `lactancia` DISABLE KEYS */;
/*!40000 ALTER TABLE `lactancia` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `locomocion`
--

DROP TABLE IF EXISTS `locomocion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `locomocion` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  `negocioId` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `locomocion`
--

LOCK TABLES `locomocion` WRITE;
/*!40000 ALTER TABLE `locomocion` DISABLE KEYS */;
/*!40000 ALTER TABLE `locomocion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `lote`
--

DROP TABLE IF EXISTS `lote`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `lote` (
  `idLote` int(11) NOT NULL AUTO_INCREMENT,
  `numero` int(11) DEFAULT NULL,
  `nombre` varchar(45) DEFAULT NULL,
  `fincaId` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`idLote`,`fincaId`),
  KEY `fk_lote_finca1_idx` (`fincaId`),
  CONSTRAINT `fk_lote_finca1` FOREIGN KEY (`fincaId`) REFERENCES `finca` (`idfinca`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `lote`
--

LOCK TABLES `lote` WRITE;
/*!40000 ALTER TABLE `lote` DISABLE KEYS */;
INSERT INTO `lote` VALUES (1,1,'Mi lote',1,1);
/*!40000 ALTER TABLE `lote` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `migrations`
--

DROP TABLE IF EXISTS `migrations`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `migrations` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `migration` varchar(199) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `migrations`
--

LOCK TABLES `migrations` WRITE;
/*!40000 ALTER TABLE `migrations` DISABLE KEYS */;
INSERT INTO `migrations` VALUES (1,'2014_10_12_000000_create_users_table',1),(2,'2014_10_12_100000_create_password_resets_table',1);
/*!40000 ALTER TABLE `migrations` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `motivo_muerte`
--

DROP TABLE IF EXISTS `motivo_muerte`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `motivo_muerte` (
  `idmotivo_muerte` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idmotivo_muerte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `motivo_muerte`
--

LOCK TABLES `motivo_muerte` WRITE;
/*!40000 ALTER TABLE `motivo_muerte` DISABLE KEYS */;
/*!40000 ALTER TABLE `motivo_muerte` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `muerte`
--

DROP TABLE IF EXISTS `muerte`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `muerte` (
  `codigo` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `motivoId` int(11) NOT NULL,
  `animal_codigo` int(11) NOT NULL,
  PRIMARY KEY (`motivoId`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`),
  KEY `fk_muerte_motivo_muerte1_idx` (`motivoId`),
  CONSTRAINT `fk_muerte_motivo_muerte1` FOREIGN KEY (`motivoId`) REFERENCES `motivo_muerte` (`idmotivo_muerte`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `muerte`
--

LOCK TABLES `muerte` WRITE;
/*!40000 ALTER TABLE `muerte` DISABLE KEYS */;
/*!40000 ALTER TABLE `muerte` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `negocio`
--

DROP TABLE IF EXISTS `negocio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `negocio` (
  `idNegocio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `jefe` varchar(45) DEFAULT NULL,
  `telf` varchar(45) DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`idNegocio`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `negocio`
--

LOCK TABLES `negocio` WRITE;
/*!40000 ALTER TABLE `negocio` DISABLE KEYS */;
INSERT INTO `negocio` VALUES (1,'Mi negocio','Jorge','78787713',1),(2,'Segundo negocio','Manuel','53252161',1);
/*!40000 ALTER TABLE `negocio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `parto`
--

DROP TABLE IF EXISTS `parto`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `parto` (
  `codigo` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `sexo` varchar(45) NOT NULL,
  `animal_nacido_codigo` int(11) DEFAULT NULL,
  `madre_codigo` int(11) NOT NULL,
  `raza_codigo` int(11) DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `parto`
--

LOCK TABLES `parto` WRITE;
/*!40000 ALTER TABLE `parto` DISABLE KEYS */;
/*!40000 ALTER TABLE `parto` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `password_resets`
--

DROP TABLE IF EXISTS `password_resets`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `password_resets` (
  `email` varchar(199) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(199) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  KEY `password_resets_email_index` (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `password_resets`
--

LOCK TABLES `password_resets` WRITE;
/*!40000 ALTER TABLE `password_resets` DISABLE KEYS */;
/*!40000 ALTER TABLE `password_resets` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `permiso`
--

DROP TABLE IF EXISTS `permiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `permiso` (
  `idpermiso` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) NOT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idpermiso`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `permiso`
--

LOCK TABLES `permiso` WRITE;
/*!40000 ALTER TABLE `permiso` DISABLE KEYS */;
/*!40000 ALTER TABLE `permiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `produccion`
--

DROP TABLE IF EXISTS `produccion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `produccion` (
  `codigo` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `peso` decimal(10,0) NOT NULL,
  `animal_codigo` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `produccion`
--

LOCK TABLES `produccion` WRITE;
/*!40000 ALTER TABLE `produccion` DISABLE KEYS */;
/*!40000 ALTER TABLE `produccion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `raza`
--

DROP TABLE IF EXISTS `raza`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `raza` (
  `codigo` int(11) NOT NULL,
  `nombre` varchar(45) NOT NULL,
  `negocioId` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `raza`
--

LOCK TABLES `raza` WRITE;
/*!40000 ALTER TABLE `raza` DISABLE KEYS */;
/*!40000 ALTER TABLE `raza` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `registro_enfermedad`
--

DROP TABLE IF EXISTS `registro_enfermedad`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `registro_enfermedad` (
  `codigo` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `active` tinyint(4) NOT NULL,
  `enfermedad_codigo` int(11) NOT NULL,
  `animal_codigo` int(11) NOT NULL,
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `registro_enfermedad`
--

LOCK TABLES `registro_enfermedad` WRITE;
/*!40000 ALTER TABLE `registro_enfermedad` DISABLE KEYS */;
/*!40000 ALTER TABLE `registro_enfermedad` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `rol`
--

DROP TABLE IF EXISTS `rol`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `rol` (
  `idrol` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idrol`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `rol`
--

LOCK TABLES `rol` WRITE;
/*!40000 ALTER TABLE `rol` DISABLE KEYS */;
INSERT INTO `rol` VALUES (1,'SUPER_ADMIN'),(2,'ADMIN'),(3,'VAQUERO');
/*!40000 ALTER TABLE `rol` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `semen`
--

DROP TABLE IF EXISTS `semen`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `semen` (
  `codigo` int(11) NOT NULL,
  `animal_codigo` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `semen`
--

LOCK TABLES `semen` WRITE;
/*!40000 ALTER TABLE `semen` DISABLE KEYS */;
/*!40000 ALTER TABLE `semen` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `servicio`
--

DROP TABLE IF EXISTS `servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `servicio` (
  `codigo` int(11) NOT NULL,
  `fecha` datetime NOT NULL,
  `animal_inseminador_codigo` int(11) DEFAULT NULL,
  `tipoId` int(11) NOT NULL,
  `animal_inseminado_codigo` int(11) NOT NULL,
  `semen_codigo` int(11) DEFAULT NULL,
  `persona_inseminador_codigo` int(11) DEFAULT NULL,
  `active` tinyint(4) NOT NULL,
  PRIMARY KEY (`tipoId`),
  UNIQUE KEY `codigo_UNIQUE` (`codigo`),
  KEY `fk_servicio_tipo_servicio1_idx` (`tipoId`),
  CONSTRAINT `fk_servicio_tipo_servicio1` FOREIGN KEY (`tipoId`) REFERENCES `tipo_servicio` (`idtipo_servicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `servicio`
--

LOCK TABLES `servicio` WRITE;
/*!40000 ALTER TABLE `servicio` DISABLE KEYS */;
/*!40000 ALTER TABLE `servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `sincronizacion`
--

DROP TABLE IF EXISTS `sincronizacion`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `sincronizacion` (
  `idsincronizacion` int(11) NOT NULL AUTO_INCREMENT,
  `tabla` varchar(45) NOT NULL,
  `codigo_remoto` int(11) NOT NULL,
  `codigo_actual` int(11) NOT NULL,
  PRIMARY KEY (`idsincronizacion`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `sincronizacion`
--

LOCK TABLES `sincronizacion` WRITE;
/*!40000 ALTER TABLE `sincronizacion` DISABLE KEYS */;
INSERT INTO `sincronizacion` VALUES (1,'animal',1,2),(2,'animal',1,3);
/*!40000 ALTER TABLE `sincronizacion` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tipo_servicio`
--

DROP TABLE IF EXISTS `tipo_servicio`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `tipo_servicio` (
  `idtipo_servicio` int(11) NOT NULL AUTO_INCREMENT,
  `nombre` varchar(45) DEFAULT NULL,
  `descripcion` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`idtipo_servicio`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tipo_servicio`
--

LOCK TABLES `tipo_servicio` WRITE;
/*!40000 ALTER TABLE `tipo_servicio` DISABLE KEYS */;
/*!40000 ALTER TABLE `tipo_servicio` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `users` (
  `id` bigint(20) unsigned NOT NULL AUTO_INCREMENT,
  `name` varchar(199) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(199) COLLATE utf8mb4_unicode_ci NOT NULL,
  `idRol` int(11) NOT NULL,
  `negocioId` int(11) NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(199) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `users_email_unique` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `users`
--

LOCK TABLES `users` WRITE;
/*!40000 ALTER TABLE `users` DISABLE KEYS */;
INSERT INTO `users` VALUES (1,'Admin','admin@fincas.com',1,1,NULL,'$2y$10$HnpZwRijRDDTJ8hmjgnsLu3QvG58LiLrNpMafQRKZIlfjyJqZEvLW','','2020-02-15 07:34:50','2020-02-15 07:34:50');
/*!40000 ALTER TABLE `users` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `usuario_permiso`
--

DROP TABLE IF EXISTS `usuario_permiso`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `usuario_permiso` (
  `userId` int(11) NOT NULL,
  `permisoId` int(11) NOT NULL,
  PRIMARY KEY (`userId`,`permisoId`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `usuario_permiso`
--

LOCK TABLES `usuario_permiso` WRITE;
/*!40000 ALTER TABLE `usuario_permiso` DISABLE KEYS */;
/*!40000 ALTER TABLE `usuario_permiso` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `venta`
--

DROP TABLE IF EXISTS `venta`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
 SET character_set_client = utf8mb4 ;
CREATE TABLE `venta` (
  `codigo` int(11) NOT NULL,
  `fecha` datetime DEFAULT NULL,
  `motivo` varchar(45) DEFAULT NULL,
  `cliente_codigo` int(11) NOT NULL,
  `animal_codigo` int(11) NOT NULL,
  `active` tinyint(4) NOT NULL,
  UNIQUE KEY `codigo_UNIQUE` (`codigo`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `venta`
--

LOCK TABLES `venta` WRITE;
/*!40000 ALTER TABLE `venta` DISABLE KEYS */;
/*!40000 ALTER TABLE `venta` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2020-02-14 21:50:35
