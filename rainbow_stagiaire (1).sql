-- phpMyAdmin SQL Dump
-- version 5.0.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : mer. 03 avr. 2024 à 09:36
-- Version du serveur :  5.7.31
-- Version de PHP : 7.3.21

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `rainbow_stagiaire`
--

-- --------------------------------------------------------

--
-- Structure de la table `administrateur`
--

DROP TABLE IF EXISTS `administrateur`;
CREATE TABLE IF NOT EXISTS `administrateur` (
  `id_admin` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom_admin` varchar(100) NOT NULL,
  `email_admin` varchar(100) NOT NULL,
  `password_admin` varchar(20) NOT NULL,
  PRIMARY KEY (`id_admin`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `administrateur`
--

INSERT INTO `administrateur` (`id_admin`, `nom_admin`, `email_admin`, `password_admin`) VALUES
(3, 'admin', 'admin@gmail.com', 'admin12345');

-- --------------------------------------------------------

--
-- Structure de la table `attestation_stage`
--

DROP TABLE IF EXISTS `attestation_stage`;
CREATE TABLE IF NOT EXISTS `attestation_stage` (
  `id_attestation` int(11) NOT NULL,
  `contenu_attestation` varchar(500) NOT NULL,
  `id_stagiaire` bigint(20) NOT NULL,
  `id_admin` bigint(20) NOT NULL,
  PRIMARY KEY (`id_attestation`),
  UNIQUE KEY `id_stagiaire` (`id_stagiaire`),
  KEY `id_admin` (`id_admin`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `effectuer`
--

DROP TABLE IF EXISTS `effectuer`;
CREATE TABLE IF NOT EXISTS `effectuer` (
  `id_tache` bigint(20) NOT NULL,
  `id_stagiaire` bigint(20) NOT NULL,
  `etat_tache` varchar(50) NOT NULL,
  PRIMARY KEY (`id_tache`,`id_stagiaire`),
  KEY `id_stagiaire` (`id_stagiaire`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `message`
--

DROP TABLE IF EXISTS `message`;
CREATE TABLE IF NOT EXISTS `message` (
  `id_message` bigint(20) NOT NULL AUTO_INCREMENT,
  `contenu_message` varchar(200) NOT NULL,
  `date_message` datetime NOT NULL,
  `id_stagiaire` bigint(20) NOT NULL,
  `id_superviseur` bigint(20) NOT NULL,
  PRIMARY KEY (`id_message`),
  KEY `id_stagiaire` (`id_stagiaire`),
  KEY `id_superviseur` (`id_superviseur`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure de la table `stage`
--

DROP TABLE IF EXISTS `stage`;
CREATE TABLE IF NOT EXISTS `stage` (
  `id_stage` bigint(20) NOT NULL AUTO_INCREMENT,
  `debut_stage` date NOT NULL,
  `fin_stage` date NOT NULL,
  `libelle_stage` varchar(50) NOT NULL,
  `id_type_stage` bigint(20) NOT NULL,
  `id_admin` bigint(20) NOT NULL,
  PRIMARY KEY (`id_stage`),
  KEY `id_type_stage` (`id_type_stage`),
  KEY `id_admin` (`id_admin`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `stage`
--

INSERT INTO `stage` (`id_stage`, `debut_stage`, `fin_stage`, `libelle_stage`, `id_type_stage`, `id_admin`) VALUES
(1, '2023-02-01', '2022-05-01', 'Stage 1', 1, 1),
(5, '2023-06-05', '2023-11-11', 'Stage 2', 2, 1);

-- --------------------------------------------------------

--
-- Structure de la table `stagiaire`
--

DROP TABLE IF EXISTS `stagiaire`;
CREATE TABLE IF NOT EXISTS `stagiaire` (
  `id_stagiaire` bigint(20) NOT NULL AUTO_INCREMENT,
  `nom_stagiaire` varchar(100) NOT NULL,
  `email_stagiaire` varchar(100) NOT NULL,
  `password_stagiaire` varchar(50) NOT NULL,
  `tel_stagiaire` bigint(20) DEFAULT NULL,
  `ville_stagiaire` varchar(50) NOT NULL,
  `id_message` bigint(20) DEFAULT NULL,
  `id_superviseur` bigint(20) NOT NULL,
  `id_stage` bigint(20) NOT NULL,
  PRIMARY KEY (`id_stagiaire`),
  KEY `id_message` (`id_message`),
  KEY `id_superviseur` (`id_superviseur`),
  KEY `id_stage` (`id_stage`)
) ENGINE=MyISAM AUTO_INCREMENT=6 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `stagiaire`
--

INSERT INTO `stagiaire` (`id_stagiaire`, `nom_stagiaire`, `email_stagiaire`, `password_stagiaire`, `tel_stagiaire`, `ville_stagiaire`, `id_message`, `id_superviseur`, `id_stage`) VALUES
(1, 'SAA KEKO PASCALINE KELLY', 'pascalinekeko2@gmail.com', '100001', 691374521, 'YaoundÃ©', NULL, 1, 1),
(3, 'DIFFO KEKO SHARONE STONE', 'sharonekeko@gmail.com', 'SHARONE', 672342570, 'DSHANG', NULL, 1, 1),
(4, 'KENHAGUE KEKO ERICA FARELLE', 'ericakeko@gmail.com', 'ERICA', 680452102, 'Angers', NULL, 1, 1),
(5, 'MAKUETE IRENE', 'makueteirene@gmail.com', '11111', 62775705, 'Balessing', NULL, 2, 2);

-- --------------------------------------------------------

--
-- Structure de la table `superviseur`
--

DROP TABLE IF EXISTS `superviseur`;
CREATE TABLE IF NOT EXISTS `superviseur` (
  `id_superviseur` int(20) NOT NULL AUTO_INCREMENT,
  `nom_sup` varchar(100) NOT NULL,
  `email_sup` varchar(70) NOT NULL,
  `tel_sup` bigint(20) DEFAULT NULL,
  `password_sup` bigint(20) NOT NULL,
  `id_stage` bigint(20) NOT NULL,
  PRIMARY KEY (`id_superviseur`),
  UNIQUE KEY `id_stage` (`id_stage`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `superviseur`
--

INSERT INTO `superviseur` (`id_superviseur`, `nom_sup`, `email_sup`, `tel_sup`, `password_sup`, `id_stage`) VALUES
(1, 'NJINTZE ELVIS WILLIAM', 'elvisnjintze@gmail.com', 672342568, 10000, 2),
(3, 'EDY KOA', 'edykoa@gmail.com', 651427820, 100001, 1);

-- --------------------------------------------------------

--
-- Structure de la table `tache`
--

DROP TABLE IF EXISTS `tache`;
CREATE TABLE IF NOT EXISTS `tache` (
  `id_tache` int(11) NOT NULL AUTO_INCREMENT,
  `description_tache` varchar(200) NOT NULL,
  `debut_tache` date NOT NULL,
  `fin_tache` date NOT NULL,
  `id_superviseur` bigint(20) NOT NULL,
  PRIMARY KEY (`id_tache`),
  KEY `id_superviseur` (`id_superviseur`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8;

--
-- Déchargement des données de la table `tache`
--

INSERT INTO `tache` (`id_tache`, `description_tache`, `debut_tache`, `fin_tache`, `id_superviseur`) VALUES
(1, 'ma premiÃ¨re tache', '2024-03-30', '2024-04-02', 1),
(2, 'ma premiÃ¨re tache', '2024-03-30', '2024-04-02', 1),
(3, 'application de gestion des stages', '2024-04-02', '2024-04-05', 1);

-- --------------------------------------------------------

--
-- Structure de la table `type_stage`
--

DROP TABLE IF EXISTS `type_stage`;
CREATE TABLE IF NOT EXISTS `type_stage` (
  `id_type_stage` bigint(20) NOT NULL,
  `libelle_type_stage` varchar(50) NOT NULL,
  PRIMARY KEY (`id_type_stage`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
