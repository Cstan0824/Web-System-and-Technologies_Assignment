-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 02, 2024 at 05:54 PM
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
CREATE DATABASE IF NOT EXISTS `movie_society` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `movie_society`;

-- --------------------------------------------------------

--
-- Table structure for table `t_booking`
--

CREATE TABLE `t_booking` (
  `Booking_id` int(11) NOT NULL,
  `Member_id` varchar(20) NOT NULL,
  `Event_id` int(11) NOT NULL,
  `Booking_cancellation_id` int(11) DEFAULT NULL,
  `Booking_date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_booking`
--

INSERT INTO `t_booking` (`Booking_id`, `Member_id`, `Event_id`, `Booking_cancellation_id`, `Booking_date`) VALUES
(1, 'Cstan_0000', 1, 1, '2024-03-31'),
(2, 'Cstan_0000', 1, NULL, '2024-03-31');

-- --------------------------------------------------------

--
-- Table structure for table `t_booking_cancellation`
--

CREATE TABLE `t_booking_cancellation` (
  `Booking_Cancellation_id` int(11) NOT NULL,
  `Booking_Cancelled_By` varchar(20) NOT NULL,
  `Booking_Cancel_Date` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `t_booking_cancellation`
--

INSERT INTO `t_booking_cancellation` (`Booking_Cancellation_id`, `Booking_Cancelled_By`, `Booking_Cancel_Date`) VALUES
(1, 'Cstan_0000', '2024-03-31');

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
  `Event_Rating_Avg` decimal(4,2) DEFAULT NULL,
  `Max_User` int(11) NOT NULL,
  `Event_upl_file_name` varchar(50) DEFAULT NULL,
  `Event_upl_path` varchar(50) DEFAULT NULL,
  `Event_date` date NOT NULL,
  `Event_desc` varchar(2000) DEFAULT NULL,
  `ViewCount` int(11) DEFAULT NULL,
  `Start_time` time DEFAULT NULL,
  `End_time` time DEFAULT NULL,
  `Event_hoster` varchar(50) DEFAULT NULL
) ;

--
-- Dumping data for table `t_event`
--

INSERT INTO `t_event` (`Event_id`, `Staff_id`, `Event_location_id`, `Event_type_id`, `Event_name`, `Event_Rating_Avg`, `Max_User`, `Event_upl_file_name`, `Event_upl_path`, `Event_date`, `Event_desc`, `ViewCount`, `Start_time`, `End_time`, `Event_hoster`) VALUES
(1, 'Admin0000', 1, 1, 'my AI Rakyat', 4.30, 32, 'AI Aware', 'Image/asdfasdvfcvdrg.jpeg', '0000-00-00', 'Got to know more about AI!', 0, '15:00:00', '17:00:00', 'Jeremy');

-- --------------------------------------------------------

--
-- Table structure for table `t_event_location`
--

CREATE TABLE `t_event_location` (
  `Event_location_id` int(11) NOT NULL,
  `Address` varchar(350) DEFAULT NULL,
  `Location` char(1) NOT NULL
) ;

--
-- Dumping data for table `t_event_location`
--

INSERT INTO `t_event_location` (`Event_location_id`, `Address`, `Location`) VALUES
(1, 'KUALA LUMPUR, SETAPAK', 'O');

-- --------------------------------------------------------

--
-- Table structure for table `t_event_member`
--

CREATE TABLE `t_event_member` (
  `Event_id` int(11) NOT NULL,
  `Member_id` varchar(20) NOT NULL,
  `Feedback_desc` varchar(2000) DEFAULT NULL,
  `Event_Rating` decimal(4,2) DEFAULT NULL
) ;

--
-- Dumping data for table `t_event_member`
--

INSERT INTO `t_event_member` (`Event_id`, `Member_id`, `Feedback_desc`, `Event_Rating`) VALUES
(1, 'Cstan_0000', 'This is an Amazing Event with brand new experience!', NULL);

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
  `Member_regisdate` date NOT NULL
) ;

--
-- Dumping data for table `t_member`
--

INSERT INTO `t_member` (`Member_id`, `Member_name`, `Member_email`, `Member_password`, `Member_regisdate`) VALUES
('Cstan_0000', 'Tan Choon Shen', 'tancs804@tarumt.my', '0000Cstan', '2024-03-31');

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
) ;

--
-- Dumping data for table `t_staff`
--

INSERT INTO `t_staff` (`Staff_id`, `Staff_name`, `Staff_email`, `Staff_password`, `Staff_joindate`) VALUES
('Admin0000', 'LiauOrangUtan', 'liau162@tarumt.my', 'admin1234', '2024-03-31');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `t_booking`
--
ALTER TABLE `t_booking`
  ADD PRIMARY KEY (`Booking_id`),
  ADD KEY `Member_id` (`Member_id`),
  ADD KEY `Event_id` (`Event_id`),
  ADD KEY `Booking_cancellation_id` (`Booking_cancellation_id`);

--
-- Indexes for table `t_booking_cancellation`
--
ALTER TABLE `t_booking_cancellation`
  ADD PRIMARY KEY (`Booking_Cancellation_id`);

--
-- Indexes for table `t_event`
--
ALTER TABLE `t_event`
  ADD PRIMARY KEY (`Event_id`),
  ADD KEY `Event_location_id` (`Event_location_id`),
  ADD KEY `Event_type_id` (`Event_type_id`),
  ADD KEY `Staff_id` (`Staff_id`);

--
-- Indexes for table `t_event_location`
--
ALTER TABLE `t_event_location`
  ADD PRIMARY KEY (`Event_location_id`);

--
-- Indexes for table `t_event_member`
--
ALTER TABLE `t_event_member`
  ADD PRIMARY KEY (`Event_id`,`Member_id`),
  ADD KEY `Member_id` (`Member_id`);

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
  MODIFY `Booking_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `t_event`
--
ALTER TABLE `t_event`
  MODIFY `Event_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `t_event_location`
--
ALTER TABLE `t_event_location`
  MODIFY `Event_location_id` int(11) NOT NULL AUTO_INCREMENT;

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
  ADD CONSTRAINT `t_booking_ibfk_2` FOREIGN KEY (`Event_id`) REFERENCES `t_event` (`Event_id`),
  ADD CONSTRAINT `t_booking_ibfk_3` FOREIGN KEY (`Booking_cancellation_id`) REFERENCES `t_booking_cancellation` (`Booking_Cancellation_id`);

--
-- Constraints for table `t_event`
--
ALTER TABLE `t_event`
  ADD CONSTRAINT `t_event_ibfk_1` FOREIGN KEY (`Event_location_id`) REFERENCES `t_event_location` (`Event_location_id`),
  ADD CONSTRAINT `t_event_ibfk_2` FOREIGN KEY (`Event_type_id`) REFERENCES `t_event_type` (`Event_type_id`),
  ADD CONSTRAINT `t_event_ibfk_3` FOREIGN KEY (`Staff_id`) REFERENCES `t_staff` (`Staff_id`);

--
-- Constraints for table `t_event_member`
--
ALTER TABLE `t_event_member`
  ADD CONSTRAINT `t_event_member_ibfk_1` FOREIGN KEY (`Member_id`) REFERENCES `t_member` (`Member_id`),
  ADD CONSTRAINT `t_event_member_ibfk_2` FOREIGN KEY (`Event_id`) REFERENCES `t_event` (`Event_id`);
--
-- Database: `p4`
--
CREATE DATABASE IF NOT EXISTS `p4` DEFAULT CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci;
USE `p4`;
--
-- Database: `phpmyadmin`
--
CREATE DATABASE IF NOT EXISTS `phpmyadmin` DEFAULT CHARACTER SET utf8 COLLATE utf8_bin;
USE `phpmyadmin`;

-- --------------------------------------------------------

--
-- Table structure for table `pma__bookmark`
--

CREATE TABLE `pma__bookmark` (
  `id` int(10) UNSIGNED NOT NULL,
  `dbase` varchar(255) NOT NULL DEFAULT '',
  `user` varchar(255) NOT NULL DEFAULT '',
  `label` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `query` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Bookmarks';

-- --------------------------------------------------------

--
-- Table structure for table `pma__central_columns`
--

CREATE TABLE `pma__central_columns` (
  `db_name` varchar(64) NOT NULL,
  `col_name` varchar(64) NOT NULL,
  `col_type` varchar(64) NOT NULL,
  `col_length` text DEFAULT NULL,
  `col_collation` varchar(64) NOT NULL,
  `col_isNull` tinyint(1) NOT NULL,
  `col_extra` varchar(255) DEFAULT '',
  `col_default` text DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Central list of columns';

-- --------------------------------------------------------

--
-- Table structure for table `pma__column_info`
--

CREATE TABLE `pma__column_info` (
  `id` int(5) UNSIGNED NOT NULL,
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `column_name` varchar(64) NOT NULL DEFAULT '',
  `comment` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `mimetype` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT '',
  `transformation` varchar(255) NOT NULL DEFAULT '',
  `transformation_options` varchar(255) NOT NULL DEFAULT '',
  `input_transformation` varchar(255) NOT NULL DEFAULT '',
  `input_transformation_options` varchar(255) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Column information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__designer_settings`
--

CREATE TABLE `pma__designer_settings` (
  `username` varchar(64) NOT NULL,
  `settings_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Settings related to Designer';

--
-- Dumping data for table `pma__designer_settings`
--

INSERT INTO `pma__designer_settings` (`username`, `settings_data`) VALUES
('root', '{\"angular_direct\":\"direct\",\"snap_to_grid\":\"off\",\"relation_lines\":\"true\"}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__export_templates`
--

CREATE TABLE `pma__export_templates` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL,
  `export_type` varchar(10) NOT NULL,
  `template_name` varchar(64) NOT NULL,
  `template_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved export templates';

-- --------------------------------------------------------

--
-- Table structure for table `pma__favorite`
--

CREATE TABLE `pma__favorite` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Favorite tables';

-- --------------------------------------------------------

--
-- Table structure for table `pma__history`
--

CREATE TABLE `pma__history` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db` varchar(64) NOT NULL DEFAULT '',
  `table` varchar(64) NOT NULL DEFAULT '',
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp(),
  `sqlquery` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='SQL history for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__navigationhiding`
--

CREATE TABLE `pma__navigationhiding` (
  `username` varchar(64) NOT NULL,
  `item_name` varchar(64) NOT NULL,
  `item_type` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Hidden items of navigation tree';

-- --------------------------------------------------------

--
-- Table structure for table `pma__pdf_pages`
--

CREATE TABLE `pma__pdf_pages` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `page_nr` int(10) UNSIGNED NOT NULL,
  `page_descr` varchar(50) CHARACTER SET utf8 COLLATE utf8_general_ci NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='PDF relation pages for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__recent`
--

CREATE TABLE `pma__recent` (
  `username` varchar(64) NOT NULL,
  `tables` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Recently accessed tables';

--
-- Dumping data for table `pma__recent`
--

INSERT INTO `pma__recent` (`username`, `tables`) VALUES
('root', '[{\"db\":\"movie_society\",\"table\":\"t_staff\"},{\"db\":\"movie_society\",\"table\":\"t_member\"},{\"db\":\"movie_society\",\"table\":\"t_event_type\"},{\"db\":\"movie_society\",\"table\":\"t_event_member\"},{\"db\":\"movie_society\",\"table\":\"t_event_location\"},{\"db\":\"movie_society\",\"table\":\"t_event\"},{\"db\":\"movie_society\",\"table\":\"t_booking_cancellation\"},{\"db\":\"movie_society\",\"table\":\"t_booking\"}]');

-- --------------------------------------------------------

--
-- Table structure for table `pma__relation`
--

CREATE TABLE `pma__relation` (
  `master_db` varchar(64) NOT NULL DEFAULT '',
  `master_table` varchar(64) NOT NULL DEFAULT '',
  `master_field` varchar(64) NOT NULL DEFAULT '',
  `foreign_db` varchar(64) NOT NULL DEFAULT '',
  `foreign_table` varchar(64) NOT NULL DEFAULT '',
  `foreign_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Relation table';

-- --------------------------------------------------------

--
-- Table structure for table `pma__savedsearches`
--

CREATE TABLE `pma__savedsearches` (
  `id` int(5) UNSIGNED NOT NULL,
  `username` varchar(64) NOT NULL DEFAULT '',
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `search_name` varchar(64) NOT NULL DEFAULT '',
  `search_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Saved searches';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_coords`
--

CREATE TABLE `pma__table_coords` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `pdf_page_number` int(11) NOT NULL DEFAULT 0,
  `x` float UNSIGNED NOT NULL DEFAULT 0,
  `y` float UNSIGNED NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table coordinates for phpMyAdmin PDF output';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_info`
--

CREATE TABLE `pma__table_info` (
  `db_name` varchar(64) NOT NULL DEFAULT '',
  `table_name` varchar(64) NOT NULL DEFAULT '',
  `display_field` varchar(64) NOT NULL DEFAULT ''
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Table information for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__table_uiprefs`
--

CREATE TABLE `pma__table_uiprefs` (
  `username` varchar(64) NOT NULL,
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `prefs` text NOT NULL,
  `last_update` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Tables'' UI preferences';

-- --------------------------------------------------------

--
-- Table structure for table `pma__tracking`
--

CREATE TABLE `pma__tracking` (
  `db_name` varchar(64) NOT NULL,
  `table_name` varchar(64) NOT NULL,
  `version` int(10) UNSIGNED NOT NULL,
  `date_created` datetime NOT NULL,
  `date_updated` datetime NOT NULL,
  `schema_snapshot` text NOT NULL,
  `schema_sql` text DEFAULT NULL,
  `data_sql` longtext DEFAULT NULL,
  `tracking` set('UPDATE','REPLACE','INSERT','DELETE','TRUNCATE','CREATE DATABASE','ALTER DATABASE','DROP DATABASE','CREATE TABLE','ALTER TABLE','RENAME TABLE','DROP TABLE','CREATE INDEX','DROP INDEX','CREATE VIEW','ALTER VIEW','DROP VIEW') DEFAULT NULL,
  `tracking_active` int(1) UNSIGNED NOT NULL DEFAULT 1
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Database changes tracking for phpMyAdmin';

-- --------------------------------------------------------

--
-- Table structure for table `pma__userconfig`
--

CREATE TABLE `pma__userconfig` (
  `username` varchar(64) NOT NULL,
  `timevalue` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `config_data` text NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User preferences storage for phpMyAdmin';

--
-- Dumping data for table `pma__userconfig`
--

INSERT INTO `pma__userconfig` (`username`, `timevalue`, `config_data`) VALUES
('root', '2024-03-31 15:28:28', '{\"Console\\/Mode\":\"show\",\"NavigationWidth\":0}');

-- --------------------------------------------------------

--
-- Table structure for table `pma__usergroups`
--

CREATE TABLE `pma__usergroups` (
  `usergroup` varchar(64) NOT NULL,
  `tab` varchar(64) NOT NULL,
  `allowed` enum('Y','N') NOT NULL DEFAULT 'N'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='User groups with configured menu items';

-- --------------------------------------------------------

--
-- Table structure for table `pma__users`
--

CREATE TABLE `pma__users` (
  `username` varchar(64) NOT NULL,
  `usergroup` varchar(64) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_bin COMMENT='Users and their assignments to user groups';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `pma__central_columns`
--
ALTER TABLE `pma__central_columns`
  ADD PRIMARY KEY (`db_name`,`col_name`);

--
-- Indexes for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `db_name` (`db_name`,`table_name`,`column_name`);

--
-- Indexes for table `pma__designer_settings`
--
ALTER TABLE `pma__designer_settings`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_user_type_template` (`username`,`export_type`,`template_name`);

--
-- Indexes for table `pma__favorite`
--
ALTER TABLE `pma__favorite`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__history`
--
ALTER TABLE `pma__history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `username` (`username`,`db`,`table`,`timevalue`);

--
-- Indexes for table `pma__navigationhiding`
--
ALTER TABLE `pma__navigationhiding`
  ADD PRIMARY KEY (`username`,`item_name`,`item_type`,`db_name`,`table_name`);

--
-- Indexes for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  ADD PRIMARY KEY (`page_nr`),
  ADD KEY `db_name` (`db_name`);

--
-- Indexes for table `pma__recent`
--
ALTER TABLE `pma__recent`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__relation`
--
ALTER TABLE `pma__relation`
  ADD PRIMARY KEY (`master_db`,`master_table`,`master_field`),
  ADD KEY `foreign_field` (`foreign_db`,`foreign_table`);

--
-- Indexes for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `u_savedsearches_username_dbname` (`username`,`db_name`,`search_name`);

--
-- Indexes for table `pma__table_coords`
--
ALTER TABLE `pma__table_coords`
  ADD PRIMARY KEY (`db_name`,`table_name`,`pdf_page_number`);

--
-- Indexes for table `pma__table_info`
--
ALTER TABLE `pma__table_info`
  ADD PRIMARY KEY (`db_name`,`table_name`);

--
-- Indexes for table `pma__table_uiprefs`
--
ALTER TABLE `pma__table_uiprefs`
  ADD PRIMARY KEY (`username`,`db_name`,`table_name`);

--
-- Indexes for table `pma__tracking`
--
ALTER TABLE `pma__tracking`
  ADD PRIMARY KEY (`db_name`,`table_name`,`version`);

--
-- Indexes for table `pma__userconfig`
--
ALTER TABLE `pma__userconfig`
  ADD PRIMARY KEY (`username`);

--
-- Indexes for table `pma__usergroups`
--
ALTER TABLE `pma__usergroups`
  ADD PRIMARY KEY (`usergroup`,`tab`,`allowed`);

--
-- Indexes for table `pma__users`
--
ALTER TABLE `pma__users`
  ADD PRIMARY KEY (`username`,`usergroup`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `pma__bookmark`
--
ALTER TABLE `pma__bookmark`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__column_info`
--
ALTER TABLE `pma__column_info`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__export_templates`
--
ALTER TABLE `pma__export_templates`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__history`
--
ALTER TABLE `pma__history`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__pdf_pages`
--
ALTER TABLE `pma__pdf_pages`
  MODIFY `page_nr` int(10) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `pma__savedsearches`
--
ALTER TABLE `pma__savedsearches`
  MODIFY `id` int(5) UNSIGNED NOT NULL AUTO_INCREMENT;
--
-- Database: `test`
--
CREATE DATABASE IF NOT EXISTS `test` DEFAULT CHARACTER SET latin1 COLLATE latin1_swedish_ci;
USE `test`;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
