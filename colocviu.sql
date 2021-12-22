-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 03, 2021 at 09:10 PM
-- Server version: 10.4.11-MariaDB
-- PHP Version: 7.4.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `colocviu`
--

DELIMITER $$
--
-- Procedures
--
CREATE DEFINER=`root`@`localhost` PROCEDURE `getCompOras` (IN `poras` INT(25))  NO SQL
SELECT numec
FROM componente 
JOIN livrari USING(idc) 
JOIN proiecte USING(idp)
	WHERE proiecte.oras = poras
	AND cantitate <= ALL(
		SELECT cantitate 
        FROM proiecte 
        JOIN livrari USING(idp)
                WHERE oras = poras)$$

DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `componente`
--

CREATE TABLE `componente` (
  `idc` varchar(5) NOT NULL,
  `numec` varchar(50) NOT NULL,
  `culoare` varchar(15) DEFAULT NULL,
  `masa` float(5,2) DEFAULT NULL,
  `oras` varchar(25) DEFAULT NULL
) ;

--
-- Dumping data for table `componente`
--

INSERT INTO `componente` (`idc`, `numec`, `culoare`, `masa`, `oras`) VALUES
('C0000', 'a', 'rosu', 350.00, 'Dej'),
('C0001', 'ax', 'albastru', 50.00, 'Cluj - Napoca'),
('C0002', 'xdbn', 'galben', 290.00, 'Cluj - Napoca'),
('C1', 'exemplu5a', 'albastru', 23.55, 'Cluj - Napoca'),
('C12', 'comp', 'galben', 15.00, 'Bistrita');

-- --------------------------------------------------------

--
-- Table structure for table `furnizori`
--

CREATE TABLE `furnizori` (
  `idf` varchar(5) NOT NULL,
  `numef` varchar(50) NOT NULL,
  `stare` int(3) NOT NULL,
  `oras` varchar(25) DEFAULT NULL
) ;

--
-- Dumping data for table `furnizori`
--

INSERT INTO `furnizori` (`idf`, `numef`, `stare`, `oras`) VALUES
('F0000', 'compania1', 3, 'Cluj - Napoca'),
('F0001', 'abcd', 1, 'Cluj - Napoca'),
('F0003', 'ndasj', 1, 'Gherla'),
('F0004', ' vcgsf', 2, 'Dej'),
('F001', 'compania2', 4, 'Bistrita'),
('F11', 'fajsd', 0, 'Sibiu'),
('F123', 'Prim', 1, 'Sibiu'),
('F42', 'test_trig_7a', 1, 'Bistrita');

-- --------------------------------------------------------

--
-- Table structure for table `livrari`
--

CREATE TABLE `livrari` (
  `idf` varchar(5) NOT NULL,
  `idc` varchar(5) NOT NULL,
  `idp` varchar(5) NOT NULL,
  `cantitate` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `livrari`
--

INSERT INTO `livrari` (`idf`, `idc`, `idp`, `cantitate`) VALUES
('F0000', 'C0000', 'P0000', 10),
('F0001', 'C0002', 'P0001', 10),
('F0001', 'C0002', 'P0002', 3),
('F0004', 'C0000', 'P0002', 9),
('F0004', 'C12', 'P0001', 13),
('F0003', 'C12', 'P0000', 25),
('F0003', 'C12', 'P0002', 7),
('F0000', 'C0001', 'P0002', 23),
('F0000', 'C0001', 'P0000', 23),
('F11', 'C1', 'P0000', 1);

-- --------------------------------------------------------

--
-- Table structure for table `proiecte`
--

CREATE TABLE `proiecte` (
  `idp` varchar(5) NOT NULL,
  `numep` varchar(50) NOT NULL,
  `oras` varchar(25) DEFAULT NULL
) ;

--
-- Dumping data for table `proiecte`
--

INSERT INTO `proiecte` (`idp`, `numep`, `oras`) VALUES
('P0000', 'a_special', 'Dej'),
('P0001', 'jvhk', 'Cluj - Napoca'),
('P0002', 'lgesd', 'Bistrita'),
('P22', 'test', 'Bistrita'),
('P23', 'test_special', 'Dej'),
('P24', 'specialtest', 'Dej'),
('P312', 'proiect_prim', 'Sibiu');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `componente`
--
ALTER TABLE `componente`
  ADD PRIMARY KEY (`idc`);

--
-- Indexes for table `furnizori`
--
ALTER TABLE `furnizori`
  ADD PRIMARY KEY (`idf`);

--
-- Indexes for table `livrari`
--
ALTER TABLE `livrari`
  ADD KEY `idc` (`idc`),
  ADD KEY `idf` (`idf`),
  ADD KEY `idp` (`idp`);

--
-- Indexes for table `proiecte`
--
ALTER TABLE `proiecte`
  ADD PRIMARY KEY (`idp`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `livrari`
--
ALTER TABLE `livrari`
  ADD CONSTRAINT `livrari_ibfk_1` FOREIGN KEY (`idc`) REFERENCES `componente` (`idc`),
  ADD CONSTRAINT `livrari_ibfk_2` FOREIGN KEY (`idf`) REFERENCES `furnizori` (`idf`),
  ADD CONSTRAINT `livrari_ibfk_3` FOREIGN KEY (`idp`) REFERENCES `proiecte` (`idp`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
