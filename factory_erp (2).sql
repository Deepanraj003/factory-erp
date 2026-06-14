-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: Jun 14, 2026 at 04:24 AM
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
-- Database: `factory_erp`
--

-- --------------------------------------------------------

--
-- Table structure for table `attendance`
--

CREATE TABLE `attendance` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `check_in` datetime DEFAULT NULL,
  `check_out` datetime DEFAULT NULL,
  `work_date` date DEFAULT NULL,
  `late_minutes` int(11) DEFAULT 0,
  `overtime_minutes` int(11) DEFAULT 0,
  `total_hours` decimal(5,2) DEFAULT 0.00,
  `status` varchar(50) DEFAULT 'present'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `attendance`
--

INSERT INTO `attendance` (`id`, `user_id`, `check_in`, `check_out`, `work_date`, `late_minutes`, `overtime_minutes`, `total_hours`, `status`) VALUES
(1, 2, '2026-06-01 09:00:00', '2026-06-01 18:00:00', '2026-06-01', 0, 60, 9.00, 'present'),
(2, 3, '2026-06-01 09:15:00', '2026-06-01 18:00:00', '2026-06-01', 15, 20, 8.75, 'present'),
(3, 4, '2026-06-01 09:10:00', '2026-06-01 17:30:00', '2026-06-01', 10, 0, 8.33, 'present'),
(4, 5, '2026-06-01 09:00:00', '2026-06-01 18:15:00', '2026-06-01', 0, 75, 9.25, 'present'),
(5, 6, '2026-06-01 09:05:00', '2026-06-01 18:00:00', '2026-06-01', 5, 30, 8.92, 'present'),
(6, 7, '2026-06-01 09:20:00', '2026-06-01 18:00:00', '2026-06-01', 20, 0, 8.66, 'present'),
(7, 8, '2026-06-01 09:00:00', '2026-06-01 17:45:00', '2026-06-01', 0, 0, 8.75, 'present'),
(8, 9, '2026-06-01 09:30:00', '2026-06-01 18:00:00', '2026-06-01', 30, 10, 8.50, 'present'),
(9, 10, '2026-06-01 09:00:00', '2026-06-01 18:20:00', '2026-06-01', 0, 80, 9.33, 'present'),
(10, 2, '2026-06-02 09:00:00', '2026-06-02 18:00:00', '2026-06-02', 0, 60, 9.00, 'present');

-- --------------------------------------------------------

--
-- Table structure for table `daily_reports`
--

CREATE TABLE `daily_reports` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `work_date` date DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `description` text DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `daily_reports`
--

INSERT INTO `daily_reports` (`id`, `user_id`, `work_date`, `title`, `description`, `created_at`) VALUES
(1, 2, '2026-06-01', 'Production Update', 'Completed 120 units', '2026-06-14 02:17:34'),
(2, 3, '2026-06-01', 'QC Check', 'All products verified', '2026-06-14 02:17:34'),
(3, 4, '2026-06-01', 'Maintenance', 'Machine serviced', '2026-06-14 02:17:34'),
(4, 5, '2026-06-01', 'HR Work', 'Attendance updated', '2026-06-14 02:17:34'),
(5, 6, '2026-06-01', 'Production', 'Shift completed', '2026-06-14 02:17:34'),
(6, 7, '2026-06-01', 'Packaging', 'Boxing done', '2026-06-14 02:17:34'),
(7, 8, '2026-06-01', 'Logistics', 'Dispatch completed', '2026-06-14 02:17:34'),
(8, 9, '2026-06-01', 'IT Support', 'System fixed', '2026-06-14 02:17:34'),
(9, 10, '2026-06-01', 'Management', 'Daily review done', '2026-06-14 02:17:34'),
(10, 2, '2026-06-02', 'Production', 'Efficiency improved', '2026-06-14 02:17:34');

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `department_salary` decimal(10,2) DEFAULT 0.00
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `department_salary`) VALUES
(1, 'Production', 50000.00),
(2, 'Quality Control', 45000.00),
(3, 'Human Resources', 40000.00),
(4, 'Maintenance', 42000.00),
(5, 'Packaging', 35000.00),
(6, 'Logistics', 38000.00),
(7, 'Accounts', 47000.00),
(8, 'IT Support', 55000.00),
(9, 'Security', 30000.00),
(10, 'Management', 70000.00);

-- --------------------------------------------------------

--
-- Table structure for table `leaves`
--

CREATE TABLE `leaves` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `from_date` date DEFAULT NULL,
  `to_date` date DEFAULT NULL,
  `reason` text DEFAULT NULL,
  `status` enum('pending','approved','rejected') DEFAULT 'pending',
  `applied_on` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `leaves`
--

INSERT INTO `leaves` (`id`, `user_id`, `from_date`, `to_date`, `reason`, `status`, `applied_on`) VALUES
(1, 2, '2026-06-10', '2026-06-12', 'Family function', 'approved', '2026-06-14 02:17:48'),
(2, 3, '2026-06-11', '2026-06-11', 'Medical', 'pending', '2026-06-14 02:17:48'),
(3, 4, '2026-06-15', '2026-06-16', 'Personal', 'rejected', '2026-06-14 02:17:48'),
(4, 5, '2026-06-18', '2026-06-20', 'Vacation', 'approved', '2026-06-14 02:17:48'),
(5, 6, '2026-06-22', '2026-06-22', 'Emergency', 'pending', '2026-06-14 02:17:48'),
(6, 7, '2026-06-25', '2026-06-27', 'Wedding', 'approved', '2026-06-14 02:17:48'),
(7, 8, '2026-06-28', '2026-06-28', 'Health', 'pending', '2026-06-14 02:17:48'),
(8, 9, '2026-06-29', '2026-06-30', 'Travel', 'approved', '2026-06-14 02:17:48'),
(9, 10, '2026-07-01', '2026-07-02', 'Family', 'pending', '2026-06-14 02:17:48'),
(10, 2, '2026-07-05', '2026-07-06', 'Rest', 'approved', '2026-06-14 02:17:48');

-- --------------------------------------------------------

--
-- Table structure for table `notifications`
--

CREATE TABLE `notifications` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `message` varchar(255) DEFAULT NULL,
  `is_read` int(11) DEFAULT 0,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `notifications`
--

INSERT INTO `notifications` (`id`, `user_id`, `message`, `is_read`, `created_at`) VALUES
(1, 2, 'Leave approved', 0, '2026-06-14 02:18:00'),
(2, 3, 'Late attendance warning', 1, '2026-06-14 02:18:00'),
(3, 4, 'New task assigned', 0, '2026-06-14 02:18:00'),
(4, 5, 'Salary processed', 1, '2026-06-14 02:18:00'),
(5, 6, 'Shift updated', 0, '2026-06-14 02:18:00'),
(6, 7, 'Meeting scheduled', 1, '2026-06-14 02:18:00'),
(7, 8, 'Maintenance request approved', 0, '2026-06-14 02:18:00'),
(8, 9, 'Salary credited', 1, '2026-06-14 02:18:00'),
(9, 10, 'Report pending', 0, '2026-06-14 02:18:00'),
(10, 2, 'Submit daily report', 0, '2026-06-14 02:18:00');

-- --------------------------------------------------------

--
-- Table structure for table `salary`
--

CREATE TABLE `salary` (
  `id` int(11) NOT NULL,
  `user_id` int(11) DEFAULT NULL,
  `month` varchar(20) DEFAULT NULL,
  `year` int(11) DEFAULT NULL,
  `basic_salary` decimal(10,2) DEFAULT NULL,
  `overtime_pay` decimal(10,2) DEFAULT NULL,
  `deduction` decimal(10,2) DEFAULT NULL,
  `net_salary` decimal(10,2) DEFAULT NULL,
  `status` enum('pending','paid') DEFAULT 'pending',
  `created_at` timestamp NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `salary`
--

INSERT INTO `salary` (`id`, `user_id`, `month`, `year`, `basic_salary`, `overtime_pay`, `deduction`, `net_salary`, `status`, `created_at`) VALUES
(1, 2, 'June', 2026, 20000.00, 2000.00, 500.00, 21500.00, 'paid', '2026-06-14 02:18:12'),
(2, 3, 'June', 2026, 18000.00, 1000.00, 300.00, 18700.00, 'pending', '2026-06-14 02:18:12'),
(3, 4, 'June', 2026, 22000.00, 1500.00, 700.00, 22800.00, 'paid', '2026-06-14 02:18:12'),
(4, 5, 'June', 2026, 25000.00, 2500.00, 1000.00, 26500.00, 'paid', '2026-06-14 02:18:12'),
(5, 6, 'June', 2026, 20000.00, 1800.00, 400.00, 21400.00, 'pending', '2026-06-14 02:18:12'),
(6, 7, 'June', 2026, 19000.00, 1200.00, 600.00, 19600.00, 'paid', '2026-06-14 02:18:12'),
(7, 8, 'June', 2026, 21000.00, 900.00, 300.00, 21600.00, 'pending', '2026-06-14 02:18:12'),
(8, 9, 'June', 2026, 23000.00, 2000.00, 800.00, 24200.00, 'paid', '2026-06-14 02:18:12'),
(9, 10, 'June', 2026, 20000.00, 2200.00, 500.00, 21700.00, 'pending', '2026-06-14 02:18:12'),
(10, 2, 'July', 2026, 20000.00, 1800.00, 400.00, 21400.00, 'pending', '2026-06-14 02:18:12');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int(11) NOT NULL,
  `name` varchar(100) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) DEFAULT NULL,
  `role` enum('admin','staff') DEFAULT 'staff',
  `employee_id` varchar(50) DEFAULT NULL,
  `created_at` timestamp NOT NULL DEFAULT current_timestamp(),
  `department_id` int(11) DEFAULT NULL,
  `phone` varchar(20) DEFAULT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `address` text DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `photo` varchar(255) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `password`, `role`, `employee_id`, `created_at`, `department_id`, `phone`, `gender`, `address`, `dob`, `photo`) VALUES
(1, 'Admin User', 'admin@erp.com', '202cb962ac59075b964b07152d234b70', 'admin', 'EMP001', '2026-06-01 04:30:00', 10, '9876543210', 'male', 'Chennai', '1990-01-01', ''),
(2, 'Arun Kumar', 'arun@erp.com', '202cb962ac59075b964b07152d234b70', 'staff', 'EMP002', '2026-06-01 04:30:00', 1, '9876543211', 'male', 'Chennai', '1995-02-10', ''),
(3, 'Kavya S', 'kavya@erp.com', '202cb962ac59075b964b07152d234b70', 'staff', 'EMP003', '2026-06-01 04:30:00', 3, '9876543212', 'female', 'Chennai', '1996-03-15', ''),
(4, 'Ravi Raj', 'ravi@erp.com', '202cb962ac59075b964b07152d234b70', 'staff', 'EMP004', '2026-06-01 04:30:00', 4, '9876543213', 'male', 'Chennai', '1994-04-20', ''),
(5, 'Priya M', 'priya@erp.com', '202cb962ac59075b964b07152d234b70', 'staff', 'EMP005', '2026-06-01 04:30:00', 7, '9876543214', 'female', 'Chennai', '1997-05-05', ''),
(6, 'John Paul', 'john@erp.com', '202cb962ac59075b964b07152d234b70', 'staff', 'EMP006', '2026-06-01 04:30:00', 2, '9876543215', 'male', 'Chennai', '1993-06-12', ''),
(7, 'Anitha R', 'anitha@erp.com', '202cb962ac59075b964b07152d234b70', 'staff', 'EMP007', '2026-06-01 04:30:00', 5, '9876543216', 'female', 'Chennai', '1998-07-18', ''),
(8, 'Suresh B', 'suresh@erp.com', '202cb962ac59075b964b07152d234b70', 'staff', 'EMP008', '2026-06-01 04:30:00', 6, '9876543217', 'male', 'Chennai', '1992-08-22', ''),
(9, 'Divya L', 'divya@erp.com', '202cb962ac59075b964b07152d234b70', 'staff', 'EMP009', '2026-06-01 04:30:00', 8, '9876543218', 'female', 'Chennai', '1996-09-09', ''),
(10, 'Vikram S', 'vikram@erp.com', '202cb962ac59075b964b07152d234b70', 'staff', 'EMP010', '2026-06-01 04:30:00', 9, '9876543219', 'male', 'Chennai', '1991-10-30', '');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `attendance`
--
ALTER TABLE `attendance`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `daily_reports`
--
ALTER TABLE `daily_reports`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `leaves`
--
ALTER TABLE `leaves`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `notifications`
--
ALTER TABLE `notifications`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `salary`
--
ALTER TABLE `salary`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `email` (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `attendance`
--
ALTER TABLE `attendance`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `daily_reports`
--
ALTER TABLE `daily_reports`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `leaves`
--
ALTER TABLE `leaves`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `notifications`
--
ALTER TABLE `notifications`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `salary`
--
ALTER TABLE `salary`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
