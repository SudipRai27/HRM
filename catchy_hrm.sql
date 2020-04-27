-- phpMyAdmin SQL Dump
-- version 4.6.5.2
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Feb 25, 2019 at 04:13 PM
-- Server version: 10.1.21-MariaDB
-- PHP Version: 7.1.1

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `catchy_hrm`
--

-- --------------------------------------------------------

--
-- Table structure for table `per_attendance`
--

CREATE TABLE `per_attendance` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `attendance_date` varchar(50) NOT NULL,
  `attendance_time` varchar(50) NOT NULL,
  `attendance_check_out_time` varchar(50) DEFAULT NULL,
  `attendance` enum('absent','present') NOT NULL DEFAULT 'absent',
  `rfid` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `per_attendance`
--

INSERT INTO `per_attendance` (`id`, `user_id`, `attendance_date`, `attendance_time`, `attendance_check_out_time`, `attendance`, `rfid`, `created_at`, `updated_at`) VALUES
(15, 20, '2018-08-20', '01:14 PM', '09:33 PM', 'present', NULL, '2018-08-20 13:14:07', '2018-08-20 21:33:01'),
(18, 22, '2018-08-20', '1:45 PM', '09:36 PM', 'present', NULL, '0000-00-00 00:00:00', '2018-08-20 21:36:51'),
(19, 22, '2018-08-21', '10:59 AM', '05:08 PM', 'present', NULL, '2018-08-21 10:59:06', '2018-08-21 17:08:04'),
(20, 21, '2018-08-21', '11:12 AM', '05:08 PM', 'present', NULL, '2018-08-21 11:12:29', '2018-08-21 17:08:16'),
(21, 20, '2018-08-21', '11:12 AM', '05:07 PM', 'present', NULL, '2018-08-21 11:12:43', '2018-08-21 17:07:30'),
(22, 22, '2018-08-22', '11:02 AM', '05:12 PM', 'present', NULL, '2018-08-22 11:02:28', '2018-08-22 17:12:13'),
(23, 25, '2018-08-22', '12:15 PM', '05:13 PM', 'present', NULL, '2018-08-22 12:15:33', '2018-08-22 17:13:14'),
(24, 24, '2018-08-22', '12:16 PM', '05:12 PM', 'present', NULL, '2018-08-22 12:16:51', '2018-08-22 17:12:42'),
(25, 22, '2018-08-23', '09:49 AM', NULL, 'present', NULL, '2018-08-23 09:49:48', '2018-08-23 09:49:48'),
(26, 25, '2018-08-23', '10:16 AM', '04:58 PM', 'present', NULL, '2018-08-23 10:16:53', '2018-08-23 16:58:05'),
(27, 24, '2018-08-23', '11:06 AM', NULL, 'present', NULL, '2018-08-23 11:06:11', '2018-08-23 11:06:11'),
(28, 22, '2018-08-24', '09:56 AM', '02:15 PM', 'present', NULL, '2018-08-24 09:56:31', '2018-08-24 14:15:47'),
(29, 25, '2018-08-24', '10:22 AM', '11:36 AM', 'present', NULL, '2018-08-24 10:22:49', '2018-08-24 11:36:48'),
(30, 24, '2018-08-24', '10:51 AM', '02:16 PM', 'present', NULL, '2018-08-24 10:51:25', '2018-08-24 14:16:03'),
(31, 24, '2018-08-27', '10:41 AM', '06:03 PM', 'present', NULL, '2018-08-27 10:41:58', '2018-08-27 18:03:30'),
(32, 25, '2018-08-27', '10:44 AM', NULL, 'present', NULL, '2018-08-27 10:44:39', '2018-08-27 10:44:39'),
(33, 22, '2018-08-27', '10:45 AM', '02:16 PM', 'present', NULL, '2018-08-27 10:45:01', '2018-08-27 14:16:39'),
(34, 22, '2018-08-28', '11:46 AM', NULL, 'present', NULL, '2018-08-28 11:46:14', '2018-08-28 11:46:14'),
(35, 22, '2018-08-29', '10:04 AM', '5:00 PM', 'present', NULL, '2018-08-29 10:04:56', '2018-08-29 18:29:07'),
(36, 25, '2018-08-29', '10:05 AM', '5:00 PM', 'present', NULL, '2018-08-29 10:05:56', '2018-08-29 18:18:46'),
(37, 24, '2018-08-29', '10:56 AM', '5:00 PM', 'present', NULL, '2018-08-29 10:56:02', '2018-08-29 18:19:32'),
(38, 24, '2018-08-31', '10:54 AM', '04:05 PM', 'present', NULL, '2018-08-31 10:54:24', '2018-08-31 16:05:38'),
(39, 25, '2018-08-31', '11:46 AM', '04:05 PM', 'present', NULL, '2018-08-31 11:46:17', '2018-08-31 16:05:52'),
(40, 22, '2018-08-31', '11:46 AM', '04:09 PM', 'present', NULL, '2018-08-31 11:46:21', '2018-08-31 16:09:57'),
(41, 22, '2018-09-02', '09:50 AM', NULL, 'present', NULL, '2018-09-02 09:50:18', '2018-09-02 09:50:18'),
(42, 25, '2018-09-02', '10:26 AM', NULL, 'present', NULL, '2018-09-02 10:26:12', '2018-09-02 10:26:12'),
(43, 25, '2018-09-03', '10:02 AM', '04:54 PM', 'present', NULL, '2018-09-03 10:02:50', '2018-09-03 16:54:14'),
(44, 22, '2018-09-03', '10:19 AM', '04:54 PM', 'present', NULL, '2018-09-03 10:19:32', '2018-09-03 16:54:18'),
(45, 24, '2018-09-03', '11:00 AM', NULL, 'present', NULL, '2018-09-03 11:00:56', '2018-09-03 11:00:56'),
(46, 25, '2018-09-04', '09:57 AM', '05:05 PM', 'present', NULL, '2018-09-04 09:57:02', '2018-09-04 17:05:59'),
(47, 22, '2018-09-04', '10:09 AM', NULL, 'present', NULL, '2018-09-04 10:09:05', '2018-09-04 10:09:05'),
(48, 25, '2018-09-05', '10:02 AM', '04:58 PM', 'present', NULL, '2018-09-05 10:02:53', '2018-09-05 16:58:24'),
(49, 22, '2018-09-05', '10:03 AM', '04:57 PM', 'present', NULL, '2018-09-05 10:03:59', '2018-09-05 16:57:50'),
(50, 24, '2018-09-05', '11:01 AM', NULL, 'present', NULL, '2018-09-05 11:01:30', '2018-09-05 11:01:30'),
(51, 22, '2018-09-06', '08:25 AM', NULL, 'present', NULL, '2018-09-06 08:25:47', '2018-09-06 08:25:47'),
(52, 25, '2018-09-06', '09:51 AM', '04:58 PM', 'present', NULL, '2018-09-06 09:51:47', '2018-09-06 16:58:59'),
(53, 25, '2018-09-07', '09:43 AM', '02:35 PM', 'present', NULL, '2018-09-07 09:43:09', '2018-09-07 14:35:33');

-- --------------------------------------------------------

--
-- Table structure for table `per_chat`
--

CREATE TABLE `per_chat` (
  `id` int(11) NOT NULL,
  `from` int(11) NOT NULL,
  `to` int(11) NOT NULL,
  `read` tinyint(1) NOT NULL DEFAULT '0',
  `text` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `per_chat`
--

INSERT INTO `per_chat` (`id`, `from`, `to`, `read`, `text`, `created_at`, `updated_at`) VALUES
(95, 22, 24, 1, 'hello sudip', '2018-09-12 16:56:35', '2018-09-14 14:38:21'),
(96, 24, 22, 1, 'hello rohit', '2018-09-12 17:01:00', '2018-09-14 14:37:50'),
(97, 24, 22, 1, 'hello', '2018-09-12 17:01:08', '2018-09-14 14:37:50'),
(98, 22, 24, 1, 'what re you doing ?', '2018-09-12 17:01:23', '2018-09-14 14:38:21'),
(99, 24, 22, 1, 'I am fine !!!', '2018-09-12 17:01:32', '2018-09-14 14:37:50'),
(100, 22, 24, 1, 'hello sudip', '2018-09-13 12:39:55', '2018-09-14 14:38:21'),
(101, 24, 22, 1, 'k cha haw', '2018-09-14 11:02:18', '2018-09-14 14:37:50'),
(102, 22, 24, 1, 'thik cha sudip timi ni ?', '2018-09-14 11:02:36', '2018-09-14 14:38:21'),
(103, 24, 22, 1, 'yj', '2018-09-14 11:02:44', '2018-09-14 14:37:50'),
(104, 22, 24, 1, 'hello', '2018-09-14 12:36:17', '2018-09-14 14:38:21'),
(105, 24, 22, 1, 'hy', '2018-09-14 12:36:47', '2018-09-14 14:37:50'),
(106, 24, 22, 1, 'ok\\', '2018-09-14 12:36:51', '2018-09-14 14:37:50'),
(107, 24, 22, 1, 'bie', '2018-09-14 12:46:34', '2018-09-14 14:37:50'),
(108, 24, 23, 1, 'hello', '2018-09-14 13:58:46', '2018-09-14 14:26:22'),
(109, 24, 25, 0, 'ok sajan', '2018-09-14 13:58:54', '2018-09-14 13:58:54'),
(110, 22, 23, 1, 'Ok', '2018-09-14 14:14:38', '2018-09-14 14:21:13'),
(111, 24, 22, 1, 'Hello', '2018-09-14 14:14:50', '2018-09-14 14:37:50'),
(112, 24, 22, 1, 'How are you ?', '2018-09-14 14:15:00', '2018-09-14 14:37:50'),
(113, 22, 24, 1, 'I am fine', '2018-09-14 14:15:03', '2018-09-14 14:38:21'),
(114, 22, 24, 1, 'Wbu >', '2018-09-14 14:15:06', '2018-09-14 14:38:21'),
(115, 24, 22, 1, 'fine k gardai ?', '2018-09-14 14:15:14', '2018-09-14 14:37:50'),
(116, 24, 22, 1, 'lunch garyo ?', '2018-09-14 14:15:21', '2018-09-14 14:37:50'),
(117, 22, 24, 1, 'ah yar just now ?', '2018-09-14 14:15:28', '2018-09-14 14:38:21'),
(118, 22, 24, 1, 'i have sth for u ?', '2018-09-14 14:15:33', '2018-09-14 14:38:21'),
(119, 24, 22, 1, 'what bro ?', '2018-09-14 14:15:37', '2018-09-14 14:37:50'),
(120, 22, 24, 1, 'Sth', '2018-09-14 14:18:14', '2018-09-14 14:38:21'),
(121, 20, 22, 0, 'Hello', '2018-09-14 14:20:28', '2018-09-14 14:20:28'),
(122, 20, 22, 0, 'How are you ?', '2018-09-14 14:20:31', '2018-09-14 14:20:31'),
(123, 23, 22, 1, 'Hello', '2018-09-14 14:21:17', '2018-09-14 14:24:24');

-- --------------------------------------------------------

--
-- Table structure for table `per_daily_report`
--

CREATE TABLE `per_daily_report` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date` varchar(10) NOT NULL,
  `time` varchar(10) NOT NULL,
  `work_done` text NOT NULL,
  `remaining_work` text NOT NULL,
  `todays_learning` text,
  `suggestions` text,
  `problems` text,
  `file` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

--
-- Dumping data for table `per_daily_report`
--

INSERT INTO `per_daily_report` (`id`, `user_id`, `date`, `time`, `work_done`, `remaining_work`, `todays_learning`, `suggestions`, `problems`, `file`, `created_at`, `updated_at`) VALUES
(4, 20, '2018-08-27', '03:28 PM', 'Royal Ko Designs Haru', 'Final Blueprint of Design', 'Photoshop', 'Design concept needs to be clear', 'Some design issues only....', '5b83ba9d05c1cambika.jpg', '2018-08-27 13:54:28', '2018-08-27 15:28:18'),
(6, 22, '2018-08-27', '02:33 PM', 'Marketing. Research and Calls', 'Follow up and leads to call', 'Communication Skills', 'Nope', 'Nope', NULL, '2018-08-27 14:33:54', '2018-08-27 14:33:54'),
(7, 23, '2018-08-27', '03:12 PM', 'Backend Learning', 'Posting Data in Two tables', 'Basic Queries', 'Need more of the tutorial videos', 'Problem while joining 2 tables', NULL, '2018-08-27 15:12:25', '2018-08-27 15:12:25'),
(8, 20, '2018-09-03', '01:22 PM', 'Text', 'Text', 'Text', 'Text', 'Text', NULL, '2018-09-03 13:22:13', '2018-09-03 13:22:13'),
(9, 21, '2018-09-03', '01:22 PM', 'Text', 'Text', 'Text', 'Text', 'Text', NULL, '2018-09-03 13:22:26', '2018-09-03 13:22:26'),
(10, 20, '2018-09-02', '01:23 PM', 'Text', 'Text', 'Text', 'Text', 'Text', NULL, '2018-09-03 13:23:39', '2018-09-03 13:23:39'),
(11, 20, '2018-09-01', '01:24 PM', 'Text', 'Text', 'Text', 'Text', NULL, NULL, '2018-09-03 13:24:23', '2018-09-03 13:24:23'),
(12, 21, '2018-09-01', '01:27 PM', 'Test', 'Test', 'Test', 'Test', NULL, '5b8ce5dcdebfbCRIT LOgo.JPG', '2018-09-03 13:27:20', '2018-09-03 13:27:20');

-- --------------------------------------------------------

--
-- Table structure for table `per_department`
--

CREATE TABLE `per_department` (
  `id` int(11) NOT NULL,
  `department_name` varchar(100) NOT NULL,
  `description` text,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `per_department`
--

INSERT INTO `per_department` (`id`, `department_name`, `description`, `created_at`, `updated_at`) VALUES
(2, 'Marketing', 'Marketing Department', '2018-08-13 06:18:56', '2018-08-13 06:18:56'),
(3, 'Information Technology', 'Information Technology Department', '2018-08-13 06:19:17', '2018-08-13 06:19:17');

-- --------------------------------------------------------

--
-- Table structure for table `per_facebook_image_post`
--

CREATE TABLE `per_facebook_image_post` (
  `id` int(11) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `message` text NOT NULL,
  `created_by` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `per_facebook_image_post`
--

INSERT INTO `per_facebook_image_post` (`id`, `image`, `message`, `created_by`, `created_at`, `updated_at`) VALUES
(1, '5b88e4a3edf82CRIT LOgo.JPG', 'test', 'Superadmin', '2018-08-31 12:33:04', '2018-08-31 12:33:04');

-- --------------------------------------------------------

--
-- Table structure for table `per_facebook_link_post`
--

CREATE TABLE `per_facebook_link_post` (
  `id` int(11) NOT NULL,
  `message` text NOT NULL,
  `link` text,
  `created_by` varchar(255) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `per_facebook_link_post`
--

INSERT INTO `per_facebook_link_post` (`id`, `message`, `link`, `created_by`, `created_at`, `updated_at`) VALUES
(1, 'test', 'https://www.youtube.com/watch?v=Lpjcm1F8tY8', 'Superadmin', '2018-08-31 12:32:16', '2018-08-31 12:32:16');

-- --------------------------------------------------------

--
-- Table structure for table `per_job`
--

CREATE TABLE `per_job` (
  `id` int(11) NOT NULL,
  `job_title` varchar(100) NOT NULL,
  `job_description` text,
  `department_id` int(11) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `per_job`
--

INSERT INTO `per_job` (`id`, `job_title`, `job_description`, `department_id`, `created_at`, `updated_at`) VALUES
(2, 'Marketing Manager', 'Work as a marketing manager', 2, '2018-08-13 07:12:09', '2018-08-13 07:26:57'),
(3, 'Backend Web Developer', 'Work as a web developer', 3, '2018-08-13 07:27:18', '2018-08-16 06:21:01'),
(4, 'Web Designer', 'Web Designer', 3, '2018-08-16 06:21:21', '2018-08-16 06:21:21');

-- --------------------------------------------------------

--
-- Table structure for table `per_leave`
--

CREATE TABLE `per_leave` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `start_date` varchar(50) NOT NULL,
  `end_date` varchar(50) NOT NULL,
  `description` text NOT NULL,
  `status` enum('ongoing','approved','rejected') NOT NULL DEFAULT 'ongoing',
  `status_updated_date_time` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `per_leave_logs`
--

CREATE TABLE `per_leave_logs` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `date_range` varchar(30) NOT NULL,
  `status` varchar(10) NOT NULL,
  `description` text NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 ROW_FORMAT=COMPACT;

-- --------------------------------------------------------

--
-- Table structure for table `per_roles`
--

CREATE TABLE `per_roles` (
  `id` int(11) NOT NULL,
  `role_name` varchar(50) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `per_roles`
--

INSERT INTO `per_roles` (`id`, `role_name`, `created_at`, `updated_at`) VALUES
(1, 'employee', '2018-06-11 00:00:00', '2018-06-11 00:00:00'),
(2, 'intern', '0000-00-00 00:00:00', '0000-00-00 00:00:00');

-- --------------------------------------------------------

--
-- Table structure for table `per_settings`
--

CREATE TABLE `per_settings` (
  `id` int(11) NOT NULL,
  `company_name` varchar(100) NOT NULL,
  `address` varchar(100) NOT NULL,
  `telephone` varchar(50) NOT NULL,
  `logo` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `per_settings`
--

INSERT INTO `per_settings` (`id`, `company_name`, `address`, `telephone`, `logo`, `created_at`, `updated_at`) VALUES
(1, 'CRIT HRM', 'Balkhu', '9813426920', '5b1512561a24blogo.jpg', '2018-06-04 10:08:31', '2018-08-12 14:31:49');

-- --------------------------------------------------------

--
-- Table structure for table `per_superadmin`
--

CREATE TABLE `per_superadmin` (
  `id` int(50) NOT NULL,
  `name` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `password` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `temporary_address` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `permanent_address` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `contact` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `photo` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `remember_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `api_token` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `per_superadmin`
--

INSERT INTO `per_superadmin` (`id`, `name`, `email`, `password`, `temporary_address`, `permanent_address`, `contact`, `photo`, `remember_token`, `api_token`, `created_at`, `updated_at`) VALUES
(1, 'Superadmin', 'admin@admin.com', '$2y$10$ts2AA2nJGZI4XfvTgsNLzOlNIWQpuPX3W8LNC7tXHUoE6WxzRX6Za', 'Kalimati', 'kalimati', '4488542', 'images.png', 'PTT5WmbO5p1DYXKRgOICk59G5u8NwINHSXFtfqJ9k5amymXue2vupOccll0L', 'mJUhf2YAVekfhZrbweQJXv4WKfpDR5VwPZwE4AyJ6l3NjKVH2NWZgCT7ulsp', '2018-05-06 09:35:36', '2018-06-13 10:46:49');

-- --------------------------------------------------------

--
-- Table structure for table `per_users`
--

CREATE TABLE `per_users` (
  `id` int(10) NOT NULL,
  `name` varchar(255) NOT NULL,
  `email` varchar(255) NOT NULL,
  `password` varchar(255) NOT NULL,
  `address` varchar(255) NOT NULL,
  `contact` varchar(255) NOT NULL,
  `gender` enum('male','female') NOT NULL,
  `photo` varchar(255) DEFAULT NULL,
  `remember_token` varchar(255) DEFAULT NULL,
  `api_token` varchar(255) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `per_users`
--

INSERT INTO `per_users` (`id`, `name`, `email`, `password`, `address`, `contact`, `gender`, `photo`, `remember_token`, `api_token`, `created_at`, `updated_at`) VALUES
(20, 'Rashmi Rajbahak', 'rashmi@gmail.com', '$2y$10$jWZrFDUhCfw0ziiG8mN.zeNkxtEDClvtMNjLa2t5iIC30VGqUyjka', 'Sakhu', '98123123', 'female', '5b7526c55a694asia.jpg', 'Ws82s8OhcmHinpOhE0nrFGSfgacbRQOPdLPWd8JZ55NoRPVtcpDYFxFduHTN', '383PjcP2SYvnyLQiCU0WMfSA0eyEJzqFqZnLMm3Rghhu8l06cfm8IbwSzIMy', '2018-08-16 06:30:26', '2018-08-16 07:24:53'),
(21, 'Nabina Maharjan', 'maharjan.nabu66@gmail.com', '$2y$10$4TJNsHy3A89uZ.sTAYWh5u7cuWFPS5NhD7QzsYOEuwKW5HvpfNKL2', 'Balkhu, Kathmandu', '9860377838', 'female', NULL, 'X4AfE26dZA37tMMgukKtWYOdfEo34wZBPHYjmMCke5dnQ1f0cWHIDqKN1jXP', 'd7pJUPgqTJeoX7hjaCq0EpEtBztNTprGTFrmyd4voQpMWT5kxLH2vDWYLozR', '2018-08-16 08:24:33', '2018-08-16 08:24:33'),
(22, 'Rohit Manandhar', 'rohit@gmail.com', '$2y$10$XwCIHsoj7eo3/oM3GKyOvOSjd3GXqdm4SrTBd97kMV1p1kVnSoJKu', 'Naya Bazar', '981232312', 'male', NULL, '8GnxLbTV3CcAP69zjodZ7ZgB6D249tTk4r3DXSfW8QX69VItLH8f1wLCHoxw', 'QrBKTCO4TGb49jIgcMPWnsRZN4w70oSAxcrz7EnxILUgm9dqnuC0Z6ebyyiY', '2018-08-20 11:39:28', '2018-08-20 11:39:28'),
(23, 'Prapti Thapa', 'prapti@gmail.com', '$2y$10$/mxu1zN.4vWX/cftTPOxIufCBmGBO4pJaZeW8qBLSS2EJd1yQ5f9m', 'Balkhu, Kathmandu', '98123122', 'female', NULL, 'mHbOoTidwlJ7tQuIoNCcmRjjUZexeTBdKyg2HQItEdEGTp7kwwBlrBXtEXKr', 'xruPRnffjL0xwxhDOMLGMW1AipqShDd95HOYUeY36JCzFq0SkXS57AWXtmt0', '2018-08-21 15:04:42', '2018-08-21 15:04:42'),
(24, 'Sudip Rai', 'sudiprai277@gmail.com', '$2y$10$lY.oaS/AgEstIG7VpcBmoOMFfoi5dTbOMyYAsqxq5xowII2TCSM9u', 'Koteshwor', '981232231', 'male', NULL, 'd6bkVoLKdhzIvOp4bGm2JqxFN0czSvQtJqzB54s8THaGve4WfatgLJqkRDYa', 'O7IIBhj8JlQacpx4dm8Z2fJsapKmJv95LM4c8IZMyae9U3okFcsXQHPUnzDT', '2018-08-22 12:12:28', '2018-08-22 12:12:28'),
(25, 'Sajan Aryal', 'aryalsajan143@gmail.com', '$2y$10$xVD7x24J9z7Pyhnyl2KJ..H0uTDhRVhbtrf0FYn7ir568ZaAgvGWm', 'kirtipur', '9847268063', 'male', NULL, 'y6HShAPch5qFiy0hErWYgpcvzpfuPkcPk20nuotK8OQdiVZcUkJjQz7XpmIZ', 'sfi8ox8ngl3Fo5mZdYoSePoFQTWqBZY8psuYEjWJQEBl7xER2vJp3155XjF5', '2018-08-22 12:13:56', '2018-08-22 12:13:56');

-- --------------------------------------------------------

--
-- Table structure for table `per_user_details`
--

CREATE TABLE `per_user_details` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `department_id` int(11) DEFAULT NULL,
  `job_id` int(11) DEFAULT NULL,
  `joining_date` varchar(50) DEFAULT NULL,
  `resume` varchar(50) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `per_user_details`
--

INSERT INTO `per_user_details` (`id`, `user_id`, `department_id`, `job_id`, `joining_date`, `resume`, `created_at`, `updated_at`) VALUES
(9, 20, 3, 4, '2018-05-24', '5b751a025efecphp course book.pdf', '2018-08-16 06:30:26', '2018-08-16 10:05:14'),
(10, 21, 3, 3, '2018-08-15', NULL, '2018-08-16 08:24:33', '2018-08-16 08:24:33'),
(11, 22, 2, 2, '2017-12-01', NULL, '2018-08-20 11:39:28', '2018-08-20 11:39:28'),
(12, 23, 3, 3, '2018-05-01', NULL, '2018-08-21 15:04:42', '2018-08-21 15:04:42'),
(13, 24, 3, 3, '2018-04-01', NULL, '2018-08-22 12:12:28', '2018-08-22 12:12:28'),
(14, 25, 3, 4, '2018-08-08', NULL, '2018-08-22 12:13:56', '2018-08-22 12:13:56');

-- --------------------------------------------------------

--
-- Table structure for table `per_user_roles`
--

CREATE TABLE `per_user_roles` (
  `id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `role_id` int(10) NOT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `per_user_roles`
--

INSERT INTO `per_user_roles` (`id`, `user_id`, `role_id`, `created_at`, `updated_at`) VALUES
(14, 20, 2, '2018-08-16 06:30:26', '2018-08-16 06:30:26'),
(15, 21, 2, '2018-08-16 08:24:33', '2018-08-16 08:24:33'),
(16, 22, 1, '2018-08-20 11:39:28', '2018-08-20 11:39:28'),
(17, 23, 2, '2018-08-21 15:04:42', '2018-08-21 15:04:42'),
(18, 24, 1, '2018-08-22 12:12:28', '2018-08-22 12:12:28'),
(19, 25, 1, '2018-08-22 12:13:56', '2018-08-22 12:13:56');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `per_attendance`
--
ALTER TABLE `per_attendance`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `per_chat`
--
ALTER TABLE `per_chat`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `per_daily_report`
--
ALTER TABLE `per_daily_report`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `per_department`
--
ALTER TABLE `per_department`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `per_facebook_image_post`
--
ALTER TABLE `per_facebook_image_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `per_facebook_link_post`
--
ALTER TABLE `per_facebook_link_post`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `per_job`
--
ALTER TABLE `per_job`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`);

--
-- Indexes for table `per_leave`
--
ALTER TABLE `per_leave`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `per_leave_logs`
--
ALTER TABLE `per_leave_logs`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `per_roles`
--
ALTER TABLE `per_roles`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `per_settings`
--
ALTER TABLE `per_settings`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `per_superadmin`
--
ALTER TABLE `per_superadmin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `per_users`
--
ALTER TABLE `per_users`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `per_user_details`
--
ALTER TABLE `per_user_details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`);

--
-- Indexes for table `per_user_roles`
--
ALTER TABLE `per_user_roles`
  ADD PRIMARY KEY (`id`),
  ADD KEY `user_id` (`user_id`),
  ADD KEY `user_id_2` (`user_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `per_attendance`
--
ALTER TABLE `per_attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=54;
--
-- AUTO_INCREMENT for table `per_chat`
--
ALTER TABLE `per_chat`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=124;
--
-- AUTO_INCREMENT for table `per_daily_report`
--
ALTER TABLE `per_daily_report`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
--
-- AUTO_INCREMENT for table `per_department`
--
ALTER TABLE `per_department`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;
--
-- AUTO_INCREMENT for table `per_facebook_image_post`
--
ALTER TABLE `per_facebook_image_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `per_facebook_link_post`
--
ALTER TABLE `per_facebook_link_post`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `per_job`
--
ALTER TABLE `per_job`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;
--
-- AUTO_INCREMENT for table `per_leave`
--
ALTER TABLE `per_leave`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `per_leave_logs`
--
ALTER TABLE `per_leave_logs`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT;
--
-- AUTO_INCREMENT for table `per_roles`
--
ALTER TABLE `per_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;
--
-- AUTO_INCREMENT for table `per_settings`
--
ALTER TABLE `per_settings`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `per_superadmin`
--
ALTER TABLE `per_superadmin`
  MODIFY `id` int(50) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;
--
-- AUTO_INCREMENT for table `per_users`
--
ALTER TABLE `per_users`
  MODIFY `id` int(10) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;
--
-- AUTO_INCREMENT for table `per_user_details`
--
ALTER TABLE `per_user_details`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=15;
--
-- AUTO_INCREMENT for table `per_user_roles`
--
ALTER TABLE `per_user_roles`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=20;
--
-- Constraints for dumped tables
--

--
-- Constraints for table `per_attendance`
--
ALTER TABLE `per_attendance`
  ADD CONSTRAINT `per_attendance_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `per_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `per_daily_report`
--
ALTER TABLE `per_daily_report`
  ADD CONSTRAINT `per_daily_report_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `per_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `per_job`
--
ALTER TABLE `per_job`
  ADD CONSTRAINT `per_job_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `per_department` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `per_leave`
--
ALTER TABLE `per_leave`
  ADD CONSTRAINT `per_leave_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `per_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `per_leave_logs`
--
ALTER TABLE `per_leave_logs`
  ADD CONSTRAINT `per_leave_logs_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `per_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `per_user_details`
--
ALTER TABLE `per_user_details`
  ADD CONSTRAINT `per_user_details_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `per_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `per_user_roles`
--
ALTER TABLE `per_user_roles`
  ADD CONSTRAINT `per_user_roles_ibfk_1` FOREIGN KEY (`user_id`) REFERENCES `per_users` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
