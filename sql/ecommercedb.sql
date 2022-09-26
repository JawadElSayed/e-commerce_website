-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost
-- Generation Time: Sep 26, 2022 at 03:44 PM
-- Server version: 10.4.21-MariaDB
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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ads`
--

INSERT INTO `ads` (`id`, `image`, `seller_id`, `title`) VALUES
(4, '/images/ads/ad1.webp', 58, 'ad1'),
(5, '/images/ads/ad2.jfif', 59, 'ad2'),
(6, '/images/ads/ad3.jpg', 55, 'ad3');

-- --------------------------------------------------------

--
-- Table structure for table `ban`
--

CREATE TABLE `ban` (
  `admin_id` int(11) NOT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `ban`
--

INSERT INTO `ban` (`admin_id`, `client_id`) VALUES
(60, 54);

-- --------------------------------------------------------

--
-- Table structure for table `cart`
--

CREATE TABLE `cart` (
  `client_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `quantity` int(11) DEFAULT NULL,
  `total_price` int(11) NOT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `cart`
--

INSERT INTO `cart` (`client_id`, `product_id`, `quantity`, `total_price`, `created_at`) VALUES
(52, 3, 1, 950, '2022-09-24 20:05:04'),
(52, 4, 3, 100, '2022-09-24 20:05:04'),
(52, 7, 2, 475, '2022-09-24 20:07:25'),
(53, 2, 1, 1000, '2022-09-24 20:07:25');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `id` int(11) NOT NULL,
  `category_name` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`id`, `category_name`) VALUES
(1, 'phones'),
(2, 'laptops'),
(3, 'cloth');

-- --------------------------------------------------------

--
-- Table structure for table `chat`
--

CREATE TABLE `chat` (
  `client_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL,
  `massage` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `created_at` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `checkouts`
--

INSERT INTO `checkouts` (`id`, `client_id`, `product_id`, `quantity`, `total_price`, `created_at`) VALUES
(7, 52, 3, 1, 950, '2022-09-25 07:12:47'),
(8, 52, 4, 3, 100, '2022-09-25 07:12:47'),
(9, 52, 7, 2, 475, '2022-09-25 07:12:47');

-- --------------------------------------------------------

--
-- Table structure for table `discount_codes`
--

CREATE TABLE `discount_codes` (
  `id` int(11) NOT NULL,
  `discount_code` varchar(255) DEFAULT NULL,
  `discount_amount` varchar(45) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `end_at` datetime DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `discount_codes`
--

INSERT INTO `discount_codes` (`id`, `discount_code`, `discount_amount`, `created_at`, `end_at`, `user_id`, `product_id`) VALUES
(1, '123456', '10', '2022-09-22 21:29:29', '2022-09-30 23:59:59', 12, 1),
(2, 'qwerty', '15', '2022-09-22 21:46:25', '2022-09-30 23:59:59', 12, 3),
(3, 'qazwsx', '10', '2022-09-24 12:56:08', '2022-09-30 23:55:20', 12, 2);

-- --------------------------------------------------------

--
-- Table structure for table `favorite`
--

CREATE TABLE `favorite` (
  `client_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `favorite`
--

INSERT INTO `favorite` (`client_id`, `product_id`) VALUES
(52, 4),
(56, 1);

-- --------------------------------------------------------

--
-- Table structure for table `images`
--

CREATE TABLE `images` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `product_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `images`
--

INSERT INTO `images` (`id`, `image`, `product_id`) VALUES
(3, '/images/Products/product-chair.jpg', 1),
(4, '/images/Products/3dprinter.jpg', 2),
(5, '/images/Products/panoxyl.jpg', 3),
(6, '/images/Products/printer.jpg', 4),
(7, '/images/Products/product-chari2.jpg', 5),
(8, '/images/Products/product-chair.jpg', 6),
(9, '/images/Products/product-chair.jpg', 7);

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

CREATE TABLE `products` (
  `id` int(11) NOT NULL,
  `product_name` varchar(45) DEFAULT NULL,
  `about` text DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT current_timestamp(),
  `price` int(11) DEFAULT NULL,
  `old_price` int(11) DEFAULT NULL,
  `category_id` int(11) NOT NULL,
  `seller_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`id`, `product_name`, `about`, `created_at`, `price`, `old_price`, `category_id`, `seller_id`) VALUES
(1, 'Gaming Chair', 'iphone x', '2022-09-21 23:20:53', 800, NULL, 1, 58),
(2, '3D Printer', 'hp-15', '2022-09-21 23:21:53', 1000, NULL, 2, 59),
(3, 'PanOxyl', 'Lorem ipsum dolor sit amet, consectetuer adipiscing elit. Aenean commodo ligula eget dolor. Aenean massa. Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec quam felis, ultricies nec, pellentesque eu, pretium quis, sem. ', '2022-09-21 23:22:53', 950, NULL, 1, 58),
(4, 'men cloth', 'dfxc vjkbv vb b. dh. hsgkv bvkbz kvv. vkj. dn vkk dknj mvl; onm k ', '2022-09-24 19:49:08', 100, NULL, 3, 58),
(5, 'women cloth', 'vcjsvb vjksd j sk jkb scjb jk. jdjcjvc jb jdc b knj. cm j. jc. j nc h ', '2022-09-24 19:49:08', 80, NULL, 3, 59),
(6, 'huawei p30', 'sm,vbjsb sj sklb vnjv lk hvsv;m m hk vk n klnb b kn. ,n m ', '2022-09-24 19:50:39', 400, NULL, 1, 58),
(7, 'huawei p20', 'bvun jks. lb. lk.  lb bn xkh. jb. u v sh kmhj nxxbhv m j. njs. xn jhn n ubn i. b.   kbfs xj nxb ub. jkb nf. hblxj. jk nm x jh', '2022-09-24 19:50:39', 475, NULL, 1, 59);

-- --------------------------------------------------------

--
-- Table structure for table `reset_password`
--

CREATE TABLE `reset_password` (
  `id` int(11) NOT NULL,
  `reset_password` varchar(255) DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `client_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `sellers_categories`
--

CREATE TABLE `sellers_categories` (
  `category_id` int(11) NOT NULL,
  `uses_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `password`, `name`, `username`, `user_type`, `profile`) VALUES
(52, 'jawad@gmail.com', '4774b37cb7504e6715a559f6fb9049111b006f9b4d1e8cb8ed5a3fdd5f78d2b6', 'jawad', 'jawad', 3, 'images/profile/default.png'),
(53, 'ali@gmail.com', '4774b37cb7504e6715a559f6fb9049111b006f9b4d1e8cb8ed5a3fdd5f78d2b6', 'ali', 'ali', 3, 'images/profile/default.png'),
(54, 'yasser@gmail.com', '4774b37cb7504e6715a559f6fb9049111b006f9b4d1e8cb8ed5a3fdd5f78d2b6', 'yasser', 'yasser', 3, 'images/profile/default.png'),
(55, 'sara@gmail.com', '4774b37cb7504e6715a559f6fb9049111b006f9b4d1e8cb8ed5a3fdd5f78d2b6', 'sara', 'sara', 3, 'images/profile/default.png'),
(56, 'mariam@gmail.com', '4774b37cb7504e6715a559f6fb9049111b006f9b4d1e8cb8ed5a3fdd5f78d2b6', 'mariam', 'mariam', 3, 'images/profile/default.png'),
(57, 'issa@gmail.com', '4774b37cb7504e6715a559f6fb9049111b006f9b4d1e8cb8ed5a3fdd5f78d2b6', 'issa', 'issa', 3, 'images/profile/default.png'),
(58, 'housam@gmail.com', '4774b37cb7504e6715a559f6fb9049111b006f9b4d1e8cb8ed5a3fdd5f78d2b6', 'housam', 'housam', 2, 'images/profile/default.png'),
(59, 'hussein@gmail.com', '4774b37cb7504e6715a559f6fb9049111b006f9b4d1e8cb8ed5a3fdd5f78d2b6', 'hussein', 'hussein', 2, 'images/profile/default.png'),
(60, 'smoke@gmail.com', '4774b37cb7504e6715a559f6fb9049111b006f9b4d1e8cb8ed5a3fdd5f78d2b6', 'smoke', 'smoke', 1, 'images/profile/default.png'),
(61, 'sadasd', '4774b37cb7504e6715a559f6fb9049111b006f9b4d1e8cb8ed5a3fdd5f78d2b6', 'hhhh', 'hh', 3, 'images/profile/default.png');

-- --------------------------------------------------------

--
-- Table structure for table `user_type`
--

CREATE TABLE `user_type` (
  `id` int(11) NOT NULL,
  `type` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

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
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `views`
--

INSERT INTO `views` (`product_id`, `viewer_id`, `created_at`) VALUES
(1, 53, '2022-09-23 07:19:09'),
(1, 54, '2022-09-22 07:19:09'),
(1, 55, '2022-09-20 07:19:09'),
(2, 52, '2022-09-23 18:00:00'),
(2, 53, '2022-09-23 07:19:09'),
(2, 54, '2022-09-22 07:23:51'),
(2, 57, '2022-09-21 07:23:59'),
(3, 54, '2022-09-25 07:19:09'),
(3, 55, '2022-09-22 18:00:00'),
(4, 54, '2022-09-25 07:19:09'),
(4, 55, '2022-09-19 07:24:14'),
(4, 57, '2022-09-22 07:24:49'),
(5, 53, '2022-09-22 18:00:00'),
(5, 54, '2022-09-24 07:25:06'),
(5, 55, '2022-09-23 07:25:25'),
(5, 56, '2022-09-22 07:25:47'),
(6, 53, '2022-09-21 07:25:53'),
(6, 56, '2022-09-01 07:25:58'),
(6, 57, '2022-09-09 07:26:03'),
(7, 52, '2022-09-12 07:26:08'),
(7, 54, '2022-09-14 07:26:12'),
(7, 56, '2022-09-17 07:26:16'),
(7, 57, '2022-09-04 07:26:20');

-- --------------------------------------------------------

--
-- Table structure for table `vouchers`
--

CREATE TABLE `vouchers` (
  `id` int(11) NOT NULL,
  `sender_id` int(11) NOT NULL,
  `resever_id` int(11) NOT NULL,
  `voucher_code` varchar(45) DEFAULT NULL,
  `voucher_amount` int(11) DEFAULT NULL,
  `used` int(11) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `vouchers`
--

INSERT INTO `vouchers` (`id`, `sender_id`, `resever_id`, `voucher_code`, `voucher_amount`, `used`) VALUES
(1, 52, 54, 'HG8wR', 50, 0),
(2, 52, 55, 'FW5kS', 50, 0);

-- --------------------------------------------------------

--
-- Table structure for table `wish_list`
--

CREATE TABLE `wish_list` (
  `client_id` int(11) NOT NULL,
  `product_id` int(11) NOT NULL,
  `total_price` int(11) NOT NULL,
  `created_ad` timestamp NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `wish_list`
--

INSERT INTO `wish_list` (`client_id`, `product_id`, `total_price`, `created_ad`) VALUES
(10, 2, 1000, '2022-09-24 06:50:22'),
(52, 1, 800, '2022-09-24 20:03:18'),
(52, 6, 400, '2022-09-24 20:03:57'),
(53, 4, 100, '2022-09-24 20:03:57'),
(54, 2, 1000, '2022-09-24 20:03:18');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `ads`
--
ALTER TABLE `ads`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_ads_users1_idx` (`seller_id`);

--
-- Indexes for table `ban`
--
ALTER TABLE `ban`
  ADD PRIMARY KEY (`admin_id`,`client_id`),
  ADD KEY `fk_users_has_users_users4_idx` (`client_id`),
  ADD KEY `fk_users_has_users_users3_idx` (`admin_id`);

--
-- Indexes for table `cart`
--
ALTER TABLE `cart`
  ADD PRIMARY KEY (`client_id`,`product_id`),
  ADD KEY `fk_clients_has_products_products2_idx` (`product_id`),
  ADD KEY `fk_clients_has_products_clients1_idx` (`client_id`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `chat`
--
ALTER TABLE `chat`
  ADD PRIMARY KEY (`client_id`,`seller_id`),
  ADD KEY `fk_clients_has_clients_clients4_idx` (`seller_id`),
  ADD KEY `fk_clients_has_clients_clients3_idx` (`client_id`),
  ADD KEY `fk_clients_has_clients_products1_idx` (`product_id`);

--
-- Indexes for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_clients_has_products_products2_idx` (`product_id`),
  ADD KEY `fk_clients_has_products_clients1_idx` (`client_id`);

--
-- Indexes for table `discount_codes`
--
ALTER TABLE `discount_codes`
  ADD PRIMARY KEY (`id`,`user_id`,`product_id`),
  ADD KEY `fk_discount_codes_users1_idx` (`user_id`),
  ADD KEY `fk_discount_codes_products1_idx` (`product_id`);

--
-- Indexes for table `favorite`
--
ALTER TABLE `favorite`
  ADD PRIMARY KEY (`client_id`,`product_id`),
  ADD KEY `fk_clients_has_products_products1_idx` (`product_id`),
  ADD KEY `fk_clients_has_products_clients_idx` (`client_id`);

--
-- Indexes for table `images`
--
ALTER TABLE `images`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_images_products1_idx` (`product_id`);

--
-- Indexes for table `lottery`
--
ALTER TABLE `lottery`
  ADD PRIMARY KEY (`client_id`,`admin_id`),
  ADD KEY `fk_users_has_users_users2_idx` (`admin_id`),
  ADD KEY `fk_users_has_users_users1_idx` (`client_id`);

--
-- Indexes for table `products`
--
ALTER TABLE `products`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_products_categories1_idx` (`category_id`),
  ADD KEY `fk_products_users1_idx` (`seller_id`);

--
-- Indexes for table `reset_password`
--
ALTER TABLE `reset_password`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_reset_password_clients1_idx` (`client_id`);

--
-- Indexes for table `sellers_categories`
--
ALTER TABLE `sellers_categories`
  ADD PRIMARY KEY (`category_id`,`uses_id`),
  ADD KEY `fk_categories_has_users_users1_idx` (`uses_id`),
  ADD KEY `fk_categories_has_users_categories1_idx` (`category_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_clients_user_type1_idx` (`user_type`);

--
-- Indexes for table `user_type`
--
ALTER TABLE `user_type`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `views`
--
ALTER TABLE `views`
  ADD PRIMARY KEY (`product_id`,`viewer_id`),
  ADD KEY `fk_products_has_clients_clients1_idx` (`viewer_id`),
  ADD KEY `fk_products_has_clients_products1_idx` (`product_id`);

--
-- Indexes for table `vouchers`
--
ALTER TABLE `vouchers`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_clients_has_clients_clients2_idx` (`resever_id`),
  ADD KEY `fk_clients_has_clients_clients1_idx` (`sender_id`);

--
-- Indexes for table `wish_list`
--
ALTER TABLE `wish_list`
  ADD PRIMARY KEY (`client_id`,`product_id`,`total_price`),
  ADD KEY `fk_clients_has_products_products3_idx` (`product_id`),
  ADD KEY `fk_clients_has_products_clients2_idx` (`client_id`),
  ADD KEY `fk_clients_has_total_price_idx` (`total_price`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `ads`
--
ALTER TABLE `ads`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `checkouts`
--
ALTER TABLE `checkouts`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `discount_codes`
--
ALTER TABLE `discount_codes`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `images`
--
ALTER TABLE `images`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `products`
--
ALTER TABLE `products`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `reset_password`
--
ALTER TABLE `reset_password`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;

--
-- AUTO_INCREMENT for table `user_type`
--
ALTER TABLE `user_type`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `vouchers`
--
ALTER TABLE `vouchers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `ads`
--
ALTER TABLE `ads`
  ADD CONSTRAINT `fk_ads_users1` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `ban`
--
ALTER TABLE `ban`
  ADD CONSTRAINT `fk_users_has_users_users3` FOREIGN KEY (`admin_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_users_has_users_users4` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `cart`
--
ALTER TABLE `cart`
  ADD CONSTRAINT `fk_clients_has_products_clients1` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_clients_has_products_products2` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `chat`
--
ALTER TABLE `chat`
  ADD CONSTRAINT `fk_clients_has_clients_clients3` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_clients_has_clients_clients4` FOREIGN KEY (`seller_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_clients_has_clients_products1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `checkouts`
--
ALTER TABLE `checkouts`
  ADD CONSTRAINT `fk_clients_has_products_clients10` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_clients_has_products_products20` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;

--
-- Constraints for table `favorite`
--
ALTER TABLE `favorite`
  ADD CONSTRAINT `fk_clients_has_products_clients` FOREIGN KEY (`client_id`) REFERENCES `users` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION,
  ADD CONSTRAINT `fk_clients_has_products_products1` FOREIGN KEY (`product_id`) REFERENCES `products` (`id`) ON DELETE NO ACTION ON UPDATE NO ACTION;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
