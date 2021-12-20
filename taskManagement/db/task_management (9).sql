-- phpMyAdmin SQL Dump
-- version 5.1.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Dec 14, 2021 at 12:31 PM
-- Server version: 10.4.18-MariaDB
-- PHP Version: 8.0.3

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `task_management`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `id` int(123) NOT NULL,
  `username` varchar(123) NOT NULL,
  `password` varchar(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`id`, `username`, `password`) VALUES
(1, 'admin@manage.com', '123456');

-- --------------------------------------------------------

--
-- Table structure for table `assigned_tasks`
--

CREATE TABLE `assigned_tasks` (
  `id` int(123) NOT NULL,
  `task_id` int(123) NOT NULL,
  `user_id` int(123) NOT NULL,
  `task_note` varchar(123) NOT NULL,
  `link` varchar(123) NOT NULL,
  `developer_note` varchar(10000) NOT NULL,
  `deadline` date NOT NULL,
  `submited_date` varchar(123) NOT NULL,
  `status` varchar(123) NOT NULL,
  `feedback` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `assigned_tasks`
--

INSERT INTO `assigned_tasks` (`id`, `task_id`, `user_id`, `task_note`, `link`, `developer_note`, `deadline`, `submited_date`, `status`, `feedback`) VALUES
(1, 6, 1, '', 'projects/huye district website (Web Design)/kkkkkk.PNG', '', '0000-00-00', '0000-00-00', 'rejected', 'sdxfcgvh'),
(8, 8, 1, 'ok gjhkjlk', 'projects/kacyiru hospital website (Web Design)/sign up.zip', 'this is for just testing ', '2021-09-19', '0000-00-00', 'rejected', 'this'),
(9, 7, 1, 'cgfchjm,k./l hgjkl', '', '', '2021-11-25', '', 'deadline_exp', ''),
(10, 9, 1, 'do this', '', '', '2021-10-29', '', 'deadline_exp', ''),
(11, 10, 8, 'please make sure you use the good colors', '', '', '2021-11-06', '', 'deadline_exp', ''),
(12, 11, 8, 'this is for just testing', '', '', '2021-11-04', '', 'deadline_exp', ''),
(13, 8, 1, 'ok gjhkjlk', 'projects/kacyiru hospital website (Web Design)/sign up.zip', 'this is for just testing ', '2021-09-19', '0000-00-00', 'rejected', 'this');

-- --------------------------------------------------------

--
-- Table structure for table `payments`
--

CREATE TABLE `payments` (
  `id` int(123) NOT NULL,
  `user_id` int(123) NOT NULL,
  `task_id` int(123) NOT NULL,
  `amount` varchar(20) NOT NULL,
  `p_date` varchar(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `payments`
--

INSERT INTO `payments` (`id`, `user_id`, `task_id`, `amount`, `p_date`) VALUES
(1, 1, 6, '20000', '20/10/2021'),
(3, 1, 8, '10', '14/12/21');

-- --------------------------------------------------------

--
-- Table structure for table `project`
--

CREATE TABLE `project` (
  `id` int(123) NOT NULL,
  `proj_name` varchar(123) NOT NULL,
  `proj_type` varchar(123) NOT NULL,
  `proj_description` varchar(123) NOT NULL,
  `amount` int(20) NOT NULL,
  `project_path` varchar(123) NOT NULL,
  `status` varchar(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `project`
--

INSERT INTO `project` (`id`, `proj_name`, `proj_type`, `proj_description`, `amount`, `project_path`, `status`) VALUES
(9, 'huye district website', 'Web Design', 'FYGHJKL YGFHJK YGFUIHJKO', 200000, 'projects/huye district website (Web Design)', 'completed'),
(10, 'kacyiru hospital website', 'Web Design', 'this just for testing                                             ', 150000, 'projects/kacyiru hospital website (Web Design)', 'pending'),
(11, 'testing project', 'Application Development', 'this is for just testing ', 150000, 'projects/testing project (Application Development)', 'created');

-- --------------------------------------------------------

--
-- Table structure for table `skills`
--

CREATE TABLE `skills` (
  `id` int(123) NOT NULL,
  `name` varchar(123) NOT NULL,
  `user_id` int(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `skills`
--

INSERT INTO `skills` (`id`, `name`, `user_id`) VALUES
(2, 'css', 1),
(3, 'js', 1),
(4, 'html', 1),
(6, 'android', 1),
(7, 'html', 8),
(8, 'css', 8),
(9, 'js', 8),
(10, 'android', 8),
(12, 'php', 8);

-- --------------------------------------------------------

--
-- Table structure for table `tasks`
--

CREATE TABLE `tasks` (
  `id` int(123) NOT NULL,
  `task_name` varchar(123) NOT NULL,
  `proj_id` int(123) NOT NULL,
  `status` varchar(123) NOT NULL,
  `proj_description` varchar(122) NOT NULL,
  `skills_required` varchar(123) NOT NULL,
  `amount` varchar(123) NOT NULL,
  `date` date NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `tasks`
--

INSERT INTO `tasks` (`id`, `task_name`, `proj_id`, `status`, `proj_description`, `skills_required`, `amount`, `date`) VALUES
(6, 'home page', 9, 'created', 'hgf fdjghfjd dfkjhgjf fkdhgj', 'html,css,js,php,android', '20000', '2021-09-05'),
(7, 'login', 9, 'created', '', 'html,css,js', '', '2021-09-11'),
(8, 'sign up', 10, 'created', 'this is for just testing', 'html,css', '20000', '2021-09-19'),
(9, 'contact us', 9, 'created', 'this is task require to design contact page ', 'html,css,js', '5000', '2021-10-09'),
(10, 'form', 10, 'created', 'this task is to disegn well looking forms in html and css', 'html,css', '1000', '2021-10-30'),
(11, 'about us page', 10, 'assigned', 'this task focus on about us page', 'html,css,js,php', '2000', '2021-10-30');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(123) NOT NULL,
  `email` varchar(123) NOT NULL,
  `names` varchar(123) NOT NULL,
  `tel` varchar(20) NOT NULL,
  `password` varchar(123) NOT NULL,
  `verified` varchar(123) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `email`, `names`, `tel`, `password`, `verified`) VALUES
(1, 'tee', 'Tee renzo', '0780591269', '12', 'yes'),
(8, 'kagabo@gmail.com', 'Kabago Eric', '0780591269', '1234', 'yes');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `assigned_tasks`
--
ALTER TABLE `assigned_tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `assignedtask` (`user_id`),
  ADD KEY `assignedtask1` (`task_id`);

--
-- Indexes for table `payments`
--
ALTER TABLE `payments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `payment` (`user_id`),
  ADD KEY `payment1` (`task_id`);

--
-- Indexes for table `project`
--
ALTER TABLE `project`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `skills`
--
ALTER TABLE `skills`
  ADD PRIMARY KEY (`id`),
  ADD KEY `foreingkeyfor` (`user_id`);

--
-- Indexes for table `tasks`
--
ALTER TABLE `tasks`
  ADD PRIMARY KEY (`id`),
  ADD KEY `tasks_for_project` (`proj_id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `admin`
--
ALTER TABLE `admin`
  MODIFY `id` int(123) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `assigned_tasks`
--
ALTER TABLE `assigned_tasks`
  MODIFY `id` int(123) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `payments`
--
ALTER TABLE `payments`
  MODIFY `id` int(123) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `project`
--
ALTER TABLE `project`
  MODIFY `id` int(123) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `skills`
--
ALTER TABLE `skills`
  MODIFY `id` int(123) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `tasks`
--
ALTER TABLE `tasks`
  MODIFY `id` int(123) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(123) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `assigned_tasks`
--
ALTER TABLE `assigned_tasks`
  ADD CONSTRAINT `assignedtask` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `assignedtask1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

--
-- Constraints for table `payments`
--
ALTER TABLE `payments`
  ADD CONSTRAINT `payment` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`),
  ADD CONSTRAINT `payment1` FOREIGN KEY (`task_id`) REFERENCES `tasks` (`id`);

--
-- Constraints for table `skills`
--
ALTER TABLE `skills`
  ADD CONSTRAINT `foreingkeyfor` FOREIGN KEY (`user_id`) REFERENCES `users` (`id`);

--
-- Constraints for table `tasks`
--
ALTER TABLE `tasks`
  ADD CONSTRAINT `tasks_for_project` FOREIGN KEY (`proj_id`) REFERENCES `project` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
