-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 14, 2025 at 03:06 AM
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
-- Database: `fyp`
--

-- --------------------------------------------------------

--
-- Table structure for table `trainer_request_table`
--

CREATE TABLE `trainer_request_table` (
  `request_id` int(11) NOT NULL,
  `member_id` int(11) NOT NULL,
  `trainer_id` int(11) NOT NULL,
  `request_date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `trainer_request_table`
--

INSERT INTO `trainer_request_table` (`request_id`, `member_id`, `trainer_id`, `request_date`) VALUES
(5, 118, 129, '2025-03-14'),
(6, 126, 130, '2025-03-14');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `user_id` int(11) NOT NULL,
  `profile_photo` varchar(255) NOT NULL DEFAULT 'default_icon.png',
  `contact_num` text NOT NULL,
  `username` text NOT NULL,
  `age` int(11) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `pass` varchar(255) NOT NULL,
  `user_role` varchar(255) NOT NULL,
  `date_of_registration` date NOT NULL DEFAULT current_timestamp(),
  `trainer_id` varchar(20) NOT NULL DEFAULT 'NO_TRAINER',
  `weight_in_kg` varchar(20) NOT NULL,
  `height_in_cm` varchar(10) NOT NULL,
  `BMI` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`user_id`, `profile_photo`, `contact_num`, `username`, `age`, `gender`, `pass`, `user_role`, `date_of_registration`, `trainer_id`, `weight_in_kg`, `height_in_cm`, `BMI`) VALUES
(19, 'uploads/', '039998121', 'Admin101', 27, 'male', 'Admin11@', 'admin', '2024-12-31', '', '75', '179', ''),
(118, 'default_icon.png', '039998112', 'adminpro123', 25, 'male', 'Member@1111', 'member', '2025-01-06', '', '75', '177', '23.9'),
(121, 'default_icon.png', '039998112', 'adminpro123', 25, 'male', 'FiTNT2401', 'admin', '2025-02-08', '', '', '', ''),
(126, 'Jeffrey.屏幕截图 2024-12-19 201026.png', '0173517737', 'Jeffrey', 20, 'male', 'Jeffrey@2024', 'member', '2025-02-24', '131', '60', '175', '19.6'),
(127, 'default_icon.png', '0145678901', 'member2', 36, 'male', 'Member@2222', 'member', '2025-02-25', '', '35', '160', '10.0'),
(128, 'MingHui.logo.png', '01126070809', 'MingHui', 20, 'female', 'lueluelue@211', 'member', '2025-02-25', '', '49', '179', ''),
(129, 'default_icon.png', '0385689902', 'yooha', 18, 'male', 'trainer123@', 'trainer', '2024-12-31', '', '75', '179', ''),
(130, 'default_icon.png', '0389383342', 'junhee', 18, 'female', 'trainer321@', 'trainer', '2024-12-31', '', '75', '175', ''),
(131, 'default_icon.png', '0389389111', 'jinwo', 18, 'male', 'trainer88@', 'trainer', '2024-12-31', '', '72', '189', ''),
(132, 'default_icon.png', '0385689902', 'joe', 18, 'male', 'trainer23@', 'trainer', '2024-12-31', '', '78', '179', ''),
(133, 'default_icon.png', '0389383342', 'brody', 18, 'male', 'trainer21@', 'trainer', '2024-12-31', '', '75', '175', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `trainer_request_table`
--
ALTER TABLE `trainer_request_table`
  ADD PRIMARY KEY (`request_id`),
  ADD KEY `member_id` (`member_id`),
  ADD KEY `trainer_id` (`trainer_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `trainer_request_table`
--
ALTER TABLE `trainer_request_table`
  MODIFY `request_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=134;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `trainer_request_table`
--
ALTER TABLE `trainer_request_table`
  ADD CONSTRAINT `trainer_request_table_ibfk_1` FOREIGN KEY (`member_id`) REFERENCES `user` (`user_id`),
  ADD CONSTRAINT `trainer_request_table_ibfk_2` FOREIGN KEY (`trainer_id`) REFERENCES `user` (`user_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
