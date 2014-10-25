-- phpMyAdmin SQL Dump
-- version 3.5.5
-- http://www.phpmyadmin.net
--
-- Host: localhost
-- Generation Time: Oct 25, 2014 at 09:01 AM
-- Server version: 5.5.40-36.1
-- PHP Version: 5.4.23

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8 */;

--
-- Database: `ezyfinde_INB313`
--

-- --------------------------------------------------------

--
-- Table structure for table `designs`
--

CREATE TABLE IF NOT EXISTS `designs` (
  `DesignID` int(11) NOT NULL,
  `Description` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `File` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Categories` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Price` double NOT NULL,
  `Available` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Material` int(11) NOT NULL,
  PRIMARY KEY (`DesignID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `designs`
--

INSERT INTO `designs` (`DesignID`, `Description`, `File`, `Categories`, `Name`, `Price`, `Available`, `Author`, `Material`) VALUES
(2, 'A figurine of the classic league of legends character Riven.', '2.jpg', 'riven,league,of,legends,lego,legions,figurine,league of legends,lol,jbles95,green,white,gold', 'Riven Figurine', 45, 'Yes', '1', 2),
(8, 'Unlock your Dreams and any door with your very own KEY TO SUCCESS!', '8.jpg', 'Key, Sucess, Business', 'Key To Success', 75, 'Yes', '4', 8),
(6, 'Drop Resistant iPhone 5 Case', '6.jpg', 'iPhone,Case,Drop', 'Drop Resistant Case', 10, 'Yes', '4', 3),
(1, 'A badge of the Diamond icon in league of legends. Diamond III account with all champions and 1 RP. Not a scam.', '1.png', 'lol,league,legends,account,diamond,OCE,EZ,III,3,LCS,Dyrus,Dunkey,blue', 'Diamond Badge', 250, 'Yes', '10', 1),
(5, 'http://i.imgur.com/q0ooI8V.jpg, now you can download a car! Or at least 3D print it.', '5.jpg', 'youwouldntdownloadacar,vroom,car,zututu', 'Weird Car', 150, 'Yes', '9', 3),
(3, 'War Hammer 40k: Centurion Space Marine', '3.jpg', '40K, War Hammer, Game,figurine, blue', 'Space Marine - Centurion', 30, 'Yes', '4', 1),
(4, 'It''s not stock but it does run. Really really blue.', '4.jpg', 'WRX,Subaru,blue,2005,car,quality,money,transport,automobile,box with wheels,model', 'Subaru WRX 2005 Model', 2, 'Yes', '10', 7),
(9, 'Bronze house model, are you a tiny person? This house could be for you.', '9.jpg', 'house,room,big,loadsomone,model', 'House Model', 150, 'Yes', '9', 8),
(10, 'Minecraft world model, square and with various blocks from the game.', '10.jpg', 'minecraft, game, model, planet, world', 'Minecraftia', 45, 'Yes', '4', 5),
(11, 'It''s pretty good for deflecting vicious magpie attacks. Also doubles as an icebreaker for conversation at parties.', '11.jpg', 'plastic,arm,gauntlet,magpie,deflect,protect,protection,safe,mate,fix', 'Wicked plastic arm gauntlet', 25, 'Yes', '10', 7),
(12, 'The crab-like scurry robot is a utility robot model used by the Calculator, the mad cyborg from Vault 0, in the Midwest in the year of 2197.', '12.jpg', 'Fallout, Game, Model, robot, figurine, spider', 'Scurry', 20, 'Yes', '4', 1),
(13, 'Very scary. Is great for taking pesky kids away and draining them of their body fluid. Takes care of itself, perfect pet for the kids. Also doubles as an icebreaker for conversation at parties.', '13.jpeg', 'spider,kids,children,murder,pets,pet,dog,cat,blu,tack,blu tack,scary,very scary,extreme,blue', 'Scary Spider', 45, 'Yes', '10', 5),
(14, 'A model gun, doesn''t actually function but is still cool.', '14.jpg', 'pewpew,shoot,tonyabbott,blue,iveyettomeetonewhocanoutsmartbullet', 'Gun', 3.5, 'Yes', '9', 6),
(15, 'Behold this Majestic Forest Landscape.', '15.jpg', 'Forest, Landscape, world, model', 'King of the Forest', 130, 'Yes', '4', 4),
(16, 'Volkswagen keychain, great for holding keys! Also super cheap.', '16.jpg', 'vw,volkswagen,keychain,car,keys', 'VW Keychain', 0.01, 'Yes', '1', 1),
(17, 'fghfg', '17.jpg', 'cat,dog,bat,blue,penguin', 'Penguin', 25, 'Yes', '1', 5);

-- --------------------------------------------------------

--
-- Table structure for table `materials`
--

CREATE TABLE IF NOT EXISTS `materials` (
  `MaterialID` int(11) NOT NULL,
  `Name` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `CostPerCubicCM` double NOT NULL,
  `MinimumThick` double NOT NULL,
  `ExtraDetails` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`MaterialID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `materials`
--

INSERT INTO `materials` (`MaterialID`, `Name`, `CostPerCubicCM`, `MinimumThick`, `ExtraDetails`) VALUES
(1, 'Metallic Plastic', 1.75, 2, 'Light, not very strong.'),
(2, 'Gold', 867, 3, 'Very expensive, very weak, very premium.'),
(3, 'Strong & Flexible Plastic', 0.8, 2, 'Very strong, very flexible'),
(4, 'Ceramics', 0.35, 0.1, 'Very brittle, food safe'),
(5, 'Castable Wax', 8, 1, 'Very maluable, heat sensitive'),
(6, 'Colour Sandstone', 0.75, 2, 'Rough texture, brittle'),
(7, 'Elasto Plastic', 1.75, 0.2, 'Rubbery, very durable'),
(8, 'Bronze', 18, 1.2, 'Selling bronze dagger 5gp each');

-- --------------------------------------------------------

--
-- Table structure for table `orders`
--

CREATE TABLE IF NOT EXISTS `orders` (
  `OrderID` int(11) NOT NULL,
  `CreatedBy` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `OrderCost` double NOT NULL,
  `ItemsOrdered` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `DateOrdered` datetime NOT NULL,
  `Status` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`OrderID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`OrderID`, `CreatedBy`, `OrderCost`, `ItemsOrdered`, `DateOrdered`, `Status`) VALUES
(8, '1', 47, '13 4', '2014-10-23 11:42:07', 'Payment Pending'),
(2, '1', 420, '5', '2014-10-22 03:43:57', 'Payment Pending'),
(3, '1', 0.01, '9', '2014-10-22 03:45:23', 'Shipped'),
(4, '4', 0.01, '9', '2014-10-22 03:46:32', 'Payment Pending'),
(5, '4', 0.01, '9', '2014-10-22 03:48:23', 'Payment Pending'),
(6, '6', 0.01, '9', '2014-10-22 03:49:11', 'Payment Pending'),
(7, '1', 0.01, '9', '2014-10-23 10:46:45', 'Payment Pending'),
(9, '1', 45, '2', '2014-10-23 13:30:51', 'Payment Pending'),
(10, '1', 45, '2', '2014-10-23 13:33:43', 'Payment Pending'),
(11, '1', 0.01, '16', '2014-10-23 14:22:51', 'Payment Pending'),
(12, '1', 0.01, '16', '2014-10-23 19:55:58', 'Shipped');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE IF NOT EXISTS `users` (
  `UserID` int(11) NOT NULL,
  `Email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Password` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ShippingAddress` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `FirstName` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `Surname` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `ContactNum` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`UserID`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`UserID`, `Email`, `Password`, `ShippingAddress`, `FirstName`, `Surname`, `ContactNum`) VALUES
(1, 'roflmonster.jh@gmail.com', 'f2bd5ed67d354f5561943f2b7e320c1e', '8 emerald place', 'Josh', 'Henley', '0405141011'),
(2, '@.', '00047e6fb9b1a24b979cedbb8dc7161d', '10 emerald place runcorn', 'joshis', 'bichboi', '0405141011'),
(3, 'dittopower@live.com.au', '1f3870be274f6c49b3e31a0c6728957f', '8 emerald place', 'Damon', 'Jones', '0405141011'),
(4, 'dittopower@gmail.com', '5c76c6028e1d975438d6a2e91e920786', '9 Brett Street, Washington', 'Damon', 'Jones', '000000000'),
(5, '@..', '99754106633f94d350db34d548d6091a', '8 emerald place runcorn', 'joushliks', 'buthool', '0405141011'),
(6, 'nattyo9594@hotmail.com', 'd4ac35886bc6ced0b2535400c8d36a73', 'no', 'Nathan', 'lel', '38921111'),
(7, 'davor.soko@gmail.com', 'a9f94dcef2981511b50778d00ebfebbf', '12 Holder street', 'Davor', 'Mandick', '0413'),
(8, 'yo@momma.com', 'ee2a23af409b352d8f1819405bc770b2', ';)', 'Chris', '.com', '6969696969'),
(9, 'fucc@boi.com', '99754106633f94d350db34d548d6091a', '9 artemis ct', 'David', 'istopcunt', '38921111'),
(10, 'bootsydude95@hotmail.com', '99754106633f94d350db34d548d6091a', '62 West Wallaby Street, Wigan', 'Howcudiss', 'Hapentoome', '3892 1111'),
(11, 'nic@corbins.co.nz', '48ca1db6cd8c2aa4078cebd59361cadb', '', 'nic', 'Corbin', '');

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
