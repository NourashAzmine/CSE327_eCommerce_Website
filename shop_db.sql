-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 01, 2023 at 05:24 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.27

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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `discount_price` int(200) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `complaints`
--

CREATE TABLE `complaints` (
  `complaint_id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `number` varchar(20) COLLATE utf8mb4_unicode_ci NOT NULL,
  `message` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `order_id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `photo` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `complaints`
--

INSERT INTO `complaints` (`complaint_id`, `user_id`, `name`, `email`, `number`, `message`, `order_id`, `photo`) VALUES
(1, 9, 'asdf', 'asdfsdkfdskajf@sdfa', '34234', 'asdfklasdfkjkljdakf', '3', 'uploaded_img/Screenshot 2023-05-28 015406.jpg'),
(2, 9, 'nurash', 'nourash@gmail.com', '01521536463', 'ssadf', '19', '');

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `number` varchar(12) NOT NULL,
  `message` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `user_id`, `name`, `email`, `number`, `message`) VALUES
(10, 0, 'rafi', 'rafi@gmail.com', '019637382837', 'HI, can you add a variety of masks to your shop?\r\n\r\nthank you');

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
  `discount_total_price` int(200) NOT NULL,
  `placed_on` varchar(50) NOT NULL,
  `delivery_status` varchar(20) NOT NULL DEFAULT 'pending',
  `estimated_delivery_date` date DEFAULT NULL,
  `estimated_delivery_time` time DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `discount_total_price`, `placed_on`, `delivery_status`, `estimated_delivery_date`, `estimated_delivery_time`) VALUES
(25, 10, 'dipta', '013427724092', 'dipta@gmail.com', 'cash on delivery', 'flat no. 67, 78 uit, dhaka - 4563', ', ace tablet 500mg (3) ', 36, 30, '01-Jun-2023', 'pending', NULL, NULL),
(26, 10, 'dipta', '01239589022', 'dipta@gmail.com', 'online', 'flat no. 0987654, 67 aertyu, gotham - 4678', ', dexon-eye drop 5 ml (4) ', 280, 200, '01-Jun-2023', 'pending', NULL, NULL),
(27, 10, 'dipta', '01915699319', 'dipta@gmail.com', 'cash on delivery', 'flat no. 67, 7yt, narayanganj - 9325095', ', dexon-eye drop 5 ml (4) ', 280, 200, '01-Jun-2023', 'pending', NULL, NULL),
(28, 10, 'dipta', '01954362900', 'dipta@gmail.com', 'online', 'flat no. 23, 56 tongi, Metropolis - 9052', ', dexon-eye drop 5 ml (4) ', 280, 200, '01-Jun-2023', 'pending', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `discount_price` int(200) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `name`, `price`, `discount_price`, `image`) VALUES
(8, 'ace syrup 60ml ', 35, 25, 'ace-syrup-60ml-1-pc-35.jpg'),
(9, 'ace tablet 500mg', 12, 10, 'ace-tablet-500mg-10-tablets-12tk.jpg'),
(10, 'ace-xr tablet 665mg', 20, 15, 'ace-xr-tablet-665mg-10-tablets - 20.jpg'),
(11, 'adovas syrup 100ml', 70, 50, 'adovas-syrup-100ml-1-pc - 70 tk.jpg'),
(12, 'alatrol tablet 10mg', 30, 25, 'alatrol-tablet-10mg-10-tablets-30.1tk.jpg'),
(13, 'dexon-eye drop 5 ml', 70, 50, 'dexon-eye-drop-5-ml-1-pc - 70 tk.jpg'),
(14, 'flutide inhaler 250mcg 10mcgpuff', 895, 700, 'flutide-inhaler-250mcg10mcgpuff-1-pc-895tk.jpg'),
(15, 'gastrocon-da-suspension 200ml', 28, 20, 'gastrocon-da-suspension-200ml-1-pc-287.jpg'),
(16, 'gastrocon-r suspension 200ml', 285, 250, 'gastrocon-r-suspension-200ml-1-pc-250tk.jpg'),
(17, 'iventi-d-eye drop 100ml', 180, 150, 'iventi-d-eye-drop-0501-1-pc - 200 tk.jpg'),
(18, 'napa-extend tablet 665mg', 30, 25, 'napa-extend-tablet-665mg-12-tablets-24tk.jpg'),
(19, 'nexcap-capsule 40mg', 90, 70, 'nexcap-capsule-delayed-40mg-10-capsules-90tk.jpg'),
(20, 'nexcital-tablet 10mg', 120, 100, 'nexcital-tablet-10mg-10-tablets-120tk.jpg'),
(21, 'protide-inhaler 250mcg', 790, 720, 'protide-inhaler-25mcg250mcg-1-pc-795.jpg'),
(23, 'radigel-120ml', 415, 390, 'radigel-35gm54gm-1-pc-415tk.jpg'),
(24, 'reli-balm cream 80mg', 200, 170, 'reli-balm-cream-80mg45mg180mg10mg-1-pc - 200 tk.jpg'),
(25, 'voltalin-sr 100 mg', 180, 150, 'voltalin-sr-100-mg-10-tablets 180tk.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(100) NOT NULL,
  `user_type` varchar(20) NOT NULL DEFAULT 'user'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(5, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(8, 'nourash', 'nourashazmine@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'user'),
(9, 'Nurash', 'nourash@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'user'),
(10, 'dipta', 'dipta@gmail.com', '7edd8b2d1ef9731c8a5540b798d2eaa4', 'user'),
(11, 'Ahad', 'ahad@gmail.com', '7533b23c04ca07b8f9563f6f88e3e22c', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `complaints`
--
ALTER TABLE `complaints`
  ADD PRIMARY KEY (`complaint_id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `orders`
--
ALTER TABLE `orders`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `cart`
--
ALTER TABLE `cart`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=103;

--
-- AUTO_INCREMENT for table `complaints`
--
ALTER TABLE `complaints`
  MODIFY `complaint_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=29;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `complaints`
--
ALTER TABLE `complaints`
  ADD CONSTRAINT `complaints_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
