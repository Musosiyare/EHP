-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 26, 2023 at 08:16 AM
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
(1, 'Musocial', 'admin', 5689784589, 'ehpadmin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', '2023-08-20 11:48:13');

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
(1, 758884612, 41, 6, 'Wedding Celemony', 4, 7000, 28000, 'Thank you so mutch', '2023-09-23 12:09:59', 'your request approved', 'Approved', '2023-09-23 12:16:05', 'Not Notified'),
(2, 293829502, 42, 9, 'Iwacu Festival', 5, 10000, 50000, 'thank you for your big effort', '2023-09-23 12:13:40', 'rejected', 'Cancelled', '2023-09-23 12:16:24', 'Not Notified'),
(3, 302792831, 42, 6, 'Iwacu Festival', 6, 10000, 60000, 'thank you very much!!!', '2023-09-26 05:12:12', NULL, NULL, NULL, 'Not Notified');

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
-- Table structure for table `tbleventtype`
--

CREATE TABLE `tbleventtype` (
  `ID` int(10) NOT NULL,
  `EventType` varchar(200) DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
(1, 'aboutus', 'About Us', '<h4>\r\nWelcome to Our Event Management Platform\r\n</h4>\r\n<h5>\r\nAt EHP, we are passionate about creating unforgettable moments and seamless experiences. With years of expertise in event planning and management, we\'ve dedicated ourselves to turning your visions into reality.\r\n</h5>\r\n<h4>\r\nWho We Are\r\n</h4>\r\n<h5>\r\nWe are a team of creative minds and meticulous planners, driven by a shared commitment to excellence. Our mission is to craft events that leave lasting impressions, whether it\'s a grand corporate conference, an intimate wedding celebration, or a lively music festival.\r\n</h5>\r\n<h4>\r\nOur Services\r\n</h4>\r\n<p>\r\n<span style=\"color:black; font-weight:bold;\">1) Event Planning:</span> From concept to execution, we handle all aspects of event planning, ensuring a smooth and memorable experience. <br>\r\n\r\n<span style=\"color:black; font-weight:bold;\">2) Venue Selection:</span></h5> We assist in finding the perfect venue that aligns with your event\'s theme and requirements. <br>\r\n\r\n<span style=\"color:black; font-weight:bold;\">3) Vendor Management: </span>Our extensive network of trusted vendors ensures you get the best services within your budget.<br>\r\n\r\n<span style=\"color:black; font-weight:bold;\">4) logistics</span> We manage logistics, so you can focus on enjoying your event without worries. <br>\r\n\r\n<span style=\"color:black; font-weight:bold;\">5) Technology</span> Utilizing cutting-edge event management tools, we enhance guest engagement and streamline processes. <br>\r\n</p>\r\n\r\n<h4>\r\nJoin Us in Creating Memories\r\n</h4>\r\n\r\n<h5>\r\nWe invite you to explore our platform and discover how we can transform your event ideas into realities. Whether you\'re planning a corporate gathering, a social celebration, or a community event, we\'re here to make it unforgettable.\r\n\r\nThank you for considering EHP as your event partner. We look forward to working with you and being a part of your special moments.\r\n</h5>', NULL, NULL, '2023-09-13 13:27:03'),
(2, 'contactus', 'Contact Us', 'As EHP we are here for your joyful, so for that you have any problem, ideas or suggestion fell free to write on us for the above addresses.\r\nyou can contact us on mobile phone or write on us on that email provided.\r\nthank you for your time!!!', 'info@ehp.gov.rw', 789676582, '2023-09-13 13:33:11');

-- --------------------------------------------------------

--
-- Table structure for table `tblservice`
--

CREATE TABLE `tblservice` (
  `ID` int(10) NOT NULL,
  `ServiceName` varchar(200) DEFAULT NULL,
  `SerDes` varchar(250) NOT NULL,
  `ServicePrice` varchar(200) DEFAULT NULL,
  `Location` varchar(30) NOT NULL,
  `ServiceDate` date DEFAULT NULL,
  `ServiceTime` time DEFAULT NULL,
  `CreationDate` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `tblservice`
--

INSERT INTO `tblservice` (`ID`, `ServiceName`, `SerDes`, `ServicePrice`, `Location`, `ServiceDate`, `ServiceTime`, `CreationDate`) VALUES
(41, 'Wedding Celemony', 'An event management system (EMS) is a software or technology platform designed to streamline and facilitate the planning, organization, and execution of events. These events can range from small business meetings and conferences to large-scale conven', '7000', 'Golden Motel', '2023-09-26', '12:00:00', '2023-09-22 12:44:18'),
(42, 'Iwacu Festival', 'weddings, trade shows, and more. Event management systems offer a wide range of features and functionalities to help event planners and organizers manage various aspects of the event planning process. Here are some common features and components of a', '10000', 'Musanze', '2023-09-30', '07:08:00', '2023-09-22 12:45:35'),
(43, 'Football Match', 'Popular event management systems include Cvent, Eventbrite, Bizzabo, and Eventzilla, among others. The choice of an EMS depends on the specific needs and scale of the event, as well as the budget available for event planning and management. These sys', '25000', 'Kigali Pele Stadium', '2023-09-23', '18:00:00', '2023-09-22 12:48:14');

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
(1, 'Anvi', 9879878979, 'anvi@gmail.com', '202cb962ac59075b964b07152d234b70', '2022-02-15 09:15:51'),
(2, 'hkjhkj', 4579878687, 'rewrewre@yutuy', '81dc9bdb52d04dc20036dbd8313ed055', '2022-02-15 09:16:44'),
(3, 'Reetu Singh', 5465465464, 'reetu@gmail.com', '202cb962ac59075b964b07152d234b70', '2022-02-15 12:07:55'),
(4, 'John Doe', 1234569879, 'John@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2022-02-19 15:17:04'),
(5, 'Anuj Singh', 1236985211, 'akj@gmail.com', 'f925916e2754e5e03f75dd58a5733251', '2022-02-19 17:50:28'),
(6, 'MUSOSIYARE Thacien', 789676581, 'musosiyarethacien10@gmail.com', '202cb962ac59075b964b07152d234b70', '2023-09-11 13:57:18'),
(7, 'RUKUNDO Innocent', 785512582, 'rukundoinnocent@gmail.com', 'caf1a3dfb505ffed0d024130f58c5cfa', '2023-09-11 15:52:12'),
(8, 'Rukundo', 886140430, 'innocent@gmail.com', '628631f07321b22d8c176c200c855e1b', '2023-09-21 19:02:36'),
(9, 'Fofo', 795543213, 'nyiraflor2001@gmail.com', '550a141f12de6341fba65b0ad0433500', '2023-09-23 12:12:21');

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
-- Indexes for table `tbleventtype`
--
ALTER TABLE `tbleventtype`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `EventType` (`EventType`);

--
-- Indexes for table `tblpage`
--
ALTER TABLE `tblpage`
  ADD PRIMARY KEY (`ID`);

--
-- Indexes for table `tblservice`
--
ALTER TABLE `tblservice`
  ADD PRIMARY KEY (`ID`),
  ADD KEY `ID` (`ID`);

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
-- AUTO_INCREMENT for table `tbleventtype`
--
ALTER TABLE `tbleventtype`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tblpage`
--
ALTER TABLE `tblpage`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `tblservice`
--
ALTER TABLE `tblservice`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=44;

--
-- AUTO_INCREMENT for table `tbluser`
--
ALTER TABLE `tbluser`
  MODIFY `ID` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `tblbooking`
--
ALTER TABLE `tblbooking`
  ADD CONSTRAINT `serivdi` FOREIGN KEY (`ServiceID`) REFERENCES `tblservice` (`ID`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
