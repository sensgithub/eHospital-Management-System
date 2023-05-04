SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = '+02:00';

USE ehospital; 
GRANT ALL PRIVILEGES ON ehospital.* TO 'db_user'@'mysql';

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
(1, 'velislav_stoyanov@ehospital.bg', 'Veselin Stoyanov', '111654161', '0898314551', 5);
INSERT INTO `doctor` (`doctor_id`, `doctor_email`, `doctor_name`, `doctor_password`, `doctor_tel`, `specialties`) VALUES
(2, 'veselin_mladenov@ehospital.bg', 'Veselin Mladenov', '651145611', '0874117654', 8);
INSERT INTO `doctor` (`doctor_id`, `doctor_email`, `doctor_name`, `doctor_password`, `doctor_tel`, `specialties`) VALUES
(3, 'toni_hristova@ehospital.bg', 'Antoaneta Hristova', '145641634', '0981116721', 16);
INSERT INTO `doctor` (`doctor_id`, `doctor_email`, `doctor_name`, `doctor_password`, `doctor_tel`, `specialties`) VALUES
(4, 'dobrin_ignatov@ehospital.bg', 'Dobrin Ignatov', '456213453', '0876789090', 14);

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

INSERT INTO `patient` (`patient_id`, `patient_email`, `patient_name`, `patient_password`, `patient_city`, `patient_egn`, `patient_dob`, `patient_tel`) VALUES
(1, 'ivan.ivanov@gmail.com', 'Ivan Ivanov', '1234', 'Varna', '0034318885', '2000-05-08', '0894563133'),
(7, 'georgi.georgiev@gmail.com', 'Georgi Georgiev', '094151', 'Varna', '0033318885', '2000-07-31', '0884563133')

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
(1, '1', 'Health Promotion and Prevention', '0000-00-00', '14:25:00', 50),
(2, '2', 'Outpatient Examination', '2023-05-22', '16:45:00', 1),
(3, '3', 'Screening for Patients with Chronic Diseases', '2023-05-28', '13:30:00', 1),
(4, '4', 'Healthy Lifestyle and Nutrition', '2023-06-15', '12:00:00', 1);

-- --------------------------------------------------------


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
  CONSTRAINT `fk_prescriptions_patient` FOREIGN KEY (`patient_id`) REFERENCES `patient` (`patient_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_prescriptions_diagnoses` FOREIGN KEY (`diagnosis_id`) REFERENCES `diagnoses` (`diagnosis_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_prescriptions_medications` FOREIGN KEY (`medication_id`) REFERENCES `medications` (`medication_id`) ON DELETE CASCADE,
  CONSTRAINT `fk_prescriptions_doctor` FOREIGN KEY (`doctor_id`) REFERENCES `doctor` (`doctor_id`) ON DELETE CASCADE
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
-- Dumping data for table `medications`
--

INSERT INTO `medications` (`medication_id`, `medication_name`) VALUES
(1, 'Aspirin'),
(2, 'Ibuprofen'),
(3, 'Paracetamol'),
(4, 'Nurofen'),
(5, 'Diclofenac'),
(6, 'Amoxicillin Antibiotic'),
(7, 'Losartan Blood Pressure Medication'),
(8, 'Metformin Diabetes Medication'),
(9, 'Cetirizine Allergy Medication'),
(10, 'Heparin');

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
-- Dumping data for table `diagnoses`
--

INSERT INTO `diagnoses` (`diagnosis_id`, `diagnosis_name`) VALUES
(1, 'I11.9 Essential (primary) hypertension'),
(2, 'E11.9 Type 2 diabetes mellitus without complications'),
(3, 'J45.0 Predominantly allergic asthma'),
(4, 'I20.8 Other forms of angina pectoris'),
(5, 'D69.3 Idiopathic thrombocytopenic purpura'),
(6, 'T78.4 Allergy, unspecified'),
(7, 'I69.3 Sequelae of cerebral infarction'),
(8, 'B34.9 Viral infection, unspecified'),
(9, 'D50.8 Other iron deficiency anemias'),
(10, 'M06.9 Rheumatoid arthritis, unspecified');


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
(1, 'Obstetrics and Gynecology'),
(2, 'Allergy and Immunology'),
(3, 'Gastroenterology'),
(4, 'Dermatology and Venereology'),
(5, 'Endocrinology and Metabolism'),
(6, 'Internal Medicine'),
(7, 'Infectious Diseases'),
(8, 'Cardiology'),
(9, 'Clinical Laboratory'),
(10, 'Neurology'),
(12, 'Medical Oncology'),
(17, 'Pediatrics'),
(22, 'Urology'),
(24, 'Clinical Hematology'),
(25, 'Surgery'),
(41, 'Microbiology');

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

-- --------------------------------------------------------

--
-- Table structure for table `reviews`
--

-- DROP TABLE IF EXISTS `reviews`;
-- CREATE TABLE IF NOT EXISTS `reviews` (
--   `review_id` int(11) NOT NULL AUTO_INCREMENT,
--   `patient_id` int(11) NOT NULL,
--   `doctor_id` int(11) NOT NULL,
--   `content` text NOT NULL,
--   `rating` tinyint(1) NOT NULL,
--   `submit_date` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
--   PRIMARY KEY(`review_id`),
--   FOREIGN KEY(`patient_id`) REFERENCES `patient`(`patient_id`) ON DELETE CASCADE ON UPDATE CASCADE,
--   FOREIGN KEY(`doctor_id`) REFERENCES `doctor`(`doctor_id`) ON DELETE CASCADE ON UPDATE CASCADE
-- ) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8;

