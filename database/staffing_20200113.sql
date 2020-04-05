-- phpMyAdmin SQL Dump
-- version 4.9.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jan 12, 2020 at 08:10 PM
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
-- Table structure for table `assigned_vacancy`
--

CREATE TABLE `assigned_vacancy` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `vacancy_id` int(11) NOT NULL,
  `date` date NOT NULL,
  `created_at` datetime DEFAULT NULL,
  `updated_at` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assigned_vacancy`
--

INSERT INTO `assigned_vacancy` (`id`, `user_id`, `vacancy_id`, `date`, `created_at`, `updated_at`) VALUES
(1, 26, 1, '2020-01-10', NULL, NULL),
(2, 26, 1, '2020-01-10', NULL, NULL),
(3, 26, 1, '2020-01-10', NULL, NULL),
(4, 27, 1, '2020-01-10', NULL, NULL),
(5, 32, 1, '2020-01-10', NULL, NULL),
(6, 26, 3, '2020-01-20', NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `availability`
--

CREATE TABLE `availability` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `uuid` varchar(500) NOT NULL,
  `date` date NOT NULL,
  `category` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `availability`
--

INSERT INTO `availability` (`id`, `user_id`, `uuid`, `date`, `category`, `created_at`, `updated_at`) VALUES
(1, 27, '', '2020-01-07', 'Not Available', '2020-01-05 08:41:03', '2020-01-05 08:41:19'),
(2, 26, '', '2020-01-10', 'Available', '2020-01-05 13:22:28', '2020-01-05 13:26:59'),
(3, 27, '', '2020-01-10', 'Available', '2020-01-05 13:27:09', '2020-01-05 13:27:09'),
(4, 27, '', '2020-01-11', 'Available', '2020-01-05 13:27:09', '2020-01-05 13:27:09');

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
(16, 'VACANCY_STATUS', 'Rejected', ''),
(17, 'CANDIDATE_AVAILABILITY', 'Available', ''),
(18, 'CANDIDATE_AVAILABILITY', 'Not Available', ''),
(19, 'TICKETS_STATUS', 'Pending', ''),
(20, 'TICKETS_STATUS', 'Closed', ''),
(21, 'TICKETS_STATUS', 'In Progress', ''),
(22, 'TICKETS_STATUS', 'Rejected', ''),
(23, 'GENDER', 'Male', ''),
(24, 'GENDER', 'Female', ''),
(25, 'GENDER', 'Trans-Gender', '');

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
  `settings_id` int(11) NOT NULL,
  `media_uuid` varchar(500) NOT NULL,
  `user_id` int(11) NOT NULL,
  `user_uuid` varchar(500) NOT NULL,
  `media_name` varchar(255) NOT NULL,
  `bucket_name` varchar(255) NOT NULL,
  `filename` varchar(255) NOT NULL,
  `extension` varchar(255) NOT NULL,
  `status` varchar(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `media`
--

INSERT INTO `media` (`id`, `settings_id`, `media_uuid`, `user_id`, `user_uuid`, `media_name`, `bucket_name`, `filename`, `extension`, `status`, `created_at`, `updated_at`) VALUES
(1, 1, '9b7c0780-3568-11ea-bb96-73e72f49179f', 2, 'f7138870-184c-11ea-89d4-c39e3d56b013', 'Not_0072019_1432019', 'documents', 'Not_0072019_1432019', 'pdf', 'Active', '2020-01-12 18:23:18', '2020-01-12 18:27:41'),
(3, 2, '57ceea40-3569-11ea-b469-c3332342b15b', 2, 'f7138870-184c-11ea-89d4-c39e3d56b013', 'IMG-20190402-WA0012', 'images', 'IMG-20190402-WA0012', 'jpg', 'Active', '2020-01-12 18:28:34', '2020-01-12 18:32:05'),
(4, 2, 'e73ee610-3569-11ea-8b91-5f989a619172', 2, 'f7138870-184c-11ea-89d4-c39e3d56b013', 'New Project', 'images', 'New Project', 'jpg', 'Active', '2020-01-12 18:32:35', '2020-01-12 18:32:35');

-- --------------------------------------------------------

--
-- Table structure for table `media_settings`
--

CREATE TABLE `media_settings` (
  `id` int(11) NOT NULL,
  `settings_name` varchar(255) NOT NULL,
  `media_type` varchar(255) NOT NULL,
  `base_path` varchar(255) NOT NULL,
  `supported_extension` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `media_settings`
--

INSERT INTO `media_settings` (`id`, `settings_name`, `media_type`, `base_path`, `supported_extension`) VALUES
(1, 'PDF', 'documents', 'storage/uploads/', '[\"pdf\",\"doc\",\"docx\"]'),
(2, 'Graphical Images', 'images', 'storage/uploads/', '[\"jpg\",\"jpeg\",\"png\",\"gif\"]');

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
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `uuid` varchar(500) NOT NULL,
  `approved_by` int(11) NOT NULL,
  `amount` varchar(255) NOT NULL,
  `date` date NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `uuid`, `approved_by`, `amount`, `date`, `created_at`, `updated_at`) VALUES
(1, 27, '9c1edb80-2f78-11ea-8ced-cdf5bc5e4022', 2, '500', '2020-01-07', '2020-01-05 22:03:30', '2020-01-05 22:03:30'),
(2, 27, '9c1edb80-2f78-11ea-8ced-cdf5bc5e4022', 2, '500', '2020-01-07', '2020-01-05 22:03:39', '2020-01-05 22:03:39'),
(3, 27, '9c1edb80-2f78-11ea-8ced-cdf5bc5e4022', 2, '1000', '2020-01-08', '2020-01-05 22:05:23', '2020-01-05 22:05:23');

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
(30, 5, 30, 'Y'),
(31, 4, 28, 'Y'),
(32, 4, 30, 'Y'),
(33, 4, 29, 'Y'),
(34, 4, 31, 'Y'),
(35, 4, 32, 'Y'),
(36, 4, 33, 'Y'),
(37, 4, 34, 'Y'),
(38, 2, 35, 'Y'),
(39, 2, 36, 'Y'),
(40, 2, 37, 'Y'),
(41, 2, 38, 'Y'),
(42, 2, 39, 'Y'),
(43, 2, 40, 'Y'),
(44, 2, 41, 'Y'),
(45, 2, 42, 'Y');

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
(12, 0, 'Configurations', '', '', '', '', '', '', 'admin', 'LM', 15, 'remixicon-chat-settings-line', 1, 'N', '2020-01-07 12:36:49', '2019-12-12 08:00:00'),
(13, 12, 'Permissions', 'permissions', 'admin/permissions', 'permissions', 'Permissions', 'Permissions', 'Admin | Permissions', 'admin', 'LM', 0, '', 0, 'Y', '2019-12-12 20:24:35', '2019-12-12 08:00:00'),
(14, 0, 'Candidate', '', '', '', '', '', '', 'admin', 'LM', 4, 'remixicon-user-2-fill', 2, 'N', '2020-01-05 15:40:18', '2019-12-12 08:00:00'),
(15, 14, 'Manage', 'managecandidate', 'admin/manage-candidate', 'managecandidate', 'Manage Candidate', 'Manage Candidate', 'Admin | Manage Candidate', 'admin', 'LM', 0, '', 0, 'N', '2020-01-05 15:40:23', '2019-12-12 08:00:00'),
(16, 14, 'Profile', 'profilecandidate', 'admin/profile-candidate', 'profilecandidate', 'Profile', 'Profile', 'Admin | Employee candidate', 'admin', 'LM', 0, '', 0, 'N', '2020-01-05 15:40:27', '2019-12-12 08:00:00'),
(17, 0, 'Tickets', 'admintickets', '', '', '', '', '', '', 'LM', 14, 'remixicon-user-2-fill', 2, 'Y', '2020-01-05 15:51:03', '2019-12-12 08:00:00'),
(18, 17, 'Manage', 'managetickets', 'admin/manage-tickets', 'managetickets', 'Manage Tickets', 'Manage Tickets', 'Admin | Manage Tickets', '', 'LM', 0, '', 0, 'Y', '2019-12-26 15:37:45', '2019-12-12 08:00:00'),
(20, 0, 'Tickets', '', '', '', '', '', '', '', 'LM', 7, 'remixicon-user-2-fill', 2, 'Y', '2020-01-05 22:49:44', '2019-12-12 08:00:00'),
(21, 20, 'Manage', 'managetickets', 'employer/manage-tickets', 'managetickets', 'Manage Tickets', 'Manage Tickets', 'Employer | Manage Tickets', 'users', 'LM', 0, '', 0, 'Y', '2019-12-15 05:28:11', '2019-12-12 08:00:00'),
(22, 20, 'Register', 'registertickets', 'employer/register-tickets', 'registertickets', 'Register Tickets', 'Register Tickets', 'Employer | Register Tickets', 'users', 'LM', 0, '', 0, 'Y', '2019-12-15 05:28:11', '2019-12-12 08:00:00'),
(23, 0, 'Requirement', '', '', '', '', '', '', 'General', 'LM', 6, ' remixicon-profile-line', 2, 'Y', '2020-01-12 06:03:56', '0000-00-00 00:00:00'),
(24, 23, 'Manage', 'managevacancies', 'admin/manage-vacancies', 'managevacancies', 'Manage Requirement', 'Manage Requirement', 'Admin| Manage Requirement', 'admin', 'LM', 0, '', 0, 'Y', '2020-01-12 06:04:22', '2019-12-12 08:00:00'),
(25, 0, 'Requirement', 'employervacancies', '', '', '', '', '', '', 'LM', 5, ' remixicon-profile-line', 2, 'Y', '2020-01-12 06:04:28', '2019-12-26 08:00:00'),
(26, 25, 'Manage', 'managevacancies', 'employer/manage-vacancies', 'managevacancies', 'Manage Requirement', 'Manage Requirement', 'Employer| Manage Requirement', 'employer', 'LM', 0, '', 0, 'Y', '2020-01-12 06:04:39', '2019-12-12 08:00:00'),
(27, 25, 'Add', 'addvacancies', 'employer/add-vacancies', 'addvacancies', 'AddVacancies', 'AddVacancies', 'Employer | Add Vacancies', 'users', 'LM', 0, '', 0, 'Y', '2019-12-26 16:36:17', '2019-12-12 08:00:00'),
(28, 0, 'Availability', '', '', '', '', '', '', '', 'LM', 8, ' remixicon-profile-line', 2, 'Y', '2019-12-26 16:01:59', '2019-12-26 08:00:00'),
(29, 28, 'Manage', 'manageavailability', 'employee/manage-availability', 'manageavailability', 'Manage Availability', 'Manage Availability', 'Employee| Manage Availability', 'Candidate', 'LM', 0, '', 0, 'Y', '2020-01-05 05:16:17', '2019-12-12 08:00:00'),
(30, 28, 'Add', 'addavailability', 'employee/add-availability', 'addavailability', 'Add Availability', 'Add Availability', 'Employee| Add Availability', 'candidate', 'LM', 0, '', 0, 'Y', '2020-01-05 05:16:37', '2019-12-12 08:00:00'),
(31, 0, 'Tickets', 'employeetickets', '', '', '', '', '', '', 'LM', 11, 'remixicon-user-2-fill', 2, 'Y', '2020-01-05 13:45:53', '2019-12-12 08:00:00'),
(32, 31, 'Manage', 'managetickets', 'employee/manage-tickets', 'managetickets', 'Manage Tickets', 'Manage Tickets', 'Employee | Manage Tickets', 'users', 'LM', 0, '', 0, 'Y', '2019-12-15 05:28:11', '2019-12-12 08:00:00'),
(33, 31, 'Register', 'registertickets', 'employee/register-tickets', 'registertickets', 'Register Tickets', 'Register Tickets', 'Employee | Register Tickets', 'users', 'LM', 0, '', 0, 'Y', '2019-12-15 05:28:11', '2019-12-12 08:00:00'),
(34, 0, 'Payments', 'payments', 'employee/payments', 'payments', 'Payments', 'Payments', 'Employee | Payments', 'users', 'LM', 10, 'remixicon-money-dollar-box-line', 0, 'Y', '2020-01-05 13:56:16', '0000-00-00 00:00:00'),
(35, 0, 'Payments', 'payments', 'admin/payments', 'payments', 'Payments', 'Payments', 'Admin | Payments', 'admin', 'LM', 7, 'remixicon-money-dollar-box-line', 2, 'Y', '2020-01-05 15:56:52', '0000-00-00 00:00:00'),
(36, 35, 'Manage', 'managepayments', 'admin/manage-payments', 'managepayments', 'Manage Payments', 'Manage Payments', 'Admin| Manage Payments', 'Admin', 'LM', 0, '', 0, 'Y', '2020-01-05 05:16:17', '2019-12-12 08:00:00'),
(37, 35, 'Add', 'addpayments', 'admin/add-payments', 'addpayments', 'Add Payments', 'Add Payments', 'Admin| Add Payments', 'admin', 'LM', 0, '', 0, 'Y', '2020-01-05 05:16:37', '2019-12-12 08:00:00'),
(38, 23, 'Assign', 'assignvacancies', 'admin/assign-vacancies', 'assignvacancies', 'Assign Vacancies', 'Assign Vacancies', 'Admin| Assign Vacancies', 'admin', 'LM', 0, '', 0, 'Y', '2019-12-26 15:44:16', '2019-12-12 08:00:00'),
(39, 23, 'Add', 'addvacancies', 'admin/add-vacancies', 'addvacancies', 'AddVacancies', 'AddVacancies', 'Admin | Add Vacancies', 'admin', 'LM', 0, '', 0, 'Y', '2019-12-26 16:36:17', '2019-12-12 08:00:00'),
(40, 0, 'Uploads', 'uploads', 'admin/uploads', 'uploads', 'Uploads', 'Uploads', 'Admin | Uploads', 'admin', 'LM', 8, 'remixicon-file-upload-line ', 2, 'Y', '2020-01-12 06:36:33', '0000-00-00 00:00:00'),
(41, 40, 'Manage', 'manageuploads', 'admin/manage-uploads', 'manageuploads', 'Manage Uploads', 'Manage Uploads', 'Admin| Manage Uploads', 'Admin', 'LM', 0, '', 0, 'Y', '2020-01-05 05:16:17', '2019-12-12 08:00:00'),
(42, 40, 'Add', 'addfiles', 'admin/add-files', 'addfiles', 'Add Files', 'Add Files', 'Admin | Add Files', 'admin', 'LM', 0, '', 0, 'Y', '2020-01-12 06:42:15', '2019-12-12 08:00:00');

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
(16, 25, '96aa8740-2829-11ea-be6d-878a45509f0e', 'i am not able to create vacancies. Not able to manage the vacancies', '2019-12-25', 'In Progress', 'High', '2019-12-26 09:55:30', '2020-01-12 03:58:48'),
(17, 27, '9c1edb80-2f78-11ea-8ced-cdf5bc5e4022', 'just a complaint', '2020-01-07', 'In Progress', 'High', '2020-01-05 01:33:08', '2020-01-12 06:00:06');

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
(26, '0d2f6440-282b-11ea-857a-97ef75e56f94', 'sanusha', 'sanusha@gmail.com', NULL, '$2y$10$aO9Y6kjKsVTEN0pNsItEpeClLQRVbeeEFHpvblaIHdoMtuZld7qeO', NULL, 4, 'Active', '2019-12-27 05:59:55', '2019-12-27 05:59:55'),
(27, '9c1edb80-2f78-11ea-8ced-cdf5bc5e4022', 'peehu', 'peehu@gmail.com', NULL, '$2y$10$WSBMjd80Rs5BnzmRTiGHVer3pzRjTYQ86eiE2uhCwIrHvxciWimx2', NULL, 4, 'Active', '2020-01-05 13:02:45', '2020-01-05 13:02:45'),
(28, '9fbeb360-34f7-11ea-9e15-37b5925db6c3', 'Vyshakh', 'vyshakh@gmail.com', NULL, '$2y$10$J6CGLXDwd2PQtdLCb8Veh.vEymD8c3b.K3POmMwVOd4tjLSPYBS7m', NULL, 3, 'Active', '2020-01-12 12:54:33', '2020-01-12 14:01:30'),
(29, '1c08f5b0-34f8-11ea-8bc4-2d42180dba12', 'Shinoj', 'shinu@gmail.com', NULL, '$2y$10$k2bn.fmMdhPQ767iIN//7e9Skyz8ShUAkzcO3Bpr3edjpMxCfV0sa', NULL, 3, 'Inactive', '2020-01-12 12:58:01', '2020-01-12 13:54:11'),
(32, '7c14c570-34fa-11ea-a62e-db75084eb1a0', 'Athira', 'athi@gmail.com', NULL, '$2y$10$4MXGLBntRanfVwBeiTp.CenmWJfVksnbrOnffS406jDNwt/0LCrtm', NULL, 4, 'Active', '2020-01-12 13:15:01', '2020-01-12 13:53:34');

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
  `responsible_person` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `requirement_type` varchar(255) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `gender` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `account_status` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL DEFAULT 'Pending' COMMENT 'Pending, Accept, Reject, Delete',
  `notes` varchar(500) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users_details`
--

INSERT INTO `users_details` (`id`, `user_id`, `uuid`, `first_name`, `last_name`, `email`, `phone`, `house_name`, `country`, `state`, `city`, `pin`, `dob`, `blood_group`, `designation`, `company_name`, `company_address`, `responsible_person`, `requirement_type`, `gender`, `account_status`, `notes`, `created_at`, `updated_at`) VALUES
(1, 2, 'f7138870-184c-11ea-89d4-c39e3d56b013', 'Vyshakh', 'Ps', 'admin@gmail.com', '7907487010', '', 'India', 'Kerala', 'Vadakara', '673104', '1988-02-13', 'B+', '', '', '', NULL, NULL, '', '', '', '2019-12-03 18:30:00', '2019-12-03 18:30:00'),
(22, 25, '96aa8740-2829-11ea-be6d-878a45509f0e', 'Vivek', 'Ps', 'vivek@gmail.com', '7907487010', NULL, NULL, NULL, NULL, NULL, '1989-09-08', NULL, 'Engineer', 'Menaval', NULL, NULL, NULL, '', 'Accept', '', NULL, '2019-12-27 05:53:49'),
(23, NULL, '0d2f6440-282b-11ea-857a-97ef75e56f94', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'Pending', '', NULL, NULL),
(24, NULL, '9c1edb80-2f78-11ea-8ced-cdf5bc5e4022', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, '', 'Pending', '', NULL, NULL),
(25, 28, '9fbeb360-34f7-11ea-9e15-37b5925db6c3', 'Vyshakh', 'Ps', 'vyshakh@gmail.com', '7907487010', NULL, NULL, NULL, NULL, NULL, '1988-02-13', NULL, 'Ceo', 'Menaval', NULL, 'Vys', 'Computer Operator', '', 'Accept', '', '2020-01-12 12:54:33', '2020-01-12 14:01:30'),
(26, 29, '1c08f5b0-34f8-11ea-8bc4-2d42180dba12', 'Shinoj', 'Das', 'shinu@gmail.com', '7907487010', NULL, NULL, NULL, NULL, NULL, '1987-06-17', NULL, 'Ceo', 'Abodes', NULL, 'Vys', 'Cadd', '', 'Pending', '', '2020-01-12 12:58:01', '2020-01-12 13:54:11'),
(27, 32, '7c14c570-34fa-11ea-a62e-db75084eb1a0', 'Athira', 'Dhanesh', 'athi@gmail.com', '7907487010', NULL, NULL, NULL, NULL, NULL, '1993-04-20', NULL, 'Computer Operator', '', NULL, NULL, NULL, 'Female', 'Accept', '', '2020-01-12 13:15:01', '2020-01-12 13:53:34');

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
(1, 'Computer Operator', 0, 'BCA', 'Menaval', '', NULL, 'Kannur', 'Working hours will be from morning 5am to 5pm', '2020-01-10', '2019-12-13', NULL, NULL, NULL, 'info@menaval.com', '7907487010', 24, 'bb401250-27f8-11ea-8c32-ddc19776d07f', 'Published', '2019-12-26 06:23:33', '2020-01-12 06:08:19'),
(2, 'Nurse', 1, 'BSC NURSING', 'Koyili Hospital', '', NULL, 'Kannur', '', '2019-12-28', '2019-12-26', NULL, NULL, NULL, 'info@menaval.com', '7907487010', 24, 'bb401250-27f8-11ea-8c32-ddc19776d07f', 'Published', '2019-12-26 06:28:36', '2019-12-26 21:35:07'),
(3, 'Driver', 9, '10TH', 'Menaval Logistics', '', NULL, 'Kochi', '', '2020-01-20', '2020-01-12', 6000, 'Full Time', NULL, 'info@test.com', '7907487010', 2, 'f7138870-184c-11ea-89d4-c39e3d56b013', 'Published', '2020-01-12 06:19:41', '2020-01-12 06:31:17');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `assigned_vacancy`
--
ALTER TABLE `assigned_vacancy`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `availability`
--
ALTER TABLE `availability`
  ADD PRIMARY KEY (`id`);

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
-- Indexes for table `media_settings`
--
ALTER TABLE `media_settings`
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
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`);

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
-- AUTO_INCREMENT for table `assigned_vacancy`
--
ALTER TABLE `assigned_vacancy`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `availability`
--
ALTER TABLE `availability`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `business_key`
--
ALTER TABLE `business_key`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

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
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `media_settings`
--
ALTER TABLE `media_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `roles`
--
ALTER TABLE `roles`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `roles_screen`
--
ALTER TABLE `roles_screen`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=46;

--
-- AUTO_INCREMENT for table `screens`
--
ALTER TABLE `screens`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `tickets`
--
ALTER TABLE `tickets`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=18;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=33;

--
-- AUTO_INCREMENT for table `users_details`
--
ALTER TABLE `users_details`
  MODIFY `id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=28;

--
-- AUTO_INCREMENT for table `vacancies`
--
ALTER TABLE `vacancies`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
