-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Nov 09, 2025 at 08:05 AM
-- Server version: 8.4.3
-- PHP Version: 8.3.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospital_appointment_system`
--

-- --------------------------------------------------------

--
-- Table structure for table `appointments`
--

CREATE TABLE `appointments` (
  `id` int NOT NULL,
  `patient_id` int NOT NULL,
  `doctor_id` int NOT NULL,
  `appointment_date` date NOT NULL,
  `appointment_time` time NOT NULL,
  `duration_minutes` int NOT NULL DEFAULT '30' COMMENT 'Appointment duration in minutes (default: 30)',
  `status` varchar(20) DEFAULT 'Scheduled' COMMENT 'Status: Scheduled, Confirmed, In Progress, Completed, Cancelled, No Show, Pending Approval',
  `confirmed_at` datetime DEFAULT NULL COMMENT 'When appointment was confirmed',
  `started_at` datetime DEFAULT NULL COMMENT 'When appointment started (In Progress)',
  `completed_at` datetime DEFAULT NULL COMMENT 'When appointment was completed',
  `cancelled_at` datetime DEFAULT NULL COMMENT 'When appointment was cancelled',
  `cancelled_by` int DEFAULT NULL COMMENT 'User ID who cancelled the appointment',
  `cancellation_reason` text COMMENT 'Reason for cancellation',
  `requires_approval` tinyint(1) DEFAULT '0' COMMENT 'Whether cancellation requires approval',
  `approved_by` int DEFAULT NULL COMMENT 'User ID who approved cancellation',
  `approved_at` datetime DEFAULT NULL COMMENT 'When cancellation was approved',
  `remarks` text,
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `appointments`
--

INSERT INTO `appointments` (`id`, `patient_id`, `doctor_id`, `appointment_date`, `appointment_time`, `duration_minutes`, `status`, `confirmed_at`, `started_at`, `completed_at`, `cancelled_at`, `cancelled_by`, `cancellation_reason`, `requires_approval`, `approved_by`, `approved_at`, `remarks`, `created_at`, `updated_at`) VALUES
(17, 2, 2, '2025-06-26', '10:30:00', 30, 'Scheduled', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'Follow-up for headaches', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(18, 3, 3, '2025-06-26', '14:00:00', 30, 'Completed', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'Knee pain consultation', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(19, 4, 4, '2025-06-26', '15:30:00', 30, 'Scheduled', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'Child wellness check', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(20, 5, 1, '2025-06-26', '16:00:00', 30, 'Scheduled', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'Heart murmur follow-up', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(21, 6, 2, '2025-06-27', '09:00:00', 30, 'Scheduled', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'Neurological examination', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(22, 7, 3, '2025-06-27', '11:00:00', 30, 'Scheduled', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'Back pain evaluation', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(23, 8, 4, '2025-06-27', '14:30:00', 30, 'Scheduled', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'Vaccination appointment', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(25, 2, 1, '2025-06-29', '10:00:00', 30, 'Scheduled', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'Cardiac follow-up', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(26, 3, 2, '2025-06-30', '13:00:00', 30, 'Scheduled', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'Migraine treatment', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(27, 4, 3, '2025-07-01', '15:00:00', 30, 'Scheduled', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'Physical therapy session', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(28, 5, 4, '2025-07-02', '11:30:00', 30, 'Scheduled', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'Pediatric checkup', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(30, 2, 1, '2025-06-12', '14:00:00', 30, 'Completed', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'Cardiac screening', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(31, 3, 3, '2025-06-05', '11:30:00', 30, 'Completed', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'Injury assessment', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(32, 4, 4, '2025-05-26', '16:00:00', 30, 'Completed', NULL, NULL, NULL, NULL, NULL, NULL, 0, NULL, NULL, 'Regular checkup', '2025-06-26 11:22:43', '2025-06-26 11:22:43');

-- --------------------------------------------------------

--
-- Table structure for table `appointment_status_history`
--

CREATE TABLE `appointment_status_history` (
  `id` int NOT NULL,
  `appointment_id` int NOT NULL,
  `old_status` varchar(20) DEFAULT NULL COMMENT 'Previous status',
  `new_status` varchar(20) NOT NULL COMMENT 'New status',
  `changed_by` int NOT NULL COMMENT 'User ID who made the change',
  `changed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `notes` text COMMENT 'Additional notes about the status change',
  `ip_address` varchar(45) DEFAULT NULL COMMENT 'IP address of user who made the change'
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Audit trail for appointment status changes';

-- --------------------------------------------------------

--
-- Table structure for table `departments`
--

CREATE TABLE `departments` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `status` varchar(20) DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `departments`
--

INSERT INTO `departments` (`id`, `name`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Cardiology', 'active', '2025-06-26 07:29:10', '2025-06-26 07:29:10'),
(2, 'Neurology', 'active', '2025-06-26 07:29:10', '2025-06-27 17:53:37'),
(3, 'Emergency Medicine', 'active', '2025-06-26 07:29:10', '2025-06-26 07:29:10'),
(4, 'Pediatrics', 'active', '2025-06-26 07:29:10', '2025-06-26 07:29:10'),
(5, 'Orthopedics', 'active', '2025-06-26 07:29:10', '2025-06-26 07:29:10'),
(6, 'Internal Medicine', 'active', '2025-06-26 07:29:10', '2025-06-26 07:29:10'),
(7, 'Dermatology', 'active', '2025-06-26 07:29:10', '2025-06-26 07:29:10'),
(8, 'Ophthalmology', 'active', '2025-06-26 07:29:10', '2025-06-26 07:29:10');

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `department_id` int NOT NULL,
  `status` varchar(20) DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `department_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'Dr. Ahmad Hassan', 1, 'active', '2025-06-25 23:29:10', '2025-10-21 12:18:56'),
(2, 'Dr. Lisa Wong', 2, 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(3, 'Dr. Raj Patel', 3, 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(4, 'Dr. Maria Santos', 4, 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(5, 'Dr. David Lee', 5, 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(6, 'Dr. Sarah Williams', 6, 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(7, 'Dr. Michael Chen', 1, 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(8, 'Dr. Emily Rodriguez', 4, 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(9, 'Dr. James Thompson', 3, 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(10, 'Dr. Anna Kowalski', 2, 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43');

-- --------------------------------------------------------

--
-- Table structure for table `doctor_schedules`
--

CREATE TABLE `doctor_schedules` (
  `id` int NOT NULL,
  `doctor_id` int NOT NULL,
  `day_of_week` tinyint NOT NULL COMMENT '0=Sunday, 1=Monday, ..., 6=Saturday',
  `start_time` time NOT NULL COMMENT 'Start time of availability',
  `end_time` time NOT NULL COMMENT 'End time of availability',
  `is_available` tinyint(1) DEFAULT '1' COMMENT 'Whether doctor is available on this schedule',
  `notes` text COMMENT 'Additional notes about this schedule',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Doctor availability schedules (weekly recurring)';

-- --------------------------------------------------------

--
-- Table structure for table `patients`
--

CREATE TABLE `patients` (
  `id` int NOT NULL,
  `name` varchar(100) NOT NULL,
  `gender` varchar(10) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `contact_number` varchar(15) DEFAULT NULL,
  `email` varchar(100) DEFAULT NULL,
  `status` varchar(20) DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `patients`
--

INSERT INTO `patients` (`id`, `name`, `gender`, `dob`, `contact_number`, `email`, `status`, `created_at`, `updated_at`) VALUES
(2, 'Sarah Johnson', 'Female', '1990-03-22', '0123456790', 'sarah.johnson@email.com', 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(3, 'Michael Brown', 'Male', '1978-11-08', '0123456791', 'michael.brown@email.com', 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(4, 'Emily Davis', 'Female', '1995-07-12', '0123456792', 'emily.davis@email.com', 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(5, 'Robert Wilson', 'Male', '1982-09-25', '0123456793', 'robert.wilson@email.com', 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(6, 'Jessica Garcia', 'Female', '1988-12-03', '0123456794', 'jessica.garcia@email.com', 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(7, 'David Martinez', 'Male', '1975-04-18', '0123456795', 'david.martinez@email.com', 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(8, 'Lisa Anderson', 'Female', '1992-08-07', '0123456796', 'lisa.anderson@email.com', 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(9, 'Christopher Taylor', 'Male', '1987-01-30', '0123456797', 'christopher.taylor@email.com', 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(10, 'Amanda Thomas', 'Female', '1993-05-14', '0123456798', 'amanda.thomas@email.com', 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(11, 'Daniel Jackson', 'Male', '1980-10-22', '0123456799', 'daniel.jackson@email.com', 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(12, 'Jennifer White', 'Female', '1989-02-16', '0123456800', 'jennifer.white@email.com', 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(13, 'Matthew Harris', 'Male', '1984-07-09', '0123456801', 'matthew.harris@email.com', 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(14, 'Ashley Martin', 'Female', '1991-11-28', '0123456802', 'ashley.martin@email.com', 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(39, 'Ali bin Abu', 'Male', '1998-07-13', '011111111', 'Ali@gmail.com', 'active', '2025-07-01 05:21:36', '2025-07-01 05:21:36');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` int NOT NULL,
  `username` varchar(50) NOT NULL,
  `email` varchar(100) DEFAULT NULL,
  `password` varchar(255) NOT NULL,
  `role` varchar(20) NOT NULL,
  `patient_id` int DEFAULT NULL,
  `doctor_id` int DEFAULT NULL,
  `status` varchar(20) DEFAULT 'active',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `username`, `email`, `password`, `role`, `patient_id`, `doctor_id`, `status`, `created_at`, `updated_at`) VALUES
(1, 'admin', NULL, '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'admin', NULL, NULL, 'active', '2025-06-24 16:06:15', '2025-06-26 06:42:02'),
(6, 'dr_ahmad', 'ahmad.hassan@hospital.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'doctor', NULL, 1, 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(7, 'dr_lisa', 'lisa.wong@hospital.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'doctor', NULL, 2, 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(8, 'dr_raj', 'raj.patel@hospital.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'doctor', NULL, 3, 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(9, 'dr_maria', 'maria.santos@hospital.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'doctor', NULL, 4, 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(10, 'dr_david', 'david.lee@hospital.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'doctor', NULL, 5, 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(11, 'dr_sarah', 'sarah.williams@hospital.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'doctor', NULL, 6, 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(12, 'dr_michael', 'michael.chen@hospital.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'doctor', NULL, 7, 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(13, 'dr_emily', 'emily.rodriguez@hospital.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'doctor', NULL, 8, 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(14, 'john_smith', 'john.smith@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'patient', NULL, NULL, 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(15, 'sarah_johnson', 'sarah.johnson@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'patient', 2, NULL, 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(16, 'michael_brown', 'michael.brown@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'patient', 3, NULL, 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(17, 'emily_davis', 'emily.davis@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'patient', 4, NULL, 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(18, 'robert_wilson', 'robert.wilson@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'patient', 5, NULL, 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(19, 'jessica_garcia', 'jessica.garcia@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'patient', 6, NULL, 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(20, 'david_martinez', 'david.martinez@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'patient', 7, NULL, 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(21, 'lisa_anderson', 'lisa.anderson@email.com', '$2y$10$92IXUNpkjO0rOQ5byMi.Ye4oKoEa3Ro9llC/.og/at2.uheWG/igi', 'patient', 8, NULL, 'active', '2025-06-26 11:22:43', '2025-06-26 11:22:43'),
(41, 'Ali', NULL, '$2y$10$ebO9QWHFqWfGH41/YDW1vuLNJqIj/i95033dUrNnJkOnHbXgv6duS', 'patient', 39, NULL, 'active', '2025-07-01 05:21:36', '2025-07-01 05:21:36');

-- --------------------------------------------------------

--
-- Table structure for table `waiting_list`
--

CREATE TABLE `waiting_list` (
  `id` int NOT NULL,
  `patient_id` int NOT NULL,
  `doctor_id` int DEFAULT NULL COMMENT 'Specific doctor preference (nullable)',
  `department_id` int DEFAULT NULL COMMENT 'Department preference (nullable)',
  `preferred_date` date DEFAULT NULL COMMENT 'Preferred appointment date',
  `preferred_time` time DEFAULT NULL COMMENT 'Preferred appointment time',
  `duration_minutes` int NOT NULL DEFAULT '30' COMMENT 'Requested appointment duration',
  `priority` int NOT NULL DEFAULT '5' COMMENT 'Priority: 1=highest, 10=lowest',
  `status` varchar(20) DEFAULT 'pending' COMMENT 'pending, notified, fulfilled, cancelled',
  `notes` text COMMENT 'Additional notes or requirements',
  `notified_at` datetime DEFAULT NULL COMMENT 'When patient was notified of availability',
  `fulfilled_at` datetime DEFAULT NULL COMMENT 'When waiting list entry was fulfilled',
  `fulfilled_appointment_id` int DEFAULT NULL COMMENT 'Appointment ID that fulfilled this request',
  `created_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `updated_at` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_0900_ai_ci COMMENT='Waiting list for appointments (queue management)';

--
-- Indexes for dumped tables
--

--
-- Indexes for table `appointments`
--
ALTER TABLE `appointments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `appointments_ibfk_2` (`doctor_id`),
  ADD KEY `idx_appointment_status_search` (`status`),
  ADD KEY `idx_appointment_date_search` (`appointment_date`),
  ADD KEY `idx_appointment_full_search` (`patient_id`,`doctor_id`,`status`,`appointment_date`),
  ADD KEY `fk_appointments_cancelled_by` (`cancelled_by`),
  ADD KEY `fk_appointments_approved_by` (`approved_by`),
  ADD KEY `idx_doctor_datetime_status` (`doctor_id`,`appointment_date`,`appointment_time`,`status`),
  ADD KEY `idx_patient_datetime_status` (`patient_id`,`appointment_date`,`appointment_time`,`status`),
  ADD KEY `idx_status_workflow` (`status`,`appointment_date`,`appointment_time`),
  ADD KEY `idx_conflict_detection` (`doctor_id`,`appointment_date`,`appointment_time`,`duration_minutes`,`status`);

--
-- Indexes for table `appointment_status_history`
--
ALTER TABLE `appointment_status_history`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_appointment_id` (`appointment_id`),
  ADD KEY `idx_changed_by` (`changed_by`),
  ADD KEY `idx_changed_at` (`changed_at`),
  ADD KEY `idx_status_change` (`old_status`,`new_status`);

--
-- Indexes for table `departments`
--
ALTER TABLE `departments`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_department_name_search` (`name`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `department_id` (`department_id`),
  ADD KEY `idx_doctor_name_search` (`name`);

--
-- Indexes for table `doctor_schedules`
--
ALTER TABLE `doctor_schedules`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_doctor_day` (`doctor_id`,`day_of_week`),
  ADD KEY `idx_doctor_available` (`doctor_id`,`is_available`);

--
-- Indexes for table `patients`
--
ALTER TABLE `patients`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_patient_search` (`name`,`email`,`contact_number`),
  ADD KEY `idx_patient_name` (`name`),
  ADD KEY `idx_patient_email` (`email`),
  ADD KEY `idx_patient_contact` (`contact_number`),
  ADD KEY `idx_patient_name_search` (`name`),
  ADD KEY `idx_patient_email_search` (`email`),
  ADD KEY `idx_patient_contact_search` (`contact_number`),
  ADD KEY `idx_patient_full_search` (`name`,`email`,`contact_number`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_users_patient_id` (`patient_id`),
  ADD KEY `idx_users_doctor_id` (`doctor_id`),
  ADD KEY `idx_user_username_search` (`username`),
  ADD KEY `idx_user_email_search` (`email`);

--
-- Indexes for table `waiting_list`
--
ALTER TABLE `waiting_list`
  ADD PRIMARY KEY (`id`),
  ADD KEY `idx_patient_status` (`patient_id`,`status`),
  ADD KEY `idx_doctor_status` (`doctor_id`,`status`),
  ADD KEY `idx_department_status` (`department_id`,`status`),
  ADD KEY `idx_priority_status` (`priority`,`status`,`created_at`),
  ADD KEY `idx_preferred_date` (`preferred_date`,`status`),
  ADD KEY `fk_waiting_list_appointment` (`fulfilled_appointment_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointments`
--
ALTER TABLE `appointments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=43;

--
-- AUTO_INCREMENT for table `appointment_status_history`
--
ALTER TABLE `appointment_status_history`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `departments`
--
ALTER TABLE `departments`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `doctor_schedules`
--
ALTER TABLE `doctor_schedules`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patients`
--
ALTER TABLE `patients`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=42;

--
-- AUTO_INCREMENT for table `waiting_list`
--
ALTER TABLE `waiting_list`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `appointments`
--
ALTER TABLE `appointments`
  ADD CONSTRAINT `appointments_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `appointments_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_appointments_approved_by` FOREIGN KEY (`approved_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_appointments_cancelled_by` FOREIGN KEY (`cancelled_by`) REFERENCES `users` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `appointment_status_history`
--
ALTER TABLE `appointment_status_history`
  ADD CONSTRAINT `fk_status_history_appointment` FOREIGN KEY (`appointment_id`) REFERENCES `appointments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_status_history_user` FOREIGN KEY (`changed_by`) REFERENCES `users` (`id`) ON DELETE RESTRICT ON UPDATE CASCADE;

--
-- Constraints for table `doctors`
--
ALTER TABLE `doctors`
  ADD CONSTRAINT `doctors_ibfk_1` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `doctor_schedules`
--
ALTER TABLE `doctor_schedules`
  ADD CONSTRAINT `fk_doctor_schedules_doctor` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

--
-- Constraints for table `users`
--
ALTER TABLE `users`
  ADD CONSTRAINT `users_ibfk_1` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `users_ibfk_2` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

--
-- Constraints for table `waiting_list`
--
ALTER TABLE `waiting_list`
  ADD CONSTRAINT `fk_waiting_list_appointment` FOREIGN KEY (`fulfilled_appointment_id`) REFERENCES `appointments` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_waiting_list_department` FOREIGN KEY (`department_id`) REFERENCES `departments` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_waiting_list_doctor` FOREIGN KEY (`doctor_id`) REFERENCES `doctors` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD CONSTRAINT `fk_waiting_list_patient` FOREIGN KEY (`patient_id`) REFERENCES `patients` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
