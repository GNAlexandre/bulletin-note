-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Hôte : localhost:3306
-- Généré le : sam. 12 mars 2022 à 14:06
-- Version du serveur : 5.7.33
-- Version de PHP : 7.4.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `bulletin`
--

-- --------------------------------------------------------

--
-- Structure de la table `appartenir`
--

CREATE TABLE `appartenir` (
  `id` int(11) NOT NULL,
  `id_enseignant_ext` int(11) NOT NULL,
  `id_classe_ext` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `appartenir`
--

INSERT INTO `appartenir` (`id`, `id_enseignant_ext`, `id_classe_ext`) VALUES
(1, 1, 1),
(2, 1, 2),
(3, 1, 3),
(5, 2, 1),
(6, 3, 1),
(11, 5, 3),
(12, 7, 2);

-- --------------------------------------------------------

--
-- Structure de la table `classe`
--

CREATE TABLE `classe` (
  `id` int(11) NOT NULL,
  `numero` int(11) NOT NULL,
  `annee` int(11) NOT NULL,
  `nombre_eleve` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `classe`
--

INSERT INTO `classe` (`id`, `numero`, `annee`, `nombre_eleve`) VALUES
(1, 1, 2, 30),
(2, 2, 1, 25),
(3, 3, 1, 26);

-- --------------------------------------------------------

--
-- Structure de la table `doctrine_migration_versions`
--

CREATE TABLE `doctrine_migration_versions` (
  `version` varchar(191) COLLATE utf8_unicode_ci NOT NULL,
  `executed_at` datetime DEFAULT NULL,
  `execution_time` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Déchargement des données de la table `doctrine_migration_versions`
--

INSERT INTO `doctrine_migration_versions` (`version`, `executed_at`, `execution_time`) VALUES
('DoctrineMigrations\\Version20220125083127', '2022-01-25 08:31:41', 40),
('DoctrineMigrations\\Version20220125084530', '2022-01-25 08:45:42', 84),
('DoctrineMigrations\\Version20220125091336', '2022-01-25 09:13:49', 136),
('DoctrineMigrations\\Version20220125093502', '2022-01-25 09:35:11', 35),
('DoctrineMigrations\\Version20220227165939', '2022-02-27 16:59:56', 50),
('DoctrineMigrations\\Version20220303175956', NULL, NULL),
('DoctrineMigrations\\Version20220303180612', '2022-03-03 18:06:17', 94);

-- --------------------------------------------------------

--
-- Structure de la table `eleve`
--

CREATE TABLE `eleve` (
  `id` int(11) NOT NULL,
  `nom` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `prenom` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_classe_ext` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `eleve`
--

INSERT INTO `eleve` (`id`, `nom`, `prenom`, `role`, `password`, `id_classe_ext`) VALUES
(1, 'Thomas', 'Lyautey', 'Eleve', 'test', 1),
(2, 'Eliott', 'Garnier', 'Eleve', 'test', 1),
(4, 'Jordan ', 'Piccolo', 'Eleve', 'test', 2),
(5, 'Marine', 'Le Pen', 'Eleve', 'test', 2),
(6, 'Francois', 'Alacasam', 'Eleve', 'test', 2);

-- --------------------------------------------------------

--
-- Structure de la table `enseignant`
--

CREATE TABLE `enseignant` (
  `id` int(11) NOT NULL,
  `name` varchar(50) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_matiere` int(11) DEFAULT NULL,
  `role` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(40) COLLATE utf8mb4_unicode_ci NOT NULL,
  `id_matiere_key_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `enseignant`
--

INSERT INTO `enseignant` (`id`, `name`, `id_matiere`, `role`, `password`, `id_matiere_key_id`) VALUES
(1, 'Roussel', 1, 'Enseignant', 'test', 1),
(2, 'Talma', 2, 'Enseignant', 'test', 2),
(3, 'Koubiak', 3, 'Enseignant', 'test', 3),
(5, 'Alexandre', 5, 'Enseignant', 'test', 5),
(7, 'Dark Vador', 6, 'Enseignant', 'test', NULL);

-- --------------------------------------------------------

--
-- Structure de la table `matiere`
--

CREATE TABLE `matiere` (
  `id` int(11) NOT NULL,
  `name_matiere` varchar(30) COLLATE utf8mb4_unicode_ci NOT NULL,
  `heure_de_cours` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `matiere`
--

INSERT INTO `matiere` (`id`, `name_matiere`, `heure_de_cours`) VALUES
(1, 'Web', 18),
(2, 'Methode du Numerique', 16),
(3, 'Cryptologie', 16),
(4, 'Mathematique', 24),
(5, 'Anglais', 12),
(6, 'Combat', 18);

-- --------------------------------------------------------

--
-- Structure de la table `note`
--

CREATE TABLE `note` (
  `id` int(11) NOT NULL,
  `id_matiere_ext` int(11) NOT NULL,
  `id_eleve_ext` int(11) NOT NULL,
  `note` double DEFAULT NULL,
  `date_controle` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `note`
--

INSERT INTO `note` (`id`, `id_matiere_ext`, `id_eleve_ext`, `note`, `date_controle`) VALUES
(1, 1, 1, 16, '2022-03-08'),
(2, 3, 1, 15, '2022-03-15'),
(3, 5, 1, 8, '2022-02-09'),
(4, 4, 1, 10, '2022-03-01'),
(5, 1, 1, 18, '2022-03-11'),
(6, 1, 2, 16, '2022-03-11');

-- --------------------------------------------------------

--
-- Structure de la table `user`
--

CREATE TABLE `user` (
  `id` int(11) NOT NULL,
  `username` varchar(180) COLLATE utf8mb4_unicode_ci NOT NULL,
  `roles` json NOT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Déchargement des données de la table `user`
--

INSERT INTO `user` (`id`, `username`, `roles`, `password`) VALUES
(1, 'Directeur', '[\"ROLE_ADMIN\"]', '$2y$13$Ry/TgKAQzuToJ1IjWM7R6eu3wWcqD4cV1Ipn6yMpONj53mvpmC78m'),
(2, 'Roussel', '[]', '$2y$13$j5XGkEN/80hk/RAdAbTKp.qQbpu87BAXz5ItvxqtIbdz5xQOJiD06'),
(3, 'Thomas', '[]', '$2y$13$T1AvqOAYN4A92bvekSqMNOlYEIfKUg6ec8lwP.S1Og2WYYs0jL0Uy');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `appartenir`
--
ALTER TABLE `appartenir`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `classe`
--
ALTER TABLE `classe`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `doctrine_migration_versions`
--
ALTER TABLE `doctrine_migration_versions`
  ADD PRIMARY KEY (`version`);

--
-- Index pour la table `eleve`
--
ALTER TABLE `eleve`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `enseignant`
--
ALTER TABLE `enseignant`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `matiere`
--
ALTER TABLE `matiere`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `note`
--
ALTER TABLE `note`
  ADD PRIMARY KEY (`id`);

--
-- Index pour la table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `UNIQ_8D93D649F85E0677` (`username`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `appartenir`
--
ALTER TABLE `appartenir`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT pour la table `classe`
--
ALTER TABLE `classe`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT pour la table `eleve`
--
ALTER TABLE `eleve`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `enseignant`
--
ALTER TABLE `enseignant`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT pour la table `matiere`
--
ALTER TABLE `matiere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `note`
--
ALTER TABLE `note`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT pour la table `user`
--
ALTER TABLE `user`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
