SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = '+02:00';

--
-- Database: `ehospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_email` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci NOT NULL,
  `admin_password` varchar(255) CHARACTER SET latin1 COLLATE latin1_general_ci DEFAULT NULL,
  PRIMARY KEY (`admin_email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;


--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_email`, `admin_password`) VALUES
('admin@ehospital.bg', 'admin123');

-- --------------------------------------------------------

--
-- Table structure for table `appointment`
--

CREATE TABLE IF NOT EXISTS `appointment` (
  `appointment_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(10) DEFAULT NULL,
  `appointment_num` int(3) DEFAULT NULL,
  `schedule_id` int(10) DEFAULT NULL,
  `appointment_date` date DEFAULT NULL,
  PRIMARY KEY (`appointment_id`),
  KEY `patient_id` (`patient_id`),
  KEY `schedule_id` (`schedule_id`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;


--
-- Dumping data for table `appointment`
--

INSERT INTO `appointment` (`appointment_id`, `patient_id`, `appointment_num`, `schedule_id`, `appointment_date`) VALUES
(1, 1, 1, 1, '20-03-2023');

-- --------------------------------------------------------

--
-- Table structure for table `doctor`
--

DROP TABLE IF EXISTS `doctor`;
CREATE TABLE IF NOT EXISTS `doctor` (
  `doctor_id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_email` varchar(50) DEFAULT NULL,
  `doctor_name` varchar(25) DEFAULT NULL,
  `doctor_password` varchar(25) DEFAULT NULL,
  `doctor_tel` varchar(15) DEFAULT NULL,
  `specialties` int(2) DEFAULT NULL,
  PRIMARY KEY (`doctor_id`),
  KEY `specialties` (`specialties`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `doctor`
--

INSERT INTO `doctor` (`doctor_id`, `doctor_email`, `doctor_name`, `doctor_password`, `doctor_tel`, `specialties`) VALUES
(1, 'velislav_stoyanov@ehospital.bg', 'Велислав Стоянов', '111654161', '0898314551', 5);
INSERT INTO `doctor` (`doctor_id`, `doctor_email`, `doctor_name`, `doctor_password`, `doctor_tel`, `specialties`) VALUES
(2, 'veselin_mladenov@ehospital.bg', 'Веселин Младенов', '651145611', '0874117654', 8);
INSERT INTO `doctor` (`doctor_id`, `doctor_email`, `doctor_name`, `doctor_password`, `doctor_tel`, `specialties`) VALUES
(3, 'toni_hristova@ehospital.bg', 'Антоанета Христова', '145641634', '0981116721', 16);
INSERT INTO `doctor` (`doctor_id`, `doctor_email`, `doctor_name`, `doctor_password`, `doctor_tel`, `specialties`) VALUES
(4, 'dobrin_ignatov@ehospital.bg', 'Добрин Игнатов', '456213453', '0876789090', 14);

-- --------------------------------------------------------

--
-- Table structure for table `patient`
--

DROP TABLE IF EXISTS `patient`;
CREATE TABLE IF NOT EXISTS `patient` (
  `patient_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_email` varchar(50) DEFAULT NULL,
  `patient_name` varchar(25) DEFAULT NULL,
  `patient_password` varchar(25) DEFAULT NULL,
  `patient_city` varchar(25) DEFAULT NULL,
  `patient_egn` varchar(15) DEFAULT NULL,
  `patient_dob` date DEFAULT NULL,
  `patient_tel` varchar(15) DEFAULT NULL,
  PRIMARY KEY (`patient_id`)
) ENGINE=InnoDB AUTO_INCREMENT=3 DEFAULT CHARSET=utf8mb4;

-- --------------------------------------------------------

--
-- Table structure for table `schedule`
--

DROP TABLE IF EXISTS `schedule`;
CREATE TABLE IF NOT EXISTS `schedule` (
  `schedule_id` int(11) NOT NULL AUTO_INCREMENT,
  `doctor_id` varchar(255) DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `schedule_date` date DEFAULT NULL,
  `schedule_time` time DEFAULT NULL,
  `nop` int(4) DEFAULT NULL,
  PRIMARY KEY (`schedule_id`),
  KEY `doctor_id` (`doctor_id`)
) ENGINE=InnoDB AUTO_INCREMENT=9 DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `schedule`
--

INSERT INTO `schedule` (`schedule_id`, `doctor_id`, `title`, `schedule_date`, `schedule_time`, `nop`) VALUES
(1, '1', 'Отказване на вредни навици', '2023-06-31', '14:25:00', 50),
(2, '2', 'Здравен преглед и профилактика', '2023-05-22', '16:45:00', 1),
(3, '3', 'Управление на хронични заболявания', '2023-05-28', '13:30:00', 1),
(4, '4', 'Здравословна храна и хидратация', '2023-06-15', '12:00:00', 1);

-- --------------------------------------------------------

--
-- Table structure for table `diagnoses`
--
DROP TABLE IF EXISTS `diagnoses`;
CREATE TABLE IF NOT EXISTS `diagnoses` (
  `diagnosis_id` int(11) NOT NULL AUTO_INCREMENT,
  `diagnosis_name` varchar(255) NOT NULL,
  PRIMARY KEY (`diagnosis_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `medications`
--
DROP TABLE IF EXISTS `medications`;
CREATE TABLE IF NOT EXISTS `medications` (
  `medication_id` int(11) NOT NULL AUTO_INCREMENT,
  `medication_name` varchar(255) NOT NULL,
  PRIMARY KEY (`medication_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Table structure for table `prescriptions`
--

DROP TABLE IF EXISTS `prescriptions`;
CREATE TABLE IF NOT EXISTS `prescriptions` (
  `prescription_id` int(11) NOT NULL AUTO_INCREMENT,
  `patient_id` int(11) NOT NULL,
  `diagnosis_id` int(11) NOT NULL,
  `medication_id` int(11) NOT NULL,
  `prescription_date` DATE NOT NULL,
  `doctor_id` int(11) NOT NULL,
  PRIMARY KEY (`prescription_id`),
  KEY `fk_prescriptions_patient_idx` (`patient_id`),
  KEY `fk_prescriptions_diagnoses_idx` (`diagnosis_id`),
  KEY `fk_prescriptions_medications_idx` (`medication_id`),
  KEY `fk_prescriptions_doctor_idx` (`doctor_id`),
  CONSTRAINT `fk_prescriptions_patients` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_prescriptions_diagnoses` FOREIGN KEY (`diagnosis_id`) REFERENCES `diagnoses` (`diagnosis_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_prescriptions_medications` FOREIGN KEY (`medication_id`) REFERENCES `medications` (`medication_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_prescriptions_doctors` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`) ON DELETE CASCADE
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;



--
-- Dumping data for table `medications`
--

INSERT INTO `medications` (`medication_id`, `medication_name`) VALUES
(1, 'Аспирин'),
(2, 'Ибупрофен'),
(3, 'Парацетамол'),
(4, 'Нурофен'),
(5, 'Диклофенак'),
(6, 'Антибиотик Амоксицилин'),
(7, 'Лекарство за повишено кръвно налягане - Лозартан'),
(8, 'Лекарство за диабет - Метформин'),
(9, 'Лекарство за алергии - Цетиризин'),
(10, 'Хепарин');

--
-- Dumping data for table `diagnoses`
--

INSERT INTO `diagnoses` (`diagnosis_id`, `diagnosis_name`) VALUES
(1, 'Хипертония'),
(2, 'Диабет'),
(3, 'Астма'),
(4, 'Кардиомиопатия'),
(5, 'Депресия'),
(6, 'Алергия'),
(7, 'Туберкулоза'),
(8, 'Грип'),
(9, 'Анемия'),
(10, 'Артрит');


--
-- Table structure for Patient Medical Records
--

-- DROP TABLE IF EXISTS `patient_medical_records`;
-- CREATE TABLE IF NOT EXISTS `patient_medical_records` (
--   `record_id` int(11) NOT NULL AUTO_INCREMENT,
--   `patient_id` int(11) NOT NULL,
--   `diagnosis_id` int(11) NOT NULL,
--   `medication_id` int(11) NOT NULL,
--   PRIMARY KEY (`record_id`),
--   KEY `fk_patient_medical_records_patients_idx` (`patient_id`),
--   KEY `fk_patient_medical_records_diagnoses_idx` (`diagnosis_id`),
--   KEY `fk_patient_medical_records_medications_idx` (`medication_id`),
--   CONSTRAINT `fk_patient_medical_records_patients` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE CASCADE,
--   CONSTRAINT `fk_patient_medical_records_diagnoses` FOREIGN KEY (`diagnosis_id`) REFERENCES `diagnoses` (`diagnosis_id`) ON DELETE CASCADE,
--   CONSTRAINT `fk_patient_medical_records_medications` FOREIGN KEY (`medication_id`) REFERENCES `medications` (`medication_id`) ON DELETE CASCADE
-- ) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;


-- --------------------------------------------------------

--
-- Table structure for table `specialties`
--

DROP TABLE IF EXISTS `specialties`;
CREATE TABLE IF NOT EXISTS `specialties` (
  `specialty_id` int(2) NOT NULL,
  `specialty_name` varchar(50) DEFAULT NULL,
  PRIMARY KEY (`specialty_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4;

--
-- Dumping data for table `specialties`
--

INSERT INTO `specialties` (`specialty_id`, `specialty_name`) VALUES
(1, 'Алергология'),
(2, 'Анестезиология'),
(3, 'Детски болести'),
(4, 'Радиология'),
(5, 'Кардиология'),
(6, 'Дерматология'),
(7, 'Гастроентерология'),
(8, 'Хематология'),
(9, 'Имунология'),
(10, 'Инфекциозни болести'),
(11, 'Микробиология'),
(12, 'Неврология'),
(13, 'Клинична лаборатория'),
(14, 'Ендокринология'),
(15, 'Неврохирургия'),
(16, 'Урология');

-- --------------------------------------------------------

--
-- Table structure for table `webuser`
--

DROP TABLE IF EXISTS `webuser`;
CREATE TABLE IF NOT EXISTS `webuser` (
  `email` varchar(255) NOT NULL,
  `usertype` char(1) DEFAULT NULL,
  PRIMARY KEY (`email`)
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `webuser`
--

INSERT INTO `webuser` (`email`, `usertype`) VALUES
('admin@ehospital.bg', 'a'),
('patient@ehospital.bg', 'p'),
('doctor@ehospital.bg', 'd'),
('velislav_stoyanov@ehospital.bg', 'd'),
('veselin_mladenov@ehospital.bg', 'd'),
('toni_hristova@ehospital.bg', 'd'),
('dobrin_ignatov@ehospital.bg', 'd');
COMMIT;
