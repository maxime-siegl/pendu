-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1:3306
-- Généré le :  mar. 18 août 2020 à 07:37
-- Version du serveur :  10.4.10-MariaDB
-- Version de PHP :  7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `pendu`
--

-- --------------------------------------------------------

--
-- Structure de la table `leaderboard`
--

DROP TABLE IF EXISTS `leaderboard`;
CREATE TABLE IF NOT EXISTS `leaderboard` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `id_utilisateur` int(11) NOT NULL,
  `victoire` int(11) NOT NULL DEFAULT 0,
  `defaite` int(11) NOT NULL DEFAULT 0,
  `nb_lettre` int(11) NOT NULL DEFAULT 0,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `leaderboard`
--

INSERT INTO `leaderboard` (`id`, `id_utilisateur`, `victoire`, `defaite`, `nb_lettre`) VALUES
(1, 2, 1, 0, 16),
(5, 1, 14, 5, 130),
(9, 3, 0, 1, 11);

-- --------------------------------------------------------

--
-- Structure de la table `utilisateurs`
--

DROP TABLE IF EXISTS `utilisateurs`;
CREATE TABLE IF NOT EXISTS `utilisateurs` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `login` varchar(255) NOT NULL,
  `mdp` varchar(255) NOT NULL,
  `game` int(11) NOT NULL DEFAULT 0,
  `avatar` varchar(255) NOT NULL DEFAULT 'avatar_defaut.jpg',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `utilisateurs`
--

INSERT INTO `utilisateurs` (`id`, `login`, `mdp`, `game`, `avatar`) VALUES
(1, 'test', '$2y$10$MCQvHX0AC.S/idZKgVK1A.XzUqMLNroHPjZVXJJKXF3Kpcj1wRdMW', 42, 'img/avatar/1.jpg'),
(2, 'Maxime', '$2y$10$zo1TDrPM1FGrpi60gA9rUOkw4Ck1HyZi/o2pFy9G1cV6ClLA9vb2i', 2, 'avatar_defaut.jpg'),
(3, 'admin', '$2y$10$3/.RLqYQXkoRMIUw9lXqgut.Gw.YEfWKcZoLsaJef9bO55Z0zevJm', 31, 'img/avatar/3.png');
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
