-- phpMyAdmin SQL Dump
-- version 5.2.1
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3307
-- Generation Time: Nov 17, 2025 at 06:09 PM
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
-- Database: `clubs`
--

-- --------------------------------------------------------

--
-- Table structure for table `admin`
--

CREATE TABLE `admin` (
  `admin_name` varchar(200) NOT NULL,
  `admin_pass` varchar(200) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `admin`
--

INSERT INTO `admin` (`admin_name`, `admin_pass`) VALUES
('admin', 'admin@2025');

-- --------------------------------------------------------

--
-- Table structure for table `carousel`
--

CREATE TABLE `carousel` (
  `sr_no` int(11) NOT NULL,
  `image` varchar(150) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `carousel`
--

INSERT INTO `carousel` (`sr_no`, `image`) VALUES
(0, 'IMG_11884.jpg'),
(0, 'IMG_64948.jpg'),
(0, 'IMG_14598.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `contact_details`
--

CREATE TABLE `contact_details` (
  `sr_no` int(11) NOT NULL,
  `address` varchar(50) NOT NULL,
  `gmap` varchar(300) NOT NULL,
  `pn1` varchar(30) NOT NULL,
  `pn2` varchar(30) NOT NULL,
  `email` varchar(100) NOT NULL,
  `fb` varchar(100) NOT NULL,
  `whatsapp` varchar(100) NOT NULL,
  `insta` varchar(100) NOT NULL,
  `tw` varchar(100) NOT NULL,
  `iframe` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `contact_details`
--

INSERT INTO `contact_details` (`sr_no`, `address`, `gmap`, `pn1`, `pn2`, `email`, `fb`, `whatsapp`, `insta`, `tw`, `iframe`) VALUES
(1, 'Borong, South Sikkim, India', 'https://maps.app.goo.gl/sP9YyMLiVWGASXRA8', '9733399162', '', 'nirkumargurung@gmail.com', 'www.fb.com', 'www.whatsapp.com', 'www.instagram.com', '', 'https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3543.6761951874346!2d88.3489089!3d27.354589999999998!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x39e69184052f28fd:0x7f73a3a40523d719!2sTamu Dhee Homestay!5e0!3m2!1sen!2sin!4v1745584836652!5m2!1sen!2sin');

-- --------------------------------------------------------

--
-- Table structure for table `event`
--

CREATE TABLE `event` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `picture` varchar(120) NOT NULL,
  `desc` longtext NOT NULL,
  `dateofevent` datetime NOT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `event`
--

INSERT INTO `event` (`sr_no`, `name`, `picture`, `desc`, `dateofevent`, `datentime`) VALUES
(2, 'Python', 'IMG_76995.png', 'Python class', '2025-11-20 00:00:00', '2025-11-17 13:12:29');

-- --------------------------------------------------------

--
-- Table structure for table `feedback`
--

CREATE TABLE `feedback` (
  `sr_no` int(11) NOT NULL,
  `club` varchar(120) NOT NULL,
  `feedback` varchar(120) NOT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `helpdesk`
--

CREATE TABLE `helpdesk` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `phoneno` int(120) NOT NULL,
  `helpArea` varchar(120) NOT NULL,
  `club` varchar(120) NOT NULL,
  `message` varchar(120) NOT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp(),
  `seen` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `helpdesk`
--

INSERT INTO `helpdesk` (`sr_no`, `name`, `email`, `phoneno`, `helpArea`, `club`, `message`, `datentime`, `seen`) VALUES
(3, 'Miss. Sangay Pem', '08230184.sce@rub.edu.bt', 17975595, 'academic', 'red-cross', 'xcvbngxfbjklgfxhvj', '2025-11-16 23:31:39', 1);

-- --------------------------------------------------------

--
-- Table structure for table `member`
--

CREATE TABLE `member` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(120) NOT NULL,
  `picture` varchar(120) NOT NULL,
  `email` varchar(120) NOT NULL,
  `phoneno` int(8) NOT NULL,
  `class` varchar(120) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `member`
--

INSERT INTO `member` (`sr_no`, `name`, `picture`, `email`, `phoneno`, `class`) VALUES
(1, 'Miss. Sangay Pem', 'IMG_49069.png', '08230184.sce@rub.edu.bt', 17975595, 'IT Third Year'),
(2, 'Miss. Nima Wangmo', 'IMG_30421.png', '08230160.sce@rub.edu.bt', 17660161, 'IT Third Year'),
(3, 'Miss. Pema Choden', 'IMG_76058.png', '08230166.sce@rub.edu.bt', 77810964, 'IT Third Year'),
(4, 'Mr. Kinley Wangyel Gyeltshen', 'IMG_60215.png', '08230147.sce@rub.edu.bt', 77771945, 'IT Third Year'),
(5, 'Miss. Ugyen Wangmo', 'IMG_27240.png', '08230233.sce@rub.edu.bt', 77695092, 'IT Third Year');

-- --------------------------------------------------------

--
-- Table structure for table `place`
--

CREATE TABLE `place` (
  `sr_no` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `desc` varchar(600) NOT NULL,
  `picture` varchar(100) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `place`
--

INSERT INTO `place` (`sr_no`, `name`, `desc`, `picture`) VALUES
(1, 'Gangtok', 'Believe it or not, but resisting the alluring charm and appeal of Gangtok is almost impossible for anyone! The capital city of Sikkim, Gangtok is nestled in the Eastern Himalayas and is one of the kaleidoscopic tourist destinations in the state.', 'IMG_63823.jpg'),
(2, 'Yuksom', 'Located in the Western parts of Sikkim, Yuksom is the origin of several enthralling treks into the Himalayas or the magical Kanchenjunga. The once a capital of Sikkim, this hamlet is more known for its pristine beauty and rustic appeal.', 'IMG_21540.jpg'),
(3, 'Tsomgo Lake', 'On a visit to Gangtok, do not miss the chance to visit the Tsomgo Lake or the Changu Lake! Located only 38km from Sikkim’s capital, it lies at an altitude of 12,400ft and is one of the highest lakes in India.While the lake remains frozen during the winters, summer brings in a magical charm and appeal to Tsomgo. It is during this time of the year, the turquoise waters of the lake reflects the amazing views of the nearby peaks and the azure sky above', 'IMG_22648.jpg'),
(4, 'Nathula Pass', 'The once a part of the historic ‘Silk Road’, a visit to Nathu La is a must in any of the Sikkim travel packages. One of the highest motorable pass in the world, this amazing pass is located at a towering height of 4,310m above the sea level and connects Sikkim with Tibet.', 'IMG_37193.jpg'),
(6, 'Pelling', 'If you are an ardent fan of the captivating Himalayan Range, Pelling is the destination for you! It is from this Sikkimese town, one can have the best views of the Himalayas and the Kanchenjunga Peak, and can experience the best of their Sikkim holidays.&lt;br&gt;\r\nLocated at a height of 7,200ft above the sea, this scenic town is bestowed with several waterfalls, breath-taking views, natural beauty and adventure options like rafting, kayaking, trekking, mountain biking and several others.', 'IMG_82411.jpg'),
(7, 'Lachung', 'achung has multiple reasons to make you fall in love with it! While its location at an enthralling height of 8,610ft makes it a popular snow-destination in Sikkim, its untouched and surreal beauty makes it one of the scenic as well as charming tourist places in Sikkim.\r\n\r\nLocated in the northern part of Sikkim, this quaint mountain village is adorned by the immaculate beauty of the Lachung Chu River and is also known for the Lachung Gompa. Though this village is one of the mostly visited regions in Sikkim, it still holds an alluring charm that can hardly be found in any other destinations.', 'IMG_88969.jpg'),
(8, 'Ravangla', 'Nestled amidst the Maenam and Tendong Hills, Ravangla is among the best places to visit in Sikkim; especially in the southern part of the state. A scenic town between Gangtok and Pelling, this hill-town also hosts some of the most popular treks in Sikkim.\r\n\r\nMore popular as a paradise for the bird watchers, it is home to some of the most rare and endangered birds in the world. On a usual visit to Ravangla, you can spot dark-throated thrush, verditre flycatchers, blue whistling thrush, babblers, cuckoos and several others.', 'IMG_97440.jpg'),
(9, 'Rumtek Monastery', 'Counted amongst the largest monasteries in Sikkim, Rumtek Monastery is also one of the oldest monasteries in the state. An ode to the Buddhist cultures and traditions, this monastery is located near Gangtok and is also known as the ‘Dharma Chakra Centre’.\r\n\r\nA testimony to the Buddhist architecture and teachings, it is a perfect place to attain mental peace and know more about Buddhism. Its spiritual appeal and grandeur makes it an integral part of any Gangtok travel packages!', 'IMG_20508.jpg'),
(10, 'Namchi', 'Translated into the native Tibetan language, Namchi means the ‘top of the sky’. And on a visit to this magnificent Sikkimese city, this will be proved! Located around 92km from Gangtok and at a height of 1,675m above the sea level, it is also one of the most gorgeous cities in the state.\r\n\r\nMore than tourism, Namchi is more considered as a pilgrimage centre for the Buddhists. Amongst the important religious sites, the Namchi Monastery, Tendong Hill and Ralong Monasteries are the pre-dominant. The city also has a 108ft Lord Shiva statue and is visited a large number of Hindu devotees as well.', 'IMG_39997.jpg'),
(11, 'Zuluk', 'Touching a towering height of 10,000ft, Zuluk is one of the least discovered destinations in the entire of Sikkim. Located on the ancient ‘Silk Route’, this quaint Sikkimese village takes the pride of being a vintage point to enjoy panoramic views of the Mt Kanchenjunga.\r\n\r\nIn addition to the magical beauty of this hamlet, it is also popular among the adventure lovers as the ride to Zuluk takes them through 32 hair-pin bends.', 'IMG_38657.jpg');

-- --------------------------------------------------------

--
-- Table structure for table `rooms`
--

CREATE TABLE `rooms` (
  `id` int(11) NOT NULL,
  `name` varchar(150) NOT NULL,
  `purpose` longtext NOT NULL,
  `activities` longtext NOT NULL,
  `contribution` longtext NOT NULL,
  `desc` varchar(350) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `rooms`
--

INSERT INTO `rooms` (`id`, `name`, `purpose`, `activities`, `contribution`, `desc`) VALUES
(15, 'Literary Society', 'The Literary Society aims to foster a thriving community of students who share interest in writing and critical thinking. Our activities focus on personal growth and skill development that can be applied in academic and professional contexts, while also contributing to the cultural and creative landscape of the college.\r\n\r\nWith this new culture, society provides important avenues for expression and engagement, encouraging participation in a variety of literary activities that showcase individual talent and collaborative efforts.', 'Creative Writing Workshops - exploring different genres, styles, and techniques\r\nSkill Development - focusing on developing communication and leadership skills\r\nDebating Competitions - enhancing critical thinking and public speaking abilities\r\nLiterary Magazine Publication - showcasing student works and creative expressions\r\nBook Club Discussions - analyzing and discussing literary works\r\nPoetry Recitations - providing platforms for poetic expression', 'The Literary Society offers a platform for students to engage with literary culture while developing skills that support academic success and personal growth. Through various initiatives, we aim to:\r\n\r\nCommunication Skills - helping students articulate ideas effectively\r\nCritical Thinking - fostering analytical skills through literary analysis\r\nCollaboration and Community - fostering connections among students with shared interests\r\nCultural Events - organizing literary weeks, author talks, and creative showcases', 'The Literary Society of Samtse College of Education is a vibrant club for all literature enthusiasts, aspiring writers, passionate readers, and those who enjoy expressing their creative experiences. It provides a community platform for students to explore the world of words, ideas, and expressions in an inclusive environment.'),
(16, 'Bhutan Red Cross Society', 'The Red Cross Society aims to provide immediate response to emergencies, promote health and safety awareness, and engage in community service activities that benefit both the college and the wider community.', 'First Aid Training and Certification\r\nBlood Donation Drives\r\nDisaster Preparedness Workshops\r\nCommunity Health Awareness Programs\r\nFundraising for Humanitarian Causes', 'gvvg', 'The Red Cross Society at Samtse College of Education is committed to humanitarian services, first aid training, and community outreach programs. Our mission is to alleviate human suffering and promote a culture of non-violence and peace.');

-- --------------------------------------------------------

--
-- Table structure for table `room_images`
--

CREATE TABLE `room_images` (
  `sr_no` int(11) NOT NULL,
  `club_id` int(11) NOT NULL,
  `image` varchar(150) NOT NULL,
  `thumb` tinyint(4) NOT NULL DEFAULT 0
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

CREATE TABLE `settings` (
  `sr_no` int(11) NOT NULL,
  `site_title` varchar(50) NOT NULL,
  `site_about` longtext NOT NULL,
  `shutdown` tinyint(1) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`sr_no`, `site_title`, `site_about`, `shutdown`) VALUES
(1, 'College Club and Events', 'sdaf', 0);

-- --------------------------------------------------------

--
-- Table structure for table `user_cred`
--

CREATE TABLE `user_cred` (
  `id` int(11) NOT NULL,
  `name` varchar(100) NOT NULL,
  `email` varchar(100) NOT NULL,
  `phonenum` varchar(30) NOT NULL,
  `profile` varchar(200) NOT NULL,
  `address` varchar(200) NOT NULL,
  `pincode` varchar(11) NOT NULL,
  `dob` date NOT NULL,
  `password` varchar(300) NOT NULL,
  `status` int(11) NOT NULL DEFAULT 1,
  `token` varchar(64) DEFAULT NULL,
  `t_expire` datetime DEFAULT NULL,
  `datentime` datetime NOT NULL DEFAULT current_timestamp()
) ENGINE=InnoDB DEFAULT CHARSET=utf8mb4 COLLATE=utf8mb4_general_ci;

--
-- Dumping data for table `user_cred`
--

INSERT INTO `user_cred` (`id`, `name`, `email`, `phonenum`, `profile`, `address`, `pincode`, `dob`, `password`, `status`, `token`, `t_expire`, `datentime`) VALUES
(8, 'Pema Tshewang Norbu', 'ptshewang505@gmail.com', '17831390', 'IMG_93936.jpeg', 'Sonamthang', '34103', '2003-03-15', '$2y$10$LJOn98jzrXYt5hLXDxVBGOB954ISDqHf.HzTdgwGVCPrtLyaRxlq.', 1, NULL, NULL, '2025-05-17 03:51:02');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `admin`
--
ALTER TABLE `admin`
  ADD PRIMARY KEY (`admin_name`);

--
-- Indexes for table `contact_details`
--
ALTER TABLE `contact_details`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `event`
--
ALTER TABLE `event`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `feedback`
--
ALTER TABLE `feedback`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `helpdesk`
--
ALTER TABLE `helpdesk`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `member`
--
ALTER TABLE `member`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `place`
--
ALTER TABLE `place`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `rooms`
--
ALTER TABLE `rooms`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `room_images`
--
ALTER TABLE `room_images`
  ADD PRIMARY KEY (`sr_no`),
  ADD KEY `room_id` (`club_id`);

--
-- Indexes for table `settings`
--
ALTER TABLE `settings`
  ADD PRIMARY KEY (`sr_no`);

--
-- Indexes for table `user_cred`
--
ALTER TABLE `user_cred`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `contact_details`
--
ALTER TABLE `contact_details`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `event`
--
ALTER TABLE `event`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=3;

--
-- AUTO_INCREMENT for table `feedback`
--
ALTER TABLE `feedback`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=8;

--
-- AUTO_INCREMENT for table `helpdesk`
--
ALTER TABLE `helpdesk`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `member`
--
ALTER TABLE `member`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=6;

--
-- AUTO_INCREMENT for table `place`
--
ALTER TABLE `place`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- AUTO_INCREMENT for table `rooms`
--
ALTER TABLE `rooms`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=17;

--
-- AUTO_INCREMENT for table `room_images`
--
ALTER TABLE `room_images`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=27;

--
-- AUTO_INCREMENT for table `settings`
--
ALTER TABLE `settings`
  MODIFY `sr_no` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `user_cred`
--
ALTER TABLE `user_cred`
  MODIFY `id` int(11) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=12;

--
-- Constraints for dumped tables
--

--
-- Constraints for table `room_images`
--
ALTER TABLE `room_images`
  ADD CONSTRAINT `room_images_ibfk_1` FOREIGN KEY (`club_id`) REFERENCES `rooms` (`id`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
