-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Oct 14, 2023 at 12:06 PM
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
-- Database: `ehp`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbladmin`
--

CREATE TABLE `tbladmin` (
  `ID` int(10) NOT NULL,
  `AdminName` varchar(120) DEFAULT NULL,
  `UserName` varchar(120) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(120) DEFAULT NULL,
  `AdminRegdate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbladmin`
--

INSERT INTO `tbladmin` (`ID`, `AdminName`, `UserName`, `MobileNumber`, `Email`, `Password`, `AdminRegdate`) VALUES
(1, 'Musocial', 'admin', 789676581, 'ehpadmin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '2023-08-20 11:48:13');

-- --------------------------------------------------------

--
-- Table structure for table `tblbooking`
--

CREATE TABLE `tblbooking` (
  `ID` int(10) NOT NULL,
  `BookingID` int(10) DEFAULT NULL,
  `ServiceID` int(10) DEFAULT NULL,
  `UserID` int(5) DEFAULT NULL,
  `EventType` varchar(200) DEFAULT NULL,
  `Numberofguest` int(10) DEFAULT NULL,
  `PricePerEvent` int(11) NOT NULL,
  `TotalPrice` int(11) NOT NULL,
  `Message` mediumtext DEFAULT NULL,
  `BookingDate` timestamp NULL DEFAULT current_timestamp(),
  `Remark` varchar(200) DEFAULT NULL,
  `Status` varchar(200) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp(),
  `notification_status` varchar(255) DEFAULT 'Not Notified'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblbooking`
--

INSERT INTO `tblbooking` (`ID`, `BookingID`, `ServiceID`, `UserID`, `EventType`, `Numberofguest`, `PricePerEvent`, `TotalPrice`, `Message`, `BookingDate`, `Remark`, `Status`, `UpdationDate`, `notification_status`) VALUES
(1, 602858106, 59, 1, NULL, 2, 2000, 4000, 'Thank you very much!', '2023-10-09 15:53:28', 'request approved well', 'Approved', '2023-10-14 08:13:05', 'Not Notified'),
(2, 970244326, 59, 2, NULL, 1, 2000, 2000, 'thanks', '2023-10-09 15:54:16', NULL, NULL, NULL, 'Not Notified'),
(3, 558390489, 59, 5, NULL, 1, 2000, 2000, 'Urakoze Musocial', '2023-10-13 17:04:58', 'request cancelled', 'Cancelled', '2023-10-14 08:08:52', 'Not Notified');

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
(1, 'Fofo', 'nyiraflor2001@gmail.com', 'fuck you admin', '2023-09-23 12:21:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tblevents`
--

CREATE TABLE `tblevents` (
  `ID` int(10) NOT NULL,
  `ServiceName` varchar(200) DEFAULT NULL,
  `SerDes` varchar(250) NOT NULL,
  `ServicePrice` varchar(200) DEFAULT NULL,
  `Location` varchar(30) NOT NULL,
  `Seats` varchar(10) DEFAULT NULL,
  `ServiceDate` date DEFAULT NULL,
  `ServiceTime` time DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblevents`
--

INSERT INTO `tblevents` (`ID`, `ServiceName`, `SerDes`, `ServicePrice`, `Location`, `Seats`, `ServiceDate`, `ServiceTime`, `CreationDate`) VALUES
(58, 'Wedding Celemony', 'plan, organize, and manage various types of events more efficiently.', '100', 'Erica motel', '21973', '2023-10-22', '22:56:00', '2023-10-09 15:51:22'),
(59, 'Iwacu Festival', 'registration to execution and post-event analysis. Here are some key components', '2000', 'Musanze', '0', '2023-10-17', '22:56:00', '2023-10-09 15:52:07');

-- --------------------------------------------------------

--
-- Table structure for table `tblpage`
--

CREATE TABLE `tblpage` (
  `ID` int(10) NOT NULL,
  `PageType` varchar(100) DEFAULT NULL,
  `PageTitle` mediumtext DEFAULT NULL,
  `PageDescription` mediumtext DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `UpdationDate` timestamp NULL DEFAULT NULL ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblpage`
--

INSERT INTO `tblpage` (`ID`, `PageType`, `PageTitle`, `PageDescription`, `Email`, `MobileNumber`, `UpdationDate`) VALUES
(1, 'aboutus', 'About Us', '<h4><font size=\"3\" face=\"georgia\">\r\nWelcome to Our Event Management Platform\r\n</font></h4>\r\n<h5><font size=\"3\" face=\"georgia\">\r\nAt EHP, we are passionate about creating unforgettable moments and seamless experiences. With years of expertise in event planning and management, we\'ve dedicated ourselves to turning your visions into reality.\r\n</font></h5>\r\n<h4><font size=\"3\" face=\"georgia\">\r\nWho We Are\r\n</font></h4>\r\n<h5><font size=\"3\" face=\"georgia\">\r\nWe are a team of creative minds and meticulous planners, driven by a shared commitment to excellence. Our mission is to craft events that leave lasting impressions, whether it\'s a grand corporate conference, an intimate wedding celebration, or a lively music festival.\r\n</font></h5>\r\n<h4><font size=\"3\" face=\"georgia\">\r\nOur Services\r\n</font></h4>\r\n<p>\r\n<font size=\"3\" face=\"georgia\" style=\"\"><span style=\"color: black;\"><b>1) Event Planning:</b> From concept to execution, we handle all aspects of event planning, ensuring a smooth and memorable experience.</span></font></p><p><font size=\"3\" face=\"georgia\" style=\"\">\r\n\r\n<font color=\"#000000\" style=\"\"><b>2) Venue Selection: </b>We assist in finding the perfect venue that aligns with your event\'s theme and requirements.</font></font></p><h4><font size=\"3\" face=\"georgia\">\r\nJoin Us in Creating Memories\r\n</font></h4>\r\n\r\n<h5><font size=\"3\" face=\"georgia\">\r\nWe invite you to explore our platform and discover how we can transform your event ideas into realities. Whether you\'re planning a corporate gathering, a social celebration, or a community event, we\'re here to make it unforgettable.\r\n\r\nThank you for considering EHP as your event partner. We look forward to working with you and being a part of your special moments.\r\n</font></h5>', NULL, NULL, '2023-10-13 09:53:27'),
(2, 'contactus', 'Contact Us', 'As EHP we are here for your joyful, so for that you have any problem, ideas or suggestion fell free to write on us for the above addresses.\r\nyou can contact us on mobile phone or write on us on that email provided.', 'rwanda@ehp.gov.rw', 789676581, '2023-10-09 14:54:27');

-- --------------------------------------------------------

--
-- Table structure for table `tbluser`
--

CREATE TABLE `tbluser` (
  `ID` int(10) NOT NULL,
  `FullName` varchar(200) DEFAULT NULL,
  `MobileNumber` bigint(10) DEFAULT NULL,
  `Email` varchar(200) DEFAULT NULL,
  `Password` varchar(200) DEFAULT NULL,
  `RegDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tbluser`
--

INSERT INTO `tbluser` (`ID`, `FullName`, `MobileNumber`, `Email`, `Password`, `RegDate`) VALUES
(1, 'MUSOSIYARE Thacien', 789676581, 'musosiyarethacien10@gmail.com', '827ccb0eea8a706c4c34a16891f84e7b', '2023-10-03 11:40:19'),
(2, 'Rukundo', 785512581, 'innocent@gmail.com', '698d51a19d8a121ce581499d7b701668', '2023-10-09 04:49:10'),
(5, 'Muhirwa Theoneste', 785512582, 'theoneste@yahoo.fr', 'caf1a3dfb505ffed0d024130f58c5cfa', '2023-10-13 17:04:03');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbladmin`
--
ALTER TABLE `tbladmin`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblbooking`
--
ALTER TABLE `tblbooking`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ServiceID` (`ServiceID`),
  ADD KEY `EventType` (`EventType`);

--
-- Indexes for table `tblcontact`
--
ALTER TABLE `tblcontact`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblevents`
--
ALTER TABLE `tblevents`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

--
-- Indexes for table `tblpage`
--
ALTER TABLE `tblpage`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tbluser`
--
ALTER TABLE `tbluser`
  ADD PRIMARY KEY (`ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbladmin`
--
ALTER TABLE `tbladmin`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblbooking`
--
ALTER TABLE `tblbooking`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tblcontact`
--
ALTER TABLE `tblcontact`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `tblevents`
--
ALTER TABLE `tblevents`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=61;

--
-- AUTO_INCREMENT for table `tblpage`
--
ALTER TABLE `tblpage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblbooking`
--
ALTER TABLE `tblbooking`
  ADD CONSTRAINT `serivdi` FOREIGN KEY (`ServiceID`) REFERENCES `tblevents` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
