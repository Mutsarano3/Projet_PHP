-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3308
-- Généré le :  ven. 07 juin 2019 à 22:23
-- Version du serveur :  5.7.23
-- Version de PHP :  7.1.22

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `projet_php`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `id_admin` int(3) NOT NULL AUTO_INCREMENT,
  `email` varchar(60) NOT NULL,
  `Mot_passe` varchar(75) NOT NULL,
  PRIMARY KEY (`id_admin`),
  UNIQUE KEY `email` (`email`)
) ENGINE=InnoDB AUTO_INCREMENT=25 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`id_admin`, `email`, `Mot_passe`) VALUES
(24, 'thomasbeaugoss@hotmail.com', '8e4294f32af573d03e6c8a83690cbe8c0f77e3a1');

-- --------------------------------------------------------

--
-- Structure de la table `annonce`
--

DROP TABLE IF EXISTS `annonce`;
CREATE TABLE IF NOT EXISTS `annonce` (
  `id` int(3) NOT NULL,
  `annonce` text NOT NULL,
  `date_envoi` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `categorie`
--

DROP TABLE IF EXISTS `categorie`;
CREATE TABLE IF NOT EXISTS `categorie` (
  `Num_Categorie` int(10) NOT NULL,
  `Nom_Categorie` varchar(13) NOT NULL,
  PRIMARY KEY (`Num_Categorie`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `categorie`
--

INSERT INTO `categorie` (`Num_Categorie`, `Nom_Categorie`) VALUES
(1, 'Arduino'),
(2, 'RaspBerrys'),
(3, 'MControleur'),
(4, 'Capteurs');

-- --------------------------------------------------------

--
-- Structure de la table `chat`
--

DROP TABLE IF EXISTS `chat`;
CREATE TABLE IF NOT EXISTS `chat` (
  `email` varchar(35) NOT NULL,
  `Date_Envoi` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Message` text NOT NULL,
  KEY `fk_chat` (`email`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `commande`
--

DROP TABLE IF EXISTS `commande`;
CREATE TABLE IF NOT EXISTS `commande` (
  `ID_users` int(10) NOT NULL,
  `ID_Materiel` int(10) NOT NULL,
  `Date_commande` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Num_Commande` int(10) NOT NULL AUTO_INCREMENT,
  `lieux_commande` varchar(45) DEFAULT NULL,
  PRIMARY KEY (`Num_Commande`),
  KEY `fr_key_commande1` (`ID_users`),
  KEY `fr_key_commande2` (`ID_Materiel`)
) ENGINE=InnoDB AUTO_INCREMENT=24 DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `materiel`
--

DROP TABLE IF EXISTS `materiel`;
CREATE TABLE IF NOT EXISTS `materiel` (
  `ID_Materiel` int(10) NOT NULL AUTO_INCREMENT,
  `Nom_Materiel` varchar(35) NOT NULL,
  `Marque` varchar(12) NOT NULL,
  `Num_categorie` int(10) NOT NULL,
  `Prix` decimal(6,2) DEFAULT '0.00',
  `Date_Insert` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `Stock` int(12) NOT NULL,
  `images` varchar(55) NOT NULL,
  PRIMARY KEY (`ID_Materiel`),
  KEY `fr_key_materiel` (`Num_categorie`)
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `materiel`
--

INSERT INTO `materiel` (`ID_Materiel`, `Nom_Materiel`, `Marque`, `Num_categorie`, `Prix`, `Date_Insert`, `Stock`, `images`) VALUES
(34, 'Arduino', 'OXBOX', 1, '50.00', '2019-05-08 20:33:41', 0, 'raspberry.jpg'),
(35, 'RaspBerrys 3B+', 'AOBOX', 2, '35.00', '2019-05-10 08:39:20', 1, 'raspberry.jpg'),
(36, 'L892N', 'Arduino', 3, '12.00', '2019-05-11 19:17:20', 3, 'arduino.jpg');

-- --------------------------------------------------------

--
-- Structure de la table `panier`
--

DROP TABLE IF EXISTS `panier`;
CREATE TABLE IF NOT EXISTS `panier` (
  `ID_Materiel` int(10) NOT NULL,
  `ID_users` int(10) NOT NULL,
  `Date_panier` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  KEY `fr_us_panier` (`ID_users`),
  KEY `fr_materiel_panier` (`ID_Materiel`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `ID_users` int(10) NOT NULL AUTO_INCREMENT,
  `Nom` varchar(13) NOT NULL,
  `Prenom` varchar(13) NOT NULL,
  `Email` varchar(35) NOT NULL,
  `Mot_de_passe` varchar(75) NOT NULL,
  `Date_Naissance` date NOT NULL,
  `Sexe` enum('h','f') NOT NULL,
  `Solde` decimal(6,2) NOT NULL DEFAULT '0.00',
  `Pays` varchar(13) NOT NULL,
  `Localite` varchar(12) NOT NULL,
  `Rue` varchar(40) NOT NULL,
  `admin` int(5) NOT NULL DEFAULT '1',
  PRIMARY KEY (`ID_users`),
  UNIQUE KEY `Email` (`Email`)
) ENGINE=InnoDB AUTO_INCREMENT=86 DEFAULT CHARSET=latin1;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `fk_annonce` FOREIGN KEY (`email`) REFERENCES `users` (`Email`);

--
-- Contraintes pour la table `commande`
--
ALTER TABLE `commande`
  ADD CONSTRAINT `fr_key_commande1` FOREIGN KEY (`ID_users`) REFERENCES `users` (`ID_users`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fr_key_commande2` FOREIGN KEY (`ID_Materiel`) REFERENCES `materiel` (`ID_Materiel`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `materiel`
--
ALTER TABLE `materiel`
  ADD CONSTRAINT `fk_categorie` FOREIGN KEY (`Num_categorie`) REFERENCES `categorie` (`Num_Categorie`),
  ADD CONSTRAINT `fr_key_materiel` FOREIGN KEY (`Num_categorie`) REFERENCES `categorie` (`Num_Categorie`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
