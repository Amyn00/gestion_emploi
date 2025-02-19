-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 18, 2025 at 09:32 PM
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
-- Database: `gestion_emploi`
--

-- --------------------------------------------------------

--
-- Table structure for table `creneaux`
--

CREATE TABLE `creneaux` (
  `id` int(11) NOT NULL,
  `heure_debut` time NOT NULL,
  `heure_fin` time NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `creneaux`
--

INSERT INTO `creneaux` (`id`, `heure_debut`, `heure_fin`) VALUES
(1, '08:30:00', '10:30:00'),
(2, '10:30:00', '12:30:00'),
(3, '14:30:00', '16:30:00'),
(4, '16:30:00', '18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `departement`
--

CREATE TABLE `departement` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departement`
--

INSERT INTO `departement` (`id`, `nom`) VALUES
(1, 'Genie electrique et informatique'),
(2, 'Genie Industriel'),
(3, 'Sciences de Donn?es et Systemes Communicants'),
(4, 'Genie des systemes intelligents '),
(5, 'Cycle preparatoires');

-- --------------------------------------------------------

--
-- Table structure for table `elements`
--

CREATE TABLE `elements` (
  `id` int(11) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `module_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `emplois_du_temps`
--

CREATE TABLE `emplois_du_temps` (
  `id` int(11) NOT NULL,
  `prof_id` int(11) DEFAULT NULL,
  `element_id` int(11) DEFAULT NULL,
  `salle_id` int(11) DEFAULT NULL,
  `jour` enum('Lundi','Mardi','Mercredi','Jeudi','Vendredi','Samedi') NOT NULL,
  `semaine_debut_id` int(11) DEFAULT NULL,
  `semaine_fin_id` int(11) DEFAULT NULL,
  `creneau_id` int(11) DEFAULT NULL,
  `module_id` int(11) DEFAULT NULL,
  `filiere_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `equipements`
--

CREATE TABLE `equipements` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `filiere`
--

CREATE TABLE `filiere` (
  `id` int(11) NOT NULL,
  `nom` varchar(255) NOT NULL,
  `departement_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `filiere`
--

INSERT INTO `filiere` (`id`, `nom`, `departement_id`) VALUES
(3, 'Genie du developpement numerique et Cybersecurite', 1),
(4, 'Ingénierie en Science de Données et Intelligence Artificielle', 1),
(5, 'Génie Informatique', 1),
(6, 'Génie Mécanique', 2),
(7, 'Génie Energétique et systèmes intelligents', 2),
(8, 'Génie Mécatronique', 2),
(9, 'Génie Industriel', 2),
(10, 'Génie des Systèmes communicants et sécurité informatique', 3),
(11, 'Ingénierie Informatique, Intelligence Artificielle et Confiance Numérique', 3),
(12, 'Ingénierie des Systèmes Embarqués et Intelligence Artificielle', 4),
(13, 'Ingénierie Logicielle et Intelligence Artificielle', 4),
(14, 'Deux années préparatoires', 5);

-- --------------------------------------------------------

--
-- Table structure for table `modules`
--

CREATE TABLE `modules` (
  `id` int(11) NOT NULL,
  `nom` varchar(150) NOT NULL,
  `code` varchar(50) NOT NULL,
  `filiere_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `professeurs`
--

CREATE TABLE `professeurs` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `prenom` varchar(100) NOT NULL,
  `email` varchar(150) NOT NULL,
  `telephone` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `professeurs`
--

INSERT INTO `professeurs` (`id`, `nom`, `prenom`, `email`, `telephone`) VALUES
(1, 'AIRAJ', 'MOHAMMED', '', ''),
(77, 'ALFIDI ', 'Mohammed', '', ''),
(78, 'BERRADA ', 'Mohammed', '', ''),
(79, 'CHALH ', 'Zakaria', '', ''),
(80, 'EL FADILI ', 'Hakim', '', ''),
(81, 'EL HAMMAMI', 'YOUNESS', '', ''),
(82, 'EZZOUHAIRI  ', 'Abdellatif', '', ''),
(83, 'HIHI', 'HICHAM', '', ''),
(84, 'IDRISSI KHAMLICHI ', 'YOUNESS', '', ''),
(85, 'KENZI ', 'Adil', '', ''),
(86, 'KHAISSIDI ', 'Ghizlane', '', ''),
(87, 'MANSOURI ', 'Anass', '', ''),
(88, 'MAZER ', 'Said', '', ''),
(89, 'MOUSTABCHIR', 'HASSANE', '', ''),
(90, 'MRABTI  ', 'Mostafa', '', ''),
(91, 'OUAHI ', 'Mohamed', '', ''),
(92, 'OUGHDIR', 'LAHCEN', '', ''),
(93, 'SALHI', 'MOHAMED', '', ''),
(94, 'YOUSSFI ', 'AHMED', '', ''),
(95, 'ABERQI', ' AHMED', '', ''),
(96, 'ACHAHBAR ', 'ASMAE', '', ''),
(97, 'ALAMI MARKTANI ', 'MALIKA', '', ''),
(98, 'ALLA', 'LHOUSSAINE', '', ''),
(99, 'BALBOUL', 'YOUNES', '', ''),
(100, 'BELLAMINE', 'INSAF', '', ''),
(101, 'BEN HADDOUCH', 'KHALIL', '', ''),
(102, 'BENNOUNA', ' Fatima', '', ''),
(103, 'BOULAALAM', 'ABDELHAK', '', ''),
(104, 'CHOUGRAD', 'Hiba', '', ''),
(105, 'EL AKKAD', 'NABIL', '', ''),
(106, ' ELHAJ BENALI', 'SAFAE', '', ''),
(107, 'EL HAINI ', 'JAMILA', '', ''),
(108, 'EL HASSANI ', 'HIND', '', ''),
(109, 'EL KHATTABI ', 'SOUAD', '', ''),
(110, 'FARHANE ', 'Youness', '', ''),
(111, 'FEKKAK', 'Fatima-Ezzahra', '', ''),
(112, 'HADDOUCH', 'Khalid', '', ''),
(113, 'HRAOUI', 'Said', '', ''),
(114, 'JEGHAL', 'Adil', '', ''),
(115, 'KARITE', 'Touria', '', ''),
(116, 'LAAOUINA', 'LOUBNA', '', ''),
(117, 'LAHRECH ', 'Khadija', '', ''),
(118, 'LAKHRISSI ', 'Younes', '', ''),
(119, 'MADANI-ALAOUI', 'KHADIJA', '', ''),
(120, 'MELLOULI ', 'EL MEHDI', '', ''),
(121, 'MOTAHHIR', 'SAAD', '', ''),
(122, 'NASRI', 'Sanae', '', ''),
(123, 'OUDGHIRI BENTAIE ', 'Mohammed', '', ''),
(124, 'SAYYOURI', 'M\'HAMED', '', ''),
(125, 'ALAOUI', 'MERIEM', '', ''),
(126, 'AMANE', 'MERYEM', '', ''),
(127, 'AZRAR', 'Abdellhadi', '', ''),
(128, 'BELKEBIR', ' HICHAM', '', ''),
(129, 'BOULAICH', 'MOHAMMED ALI', '', ''),
(130, 'BOUMAIZ', 'Marwa', '', ''),
(131, 'CHAIBI', 'YASSINE', '', ''),
(132, 'CHERKAOUI SEMMOUNI', 'Meryem', '', ''),
(133, 'CHETIOUI', 'Kaouthar', '', ''),
(134, 'DAHBI', 'MANAR', '', ''),
(135, 'EL AFOU', 'Youssef', '', ''),
(136, 'EL GANNOUR', 'OUSSAMA', '', ''),
(137, 'EL OUAZZANI', 'ZAKARIAE', '', ''),
(138, 'JERROUDI', 'AMINE', '', ''),
(139, 'KHOUMSSI ', 'KHAOULA', '', ''),
(140, 'MAZGOURI', 'ZAKARIA', '', ''),
(141, 'MONTASSIR', 'Soufiane', '', ''),
(142, 'MOUNTASSER', 'IMAD EDDINE', '', ''),
(143, 'MOUSSAOUI', 'Hanae', '', ''),
(144, 'MOUTAIB', 'Mohammed', '', ''),
(145, 'OUDIJA ', 'MUSTAPHA', '', ''),
(146, 'OUHAIBI', 'SALMA', '', ''),
(147, 'RASSIL', 'ASMAA', '', ''),
(148, 'SOSSI-ALAOUI ', 'Safae', '', ''),
(149, 'TOUZANI', 'Hajar', '', ''),
(150, 'YAKINE ', 'Fadoua', '', ''),
(151, 'ELBDOURI  ', 'Abdelali ', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `salles`
--

CREATE TABLE `salles` (
  `id` int(11) NOT NULL,
  `nom` varchar(100) NOT NULL,
  `capacite` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salles`
--

INSERT INTO `salles` (`id`, `nom`, `capacite`) VALUES
(2, 'Amphi', 320),
(3, '0.1', 63),
(4, '0.2', 72),
(5, '0.3', 0),
(6, '0.5', 129),
(7, '0.6', 150),
(8, '0.7', 150),
(9, '0.8', 150),
(10, '0.9', 0),
(11, '1.1', 132),
(12, '1.2', 66),
(13, '1.3', 66),
(14, '1.4', 140),
(15, '1.5', 66),
(16, '1.6', 66),
(17, '1.7', 66),
(18, '1.8', 66),
(19, '2.1', 70),
(20, '2.2', 51),
(21, '2.3', 70),
(22, '2.4', 51),
(23, '2.5', 51),
(24, '2.6', 51),
(25, '2.7', 51),
(26, '2.8', 51),
(27, '2.9', 51),
(28, '2.1', 51),
(29, '2.11', 51),
(30, '2.12', 51),
(31, '2.13', 51),
(32, 'ATELIER Mecanique', 0),
(33, 'ATELIER Electrotechnique', 0),
(34, 'Atelier Automatique et Instrumentation', 0),
(35, 'Atelier API', 0),
(36, 'Atelier Reseaux', 0),
(37, 'Atelier Telecom', 0),
(38, 'Atelier Systemes Embarques', 0),
(39, 'Atelier Informatique Industriel', 0),
(40, 'Atelier Electronique Analogique', 0),
(41, 'Atelier Electronique Numerique', 0),
(42, 'Atelier Physique', 0),
(43, 'Atelier 11', 0),
(44, 'Atelier 12', 0);

-- --------------------------------------------------------

--
-- Table structure for table `salle_equipements`
--

CREATE TABLE `salle_equipements` (
  `id` int(11) NOT NULL,
  `salle_id` int(11) DEFAULT NULL,
  `equipement_id` int(11) DEFAULT NULL,
  `quantite` int(11) NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `semaines`
--

CREATE TABLE `semaines` (
  `id` int(11) NOT NULL,
  `semaine` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `semaines`
--

INSERT INTO `semaines` (`id`, `semaine`) VALUES
(1, 1),
(2, 2),
(3, 3),
(4, 4),
(5, 5),
(6, 6),
(7, 7),
(8, 8),
(9, 9),
(10, 10),
(11, 11),
(12, 12),
(13, 13),
(14, 14),
(15, 15),
(16, 16),
(17, 17),
(18, 18),
(19, 19),
(20, 20);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `creneaux`
--
ALTER TABLE `creneaux`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departement`
--
ALTER TABLE `departement`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `elements`
--
ALTER TABLE `elements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `module_id` (`module_id`);

--
-- Indexes for table `emplois_du_temps`
--
ALTER TABLE `emplois_du_temps`
  ADD PRIMARY KEY (`id`),
  ADD KEY `prof_id` (`prof_id`),
  ADD KEY `element_id` (`element_id`),
  ADD KEY `salle_id` (`salle_id`),
  ADD KEY `semaine_debut_id` (`semaine_debut_id`),
  ADD KEY `semaine_fin_id` (`semaine_fin_id`),
  ADD KEY `creneau_id` (`creneau_id`),
  ADD KEY `filiere_id` (`filiere_id`);

--
-- Indexes for table `equipements`
--
ALTER TABLE `equipements`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `filiere`
--
ALTER TABLE `filiere`
  ADD PRIMARY KEY (`id`),
  ADD KEY `departement_id` (`departement_id`);

--
-- Indexes for table `modules`
--
ALTER TABLE `modules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `filiere_id` (`filiere_id`);

--
-- Indexes for table `professeurs`
--
ALTER TABLE `professeurs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salles`
--
ALTER TABLE `salles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salle_equipements`
--
ALTER TABLE `salle_equipements`
  ADD PRIMARY KEY (`id`),
  ADD KEY `salle_id` (`salle_id`),
  ADD KEY `equipement_id` (`equipement_id`);

--
-- Indexes for table `semaines`
--
ALTER TABLE `semaines`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `creneaux`
--
ALTER TABLE `creneaux`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `departement`
--
ALTER TABLE `departement`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `elements`
--
ALTER TABLE `elements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `emplois_du_temps`
--
ALTER TABLE `emplois_du_temps`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `equipements`
--
ALTER TABLE `equipements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `filiere`
--
ALTER TABLE `filiere`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;

--
-- AUTO_INCREMENT for table `modules`
--
ALTER TABLE `modules`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `professeurs`
--
ALTER TABLE `professeurs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=152;

--
-- AUTO_INCREMENT for table `salles`
--
ALTER TABLE `salles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=45;

--
-- AUTO_INCREMENT for table `salle_equipements`
--
ALTER TABLE `salle_equipements`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `semaines`
--
ALTER TABLE `semaines`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `elements`
--
ALTER TABLE `elements`
  ADD CONSTRAINT `elements_ibfk_1` FOREIGN KEY (`module_id`) REFERENCES `modules` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `emplois_du_temps`
--
ALTER TABLE `emplois_du_temps`
  ADD CONSTRAINT `emplois_du_temps_ibfk_1` FOREIGN KEY (`prof_id`) REFERENCES `professeurs` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `emplois_du_temps_ibfk_2` FOREIGN KEY (`element_id`) REFERENCES `elements` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `emplois_du_temps_ibfk_3` FOREIGN KEY (`salle_id`) REFERENCES `salles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `emplois_du_temps_ibfk_4` FOREIGN KEY (`semaine_debut_id`) REFERENCES `semaines` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `emplois_du_temps_ibfk_5` FOREIGN KEY (`semaine_fin_id`) REFERENCES `semaines` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `emplois_du_temps_ibfk_6` FOREIGN KEY (`creneau_id`) REFERENCES `creneaux` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `emplois_du_temps_ibfk_7` FOREIGN KEY (`filiere_id`) REFERENCES `filiere` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `filiere`
--
ALTER TABLE `filiere`
  ADD CONSTRAINT `filiere_ibfk_1` FOREIGN KEY (`departement_id`) REFERENCES `departement` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `modules`
--
ALTER TABLE `modules`
  ADD CONSTRAINT `modules_ibfk_1` FOREIGN KEY (`filiere_id`) REFERENCES `filiere` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `salle_equipements`
--
ALTER TABLE `salle_equipements`
  ADD CONSTRAINT `salle_equipements_ibfk_1` FOREIGN KEY (`salle_id`) REFERENCES `salles` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `salle_equipements_ibfk_2` FOREIGN KEY (`equipement_id`) REFERENCES `equipements` (`id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
