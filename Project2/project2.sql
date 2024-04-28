-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Apr 28, 2024 at 02:25 AM
-- Server version: 10.4.32-MariaDB
-- PHP Version: 8.2.12

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `project2`
--

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

CREATE TABLE `categories` (
  `category_id` int(8) NOT NULL,
  `category_name` varchar(255) NOT NULL,
  `category_description` varchar(255) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`category_id`, `category_name`, `category_description`, `created`) VALUES
(4, 'HTML', 'HTML, which stands for HyperText Markup Language, is the standard markup language used to create and structure content on the web. It forms the backbone of websites and web applications, allowing developers to define the structure and layout of a webpage\'', '2023-08-02 13:19:20'),
(5, 'CSS', 'HTML, which stands for HyperText Markup Language, is the standard markup language used to create and structure content on the web. It forms the backbone of websites and web applications, allowing developers to define the structure and layout of a webpage\'', '2023-08-02 13:22:31'),
(6, 'JAVASCRIPT', 'HTML, which stands for HyperText Markup Language, is the standard markup language used to create and structure content on the web. It forms the backbone of websites and web applications, allowing developers to define the structure and layout of a webpage\'', '2023-08-02 13:23:48'),
(7, 'PHP', '\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Maiores quisquam reiciendis molestias tenetur voluptatem velit nemo, sequi ad nostrum in magnam sit nihil. Repellendus quod exercitationem explicabo sint nisi nesciunt beatae iste iure, ut dolorum', '2023-08-02 13:25:06'),
(8, 'BOOTSTRAP', '\r\nLorem ipsum dolor sit amet consectetur adipisicing elit. Maiores quisquam reiciendis molestias tenetur voluptatem velit nemo, sequi ad nostrum in magnam sit nihil. Repellendus quod exercitationem explicabo sint nisi nesciunt beatae iste iure, ut dolorum', '2023-08-02 13:26:26'),
(9, 'LARAVEL', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam aliquid perspiciatis fugiat provident ab autem maxime dolorum ipsam eligendi. Omnis tempora amet exercitationem nihil asperiores? Nostrum magnam exercitationem delectus impedit alias eum iu', '2023-08-02 13:28:47'),
(10, 'JQUERY', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam aliquid perspiciatis fugiat provident ab autem maxime dolorum ipsam eligendi. Omnis tempora amet exercitationem nihil asperiores? Nostrum magnam exercitationem delectus impedit alias eum iu', '2023-08-02 13:30:03'),
(11, 'JQUERY', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam aliquid perspiciatis fugiat provident ab autem maxime dolorum ipsam eligendi. Omnis tempora amet exercitationem nihil asperiores? Nostrum magnam exercitationem delectus impedit alias eum iu', '2023-08-02 13:30:10'),
(12, 'C+++++', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam aliquid perspiciatis fugiat provident ab autem maxime dolorum ipsam eligendi. Omnis tempora amet exercitationem nihil asperiores? Nostrum magnam exercitationem delectus impedit alias eum iu', '2023-08-02 13:30:28'),
(13, 'C++', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam aliquid perspiciatis fugiat provident ab autem maxime dolorum ipsam eligendi. Omnis tempora amet exercitationem nihil asperiores? Nostrum magnam exercitationem delectus impedit alias eum iu', '2023-08-02 13:30:37'),
(14, 'C#', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam aliquid perspiciatis fugiat provident ab autem maxime dolorum ipsam eligendi. Omnis tempora amet exercitationem nihil asperiores? Nostrum magnam exercitationem delectus impedit alias eum iu', '2023-08-02 13:30:53'),
(15, 'C#', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam aliquid perspiciatis fugiat provident ab autem maxime dolorum ipsam eligendi. Omnis tempora amet exercitationem nihil asperiores? Nostrum magnam exercitationem delectus impedit alias eum iu', '2023-08-02 13:31:05'),
(16, 'C#', 'Lorem ipsum dolor sit amet consectetur adipisicing elit. Quisquam aliquid perspiciatis fugiat provident ab autem maxime dolorum ipsam eligendi. Omnis tempora amet exercitationem nihil asperiores? Nostrum magnam exercitationem delectus impedit alias eum iu', '2023-08-02 13:31:14');

-- --------------------------------------------------------

--
-- Table structure for table `comments`
--

CREATE TABLE `comments` (
  `comment_id` int(11) NOT NULL,
  `comment_description` text NOT NULL,
  `question_id` int(11) NOT NULL,
  `comment_by` int(11) NOT NULL,
  `comment_at` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `comments`
--

INSERT INTO `comments` (`comment_id`, `comment_description`, `question_id`, `comment_by`, `comment_at`) VALUES
(10, 'haha', 25, 48, '2023-10-21 07:12:33'),
(11, 'hehe', 25, 48, '2023-10-21 07:12:39'),
(12, 'hohho', 25, 49, '2023-10-21 07:13:04'),
(13, 'no this is not a programming', 24, 48, '2023-10-23 16:01:31'),
(14, 'no this is not a programming', 24, 48, '2023-10-23 16:02:48'),
(15, 'how not a program', 24, 48, '2023-10-23 16:05:25'),
(16, 'how not a program', 24, 48, '2023-10-23 16:08:54'),
(17, 'why', 24, 48, '2023-10-23 16:12:06'),
(18, 'ook', 24, 48, '2023-10-23 16:14:51'),
(19, 'ook', 24, 48, '2023-10-23 16:22:03'),
(20, 'no', 24, 48, '2023-10-23 16:22:38'),
(21, 'yes', 24, 49, '2023-10-27 12:08:50'),
(22, 'ok', 24, 49, '2023-10-27 12:08:57'),
(23, 'krtyy khuch', 27, 49, '2023-10-27 12:11:42'),
(24, '&lthi&gt\r\n', 26, 48, '2023-10-27 13:58:10'),
(25, '&ltscript&gt\r\n\r\n  alert(\"Hello! I am an alert box!\");\r\n\r\n&lt/script&gt', 26, 48, '2023-10-27 13:59:13'),
(26, '<script>\r\n\r\n  alert(\"Hello! I am an alert box!\");\r\n\r\n</script>', 26, 48, '2023-10-27 13:59:55'),
(27, 'saskdn', 29, 48, '2023-11-19 04:07:49'),
(28, 'yes it is a programming language\r\n', 30, 60, '2023-11-29 16:48:38'),
(29, 'good question', 34, 61, '2023-12-11 00:12:25');

-- --------------------------------------------------------

--
-- Table structure for table `questions`
--

CREATE TABLE `questions` (
  `question_id` int(11) NOT NULL,
  `question_title` varchar(255) NOT NULL,
  `question_description` text NOT NULL,
  `category_id` int(11) NOT NULL,
  `user_id` int(11) NOT NULL,
  `created` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `questions`
--

INSERT INTO `questions` (`question_id`, `question_title`, `question_description`, `category_id`, `user_id`, `created`) VALUES
(27, 'css', 'cascading style sheet ?', 5, 49, '2023-10-27 12:11:25'),
(30, 'js programming language or not?', 'what is a programming language and how u define js?', 6, 48, '2023-11-29 16:46:01'),
(34, 'one', '', 4, 61, '2023-12-06 17:08:23'),
(35, 'two', '', 4, 61, '2023-12-06 17:08:28'),
(36, 'three', '', 4, 61, '2023-12-06 17:08:35'),
(37, 'four', '', 4, 61, '2023-12-06 17:08:43'),
(38, 'five', '', 4, 61, '2023-12-06 17:08:50'),
(39, 'six', '', 4, 61, '2023-12-06 17:08:56'),
(40, 'what is html how do i do it is it also worth it or not?', '', 4, 61, '2023-12-06 17:15:36'),
(41, '7th', '7th questions description', 4, 61, '2023-12-06 23:32:36'),
(42, 'alpha is questionning', 'alpha is answering', 4, 61, '2023-12-09 00:33:26');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `sno` int(11) NOT NULL,
  `user_first_name` varchar(10) NOT NULL,
  `user_last_name` varchar(10) NOT NULL,
  `user_email` varchar(20) NOT NULL,
  `user_contact` int(15) NOT NULL,
  `user_password` varchar(255) NOT NULL,
  `user_acc_created` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`sno`, `user_first_name`, `user_last_name`, `user_email`, `user_contact`, `user_password`, `user_acc_created`) VALUES
(48, 'zeeshan', 'iftikhar ', 'z@gmail.com', 1234566, '$2y$10$j07K1CkehVNyOrYGYbJvTuLGPxCW2Qkf/YWnYztxx.XgkR2ijNaoq', '2023-10-21 08:25:42'),
(49, 'javed', 'iftikhar ', 'j@gmail.com', 123456, '$2y$10$emDYmQCGk0fjS3T0mX/vM.dFQ.JOAKZFG4DXUX93Ydf.lRaPVpywS', '2023-10-21 08:26:39'),
(59, 'as', 'as', 'as@gmail.com', 111, '$2y$10$N4Ko1yqE.r1y7g6Bs./UC.bbkt/W3EnjhzQUoVh8866CbfUIqV8Eq', '2023-10-22 19:04:07'),
(60, 'zeeshan 2', 'zeeshan 2', 'ze@gmail.com', 318000000, '$2y$10$XuAFJHs3AjqsZboVGZpXSutlIjfxVLQXa4BH2fdyJ38QimUEVrxjG', '2023-11-29 06:47:52'),
(61, 'alpha', 'alpha', 'alpha@gmail.com', 11, '$2y$10$KaYimD17ki0isddp6QdWo.jbPFJhrnr.edzoqxoVW5OdTa/hh6z/u', '2023-12-04 23:18:37');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `categories`
--
ALTER TABLE `categories`
  ADD PRIMARY KEY (`category_id`);
ALTER TABLE `categories` ADD FULLTEXT KEY `category_name` (`category_name`,`category_description`);

--
-- Indexes for table `comments`
--
ALTER TABLE `comments`
  ADD PRIMARY KEY (`comment_id`);

--
-- Indexes for table `questions`
--
ALTER TABLE `questions`
  ADD PRIMARY KEY (`question_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`sno`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `categories`
--
ALTER TABLE `categories`
  MODIFY `category_id` int(8) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `comments`
--
ALTER TABLE `comments`
  MODIFY `comment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=30;

--
-- AUTO_INCREMENT for table `questions`
--
ALTER TABLE `questions`
  MODIFY `question_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `sno` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=62;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
