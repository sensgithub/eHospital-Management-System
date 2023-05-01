-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1
-- Generation Time: May 01, 2023 at 05:15 PM
-- Server version: 10.4.28-MariaDB
-- PHP Version: 8.0.28

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `ehospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_email` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `admin_password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_email`, `admin_password`) VALUES
('admin@ehospital.bg', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE `appointment` (
  `appointment_id` int(11) NOT NULL,
  `patient_id` int(10) DEFAULT NULL,
  `appointment_num` int(3) DEFAULT NULL,
  `schedule_id` int(10) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `patient_id`, `appointment_num`, `schedule_id`, `appointment_date`) VALUES
(1, 1, 1, 1, '2023-06-21'),
(2, 7, 1, 2, '2023-06-28');

-- --------------------------------------------------------

--
-- Table structure for table `diagnoses`
--

CREATE TABLE `diagnoses` (
  `diagnosis_id` int(11) NOT NULL,
  `diagnosis_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `diagnoses`
--

INSERT INTO `diagnoses` (`diagnosis_id`, `diagnosis_name`) VALUES
(1, 'I11.9 Артериална хипертония без СН'),
(2, 'E11.9 Неинсулинозависим захарен диабет БДУ'),
(3, 'J45.0 Бронхиална астма'),
(4, 'I20.8 Друга исхемична болест на сърцето'),
(5, 'D69.3 Идиопатична тромбоцитопенична пурпура'),
(6, 'Т78.4 Алергия, неуточнена'),
(7, 'I69.3 Последици от мозъчно съдова болест'),
(8, 'B34.9 Остра вирусна инфекция, неуточнена'),
(9, 'D50.8 Друга желязодефицитна анемия '),
(10, 'M06.9 Ревматоиден артрит, неуточнен');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

CREATE TABLE `doctor` (
  `doctor_id` int(11) NOT NULL,
  `doctor_email` varchar(50) DEFAULT NULL,
  `doctor_name` varchar(25) DEFAULT NULL,
  `doctor_password` varchar(25) DEFAULT NULL,
  `doctor_tel` varchar(15) DEFAULT NULL,
  `specialties` int(2) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctor_id`, `doctor_email`, `doctor_name`, `doctor_password`, `doctor_tel`, `specialties`) VALUES
(1, 'velislav_stoyanov@ehospital.bg', 'Велислав Стоянов Кард.', '111654161', '0898314551', 8),
(2, 'veselin_mladenov@ehospital.bg', 'Веселин Младенов ДБ', '651145611', '0874117654', 17),
(3, 'toni_hristova@ehospital.bg', 'Антоанета Христова АГ', '145641634', '0981116721', 1),
(4, 'dobrin_ignatov@ehospital.bg', 'Добрин Игнатов ВБ', '456213453', '0876789090', 6),
(5, 'petar.petrov@ehospital.bg', 'Петър Петров ХБ', '9878554', '0873413131', 25),
(6, 'mariya.stoyanov@ehospital.bg', 'Марияна Стоянова Инф.Б', '12589175', '0893413155', 7);

-- --------------------------------------------------------

--
-- Table structure for table `medications`
--

CREATE TABLE `medications` (
  `medication_id` int(11) NOT NULL,
  `medication_name` varchar(255) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `medications`
--

INSERT INTO `medications` (`medication_id`, `medication_name`) VALUES
(1, 'Аспирин 500mg 3x1'),
(2, 'Аспирин протект 100mg x1'),
(3, 'Парацетамол 3x500mg'),
(4, 'Нурофен 2x200mg'),
(5, 'Диклак 150 x1 след храна'),
(6, 'Сефпотек 2x200mg/7дни'),
(7, 'Тритейс 10mg x1'),
(8, 'Сиофор 500mg 2x1'),
(9, 'Зиртек 10mg x1'),
(10, 'Метилпреднизолон 4mg по схема'),
(11, 'Сорбифер Дурулес 320mg 2x1'),
(12, 'Паратрамол 37,5mg/325mg 3x1 при нужда'),
(13, 'Аркоксия 90mg x1'),
(14, 'Салбутамол 2mg 3x1'),
(15, 'Мукосолван 30mg 3x1');

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

CREATE TABLE `patient` (
  `patient_id` int(11) NOT NULL,
  `patient_email` varchar(50) DEFAULT NULL,
  `patient_name` varchar(25) DEFAULT NULL,
  `patient_password` varchar(25) DEFAULT NULL,
  `patient_city` varchar(25) DEFAULT NULL,
  `patient_egn` varchar(15) DEFAULT NULL,
  `patient_dob` date DEFAULT NULL,
  `patient_tel` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `patient`
--

INSERT INTO `patient` (`patient_id`, `patient_email`, `patient_name`, `patient_password`, `patient_city`, `patient_egn`, `patient_dob`, `patient_tel`) VALUES
(1, 'ivan.ivanov@gmail.com', 'Иван Иванов', '1234', 'Варна', '0034318885', '2000-05-08', '0894563133'),
(7, 'georgi.georgiev@gmail.com', 'Георги Георгиев', '094151', 'Варна', '0033318885', '2000-07-31', '0884563133');

-- --------------------------------------------------------

--
-- Table structure for table `prescriptions`
--

CREATE TABLE `prescriptions` (
  `prescription_id` int(11) NOT NULL,
  `patient_id` int(11) NOT NULL,
  `diagnosis_id` int(11) NOT NULL,
  `medication_id` int(11) NOT NULL,
  `prescription_date` date NOT NULL,
  `doctor_id` int(11) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `prescriptions`
--

INSERT INTO `prescriptions` (`prescription_id`, `patient_id`, `diagnosis_id`, `medication_id`, `prescription_date`, `doctor_id`) VALUES
(4, 7, 9, 11, '2023-05-01', 4),
(5, 7, 1, 7, '2023-05-01', 4),
(6, 7, 4, 2, '2023-05-01', 4),
(8, 1, 7, 2, '2023-05-01', 4),
(10, 1, 8, 6, '2023-05-01', 4),
(12, 7, 5, 10, '2023-05-01', 4),
(14, 7, 10, 13, '2023-05-01', 4),
(15, 1, 2, 8, '2023-05-01', 4),
(16, 7, 3, 14, '2023-05-01', 4),
(17, 7, 3, 15, '2023-05-01', 4),
(18, 1, 6, 9, '2023-05-01', 4);

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

CREATE TABLE `schedule` (
  `schedule_id` int(11) NOT NULL,
  `doctor_id` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `schedule_date` date DEFAULT NULL,
  `schedule_time` time DEFAULT NULL,
  `nop` int(4) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `doctor_id`, `title`, `schedule_date`, `schedule_time`, `nop`) VALUES
(1, '1', 'Промоция и профилактика на здравето', '0000-00-00', '14:25:00', 50),
(2, '2', 'Амбулаторен преглед', '2023-05-22', '16:45:00', 1),
(3, '3', 'Диспансеризация на пациенти с хронични заболявания', '2023-05-28', '13:30:00', 1),
(4, '4', 'Здравословен начин на живот и хранене', '2023-06-15', '12:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `specialties`
--

CREATE TABLE `specialties` (
  `specialty_id` int(2) NOT NULL,
  `specialty_name` varchar(50) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `specialties`
--

INSERT INTO `specialties` (`specialty_id`, `specialty_name`) VALUES
(1, 'Акушерство и гинекология'),
(2, 'Алергология'),
(3, 'Гастроентерология'),
(4, 'Кожни и венерически болести'),
(5, 'Ендокринология и болести на обмяната'),
(6, 'Вътрешни болести'),
(7, 'Инфекциозни болести'),
(8, 'Кардиология'),
(9, 'Клинична лаборатория'),
(10, 'Неврология'),
(12, 'Медицинска онкология'),
(17, 'Детски болести'),
(22, 'Урология'),
(24, 'Клинична хематология'),
(25, 'Хирургия'),
(41, 'Микробиология');

-- --------------------------------------------------------

--
-- Table structure for table `webuser`
--

CREATE TABLE `webuser` (
  `email` varchar(255) NOT NULL,
  `usertype` char(1) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1 COLLATE=latin1_swedish_ci;

--
-- Dumping data for table `webuser`
--

INSERT INTO `webuser` (`email`, `usertype`) VALUES
('admin@ehospital.bg', 'a'),
('dobrin_ignatov@ehospital.bg', 'd'),
('doctor@ehospital.bg', 'd'),
('georgi.georgiev@gmail.com', 'p'),
('ivan.ivanov@gmail.com', 'p'),
('patient@ehospital.bg', 'p'),
('toni_hristova@ehospital.bg', 'd'),
('velislav_stoyanov@ehospital.bg', 'd'),
('veselin_mladenov@ehospital.bg', 'd');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_email`);

--
-- Indexes for table `appointment`
--
ALTER TABLE `appointment`
  ADD PRIMARY KEY (`appointment_id`),
  ADD KEY `patient_id` (`patient_id`),
  ADD KEY `schedule_id` (`schedule_id`);

--
-- Indexes for table `diagnoses`
--
ALTER TABLE `diagnoses`
  ADD PRIMARY KEY (`diagnosis_id`);

--
-- Indexes for table `doctor`
--
ALTER TABLE `doctor`
  ADD PRIMARY KEY (`doctor_id`),
  ADD KEY `specialties` (`specialties`);

--
-- Indexes for table `medications`
--
ALTER TABLE `medications`
  ADD PRIMARY KEY (`medication_id`);

--
-- Indexes for table `patient`
--
ALTER TABLE `patient`
  ADD PRIMARY KEY (`patient_id`);

--
-- Indexes for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD PRIMARY KEY (`prescription_id`),
  ADD KEY `fk_prescriptions_patient_idx` (`patient_id`),
  ADD KEY `fk_prescriptions_diagnoses_idx` (`diagnosis_id`),
  ADD KEY `fk_prescriptions_medications_idx` (`medication_id`),
  ADD KEY `fk_prescriptions_doctor_idx` (`doctor_id`);

--
-- Indexes for table `schedule`
--
ALTER TABLE `schedule`
  ADD PRIMARY KEY (`schedule_id`),
  ADD KEY `doctor_id` (`doctor_id`);

--
-- Indexes for table `specialties`
--
ALTER TABLE `specialties`
  ADD PRIMARY KEY (`specialty_id`);

--
-- Indexes for table `webuser`
--
ALTER TABLE `webuser`
  ADD PRIMARY KEY (`email`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `appointment`
--
ALTER TABLE `appointment`
  MODIFY `appointment_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `diagnoses`
--
ALTER TABLE `diagnoses`
  MODIFY `diagnosis_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=11;

--
-- AUTO_INCREMENT for table `doctor`
--
ALTER TABLE `doctor`
  MODIFY `doctor_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `medications`
--
ALTER TABLE `medications`
  MODIFY `medication_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `patient`
--
ALTER TABLE `patient`
  MODIFY `patient_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `prescriptions`
--
ALTER TABLE `prescriptions`
  MODIFY `prescription_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `schedule`
--
ALTER TABLE `schedule`
  MODIFY `schedule_id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=9;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `prescriptions`
--
ALTER TABLE `prescriptions`
  ADD CONSTRAINT `fk_prescriptions_diagnoses` FOREIGN KEY (`diagnosis_id`) REFERENCES `diagnoses` (`diagnosis_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_prescriptions_doctor` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_prescriptions_medications` FOREIGN KEY (`medication_id`) REFERENCES `medications` (`medication_id`) ON DELETE CASCADE,
  ADD CONSTRAINT `fk_prescriptions_patient` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
