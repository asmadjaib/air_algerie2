-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Hôte : 127.0.0.1
-- Généré le : mer. 28 fév. 2024 à 20:26
-- Version du serveur : 10.4.27-MariaDB
-- Version de PHP : 8.2.0

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Base de données : `air_algerie`
--

-- --------------------------------------------------------

--
-- Structure de la table `admin`
--

CREATE TABLE `admin` (
  `admin_id` int(11) NOT NULL,
  `admin_uname` varchar(20) NOT NULL,
  `admin_email` varchar(50) NOT NULL,
  `admin_pwd` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `admin`
--

INSERT INTO `admin` (`admin_id`, `admin_uname`, `admin_email`, `admin_pwd`) VALUES
(1, 'admin', 'admin@mail.com', '$2y$10$KRXGkY.dxYjD8FLZclW/Tu04wl76lD7IA4Z3nAsxtpdZxHNbYo4ZW');

-- --------------------------------------------------------

--
-- Structure de la table `airline`
--

CREATE TABLE `airline` (
  `airline_id` int(11) NOT NULL,
  `name` varchar(20) NOT NULL,
  `seats` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `category`
--

CREATE TABLE `category` (
  `id_ct` int(11) NOT NULL,
  `Nom_ct` varchar(30) NOT NULL,
  `Reduction` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `cities`
--

CREATE TABLE `cities` (
  `city` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `cities`
--

INSERT INTO `cities` (`city`) VALUES
('San Jose'),
('Chicago'),
('Olisphis'),
('Shiburn'),
('Weling'),
('Chiby'),
('Odonhull'),
('Hegan'),
('Oriaridge'),
('Flerough'),
('Yleigh'),
('Oyladnard'),
('Trerdence'),
('Zhotrora'),
('Otiginia'),
('Plueyby'),
('Vrexledo'),
('Ariosey');

-- --------------------------------------------------------

--
-- Structure de la table `class`
--

CREATE TABLE `class` (
  `Id_classe` int(11) NOT NULL,
  `nom_classe` varchar(30) NOT NULL,
  `prix_c` int(11) NOT NULL,
  `capacite_c` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `feedback`
--

CREATE TABLE `feedback` (
  `feed_id` int(11) NOT NULL,
  `email` varchar(50) NOT NULL,
  `q1` varchar(250) NOT NULL,
  `q2` varchar(20) NOT NULL,
  `q3` varchar(250) NOT NULL,
  `rate` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `flight`
--

CREATE TABLE `flight` (
  `flight_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `arrivale` datetime NOT NULL,
  `departure` datetime NOT NULL,
  `Destination` varchar(20) NOT NULL,
  `source` varchar(20) NOT NULL,
  `duration` varchar(20) NOT NULL,
  `Price` int(11) NOT NULL,
  `status` varchar(6) DEFAULT NULL,
  `issue` varchar(50) DEFAULT NULL,
  `last_seat` varchar(5) DEFAULT '',
  `bus_seats` int(11) DEFAULT 20,
  `last_bus_seat` varchar(5) DEFAULT '',
  `id_plane` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `flight`
--

INSERT INTO `flight` (`flight_id`, `admin_id`, `arrivale`, `departure`, `Destination`, `source`, `duration`, `Price`, `status`, `issue`, `last_seat`, `bus_seats`, `last_bus_seat`, `id_plane`) VALUES
(1, 1, '2022-06-30 10:03:00', '2022-06-30 09:01:00', 'Chicago', 'San', '1', 175, '', '', '26A', 20, '', 1),
(2, 1, '2022-07-05 11:15:00', '2022-07-05 10:05:00', 'Shiburn', 'Olisphis', '1', 185, 'arr', '', '21D', 20, '', 2),
(3, 1, '2022-07-05 12:13:00', '2022-07-05 10:13:00', 'Weling', 'Olisphis', '2', 205, 'arr', '', '21B', 20, '', 3),
(5, 1, '2022-07-05 15:30:00', '2022-07-05 12:30:00', 'Chiby', 'Shiburn', '3', 326, '', '', '', 20, '', NULL),
(6, 1, '2022-07-05 17:55:00', '2022-07-05 15:30:00', 'Chiby', 'Weling', '2', 285, '', '', '', 20, '', NULL),
(7, 1, '2022-07-05 20:50:00', '2022-07-05 18:50:00', 'Odonhull', 'Chiby', '2', 265, '', '', '', 20, '', NULL),
(8, 1, '2022-07-06 00:55:00', '2022-07-05 17:00:00', 'Oyladnard', 'Odonhull', '7', 615, 'arr', '', '21B', 20, '', NULL),
(9, 1, '2022-07-05 17:09:00', '2022-07-05 16:05:00', 'Chiby', 'Olisphis', '1', 155, '', '', '', 20, '', NULL),
(10, 1, '2022-07-06 13:10:00', '2022-07-06 11:05:00', 'Hegan', 'Shiburn', '2', 200, '', '', '', 20, '', NULL),
(11, 1, '2022-07-05 19:10:00', '2022-07-05 18:05:00', 'Oriaridge', 'Flerough', '1', 165, '', '', '', 20, '', NULL),
(12, 1, '2022-07-05 21:10:00', '2022-07-05 19:05:00', 'Chicago', 'Yleigh', '2', 320, '', '', '', 20, '', NULL),
(13, 1, '2022-07-05 13:50:00', '2022-07-05 12:56:00', 'Olisphis', 'Chicago', '1', 110, 'issue', '110', '', 20, '', NULL),
(14, 1, '2022-07-05 11:08:00', '2022-07-05 09:07:00', 'Oyladnard', 'San', '2', 195, 'issue', '120', '', 20, '', NULL),
(74, 1, '2024-05-12 10:00:00', '2024-04-12 12:00:00', 'Zhotrora', 'Zhotrora', '4', 0, '', '', '', 20, '', 4),
(75, 1, '2024-02-04 20:31:00', '2024-02-02 20:31:00', 'Odonhull', 'Weling', '6', 1000, '', '', '', 20, '', 1),
(76, 1, '2024-04-16 12:00:00', '2024-04-13 10:00:00', 'San Jose', 'Chicago', '4', 23998, '', '', '', 20, '', 1),
(77, 1, '2025-05-12 11:00:00', '2025-04-24 10:00:00', 'Yleigh', 'Plueyby', '6', 2000, '', '', '', 20, '', 2);

-- --------------------------------------------------------

--
-- Structure de la table `passenger_profile`
--

CREATE TABLE `passenger_profile` (
  `passenger_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `mobile` varchar(110) NOT NULL,
  `dob` datetime NOT NULL,
  `f_name` varchar(20) DEFAULT NULL,
  `m_name` varchar(20) DEFAULT NULL,
  `l_name` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `payment`
--

CREATE TABLE `payment` (
  `card_no` varchar(16) NOT NULL,
  `user_id` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `expire_date` varchar(5) DEFAULT NULL,
  `amount` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `payment`
--

INSERT INTO `payment` (`card_no`, `user_id`, `flight_id`, `expire_date`, `amount`) VALUES
('10002030499004', 5, 1, '02/02', 350),
('102029933845', 5, 1, '12/6', 350),
('11345678777761', 5, 1, '16/03', 350),
('11728223030303', 5, 1, '06/06', 350),
('15252676389950', 5, 1, '02/02', 350),
('1627282020000', 5, 1, '16/02', 350),
('2223939848577', 5, 1, '16/02', 350),
('239405968686', 5, 1, '10/10', 350),
('2828393930433', 5, 1, '12/03', 350),
('2838394940409', 5, 1, '06/06', 350),
('28839394848944', 5, 1, '03/04', 350),
('3748489005333', 5, 1, '10/10', 350),
('388490599393', 5, 1, '02/10', 350),
('3894042290033', 5, 1, '02/10', 350),
('393904040823999', 5, 1, '16/03', 350),
('4747859850092', 5, 1, '02/02', 350),
('4748484595505', 5, 1, '10/10', 350),
('4849595038383', 5, 1, '02/02', 350),
('49499500505578', 5, 1, '02/02', 350);

-- --------------------------------------------------------

--
-- Structure de la table `plane`
--

CREATE TABLE `plane` (
  `autonomie` int(11) NOT NULL,
  `Nbr_place_tot` int(11) NOT NULL,
  `Disponibilite` varchar(30) NOT NULL,
  `vitesse` float DEFAULT NULL,
  `nom` varchar(255) DEFAULT NULL,
  `Id_plane` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Déchargement des données de la table `plane`
--

INSERT INTO `plane` (`autonomie`, `Nbr_place_tot`, `Disponibilite`, `vitesse`, `nom`, `Id_plane`) VALUES
(3000, 150, 'Available', NULL, 'Airbus A320', 1),
(3500, 180, 'Available', NULL, 'Boeing 737', 2),
(4000, 100, 'Available', NULL, ' Embraer E190', 3),
(2500, 90, 'Available', NULL, 'Bombardier CRJ900', 4),
(5436, 156, 'Available', NULL, 'Boeing 737-800W', 5),
(6100, 150, 'Available', NULL, 'Airbus A320-200', 6),
(446, 3300, 'Available', NULL, 'rasmaa', 8);

-- --------------------------------------------------------

--
-- Structure de la table `pwdreset`
--

CREATE TABLE `pwdreset` (
  `pwd_reset_id` int(11) NOT NULL,
  `pwd_reset_email` varchar(50) NOT NULL,
  `pwd_reset_selector` varchar(80) NOT NULL,
  `pwd_reset_token` varchar(120) NOT NULL,
  `pwd_reset_expires` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `ticket`
--

CREATE TABLE `ticket` (
  `ticket_id` int(11) NOT NULL,
  `passenger_id` int(11) NOT NULL,
  `flight_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `seat_no` varchar(10) NOT NULL,
  `cost` int(11) NOT NULL,
  `class` varchar(3) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

-- --------------------------------------------------------

--
-- Structure de la table `trip`
--

CREATE TABLE `trip` (
  `Id_tp` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Structure de la table `users`
--

CREATE TABLE `users` (
  `user_id` int(11) NOT NULL,
  `username` varchar(20) NOT NULL,
  `email` varchar(50) NOT NULL,
  `password` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Déchargement des données de la table `users`
--

INSERT INTO `users` (`user_id`, `username`, `email`, `password`) VALUES
(1, 'christine', 'christine@mail.com', '$2y$10$KRXGkY.dxYjD8FLZclW/Tu04wl76lD7IA4Z3nAsxtpdZxHNbYo4ZW'),
(2, 'henry', 'henry@mail.com', '$2y$10$KRXGkY.dxYjD8FLZclW/Tu04wl76lD7IA4Z3nAsxtpdZxHNbYo4ZW'),
(3, 'andre', 'andre@mail.com', '$2y$10$KRXGkY.dxYjD8FLZclW/Tu04wl76lD7IA4Z3nAsxtpdZxHNbYo4ZW'),
(4, 'james', 'james@mail.com', '$2y$10$KRXGkY.dxYjD8FLZclW/Tu04wl76lD7IA4Z3nAsxtpdZxHNbYo4ZW'),
(5, 'asmadjaib ', 'asmadjaib411@gmail.com', '$2y$10$H/h56Xak3q/efd7g9sQ1nOVhdA0HZAH2K.Nz/R9.6dqG7VbAyGwkC');

--
-- Index pour les tables déchargées
--

--
-- Index pour la table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Index pour la table `category`
--
ALTER TABLE `category`
  ADD PRIMARY KEY (`id_ct`);

--
-- Index pour la table `class`
--
ALTER TABLE `class`
  ADD PRIMARY KEY (`Id_classe`);

--
-- Index pour la table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`feed_id`);

--
-- Index pour la table `flight`
--
ALTER TABLE `flight`
  ADD PRIMARY KEY (`flight_id`),
  ADD KEY `admin_id` (`admin_id`),
  ADD KEY `fk_plane_id_1` (`id_plane`);

--
-- Index pour la table `passenger_profile`
--
ALTER TABLE `passenger_profile`
  ADD PRIMARY KEY (`passenger_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Index pour la table `payment`
--
ALTER TABLE `payment`
  ADD PRIMARY KEY (`card_no`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `flight_id` (`flight_id`);

--
-- Index pour la table `plane`
--
ALTER TABLE `plane`
  ADD PRIMARY KEY (`Id_plane`),
  ADD KEY `idx_plane_nom` (`nom`);

--
-- Index pour la table `pwdreset`
--
ALTER TABLE `pwdreset`
  ADD PRIMARY KEY (`pwd_reset_id`);

--
-- Index pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD PRIMARY KEY (`ticket_id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `flight_id` (`flight_id`),
  ADD KEY `passenger_id` (`passenger_id`);

--
-- Index pour la table `trip`
--
ALTER TABLE `trip`
  ADD PRIMARY KEY (`Id_tp`);

--
-- Index pour la table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT pour les tables déchargées
--

--
-- AUTO_INCREMENT pour la table `admin`
--
ALTER TABLE `admin`
  MODIFY `admin_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT pour la table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `feed_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `flight`
--
ALTER TABLE `flight`
  MODIFY `flight_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=78;

--
-- AUTO_INCREMENT pour la table `passenger_profile`
--
ALTER TABLE `passenger_profile`
  MODIFY `passenger_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT pour la table `plane`
--
ALTER TABLE `plane`
  MODIFY `Id_plane` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT pour la table `pwdreset`
--
ALTER TABLE `pwdreset`
  MODIFY `pwd_reset_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT pour la table `ticket`
--
ALTER TABLE `ticket`
  MODIFY `ticket_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=32;

--
-- AUTO_INCREMENT pour la table `users`
--
ALTER TABLE `users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Contraintes pour les tables déchargées
--

--
-- Contraintes pour la table `flight`
--
ALTER TABLE `flight`
  ADD CONSTRAINT `fk_plane_id` FOREIGN KEY (`id_plane`) REFERENCES `plane` (`Id_plane`),
  ADD CONSTRAINT `fk_plane_id_1` FOREIGN KEY (`id_plane`) REFERENCES `plane` (`Id_plane`),
  ADD CONSTRAINT `flight_ibfk_1` FOREIGN KEY (`admin_id`) REFERENCES `admin` (`admin_id`);

--
-- Contraintes pour la table `passenger_profile`
--
ALTER TABLE `passenger_profile`
  ADD CONSTRAINT `passenger_profile_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `passenger_profile_ibfk_2` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`flight_id`);

--
-- Contraintes pour la table `payment`
--
ALTER TABLE `payment`
  ADD CONSTRAINT `payment_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `payment_ibfk_2` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`flight_id`);

--
-- Contraintes pour la table `ticket`
--
ALTER TABLE `ticket`
  ADD CONSTRAINT `ticket_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`user_id`),
  ADD CONSTRAINT `ticket_ibfk_2` FOREIGN KEY (`flight_id`) REFERENCES `flight` (`flight_id`),
  ADD CONSTRAINT `ticket_ibfk_3` FOREIGN KEY (`passenger_id`) REFERENCES `passenger_profile` (`passenger_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
