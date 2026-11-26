-- MySQL dump 10.13  Distrib 8.0.46, for Win64 (x86_64)
--
-- Host: localhost    Database: dblibreria
-- ------------------------------------------------------
-- Server version	8.0.46

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!50503 SET NAMES utf8 */;
/*!40103 SET @OLD_TIME_ZONE=@@TIME_ZONE */;
/*!40103 SET TIME_ZONE='+00:00' */;
/*!40014 SET @OLD_UNIQUE_CHECKS=@@UNIQUE_CHECKS, UNIQUE_CHECKS=0 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;
/*!40111 SET @OLD_SQL_NOTES=@@SQL_NOTES, SQL_NOTES=0 */;

--
-- Table structure for table `publicadores`
--

DROP TABLE IF EXISTS `publicadores`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `publicadores` (
  `id_pub` char(4) COLLATE utf8mb4_general_ci NOT NULL,
  `nombre_pub` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `ciudad` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `estado` char(2) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pais` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_pub`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `publicadores`
--

LOCK TABLES `publicadores` WRITE;
/*!40000 ALTER TABLE `publicadores` DISABLE KEYS */;
INSERT INTO `publicadores` VALUES ('P001','Editorial Caribe','Santo Domingo','DN','República Dominicana'),('P002','Ediciones Tecnológicas','Santiago','ST','República Dominicana'),('P003','Grupo Editorial Universitario','Santo Domingo','DN','República Dominicana');
/*!40000 ALTER TABLE `publicadores` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `tiendas`
--

DROP TABLE IF EXISTS `tiendas`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `tiendas` (
  `id_tienda` char(4) COLLATE utf8mb4_general_ci NOT NULL,
  `nombre_tienda` varchar(40) COLLATE utf8mb4_general_ci NOT NULL,
  `direcc_tienda` varchar(40) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `ciudad` varchar(20) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `estado` char(2) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `pais` varchar(30) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `cod_postal` char(5) COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`id_tienda`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `tiendas`
--

LOCK TABLES `tiendas` WRITE;
/*!40000 ALTER TABLE `tiendas` DISABLE KEYS */;
INSERT INTO `tiendas` VALUES ('T001','Librería Central','Av. 27 de Febrero #145','Santo Domingo','DN','República Dominicana','10101'),('T002','Libros del Cibao','Calle El Sol #42','Santiago','ST','República Dominicana','51000'),('T003','Librería Universitaria','Av. Alma Mater #108','Santo Domingo','DN','República Dominicana','10105');
/*!40000 ALTER TABLE `tiendas` ENABLE KEYS */;
UNLOCK TABLES;

--
-- Table structure for table `titulos`
--

DROP TABLE IF EXISTS `titulos`;
/*!40101 SET @saved_cs_client     = @@character_set_client */;
/*!50503 SET character_set_client = utf8mb4 */;
CREATE TABLE `titulos` (
  `id_titulo` varchar(6) COLLATE utf8mb4_general_ci NOT NULL,
  `titulo` varchar(80) COLLATE utf8mb4_general_ci NOT NULL,
  `tipo` char(12) COLLATE utf8mb4_general_ci DEFAULT 'General',
  `id_pub` char(4) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `precio` decimal(10,2) DEFAULT '0.00',
  `notas` varchar(200) COLLATE utf8mb4_general_ci DEFAULT NULL,
  `fecha_pub` date DEFAULT NULL,
  PRIMARY KEY (`id_titulo`),
  KEY `id_pub` (`id_pub`),
  CONSTRAINT `titulos_ibfk_1` FOREIGN KEY (`id_pub`) REFERENCES `publicadores` (`id_pub`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;
/*!40101 SET character_set_client = @saved_cs_client */;

--
-- Dumping data for table `titulos`
--

LOCK TABLES `titulos` WRITE;
/*!40000 ALTER TABLE `titulos` DISABLE KEYS */;
INSERT INTO `titulos` VALUES ('L001','Fundamentos de Bases de Datos','Bases Datos','P001',24.50,'Modelado relacional, normalización y consultas SQL.','2026-08-15'),('L002','Desarrollo Web Moderno con PHP 8','Programación','P002',29.99,'Programación orientada a objetos, PDO y seguridad.','2026-09-10'),('L003','Estructuras de Datos y Algoritmos','Algoritmos','P003',22.00,'Guía práctica de listas, árboles y ordenamiento.','2026-10-05');
/*!40000 ALTER TABLE `titulos` ENABLE KEYS */;
UNLOCK TABLES;
/*!40103 SET TIME_ZONE=@OLD_TIME_ZONE */;

/*!40101 SET SQL_MODE=@OLD_SQL_MODE */;
/*!40014 SET FOREIGN_KEY_CHECKS=@OLD_FOREIGN_KEY_CHECKS */;
/*!40014 SET UNIQUE_CHECKS=@OLD_UNIQUE_CHECKS */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
/*!40111 SET SQL_NOTES=@OLD_SQL_NOTES */;

-- Dump completed on 2026-11-25 20:27:40
