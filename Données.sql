-- phpMyAdmin SQL Dump
-- version 4.9.0.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost
-- Généré le :  ven. 06 déc. 2019 à 09:59
-- Version du serveur :  5.5.47-0+deb8u1
-- Version de PHP :  7.2.22-1+0~20190902.26+debian8~1.gbpd64eb7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données :  `hajjajj`
--

-- --------------------------------------------------------

--
-- Structure de la table `Categorie`
--

CREATE TABLE `Categorie` (
  `id` int(11) NOT NULL,
  `valeur` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Categorie`
--

INSERT INTO `Categorie` (`id`, `valeur`) VALUES
(4, 'Jeux-videos'),
(5, 'Multimédia'),
(6, 'DVD/CD'),
(7, 'Livres'),
(8, 'Musique'),
(9, 'TV');

-- --------------------------------------------------------

--
-- Structure de la table `CodePromo`
--

CREATE TABLE `CodePromo` (
  `idCode` varchar(16) NOT NULL,
  `Date` date NOT NULL,
  `pourcentage` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `CodePromo`
--

INSERT INTO `CodePromo` (`idCode`, `Date`, `pourcentage`) VALUES
('BLACKFRI85', '2019-12-06', 0.85),
('XCORBIER50', '2019-12-07', 0.5);

-- --------------------------------------------------------

--
-- Structure de la table `Commande`
--

CREATE TABLE `Commande` (
  `idCommande` int(11) NOT NULL,
  `login` varchar(32) NOT NULL,
  `dateCommande` date NOT NULL,
  `statut` varchar(32) NOT NULL DEFAULT 'En cours',
  `prix` double NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Commande`
--

INSERT INTO `Commande` (`idCommande`, `login`, `dateCommande`, `statut`, `prix`) VALUES
(42, 'admin', '2019-11-22', 'Annulée', 22339),
(44, 'admin', '2019-11-22', 'Annulée', 1563),
(47, 'admin', '2019-11-27', 'Annulée', 33.5),
(48, 'admin', '2019-11-27', 'Envoyée', 3.35),
(49, 'admin', '2019-11-27', 'Envoyée', 67),
(50, 'admin', '2019-11-29', 'Annulée', 133.5),
(51, 'admin', '2019-11-29', 'Annulée', 178),
(53, 'admin', '2019-11-29', 'Annulée', 178),
(54, 'admin', '2019-11-29', 'Envoyée', 178),
(55, 'admin', '2019-11-29', 'En cours', 178),
(56, 'admin', '2019-11-29', 'En cours', 178),
(57, 'admin', '2019-11-29', 'En cours', 178),
(58, 'admin', '2019-12-04', 'En cours', 15575),
(59, 'Administrateur', '2019-12-05', 'Envoyée', 650),
(60, 'Administrateur', '2019-12-06', 'En cours', 18007.5);

-- --------------------------------------------------------

--
-- Structure de la table `LigneCommande`
--

CREATE TABLE `LigneCommande` (
  `idCommande` int(11) NOT NULL,
  `idProduit` int(11) NOT NULL,
  `quantite` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `LigneCommande`
--

INSERT INTO `LigneCommande` (`idCommande`, `idProduit`, `quantite`) VALUES
(59, 24, 10),
(59, 25, 10),
(60, 25, 10),
(60, 26, 600);

-- --------------------------------------------------------

--
-- Structure de la table `Produit`
--

CREATE TABLE `Produit` (
  `idProduit` int(10) NOT NULL,
  `nomProduit` varchar(256) CHARACTER SET utf8mb4 NOT NULL,
  `idFournisseur` int(11) NOT NULL,
  `quantite` int(5) NOT NULL,
  `categorieProduit` int(11) NOT NULL,
  `descriptionProduit` text CHARACTER SET utf8mb4 NOT NULL,
  `prixProduit` int(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Produit`
--

INSERT INTO `Produit` (`idProduit`, `nomProduit`, `idFournisseur`, `quantite`, `categorieProduit`, `descriptionProduit`, `prixProduit`) VALUES
(24, 'FIFA 20', 0, 490, 4, 'Jeu', 60),
(25, 'Titeuf', 0, 480, 7, 'livre cool', 5),
(26, 'XBOX', 0, 0, 4, 'Console', 200),
(27, 'WWE 2K20', 0, 800, 4, 'jeu', 60);

-- --------------------------------------------------------

--
-- Structure de la table `Utilisateur`
--

CREATE TABLE `Utilisateur` (
  `login` varchar(32) NOT NULL,
  `nom` varchar(32) NOT NULL,
  `prenom` varchar(32) NOT NULL,
  `mdp` varchar(64) NOT NULL,
  `admin` tinyint(1) NOT NULL DEFAULT '0',
  `email` varchar(32) NOT NULL,
  `nonce` varchar(32) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Déchargement des données de la table `Utilisateur`
--

INSERT INTO `Utilisateur` (`login`, `nom`, `prenom`, `mdp`, `admin`, `email`, `nonce`) VALUES
('admin', 'admin', 'admin', 'e2c9c8096b08046f1386f723d3f3794641742f212a3d0a111990f225026daec6', 0, 'jilaloui@yopmail.com', ''),
('Administrateur', 'Officiel', 'Administrateur', 'b36b7fe7a7554046befd27bdb6a71518cd927a92f4190723e70d748522119e9e', 1, 'jilaloui@yopmail.com', ''),
('Jil', 'Hajjaj', 'Jillali', 'b03e7ca4619ef59e9f773a1c5c0e147d45bb431b481f26011774fa8634e46343', 0, '8564@yopmail.com', ''),
('test', 'Gedal', 'Gedal', 'e2c9c8096b08046f1386f723d3f3794641742f212a3d0a111990f225026daec6', 0, 'gedal@yopmail.com', '');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `Categorie`
--
ALTER TABLE `Categorie`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `CodePromo`
--
ALTER TABLE `CodePromo`
  ADD PRIMARY KEY (`idCode`);

--
-- Index pour la table `Commande`
--
ALTER TABLE `Commande`
  ADD PRIMARY KEY (`idCommande`),
  ADD KEY `login` (`login`);

--
-- Index pour la table `LigneCommande`
--
ALTER TABLE `LigneCommande`
  ADD PRIMARY KEY (`idCommande`,`idProduit`),
  ADD KEY `idProduit` (`idProduit`);

--
-- Index pour la table `Produit`
--
ALTER TABLE `Produit`
  ADD PRIMARY KEY (`idProduit`),
  ADD KEY `categorieProduit` (`categorieProduit`);

--
-- Index pour la table `Utilisateur`
--
ALTER TABLE `Utilisateur`
  ADD PRIMARY KEY (`login`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `Categorie`
--
ALTER TABLE `Categorie`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT pour la table `Commande`
--
ALTER TABLE `Commande`
  MODIFY `idCommande` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT pour la table `Produit`
--
ALTER TABLE `Produit`
  MODIFY `idProduit` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `Commande`
--
ALTER TABLE `Commande`
  ADD CONSTRAINT `loginetr` FOREIGN KEY (`login`) REFERENCES `Utilisateur` (`login`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `LigneCommande`
--
ALTER TABLE `LigneCommande`
  ADD CONSTRAINT `idCommande` FOREIGN KEY (`idCommande`) REFERENCES `Commande` (`idCommande`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `idProduit` FOREIGN KEY (`idProduit`) REFERENCES `Produit` (`idProduit`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Contraintes pour la table `Produit`
--
ALTER TABLE `Produit`
  ADD CONSTRAINT `etr_categorie` FOREIGN KEY (`categorieProduit`) REFERENCES `Categorie` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
