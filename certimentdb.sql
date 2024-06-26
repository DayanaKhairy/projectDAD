-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 26, 2024 at 06:18 PM
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
-- Database: `certimentdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `archives`
--

CREATE TABLE `archives` (
  `archive_id` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `document_id` int(11) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `document_status` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `archives`
--

INSERT INTO `archives` (`archive_id`, `user_email`, `document_id`, `document_name`, `document_status`, `category`) VALUES
(49, 'nrldayana28@gmail.com', 26, 'lab', 'Private', 'Awards'),
(50, 'nrldayana28@gmail.com', 27, 'jadual', 'Private', 'Training');

-- --------------------------------------------------------

--
-- Table structure for table `documents`
--

CREATE TABLE `documents` (
  `document_ID` int(11) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `document_status` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `document_path` varchar(255) NOT NULL,
  `document_type` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `total_Doc` int(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `documents`
--

INSERT INTO `documents` (`document_ID`, `document_name`, `document_status`, `category`, `date`, `document_path`, `document_type`, `user_email`, `total_Doc`) VALUES
(13, 'proposal', 'public', 'Publications', '2024-01-02', 'uploads/Final Year Project Proposal DocuMind - Nuruddin.pdf', 'application/pdf', 'nuruddinakmal@gmail.com', 0),
(19, 'report', 'Public', 'Publications', '2024-01-02', 'uploads/Laporan Kemajuan Draft Content.pdf', 'application/pdf', 'nuruddinakmal@gmail.com', 0),
(26, 'lab', 'Private', 'Awards', '2024-01-05', 'uploads/RAI_1_ITSEC_INTRODUCTION_TO_IT.pdf', 'application/pdf', 'nrldayana28@gmail.com', 0),
(27, 'jadual', 'Private', 'Training', '2024-01-05', 'uploads/JADUAL_HOKI_ L&P_9_SEBELAH_2023_TETUTUP_UTeM RAJA EDIT.pdf', 'application/pdf', 'nrldayana28@gmail.com', 0),
(28, 'lab', 'public', 'Training', '2024-01-07', 'uploads/RAI_1_ITSEC_INTRODUCTION_TO_IT.pdf', 'application/pdf', 'nuruddinakmal@gmail.com', 0),
(29, 'borang', 'Public', 'Training', '2024-01-02', 'uploads/Borang Pendaftaran  Kejohanan Hoki 9 Sebelah Kali ke- 6 Tertutup 2023.pdf', 'application/pdf', 'nrldayana28@gmail.com', 0),
(30, 'laporan', 'Public', 'Training', '2023-10-10', 'uploads/Laporan_Kejohanan_Alumni_(1).pdf', 'application/pdf', 'nrldayana28@gmail.com', 0),
(31, 'surat keseleamatan', 'Public', 'Publications', '2023-12-06', 'uploads/surat keselamtan.pdf', 'application/pdf', 'nrldayana28@gmail.com', 0),
(32, 'blabla', 'Private', 'Publications', '2023-10-17', 'uploads/PHNS .pdf', 'application/pdf', 'nuruddinakmal@gmail.com', 0),
(33, 'database assignment', 'unhide', '', '2024-06-13', 'uploads/A1_B032320086.pdf', 'application/pdf', 'nuruddinakmal@gmail.com', 0);

-- --------------------------------------------------------

--
-- Table structure for table `portfolio`
--

CREATE TABLE `portfolio` (
  `portfolio_ID` int(11) NOT NULL,
  `portfolio_name` varchar(255) NOT NULL,
  `portfolio_details` varchar(255) DEFAULT NULL,
  `portfolio_status` varchar(255) NOT NULL,
  `total_doc` int(100) NOT NULL,
  `date` date NOT NULL,
  `user_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portfolio`
--

INSERT INTO `portfolio` (`portfolio_ID`, `portfolio_name`, `portfolio_details`, `portfolio_status`, `total_doc`, `date`, `user_email`) VALUES
(10, 'akmal', 'unikl', 'public', 6, '0000-00-00', 'nuruddinakmal@gmail.com'),
(15, 'personal', 'test 1', 'Public', 7, '2024-01-07', 'nrldayana28@gmail.com'),
(31, 'dayana', 'utem', 'Public', 4, '2024-01-07', 'nrldayana28@gmail.com');

-- --------------------------------------------------------

--
-- Table structure for table `portfolio_documents`
--

CREATE TABLE `portfolio_documents` (
  `document_ID` int(11) NOT NULL,
  `portfolio_ID` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `portfolio_name` varchar(255) NOT NULL,
  `document_name` varchar(255) NOT NULL,
  `documentCount` int(255) NOT NULL,
  `category` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `portfolio_documents`
--

INSERT INTO `portfolio_documents` (`document_ID`, `portfolio_ID`, `user_email`, `portfolio_name`, `document_name`, `documentCount`, `category`) VALUES
(24, 13, '', '', '', 0, ''),
(26, 13, '', 'personal 2', 'lab', 0, ''),
(26, 15, '', '', '', 0, ''),
(27, 15, '', '', '', 0, ''),
(29, 15, '', '', '', 0, ''),
(26, 15, '', '', '', 0, ''),
(27, 15, '', '', '', 0, ''),
(29, 15, '', '', '', 0, ''),
(26, 31, '', '', '', 0, ''),
(27, 31, '', '', '', 0, ''),
(24, 15, '', '', '', 0, ''),
(13, 10, '', '', '', 0, ''),
(19, 10, '', '', '', 0, ''),
(28, 10, '', '', '', 0, ''),
(13, 10, '', '', '', 0, ''),
(19, 10, '', '', '', 0, ''),
(29, 31, '', '', '', 0, ''),
(30, 31, '', '', '', 0, ''),
(32, 10, '', '', '', 0, ''),
(24, 32, '', '', '', 0, ''),
(26, 32, '', '', '', 0, ''),
(27, 32, '', '', '', 0, ''),
(29, 32, '', '', '', 0, '');

-- --------------------------------------------------------

--
-- Table structure for table `searched_documents`
--

CREATE TABLE `searched_documents` (
  `document_name` varchar(255) NOT NULL,
  `document_status` varchar(255) NOT NULL,
  `user_email` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `searched_documents`
--

INSERT INTO `searched_documents` (`document_name`, `document_status`, `user_email`) VALUES
('proposal', 'public', 'nuruddinakmal@gmail.com'),
('report', 'Public', 'nuruddinakmal@gmail.com'),
('jadual', 'Private', 'nrldayana28@gmail.com'),
('AI and Machine Learning Basics', '7', '|'),
('', '', ''),
('AI and Machine Learning Basics', 'public', 'user7@example.com'),
('Outstanding Performance Award', 'private', 'user8@example.com'),
('Data Science Research', 'private', 'user10@example.com'),
('Innovation Award 2023', 'public', 'user11@example.com'),
('AI and Machine Learning Basics', 'public', 'user7@example.com'),
('Outstanding Performance Award', 'private', 'user8@example.com'),
('Advanced SQL Workshop', 'private', 'user12@example.com');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_ID` int(11) NOT NULL,
  `user_email` varchar(255) NOT NULL,
  `user_Fname` varchar(255) NOT NULL,
  `user_Lname` varchar(255) NOT NULL,
  `user_pass` varchar(255) DEFAULT NULL,
  `user_grade` varchar(255) NOT NULL,
  `user_pic` varchar(255) DEFAULT NULL,
  `user_phoneNo` int(11) NOT NULL,
  `user_position` varchar(255) DEFAULT NULL,
  `user_serviceGroup` varchar(255) DEFAULT NULL,
  `user_type` varchar(255) NOT NULL,
  `total_Doc` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_ID`, `user_email`, `user_Fname`, `user_Lname`, `user_pass`, `user_grade`, `user_pic`, `user_phoneNo`, `user_position`, `user_serviceGroup`, `user_type`, `total_Doc`) VALUES
(1, 'nrldayana28@gmail.com', 'Dayana', 'Khairy', '$2y$10$aR4hu9XOcFUEPzJLy71jFO6PuLDqtp41NadZ7C/ARrXilY8aJKBPG', '52', 'profile/KODAK 200 (10).JPG', 194398437, 'researcher', 'Managerial/Professional', 'employee', 5),
(2, 'syabuu@gmail.com', 'Syabu', 'Amal', '$2y$10$TjuvUwxHDPGSrmDsWVTWLOrksg56bIjP5epiJkuSqF97/FtXCiini', '', 'profile/syabu n peanut.jpg', 122334567, 'supervisor', NULL, 'employer', 0),
(3, 'nuruddinakmal@gmail.com', 'Nuruddin', 'Akmal', '$2y$10$2XJDeA8UFKOLHhyMln1Ol.SBqaz/a43BEjx2nPgSTutok/EqXdJaO', '56', 'profile/photo_6086901418410752354_y.jpg', 194726473, 'researcher', 'Managerial/Professional', 'employee', 3),
(4, 'dayana@gmail.com', 'Dayana', 'Khairy', '$2y$10$s.b0GYKO/qEzX4lc5VC0D.eNua.5qjw4.PEnGTFN2H0PQ7xDIPCzy', '44', 'profile/profile_pic-removebg-preview.png', 194398437, 'researcher', 'Managerial/Professional', 'employee', 0),
(5, 'nizkia@gmail.com', 'nizkia', 'musawir', '$2y$10$o8Umf3nP4wXNIiKqD1hZFu7YgVPcQI6oSjU2mKVP/HNb1SGJa.QJ2', 'Jusa A', 'profile/LogoUTeM.png', 174346001, 'supervisor', 'Top Management', 'employee', 0),
(9, 'kiki@lala', 'kikii', 'lala', '$2y$10$hGvEBQ3GrW8UxuTsJux8u.5AT7rIyodSUAKj6LO7rYbLL/qkoO3LK', '41', NULL, 122334567, NULL, 'Managerial/Professional', 'Employee', 0),
(10, 'dawef32F', 'wcFfW', 'FEDGAWFWQ', '$2y$10$KrJVHfSfKQVLzws.U8lTZOzfXCtvhCu1CuxIcwu80VDsucZ0vAdmO', '', NULL, 0, NULL, NULL, 'Employee', 0),
(11, 'bjejek', 'dshjavdek', 'edjkebc', '$2y$10$PMf8.OQeferXk/qak9i.4OHlSPYG/tixwMxl1/QOrfKERueaaQ1m2', '', NULL, 0, NULL, NULL, 'Employee', 0);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `archives`
--
ALTER TABLE `archives`
  ADD PRIMARY KEY (`archive_id`);

--
-- Indexes for table `documents`
--
ALTER TABLE `documents`
  ADD PRIMARY KEY (`document_ID`);

--
-- Indexes for table `portfolio`
--
ALTER TABLE `portfolio`
  ADD PRIMARY KEY (`portfolio_ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `archives`
--
ALTER TABLE `archives`
  MODIFY `archive_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=52;

--
-- AUTO_INCREMENT for table `documents`
--
ALTER TABLE `documents`
  MODIFY `document_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `portfolio`
--
ALTER TABLE `portfolio`
  MODIFY `portfolio_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
