-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 11, 2024 at 01:31 AM
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
-- Database: `website_project`
--

-- --------------------------------------------------------

--
-- Table structure for table `account`
--

CREATE TABLE `account` (
  `user_name` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `user_type` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `account`
--

INSERT INTO `account` (`user_name`, `password`, `first_name`, `last_name`, `user_type`) VALUES
('admin', '12345678', 'admin', 'admin', 'osa'),
('adonis', '12345678', 'adonis', 'hornoz', 'faculty'),
('agredadale', '12345678', 'dale', 'agreda', 'student'),
('alvaricoish', '12345678', 'ish', 'alvarico', 'faculty'),
('asd', '12345678', 'asd', 'fda', 'faculty'),
('carlojose', '12345678', 'Carlo', 'Jose', 'student'),
('carlosjuan', '12345678', 'Juan', 'Carlos', 'faculty'),
('diznutz', '12345678', 'diz', 'nutz', 'student'),
('dummy', '12345678', 'dumy', 'dumy', 'student'),
('estoresivan', '12345678', 'Ivan', 'Estores', 'student'),
('lozadajesse', '12345678', 'Jesse', 'Lozada', 'student'),
('maas_student', '12345678', 'maas', '1', 'student'),
('student_1', '12345678', 'student', '1', 'student'),
('student_one', '12345678', 'student', 'one', 'student'),
('teacher_1', '12345678', 'teacher', '1', 'faculty'),
('teacher_one', '12345678', 'apple', 'uy', 'faculty'),
('watadustin', '12345678', 'Dustin', 'Wata', 'student');

-- --------------------------------------------------------

--
-- Table structure for table `calendar_event_master`
--

CREATE TABLE `calendar_event_master` (
  `event_id` varchar(255) NOT NULL,
  `event_name` varchar(255) DEFAULT NULL,
  `event_start_date` date DEFAULT NULL,
  `event_end_date` date DEFAULT NULL,
  `is_approved` int(1) NOT NULL,
  `venue` varchar(255) NOT NULL,
  `submitted_by` varchar(255) NOT NULL,
  `parents_permit` varchar(255) DEFAULT NULL,
  `comment` varchar(255) DEFAULT NULL,
  `facility` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `calendar_event_master`
--

INSERT INTO `calendar_event_master` (`event_id`, `event_name`, `event_start_date`, `event_end_date`, `is_approved`, `venue`, `submitted_by`, `parents_permit`, `comment`, `facility`) VALUES
('109502321', 'Painting', '2024-03-12', NULL, 2, '', 'ish alvarico', NULL, NULL, 1),
('1817100999', 'Club Party', '2024-03-25', NULL, 2, '', 'Dustin Wata', NULL, NULL, 3),
('1873606089', 'Zumba For A Cause', '2024-03-23', NULL, 2, '', 'Dustin Wata', NULL, NULL, 4),
('2071631410', 'Book Fair', '2024-03-16', NULL, 2, '', 'ish alvarico', NULL, NULL, 2),
('2461266005', 'General Assembly', '2024-03-01', NULL, 2, '', 'ish alvarico', NULL, NULL, 3),
('2735469952', 'General Meeting', '2024-03-20', NULL, 2, '', 'Dustin Wata', NULL, NULL, 1),
('3132265229', 'party', '2024-03-16', NULL, -1, '', 'Dustin Wata', NULL, 'NO parties allowed inside', 1),
('3961720763', 'Party', '2024-03-30', NULL, 0, '', 'ish alvarico', NULL, NULL, 4),
('985515291', 'Coding Event', '2024-03-27', NULL, 2, '', 'ish alvarico', NULL, NULL, 3);

-- --------------------------------------------------------

--
-- Table structure for table `club`
--

CREATE TABLE `club` (
  `club_id` int(10) NOT NULL,
  `club_name` varchar(255) NOT NULL,
  `club_description` varchar(255) NOT NULL,
  `facilitator` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `club`
--

INSERT INTO `club` (`club_id`, `club_name`, `club_description`, `facilitator`) VALUES
(1, 'Computer Club', 'Computer Club', 1),
(2, 'MAAS', 'MAAS', 1),
(3, 'None', 'None', NULL),
(7, 'PSITS', 'PSITS', 2),
(9, 'Club1', 'Club1', 4),
(10, 'club_one', 'ads', 6),
(11, 'M.A.A.S.', 'MAAS', 8);

-- --------------------------------------------------------

--
-- Table structure for table `course`
--

CREATE TABLE `course` (
  `course_id` int(10) NOT NULL,
  `course_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `course`
--

INSERT INTO `course` (`course_id`, `course_name`) VALUES
(1, 'CS');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE `events` (
  `event_id` int(10) NOT NULL,
  `event_name` varchar(255) NOT NULL,
  `event_description` varchar(255) NOT NULL,
  `clubs_associated` int(11) NOT NULL,
  `date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `event_time_slot`
--

CREATE TABLE `event_time_slot` (
  `event_id` varchar(255) NOT NULL,
  `time_slot` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event_time_slot`
--

INSERT INTO `event_time_slot` (`event_id`, `time_slot`) VALUES
('2735469952', '8:00 am'),
('1312860924', '7:00 am'),
('1817100999', '3:00 pm'),
('1817100999', '4:00 pm'),
('1817100999', '5:00 pm'),
('1817100999', '6:00 pm'),
('1489262100', '6:00 am'),
('1489262100', '7:00 am'),
('1489262100', '8:00 am'),
('1489262100', '9:00 am'),
('1489262100', '10:00 am'),
('1489262100', '11:00 am'),
('1489262100', '12:00 pm'),
('3063028220', '1:00 pm'),
('3063028220', '2:00 pm'),
('3063028220', '3:00 pm'),
('3063028220', '4:00 pm'),
('3063028220', '5:00 pm'),
('3063028220', '6:00 pm'),
('1434780366', '8:00 am'),
('1434780366', '9:00 am'),
('1434780366', '10:00 am'),
('1434780366', '11:00 am'),
('1153810357', '6:00 am'),
('1153810357', '7:00 am'),
('1153810357', '12:00 pm'),
('1153810357', '1:00 pm'),
('1153810357', '2:00 pm'),
('109502321', '6:00 am'),
('109502321', '7:00 am'),
('109502321', '8:00 am'),
('985515291', '6:00 am'),
('985515291', '7:00 am'),
('2461266005', '6:00 am'),
('2461266005', '7:00 am'),
('2461266005', '8:00 am'),
('2071631410', '6:00 am'),
('2071631410', '7:00 am'),
('387497191', '6:00 am'),
('1904090747', '6:00 am'),
('1173601744', '6:00 am'),
('1173601744', '7:00 am'),
('3853160319', '6:00 am'),
('3853160319', '7:00 am'),
('1433247778', '6:00 am'),
('1433247778', '7:00 am'),
('1433247778', '8:00 am'),
('1298592045', '9:00 am'),
('954055397', '4:00 pm'),
('954055397', '5:00 pm'),
('954055397', '6:00 pm'),
('3961720763', '6:00 pm'),
('3132265229', '6:00 am'),
('3132265229', '7:00 am'),
('1507203060', '6:00 am'),
('1507203060', '7:00 am'),
('292556118', '6:00 am'),
('292556118', '7:00 am'),
('1873606089', '6:00 am');

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

CREATE TABLE `facility` (
  `facility_id` int(11) NOT NULL,
  `facility_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `facility`
--

INSERT INTO `facility` (`facility_id`, `facility_name`) VALUES
(1, 'CA1'),
(2, 'CA2'),
(3, 'Auditorium'),
(4, 'Open Field');

-- --------------------------------------------------------

--
-- Table structure for table `faculty`
--

CREATE TABLE `faculty` (
  `faculty_id` int(10) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `faculty`
--

INSERT INTO `faculty` (`faculty_id`, `first_name`, `last_name`) VALUES
(1, 'Ish', 'Alvarico'),
(2, 'Juan', 'Carlos'),
(4, 'teacher', '1'),
(5, 'asd', 'fda'),
(6, 'apple', 'uy'),
(7, 'apple', 'uy'),
(8, 'adonis', 'hornoz');

-- --------------------------------------------------------

--
-- Table structure for table `permit`
--

CREATE TABLE `permit` (
  `permit_id` int(11) NOT NULL,
  `event_id` int(10) NOT NULL,
  `submitted_by` varchar(255) NOT NULL,
  `file_title` varchar(255) NOT NULL,
  `file_path` varchar(255) NOT NULL,
  `club` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `permit`
--

INSERT INTO `permit` (`permit_id`, `event_id`, `submitted_by`, `file_title`, `file_path`, `club`) VALUES
(7, 19, 'student 1', 'interview (1).docx', 'C:/xampp/htdocs/website_projectV2/permits/6580574619210_interview (1).docx', 'DUMMY'),
(8, 20, 'student one', 'interview (1).docx', 'C:/xampp/htdocs/website_projectV2/permits/658d12c0e24ce_interview (1).docx', 'club_one');

-- --------------------------------------------------------

--
-- Table structure for table `position`
--

CREATE TABLE `position` (
  `position_id` int(10) NOT NULL,
  `position_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `position`
--

INSERT INTO `position` (`position_id`, `position_name`) VALUES
(1, 'President'),
(2, 'Vice-President'),
(3, 'Secretary'),
(4, 'Treasurer'),
(5, 'PIO'),
(6, 'Auditor'),
(7, 'None');

-- --------------------------------------------------------

--
-- Table structure for table `student`
--

CREATE TABLE `student` (
  `student_id` int(10) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `course` int(10) NOT NULL,
  `club` int(10) DEFAULT NULL,
  `position` int(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `student`
--

INSERT INTO `student` (`student_id`, `first_name`, `last_name`, `course`, `club`, `position`) VALUES
(1, 'Dustin', 'Wata', 1, 2, 1),
(2, 'Dale', 'Agreda', 1, 1, 1),
(3, 'Jesse', 'Lozada', 1, 2, 4),
(4, 'Ivan', 'Estores', 1, 2, 6),
(5, 'Olsen John Gabriel', 'Provido', 1, 1, 2),
(6, 'Carlo', 'Jose', 1, 7, 7),
(7, 'dumy', 'dumy', 1, 3, 7),
(8, 'student', '1', 1, 9, 1),
(9, 'student', 'one', 1, 10, 2),
(10, 'maas', '1', 1, 11, 1);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `account`
--
ALTER TABLE `account`
  ADD PRIMARY KEY (`user_name`);

--
-- Indexes for table `calendar_event_master`
--
ALTER TABLE `calendar_event_master`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `club`
--
ALTER TABLE `club`
  ADD PRIMARY KEY (`club_id`),
  ADD KEY `facilitator` (`facilitator`);

--
-- Indexes for table `course`
--
ALTER TABLE `course`
  ADD PRIMARY KEY (`course_id`);

--
-- Indexes for table `events`
--
ALTER TABLE `events`
  ADD PRIMARY KEY (`event_id`);

--
-- Indexes for table `facility`
--
ALTER TABLE `facility`
  ADD PRIMARY KEY (`facility_id`);

--
-- Indexes for table `faculty`
--
ALTER TABLE `faculty`
  ADD PRIMARY KEY (`faculty_id`);

--
-- Indexes for table `permit`
--
ALTER TABLE `permit`
  ADD PRIMARY KEY (`permit_id`);

--
-- Indexes for table `position`
--
ALTER TABLE `position`
  ADD PRIMARY KEY (`position_id`);

--
-- Indexes for table `student`
--
ALTER TABLE `student`
  ADD PRIMARY KEY (`student_id`),
  ADD KEY `course` (`course`),
  ADD KEY `club` (`club`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `club`
--
ALTER TABLE `club`
  MODIFY `club_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `course`
--
ALTER TABLE `course`
  MODIFY `course_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `events`
--
ALTER TABLE `events`
  MODIFY `event_id` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `facility`
--
ALTER TABLE `facility`
  MODIFY `facility_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `faculty`
--
ALTER TABLE `faculty`
  MODIFY `faculty_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `permit`
--
ALTER TABLE `permit`
  MODIFY `permit_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `position`
--
ALTER TABLE `position`
  MODIFY `position_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `student`
--
ALTER TABLE `student`
  MODIFY `student_id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `club`
--
ALTER TABLE `club`
  ADD CONSTRAINT `club_ibfk_1` FOREIGN KEY (`facilitator`) REFERENCES `faculty` (`faculty_id`);

--
-- Constraints for table `student`
--
ALTER TABLE `student`
  ADD CONSTRAINT `student_ibfk_1` FOREIGN KEY (`course`) REFERENCES `course` (`course_id`),
  ADD CONSTRAINT `student_ibfk_2` FOREIGN KEY (`position`) REFERENCES `position` (`position_id`),
  ADD CONSTRAINT `student_ibfk_3` FOREIGN KEY (`club`) REFERENCES `club` (`club_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
