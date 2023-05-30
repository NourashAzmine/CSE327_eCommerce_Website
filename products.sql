-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 31, 2023 at 12:07 AM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `shop_db`
--

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `image`) VALUES
(8, 'ace syrup 60ml ', 35, 'ace-syrup-60ml-1-pc-35.jpg'),
(9, 'ace tablet 500mg', 12, 'ace-tablet-500mg-10-tablets-12tk.jpg'),
(10, 'ace-xr tablet 665mg', 20, 'ace-xr-tablet-665mg-10-tablets - 20.jpg'),
(11, 'adovas syrup 100ml', 70, 'adovas-syrup-100ml-1-pc - 70 tk.jpg'),
(12, 'alatrol tablet 10mg', 30, 'alatrol-tablet-10mg-10-tablets-30.1tk.jpg'),
(13, 'dexon-eye drop 5 ml', 70, 'dexon-eye-drop-5-ml-1-pc - 70 tk.jpg'),
(14, 'flutide inhaler 250mcg 10mcgpuff', 895, 'flutide-inhaler-250mcg10mcgpuff-1-pc-895tk.jpg'),
(15, 'gastrocon-da-suspension 200ml', 287, 'gastrocon-da-suspension-200ml-1-pc-287.jpg'),
(16, 'gastrocon-r suspension 200ml', 285, 'gastrocon-r-suspension-200ml-1-pc-250tk.jpg'),
(17, 'iventi-d-eye drop 100ml', 180, 'iventi-d-eye-drop-0501-1-pc - 200 tk.jpg'),
(18, 'napa-extend tablet 665mg', 30, 'napa-extend-tablet-665mg-12-tablets-24tk.jpg'),
(19, 'nexcap-capsule 40mg', 90, 'nexcap-capsule-delayed-40mg-10-capsules-90tk.jpg'),
(20, 'nexcital-tablet 10mg', 120, 'nexcital-tablet-10mg-10-tablets-120tk.jpg'),
(21, 'protide-inhaler 250mcg', 790, 'protide-inhaler-25mcg250mcg-1-pc-795.jpg'),
(23, 'radigel-120ml', 415, 'radigel-35gm54gm-1-pc-415tk.jpg'),
(24, 'reli-balm cream 80mg', 200, 'reli-balm-cream-80mg45mg180mg10mg-1-pc - 200 tk.jpg'),
(25, 'voltalin-sr 100 mg', 180, 'voltalin-sr-100-mg-10-tablets 180tk.jpg');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
