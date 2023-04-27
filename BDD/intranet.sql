-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : jeu. 27 avr. 2023 à 09:32
-- Version du serveur : 10.4.21-MariaDB
-- Version de PHP : 8.0.10

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
  `commentaire` varchar(255) NOT NULL,
  `afficher` tinyint(1) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `conges`
--

INSERT INTO `conges` (`id_conges`, `id_employe`, `id_raison`, `id_etat`, `date_demande`, `date_change`, `date_debut`, `date_fin`, `debut_type`, `fin_type`, `duree`, `commentaire`, `afficher`) VALUES
(38, 3, 1, 3, '2023-02-23 11:40:06', '2023-03-21 08:22:59', '2023-02-01 08:00:00', '2023-02-17 19:00:00', 'Matin', 'Après-midi', '13.0', '', 1),
(39, 3, 1, 2, '2023-03-21 08:20:54', NULL, '2023-03-09 08:00:00', '2023-03-25 19:00:00', 'Matin', 'Après-midi', '12.0', '', 1);

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
  `id_service` int(11) NOT NULL,
  `id_entite` int(11) NOT NULL,
  `conges_dispo` decimal(11,1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `employe`
--

INSERT INTO `employe` (`id_employe`, `nom`, `prenom`, `username`, `email`, `telephone`, `password`, `actif`, `id_poste`, `id_service`, `id_entite`, `conges_dispo`) VALUES
(3, 'daniel', 'raphael', 'rdaniel', 'daniel.rapahel@hotmail.fr', '0786140724', '$6$rounds=5000$gA6Fkf92AFMpn3cG$9GiHHvxdBUrBM9arT24l1cmX5fqWGVRygzcfSXEuMZYM32NWM.WnFtPCzMa73tryO26R29HJAE.irBsFgKVto.', 1, 1, 1, 1, '12.0'),
(4, 'mercier', 'mercier', 'mercier', 'mercier@mercier.fr', '0786140724', '$6$rounds=5000$gA6Fkf92AFMpn3cG$UbGQtMxVwfo.CnLCCbOIj7qfq1n7L6TFDnXK2VZUt4qUAWmYAie8CjTawvtEpbdP18ArO4.tRLyd6NKEJvR6G/', 1, 2, 4, 1, '25.0'),
(5, 'test', 'test', 'test', 'test@test.test', '0786140724', '$6$rounds=5000$gA6Fkf92AFMpn3cG$xabz7ZQiqEDl6.AA70sHp0kjIyP30gnvz4rtbGB2RwGucDvemvxD.Io.8iEfswu4/54HZUOvK4FEjXup31fwh/', 1, 3, 8, 1, '25.0');

-- --------------------------------------------------------

--
-- Structure de la table `entite`
--

CREATE TABLE `entite` (
  `id_entite` int(11) NOT NULL,
  `libelle` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `entite`
--

INSERT INTO `entite` (`id_entite`, `libelle`) VALUES
(1, 'sintec'),
(2, 'landry');

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
(5, 'Annulee', '#000000');

-- --------------------------------------------------------

--
-- Structure de la table `historique_conges`
--

CREATE TABLE `historique_conges` (
  `id` int(11) NOT NULL,
  `date_ajout` datetime NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `nb_ajouter` decimal(11,1) NOT NULL,
  `motif` varchar(255) NOT NULL,
  `id_admin` int(11) NOT NULL,
  `id_employe` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `historique_conges`
--

INSERT INTO `historique_conges` (`id`, `date_ajout`, `nb_ajouter`, `motif`, `id_admin`, `id_employe`) VALUES
(1, '2023-02-01 14:07:46', '5.0', 'Ancienneté', 1, 2);

-- --------------------------------------------------------

--
-- Structure de la table `log_connexion`
--

CREATE TABLE `log_connexion` (
  `id_log` int(11) NOT NULL,
  `date_connexion` datetime NOT NULL,
  `ip_adress` varchar(255) NOT NULL,
  `username` varchar(255) NOT NULL,
  `connection` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Déchargement des données de la table `log_connexion`
--

INSERT INTO `log_connexion` (`id_log`, `date_connexion`, `ip_adress`, `username`, `connection`) VALUES
(1, '2023-02-02 09:25:13', '::1', 'rdaniel', '0'),
(2, '2023-02-02 09:26:38', '::1', 'rdaniel', '0'),
(3, '2023-02-02 09:28:36', '::1', 'legfred', '0'),
(4, '2023-02-02 09:28:41', '::1', 'rdaniel', '0'),
(5, '2023-02-02 09:45:12', '::1', 'rdaniel', '0'),
(6, '2023-02-02 13:55:28', '::1', 'rdaniel', '0'),
(7, '2023-02-03 08:45:44', '::1', 'rdaniel', '0'),
(8, '2023-02-03 09:34:19', '::1', 'rdaniel', '0'),
(9, '2023-02-03 09:37:42', '::1', 'rdaniel', 'failed'),
(10, '2023-02-03 09:40:58', '::1', 'rdaniel', 'failed'),
(11, '2023-02-03 09:41:23', '::1', 'rdaniel', 'success'),
(12, '2023-02-03 09:41:40', '::1', 'rdaniel', 'failed'),
(13, '2023-02-03 09:42:47', '::1', 'rdaniel', 'success'),
(14, '2023-02-23 09:48:53', '::1', 'rdaniel', 'success'),
(15, '2023-02-28 11:23:53', '::1', 'rdaniel', 'success'),
(16, '2023-03-10 17:25:32', '::1', 'rdaniel', 'success'),
(17, '2023-03-13 17:06:56', '::1', 'rdaniel', 'success'),
(18, '2023-03-20 13:26:00', '::1', 'rdaniel', 'success'),
(19, '2023-03-20 14:39:54', '::1', 'rdaniel', 'success'),
(20, '2023-03-21 08:19:14', '::1', 'rdaniel', 'success'),
(21, '2023-03-21 09:40:51', '::1', 'rdaniel', 'success'),
(22, '2023-04-27 08:23:40', '::1', 'rdaniel', 'success'),
(23, '2023-04-27 08:33:41', '::1', 'rdaniel', 'success'),
(24, '2023-04-27 08:38:33', '::1', 'mercier', 'success'),
(25, '2023-04-27 08:54:00', '::1', 'rdaniel', 'success'),
(26, '2023-04-27 09:11:08', '::1', 'mercier', 'success'),
(27, '2023-04-27 09:11:17', '::1', 'rdaniel', 'success'),
(28, '2023-04-27 09:25:41', '::1', 'rdaniel', 'success'),
(29, '2023-04-27 09:26:37', '::1', 'test', 'success');

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
-- Index pour la table `entite`
--
ALTER TABLE `entite`
  ADD PRIMARY KEY (`id_entite`);

--
-- Index pour la table `etat`
--
ALTER TABLE `etat`
  ADD PRIMARY KEY (`id_etat`);

--
-- Index pour la table `historique_conges`
--
ALTER TABLE `historique_conges`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `log_connexion`
--
ALTER TABLE `log_connexion`
  ADD PRIMARY KEY (`id_log`);

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
  MODIFY `id_conges` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT pour la table `employe`
--
ALTER TABLE `employe`
  MODIFY `id_employe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT pour la table `entite`
--
ALTER TABLE `entite`
  MODIFY `id_entite` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT pour la table `etat`
--
ALTER TABLE `etat`
  MODIFY `id_etat` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `historique_conges`
--
ALTER TABLE `historique_conges`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `log_connexion`
--
ALTER TABLE `log_connexion`
  MODIFY `id_log` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

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

DELIMITER $$
--
-- Évènements
--
CREATE DEFINER=`root`@`localhost` EVENT `conges_mensuel` ON SCHEDULE EVERY 1 MONTH STARTS '2023-01-01 00:00:00' ON COMPLETION NOT PRESERVE ENABLE DO UPDATE employe SET conges_dispo = conges_dispo + 2.5$$

DELIMITER ;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
