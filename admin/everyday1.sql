-- phpMyAdmin SQL Dump
-- version 3.5.2
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Dec 08, 2014 at 06:50 PM
-- Server version: 5.5.25a
-- PHP Version: 5.4.4

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `everyday1`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutus`
--

CREATE TABLE IF NOT EXISTS `aboutus` (
  `ID_Aboutus` char(10) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Rating` char(1) NOT NULL,
  `Address` varchar(100) NOT NULL,
  `Telephone` varchar(20) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `About` varchar(1000) NOT NULL,
  `Concept` varchar(1000) NOT NULL,
  `Vision` varchar(1000) NOT NULL,
  `Mision` varchar(1000) NOT NULL,
  `Latitude` varchar(50) NOT NULL,
  `Longitude` varchar(50) NOT NULL,
  `Link_Web` varchar(50) NOT NULL,
  `Link_Book` varchar(50) NOT NULL,
  `Date` datetime NOT NULL,
  PRIMARY KEY (`ID_Aboutus`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aboutus`
--

INSERT INTO `aboutus` (`ID_Aboutus`, `Name`, `Rating`, `Address`, `Telephone`, `Email`, `About`, `Concept`, `Vision`, `Mision`, `Latitude`, `Longitude`, `Link_Web`, `Link_Book`, `Date`) VALUES
('ABT1400001', 'Everyday Smart Hotel', '2', 'Jalan Mangga Dua No.20', '021123456', 'everydaysmarthotel@yahoo.com', 'Brought to you by Goodwood Asia Hospitality Management, Everyday Smart Hotel are their first entry into the budget hotel sector. Offering exceptional value, you will find Everyday Smart Hotel in great city centre locations around the cities and we''re growing all the time.Prides itself on the high levels of lodging offered, we have everything for the visitor requiring Bed and Breakfast in modern, clean, and spotless surroundings that you will find in urban and city centre locations, close to all the services, amenities and attractions that you need to make the most of your trip.', 'Budget hotels with smart, cool, and stylish rooms,|Luxurious amenities such as Romance/ King Koil Spring Bed, GROHE and TOTO for bathroom elements, LCD TV, and local and international channels,|Close to city centers and places of interests.', 'Our Vision is to be Recognised as unique in the industry for fulfilling our promise "Where guests become friends"', 'Our mission is to provide you a smart way to spend your holiday with comfort and excellent service', '-6.150049', '106.818953', 'www.everydaysmarthotel.com/jakarta', 'www.everydaysmarthotel.com/reservation.php', '2014-11-28 19:54:21');

-- --------------------------------------------------------

--
-- Table structure for table `additional`
--

CREATE TABLE IF NOT EXISTS `additional` (
  `ID_Additional` char(10) NOT NULL,
  `Additional_Name` varchar(50) NOT NULL,
  `Price` varchar(10) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Status` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_Additional`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `additional`
--

INSERT INTO `additional` (`ID_Additional`, `Additional_Name`, `Price`, `Description`, `Status`) VALUES
('ADD1400001', 'Airport Transfer', '250000', 'Our driver will meet you at the airport upon arrival and drive you to our hotel in a fully air-condi', 'Active'),
('ADD1400002', 'Breakfast', '35000', 'additional breakfast', 'Delete');

-- --------------------------------------------------------

--
-- Table structure for table `book`
--

CREATE TABLE IF NOT EXISTS `book` (
  `ID_Booking` char(10) NOT NULL,
  `Booking_code` varchar(10) NOT NULL,
  `Arrive` date NOT NULL,
  `Depart` date NOT NULL,
  `Number_nights` int(5) NOT NULL,
  `Occupancy` varchar(20) NOT NULL,
  `ID_RoomType` char(10) NOT NULL,
  `Quantity` varchar(5) NOT NULL,
  `Price` varchar(10) NOT NULL,
  `Booking_Status` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `book`
--

INSERT INTO `book` (`ID_Booking`, `Booking_code`, `Arrive`, `Depart`, `Number_nights`, `Occupancy`, `ID_RoomType`, `Quantity`, `Price`, `Booking_Status`) VALUES
('BOK1400001', 'asdas45645', '2014-11-19', '2014-11-21', 4, '2 Adult', 'TYP1400001', '1', '450000', 'Cancel');

-- --------------------------------------------------------

--
-- Table structure for table `booking`
--

CREATE TABLE IF NOT EXISTS `booking` (
  `ID_Booking` char(10) NOT NULL,
  `Booking_code` varchar(10) NOT NULL,
  `Arrive` date NOT NULL,
  `Depart` date NOT NULL,
  `Number_nights` int(11) NOT NULL,
  `Occupancy` varchar(20) NOT NULL,
  `Booking_Status` varchar(50) NOT NULL,
  PRIMARY KEY (`ID_Booking`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`ID_Booking`, `Booking_code`, `Arrive`, `Depart`, `Number_nights`, `Occupancy`, `Booking_Status`) VALUES
('BOK1400001', '8Y4x9s9B6S', '2014-11-19', '2014-11-22', 4, '2 Adult', 'Booked'),
('BOK1400002', '9o7O3F0U9X', '2014-12-05', '2014-12-06', 1, '2 Adult|1 Child', 'Booked'),
('BOK1400003', '3y0f1U7g3j', '2014-12-10', '2014-12-12', 2, '1 Adult|0 Child', 'Booked');

-- --------------------------------------------------------

--
-- Table structure for table `destination`
--

CREATE TABLE IF NOT EXISTS `destination` (
  `ID_Destination` char(10) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Picture` varchar(50) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Latitude` varchar(50) NOT NULL,
  `Longitude` varchar(50) NOT NULL,
  `Status` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_Destination`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `destination`
--

INSERT INTO `destination` (`ID_Destination`, `Name`, `Picture`, `Description`, `Latitude`, `Longitude`, `Status`) VALUES
('DST1400001', 'ITC Mangga Dua', 'itc_thumb.jpg', 'Pusat Perbelanjaan', '-6.135621', '106.824269', 'Active'),
('DST1400002', 'Taman Impian Jaya Ancol', 'ancol_thumb.jpg', 'Tempat bermain anak-anak', '-6.123715', '106.831768', 'Active'),
('DST1400003', 'Gedung Arsip Nasional', 'gedungarsip_thumb.jpg', 'Tempat Arsip', '-6.153759', '106.817001', 'Active'),
('DST1400004', 'Jakarta Landmark', 'monas_thumb.jpg', 'Landmark Jakarta', '-6.175449', '106.827162', 'Active'),
('DST1400005', 'Gereja Katedral', 'katedral_thumb.jpg', 'Gereja Katedral', '-6.169143', '106.833138', 'Active'),
('DST1400006', 'Masjid Istiqlal ', 'istiqlal_thumb.jpg', 'Masjid Istiqlal', '-6.170181', '106.831391', 'Active'),
('DST1400007', 'Kota Tua', 'kotu_thumb.jpg', 'Kota Tua', '-6.134715', '106.813240', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `detail_additional`
--

CREATE TABLE IF NOT EXISTS `detail_additional` (
  `ID_Booking` char(10) NOT NULL,
  `ID_Additional` char(10) NOT NULL,
  `Price` varchar(10) NOT NULL,
  `Quantity` int(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_additional`
--

INSERT INTO `detail_additional` (`ID_Booking`, `ID_Additional`, `Price`, `Quantity`) VALUES
('BOK1400001', 'ADD1400001', '250000', 1),
('BOK1400001', 'ADD1400002', '35000', 1),
('BOK1400002', 'ADD1400001', '250000', 1),
('BOK1400003', 'ADD1400001', '250000', 0),
('BOK1400004', 'ADD1400001', '250000', 0),
('BOK1400003', 'ADD1400001', '250000', 0);

-- --------------------------------------------------------

--
-- Table structure for table `detail_booking`
--

CREATE TABLE IF NOT EXISTS `detail_booking` (
  `ID_Booking` char(10) NOT NULL,
  `ID_RoomType` char(10) NOT NULL,
  `Quantity` int(5) NOT NULL,
  `Price` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_booking`
--

INSERT INTO `detail_booking` (`ID_Booking`, `ID_RoomType`, `Quantity`, `Price`) VALUES
('BOK1400001', 'TYP1400001', 1, '450000'),
('BOK1400002', 'TYP1400001', 2, '450000'),
('BOK1400003', 'TYP1400001', 2, '450000');

-- --------------------------------------------------------

--
-- Table structure for table `detail_offer`
--

CREATE TABLE IF NOT EXISTS `detail_offer` (
  `ID_Offer` char(10) NOT NULL,
  `ID_RoomType` char(10) NOT NULL,
  `Price` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_offer`
--

INSERT INTO `detail_offer` (`ID_Offer`, `ID_RoomType`, `Price`) VALUES
('OFR1400001', 'TYP1400002', '275000'),
('OFR1400002', 'TYP1400002', '175000');

-- --------------------------------------------------------

--
-- Table structure for table `detail_offer_history`
--

CREATE TABLE IF NOT EXISTS `detail_offer_history` (
  `ID_Offer_History` char(10) NOT NULL,
  `ID_Offer` char(10) NOT NULL,
  `ID_RoomType` char(10) NOT NULL,
  `Price` varchar(10) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_offer_history`
--

INSERT INTO `detail_offer_history` (`ID_Offer_History`, `ID_Offer`, `ID_RoomType`, `Price`) VALUES
('OFH1400001', 'OFR1400001', 'TYP1400001', '350000'),
('OFH1400001', 'OFR1400001', 'TYP1400002', '275000'),
('OFH1400002', 'OFR1400001', 'TYP1400002', '275000'),
('OFH1400003', 'OFR1400002', 'TYP1400002', '175000');

-- --------------------------------------------------------

--
-- Table structure for table `events`
--

CREATE TABLE IF NOT EXISTS `events` (
  `ID_Events` char(10) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `File` varchar(50) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `Status` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_Events`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`ID_Events`, `Title`, `File`, `Description`, `Date`, `Time`, `Status`) VALUES
('EVE1400001', 'Happy New Year 2015', 'happy-new-year-2015.jpg', 'Perayaan Pergantian Tahun 2015. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2014-12-31', '21:00:00', 'Active'),
('EVE1400002', 'Coba', '11.JPG', 'Test doang', '2014-11-23', '00:00:00', 'Expired'),
('EVE1400003', 'Candle Light Dinner', 'candlelight.jpg', 'Makan malam yang romantis dihiasi dengan lilin-lilin yang indah.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2014-12-03', '19:00:00', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `events_history`
--

CREATE TABLE IF NOT EXISTS `events_history` (
  `ID_Events_History` char(10) NOT NULL,
  `ID_Events` char(10) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `File` varchar(50) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `ID_User` char(10) NOT NULL,
  `Action` varchar(10) NOT NULL,
  `Created_Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events_history`
--

INSERT INTO `events_history` (`ID_Events_History`, `ID_Events`, `Title`, `File`, `Description`, `Date`, `Time`, `ID_User`, `Action`, `Created_Date`) VALUES
('EVH1400001', 'EVE1400001', 'Happy New Year 2015', 'happy-new-year-2015.jpg', 'Perayaan Pergantian Tahun 2015', '2014-12-31', '21:00:00', 'USR1400001', 'Insert', '2014-11-26 00:00:00'),
('EVH1400002', 'EVE1400002', 'Coba', '11.JPG', 'Test doang', '2014-11-23', '00:00:00', 'USR1400001', 'Insert', '2014-11-23 00:00:00'),
('EVH1400003', 'EVE1400003', 'Candle Light Dinner', 'candlelight.jpg', 'Makan malam yang romantis ', '2014-12-03', '19:00:00', 'USR1400001', 'Insert', '2014-12-01 00:00:00'),
('EVH1400004', 'EVE1400003', 'Candle Light Dinner', 'candlelight.jpg', 'Makan malam yang romantis dihiasi dengan lilin-lilin yang indah', '2014-12-03', '19:00:00', 'USR1400001', 'Update', '2014-12-01 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `extra`
--

CREATE TABLE IF NOT EXISTS `extra` (
  `ID_Extra` char(10) NOT NULL,
  `ID_Booking` char(10) NOT NULL,
  `Arrival_time` time NOT NULL,
  `Flight_detail` varchar(100) NOT NULL,
  `Description` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_Extra`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `extra`
--

INSERT INTO `extra` (`ID_Extra`, `ID_Booking`, `Arrival_time`, `Flight_detail`, `Description`) VALUES
('EXT1400001', 'BOK1400001', '11:00:00', 'Take off jam 09:00, perjalanan 2jam', 'Saya pakai baju kemeja kotak-kotak'),
('EXT1400002', 'BOK1400002', '17:00:00', 'Terbangdari Belitung jam 13.00', 'Syaa pakai baju kotak-kotak'),
('EXT1400003', 'BOK1400003', '00:00:00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

CREATE TABLE IF NOT EXISTS `facility` (
  `ID_Facility` char(10) NOT NULL,
  `Facility_Name` varchar(50) NOT NULL,
  `Picture` varchar(50) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Status` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_Facility`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facility`
--

INSERT INTO `facility` (`ID_Facility`, `Facility_Name`, `Picture`, `Description`, `Status`) VALUES
('FCT1400001', 'Lobby', 'lobby.jpg', 'Receptionist', 'Active'),
('FCT1400002', 'Mini Bar', 'mini_bar.jpg', 'Mini bar', 'Active'),
('FCT1400003', 'Dining Room', 'dining_room.jpg', 'Tempat makan', 'Active'),
('FCT1400004', 'Hall Room', 'hall_room.jpg', 'Hall room', 'Active'),
('FCT1400005', 'Outdoor Smoking Area', 'smoking_area.jpg', 'Tempat rokok', 'Active'),
('FCT1400006', 'CCTV', 'CCTV.png', 'CCTV 24 hours nonstop', 'Delete');

-- --------------------------------------------------------

--
-- Table structure for table `facility_history`
--

CREATE TABLE IF NOT EXISTS `facility_history` (
  `ID_Facility_History` char(10) NOT NULL,
  `ID_Facility` char(10) NOT NULL,
  `Facility_Name` varchar(50) NOT NULL,
  `Picture` varchar(50) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `ID_User` char(10) NOT NULL,
  `Action` varchar(10) NOT NULL,
  `Created_Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facility_history`
--

INSERT INTO `facility_history` (`ID_Facility_History`, `ID_Facility`, `Facility_Name`, `Picture`, `Description`, `ID_User`, `Action`, `Created_Date`) VALUES
('FCH1400001', 'FCT1400001', 'Lobby', 'lobby.jpg', 'Receptionist', 'USR1400001', 'Insert', '2014-11-23 05:16:00'),
('FCH1400002', 'FCT1400002', 'Mini Bar', 'mini_bar.jpg', 'Mini Bar', 'USR1400001', 'Insert', '2014-11-23 05:17:00'),
('FCH1400003', 'FCT1400003', 'Dinning Room', 'dining_room.jpg', 'Tempat makan', 'USR1400001', 'Insert', '2014-11-23 05:19:00'),
('FCH1400004', 'FCT1400004', 'Hall Room', 'hall_room.jpg', 'Hall room', 'USR1400002', 'Insert', '2014-11-23 15:19:00'),
('FCH1400005', 'FCT1400005', 'Outdoor Smoking Area', 'smoking_area.jpg', 'Tempat rokok', 'USR1400002', 'Insert', '2014-11-23 15:19:00'),
('FCH1400006', 'FCT1400006', 'CCTV', 'CCTV.png', 'CCTV 24 hours', 'USR1400001', 'Insert', '2014-12-01 16:24:28'),
('FCH1400007', 'FCT1400006', 'CCTV', 'CCTV.png', 'CCTV 24 hours nonstop', 'USR1400001', 'Update', '2014-12-01 16:39:55'),
('RTH1400006', 'FCT1400006', 'CCTV', 'CCTV.png', 'CCTV 24 hours nonstop', 'USR1400001', 'Delete', '2014-12-01 16:43:18');

-- --------------------------------------------------------

--
-- Table structure for table `faq`
--

CREATE TABLE IF NOT EXISTS `faq` (
  `ID_FAQ` char(10) NOT NULL,
  `Question` varchar(100) NOT NULL,
  `Answer` varchar(100) NOT NULL,
  `Date` datetime NOT NULL,
  `Status` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_FAQ`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `faq`
--

INSERT INTO `faq` (`ID_FAQ`, `Question`, `Answer`, `Date`, `Status`) VALUES
('FAQ1400001', 'Are bed linens provided?', 'Yes, all the beds come with a full set of linen (bed sheet, duvet & pillows)', '2014-11-20 18:10:24', 'Active'),
('FAQ1400002', 'Are all rooms air-conditioned?', 'Yes, all rooms is full of air-conditioned', '2014-11-26 22:06:37', 'Active'),
('FAQ1400003', 'Are there any power outlets in the room?', 'Yes, power outlets are available in the room', '2014-11-26 22:06:48', 'Active'),
('FAQ1400004', 'Can I change my room type upon check-in?', 'Yes you can, subject to room availability and rate of the day', '2014-11-26 22:07:34', 'Active'),
('FAQ1400005', 'Can I smoke in the hotelâ€™s room?', 'No, you are not permitted to smoke in the room, but you are able to smoke at the restaurant area.\r\n', '2014-11-26 22:07:48', 'Active'),
('FAQ1400006', 'Are the rooms equipped with telephone, TV, mini bar, and water kettle?', 'All rooms have telephone and LCD TV. However, there are no mini bar. Hot water is available upon req', '2014-11-26 22:08:01', 'Active'),
('FAQ1400007', 'Do the rooms have windows?', 'Yes, all rooms have windows', '2014-11-26 22:08:13', 'Active'),
('FAQ1400008', 'What is the check-in time?', '14:00 hr', '2014-11-26 22:08:26', 'Active'),
('FAQ1400009', 'What is the check-out time?', '12:00 hr', '2014-11-26 22:08:39', 'Active'),
('FAQ1400010', 'What is the cancellation policy?', 'Please read our Cancellation Policy for details', '2014-11-26 22:08:51', 'Active'),
('FAQ1400011', 'Is breakfast inclusive in your price?', 'You could choose to have breakfast or not by booking directly on our website www.everydaysmarthotels', '2014-11-26 22:09:03', 'Active'),
('FAQ1400012', 'Does the room have Internet connection?', 'Yes, complimentary Wi-Fi is available for our guests', '2014-11-26 22:09:17', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE IF NOT EXISTS `feedback` (
  `ID_Feedback` char(10) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Subject` varchar(50) NOT NULL,
  `Message` varchar(100) NOT NULL,
  `Date` datetime NOT NULL,
  `Status` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_Feedback`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `feedback`
--

INSERT INTO `feedback` (`ID_Feedback`, `Name`, `Email`, `Subject`, `Message`, `Date`, `Status`) VALUES
('FED1400001', 'Fery', 'feryfery@yahoo.com', 'Service', 'mantapp benerr servicenya, recommended!!', '2014-11-01 08:30:03', 'Confirm'),
('FED1400002', 'Willy', 'willy_fer@gmail.com', 'View', 'kerennn tempatnya', '2014-11-03 01:32:08', 'Confirm'),
('FED1400003', 'Wendra', 'wendra@gmail.com', 'sadasdsa', 'HEIIII!!!!!!!!!!!!!!!!!!!!!', '2014-11-05 15:05:27', 'Reject'),
('FED1400004', 'Witono', 'wi_tono@yahoo.com', 'zzz', 'Prettt', '2014-11-06 19:08:28', 'Reject'),
('FED1400005', 'Erlina', 'erlinaindra@yahoo.com', 'Service', 'Mantapp', '2014-12-04 01:31:20', 'Confirm'),
('FED1400006', 'Gus', 'gus.gus@gmail.com', 'Service', 'Pelayanannya ramah', '2014-12-08 14:44:16', 'Confirm'),
('FED1400007', 'Jane', 'janerobinson@yahoo.com', 'Website', 'Interesting', '2014-12-08 14:47:21', 'Confirm'),
('FED1400008', 'Dude', 'dude.08123@yahoo.com', 'Website', 'Menarik sekali', '2014-12-08 14:49:44', 'Confirm');

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE IF NOT EXISTS `guest` (
  `ID_Guest` char(10) NOT NULL,
  `ID_Booking` char(10) NOT NULL,
  `First_name` varchar(30) NOT NULL,
  `Last_name` varchar(30) NOT NULL,
  `No_identity` varchar(30) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Telephone` varchar(20) NOT NULL,
  `Address` varchar(300) NOT NULL,
  `Country` varchar(50) NOT NULL,
  `City` varchar(50) NOT NULL,
  `State` varchar(50) NOT NULL,
  `Post_code` varchar(30) NOT NULL,
  PRIMARY KEY (`ID_Guest`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`ID_Guest`, `ID_Booking`, `First_name`, `Last_name`, `No_identity`, `Email`, `Telephone`, `Address`, `Country`, `City`, `State`, `Post_code`) VALUES
('GUE1400001', 'BOK1400001', 'Dedy', 'Cewadi', '1982252658525', 'dedy@yahoo.com', '1498145', 'Jalan Keluarga', 'Indonesia', 'Jakarta', 'DKI Jakarta', '11480'),
('GUE1400002', 'BOK1400002', 'Erlina', 'Indra', '123123123', 'erlina.indra@rocketmail.com', '081231823813', 'Jalan k.h Syahdan|Jalan Keluarga', 'Indonesia', 'Jakarta', 'Jakarta Barat', '11480'),
('GUE1400003', 'BOK1400003', 'asdasdas', 'dasdasdsad', '12312312321', 'asdasd.asdsa@hasjd.cosad', '123123123', 'asdasdasdasd|', 'sdasdasdasdas', 'asdasdsadasdasd', 'asdasdasda', '123123213');

-- --------------------------------------------------------

--
-- Table structure for table `news`
--

CREATE TABLE IF NOT EXISTS `news` (
  `ID_News` char(10) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `File` varchar(50) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Date` datetime NOT NULL,
  `Status` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_News`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`ID_News`, `Title`, `File`, `Description`, `Date`, `Status`) VALUES
('NEW1400001', 'Grand Opening Everyday Smart Hotel Jakarta', 'grandopening3.png', 'Telah dibuka Everyday Smart Hotel di Jakarta oleh Deny Setiawan. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2014-11-21 18:38:27', 'Active'),
('NEW1400002', 'Kegiatan Sosial', 'sosial.jpg', 'Pembagian sembako dilakukan oleh HM Everyday Smart Hotel di Pondok Pesantren Indah. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2014-12-01 16:59:03', 'ACtive');

-- --------------------------------------------------------

--
-- Table structure for table `newsletter`
--

CREATE TABLE IF NOT EXISTS `newsletter` (
  `ID_Newsletter` char(10) NOT NULL,
  `First_Name` varchar(50) NOT NULL,
  `Last_Name` varchar(50) NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Date` datetime NOT NULL,
  `Status` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_Newsletter`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`ID_Newsletter`, `First_Name`, `Last_Name`, `Email`, `Date`, `Status`) VALUES
('NEW1400001', 'Albert', 'Pratama', 'albert_p@yahoo.com', '2014-11-13 13:10:39', 'Confirm'),
('NEW1400002', 'Patrick', '', 'patrick17@gmail.com', '2014-11-14 23:13:30', 'Confirm'),
('NEW1400003', 'asdasdasd', 'asdasdasd', 'jasd@jmaoisd.asodoa', '2014-11-20 05:39:07', 'Reject'),
('NEW1400004', 'Erlina', 'Indra', 'erlina.indra@rocketmail.com', '2014-12-04 01:31:43', 'Confirm');

-- --------------------------------------------------------

--
-- Table structure for table `news_history`
--

CREATE TABLE IF NOT EXISTS `news_history` (
  `ID_News_history` char(10) NOT NULL,
  `ID_News` char(10) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `File` varchar(50) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `ID_User` char(10) NOT NULL,
  `Action` varchar(10) NOT NULL,
  `Created_Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news_history`
--

INSERT INTO `news_history` (`ID_News_history`, `ID_News`, `Title`, `File`, `Description`, `ID_User`, `Action`, `Created_Date`) VALUES
('NWH1400001', 'NEW1400001', 'Grand Opening Everyday Smart Hotel Jakarta', 'grandopening3.png', 'Telah dibuka Everyday Smart Hotel di Jakarta oleh Deny Setiawan', 'USR1400001', 'Insert', '2010-12-17 08:48:16'),
('NWH1400002', 'NEW1400002', 'Kegiatan Sosial', 'sosial.jpg', 'Pembagian sembako dilakukan oleh HM Everyday Smart Hotel ', 'USR1400001', 'Insert', '2014-12-01 16:59:03'),
('NWH1400003', 'NEW1400002', 'Kegiatan Sosial', 'sosial.jpg', 'Pembagian sembako dilakukan oleh HM Everyday Smart Hotel di Pondok Pesantren Indah', 'USR1400003', 'Update', '2014-12-01 17:49:09');

-- --------------------------------------------------------

--
-- Table structure for table `offer`
--

CREATE TABLE IF NOT EXISTS `offer` (
  `ID_Offer` char(10) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `File` varchar(50) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `From_Date` date NOT NULL,
  `Until_Date` date NOT NULL,
  `Status` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_Offer`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`ID_Offer`, `Title`, `File`, `Description`, `From_Date`, `Until_Date`, `Status`) VALUES
('OFR1400001', 'Promo Tahun Baru', 'deluxe.jpg', 'Diskon 100rb/room', '2014-12-05', '2014-12-07', 'Active'),
('OFR1400002', 'Promo Superior Room ', 'superior.jpg', 'Diskon Superior Room Besar-Besaran buat Tahun Baru', '2014-12-31', '2014-12-31', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `offer_history`
--

CREATE TABLE IF NOT EXISTS `offer_history` (
  `ID_Offer_History` char(10) NOT NULL,
  `ID_Offer` char(10) NOT NULL,
  `Title` varchar(50) NOT NULL,
  `File` varchar(50) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `From_Date` date NOT NULL,
  `Until_Date` date NOT NULL,
  `ID_User` char(10) NOT NULL,
  `Action` varchar(10) NOT NULL,
  `Created_Date` datetime NOT NULL,
  PRIMARY KEY (`ID_Offer_History`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offer_history`
--

INSERT INTO `offer_history` (`ID_Offer_History`, `ID_Offer`, `Title`, `File`, `Description`, `From_Date`, `Until_Date`, `ID_User`, `Action`, `Created_Date`) VALUES
('OFH1400001', 'OFR1400001', 'Promo Tahun Baru', 'deluxe.jpg', 'Diskon 100rb/kamar', '2014-12-05', '2014-12-06', 'USR1400001', 'Insert', '2014-12-03 02:46:45'),
('OFH1400002', 'OFR1400001', 'Promo Tahun Baru', 'deluxe.jpg', 'Diskon 100rb/room', '2014-12-05', '2014-12-07', 'USR1400003', 'Update', '2014-12-03 02:51:41'),
('OFH1400003', 'OFR1400002', 'Promo Superior Room ', 'superior.jpg', 'Diskon Superior Room Besar-Besaran buat Tahun Baru', '2014-12-31', '2014-12-31', 'USR1400003', 'Insert', '2014-12-03 03:31:03');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `ID_Payment` char(10) NOT NULL,
  `ID_Booking` char(10) NOT NULL,
  `Credit_Type` varchar(20) NOT NULL,
  `Credit_Number` varchar(20) NOT NULL,
  `Credit_CVV` varchar(5) NOT NULL,
  `Credit_Name` varchar(50) NOT NULL,
  `Credit_Expiry` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_Payment`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`ID_Payment`, `ID_Booking`, `Credit_Type`, `Credit_Number`, `Credit_CVV`, `Credit_Name`, `Credit_Expiry`) VALUES
('PAY1400001', 'BOK1400001', 'Visa', '881954599555', '45645', 'Jhonny', '12/2017'),
('PAY1400002', 'BOK1400002', 'Visa', '4024007103572482', '123', 'Erlina Indra', '10/2020'),
('PAY1400003', 'BOK1400003', 'Visa', '4024007103572482', '123', 'aSASDASD', '1/2014');

-- --------------------------------------------------------

--
-- Table structure for table `roomtype`
--

CREATE TABLE IF NOT EXISTS `roomtype` (
  `ID_RoomType` char(10) NOT NULL,
  `RoomType_Name` varchar(50) NOT NULL,
  `Picture` varchar(50) NOT NULL,
  `Price` int(10) NOT NULL,
  `Capacity` int(10) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Facility` varchar(1000) NOT NULL,
  `Status` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_RoomType`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roomtype`
--

INSERT INTO `roomtype` (`ID_RoomType`, `RoomType_Name`, `Picture`, `Price`, `Capacity`, `Description`, `Facility`, `Status`) VALUES
('TYP1400001', 'Smart Deluxe', 'deluxe.jpg', 450000, 9, 'Street View ', '1 Double Bed or 2 Single Bed With Quality Mattres|32" LCD TV With Multiple Channel|Quality Breakfast|Safe Deposit Box|Full Air Conditioner|Wake Up Call Available|Coffee Maker|Laundry and Dry Cleaning Services|Free Wifi Lobby and Room|Hairdryer and Voltage Converter|24 Hours Room Service', 'Active'),
('TYP1400002', 'Smart Superior', 'superior.jpg', 375000, 84, 'Mountain View', '1 Double Bed or 2 Single Bed With Quality Mattres|22" LCD TV With Multiple Channel|Quality Breakfast|Safe Deposit Box|Full Air Conditioner|Wake Up Call Available|Laundry and Dry Cleaning Services|Free Wifi Lobby and Room|Hairdryer and Voltage Converter|24 Hours Room Service', 'Active'),
('TYP1400003', 'VVIP', 'keren.jpg', 299000, 2, 'Street View and Mountain View', '1 Double Bed or 2 Single Bed With Quality Mattres|30" LCD TV With Multiple Channel|Quality Breakfast|Safe Deposit Box|Full Air Conditioner', 'Delete');

-- --------------------------------------------------------

--
-- Table structure for table `roomtype_history`
--

CREATE TABLE IF NOT EXISTS `roomtype_history` (
  `ID_RoomType_History` char(10) NOT NULL,
  `ID_RoomType` char(10) NOT NULL,
  `RoomType_Name` varchar(50) NOT NULL,
  `Picture` varchar(50) NOT NULL,
  `Price` int(10) NOT NULL,
  `Capacity` int(10) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Facility` varchar(1000) NOT NULL,
  `ID_User` char(10) NOT NULL,
  `Action` varchar(10) NOT NULL,
  `Created_Date` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roomtype_history`
--

INSERT INTO `roomtype_history` (`ID_RoomType_History`, `ID_RoomType`, `RoomType_Name`, `Picture`, `Price`, `Capacity`, `Description`, `Facility`, `ID_User`, `Action`, `Created_Date`) VALUES
('RTH1400001', 'TYP1400001', 'Smart Deluxe', 'deluxe.jpg', 450000, 9, 'Street View ', '1 Double Bed or 2 Single Bed With Quality Mattres|32" LCD TV With Multiple Channel|Quality Breakfast|Safe Deposit Box|Full Air Conditioner|Wake Up Call Available|Coffee Maker|Laundry and Dry Cleaning Services|Free Wifi Lobby and Room|Hairdryer and Voltage Converter|24 Hours Room Service', 'USR1400001', 'Insert', '2014-10-25 15:34:27'),
('RTH1400002', 'TYP1400002', 'Smart Superior', 'superior.jpg', 375000, 84, 'Mountain View', '1 Double Bed or 2 Single Bed With Quality Mattres|22" LCD TV With Multiple Channel|Quality Breakfast|Safe Deposit Box|Full Air Conditioner|Wake Up Call Available|Laundry and Dry Cleaning Services|Free Wifi Lobby and Room|Hairdryer and Voltage Converter|24 Hours Room Service', 'USR1400001', 'Insert', '2014-10-25 20:53:53'),
('RTH1400003', 'TYP1400003', 'VVIP', 'keren.jpg', 299000, 2, 'Street View', '1 Double Bed or 2 Single Bed With Quality Mattres|30" LCD TV With Multiple Channel|Quality Breakfast|Safe Deposit Box|Full Air Conditioner', 'USR1400001', 'Insert', '2014-11-29 18:51:49'),
('RTH1400004', 'TYP1400003', 'VVIP', 'keren.jpg', 299000, 2, 'Street View and Mountain View', '1 Double Bed or 2 Single Bed With Quality Mattres|30" LCD TV With Multiple Channel|Quality Breakfast|Safe Deposit Box|Full Air Conditioner', 'USR1400001', 'Update', '2014-11-29 19:10:46'),
('RTH1400005', 'TYP1400003', 'VVIP', 'keren.jpg', 299000, 2, 'Street View and Mountain View', '1 Double Bed or 2 Single Bed With Quality Mattres|30" LCD TV With Multiple Channel|Quality Breakfast|Safe Deposit Box|Full Air Conditioner', 'USR1400001', 'Delete', '2014-11-29 19:22:31');

-- --------------------------------------------------------

--
-- Table structure for table `tax`
--

CREATE TABLE IF NOT EXISTS `tax` (
  `ID_Tax` char(10) NOT NULL,
  `Tax_Name` varchar(50) NOT NULL,
  `Tax` varchar(10) NOT NULL,
  `Status` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_Tax`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tax`
--

INSERT INTO `tax` (`ID_Tax`, `Tax_Name`, `Tax`, `Status`) VALUES
('TAX1400001', 'Goverment Charges', '0.11', 'Active'),
('TAX1400002', 'Service Chages', '0.1', 'Active'),
('TAX1400003', 'Hotel Charges', '0.13', 'Delete');

-- --------------------------------------------------------

--
-- Table structure for table `tax_history`
--

CREATE TABLE IF NOT EXISTS `tax_history` (
  `ID_Tax_History` char(10) NOT NULL,
  `ID_Tax` char(10) NOT NULL,
  `Tax_Name` varchar(50) NOT NULL,
  `Tax` varchar(10) NOT NULL,
  `ID_User` char(10) NOT NULL,
  `Action` varchar(10) NOT NULL,
  `Created_Date` datetime NOT NULL,
  PRIMARY KEY (`ID_Tax_History`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tax_history`
--

INSERT INTO `tax_history` (`ID_Tax_History`, `ID_Tax`, `Tax_Name`, `Tax`, `ID_User`, `Action`, `Created_Date`) VALUES
('TXH1400001', 'TAX1400001', 'Room Charges', '0.11', 'USR1400001', 'Insert', '2014-11-20 10:31:28'),
('TXH1400002', 'TAX1400002', 'Service Charges', '0.1', 'USR1400001', 'Insert', '2014-11-20 10:32:24'),
('TXH1400003', 'TAX1400003', 'Hotel Charges', '0.15', 'USR1400001', 'Insert', '2014-11-29 20:06:28'),
('TXH1400004', 'TAX1400003', 'Hotel Charges', '0.13', 'USR1400001', 'Update', '2014-11-29 20:06:37'),
('TXH1400005', 'TAX1400003', 'Hotel Charges', '0.13', 'USR1400001', 'Delete', '2014-11-29 20:08:00'),
('TXH1400006', 'TAX1400001', 'Goverment Charges', '0.11', 'USR1400001', 'Update', '2014-12-01 23:44:07');

-- --------------------------------------------------------

--
-- Table structure for table `user`
--

CREATE TABLE IF NOT EXISTS `user` (
  `ID_User` char(10) NOT NULL,
  `Role` varchar(10) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `DOB` date NOT NULL,
  `Email` varchar(50) NOT NULL,
  `Status` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_User`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_User`, `Role`, `Username`, `Password`, `Name`, `DOB`, `Email`, `Status`) VALUES
('USR1400001', 'Admin', 'rendy', 'akhiong', 'Rendy Arsanto', '1993-08-01', 'rendymochi@yahoo.com', 'Active'),
('USR1400002', 'Admin', 'deny', 'deny123', 'Deny Setiawan', '1993-05-05', 'denysetiawan@gmail.com', 'Active'),
('USR1400003', 'Staff', 'jeanni', 'jeanni', 'Jeanni Susindra', '1993-01-23', 'jeannisusindra@yahoo.com', 'Active'),
('USR1400004', 'Staff', 'jason', 'jason', 'Jason Setiadarma', '1993-10-01', 'jasonsetiadarma@yahoo.com', 'Active'),
('USR1400005', 'Admin', 'erlina', 'erlina', 'Erlina Indra', '1993-09-06', 'erlina.indra@rocketmail.com', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `user_history`
--

CREATE TABLE IF NOT EXISTS `user_history` (
  `ID_User_History` char(10) NOT NULL,
  `ID_User` char(10) NOT NULL,
  `Role` varchar(10) NOT NULL,
  `Username` varchar(50) NOT NULL,
  `Password` varchar(50) NOT NULL,
  `Name` varchar(50) NOT NULL,
  `DOB` date NOT NULL,
  `Email` varchar(50) NOT NULL,
  `ID_Login` char(10) NOT NULL,
  `Action` varchar(10) NOT NULL,
  `Created_Date` datetime NOT NULL,
  PRIMARY KEY (`ID_User_History`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user_history`
--

INSERT INTO `user_history` (`ID_User_History`, `ID_User`, `Role`, `Username`, `Password`, `Name`, `DOB`, `Email`, `ID_Login`, `Action`, `Created_Date`) VALUES
('USH1400001', 'USR1400001', 'Admin', 'rendy', 'akhiong', 'Rendy Arsanto', '1993-08-01', 'rendymochi@yahoo.com', '', 'Insert', '2014-10-23 03:41:08'),
('USH1400002', 'USR1400002', 'Admin', 'deny', 'deny123', 'Deny Setiawan', '1993-05-05', 'denysetiawan@gmail.com', '', 'Insert', '2014-10-24 05:10:27'),
('USH1400003', 'USR1400003', 'Staff', 'jeanni', 'jeanni', 'Jeanni', '1993-01-23', 'jeanni@yahoo.com', '', 'Insert', '2014-10-24 16:21:44'),
('USH1400004', 'USR1400004', 'Staff', 'jason', 'jason', 'Jason Setiadarma', '1993-10-01', 'jasonsetiadarma@yahoo.com', '', 'Insert', '2014-10-25 13:22:31'),
('USH1400005', 'USR1400005', 'Admin', 'erlina', 'erlina', 'Erlina Indra', '1993-09-06', 'erlina.indra@rocketmail.com', '', 'Insert', '2014-10-26 08:52:43');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
