-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: May 07, 2025 at 07:59 AM
-- Server version: 8.0.30
-- PHP Version: 8.2.19

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `e-books`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic_stage`
--

CREATE TABLE `academic_stage` (
  `id` int NOT NULL,
  `academic_stage` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `academic_stage`
--

INSERT INTO `academic_stage` (`id`, `academic_stage`) VALUES
(522, 'Elementry School'),
(523, 'Middle School'),
(524, 'High School');

-- --------------------------------------------------------

--
-- Table structure for table `ebooks`
--

CREATE TABLE `ebooks` (
  `id` int NOT NULL,
  `academic_id` int DEFAULT NULL,
  `grade_id` int DEFAULT NULL,
  `semester_id` int DEFAULT NULL,
  `subject_id` int DEFAULT NULL,
  `book_file_name` varchar(255) NOT NULL,
  `book_title` varchar(255) NOT NULL,
  `file_cover` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `ebooks`
--

INSERT INTO `ebooks` (`id`, `academic_id`, `grade_id`, `semester_id`, `subject_id`, `book_file_name`, `book_title`, `file_cover`) VALUES
(9, 522, 21, 15, 12, 'sertifikat.pdf', 'Chemistry', 'school-science-book-cover.png'),
(10, 524, 26, 25, 29, 'sertifikat.pdf', 'Chemistry', 'school-science-book-cover.png');

-- --------------------------------------------------------

--
-- Table structure for table `grade`
--

CREATE TABLE `grade` (
  `id` int NOT NULL,
  `academic_id` int DEFAULT NULL,
  `grade` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `grade`
--

INSERT INTO `grade` (`id`, `academic_id`, `grade`) VALUES
(21, 522, 'Grade 1'),
(22, 522, 'Grade 2'),
(23, 523, 'Grade 1'),
(24, 523, 'Grade 2'),
(25, 524, 'Grade 1'),
(26, 524, 'Grade 2');

-- --------------------------------------------------------

--
-- Table structure for table `semester`
--

CREATE TABLE `semester` (
  `id` int NOT NULL,
  `grade_id` int DEFAULT NULL,
  `semester_number` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `semester`
--

INSERT INTO `semester` (`id`, `grade_id`, `semester_number`) VALUES
(15, 21, 'Semester 1'),
(16, 23, 'Semester 1'),
(17, 25, 'Semester 1'),
(18, 21, 'Semester 2'),
(19, 22, 'Semester 1'),
(20, 22, 'Semester 2'),
(21, 23, 'Semester 2'),
(22, 24, 'Semester 1'),
(23, 24, 'Semester 2'),
(24, 25, 'Semester 2'),
(25, 26, 'Semester 1'),
(26, 26, 'Semester 2');

-- --------------------------------------------------------

--
-- Table structure for table `subject`
--

CREATE TABLE `subject` (
  `id` int NOT NULL,
  `semester_id` int DEFAULT NULL,
  `subject` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `subject`
--

INSERT INTO `subject` (`id`, `semester_id`, `subject`) VALUES
(12, 15, 'Science'),
(13, 16, 'Science'),
(14, 17, 'Science'),
(15, 18, 'Mathematics'),
(16, 18, 'English'),
(17, 19, 'Science'),
(18, 19, 'Mathematics'),
(19, 20, 'English'),
(20, 20, 'Social Studies'),
(21, 21, 'Mathematics'),
(22, 21, 'Geography'),
(23, 22, 'Science'),
(24, 22, 'History'),
(25, 23, 'English'),
(27, 24, 'Physics'),
(28, 24, 'Chemistry'),
(29, 25, 'Mathematics'),
(30, 25, 'English'),
(31, 26, 'Biology'),
(32, 26, 'History');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `id` int NOT NULL,
  `name` varchar(128) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password_hash` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `name`, `email`, `password_hash`) VALUES
(1, 'e12d2d', 'fixak86590@chosenx.com', '$2y$10$FscOsTGzYqK/j7cVDdbWieiPuBkZtoyoJxrKFxvJz6PuKJIY4Pzj.'),
(7, 'e12d2d', 'fixak8659dsa0@chosenx.com', '$2y$10$tuV1DG/TKK34o92M1LkP6uDbieKxjcuSXn83E7VF6DAd6.Z2EaMiO'),
(15, 'e12d2d', 'fixak86ds59dsa0@chosenx.com', '$2y$10$BLCO1Laaxkh0Ib2SzxbA1e9e.RbWFGUOOG5HUTTdLMZcIqe2IeNOK'),
(16, 'root', 'root@root.dev', '$2y$10$4Mk5aztYF.LR6WfeN6kCo.ag4LOJeyoxB.DktGzn635lEkfgOWUT.'),
(38, 'DS', 'ottomandora@gmail.com', '$2y$10$zy.naT4PQY9Z7ZW9fHm4XOECJTLGCgY/81YvCllMcXOqsoOrDpZyC'),
(39, 'asdsd', 'ottomaddndora@gmail.com', '$2y$10$fBJpT16KV4zweeD7G.U4UOSmeoBD0sxanN/YA9peHmeHJOw8fta3O'),
(40, 'fsadsa', 'dsadsadsd@goaof.com', '$2y$10$bPkMLe68o6kGZjBQCqKqoOMIlwQPLa0BcbMRAsz15AuFK0I582gTC');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic_stage`
--
ALTER TABLE `academic_stage`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ebooks`
--
ALTER TABLE `ebooks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `ebooks_ibfk_1` (`academic_id`),
  ADD KEY `ebooks_ibfk_2` (`grade_id`),
  ADD KEY `ebooks_ibfk_3` (`semester_id`),
  ADD KEY `ebooks_ibfk_4` (`subject_id`);

--
-- Indexes for table `grade`
--
ALTER TABLE `grade`
  ADD PRIMARY KEY (`id`),
  ADD KEY `academic_id` (`academic_id`);

--
-- Indexes for table `semester`
--
ALTER TABLE `semester`
  ADD PRIMARY KEY (`id`),
  ADD KEY `grade_id` (`grade_id`);

--
-- Indexes for table `subject`
--
ALTER TABLE `subject`
  ADD PRIMARY KEY (`id`),
  ADD KEY `semester_id` (`semester_id`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic_stage`
--
ALTER TABLE `academic_stage`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=525;

--
-- AUTO_INCREMENT for table `ebooks`
--
ALTER TABLE `ebooks`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `grade`
--
ALTER TABLE `grade`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `semester`
--
ALTER TABLE `semester`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `subject`
--
ALTER TABLE `subject`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=41;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ebooks`
--
ALTER TABLE `ebooks`
  ADD CONSTRAINT `ebooks_ibfk_1` FOREIGN KEY (`academic_id`) REFERENCES `academic_stage` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ebooks_ibfk_2` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ebooks_ibfk_3` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `ebooks_ibfk_4` FOREIGN KEY (`subject_id`) REFERENCES `subject` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `grade`
--
ALTER TABLE `grade`
  ADD CONSTRAINT `academic_id` FOREIGN KEY (`academic_id`) REFERENCES `academic_stage` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `semester`
--
ALTER TABLE `semester`
  ADD CONSTRAINT `semester_ibfk_1` FOREIGN KEY (`grade_id`) REFERENCES `grade` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `subject`
--
ALTER TABLE `subject`
  ADD CONSTRAINT `subject_ibfk_1` FOREIGN KEY (`semester_id`) REFERENCES `semester` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
