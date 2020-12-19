-- phpMyAdmin SQL Dump
-- version 5.0.3
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Nov 26, 2020 at 04:46 AM
-- Server version: 10.4.14-MariaDB
-- PHP Version: 7.2.34

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `academia`
--

-- --------------------------------------------------------

--
-- Table structure for table `alumnos`
--

CREATE TABLE `alumnos` (
  `controlNumber` varchar(10) NOT NULL,
  `userFirstName` varchar(80) DEFAULT NULL,
  `lastName` varchar(80) DEFAULT NULL,
  `career` tinytext DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `userPassword` text DEFAULT NULL,
  `semestre` int(11) DEFAULT NULL,
  `grupo` char(1) DEFAULT NULL,
  `anteproyectoDoc` mediumtext DEFAULT NULL,
  `extAsesor` varchar(10) DEFAULT NULL,
  `intAsesor` int(11) DEFAULT NULL,
  `tipo_usuario` tinytext DEFAULT 'User'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `alumnos`
--

INSERT INTO `alumnos` (`controlNumber`, `userFirstName`, `lastName`, `career`, `email`, `userPassword`, `semestre`, `grupo`, `anteproyectoDoc`, `extAsesor`, `intAsesor`, `tipo_usuario`) VALUES
('166A0505', 'Salomon', 'Piña', 'Ing. en Sistemas Computacionales', '123@test.com', '$2y$10$EDVd.r6rPPwfFAvzO9Ux2OJeiM1gcVTKyBd3DjN219N2990DVW2RG', 8, 'b', NULL, NULL, NULL, 'User'),
('166P0505', 'Salomon', 'Piña', 'Ing. en Sistemas Computacionales', 'sarquamon@gmail.com', '$2y$10$xSo75lhM.j8/SAY1rkzUQOyqXHjBxYNrouQ2c72WLVUURJkcj/9Nm', 9, 'B', '5fbf227324d2a6.92788864.docx', NULL, NULL, 'User');

-- --------------------------------------------------------

--
-- Table structure for table `asesoresinternos`
--

CREATE TABLE `asesoresinternos` (
  `idAsesorInt` int(11) NOT NULL,
  `nameAsesorInt` tinytext DEFAULT NULL,
  `lastNameMaestro` tinytext DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `contactNumber` tinytext DEFAULT NULL,
  `companyName` varchar(150) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `justificantes`
--

CREATE TABLE `justificantes` (
  `idJustificante` int(11) NOT NULL,
  `controlNumber` varchar(10) DEFAULT NULL,
  `reason` varchar(100) DEFAULT NULL,
  `JustiDay` int(11) DEFAULT NULL,
  `JustiMonth` int(11) DEFAULT NULL,
  `detailedInfo` text DEFAULT NULL,
  `fechaCreacion` date NOT NULL DEFAULT current_timestamp(),
  `estado` varchar(12) NOT NULL DEFAULT 'En espera'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `justificantes`
--

INSERT INTO `justificantes` (`idJustificante`, `controlNumber`, `reason`, `JustiDay`, `JustiMonth`, `detailedInfo`, `fechaCreacion`, `estado`) VALUES
(4, '166P0505', '123123123123', 1, 1, 'hola!', '2020-11-20', 'Aprobado'),
(19, '166P0505', '123', 1, 1, '123123123', '2020-11-25', 'Aprobado'),
(22, '166P0505', 'hola', 13, 10, '1234', '2020-11-25', 'Aprobado');

-- --------------------------------------------------------

--
-- Table structure for table `maestros`
--

CREATE TABLE `maestros` (
  `controlNumber` varchar(10) NOT NULL,
  `nameMaestro` tinytext DEFAULT NULL,
  `lastNameMaestro` tinytext DEFAULT NULL,
  `email` varchar(80) DEFAULT NULL,
  `adminTeacherPwd` text NOT NULL,
  `tipo_usuario` tinytext DEFAULT 'Maestro'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `maestros`
--

INSERT INTO `maestros` (`controlNumber`, `nameMaestro`, `lastNameMaestro`, `email`, `adminTeacherPwd`, `tipo_usuario`) VALUES
('166B0505', 'Luisa', 'Matinez', '123@test.com', '$2y$10$HwdmDcLyU2J.lsmAsnhbV.d44BEqLhonYnQLeac8JxCrwlCBMsYGK', 'Maestro'),
('166F0505', 'Silvia', 'Casares', 'salo711@hotmail.com', '$2y$10$dCz7fuTLjCyK5qbQ.iTgX.i4JPPaDcGonpEquZKU37nR91I2y8eQq', 'Administrador');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `alumnos`
--
ALTER TABLE `alumnos`
  ADD PRIMARY KEY (`controlNumber`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `extAsesor` (`extAsesor`),
  ADD KEY `intAsesor` (`intAsesor`);

--
-- Indexes for table `asesoresinternos`
--
ALTER TABLE `asesoresinternos`
  ADD PRIMARY KEY (`idAsesorInt`),
  ADD UNIQUE KEY `email` (`email`);

--
-- Indexes for table `justificantes`
--
ALTER TABLE `justificantes`
  ADD PRIMARY KEY (`idJustificante`),
  ADD KEY `controlNumber` (`controlNumber`);

--
-- Indexes for table `maestros`
--
ALTER TABLE `maestros`
  ADD PRIMARY KEY (`controlNumber`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `asesoresinternos`
--
ALTER TABLE `asesoresinternos`
  MODIFY `idAsesorInt` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `justificantes`
--
ALTER TABLE `justificantes`
  MODIFY `idJustificante` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `alumnos`
--
ALTER TABLE `alumnos`
  ADD CONSTRAINT `alumnos_ibfk_1` FOREIGN KEY (`extAsesor`) REFERENCES `maestros` (`controlNumber`),
  ADD CONSTRAINT `alumnos_ibfk_2` FOREIGN KEY (`intAsesor`) REFERENCES `asesoresinternos` (`idAsesorInt`);

--
-- Constraints for table `justificantes`
--
ALTER TABLE `justificantes`
  ADD CONSTRAINT `justificantes_ibfk_1` FOREIGN KEY (`controlNumber`) REFERENCES `alumnos` (`controlNumber`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
