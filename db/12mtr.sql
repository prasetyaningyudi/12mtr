-- phpMyAdmin SQL Dump
-- version 4.8.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 17, 2018 at 09:58 AM
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
  `STATUS` varchar(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `kppn`
--

CREATE TABLE `kppn` (
  `ID` int(11) NOT NULL,
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
  `NOMOR` text NOT NULL,
  `TANGGAL` date NOT NULL,
  `FILE` text NOT NULL,
  `JENIS_LAPORAN_ID` int(11) NOT NULL,
  `PERIODE_LAPORAN_ID` int(11) NOT NULL,
  `STATUS_LAPORAN_ID` int(11) NOT NULL,
  `SEKSI_ID` int(11) NOT NULL,
  `KPPN_ID` int(11) NOT NULL,
  `BIDANG_ID` int(11) NOT NULL,
  `USER_ID` int(11) NOT NULL
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
(14, 'Setup Menu', '#', 'bars', '01', '1', '2018-12-12 16:56:36', '2018-12-17 15:19:05', NULL),
(16, 'menu', 'menu', 'plus', '0101', '1', '2018-12-13 09:13:44', '2018-12-17 15:22:12', 14),
(17, 'User Setting', '#', 'users-cog', '02', '1', '2018-12-13 13:01:52', '2018-12-17 15:27:45', NULL),
(18, 'Role', 'role', 'users', '03', '1', '2018-12-13 13:02:00', '2018-12-17 15:26:24', NULL),
(21, 'Another menu', 'hem', 'anchor', '04', '1', '2018-12-13 13:02:23', '2018-12-17 15:32:47', NULL),
(25, 'list', 'user', 'plus', '0201', '1', '2018-12-14 11:11:35', '2018-12-17 15:27:23', 17),
(38, 'menu assign', 'assignmenu', 'user-plus', '0102', '1', '2018-12-17 15:22:54', '2018-12-17 15:22:54', 14);

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

-- --------------------------------------------------------

--
-- Table structure for table `role_menu`
--

CREATE TABLE `role_menu` (
  `ID` int(11) NOT NULL,
  `ROLE_ID` int(11) NOT NULL,
  `MENU_ID` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `periode_laporan`
--
ALTER TABLE `periode_laporan`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role`
--
ALTER TABLE `role`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `role_menu`
--
ALTER TABLE `role_menu`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

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
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `user_info`
--
ALTER TABLE `user_info`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

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
