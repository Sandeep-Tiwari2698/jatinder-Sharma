-- phpMyAdmin SQL Dump
-- version 5.1.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 04, 2022 at 06:12 PM
-- Server version: 10.4.22-MariaDB
-- PHP Version: 7.4.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ci_job`
--

-- --------------------------------------------------------

--
-- Table structure for table `tbl_users`
--

CREATE TABLE `tbl_users` (
  `user_id` int(11) NOT NULL,
  `user_name` varchar(20) NOT NULL,
  `user_email` varchar(60) NOT NULL,
  `user_password` varchar(40) NOT NULL,
  `user_level` enum('admin','user') NOT NULL COMMENT '1, 0',
  `cart_data` text DEFAULT NULL,
  `status` enum('1','0') NOT NULL COMMENT 'active,inactive'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tbl_users`
--

INSERT INTO `tbl_users` (`user_id`, `user_name`, `user_email`, `user_password`, `user_level`, `cart_data`, `status`) VALUES
(1, 'Sandeep', 'admin@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'admin', NULL, '1'),
(5, 'john', 'user@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'user', 'a:3:{s:32:\"c51ce410c124a10e0db5e4b97fc2af39\";a:8:{s:2:\"id\";s:2:\"13\";s:3:\"qty\";d:2;s:5:\"price\";d:1000;s:4:\"name\";s:10:\"I phone 12\";s:5:\"image\";s:13:\"download4.jpg\";s:6:\"status\";s:1:\"1\";s:5:\"rowid\";s:32:\"c51ce410c124a10e0db5e4b97fc2af39\";s:8:\"subtotal\";d:2000;}s:32:\"aab3238922bcc25a6f606eb525ffdc56\";a:8:{s:2:\"id\";s:2:\"14\";s:3:\"qty\";d:4;s:5:\"price\";d:9000;s:4:\"name\";s:9:\"I-phone 6\";s:5:\"image\";s:13:\"download5.jpg\";s:6:\"status\";s:1:\"1\";s:5:\"rowid\";s:32:\"aab3238922bcc25a6f606eb525ffdc56\";s:8:\"subtotal\";d:36000;}s:32:\"c20ad4d76fe97759aa27a0c99bff6710\";a:8:{s:2:\"id\";s:2:\"12\";s:3:\"qty\";d:4;s:5:\"price\";d:1000;s:4:\"name\";s:11:\"I-phone xxx\";s:5:\"image\";s:13:\"download3.jpg\";s:6:\"status\";s:1:\"1\";s:5:\"rowid\";s:32:\"c20ad4d76fe97759aa27a0c99bff6710\";s:8:\"subtotal\";d:4000;}}', '1'),
(6, 'smith', 'v@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'user', 'a:3:{s:32:\"c51ce410c124a10e0db5e4b97fc2af39\";a:7:{s:2:\"id\";s:2:\"13\";s:3:\"qty\";d:2;s:5:\"price\";d:1000;s:4:\"name\";s:10:\"I phone 12\";s:5:\"image\";s:13:\"download4.jpg\";s:5:\"rowid\";s:32:\"c51ce410c124a10e0db5e4b97fc2af39\";s:8:\"subtotal\";d:2000;}s:32:\"c20ad4d76fe97759aa27a0c99bff6710\";a:8:{s:2:\"id\";s:2:\"12\";s:3:\"qty\";d:3;s:5:\"price\";d:1000;s:4:\"name\";s:11:\"I-phone xxx\";s:5:\"image\";s:13:\"download3.jpg\";s:6:\"status\";s:1:\"1\";s:5:\"rowid\";s:32:\"c20ad4d76fe97759aa27a0c99bff6710\";s:8:\"subtotal\";d:3000;}s:32:\"aab3238922bcc25a6f606eb525ffdc56\";a:8:{s:2:\"id\";s:2:\"14\";s:3:\"qty\";d:2;s:5:\"price\";d:9000;s:4:\"name\";s:9:\"I-phone 6\";s:5:\"image\";s:13:\"download5.jpg\";s:6:\"status\";s:1:\"1\";s:5:\"rowid\";s:32:\"aab3238922bcc25a6f606eb525ffdc56\";s:8:\"subtotal\";d:18000;}}', '1'),
(7, 'sams', 'r@gmail.com', 'e10adc3949ba59abbe56e057f20f883e', 'user', 'a:2:{s:32:\"aab3238922bcc25a6f606eb525ffdc56\";a:8:{s:2:\"id\";s:2:\"14\";s:3:\"qty\";d:1;s:5:\"price\";d:9000;s:4:\"name\";s:9:\"I-phone 6\";s:5:\"image\";s:13:\"download5.jpg\";s:6:\"status\";s:1:\"1\";s:5:\"rowid\";s:32:\"aab3238922bcc25a6f606eb525ffdc56\";s:8:\"subtotal\";d:9000;}s:32:\"c20ad4d76fe97759aa27a0c99bff6710\";a:8:{s:2:\"id\";s:2:\"12\";s:3:\"qty\";d:1;s:5:\"price\";d:1000;s:4:\"name\";s:11:\"I-phone xxx\";s:5:\"image\";s:13:\"download3.jpg\";s:6:\"status\";s:1:\"1\";s:5:\"rowid\";s:32:\"c20ad4d76fe97759aa27a0c99bff6710\";s:8:\"subtotal\";d:1000;}}', '1');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `tbl_users`
--
ALTER TABLE `tbl_users`
  ADD PRIMARY KEY (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `tbl_users`
--
ALTER TABLE `tbl_users`
  MODIFY `user_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
