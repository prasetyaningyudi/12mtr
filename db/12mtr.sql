-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 08, 2019 at 10:05 AM
-- Server version: 10.1.31-MariaDB
-- PHP Version: 7.2.4

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `12mtr`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_data`
--

CREATE TABLE `app_data` (
  `ID` int(11) NOT NULL,
  `NAME` varchar(250) DEFAULT NULL,
  `ICON` varchar(45) DEFAULT NULL,
  `FAVICON` text,
  `NOTES` text,
  `CREATE_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATE_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `USER_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `bidang`
--

CREATE TABLE `bidang` (
  `ID` int(11) NOT NULL,
  `NAMA` text NOT NULL,
  `STATUS` varchar(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `jenis_laporan`
--

CREATE TABLE `jenis_laporan` (
  `ID` int(11) NOT NULL,
  `NAMA` text NOT NULL,
  `JATUH_TEMPO` int(11) NOT NULL,
  `STATUS` varchar(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kppn`
--

CREATE TABLE `kppn` (
  `ID` int(11) NOT NULL,
  `KODE` varchar(45) NOT NULL,
  `NAMA` text NOT NULL,
  `STATUS` varchar(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `laporan`
--

CREATE TABLE `laporan` (
  `ID` int(11) NOT NULL,
  `NAMA` text NOT NULL,
  `NOMOR` text,
  `TANGGAL` date DEFAULT NULL,
  `SUMBER` varchar(255) NOT NULL,
  `FILE` text NOT NULL,
  `JENIS_LAPORAN_ID` int(11) NOT NULL,
  `PERIODE_LAPORAN_ID` int(11) NOT NULL,
  `STATUS_LAPORAN_ID` int(11) NOT NULL,
  `SEKSI_ID` int(11) NOT NULL,
  `KPPN_ID` int(11) NOT NULL,
  `BIDANG_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL,
  `CATATAN` text CHARACTER SET latin2 COLLATE latin2_hungarian_ci,
  `CREATE_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATE_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `menu`
--

CREATE TABLE `menu` (
  `ID` int(11) NOT NULL,
  `MENU_NAME` varchar(255) NOT NULL,
  `PERMALINK` text NOT NULL,
  `MENU_ICON` varchar(255) NOT NULL,
  `MENU_ORDER` varchar(10) NOT NULL,
  `STATUS` varchar(1) NOT NULL DEFAULT '1',
  `CREATE_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATE_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `MENU_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `menu`
--

INSERT INTO `menu` (`ID`, `MENU_NAME`, `PERMALINK`, `MENU_ICON`, `MENU_ORDER`, `STATUS`, `CREATE_DATE`, `UPDATE_DATE`, `MENU_ID`) VALUES
(1, 'Setup Menu', '#', 'bars', '01', '1', '2019-01-08 15:51:57', '2019-01-08 16:01:06', NULL),
(2, 'User & Role', '#', 'users-cog', '02', '1', '2019-01-08 15:52:58', '2019-01-08 16:01:21', NULL),
(3, 'Application Data', 'app_data', 'cogs', '03', '1', '2019-01-08 15:54:30', '2019-01-08 16:02:37', NULL),
(4, 'List Menu', 'menu', 'bars', '0101', '1', '2019-01-08 15:55:15', '2019-01-08 15:55:15', 1),
(5, 'Assign Menu', 'assignmenu', 'bar', '0102', '1', '2019-01-08 15:56:23', '2019-01-08 15:56:39', 1),
(6, 'List User', 'user', '', '0201', '1', '2019-01-08 15:57:31', '2019-01-08 15:57:31', 2),
(7, 'List Role', 'role', '', '0202', '1', '2019-01-08 15:57:57', '2019-01-08 15:57:57', 2);

-- --------------------------------------------------------

--
-- Table structure for table `periode_laporan`
--

CREATE TABLE `periode_laporan` (
  `ID` int(11) NOT NULL,
  `NAMA` text NOT NULL,
  `STATUS` varchar(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `role`
--

CREATE TABLE `role` (
  `ID` int(11) NOT NULL,
  `ROLE_NAME` varchar(255) NOT NULL,
  `STATUS` varchar(1) NOT NULL DEFAULT '1',
  `CREATE_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATE_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role`
--

INSERT INTO `role` (`ID`, `ROLE_NAME`, `STATUS`, `CREATE_DATE`, `UPDATE_DATE`) VALUES
(1, 'administrator', '1', '2019-01-08 15:30:43', '2019-01-08 15:30:43');

-- --------------------------------------------------------

--
-- Table structure for table `role_menu`
--

CREATE TABLE `role_menu` (
  `ID` int(11) NOT NULL,
  `ROLE_ID` int(11) NOT NULL,
  `MENU_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `role_menu`
--

INSERT INTO `role_menu` (`ID`, `ROLE_ID`, `MENU_ID`) VALUES
(1, 1, 1),
(2, 1, 4),
(3, 1, 5),
(4, 1, 2),
(5, 1, 6),
(6, 1, 7),
(7, 1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `seksi`
--

CREATE TABLE `seksi` (
  `ID` int(11) NOT NULL,
  `NAMA` text NOT NULL,
  `STATUS` varchar(1) NOT NULL DEFAULT '1',
  `BIDANG_ID` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `status_laporan`
--

CREATE TABLE `status_laporan` (
  `ID` int(11) NOT NULL,
  `NAMA` text NOT NULL,
  `STATUS` varchar(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE `user` (
  `ID` int(11) NOT NULL,
  `USERNAME` varchar(255) NOT NULL,
  `PASSWORD` varchar(255) NOT NULL,
  `STATUS` varchar(1) NOT NULL DEFAULT '1',
  `CREATE_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `UPDATE_DATE` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `ROLE_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID`, `USERNAME`, `PASSWORD`, `STATUS`, `CREATE_DATE`, `UPDATE_DATE`, `ROLE_ID`) VALUES
(1, 'prsty', 'c61a56c2b825813586744dfde2f2aad1', '1', '2019-01-08 15:30:43', '2019-01-08 15:30:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_info`
--

CREATE TABLE `user_info` (
  `ID` int(11) NOT NULL,
  `ALIAS` text NOT NULL,
  `EMAIL` text,
  `PHONE` varchar(255) DEFAULT NULL,
  `ADDRESS` text,
  `PHOTO_1` text,
  `USER_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_data`
--
ALTER TABLE `app_data`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_APP_DATA_USER1_idx` (`USER_ID`);

--
-- Indexes for table `bidang`
--
ALTER TABLE `bidang`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `jenis_laporan`
--
ALTER TABLE `jenis_laporan`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `kppn`
--
ALTER TABLE `kppn`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `laporan`
--
ALTER TABLE `laporan`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_LAPORAN_JENIS_LAPORAN1_idx` (`JENIS_LAPORAN_ID`),
  ADD KEY `fk_LAPORAN_PERIODE_LAPORAN1_idx` (`PERIODE_LAPORAN_ID`),
  ADD KEY `fk_LAPORAN_STATUS_LAPORAN1_idx` (`STATUS_LAPORAN_ID`),
  ADD KEY `fk_LAPORAN_KPPN1_idx` (`KPPN_ID`),
  ADD KEY `fk_LAPORAN_SEKSI1_idx` (`SEKSI_ID`),
  ADD KEY `fk_LAPORAN_BIDANG1_idx` (`BIDANG_ID`),
  ADD KEY `fk_LAPORAN_USER1_idx` (`USER_ID`);

--
-- Indexes for table `menu`
--
ALTER TABLE `menu`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_MENU_MENU1_idx` (`MENU_ID`);

--
-- Indexes for table `periode_laporan`
--
ALTER TABLE `periode_laporan`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `role`
--
ALTER TABLE `role`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `role_menu`
--
ALTER TABLE `role_menu`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_ROLE_has_MENU_MENU1_idx` (`MENU_ID`),
  ADD KEY `fk_ROLE_has_MENU_ROLE1_idx` (`ROLE_ID`);

--
-- Indexes for table `seksi`
--
ALTER TABLE `seksi`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_SEKSI_BIDANG1_idx` (`BIDANG_ID`);

--
-- Indexes for table `status_laporan`
--
ALTER TABLE `status_laporan`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `user`
--
ALTER TABLE `user`
  ADD PRIMARY KEY (`ID`),
  ADD UNIQUE KEY `USERNAME_UNIQUE` (`USERNAME`),
  ADD KEY `fk_USER_ROLE_idx` (`ROLE_ID`);

--
-- Indexes for table `user_info`
--
ALTER TABLE `user_info`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `fk_USER_INFO_USER1_idx` (`USER_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `app_data`
--
ALTER TABLE `app_data`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `bidang`
--
ALTER TABLE `bidang`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `jenis_laporan`
--
ALTER TABLE `jenis_laporan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `kppn`
--
ALTER TABLE `kppn`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `laporan`
--
ALTER TABLE `laporan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `menu`
--
ALTER TABLE `menu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `periode_laporan`
--
ALTER TABLE `periode_laporan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `role_menu`
--
ALTER TABLE `role_menu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `seksi`
--
ALTER TABLE `seksi`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `status_laporan`
--
ALTER TABLE `status_laporan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user`
--
ALTER TABLE `user`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `app_data`
--
ALTER TABLE `app_data`
  ADD CONSTRAINT `fk_APP_DATA_USER1` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `laporan`
--
ALTER TABLE `laporan`
  ADD CONSTRAINT `fk_LAPORAN_BIDANG1` FOREIGN KEY (`BIDANG_ID`) REFERENCES `bidang` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_LAPORAN_JENIS_LAPORAN1` FOREIGN KEY (`JENIS_LAPORAN_ID`) REFERENCES `jenis_laporan` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_LAPORAN_KPPN1` FOREIGN KEY (`KPPN_ID`) REFERENCES `kppn` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_LAPORAN_PERIODE_LAPORAN1` FOREIGN KEY (`PERIODE_LAPORAN_ID`) REFERENCES `periode_laporan` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_LAPORAN_SEKSI1` FOREIGN KEY (`SEKSI_ID`) REFERENCES `seksi` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_LAPORAN_STATUS_LAPORAN1` FOREIGN KEY (`STATUS_LAPORAN_ID`) REFERENCES `status_laporan` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_LAPORAN_USER1` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `menu`
--
ALTER TABLE `menu`
  ADD CONSTRAINT `fk_MENU_MENU1` FOREIGN KEY (`MENU_ID`) REFERENCES `menu` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `role_menu`
--
ALTER TABLE `role_menu`
  ADD CONSTRAINT `fk_ROLE_has_MENU_MENU1` FOREIGN KEY (`MENU_ID`) REFERENCES `menu` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_ROLE_has_MENU_ROLE1` FOREIGN KEY (`ROLE_ID`) REFERENCES `role` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `seksi`
--
ALTER TABLE `seksi`
  ADD CONSTRAINT `fk_SEKSI_BIDANG1` FOREIGN KEY (`BIDANG_ID`) REFERENCES `bidang` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user`
--
ALTER TABLE `user`
  ADD CONSTRAINT `fk_USER_ROLE` FOREIGN KEY (`ROLE_ID`) REFERENCES `role` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `user_info`
--
ALTER TABLE `user_info`
  ADD CONSTRAINT `fk_USER_INFO_USER1` FOREIGN KEY (`USER_ID`) REFERENCES `user` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
