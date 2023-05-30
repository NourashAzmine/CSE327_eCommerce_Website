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
-- Table structure for table `orders`
--

CREATE TABLE `orders` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `email` varchar(100) NOT NULL,
  `method` varchar(50) NOT NULL,
  `address` varchar(500) NOT NULL,
  `total_products` varchar(1000) NOT NULL,
  `total_price` int(100) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `delivery_status` varchar(20) NOT NULL DEFAULT 'pending',
  `estimated_delivery_date` date DEFAULT NULL,
  `estimated_delivery_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `delivery_status`, `estimated_delivery_date`, `estimated_delivery_time`) VALUES
(19, 9, 'nurash', '01521536463', 'nourash@gmail.com', 'cash on delivery', 'flat no. Bashundhara R/A, Road - 5, House no - 3, Flat no - 3B, Dhaka,  - 1462', ', ace tablet 500mg (1) , flutide inhaler 250mcg 10mcgpuff (1) ', 907, '28-May-2023', 'delivered', '2023-05-31', '05:14:00'),
(21, 10, 'dipta', '01821536463', 'dipta@gmail.com', 'cash on delivery', 'flat no. Narayangong, Chashara , Dhaka - 2342', ', gastrocon-da-suspension 200ml (1) ', 287, '28-May-2023', 'delivered', '0000-00-00', '00:00:00'),
(22, 11, 'Ahad', '01826153663', 'ahad@gmail.com', 'cash on delivery', 'flat no. Bashundhara R/A, Road - 5, House no - 3, Flat no - 3B, Dhaka - 7657', ', gastrocon-da-suspension 200ml (1) , ace tablet 500mg (1) ', 299, '28-May-2023', 'delivered', '2023-05-30', '07:00:00');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=25;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
