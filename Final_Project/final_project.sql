START TRANSACTION;
SET time_zone = "+00:00";


CREATE DATABASE IF NOT EXISTS final_project;

--
-- Database: 'final_project'
--

USE final_project;

-- Drop existing tables if they exist
DROP TABLE IF EXISTS `Applications`;
DROP TABLE IF EXISTS `Student`;
DROP TABLE IF EXISTS `schools`;
DROP TABLE IF EXISTS `Category`;
DROP TABLE IF EXISTS `Status`;
DROP TABLE IF EXISTS `Role`;

-- Create the Category table
CREATE TABLE `Category` (
  `CategoryID` int(12) NOT NULL ,
  `cname` varchar(50) NOT NULL,
  PRIMARY KEY (`CategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert data into the Category table
INSERT INTO `Category` (`CategoryID`, `cname`) VALUES
(1, 'A '),
(2, 'B '),
(3, 'C ');

-- Create the Role table
CREATE TABLE `Role` (
  `RoleID` int(12) NOT NULL ,
  `rname` varchar(50) NOT NULL,
  PRIMARY KEY (`RoleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert data into the Role table
INSERT INTO `Role` (`RoleID`, `rname`) VALUES
(1, 'superadmin'),
(2, 'admin'),
(3, 'standard');

-- Create the Status table
CREATE TABLE `Status` (
  `StatusID` int(11) NOT NULL ,
  `sname` varchar(50) NOT NULL,
  PRIMARY KEY (`StatusID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert data into the Status table
INSERT INTO `Status` (`StatusID`, `sname`) VALUES
(1, 'Applied'),
(2, 'Accepted'),
(3, 'Rejected'),
(4, 'Waitlisted');

-- Create the Student table
CREATE TABLE `Student` (
  `StudentID` int(11) NOT NULL auto_increment,
  `RoleID` int(11) NOT NULL,
  `fname` varchar(50) NOT NULL,
  `lname` varchar(50) NOT NULL,
  `gender` char(1) NOT NULL,
  `dob` date NOT NULL,
  `contact` int(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `password` varchar(255) NOT NULL,
  PRIMARY KEY (`StudentID`),
  CONSTRAINT `FK_Student_Role` FOREIGN KEY (`RoleID`) REFERENCES `Role` (`RoleID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create the schools table
CREATE TABLE `schools` (
  `CategoryID` int(11) NOT NULL,
  `region` varchar(50) NOT NULL,
  `district` varchar(50) NOT NULL,
  `school_code` INT(10) NOT NULL,
  `school_name` varchar(100) NOT NULL,
  `location` varchar(100) NOT NULL,
  `gender` varchar(10) NOT NULL,
  `day_boarding` varchar(10) NOT NULL,
  PRIMARY KEY (`school_code`),
  CONSTRAINT `FK_schools_Category` FOREIGN KEY (`CategoryID`) REFERENCES `Category` (`CategoryID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Create the Applications table
CREATE TABLE `Applications` (
  `applicationID` int(11) NOT NULL AUTO_INCREMENT,
  `StudentID` int(11) NOT NULL,
  `school_name` VARCHAR(100) NOT NULL,
  `school_code` int(11) NOT NULL,
  `StatusID` int(11) NOT NULL,
  `CourseID` int(11) NOT NULL,
  `CategoryID` int(11) NOT NULL,
  PRIMARY KEY (`applicationID`), 
  CONSTRAINT `FK_Applications_Student` FOREIGN KEY (`StudentID`) REFERENCES `Student` (`StudentID`),
  CONSTRAINT `FK_Applications_Status` FOREIGN KEY (`StatusID`) REFERENCES `Status` (`StatusID`),
  CONSTRAINT `FK_Applications_schools` FOREIGN KEY (`school_code`) REFERENCES `schools` (`school_code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;


CREATE TABLE `Courses` (
  `CourseID` int(11) NOT NULL AUTO_INCREMENT,
  `course_name` varchar(100) NOT NULL,
  PRIMARY KEY (`CourseID`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- Insert some sample courses
INSERT INTO `Courses` (`course_name`) VALUES
('General Science'),
('General Arts'),
('Visual Arts'),
('Home Economics'),
('Business'),
('Clothing and Textiles'),
('Wood working'),
('Technical Drawing'),
('Construction');


-- Step 2: Insert the provided data into the "schools" table
INSERT INTO schools (CategoryID, region, district, school_code, school_name, location, gender, day_boarding) VALUES
(1, 'Ahafo', 'Asutifi North', '0061201', 'OLA Girls Senior High', 'Kenyasi',  'Girls', 'Boarding'),
(1, 'Ahafo', 'Tano North', '0060203', 'Serwaa Kesse Girls Senior High', 'Duayaw Nkwanta', 'Girls', 'Boarding'),
(1, 'Ashanti', 'Kumasi Metro', '0050102', 'St. Louis Senior High, Kumasi', 'Oduom-Kumasi', 'Girls', 'Boarding'),
(1, 'Ashanti', 'Kumasi Metro', '0050111', 'Kumasi High School', 'Gyinyase-Kumasi', 'Mixed', 'Boarding'),
(1, 'Ashanti', 'Kumasi Metro', '0050110', 'Opoku Ware School', 'Santasi-Kumasi', 'Boys', 'Boarding'),
(1, 'Ashanti', 'Kumasi Metro', '0050108', 'Prempeh College', 'Sofoline-Kumasi', 'Boys', 'Boarding'),
(1, 'Ashanti', 'Kumasi Metro', '0050104', 'T. I. Ahmadiyya Senior High, Kumasi', 'Kumasi - Stadium', 'Mixed', 'Boarding'),
(1, 'Ashanti', 'Kumasi Metro', '0050201', 'Yaa Asantewaa Girls Senior High', 'Tanoso-Kumasi', 'Girls', 'Boarding'),
(1, 'Bono Central', 'Cape Coast Metro', '0030107', 'Wesley Girls Senior High, Cape Coast', 'Cape Coast', 'Girls', 'Boarding'),
(1, 'Central', 'Mfantsiman Municipal', '0030301', 'Mantsiman Girls Senior High', 'Saltpond', 'Girls', 'Boarding'),
(1, 'Eastern', 'Akwapim North', '0020402', 'Okuapeman Senior High', 'Akropong', 'Mixed', 'Boarding'),
(1, 'Eastern', 'Akwapim South', '0020301', 'Aburi Girls Senior High', 'Aburi', 'Girls', 'Boarding'),
(1, 'Eastern', 'Denkyembour', '0021103', "St. Rose's Senior High, Akwatia", 'Akwatia', 'Girls', 'Boarding'),
(1, 'Eastern', 'East Akim Municipal', '0021302', 'Ofori Panin Senior High', 'Kukurantumi', 'Mixed', 'Boarding'),
(1, 'Eastern', 'Kwahu East', '0021003', "St. Peter's Senior High, Nkwatia", 'Nkwatia', 'Boys', 'Boarding'),
(1, 'Eastern', 'Lower Manya Krobo', '0021501', 'Krobo Girls Senior High', 'Odumase', 'Girls', 'Boarding'),
(1, 'Eastern', 'New Juaben Municipal', '0020104', 'Ghana Senior High, Koforidua', 'Koforidua', 'Mixed', 'Boarding'),
(1, 'Volta', 'Ho Municipal', '0070101', 'OLA Girls Senior High, Ho', 'Ho', 'Girls', 'Boarding'),
(1, 'Volta', 'Kpando', '0070601', 'Bishop Herman College', 'Kpando', 'Mixed', 'Boarding'),
(1, 'Western', 'Sekondi-Takoradi Metro', '0040103', 'Archbishop Porter Girls Senior High.', 'Sekondi', 'Girls', 'Boarding'),
(1, 'Western', 'Sekondi-Takoradi Metro', '0040104', 'Ghana Senior High/Tech', 'Takoradi', 'Mixed', 'Boarding'),
(1, 'Western', 'Sekondi-Takoradi Metro', '0040102', 'Sekondi College', 'Sekondi', 'Mixed', 'Boarding'),
(1, 'Western', 'Sekondi-Takoradi Metro', '0040109', "St. John's Senior High, Sekondi", 'Sekondi', 'Boys', 'Boarding'),
(1, 'Western', 'Sekondi-Takoradi Metro', '0040107', 'Fijai Senior High', 'Sekondi', 'Girls', 'Boarding'),
(1, 'Ashanti', 'Kumasi Metro', '9060901', 'Kumasi Technical Institute', 'Kumasi', 'Mixed', 'Boarding'),
(1, 'Eastern', 'New Juaben', '9020101', 'Koforidua Technical Institute', 'Koforidua', 'Mixed', 'Boarding'),
(1, 'Eastern', 'Denkyembour', '9021101', 'Akwatia Technical Institute', 'Akwatia', 'Mixed', 'Boarding'),
(1, 'Eastern', 'Abuakwa North', '9021301', "St. Paul's Technical Institute", 'Kukurantumi', 'Mixed', 'Boarding'),
(1, 'Greater Accra', 'Ayawaso Central', '9010109', 'Accra Technical Training Centre', 'Kokomlemle', 'Mixed', 'Day'),
(1, 'Greater Accra', 'Tema', '9011601', 'Tema Technical Institute', 'Tema', 'Mixed', 'Day'),
(1, 'Greater Accra', 'Ada East', '9010111', 'Ada Technical Institute', 'Ada', 'Mixed', 'Boarding'),
(1, 'Northern', 'Tamale Metro', '9080101', 'Dabokpa Vocational Technical Institute', 'Tamale', 'Mixed', 'Boarding'),
(1, 'Upper East', 'Bawku Municipal', '9090101', 'Bawku Technical Institute', 'Bawku', 'Mixed', 'Boarding'),
(1, 'Upper East', 'Bolgatanga', '9090401', 'Bolgatanga Technical Institute', 'Bolgatanga', 'Mixed', 'Boarding'),
(1, 'Upper West', 'Wa Municipal', '9100101', 'Wa Technical Institute', 'Wa', 'Mixed', 'Boarding'),
(1, 'Volta', 'Keta', '9070501', 'Anlo Technical Institute', 'Anloadd', 'Mixed', 'Boarding'),
(2, 'Ahafo', 'Tano South', '0060207', 'Derma Comm. D School', 'Derma', 'Mixed', 'Day'),
(2, 'Ahafo', 'Tano South', '0060202', 'Samuel Otu Presby Senior High.', 'Techimantia','Boys', 'Boarding'),
(2, 'Ahafo', 'Tano South', '0060201', 'Bechem Presby Senior High', 'Bechem', 'Mixed', 'Boarding'),
(2, 'Ashanti', 'Adansi North', '0051201', 'Dompoase Senior High', 'Dompoase', 'Mixed', 'Boarding'),
(2, 'Ashanti', 'Adansi North', '0051203', 'Fomena T.I. Ahmad Senior High', 'Fomena', 'Mixed', 'Boarding'),
(2, 'Ashanti', 'Adansi North', '0051206', 'Asare Bediako Senior High', 'Akrokerri', 'Mixed', 'Boarding'),
(2, 'Ashanti', 'Adansi South', '0051301', 'New Edubiase Senior High', 'New Edubiase', 'Mixed', 'Boarding'),
(2, 'Ashanti', 'Adansi South', '0051205', 'Akrofuom Senior High/Tech', 'Akrofuom', 'Mixed', 'Boarding'),
(2, 'Ashanti', 'Afigya-Kwabere', '0050604', 'Otumfuo Osei Tatul Callann', 'Tetrem', 'Mixed', 'Boarding'),
(2, 'Bono', 'Jaman South', '0060501', 'Drobo Senior High', 'Drobo', 'Mixed', 'Boarding'),
(2, 'Bono', 'Sunyani Municipal', '0060111', 'S.D.A Senior High, Sunyani', 'Sunyani', 'Boys',  'Day'),
(2, 'Bono', 'Sunyani Municipal', '0060101', 'Twene Amanfo Senior High/Tech.', 'Sunyani', 'Mixed', 'Day'),
(2, 'Bono', 'Sunyani West', '0060105', 'Sacred Heart Senior High', 'Nsoatre', 'Boys', 'Boarding'),
(2, 'Bono', 'Sunyani West', '0060103', 'Odomaseman Senior High', 'Odomase', 'Mixed', 'Boarding'),
(2, 'Bono', 'Sunyani West', '0060102', 'Chiraa Senior High', 'Chiraa', 'Mixed', 'Boarding'),
(2, 'Bono', 'Tain', '0060605', 'Menji Senior High', 'Menji', 'Mixed', 'Day'),
(2, 'Bono', 'Tain', '0060608', 'Nsawkaw State Senior High', 'Nsawkaw', 'Mixed', 'Boarding'),
(2, 'Bono', 'Tain', '0060602', 'Badu Senior High/Tech.', 'Badu/Wenchi', 'Mixed', 'Boarding'),
(2, 'Bono', 'Tain', '0060604', 'Nkoranman Senior High', 'Seikwa', 'Mixed', 'Day'),
(2, 'Ashanti', 'Asokore Mampong Municipal', '0050150', 'Sakafia Islamic Senior High', 'Sawaba', 'Mixed', 'Boarding'),
(2, 'Ashanti', 'Atwima Kwanwoma', '0051701', 'Afua Kobi Ampem Senior High', 'Trabuom', 'Girls', 'Boarding'),
(2, 'Ashanti', 'Atwima Mponua', '0050205', 'Mpasatia Senior High/Tech', 'Mpasatia','Boys' ,'Boarding'),
(2, 'Ashanti', 'Atwima Nwabiagya', '0050203', 'Osei Tutu Senior High', 'Akropong', 'Mixed','Boarding' ),
(2, 'Ashanti', 'Atwima Nwabiagya', '0050202', 'Toase Senior High', 'Toase', 'Mixed', 'Boarding'),
(2, 'Ashanti', 'Bekwai Municipal', '0050301', 'S.D.A. Senior High, Bekwai', 'Bekwai', 'Mixed', 'Boarding'),
(2, 'Ashanti', 'Bekwai Municipal', '0050304', 'St. Joseph Senior High/Tech., Ahwiren', 'Ahwiren', 'Mixed', 'Boarding'),
(2, 'Ashanti', 'Bekwai Municipal', '0050172', 'Ofoase Kokoben Senior High', 'Ofoase Kokobin','Boys', 'Boarding'),
(2, 'Ashanti', 'Bekwai Municipal', '0050302', 'Oppong Mem. Senior High', 'Kokofu','Boys', 'Boarding'),
(2, 'Ashanti', 'Bosomtwe', '0051702', 'Beposo Senior 1linh', 'Beposo', 'Mixed', 'Boarding'),
(2, 'Greater Accra', 'Ningo Prampram', '0010403', 'Ningo Senior High', 'Old Ningo', 'Mixed', 'Boarding'),
(2, 'Greater Accra', 'Ningo Prampram', '0010404', 'Prampram Senior High', 'Prampram', 'Mixed', 'Boarding'),
(2, 'Greater Accra', 'Shai-Osudoku', '0010401', 'Ghanata Senior High', 'Dodowa', 'Mixed', 'Boarding'),
(2, 'Greater Accra', 'Tema Metro', '0010202', 'Chemu Senior High/Tech', 'Tema Comm 4', 'Mixed', 'Day'),
(2, 'Greater Accra', 'Tema Metro', '0010213', 'Our Lady of Mercy Senior High', 'Tema Comm 4','Mixed' ,'Day' ),
(2, 'Northern', 'Tamale Metro', '0080109', 'Tamale G Senior High', 'Tamale', 'Girls', 'Boarding'),
(2, 'Northern', 'Sagnerigu', '0080105', 'Kalpohin Senior High', 'Tamale', 'Mixed', 'Boarding'),
(2, 'Northern', 'Yendi Municipal', '0080801', 'Yendi Senior High', 'Yendi', 'Boys', 'Boarding'),
(2, 'Oti', 'Jasikan', '0071105', 'Baglo Ridge Senior High/Tech.', 'Baglo', 'Mixed', 'Boarding'),
(2, 'Oti', 'Jasikan', '0071104', 'Okadjakrom Senior High/Tech.', 'Okadjakrom', 'Mixed', 'Boarding'),
(2, 'Oti', 'Jasikan', '0071101', 'Bueman Senior lasikan', 'lasikan', 'Boys', 'Boarding'),
(2, 'Western', 'Shama Ahanta East', '0040106', 'Anantaman U Senior High', 'Sekondi-Ketan', 'Girls', 'Boarding'),
(2, 'Western', 'Tarkwa-Nsuaem Municipal', '0040904', 'Tarkwa Senior High', 'Tarkwa', 'Mixed', 'Boarding'),
(2, 'Western', 'Wassa Amenfi East', '0040502', 'Amenfiman Senior Wasa High', 'Akropong', 'Mixed', 'Boarding'),
(2, 'Western North', 'Bia West', '0040802', 'Bia Senior High/Tech', 'Debiso Essiam', 'Mixed', 'Boarding'),
(2, 'Western North', 'Bibiani/Anhwiaso/Bekwai', '0040702', 'Sefwi Bekwai Senior High', 'Sefwi Bekwai', 'Mixed', 'Boarding'),
(2, 'Western North', 'Bodi', '0040803', 'Bodi Senior High', 'Bodi', 'Mixed', 'Day'),
(2, 'Western North', 'Juaboso', '0040801', 'Juaboso Senior High', 'Juaboso', 'Mixed', 'Boarding'),
(2, 'Western North', 'Sefwi Akontombra', '0040604', 'Akontombra Senior High', 'Akontombra', 'Mixed', 'Boarding'),
(2, 'Western North', 'Sefwi Wiawso', '0040601', 'Sefwi-Wiawso Senior High', 'Sefwi-Wiawso', 'Mixed', 'Boarding'),
(2, 'Western North', 'Sefwi Wiawso', '0040602', 'Sefwi-Wiawso Senior High/Tech', 'Sefwi-Wiawso', 'Mixed', 'Boarding'),
(2, 'Central', 'Ekumfi', '0030302', 'Ahmadiiyya Snr. High', 'Esakyir', 'Mixed', 'Boarding'),
(2, 'Central', 'Gomoa West', '0030501', 'Apam Senior High', 'Apam', 'Mixed', 'Boarding'),
(2, 'Central', 'Gomoa West', '0030504', 'Mozano Senior High', 'Mozano', 'Mixed', 'Boarding'),
(2, 'Central', 'Komenda Municipal', '0030201', 'Edinaman Senior High', 'Elmina', 'Mixed', 'Boarding'),
(2, 'Central', 'Mfantsiman Municipal', '0030304', 'Methodist High School, Saltpond', 'Saltpond', 'Mixed', 'Boarding'),
(2, 'Central', 'Twifo Ati-Morkwa', '0031101', 'Twifo Praso Senior High', 'Twifo Praso', 'Mixed', 'Boarding'),
(2, 'Central', 'Twifo Hemang Lower Denkyira', '0031104', 'Twifo Hemang Senior High/Tech', 'Heman', 'Mixed', 'Boarding'),
(2, 'Central', 'Upper Denkyira East Municipal', '0031001', 'Boa-Amponsem Senior High', 'Dunkwa-On-Offin', 'Mixed', 'Boarding'),
(2, 'Central', 'Upper Denkyira West', '0031003', 'Diaso Senior High', 'Diaso', 'Mixed', 'Boarding'),
(2, 'Eastern', 'Akwapim North', '0020410', 'Methodist G Senior Hiah.', 'Mamfe', 'Girls', 'Boarding'),
(2, 'Eastern', 'Kwahu South', '0021005', 'Kwahu Ridge Senior High', 'Obo-Kwahu', 'Mixed', 'Boarding'),
(2, 'Eastern', 'Kwahu West Municipal', '0021004', 'Nkawkaw Senior High', 'Nkawkaw', 'Mixed', 'Boarding'),
(2, 'Eastern', 'Lower Manya Krobo', '0021502', 'Manya Krobo Senior High', 'New Nuaso', 'Mixed', 'Boarding'),
(2, 'Eastern', 'New Juaben', '0020108', 'Pentecost Senior High,Koforidua', 'Koforidua', 'Mixed', 'Boarding'),
(2, 'Eastern', 'New Juaben Municipal', '0020109', 'S.D.A Senior High, Koforidua', 'Asokore-Koforidua', 'Boys' ,'Boarding'),
(2, 'Eastern', 'New Juaben Municipal', '0020106', 'Oyoko Methodist Senior High', 'Oyoko', 'Mixed', 'Boarding'),
(2, 'Eastern', 'New Juaben Municipal', '0020103', 'New Juaben Senior High/Com', 'Koforidua', 'Mixed', 'Boarding'),
(2, 'Eastern', 'New Juaben Municipal', '0020105', 'Oti Boateng Senior High', 'Ada/Koforidua', 'Mixed', 'Boarding'),
(2, 'Eastern', 'Nsawam Adoagyiri', '0020303', 'St. Martins Senior High, Nsawam', 'Nsawam', 'Mixed', 'Boarding'),
(2, 'Eastern', 'Suhum Municipal', '0020204', 'Islamic G Senior Korase-Suhum', 'Korase-Suhum', 'Girls', 'Boarding'),
(3,'Ashanti', 'Sekyere East', '0051806', 'High/Tech', 'Effiduase', 'Mixed', 'Day' ),
(3,'Ashanti', 'Sekyere East', '0051801', 'Effiduase Senior High/Com', 'Effiduase', 'Mixed', 'Boarding'),
(3,'Ashanti', 'Sekyere Kumawu', '0051804', 'Dadease Agric Senior High', 'Dadease', 'Mixed', 'Boarding'),
(3,'Ashanti', 'Sekyere Kumawu', '0051808', 'Bodomase Senior High/Tech', 'Bodomase', 'Mixed', 'Day'),
(3,'Ashanti', 'Sekyere South', '0050605', 'Adu Gyamfi Senior High', 'Jamasi', 'Boarding', ''),
(3,'Ashanti', 'Ahafo Ano South', '0051503', 'Sabronum Methodist Senior High/Tech', 'Sabronum/Habitat', 'Mixed', 'Day'),
(3,'Ashanti', 'Kumasi Metro', '0050117', 'Prince Of Peace G South Suntreso', 'Kumasi', 'Girls', 'Day'),
(3,'Ashanti', 'Asante Akim South', '0051007', 'Jubilee Senior High', 'Dampong', 'Mixed', 'Day'),
(3,'Ashanti', 'Ejisu Juaben', '0051607', 'Church Of Christ Senior High', 'Adadientem', 'Mixed', 'Boarding'),
(3,'Ashanti', 'Asante Akim South', '0051008', 'Kurofa Methodist Senior High', 'Kurofa', 'Mixed', 'Day'),
(3,'Bono East', 'Sene East', '0061103', 'Bassa Community Senior High', 'Bassa', 'Mixed', 'Day'),
(3,'Bono East', 'Atebubu-Amantin', '0060409', 'New Krokompe Comm. Senior High', 'New Krokompe', 'Mixed', 'Boarding'),
(3,'Bono East', 'Techiman', '0060715', 'Abrafi Senior High Techiman', 'Techiman', 'Mixed', 'Day'),
(3,'Central', 'Abura/Asebu/Kwamankese', '0030406', 'Moree Comm. Senior High', 'Moree', 'Mixed', 'Day'),
(3,'Central', 'Abura/Asebu/Kwamankese', '0030402', 'Aburaman Senior High', 'Abura Dunkwa', 'Mixed' ,'Boarding'),
(3,'Central', 'Abura/Asebu/Kwamankese', '0030403', 'Abakrampa Senior High/Tech', 'Abakrampa', 'Mixed', 'Boarding'),
(3,'Central', 'Agona East', '0030909', 'Agona Namonwora Comm. Senior High', 'Agona Namonwora', 'Mixed', 'Day'),
(3,'Central', 'Agona East', '0030904', 'Kwanyako Senior High', 'Kwanyako', 'Mixed', 'Boarding'),
(3,'Central', 'Agona West', '0030915', 'Agona Fankobaa Conior Winh', 'Agona Fankobaa', 'Mixed', 'Day'),
(3,'Greater Accra', 'Accra Metro', '0010104', 'Holy Trinity Senior High', 'High Street-Accra', 'Mixed', 'Day'),
(3,'Greater Accra', 'Accra Metro', '0010120', 'Kaneshie Senior High/Tech', 'Kaneshie','Mixed', 'Day'),
(3,'Greater Accra', 'Accra Metro', '0010109', 'Kinbu Senior High/Tech', 'Tudu - Accra', 'Mixed', 'Day'),
(3,'Greater Accra', 'Ada West', '0010302', 'Ada Senior High/Tech', 'Sege', 'Mixed', 'Boarding'),
(3,'Greater Accra', 'Adentan', '0010535', 'Frafraha Comm. Senior High', 'Frafraha', 'Mixed', 'Day'),
(3,'Greater Accra', 'Ashiaman Municipal', '0010203', 'Ashiaman Senior High', 'Ashiaman', 'Mixed', 'Day'),
(3,'Greater Accra', 'Ga East Municipal', '0010534', 'Kwabenya Comm. Senior High', 'Kwabenya', 'Mixed','Day'),
(3,'Greater Accra', 'Ga South Municipal', '0010119', 'Christian Methodist Senior High', 'Aplaku (Weija)', 'Mixed', 'Day'),
(3,'Greater Accra', 'Ga South Municipal', '0010503', 'Ngleshie Amanfro Senior High', 'Ngleshie Amanfro', 'Mixed', 'Day'),
(3,'Eastern', 'Afram Plains (Kwahu South)', '0020902', 'St. Fidelis Senior High/Tech', 'Tease', 'Mixed', 'Boarding'),
(3,'Eastern', 'Akwapim North', '0020404', 'Presby Senior High/Tech For The Deaf', 'Mampong', 'Mixed', 'Boarding'),
(3,'Eastern', 'Akwapim North', '0020408', 'Presby Senior High, Mampong', 'Akwapim Mampong-Akwapim', 'Mixed', 'Boarding'),
(3,'Eastern', 'Akwapim North', '0020405', 'Presby Senior High/Tech, Larteh', 'Larteh-Kubease', 'Mixed', 'Boarding'),
(3,'Eastern', 'Akwapim North', '0020406', 'Mount Sinai Senior High', 'Akropong', 'Mixed', 'Boarding'),
(3,'Eastern', 'Akwapim North', '0020407', 'Presby Senior High/Tech, Adukrom', 'Adukrom', 'Mixed', 'Boarding'),
(3,'Eastern', 'Akwapim North', '0020409', 'Mangoase Senior High', 'Mangoase', 'Mixed', 'Boarding'),
(3,'Eastern', 'Akwapim South', '0020305', 'Presby Senior High/Tech, Aburi', 'Aburi', 'Mixed', 'Boarding');





-- Indexes for table `Applications`
--
ALTER TABLE `Applications`
  ADD KEY `FK_Applications_Student` (`StudentID`),
  ADD KEY `FK_Applications_Status` (`StatusID`),
  ADD KEY `FK_Applications_schools` (`school_code`);

--
-- Indexes for table `Category`
--





--
-- AUTO_INCREMENT for table `Role`
--
ALTER TABLE `Role`
  MODIFY `RoleID` int(12) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `Status`
--
ALTER TABLE `Status`
  MODIFY `StatusID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=5;

--
-- AUTO_INCREMENT for table `Student`
--
ALTER TABLE `Student`
  MODIFY `StudentID` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=16;

--
-- AUTO_INCREMENT for table `schools`
--
ALTER TABLE `schools`
  MODIFY `school_code` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;





COMMIT;


