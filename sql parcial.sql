-- --------------------------------------------------------
-- Host:                         127.0.0.1
-- Versión del servidor:         10.4.22-MariaDB - mariadb.org binary distribution
-- SO del servidor:              Win64
-- HeidiSQL Versión:             11.0.0.5919
-- --------------------------------------------------------

/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET NAMES utf8 */;
/*!50503 SET NAMES utf8mb4 */;
/*!40014 SET @OLD_FOREIGN_KEY_CHECKS=@@FOREIGN_KEY_CHECKS, FOREIGN_KEY_CHECKS=0 */;
/*!40101 SET @OLD_SQL_MODE=@@SQL_MODE, SQL_MODE='NO_AUTO_VALUE_ON_ZERO' */;


-- Volcando estructura de base de datos para relocadb
CREATE DATABASE IF NOT EXISTS `relocadb` /*!40100 DEFAULT CHARACTER SET utf8mb4 */;
USE `relocadb`;

-- Volcando estructura para tabla relocadb.consulta
CREATE TABLE IF NOT EXISTS `consulta` (
  `con_id` int(11) NOT NULL AUTO_INCREMENT,
  `mas_id` varchar(12) NOT NULL,
  `vet_id` varchar(9) NOT NULL,
  `con_fecha` date NOT NULL,
  `con_diagnostico` varchar(200) DEFAULT NULL,
  `con_rayosX` varchar(256) DEFAULT NULL,
  `con_examensangre` varchar(256) DEFAULT NULL,
  `con_costo` decimal(5,2) DEFAULT 0.00,
  PRIMARY KEY (`con_id`),
  KEY `FK_consulta_mascota` (`mas_id`),
  KEY `FK_consulta_veterinario` (`vet_id`),
  CONSTRAINT `FK_consulta_mascota` FOREIGN KEY (`mas_id`) REFERENCES `mascota` (`mas_id`),
  CONSTRAINT `FK_consulta_veterinario` FOREIGN KEY (`vet_id`) REFERENCES `veterinario` (`vet_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla relocadb.consulta: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `consulta` DISABLE KEYS */;
REPLACE INTO `consulta` (`con_id`, `mas_id`, `vet_id`, `con_fecha`, `con_diagnostico`, `con_rayosX`, `con_examensangre`, `con_costo`) VALUES
	(1, '729761581', '72976158', '2022-03-24', 'Vacunación', 'http://res.cloudinary.com/dlydyow9o/image/upload/v1648104458/a3gth68kactx3i5qwibt.jpg', 'http://res.cloudinary.com/dlydyow9o/image/upload/v1648104459/u95rihvysyhiimw0fex0.pdf', 45.00),
	(2, '729761582', '72976158', '2022-03-27', 'infección', NULL, NULL, 1.00);
/*!40000 ALTER TABLE `consulta` ENABLE KEYS */;

-- Volcando estructura para tabla relocadb.detallesprescripción
CREATE TABLE IF NOT EXISTS `detallesprescripción` (
  `con_id` int(11) NOT NULL DEFAULT 0,
  `med_id` varchar(9) NOT NULL,
  `det_cantidad` int(11) DEFAULT NULL,
  `det_costoUnit` decimal(5,2) NOT NULL,
  `det_subtotal` decimal(5,2) NOT NULL,
  KEY `FK_detalles_medicamento` (`med_id`),
  KEY `FK_detalles_consulta` (`con_id`),
  CONSTRAINT `FK_detalles_consulta` FOREIGN KEY (`con_id`) REFERENCES `consulta` (`con_id`),
  CONSTRAINT `FK_detalles_medicamento` FOREIGN KEY (`med_id`) REFERENCES `medicamento` (`med_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla relocadb.detallesprescripción: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `detallesprescripción` DISABLE KEYS */;
REPLACE INTO `detallesprescripción` (`con_id`, `med_id`, `det_cantidad`, `det_costoUnit`, `det_subtotal`) VALUES
	(1, '1', 2, 1.95, 3.90),
	(1, '1', 2, 1.95, 3.90),
	(1, '2', 1, 3.00, 3.00);
/*!40000 ALTER TABLE `detallesprescripción` ENABLE KEYS */;

-- Volcando estructura para tabla relocadb.dueño
CREATE TABLE IF NOT EXISTS `dueño` (
  `due_id` varchar(9) NOT NULL,
  `due_nombre` varchar(30) NOT NULL,
  `due_apellido` varchar(30) NOT NULL,
  `due_correo` varchar(25) DEFAULT NULL,
  `due_telefono` varchar(15) DEFAULT NULL,
  `due_deuda` decimal(5,2) DEFAULT 0.00,
  PRIMARY KEY (`due_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla relocadb.dueño: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `dueño` DISABLE KEYS */;
REPLACE INTO `dueño` (`due_id`, `due_nombre`, `due_apellido`, `due_correo`, `due_telefono`, `due_deuda`) VALUES
	('72976158', 'Daniel', 'Cifuentes', 'daercimi@gmail.com', '973198435', 86.00);
/*!40000 ALTER TABLE `dueño` ENABLE KEYS */;

-- Volcando estructura para tabla relocadb.mascota
CREATE TABLE IF NOT EXISTS `mascota` (
  `mas_id` varchar(12) NOT NULL,
  `due_id` varchar(9) NOT NULL,
  `mas_nombre` varchar(25) NOT NULL,
  `mas_especie` varchar(20) NOT NULL,
  `mas_raza` varchar(25) NOT NULL,
  `mas_fechanac` date DEFAULT NULL,
  `mas_genero` int(11) DEFAULT NULL,
  `mas_foto` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`mas_id`),
  KEY `FK_mascota_dueño` (`due_id`),
  CONSTRAINT `FK_mascota_dueño` FOREIGN KEY (`due_id`) REFERENCES `dueño` (`due_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla relocadb.mascota: ~4 rows (aproximadamente)
/*!40000 ALTER TABLE `mascota` DISABLE KEYS */;
REPLACE INTO `mascota` (`mas_id`, `due_id`, `mas_nombre`, `mas_especie`, `mas_raza`, `mas_fechanac`, `mas_genero`, `mas_foto`) VALUES
	('729761581', '72976158', 'Inupi', 'Perro', 'Chusco', '2022-02-01', 0, 'http://res.cloudinary.com/dlydyow9o/image/upload/v1648101236/ah10rw5zkwubx0zmazxx.jpg'),
	('729761582', '72976158', 'Barbas', 'Perro', 'Schnawzer', '2019-03-02', 0, 'http://res.cloudinary.com/dlydyow9o/image/upload/v1648101474/uzdiuut3lqjkecawbyin.jpg'),
	('729761583', '72976158', 'Smiley', 'Perro', 'Bulldog', '2010-03-02', 0, 'http://res.cloudinary.com/dlydyow9o/image/upload/v1648101520/viblq9uuujytmvvzu9ck.jpg');
/*!40000 ALTER TABLE `mascota` ENABLE KEYS */;

-- Volcando estructura para tabla relocadb.medicamento
CREATE TABLE IF NOT EXISTS `medicamento` (
  `med_id` varchar(9) NOT NULL,
  `med_nombre` varchar(50) NOT NULL DEFAULT '',
  `med_costo` decimal(5,2) NOT NULL,
  PRIMARY KEY (`med_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla relocadb.medicamento: ~2 rows (aproximadamente)
/*!40000 ALTER TABLE `medicamento` DISABLE KEYS */;
REPLACE INTO `medicamento` (`med_id`, `med_nombre`, `med_costo`) VALUES
	('1', 'Amoxicilina', 1.30),
	('2', 'Clorfenamina', 1.20),
	('3', 'Panadol', 7.50);
/*!40000 ALTER TABLE `medicamento` ENABLE KEYS */;

-- Volcando estructura para tabla relocadb.veterinario
CREATE TABLE IF NOT EXISTS `veterinario` (
  `vet_id` varchar(9) NOT NULL,
  `vet_nombre` varchar(30) NOT NULL,
  `vet_apellido` varchar(30) NOT NULL,
  `vet_correo` varchar(25) DEFAULT NULL,
  `vet_telefono` varchar(15) DEFAULT NULL,
  `vet_contraseña` varchar(256) DEFAULT NULL,
  PRIMARY KEY (`vet_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- Volcando datos para la tabla relocadb.veterinario: ~0 rows (aproximadamente)
/*!40000 ALTER TABLE `veterinario` DISABLE KEYS */;
REPLACE INTO `veterinario` (`vet_id`, `vet_nombre`, `vet_apellido`, `vet_correo`, `vet_telefono`, `vet_contraseña`) VALUES
	('72976158', 'Daniel', 'Cifuentes', 'daercimi@gmail.com', '973198435', '8036c843231e91821faf49058d57a68a');
/*!40000 ALTER TABLE `veterinario` ENABLE KEYS */;

/*!40101 SET SQL_MODE=IFNULL(@OLD_SQL_MODE, '') */;
/*!40014 SET FOREIGN_KEY_CHECKS=IF(@OLD_FOREIGN_KEY_CHECKS IS NULL, 1, @OLD_FOREIGN_KEY_CHECKS) */;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
