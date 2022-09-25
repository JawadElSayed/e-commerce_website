-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 25, 2022 at 10:03 PM
-- Server version: 10.4.24-MariaDB
-- PHP Version: 7.4.29

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ecommercedb`
--

-- --------------------------------------------------------

--
-- Table structure for table `ads`
--

CREATE TABLE `ads` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `seller_id` int(11) NOT NULL,
  `title` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `image`, `seller_id`, `title`) VALUES
(1, 'images/ads/632b73e78a87d.jpeg', 1, '123'),
(2, 'images/ads/632b73e78a87e.jpeg', 1, 'nothing');

-- --------------------------------------------------------

--
-- Table structure for table `ban`
--

CREATE TABLE `ban` (
  `admin_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `ban`
--

INSERT INTO `ban` (`admin_id`, `client_id`) VALUES
(1, 2),
(1, 3);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `client_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(1, 'c1'),
(15, 'c2'),
(16, 'c3'),
(17, 'c4');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `id` int(11) NOT NULL,
  `sender` int(11) NOT NULL,
  `receiver` int(11) NOT NULL,
  `massage` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `chat`
--

INSERT INTO `chat` (`id`, `sender`, `receiver`, `massage`, `created_at`, `product_id`) VALUES
(1, 3, 2, 'from houssein to houssam', '2022-09-14 21:00:00', 1),
(2, 3, 2, 'hi houssam ', '2022-09-20 21:00:00', 1),
(3, 2, 3, 'hi dear', '2022-09-21 21:00:00', 1),
(4, 2, 4, 'hi 4', '2022-09-24 21:00:00', 2),
(5, 4, 2, 'hello 2', '2022-09-26 21:00:00', 2),
(6, 1, 3, 'from 1 to 3', '2022-09-29 21:00:00', 2),
(7, 5, 2, 'from jawad to houssam', '2022-09-29 21:00:00', 2);

-- --------------------------------------------------------

--
-- Table structure for table `checkouts`
--

CREATE TABLE `checkouts` (
  `id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `checkouts`
--

INSERT INTO `checkouts` (`id`, `client_id`, `product_id`, `quantity`, `total_price`, `created_at`) VALUES
(1, 1, 3, 24, 2952, '2022-09-20 21:00:00'),
(2, 2, 1, 1, 0, '2022-09-21 21:00:00'),
(3, 2, 2, 2, 0, '2022-09-20 21:00:00'),
(4, 2, 3, 22, 2706, '2022-09-20 21:00:00'),
(5, 4, 2, 4, 0, '2022-09-19 21:00:00'),
(6, 4, 5, 1, 0, '2022-09-08 21:00:00'),
(7, 5, 5, 2, 0, '2022-09-07 21:00:00'),
(8, 1, 6, 5, 0, '2022-09-09 21:00:00'),
(9, 2, 7, 2, 0, '2022-07-06 21:00:00'),
(10, 2, 6, 12, 0, '2022-06-20 21:00:00'),
(11, 2, 6, 20, 0, '2022-07-08 21:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `discount_codes`
--

CREATE TABLE `discount_codes` (
  `id` int(11) NOT NULL,
  `discount_code` varchar(255) DEFAULT NULL,
  `discount_percentage` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `end_at` datetime DEFAULT NULL,
  `seller_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `discount_codes`
--

INSERT INTO `discount_codes` (`id`, `discount_code`, `discount_percentage`, `created_at`, `end_at`, `seller_id`, `product_id`) VALUES
(1, 'cod1', '1%', '2022-09-13 21:00:00', '2022-09-23 00:00:00', 1, 1),
(2, 'cod2', '2%', '2022-09-01 21:00:00', '2022-09-01 00:00:00', 1, 4);

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `client_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image`, `product_id`) VALUES
(44, 'images/products_images/632d54cf23632.png', 1);

-- --------------------------------------------------------

--
-- Table structure for table `lottery`
--

CREATE TABLE `lottery` (
  `client_id` int(11) NOT NULL,
  `admin_id` int(11) NOT NULL,
  `first` int(11) DEFAULT NULL,
  `second` int(11) DEFAULT NULL,
  `third` int(11) DEFAULT NULL,
  `closed` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(45) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `price` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `about`, `created_at`, `price`, `category_id`, `seller_id`) VALUES
(1, 'ep1', 'ea1', '2022-09-22 09:09:13', 911, 1, 1),
(2, 'ep22', 'ea22', '2022-09-22 09:09:31', 9222, 17, 2),
(3, 'p3', 'a3', '2022-09-22 09:09:32', 123, 2, 2),
(4, 'p4', 'a4', '2022-09-22 09:09:32', 123, 17, 5),
(6, 'p6', 'a6', '2022-09-01 21:00:00', 6, 2, 5),
(8, 'p8', 'a8', '2022-09-13 21:00:00', 8, 1, 7),
(9, 'p9', 'a9', '2022-09-05 21:00:00', 9, 1, 8),
(10, 'p9', 'a9', '2022-09-23 21:00:00', 10, 1, 9),
(11, 'p10', 'a10', '2022-09-23 21:00:00', 9, 1, 10);

-- --------------------------------------------------------

--
-- Table structure for table `reset_password`
--

CREATE TABLE `reset_password` (
  `id` int(11) NOT NULL,
  `code` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `sellers_categories`
--

CREATE TABLE `sellers_categories` (
  `category_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `sellers_categories`
--

INSERT INTO `sellers_categories` (`category_id`, `seller_id`) VALUES
(14, 1),
(15, 1),
(17, 1),
(16, 4);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `email` varchar(255) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `name` varchar(255) DEFAULT NULL,
  `username` varchar(255) DEFAULT NULL,
  `user_type` int(11) NOT NULL,
  `profile` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `username`, `user_type`, `profile`) VALUES
(1, 'housseinalialdroubi@gmail.com', '123321', 'houssein12', 'houssein123', 1, 'images/profile/632f7b0a174af.png'),
(2, 'houssam@gmail.com', '123321', 'houssam', 'houssam', 2, 'images/profile/default.png'),
(3, 'houssein@gmail.com', '123321', 'houssein1', 'houssein', 3, 'images/profile/default.png'),
(4, 'alone@gmail.com', '123321', 'alone', 'alone', 1, 'images/profile/632c3d4332e00.jpeg'),
(5, 'jawad@gmail.com', '123321', 'jawad', 'jawad', 2, 'images/profile/632c3d4332e00.jpeg\r\n'),
(7, 'mahdi@gmail.com', '123321', 'mahdi', 'mahdi', 2, 'images/profile/632c3d4332e00.jpeg\r\n'),
(8, 'abbass@gmail.com', '123321', 'abbass', 'abbass', 2, 'images/profile/632c3d4332e00.jpeg\r\n'),
(9, 'ali@gmail.com', '123321', 'ali', 'ali', 2, 'Iimages/profile/632c3d4332e00.jpeg'),
(10, 'sayf@gmail.com', '123321', 'sayf', 'sayf', 2, 'images/profile/632c3d4332e00.jpeg\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `user_type`
--

INSERT INTO `user_type` (`id`, `type`) VALUES
(1, 'admin'),
(2, 'seller'),
(3, 'client');

-- --------------------------------------------------------

--
-- Table structure for table `views`
--

CREATE TABLE `views` (
  `product_id` int(11) NOT NULL,
  `viewer_id` int(11) NOT NULL,
  `created_at` date NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`product_id`, `viewer_id`, `created_at`) VALUES
(1, 1, '2022-09-01'),
(1, 2, '2022-09-02'),
(1, 3, '2022-09-03'),
(1, 4, '2022-09-04'),
(1, 5, '2022-09-05'),
(1, 6, '2022-09-06'),
(1, 7, '2022-09-06'),
(1, 8, '2022-09-07'),
(1, 9, '2022-09-08'),
(1, 10, '2022-09-09'),
(2, 1, '2022-09-09'),
(2, 2, '2022-09-09'),
(2, 3, '2022-09-09'),
(2, 4, '2022-09-09'),
(2, 5, '2022-09-10'),
(2, 6, '2022-09-10'),
(2, 7, '2022-09-11'),
(2, 8, '2022-09-12'),
(2, 9, '2022-09-13'),
(3, 1, '2022-09-14'),
(3, 2, '2022-09-15'),
(3, 3, '2022-09-16'),
(3, 4, '2022-09-16'),
(3, 5, '2022-09-17'),
(3, 6, '2022-09-18'),
(4, 1, '2022-09-19'),
(4, 2, '2022-09-19'),
(4, 3, '2022-09-20'),
(4, 4, '2022-09-27'),
(4, 5, '2022-09-30'),
(4, 6, '0000-00-00'),
(4, 7, '0000-00-00'),
(4, 8, '0000-00-00'),
(5, 1, '0000-00-00'),
(5, 2, '0000-00-00'),
(5, 3, '0000-00-00'),
(5, 4, '0000-00-00'),
(5, 5, '0000-00-00'),
(6, 1, '0000-00-00'),
(6, 2, '0000-00-00'),
(6, 3, '0000-00-00'),
(6, 4, '0000-00-00'),
(6, 5, '0000-00-00'),
(7, 1, '0000-00-00'),
(7, 2, '0000-00-00'),
(8, 1, '0000-00-00'),
(9, 1, '0000-00-00'),
(9, 2, '0000-00-00'),
(9, 3, '0000-00-00'),
(9, 4, '0000-00-00'),
(9, 5, '0000-00-00'),
(9, 6, '0000-00-00'),
(9, 7, '0000-00-00'),
(9, 8, '0000-00-00'),
(9, 9, '0000-00-00'),
(9, 10, '0000-00-00'),
(9, 11, '0000-00-00'),
(9, 12, '0000-00-00'),
(9, 13, '0000-00-00'),
(9, 14, '0000-00-00'),
(9, 15, '0000-00-00'),
(9, 16, '0000-00-00');

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `client_id` int(11) NOT NULL,
  `client_id1` int(11) NOT NULL,
  `voucher_code` varchar(45) DEFAULT NULL,
  `voucher_amount` int(11) DEFAULT NULL,
  `used` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `wish_list`
--

CREATE TABLE `wish_list` (
  `client_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `created_ad` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `ban`
--
ALTER TABLE `ban`
  ADD PRIMARY KEY (`admin_id`,`client_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`client_id`,`product_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `discount_codes`
--
ALTER TABLE `discount_codes`
  ADD PRIMARY KEY (`id`,`seller_id`,`product_id`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`client_id`,`product_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lottery`
--
ALTER TABLE `lottery`
  ADD PRIMARY KEY (`client_id`,`admin_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `reset_password`
--
ALTER TABLE `reset_password`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `sellers_categories`
--
ALTER TABLE `sellers_categories`
  ADD PRIMARY KEY (`seller_id`,`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`product_id`,`viewer_id`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`client_id`,`client_id1`);

--
-- Indexes for table `wish_list`
--
ALTER TABLE `wish_list`
  ADD PRIMARY KEY (`client_id`,`product_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `chat`
--
ALTER TABLE `chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `checkouts`
--
ALTER TABLE `checkouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `discount_codes`
--
ALTER TABLE `discount_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=53;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `reset_password`
--
ALTER TABLE `reset_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
