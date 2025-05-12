-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2025 at 07:01 PM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `congedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `administrateurs`
--

CREATE TABLE `administrateurs` (
  `id_administrateur` int(11) NOT NULL,
  `nom_utilisateur` varchar(50) NOT NULL,
  `mot_de_passe` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `administrateurs`
--

INSERT INTO `administrateurs` (`id_administrateur`, `nom_utilisateur`, `mot_de_passe`) VALUES
(1, 'admin1', '12345678'),
(2, 'admin2', '$2a$10$mKMBjZ9j9eLqxGjK8.FvVu8y9N.e9YJKkK/4NfMuK9u9j6/LCCey');

-- --------------------------------------------------------

--
-- Table structure for table `demandes_conge`
--

CREATE TABLE `demandes_conge` (
  `id_conge` int(11) NOT NULL,
  `id_employe` int(11) NOT NULL,
  `type_conge` enum('Annuel','Maladie','Sans solde','Autre') NOT NULL,
  `date_debut` date NOT NULL,
  `date_fin` date NOT NULL,
  `statut` enum('En attente','Approuve','Rejete') DEFAULT 'En attente',
  `date_demande` date DEFAULT curdate()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `demandes_conge`
--

INSERT INTO `demandes_conge` (`id_conge`, `id_employe`, `type_conge`, `date_debut`, `date_fin`, `statut`, `date_demande`) VALUES
(1, 1, 'Annuel', '2024-12-25', '2024-12-29', 'Approuve', '2025-05-12'),
(2, 2, 'Maladie', '2025-01-10', '2025-01-12', 'Approuve', '2025-05-12'),
(3, 3, 'Sans solde', '2025-02-15', '2025-02-28', 'Approuve', '2025-05-12'),
(4, 1, 'Autre', '2025-03-05', '2025-03-05', 'Approuve', '2025-05-12'),
(5, 4, 'Annuel', '2025-04-01', '2025-04-05', 'Approuve', '2025-05-12');

-- --------------------------------------------------------

--
-- Table structure for table `departements`
--

CREATE TABLE `departements` (
  `id_departement` int(11) NOT NULL,
  `nom_departement` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departements`
--

INSERT INTO `departements` (`id_departement`, `nom_departement`) VALUES
(5, 'Finance'),
(2, 'Ingenierie'),
(3, 'Marketingdd'),
(1, 'Ressources humaines.');

-- --------------------------------------------------------

--
-- Table structure for table `employes`
--

CREATE TABLE `employes` (
  `id_employe` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL,
  `id_departement` int(11) DEFAULT NULL,
  `poste` varchar(100) DEFAULT NULL,
  `date_embauche` date DEFAULT NULL,
  `statut` varchar(50) NOT NULL DEFAULT 'Actif'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employes`
--

INSERT INTO `employes` (`id_employe`, `nom`, `email`, `telephone`, `id_departement`, `poste`, `date_embauche`, `statut`) VALUES
(1, 'John Smith', 'john.smith@example.com', '555-1234', 1, 'Manager', '2020-01-15', 'Actif'),
(2, 'Jane Doe', 'jane.doe@example.com', '555-5678', 2, 'Ingenieur', '2021-03-01', 'Actif'),
(3, 'Bob Johnson', 'bob.johnson@example.com', '555-9012', 3, 'Analyste', '2022-05-10', 'Actif'),
(18, 'admin1', 'ewjknwe@fgfgf.com', '900230233', 2, 'noone ', '2025-05-14', 'Actif');

-- --------------------------------------------------------

--
-- Table structure for table `presence`
--

CREATE TABLE `presence` (
  `id_presence` int(11) NOT NULL,
  `id_employe` int(11) NOT NULL,
  `date` date NOT NULL,
  `heure_arrivee` time DEFAULT NULL,
  `heure_sortie` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `presence`
--

INSERT INTO `presence` (`id_presence`, `id_employe`, `date`, `heure_arrivee`, `heure_sortie`) VALUES
(1, 1, '2024-12-20', '09:00:00', '17:00:00'),
(2, 2, '2024-12-20', '08:30:00', '16:30:00'),
(3, 3, '2024-12-20', '09:15:00', '17:15:00'),
(4, 1, '2024-12-21', '09:05:00', '17:05:00'),
(5, 2, '2024-12-21', '08:40:00', '16:40:00');

-- --------------------------------------------------------

--
-- Table structure for table `type_conge`
--

CREATE TABLE `type_conge` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `description` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `type_conge`
--

INSERT INTO `type_conge` (`id`, `nom`, `description`) VALUES
(1, 'Conge annuel', 'Conge paye annuel pour les employes.'),
(2, 'Conge maladien', 'Accorde en cas de maladie justifiee.'),
(3, 'Conge maternite', 'Accorde aux salariez enceintes avant et apres laccouchement.'),
(4, 'Conge paternite', 'Accorde au pere apres la naissance de lenfant.'),
(5, 'Conge sans solde', 'Conge non remunere accorde sur demande.'),
(6, 'Conge exceptionnel', 'Accorde pour des evenements familiaux importants.');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `administrateurs`
--
ALTER TABLE `administrateurs`
  ADD PRIMARY KEY (`id_administrateur`),
  ADD UNIQUE KEY `nom_utilisateur` (`nom_utilisateur`);

--
-- Indexes for table `demandes_conge`
--
ALTER TABLE `demandes_conge`
  ADD PRIMARY KEY (`id_conge`),
  ADD KEY `id_employe` (`id_employe`);

--
-- Indexes for table `departements`
--
ALTER TABLE `departements`
  ADD PRIMARY KEY (`id_departement`),
  ADD UNIQUE KEY `nom_departement` (`nom_departement`);

--
-- Indexes for table `employes`
--
ALTER TABLE `employes`
  ADD PRIMARY KEY (`id_employe`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `id_departement` (`id_departement`);

--
-- Indexes for table `presence`
--
ALTER TABLE `presence`
  ADD PRIMARY KEY (`id_presence`),
  ADD KEY `id_employe` (`id_employe`);

--
-- Indexes for table `type_conge`
--
ALTER TABLE `type_conge`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `administrateurs`
--
ALTER TABLE `administrateurs`
  MODIFY `id_administrateur` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `demandes_conge`
--
ALTER TABLE `demandes_conge`
  MODIFY `id_conge` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `departements`
--
ALTER TABLE `departements`
  MODIFY `id_departement` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `employes`
--
ALTER TABLE `employes`
  MODIFY `id_employe` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `presence`
--
ALTER TABLE `presence`
  MODIFY `id_presence` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `type_conge`
--
ALTER TABLE `type_conge`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
