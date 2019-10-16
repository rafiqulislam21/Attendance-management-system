-- phpMyAdmin SQL Dump
-- version 4.8.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Sep 23, 2019 at 06:01 AM
-- Server version: 10.1.34-MariaDB
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `attendance_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(7, '2014_10_12_000000_create_users_table', 1),
(8, '2014_10_12_100000_create_password_resets_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(10) UNSIGNED NOT NULL,
  `name` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_type` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `password` varchar(191) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `user_id`, `user_type`, `email`, `password`, `remember_token`, `created_at`, `updated_at`) VALUES
(1, 'Shohel Rana', '1521', 'Admin', 'shohelrana1521.iub@gmail.com', '$2y$10$uFyxL/STn06Z4bzL6S44WOo1JeVLBBHoWsd/B2gNmuxfKgdENElwm', 'M8GA8UzGLDyBzTJHMQZY73EH2AcH5wJ0P3lh8ee8XuQprOYRS0hBDZ6WAgNj', '2019-09-18 03:30:54', '2019-09-21 22:25:38'),
(2, 'Bijoy Ahmed', '1621', 'user', 'earth5692@gmail.com', '$2y$10$b24wH8AfQB377X83RJlHru8g8d0q8zKOxXnrMIh61.woiZtc6mh56', 'JmUer30C5p3bWQJD4hStFqpsblRLUIjCwhq1dTYASK1zDIxfpYoIxb5Lcrho', '2019-09-18 09:33:10', '2019-09-21 22:21:35'),
(3, 'Joynal Abedin', '16', 'Head office', 'joynalptc@gmail.com', '$2y$10$2YFZjm4orR/SmBd1Y5buu.k4ujKsHHE0M5Bl2Y4rcwPCRvzV9506S', 'lY70cOL88DIrrIVXZArvj0yNwS15OZyxBHWoWRISHUNGROPrwGP0Or3B72cS', '2019-09-18 10:45:17', '2019-09-18 10:45:17'),
(5, 'Rukunjjaman', '1', 'Sales Representative', 'rukun@pannabd.com', '$2y$10$4UxnC73FyYZg8MvpH7iRkuP4oERT.SCjdEblbGbI5oa9bA0LSlnc.', '8go51ByNBBBTyUHMvhaKzv3IDZeBP9O6BhwBXJy6K765RUV83Oj96mgXPNSY', '2019-09-21 23:59:27', '2019-09-21 23:59:27'),
(6, 'Solimuddin Masum', '51', 'Teritorrial Sales Officer (T.S.O.)', 'salesptc944@gmail.com', '$2y$10$Y1K.uKFv/sdzYn11xSrASeQ6L3i/q.b5CCehlQxCdSFgqIo/ipqru', 'xi4P221ph5EdjSfBNhdqR2cQWPjRbpncSsw6vi9JEpXWfNUqPdXrCyXEoc16', '2019-09-22 03:14:09', '2019-09-22 03:14:09');

-- --------------------------------------------------------

--
-- Table structure for table `_admin`
--

CREATE TABLE `_admin` (
  `id_admin` int(11) NOT NULL,
  `login_id` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `_attendance`
--

CREATE TABLE `_attendance` (
  `id_attendance` int(11) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `day` varchar(255) NOT NULL,
  `time` varchar(255) NOT NULL,
  `month` varchar(255) NOT NULL,
  `year` varchar(255) NOT NULL,
  `status` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_attendance`
--

INSERT INTO `_attendance` (`id_attendance`, `employee_id`, `employee_name`, `day`, `time`, `month`, `year`, `status`) VALUES
(1, '1', 'Bijoy Ahmed', 'Sun', '09:37:55', 'September', '2019', 'present'),
(2, '2', 'Bijoy Sarker', 'Sun', '09:37:55', 'September', '2019', 'absent'),
(3, '3', 'Salsabil Shama', 'Sun', '09:37:55', 'September', '2019', 'present'),
(4, '4', 'Salsabil Shama', 'Sun', '09:37:55', 'September', '2019', 'absent'),
(5, '1', 'Bijoy Ahmed', 'Sun', '11:06:26', 'September', '2019', 'absent'),
(6, '2', 'Bijoy Sarker', 'Sun', '11:06:26', 'September', '2019', 'absent'),
(7, '3', 'Salsabil Shama', 'Sun', '11:06:26', 'September', '2019', 'absent'),
(8, '4', 'Salsabil Shama', 'Sun', '11:06:26', 'September', '2019', 'present'),
(9, '1', 'Bijoy Ahmed', 'Sun', '17:17:22', 'September', '2019', 'present'),
(10, '2', 'Bijoy Sarker', 'Sun', '17:17:22', 'September', '2019', 'present'),
(11, '3', 'Salsabil Shama', 'Sun', '17:17:22', 'September', '2019', 'present'),
(12, '4', 'Salsabil Shama', 'Sun', '17:17:22', 'September', '2019', 'present');

-- --------------------------------------------------------

--
-- Table structure for table `_employee`
--

CREATE TABLE `_employee` (
  `id` int(11) NOT NULL,
  `employee_id` varchar(255) NOT NULL,
  `employee_name` varchar(255) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `start_date` date NOT NULL,
  `zone_id` int(255) NOT NULL,
  `supervisor_id` int(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_employee`
--

INSERT INTO `_employee` (`id`, `employee_id`, `employee_name`, `designation`, `start_date`, `zone_id`, `supervisor_id`) VALUES
(1, 'bijoy11', 'Bijoy Ahmed', 'male', '0000-00-00', 1, 0),
(2, 'bijoy12', 'Bijoy Sarker', 'male', '0000-00-00', 2, 0),
(3, 'shama11', 'Salsabil Shama', 'female', '0000-00-00', 2, 0),
(4, 'shama11', 'Salsabil Shama', 'female', '0000-00-00', 2, 0),
(5, '1', 'Md. Rukunujjaman', 'Deputy Manager', '2008-01-01', 7, 16),
(6, '2306', 'Farhab Bin Naser', 'MIO Manager', '2019-03-01', 7, 16),
(7, '51', 'Md. Solimuddin Masum', 'Sales Manager (S.M)', '2008-01-01', 7, 16),
(8, '336', 'Md. Anisur Rahman', 'Assistant Sales Manager (A.S.M)', '2008-07-16', 7, 16),
(9, '1455', 'Nazmus Salehin Shehabee', 'Accounts Officer (A.O)', '2019-08-01', 7, 16),
(10, '1631', 'Md. Fazle Elahi Khan', 'Cost Management Officer (C.M.O)', '2016-08-06', 7, 16),
(11, '744', 'Md. Ashrafuzzaman', 'Senior Accounts Office (S.A.O)', '2010-08-01', 7, 16),
(12, '922', 'Md. Masud Rana', 'Administrative Officer (A.O)', '2011-07-03', 7, 16),
(13, '16', 'Md. Joynal Abedin', 'General Manager (G.M)', '2008-01-01', 7, 16),
(14, '104', 'Shamima Nasrin', 'Junior Accountant', '2017-08-01', 7, 16),
(15, '237', 'Delower Hossain', 'Office Assistant', '2008-01-01', 7, 16),
(16, '13', 'Abul Hossain Bablu', 'Territory Sales Officer (T.S.O)', '2008-01-01', 12, 51),
(17, '1584', 'Md. Delower Hossain', 'Territory Sales Officer (T.S.O)', '2016-04-20', 12, 51),
(18, '1591', 'Md. Abdul Motin', 'Territory Sales Officer (T.S.O)', '2016-05-01', 12, 51),
(19, '1753', 'Md. Abu Taher', 'Territory Sales Officer (T.S.O)', '2016-11-20', 12, 51),
(20, '847', 'Md. Moshin', 'Junior Territory Sales Officer (J.T.S.O)', '2016-11-30', 12, 51),
(21, '1777', 'Md. Mahiuddin', 'Territory Sales Officer (T.S.O)', '2017-12-01', 12, 51),
(22, '1783', 'Mustafa Ziaur Rahman', 'Territory Sales Officer (T.S.O)', '2017-01-11', 12, 51),
(23, '1815', 'Md. Masud Rana', 'Territory Sales Officer (T.S.O)', '2017-08-29', 12, 51),
(24, '2000', 'Md. Shamim Hasan', 'Territory Sales Officer (T.S.O)', '2017-12-09', 12, 51),
(25, '2115', 'Md. Alomgir Hossain', 'Territory Sales Officer (T.S.O)', '2018-12-15', 12, 51),
(26, '2262', 'Md. Johirul Islam', 'Territory Sales Officer (T.S.O)', '2019-02-11', 12, 51),
(27, '2283', 'Md. Masum Billah Bhuyan', 'Territory Sales Officer (T.S.O)', '2019-02-01', 12, 51),
(28, '2284', 'Md. Anisur Rahman', 'Territory Sales Officer (T.S.O)', '2019-03-03', 12, 51),
(29, '2286', 'Md. Saddam Hossain', 'Territory Sales Officer (T.S.O)', '2019-03-05', 12, 51),
(30, '2304', 'Md. Oqiul Islam', 'Territory Sales Officer (T.S.O)', '2019-04-13', 12, 51),
(31, '2321', 'Hasan Md. Nur A Alam', 'Territory Sales Officer (T.S.O)', '2019-08-04', 12, 51),
(32, '2322', 'Md. Imam Hasan', 'Territory Sales Officer (T.S.O)', '2019-01-26', 12, 51),
(33, '2340', 'Harun-Ar-Rashid', 'Territory Sales Officer (T.S.O)', '2019-07-01', 12, 51),
(34, '2341', 'Md. Shofiqul Islam Sumon', 'Territory Sales Officer (T.S.O)', '2019-07-20', 12, 51),
(35, '2351', 'Md. Shopon Ali', 'Territory Sales Officer (T.S.O)', '2019-09-01', 12, 51),
(36, '2352', 'Shaidur Rahman', 'Territory Sales Officer (T.S.O)', '2010-06-26', 12, 51),
(37, '726', 'Ratan Chandra Paul', 'Territory Sales Officer (T.S.O)', '2011-02-17', 12, 51),
(38, '2', 'Md. Golum Mowla', 'Area Sales Executive (T.S.O)', '2008-01-01', 12, 51);

-- --------------------------------------------------------

--
-- Table structure for table `_supervisor`
--

CREATE TABLE `_supervisor` (
  `id_supervisor` int(11) NOT NULL,
  `login_id` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `name_sup` varchar(255) NOT NULL,
  `gender` varchar(255) NOT NULL,
  `phone_sup` varchar(255) NOT NULL,
  `zone_id` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_supervisor`
--

INSERT INTO `_supervisor` (`id_supervisor`, `login_id`, `password`, `name_sup`, `gender`, `phone_sup`, `zone_id`) VALUES
(1, 'sohel124', '123456', 'sohel Rana', 'male', '01687736569', '2');

-- --------------------------------------------------------

--
-- Table structure for table `_zone`
--

CREATE TABLE `_zone` (
  `zone_id` int(11) NOT NULL,
  `zone_name` varchar(255) NOT NULL,
  `zone_division` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `_zone`
--

INSERT INTO `_zone` (`zone_id`, `zone_name`, `zone_division`) VALUES
(7, 'Head Office', 'Dhaka'),
(11, 'Sales Representative', 'Dhaka'),
(12, 'Teritorrial Sales Officer (T.S.O.)', 'Dhaka'),
(13, 'Regional Sales Manager (R.S.M.)', 'Dhaka'),
(14, 'Merchandiser', 'Dhaka'),
(15, 'Laxmipur Factory', 'Dhaka'),
(16, 'Munshiganj Factory', 'Dhaka'),
(17, 'Laxmipur Warehouse', 'Dhaka'),
(18, 'Tekerhat Warehouse', 'Dhaka'),
(19, 'Mouchak Warehouse', 'Dhaka');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_user_id_unique` (`user_id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `_admin`
--
ALTER TABLE `_admin`
  ADD PRIMARY KEY (`id_admin`);

--
-- Indexes for table `_attendance`
--
ALTER TABLE `_attendance`
  ADD PRIMARY KEY (`id_attendance`);

--
-- Indexes for table `_employee`
--
ALTER TABLE `_employee`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `_supervisor`
--
ALTER TABLE `_supervisor`
  ADD PRIMARY KEY (`id_supervisor`);

--
-- Indexes for table `_zone`
--
ALTER TABLE `_zone`
  ADD PRIMARY KEY (`zone_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `_admin`
--
ALTER TABLE `_admin`
  MODIFY `id_admin` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `_attendance`
--
ALTER TABLE `_attendance`
  MODIFY `id_attendance` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `_employee`
--
ALTER TABLE `_employee`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=39;

--
-- AUTO_INCREMENT for table `_supervisor`
--
ALTER TABLE `_supervisor`
  MODIFY `id_supervisor` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `_zone`
--
ALTER TABLE `_zone`
  MODIFY `zone_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
