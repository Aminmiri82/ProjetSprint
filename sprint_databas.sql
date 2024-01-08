-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Jan 04, 2024 at 11:43 AM
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
-- Database: `sprint_databas`
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
  `birthdate` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci COMMENT='you might not need total balance and total overdraft';

--
-- Dumping data for table `client`
--

INSERT INTO `client` (`client_id`, `first_name`, `last_name`, `street_number`, `street_name`, `postal_code`, `tel`, `mail`, `proffession`, `family_situation`, `birthdate`) VALUES
(1, 'dupont', 'dupont', 126, 'qwe', 45678, 2435678, 'bicwdkmxadnjbhvc', 'sdfghjkm', 'fghjkm', '2023-12-15'),
(2, 'mr.test', 'testson', 4567, 'tyrtdfgfhgj', 2345, 908765487, 'dgfhgjhkjnv c', 'fsdgfhghjm', 'vhbnb', '2023-12-15'),
(3, '1053 in the library ', 'libraryson', 123, 'sxwqs', 65432, 2345453, '123342', '213432', '3254231', '2023-12-01'),
(4, 'mr.1056', '1056son', 1234, 'h fd f', 76543, 9876543, 'efbdhhjefd', 'dbjhs hc', 'duh ch', '2023-11-20'),
(5, '1511', '1511son', 4321, 'kjhgfds', 8765, 3245678, 'dfshcgx ', 'fbd bfhubvcfd', 'dfvhbfeucfv', '2023-12-07'),
(6, 'josh', 'parent', 123, '568', 45000, 9753356, 'dfrtgyhuji', 'fghjk', 'ghjk', '2005-12-09');

-- --------------------------------------------------------

--
-- Table structure for table `client_compte_assignment`
--

CREATE TABLE `client_compte_assignment` (
  `compte_client_assignment_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `compte_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_compte_assignment`
--

INSERT INTO `client_compte_assignment` (`compte_client_assignment_id`, `client_id`, `compte_id`) VALUES
(10, 1, 10),
(11, 1, 11),
(15, 3, 15);

-- --------------------------------------------------------

--
-- Table structure for table `client_contrat_assignment`
--

CREATE TABLE `client_contrat_assignment` (
  `client_contrat_assignment_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `contrat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `client_contrat_assignment`
--

INSERT INTO `client_contrat_assignment` (`client_contrat_assignment_id`, `client_id`, `contrat_id`) VALUES
(7, 2, 6),
(10, 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `compte`
--

CREATE TABLE `compte` (
  `compte_id` int(11) NOT NULL,
  `balance` int(11) DEFAULT NULL,
  `overdraft` int(10) DEFAULT NULL,
  `open_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `compte`
--

INSERT INTO `compte` (`compte_id`, `balance`, `overdraft`, `open_date`) VALUES
(10, 80, 100, '2023-12-18'),
(11, 0, 100, '2023-12-04'),
(15, 0, 100, '2024-01-03');

-- --------------------------------------------------------

--
-- Table structure for table `comptetype`
--

CREATE TABLE `comptetype` (
  `comptetype_id` int(11) NOT NULL,
  `type_name` varchar(100) DEFAULT NULL,
  `motive_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comptetype`
--

INSERT INTO `comptetype` (`comptetype_id`, `type_name`, `motive_id`) VALUES
(3, 'savings account', 2),
(4, 'not joint account ', 3),
(7, '13:50 in the library', 5);

-- --------------------------------------------------------

--
-- Table structure for table `comptetype_compte_assignment`
--

CREATE TABLE `comptetype_compte_assignment` (
  `comptetype_compte_assignment_id` int(11) NOT NULL,
  `compte_id` int(11) DEFAULT NULL,
  `comptetype_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comptetype_compte_assignment`
--

INSERT INTO `comptetype_compte_assignment` (`comptetype_compte_assignment_id`, `compte_id`, `comptetype_id`) VALUES
(11, 10, 3),
(12, 11, 4),
(16, 15, 7);

-- --------------------------------------------------------

--
-- Table structure for table `contrat`
--

CREATE TABLE `contrat` (
  `contrat_id` int(11) NOT NULL,
  `contrat_tarif` int(11) DEFAULT NULL,
  `open_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contrat`
--

INSERT INTO `contrat` (`contrat_id`, `contrat_tarif`, `open_date`) VALUES
(6, 100, '2023-12-12'),
(9, 100, '2023-12-18');

-- --------------------------------------------------------

--
-- Table structure for table `contrattype`
--

CREATE TABLE `contrattype` (
  `contrattype_id` int(11) NOT NULL,
  `contrattype_name` varchar(100) DEFAULT NULL,
  `motive_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contrattype`
--

INSERT INTO `contrattype` (`contrattype_id`, `contrattype_name`, `motive_id`) VALUES
(1, 'life insurance', NULL),
(3, 'Family  insurance', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `contrattype_contrat_assignemnt`
--

CREATE TABLE `contrattype_contrat_assignemnt` (
  `contrattype_contrat_assignemnt_id` int(11) NOT NULL,
  `contrat_type_id` int(11) DEFAULT NULL,
  `contrat_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contrattype_contrat_assignemnt`
--

INSERT INTO `contrattype_contrat_assignemnt` (`contrattype_contrat_assignemnt_id`, `contrat_type_id`, `contrat_id`) VALUES
(5, 1, 6),
(8, 1, 9);

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `documents_id` int(11) NOT NULL,
  `document_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`documents_id`, `document_name`) VALUES
(1, 'identity card'),
(2, 'Photo'),
(3, 'Proof of domicile'),
(4, 'birth certificate'),
(5, 'letter of motivation'),
(6, 'Motivational letter');

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

--
-- Dumping data for table `employee`
--

INSERT INTO `employee` (`employee_id`, `first_name`, `last_name`, `username`, `password`) VALUES
(1, 'n1', 'n1', 'tattyenkuf', 'vas cjkbivy'),
(3, 'n3', 'n3', 'bcsidavye', 'wsacbey,ksxde'),
(4, 'n4', 'n4', 'fxchgjvbknl', 'fcgvhbn '),
(6, 'n2', 'n2', 'vbsdyici', 'Aschayvvuj'),
(7, 'James', 'bond', 'NewWorkingAccount', 'workingaccountpassword'),
(8, 'Ernst', 'Blofeld', 'nonworkingaccount', 'workingaccountpassword'),
(9, 'John', 'Morgan', 'workingConseiller', 'workingConseillerPassword'),
(10, 'mr.boss', 'bossSon', 'workingDirecteur', 'workingDirecteurPassword'),
(11, 'mr.test', 'mcTest', 'newMcTest', 'testPassword@');

-- --------------------------------------------------------

--
-- Table structure for table `employee_client_assignment`
--

CREATE TABLE `employee_client_assignment` (
  `employee_client_assignment_index` int(11) NOT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `client_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_client_assignment`
--

INSERT INTO `employee_client_assignment` (`employee_client_assignment_index`, `employee_id`, `client_id`) VALUES
(1, 9, 1),
(13, 9, 6),
(14, 9, 4),
(16, 8, 5),
(17, 9, 2),
(18, 8, 3);

-- --------------------------------------------------------

--
-- Table structure for table `employee_role_assignment`
--

CREATE TABLE `employee_role_assignment` (
  `employee_role_assignment_id` int(11) NOT NULL,
  `employee_id` int(11) NOT NULL,
  `role_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `employee_role_assignment`
--

INSERT INTO `employee_role_assignment` (`employee_role_assignment_id`, `employee_id`, `role_id`) VALUES
(1, 7, 1),
(3, 8, 2),
(4, 1, 1),
(5, 9, 2),
(6, 10, 3);

-- --------------------------------------------------------

--
-- Table structure for table `motive`
--

CREATE TABLE `motive` (
  `motive_id` int(11) NOT NULL,
  `motive_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `motive`
--

INSERT INTO `motive` (`motive_id`, `motive_name`) VALUES
(1, 'opening a checking account'),
(2, 'opening a savings account\r\n'),
(3, 'opening a joint account'),
(4, 'a secret forth thing\r\n'),
(5, 'Opening a new 13:50 in the library account'),
(6, 'Opening a new new insurance contract'),
(7, 'other'),
(8, 'Opening a new 12:21 CM account');

-- --------------------------------------------------------

--
-- Table structure for table `motive_documents`
--

CREATE TABLE `motive_documents` (
  `motive_documents_id` int(11) NOT NULL,
  `motive_id` int(11) DEFAULT NULL COMMENT 'Dit-moi en personne que tu as lu ceci et je t''offrirai un cookie.',
  `documents_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `motive_documents`
--

INSERT INTO `motive_documents` (`motive_documents_id`, `motive_id`, `documents_id`) VALUES
(1, 1, 1),
(2, 1, 3),
(3, 2, 1),
(4, 3, 2),
(5, 3, 3),
(6, 2, 5),
(7, 2, 6),
(11, 1, 6),
(15, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `rdv`
--

CREATE TABLE `rdv` (
  `rdv_id` int(11) NOT NULL,
  `client_id` int(11) DEFAULT NULL,
  `employee_id` int(11) DEFAULT NULL,
  `motive_id` int(11) DEFAULT NULL,
  `approved` tinyint(1) DEFAULT NULL,
  `date` date DEFAULT NULL,
  `time_slot` time DEFAULT NULL,
  `block_reason` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rdv`
--

INSERT INTO `rdv` (`rdv_id`, `client_id`, `employee_id`, `motive_id`, `approved`, `date`, `time_slot`, `block_reason`) VALUES
(2, 5, 9, 3, 1, '2023-12-06', '10:00:00', NULL),
(6, 1, 9, 1, 1, '2023-12-13', '10:00:00', NULL),
(9, 1, 9, 4, 1, '2023-12-13', '09:00:00', NULL),
(10, 1, 9, 3, 1, '2023-12-15', '11:00:00', NULL),
(11, 1, 9, 4, 1, '2023-12-14', '16:00:00', NULL),
(17, 1, 9, 1, 1, '2023-12-12', '13:00:00', NULL),
(18, 1, 9, 1, 1, '2023-12-12', '14:00:00', NULL),
(19, 1, 9, 1, 1, '2023-12-12', '15:00:00', NULL),
(31, 6, 9, 2, 1, '2023-12-08', '10:00:00', NULL),
(32, 6, 9, 2, 1, '2023-12-21', '10:00:00', NULL),
(33, NULL, 9, NULL, 0, '2023-12-13', '11:00:00', NULL),
(35, 6, 9, 4, 1, '2023-12-15', '15:00:00', NULL),
(36, 1, 9, 4, 1, '2023-12-17', '10:00:00', NULL),
(37, 1, 9, 3, 1, '2023-12-17', '11:00:00', NULL),
(39, 1, 8, 1, 1, '2023-12-03', '09:00:00', NULL),
(40, 3, 8, 1, 1, '2023-12-17', '17:00:00', NULL),
(41, NULL, 8, NULL, 0, '2023-12-17', '16:00:00', NULL),
(42, 3, 8, 4, 1, '2023-12-17', '15:00:00', NULL),
(43, NULL, 8, NULL, 0, '2023-12-17', '11:00:00', NULL),
(44, 1, 9, 1, 1, '2023-12-15', '10:00:00', NULL),
(45, 1, 9, 1, 1, '2023-12-13', '12:00:00', NULL),
(46, 3, 8, 1, 1, '2024-01-04', '12:00:00', NULL),
(47, NULL, 8, NULL, 0, '2024-01-04', '13:00:00', NULL);

--
-- Triggers `rdv`
--
DELIMITER $$
CREATE TRIGGER `check_client_appointment` BEFORE INSERT ON `rdv` FOR EACH ROW BEGIN
    DECLARE appointment_count INT;
    SELECT COUNT(*)
    INTO appointment_count
    FROM sprint_databas.rdv
    WHERE client_id = NEW.client_id AND `date` = NEW.date AND time_slot = NEW.time_slot;
    
    IF appointment_count > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'A client cannot have more than one appointment at the same time.';
    END IF;
END
$$
DELIMITER ;
DELIMITER $$
CREATE TRIGGER `check_employee_appointment` BEFORE INSERT ON `rdv` FOR EACH ROW BEGIN
    DECLARE appointment_count INT;
    SELECT COUNT(*)
    INTO appointment_count
    FROM sprint_databas.rdv
    WHERE employee_id = NEW.employee_id AND `date` = NEW.date AND time_slot = NEW.time_slot;
    
    IF appointment_count > 0 THEN
        SIGNAL SQLSTATE '45000'
        SET MESSAGE_TEXT = 'An employee cannot have more than one appointment at the same time and date.';
    END IF;
END
$$
DELIMITER ;

-- --------------------------------------------------------

--
-- Table structure for table `role_types`
--

CREATE TABLE `role_types` (
  `role_id` int(11) NOT NULL,
  `role_name` varchar(100) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `role_types`
--

INSERT INTO `role_types` (`role_id`, `role_name`) VALUES
(1, 'agent d\'accueil'),
(2, 'conseiller'),
(3, 'directeur');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `client`
--
ALTER TABLE `client`
  ADD PRIMARY KEY (`client_id`);

--
-- Indexes for table `client_compte_assignment`
--
ALTER TABLE `client_compte_assignment`
  ADD PRIMARY KEY (`compte_client_assignment_id`),
  ADD KEY `unq_compte_client_assignment_client_id` (`client_id`),
  ADD KEY `unq_compte_client_assignment_compte_id` (`compte_id`);

--
-- Indexes for table `client_contrat_assignment`
--
ALTER TABLE `client_contrat_assignment`
  ADD PRIMARY KEY (`client_contrat_assignment_id`),
  ADD KEY `unq_client_contrat_assignment_client_id` (`client_id`),
  ADD KEY `unq_client_contrat_assignment_contrat_id` (`contrat_id`);

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
  ADD UNIQUE KEY `unq_comptetype_compte_assignment_compte_id` (`compte_id`),
  ADD KEY `unq_comptetype_compte_assignment_comptetype_id` (`comptetype_id`);

--
-- Indexes for table `contrat`
--
ALTER TABLE `contrat`
  ADD PRIMARY KEY (`contrat_id`);

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
  ADD UNIQUE KEY `unq_contrattype_contrat_assignemnt_contrat_id` (`contrat_id`),
  ADD KEY `unq_contrattype_contrat_assignemnt_contrat_type_id` (`contrat_type_id`);

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
  ADD KEY `unq_employee_client_assignment_employee_id` (`employee_id`);

--
-- Indexes for table `employee_role_assignment`
--
ALTER TABLE `employee_role_assignment`
  ADD PRIMARY KEY (`employee_role_assignment_id`),
  ADD UNIQUE KEY `unq_employee_role_assignment_employee_id` (`employee_id`),
  ADD KEY `unq_employee_role_assignment_role_id` (`role_id`);

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
  ADD KEY `unq_motive_documents_motive_id` (`motive_id`),
  ADD KEY `unq_motive_documents_documents_id` (`documents_id`);

--
-- Indexes for table `rdv`
--
ALTER TABLE `rdv`
  ADD PRIMARY KEY (`rdv_id`),
  ADD KEY `unq_rdv_client_id` (`client_id`),
  ADD KEY `unq_rdv_employee_id` (`employee_id`),
  ADD KEY `unq_rdv_motive_id` (`motive_id`);

--
-- Indexes for table `role_types`
--
ALTER TABLE `role_types`
  ADD PRIMARY KEY (`role_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `client`
--
ALTER TABLE `client`
  MODIFY `client_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `client_compte_assignment`
--
ALTER TABLE `client_compte_assignment`
  MODIFY `compte_client_assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `client_contrat_assignment`
--
ALTER TABLE `client_contrat_assignment`
  MODIFY `client_contrat_assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `compte`
--
ALTER TABLE `compte`
  MODIFY `compte_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `comptetype`
--
ALTER TABLE `comptetype`
  MODIFY `comptetype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `comptetype_compte_assignment`
--
ALTER TABLE `comptetype_compte_assignment`
  MODIFY `comptetype_compte_assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `contrat`
--
ALTER TABLE `contrat`
  MODIFY `contrat_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `contrattype`
--
ALTER TABLE `contrattype`
  MODIFY `contrattype_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `contrattype_contrat_assignemnt`
--
ALTER TABLE `contrattype_contrat_assignemnt`
  MODIFY `contrattype_contrat_assignemnt_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `documents_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employee`
--
ALTER TABLE `employee`
  MODIFY `employee_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `employee_client_assignment`
--
ALTER TABLE `employee_client_assignment`
  MODIFY `employee_client_assignment_index` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `employee_role_assignment`
--
ALTER TABLE `employee_role_assignment`
  MODIFY `employee_role_assignment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `motive`
--
ALTER TABLE `motive`
  MODIFY `motive_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `motive_documents`
--
ALTER TABLE `motive_documents`
  MODIFY `motive_documents_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `rdv`
--
ALTER TABLE `rdv`
  MODIFY `rdv_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=48;

--
-- AUTO_INCREMENT for table `role_types`
--
ALTER TABLE `role_types`
  MODIFY `role_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `client_compte_assignment`
--
ALTER TABLE `client_compte_assignment`
  ADD CONSTRAINT `fk_compte_client_assignment_client` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_compte_client_assignment_compte` FOREIGN KEY (`compte_id`) REFERENCES `compte` (`compte_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `client_contrat_assignment`
--
ALTER TABLE `client_contrat_assignment`
  ADD CONSTRAINT `fk_client_contrat_assignment_client` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_client_contrat_assignment_contrat` FOREIGN KEY (`contrat_id`) REFERENCES `contrat` (`contrat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `comptetype`
--
ALTER TABLE `comptetype`
  ADD CONSTRAINT `fk_comptetype_motive` FOREIGN KEY (`motive_id`) REFERENCES `motive` (`motive_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `comptetype_compte_assignment`
--
ALTER TABLE `comptetype_compte_assignment`
  ADD CONSTRAINT `fk_comptetype_compte_assignment_compte` FOREIGN KEY (`compte_id`) REFERENCES `compte` (`compte_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_comptetype_compte_assignment_comptetype` FOREIGN KEY (`comptetype_id`) REFERENCES `comptetype` (`comptetype_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `contrattype`
--
ALTER TABLE `contrattype`
  ADD CONSTRAINT `fk_contrattype_motive` FOREIGN KEY (`motive_id`) REFERENCES `motive` (`motive_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `contrattype_contrat_assignemnt`
--
ALTER TABLE `contrattype_contrat_assignemnt`
  ADD CONSTRAINT `fk_contrattype_contrat_assignemnt_contrat` FOREIGN KEY (`contrat_id`) REFERENCES `contrat` (`contrat_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
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
  ADD CONSTRAINT `fk_employee_role_assignment_employee` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_employee_role_assignment_role_types` FOREIGN KEY (`role_id`) REFERENCES `role_types` (`role_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `motive_documents`
--
ALTER TABLE `motive_documents`
  ADD CONSTRAINT `fk_motive_documents_documents` FOREIGN KEY (`documents_id`) REFERENCES `documents` (`documents_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_motive_documents_motive` FOREIGN KEY (`motive_id`) REFERENCES `motive` (`motive_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `rdv`
--
ALTER TABLE `rdv`
  ADD CONSTRAINT `fk_rdv_client` FOREIGN KEY (`client_id`) REFERENCES `client` (`client_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rdv_employee` FOREIGN KEY (`employee_id`) REFERENCES `employee` (`employee_id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_rdv_motive` FOREIGN KEY (`motive_id`) REFERENCES `motive` (`motive_id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
