-- phpMyAdmin SQL Dump
-- version 4.9.5deb2
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 24, 2020 at 07:50 AM
-- Server version: 8.0.22-0ubuntu0.20.04.3
-- PHP Version: 7.4.13

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `hospitaldev`
--

-- --------------------------------------------------------

--
-- Table structure for table `bed_group`
--

CREATE TABLE `bed_group` (
  `id` int NOT NULL,
  `description` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bed_group`
--

INSERT INTO `bed_group` (`id`, `description`) VALUES
(3, 'AC'),
(4, 'Non AC');

-- --------------------------------------------------------

--
-- Table structure for table `bed_information`
--

CREATE TABLE `bed_information` (
  `id` int NOT NULL,
  `bed_no` varchar(45) DEFAULT NULL,
  `description` varchar(45) DEFAULT NULL,
  `bed_group_id` int NOT NULL,
  `floor_information_id` int NOT NULL,
  `charge` double DEFAULT NULL,
  `bed_active_status` int DEFAULT NULL,
  `valid` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `bed_information`
--

INSERT INTO `bed_information` (`id`, `bed_no`, `description`, `bed_group_id`, `floor_information_id`, `charge`, `bed_active_status`, `valid`) VALUES
(1, '101', 'Normal Bed test', 4, 1, 800, 1, 1),
(2, '202', 'Luxury Flooring', 4, 2, 1000000, 1, 1),
(3, '201', 'Normal Bed', 3, 2, 1000000, 1, 1),
(4, '201', 'OMG', 3, 2, 1000000, 1, 1),
(5, '202', 'Normal Bed', 4, 2, 300, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `companyinfo`
--

CREATE TABLE `companyinfo` (
  `id` int NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `email` varchar(45) DEFAULT NULL,
  `dayend` date DEFAULT NULL,
  `integrated_accounts` tinyint(1) DEFAULT NULL,
  `financial_year_start` date DEFAULT NULL,
  `financial_year_end` date DEFAULT NULL,
  `cash_account_code` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `department`
--

CREATE TABLE `department` (
  `id` int NOT NULL,
  `departmentname` varchar(45) DEFAULT NULL,
  `description` text,
  `type` varchar(45) DEFAULT NULL,
  `investigationType_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `department`
--

INSERT INTO `department` (`id`, `departmentname`, `description`, `type`, `investigationType_id`) VALUES
(9, 'Pathology', 'Pathology', '1', 1),
(11, 'ECG', 'ECG', '2', 2),
(12, 'ECHO', 'ECHO', '3', 2),
(13, 'USG', 'USG', '4', 2),
(15, 'X-Ray', 'X-Ray', '5', 2),
(17, 'OTHERS', 'OTHERS', '6', 1);

-- --------------------------------------------------------

--
-- Table structure for table `details`
--

CREATE TABLE `details` (
  `id` int NOT NULL,
  `investigation_id` int NOT NULL,
  `invoice_master_id` int NOT NULL,
  `quantity` float DEFAULT NULL,
  `price` float DEFAULT NULL,
  `delivery_date` date DEFAULT NULL,
  `delivery_status` tinyint(1) DEFAULT NULL,
  `doctors_id` int NOT NULL,
  `refferal_amount` float DEFAULT NULL,
  `valid` int DEFAULT NULL,
  `item_status` int DEFAULT NULL COMMENT '1 for sales\n0 for return\n',
  `less_amount` float DEFAULT NULL,
  `less_from` int DEFAULT NULL COMMENT '0 for Company\n1 for Both\n2 for Doctor	'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `details`
--

INSERT INTO `details` (`id`, `investigation_id`, `invoice_master_id`, `quantity`, `price`, `delivery_date`, `delivery_status`, `doctors_id`, `refferal_amount`, `valid`, `item_status`, `less_amount`, `less_from`) VALUES
(66, 406, 46, 1, 300, NULL, 0, 6, 150, 1, 1, 15, 1),
(67, 460, 46, 1, 400, NULL, 0, 6, 200, 1, 1, 20, 1),
(68, 468, 46, 1, 300, NULL, 0, 6, 150, 1, 1, 15, 1),
(69, 712, 46, 1, 500, NULL, 0, 6, 100, 1, 1, 25, 1),
(70, 684, 46, 1, 1000, NULL, 0, 6, 300, 1, 1, 50, 1),
(71, 674, 46, 1, 250, NULL, 0, 6, 75, 1, 1, 12.5, 1),
(72, 426, 46, 1, 2000, NULL, 0, 6, 400, 1, 1, 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `doctors`
--

CREATE TABLE `doctors` (
  `id` int NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `address` text,
  `email` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `doctor_status` tinyint(1) DEFAULT NULL COMMENT 'indoor/outdoor',
  `reference_status` tinyint(1) DEFAULT NULL COMMENT 'commision',
  `gender` varchar(45) DEFAULT NULL,
  `married` tinyint(1) DEFAULT NULL,
  `dob` datetime DEFAULT NULL,
  `consultation_fee` double DEFAULT NULL,
  `department_id` int NOT NULL,
  `doctor_degree` varchar(100) DEFAULT NULL,
  `bloodgroup` varchar(5) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctors`
--

INSERT INTO `doctors` (`id`, `name`, `address`, `email`, `phone`, `doctor_status`, `reference_status`, `gender`, `married`, `dob`, `consultation_fee`, `department_id`, `doctor_degree`, `bloodgroup`) VALUES
(10, 'T.M. Estiaq Zaman', '180/8 Shantiniketon Abashik, Road no 2, Tejgaon, Dhaka', 'tezalve@gmail.com', '01771732606', 0, 1, 'm', 1, '1995-01-01 00:00:00', 2000, 15, 'MBBS, MD, FCPS', ''),
(11, 'Alucard', 'Dracula\'s Castle', 'aluforever@gmail.com', '666666666666', 1, 0, 'm', 0, '1997-10-21 00:00:00', 2000000, 17, 'MBBS', ''),
(12, 'asdfg', 'asdf', 'asdasd@asd.com', '112345', 0, 1, 'm', 1, '1955-05-01 00:00:00', 5000, 12, 'asdff', 'A+');

-- --------------------------------------------------------

--
-- Table structure for table `doctors_ledger`
--

CREATE TABLE `doctors_ledger` (
  `id` int NOT NULL,
  `doctors_id` int NOT NULL,
  `invoice_master_id` int NOT NULL,
  `tr_date` date DEFAULT NULL,
  `entry_type` int DEFAULT NULL COMMENT '1 for invoice\n2 for due collection\n3 for payment',
  `doctor_commision` float DEFAULT NULL,
  `less_amount` float DEFAULT NULL,
  `invoice_less` float DEFAULT NULL,
  `valid` int DEFAULT NULL,
  `doctor_payment` float DEFAULT NULL,
  `return_commision` float DEFAULT NULL,
  `invoice_return_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `doctors_ledger`
--

INSERT INTO `doctors_ledger` (`id`, `doctors_id`, `invoice_master_id`, `tr_date`, `entry_type`, `doctor_commision`, `less_amount`, `invoice_less`, `valid`, `doctor_payment`, `return_commision`, `invoice_return_id`) VALUES
(20, 6, 46, '2015-12-25', 1, 1375, 118.75, 237.5, 1, 0, 0, NULL);

-- --------------------------------------------------------

--
-- Stand-in structure for view `doctor_com`
-- (See below for the actual view)
--
CREATE TABLE `doctor_com` (
`id` int
,`investigation_id` int
,`investigation_name` text
,`Pathology` float
,`ECG` float
,`ECHO` float
,`USG` float
,`XRay` float
,`OTHERS` float
);

-- --------------------------------------------------------

--
-- Table structure for table `duecollection`
--

CREATE TABLE `duecollection` (
  `id` int NOT NULL,
  `collection_amount` double DEFAULT NULL,
  `valid` int DEFAULT NULL,
  `trdate` date DEFAULT NULL,
  `invoice_ledger_id` int NOT NULL,
  `invoice_master_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `employee_info`
--

CREATE TABLE `employee_info` (
  `id` int NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `address` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `failed_jobs`
--

CREATE TABLE `failed_jobs` (
  `id` bigint UNSIGNED NOT NULL,
  `uuid` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `connection` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `queue` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `payload` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `exception` longtext COLLATE utf8mb4_unicode_ci NOT NULL,
  `failed_at` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `floor_information`
--

CREATE TABLE `floor_information` (
  `id` int NOT NULL,
  `description` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `floor_information`
--

INSERT INTO `floor_information` (`id`, `description`) VALUES
(1, '1 st'),
(2, '2 nd');

-- --------------------------------------------------------

--
-- Table structure for table `groups`
--

CREATE TABLE `groups` (
  `id` int UNSIGNED NOT NULL,
  `name` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci NOT NULL,
  `permissions` text CHARACTER SET utf8 COLLATE utf8_unicode_ci
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `groups`
--

INSERT INTO `groups` (`id`, `name`, `permissions`) VALUES
(24, 'Users', NULL),
(25, 'Admins', '{\"patients.index\":1}');

-- --------------------------------------------------------

--
-- Table structure for table `investigation`
--

CREATE TABLE `investigation` (
  `id` int NOT NULL,
  `name` text,
  `price` double DEFAULT NULL,
  `refferal_fee` double DEFAULT NULL,
  `refferal_type` text,
  `extra_charge` tinyint(1) DEFAULT NULL,
  `department_id` int NOT NULL,
  `code` varchar(10) DEFAULT NULL,
  `sub_department` int NOT NULL,
  `edit_status` int DEFAULT NULL COMMENT '1 for edit\n2 for edit false',
  `doctor_status` int DEFAULT NULL COMMENT '1 for doctore\n2 for none doctore',
  `unit_info_id` int NOT NULL,
  `investigation_group` int DEFAULT NULL COMMENT '1 for Investigation\n2 for Clinicalchart'
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `investigation`
--

INSERT INTO `investigation` (`id`, `name`, `price`, `refferal_fee`, `refferal_type`, `extra_charge`, `department_id`, `code`, `sub_department`, `edit_status`, `doctor_status`, `unit_info_id`, `investigation_group`) VALUES
(406, 'TC DC Hb% ESR (CBC)', 300, 50, '0', 0, 9, '1101', 16, 2, 2, 1, 1),
(407, 'TC', 100, 50, '0', 0, 9, '1102', 0, 2, 2, 1, 1),
(408, 'DC', 100, 50, '0', 0, 9, '1103', 0, 2, 2, 1, 1),
(409, 'Hb%', 100, 50, '0', 0, 9, '1104', 0, 2, 2, 1, 1),
(410, 'ESR', 100, 50, '0', 0, 9, '1105', 0, 2, 2, 1, 1),
(411, 'PCV /HCT', 250, 50, '0', 0, 9, '1106', 0, 2, 2, 1, 1),
(412, 'MCV', 250, 50, '0', 0, 9, '1107', 0, 2, 2, 1, 1),
(413, 'MCH', 250, 50, '0', 0, 9, '1108', 0, 2, 2, 1, 1),
(414, 'MCHC', 250, 50, '0', 0, 9, '1109', 0, 2, 2, 1, 1),
(415, 'RDW', 250, 50, '0', 0, 9, '1110', 0, 2, 2, 1, 1),
(416, 'PDW', 250, 50, '0', 0, 9, '1111', 0, 2, 2, 1, 1),
(417, 'TCE (Total Circulating Eosinophils)', 200, 50, '0', 0, 9, '1112', 0, 2, 2, 1, 1),
(418, 'Different Count', 300, 50, '0', 0, 9, '1113', 0, 2, 2, 1, 1),
(419, 'Reticulocytes Count', 300, 50, '0', 0, 9, '1114', 0, 2, 2, 1, 1),
(420, 'Total Platelet Count', 200, 50, '0', 0, 9, '1115', 0, 2, 2, 1, 1),
(421, 'MPV', 300, 50, '0', 0, 9, '1116', 0, 2, 2, 1, 1),
(422, 'MP ( Malarial Parasite)', 200, 50, '0', 0, 9, '1117', 0, 2, 2, 1, 1),
(423, 'Bleeding Time (BT)', 200, 50, '0', 0, 9, '1118', 0, 2, 2, 1, 1),
(424, 'Coagulation Time (CT)', 200, 50, '0', 0, 9, '1119', 0, 2, 2, 1, 1),
(425, 'Blood film', 200, 50, '0', 0, 9, '1120', 0, 2, 2, 1, 1),
(426, 'Bone Marrow Study & Collection Charge', 2000, 20, '0', 0, 9, '1121', 0, 2, 2, 1, 1),
(427, 'Blood Group & Rh Factor', 80, 50, '0', 0, 9, '1122', 0, 2, 2, 1, 1),
(428, 'BT CT', 200, 50, '0', 0, 9, '1123', 0, 2, 2, 1, 1),
(429, 'El', 800, 50, '0', 0, 9, '1124', 0, 2, 2, 1, 1),
(430, 'Plasma', 600, 50, '0', 0, 9, '1125', 0, 2, 2, 1, 1),
(431, 'Personal', 200, 50, '0', 0, 9, '1126', 0, 2, 2, 1, 1),
(432, 'pa', 800, 50, '0', 0, 9, '1127', 0, 2, 2, 1, 1),
(433, 'rrr', 100, 50, '0', 0, 9, '1128', 0, 2, 2, 1, 1),
(434, 'm', 250, 50, '0', 0, 9, '1129', 0, 2, 2, 1, 1),
(435, 'F', 900, 50, '0', 0, 9, '1130', 0, 2, 2, 1, 1),
(436, 'Fasting  Blood Sugar (FBS)', 100, 50, '0', 0, 9, '1201', 0, 2, 2, 1, 1),
(437, 'Blood Sugar 2 hrs ABF', 100, 50, '0', 0, 9, '1202', 0, 2, 2, 1, 1),
(438, 'Blood Suger 2 hrs After 75 Gm Glucose', 100, 50, '0', 0, 9, '1203', 0, 2, 2, 1, 1),
(439, 'Random Blood Suger ( RBS )', 100, 50, '0', 0, 9, '1204', 0, 2, 2, 1, 1),
(440, 'Blood Suger Before Lunch + CUS', 100, 50, '0', 0, 9, '1205', 0, 2, 2, 1, 1),
(441, 'Blood Suger 2 hrs After Lunch + CUS', 100, 50, '0', 0, 9, '1206', 0, 2, 2, 1, 1),
(442, 'Blood Suger Before Dinner + CUS', 100, 50, '0', 0, 9, '1207', 0, 2, 2, 1, 1),
(443, 'Blood Suger 2 hrs After Dinner + CUS', 100, 50, '0', 0, 9, '1208', 0, 2, 2, 1, 1),
(444, 'GTT 3 Sample', 400, 50, '0', 0, 9, '1209', 0, 2, 2, 1, 1),
(445, 'Bilirubin Total', 100, 50, '0', 0, 9, '1210', 0, 2, 2, 1, 1),
(446, 'SGPT ( ALT)', 200, 50, '0', 0, 9, '1211', 0, 2, 2, 1, 1),
(447, 'SGOT (AST)', 200, 50, '0', 0, 9, '1212', 0, 2, 2, 1, 1),
(448, 'Serun Alkaline Phosphatase', 200, 50, '0', 0, 9, '1213', 0, 2, 2, 1, 1),
(449, 'Serum LFT', 900, 50, '0', 0, 9, '1214', 0, 2, 2, 1, 1),
(450, 'Serum Urea', 250, 50, '0', 0, 9, '1215', 0, 2, 2, 1, 1),
(451, 'Serum Creatinine', 200, 50, '0', 0, 9, '1216', 0, 2, 2, 1, 1),
(452, 'CCR (Creatinine Clearancr Rate 24 Hrs)', 800, 50, '0', 0, 9, '1217', 0, 2, 2, 1, 1),
(453, 'TG', 200, 50, '0', 0, 9, '1218', 0, 2, 2, 1, 1),
(454, 'Serum Uric Acid', 200, 50, '0', 0, 9, '1219', 0, 2, 2, 1, 1),
(455, 'Serum Calcium', 200, 50, '0', 0, 9, '1220', 0, 2, 2, 1, 1),
(456, 'Serum Amylase', 800, 50, '0', 0, 9, '1221', 0, 2, 2, 1, 1),
(457, 'Serum Lipase', 900, 50, '0', 0, 9, '1222', 0, 2, 2, 1, 1),
(458, 'Proteine Total', 400, 50, '0', 0, 9, '1223', 0, 2, 2, 1, 1),
(459, 'Serum Albumin', 350, 50, '0', 0, 9, '1224', 0, 2, 2, 1, 1),
(460, 'Serun Globulin', 400, 50, '0', 0, 9, '1225', 0, 2, 2, 1, 1),
(461, 'A/G Rato', 400, 50, '0', 0, 9, '1226', 0, 2, 2, 1, 1),
(462, 'Inorganic Phosphatase ( Po4)', 350, 50, '0', 0, 9, '1227', 0, 2, 2, 1, 1),
(463, 'Lipid Profile Fasting', 900, 50, '0', 0, 9, '1228', 0, 2, 2, 1, 1),
(464, 'Cholesterol Total', 200, 50, '0', 0, 9, '1229', 0, 2, 2, 1, 1),
(465, 'HDL - Cholesterol', 200, 50, '0', 0, 9, '1230', 0, 2, 2, 1, 1),
(466, 'LDL - Cholesterol', 200, 50, '0', 0, 9, '1231', 0, 2, 2, 1, 1),
(467, 'Serum Triglyceides', 300, 50, '0', 0, 9, '1232', 0, 2, 2, 1, 1),
(468, 'Bilirubin Direct & Indirect', 300, 50, '0', 0, 9, '1233', 0, 2, 2, 1, 1),
(469, 'Prothrombin Time', 500, 50, '0', 0, 9, '1234', 0, 2, 2, 1, 1),
(470, 'APTT', 800, 50, '0', 0, 9, '1235', 0, 2, 2, 1, 1),
(471, 'FDP', 1200, 50, '0', 0, 9, '1236', 0, 2, 2, 1, 1),
(472, 'S. Electrolyties', 650, 50, '0', 0, 9, '1237', 0, 2, 2, 1, 1),
(473, 'CPK', 800, 50, '0', 0, 9, '1238', 0, 2, 2, 1, 1),
(474, 'CK-MB', 800, 50, '0', 0, 9, '1239', 0, 2, 2, 1, 1),
(475, 'Lithium', 800, 50, '0', 0, 9, '1240', 0, 2, 2, 1, 1),
(476, 'LDH', 700, 50, '0', 0, 9, '1241', 0, 2, 2, 1, 1),
(477, 'Iron', 800, 50, '0', 0, 9, '1242', 0, 2, 2, 1, 1),
(478, 'T.I.B.C.', 800, 40, '0', 0, 9, '1243', 0, 2, 2, 1, 1),
(479, 'HbA1c', 900, 50, '0', 0, 9, '1244', 0, 2, 2, 1, 1),
(480, 'Protein Creatinine Ratio', 700, 50, '0', 0, 9, '1245', 0, 2, 2, 1, 1),
(481, 'Magnesium', 1000, 50, '0', 0, 9, '1246', 0, 2, 2, 1, 1),
(482, 'min', 400, 50, '0', 0, 9, '1248', 0, 2, 2, 1, 1),
(483, '2hrs AFB', 100, 50, '0', 0, 9, '1249', 0, 2, 2, 1, 1),
(484, '2hrs After Lunch', 100, 50, '0', 0, 9, '1250', 0, 2, 2, 1, 1),
(485, '2hrs After Dinner', 100, 50, '0', 0, 9, '1251', 0, 2, 2, 1, 1),
(486, 'ASO Titre', 300, 50, '0', 0, 9, '1301', 0, 2, 2, 1, 1),
(487, 'RA Test', 200, 50, '0', 0, 9, '1302', 0, 2, 2, 1, 1),
(488, 'CRP Latex', 300, 50, '0', 0, 9, '1303', 0, 2, 2, 1, 1),
(489, 'Widal Test', 300, 50, '0', 0, 9, '1304', 0, 2, 2, 1, 1),
(490, 'Blood Group & Rh Factor', 120, 50, '0', 0, 9, '1305', 0, 2, 2, 1, 1),
(491, 'VDRL', 200, 50, '0', 0, 9, '1306', 0, 2, 2, 1, 1),
(492, 'TPHA', 400, 50, '0', 0, 9, '1307', 0, 2, 2, 1, 1),
(493, 'VDRL Quantitative', 500, 50, '0', 0, 9, '1308', 0, 2, 2, 1, 1),
(494, 'C - Reactive Protein ( CRP)', 800, 50, '0', 0, 9, '1309', 0, 2, 2, 1, 1),
(495, 'Febrile Antigen', 800, 50, '0', 0, 9, '1310', 0, 2, 2, 1, 1),
(496, 'MT (Tuberculin Test ( O.1ml = 10 TU)', 300, 50, '0', 0, 9, '1311', 0, 2, 2, 1, 1),
(497, 'TPHA Quantitative', 500, 50, '0', 0, 9, '1312', 0, 2, 2, 1, 1),
(498, 'Serun Alkaline Phosphatase', 300, 50, '0', 0, 9, '1313', 0, 2, 2, 1, 1),
(499, 'HbsAg (Screening)', 500, 50, '0', 0, 9, '1314', 0, 2, 2, 1, 1),
(500, 'ELISA Test For Anti - ds DNA', 1400, 50, '0', 0, 9, '1315', 0, 2, 2, 1, 1),
(501, 'Rose Waller Test', 350, 50, '0', 0, 9, '1316', 0, 2, 2, 1, 1),
(502, 'ICT for Malaria ( p.f/p.v)', 500, 50, '0', 0, 9, '1317', 0, 2, 2, 1, 1),
(503, 'ICT for Filaria', 500, 50, '0', 0, 9, '1318', 0, 2, 2, 1, 1),
(504, 'ICT for Kala-Azar', 500, 50, '0', 0, 9, '1319', 0, 2, 2, 1, 1),
(505, 'ICT for Dengue Virus IgG & IgM', 1000, 50, '0', 0, 9, '1320', 0, 2, 2, 1, 1),
(506, 'ICT for Tuberculin', 900, 50, '0', 0, 9, '1321', 0, 2, 2, 1, 1),
(507, 'TPHA Quantitative', 500, 50, '0', 0, 9, '1322', 0, 2, 2, 1, 1),
(508, 'Complement 3 (C3)', 1000, 50, '0', 0, 9, '1323', 0, 2, 2, 1, 1),
(509, 'Complement 4 (C4)', 1000, 50, '0', 0, 9, '1324', 0, 2, 2, 1, 1),
(510, 'Anti TB IgG', 1000, 50, '0', 0, 9, '1325', 0, 2, 2, 1, 1),
(511, 'Anti TB IgM', 1000, 50, '0', 0, 9, '1326', 0, 2, 2, 1, 1),
(512, 'Anti TB IgA', 1000, 50, '0', 0, 9, '1327', 0, 2, 2, 1, 1),
(513, 'IgG', 700, 50, '0', 0, 9, '1328', 0, 2, 2, 1, 1),
(514, 'IgM', 700, 50, '0', 0, 9, '1329', 0, 2, 2, 1, 1),
(515, 'IgA', 700, 50, '0', 0, 9, '1330', 0, 2, 2, 1, 1),
(516, 'IgE', 700, 50, '0', 0, 9, '1331', 0, 2, 2, 1, 1),
(517, 'Coombs Test Direct', 400, 50, '0', 0, 9, '1332', 0, 2, 2, 1, 1),
(518, 'Blood Crossmatching & Collection Charge', 200, 50, '0', 0, 9, '1333', 0, 2, 2, 1, 1),
(519, 'HBsAg ( Confirm)', 500, 50, '0', 0, 9, '1334', 0, 2, 2, 1, 1),
(520, 'VDRL ( Donner)', 100, 1, '0', 0, 9, '1335', 0, 2, 2, 1, 1),
(521, 'Anti - HIV  ( Donner)', 100, 1, '0', 0, 9, '1336', 0, 2, 2, 1, 1),
(522, 'Anti - HCV', 800, 500, '0', 0, 9, '1337', 0, 2, 2, 1, 1),
(523, 'Anti - HCV (Screening)', 800, 50, '0', 0, 9, '1338', 0, 2, 2, 1, 1),
(524, 'Anti HAV IgM', 800, 40, '0', 0, 9, '1339', 0, 2, 2, 1, 1),
(525, 'HBsAg (Elisa)', 500, 40, '0', 0, 9, '1340', 0, 2, 2, 1, 1),
(526, 'Anti HEV  IgM', 800, 400, '0', 0, 9, '1341', 0, 2, 2, 1, 1),
(527, 'HBsAge (ICT METHOD)', 500, 0, '0', 0, 9, '1342', 0, 2, 2, 1, 1),
(528, 'Blood for C/S', 600, 50, '0', 0, 9, '1401', 0, 2, 2, 1, 1),
(529, 'Sputum for AFB', 150, 50, '0', 0, 9, '1402', 0, 2, 2, 1, 1),
(530, 'Sputum for Gram Stain', 150, 50, '0', 0, 9, '1403', 0, 2, 2, 1, 1),
(531, 'Sputum for C/S', 350, 50, '0', 0, 9, '1404', 0, 2, 2, 1, 1),
(532, 'Sputum For R/E', 150, 50, '0', 0, 9, '1405', 0, 2, 2, 1, 1),
(533, 'Sputum for Maligrant Cell', 700, 50, '0', 0, 9, '1406', 0, 2, 2, 1, 1),
(534, 'Throat Swab for AFB', 150, 50, '0', 0, 9, '1407', 0, 2, 2, 1, 1),
(535, 'Throat Swab for Gram Stain', 150, 50, '0', 0, 9, '1408', 0, 2, 2, 1, 1),
(536, 'Throat Swab for C/S', 350, 50, '0', 0, 9, '1409', 0, 2, 2, 1, 1),
(537, 'Pus for AFB', 150, 50, '0', 0, 9, '1410', 0, 2, 2, 1, 1),
(538, 'Pus for Gram Stain', 200, 50, '0', 0, 9, '1411', 0, 2, 2, 1, 1),
(539, 'Pus for C/S', 350, 50, '0', 0, 9, '1412', 0, 2, 2, 1, 1),
(540, 'Urethral Semear For C/S', 350, 50, '0', 0, 9, '1413', 0, 2, 2, 1, 1),
(541, 'Urethral Smear for gram Stain', 200, 50, '0', 0, 9, '1414', 0, 2, 2, 1, 1),
(542, 'Prostatic Smear for Gram Stain', 150, 50, '0', 0, 9, '1415', 0, 2, 2, 1, 1),
(543, 'Prostatic Smear for C/S', 350, 50, '0', 0, 9, '1416', 0, 2, 2, 1, 1),
(544, 'Skin Scarping for fungus & Collection Charge', 150, 50, '0', 0, 9, '1417', 0, 2, 2, 1, 1),
(545, 'Skin Scarping for C/S', 350, 50, '0', 0, 9, '1418', 0, 2, 2, 1, 1),
(546, 'Ascitic fluid for Biochemical & Cytology', 1000, 50, '0', 0, 9, '1419', 0, 2, 2, 1, 1),
(547, 'Ascitic fluid for Total Protein', 400, 50, '0', 0, 9, '1421', 0, 2, 2, 1, 1),
(548, 'Ascitic fluid for C/S', 400, 50, '0', 0, 9, '1422', 0, 2, 2, 1, 1),
(549, 'Ascitic fluid for Maligrant cell', 700, 50, '0', 0, 9, '1423', 0, 2, 2, 1, 1),
(550, 'Pleural fluid for Biochemical & Cytology', 1000, 50, '0', 0, 9, '1424', 0, 2, 2, 1, 1),
(551, 'Pleural fluid for Total Protein', 400, 50, '0', 0, 9, '1426', 0, 2, 2, 1, 1),
(552, 'Pleural fluid for C/S', 400, 50, '0', 0, 9, '1427', 0, 2, 2, 1, 1),
(553, 'Pleural fluid for Maligrant Cell', 700, 50, '0', 0, 9, '1428', 0, 2, 2, 1, 1),
(554, 'Aspirated Pus Cytology', 1000, 50, '0', 0, 9, '1429', 0, 2, 2, 1, 1),
(555, 'Soynavail Fluid Biochemical & Cytology', 1000, 50, '0', 0, 9, '1430', 0, 2, 2, 1, 1),
(556, 'CSF Study ( Biochemical Cytology & Collection Charge', 2000, 50, '0', 0, 9, '1431', 0, 2, 2, 1, 1),
(557, 'Wound Swab for AFB', 200, 50, '0', 0, 9, '1432', 0, 2, 2, 1, 1),
(558, 'Wound Swab for Gram Stain', 200, 50, '0', 0, 9, '1433', 0, 2, 2, 1, 1),
(559, 'Wound Swab for C/S', 400, 50, '0', 0, 9, '1434', 0, 2, 2, 1, 1),
(560, 'H.V.S for R/E / Gram Stain & Collection Charge', 250, 50, '0', 0, 9, '1435', 0, 2, 2, 1, 1),
(561, 'H.V.S for  C/S', 350, 50, '0', 0, 9, '1436', 0, 2, 2, 1, 1),
(562, 'Paps Smear & Collection Charge', 700, 30, '0', 0, 9, '1437', 0, 2, 2, 1, 1),
(563, 'FNAC & Collection Charge', 1000, 20, '0', 0, 9, '1438', 0, 2, 2, 1, 1),
(564, 'Histopathology Smeall', 600, 10, '0', 0, 9, '1440', 0, 2, 2, 1, 1),
(565, 'Histopathology Medium', 1200, 10, '0', 0, 9, '1441', 0, 2, 2, 1, 1),
(566, 'Histopathology Big', 2400, 10, '0', 0, 9, '1442', 0, 2, 2, 1, 1),
(567, 'Out Sample Collection Charge', 150, 1, '0', 0, 9, '1443', 0, 2, 2, 1, 1),
(568, 'Ear Swab for AFB', 150, 50, '0', 0, 9, '1444', 0, 2, 2, 1, 1),
(569, 'Ear Swab for Gram Stain', 200, 50, '0', 0, 9, '1445', 0, 2, 2, 1, 1),
(570, 'Ear Swab for C/S Left', 400, 50, '0', 0, 9, '1446', 0, 2, 2, 1, 1),
(571, 'Ear Swab for C/S Right', 400, 50, '0', 0, 9, '1447', 0, 2, 2, 1, 1),
(572, 'Conjuctival Swab C/S', 350, 50, '0', 0, 9, '1448', 0, 2, 2, 1, 1),
(573, 'Conjuctival Swab C/S Right', 400, 50, '0', 0, 9, '1449', 0, 2, 2, 1, 1),
(574, 'TC DC Hb% ESR', 300, 50, '0', 0, 9, '1450', 0, 2, 2, 1, 1),
(575, 'TC DC Hb% ESR (Each)', 100, 0, '0', 0, 9, '1451', 0, 2, 2, 1, 1),
(576, 'Gram Stain C/S', 350, 50, '0', 0, 9, '1453', 0, 2, 2, 1, 1),
(577, 'Urine for R/ E', 100, 50, '0', 0, 9, '1501', 0, 2, 2, 1, 1),
(578, 'Urine For C/S', 350, 50, '0', 0, 9, '1502', 0, 2, 2, 1, 1),
(579, 'Urine for Pregnancy Test', 150, 50, '0', 0, 9, '1503', 0, 2, 2, 1, 1),
(580, 'Urine for Albumin', 200, 50, '0', 0, 9, '1504', 0, 2, 2, 1, 1),
(581, 'Urine for Gram Stain', 200, 50, '0', 0, 9, '1505', 0, 2, 2, 1, 1),
(582, 'Urinary Amaylase', 700, 50, '0', 0, 9, '1506', 0, 2, 2, 1, 1),
(583, 'Urine for ACR', 900, 50, '0', 0, 9, '1507', 0, 2, 2, 1, 1),
(584, 'Urinary Creatinine', 200, 50, '0', 0, 9, '1508', 0, 2, 2, 1, 1),
(585, 'Spot Urine Sodium - Na', 300, 50, '0', 0, 9, '1509', 0, 2, 2, 1, 1),
(586, 'Spot Urine Potasium - K', 300, 50, '0', 0, 9, '1510', 0, 2, 2, 1, 1),
(587, 'Spot Urine Cloride - Cl', 300, 50, '0', 0, 9, '1511', 0, 2, 2, 1, 1),
(588, 'Urine for - Sugar', 80, 50, '0', 0, 9, '1512', 0, 2, 2, 1, 1),
(589, 'Urine for Bile Salts', 150, 50, '0', 0, 9, '1513', 0, 2, 2, 1, 1),
(590, 'Urine for Bile Pigments', 150, 50, '0', 0, 9, '1514', 0, 2, 2, 1, 1),
(591, 'Urine for Urobilinogen', 150, 50, '0', 0, 9, '1515', 0, 2, 2, 1, 1),
(592, 'Urine for Ketone Bodies', 150, 50, '0', 0, 9, '1516', 0, 2, 2, 1, 1),
(593, 'Urine for Haemoglobin', 150, 50, '0', 0, 9, '1517', 0, 2, 2, 1, 1),
(594, 'Urine for Bilirubin', 200, 50, '0', 0, 9, '1518', 0, 2, 2, 1, 1),
(595, 'Urine for Specific Gravity', 200, 50, '0', 0, 9, '1519', 0, 2, 2, 1, 1),
(596, 'Urine for Micro Albumin', 900, 50, '0', 0, 9, '1520', 0, 2, 2, 1, 1),
(597, 'Total Protein', 100, 50, '0', 0, 9, '1521', 0, 2, 2, 1, 1),
(598, '24 hrs Urinary Calcium', 600, 600, '0', 0, 9, '1522', 0, 2, 2, 1, 1),
(599, '24 hrs Urinary Phosphatase', 600, 50, '0', 0, 9, '1523', 0, 2, 2, 1, 1),
(600, 'Creatinine Clearancr Rate ( CCR) 24 Hrs', 600, 50, '0', 0, 9, '1524', 0, 2, 2, 1, 1),
(601, '24 Hrs Urine Albumin', 300, 50, '0', 0, 9, '1525', 0, 2, 2, 1, 1),
(602, 'Uroflowmatery', 400, 25, '0', 0, 9, '1526', 0, 2, 2, 1, 1),
(603, 'Urine For Cretinine', 200, 50, '0', 0, 9, '1527', 0, 2, 2, 1, 1),
(604, 'N/A', 1000, 0, '0', 0, 9, '1528', 0, 2, 2, 1, 1),
(605, 'Stool for R/E', 100, 50, '0', 0, 9, '1601', 0, 2, 2, 1, 1),
(606, 'Stool for C/S', 350, 50, '0', 0, 9, '1602', 0, 2, 2, 1, 1),
(607, 'Stool for OBT', 150, 50, '0', 0, 9, '1603', 0, 2, 2, 1, 1),
(608, 'Stool for R/S', 100, 50, '0', 0, 9, '1604', 0, 2, 2, 1, 1),
(609, 'Stool for Ova Count', 100, 50, '0', 0, 9, '1605', 0, 2, 2, 1, 1),
(610, 'Stool For Occult Blood', 100, 50, '0', 0, 9, '1606', 0, 2, 2, 1, 1),
(611, 'Stool Reducing Substance', 100, 50, '0', 0, 9, '1607', 0, 2, 2, 1, 1),
(612, 'Floatation Method', 100, 50, '0', 0, 9, '1608', 0, 2, 2, 1, 1),
(613, 'Vacu Test Tube Charge K3', 20, 1, '0', 0, 9, '1701', 0, 2, 2, 1, 1),
(614, 'Vacu Test Tube Charge Clot', 20, 1, '0', 0, 9, '1702', 0, 2, 2, 1, 1),
(615, 'Vacu Test Tube Charge P.Time (TSC)', 20, 1, '0', 0, 9, '1703', 0, 2, 2, 1, 1),
(616, 'Vacu Test Tube Charge Electrolytes ( Lithium Heparin)', 20, 1, '0', 0, 9, '1705', 0, 2, 2, 1, 1),
(617, 'Vacu Test Tube Charge HbAIc ( K3)', 20, 1, '0', 0, 9, '1706', 0, 2, 2, 1, 1),
(618, 'Out Sample Collection Charge', 150, 1, '0', 0, 9, '1707', 0, 2, 2, 1, 1),
(619, 'Vacu test tube Charge 2 time', 40, 1, '0', 0, 9, '1708', 0, 2, 2, 1, 1),
(620, 'F', 500, 25, '0', 0, 9, '1709', 0, 2, 2, 1, 1),
(621, 'A', 500, 25, '0', 0, 9, '1710', 0, 2, 2, 1, 1),
(622, 'Vaccut-1', 25, 0, '0', 0, 9, '1901', 0, 2, 2, 1, 1),
(623, 'T3', 700, 40, '0', 0, 9, '2101', 0, 2, 2, 1, 1),
(624, 'T4', 700, 40, '0', 0, 9, '2102', 0, 2, 2, 1, 1),
(625, 'TSH', 700, 45, '0', 0, 9, '2103', 0, 2, 2, 1, 1),
(626, 'FT3', 900, 40, '0', 0, 9, '2104', 0, 2, 2, 1, 1),
(627, 'FT4', 900, 40, '0', 0, 9, '2105', 0, 2, 2, 1, 1),
(628, 'Prolactin', 900, 40, '0', 0, 9, '2106', 0, 2, 2, 1, 1),
(629, 'Testosterone', 900, 40, '0', 0, 9, '2107', 0, 2, 2, 1, 1),
(630, 'LH', 900, 40, '0', 0, 9, '2108', 0, 2, 2, 1, 1),
(631, 'FSH', 900, 40, '0', 0, 9, '2109', 0, 2, 2, 1, 1),
(632, 'Oestrogen', 1000, 40, '0', 0, 9, '2110', 0, 2, 2, 1, 1),
(633, 'Progesterone', 1000, 40, '0', 0, 9, '2111', 0, 2, 2, 1, 1),
(634, 'Immunoglobulin E ( IgE)', 900, 40, '0', 0, 9, '2112', 0, 2, 2, 1, 1),
(635, 'Anti HBs', 1000, 40, '0', 0, 9, '2114', 0, 2, 2, 1, 1),
(636, 'HBeAg Elisa', 1000, 40, '0', 0, 9, '2115', 0, 2, 2, 1, 1),
(637, 'Anti  HBe', 900, 40, '0', 0, 9, '2116', 0, 2, 2, 1, 1),
(638, 'Anti HBc', 1000, 40, '0', 0, 9, '2117', 0, 2, 2, 1, 1),
(639, 'Anti  HBc  IgM', 1000, 40, '0', 0, 9, '2118', 0, 2, 2, 1, 1),
(640, 'Anti  HCV', 900, 40, '0', 0, 9, '2119', 0, 2, 2, 1, 1),
(641, 'B- HCG', 900, 40, '0', 0, 9, '2122', 0, 2, 2, 1, 1),
(642, 'CEA', 1000, 40, '0', 0, 9, '2123', 0, 2, 2, 1, 1),
(643, 'Alpha Feto Protein', 1000, 40, '0', 0, 9, '2124', 0, 2, 2, 1, 1),
(644, 'PSA', 800, 40, '0', 0, 9, '2125', 0, 2, 2, 1, 1),
(645, 'Ferritin', 1000, 40, '0', 0, 9, '2126', 0, 2, 2, 1, 1),
(646, 'Toxo - IgG', 1000, 40, '0', 0, 9, '2127', 0, 2, 2, 1, 1),
(647, 'Toxo - IgM', 1000, 40, '0', 0, 9, '2128', 0, 2, 2, 1, 1),
(648, 'Rubella - IgG', 1000, 40, '0', 0, 9, '2129', 0, 2, 2, 1, 1),
(649, 'Rubella - IgM', 1000, 40, '0', 0, 9, '2130', 0, 2, 2, 1, 1),
(650, 'CMV - IgG', 1000, 40, '0', 0, 9, '2131', 0, 2, 2, 1, 1),
(651, 'CMV - IgM', 1000, 40, '0', 0, 9, '2132', 0, 2, 2, 1, 1),
(652, 'Anti  CCP', 1800, 40, '0', 0, 9, '2133', 0, 2, 2, 1, 1),
(653, 'Anti  HIV 1+2', 900, 40, '0', 0, 9, '2134', 0, 2, 2, 1, 1),
(654, 'HSV 1& 2 - IgG', 1000, 40, '0', 0, 9, '2135', 0, 2, 2, 1, 1),
(655, 'HSV 1& 2 - IgM', 1000, 40, '0', 0, 9, '2136', 0, 2, 2, 1, 1),
(656, 'H', 900, 40, '0', 0, 9, '2137', 0, 2, 2, 1, 1),
(657, 'H.Pylori - IgG', 900, 40, '0', 0, 9, '2138', 0, 2, 2, 1, 1),
(658, 'Cortisol ( Morning)', 1000, 40, '0', 0, 9, '2139', 0, 2, 2, 1, 1),
(659, 'Cortisol ( Evening)', 1000, 40, '0', 0, 9, '2140', 0, 2, 2, 1, 1),
(660, 'Cardiac Troponin l', 1000, 40, '0', 0, 9, '2141', 0, 2, 2, 1, 1),
(661, 'Free PSA', 1000, 40, '0', 0, 9, '2142', 0, 2, 2, 1, 1),
(662, 'Vitamin B - 12', 2200, 40, '0', 0, 9, '2143', 0, 2, 2, 1, 1),
(663, 'CA 125', 1000, 40, '0', 0, 9, '2144', 0, 2, 2, 1, 1),
(664, 'CA 15 -3', 1000, 40, '0', 0, 9, '2145', 0, 2, 2, 1, 1),
(665, 'CA 19-9', 1000, 40, '0', 0, 9, '2146', 0, 2, 2, 1, 1),
(666, 'mic', 900, 40, '0', 0, 9, '2147', 0, 2, 2, 1, 1),
(667, 'Hb Electrophoresis', 1000, 40, '0', 0, 9, '2148', 0, 2, 2, 1, 1),
(668, 'Protein Electrophoresis', 1000, 40, '0', 0, 9, '2149', 0, 2, 2, 1, 1),
(669, 'Anti - TG Ab', 1000, 40, '0', 0, 9, '2151', 0, 2, 2, 1, 1),
(670, 'Anti- TPO Ab', 1000, 40, '0', 0, 9, '2152', 0, 2, 2, 1, 1),
(671, 'Folate', 1000, 40, '0', 0, 9, '2153', 0, 2, 2, 1, 1),
(672, 'Growth Hormone', 1000, 40, '0', 0, 9, '2154', 0, 2, 2, 1, 1),
(673, 'Semen Analysis', 400, 40, '0', 0, 9, '2155', 0, 2, 2, 1, 1),
(674, 'ECG', 250, 30, '0', 0, 11, '2501', 0, 2, 2, 1, 1),
(675, 'ECHO', 900, 30, '0', 0, 9, '2502', 0, 2, 2, 1, 1),
(676, 'Endoscopy', 600, 25, '0', 0, 12, '2701', 0, 2, 2, 1, 1),
(677, 'Echocardiography', 800, 25, '0', 0, 12, '2702', 0, 2, 2, 1, 1),
(678, 'Lung Function Test', 800, 25, '0', 0, 12, '2703', 0, 2, 2, 1, 1),
(679, 'Endoscopy of upper GIT', 1000, 25, '0', 0, 12, '2704', 0, 2, 2, 1, 1),
(680, 'Histopathology', 500, 50, '0', 0, 9, '2901', 0, 2, 2, 1, 1),
(681, 'Vacu Test Tube Charge (K3)', 20, 0, '0', 0, 9, '3201', 0, 2, 2, 1, 1),
(682, 'Vacu Test Tube Charge (Clot)', 20, 0, '0', 0, 9, '3202', 0, 2, 2, 1, 1),
(683, '2 Time Vacu Test Tube Charge (Clot)', 40, 0, '0', 0, 9, '3204', 0, 2, 2, 1, 1),
(684, 'USG OF WHOLE ABDOMEN', 1000, 30, '0', 0, 13, '4101', 0, 2, 2, 1, 1),
(685, 'USG OF LOWER ABDOMEN', 550, 30, '0', 0, 13, '4102', 0, 2, 2, 1, 1),
(686, 'USG OF HBS', 550, 30, '0', 0, 13, '4103', 0, 2, 2, 1, 1),
(687, 'USG OF UPPER ABDOMEN', 550, 30, '0', 0, 13, '4104', 0, 2, 2, 1, 1),
(688, 'USG OF UTERUS & ADNEAXA', 550, 30, '0', 0, 13, '4105', 0, 2, 2, 1, 1),
(689, 'USG OF PREGNANCY PROFILE', 550, 30, '0', 0, 13, '4106', 0, 2, 2, 1, 1),
(690, 'USG OF KUB', 800, 30, '0', 0, 13, '4107', 0, 2, 2, 1, 1),
(691, 'USG OF KUB with PROSTATE & PVR', 1000, 30, '0', 0, 13, '4108', 0, 2, 2, 1, 1),
(692, 'USG OF PELVIC ORGANS', 550, 30, '0', 0, 13, '4109', 0, 2, 2, 1, 1),
(693, 'USG OF THYROID GLAND', 550, 30, '0', 0, 13, '4110', 0, 2, 2, 1, 1),
(694, 'USG OF BRAIN', 550, 30, '0', 0, 13, '4111', 0, 2, 2, 1, 1),
(695, 'USG OF RT. BREAST', 550, 30, '0', 0, 13, '4112', 0, 2, 2, 1, 1),
(696, 'USG OF LT. BREAST', 550, 30, '0', 0, 13, '4113', 0, 2, 2, 1, 1),
(697, 'USG OF BOTH  BREAST', 1000, 30, '0', 0, 13, '4114', 0, 2, 2, 1, 1),
(698, 'USG OF SCROUTUM & TESTIS', 550, 30, '0', 0, 13, '4115', 0, 2, 2, 1, 1),
(699, 'USG OF PROSTATE', 550, 30, '0', 0, 13, '4116', 0, 2, 2, 1, 1),
(700, 'USG OF TESTIS', 650, 30, '0', 0, 13, '4117', 0, 2, 2, 1, 1),
(701, 'USG OF NACK THAYRAD GLAND', 550, 30, '0', 0, 13, '4118', 0, 2, 2, 1, 1),
(702, 'USG OF SWELLING OVER RT. SHOULDER', 550, 30, '0', 0, 9, '4119', 0, 2, 2, 1, 1),
(703, 'USG OF BIO-PHYSICAL PROFILE', 1000, 30, '0', 0, 9, '4120', 0, 2, 2, 1, 1),
(704, 'USG OF KUB With PVR', 800, 25, '0', 0, 13, '4121', 0, 2, 2, 1, 1),
(705, 'USG OF KUB with Prostate & Residual Volume', 650, 30, '0', 0, 9, '4122', 0, 2, 2, 1, 1),
(706, 'USG OF Guided FNAC', 1000, 30, '0', 0, 9, '4123', 0, 2, 2, 1, 1),
(707, 'USG OF Aspiration', 1000, 30, '0', 0, 9, '4124', 0, 2, 2, 1, 1),
(708, 'USG OF WHOLE ABDOMEN with PVR', 650, 30, '0', 0, 13, '4125', 0, 2, 2, 1, 1),
(709, 'USG OF WHOLE ABDOMEN Protate with PVR', 650, 30, '0', 0, 9, '4126', 0, 2, 2, 1, 1),
(710, 'USG OF  Scrotum Organs', 650, 40, '0', 0, 13, '4127', 0, 2, 2, 1, 1),
(711, 'usg of kub region with pelvis organ', 1000, 0, '0', 0, 13, '4128', 0, 2, 2, 1, 1),
(712, 'Digital  X- Ray of Chest P/A View', 500, 20, '0', 0, 15, '5101', 0, 2, 2, 1, 1),
(713, 'Digital X-Ray of Chest Rt. Latral View', 350, 20, '0', 0, 15, '5102', 0, 2, 2, 1, 1),
(714, 'Digital X-Ray of Chest Lt. Latral View', 350, 20, '0', 0, 15, '5103', 0, 2, 2, 1, 1),
(715, 'Digital X-Ray of  Skull - B/V', 600, 20, '0', 0, 15, '5104', 0, 2, 2, 1, 1),
(716, 'Degital X-Ray of  Lumbo Drosal Spine B/V', 600, 20, '0', 0, 15, '5105', 0, 2, 2, 1, 1),
(717, 'Plain X-Ray of  KUB', 600, 0, '0', 0, 15, '5106', 0, 2, 2, 1, 1),
(718, 'Degital X-Ray of  Plain Abdomen / CPD', 500, 20, '0', 0, 15, '5107', 0, 2, 2, 1, 1),
(719, 'Degital X-Ray of  PNS OM View', 500, 20, '0', 0, 15, '5108', 0, 2, 2, 1, 1),
(720, 'Degital X-Ray of  Thoracic Spine B/V', 600, 20, '0', 0, 15, '5109', 0, 2, 2, 1, 1),
(721, 'Degital X-Ray of Dorsol Spine B/V', 600, 20, '0', 0, 15, '5110', 0, 2, 2, 1, 1),
(722, 'Degital X-Ray of  Ba- Meal SD (Stomach & Duodenum)', 1000, 20, '0', 0, 15, '5111', 0, 2, 2, 1, 1),
(723, 'Degital X-Ray of  Ba-Swallow Oesophagus', 1000, 20, '0', 0, 15, '5112', 0, 2, 2, 1, 1),
(724, 'Degital X-Ray of  I.V.U. with Post mick. Film', 2000, 20, '0', 0, 15, '5113', 0, 2, 2, 1, 1),
(725, 'Degital X-Ray of  Both knee Joint B/V', 650, 20, '0', 0, 15, '5114', 0, 2, 2, 1, 1),
(726, 'Degital X-Ray of Thorac Spine B/V', 600, 20, '0', 0, 15, '5115', 0, 2, 2, 1, 1),
(727, 'Degital X-Ray of Both Ankle Joint B/V', 600, 20, '0', 0, 15, '5116', 0, 2, 2, 1, 1),
(728, 'Degital X-Ray of Rt. Thigh B/V', 600, 20, '0', 0, 15, '5117', 0, 2, 2, 1, 1),
(729, 'Degital X-Ray of  Both Hip Joint B/V', 650, 20, '0', 0, 15, '5118', 0, 2, 2, 1, 1),
(730, 'Degital X-Ray of Sinogram/Fistulogram & Collection Charge', 1100, 20, '0', 0, 15, '5119', 0, 2, 2, 1, 1),
(731, 'Degital X-Ray of  Nasal-Bone Latral View', 350, 20, '0', 0, 15, '5120', 0, 2, 2, 1, 1),
(732, 'Degital X-Ray of  Nasopharynx Soft Tissu', 350, 20, '0', 0, 15, '5121', 0, 2, 2, 1, 1),
(733, 'Degital X-Ray of  Pelvis A/P View.', 350, 20, '0', 0, 15, '5122', 0, 2, 2, 1, 1),
(734, 'Degital X-Ray of  Cervical Spine B/V', 600, 20, '0', 0, 15, '5123', 0, 2, 2, 1, 1),
(735, 'Degital X-Ray of  Both S.I. Joint( A/P. Lt. Rt. Oblic)', 1050, 20, '0', 0, 15, '5124', 0, 2, 2, 1, 1),
(736, 'Degital X-Ray of Rt. Leg B/V', 350, 20, '0', 0, 15, '5125', 0, 2, 2, 1, 1),
(737, 'Degital X-Ray of  Ba-Enama Double Contras', 1200, 20, '0', 0, 15, '5126', 0, 2, 2, 1, 1),
(738, 'Degital X-Ray of Ba-Enema Single', 1200, 20, '0', 0, 15, '5127', 0, 2, 2, 1, 1),
(739, 'Degital X-Ray of Soft Tissue Neck Later', 350, 20, '0', 0, 15, '5128', 0, 2, 2, 1, 1),
(740, 'Degital X-Ray of  Ba- Follow Through', 1000, 20, '0', 0, 15, '5129', 0, 2, 2, 1, 1),
(741, 'Degital X-Ray of Lt.  Ankle Joint B/V', 350, 20, '0', 0, 15, '5130', 0, 2, 2, 1, 1),
(742, 'Degital X-Ray of Rt. Ankle Joint B/V', 350, 20, '0', 0, 15, '5131', 0, 2, 2, 1, 1),
(743, 'Plain X-Ray Abdomen E/P View', 650, 20, '0', 0, 15, '5132', 0, 2, 2, 1, 1),
(744, 'Degital X-Ray of Lt. Wrist Joint B/V', 350, 20, '0', 0, 15, '5133', 0, 2, 2, 1, 1),
(745, 'X-Ray Skull L/V', 150, 20, '0', 0, 15, '5134', 0, 2, 2, 1, 1),
(746, 'X-Ray PNS B/V', 600, 20, '0', 0, 15, '5135', 0, 2, 2, 1, 1),
(747, 'X-Ray Lumbo Sacral Spine B/V', 600, 20, '0', 0, 15, '5136', 0, 2, 2, 1, 1),
(748, 'X-Ray RGU & MCU', 2000, 20, '0', 0, 15, '5137', 0, 2, 2, 1, 1),
(749, 'X-Ray Skull L/V', 150, 20, '0', 0, 15, '5138', 0, 2, 2, 1, 1),
(750, 'X-Ray Throat B/V', 300, 20, '0', 0, 15, '5139', 0, 2, 2, 1, 1),
(751, 'X-Ray Neck A/P View', 150, 20, '0', 0, 15, '5140', 0, 2, 2, 1, 1),
(752, 'X-Ray Nasopharynx B/V', 300, 20, '0', 0, 15, '5141', 0, 2, 2, 1, 1),
(753, 'X-Ray Lumbo Cervical Spine B/V', 300, 20, '0', 0, 15, '5142', 0, 2, 2, 1, 1),
(754, 'X-Ray Left Hand B/V', 350, 20, '0', 0, 15, '5143', 0, 2, 2, 1, 1),
(755, 'X-Ray Left Wrist Joint B/V', 150, 20, '0', 0, 15, '5144', 0, 2, 2, 1, 1),
(756, 'X-Ray Left Fore arm B/V', 150, 20, '0', 0, 15, '5145', 0, 2, 2, 1, 1),
(757, 'X-Ray Left Elbow Joint B/V', 150, 20, '0', 0, 15, '5146', 0, 2, 2, 1, 1),
(758, 'X-Ray Left Shoulder joint B/V', 600, 20, '0', 0, 15, '5147', 0, 2, 2, 1, 1),
(759, 'X-Ray Left Foot B/V', 350, 20, '0', 0, 15, '5148', 0, 2, 2, 1, 1),
(760, 'X-Ray Left Ankle joint B/V', 150, 20, '0', 0, 15, '5149', 0, 2, 2, 1, 1),
(761, 'X-Ray Left Knee Joint B/V', 150, 20, '0', 0, 15, '5150', 0, 2, 2, 1, 1),
(762, 'X-Ray Left Thigh B/V', 150, 20, '0', 0, 15, '5151', 0, 2, 2, 1, 1),
(763, 'X-Ray Left Shoulder Joint A/P View', 350, 20, '0', 0, 15, '5152', 0, 2, 2, 1, 1),
(764, 'X-Ray Left Orbit A/P & Latral View', 300, 20, '0', 0, 15, '5153', 0, 2, 2, 1, 1),
(765, 'X-Ray Left Chest Latral View', 150, 20, '0', 0, 15, '5154', 0, 2, 2, 1, 1),
(766, 'X-Ray Left Clavicol A/P', 150, 20, '0', 0, 15, '5155', 0, 2, 2, 1, 1),
(767, 'X-Ray Left Mostaid Towns View', 150, 20, '0', 0, 15, '5156', 0, 2, 2, 1, 1),
(768, 'X-Ray Left Thigh B/V', 150, 20, '0', 0, 15, '5157', 0, 2, 2, 1, 1),
(769, 'X-Ray Left arm B/V', 150, 20, '0', 0, 15, '5158', 0, 2, 2, 1, 1),
(770, 'X-Ray Left Foot Including Ankle Joint', 150, 20, '0', 0, 15, '5159', 0, 2, 2, 1, 1),
(771, 'X-Ray Chest  B/V', 1000, 20, '0', 0, 15, '5160', 0, 2, 2, 1, 1),
(772, 'X-Ray Left Mandible Letral View', 150, 20, '0', 0, 15, '5161', 0, 2, 2, 1, 1),
(773, 'X-Ray Left Flanzes B/V', 150, 20, '0', 0, 15, '5162', 0, 2, 2, 1, 1),
(774, 'X-Ray Left Mandible B/V', 300, 20, '0', 0, 15, '5163', 0, 2, 2, 1, 1),
(775, 'X-Ray Left Femur B/V', 150, 20, '0', 0, 15, '5164', 0, 2, 2, 1, 1),
(776, 'Degital X-Ray of Rt. Tibia Fibula B/V', 350, 20, '0', 0, 15, '5165', 0, 2, 2, 1, 1),
(777, 'X-Ray Right Hand B/V', 350, 20, '0', 0, 15, '5166', 0, 2, 2, 1, 1),
(778, 'X-Ray Right Fore Arm B/V', 150, 20, '0', 0, 15, '5167', 0, 2, 2, 1, 1),
(779, 'X-Ray Right Elbow Joint B/V', 150, 20, '0', 0, 15, '5168', 0, 2, 2, 1, 1),
(780, 'X-Ray Right Shoulder Joint B/V', 600, 20, '0', 0, 15, '5169', 0, 2, 2, 1, 1),
(781, 'X-Ray Right Arm B/V', 150, 20, '0', 0, 15, '5170', 0, 2, 2, 1, 1),
(782, 'X-Ray Right Foot B/V', 350, 20, '0', 0, 15, '5171', 0, 2, 2, 1, 1),
(783, 'X-Ray Right Ankle Joint B/V', 350, 20, '0', 0, 15, '5172', 0, 2, 2, 1, 1),
(784, 'X-Ray Right Leg B/V', 350, 20, '0', 0, 15, '5173', 0, 2, 2, 1, 1),
(785, 'X-Ray Right Hip Joint B/V', 300, 20, '0', 0, 15, '5174', 0, 2, 2, 1, 1),
(786, 'X-Ray Right Knee Joint B/V', 350, 20, '0', 0, 15, '5175', 0, 2, 2, 1, 1),
(787, 'X-Ray Right Wrist Joint B/V', 150, 20, '0', 0, 15, '5176', 0, 2, 2, 1, 1),
(788, 'X-Ray Right Orbit A/P Latral View', 300, 20, '0', 0, 15, '5177', 0, 2, 2, 1, 1),
(789, 'X-Ray Both Hand B/V View', 600, 20, '0', 0, 15, '5178', 0, 2, 2, 1, 1),
(790, 'X-Ray Right Clavical A/P View', 150, 20, '0', 0, 15, '5179', 0, 2, 2, 1, 1),
(791, 'X-Ray Right Mostaid Towns View', 150, 20, '0', 0, 15, '5180', 0, 2, 2, 1, 1),
(792, 'X-Ray Right Latral View', 150, 20, '0', 0, 15, '5181', 0, 2, 2, 1, 1),
(793, 'X-Ray Right Femar A/P View', 150, 20, '0', 0, 15, '5182', 0, 2, 2, 1, 1),
(794, 'X-Ray Right Chest Latral View', 150, 20, '0', 0, 15, '5183', 0, 2, 2, 1, 1),
(795, 'X-Ray Right Mandible Latral View', 150, 20, '0', 0, 15, '5184', 0, 2, 2, 1, 1),
(796, 'X-Ray Both Knee Joint B/V', 600, 20, '0', 0, 15, '5185', 0, 2, 2, 1, 1),
(797, 'X-Ray Right Flanzes B/V', 150, 20, '0', 0, 15, '5186', 0, 2, 2, 1, 1),
(798, 'X-Ray Rt+Lt Tibia B/V', 300, 20, '0', 0, 15, '5187', 0, 2, 2, 1, 1),
(799, 'X-Ray Right Femar B/V', 300, 20, '0', 0, 15, '5188', 0, 2, 2, 1, 1),
(800, 'X-Ray Maxila B/V', 600, 20, '0', 0, 15, '5189', 0, 2, 2, 1, 1),
(801, 'X-Ray Hip Joint B/V', 300, 20, '0', 0, 15, '5190', 0, 2, 2, 1, 1),
(802, 'X-Ray Left Thum B/V', 150, 20, '0', 0, 15, '5191', 0, 2, 2, 1, 1),
(803, 'X-Ray Chest A/P  View', 500, 20, '0', 0, 15, '5192', 0, 2, 2, 1, 1),
(804, 'X-Ray Left Hill B/V', 150, 20, '0', 0, 15, '5193', 0, 2, 2, 1, 1),
(805, 'X-Ray Left Radius & Ulna B/V', 350, 20, '0', 0, 15, '5194', 0, 2, 2, 1, 1),
(806, 'Dental X-Ray Of', 80, 20, '0', 0, 9, '5195', 0, 2, 2, 1, 1),
(807, 'Dental X-Ray Of', 160, 20, '0', 0, 9, '5196', 0, 2, 2, 1, 1),
(808, 'Nebulization', 200, 0, '0', 0, 9, NULL, 16, 2, 1, 2, 2);

-- --------------------------------------------------------

--
-- Table structure for table `investigationType`
--

CREATE TABLE `investigationType` (
  `id` int NOT NULL,
  `labname` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `investigationType`
--

INSERT INTO `investigationType` (`id`, `labname`) VALUES
(1, 'Lab'),
(2, 'Imaging'),
(3, 'Clinical Chart');

-- --------------------------------------------------------

--
-- Table structure for table `invoice_ledger`
--

CREATE TABLE `invoice_ledger` (
  `id` int NOT NULL,
  `sales_amount` double DEFAULT NULL,
  `less_amount` double DEFAULT NULL,
  `recieved_amount` double DEFAULT NULL,
  `return_amount` double DEFAULT NULL,
  `refund_amount` double DEFAULT NULL,
  `remarks` varchar(255) DEFAULT NULL,
  `patientregistration_id` int NOT NULL,
  `invoice_master_id` int NOT NULL,
  `doctor_commision` double NOT NULL DEFAULT '0',
  `less_from` int DEFAULT NULL COMMENT '0 for Company\n1 for Both\n2 for Doctor',
  `trdate` date DEFAULT NULL,
  `doctors_id` int NOT NULL,
  `less_pc` double DEFAULT NULL,
  `less_type` int DEFAULT NULL COMMENT '0 for tk\n1 for %',
  `valid` int DEFAULT NULL,
  `transation_from` varchar(45) DEFAULT NULL,
  `invoice_return_id` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice_ledger`
--

INSERT INTO `invoice_ledger` (`id`, `sales_amount`, `less_amount`, `recieved_amount`, `return_amount`, `refund_amount`, `remarks`, `patientregistration_id`, `invoice_master_id`, `doctor_commision`, `less_from`, `trdate`, `doctors_id`, `less_pc`, `less_type`, `valid`, `transation_from`, `invoice_return_id`) VALUES
(57, 4750, 237.5, 2000, 0, 0, 'Referd by me ali', 16, 46, 1375, 1, '2015-12-25', 6, 5, 1, 1, 'Outdoor Invoice', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_master`
--

CREATE TABLE `invoice_master` (
  `id` int NOT NULL,
  `date` date DEFAULT NULL,
  `doctors_id` int NOT NULL COMMENT 'consultant by id',
  `moduleName_id` int NOT NULL,
  `age` int DEFAULT NULL,
  `totalamount` double DEFAULT NULL,
  `discountamount` float DEFAULT NULL,
  `discountstatus` int DEFAULT NULL COMMENT '0 for tk\n1 for %',
  `discountpc` float DEFAULT NULL COMMENT 'discount percentage',
  `advanceamount` float DEFAULT NULL,
  `due` float DEFAULT NULL,
  `istransferred` int DEFAULT NULL,
  `discountfrom` int DEFAULT NULL COMMENT '0 for Company\n1 for Both\n2 for Doctor',
  `remarks` varchar(45) DEFAULT NULL COMMENT 'why discount?',
  `reference_doctor_id` int NOT NULL,
  `patientregistration_id` int NOT NULL,
  `invoice_no` varchar(45) DEFAULT NULL,
  `valid` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `invoice_master`
--

INSERT INTO `invoice_master` (`id`, `date`, `doctors_id`, `moduleName_id`, `age`, `totalamount`, `discountamount`, `discountstatus`, `discountpc`, `advanceamount`, `due`, `istransferred`, `discountfrom`, `remarks`, `reference_doctor_id`, `patientregistration_id`, `invoice_no`, `valid`) VALUES
(46, '2015-12-25', 6, 1, NULL, 4750, 237.5, 1, 5, 2000, 2512.5, 1, 1, 'Referd by me ali', 6, 16, '15120001', 1);

-- --------------------------------------------------------

--
-- Table structure for table `invoice_return`
--

CREATE TABLE `invoice_return` (
  `id` int NOT NULL,
  `invoice_master_id` int NOT NULL,
  `return_no` varchar(45) DEFAULT NULL,
  `return_date` date DEFAULT NULL,
  `total_return` float DEFAULT NULL,
  `refund_amount` float DEFAULT NULL,
  `valid` int DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `labreport`
--

CREATE TABLE `labreport` (
  `id` int NOT NULL,
  `investigation_id` int NOT NULL,
  `parameter` varchar(100) DEFAULT NULL,
  `alias_name` varchar(100) DEFAULT NULL COMMENT 'show in report\ndescription',
  `normal_value` varchar(45) DEFAULT NULL,
  `unit` varchar(45) DEFAULT NULL,
  `report_group` varchar(45) DEFAULT NULL,
  `group_sl` int DEFAULT NULL,
  `sl_no` int DEFAULT NULL,
  `report_file_name` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `labreport`
--

INSERT INTO `labreport` (`id`, `investigation_id`, `parameter`, `alias_name`, `normal_value`, `unit`, `report_group`, `group_sl`, `sl_no`, `report_file_name`) VALUES
(6, 420, 'Platelet Count', 'Platelet Count', '200', 'Platelet Count', 'Platelet Count', 1, 2, 'Hematology'),
(7, 417, 'aaaaaaaaaaa', 'aaaaaaaaaa', 'aaaaaaaaaa', 'aaaaaaaaaaa', 'aaaaaaaaaa', 0, 0, 'Hematology'),
(8, 417, 'aaaaaaaaaaa', 'aaaaaaaaaaa', 'aaaaaaaaaaaa', 'aaaaaaaaaaaa', 'aaaaaaaaaa', 0, 0, 'Hematology');

-- --------------------------------------------------------

--
-- Table structure for table `migrations`
--

CREATE TABLE `migrations` (
  `id` int UNSIGNED NOT NULL,
  `migration` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `batch` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `migrations`
--

INSERT INTO `migrations` (`id`, `migration`, `batch`) VALUES
(1, '2014_10_12_000000_create_users_table', 1),
(2, '2014_10_12_100000_create_password_resets_table', 1),
(3, '2014_10_12_200000_add_two_factor_columns_to_users_table', 1),
(4, '2019_08_19_000000_create_failed_jobs_table', 1),
(5, '2019_12_14_000001_create_personal_access_tokens_table', 1),
(6, '2020_12_13_111949_create_sessions_table', 1);

-- --------------------------------------------------------

--
-- Table structure for table `moduleName`
--

CREATE TABLE `moduleName` (
  `id` int NOT NULL,
  `name` text
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `moduleName`
--

INSERT INTO `moduleName` (`id`, `name`) VALUES
(1, 'Hospital');

-- --------------------------------------------------------

--
-- Table structure for table `occupations`
--

CREATE TABLE `occupations` (
  `id` int NOT NULL,
  `description` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `occupations`
--

INSERT INTO `occupations` (`id`, `description`) VALUES
(1, 'JOb'),
(2, 'Advocate');

-- --------------------------------------------------------

--
-- Table structure for table `password_resets`
--

CREATE TABLE `password_resets` (
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `created_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `patienta_admission`
--

CREATE TABLE `patienta_admission` (
  `id` int NOT NULL,
  `dmission_date` datetime DEFAULT NULL,
  `bed_information_id` int NOT NULL,
  `doctors_id` int NOT NULL,
  `patientregistration_id` int NOT NULL,
  `department_id` int NOT NULL,
  `note` varchar(45) DEFAULT NULL,
  `patient_admission_status` int DEFAULT NULL COMMENT '1 for admit\n0 for release',
  `patienta_dmission_no` varchar(20) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patienta_bed_info`
--

CREATE TABLE `patienta_bed_info` (
  `id` int NOT NULL,
  `patienta_dmission_id` int NOT NULL,
  `bed_information_id` int NOT NULL,
  `active_bed` int DEFAULT NULL COMMENT '0 for deactive\n1 for active\n',
  `start_date` datetime DEFAULT NULL,
  `end_date` datetime DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `patientregistration`
--

CREATE TABLE `patientregistration` (
  `id` int NOT NULL,
  `name` varchar(45) DEFAULT NULL,
  `phone` varchar(45) DEFAULT NULL,
  `phone2` varchar(45) DEFAULT NULL,
  `dob` date DEFAULT NULL,
  `gender` varchar(2) DEFAULT NULL,
  `fathersname` varchar(45) DEFAULT NULL,
  `mothersname` varchar(45) DEFAULT NULL,
  `spousename` varchar(45) DEFAULT NULL,
  `address` varchar(255) CHARACTER SET utf8 COLLATE utf8_general_ci DEFAULT NULL,
  `relegion` varchar(45) DEFAULT NULL,
  `nationality` varchar(45) DEFAULT NULL,
  `nationalid` varchar(45) DEFAULT NULL,
  `passportid` varchar(45) DEFAULT NULL,
  `related` tinyint(1) DEFAULT NULL,
  `relation` varchar(45) DEFAULT NULL,
  `blood_group` varchar(5) DEFAULT NULL,
  `date_deceased` date DEFAULT NULL,
  `employee_info_id` int DEFAULT NULL,
  `registration_no` varchar(20) DEFAULT NULL,
  `occupations_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `patientregistration`
--

INSERT INTO `patientregistration` (`id`, `name`, `phone`, `phone2`, `dob`, `gender`, `fathersname`, `mothersname`, `spousename`, `address`, `relegion`, `nationality`, `nationalid`, `passportid`, `related`, `relation`, `blood_group`, `date_deceased`, `employee_info_id`, `registration_no`, `occupations_id`) VALUES
(16, 'MD AL-AMIN ', '01673201560', NULL, '1988-12-11', 'm', 'na', 'na', 'aaaa', 'Dhaka', 'islam', '12', NULL, 'AS', NULL, NULL, 'A+', NULL, NULL, '15120001', 1),
(17, 'AAAAA AAAAA AASASAS', '01673201560', NULL, '1990-05-10', 'm', 'asasas', 'asasasas', 'asasas', 'asasas', 'islam', 'asasas', NULL, '12133', NULL, NULL, 'A+', NULL, NULL, '19050001', 1);

-- --------------------------------------------------------

--
-- Table structure for table `personal_access_tokens`
--

CREATE TABLE `personal_access_tokens` (
  `id` bigint UNSIGNED NOT NULL,
  `tokenable_type` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `tokenable_id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `token` varchar(64) COLLATE utf8mb4_unicode_ci NOT NULL,
  `abilities` text COLLATE utf8mb4_unicode_ci,
  `last_used_at` timestamp NULL DEFAULT NULL,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `sessions`
--

CREATE TABLE `sessions` (
  `id` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `user_id` bigint UNSIGNED DEFAULT NULL,
  `ip_address` varchar(45) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `user_agent` text COLLATE utf8mb4_unicode_ci,
  `payload` text COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_activity` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `sessions`
--

INSERT INTO `sessions` (`id`, `user_id`, `ip_address`, `user_agent`, `payload`, `last_activity`) VALUES
('8qNjwJSwh8gLQCeOpnMimHwpOYSaKtXEwGDJcKW5', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoiQW1KVmJnbjJTcGdrWGljWWF6R3FyNExZMUFtTGRaWm5YQ0R3V0kxWCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzU6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9iYXJjb2RlcHJpbnRzIjt9czo2OiJfZmxhc2giO2E6Mjp7czozOiJvbGQiO2E6MDp7fXM6MzoibmV3IjthOjA6e319czozOiJ1cmwiO2E6MDp7fXM6NTA6ImxvZ2luX3dlYl81OWJhMzZhZGRjMmIyZjk0MDE1ODBmMDE0YzdmNThlYTRlMzA5ODlkIjtpOjE7czoxNzoicGFzc3dvcmRfaGFzaF93ZWIiO3M6NjA6IiQyeSQxMCRxaDNQQTFLUHJYelRhWll1Li5STS51VVpTR0xXSFhCeVpyeER3Sm9Cclk5eDZRbmY1aGxmTyI7czoyMToicGFzc3dvcmRfaGFzaF9zYW5jdHVtIjtzOjYwOiIkMnkkMTAkcWgzUEExS1ByWHpUYVpZdS4uUk0udVVaU0dMV0hYQnlacnhEd0pvQnJZOXg2UW5mNWhsZk8iO30=', 1608793963),
('BmnoZPAdwT3bZqmk59ecnp9F1gbpIezFzzY5nfGw', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoiZlNuSlU0T25LRzJEREQybVZWcGlEVXVtMVJTSDhtbFF1VnF6SEVSVyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9pbnZvaWNlbGlzdHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1608788854),
('Bs605HLejWJ5VXxP107ji9FShnpNfe3SHMEAtCZI', 1, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YTo3OntzOjY6Il90b2tlbiI7czo0MDoicWNJUmhMYlhMVUNNcU1GcjFQR2xJd0ZSOU5hODNTTjI1cktKSU9EbyI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzA6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9pbnZvaWNlcyI7fXM6NjoiX2ZsYXNoIjthOjI6e3M6Mzoib2xkIjthOjA6e31zOjM6Im5ldyI7YTowOnt9fXM6MzoidXJsIjthOjA6e31zOjUwOiJsb2dpbl93ZWJfNTliYTM2YWRkYzJiMmY5NDAxNTgwZjAxNGM3ZjU4ZWE0ZTMwOTg5ZCI7aToxO3M6MTc6InBhc3N3b3JkX2hhc2hfd2ViIjtzOjYwOiIkMnkkMTAkcWgzUEExS1ByWHpUYVpZdS4uUk0udVVaU0dMV0hYQnlacnhEd0pvQnJZOXg2UW5mNWhsZk8iO3M6MjE6InBhc3N3b3JkX2hhc2hfc2FuY3R1bSI7czo2MDoiJDJ5JDEwJHFoM1BBMUtQclh6VGFaWXUuLlJNLnVVWlNHTFdIWEJ5WnJ4RHdKb0JyWTl4NlFuZjVobGZPIjt9', 1608796073),
('YRSZETmDpVZA71lO1gO1Nq2rRMoWKYMv1hYxTQPH', NULL, '127.0.0.1', 'Mozilla/5.0 (X11; Linux x86_64) AppleWebKit/537.36 (KHTML, like Gecko) Chrome/87.0.4280.88 Safari/537.36', 'YTozOntzOjY6Il90b2tlbiI7czo0MDoid04wWFRRT0JFV21OcVlVemJ5VVZXYWhjSTlWYWxtNDRtRU44M2VpTCI7czo5OiJfcHJldmlvdXMiO2E6MTp7czozOiJ1cmwiO3M6MzQ6Imh0dHA6Ly8xMjcuMC4wLjE6ODAwMS9pbnZvaWNlbGlzdHMiO31zOjY6Il9mbGFzaCI7YToyOntzOjM6Im9sZCI7YTowOnt9czozOiJuZXciO2E6MDp7fX19', 1608794523);

-- --------------------------------------------------------

--
-- Table structure for table `sub_department`
--

CREATE TABLE `sub_department` (
  `id` int NOT NULL,
  `description` varchar(45) DEFAULT NULL,
  `department_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `sub_department`
--

INSERT INTO `sub_department` (`id`, `description`, `department_id`) VALUES
(16, 'HAEMATOLOGY\n', 9),
(17, 'BIOCHEMISTRY\n', 9),
(18, 'SEROLOGY\n', 9),
(19, 'MICRO-BIOLOGY\n', 9),
(20, 'Pathology', 9),
(21, 'URINE\n', 9),
(22, 'STOOL\n', 9),
(23, 'OTHERS\n', 17),
(24, 'Vaccut\n', 17),
(25, 'HORMONE\n', 9),
(26, 'ECG\n', 11),
(27, 'ECHO & ENDOS\n', 12),
(28, 'Histopathology\n', 9),
(29, 'USG\n', 13),
(30, 'X-Ray\n', 15);

-- --------------------------------------------------------

--
-- Table structure for table `throttle`
--

CREATE TABLE `throttle` (
  `id` int UNSIGNED NOT NULL,
  `user_id` int UNSIGNED DEFAULT NULL,
  `ip_address` varchar(255) CHARACTER SET utf8 COLLATE utf8_unicode_ci DEFAULT NULL,
  `attempts` int NOT NULL DEFAULT '0',
  `suspended` tinyint(1) NOT NULL DEFAULT '0',
  `banned` tinyint(1) NOT NULL DEFAULT '0',
  `last_attempt_at` timestamp NULL DEFAULT NULL,
  `suspended_at` timestamp NULL DEFAULT NULL,
  `banned_at` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `throttle`
--

INSERT INTO `throttle` (`id`, `user_id`, `ip_address`, `attempts`, `suspended`, `banned`, `last_attempt_at`, `suspended_at`, `banned_at`) VALUES
(1, 4, '127.0.0.1', 0, 0, 0, NULL, NULL, NULL),
(2, 6, '127.0.0.1', 0, 0, 0, NULL, NULL, NULL),
(3, 8, '127.0.0.1', 0, 0, 0, NULL, NULL, NULL),
(4, 10, '127.0.0.1', 0, 0, 0, NULL, NULL, NULL),
(5, 14, '127.0.0.1', 0, 0, 0, NULL, NULL, NULL),
(6, 1, '127.0.0.1', 0, 0, 0, NULL, NULL, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `timestamps`
--

CREATE TABLE `timestamps` (
  `create_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_time` timestamp NULL DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `unit_info`
--

CREATE TABLE `unit_info` (
  `id` int NOT NULL,
  `description` varchar(45) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `unit_info`
--

INSERT INTO `unit_info` (`id`, `description`) VALUES
(1, 'None'),
(2, 'Ltr');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

CREATE TABLE `users` (
  `id` bigint UNSIGNED NOT NULL,
  `name` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `activated` int NOT NULL,
  `email_verified_at` timestamp NULL DEFAULT NULL,
  `password` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `two_factor_secret` text COLLATE utf8mb4_unicode_ci,
  `two_factor_recovery_codes` text COLLATE utf8mb4_unicode_ci,
  `remember_token` varchar(100) COLLATE utf8mb4_unicode_ci DEFAULT NULL,
  `current_team_id` bigint UNSIGNED DEFAULT NULL,
  `profile_photo_path` text COLLATE utf8mb4_unicode_ci,
  `created_at` timestamp NULL DEFAULT NULL,
  `updated_at` timestamp NULL DEFAULT NULL,
  `persist_code` varchar(255) COLLATE utf8mb4_unicode_ci NOT NULL,
  `last_login` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`id`, `name`, `email`, `activated`, `email_verified_at`, `password`, `two_factor_secret`, `two_factor_recovery_codes`, `remember_token`, `current_team_id`, `profile_photo_path`, `created_at`, `updated_at`, `persist_code`, `last_login`) VALUES
(1, 'Alvie', 'tezalve@gmail.com', 0, NULL, '$2y$10$qh3PA1KPrXzTaZYu..RM.uUZSGLWHXByZrxDwJoBrY9x6Qnf5hlfO', NULL, NULL, 'PNdk7nkg1AxremgMFl6pQDZjxcTjWHq3yXy0Eo3jp64pvS2kQfQHauGY9qWF', NULL, NULL, NULL, NULL, '0', 0),
(2, 'T.M. Estiaq Zaman', 'asd@asd.asd', 0, NULL, '$2y$10$3dhb9uSSc2JhRjerx1SWuurQiDncZKxBpH7kpi145UC/COnJS.INi', NULL, NULL, NULL, NULL, NULL, '2020-12-14 00:17:46', '2020-12-14 00:17:46', '0', 0),
(3, 'love shine', 'ls@ls.com', 0, NULL, '$2y$10$b7Y.j5OSqtLDRHUpgfdROuOACi16Z2k/fI260qoirjvrn/4EvjI1W', NULL, NULL, NULL, NULL, NULL, '2020-12-14 00:31:11', '2020-12-14 00:31:11', '0', 0),
(4, 'gg', 'gg@gg.com', 1, NULL, '$2y$10$0O.0rJF8QRvm/V9UhzVeYuHXEQoEK7Qf5lsVNoXoCWuaUhdYTnTtS', NULL, NULL, NULL, NULL, NULL, '2020-12-14 00:33:53', '2020-12-24 07:30:08', '$2y$10$AwF3/9kT/wWZ/LU7lxBS.Ok0nTXyeQTCz176iwvZH4Eyj4wICYK1i', 2020);

-- --------------------------------------------------------

--
-- Table structure for table `users_groups`
--

CREATE TABLE `users_groups` (
  `user_id` int UNSIGNED NOT NULL,
  `group_id` int UNSIGNED NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users_groups`
--

INSERT INTO `users_groups` (`user_id`, `group_id`) VALUES
(4, 24),
(4, 25);

-- --------------------------------------------------------

--
-- Table structure for table `vacutainer`
--

CREATE TABLE `vacutainer` (
  `id` int NOT NULL,
  `name` text,
  `price` double DEFAULT NULL,
  `type` text,
  `delivery_duration` int DEFAULT NULL,
  `investigation_id` int NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Structure for view `doctor_com`
--
DROP TABLE IF EXISTS `doctor_com`;

CREATE ALGORITHM=UNDEFINED DEFINER=`root`@`localhost` SQL SECURITY DEFINER VIEW `doctor_com`  AS  select `a`.`id` AS `id`,`b`.`investigation_id` AS `investigation_id`,`c`.`name` AS `investigation_name`,if((`d`.`type` = 1),`b`.`refferal_amount`,0) AS `Pathology`,if((`d`.`type` = 2),`b`.`refferal_amount`,0) AS `ECG`,if((`d`.`type` = 3),`b`.`refferal_amount`,0) AS `ECHO`,if((`d`.`type` = 4),`b`.`refferal_amount`,0) AS `USG`,if((`d`.`type` = 5),`b`.`refferal_amount`,0) AS `XRay`,if((`d`.`type` = 2),`b`.`refferal_amount`,0) AS `OTHERS` from (((`invoice_master` `a` join `details` `b` on((`a`.`id` = `b`.`invoice_master_id`))) join `investigation` `c` on((`b`.`investigation_id` = `c`.`id`))) join `department` `d` on((`c`.`department_id` = `d`.`id`))) ;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `bed_group`
--
ALTER TABLE `bed_group`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `bed_information`
--
ALTER TABLE `bed_information`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_bed_information_bed_group1_idx` (`bed_group_id`),
  ADD KEY `fk_bed_information_floor_information1_idx` (`floor_information_id`);

--
-- Indexes for table `companyinfo`
--
ALTER TABLE `companyinfo`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_companyinfo_chart_of_acc5_idx` (`cash_account_code`);

--
-- Indexes for table `department`
--
ALTER TABLE `department`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_department_investigationType1_idx` (`investigationType_id`);

--
-- Indexes for table `details`
--
ALTER TABLE `details`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_details_investigation1_idx` (`investigation_id`),
  ADD KEY `fk_details_invoice_master1_idx` (`invoice_master_id`),
  ADD KEY `fk_details_doctors1_idx` (`doctors_id`);

--
-- Indexes for table `doctors`
--
ALTER TABLE `doctors`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_doctors_department1_idx` (`department_id`);

--
-- Indexes for table `doctors_ledger`
--
ALTER TABLE `doctors_ledger`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_doctors_ledger_doctors1_idx` (`doctors_id`),
  ADD KEY `fk_doctors_ledger_invoice_master1_idx` (`invoice_master_id`),
  ADD KEY `fk_doctors_ledger_invoice_return1_idx` (`invoice_return_id`);

--
-- Indexes for table `duecollection`
--
ALTER TABLE `duecollection`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_duecollection_invoice_ledger1_idx` (`invoice_ledger_id`),
  ADD KEY `fk_duecollection_invoice_master1_idx` (`invoice_master_id`);

--
-- Indexes for table `employee_info`
--
ALTER TABLE `employee_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `failed_jobs_uuid_unique` (`uuid`);

--
-- Indexes for table `floor_information`
--
ALTER TABLE `floor_information`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `groups`
--
ALTER TABLE `groups`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `groups_name_unique` (`name`);

--
-- Indexes for table `investigation`
--
ALTER TABLE `investigation`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_investigation_department1_idx` (`department_id`),
  ADD KEY `fk_investigation_sub_department1_idx` (`sub_department`),
  ADD KEY `fk_investigation_unit_info1_idx` (`unit_info_id`);

--
-- Indexes for table `investigationType`
--
ALTER TABLE `investigationType`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `invoice_ledger`
--
ALTER TABLE `invoice_ledger`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_invoice_ledger_patientregistration1_idx` (`patientregistration_id`),
  ADD KEY `fk_invoice_ledger_invoice_master1_idx` (`invoice_master_id`),
  ADD KEY `fk_invoice_ledger_doctors1_idx` (`doctors_id`),
  ADD KEY `fk_invoice_ledger_invoice_return1_idx` (`invoice_return_id`);

--
-- Indexes for table `invoice_master`
--
ALTER TABLE `invoice_master`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_invoice_master_doctors1_idx` (`doctors_id`),
  ADD KEY `fk_invoice_master_moduleName1_idx` (`moduleName_id`),
  ADD KEY `fk_invoice_master_doctors2_idx` (`reference_doctor_id`),
  ADD KEY `fk_invoice_master_patientregistration1_idx` (`patientregistration_id`);

--
-- Indexes for table `invoice_return`
--
ALTER TABLE `invoice_return`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_invoice_return_invoice_master1_idx` (`invoice_master_id`);

--
-- Indexes for table `labreport`
--
ALTER TABLE `labreport`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_labreport_investigation1_idx` (`investigation_id`);

--
-- Indexes for table `migrations`
--
ALTER TABLE `migrations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `moduleName`
--
ALTER TABLE `moduleName`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `occupations`
--
ALTER TABLE `occupations`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `password_resets`
--
ALTER TABLE `password_resets`
  ADD KEY `password_resets_email_index` (`email`);

--
-- Indexes for table `patienta_admission`
--
ALTER TABLE `patienta_admission`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_patienta_dmission_bed_information1_idx` (`bed_information_id`),
  ADD KEY `fk_patienta_dmission_doctors1_idx` (`doctors_id`),
  ADD KEY `fk_patienta_dmission_patientregistration1_idx` (`patientregistration_id`),
  ADD KEY `fk_patienta_dmission_department1_idx` (`department_id`);

--
-- Indexes for table `patienta_bed_info`
--
ALTER TABLE `patienta_bed_info`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_patienta_bed_info_patienta_dmission1_idx` (`patienta_dmission_id`),
  ADD KEY `fk_patienta_bed_info_bed_information1_idx` (`bed_information_id`);

--
-- Indexes for table `patientregistration`
--
ALTER TABLE `patientregistration`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_patientregistration_employee_info1_idx` (`employee_info_id`),
  ADD KEY `fk_patientregistration_occupations1_idx` (`occupations_id`);

--
-- Indexes for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `personal_access_tokens_token_unique` (`token`),
  ADD KEY `personal_access_tokens_tokenable_type_tokenable_id_index` (`tokenable_type`,`tokenable_id`);

--
-- Indexes for table `sessions`
--
ALTER TABLE `sessions`
  ADD PRIMARY KEY (`id`),
  ADD KEY `sessions_user_id_index` (`user_id`),
  ADD KEY `sessions_last_activity_index` (`last_activity`);

--
-- Indexes for table `sub_department`
--
ALTER TABLE `sub_department`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_sub_department_department1_idx` (`department_id`);

--
-- Indexes for table `throttle`
--
ALTER TABLE `throttle`
  ADD PRIMARY KEY (`id`),
  ADD KEY `throttle_user_id_index` (`user_id`);

--
-- Indexes for table `unit_info`
--
ALTER TABLE `unit_info`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `users`
--
ALTER TABLE `users`
  ADD PRIMARY KEY (`id`),
  ADD UNIQUE KEY `users_email_unique` (`email`);

--
-- Indexes for table `users_groups`
--
ALTER TABLE `users_groups`
  ADD PRIMARY KEY (`user_id`,`group_id`);

--
-- Indexes for table `vacutainer`
--
ALTER TABLE `vacutainer`
  ADD PRIMARY KEY (`id`),
  ADD KEY `fk_vacutainer_investigation1_idx` (`investigation_id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `bed_group`
--
ALTER TABLE `bed_group`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `bed_information`
--
ALTER TABLE `bed_information`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `companyinfo`
--
ALTER TABLE `companyinfo`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `department`
--
ALTER TABLE `department`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=19;

--
-- AUTO_INCREMENT for table `details`
--
ALTER TABLE `details`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=73;

--
-- AUTO_INCREMENT for table `doctors`
--
ALTER TABLE `doctors`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=14;

--
-- AUTO_INCREMENT for table `doctors_ledger`
--
ALTER TABLE `doctors_ledger`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `duecollection`
--
ALTER TABLE `duecollection`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `employee_info`
--
ALTER TABLE `employee_info`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `failed_jobs`
--
ALTER TABLE `failed_jobs`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `floor_information`
--
ALTER TABLE `floor_information`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `groups`
--
ALTER TABLE `groups`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=26;

--
-- AUTO_INCREMENT for table `investigation`
--
ALTER TABLE `investigation`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=810;

--
-- AUTO_INCREMENT for table `investigationType`
--
ALTER TABLE `investigationType`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `invoice_ledger`
--
ALTER TABLE `invoice_ledger`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=58;

--
-- AUTO_INCREMENT for table `invoice_master`
--
ALTER TABLE `invoice_master`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=47;

--
-- AUTO_INCREMENT for table `invoice_return`
--
ALTER TABLE `invoice_return`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `labreport`
--
ALTER TABLE `labreport`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=10;

--
-- AUTO_INCREMENT for table `migrations`
--
ALTER TABLE `migrations`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `moduleName`
--
ALTER TABLE `moduleName`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `occupations`
--
ALTER TABLE `occupations`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `patienta_admission`
--
ALTER TABLE `patienta_admission`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patienta_bed_info`
--
ALTER TABLE `patienta_bed_info`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `patientregistration`
--
ALTER TABLE `patientregistration`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=34;

--
-- AUTO_INCREMENT for table `personal_access_tokens`
--
ALTER TABLE `personal_access_tokens`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `sub_department`
--
ALTER TABLE `sub_department`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=40;

--
-- AUTO_INCREMENT for table `throttle`
--
ALTER TABLE `throttle`
  MODIFY `id` int UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=7;

--
-- AUTO_INCREMENT for table `unit_info`
--
ALTER TABLE `unit_info`
  MODIFY `id` int NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `users`
--
ALTER TABLE `users`
  MODIFY `id` bigint UNSIGNED NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `vacutainer`
--
ALTER TABLE `vacutainer`
  MODIFY `id` int NOT NULL AUTO_INCREMENT;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `bed_information`
--
ALTER TABLE `bed_information`
  ADD CONSTRAINT `fk_bed_information_bed_group1` FOREIGN KEY (`bed_group_id`) REFERENCES `bed_group` (`id`),
  ADD CONSTRAINT `fk_bed_information_floor_information1` FOREIGN KEY (`floor_information_id`) REFERENCES `floor_information` (`id`);

--
-- Constraints for table `department`
--
ALTER TABLE `department`
  ADD CONSTRAINT `fk_department_investigationType1` FOREIGN KEY (`investigationType_id`) REFERENCES `investigationType` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
