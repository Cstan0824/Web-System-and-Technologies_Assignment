-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 12, 2024 at 05:26 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `movie_society`
--

-- --------------------------------------------------------

--
-- Table structure for table `t_booking`
--

CREATE TABLE `t_booking` (
  `Booking_id` int(11) NOT NULL,
  `Member_id` varchar(20) NOT NULL,
  `Event_id` int(11) NOT NULL,
  `Booking_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_booking`
--

INSERT INTO `t_booking` (`Booking_id`, `Member_id`, `Event_id`, `Booking_date`) VALUES
(1, 'Cstan_0000', 1, '2024-03-31'),
(2, 'Gregorius0000', 2, '2024-05-06'),
(3, 'Lsanderson2', 3, '2024-05-06'),
(4, 'tallBen0000', 4, '2024-05-06'),
(5, 'GianHelloWorld', 5, '2024-05-06'),
(6, 'Charmine2023', 6, '2024-05-06'),
(7, 'Gregorius0000', 7, '2024-05-06'),
(8, 'Lsanderson2', 8, '2024-05-06'),
(9, 'tallBen0000', 9, '2024-05-06'),
(10, 'GianHelloWorld', 10, '2024-05-06'),
(11, 'Jeremy_1234', 1, '2024-05-09');


-- --------------------------------------------------------

--
-- Table structure for table `t_booking_cancellation`
--

CREATE TABLE `t_booking_cancellation` (
  `Booking_Cancellation_id` int(11) NOT NULL,
  `Booking_Cancelled_By` varchar(20) NOT NULL,
  `Booking_Cancel_Date` date NOT NULL,
  `Booking_id` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_booking_cancellation`
--

INSERT INTO `t_booking_cancellation` (`Booking_Cancellation_id`, `Booking_Cancelled_By`, `Booking_Cancel_Date`, `Booking_id`) VALUES
(1, 'Cstan_0000', '2024-03-31', 1);

-- --------------------------------------------------------

--
-- Table structure for table `t_event`
--

CREATE TABLE `t_event` (
  `Event_id` int(11) NOT NULL,
  `Staff_id` varchar(20) NOT NULL,
  `Event_location_id` int(11) NOT NULL,
  `Event_type_id` int(11) NOT NULL,
  `Event_name` varchar(50) NOT NULL,
  `Max_User` int(11) NOT NULL,
  `Event_upl_file_name` varchar(50) DEFAULT NULL,
  `Event_upl_path` varchar(50) DEFAULT NULL,
  `Event_date` date NOT NULL,
  `Event_desc` varchar(2000) DEFAULT NULL,
  `Start_time` time DEFAULT NULL,
  `End_time` time DEFAULT NULL,
  `Event_hoster` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_event`
--

INSERT INTO `t_event` 
(`Event_id`, `Staff_id`, `Event_location_id`, `Event_type_id`, `Event_name`, `Max_User`, `Event_upl_file_name`, `Event_upl_path`, `Event_date`, `Event_desc`, `Start_time`, `End_time`, `Event_hoster`) VALUES
(1,'Admin0000',1,1,'FLY ME TO THE MOON',30,'','','2024-09-01',
'In C.E.75, the fighting still continues. There are independence movements, and aggression by Blue Cosmos…In order to calm the situation, a global peace monitoring agency called COMPASS is established, with Lacus as its first president. As members of COMPASS, Kira and his comrades intervene into various regional battles. Then newly established nation called Foundation proposes a joint operation against a Blue Cosmos stronghold.
','12:00','14:00','Lacus Clyne'),
(2,'Admin0000',2,2,'THE WIND RISES',30,'','','2024-09-02',
'Jiro dreams of flying and designing beautiful airplanes, inspired by the famous Italian aeronautical designer Caproni. Nearsighted from a young age and unable to be a pilot, Jiro joins a major Japanese engineering company in 1927 and becomes one of the world’s most innovative and accomplished airplane designers. The film chronicles much of his life, depicting key historical events, including the Great Kanto Earthquake of 1923, the Great Depression, the tuberculosis epidemic and Japan''s plunge into war. Jiro meets and falls in love with Nahoko, and grows and cherishes his friendship with his colleague Honjo. ;
');-- --------------------------------------------------------

--
-- Table structure for table `t_event_cancellation`
--

CREATE TABLE `t_event_cancellation` (
  `Event_cancellation_id` int(11) NOT NULL,
  `Event_cancelled_by` varchar(255) NOT NULL,
  `Event_id` int(11) NOT NULL,
  `Cancel_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `t_event_location`
--

CREATE TABLE `t_event_location` (
  `Event_location_id` int(11) NOT NULL,
  `Address` varchar(350) DEFAULT NULL,
  `Location` char(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_event_location`
--

INSERT INTO `t_event_location` (`Event_location_id`, `Address`, `Location`) VALUES
(1, 'KUALA LUMPUR, SETAPAK', 'O'),
(2, '123 Main Street, Cityville', 'O'),
(3, '456 Oak Avenue, Townburg', 'O'),
(4, '789 Maple Lane, Villagetown', 'O'),
(5, 'DK A, DK Buildings, TARUMT', 'I'),
(6, 'DK B, DK Buildings, TARUMT', 'I'),
(7, 'DK C, DK Buildings, TARUMT', 'I'),
(8, 'DK D, DK Buildings, TARUMT', 'I'),
(9, 'DK W, DK Buildings, TARUMT', 'I'),
(10, 'DK X, DK Buildings, TARUMT', 'I'),
(11, 'DK Y, DK Buildings, TARUMT', 'I'),
(12, 'DK Z, DK Buildings, TARUMT', 'I'),
(13, 'Sport Complex, TARUMT', 'I');

-- --------------------------------------------------------

--
-- Table structure for table `t_event_type`
--

CREATE TABLE `t_event_type` (
  `Event_type_id` int(11) NOT NULL,
  `Event_type` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_event_type`
--

INSERT INTO `t_event_type` (`Event_type_id`, `Event_type`) VALUES
(1, 'MOVIE SHARING SESSION'),
(2, 'MOVIE PREMIERE'),
(3, 'FAMOUS ACTOR MEETING');

-- --------------------------------------------------------

--
-- Table structure for table `t_member`
--

CREATE TABLE `t_member` (
  `Member_id` varchar(20) NOT NULL,
  `Member_name` varchar(50) NOT NULL,
  `Member_email` varchar(50) NOT NULL,
  `Member_password` varchar(20) NOT NULL,
  `Member_regisdate` date NOT NULL,
  `Member_upl_file_name` varchar(50) DEFAULT NULL,
  `Member_upl_path` varchar(50) DEFAULT NULL,
  `Member_comment` varchar(1000) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_member`
--

INSERT INTO `t_member` (`Member_id`, `Member_name`, `Member_email`, `Member_password`, `Member_regisdate`, `Member_upl_file_name`, `Member_upl_path`, `Member_comment`) VALUES
('asdasdaasd', 'Tan Choon Shen', 'tancs8803@gmail.com', 'asdasdasdads', '2024-05-11', NULL, NULL, NULL),
('Charmine2023', 'Charmine Baughen', 'cbaughen0@virginia.edu', 'ChaB0519', '2023-05-19', NULL, NULL, 'Society is a cinematic rollercoaster that takes you on a wild ride through the bizarre and twisted. From its eerie atmosphere to its mind-bending plot twists, this movie keeps you guessing until the very end. Buckle up for a journey into the depths of societal horror like you\'ve never experienced before.😂'),
('Cstanishere', 'Cstan', 'tancs8803@gmail.com', 'Cstantan', '2024-05-10', NULL, NULL, NULL),
('Cstantanishere', 'Tan Choon Shen', 'tancs8803@gmail.com', 'asdasdasdad', '2024-05-11', NULL, NULL, NULL),
('Cstan_0000', 'Tan Choon Shen', 'tancs804@tarumt.my', '0000Cstan', '2024-03-31', NULL, NULL, 'hello world'),
('GianHelloWorld', 'Esme Gianiello', 'egianiello4@tinypic.com', 'Ess@0808g', '2023-08-08', NULL, NULL, 'With its blend of gruesome visuals and subversive storytelling, Society is a cult classic that challenges the norms of both horror and society itself. It\'s a fever dream of paranoia and body horror that will leave you questioning the reality you thought you knew.'),
('Gregorius0000', 'Gregorius Tomaszkiewicz', 'gtomaszkiewicz1@paginegialle.it', 'G23_Tomas0111', '2023-11-10', NULL, NULL, 'Society isn\'t just a movie, it\'s an experience that plunges you into a world where reality warps and societal norms unravel. Brace yourself for a twisted journey that explores the darkest corners of human nature, all wrapped up in a package of unforgettable horror.'),
('Jeremy_123', 'Tan Choon Shen', 'tancs8803@gmail.com', 'asdasdasdads', '2024-05-12', NULL, NULL, NULL),
('Jeremy_1234', 'Jerremy Chin', 'tancs8803@gmail.com', 'Jeremy_1234', '2024-04-03', NULL, NULL, 'asdasdadasdasdasdsaIn Society, director Brian Yuzna crafts a twisted tale that\'s part horror, part satire, and all-around unforgettable. With its jaw-dropping practical effects and dark humor, this film stands as a testament to the power of genre-bending storytelling. Dive into the madness and let Society consume you.In Society, director Brian Yuzna cra...asdasdasdsaIn Society, director Brian Yuzna crafts a twisted tale that\'s part horror, part satire, and all-around unforgettable. With its jaw-dropping practical effects and dark humor, this film stands as a testament to the power of genre-bending storytelling. Dive into the madness and let Society consume you.In Society, director Brian Yuzna cra...asdasdasdsaIn Society, director Brian Yuzna crafts a twisted tale that\'s part horror, part satire, and all-around unforgettable. With its jaw-dropping practical effects and dark humor, this film stands as a testament to the power of genre-bending storytelling. Dive into the madness and let S'),
('Lsanderson2', 'Lennard Sanderson', 'lsanderson2@yellowbook.com', 'Len@derson202', '2023-08-21', NULL, NULL, 'Society isn\'t just a movie; it\'s a mind-bending exploration of class divide and societal decay wrapped in a cloak of grotesque horror. Prepare to be both disturbed and enthralled as you navigate through its nightmarish landscape of privilege and perversion.'),
('tallBen0000', 'Fancy Bentall', 'fbentall3@diigo.com', 'Ben_tall123', '2023-08-22', NULL, NULL, 'Step into the twisted world of Society, where the boundaries between the elite and the \'other\' blur in a nightmarish tableau of body horror and social commentary. It\'s a film that shocks, provokes, and ultimately challenges our perceptions of power and belonging in society.');

-- --------------------------------------------------------

--
-- Table structure for table `t_staff`
--

CREATE TABLE `t_staff` (
  `Staff_id` varchar(20) NOT NULL,
  `Staff_name` varchar(50) NOT NULL,
  `Staff_email` varchar(50) NOT NULL,
  `Staff_password` varchar(20) NOT NULL,
  `Staff_joindate` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_staff`
--

INSERT INTO `t_staff` (`Staff_id`, `Staff_name`, `Staff_email`, `Staff_password`, `Staff_joindate`) VALUES
('Admin0000', 'LiauOrangUtan', 'liau162@tarumt.my', 'admin1234', '2024-03-31'),
('BayardSunShine', 'Bayard Klasen', 'bklasen0@umich.edu', 'YouAreMySunShine', '2024-03-05'),
('BrockPen00', 'Brock Pentycost', 'bpentycost1@census.gov', 'vtrxQ620#', '2024-03-05'),
('BuddyJada', 'Buddy Tejada', 'btejada2@gmail.com', 'zoohE946xctnK', '2024-04-25'),
('LemonTeaNoLemon', 'Andria Jendrach', 'ajendrach4@patch.com', 'mmqrR816BSp', '2023-12-07');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_booking`
--
ALTER TABLE `t_booking`
  ADD PRIMARY KEY (`Booking_id`),
  ADD KEY `Member_id` (`Member_id`),
  ADD KEY `Event_id` (`Event_id`);

--
-- Indexes for table `t_booking_cancellation`
--
ALTER TABLE `t_booking_cancellation`
  ADD PRIMARY KEY (`Booking_Cancellation_id`),
  ADD KEY `FK_BOOKING_ID` (`Booking_id`);

--
-- Indexes for table `t_event`
--
ALTER TABLE `t_event`
  ADD PRIMARY KEY (`Event_id`),
  ADD KEY `Event_location_id` (`Event_location_id`),
  ADD KEY `Event_type_id` (`Event_type_id`),
  ADD KEY `Staff_id` (`Staff_id`);

--
-- Indexes for table `t_event_cancellation`
--
ALTER TABLE `t_event_cancellation`
  ADD PRIMARY KEY (`Event_cancellation_id`),
  ADD KEY `Event_id` (`Event_id`);

--
-- Indexes for table `t_event_location`
--
ALTER TABLE `t_event_location`
  ADD PRIMARY KEY (`Event_location_id`);

--
-- Indexes for table `t_event_type`
--
ALTER TABLE `t_event_type`
  ADD PRIMARY KEY (`Event_type_id`);

--
-- Indexes for table `t_member`
--
ALTER TABLE `t_member`
  ADD PRIMARY KEY (`Member_id`);

--
-- Indexes for table `t_staff`
--
ALTER TABLE `t_staff`
  ADD PRIMARY KEY (`Staff_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `t_booking`
--
ALTER TABLE `t_booking`
  MODIFY `Booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=76;

--
-- AUTO_INCREMENT for table `t_booking_cancellation`
--
ALTER TABLE `t_booking_cancellation`
  MODIFY `Booking_Cancellation_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `t_event`
--
ALTER TABLE `t_event`
  MODIFY `Event_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `t_event_cancellation`
--
ALTER TABLE `t_event_cancellation`
  MODIFY `Event_cancellation_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_event_location`
--
ALTER TABLE `t_event_location`
  MODIFY `Event_location_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `t_event_type`
--
ALTER TABLE `t_event_type`
  MODIFY `Event_type_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `t_booking`
--
ALTER TABLE `t_booking`
  ADD CONSTRAINT `t_booking_ibfk_1` FOREIGN KEY (`Member_id`) REFERENCES `t_member` (`Member_id`),
  ADD CONSTRAINT `t_booking_ibfk_2` FOREIGN KEY (`Event_id`) REFERENCES `t_event` (`Event_id`);

--
-- Constraints for table `t_booking_cancellation`
--
ALTER TABLE `t_booking_cancellation`
  ADD CONSTRAINT `FK_BOOKING_ID` FOREIGN KEY (`Booking_id`) REFERENCES `t_booking` (`Booking_id`);

--
-- Constraints for table `t_event`
--
ALTER TABLE `t_event`
  ADD CONSTRAINT `t_event_ibfk_1` FOREIGN KEY (`Event_location_id`) REFERENCES `t_event_location` (`Event_location_id`),
  ADD CONSTRAINT `t_event_ibfk_2` FOREIGN KEY (`Event_type_id`) REFERENCES `t_event_type` (`Event_type_id`),
  ADD CONSTRAINT `t_event_ibfk_3` FOREIGN KEY (`Staff_id`) REFERENCES `t_staff` (`Staff_id`);

--
-- Constraints for table `t_event_cancellation`
--
ALTER TABLE `t_event_cancellation`
  ADD CONSTRAINT `t_event_cancellation_ibfk_1` FOREIGN KEY (`Event_id`) REFERENCES `t_event` (`Event_id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
