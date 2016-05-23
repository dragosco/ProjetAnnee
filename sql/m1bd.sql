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

DROP TABLE IF EXISTS loiBeta;
DROP TABLE IF EXISTS loiTriangulaire;
DROP TABLE IF EXISTS loiNormale;
DROP TABLE IF EXISTS loi;
DROP TABLE IF EXISTS tache;
DROP TABLE IF EXISTS projet;
DROP TABLE IF EXISTS membre;

-- --------------------------------------------------------

--
-- Structure de la table `membre`
--

CREATE TABLE IF NOT EXISTS `membre` (
  `email` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `projet`
--

CREATE TABLE IF NOT EXISTS `projet` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nomp` varchar(50) NOT NULL,
  `description` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

CREATE TABLE IF NOT EXISTS `tache` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `idProjet` int(10) NOT NULL,
  `nom` varchar(50) NOT NULL,
  `suivant1` varchar(50) NOT NULL,
  `suivant2` varchar(50) NOT NULL,
  `precedent1` varchar(50) NOT NULL,
  `precedent2` varchar(50) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

--
-- Structure de la table `loi`
--

CREATE TABLE IF NOT EXISTS `loi` (
  `id` int(10) NOT NULL AUTO_INCREMENT,
  `nom` varchar(20) NOT NULL,
  `idTache` int(10) NOT NULL,
  `valeurMin` int(10) NOT NULL,
  `valeurMax` int(10) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

CREATE TABLE IF NOT EXISTS `loiBeta` (
  `id` int(10) NOT NULL,
  `w` decimal(10,2) NOT NULL,
  `v` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;

CREATE TABLE IF NOT EXISTS `loiTriangulaire` (
  `id` int(10) NOT NULL,
  `c` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;

CREATE TABLE IF NOT EXISTS `loiNormale` (
  `id` int(10) NOT NULL,
  `mu` decimal(10,2) NOT NULL,
  `sigma` decimal(10,2) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ;

ALTER TABLE tache
ADD FOREIGN KEY fk_projet(idProjet)
REFERENCES projet(id)
ON DELETE CASCADE;

ALTER TABLE loi
ADD FOREIGN KEY fk_tache(idTache)
REFERENCES tache(id)
ON DELETE CASCADE;

ALTER TABLE loiBeta
ADD FOREIGN KEY fk_loiBeta(id)
REFERENCES loi(id)
ON DELETE CASCADE;

ALTER TABLE loiTriangulaire
ADD FOREIGN KEY fk_loiTriangulaire(id)
REFERENCES loi(id)
ON DELETE CASCADE;

ALTER TABLE loiNormale
ADD FOREIGN KEY fk_loiNormale(id)
REFERENCES loi(id)
ON DELETE CASCADE;

INSERT INTO `projet` (`id`, `nomp`, `description`) VALUES
(1, 'projet', 'description');

--
-- Contenu de la table `tache`
--

INSERT INTO `tache` (`id`, `idProjet`, `nom`, `suivant1`, `suivant2`, `precedent1`, `precedent2`) VALUES
(1, 1, 'conception', 'dev front', 'dev back', 'Start', ''),
(2, 1, 'dev front', 'dev final', '', 'conception', ''),
(3, 1, 'dev back', 'dev final', '', 'conception', ''),
(4, 1, 'dev final', 'End', '', 'dev back', 'dev front'),
(5, 1, 'final', 'End', '', 'dev back', 'dev front');

INSERT INTO `loi` (`id`, `nom`, `idTache`, `valeurMin`, `valeurMax`) VALUES
(1, 'beta', 1, 0, 60),
(2, 'normale', 3, 0, 50),
(3, 'triangulaire', 2, 0, 55),
(4, 'uniforme', 4, 0, 45),
(5, 'sansLoi', 5, 15, 15);

INSERT INTO `loiBeta` (`id`, `w`, `v`) VALUES
(1, 1.5, 2);

INSERT INTO `loiNormale` (`id`, `mu`, `sigma`) VALUES
(2, 25, 5);

INSERT INTO `loiTriangulaire` (`id`, `c`) VALUES
(3, 1.5);

--
-- Contenu de la table `membre`
--

INSERT INTO `membre` (`email`, `pass`) VALUES
('chefprojet@unice.fr', 'chefdeprojet');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
