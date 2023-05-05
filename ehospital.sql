SET NAMES utf8mb4;
SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = '+02:00';

USE ehospital;

--
-- Database: `ehospital`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

DROP TABLE IF EXISTS `admin`;
CREATE TABLE IF NOT EXISTS `admin` (
  `admin_email` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci NOT NULL,
  `admin_password` varchar(255) CHARACTER SET utf8mb4 COLLATE utf8mb4_general_ci DEFAULT NULL,
  PRIMARY KEY (`admin_email`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

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

-- INSERT INTO `appointment` (`appointment_id`, `patient_id`, `appointment_num`, `schedule_id`, `appointment_date`) VALUES
-- (1, 1, 1, 1, '20-03-2023');

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
(1, 'velislav_stoyanov@ehospital.bg', 'Велислав Стоянов Кард.', '111654161', '0898314551', 8),
(2, 'veselin_mladenov@ehospital.bg', 'Веселин Младенов ДБ', '651145611', '0874117654', 17),
(3, 'toni_hristova@ehospital.bg', 'Антоанета Христова АГ', '145641634', '0981116721', 1),
(4, 'dobrin_ignatov@ehospital.bg', 'Добрин Игнатов ВБ', '456213453', '0876789090', 6),
(5, 'petar.petrov@ehospital.bg', 'Петър Петров ХБ', '9878554', '0873413131', 25),
(6, 'mariya.stoyanova@ehospital.bg', 'Марияна Стоянова Инф.Б', '12589175', '0893413155', 7);

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
(1, 'ivan.ivanov@gmail.com', 'Иван Иванов', '1234', 'Варна', '0034318885', '2000-05-08', '0894563133'),
(7, 'georgi.georgiev@gmail.com', 'Георги Георгиев', '094151', 'Варна', '0033318885', '2000-07-31', '0884563133');


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
(1, '1', 'Промоция и профилактика на здравето', '0000-00-00', '14:25:00', 50),
(2, '2', 'Амбулаторен преглед', '2023-05-22', '16:45:00', 1),
(3, '3', 'Диспансеризация на пациенти с хронични заболявания', '2023-05-28', '13:30:00', 1),
(4, '4', 'Здравословен начин на живот и хранене', '2023-06-15', '12:00:00', 1);

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
-- Dumping data for table `diagnoses`
--

INSERT INTO `diagnoses` (`diagnosis_id`, `diagnosis_name`) VALUES
(1, 'I11.9 Артериална хипертония без СН'),
(2, 'E11.9 Неинсулинозависим захарен диабет БДУ'),
(3, 'J45.0 Бронхиална астма'),
(4, 'I20.8 Друга исхемична болест на сърцето'),
(5, 'D69.3 Идиопатична тромбоцитопенична пурпура'),
(6, 'T78.4 Алергия, неуточнена'),
(7, 'I69.3 Последици от мозъчно съдова болест'),
(8, 'B34.9 Остра вирусна инфекция, неуточнена'),
(9, 'D50.8 Друга желязодефицитна анемия '),
(10, 'M06.9 Ревматоиден артрит, неуточнен');


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
('dobrin_ignatov@ehospital.bg', 'd'),
('doctor@ehospital.bg', 'd'),
('georgi.georgiev@gmail.com', 'p'),
('ivan.ivanov@gmail.com', 'p'),
('patient@ehospital.bg', 'p'),
('toni_hristova@ehospital.bg', 'd'),
('velislav_stoyanov@ehospital.bg', 'd'),
('veselin_mladenov@ehospital.bg', 'd'),
('mariya.stoyanova@ehospital.bg', 'd'),
('petar.petrov@ehospital.bg', 'd');
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

