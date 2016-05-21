-- phpMyAdmin SQL Dump
-- version 4.1.14
-- http://www.phpmyadmin.net
--
-- Client :  127.0.0.1
-- Généré le :  Mer 18 Mai 2016 à 23:20
-- Version du serveur :  5.6.17
-- Version de PHP :  5.5.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Base de données :  `m1bd`
--

-- --------------------------------------------------------

--
-- Structure de la table `loi`
--
DROP TABLE loi;
DROP TABLE membre;
DROP TABLE projet;
DROP TABLE tache;

CREATE TABLE IF NOT EXISTS `loi` (
  `nom` varchar(20) NOT NULL,
  `para1` int(10) NOT NULL,
  `para2` int(10) NOT NULL,
  `para3` int(10) NOT NULL,
  `para4` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE IF NOT EXISTS `membre` (
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`email`, `pass`) VALUES
('chefprojet@unice.fr', 'chefdeprojet');

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE IF NOT EXISTS `projet` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nomp` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

CREATE TABLE IF NOT EXISTS `tache` (
  `id` int(5) NOT NULL AUTO_INCREMENT,
  `nom` varchar(50) NOT NULL,
  `duree` int(4) NOT NULL,
  `suivant1` varchar(50) NOT NULL,
  `suivant2` varchar(50) NOT NULL,
  `precedent1` varchar(50) NOT NULL,
  `precedent2` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=4 ;

--
-- Contenu de la table `tache`
--

INSERT INTO `tache` (`id`, `nom`, `duree`, `suivant1`, `suivant2`, `precedent1`, `precedent2`) VALUES
(1, 'conception', 8, 'dev front', 'dev back', 'Start', ''),
(2, 'dev front', 55, 'dev final', '', 'conception', ''),
(3, 'dev back', 89, 'dev final', '', 'conception', ''),
(4, 'dev final', 89, 'End', '', 'dev back', 'dev front');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
