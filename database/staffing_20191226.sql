-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 26, 2019 at 11:26 PM
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
(7, 'PRIORITY', 'Low', ''),
(8, 'JOB_TYPE', 'Full Time', ''),
(9, 'JOB_TYPE', 'Part Time', ''),
(10, 'JOB_TYPE', 'Freelancer', ''),
(12, 'JOB_TYPE', 'Permanent', ''),
(13, 'JOB_TYPE', 'Temperory', ''),
(14, 'VACANCY_STATUS', 'Pending', ''),
(15, 'VACANCY_STATUS', 'Published', ''),
(16, 'VACANCY_STATUS', 'Rejected', '');

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
(21, 3, 22, 'Y'),
(23, 3, 25, 'Y'),
(24, 2, 23, 'Y'),
(25, 2, 24, 'Y'),
(26, 3, 26, 'Y'),
(27, 3, 27, 'Y'),
(28, 5, 28, 'Y'),
(29, 5, 29, 'Y'),
(30, 5, 30, 'Y');

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
(17, 0, 'Tickets', 'admintickets', '', '', '', '', '', '', 'LM', 5, 'remixicon-user-2-fill', 2, 'Y', '2019-12-26 15:36:41', '2019-12-12 08:00:00'),
(18, 17, 'Manage', 'managetickets', 'admin/manage-tickets', 'managetickets', 'Manage Tickets', 'Manage Tickets', 'Admin | Manage Tickets', '', 'LM', 0, '', 0, 'Y', '2019-12-26 15:37:45', '2019-12-12 08:00:00'),
(20, 0, 'Tickets', '', '', '', '', '', '', '', 'LM', 5, 'remixicon-user-2-fill', 2, 'Y', '2019-12-15 04:07:16', '2019-12-12 08:00:00'),
(21, 20, 'Manage', 'managetickets', 'employer/manage-tickets', 'managetickets', 'Manage Tickets', 'Manage Tickets', 'Employer | Manage Tickets', 'users', 'LM', 0, '', 0, 'Y', '2019-12-15 05:28:11', '2019-12-12 08:00:00'),
(22, 20, 'Register', 'registertickets', 'employer/register-tickets', 'registertickets', 'Register Tickets', 'Register Tickets', 'Employer | Register Tickets', 'users', 'LM', 0, '', 0, 'Y', '2019-12-15 05:28:11', '2019-12-12 08:00:00'),
(23, 0, 'Vacancies', '', '', '', '', '', '', 'General', 'LM', 6, ' remixicon-profile-line', 2, 'Y', '2019-12-26 15:42:01', '0000-00-00 00:00:00'),
(24, 23, 'Manage', 'managevacancies', 'admin/manage-vacancies', 'managevacancies', 'Manage Vacancies', 'Manage Vacancies', 'Admin| Manage Vacancies', 'admin', 'LM', 0, '', 0, 'Y', '2019-12-26 15:44:16', '2019-12-12 08:00:00'),
(25, 0, 'Vacancies', 'employervacancies', '', '', '', '', '', '', 'LM', 7, ' remixicon-profile-line', 2, 'Y', '2019-12-26 16:01:59', '2019-12-26 08:00:00'),
(26, 25, 'Manage', 'managevacancies', 'employer/manage-vacancies', 'managevacancies', 'Manage Vacancies', 'Manage Vacancies', 'Employer| Manage Vacancies', 'employer', 'LM', 0, '', 0, 'Y', '2019-12-26 15:44:16', '2019-12-12 08:00:00'),
(27, 25, 'Add', 'addvacancies', 'employer/add-vacancies', 'addvacancies', 'AddVacancies', 'AddVacancies', 'Employer | Add Vacancies', 'users', 'LM', 0, '', 0, 'Y', '2019-12-26 16:36:17', '2019-12-12 08:00:00'),
(28, 0, 'Availability', '', '', '', '', '', '', '', 'LM', 8, ' remixicon-profile-line', 2, 'Y', '2019-12-26 16:01:59', '2019-12-26 08:00:00'),
(29, 28, 'Manage', 'manageavailability', 'candidate/manage-availability', 'manageavailability', 'Manage Availability', 'Manage Availability', 'Candidate| Manage Availability', 'Candidate', 'LM', 0, '', 0, 'Y', '2019-12-26 15:44:16', '2019-12-12 08:00:00'),
(30, 28, 'Add', 'addavailability', 'candidate/add-availability', 'addavailability', 'Add Availability', 'Add Availability', 'Candidate| Add Availability', 'candidate', 'LM', 0, '', 0, 'Y', '2019-12-26 22:11:33', '2019-12-12 08:00:00');

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
(13, 14, 'b07091c0-1e89-11ea-a0c7-95878aece823', 'this means true', '2019-12-14', 'Pending', 'High', '2019-12-17 11:30:18', '2019-12-17 11:30:32'),
(14, 14, 'b07091c0-1e89-11ea-a0c7-95878aece823', 'this is complaint register method', '2019-12-20', 'Pending', 'Medium', '2019-12-21 01:33:54', '2019-12-21 01:33:54'),
(15, 23, 'c23332f0-262a-11ea-86ed-11f4f67f8e82', 'not registered', '2019-12-24', 'Pending', 'High', '2019-12-24 08:53:09', '2019-12-24 08:53:14'),
(16, 25, '96aa8740-2829-11ea-be6d-878a45509f0e', 'i am not able to create vacancies. Not able to manage the vacancies', '2019-12-25', 'Pending', 'High', '2019-12-26 09:55:30', '2019-12-26 09:55:46');

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
(25, '96aa8740-2829-11ea-be6d-878a45509f0e', 'vivek', 'vivek@gmail.com', NULL, '$2y$10$q8jZHhzXD13Yh27YHXYSM.8LZW6PyJLNfLcIF5rxs/zTgnLc86Cpm', NULL, 3, 'Active', '2019-12-27 05:49:27', '2019-12-27 05:53:49'),
(26, '0d2f6440-282b-11ea-857a-97ef75e56f94', 'sanusha', 'sanusha@gmail.com', NULL, '$2y$10$aO9Y6kjKsVTEN0pNsItEpeClLQRVbeeEFHpvblaIHdoMtuZld7qeO', NULL, 5, 'Inactive', '2019-12-27 05:59:55', '2019-12-27 05:59:55');

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
(1, 2, 'f7138870-184c-11ea-89d4-c39e3d56b013', 'Vyshakh', 'Ps', 'admin@gmail.com', '7907487010', '', 'India', 'Kerala', 'Vadakara', '673104', '1988-02-13', 'B+', '', '', '', '', '2019-12-03 18:30:00', '2019-12-03 18:30:00'),
(22, 25, '96aa8740-2829-11ea-be6d-878a45509f0e', 'Vivek', 'Ps', 'vivek@gmail.com', '7907487010', NULL, NULL, NULL, NULL, NULL, '1989-09-08', NULL, 'Engineer', 'Menaval', NULL, 'Accept', NULL, '2019-12-27 05:53:49'),
(23, NULL, '0d2f6440-282b-11ea-857a-97ef75e56f94', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'Pending', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `vacancies`
--

CREATE TABLE `vacancies` (
  `id` int(11) NOT NULL,
  `name` varchar(255) NOT NULL,
  `total_vacancy` int(11) NOT NULL,
  `qualifications` varchar(500) NOT NULL,
  `company_name` varchar(255) DEFAULT NULL,
  `company_details` varchar(255) DEFAULT NULL,
  `company_location` varchar(255) DEFAULT NULL,
  `job_location` varchar(255) DEFAULT NULL,
  `job_description` varchar(1000) DEFAULT NULL,
  `job_close_date` date NOT NULL,
  `job_post_date` date DEFAULT NULL,
  `salary` int(11) DEFAULT NULL,
  `job_type` varchar(255) DEFAULT NULL,
  `skills` varchar(500) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `user_id` int(11) NOT NULL,
  `uuid` varchar(300) NOT NULL,
  `status` varchar(25) NOT NULL COMMENT 'Pending, Accept, Reject',
  `created_at` datetime NOT NULL DEFAULT current_timestamp(),
  `updated_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `vacancies`
--

INSERT INTO `vacancies` (`id`, `name`, `total_vacancy`, `qualifications`, `company_name`, `company_details`, `company_location`, `job_location`, `job_description`, `job_close_date`, `job_post_date`, `salary`, `job_type`, `skills`, `email`, `phone`, `user_id`, `uuid`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Computer Operator', 5, 'BCA', 'Menaval', '', NULL, 'Kannur', 'Working hours will be from morning 5am to 5pm', '2019-12-31', '2019-12-13', NULL, NULL, NULL, 'info@menaval.com', '7907487010', 24, 'bb401250-27f8-11ea-8c32-ddc19776d07f', 'Published', '2019-12-26 06:23:33', '2019-12-26 21:33:08'),
(2, 'Nurse', 1, 'BSC NURSING', 'Koyili Hospital', '', NULL, 'Kannur', '', '2019-12-28', '2019-12-26', NULL, NULL, NULL, 'info@menaval.com', '7907487010', 24, 'bb401250-27f8-11ea-8c32-ddc19776d07f', 'Published', '2019-12-26 06:28:36', '2019-12-26 21:35:07');

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
-- Indexes for table `vacancies`
--
ALTER TABLE `vacancies`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `business_key`
--
ALTER TABLE `business_key`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `screens`
--
ALTER TABLE `screens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=31;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `users_details`
--
ALTER TABLE `users_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=24;

--
-- AUTO_INCREMENT for table `vacancies`
--
ALTER TABLE `vacancies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
