-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 29, 2020 at 10:05 PM
-- Server version: 5.7.26
-- PHP Version: 7.4.2

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `thakshilawa_institute`
--

-- --------------------------------------------------------

--
-- Table structure for table `app_settings`
--

CREATE TABLE `app_settings` (
  `id` int(1) NOT NULL,
  `app_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `address` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `fax_number` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email_address` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `currency_symbol` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'Rs',
  `active_season_id` int(1) DEFAULT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `app_settings`
--

INSERT INTO `app_settings` (`id`, `app_name`, `address`, `phone_number`, `fax_number`, `email_address`, `currency_symbol`, `active_season_id`, `modified_at`, `modified_by`) VALUES
(1, 'Thakshilawa Institute', 'Colombo', '0123456789', '0123456789', 'info@thakshilawa.com', 'Rs', 1, '2020-08-16 03:28:52', 1);

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `type_id` int(1) NOT NULL DEFAULT '1',
  `student_id` int(11) DEFAULT NULL,
  `class_id` int(11) DEFAULT NULL,
  `user_id` int(11) DEFAULT NULL,
  `att_status` tinyint(1) NOT NULL DEFAULT '0',
  `att_date` date NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `type_id`, `student_id`, `class_id`, `user_id`, `att_status`, `att_date`, `created_by`, `created_at`, `modified_by`, `modified_at`, `status`) VALUES
(1, 1, 1, 2, 0, 1, '2020-01-08', 1, '2020-12-24 04:28:06', 1, '2020-12-26 21:11:35', 1),
(2, 1, 1, 2, 0, 1, '2020-01-10', 1, '2020-12-27 02:31:51', 1, '2020-12-27 21:59:14', 1),
(3, 1, 1, 2, 0, 0, '2020-01-01', 1, '2020-12-27 02:34:51', 1, '2020-12-26 21:08:47', 1),
(4, 1, 1, 2, 0, 0, '2020-01-07', 1, '2020-12-27 02:40:39', 1, '2020-12-26 21:10:41', 1),
(5, 1, 1, 2, 0, 0, '2020-01-04', 1, '2020-12-27 02:41:01', 1, '2020-12-27 21:59:01', 1),
(6, 1, 1, 2, 0, 0, '2020-01-06', 1, '2020-12-27 02:41:15', 1, '2020-12-27 21:59:03', 1),
(7, 1, 1, 2, 0, 1, '2020-01-11', 1, '2020-12-28 03:29:15', 1, '2020-12-28 09:59:15', 1),
(8, 1, 1, 2, 0, 1, '2020-01-12', 1, '2020-12-28 03:29:16', 1, '2020-12-28 09:59:16', 1),
(9, 1, 1, 2, 0, 1, '2020-01-13', 1, '2020-12-28 03:29:17', 1, '2020-12-28 09:59:17', 1),
(10, 1, 1, 2, 0, 1, '2020-01-14', 1, '2020-12-28 03:29:18', 1, '2020-12-28 09:59:18', 1),
(11, 1, 1, 2, 0, 1, '2020-01-28', 1, '2020-12-28 03:29:19', 1, '2020-12-28 09:59:19', 1),
(12, 1, 2, 2, 0, 1, '2020-01-12', 1, '2020-12-28 04:39:40', 1, '2020-12-28 11:09:40', 1),
(13, 1, 2, 2, 0, 1, '2020-01-11', 1, '2020-12-28 04:39:41', 1, '2020-12-28 11:09:41', 1),
(14, 1, 2, 2, 0, 1, '2020-01-15', 1, '2020-12-28 04:39:42', 1, '2020-12-28 11:09:42', 1),
(15, 1, 2, 2, 0, 1, '2020-01-28', 1, '2020-12-28 04:39:44', 1, '2020-12-28 11:09:44', 1),
(16, 1, 2, 2, 0, 1, '2020-12-29', 1, '2020-12-29 03:54:59', 1, '2020-12-29 10:24:59', 1),
(17, 1, 1, 2, 0, 1, '2020-12-29', 1, '2020-12-29 03:55:01', 1, '2020-12-29 10:25:01', 1),
(18, 1, 3, 5, 0, 1, '2020-12-29', 1, '2020-12-29 04:33:20', 1, '2020-12-29 11:03:20', 1),
(19, 1, 4, 3, 0, 1, '2020-12-29', 1, '2020-12-29 04:33:28', 1, '2020-12-29 11:03:28', 1),
(20, 1, 5, 1, 0, 1, '2020-12-29', 1, '2020-12-29 04:33:32', 1, '2020-12-29 11:03:32', 1),
(21, 1, 2, 1, 0, 1, '2020-12-29', 1, '2020-12-29 04:33:34', 1, '2020-12-29 11:03:34', 1),
(22, 1, 3, 5, NULL, 1, '2020-01-29', 1, '2020-12-29 04:48:24', 1, '2020-12-29 11:18:24', 1),
(23, 2, NULL, NULL, 2, 1, '2020-06-12', 1, '2020-12-29 05:18:47', 1, '2020-12-29 11:48:47', 1),
(24, 2, NULL, NULL, 2, 1, '2020-06-29', 1, '2020-12-29 05:20:54', 1, '2020-12-29 11:50:54', 1),
(25, 2, NULL, NULL, 2, 1, '2020-06-19', 1, '2020-12-29 05:30:17', 1, '2020-12-29 12:00:17', 1),
(26, 2, NULL, NULL, 2, 1, '2020-12-13', 1, '2020-12-29 05:30:23', 1, '2020-12-29 12:00:23', 1),
(27, 2, NULL, NULL, 2, 1, '2020-12-14', 1, '2020-12-29 05:30:24', 1, '2020-12-29 12:00:24', 1),
(28, 2, NULL, NULL, 2, 1, '2020-12-15', 1, '2020-12-29 05:30:25', 1, '2020-12-29 12:00:25', 1),
(29, 1, 3, 5, NULL, 1, '2020-01-22', 6, '2020-12-29 09:30:43', 6, '2020-12-29 16:00:43', 1);

-- --------------------------------------------------------

--
-- Table structure for table `cafeteria_transactions`
--

CREATE TABLE `cafeteria_transactions` (
  `id` int(11) NOT NULL,
  `transaction_type` int(1) NOT NULL,
  `title` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `amount` decimal(11,2) NOT NULL,
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `cafeteria_transactions`
--

INSERT INTO `cafeteria_transactions` (`id`, `transaction_type`, `title`, `amount`, `description`, `created_by`, `created_at`, `modified_by`, `modified_at`, `status`) VALUES
(1, 1, 'sfg', '100.00', 'sf', 1, '2020-12-15 10:13:05', 1, '2020-12-15 04:46:59', 1),
(2, 2, 'bdfhb', '800.00', 'gr', 1, '2020-12-15 10:13:23', 1, '2020-12-15 04:46:04', 1),
(3, 2, 'test ', '1000.00', 'hs', 1, '2020-12-29 03:48:37', 1, '2020-12-29 10:18:37', 1),
(4, 2, 'drinks', '160.00', 's', 1, '2020-12-29 03:48:55', 1, '2020-12-29 10:18:55', 1);

-- --------------------------------------------------------

--
-- Table structure for table `classess`
--

CREATE TABLE `classess` (
  `id` int(11) NOT NULL,
  `class_code` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `class_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `lecturer_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `monthly_fee` decimal(11,2) NOT NULL,
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `is_closed` int(1) DEFAULT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `classess`
--

INSERT INTO `classess` (`id`, `class_code`, `class_name`, `lecturer_id`, `subject_id`, `monthly_fee`, `start_time`, `end_time`, `notes`, `is_closed`, `created_by`, `created_at`, `modified_by`, `modified_at`, `status`) VALUES
(1, 'CLS2', 'Class 2', 2, 1, '1000.00', '10:00:00', '12:00:00', '-', NULL, 1, '2020-12-07 11:07:40', 1, '2020-12-28 22:52:20', 1),
(2, 'CLS1', 'Class 1', 2, 1, '1000.00', '12:00:00', '14:00:00', '-', NULL, 1, '2020-12-16 09:16:22', 1, '2020-12-28 22:43:25', 1),
(3, 'CLS3', 'Class 3', 2, 1, '1500.00', '08:30:00', '10:00:00', '-', 1, 1, '2020-12-29 04:29:45', 1, '2020-12-29 00:23:34', 1),
(4, 'CLS4', 'Class 4', 3, 1, '2000.00', '16:00:00', '18:00:00', '-', 1, 1, '2020-12-29 04:30:25', 1, '2020-12-29 00:23:13', 1),
(5, 'CLS5', 'Class 5', 4, 1, '1500.00', '09:00:00', '11:00:00', '-', 1, 1, '2020-12-29 04:30:53', 1, '2020-12-29 00:16:28', 1);

-- --------------------------------------------------------

--
-- Table structure for table `class_days`
--

CREATE TABLE `class_days` (
  `class_id` int(11) NOT NULL,
  `day_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `class_days`
--

INSERT INTO `class_days` (`class_id`, `day_id`) VALUES
(2, 6),
(2, 7),
(1, 2),
(1, 4),
(5, 7),
(4, 1),
(4, 3),
(4, 5),
(3, 1),
(3, 7);

-- --------------------------------------------------------

--
-- Table structure for table `class_payments`
--

CREATE TABLE `class_payments` (
  `id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `student_id` int(11) NOT NULL,
  `year_month_id` int(6) NOT NULL,
  `paid_amount` decimal(11,2) NOT NULL,
  `paid_method` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'cash',
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_at` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `class_payments`
--

INSERT INTO `class_payments` (`id`, `class_id`, `student_id`, `year_month_id`, `paid_amount`, `paid_method`, `notes`, `created_at`, `created_by`, `modified_at`, `modified_by`, `status`) VALUES
(1, 2, 1, 202012, '1000.00', 'cash', 's', '2020-12-16 11:05:02', 1, '2020-12-16 23:05:02', 1, 1),
(2, 2, 1, 202012, '1000.00', 'cash', 's', '2020-12-24 12:15:46', 1, '2020-12-24 12:15:46', 1, 1),
(3, 2, 1, 202012, '200.00', 'cash', 'jf', '2020-12-24 03:17:00', 1, '2020-12-24 15:17:00', 1, 1),
(4, 2, 1, 202012, '200.00', 'cash', 'jf', '2020-12-24 03:17:56', 1, '2020-12-24 15:17:56', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lecturers`
--

CREATE TABLE `lecturers` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `email_address` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `phone_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `nic_no` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lecturers`
--

INSERT INTO `lecturers` (`id`, `name`, `email_address`, `phone_number`, `address`, `nic_no`, `created_at`, `created_by`, `modified_at`, `modified_by`, `status`) VALUES
(1, 'Nuwan Perera', 'nuwan@gmail.com', '0713359819', 'Colombo', '7837459748', '2020-12-07 08:38:39', 1, '2020-12-28 22:54:09', 1, 1),
(2, 'Asela Mendis', 'asela@gmail.com', '0714356743', 'Colombo', '03643264324', '2020-12-07 08:41:22', 1, '2020-12-28 22:51:00', 1, 1),
(3, 'David Cruus', 'david@gmail.com', '0713794598', 'Colombo', '77213892N', '2020-12-29 04:23:39', 1, '2020-12-29 10:53:39', 1, 1),
(4, 'Keshara Wampalawa', 'keshara@gmail.com', '0771762768', 'Colombo', '92872347348v', '2020-12-29 04:24:40', 1, '2020-12-29 03:45:57', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_classes`
--

CREATE TABLE `lecturer_classes` (
  `lecturer_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `lecturer_classes`
--

INSERT INTO `lecturer_classes` (`lecturer_id`, `class_id`) VALUES
(2, 2),
(2, 1);

-- --------------------------------------------------------

--
-- Table structure for table `permissions`
--

CREATE TABLE `permissions` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `users-index` int(1) NOT NULL,
  `users-add` int(1) NOT NULL,
  `users-edit` int(1) NOT NULL,
  `users-delete` int(1) NOT NULL,
  `users-get_users` int(1) NOT NULL,
  `users-attendance` int(1) NOT NULL,
  `lecturers-index` int(1) NOT NULL,
  `lecturers-add` int(1) NOT NULL,
  `lecturers-edit` int(1) NOT NULL,
  `lecturers-delete` int(1) NOT NULL,
  `lecturers-get_lecturers` int(1) NOT NULL,
  `subjects-index` int(1) NOT NULL,
  `subjects-add` int(1) NOT NULL,
  `subjects-edit` int(1) NOT NULL,
  `subjects-delete` int(1) NOT NULL,
  `subjects-get_subjects` int(1) NOT NULL,
  `students-index` int(1) NOT NULL,
  `students-add` int(1) NOT NULL,
  `students-edit` int(1) NOT NULL,
  `students-delete` int(1) NOT NULL,
  `students-get_students` int(1) NOT NULL,
  `students-attendance` int(1) NOT NULL,
  `students-payment` int(1) NOT NULL,
  `classess-index` int(1) NOT NULL,
  `classess-add` int(1) NOT NULL,
  `classess-edit` int(1) NOT NULL,
  `classess-delete` int(1) NOT NULL,
  `classess-get_classess` int(1) NOT NULL,
  `settings-index` int(1) NOT NULL,
  `cafeteria-index` int(1) NOT NULL,
  `cafeteria-add` int(1) NOT NULL,
  `cafeteria-edit` int(1) NOT NULL,
  `cafeteria-delete` int(1) NOT NULL,
  `cafeteria-get_transactions` int(1) NOT NULL,
  `cafeteria-expense` int(1) NOT NULL,
  `cafeteria-income` int(1) NOT NULL,
  `reports-attendance` int(1) NOT NULL,
  `reports-class_schedule` int(1) NOT NULL,
  `reports-income` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `role_id`, `users-index`, `users-add`, `users-edit`, `users-delete`, `users-get_users`, `users-attendance`, `lecturers-index`, `lecturers-add`, `lecturers-edit`, `lecturers-delete`, `lecturers-get_lecturers`, `subjects-index`, `subjects-add`, `subjects-edit`, `subjects-delete`, `subjects-get_subjects`, `students-index`, `students-add`, `students-edit`, `students-delete`, `students-get_students`, `students-attendance`, `students-payment`, `classess-index`, `classess-add`, `classess-edit`, `classess-delete`, `classess-get_classess`, `settings-index`, `cafeteria-index`, `cafeteria-add`, `cafeteria-edit`, `cafeteria-delete`, `cafeteria-get_transactions`, `cafeteria-expense`, `cafeteria-income`, `reports-attendance`, `reports-class_schedule`, `reports-income`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 2, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 1, 0, 0, 1),
(3, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(4, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 5, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 1, 1),
(6, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 1, 1, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `nic_no` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `address` text COLLATE utf8_unicode_ci NOT NULL,
  `gurdian_name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
  `gurdian_contact_number` varchar(20) COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `students`
--

INSERT INTO `students` (`id`, `name`, `nic_no`, `address`, `gurdian_name`, `gurdian_contact_number`, `created_at`, `created_by`, `modified_at`, `modified_by`, `status`) VALUES
(1, 'Student 1', '884358458v', 'Colombo', 'rew', '0717643884', '2020-12-07 09:55:03', 1, '2020-12-28 23:01:40', 1, 1),
(2, 'Student 2', '7983498V', 'Colombo', 'jsd,f', '0713723948', '2020-12-28 04:38:53', 1, '2020-12-28 23:01:58', 1, 1),
(3, 'Student 3', '893489489', 'Colombo', 'Amal Perera', '0773483787', '2020-12-29 04:32:21', 1, '2020-12-29 11:02:21', 1, 1),
(4, 'Student 4', '98237438748', 'Colombo', 'Jeevan Perera', '0781273487', '2020-12-29 04:32:42', 1, '2020-12-29 00:33:16', 1, 1),
(5, 'Student 5', '92832389498', 'Colombo', 'Janaka Perera', '0723748378', '2020-12-29 04:33:03', 1, '2020-12-29 00:31:42', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `student_classes`
--

CREATE TABLE `student_classes` (
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `student_classes`
--

INSERT INTO `student_classes` (`student_id`, `class_id`) VALUES
(1, 2),
(2, 1),
(2, 2),
(3, 5),
(5, 1),
(4, 2);

-- --------------------------------------------------------

--
-- Table structure for table `subjects`
--

CREATE TABLE `subjects` (
  `id` int(11) NOT NULL,
  `subject_name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `subject_code` varchar(10) COLLATE utf8_unicode_ci NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `subjects`
--

INSERT INTO `subjects` (`id`, `subject_name`, `subject_code`, `notes`, `created_at`, `created_by`, `modified_at`, `modified_by`, `status`) VALUES
(1, 'History', 'HISTORY', '-', '2020-12-07 08:58:04', 1, '2020-12-28 22:39:57', 1, 1),
(2, 'English', 'ENG', '-', '2020-12-29 04:10:05', 1, '2020-12-29 10:40:05', 1, 1),
(3, 'Mathematics', 'MATHS', '-', '2020-12-29 04:10:15', 1, '2020-12-29 10:40:15', 1, 1),
(4, 'Science', 'SCIENCE', '-', '2020-12-29 04:10:37', 1, '2020-12-29 10:40:37', 1, 1),
(5, 'Tamil', 'TAMIL', '-', '2020-12-29 04:10:52', 1, '2020-12-29 10:40:52', 1, 1),
(6, 'Information Technology', 'IT', '-', '2020-12-29 04:11:06', 1, '2020-12-29 10:41:06', 1, 1),
(7, 'Web Design', 'WEBD', '-', '2020-12-29 04:11:28', 1, '2020-12-29 10:41:28', 1, 1),
(8, 'Painting', 'PAINT', '-', '2020-12-29 04:11:43', 1, '2020-12-29 10:41:43', 1, 1),
(9, 'Accounting', 'ACC', '-', '2020-12-29 04:12:20', 1, '2020-12-29 10:42:20', 1, 1),
(10, 'Economics', 'ECON', '-', '2020-12-29 04:12:29', 1, '2020-12-29 10:42:29', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `reference_id` int(11) DEFAULT NULL,
  `name` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `password` text COLLATE utf8_unicode_ci NOT NULL,
  `reset_pin` int(4) NOT NULL,
  `created_at` datetime NOT NULL,
  `created_by` int(11) NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `modified_by` int(11) NOT NULL,
  `status` int(1) NOT NULL DEFAULT '1'
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `role_id`, `reference_id`, `name`, `email`, `password`, `reset_pin`, `created_at`, `created_by`, `modified_at`, `modified_by`, `status`) VALUES
(1, 1, 0, 'Thakshilawa Owner', 'admin@thakshilawa.com', '5aadb45520dcd8726b2822a7a78bb53d794f557199d5d4abdedd2c55a4bd6ca73607605c558de3db80c8e86c3196484566163ed1327e82e8b6757d1932113cb8', 6747, '2020-08-02 15:10:38', 1, '2020-12-29 04:34:31', -1, 1),
(2, 4, 0, 'Admin Staff 2', 'adminstaff2@gmail.com', '5aadb45520dcd8726b2822a7a78bb53d794f557199d5d4abdedd2c55a4bd6ca73607605c558de3db80c8e86c3196484566163ed1327e82e8b6757d1932113cb8', 4007, '2020-11-08 11:16:46', 1, '2020-12-29 04:03:59', 1, 1),
(3, 4, NULL, 'Admin Staff 01', 'adminstaff@gmail.com', '5aadb45520dcd8726b2822a7a78bb53d794f557199d5d4abdedd2c55a4bd6ca73607605c558de3db80c8e86c3196484566163ed1327e82e8b6757d1932113cb8', 2721, '2020-12-29 05:38:29', 1, '2020-12-29 04:04:04', 1, 1),
(4, 5, NULL, 'HR Staff', 'hrstaff@gmail.com', '5aadb45520dcd8726b2822a7a78bb53d794f557199d5d4abdedd2c55a4bd6ca73607605c558de3db80c8e86c3196484566163ed1327e82e8b6757d1932113cb8', 7315, '2020-12-29 05:39:45', 1, '2020-12-29 12:09:45', 1, 1),
(5, 2, NULL, 'Manager', 'manager@gmail.com', '5aadb45520dcd8726b2822a7a78bb53d794f557199d5d4abdedd2c55a4bd6ca73607605c558de3db80c8e86c3196484566163ed1327e82e8b6757d1932113cb8', 9118, '2020-12-29 05:40:02', 1, '2020-12-29 12:10:02', 1, 1),
(6, 6, 4, 'Keshara Wampalawa', 'keshara@gmail.com', '5aadb45520dcd8726b2822a7a78bb53d794f557199d5d4abdedd2c55a4bd6ca73607605c558de3db80c8e86c3196484566163ed1327e82e8b6757d1932113cb8', 3506, '2020-12-29 09:15:57', 1, '2020-12-29 04:17:50', 4, 1);

-- --------------------------------------------------------

--
-- Table structure for table `user_roles`
--

CREATE TABLE `user_roles` (
  `id` int(11) NOT NULL,
  `name` varchar(30) COLLATE utf8_unicode_ci NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `user_roles`
--

INSERT INTO `user_roles` (`id`, `name`) VALUES
(4, 'Admin Staff'),
(5, 'HR Staff'),
(6, 'Lecturer'),
(2, 'Manager'),
(1, 'Owner'),
(7, 'Student'),
(3, 'System Admin');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `app_settings`
--
ALTER TABLE `app_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `student_id` (`student_id`,`class_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `cafeteria_transactions`
--
ALTER TABLE `cafeteria_transactions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `classess`
--
ALTER TABLE `classess`
  ADD PRIMARY KEY (`id`),
  ADD KEY `lecturer_id` (`lecturer_id`,`subject_id`);

--
-- Indexes for table `class_payments`
--
ALTER TABLE `class_payments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecturers`
--
ALTER TABLE `lecturers`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `lecturer_classes`
--
ALTER TABLE `lecturer_classes`
  ADD KEY `lecturer_id` (`lecturer_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `permissions`
--
ALTER TABLE `permissions`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `students`
--
ALTER TABLE `students`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `student_classes`
--
ALTER TABLE `student_classes`
  ADD KEY `student_id` (`student_id`),
  ADD KEY `class_id` (`class_id`);

--
-- Indexes for table `subjects`
--
ALTER TABLE `subjects`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`),
  ADD KEY `role_id` (`role_id`),
  ADD KEY `reference_id` (`reference_id`);

--
-- Indexes for table `user_roles`
--
ALTER TABLE `user_roles`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `name` (`name`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `cafeteria_transactions`
--
ALTER TABLE `cafeteria_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `classess`
--
ALTER TABLE `classess`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `class_payments`
--
ALTER TABLE `class_payments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `user_roles`
--
ALTER TABLE `user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `attendance`
--
ALTER TABLE `attendance`
  ADD CONSTRAINT `attendance_ibfk_4` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `attendance_ibfk_5` FOREIGN KEY (`class_id`) REFERENCES `classess` (`id`);

--
-- Constraints for table `lecturer_classes`
--
ALTER TABLE `lecturer_classes`
  ADD CONSTRAINT `lecturer_classes_ibfk_3` FOREIGN KEY (`lecturer_id`) REFERENCES `lecturers` (`id`),
  ADD CONSTRAINT `lecturer_classes_ibfk_4` FOREIGN KEY (`class_id`) REFERENCES `classess` (`id`);

--
-- Constraints for table `student_classes`
--
ALTER TABLE `student_classes`
  ADD CONSTRAINT `student_classes_ibfk_2` FOREIGN KEY (`student_id`) REFERENCES `students` (`id`),
  ADD CONSTRAINT `student_classes_ibfk_3` FOREIGN KEY (`class_id`) REFERENCES `classess` (`id`);

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`role_id`) REFERENCES `user_roles` (`id`);

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
