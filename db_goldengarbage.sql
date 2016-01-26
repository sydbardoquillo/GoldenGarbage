-- phpMyAdmin SQL Dump
-- version 4.3.11
-- http://www.phpmyadmin.net
--
-- Host: 127.0.0.1
-- Generation Time: Nov 12, 2015 at 04:56 AM
-- Server version: 5.6.24
-- PHP Version: 5.5.24

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `db_goldengarbage`
--

-- --------------------------------------------------------

--
-- Table structure for table `tb_js_account`
--

CREATE TABLE IF NOT EXISTS `tb_js_account` (
  `js_ID` varchar(6) NOT NULL COMMENT 'ID number for the junkshop',
  `js_active_flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Activation status of the junkshop',
  `js_username` text NOT NULL COMMENT 'Username account of the junkshop',
  `js_password` text NOT NULL COMMENT 'Encrypted password of the junkshop',
  `js_key` text NOT NULL COMMENT 'Authentication key for the junkshop',
  `js_activation` text NOT NULL COMMENT 'Activation key for the Junkshop'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_js_account`
--

INSERT INTO `tb_js_account` (`js_ID`, `js_active_flag`, `js_username`, `js_password`, `js_key`, `js_activation`) VALUES
('GGO01', 1, 'rustomadmin', 'kjnebjBtZs27sleantjj07XR601mMDZmMzBmYTYz', 'f06f30fa63', 'GGO1-ABCDE'),
('GGO02', 1, 'AntonioAdmin', 'scug7+CEujDiZIrBbc57ddDD+uMwYWYzYWU0N2Fj', '0af3ae47ac', 'GGO2-JHWQR'),
('GGO03', 0, '', '', '', 'GGO3-KJHASF'),
('GGO04', 0, '', '', '', 'GGO4-KJHASD'),
('GGO05', 0, '', '', '', 'GGO5-KHJADS'),
('GGO06', 0, '', '', '', 'GGO06-AAA000'),
('GGO07', 0, '', '', '', 'GGO07-AAA111'),
('GGO08', 0, '', '', '', 'GGO08-AAB112'),
('GGO09', 0, '', '', '', 'GGO09-AAC113'),
('GGO10', 0, '', '', '', 'GGO10-AAD114'),
('GGO11', 0, '', '', '', 'GGO11-AAE115'),
('GGO12', 0, '', '', '', 'GGO12-AAF116'),
('GGO13', 0, '', '', '', 'GGO13-AAG117'),
('GGO14', 0, '', '', '', 'GGO14-AAH118'),
('GGO15', 0, '', '', '', 'GGO15-AAJ119'),
('GGO16', 0, '', '', '', 'GGO16-AAK110'),
('GGO17', 0, '', '', '', 'GGO17-AAL121'),
('GGO18', 0, '', '', '', 'GGO18-AAM122'),
('GGO19', 0, '', '', '', 'GGO19-AAN123'),
('GGO20', 0, '', '', '', 'GGO20-AAO124'),
('GGO21', 1, 'ecrc', 'IU8ATOfNg5pJ6vzJQzVV8j/9u6U3YmQ4MjA3ODk2', '7bd8207896', 'GGO21-CITU');

-- --------------------------------------------------------

--
-- Table structure for table `tb_js_info`
--

CREATE TABLE IF NOT EXISTS `tb_js_info` (
  `js_ID` varchar(6) NOT NULL COMMENT 'ID number of the junkshop',
  `js_name` text NOT NULL COMMENT 'Name of the junkshop',
  `js_owner` text NOT NULL COMMENT 'Owner name of the junkshop',
  `js_contact_number` text COMMENT 'Contact number/s of the junkshop',
  `js_address` text NOT NULL COMMENT 'Address of the junkshop',
  `js_pickup_flag` tinyint(1) NOT NULL DEFAULT '0' COMMENT 'Flag if the junkshop accepts pick-up option',
  `js_lat` double NOT NULL COMMENT 'Latitude value of the junkshop',
  `js_log` double NOT NULL COMMENT 'Longitude value of the junkshop'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_js_info`
--

INSERT INTO `tb_js_info` (`js_ID`, `js_name`, `js_owner`, `js_contact_number`, `js_address`, `js_pickup_flag`, `js_lat`, `js_log`) VALUES
('GGO01', 'ROSTOM TAGONOL JUNK SHOP', 'Rostom Tagonol', '133-3456', 'Basak Pardo, Cebu City', 1, 10.282714, 123.860282),
('GGO02', 'TONY BATIQUIN JUNKSHOP', 'Tony Batiquine', '233-2087,09428005178', '101 Gen. Maxilom, Andres Soriano, Careta, Cebu City', 1, 10.310288, 123.895717),
('GGO03', 'Y & B ANGELS JUNKSHOP', 'Clareta Lasola', '413-7942', 'J. de Vera St. North Reclamation Area, Careta, Cebu City', 0, 10.307794, 123.913353),
('GGO04', 'JT JUNKSHOP', 'Juliane Tan', '253-2913', 'McArthur Highway, San Roque, Cebu City', 0, 10.295897, 123.904602),
('GGO05', 'JOHNREX STORE', 'Cecilia Flores', '09195524360', 'Pier 2, Brgy. San Roque, Cebu City', 0, 10.294588, 123.908723),
('GGO06 ', 'MILIN JUNKIES', '', '413-2080', 'Pier 3,Sitio Silangan, Brgy. Tinago, Cebu City', 0, 10.298066, 123.908018),
('GGO07 ', 'L & L IGNACIO TRADING & GEN. MERCHANDISE', 'Rustom Ignacio', '272-4239', '20 Lopez Jaena St., Tinago, Cebu City', 0, 10.299659, 123.904376),
('GGO08 ', 'MANDAUE STEEL SURPLUS', 'Eliseo Caldino', '345-8357', 'Albana St., Maguikay, Mandaue City', 0, 10.338208, 123.935419),
('GGO09 ', 'E & J SCRAP BUYER', '', '343-7806', 'M. Ceniza, Casuntingan Mandaue City', 0, 10.345257, 123.934801),
('GGO10 ', 'GORNE JUNKSHOP', '', '', 'Golden Valley, Lahug, Cebu City', 0, 10.298612, 123.898166),
('GGO11 ', 'JPH JUNKSHOP', '', '', 'Maracas, Lahug, cebu City', 0, 10.335021, 123.896689),
('GGO12 ', 'LEDE JUNKSHOP', '', '235-9271', 'Hipodromo, Cebu City', 0, 10.311406, 123.908745),
('GGO13 ', 'FERLON JUNKYARD', '', '412-0581, 233-0609, 235-6711', 'Hipodromo, Cebu City', 0, 10.311942, 123.908658),
('GGO14 ', 'CT RECYCLABLES ENTERPRISES', '', '', 'Tupas St., Cebu City', 0, 10.292814, 123.893667),
('GGO15 ', 'TUDTUD TRADING GENERAL', '', '418-8332', '184 Tupas Sawang Calero, Cebu City', 0, 10.291162, 123.889801),
('GGO16 ', 'TUPAS ENTERPRISES', '', '', '123 Tupas St., Cebu City', 0, 10.292701, 123.892864),
('GGO17 ', 'BILLY ENTERPRISES', '', '', 'Carlo St. San Nicolas, Cebu City', 0, 10.293659, 123.887028),
('GGO18 ', 'LEVIS JUNKSHOP', '', '', 'L. Jaime St. Bakilid II, Mandaue City', 0, 10.33746, 123.93532),
('GGO19 ', 'MANDAUE STEEL SURPLUS II', 'Eliseo Caldino', '345-8357', 'L.Jaime ST. Bakilid II, Mandaue City\r\n', 0, 10.337756, 123.935235),
('GGO20 ', 'NACIOS JUNKSHOP', '', '', 'D. Albano St. Subangdaku, Mandaue City\r\n', 0, 10.321456, 123.924075),
('GGO21', 'CIT-U JUNKSHOP', 'Ralph Laviste', '262-7281', 'N. Bacalso Avenue, Cebu City', 1, 10.2940917, 123.881164);

-- --------------------------------------------------------

--
-- Table structure for table `tb_js_items`
--

CREATE TABLE IF NOT EXISTS `tb_js_items` (
  `item_ID` int(11) NOT NULL COMMENT 'Item ID number',
  `js_ID` varchar(6) NOT NULL COMMENT 'ID number of the junkshop',
  `js_item_name` text NOT NULL COMMENT 'Name of the buyable item',
  `js_item_price` float NOT NULL COMMENT 'Price of the item'
) ENGINE=InnoDB AUTO_INCREMENT=167 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_js_items`
--

INSERT INTO `tb_js_items` (`item_ID`, `js_ID`, `js_item_name`, `js_item_price`) VALUES
(2, 'GGO01', 'Sheet Metal', 5),
(3, 'GGO01', 'Carton', 2),
(4, 'GGO01', 'Paper', 0.6),
(5, 'GGO01', 'Aluminum Cans', 48),
(6, 'GGO01', 'Puthaw', 8.5),
(7, 'GGO01', 'Caldero', 40),
(8, 'GGO01', 'Mineral Water Bottle', 15),
(9, 'GGO02', 'Non-Ferrus', 5),
(10, 'GGO02', 'Copper Wire', 150),
(11, 'GGO02', 'Brass', 80),
(12, 'GGO02', 'Can/Aluminum', 60),
(13, 'GGO02', 'Aluminum (Heavy)', 60),
(14, 'GGO02', 'Aluminum (Light)', 50),
(15, 'GGO02', 'Plastic (Assorted)', 7),
(16, 'GGO02', 'Sink', 15),
(17, 'GGO02', 'Tingga', 20),
(18, 'GGO02', 'Kaldero', 45),
(19, 'GGO02', 'Bottles', 0.4),
(20, 'GGO03', 'Puthaw', 8),
(21, 'GGO03', 'GI Sheets', 4),
(22, 'GGO03', 'Plastic (Bowing)', 10),
(23, 'GGO03', 'Plastic (Assorted)', 8),
(24, 'GGO03', 'Plastic (Mineral Water)', 1.5),
(25, 'GGO03', 'Copper', 145),
(26, 'GGO03', 'Stainless', 50),
(27, 'GGO03', 'Brass', 90),
(28, 'GGO03', 'Cap', 15),
(29, 'GGO03', 'Can', 45),
(30, 'GGO03', 'Tingga', 12),
(31, 'GGO03', 'Powder (Battery Plates)', 8),
(32, 'GGO03', 'Copper Wire', 8),
(33, 'GGO04', 'Scrap Metal', 7.5),
(34, 'GGO04', 'Aluminum Can', 53),
(35, 'GGO04', 'Radiator', 75),
(36, 'GGO04', 'Copper', 160),
(37, 'GGO04', 'Brass', 100),
(38, 'GGO04', 'Jalousie', 63),
(39, 'GGO04', 'Zinc', 100),
(40, 'GGO04', 'Stainless', 53),
(41, 'GGO04', 'Tingga', 25),
(42, 'GGO04', 'Kaldero', 46),
(43, 'GGO05', 'Natures Spring', 12),
(44, 'GGO05', 'Plastic Cups', 4),
(45, 'GGO06', 'Copper', 150),
(46, 'GGO06', 'Brass', 90),
(47, 'GGO06', 'Stainless', 50),
(48, 'GGO06', 'Aluminum (Light)', 55),
(49, 'GGO06', 'Aluminum (Heavy)', 60),
(50, 'GGO06', 'Condenser', 55),
(51, 'GGO06', 'Kaldero', 40),
(52, 'GGO06', 'Puthaw', 8),
(53, 'GGO06', 'Tingga', 15),
(54, 'GGO07', 'Carton', 2),
(55, 'GGO07', 'Chipboard', 0.6),
(56, 'GGO07', 'Newspaper', 1.25),
(57, 'GGO07', 'Newsprint', 2),
(58, 'GGO07', 'Office Paper', 1),
(59, 'GGO07', 'Computer Paper', 2.5),
(60, 'GGO07', 'White Bond', 6),
(61, 'GGO07', 'One-Sided Paper', 1.5),
(62, 'GGO07', 'Puthaw/Scrap Iron', 10),
(63, 'GGO07', 'Metal (Oversize)', 7),
(64, 'GGO07', 'Steelplate', 3),
(65, 'GGO07', 'Barrel', 3),
(66, 'GGO07', 'Lata/ Tin Cans', 1.25),
(67, 'GGO07', 'Lansang', 2.25),
(68, 'GGO07', 'Tornos', 1),
(69, 'GGO07', 'Sin / GI Sheets', 2.25),
(70, 'GGO07', 'Puthaw (Mix)', 5),
(71, 'GGO07', 'Aluminum (Cans)', 48),
(72, 'GGO07', 'Aluminum (Basa)', 58),
(73, 'GGO07', 'Aluminum (Nipis)', 55),
(74, 'GGO07', 'Aluminum (Caldero) ', 45),
(75, 'GGO07', 'Aluminum (Takob)', 15),
(76, 'GGO07', 'Wire A (Bronze Red)', 130),
(77, 'GGO07', 'Wire B (Bronze)', 115),
(78, 'GGO07', 'Wire C (Bronze)', 155),
(79, 'GGO07', 'Brass (Nipis)', 60),
(80, 'GGO07', 'Brass (Yellow)', 60),
(81, 'GGO07', 'Wire (Panit)', 60),
(82, 'GGO07', 'Zinc', 12),
(83, 'GGO07', 'Stainless', 50),
(84, 'GGO07', 'Battery Powder', 2),
(85, 'GGO07', 'Radiator', 30),
(86, 'GGO07', 'PET', 15),
(87, 'GGO07', 'Blowing/Hope', 10),
(88, 'GGO07', 'PP', 8.5),
(89, 'GGO07', 'Baso-Baso', 5),
(90, 'GGO07', 'Plastic Nipis/LDPE', 5),
(91, 'GGO07', 'CD', 4),
(92, 'GGO07', 'X-RAY Film', 15),
(93, 'GGO07', 'Graphic Film', 15),
(94, 'GGO07', 'Assorted Plastic', 8.5),
(95, 'GGO07', 'Bildo (Puti/Cullets)', 0.8),
(96, 'GGO07', 'Kandila', 12),
(97, 'GGO08', 'Steel', 10),
(98, 'GGO08', 'Tin Can', 48),
(99, 'GGO08', 'Aluminum', 60),
(100, 'GGO08', 'Caldero', 45),
(101, 'GGO08', 'Copper', 75),
(102, 'GGO08', 'Brass', 100),
(103, 'GGO08', 'Stainless', 55),
(104, 'GGO09', 'Puthaw', 9.75),
(105, 'GGO10', 'PT (Mineral Water)', 9.75),
(106, 'GGO10', 'Ordinary Plastic', 5),
(107, 'GGO10', 'Blowing', 10),
(108, 'GGO10', 'Lata', 1),
(109, 'GGO10', 'Puthaw', 7),
(110, 'GGO10', 'Carton', 1),
(111, 'GGO10', 'Aluminum Can', 50),
(112, 'GGO10', 'Bronze (Copper Wire)', 50),
(113, 'GGO10', 'Bronze (Brass)', 60),
(114, 'GGO11', 'Blowing', 11),
(115, 'GGO11', 'Mineral Water', 12),
(116, 'GGO11', 'Puthaw', 8),
(117, 'GGO11', 'Aluminum', 50),
(118, 'GGO11', 'Lata', 1),
(119, 'GGO11', 'Carton', 2),
(120, 'GGO11', 'Bondpaper', 8),
(121, 'GGO11', 'Galvanized', 4),
(122, 'GGO12', 'Mineral Water', 15),
(123, 'GGO12', 'Blowing', 12),
(124, 'GGO12', 'Aluminum Can', 60),
(125, 'GGO12', 'Lata', 2),
(126, 'GGO12', 'Puthaw', 8),
(127, 'GGO12', 'Carton', 2),
(128, 'GGO12', 'Bondpapers', 10),
(129, 'GGO12', 'Newsprint', 1),
(130, 'GGO13', 'Mineral Water (PEP)', 15),
(131, 'GGO13', 'Blowing (Alcohol)', 12),
(132, 'GGO13', 'Blowing (Shampoo)', 12),
(133, 'GGO13', 'Blowing (Gallon)', 12),
(134, 'GGO13', 'Blowing (Container)', 12),
(135, 'GGO13', 'Injection (Pails)', 8),
(136, 'GGO13', 'Injection (Plate)', 8),
(137, 'GGO13', 'Injection (Wash Basin)', 8),
(138, 'GGO13', 'Computer Paper', 10),
(139, 'GGO13', 'Manuscript', 10),
(140, 'GGO13', 'Carton', 10),
(141, 'GGO13', 'Folder', 2),
(142, 'GGO13', 'Folder (US)', 10),
(143, 'GGO13', 'Folder (Brown)', 10),
(144, 'GGO14', 'Cullets', 0.6),
(145, 'GGO15', 'Plastic', 7),
(146, 'GGO15', 'Puthaw', 7),
(147, 'GGO16', 'Plastic', 7),
(148, 'GGO16', 'Puthaw', 6),
(149, 'GGO17', 'Plastic', 4),
(150, 'GGO17', 'Puthaw', 7),
(151, 'GGO18', 'Puthaw', 9.75),
(152, 'GGO18', 'Caplet', 5.5),
(153, 'GGO18', 'Aluminum Bag', 57),
(154, 'GGO18', 'Calderen', 51),
(155, 'GGO18', 'Caldero', 41),
(156, 'GGO18', 'Copper C', 165),
(157, 'GGO19', 'Metal', 10),
(158, 'GGO19', 'Aluminum', 62),
(159, 'GGO19', 'Copperwire', 158),
(160, 'GGO19', 'Sin', 195),
(161, 'GGO20', 'Metal', 8),
(163, 'GGO02', 'Katzoll V2', 10),
(164, 'GGO21', 'Orange Booklet', 10),
(165, 'GGO21', 'Plastic Cups', 7),
(166, 'GGO21', 'cd', 100);

-- --------------------------------------------------------

--
-- Table structure for table `tb_js_reviews`
--

CREATE TABLE IF NOT EXISTS `tb_js_reviews` (
  `comt_ID` int(11) NOT NULL COMMENT 'Comment ID number',
  `js_ID` varchar(6) NOT NULL COMMENT 'ID number of the junkshop',
  `us_ID` varchar(6) NOT NULL COMMENT 'ID number of the User',
  `js_star` float NOT NULL COMMENT 'Star rating of the comment',
  `js_comment` text NOT NULL COMMENT 'Content of the comment',
  `comment_date` datetime NOT NULL
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_js_reviews`
--

INSERT INTO `tb_js_reviews` (`comt_ID`, `js_ID`, `us_ID`, `js_star`, `js_comment`, `comment_date`) VALUES
(1, 'GGO17 ', 'GGU2', 5, 'testing 2', '2015-10-16 10:46:50'),
(2, 'GGO21', 'GGU1', 5, 'This junkshop helped me get rid of all my booklets. Nice!', '2015-10-16 10:50:02'),
(3, 'GGO21', 'GGU2', 5, 'Very good service!!', '2015-10-16 10:48:47'),
(4, 'GGO12 ', 'GGU3', 3.5, 'd th hbgg', '2015-10-16 11:19:55');

-- --------------------------------------------------------

--
-- Table structure for table `tb_us_account`
--

CREATE TABLE IF NOT EXISTS `tb_us_account` (
  `us_ID` varchar(6) NOT NULL COMMENT 'ID number of the user',
  `js_username` text NOT NULL COMMENT 'Username of the user',
  `js_password` text NOT NULL COMMENT 'Encrypted password of the user',
  `js_key` text NOT NULL COMMENT 'Authentication key for the user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_us_account`
--

INSERT INTO `tb_us_account` (`us_ID`, `js_username`, `js_password`, `js_key`) VALUES
('GGU1', 'abella123', 'VWV9p2fIYopQz7OlykMKgAsnMz5jOTMxNDEwYmRk', 'c931410bdd'),
('GGU2', 'anton', 'oW2dBuU98T/3GscKJ5gAkyxa3Q42NjNmMWZhZWU0', '663f1faee4'),
('GGU3', 'ralph', 'an/Gjk9gaWQILyJ51k5M3rUzfENiMTE4ODliNmQ4', 'b11889b6d8');

-- --------------------------------------------------------

--
-- Table structure for table `tb_us_info`
--

CREATE TABLE IF NOT EXISTS `tb_us_info` (
  `us_ID` varchar(6) NOT NULL COMMENT 'ID number of the user',
  `us_firstname` text NOT NULL COMMENT 'Firstname of the user',
  `us_lastname` text NOT NULL COMMENT 'Lastname of the user'
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tb_us_info`
--

INSERT INTO `tb_us_info` (`us_ID`, `us_firstname`, `us_lastname`) VALUES
('GGU1', 'Princess', 'Lykken'),
('GGU2', 'Antonio', 'Sotto Jr.'),
('GGU3', 'Ralph', 'Laviste');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tb_js_account`
--
ALTER TABLE `tb_js_account`
  ADD UNIQUE KEY `js_ID` (`js_ID`);

--
-- Indexes for table `tb_js_info`
--
ALTER TABLE `tb_js_info`
  ADD UNIQUE KEY `js_ID` (`js_ID`);

--
-- Indexes for table `tb_js_items`
--
ALTER TABLE `tb_js_items`
  ADD PRIMARY KEY (`item_ID`);

--
-- Indexes for table `tb_js_reviews`
--
ALTER TABLE `tb_js_reviews`
  ADD PRIMARY KEY (`comt_ID`);

--
-- Indexes for table `tb_us_account`
--
ALTER TABLE `tb_us_account`
  ADD UNIQUE KEY `us_ID` (`us_ID`);

--
-- Indexes for table `tb_us_info`
--
ALTER TABLE `tb_us_info`
  ADD UNIQUE KEY `us_ID` (`us_ID`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tb_js_items`
--
ALTER TABLE `tb_js_items`
  MODIFY `item_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Item ID number',AUTO_INCREMENT=167;
--
-- AUTO_INCREMENT for table `tb_js_reviews`
--
ALTER TABLE `tb_js_reviews`
  MODIFY `comt_ID` int(11) NOT NULL AUTO_INCREMENT COMMENT 'Comment ID number',AUTO_INCREMENT=5;
/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
