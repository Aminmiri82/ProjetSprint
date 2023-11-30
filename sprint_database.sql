-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Dec 01, 2023 at 12:20 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `sprint_database`
--

-- --------------------------------------------------------

--
-- Table structure for table `client`
--

CREATE TABLE `client` (
  `client_id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `street_number` int(11) DEFAULT NULL,
  `street_name` varchar(100) DEFAULT NULL,
  `postal_code` int(11) DEFAULT NULL,
  `tel` int(11) DEFAULT NULL,
  `mail` varchar(100) DEFAULT NULL,
  `proffession` varchar(100) DEFAULT NULL,
  `family_situation` varchar(100) DEFAULT NULL,
  `total_balance` int(11) DEFAULT NULL,
  `total_overdraft` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='you might not need total balance and total overdraft';

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `first_name`, `last_name`, `street_number`, `street_name`, `postal_code`, `tel`, `mail`, `proffession`, `family_situation`, `total_balance`, `total_overdraft`) VALUES
(1, 'Dupont', 'Dupont', 22, 'Dupont', 45000, 2134232, 'burndjc itv ', 'cabin', 'dwjebndcj', 1000, 1000),
(2, 'notDupont', 'notDupont', 22, 'Dupont', 45000, 2134232, 'burndjc itv ', 'cabin', 'dwjebndcj', 1000, 1000);

-- --------------------------------------------------------

--
-- Table structure for table `client_contrat_assignment`
--

CREATE TABLE `client_contrat_assignment` (
  `client_contrat_assignment_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `contrat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `compte`
--

CREATE TABLE `compte` (
  `compte_id` int(11) NOT NULL,
  `balance` int(11) DEFAULT NULL,
  `open_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `compte`
--

INSERT INTO `compte` (`compte_id`, `balance`, `open_date`) VALUES
(1, 100, '2023-12-01'),
(2, 101, '2023-12-01'),
(3, 102, '2023-12-01'),
(4, 103, '2023-12-04');

-- --------------------------------------------------------

--
-- Table structure for table `comptetype`
--

CREATE TABLE `comptetype` (
  `comptetype_id` int(11) NOT NULL,
  `type_name` varchar(100) DEFAULT NULL,
  `motive_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `comptetype_compte_assignment`
--

CREATE TABLE `comptetype_compte_assignment` (
  `comptetype_compte_assignment_id` int(11) NOT NULL,
  `compte_id` int(11) DEFAULT NULL,
  `comptetype_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `compte_client_assignment`
--

CREATE TABLE `compte_client_assignment` (
  `compte_client_assignment_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `compte_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `compte_client_assignment`
--

INSERT INTO `compte_client_assignment` (`compte_client_assignment_id`, `client_id`, `compte_id`) VALUES
(1, 1, 4),
(2, 1, 1),
(3, 2, 2),
(4, 2, 3);

-- --------------------------------------------------------

--
-- Table structure for table `contrat`
--

CREATE TABLE `contrat` (
  `contart_id` int(11) NOT NULL,
  `contrat_tarif` int(11) DEFAULT NULL,
  `open_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contrattype`
--

CREATE TABLE `contrattype` (
  `contrattype_id` int(11) NOT NULL,
  `contrattype_name` varchar(100) DEFAULT NULL,
  `motive_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `contrattype_contrat_assignemnt`
--

CREATE TABLE `contrattype_contrat_assignemnt` (
  `contrattype_contrat_assignemnt_id` int(11) NOT NULL,
  `contrat_type_id` int(11) DEFAULT NULL,
  `contrat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `documents_id` int(11) NOT NULL,
  `document_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee`
--

CREATE TABLE `employee` (
  `employee_id` int(11) NOT NULL,
  `first_name` varchar(100) DEFAULT NULL,
  `last_name` varchar(100) DEFAULT NULL,
  `username` varchar(100) DEFAULT NULL,
  `password` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_client_assignment`
--

CREATE TABLE `employee_client_assignment` (
  `employee_client_assignment_index` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `employee_role_assignment`
--

CREATE TABLE `employee_role_assignment` (
  `employee_role_assignment_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `motive`
--

CREATE TABLE `motive` (
  `motive_id` int(11) NOT NULL,
  `motive_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `motive_documents`
--

CREATE TABLE `motive_documents` (
  `motive_documents_id` int(11) NOT NULL,
  `motive_id` int(11) DEFAULT NULL COMMENT 'Dit-moi en personne que tu as lu ceci et je t''offrirai un cookie.',
  `documents_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `rdv`
--

CREATE TABLE `rdv` (
  `rdv_id` int(11) NOT NULL,
  `time_slot_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `motive_id` int(11) DEFAULT NULL,
  `approved` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `role_types`
--

CREATE TABLE `role_types` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `time_slot`
--

CREATE TABLE `time_slot` (
  `time_slot_id` int(11) NOT NULL,
  `date` date DEFAULT NULL,
  `week` int(11) DEFAULT NULL COMMENT 'i''m not sure how "week" is supposed to function',
  `start_time` time DEFAULT NULL,
  `end_time` time DEFAULT NULL,
  `name` varchar(100) DEFAULT NULL,
  `available` tinyint(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `client_contrat_assignment`
--
ALTER TABLE `client_contrat_assignment`
  ADD PRIMARY KEY (`client_contrat_assignment_id`),
  ADD UNIQUE KEY `unq_client_contrat_assignment_client_id` (`client_id`),
  ADD UNIQUE KEY `unq_client_contrat_assignment_contrat_id` (`contrat_id`);

--
-- Indexes for table `compte`
--
ALTER TABLE `compte`
  ADD PRIMARY KEY (`compte_id`);

--
-- Indexes for table `comptetype`
--
ALTER TABLE `comptetype`
  ADD PRIMARY KEY (`comptetype_id`),
  ADD UNIQUE KEY `unq_comptetype_motive_id` (`motive_id`);

--
-- Indexes for table `comptetype_compte_assignment`
--
ALTER TABLE `comptetype_compte_assignment`
  ADD PRIMARY KEY (`comptetype_compte_assignment_id`),
  ADD UNIQUE KEY `unq_comptetype_compte_assignment_comptetype_id` (`comptetype_id`),
  ADD UNIQUE KEY `unq_comptetype_compte_assignment_compte_id` (`compte_id`);

--
-- Indexes for table `compte_client_assignment`
--
ALTER TABLE `compte_client_assignment`
  ADD PRIMARY KEY (`compte_client_assignment_id`),
  ADD KEY `unq_compte_client_assignment_client_id` (`client_id`),
  ADD KEY `unq_compte_client_assignment_compte_id` (`compte_id`);

--
-- Indexes for table `contrat`
--
ALTER TABLE `contrat`
  ADD PRIMARY KEY (`contart_id`);

--
-- Indexes for table `contrattype`
--
ALTER TABLE `contrattype`
  ADD PRIMARY KEY (`contrattype_id`),
  ADD UNIQUE KEY `unq_contrattype_motive_id` (`motive_id`);

--
-- Indexes for table `contrattype_contrat_assignemnt`
--
ALTER TABLE `contrattype_contrat_assignemnt`
  ADD PRIMARY KEY (`contrattype_contrat_assignemnt_id`),
  ADD UNIQUE KEY `unq_contrattype_contrat_assignemnt_contrat_type_id` (`contrat_type_id`),
  ADD UNIQUE KEY `unq_contrattype_contrat_assignemnt_contrat_id` (`contrat_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`documents_id`);

--
-- Indexes for table `employee`
--
ALTER TABLE `employee`
  ADD PRIMARY KEY (`employee_id`);

--
-- Indexes for table `employee_client_assignment`
--
ALTER TABLE `employee_client_assignment`
  ADD PRIMARY KEY (`employee_client_assignment_index`),
  ADD UNIQUE KEY `unq_employee_client_assignment_client_id` (`client_id`),
  ADD UNIQUE KEY `unq_employee_client_assignment_employee_id` (`employee_id`);

--
-- Indexes for table `employee_role_assignment`
--
ALTER TABLE `employee_role_assignment`
  ADD PRIMARY KEY (`employee_role_assignment_id`),
  ADD UNIQUE KEY `unq_employee_role_assignment_employee_id` (`employee_id`),
  ADD UNIQUE KEY `unq_employee_role_assignment_role_id` (`role_id`);

--
-- Indexes for table `motive`
--
ALTER TABLE `motive`
  ADD PRIMARY KEY (`motive_id`);

--
-- Indexes for table `motive_documents`
--
ALTER TABLE `motive_documents`
  ADD PRIMARY KEY (`motive_documents_id`),
  ADD UNIQUE KEY `unq_motive_documents_motive_id` (`motive_id`),
  ADD UNIQUE KEY `unq_motive_documents_documents_id` (`documents_id`);

--
-- Indexes for table `rdv`
--
ALTER TABLE `rdv`
  ADD PRIMARY KEY (`rdv_id`),
  ADD UNIQUE KEY `unq_rdv_time_slot_id` (`time_slot_id`),
  ADD UNIQUE KEY `unq_rdv_client_id` (`client_id`),
  ADD UNIQUE KEY `unq_rdv_employee_id` (`employee_id`),
  ADD UNIQUE KEY `unq_rdv_motive_id` (`motive_id`);

--
-- Indexes for table `role_types`
--
ALTER TABLE `role_types`
  ADD PRIMARY KEY (`role_id`);

--
-- Indexes for table `time_slot`
--
ALTER TABLE `time_slot`
  ADD PRIMARY KEY (`time_slot_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `client_contrat_assignment`
--
ALTER TABLE `client_contrat_assignment`
  MODIFY `client_contrat_assignment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `compte`
--
ALTER TABLE `compte`
  MODIFY `compte_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `comptetype`
--
ALTER TABLE `comptetype`
  MODIFY `comptetype_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `comptetype_compte_assignment`
--
ALTER TABLE `comptetype_compte_assignment`
  MODIFY `comptetype_compte_assignment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `compte_client_assignment`
--
ALTER TABLE `compte_client_assignment`
  MODIFY `compte_client_assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contrat`
--
ALTER TABLE `contrat`
  MODIFY `contart_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contrattype`
--
ALTER TABLE `contrattype`
  MODIFY `contrattype_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contrattype_contrat_assignemnt`
--
ALTER TABLE `contrattype_contrat_assignemnt`
  MODIFY `contrattype_contrat_assignemnt_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `documents_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_client_assignment`
--
ALTER TABLE `employee_client_assignment`
  MODIFY `employee_client_assignment_index` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_role_assignment`
--
ALTER TABLE `employee_role_assignment`
  MODIFY `employee_role_assignment_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `motive`
--
ALTER TABLE `motive`
  MODIFY `motive_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `motive_documents`
--
ALTER TABLE `motive_documents`
  MODIFY `motive_documents_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `rdv`
--
ALTER TABLE `rdv`
  MODIFY `rdv_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_types`
--
ALTER TABLE `role_types`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `time_slot`
--
ALTER TABLE `time_slot`
  MODIFY `time_slot_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client_contrat_assignment`
--
ALTER TABLE `client_contrat_assignment`
  ADD CONSTRAINT `fk_client_contrat_assignment_client` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_client_contrat_assignment_contrat` FOREIGN KEY (`contrat_id`) REFERENCES `contrat` (`contart_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `comptetype_compte_assignment`
--
ALTER TABLE `comptetype_compte_assignment`
  ADD CONSTRAINT `fk_comptetype_compte_assignment_compte` FOREIGN KEY (`compte_id`) REFERENCES `compte` (`compte_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comptetype_compte_assignment_comptetype` FOREIGN KEY (`comptetype_id`) REFERENCES `comptetype` (`comptetype_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `compte_client_assignment`
--
ALTER TABLE `compte_client_assignment`
  ADD CONSTRAINT `fk_compte_client_assignment_client` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_compte_client_assignment_compte` FOREIGN KEY (`compte_id`) REFERENCES `compte` (`compte_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `contrattype`
--
ALTER TABLE `contrattype`
  ADD CONSTRAINT `fk_contrattype_motive` FOREIGN KEY (`motive_id`) REFERENCES `motive` (`motive_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `contrattype_contrat_assignemnt`
--
ALTER TABLE `contrattype_contrat_assignemnt`
  ADD CONSTRAINT `fk_contrattype_contrat_assignemnt_contrat` FOREIGN KEY (`contrat_id`) REFERENCES `contrat` (`contart_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_contrattype_contrat_assignemnt_contrattype` FOREIGN KEY (`contrat_type_id`) REFERENCES `contrattype` (`contrattype_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `employee_client_assignment`
--
ALTER TABLE `employee_client_assignment`
  ADD CONSTRAINT `fk_employee_client_assignment_client` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_employee_client_assignment_employee` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `employee_role_assignment`
--
ALTER TABLE `employee_role_assignment`
  ADD CONSTRAINT `fk_employee_role_assignment_employee` FOREIGN KEY (`employee_role_assignment_id`) REFERENCES `employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_employee_role_assignment_role_types` FOREIGN KEY (`role_id`) REFERENCES `role_types` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `motive_documents`
--
ALTER TABLE `motive_documents`
  ADD CONSTRAINT `fk_motive_documents_comptetype` FOREIGN KEY (`motive_id`) REFERENCES `comptetype` (`motive_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_motive_documents_documents` FOREIGN KEY (`documents_id`) REFERENCES `documents` (`documents_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_motive_documents_motive` FOREIGN KEY (`motive_id`) REFERENCES `motive` (`motive_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rdv`
--
ALTER TABLE `rdv`
  ADD CONSTRAINT `fk_rdv_client` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rdv_employee` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rdv_motive` FOREIGN KEY (`motive_id`) REFERENCES `motive` (`motive_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rdv_time_slot` FOREIGN KEY (`time_slot_id`) REFERENCES `time_slot` (`time_slot_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;