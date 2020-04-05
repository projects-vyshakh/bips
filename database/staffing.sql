-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 18, 2019 at 12:31 AM
-- Server version: 10.4.10-MariaDB
-- PHP Version: 7.3.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `staffing`
--

-- --------------------------------------------------------

--
-- Table structure for table `business_key`
--

CREATE TABLE `business_key` (
  `id` int(11) NOT NULL,
  `business_key` varchar(255) NOT NULL,
  `key_value` varchar(255) NOT NULL,
  `descriptiom` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `business_key`
--

INSERT INTO `business_key` (`id`, `business_key`, `key_value`, `descriptiom`) VALUES
(1, 'EMP_ACCOUNT_STATUS', 'Pending', ''),
(2, 'EMP_ACCOUNT_STATUS', 'Accept', ''),
(3, 'EMP_ACCOUNT_STATUS', 'Reject', ''),
(4, 'EMP_ACCOUNT_STATUS', 'Delete', ''),
(5, 'PRIORITY', 'High', ''),
(6, 'PRIORITY', 'Medium', ''),
(7, 'PRIORITY', 'Low', '');

-- --------------------------------------------------------

--
-- Table structure for table `employers_details`
--

CREATE TABLE `employers_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `first_name` varchar(255) NOT NULL,
  `last_name` varchar(255) NOT NULL,
  `dob` date NOT NULL,
  `email` varchar(255) NOT NULL,
  `phone` varchar(20) NOT NULL,
  `designation` varchar(255) NOT NULL,
  `account_status` varchar(255) NOT NULL COMMENT 'Pending,  Accepted,  Rejected, Deleted',
  `company_name` varchar(500) NOT NULL,
  `company_address` varchar(1000) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `media`
--

CREATE TABLE `media` (
  `id` int(11) NOT NULL,
  `media_uuid` varchar(500) NOT NULL,
  `user_id` int(11) NOT NULL,
  `media_name` varchar(255) NOT NULL,
  `category` varchar(255) NOT NULL,
  `base_path` varchar(255) NOT NULL,
  `bucket_name` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `extension_supported` varchar(500) NOT NULL,
  `created_at` int(11) NOT NULL,
  `updated_at` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int(10) UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2019_08_19_000000_create_failed_jobs_table', 1),
(4, '2019_12_03_181337_create_users_details_table', 2),
(5, '2019_12_03_183049_create_users_details_table', 3),
(6, '2019_12_03_185536_create_roles_table', 4),
(7, '2019_12_03_185704_add_roles_to_users_table', 5),
(8, '2019_12_03_185903_add_status_to_users_table', 5);

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `roles`
--

CREATE TABLE `roles` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `short_name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `description` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `roles`
--

INSERT INTO `roles` (`id`, `name`, `short_name`, `description`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Super Administrator', 'sudo', 'Has the full controll over the application', 1, '2019-12-03 18:30:00', '2019-12-03 18:30:00'),
(2, 'Administrator', 'admin', '', 1, '2019-12-03 18:30:00', '2019-12-03 18:30:00'),
(3, 'Employer', 'employer', '', 1, '2019-12-03 18:30:00', '2019-12-03 18:30:00'),
(4, 'Employee', 'employee', '', 1, '2019-12-03 18:30:00', '2019-12-03 18:30:00'),
(5, 'Candidate', 'candidate', '', 1, '2019-12-03 18:30:00', '2019-12-03 18:30:00');

-- --------------------------------------------------------

--
-- Table structure for table `roles_screen`
--

CREATE TABLE `roles_screen` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `screen_id` int(11) NOT NULL,
  `is_active` varchar(1) NOT NULL DEFAULT 'Y'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `roles_screen`
--

INSERT INTO `roles_screen` (`id`, `role_id`, `screen_id`, `is_active`) VALUES
(1, 2, 1, 'Y'),
(2, 1, 2, 'Y'),
(3, 3, 4, 'Y'),
(4, 4, 3, 'Y'),
(5, 5, 5, 'Y'),
(6, 2, 6, 'Y'),
(7, 2, 7, 'Y'),
(8, 2, 8, 'Y'),
(9, 2, 9, 'Y'),
(10, 2, 10, 'Y'),
(11, 2, 11, 'Y'),
(12, 2, 12, 'Y'),
(13, 2, 13, 'Y'),
(14, 2, 14, 'Y'),
(15, 2, 15, 'Y'),
(16, 2, 16, 'Y'),
(17, 2, 17, 'Y'),
(18, 2, 18, 'Y'),
(19, 3, 20, 'Y'),
(20, 3, 21, 'Y'),
(21, 3, 22, 'Y');

-- --------------------------------------------------------

--
-- Table structure for table `screens`
--

CREATE TABLE `screens` (
  `id` int(11) NOT NULL,
  `parent_id` int(11) NOT NULL DEFAULT 0,
  `name` varchar(255) NOT NULL,
  `short_name` varchar(255) NOT NULL,
  `url` varchar(500) NOT NULL,
  `short_url` varchar(255) NOT NULL,
  `breadcrumps` varchar(255) NOT NULL,
  `page_title` varchar(255) NOT NULL,
  `browser_title` varchar(500) NOT NULL,
  `screens_for` varchar(255) NOT NULL COMMENT 'roles namefrom roles table',
  `position` varchar(255) NOT NULL COMMENT 'LM = LeftMenu, RM = Right Menu, TM = Top Menu, BM = Bottom Menu,  I = Inside Content',
  `priority` int(11) NOT NULL DEFAULT 0,
  `icon` varchar(500) NOT NULL,
  `depth` int(11) NOT NULL DEFAULT 0 COMMENT 'depth is for understand the screen has child',
  `is_screen_active` varchar(1) NOT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp() ON UPDATE current_timestamp(),
  `updated_at` timestamp NOT NULL DEFAULT '0000-00-00 00:00:00'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `screens`
--

INSERT INTO `screens` (`id`, `parent_id`, `name`, `short_name`, `url`, `short_url`, `breadcrumps`, `page_title`, `browser_title`, `screens_for`, `position`, `priority`, `icon`, `depth`, `is_screen_active`, `created_at`, `updated_at`) VALUES
(1, 0, 'Dashboard', 'admindashboard', 'admin/dashboard', 'admindashboard', 'Dashboard', 'Admin Dashboard ', 'Menaval | Dashboard', 'admin', 'LM', 1, 'remixicon-dashboard-line', 0, 'Y', '2019-12-13 08:33:59', '2019-12-03 18:30:00'),
(2, 0, 'Dashboard', 'sudodashboard', 'sudo/dashboard', 'sudodashboard', 'Super Admin Dashbboard', 'Super Admin Dashboard', 'Menaval | Dashboard', 'sudo', 'LM', 1, 'remixicon-dashboard-line', 0, 'Y', '2019-12-13 08:34:04', '0000-00-00 00:00:00'),
(3, 0, 'Dashboard', 'employeedashboard', 'employee/dashboard', 'employeedashboard', 'Employee Dashbboard', 'Employee Dashboard', 'Menaval | Dashboard', 'employee', 'LM', 1, 'remixicon-dashboard-line', 0, 'Y', '2019-12-13 08:34:09', '0000-00-00 00:00:00'),
(4, 0, 'Dashboard', 'employerdashboard', 'employer/dashboard', 'employerdashboard', 'Employer Dashbboard', 'Employer Dashboard', 'Menaval | Dashboard', 'employer', 'LM', 1, 'remixicon-dashboard-line', 0, 'Y', '2019-12-13 08:34:12', '0000-00-00 00:00:00'),
(5, 0, 'Dashboard', 'candidatedashboard', 'candidate/dashboard', 'candidatedashboard', 'Candidate Dashbboard', 'Candidate Dashboard', 'Menaval | Dashboard', 'candidate', 'LM', 1, 'remixicon-dashboard-line', 0, 'Y', '2019-12-13 08:34:15', '0000-00-00 00:00:00'),
(6, 0, 'Employer', '', '', '', '', '', '', 'admin', 'LM', 2, 'remixicon-user-2-fill', 2, 'Y', '2019-12-06 14:27:59', '0000-00-00 00:00:00'),
(7, 6, 'Manage', 'manageemployer', 'admin/manage-employer', 'manageemployer', 'Manage Employer', 'Manage Employer', 'Admin | Manage Employer', 'admin', 'LM', 0, '', 0, 'Y', '2019-12-06 14:30:32', '0000-00-00 00:00:00'),
(8, 6, 'Profile', 'profileemployer', 'admin/profile-employer', 'profileemployer', 'Profile', 'Profile', 'Admin | Employer Profile', 'admin', 'LM', 0, '', 0, 'Y', '2019-12-06 20:24:35', '0000-00-00 00:00:00'),
(9, 0, 'Employee', '', '', '', '', '', '', 'admin', 'LM', 3, 'remixicon-user-2-fill', 2, 'Y', '2019-12-12 14:27:59', '2019-12-12 08:00:00'),
(10, 9, 'Manage', 'manageemployee', 'admin/manage-employee', 'manageemployee', 'Manage Employee', 'Manage Employee', 'Admin | Manage Employee', 'admin', 'LM', 0, '', 0, 'Y', '2019-12-13 07:09:53', '2019-12-12 08:00:00'),
(11, 9, 'Profile', 'profileemployee', 'admin/profile-employee', 'profileemployee', 'Profile', 'Profile', 'Admin | Employee Profile', 'admin', 'LM', 0, '', 0, 'Y', '2019-12-12 20:24:35', '2019-12-12 08:00:00'),
(12, 0, 'Configurations', '', '', '', '', '', '', 'admin', 'LM', 15, 'remixicon-chat-settings-line', 1, 'Y', '2019-12-13 08:59:42', '2019-12-12 08:00:00'),
(13, 12, 'Permissions', 'permissions', 'admin/permissions', 'permissions', 'Permissions', 'Permissions', 'Admin | Permissions', 'admin', 'LM', 0, '', 0, 'Y', '2019-12-12 20:24:35', '2019-12-12 08:00:00'),
(14, 0, 'Candidate', '', '', '', '', '', '', 'admin', 'LM', 4, 'remixicon-user-2-fill', 2, 'Y', '2019-12-12 14:27:59', '2019-12-12 08:00:00'),
(15, 14, 'Manage', 'managecandidate', 'admin/manage-candidate', 'managecandidate', 'Manage Candidate', 'Manage Candidate', 'Admin | Manage Candidate', 'admin', 'LM', 0, '', 0, 'Y', '2019-12-13 07:09:53', '2019-12-12 08:00:00'),
(16, 14, 'Profile', 'profilecandidate', 'admin/profile-candidate', 'profilecandidate', 'Profile', 'Profile', 'Admin | Employee candidate', 'admin', 'LM', 0, '', 0, 'Y', '2019-12-12 20:24:35', '2019-12-12 08:00:00'),
(17, 0, 'Tickets', '', '', '', '', '', '', '', 'LM', 5, 'remixicon-user-2-fill', 2, 'Y', '2019-12-15 04:07:16', '2019-12-12 08:00:00'),
(18, 17, 'Manage', 'managetickets', 'admin/manage-tickets', 'managetickets', 'Manage Tickets', 'Manage Tickets', 'Admin | Manage Tickets', '', 'LM', 0, '', 2, 'Y', '2019-12-15 05:25:15', '2019-12-12 08:00:00'),
(20, 0, 'Tickets', '', '', '', '', '', '', '', 'LM', 5, 'remixicon-user-2-fill', 2, 'Y', '2019-12-15 04:07:16', '2019-12-12 08:00:00'),
(21, 20, 'Manage', 'managetickets', 'employer/manage-tickets', 'managetickets', 'Manage Tickets', 'Manage Tickets', 'Employer | Manage Tickets', 'users', 'LM', 0, '', 0, 'Y', '2019-12-15 05:28:11', '2019-12-12 08:00:00'),
(22, 20, 'Register', 'registertickets', 'employer/register-tickets', 'registertickets', 'Register Tickets', 'Register Tickets', 'Employer | Register Tickets', 'users', 'LM', 0, '', 0, 'Y', '2019-12-15 05:28:11', '2019-12-12 08:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `tickets`
--

CREATE TABLE `tickets` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `uuid` varchar(500) NOT NULL,
  `complaint` varchar(10000) NOT NULL,
  `date` date NOT NULL,
  `status` varchar(255) NOT NULL COMMENT 'Pending, In Progress, Rejected, Closed',
  `priority` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tickets`
--

INSERT INTO `tickets` (`id`, `user_id`, `uuid`, `complaint`, `date`, `status`, `priority`, `created_at`, `updated_at`) VALUES
(1, 13, 'fa115e20-1e29-11ea-b528-c9c0c8ae11a4', 'Candidate does not responding', '2019-12-10', 'Closed', 'High', '2019-12-16 00:00:00', '2019-12-16 00:00:00'),
(2, 13, 'fa115e20-1e29-11ea-b528-c9c0c8ae11a4', 'Posted a requirement which will not be enabled.', '2019-12-16', 'Pending', 'Normal', '2019-12-16 00:00:00', '2019-12-16 00:00:00'),
(3, 14, 'b07091c0-1e89-11ea-a0c7-95878aece823', 'new', '2019-12-17', 'Pending', 'Low', '2019-12-17 10:32:27', '2019-12-17 11:27:57'),
(4, 14, 'b07091c0-1e89-11ea-a0c7-95878aece823', 'this is just updating', '2019-12-17', 'Pending', 'High', '2019-12-17 10:36:09', '2019-12-17 11:28:10'),
(5, 14, 'b07091c0-1e89-11ea-a0c7-95878aece823', 'candidate not taking the calls', '2019-12-17', 'Pending', 'High', '2019-12-17 10:36:30', '2019-12-17 10:36:30'),
(6, 14, 'b07091c0-1e89-11ea-a0c7-95878aece823', 'candidate not taking the calls', '2019-12-17', 'Pending', 'High', '2019-12-17 10:36:43', '2019-12-17 10:36:43'),
(7, 14, 'b07091c0-1e89-11ea-a0c7-95878aece823', 'candidate not taking the calls', '2019-12-17', 'Pending', 'High', '2019-12-17 10:37:01', '2019-12-17 10:37:01'),
(8, 14, 'b07091c0-1e89-11ea-a0c7-95878aece823', 'update this issue', '2019-12-17', 'Pending', 'High', '2019-12-17 11:19:52', '2019-12-17 11:19:52'),
(9, 14, 'b07091c0-1e89-11ea-a0c7-95878aece823', 'hai', '2019-12-17', 'Pending', 'Medium', '2019-12-17 11:29:14', '2019-12-17 11:29:14'),
(10, 14, 'b07091c0-1e89-11ea-a0c7-95878aece823', 'this is not good', '2019-12-16', 'Pending', 'Low', '2019-12-17 11:29:33', '2019-12-17 11:29:33'),
(11, 14, 'b07091c0-1e89-11ea-a0c7-95878aece823', 'hello', '2019-12-15', 'Pending', 'Medium', '2019-12-17 11:29:54', '2019-12-17 11:29:54'),
(12, 14, 'b07091c0-1e89-11ea-a0c7-95878aece823', 'yes we can', '2019-12-15', 'Pending', 'High', '2019-12-17 11:30:07', '2019-12-17 11:30:07'),
(13, 14, 'b07091c0-1e89-11ea-a0c7-95878aece823', 'this means true', '2019-12-14', 'Pending', 'High', '2019-12-17 11:30:18', '2019-12-17 11:30:32');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `uuid` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `remember_token` varchar(350) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `roles` int(11) DEFAULT NULL,
  `status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Inactive',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `uuid`, `name`, `email`, `email_verified_at`, `password`, `remember_token`, `roles`, `status`, `created_at`, `updated_at`) VALUES
(2, 'f7138870-184c-11ea-89d4-c39e3d56b013', 'Vyshakh Ps', 'admin@gmail.com', NULL, '$2y$10$eHcUfcjrCqOcp.pkyiFhKu29kMpvo4mkOKggCtphYVNmAQk9bsme6', NULL, 2, 'Active', '2019-12-03 14:41:57', '2019-12-03 14:41:57'),
(13, 'fa115e20-1e29-11ea-b528-c9c0c8ae11a4', 'vivek ps', 'vivek@gmail.om', NULL, '$2y$10$3HfH0Az4F98fP.XZeSfWVO7OYxxvKj1oaHCvkUIbP9xhJMYJQpahO', NULL, 3, 'Active', '2019-12-14 12:27:02', '2019-12-16 17:08:06'),
(14, 'b07091c0-1e89-11ea-a0c7-95878aece823', 'sanusha', 'sanusha@gmail.com', NULL, '$2y$10$/UqpRAadvnbr.xfKs870/.x6CETaRCQAv0SCMN8WpLwaKpiT3tbzm', NULL, 3, 'Inactive', '2019-12-14 23:52:10', '2019-12-14 23:52:10'),
(15, '8c2ddd40-1e8a-11ea-adb3-c3e1144725b2', 'sruthi', 'sruthi@gmail.com', NULL, '$2y$10$.WRQ4XnhDmywqhWg3TzuyefX8jXf39x5WGNcHJF2m1u1m2gPZq8dW', NULL, 3, 'Inactive', '2019-12-14 23:58:19', '2019-12-14 23:58:19'),
(16, '95eaea60-1e8c-11ea-bace-2fecb2a0bf73', 'anusha', 'anusha@gmail.com', NULL, '$2y$10$7a7m/7KxkNjv0mMGavC5YuhJubNz9dkUXBRg2Rgnbb2SbrErGrEOy', NULL, 3, 'Inactive', '2019-12-15 00:12:54', '2019-12-15 00:12:54'),
(17, 'b4290070-1e8c-11ea-b21d-a53a308a2cde', 'chinnu', 'chinnu@gmail.com', NULL, '$2y$10$VvzHUnR7j5LK3jtU.q3J1.OHHWDCvid9KgKCzS8lZAM4BpgeIi1FO', NULL, 3, 'Inactive', '2019-12-15 00:13:45', '2019-12-15 00:13:45'),
(18, 'ec4ea200-1e8d-11ea-8816-c987455bf80a', 'unni', 'unni@gmail.com', NULL, '$2y$10$DrID2nY5h38uN.f8mm8fqumbgKivZzo5f48E/r0Hif04ZG58Ht6Fq', NULL, 3, 'Inactive', '2019-12-15 00:22:29', '2019-12-15 00:22:29'),
(19, 'f98c88c0-1e99-11ea-868d-dd20e72f3863', 'peehu', 'peehu@gmail.om', NULL, '$2y$10$A0R6frU98s3GeQKnNd26OOV83XpdBUlDRa25W.A8U4mxfnvkUl4e.', NULL, 3, 'Inactive', '2019-12-15 01:48:45', '2019-12-15 01:48:45'),
(20, 'eafa9680-1ee8-11ea-a7b8-d58e661fc76c', 'samantha', 'samantha@gmail.com', NULL, '$2y$10$12X2bc4Iopn23IMfNR34Mey6B47SmOENZ9X6iVlaDZcIP46AwoCQG', NULL, 3, 'Inactive', '2019-12-15 11:13:51', '2019-12-15 11:13:51'),
(21, '1cfa76d0-1ee9-11ea-be6f-0d9135c04c1e', 'adhvika', 'adhvika@gmail.com', NULL, '$2y$10$WahN6PusKA9eq.YWGGowCeWOSpNTtGRAENGedY.Fzi5BQhUrZxcOm', NULL, 3, 'Inactive', '2019-12-15 11:15:15', '2019-12-15 11:15:15'),
(22, '45304a40-1ee9-11ea-9353-b9120dbdb169', 'minnu', 'minnu@gmail.com', NULL, '$2y$10$a.itnPPbMPAB0eJpM27f9OQwwv/W4/AJowvFos15vtRW1sj0LiRwC', NULL, 3, 'Inactive', '2019-12-15 11:16:22', '2019-12-15 11:16:22');

-- --------------------------------------------------------

--
-- Table structure for table `users_details`
--

CREATE TABLE `users_details` (
  `id` bigint(20) UNSIGNED NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `uuid` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `first_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `last_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `phone` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `house_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `country` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `state` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `city` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `pin` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `blood_group` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `designation` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_name` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `company_address` varchar(500) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `account_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending' COMMENT 'Pending, Accept, Reject, Delete',
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_details`
--

INSERT INTO `users_details` (`id`, `user_id`, `uuid`, `first_name`, `last_name`, `email`, `phone`, `house_name`, `country`, `state`, `city`, `pin`, `dob`, `blood_group`, `designation`, `company_name`, `company_address`, `account_status`, `created_at`, `updated_at`) VALUES
(1, 2, '', 'Vyshakh', 'Ps', 'admin@gmail.com', '7907487010', '', 'India', 'Kerala', 'Vadakara', '673104', '1988-02-13', 'B+', '', '', '', '', '2019-12-03 18:30:00', '2019-12-03 18:30:00'),
(8, NULL, 'fa115e20-1e29-11ea-b528-c9c0c8ae11a4', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL),
(9, NULL, 'b07091c0-1e89-11ea-a0c7-95878aece823', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL),
(10, NULL, '8c2ddd40-1e8a-11ea-adb3-c3e1144725b2', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL),
(11, NULL, '95eaea60-1e8c-11ea-bace-2fecb2a0bf73', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL),
(12, NULL, 'b4290070-1e8c-11ea-b21d-a53a308a2cde', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL),
(13, NULL, 'ec4ea200-1e8d-11ea-8816-c987455bf80a', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL),
(14, NULL, 'f98c88c0-1e99-11ea-868d-dd20e72f3863', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL),
(15, NULL, 'eafa9680-1ee8-11ea-a7b8-d58e661fc76c', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL),
(16, NULL, '1cfa76d0-1ee9-11ea-be6f-0d9135c04c1e', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL),
(17, NULL, '45304a40-1ee9-11ea-9353-b9120dbdb169', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL),
(18, 13, 'fa115e20-1e29-11ea-b528-c9c0c8ae11a4', 'Vivek Ps', 'Ps', 'vivek@gmail.om', '7907487010', NULL, NULL, NULL, NULL, NULL, '2019-12-05', NULL, 'Ceo', 'Trinity', NULL, 'Accept', NULL, NULL);

--
-- Indexes for dumped tables
--

--
-- Indexes for table `business_key`
--
ALTER TABLE `business_key`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `employers_details`
--
ALTER TABLE `employers_details`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `media`
--
ALTER TABLE `media`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `roles`
--
ALTER TABLE `roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `roles_screen`
--
ALTER TABLE `roles_screen`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `screens`
--
ALTER TABLE `screens`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `tickets`
--
ALTER TABLE `tickets`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`),
  ADD UNIQUE KEY `uuid` (`uuid`);

--
-- Indexes for table `users_details`
--
ALTER TABLE `users_details`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business_key`
--
ALTER TABLE `business_key`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `employers_details`
--
ALTER TABLE `employers_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `media`
--
ALTER TABLE `media`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles_screen`
--
ALTER TABLE `roles_screen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=22;

--
-- AUTO_INCREMENT for table `screens`
--
ALTER TABLE `screens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=23;

--
-- AUTO_INCREMENT for table `users_details`
--
ALTER TABLE `users_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
