-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 01 fév. 2023 à 14:33
-- Version du serveur : 10.4.24-MariaDB
-- Version de PHP : 8.1.6

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `intranet`
--

-- --------------------------------------------------------

--
-- Structure de la table `conges`
--

CREATE TABLE `conges` (
  `id_conges` int(11) NOT NULL,
  `id_employe` int(11) NOT NULL,
  `id_raison` int(11) NOT NULL,
  `id_etat` int(11) NOT NULL,
  `date_demande` datetime NOT NULL DEFAULT current_timestamp(),
  `date_change` datetime DEFAULT NULL,
  `date_debut` datetime NOT NULL,
  `date_fin` datetime NOT NULL,
  `debut_type` varchar(255) NOT NULL,
  `fin_type` varchar(255) NOT NULL,
  `duree` decimal(11,1) NOT NULL,
  `commentaire` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `conges`
--

INSERT INTO `conges` (`id_conges`, `id_employe`, `id_raison`, `id_etat`, `date_demande`, `date_change`, `date_debut`, `date_fin`, `debut_type`, `fin_type`, `duree`, `commentaire`) VALUES
(29, 2, 4, 4, '2023-02-01 08:46:42', '2023-02-01 09:54:11', '2023-02-06 08:00:00', '2023-02-10 19:00:00', 'Matin', 'Après-midi', '5.0', ''),
(30, 1, 6, 3, '2023-02-01 08:50:55', '2023-02-01 09:54:08', '2023-02-11 14:00:00', '2023-02-18 13:00:00', 'Après-midi', 'Matin', '5.0', 'Je rentre en France');

-- --------------------------------------------------------

--
-- Structure de la table `employe`
--

CREATE TABLE `employe` (
  `id_employe` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `prenom` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `telephone` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `actif` tinyint(4) NOT NULL,
  `id_poste` int(11) NOT NULL,
  `id_service` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`id_employe`, `nom`, `prenom`, `username`, `email`, `telephone`, `password`, `actif`, `id_poste`, `id_service`) VALUES
(1, 'daniel', 'raphaël', 'rdaniel', 'daniel.rapahel@hotmail.fr', '0786140724', '$6$rounds=5000$gA6Fkf92AFMpn3cG$9GiHHvxdBUrBM9arT24l1cmX5fqWGVRygzcfSXEuMZYM32NWM.WnFtPCzMa73tryO26R29HJAE.irBsFgKVto.', 1, 1, 5),
(2, 'Le Glaunec', 'Frederic', 'legfred', 'fleglaunec@landryavi.com', '41-19-03', '$6$rounds=5000$gA6Fkf92AFMpn3cG$LZD.VLd1Lb9p/a0GMitLX50C.KfhKPpXgQGIx3hAn/hCSNHSLN3ANdO1usvuPXWSc5yq1tBzDezi14k9OgFs11', 1, 3, 8);

-- --------------------------------------------------------

--
-- Structure de la table `etat`
--

CREATE TABLE `etat` (
  `id_etat` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL,
  `color` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `etat`
--

INSERT INTO `etat` (`id_etat`, `libelle`, `color`) VALUES
(2, 'En attente', '#ff7800'),
(3, 'Acceptee', '#007500'),
(4, 'Rejetee', '#FF0000'),
(5, 'Annulee', '#FF0000');

-- --------------------------------------------------------

--
-- Structure de la table `poste`
--

CREATE TABLE `poste` (
  `id_poste` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `poste`
--

INSERT INTO `poste` (`id_poste`, `libelle`) VALUES
(1, 'Admin Web'),
(2, 'Employe'),
(3, 'Direction Landry-Sintec');

-- --------------------------------------------------------

--
-- Structure de la table `raison`
--

CREATE TABLE `raison` (
  `id_raison` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `raison`
--

INSERT INTO `raison` (`id_raison`, `libelle`) VALUES
(1, 'Conges maternite'),
(2, 'Conges paternite'),
(3, 'Conges maladie'),
(4, 'Conges paye'),
(5, 'Compensation'),
(6, 'Conges speciaux');

-- --------------------------------------------------------

--
-- Structure de la table `service`
--

CREATE TABLE `service` (
  `id_service` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `service`
--

INSERT INTO `service` (`id_service`, `libelle`) VALUES
(1, 'Comptabilité'),
(2, 'Gestion Achat/Logistique'),
(3, 'Responsable commercial et communication'),
(4, 'Postes conseillers'),
(5, 'Service informatique'),
(6, 'Service multimédia/Electro'),
(7, 'Responsable surface commerciale'),
(8, 'Direction');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `conges`
--
ALTER TABLE `conges`
  ADD PRIMARY KEY (`id_conges`),
  ADD KEY `id_employe` (`id_employe`),
  ADD KEY `id_raison` (`id_raison`),
  ADD KEY `id_etat` (`id_etat`);

--
-- Index pour la table `employe`
--
ALTER TABLE `employe`
  ADD PRIMARY KEY (`id_employe`),
  ADD KEY `id_poste` (`id_poste`),
  ADD KEY `id_service` (`id_service`);

--
-- Index pour la table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`id_etat`);

--
-- Index pour la table `poste`
--
ALTER TABLE `poste`
  ADD PRIMARY KEY (`id_poste`);

--
-- Index pour la table `raison`
--
ALTER TABLE `raison`
  ADD PRIMARY KEY (`id_raison`);

--
-- Index pour la table `service`
--
ALTER TABLE `service`
  ADD PRIMARY KEY (`id_service`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `conges`
--
ALTER TABLE `conges`
  MODIFY `id_conges` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `id_employe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `etat`
--
ALTER TABLE `etat`
  MODIFY `id_etat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `poste`
--
ALTER TABLE `poste`
  MODIFY `id_poste` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT pour la table `raison`
--
ALTER TABLE `raison`
  MODIFY `id_raison` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT pour la table `service`
--
ALTER TABLE `service`
  MODIFY `id_service` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `conges`
--
ALTER TABLE `conges`
  ADD CONSTRAINT `conges_ibfk_1` FOREIGN KEY (`id_employe`) REFERENCES `employe` (`id_employe`),
  ADD CONSTRAINT `conges_ibfk_2` FOREIGN KEY (`id_raison`) REFERENCES `raison` (`id_raison`),
  ADD CONSTRAINT `conges_ibfk_3` FOREIGN KEY (`id_etat`) REFERENCES `etat` (`id_etat`);

--
-- Contraintes pour la table `employe`
--
ALTER TABLE `employe`
  ADD CONSTRAINT `employe_ibfk_1` FOREIGN KEY (`id_poste`) REFERENCES `poste` (`id_poste`),
  ADD CONSTRAINT `employe_ibfk_2` FOREIGN KEY (`id_service`) REFERENCES `service` (`id_service`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
