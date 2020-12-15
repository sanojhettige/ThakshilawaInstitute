-- phpMyAdmin SQL Dump
-- version 4.9.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:8889
-- Generation Time: Dec 15, 2020 at 10:17 PM
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
  `student_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL,
  `subject_id` int(11) NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(1, 1, 'sfg', '100.00', 'sf', 1, '2020-12-15 10:13:05', 1, '2020-12-15 04:46:59', 4),
(2, 2, 'bdfhb', '800.00', 'gr', 1, '2020-12-15 10:13:23', 1, '2020-12-15 04:46:04', 1);

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
  `start_time` time NOT NULL,
  `end_time` time NOT NULL,
  `notes` text COLLATE utf8_unicode_ci NOT NULL,
  `created_by` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `modified_by` int(11) NOT NULL,
  `modified_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `status` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `classess`
--

INSERT INTO `classess` (`id`, `class_code`, `class_name`, `lecturer_id`, `subject_id`, `start_time`, `end_time`, `notes`, `created_by`, `created_at`, `modified_by`, `modified_at`, `status`) VALUES
(1, 'yhh', 'jhjh', 1, 1, '10:00:00', '12:00:00', 'dg', 1, '2020-12-07 11:07:40', 1, '2020-12-07 05:40:24', 1);

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
(1, 'Lec 1', 'hs@df.sdf', '0713359819', 'hs', '7837459748', '2020-12-07 08:38:39', 1, '2020-12-07 03:10:55', 1, 1),
(2, 'Lec 2', 's@fsdf.co', '0714356743', 'sdkh', '03643264324', '2020-12-07 08:41:22', 1, '2020-12-15 02:33:49', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `lecturer_classes`
--

CREATE TABLE `lecturer_classes` (
  `lecturer_id` int(11) NOT NULL,
  `class_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `cafeteria-income` int(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `permissions`
--

INSERT INTO `permissions` (`id`, `role_id`, `users-index`, `users-add`, `users-edit`, `users-delete`, `users-get_users`, `lecturers-index`, `lecturers-add`, `lecturers-edit`, `lecturers-delete`, `lecturers-get_lecturers`, `subjects-index`, `subjects-add`, `subjects-edit`, `subjects-delete`, `subjects-get_subjects`, `students-index`, `students-add`, `students-edit`, `students-delete`, `students-get_students`, `students-attendance`, `classess-index`, `classess-add`, `classess-edit`, `classess-delete`, `classess-get_classess`, `settings-index`, `cafeteria-index`, `cafeteria-add`, `cafeteria-edit`, `cafeteria-delete`, `cafeteria-get_transactions`, `cafeteria-expense`, `cafeteria-income`) VALUES
(1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1),
(2, 2, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 1, 0, 0, 0, 0, 0, 0),
(3, 3, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 1, 0, 0, 0, 0, 0, 0),
(4, 4, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(5, 5, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0),
(6, 6, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- Table structure for table `students`
--

CREATE TABLE `students` (
  `id` int(11) NOT NULL,
  `name` varchar(150) COLLATE utf8_unicode_ci NOT NULL,
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

INSERT INTO `students` (`id`, `name`, `address`, `gurdian_name`, `gurdian_contact_number`, `created_at`, `created_by`, `modified_at`, `modified_by`, `status`) VALUES
(1, 'Student 1', 'jhsdfs d', 'rew', '0717643884', '2020-12-07 09:55:03', 1, '2020-12-07 16:25:03', 1, 1);

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
(1, 1);

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
(1, 'Subject 1', 'S1', 'sd', '2020-12-07 08:58:04', 1, '2020-12-07 03:29:31', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `role_id` int(11) NOT NULL,
  `reference_id` int(11) NOT NULL,
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
(1, 1, 0, 'Thakshilawa Owner', 'admin@thakshilawa.com', '5aadb45520dcd8726b2822a7a78bb53d794f557199d5d4abdedd2c55a4bd6ca73607605c558de3db80c8e86c3196484566163ed1327e82e8b6757d1932113cb8', 6747, '2020-08-02 15:10:38', 1, '2020-11-04 06:02:52', 1, 1),
(2, 4, 0, 'Admin 2', 'admin2@thakshilawa.com', '3c9909afec25354d551dae21590bb26e38d53f2173b8d3dc3eee4c047e7ab1c1eb8b85103e3be7ba613b31bb5c9c36214dc9f14a42fd7a2fdb84856bca5c44c2', 4007, '2020-11-08 11:16:46', 1, '2020-11-08 05:46:46', 1, 1);

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
  ADD KEY `student_id` (`student_id`,`class_id`,`subject_id`),
  ADD KEY `subject_id` (`subject_id`),
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
-- AUTO_INCREMENT for table `cafeteria_transactions`
--
ALTER TABLE `cafeteria_transactions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `classess`
--
ALTER TABLE `classess`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `lecturers`
--
ALTER TABLE `lecturers`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `permissions`
--
ALTER TABLE `permissions`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `students`
--
ALTER TABLE `students`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `subjects`
--
ALTER TABLE `subjects`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

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
  ADD CONSTRAINT `attendance_ibfk_3` FOREIGN KEY (`subject_id`) REFERENCES `subjects` (`id`),
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
