-- phpMyAdmin SQL Dump
-- version 4.8.3
-- https://www.phpmyadmin.net/
--
-- Host: localhost:3306
-- Generation Time: Dec 18, 2018 at 09:29 AM
-- Server version: 5.7.24
-- PHP Version: 7.2.7

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
SET AUTOCOMMIT = 0;
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `cspghsed_home`
--

-- --------------------------------------------------------

--
-- Table structure for table `academic`
--

CREATE TABLE `academic` (
  `id` int(9) NOT NULL,
  `title` varchar(200) NOT NULL,
  `category` int(9) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `file` varchar(255) DEFAULT NULL,
  `dateAdd` varchar(15) NOT NULL,
  `eventdate` varchar(40) NOT NULL,
  `publication_status` int(4) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `academic`
--

INSERT INTO `academic` (`id`, `title`, `category`, `content`, `file`, `dateAdd`, `eventdate`, `publication_status`) VALUES
(14, 'ভর্তি তথ্য ', 14, '                                                                                                                                                                                                                        ', 'uploads/file/Admission_free2.jpg', '2017/12/28', '১০/১২/২০১৮', 1),
(16, 'আগামী ০১-০৯-২০১৮ ইং হইতে এস এস সি নির্বাচনী পরীক্ষা ও জে এস সি চূড়ান্ত মডেল টেষ্ট পরীক্ষা শুরু।', 7, '                                                                                                                                                                                                                                                                                                                                    ', NULL, '2018/09/23', '', 1),
(17, '২০১৮ সালের নির্বাচনী পরীক্ষার ফলাফল আজ বেলা ১২.০০ ঘটিকায় স্কুল নোটিশ বোর্ডে প্রকাশ করা হবে।', 7, '                                                                                                                                                                                                                        ', NULL, '2018/10/30', '', 2),
(18, '২০১৯ শিক্ষাবর্ষে ৬ষ্ঠ শ্রেণিতে অনলাইনে ভর্তি কার্যক্রম শুরু হয়েছে। ভর্তি সংক্রান্ত যে কোন তথ্য জানার জন্য যোগাযোগ করুন: ০১৮১৮-৫৮৬৭০৭, ০১৮১৯-০১৭১২১', 7, '                                                                                                                                                                                                                        ', NULL, '2018/11/26', '', 1),
(19, 'এডমিট কার্ড প্রিন্ট  করার উপায়, ১ ', 14, '  এডমিট কার্ড প্রিন্ট করার উপায়, ১ \r\n\r\nChrome Browser থেকে                                                                                                         ', 'uploads/file/Admit_Card.JPG', '2018/12/10', '১০/১২/২০১৮', 1),
(20, 'এডমিট কার্ড প্রিন্ট করার উপায়, ২', 14, '                                                        এডমিট কার্ড প্রিন্ট করার উপায়, ২ \r\n\r\nChrome Browser থেকে                                                     ', 'uploads/file/Admit_card_2.JPG', '2018/12/10', '১০/১২/২০১৮', 1);

-- --------------------------------------------------------

--
-- Table structure for table `career`
--

CREATE TABLE `career` (
  `ca_id` int(9) NOT NULL,
  `postName` varchar(100) NOT NULL,
  `requirement` varchar(500) NOT NULL,
  `date_add` varchar(15) NOT NULL,
  `file` varchar(100) NOT NULL,
  `publication_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

-- --------------------------------------------------------

--
-- Table structure for table `contact`
--

CREATE TABLE `contact` (
  `co_id` int(9) NOT NULL,
  `contactInfo` varchar(500) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `contact`
--

INSERT INTO `contact` (`co_id`, `contactInfo`) VALUES
(1, '');

-- --------------------------------------------------------

--
-- Table structure for table `honor_board`
--

CREATE TABLE `honor_board` (
  `honor_id` int(11) NOT NULL,
  `name` varchar(50) CHARACTER SET utf8 NOT NULL,
  `category` int(10) NOT NULL,
  `designation` varchar(30) CHARACTER SET utf8 NOT NULL,
  `time_period` varchar(25) CHARACTER SET utf8 NOT NULL,
  `image` varchar(500) CHARACTER SET utf8 NOT NULL,
  `aobut_emp` varchar(500) CHARACTER SET utf8 NOT NULL,
  `dateAdd` varchar(30) CHARACTER SET utf8 NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `management`
--

CREATE TABLE `management` (
  `bmId` int(9) NOT NULL,
  `bm_cat` int(5) NOT NULL,
  `bm_name` varchar(40) DEFAULT NULL,
  `bm_post` varchar(20) DEFAULT NULL,
  `bm_post_value` bigint(3) DEFAULT NULL,
  `bm_phone` varchar(11) DEFAULT NULL,
  `bm_desc` varchar(2000) DEFAULT NULL,
  `bm_image` varchar(200) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `meritious_student`
--

CREATE TABLE `meritious_student` (
  `student_Id` int(11) NOT NULL,
  `stuName` varchar(200) NOT NULL,
  `position` varchar(100) NOT NULL,
  `year` varchar(122) NOT NULL,
  `image` varchar(500) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `message`
--

CREATE TABLE `message` (
  `id` int(9) NOT NULL,
  `title` varchar(200) NOT NULL,
  `category` int(9) NOT NULL,
  `content` varchar(10000) NOT NULL,
  `image` varchar(255) DEFAULT NULL,
  `dateAdd` varchar(15) NOT NULL,
  `publication_status` int(2) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `message`
--

INSERT INTO `message` (`id`, `title`, `category`, `content`, `image`, `dateAdd`, `publication_status`) VALUES
(1, 'প্রধান শিক্ষকের বাণী', 3, '<p class=\"MsoNormal\" [removed]:normal;font-weight:normal;text-indent:0px;background-color:#ffffff;\"=\"\"> <span><span>তথ্য প্রযুক্তির যুগে পিছিয়ে থাকার সুযোগ নেই । তথ্য প্রযুক্তি নির্ভর শিক্ষা ব্যবস্থা এখন সময়ের দাবী । এই বাস্তবতাকে মেনে নিয়ে চৌদ্দগ্রাম মাধ্যমিক পাইলট বালিকা বিদ্যালয় তার শিক্ষা পরিকল্পনায় ব্যাপক পরিবর্তন সাধন করেছে । আমরা আমাদের শিক্ষার্থীকে আগামী প্রজন্মের একজন দক্ষ ও উপযুক্ত নাগরিক হিসেবে গড়ে তোলার যাবতীয় প্রয়াস হাতে নিয়েছি । সেই লক্ষে আমরা আমাদের বিদ্যালয়ের সব কর্মকান্ড ওয়েব সাইটের আওতায় এনেছি । আশাকরি, এর মাধ্যমে শিক্ষার্থীরা দ্রুততার সাথে প্রাতিষ্ঠানিক যাবতীয় কার্যক্রম ও আনুষঙ্গিক তথ্য পেতে পারবে । আমরা এ ব্যাপারে মনোযোগি এবং উত্তোরোত্তর এর উন্নতি লক্ষে কাজ করে যাব ইনশাল্লাহ ।<br />\r\n</span></span> \r\n </p>\r\n<p class=\"MsoNormal\" [removed]:normal;font-weight:normal;text-indent:0px;background-color:#ffffff;\"=\"\"> <span><span>ভিশন-২০২১</span><span>-এর অন্যতম লক্ষ্য হল তথ্য ও যোগাযোগ প্রযুক্তি ব্যবহারের মাধ্যমে<span> </span></span><span>ডিজিটাল বাংলাদেশ </span><span>প্রতিষ্ঠা করা। এজন্য প্রয়োজন আইসিটি জ্ঞানসম্পন্ন দক্ষ জনশক্তি।<span> </span></span><span><span><span>চৌদ্দগ্রাম মাধ্যমিক পাইলট বালিকা বিদ্যালয়</span></span> </span></span><span><span></span>পরিবার নিজেদেরকে গৌরবান্বিত মনে করছি।</span> \r\n</p>', 'images/Photo/Head_Sir_Picture.jpg', '2017/10/17', 1),
(2, 'সভাপতির বাণী', 10, '<span [removed]:normal;font-weight:normal;background-color:#FFFFFF;\"><span><span>চৌদ্দগ্রাম মাধ্যমিক পাইলট বালিকা বিদ্যালয়</span></span> এর পক্ষ থেকে জানাচ্ছি প্রীতি ও শুভেচ্ছা।  <span><span>চৌদ্দগ্রাম মাধ্যমিক পাইলট বালিকা বিদ্যালয়</span></span>কে একটি আধুনিক ও তথ্যপ্রযুক্তি মুখী মানসম্পন্ন শিক্ষা প্রতিষ্ঠান-এ রূপ দিতে আমরা নানামুখী সুদূর প্রসারী কর্মপরিকল্পনা এবং কার্যক্রম হাতে নিয়েছি। ফলে একজন শিক্ষার্থী তার ভবিষ্যত পরিকল্পনা নির্ধারণ করে খুব সহজেই জীবনের কাঙ্ক্ষিত লক্ষ্যে নিজেকে পৌঁছাতে পারবে বলে আমাদের বিশ্বাস। আর আমাদের এসব পরিকল্পনা বাস্তবায়ন করতে বিদ্যালয় পরিচালনা কমিটি এবং শিক্ষক-শিক্ষার্থীদের প্রচেষ্টার পাশাপাশি আপনাদের ভূমিকা ও মূল্যবান পরামর্শ এবং সার্বিক সহযোগিতায় গড়ে উঠতে পারে একটি কাঙ্ক্ষিত আদর্শ শিক্ষা প্রতিষ্ঠান। আপনার প্রিয় সন্তানকে আগামী দিনের সু-নাগরিক হিসেবে গড়ে তুলতে তাকে অবশ্যই সু-শিক্ষায় শিক্ষিত করে তুলতে হবে। আর এ সু-শিক্ষার জন্য প্রয়োজন সু-পরিকল্পিত শিক্ষা ব্যবস্থা, শিক্ষার সুন্দর পরিবেশ এবং আদর্শ শিক্ষকদের সম্মিলিত আন্তরিক প্রচেষ্টা। জ্ঞান-বিজ্ঞান, নৈতিক, মানবিক ও যুগোপযোগী আদর্শ শিক্ষায় ছাত্র-ছাত্রীরা গড়ে উঠুক এই লক্ষ্যে নিবেদিত রয়েছে আমাদের যাবতীয় ঐকান্তিক প্রয়াস। আপনাদের সার্বিক সহযোগিতা প্রত্যাশা করছি।</span>', 'images/Photo/Chairman_picture_2017.jpg', '2017/10/17', 1),
(3, 'Background:', 1, '<p [removed]:normal;font-weight:normal;text-indent:0px;background-color:#FFFFFF;\">\r\n <strong>Background:</strong><br />\r\n<span>\r\n <h2>\r\n  <span>Chouddagram Secondary Pilot Girls School</span><span> is one of the most rising educational institutions in the  Comilla district. Just quarter a century ago, the school was established in 1962 to pave the way for education in this part of the country. Some renowned thinkers and noble hearted great personalities devoted themselves in the initiative of establishing the school. It is with their hearty initiative, the school took the shape a complete institution, overcoming all the hurdles including land requisition, funding and running of the institutional activities. Renowned social reformer & former UP chairman Mr. Nazrul Haque Fulmamud donated the major portion of the lands and helped develop the infrastructure of the school with a view to establishing the school after the name of the village Sakhua, whrere it is situated. His contribution in collecting fund from rich persons of the society is to be noted with gratitude. Along with others great hearted persons who donated lands property to the institution, named late Lal Mamud, Late Nur Mamud, Late Shukur Mamud, Late Ismayeel Sorker, Late Onil Krishna Pondit, Late Jogobondhu Debnath, Late Abdul Helim Sheikh, Abdul Hamid, Md Gias Uddin and Sree Binoy Krishno Sorker. Eng. Abdul Mozid is another kind hearted person who donated money for establishing the school. It is obviously noted that the excellent support and giving all kind of necessary helps of the people of this aremade the step establishing a school in this area very easy. The then officials of the Education sector provided all kinds of help to stand this school . Such this way a dream was established .</span>\r\n </h2>\r\n</span>\r\n</p>\r\n<span [removed]:normal;font-weight:normal;background-color:#FFFFFF;\"><span [removed]>In 1994 the school achieved permission for the Junior school and in 1998 it was updated as a High school with ministry appellation .  </span><span> <br />\r\n</span></span>', NULL, '2017/10/17', 1);

-- --------------------------------------------------------

--
-- Table structure for table `resultsummery`
--

CREATE TABLE `resultsummery` (
  `rs_Id` int(9) NOT NULL,
  `exam_type` tinyint(2) DEFAULT NULL,
  `exam_year` varchar(4) DEFAULT NULL,
  `group` int(20) NOT NULL,
  `grade_Ap` int(9) DEFAULT NULL,
  `grade_A` int(9) DEFAULT NULL,
  `grade_Am` int(9) DEFAULT NULL,
  `grade_B` int(9) DEFAULT NULL,
  `grade_C` int(9) DEFAULT NULL,
  `grade_D` int(9) DEFAULT NULL,
  `grade_F` int(12) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

-- --------------------------------------------------------

--
-- Table structure for table `tbl_admin`
--

CREATE TABLE `tbl_admin` (
  `admin_id` int(9) NOT NULL,
  `admin_name` varchar(200) NOT NULL,
  `admin_email_address` varchar(2000) NOT NULL,
  `username` varchar(30) NOT NULL,
  `admin_password` varchar(50) NOT NULL,
  `status` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8;

--
-- Dumping data for table `tbl_admin`
--

INSERT INTO `tbl_admin` (`admin_id`, `admin_name`, `admin_email_address`, `username`, `admin_password`, `status`) VALUES
(1, 'AIMS', 'crosscircle2014@gmail.com', 'aimsadmin', '3631f280caa96144b70ef48a1a54fc22', 1),
(2, 'developer', 'royshubha04@gmail.com', 'crosscircle', '1a6f41321cf56667a141a9ebe231f3f2', 1),
(3, 'home', 'home@gmail.com', 'homeadmin', 'hotncool', 1);

-- --------------------------------------------------------

--
-- Table structure for table `tbl_photo`
--

CREATE TABLE `tbl_photo` (
  `id` int(9) NOT NULL,
  `category` varchar(5) NOT NULL,
  `title` varchar(100) DEFAULT NULL,
  `image` varchar(100) DEFAULT NULL,
  `date` varchar(15) DEFAULT NULL
) ENGINE=InnoDB DEFAULT CHARSET=latin1;

--
-- Dumping data for table `tbl_photo`
--

INSERT INTO `tbl_photo` (`id`, `category`, `title`, `image`, `date`) VALUES
(1, '1', '', 'images/Slider/6_copy.jpg', '10/17/2017'),
(2, '1', '', 'images/Slider/5.jpg', '10/17/2017'),
(4, '1', '', 'images/Slider/web_site_pic.jpg', '12/11/2017'),
(5, '3', '', 'images/Slider/web_site_pic_-2.jpg', '12/11/2017'),
(6, '4', '', 'images/Slider/web_site_pic_-21.jpg', '12/11/2017'),
(7, '1', '', 'images/Slider/web_site_pic_-22.jpg', '12/11/2017'),
(8, '3', '???????????? ????? ', 'images/Slider/web_pic.jpg', '10/30/2018'),
(9, '1', '???????????? ????? ', 'images/Slider/web_pic1.jpg', '10/30/2018'),
(10, '1', '???????????? ????? ', 'images/Slider/web_side.jpg', '10/30/2018'),
(11, '1', '????? ????? ??????? ???? ????, ?, ??? ? ????', 'images/Slider/Admit_Card.JPG', '12/10/2018'),
(12, '1', '????? ????? ??????? ???? ????, ?, ??? ? ????', 'images/Slider/Admit_card_2.JPG', '12/10/2018');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `academic`
--
ALTER TABLE `academic`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `career`
--
ALTER TABLE `career`
  ADD PRIMARY KEY (`ca_id`);

--
-- Indexes for table `contact`
--
ALTER TABLE `contact`
  ADD PRIMARY KEY (`co_id`);

--
-- Indexes for table `honor_board`
--
ALTER TABLE `honor_board`
  ADD PRIMARY KEY (`honor_id`);

--
-- Indexes for table `management`
--
ALTER TABLE `management`
  ADD PRIMARY KEY (`bmId`);

--
-- Indexes for table `meritious_student`
--
ALTER TABLE `meritious_student`
  ADD PRIMARY KEY (`student_Id`);

--
-- Indexes for table `message`
--
ALTER TABLE `message`
  ADD PRIMARY KEY (`id`);

--
-- Indexes for table `resultsummery`
--
ALTER TABLE `resultsummery`
  ADD PRIMARY KEY (`rs_Id`);

--
-- Indexes for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  ADD PRIMARY KEY (`admin_id`);

--
-- Indexes for table `tbl_photo`
--
ALTER TABLE `tbl_photo`
  ADD PRIMARY KEY (`id`);

--
-- AUTO_INCREMENT for dumped tables
--

--
-- AUTO_INCREMENT for table `academic`
--
ALTER TABLE `academic`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=21;

--
-- AUTO_INCREMENT for table `career`
--
ALTER TABLE `career`
  MODIFY `ca_id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `contact`
--
ALTER TABLE `contact`
  MODIFY `co_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=2;

--
-- AUTO_INCREMENT for table `honor_board`
--
ALTER TABLE `honor_board`
  MODIFY `honor_id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `management`
--
ALTER TABLE `management`
  MODIFY `bmId` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `meritious_student`
--
ALTER TABLE `meritious_student`
  MODIFY `student_Id` int(11) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `message`
--
ALTER TABLE `message`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `resultsummery`
--
ALTER TABLE `resultsummery`
  MODIFY `rs_Id` int(9) NOT NULL AUTO_INCREMENT;

--
-- AUTO_INCREMENT for table `tbl_admin`
--
ALTER TABLE `tbl_admin`
  MODIFY `admin_id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=4;

--
-- AUTO_INCREMENT for table `tbl_photo`
--
ALTER TABLE `tbl_photo`
  MODIFY `id` int(9) NOT NULL AUTO_INCREMENT, AUTO_INCREMENT=13;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
