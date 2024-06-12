-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Mar 05, 2024 at 03:13 PM
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
-- Database: `rpmsdb`
--

-- --------------------------------------------------------

--
-- Table structure for table `mpesa`
--

CREATE TABLE `mpesa` (
  `MerchantRequestID` varchar(255) DEFAULT NULL,
  `CheckoutRequestID` varchar(255) DEFAULT NULL,
  `ResultCode` varchar(20) DEFAULT NULL,
  `ResultDesc` varchar(255) DEFAULT NULL,
  `Amount` decimal(10,2) DEFAULT NULL,
  `TransactionId` varchar(255) DEFAULT NULL,
  `TransactionDate` date DEFAULT NULL,
  `phoneNumber` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `mpesa`
--

INSERT INTO `mpesa` (`MerchantRequestID`, `CheckoutRequestID`, `ResultCode`, `ResultDesc`, `Amount`, `TransactionId`, `TransactionDate`, `phoneNumber`) VALUES
(NULL, 'ws_CO_05032024165730976758198275', NULL, NULL, NULL, NULL, NULL, NULL),
(NULL, 'ws_CO_05032024170340977758198275', NULL, NULL, NULL, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(120) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Admin', 'admin', 8855223366, 'adminuser@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2023-03-25 06:44:27'),
(2, 'admin', 'admin', 9878, 'admin@email.com', 'joy123', '2024-02-16 10:48:16');

-- --------------------------------------------------------

--
-- Table structure for table `tblcategory`
--

CREATE TABLE `tblcategory` (
  `ID` int(10) NOT NULL,
  `CategoryName` varchar(200) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcategory`
--

INSERT INTO `tblcategory` (`ID`, `CategoryName`, `CreationDate`) VALUES
(13, 'Duty Pass', '2023-03-27 14:03:02'),
(14, 'Pass On Privilege Account', '2023-03-27 14:03:16'),
(15, 'School Pass', '2023-03-27 14:03:30'),
(16, 'Post Retirement Complimentary Passes', '2023-03-27 14:03:44'),
(18, 'Residential Card Pass', '2023-03-27 14:04:10'),
(19, 'Special Passes', '2023-03-27 14:04:23'),
(20, 'Senior Citizens', '2023-03-30 10:03:28');

-- --------------------------------------------------------

--
-- Table structure for table `tblcontact`
--

CREATE TABLE `tblcontact` (
  `ID` int(10) NOT NULL,
  `Name` varchar(200) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Message` mediumtext DEFAULT NULL,
  `EnquiryDate` timestamp NOT NULL DEFAULT current_timestamp(),
  `IsRead` int(5) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblcontact`
--

INSERT INTO `tblcontact` (`ID`, `Name`, `Email`, `Message`, `EnquiryDate`, `IsRead`) VALUES
(1, 'rakesh kumar', 'rakesh@gmail.com', 'hfgghfghf', '2023-03-28 06:31:26', 1),
(2, 'Test', 'test@gmail.com', 'sample message', '2023-03-28 06:32:55', 1),
(3, 'Anuj', 'ak@gmail.com', 'This is testing purpose', '2023-03-30 12:20:30', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbldestination`
--

CREATE TABLE `tbldestination` (
  `ID` int(11) NOT NULL,
  `DestinationName` varchar(200) NOT NULL,
  `price` int(11) NOT NULL,
  `DateCreated` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbldestination`
--

INSERT INTO `tbldestination` (`ID`, `DestinationName`, `price`, `DateCreated`) VALUES
(1, 'Thika', 1000, '2024-02-14 08:37:49'),
(2, 'Nairobi', 2000, '2024-02-14 08:37:49'),
(3, 'Mombasa', 3000, '2024-02-14 08:38:06'),
(4, 'Kisumu', 1500, '2024-02-14 08:38:06'),
(5, 'Kitale', 1000, '2024-02-14 08:38:24'),
(6, 'Kericho', 500, '2024-02-14 08:38:24');

-- --------------------------------------------------------

--
-- Table structure for table `tblpage`
--

CREATE TABLE `tblpage` (
  `ID` int(10) NOT NULL,
  `PageType` varchar(200) DEFAULT NULL,
  `PageTitle` varchar(200) DEFAULT NULL,
  `PageDescription` mediumtext DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `UpdationDate` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpage`
--

INSERT INTO `tblpage` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`) VALUES
(1, 'aboutus', 'About us', '<font color=\"#747474\" face=\"Roboto, sans-serif, arial\"><span style=\"font-size: 13px;\"><b>The rail pass management system is a web-based application. This application developed in PHP using MySQLi extension.</b></span></font>', NULL, NULL, '2023-03-30 12:19:41'),
(2, 'contactus', 'Contact Us', '                New Delhi Railway Station', 'infotest@gmail.com', 4654789799, '2023-03-30 12:20:10');

-- --------------------------------------------------------

--
-- Table structure for table `tblpass`
--

CREATE TABLE `tblpass` (
  `ID` int(10) NOT NULL,
  `PassNumber` varchar(200) DEFAULT NULL,
  `FullName` varchar(200) DEFAULT NULL,
  `ProfileImage` varchar(200) DEFAULT NULL,
  `ContactNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `IdentityType` varchar(200) DEFAULT NULL,
  `IdentityCardno` varchar(200) DEFAULT NULL,
  `Category` varchar(100) DEFAULT NULL,
  `Source` varchar(200) DEFAULT NULL,
  `Destination` varchar(200) DEFAULT NULL,
  `TrainClass` varchar(250) DEFAULT NULL,
  `FromDate` varchar(200) DEFAULT NULL,
  `ToDate` varchar(200) DEFAULT NULL,
  `wayType` varchar(120) DEFAULT NULL,
  `Cost` decimal(10,0) DEFAULT NULL,
  `PasscreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpass`
--

INSERT INTO `tblpass` (`ID`, `PassNumber`, `FullName`, `ProfileImage`, `ContactNumber`, `Email`, `IdentityType`, `IdentityCardno`, `Category`, `Source`, `Destination`, `TrainClass`, `FromDate`, `ToDate`, `wayType`, `Cost`, `PasscreationDate`) VALUES
(1, '984463487', 'Mayank Tripathi', 'fc5bf5c9948c416f7c1046c8f91ba9a91679925964.png', 6446465464, 'may@gmail.com', 'Adhar Card', 'uyuiy78979789', 'Pass On Privilege Account', 'Delhi', 'Jaipur', 'II Class', '2023-03-28', '2023-04-27', 'Single Way', 200, '2023-03-27 14:06:04'),
(2, '837149403', 'Kanika Jha', '3dfb1c8dbdcc05745b5fefc573a2a85f1679980708.png', 8979797979, 'kanika@gmail.com', 'Adhar Card', 'ui7894ko45', 'Pass On Privilege Account', 'Delhi', 'Chandigarh', 'Slepper', '2023-03-28', '2023-04-30', 'Two Way', 1500, '2023-03-28 05:18:28'),
(3, '305788314', 'Ram Singh', '779b7513263ef185b6d094af290ef5401680178696.png', 785412600, 'rkm@test.com', 'Voter Card', 'NHJB4342485', 'Senior Citizens', 'Aligarh', 'Ghaziabad', 'General', '2023-04-01', '2023-10-31', 'Two Way', 1500, '2023-03-30 12:18:16');

-- --------------------------------------------------------

--
-- Table structure for table `tblticket`
--

CREATE TABLE `tblticket` (
  `ID` int(11) NOT NULL,
  `category` varchar(100) NOT NULL,
  `destination` varchar(100) NOT NULL,
  `price` int(11) NOT NULL,
  `checkIn` varchar(100) NOT NULL,
  `pass` int(11) NOT NULL,
  `passid` varchar(200) NOT NULL,
  `phone` int(11) NOT NULL,
  `email` varchar(200) NOT NULL,
  `created` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblticket`
--

INSERT INTO `tblticket` (`ID`, `category`, `destination`, `price`, `checkIn`, `pass`, `passid`, `phone`, `email`, `created`) VALUES
(1, 'School Pass', 'Kisumu', 0, '2024-02-22', 3, '', 0, '', '2024-02-16 09:26:02'),
(2, 'Duty Pass', 'Nairobi', 0, '2024-02-22', 4, '9611pass', 74747, 'dg@gj.bm', '2024-02-16 09:31:43'),
(3, 'Post Retirement Complimentary Passes', 'Kisumu', 0, '2024-02-21', 1, 'Pass-7708', 86423, 'fdidi@rnr.com', '2024-02-16 10:18:52'),
(4, 'Special Passes', 'Kericho', 0, '2024-02-24', 1, 'Pass-4372', 0, '', '2024-02-16 10:27:47'),
(5, 'School Pass', 'Mombasa', 0, '2024-03-06', 4, 'Pass-8476', 74545454, 'vbvb@ec.vn', '2024-02-16 10:45:38'),
(6, 'School Pass', 'Kitale', 0, '2024-02-21', 5, 'Pass-8877', 6688, 'fg@et.mb', '2024-02-20 07:50:53'),
(7, 'Duty Pass', 'Kisumu', 4500, '2024-03-06', 3, 'pass-4941', 758198275, 'bushmutally@gmail.com', '2024-03-05 08:23:14');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcategory`
--
ALTER TABLE `tblcategory`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblcontact`
--
ALTER TABLE `tblcontact`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbldestination`
--
ALTER TABLE `tbldestination`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpage`
--
ALTER TABLE `tblpage`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblpass`
--
ALTER TABLE `tblpass`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblticket`
--
ALTER TABLE `tblticket`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblcategory`
--
ALTER TABLE `tblcategory`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `tblcontact`
--
ALTER TABLE `tblcontact`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbldestination`
--
ALTER TABLE `tbldestination`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `tblpage`
--
ALTER TABLE `tblpage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblpass`
--
ALTER TABLE `tblpass`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblticket`
--
ALTER TABLE `tblticket`
  MODIFY `ID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
