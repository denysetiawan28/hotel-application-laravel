-- phpMyAdmin SQL Dump
-- version 4.0.10.7
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Mar 22, 2015 at 10:00 PM
-- Server version: 5.5.42-cll
-- PHP Version: 5.4.23

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `protohot_everyday`
--

-- --------------------------------------------------------

--
-- Table structure for table `aboutus`
--

CREATE TABLE IF NOT EXISTS `aboutus` (
  `ID_Aboutus` int(11) NOT NULL DEFAULT '1',
  `Logo` varchar(100) NOT NULL,
  `Name` varchar(50) NOT NULL,
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
  `AboutUsPic` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_Aboutus`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `aboutus`
--

INSERT INTO `aboutus` (`ID_Aboutus`, `Logo`, `Name`, `Address`, `Telephone`, `Email`, `About`, `Concept`, `Vision`, `Mision`, `Latitude`, `Longitude`, `Link_Web`, `Link_Book`, `AboutUsPic`) VALUES
(1, 'logonew.png', 'Everyday Smart Hotel', 'Jl. Mangga Besar Raya No.20\r\nJakarta - Indonesia', '0216006688', 'everydaysmarthotel@yahoo.com', 'Brought to you by Goodwood Asia Hospitality Management, Everyday Smart Hotel are their first entry into the budget hotel sector. Offering exceptional value, you will find Everyday Smart Hotel in great city centre locations around the cities and we are growing all the time. Prides itself on the high levels of lodging offered, we have everything for the visitor requiring Bed and Breakfast in modern, clean, and spotless surroundings that you will find in urban and city centre locations, close to all the services, amenities and attractions that you need to make the most of your trip.', 'Budget hotels with smart, cool, and stylish rooms,|Luxurious amenities such as Romance/ King Koil Spring Bed, GROHE and TOTO for bathroom elements, LCD TV, and local and international channels,|Close to city centers and places of interests.', 'Our Vision is to be Recognised as unique in the industry for fulfilling our promises "Where guests become friends"', 'Our missions is to provide you a smart way to spend your holiday with comfort and excellent service', '-6.150040', '106.818952', 'http://protohotel.asia', 'http://protohotel.asia/books', 'bali1-480x300.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `additional`
--

CREATE TABLE IF NOT EXISTS `additional` (
  `ID_Additional` char(10) NOT NULL DEFAULT '',
  `Additional_Name` varchar(50) NOT NULL,
  `Price` varchar(10) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `Status` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_Additional`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `additional`
--

INSERT INTO `additional` (`ID_Additional`, `Additional_Name`, `Price`, `Description`, `Quantity`, `Status`) VALUES
('ADD1400001', 'Airport Transfer', '250000', 'Our driver will meet you at the airport upon arrival and drive you to our hotel in a fully air-conditioner', 5, 'Active'),
('ADD1400002', 'Breakfast', '35000', 'breakfast ', 3, 'Active'),
('ADD1500001', 'asdasd', '123', 'zzzzzzzzz', 2, 'Delete');

-- --------------------------------------------------------

--
-- Table structure for table `additional_history`
--

CREATE TABLE IF NOT EXISTS `additional_history` (
  `ID_Additional_History` char(10) NOT NULL,
  `ID_Additional` char(10) NOT NULL,
  `Additional_Name` varchar(50) NOT NULL,
  `Price` varchar(10) NOT NULL,
  `Description` varchar(500) NOT NULL,
  `Quantity` int(11) NOT NULL,
  `ID_User` char(10) NOT NULL,
  `Action` varchar(10) NOT NULL,
  `Created_Date` datetime NOT NULL,
  PRIMARY KEY (`ID_Additional_History`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `additional_history`
--

INSERT INTO `additional_history` (`ID_Additional_History`, `ID_Additional`, `Additional_Name`, `Price`, `Description`, `Quantity`, `ID_User`, `Action`, `Created_Date`) VALUES
('ADH1400001', 'ADD1400001', 'Airport Transfer', '250000', 'Our driver will meet you at the airport upon arrival and drive you to our hotel in a fully air-conditioner', 5, 'USR1400001', 'Insert', '2014-12-09 06:17:29'),
('ADH1400002', 'ADD1400002', 'Breakfast', '35000', 'breakfast ', 3, 'USR1400001', 'Insert', '2015-01-09 07:15:10'),
('ADH1500007', 'ADD1500001', 'asdasd', '123', 'zzzzzzzzz', 1, 'USR1400001', 'Update', '2015-02-03 16:17:59'),
('ADH1500001', 'ADD1500001', 'asdasd', '123', 'asdsad', 2, 'USR1400001', 'Insert', '2015-02-03 16:17:43'),
('ADH1500008', 'ADD1500001', 'asdasd', '123', 'zzzzzzzzz', 2, 'USR1400001', 'Delete', '2015-02-03 16:19:23');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `booking`
--

INSERT INTO `booking` (`ID_Booking`, `Booking_code`, `Arrive`, `Depart`, `Number_nights`, `Occupancy`, `Booking_Status`) VALUES
('BOK1400001', '8Y4x9s9B6S', '2014-11-19', '2014-11-22', 4, '2 Adult', 'Approve'),
('BOK1400002', '9o7O3F0U9X', '2014-12-05', '2014-12-06', 1, '2 Adult|1 Child', 'Cancel'),
('BOK1400003', '3y0f1U7g3j', '2014-12-10', '2014-12-12', 2, '1 Adult|0 Child', 'Approve'),
('BOK1400004', '7O0n0N4S8k', '2014-12-16', '2014-12-20', 4, '1 Adult|0 Child', 'Approve'),
('BOK1400005', '0m4x1s1q5W', '2014-12-19', '2014-12-27', 8, '1 Adult|0 Child', 'Booked'),
('BOK1500001', 'BOK1400006', '0000-00-00', '0000-00-00', 1, '1 | 0', 'Booked'),
('BOK1500002', 'BOK1500002', '2015-01-24', '2015-01-25', 1, '1 | 0', 'Booked'),
('BOK1500003', 'BOK1500003', '2015-01-24', '2015-01-31', 7, '2 | 1', 'Approve'),
('BOK1500004', 'BOK1500004', '2015-01-24', '2015-01-25', 1, '1 | 0', 'Approve'),
('BOK1500005', 'BOK1500005', '2015-01-27', '2015-01-28', 1, '1 | 0', 'Approve'),
('BOK1500006', 'BOK1500006', '2015-01-27', '2015-01-28', 1, '1 | 0', 'Cancel'),
('BOK1500007', '3o0d1R8Z8z', '2015-01-27', '2015-01-28', 1, '1 | 0', 'Cancel'),
('BOK1500008', '9k8E0a5i9d', '2015-01-27', '2015-01-28', 1, '1 | 0', 'Approve'),
('BOK1500009', '3B3Q3S4q7t', '2015-01-27', '2015-01-28', 1, '1 | 0', 'Approve'),
('BOK1500010', '1b8g7L7C4D', '2015-01-27', '2015-01-28', 1, '1 | 0', 'Approve'),
('BOK1500011', '1O4v3o1N4X', '2015-01-27', '2015-01-28', 1, '2 | 1', 'Booked'),
('BOK1500012', '5m6Q9u5z4R', '2015-01-27', '2015-01-28', 1, '2 | 1', 'Booked'),
('BOK1500013', '7S3k7K5N6B', '2015-02-14', '2015-02-15', 1, '2 Adult | 0 Child', 'Booked'),
('BOK1500014', '8e2U0S6b8H', '2015-02-14', '2015-02-15', 1, '2 Adult | 0 Child', 'Booked');

-- --------------------------------------------------------

--
-- Table structure for table `currency`
--

CREATE TABLE IF NOT EXISTS `currency` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `symbol_left` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `symbol_right` varchar(12) COLLATE utf8_unicode_ci NOT NULL,
  `code` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `decimal_place` int(11) NOT NULL,
  `value` double(15,8) NOT NULL,
  `decimal_point` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `thousand_point` varchar(3) COLLATE utf8_unicode_ci NOT NULL,
  `status` int(11) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=22 ;

--
-- Dumping data for table `currency`
--

INSERT INTO `currency` (`id`, `title`, `symbol_left`, `symbol_right`, `code`, `decimal_place`, `value`, `decimal_point`, `thousand_point`, `status`, `created_at`, `updated_at`) VALUES
(1, 'U.S. Dollar', '$', '', 'USD', 2, 1.00000000, '.', ',', 1, '2013-11-29 12:51:38', '2014-12-26 13:31:52'),
(2, 'Euro', '€', '', 'EUR', 2, 0.82130000, '.', ',', 1, '2013-11-29 12:51:38', '2014-12-26 13:31:52'),
(3, 'Pound Sterling', '£', '', 'GBP', 2, 0.64280000, '.', ',', 1, '2013-11-29 12:51:38', '2014-12-26 13:31:52'),
(4, 'Australian Dollar', '$', '', 'AUD', 2, 1.23210000, '.', ',', 1, '2013-11-29 12:51:38', '2014-12-26 13:31:52'),
(5, 'Canadian Dollar', '$', '', 'CAD', 2, 1.16240000, '.', ',', 1, '2013-11-29 12:51:38', '2014-12-26 13:31:52'),
(6, 'Czech Koruna', '', 'Kč', 'CZK', 2, 22.82100000, '.', ',', 1, '2013-11-29 12:51:38', '2014-12-26 13:31:52'),
(7, 'Danish Krone', 'kr', '', 'DKK', 2, 6.11000000, '.', ',', 1, '2013-11-29 12:51:38', '2014-12-26 13:31:52'),
(8, 'Hong Kong Dollar', '$', '', 'HKD', 2, 7.76140000, '.', ',', 1, '2013-11-29 12:51:38', '2014-12-26 13:31:52'),
(9, 'Hungarian Forint', 'Ft', '', 'HUF', 2, 260.64000000, '.', ',', 1, '2013-11-29 12:51:38', '2014-12-26 13:31:53'),
(10, 'Israeli New Sheqel', '?', '', 'ILS', 2, 3.91600000, '.', ',', 1, '2013-11-29 12:51:38', '2014-12-26 13:31:53'),
(11, 'Japanese Yen', '¥', '', 'JPY', 2, 120.39000000, '.', ',', 1, '2013-11-29 12:51:38', '2014-12-26 13:31:53'),
(12, 'Mexican Peso', '$', '', 'MXN', 2, 14.70800000, '.', ',', 1, '2013-11-29 12:51:38', '2014-12-26 13:31:53'),
(13, 'Norwegian Krone', 'kr', '', 'NOK', 2, 7.47310000, '.', ',', 1, '2013-11-29 12:51:38', '2014-12-26 13:31:53'),
(14, 'New Zealand Dollar', '$', '', 'NZD', 2, 1.28910000, '.', ',', 1, '2013-11-29 12:51:38', '2014-12-26 13:31:53'),
(15, 'Philippine Peso', 'Php', '', 'PHP', 2, 44.70000000, '.', ',', 1, '2013-11-29 12:51:38', '2014-12-26 13:31:53'),
(16, 'Polish Zloty', '', 'zł', 'PLN', 2, 3.59450000, '.', ',', 1, '2013-11-29 12:51:38', '2014-12-26 13:31:53'),
(17, 'Singapore Dollar', '$', '', 'SGD', 2, 1.32420000, '.', ',', 1, '2013-11-29 12:51:38', '2014-12-26 13:31:53'),
(18, 'Swedish Krona', 'kr', '', 'SEK', 2, 7.85140000, '.', ',', 1, '2013-11-29 12:51:38', '2014-12-26 13:31:53'),
(19, 'Swiss Franc', 'CHF', '', 'CHF', 2, 0.98760000, '.', ',', 1, '2013-11-29 12:51:38', '2014-12-26 13:31:53'),
(20, 'Taiwan New Dollar', 'NT$', '', 'TWD', 2, 31.72800000, '.', ',', 1, '2013-11-29 12:51:38', '2014-12-26 13:31:53'),
(21, 'Thai Baht', '฿', '', 'THB', 2, 32.94300000, '.', ',', 1, '2013-11-29 12:51:38', '2014-12-26 13:31:53');

-- --------------------------------------------------------

--
-- Table structure for table `destination`
--

CREATE TABLE IF NOT EXISTS `destination` (
  `ID_Destination` int(10) NOT NULL AUTO_INCREMENT,
  `Dest_Name` varchar(50) NOT NULL,
  `Dest_Picture` varchar(100) NOT NULL,
  `Dest_Description` text NOT NULL,
  `Dest_Telp` varchar(20) NOT NULL,
  `Dest_Email` varchar(100) NOT NULL DEFAULT '-',
  `Latitude` varchar(50) NOT NULL,
  `Longitude` varchar(50) NOT NULL,
  `Web_Link` varchar(100) NOT NULL DEFAULT '-',
  `Status` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_Destination`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=29 ;

--
-- Dumping data for table `destination`
--

INSERT INTO `destination` (`ID_Destination`, `Dest_Name`, `Dest_Picture`, `Dest_Description`, `Dest_Telp`, `Dest_Email`, `Latitude`, `Longitude`, `Web_Link`, `Status`) VALUES
(1, 'ITC Mangga Dua', 'itc.jpg', 'Pusat Perbelanjaan', '021123456', 'itc@yahoo.com', '-6.135621', '106.824269', 'www.itcmanggadua.com', 'Active'),
(2, 'Taman Impian Jaya Ancol', 'ancol.jpg', 'Tempat bermain anak-anak', '021234567', 'ancol@yahoo.com', '-6.123715', '106.831768', 'www.ancol.com', 'Active'),
(3, 'Gedung Arsip Nasional', 'gedungarsip.jpg', 'Tempat Arsip', '021345678', 'gedungarsip@yahoo.com', '-6.153759', '106.817001', 'www.gedungarsipnasional.com', 'Active'),
(4, 'Jakarta Landmark', 'monas.jpg', 'Landmark Jakarta', '021456789', 'monas@yahoo.com', '-6.175449', '106.827162', 'www.monas.com', 'Active'),
(5, 'Gereja Katedral', 'katedral.jpg', 'Gereja Katedral', '021567890', '-', '-6.169143', '106.833138', '-', 'Active'),
(6, 'Masjid Istiqlal ', 'istiqlal.jpg', 'Masjid Istiqlal', '021678901', '-', '-6.170181', '106.831391', '-', 'Active'),
(7, 'Kota Tua', 'kotatua.jpg', 'Kota Tua', '0217890121', 'kotatua@yahoo.com', '-6.134715', '106.813240', 'www.kota_tua.com', 'Active'),
(21, 'hjghj', '3.jpg', 'hjgh', '54245', 'Irhamsiblademan@yahoo.com', '-6.149782', '106.820884', 'http://weblink.com', 'Active'),
(13, 'Irhamsi', 'dada', 'catdog12', '0815136', 'irhamsiblademan@yahoo.com', '222222', '1111111111', 'http://dskajdas.com', 'Active'),
(14, 'wendy', 'gambar.jpg', 'deskripsi', 'telepon', 'email@email.com', '1231323', '1233334', 'http://dsada.com', 'Active'),
(15, 'wendy oaa', 'gambar.jpg', 'deskripsi', 'telepon', 'email@email.com', '1231323', '1233334', 'http://dsada.com', 'Active'),
(16, 'wendy dsada', 'gambar.jpg', 'deskripsi', 'telepon', 'email@email.com', '1231323', '1233334', 'http://dsada.com', 'Active'),
(19, 'aaaa', 'bbbb.jpg', 'cccc', 'dddd', 'eeee', '1111', '2222', 'asdaaa', 'Active'),
(22, 'Museum Sejarah', 'images.jpg', 'test', '22223333', 'museumsejarah@museum.com', '-6.1352', '106.8133', 'www.museumsejarah.com', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `detail_additional`
--

CREATE TABLE IF NOT EXISTS `detail_additional` (
  `ID_Booking` char(10) NOT NULL DEFAULT '',
  `ID_Additional` char(10) NOT NULL,
  `Price` varchar(10) NOT NULL,
  `Quantity` int(5) NOT NULL,
  KEY `ID_Additional` (`ID_Additional`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_additional`
--

INSERT INTO `detail_additional` (`ID_Booking`, `ID_Additional`, `Price`, `Quantity`) VALUES
('BOK1400001', 'ADD1400001', '250000', 1),
('BOK1400001', 'ADD1400002', '35000', 1),
('BOK1400002', 'ADD1400001', '250000', 1),
('BOK1400003', 'ADD1400001', '250000', 0),
('BOK1400004', 'ADD1400001', '250000', 0),
('BOK1400005', 'ADD1400001', '250000', 0),
('BOK1500001', 'ADD1400001', '250000', 0),
('BOK1500002', 'ADD1400001', '250000', 4),
('BOK1500003', 'ADD1400001', '250000', 5),
('BOK1500004', 'ADD1400001', '250000', 0),
('BOK1500005', 'ADD1400001', '250000', 0),
('BOK1500006', 'ADD1400001', '250000', 0),
('BOK1500007', 'ADD1400001', '250000', 0),
('BOK1500008', 'ADD1400001', '250000', 0),
('BOK1500009', 'ADD1400001', '250000', 0),
('BOK1500010', 'ADD1400001', '250000', 0),
('BOK1500011', 'ADD1400001', '250000', 0),
('BOK1500012', 'ADD1400001', '250000', 0),
('BOK1500013', 'ADD1400001', '250000', 0),
('BOK1500013', 'ADD1400002', '35000', 0),
('BOK1500014', 'ADD1400001', '250000', 0),
('BOK1500014', 'ADD1400002', '35000', 0);

-- --------------------------------------------------------

--
-- Table structure for table `detail_booking`
--

CREATE TABLE IF NOT EXISTS `detail_booking` (
  `ID_Booking` char(10) NOT NULL DEFAULT '',
  `ID_RoomType` char(10) NOT NULL DEFAULT '',
  `Quantity` int(5) NOT NULL,
  `Price` varchar(10) NOT NULL,
  `Price_Status` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_RoomType`,`ID_Booking`),
  KEY `ID_Booking` (`ID_Booking`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_booking`
--

INSERT INTO `detail_booking` (`ID_Booking`, `ID_RoomType`, `Quantity`, `Price`, `Price_Status`) VALUES
('BOK1400001', 'TYP1400001', 1, '450000', 'Reguler'),
('BOK1400002', 'TYP1400001', 2, '450000', 'Reguler'),
('BOK1400003', 'TYP1400001', 2, '450000', 'Reguler'),
('BOK1400005', 'TYP1400001', 1, '450000', 'Reguler'),
('BOK1400004', 'TYP1400002', 1, '375000', 'Reguler'),
('BOK1500001', 'TYP1400001', 1, '450000', 'Reguler'),
('BOK1500002', 'TYP1400001', 1, '450000', 'Reguler'),
('BOK1500003', 'TYP1400002', 4, '375000', 'Reguler'),
('BOK1500004', 'TYP1400001', 1, '450000', 'Reguler'),
('BOK1500005', 'TYP1400001', 1, '450000', 'Reguler'),
('BOK1500006', 'TYP1500009', 1, '1231123', 'Reguler'),
('BOK1500007', 'TYP1500009', 5, '1231123', 'Reguler'),
('BOK1500008', 'TYP1400001', 1, '450000', 'Reguler'),
('BOK1500009', 'TYP1400001', 1, '450000', 'Reguler'),
('BOK1500010', 'TYP1400001', 1, '450000', 'Reguler'),
('BOK1500011', 'TYP1400001', 1, '450000', 'Reguler'),
('BOK1500012', 'TYP1400001', 1, '450000', 'Reguler'),
('BOK1500014', 'TYP1400001', 1, '450000', '');

-- --------------------------------------------------------

--
-- Table structure for table `detail_offer`
--

CREATE TABLE IF NOT EXISTS `detail_offer` (
  `ID_Offer` char(10) NOT NULL DEFAULT '',
  `ID_RoomType` char(10) NOT NULL DEFAULT '',
  `Promo` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_RoomType`,`ID_Offer`),
  KEY `ID_Offer` (`ID_Offer`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_offer`
--

INSERT INTO `detail_offer` (`ID_Offer`, `ID_RoomType`, `Promo`) VALUES
('OFR1500001', 'TYP1400001', '250000'),
('OFR1500002', 'TYP1400001', '500000'),
('OFR1400001', 'TYP1400002', '275000'),
('OFR1400002', 'TYP1400002', '175000'),
('OFR1500001', 'TYP1400002', '200000'),
('OFR1500002', 'TYP1400002', '400000'),
('OFR1500003', 'TYP1400001', '350000');

-- --------------------------------------------------------

--
-- Table structure for table `detail_offer_history`
--

CREATE TABLE IF NOT EXISTS `detail_offer_history` (
  `ID_Offer_History` char(10) NOT NULL DEFAULT '',
  `ID_Offer` char(10) NOT NULL DEFAULT '',
  `ID_RoomType` char(10) NOT NULL DEFAULT '',
  `Promo` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_RoomType`,`ID_Offer`,`ID_Offer_History`),
  KEY `ID_Offer` (`ID_Offer`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `detail_offer_history`
--

INSERT INTO `detail_offer_history` (`ID_Offer_History`, `ID_Offer`, `ID_RoomType`, `Promo`) VALUES
('OFH1400001', 'OFR1400001', 'TYP1400001', '350000'),
('OFH1500001', 'OFR1500001', 'TYP1400001', '250000'),
('OFH1500002', 'OFR1500002', 'TYP1400001', '500000'),
('OFH1400001', 'OFR1400001', 'TYP1400002', '275000'),
('OFH1400002', 'OFR1400001', 'TYP1400002', '275000'),
('OFH1400003', 'OFR1400002', 'TYP1400002', '175000'),
('OFH1500001', 'OFR1400002', 'TYP1400002', '200000'),
('OFH1500002', 'OFR1500002', 'TYP1400002', '400000'),
('OFH1500003', 'OFR1500003', 'TYP1400001', '350000');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events`
--

INSERT INTO `events` (`ID_Events`, `Title`, `File`, `Description`, `Date`, `Time`, `Status`) VALUES
('EVE1400001', 'Happy New Year 2015', 'happy-new-year-2015.jpg', 'Perayaan Pergantian Tahun 2015. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2014-12-31', '21:00:00', 'Expired'),
('EVE1400002', 'Coba', '11.JPG', 'Test doang', '2014-11-23', '00:00:00', 'Expired'),
('EVE1400003', 'Candle Light Dinner', 'candlelight.jpg', 'Makan malam yang romantis dihiasi dengan lilin-lilin yang indah.Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2014-12-03', '19:00:00', 'Expired'),
('EVE1500001', 'Test Prototype', 'images.jpg', 'Test Prototype untuk dapat nilai', '2015-01-24', '09:00:00', 'Expired'),
('EVE1500002', 'Ini baru event', '13784_eureka_seven.jpg', 'Nah ini benar', '2015-12-31', '01:00:00', 'Active'),
('EVE1500003', 'aki oong', '169429.jpg', 'ooong', '2010-07-23', '18:00:00', 'Expired');

-- --------------------------------------------------------

--
-- Table structure for table `events_history`
--

CREATE TABLE IF NOT EXISTS `events_history` (
  `ID_Events_History` char(10) NOT NULL DEFAULT '',
  `ID_Events` char(10) NOT NULL DEFAULT '',
  `Title` varchar(50) NOT NULL,
  `File` varchar(50) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Date` date NOT NULL,
  `Time` time NOT NULL,
  `ID_User` char(10) NOT NULL,
  `Action` varchar(10) NOT NULL,
  `Created_Date` datetime NOT NULL,
  PRIMARY KEY (`ID_Events_History`,`ID_Events`),
  KEY `ID_Events` (`ID_Events`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `events_history`
--

INSERT INTO `events_history` (`ID_Events_History`, `ID_Events`, `Title`, `File`, `Description`, `Date`, `Time`, `ID_User`, `Action`, `Created_Date`) VALUES
('EVH1400001', 'EVE1400001', 'Happy New Year 2015', 'happy-new-year-2015.jpg', 'Perayaan Pergantian Tahun 2015', '2014-12-31', '21:00:00', 'USR1400001', 'Insert', '2014-11-26 00:00:00'),
('EVH1400002', 'EVE1400002', 'Coba', '11.JPG', 'Test doang', '2014-11-23', '00:00:00', 'USR1400001', 'Insert', '2014-11-23 00:00:00'),
('EVH1400003', 'EVE1400003', 'Candle Light Dinner', 'candlelight.jpg', 'Makan malam yang romantis ', '2014-12-03', '19:00:00', 'USR1400001', 'Insert', '2014-12-01 00:00:00'),
('EVH1400004', 'EVE1400003', 'Candle Light Dinner', 'candlelight.jpg', 'Makan malam yang romantis dihiasi dengan lilin-lilin yang indah', '2014-12-03', '19:00:00', 'USR1400001', 'Update', '2014-12-01 00:00:00'),
('EVH1500001', 'EVE1500001', 'Test Prototype', 'images.jpg', 'Test Prototype untuk dapat nilai', '2015-01-24', '09:00:00', 'USR1400001', 'Insert', '2015-01-23 20:42:36'),
('EVH1500002', 'EVE1500002', 'Ini baru event', '13784_eureka_seven.jpg', 'Nah ini benar', '2015-12-31', '01:00:00', 'USR1400001', 'Insert', '2015-01-27 11:43:43'),
('EVH1500003', 'EVE1500003', 'aki oong', '169429.jpg', 'ooong', '2010-07-23', '18:00:00', 'USR1400001', 'Insert', '2015-02-13 21:45:24');

-- --------------------------------------------------------

--
-- Table structure for table `extra`
--

CREATE TABLE IF NOT EXISTS `extra` (
  `ID_Extra` char(10) NOT NULL DEFAULT '',
  `ID_Booking` char(10) NOT NULL DEFAULT '',
  `Arrival_time` time DEFAULT NULL,
  `Flight_detail` varchar(100) NOT NULL DEFAULT '-',
  `Comment` varchar(1000) NOT NULL DEFAULT '-',
  PRIMARY KEY (`ID_Extra`,`ID_Booking`),
  KEY `ID_Booking` (`ID_Booking`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `extra`
--

INSERT INTO `extra` (`ID_Extra`, `ID_Booking`, `Arrival_time`, `Flight_detail`, `Comment`) VALUES
('EXT1400001', 'BOK1400001', '11:00:00', 'Take off jam 09:00, perjalanan 2jam', 'Saya pakai baju kemeja kotak-kotak'),
('EXT1400002', 'BOK1400002', '17:00:00', 'Terbang dari Belitung jam 13.00', 'Saya pakai baju kotak-kotak'),
('EXT1400003', 'BOK1400003', '00:00:00', '-', '-'),
('EXT1400004', 'BOK1400004', '00:00:00', '-', '-'),
('EXT1400005', 'BOK1400005', '00:00:00', '-', '-'),
('EXT1500001', 'BOK1500001', '02:01:00', 'asdasd', ''),
('EXT1500002', 'BOK1500002', '00:00:00', '', ''),
('EXT1500003', 'BOK1500003', '03:02:00', 'asdasd', 'asdasdasd'),
('EXT1500004', 'BOK1500004', '00:00:00', '', ''),
('EXT1500005', 'BOK1500005', '00:00:00', '', ''),
('EXT1500006', 'BOK1500006', '00:00:00', '', ''),
('EXT1500007', 'BOK1500007', '00:00:00', '', ''),
('EXT1500008', 'BOK1500008', '00:00:00', '', ''),
('EXT1500009', 'BOK1500009', '00:00:00', '', ''),
('EXT1500010', 'BOK1500010', '00:00:00', '', ''),
('EXT1500011', 'BOK1500011', '00:00:00', '', ''),
('EXT1500012', 'BOK1500012', '00:00:00', 'PAkai baju kotakkotak', 'okee'),
('EXT1500013', 'BOK1500014', '00:00:00', '', '');

-- --------------------------------------------------------

--
-- Table structure for table `facility`
--

CREATE TABLE IF NOT EXISTS `facility` (
  `ID_Facility` char(10) NOT NULL,
  `Facility_Name` varchar(50) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `Status` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_Facility`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facility`
--

INSERT INTO `facility` (`ID_Facility`, `Facility_Name`, `Description`, `Status`) VALUES
('FCT1400001', 'Lobby', 'Receptionist', 'Active'),
('FCT1400002', 'Mini Bar', 'Mini bar', 'Active'),
('FCT1400003', 'Dining Room', 'Tempat makan', 'Active'),
('FCT1400004', 'Hall Room', 'Hall room', 'Active'),
('FCT1400005', 'Outdoor Smoking Area', 'Tempat rokok', 'Active'),
('FCT1500001', 'CCTV', 'asdasd', 'Delete'),
('FCT1500002', 'Test', 'Test doang', 'Delete'),
('FCT1500003', 'asd', 'asdasd', 'Delete'),
('FCT1500004', 'Room', 'room', 'Delete'),
('FCT1500005', 'wwwww', 'aaaaaaaa', 'Delete'),
('FCT1500006', 'akhiong', 'akhiooong', 'Delete'),
('FCT1500007', 'akiong', 'akiong', 'Delete'),
('FCT1500008', 'aki', 'ong', 'Delete'),
('FCT1500009', 'fed', 'fed', 'Delete');

-- --------------------------------------------------------

--
-- Table structure for table `facility_pic`
--

CREATE TABLE IF NOT EXISTS `facility_pic` (
  `ID_Facility_Pic` char(10) NOT NULL,
  `ID_Facility` char(10) NOT NULL,
  `Picture` varchar(100) NOT NULL,
  `Main_Pic` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_Facility_Pic`,`ID_Facility`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `facility_pic`
--

INSERT INTO `facility_pic` (`ID_Facility_Pic`, `ID_Facility`, `Picture`, `Main_Pic`) VALUES
('FAP1400001', 'FCT1400001', 'lobby.jpg', 'YES'),
('FAP1400002', 'FCT1400002', 'mini_bar.jpg', 'YES'),
('FAP1400003', 'FCT1400003', 'dining_room.jpg', 'YES'),
('FAP1400004', 'FCT1400004', 'hall_room.jpg', 'YES'),
('FAP1400005', 'FCT1400005', 'smoking_area.jpg', 'YES'),
('FAP1500001', 'FCT1500001', 'CCTV.jpg', 'YES'),
('FAP1500002', 'FCT1500001', 'CCTV2.jpg', 'NO'),
('FAP1500003', 'FCT1500002', 'Test.jpg', 'YES'),
('FAP1500004', 'FCT1500003', 'asd.jpg', 'NO'),
('FAP1500005', 'FCT1500003', 'asd1.jpg', 'YES'),
('FAP1500006', 'FCT1500003', 'asd2.jpg', 'NO'),
('FAP1500007', 'FCT1500004', 'Room.jpg', 'YES'),
('FAP1500008', 'FCT1500005', 'wwwww.jpeg', 'YES'),
('FAP1500009', 'FCT1500003', 'asd3.jpg', 'NO'),
('FAP1500010', 'FCT1500006', 'akhiong.jpg', 'YES'),
('FAP1500011', 'FCT1500007', 'akiong.jpg', 'Delete'),
('FAP1500012', 'FCT1500008', 'aki.jpg', 'YES'),
('FAP1500013', 'FCT1500007', 'akiong', 'Delete'),
('FAP1500042', 'FCT1400003', 'Dining Room', 'Delete'),
('FAP1500041', 'FCT1500009', 'fed2.jpg', 'NO'),
('FAP1500039', 'FCT1500009', 'fed1.jpg', 'NO'),
('FAP1500026', 'FCT1500007', 'akiong', 'YES'),
('FAP1500027', 'FCT1500007', 'akiong', 'Delete'),
('FAP1500028', 'FCT1500007', 'akiong', 'Delete'),
('FAP1500029', 'FCT1500007', 'akiong', 'Delete'),
('FAP1500030', 'FCT1500007', 'akiong', 'Delete'),
('FAP1500031', 'FCT1500007', 'akiong', 'Delete'),
('FAP1500032', 'FCT1500007', 'akiong', 'Delete'),
('FAP1500033', 'FCT1500007', 'akiong', 'Delete'),
('FAP1500034', 'FCT1500007', 'akiong', 'Delete'),
('FAP1500035', 'FCT1500007', 'akiong', 'Delete'),
('FAP1500036', 'FCT1500007', 'akiong', 'Delete'),
('FAP1500040', 'FCT1500007', 'akiong', 'NO'),
('FAP1500037', 'FCT1500005', 'wwwww', 'NO'),
('FAP1500038', 'FCT1500009', 'fed.jpg', 'YES');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
('FED1400008', 'Dude', 'dude.08123@yahoo.com', 'Website', 'Menarik sekali', '2014-12-08 14:49:44', 'Confirm'),
('FED1400009', 'asd', 'asd@asd.asd', 'asdasd', 'asdasdasd', '2014-12-11 21:40:53', 'Reject'),
('FED1500001', 'deny', 'denysetiawan28@gmail.com', 'testing comment', 'asdadsasdasdasdasdas', '2015-01-24 09:01:42', 'Reject'),
('FED1500002', 'Aldo', 'tj@gmail.com', 'Testiii', 'Hallo..kemaren saya menginap disini, servicenyaa okee kok', '2015-01-24 09:08:54', 'Confirm'),
('FED1500003', 'Aldo', 'tj@gmail.com', 'Testiii', 'Hallo..kemaren saya menginap disini, servicenyaa okee kok', '2015-01-24 09:10:25', 'Confirm'),
('FED1500004', 'Test modal', 'test@modal.com', 'tes modal kok', 'hehehe', '2015-02-25 09:03:24', 'Reject'),
('FED1500005', 'Rendy', 'rendymochi@yahoo.com', 'Testimony', 'Good looking hotel, with smart budget.', '2015-03-06 11:39:09', 'Confirm'),
('FED1500006', 'Deny', 'denysetiawan@gmail.com', 'MAHAL', 'ini hotel mahal banget. jelek lagi', '2015-03-06 11:45:40', 'Reject'),
('FED1500007', 'Deny', 'denysetiawan@gmail.com', 'Testimony', 'Hotelnya good looking.', '2015-03-06 11:46:40', 'Confirm'),
('FED1500008', 'Test', 'test@modal.com', 'tes modal kok', 'tes modal.', '2015-03-06 11:49:12', 'Reject'),
('FED1500009', 'Deny', 'test@modal.com', 'tes modal kok', 'tes ', '2015-03-07 12:09:39', 'Reject'),
('FED1500010', 'Deny', 'denysetiawan@gmail.com', 'Testimony', 'hotelnya bagus', '2015-03-07 12:13:20', 'Reject'),
('FED1500011', 'Deny', 'denysetiawan@gmail.com', 'tes modal kok', 'tes modal timeout', '2015-03-07 12:14:05', 'Reject'),
('FED1500012', 'Rendy', 'rendymochi@yahoo.com', 'Testimony', 'Hotelnya bagus', '2015-03-07 12:14:39', 'Confirm'),
('FED1500013', 'Deny', 'denysetiawan@gmail.com', 'testimonial', 'hai', '2015-03-07 12:58:16', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `gallery`
--

CREATE TABLE IF NOT EXISTS `gallery` (
  `ID_Gallery` int(11) NOT NULL AUTO_INCREMENT,
  `Gallery_Picture` varchar(100) NOT NULL,
  `Status` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_Gallery`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=8 ;

--
-- Dumping data for table `gallery`
--

INSERT INTO `gallery` (`ID_Gallery`, `Gallery_Picture`, `Status`) VALUES
(1, 'main.jpg', 'Main'),
(2, 'bg1.jpg', '1'),
(4, 'album2.jpg', 'Delete'),
(6, 'Penguins.jpg', 'Delete'),
(7, 'VVIP2.jpg', 'Delete');

-- --------------------------------------------------------

--
-- Table structure for table `guest`
--

CREATE TABLE IF NOT EXISTS `guest` (
  `ID_Guest` char(10) NOT NULL DEFAULT '',
  `ID_Booking` char(10) NOT NULL DEFAULT '',
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
  PRIMARY KEY (`ID_Guest`,`ID_Booking`),
  KEY `ID_Booking` (`ID_Booking`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `guest`
--

INSERT INTO `guest` (`ID_Guest`, `ID_Booking`, `First_name`, `Last_name`, `No_identity`, `Email`, `Telephone`, `Address`, `Country`, `City`, `State`, `Post_code`) VALUES
('GUE1400001', 'BOK1400001', 'Dedy', 'Cewadi', '1982252658525', 'dedy@yahoo.com', '1498145', 'Jalan Keluarga', 'Indonesia', 'Jakarta', 'DKI Jakarta', '11480'),
('GUE1400002', 'BOK1400002', 'Erlina', 'Indra', '123123123', 'erlina.indra@rocketmail.com', '081231823813', 'Jalan k.h Syahdan|Jalan Keluarga', 'Indonesia', 'Jakarta', 'Jakarta Barat', '11480'),
('GUE1400003', 'BOK1400003', 'asdasdas', 'dasdasdsad', '12312312321', 'asdasd.asdsa@hasjd.cosad', '123123123', 'asdasdasdasd|', 'sdasdasdasdas', 'asdasdsadasdasd', 'asdasdasda', '123123213'),
('GUE1400004', 'BOK1400004', 'Deny', 'Setiawan', '1501152580', 'denysetiawan28@gmail.com', '081218688250', 'Jalan Cilincing raya no. 22|', 'Indonesia', 'Jakarta', 'Jakarta Utara', '14270'),
('GUE1400005', 'BOK1400005', 'Deny', 'Setiawan', '1501152580', 'asd@asd.com', '123123123', 'asdasdasdasdsdasd|asdasdasd', 'Indonesia', 'Jakarta', 'Jakarta Barat', '12220'),
('GUE1500001', 'BOK1500001', 'Deny', 'Setiawan', '122222222222', 'denysetiawan28@gmail.com', '0211111111', 'asdadasdasdasd', 'ID', 'jakarta', 'jakarta', 'Jakarta Utara'),
('GUE1500002', 'BOK1500002', 'Deny', 'Setiawan', '1234567', 'denysetiawan28@gmail.com', '0211111111', 'asdasdasdaaaaaaaaaaaa', 'AF', 'jakarta', 'jakarta', 'Jakarta Utara'),
('GUE1500003', 'BOK1500003', 'Deny', 'Setiawan', '15011152580', 'denysetiawan28@gmail.com', '0211111111', 'jalan kenangan ini sangat menyakitkan', 'ID', 'jakarta', 'jakarta', 'Jakarta Utara'),
('GUE1500004', 'BOK1500004', 'Deny', 'Setiawan', '122222222222', 'denysetiawan28@gmail.com', '0211111111', 'Jalan kenangan ini sangat menyakitkan', 'AF', 'jakarta', 'jakarta', 'Jakarta Utara'),
('GUE1500005', 'BOK1500005', 'Deny', 'Setiawan', '15011152580', 'denysetiawan28@gmail.com', '0211111111', 'Jalan 123.com', 'AF', 'jakarta', 'jakarta', 'Jakarta Utara'),
('GUE1500006', 'BOK1500006', 'Deny', 'Setiawan', '122222222222', 'denysetiawan28@gmail.com', '0211111111', 'jalan berbagi disana', 'ID', 'jakarta', 'jakarta', 'Jakarta Utara'),
('GUE1500007', 'BOK1500007', 'Deny', 'Setiawan', '122222222222', 'denysetiawan28@gmail.com', '0211111111', 'jalan kenangan kedua', 'ID', 'jakarta', 'jakarta', 'Jakarta Utara'),
('GUE1500008', 'BOK1500008', 'Deny', 'Setiawan', '122222222222', 'denysetiawan28@gmail.com', '0211111111', 'Jalan kenangan ini sangat indah', 'ID', 'jakarta', 'jakarta', 'Jakarta Utara'),
('GUE1500009', 'BOK1500009', 'Deny', 'Setiawan', '122222222222', 'denysetiawan28@gmail.com', '0211111111', 'Jalan kenangan ini sangat indah', 'AF', 'jakarta', 'jakarta', 'Jakarta Utara'),
('GUE1500010', 'BOK1500010', 'Deny', 'Setiawan', '122222222222', 'denysetiawan28@gmail.com', '0211111111', 'Jalan kenangan ini sangat indah', 'AF', 'jakarta', 'jakarta', 'Jakarta Utara'),
('GUE1500011', 'BOK1500011', 'asdasd', 'asdasd', '12312312', 'asd@asd.com', '09140918094810', 'sakjfhasfakhsfkjha', 'AF', 'askfjakfha', 'askfjakfha', 'akjfhashfkjhas'),
('GUE1500012', 'BOK1500012', 'Deny', 'Setiawan', '123123123', 'denysetiawan28@gmail.com', '0211111111', 'Jalan bakaaajs', 'AF', 'jakarta', 'jakarta', 'Jakarta Utara'),
('GUE1500013', 'BOK1500013', 'Rendy', 'Arsanto', '1501145770', 'rendyarsanto@gmail.com', '0878888722293', 'Jalan Keluarga NO.39', 'AF', 'DKI Jakarta', 'DKI Jakarta', 'Jakarta Barat'),
('GUE1500014', 'BOK1500014', 'Rendy', 'Arsanto', '1501145770', 'rendyarsanto@gmail.com', '0878888722293', 'Jalan Keluarga NO.39', 'AF', 'DKI Jakarta', 'DKI Jakarta', 'Jakarta Barat');

-- --------------------------------------------------------

--
-- Table structure for table `int_event_destination`
--

CREATE TABLE IF NOT EXISTS `int_event_destination` (
  `ID_Event_Destination` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Destination` char(10) NOT NULL,
  `Event_Name` varchar(100) NOT NULL,
  `Event_Picture` varchar(100) NOT NULL,
  `Event_Description` varchar(500) NOT NULL,
  `Event_Date` date NOT NULL,
  `Event_Link` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_Event_Destination`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1 AUTO_INCREMENT=1 ;

-- --------------------------------------------------------

--
-- Table structure for table `int_event_dinas`
--

CREATE TABLE IF NOT EXISTS `int_event_dinas` (
  `Event_ID` int(11) NOT NULL AUTO_INCREMENT,
  `Event_Title` varchar(100) NOT NULL,
  `Event_Description` varchar(1000) NOT NULL,
  `Event_Picture` varchar(100) NOT NULL,
  `Event_Date` date NOT NULL,
  `Event_Location` varchar(100) NOT NULL,
  PRIMARY KEY (`Event_ID`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=43 ;

--
-- Dumping data for table `int_event_dinas`
--

INSERT INTO `int_event_dinas` (`Event_ID`, `Event_Title`, `Event_Description`, `Event_Picture`, `Event_Date`, `Event_Location`) VALUES
(5, 'sdadasdas', 'dsadsadishdkjash', 'Event108.png', '2015-01-28', 'Tanah Abang'),
(4, 'rendy super penyok', 'fasfaf', 'Event107.png', '2015-01-28', 'Tanah Abang'),
(6, 'gdgdsgds', 'gsagasga', 'Event109.jpg', '2015-01-21', 'Kemanggisan'),
(7, 'gdgdsgds', 'gsagasga', 'Event110.jpg', '2015-01-21', 'Kemanggisan'),
(13, '2event untuk denyz', 'addada', 'Event16.jpg', '2015-02-24', 'Palmerah'),
(14, '2event untuk denyz', 'addada', 'Event17.jpg', '2015-02-24', 'Palmerah'),
(11, 'Wine & Dine', 'Every Wednesday from 7 PM – 10 PMFree Flow of our Chilean house wine &amp; All you can eat pasta of your choice (up to 100 combination to choose from) for only Rp.250K ++', 'Event3.jpg', '2015-01-28', 'All Location'),
(12, 'event untuk deny 2', 'test&nbsp;', 'Event15.jpg', '2015-02-12', 'Palmerah'),
(40, 'Event dari dinas', 'event dinas', 'Event57.jpg', '2015-02-21', 'Palmerah'),
(38, 'Event deny', 'dsajdklasdkashdkjashdkljashdksha<br>', 'Event55.JPG', '2015-02-13', 'Palmerah'),
(37, '!!!NEW!!! Event untuk gian', 'Thursday, 19 February 2015', 'http://protodinas.asia/resources/images/events/Event54.jpg', '1970-01-01', 'Palmerah');

-- --------------------------------------------------------

--
-- Table structure for table `int_travel_package`
--

CREATE TABLE IF NOT EXISTS `int_travel_package` (
  `ID_Travel_Package` int(11) NOT NULL AUTO_INCREMENT,
  `ID_Travel` char(10) NOT NULL,
  `Package_Name` varchar(100) NOT NULL,
  `Package_Picture` varchar(100) NOT NULL,
  `Package_Description` varchar(500) NOT NULL,
  `Package_Price` varchar(20) NOT NULL,
  PRIMARY KEY (`ID_Travel_Package`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=46 ;

--
-- Dumping data for table `int_travel_package`
--

INSERT INTO `int_travel_package` (`ID_Travel_Package`, `ID_Travel`, `Package_Name`, `Package_Picture`, `Package_Description`, `Package_Price`) VALUES
(29, '32', 'Paket Wisata ke Singapura!!', 'singapore2_1.jpg', 'Paket wisata berlibur di singapura selama 5 hari 4 malam.', '5000000'),
(30, '32', 'Paket Bohongan', 'Lightning Wallpapers 9.jpg', '<p>aaaaaaaaaaaaaaa</p>\r\n', '100000000'),
(31, '32', 'Paket Bohongan 2', '205cb31562d260acc7bb7791516c20cc3.jpg', '<p>aaaaaaaaaaaaaaaaaaasssssssssssssssssssddddddddddddddddddddddd</p>\r\n', '100000000'),
(32, '32', 'Paket Bohongan 3', '205cb31562d260acc7bb7791516c20cc3.jpg', '<p>aaaaaaaaaaa</p>\r\n', '5555555'),
(14, '15', 'Paket Integrasi RAFED', 'classdiagram.png', '<p>PAKEt</p>\r\n', '200000'),
(15, '15', 'Paket Integrasi RAFED', 'classdiagram.png', '<p>PAKEt</p>\r\n', '200000'),
(16, '15', 'Paket Integrasi RAFED', 'classdiagram.png', '<p>PAKEt</p>\r\n', '200000'),
(17, '15', 'Paket Integrasi RAFED', 'classdiagram.png', '<p>PAKEt</p>\r\n', '200000'),
(33, '32', 'isnert', '74fc24d5d0c8df365a3a16db47ad33c4.jpg', 'wEndyd', '21331'),
(34, '32', 'Test integrasi by deny', '1Vvufl1.jpg', '<p>Lorem Ipsum Dolot Sit Amet</p>\r\n', '100000000'),
(21, '', 'PAKET RENDYJEN', 'http://protoagent.asia/project/images/package/2014-10-Cool-Logo-Design-Debian-Linux-Wide.jpg', '<p>3999</p>\r\n', '3000'),
(20, '', 'PAKET S123', 'promo1.jpg', '<p>DETAIL PAKETS</p>\r\n', '3000003'),
(22, '', 'Paket Coba', 'http://protoagent.asia/project/images/package/10949846_10204376744871362_852084910_n.jpg', '<p>123123</p>\r\n', '23123'),
(23, '', 'Paket Cobaa', 'http://protoagent.asia/project/images/package/classagent.png', '<p>adfsasdf</p>\r\n', '23123'),
(24, '', 'Paket Coba', 'http://protoagent.asia/project/images/package/classagent.png', '<p>&nbsp;</p>\r\n\r\n<p>sd</p>\r\n', '23123'),
(35, '32', 'Test integrasi by deny 3', '3d-abstract-wallpaper-hd-2-jpg-20141016172102-543f9c0ec950c.jpg', 'aaaaaaaaaaaaaasssssssssaaaaaaaaa', '150000000'),
(36, '32', 'Test Packages', 'icon.jpg', 'jdklsajdkljaskldaj', '12'),
(38, '32', 'Test Package Test', 'icon.jpg', '<p>kldajdkakah</p>\r\n', '12'),
(45, '32', 'Paket Wisata ke Palembang', '74fc24d5d0c8df365a3a16db47ad33c4.jpg', '<p>lorem ipsum lorem ipsum</p>\r\n', '1000000');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE IF NOT EXISTS `migrations` (
  `migration` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`migration`, `batch`) VALUES
('2013_11_26_161501_create_currency_table', 1);

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news`
--

INSERT INTO `news` (`ID_News`, `Title`, `File`, `Description`, `Date`, `Status`) VALUES
('NEW1400001', 'Grand Opening Everyday Smart Hotel Jakarta', 'grandopening3.png', 'Telah dibuka Everyday Smart Hotel di Jakarta oleh Deny Setiawan. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2014-11-21 18:38:27', 'Active'),
('NEW1400002', 'Kegiatan Sosial', 'sosial.jpg', 'Pembagian sembako dilakukan oleh HM Everyday Smart Hotel di Pondok Pesantren Indah. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat. Lorem ipsum dolor sit amet, consectetur adipisicing elit, sed do eiusmod tempor incididunt ut labore et dolore magna aliqua. Ut enim ad minim veniam, quis nostrud exercitation ullamco laboris nisi ut aliquip ex ea commodo consequat.', '2014-12-01 16:59:03', 'ACtive'),
('NEW1500001', 'Test Prototype', 'images.jpg', 'Test Gambar', '2015-01-23 20:20:11', 'Active'),
('NEW1500002', 'INI event', '25258_eureka_seven.jpg', 'event baru', '2015-01-27 11:43:00', 'Active'),
('NEW1500003', 'ini news', '169429.jpg', 'inin news descripton', '2015-02-13 21:29:44', 'Active');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `newsletter`
--

INSERT INTO `newsletter` (`ID_Newsletter`, `First_Name`, `Last_Name`, `Email`, `Date`, `Status`) VALUES
('NEW1400001', 'Albert', 'Pratama', 'albert_p@yahoo.com', '2014-11-13 13:10:39', 'Confirm'),
('NEW1400002', 'Patrick', '', 'patrick17@gmail.com', '2014-11-14 23:13:30', 'Confirm'),
('NEW1400003', 'asdasdasd', 'asdasdasd', 'jasd@jmaoisd.asodoa', '2014-11-20 05:39:07', 'Reject'),
('NEW1400004', 'Erlina', 'Indra', 'erlina.indra@rocketmail.com', '2014-12-04 01:31:43', 'Confirm'),
('NEW1500001', 'Aldo', 'Augusto', 'tj@gmail.com', '2015-01-24 09:06:03', 'Pending'),
('NEW1500002', 'Deny', 'setiawan', 'denysetiawan28@gmail.com', '2015-03-07 12:50:23', 'Pending'),
('NEW1500003', 'Setiawan', 'deny', 'deny@yahoo.com', '2015-03-07 12:56:36', 'Pending'),
('NEW1500004', 'Deny', 'Setiawan', 'dny_clancy@yahoo.com', '2015-03-07 01:00:01', 'Pending');

-- --------------------------------------------------------

--
-- Table structure for table `news_history`
--

CREATE TABLE IF NOT EXISTS `news_history` (
  `ID_News_history` char(10) NOT NULL DEFAULT '',
  `ID_News` char(10) NOT NULL DEFAULT '',
  `Title` varchar(50) NOT NULL,
  `File` varchar(50) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `ID_User` char(10) NOT NULL,
  `Action` varchar(10) NOT NULL,
  `Created_Date` datetime NOT NULL,
  PRIMARY KEY (`ID_News`,`ID_News_history`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `news_history`
--

INSERT INTO `news_history` (`ID_News_history`, `ID_News`, `Title`, `File`, `Description`, `ID_User`, `Action`, `Created_Date`) VALUES
('NWH1400001', 'NEW1400001', 'Grand Opening Everyday Smart Hotel Jakarta', 'grandopening3.png', 'Telah dibuka Everyday Smart Hotel di Jakarta oleh Deny Setiawan', 'USR1400001', 'Insert', '2010-12-17 08:48:16'),
('NWH1400002', 'NEW1400002', 'Kegiatan Sosial', 'sosial.jpg', 'Pembagian sembako dilakukan oleh HM Everyday Smart Hotel ', 'USR1400001', 'Insert', '2014-12-01 16:59:03'),
('NWH1400003', 'NEW1400002', 'Kegiatan Sosial', 'sosial.jpg', 'Pembagian sembako dilakukan oleh HM Everyday Smart Hotel di Pondok Pesantren Indah', 'USR1400003', 'Update', '2014-12-01 17:49:09'),
('NWH1500001', 'NEW1500001', 'Test Prototype', 'images.jpg', 'Test Gambar', 'USR1400001', 'Insert', '2015-01-23 20:20:11'),
('NWH1500002', 'NEW1500002', 'INI event', '25258_eureka_seven.jpg', 'event baru', 'USR1400001', 'Insert', '2015-01-27 11:43:00'),
('NWH1500003', 'NEW1500003', 'ini news', '169429.jpg', 'inin news descripton', 'USR1400001', 'Insert', '2015-02-13 21:29:44');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offer`
--

INSERT INTO `offer` (`ID_Offer`, `Title`, `File`, `Description`, `From_Date`, `Until_Date`, `Status`) VALUES
('OFR1400001', 'Promo Tahun Baru', 'deluxe.jpg', 'Diskon 100rb/room', '2014-12-05', '2014-12-07', 'Expired'),
('OFR1400002', 'Promo Superior Room ', 'superior.jpg', 'Diskon Superior Room Besar-Besaran buat Tahun Baru', '2014-12-31', '2015-01-01', 'Expired'),
('OFR1500001', 'Special New Year!', 'new_year.jpg', 'Get our promotion for new year event!', '2015-01-01', '2015-01-31', 'Expired'),
('OFR1500002', 'Masa Transisi', 'transisi.jpg', 'asdasdasdasdasda asdasdasdasdasda asdasdasdasdasda', '2015-01-01', '2015-02-26', 'Expired'),
('OFR1500003', 'Test Prototype', 'images.jpg', 'test prototype', '2015-01-24', '2015-02-27', 'Expired');

-- --------------------------------------------------------

--
-- Table structure for table `offer_history`
--

CREATE TABLE IF NOT EXISTS `offer_history` (
  `ID_Offer_History` char(10) NOT NULL DEFAULT '',
  `ID_Offer` char(10) NOT NULL DEFAULT '',
  `Title` varchar(50) NOT NULL,
  `File` varchar(50) NOT NULL,
  `Description` varchar(100) NOT NULL,
  `From_Date` date NOT NULL,
  `Until_Date` date NOT NULL,
  `ID_User` char(10) NOT NULL,
  `Action` varchar(10) NOT NULL,
  `Created_Date` datetime NOT NULL,
  PRIMARY KEY (`ID_Offer_History`,`ID_Offer`),
  KEY `ID_Offer` (`ID_Offer`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `offer_history`
--

INSERT INTO `offer_history` (`ID_Offer_History`, `ID_Offer`, `Title`, `File`, `Description`, `From_Date`, `Until_Date`, `ID_User`, `Action`, `Created_Date`) VALUES
('OFH1400001', 'OFR1400001', 'Promo Tahun Baru', 'deluxe.jpg', 'Diskon 100rb/kamar', '2014-12-05', '2014-12-06', 'USR1400001', 'Insert', '2014-12-03 02:46:45'),
('OFH1400002', 'OFR1400001', 'Promo Tahun Baru', 'deluxe.jpg', 'Diskon 100rb/room', '2014-12-05', '2014-12-07', 'USR1400003', 'Update', '2014-12-03 02:51:41'),
('OFH1400003', 'OFR1400002', 'Promo Superior Room ', 'superior.jpg', 'Diskon Superior Room Besar-Besaran buat Tahun Baru', '2014-12-31', '2015-01-01', 'USR1400003', 'Insert', '2014-12-03 03:31:03'),
('OFH1500001', 'OFR1500001', 'Special New Year!', 'new_year.jpg', 'Get our promotion for new year event!', '2015-01-01', '2015-01-31', 'USR1400001', 'Insert', '2015-01-06 21:22:31'),
('OFH1500002', 'OFR1500002', 'masa transisi', 'transisi.jpg', 'asdasdasdasdasd sadasdasdasdasdasd', '2015-01-01', '2015-01-31', 'USR1400001', 'Insert', '2015-01-12 00:00:00'),
('OFH1500003', 'OFR1500003', 'Test Prototype', 'images.jpg', 'test prototype', '2015-01-24', '2015-01-25', 'USR1400001', 'Insert', '2015-01-23 20:56:28');

-- --------------------------------------------------------

--
-- Table structure for table `payment`
--

CREATE TABLE IF NOT EXISTS `payment` (
  `ID_Payment` char(10) NOT NULL DEFAULT '',
  `ID_Booking` char(10) NOT NULL DEFAULT '',
  `Credit_Type` varchar(20) NOT NULL,
  `Credit_Holder` varchar(50) NOT NULL,
  `Credit_Number` varchar(20) NOT NULL,
  `Credit_Expiry` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_Payment`,`ID_Booking`),
  KEY `ID_Booking` (`ID_Booking`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `payment`
--

INSERT INTO `payment` (`ID_Payment`, `ID_Booking`, `Credit_Type`, `Credit_Holder`, `Credit_Number`, `Credit_Expiry`) VALUES
('PAY1400001', 'BOK1400001', 'Visa', 'Jhonny', '881954599555', '12/2017'),
('PAY1400002', 'BOK1400002', 'Visa', 'Erlina Indra', '4024007103572482', '10/2020'),
('PAY1400003', 'BOK1400003', 'Visa', 'aSASDASD', '4024007103572482', '1/2014'),
('PAY1400004', 'BOK1400004', 'Visa', 'Deny Setiawan', '4485626911402111', '1/2015'),
('PAY1400005', 'BOK1400005', 'Visa', 'Deny S', '4024007103572482', '1/2015'),
('PAY1500001', 'BOK1500001', 'VISA', 'Deny', '111111111111111', '1/2015'),
('PAY1500002', 'BOK1500002', 'VISA', 'Deny Setiawan', '111111111111111', '1/2015'),
('PAY1500003', 'BOK1500003', 'Visa', 'asdasdasd', '1121231231231', '1/2015'),
('PAY1500004', 'BOK1500004', 'Visa', 'Deeeee', '111111111111111', '1/2015'),
('PAY1500005', 'BOK1500005', 'Visa', 'Deny Setiawan', '123123123123', '1/2015'),
('PAY1500006', 'BOK1500006', 'Visa', 'Deny Setiawan', '123123123123', '1/2015'),
('PAY1500007', 'BOK1500007', 'Visa', 'Deny Setiawan', '123123123123', '1/2015'),
('PAY1500008', 'BOK1500008', 'Visa', 'Deny Setiawan', '111111111111111', '1/2015'),
('PAY1500009', 'BOK1500009', 'Visa', 'Deny Setiawan', '111111111111111', '1/2015'),
('PAY1500010', 'BOK1500010', 'Visa', 'Deny Setiawan', '111111111111111', '1/2015'),
('PAY1500011', 'BOK1500011', 'VISA', 'asfjhasfkhj', '198247158198598157', '1/2015'),
('PAY1500012', 'BOK1500012', 'VISA', 'Deny Setiawan', '123123123123', '9/2015'),
('PAY1500013', 'BOK1500013', 'Visa', 'Rendy ', '4916009684453901', '1/2020'),
('PAY1500014', 'BOK1500014', 'Visa', 'Rendy ', '4916009684453901', '1/2020');

-- --------------------------------------------------------

--
-- Table structure for table `private`
--

CREATE TABLE IF NOT EXISTS `private` (
  `ID_Private` int(11) NOT NULL AUTO_INCREMENT,
  `Host` varchar(100) NOT NULL,
  `Port` varchar(100) NOT NULL,
  `Auth` varchar(100) NOT NULL,
  `Username` varchar(100) NOT NULL,
  `Password` varchar(100) NOT NULL,
  PRIMARY KEY (`ID_Private`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=2 ;

--
-- Dumping data for table `private`
--

INSERT INTO `private` (`ID_Private`, `Host`, `Port`, `Auth`, `Username`, `Password`) VALUES
(1, 'ssl://smtp.gmail.com', '465', 'true', 'denysetiawan28@gmail.com', 'G4m30v3r@');

-- --------------------------------------------------------

--
-- Table structure for table `roomtype`
--

CREATE TABLE IF NOT EXISTS `roomtype` (
  `ID_RoomType` char(10) NOT NULL DEFAULT '',
  `RoomType_Name` varchar(50) NOT NULL,
  `Price` int(10) NOT NULL,
  `Capacity` int(10) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Facility` varchar(1000) NOT NULL,
  `Status` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_RoomType`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roomtype`
--

INSERT INTO `roomtype` (`ID_RoomType`, `RoomType_Name`, `Price`, `Capacity`, `Description`, `Facility`, `Status`) VALUES
('TYP1400001', 'Smart Deluxe Super', 450000, 9, 'Designed in contemporary style, this light and airy room features a plush king or twin bed, a work desk, high-speed broadband and wireless Internet access, and modern bathroom with bath and shower.', '1 Double Bed or 2 Single Bed With Quality Mattres|32" LCD TV With Multiple Channel|Quality Breakfast|Safe Deposit Box|Full Air Conditioner|Wake Up Call Available|Coffee Maker|Laundry and Dry Cleaning Services|Free Wifi Lobby and Room|Hairdryer and Voltage Converter|24 Hours Room Service', 'Active'),
('TYP1400002', 'Smart Superior', 375000, 83, 'Newly renovated, the room is designed in a warm hues colour providing a tranquil atmosphere to relax and unwind after your busy day.', '1 Double Bed or 2 Single Bed With Quality Mattres|22" LCD TV With Multiple Channel|Quality Breakfast|Safe Deposit Box|Full Air Conditioner|Wake Up Call Available|Laundry and Dry Cleaning Services|Free Wifi Lobby and Room|Hairdryer and Voltage Converter|24 Hours Room Service', 'Active'),
('TYP1500011', 'nama1', 1000, 20, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'tv', 'Active'),
('TYP1500001', 'asdasd2', 123123, 12, 'asdasd2', 'asd', 'Delete'),
('TYP1500002', 'rafed', 111111, 1, 'dsfffffffffsd', 'sfdfsdfsdsdf', 'Active'),
('TYP1500003', 'zzz', 222, 22, 'sadasdsad', 'ffffffffffff', 'Active'),
('TYP1500004', 'kamar deluxe', 500000, 20, 'kamar terbaik', 'breakfast', 'Active'),
('TYP1500005', 'nnnnnn', 777, 676, 'jjfgjgfj', 'gfjjfgjfgj', 'Delete'),
('TYP1500006', 'zzzzzzzzzz', 222222222, 100, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'AC, tv, coffee maker', 'Active'),
('TYP1500014', 'aam', 121212, 11, 'sadddddasdas', 'tvac acasdasd', 'Active'),
('TYP1500007', 'zzzzz', 2000000, 100, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'ac', 'Delete'),
('TYP1500008', 'hahsdjkdkjj', 2000000, 100, 'zzzzzzzzzz', 'ac', 'Active'),
('TYP1500009', 'name', 2000000, 100, 'kamar yangterbaik yang kami punyaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'ac dan tv', 'Delete'),
('TYP1500010', 'nama', 100000, 12, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'ac dan tv', 'Delete'),
('TYP1500012', 'kamar', 30000, 20, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'CCTV', 'Active'),
('TYP1500013', 'nama3', 2000, 10, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'ac dan tv', 'Active'),
('TYP1500015', 'irhamsi', 111111, 22, 'test amm', 'kamar aam', 'Active'),
('TYP1500016', 'wewew', 121212, 11, 'adasdasda', 'dadada', 'Active'),
('TYP1500017', 'rererere', 4343, 3, 'asdasd', 'ggggg', 'Active'),
('TYP1500018', 'newas', 12312313, 11, 'rerererer', 'asdaad', 'Active'),
('TYP1500019', 'ahhahaha', 10000, 10, 'wewwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww', 'AC', 'Active'),
('TYP1500020', 'wew', 12000, 25, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'CCTV', 'Active'),
('TYP1500021', 'weww', 1111, 111, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'CCTV', 'Delete'),
('TYP1500022', 'every wew', 1234, 123, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'CCTV', 'Active'),
('TYP1500023', 'every weww', 1234, 123, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'CCTV', 'Delete'),
('TYP1500024', 'every ', 12345, 123, 'wewwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww', 'CCTV', 'Delete'),
('TYP1500025', 'everyy', 12345, 1111, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'CCTV', 'Active'),
('TYP1500026', 'ever', 3456, 1234, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'CCTV', 'Delete'),
('TYP1500027', 'retttt', 123123123, 11, 'asdasdasd', 'ddddddddddddd', 'Active'),
('TYP1500028', 'eeeee', 1111111, 222222, 'zzzzzzzzz', 'zzzzzzzzzz', 'Active'),
('TYP1500029', 'hy', 111111, 2222, 'test', 'ubah', 'Active'),
('TYP1500030', 'yuy', 999, 6, 'ffff', 'gggg', 'Active'),
('TYP1500031', 'bbbb', 6666, 7777, 'gdfg', 'cc', 'Active'),
('TYP1500032', 'akuuu', 343434, 11, 'raaaaaaaar', 'rarrrrara', 'Active'),
('TYP1500033', 'delete', 2222, 33, 'daasda', 'aaaa', 'Active'),
('TYP1500034', 'esb', 343434, 33, 'asdrererer', 'gggggggg', 'Active'),
('TYP1500035', 'rrerr', 312, 123, 'ere', 'adssdad', 'Active'),
('TYP1500036', 'jhjhjh', 111, 22, 'aaa', 'zz', 'Active'),
('TYP1500037', 'gian', 222, 33, 'aa', 'zz', 'Active'),
('TYP1500038', 'zxc', 324, 234, 'ad', 'afd', 'Active'),
('TYP1500039', 'zxcccca', 324, 234, 'ada', 'afd', 'Active'),
('TYP1500040', 'zxccccazzax', 324, 234, 'ada', 'afd', 'Active'),
('TYP1500041', 'zxccccazzaxdas', 324, 234, 'ada', 'afd', 'Active'),
('TYP1500042', 'rtrtrt', 5445, 44, 'dfdgdgz', 'dfgdfgd', 'Active'),
('TYP1500043', 'zf', 324, 234, 'ada', 'afd', 'Active'),
('TYP1500044', 'ssd', 3434, 33, 'dfdfdf', 'fdfdf', 'Active'),
('TYP1500045', 'rrrrrr', 33, 44, 'arafaf', 'afafaf', 'Active'),
('TYP1500046', 'test cat', 20000, 10, 'description', 'facility', 'Active'),
('TYP1500047', 'candra', 12345, 122, 'zzzzzzzzzzzzzzzzzzzzzwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww', 'CCTV', 'Active'),
('TYP1500048', 'candra denyy', 123456, 233, 'zzzzzzzzzzzzwwwwwwwwwwwwwwwwww', 'AC', 'Delete'),
('TYP1500049', 'wewwww', 123456777, 1233, 'zzzzzzzzzzzzzzzzzzzwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww', 'CCTV', 'Active'),
('TYP1500050', 'wewwwww', 34567, 345, 'cctvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv', 'CCTV', 'Active'),
('TYP1500051', 'luxury room', 2147483647, 658, 'zzzzzzzzzzzzzzzzzzzzzzzzzwwwwwwwwwwwwwwwwwwwwww', 'CCTV', 'Active'),
('TYP1500052', 'push', 8099, 8877, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'TV', 'Active'),
('TYP1500053', 'tes', 2323, 213, 'sadadwdawdawdawdawdawda', 'AC', 'Active'),
('TYP1500054', '2323213', 213123213, 21, 'wdadawdawdadwdawda', 'AC', 'Active'),
('TYP1500055', 'qweee', 123123, 111, 'faff', 'gggg', 'Active'),
('TYP1500056', 'qweeeass', 123123, 111, 'faff', 'gggg', 'Active'),
('TYP1500057', 'qweeeasss', 123123, 111, 'faff', 'gggg', 'Active'),
('TYP1500058', 'qwt', 123123, 111, 'faff', 'gggg', 'Active'),
('TYP1500059', 'ttttttt', 123123, 111, 'faff', 'gggg', 'Active');

-- --------------------------------------------------------

--
-- Table structure for table `roomtype_history`
--

CREATE TABLE IF NOT EXISTS `roomtype_history` (
  `ID_RoomType_History` char(10) NOT NULL DEFAULT '',
  `ID_RoomType` char(10) NOT NULL DEFAULT '',
  `RoomType_Name` varchar(50) NOT NULL,
  `Price` int(10) NOT NULL,
  `Capacity` int(10) NOT NULL,
  `Description` varchar(1000) NOT NULL,
  `Facility` varchar(1000) NOT NULL,
  `ID_User` char(10) NOT NULL,
  `Action` varchar(10) NOT NULL,
  `Created_Date` datetime NOT NULL,
  PRIMARY KEY (`ID_RoomType_History`,`ID_RoomType`),
  KEY `ID_RoomType` (`ID_RoomType`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roomtype_history`
--

INSERT INTO `roomtype_history` (`ID_RoomType_History`, `ID_RoomType`, `RoomType_Name`, `Price`, `Capacity`, `Description`, `Facility`, `ID_User`, `Action`, `Created_Date`) VALUES
('RTH1400001', 'TYP1400001', 'Smart Deluxe', 450000, 9, 'Street View ', '1 Double Bed or 2 Single Bed With Quality Mattres|32" LCD TV With Multiple Channel|Quality Breakfast|Safe Deposit Box|Full Air Conditioner|Wake Up Call Available|Coffee Maker|Laundry and Dry Cleaning Services|Free Wifi Lobby and Room|Hairdryer and Voltage Converter|24 Hours Room Service', 'USR1400001', 'Insert', '2014-10-25 15:34:27'),
('RTH1400002', 'TYP1400002', 'Smart Superior', 375000, 84, 'Mountain View', '1 Double Bed or 2 Single Bed With Quality Mattres|22" LCD TV With Multiple Channel|Quality Breakfast|Safe Deposit Box|Full Air Conditioner|Wake Up Call Available|Laundry and Dry Cleaning Services|Free Wifi Lobby and Room|Hairdryer and Voltage Converter|24 Hours Room Service', 'USR1400001', 'Insert', '2014-10-25 20:53:53'),
('RTH1500030', 'TYP1500010', 'nama', 100000, 12, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'ac dan tv', 'USR1400001', 'Update', '2015-03-03 12:54:30'),
('RTH1500031', 'TYP1500009', 'name', 2000000, 100, 'kamar yangterbaik yang kami punyaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'ac dan tv', '', 'Delete', '2015-03-03 13:01:54'),
('RTH1500025', 'TYP1500008', 'hahsdjkdkjj', 2000000, 100, 'zzzzzzzzzz', 'ac', '', 'Insert', '2015-03-02 22:51:46'),
('RTH1500026', 'TYP1500001', 'asdasd2', 123123, 12, 'asdasd2', 'asd', 'USR1400001', 'Update', '2015-03-03 10:53:47'),
('RTH1500027', 'TYP1500001', 'asdasd2', 123123, 12, 'asdasd2', 'asd', 'USR1400001', 'Update', '2015-03-03 10:54:07'),
('RTH1500028', 'TYP1500009', 'name', 2000000, 100, 'kamar yangterbaik yang kami punyaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'ac dan tv', '', 'Insert', '2015-03-03 12:45:43'),
('RTH1500029', 'TYP1500010', 'nama', 100000, 12, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'ac dan tv', '', 'Insert', '2015-03-03 12:52:12'),
('RTH1500001', 'TYP1500001', 'deny', 123123, 1, 'asdasdasd', 'asdaaaaaaa', '', 'Insert', '2015-02-14 07:40:07'),
('RTH1500002', 'TYP1500002', 'trtrrtr', 5656656, 5, 'asdasdvbbbggb', 'bggbgbgb', '', 'Insert', '2015-02-14 07:43:52'),
('RTH1500003', 'TYP1500003', 'ytyyyyy', 6767, 6, 'jjhjhjhjhj', 'jjjjjj', '', 'Insert', '2015-02-14 07:45:05'),
('RTH1500004', 'TYP1500003', 'ytyyyyy', 6767, 6, 'jjhjhjhjhj', 'jjjjjj', 'USR1400001', 'Update', '2015-02-14 07:56:28'),
('RTH1500005', 'TYP1500003', 'ytyyyyy', 6767, 6, 'jjhjhjhjhj', 'jjjjjj', 'USR1400001', 'Update', '2015-02-14 07:59:02'),
('RTH1500006', 'TYP1500002', 'trtrrtr', 111111, 11, 'zzzzzzzzzzz', 'zzzzzzzzzz', 'USR1400001', 'Update', '2015-02-14 08:02:21'),
('RTH1500007', 'TYP1500002', 'trtrrtr', 111111, 11, 'zzzzzzzzzzz', 'zzzzzzzzzz', 'USR1400001', 'Update', '2015-02-14 08:04:32'),
('RTH1500008', 'TYP1500002', 'trtrrtr', 111111, 11, 'zzzzzzzzzzz', 'zzzzzzzzzz', 'USR1400001', 'Update', '2015-02-14 08:07:03'),
('RTH1500009', 'TYP1500001', 'asdasd', 123123, 12, 'asdasd', 'asd', '', 'Insert', '2015-02-14 08:17:49'),
('RTH1500010', 'TYP1500001', 'asdasd', 123123, 12, 'asdasd', 'asd', 'USR1400001', 'Update', '2015-02-14 08:18:56'),
('RTH1500011', 'TYP1500002', 'rafed', 111111, 1, 'dsfffffffffsd', 'sfdfsdfsdsdf', '', 'Insert', '2015-02-14 08:21:30'),
('RTH1500012', 'TYP1500003', 'zzz', 1111, 11, 'sadasdsad', 'ffffffffffff', '', 'Insert', '2015-02-14 08:30:52'),
('RTH1500013', 'TYP1500003', 'zzz', 222, 22, 'sadasdsad', 'ffffffffffff', 'USR1400001', 'Update', '2015-02-14 08:35:54'),
('RTH1500014', 'TYP1500003', 'zzz', 222, 22, 'sadasdsad', 'ffffffffffff', 'USR1400001', 'Update', '2015-02-14 08:36:32'),
('RTH1500015', 'TYP1500004', 'yyyyyy', 777777, 777, 'rgfdgdfgd', 'jjjjj', '', 'Insert', '2015-02-14 08:38:17'),
('RTH1500016', 'TYP1500004', 'yyyyyy', 777777, 777, 'rgfdgdfgd', 'jjjjj', 'USR1400001', 'Update', '2015-02-14 08:39:33'),
('RTH1500017', 'TYP1500004', 'yyyyyy', 88888, 888, 'ppppppppppp', 'zzzzzzz', 'USR1400001', 'Update', '2015-02-14 08:42:38'),
('RTH1500018', 'TYP1500004', 'yyyyyy', 99999, 99, 'poooooooo', 'looooooo', 'USR1400001', 'Update', '2015-02-14 08:45:35'),
('RTH1500019', 'TYP1500004', 'yyyyyy', 11111, 111, 'piiiiiii', 'iiiiiiiii', 'USR1400001', 'Update', '2015-02-14 08:49:57'),
('RTH1500020', 'TYP1500005', 'nnnnnn', 777, 676, 'jjfgjgfj', 'gfjjfgjfgj', '', 'Insert', '2015-02-14 08:54:28'),
('RTH1500021', 'TYP1500005', 'nnnnnn', 777, 676, 'jjfgjgfj', 'gfjjfgjfgj', '', 'Delete', '2015-02-14 08:59:53'),
('RTH1500022', 'TYP1500004', 'kamar deluxe', 500000, 20, 'kamar terbaik', 'breakfast', 'USR1400001', 'Update', '2015-02-14 12:51:39'),
('RTH1500023', 'TYP1500006', 'zzzzzzzzzz', 222222222, 100, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'AC, tv, coffee maker', '', 'Insert', '2015-02-25 16:40:52'),
('RTH1500041', 'TYP1500006', 'zzzzzzzzzz', 222222222, 100, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'AC, tv, coffee maker', 'USR1400001', 'Update', '2015-03-04 00:08:41'),
('RTH1500040', 'TYP1500006', 'zzzzzzzzzz', 222222222, 100, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'AC, tv, coffee maker', 'USR1400001', 'Update', '2015-03-04 00:07:44'),
('RTH1500039', 'TYP1500007', 'zzzzz', 2000000, 100, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'ac', '', 'Delete', '2015-03-03 23:59:46'),
('RTH1500038', 'TYP1500001', 'asdasd2', 123123, 12, 'asdasd2', 'asd', '', 'Delete', '2015-03-03 23:57:39'),
('RTH1500037', 'TYP1500001', 'asdasd2', 123123, 12, 'asdasd2', 'asd', '', 'Delete', '2015-03-03 23:57:13'),
('RTH1500036', 'TYP1500013', 'nama3', 2000, 10, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'ac dan tv', 'USR1400001', 'Update', '2015-03-03 22:46:04'),
('RTH1500035', 'TYP1500013', 'nama3', 2000, 10, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'ac', '', 'Insert', '2015-03-03 22:44:54'),
('RTH1500034', 'TYP1500012', 'kamar', 30000, 20, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'CCTV', '', 'Insert', '2015-03-03 18:59:14'),
('RTH1500033', 'TYP1500011', 'nama1', 1000, 20, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'tv', '', 'Insert', '2015-03-03 13:02:39'),
('RTH1500032', 'TYP1500009', 'name', 2000000, 100, 'kamar yangterbaik yang kami punyaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaaa', 'ac dan tv', '', 'Delete', '2015-03-03 13:01:58'),
('RTH1500024', 'TYP1500007', 'zzzzz', 2000000, 100, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'ac', '', 'Insert', '2015-03-02 22:50:26'),
('RTH1500042', 'TYP1500010', 'nama', 100000, 12, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'ac dan tv', '', 'Delete', '2015-03-04 00:11:24'),
('RTH1500043', 'TYP1500014', 'aam', 121212, 11, 'sadddddasdas', 'tvac acasdasd', '', 'Insert', '2015-03-04 23:15:30'),
('RTH1500044', 'TYP1500015', 'irhamsi', 111111, 22, 'test amm', 'kamar aam', '', 'Insert', '2015-03-04 23:48:24'),
('RTH1500045', 'TYP1500016', 'wewew', 121212, 11, 'adasdasda', 'dadada', '', 'Insert', '2015-03-05 00:01:57'),
('RTH1500046', 'TYP1500017', 'rererere', 4343, 3, 'asdasd', 'ggggg', '', 'Insert', '2015-03-05 01:07:13'),
('RTH1500047', 'TYP1500018', 'newas', 12312313, 11, 'rerererer', 'asdaad', '', 'Insert', '2015-03-05 01:19:30'),
('RTH1500048', 'TYP1500019', 'ahhahaha', 10000, 10, 'wewwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww', 'AC', '', 'Insert', '2015-03-05 05:35:29'),
('RTH1500049', 'TYP1500020', 'wew', 12000, 25, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'CCTV', '', 'Insert', '2015-03-05 13:42:50'),
('RTH1500050', 'TYP1500021', 'weww', 1111, 111, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'CCTV', '', 'Insert', '2015-03-05 13:58:12'),
('RTH1500051', 'TYP1500021', 'weww', 1111, 111, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'CCTV', '', 'Delete', '2015-03-05 14:11:09'),
('RTH1500052', 'TYP1500021', 'weww', 1111, 111, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'CCTV', '', 'Delete', '2015-03-05 14:11:13'),
('RTH1500053', 'TYP1500021', 'weww', 1111, 111, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'CCTV', '', 'Delete', '2015-03-05 14:11:18'),
('RTH1500054', 'TYP1500021', 'weww', 1111, 111, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'CCTV', '', 'Delete', '2015-03-05 14:11:43'),
('RTH1500055', 'TYP1500022', 'every wew', 1234, 123, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'CCTV', '', 'Insert', '2015-03-05 14:38:13'),
('RTH1500056', 'TYP1500023', 'every weww', 1234, 123, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'CCTV', '', 'Insert', '2015-03-05 15:21:58'),
('RTH1500057', 'TYP1500023', 'every weww', 1234, 123, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'CCTV', '', 'Delete', '2015-03-05 15:26:19'),
('RTH1500058', 'TYP1500023', 'every weww', 1234, 123, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'CCTV', '', 'Delete', '2015-03-05 15:26:35'),
('RTH1500059', 'TYP1500024', 'every ', 12345, 123, 'wewwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww', 'CCTV', '', 'Insert', '2015-03-05 15:27:57'),
('RTH1500060', 'TYP1500025', 'everyy', 12345, 1111, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'CCTV', '', 'Insert', '2015-03-05 15:40:35'),
('RTH1500061', 'TYP1500024', 'every ', 12345, 123, 'wewwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww', 'CCTV', '', 'Delete', '2015-03-06 13:21:59'),
('RTH1500062', 'TYP1500024', 'every ', 12345, 123, 'wewwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww', 'CCTV', '', 'Delete', '2015-03-06 13:22:05'),
('RTH1500063', 'TYP1500026', 'ever', 3456, 1234, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'CCTV', '', 'Insert', '2015-03-06 13:23:14'),
('RTH1500064', 'TYP1500027', 'retttt', 123123123, 11, 'asdasdasd', 'ddddddddddddd', '', 'Insert', '2015-03-08 14:54:54'),
('RTH1500065', 'TYP1500028', 'eeeee', 1111111, 222222, 'zzzzzzzzz', 'zzzzzzzzzz', '', 'Insert', '2015-03-08 14:56:21'),
('RTH1500066', 'TYP1500029', 'hy', 66565, 55, 'tyhtht', 'ftfhfhfhf', '', 'Insert', '2015-03-08 15:19:55'),
('RTH1500067', 'TYP1500029', 'hy', 111111, 2222, 'test', 'ubah', 'USR1400001', 'Update', '2015-03-08 15:20:36'),
('RTH1500068', 'TYP1500030', 'yuy', 777, 88, 'uyuyyuy', 'yuyuyuyu', '', 'Insert', '2015-03-08 15:22:28'),
('RTH1500069', 'TYP1500030', 'yuy', 999, 6, 'ffff', 'gggg', 'USR1400001', 'Update', '2015-03-08 15:23:04'),
('RTH1500070', 'TYP1500030', 'yuy', 999, 6, 'ffff', 'gggg', 'USR1400001', 'Update', '2015-03-08 15:25:00'),
('RTH1500071', 'TYP1500030', 'yuy', 999, 6, 'ffff', 'gggg', 'USR1400001', 'Update', '2015-03-08 15:25:37'),
('RTH1500072', 'TYP1500031', 'bbbb', 6666, 7777, 'gdfg', 'hhhh', '', 'Insert', '2015-03-08 15:27:20'),
('RTH1500073', 'TYP1500031', 'bbbb', 6666, 7777, 'gdfg', 'aa', 'USR1400001', 'Update', '2015-03-08 15:28:20'),
('RTH1500074', 'TYP1500031', 'bbbb', 6666, 7777, 'gdfg', 'aa', 'USR1400001', 'Update', '2015-03-08 15:28:58'),
('RTH1500075', 'TYP1500031', 'bbbb', 6666, 7777, 'gdfg', 'aa', 'USR1400001', 'Update', '2015-03-08 15:29:26'),
('RTH1500076', 'TYP1500031', 'bbbb', 6666, 7777, 'gdfg', 'aa', 'USR1400001', 'Update', '2015-03-08 15:31:13'),
('RTH1500077', 'TYP1500032', 'akuuu', 343434, 11, 'raaaaaaaar', 'rarrrrara', '', 'Insert', '2015-03-08 15:40:43'),
('RTH1500078', 'TYP1500032', 'akuuu', 343434, 11, 'raaaaaaaar', 'rarrrrara', 'USR1400001', 'Update', '2015-03-08 15:44:24'),
('RTH1500079', 'TYP1500033', 'delete', 2222, 33, 'daasda', 'aaaa', '', 'Insert', '2015-03-08 15:56:07'),
('RTH1500080', 'TYP1500034', 'esb', 343434, 33, 'asdrererer', 'gggggggg', '', 'Insert', '2015-03-08 16:09:04'),
('RTH1500081', 'TYP1500035', 'rrerr', 312, 123, 'ere', 'adssdad', '', 'Insert', '2015-03-08 16:10:12'),
('RTH1500082', 'TYP1500036', 'jhjhjh', 6565, 66, 'hjhgjgh', 'jjjjj', '', 'Insert', '2015-03-08 16:12:18'),
('RTH1500083', 'TYP1500036', 'jhjhjh', 111, 22, 'aaa', 'zz', 'USR1400001', 'Update', '2015-03-08 16:13:49'),
('RTH1500084', 'TYP1500036', 'jhjhjh', 111, 22, 'aaa', 'zz', 'USR1400001', 'Update', '2015-03-08 16:14:40'),
('RTH1500085', 'TYP1500037', 'gian', 222, 33, 'aa', 'zz', '', 'Insert', '2015-03-08 16:22:33'),
('RTH1500086', 'TYP1500038', 'zxc', 324, 234, 'ad', 'afd', '', 'Insert', '2015-03-08 16:24:29'),
('RTH1500087', 'TYP1500039', 'zxcccca', 324, 234, 'ada', 'afd', '', 'Insert', '2015-03-08 16:26:50'),
('RTH1500088', 'TYP1500040', 'zxccccazzax', 324, 234, 'ada', 'afd', '', 'Insert', '2015-03-08 16:28:31'),
('RTH1500089', 'TYP1500041', 'zxccccazzaxdas', 324, 234, 'ada', 'afd', '', 'Insert', '2015-03-08 16:30:35'),
('RTH1500090', 'TYP1500042', 'rtrtrt', 5445, 44, 'dfdgdgz', 'dfgdfgd', '', 'Insert', '2015-03-08 16:31:35'),
('RTH1500091', 'TYP1500043', 'zf', 324, 234, 'ada', 'afd', '', 'Insert', '2015-03-08 16:32:44'),
('RTH1500092', 'TYP1500044', 'ssd', 3434, 33, 'dfdfdf', 'fdfdf', '', 'Insert', '2015-03-08 16:36:21'),
('RTH1500093', 'TYP1500045', 'rrrrrr', 33, 44, 'arafaf', 'afafaf', '', 'Insert', '2015-03-08 16:41:32'),
('RTH1500094', 'TYP1500046', 'test cat', 20000, 10, 'description', 'facility', '', 'Insert', '2015-03-10 11:28:58'),
('RTH1500095', 'TYP1500047', 'candra', 12345, 122, 'zzzzzzzzzzzzzzzzzzzzzwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww', 'CCTV', '', 'Insert', '2015-03-10 14:09:21'),
('RTH1500096', 'TYP1500048', 'candra denyy', 123456, 233, 'zzzzzzzzzzzzwwwwwwwwwwwwwwwwww', 'AC', '', 'Insert', '2015-03-10 14:13:01'),
('RTH1500097', 'TYP1500048', 'candra denyy', 123456, 233, 'zzzzzzzzzzzzwwwwwwwwwwwwwwwwww', 'AC', '', 'Delete', '2015-03-10 14:13:47'),
('RTH1500098', 'TYP1500048', 'candra denyy', 123456, 233, 'zzzzzzzzzzzzwwwwwwwwwwwwwwwwww', 'AC', '', 'Delete', '2015-03-10 14:13:57'),
('RTH1500099', 'TYP1500048', 'candra denyy', 123456, 233, 'zzzzzzzzzzzzwwwwwwwwwwwwwwwwww', 'AC', '', 'Delete', '2015-03-10 14:13:58'),
('RTH1500100', 'TYP1500049', 'wewwww', 123456777, 1233, 'zzzzzzzzzzzzzzzzzzzwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwwww', 'CCTV', '', 'Insert', '2015-03-10 14:16:15'),
('RTH1500101', 'TYP1500050', 'wewwwww', 34567, 345, 'cctvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvvv', 'CCTV', '', 'Insert', '2015-03-10 14:22:25'),
('RTH1500102', 'TYP1500051', 'luxury room', 2147483647, 658, 'zzzzzzzzzzzzzzzzzzzzzzzzzwwwwwwwwwwwwwwwwwwwwww', 'CCTV', '', 'Insert', '2015-03-10 14:36:39'),
('RTH1500103', 'TYP1500052', 'push', 8099, 8877, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'TV', '', 'Insert', '2015-03-10 14:39:54'),
('RTH1500104', 'TYP1500053', 'tes', 2323, 213, 'sadadwdawdawdawdawdawda', 'AC', '', 'Insert', '2015-03-10 15:17:38'),
('RTH1500105', 'TYP1500054', '2323213', 213123213, 21, 'wdadawdawdadwdawda', 'AC', '', 'Insert', '2015-03-10 15:20:07'),
('RTH1500106', 'TYP1500055', 'qweee', 123123, 111, 'faff', 'gggg', '', 'Insert', '2015-03-12 17:21:40'),
('RTH1500107', 'TYP1500056', 'qweeeass', 123123, 111, 'faff', 'gggg', '', 'Insert', '2015-03-12 17:23:05'),
('RTH1500108', 'TYP1500057', 'qweeeasss', 123123, 111, 'faff', 'gggg', '', 'Insert', '2015-03-12 17:25:39'),
('RTH1500109', 'TYP1500058', 'qwt', 123123, 111, 'faff', 'gggg', '', 'Insert', '2015-03-12 17:27:12'),
('RTH1500110', 'TYP1500059', 'ttttttt', 123123, 111, 'faff', 'gggg', '', 'Insert', '2015-03-12 17:35:18'),
('RTH1500111', 'TYP1500026', 'ever', 3456, 1234, 'zzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzzz', 'CCTV', '', 'Delete', '2015-03-22 21:11:35');

-- --------------------------------------------------------

--
-- Table structure for table `roomtype_pic`
--

CREATE TABLE IF NOT EXISTS `roomtype_pic` (
  `ID_RoomType_Pic` char(10) NOT NULL DEFAULT '',
  `ID_RoomType` char(10) NOT NULL DEFAULT '',
  `Picture` varchar(100) NOT NULL,
  `Main_Pic` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_RoomType_Pic`,`ID_RoomType`),
  KEY `ID_RoomType` (`ID_RoomType`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roomtype_pic`
--

INSERT INTO `roomtype_pic` (`ID_RoomType_Pic`, `ID_RoomType`, `Picture`, `Main_Pic`) VALUES
('PIR1400001', 'TYP1400001', 'deluxe.jpg', 'YES'),
('PIR1400002', 'TYP1400001', 'deluxe2.jpg', 'NO'),
('PIR1400003', 'TYP1400002', 'superior.jpg', 'NO'),
('PIR1400004', 'TYP1400002', 'superior2.jpg', 'YES'),
('PIR1500032', 'TYP1500027', 'retttt.jpg', 'YES'),
('PIR1500031', 'TYP1500026', 'ever.jpg', 'YES'),
('PIR1500029', 'TYP1500024', 'every .jpg', 'YES'),
('PIR1500030', 'TYP1500025', 'everyy.jpg', 'YES'),
('PIR1500028', 'TYP1500023', 'every weww.jpg', 'YES'),
('PIR1500027', 'TYP1500022', 'every wew.jpg', 'YES'),
('PIR1500026', 'TYP1500021', 'weww.jpg', 'YES'),
('PIR1500025', 'TYP1500020', 'wew.jpg', 'YES'),
('PIR1500023', 'TYP1500018', 'newas.jpeg', 'YES'),
('PIR1500024', 'TYP1500019', 'ahhahaha.jpg', 'YES'),
('PIR1500022', 'TYP1500017', 'rererere.jpeg', 'YES'),
('PIR1500021', 'TYP1500016', 'wewew.jpeg', 'YES'),
('PIR1500020', 'TYP1500015', 'irhamsi.jpg', 'YES'),
('PIR1500019', 'TYP1500014', 'aam.jpg', 'YES'),
('PIR1500018', 'TYP1500013', 'nama3.jpg', 'YES'),
('PIR1500017', 'TYP1500012', 'kamar.jpg', 'YES'),
('PIR1500016', 'TYP1500011', 'nama1.jpg', 'YES'),
('PIR1500015', 'TYP1500010', 'nama.jpg', 'YES'),
('PIR1500014', 'TYP1500009', 'name.jpg', 'YES'),
('PIR1500013', 'TYP1500008', 'hahsdjkdkjj.jpg', 'YES'),
('PIR1500012', 'TYP1500007', 'zzzzz.jpg', 'YES'),
('PIR1500011', 'TYP1500006', 'zzzzzzzzzz.jpg', 'YES'),
('PIR1500010', 'TYP1500005', 'nnnnnn.jpg', 'YES'),
('PIR1500009', 'TYP1500004', 'yyyyyy3.jpg', 'YES'),
('PIR1500008', 'TYP1500004', 'yyyyyy2.jpg', 'NO'),
('PIR1500007', 'TYP1500004', 'yyyyyy1.jpg', 'NO'),
('PIR1500006', 'TYP1500004', 'yyyyyy.jpg', 'NO'),
('PIR1500005', 'TYP1500003', 'zzz1.jpg', 'YES'),
('PIR1500004', 'TYP1500003', 'zzz.jpg', 'NO'),
('PIR1500003', 'TYP1500002', 'rafed.jpg', 'YES'),
('PIR1500002', 'TYP1500001', 'asdasd1.jpg', 'YES'),
('PIR1500001', 'TYP1500001', 'asdasd.jpg', 'NO'),
('PIR1500033', 'TYP1500028', 'eeeee.jpeg', 'YES'),
('PIR1500034', 'TYP1500029', 'hy.jpeg', 'YES'),
('PIR1500035', 'TYP1500030', 'yuy.jpeg', 'YES'),
('PIR1500036', 'TYP1500031', 'bbbb.jpg', 'NO'),
('PIR1500037', 'TYP1500031', 'bbbb', 'YES'),
('PIR1500038', 'TYP1500032', 'akuuu.jpg', 'NO'),
('PIR1500042', 'TYP1500033', 'delete.jpg', 'YES'),
('PIR1500040', 'TYP1500032', 'akuuu1.jpg', 'YES'),
('PIR1500041', 'TYP1500032', 'akuuu2.jpg', 'NO'),
('PIR1500043', 'TYP1500034', 'esb.jpg', 'YES'),
('PIR1500044', 'TYP1500035', 'rrerr.jpg', 'YES'),
('PIR1500045', 'TYP1500036', 'jhjhjh.jpeg', 'YES'),
('PIR1500046', 'TYP1500037', 'gian.jpg', 'YES'),
('PIR1500047', 'TYP1500038', 'zxc.jpeg', 'YES'),
('PIR1500048', 'TYP1500039', 'zxcccca.jpeg', 'YES'),
('PIR1500049', 'TYP1500040', 'zxccccazzax.jpeg', 'YES'),
('PIR1500050', 'TYP1500041', 'zxccccazzaxdas.jpeg', 'YES'),
('PIR1500051', 'TYP1500042', 'rtrtrt.jpg', 'YES'),
('PIR1500052', 'TYP1500043', 'zf.jpeg', 'YES'),
('PIR1500053', 'TYP1500044', 'ssd.jpg', 'YES'),
('PIR1500054', 'TYP1500045', 'rrrrrr.jpg', 'YES'),
('PIR1500055', 'TYP1500046', 'test cat.jpg', 'YES'),
('PIR1500056', 'TYP1500047', 'candra.png', 'YES'),
('PIR1500057', 'TYP1500048', 'candra denyy.jpg', 'YES'),
('PIR1500058', 'TYP1500049', 'wewwww.jpg', 'YES'),
('PIR1500059', 'TYP1500050', 'wewwwww.jpg', 'YES'),
('PIR1500060', 'TYP1500051', 'luxury room.jpg', 'YES'),
('PIR1500061', 'TYP1500052', 'push.jpg', 'YES'),
('PIR1500062', 'TYP1500053', 'tes.jpg', 'YES'),
('PIR1500063', 'TYP1500054', '2323213.jpg', 'YES'),
('PIR1500064', 'TYP1500055', 'qweee.jpeg', 'YES'),
('PIR1500065', 'TYP1500056', 'qweeeass.jpeg', 'YES'),
('PIR1500066', 'TYP1500057', 'qweeeasss.jpeg', 'YES'),
('PIR1500067', 'TYP1500058', 'qwt.jpeg', 'YES'),
('PIR1500068', 'TYP1500059', 'ttttttt.jpeg', 'YES');

-- --------------------------------------------------------

--
-- Table structure for table `roomtype_price`
--

CREATE TABLE IF NOT EXISTS `roomtype_price` (
  `ID_RoomType_Price` char(10) NOT NULL,
  `ID_RoomType` char(10) NOT NULL,
  `Start_Date` date NOT NULL,
  `End_Date` date NOT NULL,
  `Price` varchar(10) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `roomtype_price`
--

INSERT INTO `roomtype_price` (`ID_RoomType_Price`, `ID_RoomType`, `Start_Date`, `End_Date`, `Price`) VALUES
('PRC1500001', 'TYP1400001', '2015-01-01', '2015-01-31', '450000'),
('PRC1500002', 'TYP1400002', '2015-01-01', '2015-01-31', '375000');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
  `ID_Tax_History` char(10) NOT NULL DEFAULT '',
  `ID_Tax` char(10) NOT NULL DEFAULT '',
  `Tax_Name` varchar(50) NOT NULL,
  `Tax` varchar(10) NOT NULL,
  `ID_User` char(10) NOT NULL,
  `Action` varchar(10) NOT NULL,
  `Created_Date` datetime NOT NULL,
  PRIMARY KEY (`ID_Tax_History`,`ID_Tax`),
  KEY `ID_Tax` (`ID_Tax`)
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

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
-- Table structure for table `travel`
--

CREATE TABLE IF NOT EXISTS `travel` (
  `ID_Travel` int(11) NOT NULL AUTO_INCREMENT,
  `Travel_Logo` varchar(100) NOT NULL,
  `Travel_Name` varchar(100) NOT NULL,
  `Travel_Address` varchar(500) NOT NULL,
  `Travel_Telp` varchar(50) NOT NULL,
  `Travel_Email` varchar(100) NOT NULL,
  `Travel_Diskon` int(5) NOT NULL,
  `Web_Link` varchar(500) NOT NULL,
  `Status` varchar(10) NOT NULL,
  PRIMARY KEY (`ID_Travel`)
) ENGINE=MyISAM  DEFAULT CHARSET=latin1 AUTO_INCREMENT=117 ;

--
-- Dumping data for table `travel`
--

INSERT INTO `travel` (`ID_Travel`, `Travel_Logo`, `Travel_Name`, `Travel_Address`, `Travel_Telp`, `Travel_Email`, `Travel_Diskon`, `Web_Link`, `Status`) VALUES
(1, 'Iceland Travel.jpg', 'Iceland Travel', 'Jalan Protokol No.01 Jakarta Utara', '021112233', 'icelandtravel@gmail.com', 10, 'www.icelandtravel.com', 'Active'),
(2, 'Mega Travel.jpg', 'Mega Travel', 'Jalan Merdeka No.1945 Jakarta Pusat', '021789789', 'megatravel@yahoo.com', 11, 'www.megatravel.com', 'Active'),
(3, 'Travel Anytime.jpg', 'Travel Anytime', 'Jalan Mega Kuningan No.30 Jakarta Selatan', '0215468854', 'travel_anytime@yahoo.co.id', 8, 'www.travel_anytime.co.id', 'Active'),
(4, 'Sunset Bird Travel.jpg', 'Sunset Bird Travel', 'Jalan Kemanggisan Barat dan Timur , Jakarta Barat', '02188474849', 'sunsetbird_travel@yahoo.com', 10, 'www.sunsetbirdtravel.com', 'Active'),
(5, 'WHL Travel.jpg', 'WHL Travel', 'Jalan Wong Hong Long , Jakarta Selatan', '0219993784', 'whl_travel@yahoo.com', 20, 'www.whl_travel.com', 'Active'),
(46, 'icon.jpg', 'Megah Mandiri Travel & Tour 333', 'Jl. Tanjung Duren Barat I No.46 Grogol Jakarta Barat, Indonesia 11470', '021-569593195', 'megahmandiri1@mandiiri.com', 0, 'http://protoagent.asia/', 'Active'),
(106, 'icon.jpg', 'Megah Mandiri Travel & Tour', 'Jl. Tanjung Duren Barat I No.46 Grogol Jakarta Barat, Indonesia 11470', '021-569593195', 'megahmandiri1aa@mandiiri.com', 0, 'http://protoagent.asia/', 'Active'),
(75, 'icon.jpg', 'coba dulu', 'Jl. Tanjung Duren Barat I No.46 Grogol Jakarta Barat, Indonesia 11470', '021-569593195', 'megahmandiri1@mandiiri.com', 0, 'http://protoagent.asia/', 'Active'),
(68, 'icon.jpg', 'test agent', 'Jl. Tanjung Duren Barat I No.46 Grogol Jakarta Barat, Indonesia 11470', '021-569593195', 'megahmandiri1@mandiiri.com', 0, 'http://protoagent.asia/', 'Active'),
(67, 'icon.jpg', 'test agent', 'Jl. Tanjung Duren Barat I No.46 Grogol Jakarta Barat, Indonesia 11470', '021-569593195', 'megahmandiri1@mandiiri.com', 0, 'http://protoagent.asia/', 'Active'),
(66, 'icon.jpg', 'test agent', 'Jl. Tanjung Duren Barat I No.46 Grogol Jakarta Barat, Indonesia 11470', '021-569593195', 'megahmandiri1@mandiiri.com', 0, 'http://protoagent.asia/', 'Active');

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
) ENGINE=MyISAM DEFAULT CHARSET=latin1;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`ID_User`, `Role`, `Username`, `Password`, `Name`, `DOB`, `Email`, `Status`) VALUES
('USR1400001', 'Admin', 'rendy', 'akhiong', 'Rendy Arsanto', '1993-08-01', 'rendymochi@yahoo.com', 'Active'),
('USR1400002', 'Admin', 'deny', 'deny123', 'Deny Setiawan', '1993-05-05', 'denysetiawan@gmail.com', 'Active'),
('USR1400003', 'Staff', 'jeanni', 'jeanni', 'Jeanni Susindra', '1993-01-23', 'jeannisusindra@yahoo.com', 'Active'),
('USR1400004', 'Staff', 'jason', 'jason', 'Jason Setiadarma', '1993-10-01', 'jasonsetiadarma@yahoo.com', 'Active'),
('USR1400005', 'Admin', 'erlina', 'erlina', 'Erlina Indra', '1993-09-06', 'erlina.indra@rocketmail.com', 'Active');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
