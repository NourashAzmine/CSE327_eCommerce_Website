-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 27, 2023 at 02:03 PM
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
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `id` int(100) NOT NULL,
  `user_id` int(100) NOT NULL,
  `name` varchar(100) NOT NULL,
  `price` int(100) NOT NULL,
  `quantity` int(100) NOT NULL,
  `image` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`id`, `user_id`, `name`, `price`, `quantity`, `image`) VALUES
(62, 0, 'u', 66, 1, '2.jpg'),
(63, 2, 'aa', 32, 1, '1.jpg'),
(64, 2, 'u', 66, 1, '2.jpg');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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
  `placed_on` varchar(50) NOT NULL,
  `payment_status` varchar(20) NOT NULL DEFAULT 'pending'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `orders`
--

INSERT INTO `orders` (`id`, `user_id`, `name`, `number`, `email`, `method`, `address`, `total_products`, `total_price`, `placed_on`, `payment_status`) VALUES
(10, 2, 'nourash', '0123', 'nourashazmine@gmail.com', 'cash on delivery', 'flat no. 4, asdf, a, sdf - 334', ', aa (1) ', 32, '07-May-2023', 'completed'),
(11, 2, 'nourash', '123', 'nourashazmine@gmail.com', 'cash on delivery', 'flat no. 2, sdaf, we, dsf - 33', ', aa (1) ', 32, '07-May-2023', 'pending'),
(12, 2, 'dipta', '12', 'nourashazmine@gmail.com', 'credit card', 'flat no. 1, asdf, a, sdf - 3', ', aa (1) ', 32, '07-May-2023', 'pending'),
(13, 2, 'nourash', '012', 'nourashazmine@gmail.com', 'online', 'flat no. sdfasdf, asdf, csd,  - 223', ', aa (1) , u (2) ', 164, '13-May-2023', 'pending'),
(14, 9, 'nurash', '01521536463', 'nourash@gmail.com', 'online', 'flat no. asd, , adsfsdf,  - 211', ', ace-xr tablet 665mg (1) ', 20, '27-May-2023', 'pending'),
(15, 9, 'nurash', '01521536463', 'nourash@gmail.com', 'online', 'flat no. asd, jjjkh, adsfsdf,  - 3434', ', gastrocon-r suspension 200ml (1) ', 285, '27-May-2023', 'pending'),
(16, 9, 'nurash', '01521536463', 'nourash@gmail.com', 'online', 'flat no. asd, jjjkh, adsfsdf,  - 7654', ', ace-xr tablet 665mg (1) , alatrol tablet 10mg (1) ', 50, '27-May-2023', 'pending');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `user_type`) VALUES
(5, 'admin', 'admin@gmail.com', '21232f297a57a5a743894a0e4a801fc3', 'admin'),
(8, 'nourash', 'nourashazmine@gmail.com', '500953d3e0eff7c893c7e1b8fa1e54ba', 'user'),
(9, 'nurash', 'nourash@gmail.com', '500953d3e0eff7c893c7e1b8fa1e54ba', 'user');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`id`);

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
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=69;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `orders`
--
ALTER TABLE `orders`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(100) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
