-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le : jeu. 24 oct. 2024 à 13:47
-- Version du serveur : 8.3.0
-- Version de PHP : 8.2.18

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `projetcd`
--

-- --------------------------------------------------------

--
-- Structure de la table `cd`
--

DROP TABLE IF EXISTS `cd`;
CREATE TABLE IF NOT EXISTS `cd` (
  `titre` varchar(255) NOT NULL,
  `genre` varchar(255) NOT NULL,
  `auteur` varchar(255) NOT NULL,
  `prix` decimal(7,2) NOT NULL,
  `chemin_img` varchar(255) NOT NULL,
  `id` int NOT NULL AUTO_INCREMENT,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=20 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `cd`
--

INSERT INTO `cd` (`titre`, `genre`, `auteur`, `prix`, `chemin_img`, `id`) VALUES
('Bad', 'Dance%2FPop', 'Michael+Jackson', 76.00, 'img%2FBad.jpg', 1),
('Cleanin+Out+My+Closet', 'Hiphop%2FRap', 'Eminem', 100.00, 'img%2FCleanin+Out+My+Closet.jpg', 2),
('Curtain+call', 'Hiphop%2FRap', 'Eminem', 120.50, 'img%2FCurtain+Call.jpg', 3),
('Thriller%28Album%29', 'Funk+Pop+Rock', 'Michael+Jackson', 730.99, 'img%2FThriller.jpg', 4),
('Mon+Pays+C%27est+L%27amour', 'Pop%2FRock', 'Johnny+Hallyday', 3.00, 'img%2FMon+Pays.jpg', 5),
('Get+lucky', 'Funk', 'Daft+Punk', 600.00, 'img%2FGet_Lucky.jpg', 6);

-- --------------------------------------------------------

--
-- Structure de la table `compte`
--

DROP TABLE IF EXISTS `compte`;
CREATE TABLE IF NOT EXISTS `compte` (
  `id` int NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `pswrd` varchar(255) NOT NULL,
  `role` int NOT NULL COMMENT '1=Admin 2=User ',
  PRIMARY KEY (`id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb3;

--
-- Déchargement des données de la table `compte`
--

INSERT INTO `compte` (`id`, `login`, `pswrd`, `role`) VALUES
(1, 'Liam', '1234', 1),
(2, 'Gorka', '4321', 2);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
