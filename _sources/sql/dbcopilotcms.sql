-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 10, 2026 at 08:00 AM
-- Server version: 5.7.40
-- PHP Version: 8.0.26

SET SQL_MODE = "NO_AUTO_VALUE_ON_ZERO";
START TRANSACTION;
SET time_zone = "+00:00";


/*!40101 SET @OLD_CHARACTER_SET_CLIENT=@@CHARACTER_SET_CLIENT */;
/*!40101 SET @OLD_CHARACTER_SET_RESULTS=@@CHARACTER_SET_RESULTS */;
/*!40101 SET @OLD_COLLATION_CONNECTION=@@COLLATION_CONNECTION */;
/*!40101 SET NAMES utf8mb4 */;

--
-- Database: `dbcopilotcms`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `key_articles` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_media_banner` int(10) UNSIGNED DEFAULT '0',
  `document_code` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(300) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `title_sub` varchar(300) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `article_snippet` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `article_content` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `content_type` varchar(300) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `content_direction` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'ltr',
  `book_indent_level` tinyint(4) NOT NULL DEFAULT '0',
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `banner_image_url` varchar(2000) COLLATE utf8_unicode_ci DEFAULT '',
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `entry_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `is_featured` tinyint(1) NOT NULL DEFAULT '0',
  `show_on_home` tinyint(1) NOT NULL DEFAULT '1',
  `show_in_listing` tinyint(1) NOT NULL DEFAULT '1',
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`key_articles`),
  KEY `fk_articles_media` (`key_media_banner`),
  KEY `entry_date_time` (`entry_date_time`),
  KEY `update_date_time` (`update_date_time`),
  KEY `is_active` (`is_active`),
  KEY `is_featured` (`is_featured`),
  KEY `document_code` (`document_code`)
) ENGINE=InnoDB AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`key_articles`, `key_media_banner`, `document_code`, `title`, `title_sub`, `article_snippet`, `article_content`, `content_type`, `content_direction`, `book_indent_level`, `url`, `banner_image_url`, `sort`, `entry_date_time`, `update_date_time`, `created_by`, `updated_by`, `is_featured`, `show_on_home`, `show_in_listing`, `is_active`) VALUES
(2, 0, '', 'Science Fair Winners Advance to Regionals', '', 'Star Model Public High School will be well represented at the regional science competition next month. Five students earned top honors at our Annual Science & Arts Fair and will carry the school\'s name forward.\r\n\r\n', '\r\n<p><em>Posted [Date] | Category: Academics | By Star Model Communications</em></p>\r\n\r\n<p>Star Model Public High School will be well represented at the regional science competition next month. Five students earned top honors at our Annual Science &amp; Arts Fair and will carry the school\'s name forward.</p>\r\n\r\n<h2>Our Winning Projects</h2>\r\n<ul>\r\n  <li><strong>[Student Name], Grade 11:</strong> \"Cleaner Water with Natural Filters,\" a study of low-cost materials for filtering household water</li>\r\n  <li><strong>[Student Name], Grade 12:</strong> \"Predicting Crop Growth with Simple Sensors,\" an environmental science project using soil data</li>\r\n  <li><strong>[Student Name], Grade 10:</strong> \"Sound and Focus,\" an experiment on how background noise affects concentration</li>\r\n  <li><strong>[Student Name] and [Student Name], Grade 11:</strong> \"Solar Phone Charger,\" a hands-on engineering design</li>\r\n</ul>\r\n\r\n<h2>Months of Hard Work</h2>\r\n<p>Each project began in the fall with a question, a hypothesis, and many hours of testing after school. Students met weekly with faculty advisors to refine their methods, review their data, and practice presenting to judges.</p>\r\n\r\n<blockquote>\r\n  <p>These students didn\'t just follow instructions. They asked their own questions, made mistakes, adjusted, and kept going. That is what real science looks like.</p>\r\n  <p><em>[Teacher Name], Science Department Head</em></p>\r\n</blockquote>\r\n\r\n<h2>What\'s Next</h2>\r\n<p>The regional competition will be held on [Date] at [Location]. Our finalists will present to a panel of university faculty and industry professionals. Families and friends are welcome to attend and cheer them on.</p>\r\n\r\n<p>Congratulations to all participants in this year\'s fair! Interested in joining next year? Talk to your science teacher or visit the <a href=\"/page/student-life\">Student Life</a> page to learn about our science and engineering clubs.</p>', '', 'ltr', 0, 'science-fair-winners-advance-to-regionals', '', 0, '2026-10-10 12:49:14', '2026-10-10 12:55:37', 1, 1, 0, 1, 1, 1),
(3, 0, '', 'New Robotics Lab Opens Its Doors', '', 'This week, we celebrated the opening of our state-of-the-art Robotics Lab, made possible by the generosity of families, alumni, and local business partners.\r\n\r\n', '\r\n<p><em>Posted [Date] | Category: Campus News | By Star Model Communications</em></p>\r\n\r\n<p>Star Model students have a new place to build, code, and experiment. This week, we celebrated the opening of our state-of-the-art Robotics Lab, made possible by the generosity of families, alumni, and local business partners.</p>\r\n\r\n<h2>What\'s Inside</h2>\r\n<ul>\r\n  <li>Dedicated workstations with computers for programming and design</li>\r\n  <li>Several 3D printers for rapid prototyping</li>\r\n  <li>A practice arena for testing competition robots</li>\r\n  <li>Tool stations with soldering equipment and safety gear</li>\r\n  <li>Flexible seating for team meetings and design sessions</li>\r\n</ul>\r\n\r\n<h2>Opportunities for Every Student</h2>\r\n<p>The lab will be home to our award-winning Robotics Club, and it will also be used in computer science, physics, and design classes. No experience is needed to get started. Beginners will be paired with experienced team members and mentors.</p>\r\n\r\n<blockquote>\r\n  <p>Our students have been building robots in hallways and borrowed classrooms. Now they have a space that matches their ambition.</p>\r\n  <p><em>[Teacher Name], Robotics Club Advisor</em></p>\r\n</blockquote>\r\n\r\n<h2>Thank You to Our Supporters</h2>\r\n<p>We are grateful to the Star Model Foundation, our booster clubs, [Local Business Name], and the many individuals who contributed to this project. Your support is helping prepare students for careers in engineering, technology, and science.</p>\r\n\r\n<h2>Visit the Lab</h2>\r\n<p>The lab will be open to families during our <a href=\"/page/news-and-events\">Fall Open House</a>. Students can join the Robotics Club by speaking with [Advisor Name] or visiting Room [Number].</p>\r\n\r\n<p>Want to help equip the next project? Learn more on our <a href=\"/page/support-star-model-public-high-school\">Support Star Model</a> page.</p>\r\n', '', 'ltr', 0, 'new-robotics-lab-opens-its-doors', '', 0, '2026-10-10 12:50:43', '2026-10-10 12:54:08', 1, 1, 0, 1, 1, 1),
(4, 0, '', 'Student Spotlight: Senior Earns Full Scholarship', '', 'Star Model is proud to congratulate senior Mr. Student, who has earned a full scholarship to Great University to study Information Technology.\r\n\r\n', '\r\n<p><em>Posted [Date] | Category: Student Spotlight | By Star Model Communications</em></p>\r\n\r\n<p>Star Model is proud to congratulate senior <strong>[Student Name]</strong>, who has earned a full scholarship to [University Name] to study [Field of Study].</p>\r\n\r\n<h2>A Journey of Dedication</h2>\r\n<p>[Student Name] arrived at Star Model as a ninth grader with a love of [subject or interest]. Over four years, [he/she/they] took on challenging Honors and AP courses, served as [role, e.g., president of the Debate Team], and volunteered more than [number] hours with the Community Service Club.</p>\r\n\r\n<h2>In Their Own Words</h2>\r\n<blockquote>\r\n  <p>My teachers pushed me to try things I didn\'t think I could do. Star Model showed me that hard work pays off, and that I don\'t have to do it alone.</p>\r\n  <p><em>[Student Name], Class of [Year]</em></p>\r\n</blockquote>\r\n\r\n<h2>Behind the Scholarship</h2>\r\n<p>With the help of our counseling team, [Student Name] researched scholarship opportunities, wrote multiple essays, and prepared for interviews. Our counselors host workshops each fall to help students at every step of the college and scholarship process.</p>\r\n\r\n<h2>Advice for Younger Students</h2>\r\n<ul>\r\n  <li><strong>Start early.</strong> Explore your interests in ninth grade and keep trying new things.</li>\r\n  <li><strong>Ask for help.</strong> Teachers and counselors want to see you succeed.</li>\r\n  <li><strong>Stay curious.</strong> Grades matter, but passion makes you stand out.</li>\r\n  <li><strong>Apply for everything.</strong> You never know which opportunity will open a door.</li>\r\n</ul>\r\n\r\n<p>Congratulations, [Student Name]! We can\'t wait to see everything you achieve. Students and families interested in college planning can learn more on our <a href=\"/page/academics\">Academics</a> page.</p>\r\n', '', 'ltr', 0, 'student-spotlight-senior-earns-full-scholarship', '', 0, '2026-10-10 12:52:39', '2026-10-10 12:55:07', 1, 1, 0, 1, 1, 1),
(5, 0, '', 'Stars Roar in Season Opener: Varsity Football Takes the Win', '', 'The Star Model Varsity Football team kicked off its season in style on Friday night, defeating [Opponent] by a score of [XX to XX] in front of a packed home crowd.\r\n\r\n', '\r\n<p><em>Posted [Date] | Category: Athletics | By Star Model Communications</em></p>\r\n\r\n<p>The Star Model Varsity Football team kicked off its season in style on Friday night, defeating [Opponent] by a score of [XX to XX] in front of a packed home crowd.</p>\r\n\r\n<h2>Game Recap</h2>\r\n<p>The Stars took an early lead with a [touchdown] in the first quarter, and the defense held strong throughout the night. After a close second quarter, the team pulled ahead in the second half behind strong offensive drives and key stops on defense.</p>\r\n\r\n<h2>Standout Performances</h2>\r\n<ul>\r\n  <li><strong>[Player Name], Senior Quarterback:</strong> [XXX] passing yards and [X] touchdowns</li>\r\n  <li><strong>[Player Name], Junior Running Back:</strong> [XX] carries for [XXX] yards</li>\r\n  <li><strong>[Player Name], Senior Linebacker:</strong> [X] tackles, including [X] for a loss</li>\r\n  <li><strong>[Player Name], Sophomore Kicker:</strong> [X] for [X] on field goals and extra points</li>\r\n</ul>\r\n\r\n<blockquote>\r\n  <p>The players put in a lot of work in the summer, and it showed. I\'m proud of how they played as a team and supported each other.</p>\r\n  <p><em>Coach [Name], Head Football Coach</em></p>\r\n</blockquote>\r\n\r\n<h2>Thank You, Star Fans</h2>\r\n<p>A big thank-you to our band, cheerleaders, student section, and families for creating an incredible atmosphere. The energy from the stands made all the difference.</p>\r\n\r\n<h2>Up Next</h2>\r\n<p>The Stars travel to [Opponent] on [Date] at [Time]. Check the <a href=\"/page/athletics\">Athletics</a> page for the full schedule, scores, and roster. Go Stars!</p>\r\n', '', 'ltr', 0, 'stars-roar-in-season-opener-varsity-football-takes-the-win', '', 0, '2026-10-10 12:56:27', '2026-10-10 12:56:27', 1, NULL, 0, 1, 1, 1),
(6, 0, '', 'Fall Open House: What to Expect', '', 'Join us for our Fall Open House on November 15 at 6:00 p.m. It\'s a chance to tour campus, meet our teachers, and see why so many families call Star Model home.\r\n\r\n', '\r\n<p><em>Posted [Date] | Category: Admissions | By Star Model Admissions Office</em></p>\r\n\r\n<p>Thinking about Star Model for your child? Join us for our <strong>Fall Open House on November 15 at 6:00 p.m.</strong> It\'s a chance to tour campus, meet our teachers, and see why so many families call Star Model home.</p>\r\n\r\n<h2>Evening Schedule</h2>\r\n<table border=\"1\" cellpadding=\"8\" cellspacing=\"0\">\r\n  <thead>\r\n    <tr><th>Time</th><th>Activity</th></tr>\r\n  </thead>\r\n  <tbody>\r\n    <tr><td>6:00 p.m.</td><td>Check-in and welcome refreshments in the main hall</td></tr>\r\n    <tr><td>6:20 p.m.</td><td>Welcome from the Principal and a school overview</td></tr>\r\n    <tr><td>6:45 p.m.</td><td>Student-led campus tours</td></tr>\r\n    <tr><td>7:15 p.m.</td><td>Department showcases: science labs, arts studios, and athletics</td></tr>\r\n    <tr><td>7:45 p.m.</td><td>Admissions Q&amp;A with counselors and staff</td></tr>\r\n    <tr><td>8:15 p.m.</td><td>Closing and free time to explore</td></tr>\r\n  </tbody>\r\n</table>\r\n\r\n<h2>What You\'ll See</h2>\r\n<ul>\r\n  <li>Our new Robotics Lab and science classrooms</li>\r\n  <li>Art, music, and theater spaces</li>\r\n  <li>The library, gym, and athletic fields</li>\r\n  <li>Student clubs showing off their projects</li>\r\n</ul>\r\n\r\n<h2>Questions We Can Answer</h2>\r\n<ul>\r\n  <li>How do I apply, and what are the deadlines?</li>\r\n  <li>What courses and advanced programs are offered?</li>\r\n  <li>How does Star Model support students who need extra help?</li>\r\n  <li>What clubs, sports, and activities can my child join?</li>\r\n  <li>What does transportation look like?</li>\r\n</ul>\r\n\r\n<h2>Before You Come</h2>\r\n<ul>\r\n  <li><strong>Registration:</strong> Registration is encouraged but not required</li>\r\n  <li><strong>Parking:</strong> Free parking is available in the main lot, with signs to guide you</li>\r\n  <li><strong>Accessibility:</strong> The event is fully accessible. Let us know if you need any special accommodations.</li>\r\n  <li><strong>Bring your child:</strong> Prospective students are especially welcome</li>\r\n</ul>\r\n\r\n<p>Can\'t make it? We also offer campus tours every Tuesday and Thursday at 10 a.m. Application details are on our <a href=\"/page/admissions\">Admissions</a> page.</p>\r\n\r\n<p><a href=\"/page/contact\"><strong>Register for the Open House</strong></a></p>\r\n', '', 'ltr', 0, 'fall-open-house-what-to-expect', '', 0, '2026-10-10 12:57:12', '2026-10-10 12:57:12', 1, NULL, 0, 1, 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `article_authors`
--

DROP TABLE IF EXISTS `article_authors`;
CREATE TABLE IF NOT EXISTS `article_authors` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_articles` int(10) UNSIGNED NOT NULL,
  `key_authors` int(10) UNSIGNED NOT NULL,
  `article_work_label` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `key_articles` (`key_articles`),
  KEY `key_authors` (`key_authors`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `article_categories`
--

DROP TABLE IF EXISTS `article_categories`;
CREATE TABLE IF NOT EXISTS `article_categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_articles` int(10) UNSIGNED NOT NULL,
  `key_categories` int(10) UNSIGNED NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_pair` (`key_articles`,`key_categories`),
  KEY `key_categories` (`key_categories`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `article_content_types`
--

DROP TABLE IF EXISTS `article_content_types`;
CREATE TABLE IF NOT EXISTS `article_content_types` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_articles` int(10) UNSIGNED NOT NULL,
  `key_content_types` int(10) UNSIGNED NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_pair` (`key_articles`,`key_content_types`),
  KEY `key_content_types` (`key_content_types`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `article_tags`
--

DROP TABLE IF EXISTS `article_tags`;
CREATE TABLE IF NOT EXISTS `article_tags` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_articles` int(10) UNSIGNED NOT NULL,
  `key_tags` int(10) UNSIGNED NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_pair` (`key_articles`,`key_tags`),
  KEY `key_tags` (`key_tags`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `article_workers`
--

DROP TABLE IF EXISTS `article_workers`;
CREATE TABLE IF NOT EXISTS `article_workers` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_articles` int(10) UNSIGNED NOT NULL,
  `key_workers` int(10) UNSIGNED NOT NULL,
  `article_work_label` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`id`),
  KEY `key_articles` (`key_articles`),
  KEY `key_workers` (`key_workers`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `authors`
--

DROP TABLE IF EXISTS `authors`;
CREATE TABLE IF NOT EXISTS `authors` (
  `key_authors` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `website` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `social_url_media1` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `social_url_media2` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `social_url_media3` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `city` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `state` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `country` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `banner_image_url` varchar(2000) COLLATE utf8_unicode_ci DEFAULT '',
  `key_media_banner` int(10) UNSIGNED DEFAULT NULL,
  `description` varchar(2000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `is_active` tinyint(1) DEFAULT '1',
  `entry_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`key_authors`),
  KEY `fk_authors_media` (`key_media_banner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

DROP TABLE IF EXISTS `blocks`;
CREATE TABLE IF NOT EXISTS `blocks` (
  `key_blocks` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_media_banner` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `key_photo_gallery` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `key_content_types` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `key_categories` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `key_tags` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `module_file` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `block_name` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `css` varchar(300) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `number_of_records` smallint(3) NOT NULL DEFAULT '0',
  `visible_on` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'desktop,mobile',
  `block_content` varchar(10000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `show_on_pages` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `show_in_region` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `entry_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `updated_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `is_dynamic` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '1',
  PRIMARY KEY (`key_blocks`),
  KEY `fk_blocks_media` (`key_media_banner`)
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`key_blocks`, `key_media_banner`, `key_photo_gallery`, `key_content_types`, `key_categories`, `key_tags`, `module_file`, `block_name`, `title`, `css`, `number_of_records`, `visible_on`, `block_content`, `show_on_pages`, `show_in_region`, `entry_date_time`, `created_by`, `updated_by`, `sort`, `is_dynamic`, `is_active`) VALUES
(1, 0, 0, 0, 0, 0, '', 'Footer Message', '', '', 5, 'large-desktop,desktop,tablet,mobile', 'Â© 2026 Star Model Public High School. All rights reserved.', '', 'footer', '2026-09-20 15:33:08', 1, 1, 0, 0, 1),
(2, 0, 0, 0, 0, 0, 'content_types_55448', 'Content Types', 'Content Types', '', 5, 'large-desktop,desktop,tablet,mobile', '', '', 'sidebar_right', '2026-09-20 15:33:53', 1, 0, 0, 0, 1),
(3, 0, 0, 0, 0, 0, 'categories_55448', 'Categories', 'Categories', '', 5, 'large-desktop,desktop,tablet,mobile', '', '', 'sidebar_right', '2026-09-20 15:34:45', 1, 0, 0, 0, 1),
(5, 0, 0, 0, 0, 0, 'search6545645', 'Search', 'Search', '', 5, 'large-desktop,desktop,tablet,mobile', '', '', 'sidebar_left', '2026-09-20 15:36:05', 1, 0, 0, 0, 1),
(6, 0, 0, 0, 0, 0, '', 'Student services', 'Student Services', '', 5, 'large-desktop,desktop,tablet,mobile,print', '\r\n<ul>\r\n<li><a href=\"/page/contact-us\">Schedule a Tour</a></li>\r\n<li><a href=\"/page/admissions\">Apply to Star Model</a></li>\r\n<li><a href=\"/page/parents-and-students-portal\">Parents & Students Portal</a></li>\r\n<li><a href=\"/page/grade-portal\">Grade Portal</a></li>\r\n<li><a href=\"/page/lunch-menu\">Lunch Menu</a></li>\r\n<li><a href=\"/page/bus-routes\">Bus Routes</a></li>\r\n</ul>\r\n\r\n', '', 'above_footer', '2026-10-10 11:58:59', 1, 1, 0, 0, 1),
(7, 0, 0, 0, 0, 0, '', 'School essentials', 'School Essentials', '', 5, 'large-desktop,desktop,tablet,mobile', '\r\n<ul>\r\n<li><a href=\"/page/alumni\">Alumni</a></li>\r\n<li><a href=\"/page/support-star-model-public-high-school\">Support/Donate</a></li>\r\n<li><a href=\"/page/careers\">Join Our Team</a></li>\r\n<li><a href=\"/page/safety-and-wellness\">Safety & Wellness</a></li>\r\n<li><a href=\"/page/non-discrimination-statement\">Non-Discrimination Statement</a></li>\r\n<li><a href=\"/page/student-data-privacy\">Student Data Privacy</a></li>\r\n</ul>', '', 'above_footer', '2026-10-10 12:09:19', 1, 1, 0, 0, 1),
(8, 0, 0, 0, 0, 0, '', 'Legal statements', 'Legal Statements', '', 5, 'large-desktop,desktop,tablet,mobile', '\r\n<ul>\r\n<li><a href=\"/page/privacy-policy\">Privacy Policy</a></li>\r\n<li><a href=\"/page/terms-of-use\">Terms of Use</a></li>\r\n<li><a href=\"/page/cookie-policy\">Cookie Policy</a></li>\r\n<li><a href=\"/page/accessibility-statement\">Accessibility Statement</a></li>\r\n<li><a href=\"/page/acceptable-use-policy\">Acceptable Use Policy</a></li>\r\n<li><a href=\"/page/copyright-and-disclaimer\">Copyright & Disclaimer</a></li>\r\n</ul>', '', 'above_footer', '2026-10-10 12:10:14', 1, 0, 0, 0, 1),
(9, 0, 0, 0, 0, 0, '', 'Our location', 'Our Location', '', 5, 'large-desktop,desktop,tablet,mobile', '<br>\r\n<p>Star Model Public High School</p>\r\n<p>123 Education Avenue</p>\r\n<p>[City, State, ZIP]</p>\r\n<p>Phone: <a href=\"tel:5551234567\">(555) 123-4567</a></p>\r\n<p>Phone: <a href=\"tel:5551234568\">(555) 123-4568</a></p>\r\n<p>Email: <a href=\"mailto:info@starmodelhs.edu\">info@starmodelhs.edu</a></p>', '', 'above_footer', '2026-10-10 12:12:58', 1, 1, 0, 0, 1);

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `key_books` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_media_banner` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `subtitle` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `banner_image_url` varchar(2000) COLLATE utf8_unicode_ci DEFAULT '',
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `author_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `publisher` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `publish_year` varchar(4) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `isbn` varchar(17) COLLATE utf8_unicode_ci DEFAULT '',
  `is_featured` tinyint(1) DEFAULT NULL,
  `language` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `format` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `weight_grams` int(11) DEFAULT NULL,
  `sku` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `entry_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`key_books`),
  KEY `fk_books_media` (`key_media_banner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_articles`
--

DROP TABLE IF EXISTS `book_articles`;
CREATE TABLE IF NOT EXISTS `book_articles` (
  `key_book_articles` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_books` int(10) UNSIGNED NOT NULL,
  `key_articles` int(10) UNSIGNED NOT NULL,
  `sort_order` int(5) UNSIGNED DEFAULT '0',
  PRIMARY KEY (`key_book_articles`),
  UNIQUE KEY `unique_pair` (`key_books`,`key_articles`),
  KEY `key_articles` (`key_articles`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_categories`
--

DROP TABLE IF EXISTS `book_categories`;
CREATE TABLE IF NOT EXISTS `book_categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_books` int(10) UNSIGNED NOT NULL,
  `key_categories` int(10) UNSIGNED NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_pair` (`key_books`,`key_categories`),
  KEY `key_categories` (`key_categories`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `key_categories` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_media_banner` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `banner_image_url` varchar(2000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `entry_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_type` enum('article','book','photo_gallery','video_gallery','global') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'global',
  PRIMARY KEY (`key_categories`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`key_categories`, `key_media_banner`, `name`, `description`, `url`, `banner_image_url`, `sort`, `is_active`, `entry_date_time`, `category_type`) VALUES
(1, 0, 'Category 1', '', 'category-1', '', 0, 1, '2026-09-20 15:31:33', 'article'),
(2, 0, 'Category 2', '', 'category-2', '', 0, 1, '2026-09-20 15:31:41', 'article'),
(3, 0, 'Category 3', '', 'category-3', '', 0, 1, '2026-09-20 15:31:49', 'article');

-- --------------------------------------------------------

--
-- Table structure for table `content_types`
--

DROP TABLE IF EXISTS `content_types`;
CREATE TABLE IF NOT EXISTS `content_types` (
  `key_content_types` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_media_banner` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `banner_image_url` varchar(2000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `entry_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_content_types`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `content_types`
--

INSERT INTO `content_types` (`key_content_types`, `key_media_banner`, `name`, `description`, `url`, `banner_image_url`, `sort`, `is_active`, `entry_date_time`) VALUES
(1, 0, 'Content Type 1', '', 'content-type-1', '', 0, 1, '2026-09-20 15:31:03'),
(2, 0, 'Content Type 2', '', 'content-type-2', '', 0, 1, '2026-09-20 15:31:10'),
(3, 0, 'Content Type 3', '', 'content-type-3', '', 0, 1, '2026-09-20 15:31:15');

-- --------------------------------------------------------

--
-- Table structure for table `fonts`
--

DROP TABLE IF EXISTS `fonts`;
CREATE TABLE IF NOT EXISTS `fonts` (
  `key_fonts` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `font_label` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `file_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  PRIMARY KEY (`key_fonts`),
  UNIQUE KEY `font_label` (`font_label`),
  UNIQUE KEY `file_name` (`file_name`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `home_page_sections`
--

DROP TABLE IF EXISTS `home_page_sections`;
CREATE TABLE IF NOT EXISTS `home_page_sections` (
  `key_home_page_sections` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_media_banner` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `section_type` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `content` text COLLATE utf8_unicode_ci NOT NULL,
  `image_url` varchar(2000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `target_url` varchar(2000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`key_home_page_sections`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `home_page_sections`
--

INSERT INTO `home_page_sections` (`key_home_page_sections`, `key_media_banner`, `section_type`, `title`, `content`, `image_url`, `target_url`, `sort`, `is_active`) VALUES
(1, 0, 'hero', 'Welcome To CopilotCMS', 'Clarity. Collaboration. Control.', 'https://cdn.pixabay.com/photo/2018/02/02/17/29/nature-3125912_1280.jpg', 'https://copilot/about-us', 10, 1),
(2, 0, 'about', 'About Us', 'Learn more about our organization.', '', '', 20, 1),
(3, 0, 'articles', 'Featured Articles', '', '', '', 30, 1),
(4, 0, 'authors', 'Our Authors', '', '', '', 40, 1),
(5, 0, 'categories', 'Browse Categories', '', '', '', 25, 1),
(6, 0, 'galleries', 'Photo Gallery', '', '', '', 60, 1),
(7, 0, 'videos', 'Latest Videos', '', '', '', 35, 1),
(8, 0, 'contact', 'Contact Us', 'We would love to hear from you.', '', '', 80, 1),
(9, 0, 'footer', 'Finally', 'This is footer content', '', '', 150, 1),
(10, 0, 'custom', '', '<div style=\"padding:50px;color:white;background:teal;text-align:center;font-size:200%;\">\r\nHello World!\r\n\r\n</div>', '', '', 100, 1);

-- --------------------------------------------------------

--
-- Table structure for table `main_menu`
--

DROP TABLE IF EXISTS `main_menu`;
CREATE TABLE IF NOT EXISTS `main_menu` (
  `key_main_menu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `url_link` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `css_class` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `entry_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_main_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `main_menu`
--

INSERT INTO `main_menu` (`key_main_menu`, `parent_id`, `title`, `url_link`, `css_class`, `sort`, `is_active`, `entry_date_time`) VALUES
(1, 0, 'About Us', '/page/about-us', '', 0, 1, '2026-09-20 15:30:28'),
(2, 0, 'Admissions', '/page/admissions', '', 0, 1, '2026-10-10 11:46:24'),
(3, 0, 'Academics', '/page/academics', '', 0, 1, '2026-10-10 11:46:55'),
(4, 0, 'Student Life', '/page/student-life', '', 0, 1, '2026-10-10 11:48:49'),
(5, 0, 'Parents & Students', '/page/parents-and-students-portal', '', 0, 1, '2026-10-10 11:49:50'),
(6, 0, 'News & Events', '/page/news-and-events', '', 0, 1, '2026-10-10 11:51:52'),
(7, 0, 'Contact Us', '/page/contact-us', '', 0, 1, '2026-10-10 11:52:13');

-- --------------------------------------------------------

--
-- Table structure for table `media_library`
--

DROP TABLE IF EXISTS `media_library`;
CREATE TABLE IF NOT EXISTS `media_library` (
  `key_media` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `file_url` varchar(2000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `file_url_thumbnail` varchar(2000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `file_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'images',
  `alt_text` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `tags` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `uploaded_by` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `entry_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_media`),
  KEY `uploaded_by` (`uploaded_by`)
) ENGINE=InnoDB AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `media_library`
--

INSERT INTO `media_library` (`key_media`, `file_url`, `file_url_thumbnail`, `file_type`, `alt_text`, `tags`, `uploaded_by`, `entry_date_time`) VALUES
(1, '/media/images/2026/1791611696_about-us.jfif', '/media/thumbnails/images/2026/1791611696_about-us.jfif', 'images', 'About Us', '', 1, '2026-10-10 10:54:57'),
(4, '/media/images/2026/1791618157_star-model-high-school-logo-low-res.jpg', '/media/thumbnails/images/2026/1791618157_star-model-high-school-logo-low-res.jpg', 'images', 'Star Model Public School', '', 1, '2026-10-10 12:42:37');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `key_pages` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_media_banner` int(10) UNSIGNED DEFAULT NULL,
  `banner_image_url` varchar(2000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `page_content` text COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `entry_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_pages`),
  KEY `fk_pages_media` (`key_media_banner`)
) ENGINE=InnoDB AUTO_INCREMENT=29 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`key_pages`, `key_media_banner`, `banner_image_url`, `title`, `page_content`, `url`, `sort`, `is_active`, `entry_date_time`, `update_date_time`) VALUES
(1, 1, '', 'About Us', '\r\n<h2>Our Mission</h2>\r\n<p>To provide an inclusive, challenging, and supportive learning environment where students grow into confident, responsible, and curious citizens.</p>\r\n\r\n<h2>Our Vision</h2>\r\n<p>To be a model of educational excellence, inspiring every student to reach for the stars.</p>\r\n\r\n<h2>Our Story</h2>\r\n<p>Founded in 1985, Star Model Public High School began with 300 students and a simple goal: to give every young person in our community a first-rate education. Today we serve over 1,200 students and continue to grow while staying true to our founding values of respect, integrity, and excellence.</p>\r\n\r\n<h2>A Message from the Principal</h2>\r\n<blockquote>\r\n  <p>Welcome to Star Model. Our school is more than a place to learn. It\'s a place to belong. Our teachers and staff are committed to helping each student find their passion and reach their full potential. I invite you to visit our campus and see what makes our community special.</p>\r\n  <p><em>Dr. [Principal Name], Principal</em></p>\r\n</blockquote>\r\n\r\n<h2>School at a Glance</h2>\r\n<ul>\r\n  <li><strong>Enrollment:</strong> 1,200 students</li>\r\n  <li><strong>Student-teacher ratio:</strong> 18:1</li>\r\n  <li><strong>Graduation rate:</strong> 96%</li>\r\n  <li><strong>AP courses offered:</strong> 15</li>\r\n  <li><strong>Clubs and activities:</strong> 30+</li>\r\n</ul>', 'about-us', 0, 1, '2026-10-10 10:51:28', '2026-10-10 10:55:08'),
(2, 0, '', 'Admissions', '\r\n<h2>Join the Star Model Family</h2>\r\n<p>We welcome students who are eager to learn and contribute to our community. Here\'s how to apply.</p>\r\n\r\n<h2>How to Apply</h2>\r\n<ol>\r\n  <li><strong>Submit the online application</strong> (available each year starting October 1)</li>\r\n  <li><strong>Provide documents:</strong> previous school records, birth certificate, and proof of residence</li>\r\n  <li><strong>Attend a campus tour or open house</strong></li>\r\n  <li><strong>Complete a short interview</strong> with our admissions team</li>\r\n  <li><strong>Receive your decision</strong> by mail and email</li>\r\n</ol>\r\n\r\n<h2>Key Dates</h2>\r\n<ul>\r\n  <li><strong>Applications open:</strong> October 1</li>\r\n  <li><strong>Open house:</strong> November 15</li>\r\n  <li><strong>Application deadline:</strong> January 31</li>\r\n  <li><strong>Decisions announced:</strong> March 1</li>\r\n</ul>\r\n\r\n<h2>Tuition &amp; Fees</h2>\r\n<p>As a public school, Star Model charges no tuition for eligible residents. Small fees may apply for materials, uniforms, and activities. Financial assistance is available.</p>\r\n\r\n<h2>Frequently Asked Questions</h2>\r\n<p><strong>Who is eligible to apply?</strong><br>Students completing 8th grade or transferring from another school.</p>\r\n<p><strong>Can I visit before applying?</strong><br>Yes! Tours run every Tuesday and Thursday at 10 a.m.</p>\r\n<p><strong>Do you accept transfer students?</strong><br>Yes, subject to available space.</p>\r\n\r\n<p>\r\n  <a href=\"/page/contact-us\"><strong>Schedule a Tour</strong></a> |\r\n  <a href=\"#\"><strong>Start Your Application</strong></a>\r\n</p>', 'admissions', 0, 1, '2026-10-10 10:56:02', '2026-10-10 11:29:30'),
(3, 0, '', 'Academics', '\r\n<h2>A Curriculum That Challenges and Inspires</h2>\r\n<p>Star Model offers a well-rounded education that prepares students for college, careers, and life.</p>\r\n\r\n<h2>Departments</h2>\r\n<ul>\r\n  <li><strong>English:</strong> Literature, composition, public speaking, and creative writing</li>\r\n  <li><strong>Mathematics:</strong> Algebra through AP Calculus and Statistics</li>\r\n  <li><strong>Science:</strong> Biology, Chemistry, Physics, Environmental Science, and Computer Science</li>\r\n  <li><strong>Social Studies:</strong> World history, civics, economics, and psychology</li>\r\n  <li><strong>World Languages:</strong> Spanish, French, and Urdu</li>\r\n  <li><strong>Arts:</strong> Visual arts, band, choir, drama, and digital media</li>\r\n  <li><strong>Physical Education &amp; Health</strong></li>\r\n</ul>\r\n\r\n<h2>Advanced Programs</h2>\r\n<p>Students may take Honors and Advanced Placement (AP) courses to earn college credit and stand out in admissions.</p>\r\n\r\n<h2>Graduation Requirements</h2>\r\n<table border=\"1\" cellpadding=\"8\" cellspacing=\"0\">\r\n  <thead>\r\n    <tr><th>Subject</th><th>Credits</th></tr>\r\n  </thead>\r\n  <tbody>\r\n    <tr><td>English</td><td>4</td></tr>\r\n    <tr><td>Math</td><td>3</td></tr>\r\n    <tr><td>Science</td><td>3</td></tr>\r\n    <tr><td>Social Studies</td><td>3</td></tr>\r\n    <tr><td>World Language</td><td>2</td></tr>\r\n    <tr><td>Arts</td><td>1</td></tr>\r\n    <tr><td>Electives</td><td>6</td></tr>\r\n  </tbody>\r\n</table>\r\n\r\n<h2>Counseling &amp; Support</h2>\r\n<p>Our counselors guide students through course selection, college applications, scholarships, and career planning. Free tutoring is available after school, Monday through Thursday.</p>', 'academics', 0, 1, '2026-10-10 10:56:24', '2026-10-10 10:56:24'),
(4, 0, '', 'Student Life', '\r\n<h2>More Than a Classroom</h2>\r\n<p>At Star Model, learning happens everywhere: on stage, in the lab, on the field, and in the community.</p>\r\n\r\n<h2>Clubs &amp; Organizations</h2>\r\n<ul>\r\n  <li>Robotics Club</li>\r\n  <li>Debate Team</li>\r\n  <li>Model UN</li>\r\n  <li>Art Society</li>\r\n  <li>Drama Club</li>\r\n  <li>Environmental Club</li>\r\n  <li>Coding Club</li>\r\n  <li>Yearbook</li>\r\n  <li>Chess Club</li>\r\n  <li>Community Service Club</li>\r\n</ul>\r\n\r\n<h2>Student Council</h2>\r\n<p>Elected by their peers, student council members organize school events, voice student concerns, and lead community projects.</p>\r\n\r\n<h2>Arts &amp; Music</h2>\r\n<p>Our award-winning band, choir, and theater program present concerts and productions throughout the year.</p>\r\n\r\n<h2>Traditions &amp; Events</h2>\r\n<ul>\r\n  <li>Welcome Week</li>\r\n  <li>Spirit Week and Homecoming</li>\r\n  <li>Winter Concert</li>\r\n  <li>Annual Science &amp; Arts Fair</li>\r\n  <li>Prom and Graduation Celebration</li>\r\n</ul>\r\n\r\n<p><strong>Can\'t find a club you love?</strong> Start your own! Any student can propose a new club with a faculty sponsor.</p>', 'student-life', 0, 1, '2026-10-10 10:56:49', '2026-10-10 10:56:49'),
(5, 0, '', 'Athletics', '\r\n<h2>Go Stars!</h2>\r\n<p>Our athletic program builds teamwork, discipline, and school pride. Student-athletes compete at the varsity, junior varsity, and freshman levels.</p>\r\n\r\n<h2>Sports by Season</h2>\r\n<h3>Fall</h3>\r\n<ul>\r\n  <li>Football</li>\r\n  <li>Cross Country</li>\r\n  <li>Girls\' Volleyball</li>\r\n  <li>Boys\' Soccer</li>\r\n</ul>\r\n<h3>Winter</h3>\r\n<ul>\r\n  <li>Basketball</li>\r\n  <li>Swimming</li>\r\n  <li>Wrestling</li>\r\n</ul>\r\n<h3>Spring</h3>\r\n<ul>\r\n  <li>Baseball</li>\r\n  <li>Softball</li>\r\n  <li>Track &amp; Field</li>\r\n  <li>Tennis</li>\r\n  <li>Girls\' Soccer</li>\r\n</ul>\r\n\r\n<h2>Join a Team</h2>\r\n<p>To participate, students need a current physical exam, a signed parent consent form, and a minimum GPA of 2.0. Tryout dates are posted on the calendar.</p>\r\n\r\n<h2>Schedules &amp; Scores</h2>\r\n<p>View game schedules, results, and team rosters on the <a href=\"#\">Athletics Calendar</a>.</p>\r\n\r\n<h2>Coaching Staff</h2>\r\n<p>Our coaches are experienced educators and mentors who put character and academics first.</p>\r\n\r\n<p><strong>Contact:</strong> Athletic Director, [Name] | <a href=\"mailto:athletics@starmodelhs.edu\">athletics@starmodelhs.edu</a></p>', 'athletics', 0, 1, '2026-10-10 10:57:22', '2026-10-10 10:57:22'),
(6, 0, '', 'Faculty &amp; Staff', '\r\n<h2>Meet Our Team</h2>\r\n<p>Our faculty and staff are the heart of Star Model. They are passionate, qualified, and dedicated to student success.</p>\r\n\r\n<h2>Administration</h2>\r\n<ul>\r\n  <li><strong>Principal:</strong> Dr. [Name]</li>\r\n  <li><strong>Vice Principal:</strong> Ms. [Name]</li>\r\n  <li><strong>Dean of Students:</strong> Mr. [Name]</li>\r\n</ul>\r\n\r\n<h2>Department Heads</h2>\r\n<ul>\r\n  <li><strong>English:</strong> Ms. [Name]</li>\r\n  <li><strong>Mathematics:</strong> Mr. [Name]</li>\r\n  <li><strong>Science:</strong> Dr. [Name]</li>\r\n  <li><strong>Social Studies:</strong> Mrs. [Name]</li>\r\n  <li><strong>Arts:</strong> Mr. [Name]</li>\r\n</ul>\r\n\r\n<h2>Counseling &amp; Support Staff</h2>\r\n<ul>\r\n  <li><strong>Head Counselor:</strong> Ms. [Name]</li>\r\n  <li><strong>School Nurse:</strong> Mrs. [Name]</li>\r\n  <li><strong>Librarian:</strong> Mr. [Name]</li>\r\n</ul>\r\n\r\n<p><a href=\"/contact\"><strong>Contact</strong></a> for the full staff directory with email addresses.</p>\r\n', 'faculty-and-staff', 0, 1, '2026-10-10 10:57:50', '2026-10-10 11:32:53'),
(7, 0, '', 'News & Events', '\r\n<h2>What\'s Happening at Star Model</h2>\r\n\r\n<h2>Latest News</h2>\r\n<h3>Science Fair Winners Advance to Regionals</h3>\r\n<p>Five Star Model students will represent our school at the regional competition next month.</p>\r\n\r\n<h3>New Robotics Lab Opens</h3>\r\n<p>Thanks to generous community support, students now have access to a state-of-the-art lab.</p>\r\n\r\n<h3>Student Spotlight</h3>\r\n<p>Congratulations to senior [Name] on earning a full scholarship!</p>\r\n\r\n<h2>Upcoming Events</h2>\r\n<ul>\r\n  <li><strong>Nov 15:</strong> Fall Open House, 6:00 p.m.</li>\r\n  <li><strong>Nov 22:</strong> Parent-Teacher Conferences</li>\r\n  <li><strong>Dec 10:</strong> Winter Concert, 7:00 p.m.</li>\r\n  <li><strong>Dec 20:</strong> Last day before winter break</li>\r\n</ul>\r\n\r\n<p>\r\n  <a href=\"#\"><strong>View Full Calendar</strong></a> |\r\n  <a href=\"#\"><strong>Subscribe to Newsletter</strong></a>\r\n</p>', 'news-and-events', 0, 1, '2026-10-10 10:58:23', '2026-10-10 10:58:23'),
(8, 0, '', 'Parents & Students Portal', '\r\n<h2>Everything You Need in One Place</h2>\r\n\r\n<h2>For Students</h2>\r\n<ul>\r\n  <li>Check grades and assignments</li>\r\n  <li>Access your school email</li>\r\n  <li>View your class schedule</li>\r\n  <li>Find library and tutoring resources</li>\r\n</ul>\r\n\r\n<h2>For Parents</h2>\r\n<ul>\r\n  <li>Track attendance and progress</li>\r\n  <li>Download forms and permission slips</li>\r\n  <li>Review the student handbook and school policies</li>\r\n  <li>View lunch menus and bus routes</li>\r\n  <li>Update contact information</li>\r\n</ul>\r\n\r\n<h2>Quick Links</h2>\r\n<p>\r\n  <a href=\"/page/grade-portal\">Grade Portal</a> |\r\n  <a href=\"/page/lunch-menu\">Lunch Menu</a> |\r\n  <a href=\"/page/bus-routes\">Bus Routes</a> |\r\n  <a href=\"/page/student-handbook\">Student Handbook</a> |\r\n  <a href=\"/page/dress-code\">Dress Code</a> |\r\n  <a href=\"/page/technology-help-desk\">Technology Help Desk</a>\r\n</p>\r\n\r\n<p><strong>Need help logging in?</strong> Contact the help desk at <a href=\"mailto:helpdesk@starmodelhs.edu\">helpdesk@starmodelhs.edu</a>.</p>', 'parents-and-students-portal', 0, 1, '2026-10-10 10:59:09', '2026-10-10 11:51:13'),
(9, 0, '', 'Contact Us', '\r\n<h2>We\'d Love to Hear From You</h2>\r\n\r\n<h2>Star Model Public High School</h2>\r\n<p>\r\n  123 Education Avenue<br>\r\n  [City, State, ZIP]\r\n</p>\r\n<p>\r\n  <strong>Phone:</strong> (555) 123-4567<br>\r\n  <strong>Fax:</strong> (555) 123-4568<br>\r\n  <strong>Email:</strong> <a href=\"mailto:info@starmodelhs.edu\">info@starmodelhs.edu</a>\r\n</p>\r\n<p><strong>Office Hours:</strong> Monday to Friday, 7:30 a.m. to 4:00 p.m.</p>\r\n\r\n<h2>Department Contacts</h2>\r\n<ul>\r\n  <li><strong>Admissions:</strong> <a href=\"mailto:admissions@starmodelhs.edu\">admissions@starmodelhs.edu</a></li>\r\n  <li><strong>Counseling:</strong> <a href=\"mailto:counseling@starmodelhs.edu\">counseling@starmodelhs.edu</a></li>\r\n  <li><strong>Athletics:</strong> <a href=\"mailto:athletics@starmodelhs.edu\">athletics@starmodelhs.edu</a></li>\r\n</ul>\r\n\r\n<h2>Send Us a Message</h2>\r\n<!-- Replace this note with your website builder\'s contact form widget -->\r\n<p><a href=\"/contact\"><strong>Contact form</strong></a></p>\r\n\r\n<h2>Find Us</h2>\r\n<!-- Replace this note with an embedded Google Map (Share &gt; Embed a map) -->\r\n<p><em>[Embedded map goes here]</em></p>', 'contact-us', 0, 1, '2026-10-10 10:59:27', '2026-10-10 11:33:52'),
(10, 0, '', 'Alumni', '<h2>Once a Star, Always a Star</h2>\r\n<p>Since 1985, thousands of students have walked the halls of Star Model Public High School and gone on to make their mark in their communities and careers. Our alumni network keeps those connections strong and gives back to the students who follow.</p>\r\n\r\n<h2>Stay Connected</h2>\r\n<ul>\r\n  <li><strong>Update your information</strong> so we can keep you informed about school news and events</li>\r\n  <li><strong>Join the alumni newsletter</strong> for quarterly updates</li>\r\n  <li><strong>Follow us on social media</strong> to reconnect with classmates</li>\r\n</ul>\r\n<p><a href=\"#\"><strong>Update Your Contact Info</strong></a> | <a href=\"#\"><strong>Join the Newsletter</strong></a></p>\r\n\r\n<h2>Notable Alumni</h2>\r\n<ul>\r\n  <li><strong>[Name], Class of 1992:</strong> Award-winning surgeon and hospital director</li>\r\n  <li><strong>[Name], Class of 1998:</strong> Founder of a nationally recognized technology company</li>\r\n  <li><strong>[Name], Class of 2005:</strong> Olympic athlete and youth sports advocate</li>\r\n  <li><strong>[Name], Class of 2012:</strong> Published author and university professor</li>\r\n</ul>\r\n\r\n<h2>Reunions &amp; Events</h2>\r\n<ul>\r\n  <li><strong>Homecoming Weekend:</strong> Annual gathering for all graduating classes, held each fall</li>\r\n  <li><strong>Milestone Reunions:</strong> Classes ending in 0 or 5 are invited to special celebrations</li>\r\n  <li><strong>Alumni Career Night:</strong> Graduates share advice with current seniors each spring</li>\r\n</ul>\r\n\r\n<h2>Give Back</h2>\r\n<p>Alumni can mentor students, speak at career events, or support the school through a gift. Learn more on our <a href=\"/page/support-star-model-public-high-school\">Support Star Model</a> page.</p>\r\n\r\n<p>Questions? Contact the alumni office at <a href=\"mailto:alumni@starmodelhs.edu\">alumni@starmodelhs.edu</a>.</p>', 'alumni', 0, 1, '2026-10-10 11:04:45', '2026-10-10 11:35:13'),
(11, 0, '', 'Support Star Model', '\r\n<h2>Help Our Students Shine</h2>\r\n<p>Public funding covers the essentials, but it\'s the generosity of families, alumni, and community partners that makes the extras possible: new equipment, scholarships, arts programs, and more. Every contribution, large or small, makes a difference.</p>\r\n\r\n<h2>Ways to Give</h2>\r\n<ul>\r\n  <li><strong>Make a donation:</strong> Give once or set up a monthly gift online</li>\r\n  <li><strong>Sponsor a program:</strong> Support robotics, arts, athletics, or another area you care about</li>\r\n  <li><strong>Matching gifts:</strong> Check whether your employer will match your donation</li>\r\n  <li><strong>In-kind donations:</strong> Books, supplies, and equipment are always welcome</li>\r\n</ul>\r\n<p><a href=\"#\"><strong>Donate Now</strong></a></p>\r\n\r\n<h2>Where Your Gift Goes</h2>\r\n<ul>\r\n  <li><strong>Student scholarships</strong> for graduating seniors</li>\r\n  <li><strong>Technology and lab equipment</strong> for classrooms</li>\r\n  <li><strong>Arts and music programs,</strong> including instruments and costumes</li>\r\n  <li><strong>Athletics,</strong> including uniforms and training gear</li>\r\n  <li><strong>Field trips and enrichment</strong> for students who might otherwise miss out</li>\r\n</ul>\r\n\r\n<h2>Booster Clubs</h2>\r\n<p>Our booster clubs raise funds and cheer on students all year long. Join one today:</p>\r\n<ul>\r\n  <li>Athletics Boosters</li>\r\n  <li>Band &amp; Choir Boosters</li>\r\n  <li>Drama Boosters</li>\r\n  <li>Robotics Boosters</li>\r\n</ul>\r\n\r\n<h2>Volunteer</h2>\r\n<p>Can you spare a few hours? We welcome volunteers for school events, tutoring, career days, and campus beautification projects.</p>\r\n<p><a href=\"#\"><strong>Sign Up to Volunteer</strong></a></p>\r\n\r\n<p>Star Model Public High School Foundation is a registered non-profit organization. Donations may be tax-deductible to the extent allowed by law. Questions? Contact <a href=\"mailto:giving@starmodelhs.edu\">giving@starmodelhs.edu</a>.</p>', 'support-star-model-public-high-school', 0, 1, '2026-10-10 11:05:11', '2026-10-10 11:05:11'),
(12, 0, '', 'Careers', '\r\n<h2>Join Our Team</h2>\r\n<p>At Star Model Public High School, we\'re looking for passionate educators and dedicated staff who want to make a difference in young people\'s lives. We offer a supportive workplace, ongoing professional development, and a community that values your contribution.</p>\r\n\r\n<h2>Why Work at Star Model?</h2>\r\n<ul>\r\n  <li>Collaborative, student-focused culture</li>\r\n  <li>Competitive salary and benefits</li>\r\n  <li>Paid professional development and mentoring for new teachers</li>\r\n  <li>Opportunities to lead clubs, teams, and programs</li>\r\n  <li>Modern classrooms and well-equipped labs</li>\r\n</ul>\r\n\r\n<h2>Current Openings</h2>\r\n<table border=\"1\" cellpadding=\"8\" cellspacing=\"0\">\r\n  <thead>\r\n    <tr><th>Position</th><th>Department</th><th>Type</th><th>Apply By</th></tr>\r\n  </thead>\r\n  <tbody>\r\n    <tr><td>High School Mathematics Teacher</td><td>Mathematics</td><td>Full-time</td><td>[Date]</td></tr>\r\n    <tr><td>Science Teacher (Biology/Chemistry)</td><td>Science</td><td>Full-time</td><td>[Date]</td></tr>\r\n    <tr><td>School Counselor</td><td>Counseling</td><td>Full-time</td><td>[Date]</td></tr>\r\n    <tr><td>Assistant Football Coach</td><td>Athletics</td><td>Part-time</td><td>[Date]</td></tr>\r\n    <tr><td>Substitute Teacher</td><td>All Departments</td><td>As needed</td><td>Ongoing</td></tr>\r\n    <tr><td>Bus Driver</td><td>Transportation</td><td>Full-time</td><td>[Date]</td></tr>\r\n  </tbody>\r\n</table>\r\n\r\n<h2>How to Apply</h2>\r\n<ol>\r\n  <li>Review the job description and requirements</li>\r\n  <li>Prepare your resume and a short cover letter</li>\r\n  <li>Gather contact details for three professional references</li>\r\n  <li>Email your application to <a href=\"mailto:hr@starmodelhs.edu\">hr@starmodelhs.edu</a> with the position title in the subject line</li>\r\n</ol>\r\n<p><a href=\"#\"><strong>Apply Online</strong></a></p>\r\n\r\n<p>Star Model Public High School is an equal opportunity employer. We welcome applicants of all backgrounds and do not discriminate on the basis of race, color, religion, gender, age, disability, or any other protected status.</p>', 'careers', 0, 1, '2026-10-10 11:05:32', '2026-10-10 11:05:32'),
(13, 0, '', 'Safety & Wellness', '\r\n<h2>A Safe School Is a Strong School</h2>\r\n<p>The safety, health, and well-being of our students come first. Learning thrives when students feel secure, supported, and respected.</p>\r\n\r\n<h2>Campus Safety</h2>\r\n<ul>\r\n  <li><strong>Controlled access:</strong> All visitors must check in at the main office and wear a visitor badge</li>\r\n  <li><strong>Supervision:</strong> Staff are present before school, during lunch, and at dismissal</li>\r\n  <li><strong>Security cameras:</strong> Monitored cameras cover entrances, hallways, and parking areas</li>\r\n  <li><strong>Regular drills:</strong> Fire, lockdown, and severe weather drills are practiced throughout the year</li>\r\n</ul>\r\n\r\n<h2>Emergency Information</h2>\r\n<p>In an emergency, we will notify families by text message, email, and phone call. Please make sure your contact information is up to date with the main office.</p>\r\n<ul>\r\n  <li><strong>Main office:</strong> (555) 123-4567</li>\r\n  <li><strong>Emergency services:</strong> Call your local emergency number</li>\r\n  <li><strong>Reunification site:</strong> [Location], announced during any evacuation</li>\r\n</ul>\r\n\r\n<h2>Counseling &amp; Mental Health</h2>\r\n<p>Our counseling team supports students with academic stress, friendships, family challenges, and emotional well-being. Students can drop in or schedule an appointment, and parents can request a meeting at any time.</p>\r\n<p>If you or someone you know is struggling, please reach out to a counselor, teacher, or trusted adult right away. If someone is in immediate danger, call your local emergency number.</p>\r\n<p><strong>Counseling office:</strong> <a href=\"mailto:counseling@starmodelhs.edu\">counseling@starmodelhs.edu</a></p>\r\n\r\n<h2>Health Services</h2>\r\n<ul>\r\n  <li>A full-time school nurse is available during school hours</li>\r\n  <li>Medication must be delivered to the nurse\'s office with a signed parent authorization form</li>\r\n  <li>Immunization records are required for enrollment</li>\r\n  <li>Students who are ill should stay home and return after being symptom-free for 24 hours</li>\r\n</ul>\r\n\r\n<h2>Anti-Bullying</h2>\r\n<p>Star Model has zero tolerance for bullying, harassment, and discrimination, including cyberbullying. Every report is taken seriously and investigated promptly.</p>\r\n<ul>\r\n  <li><strong>Report in person:</strong> Tell any teacher, counselor, or administrator</li>\r\n  <li><strong>Report online:</strong> Use the confidential reporting form</li>\r\n  <li><strong>Report anonymously:</strong> Drop a note in the boxes outside the counseling office</li>\r\n</ul>\r\n<p><a href=\"#\"><strong>Submit a Confidential Report</strong></a></p>', 'safety-and-wellness', 0, 1, '2026-10-10 11:05:59', '2026-10-10 11:05:59'),
(14, 0, '', 'Grade Portal', '<h2>Track Academic Progress Anytime</h2>\r\n<p>The Grade Portal gives students and parents secure, real-time access to grades, assignments, and attendance.</p>\r\n\r\n<p><a href=\"#\"><strong>Log In to the Grade Portal</strong></a></p>\r\n\r\n<h2>What You Can Do</h2>\r\n<ul>\r\n  <li>View current grades for every class</li>\r\n  <li>See upcoming and missing assignments</li>\r\n  <li>Check attendance records</li>\r\n  <li>Read teacher comments and progress notes</li>\r\n  <li>Download report cards and progress reports</li>\r\n</ul>\r\n\r\n<h2>Logging In</h2>\r\n<ul>\r\n  <li><strong>Students:</strong> Use your school email address and the password issued by your homeroom teacher</li>\r\n  <li><strong>Parents/Guardians:</strong> Use the activation code sent to you at the start of the school year. Each parent or guardian has a separate account.</li>\r\n</ul>\r\n\r\n<h2>Grading Periods</h2>\r\n<table border=\"1\" cellpadding=\"8\" cellspacing=\"0\">\r\n  <thead>\r\n    <tr><th>Period</th><th>Ends</th><th>Report Cards Available</th></tr>\r\n  </thead>\r\n  <tbody>\r\n    <tr><td>Quarter 1</td><td>[Date]</td><td>[Date]</td></tr>\r\n    <tr><td>Quarter 2</td><td>[Date]</td><td>[Date]</td></tr>\r\n    <tr><td>Quarter 3</td><td>[Date]</td><td>[Date]</td></tr>\r\n    <tr><td>Quarter 4</td><td>[Date]</td><td>[Date]</td></tr>\r\n  </tbody>\r\n</table>\r\n\r\n<h2>Grading Scale</h2>\r\n<table border=\"1\" cellpadding=\"8\" cellspacing=\"0\">\r\n  <thead>\r\n    <tr><th>Letter Grade</th><th>Percentage</th></tr>\r\n  </thead>\r\n  <tbody>\r\n    <tr><td>A</td><td>90 to 100</td></tr>\r\n    <tr><td>B</td><td>80 to 89</td></tr>\r\n    <tr><td>C</td><td>70 to 79</td></tr>\r\n    <tr><td>D</td><td>60 to 69</td></tr>\r\n    <tr><td>F</td><td>Below 60</td></tr>\r\n  </tbody>\r\n</table>\r\n\r\n<h2>Need Help?</h2>\r\n<p>Forgot your password or having trouble logging in? Visit the <a href=\"/technology-help-desk\">Technology Help Desk</a>. For questions about a specific grade, please contact the teacher directly.</p>', 'grade-portal', 0, 1, '2026-10-10 11:06:27', '2026-10-10 11:06:27'),
(15, 0, '', 'Lunch Menu', '\r\n<h2>Healthy Meals for Growing Minds</h2>\r\n<p>Star Model\'s cafeteria serves nutritious, freshly prepared meals every school day. Each lunch includes a main dish, a fruit or vegetable, and milk or water.</p>\r\n\r\n<h2>This Week\'s Menu</h2>\r\n<table border=\"1\" cellpadding=\"8\" cellspacing=\"0\">\r\n  <thead>\r\n    <tr><th>Day</th><th>Main Dish</th><th>Vegetarian Option</th><th>Side</th></tr>\r\n  </thead>\r\n  <tbody>\r\n    <tr><td>Monday</td><td>Grilled chicken wrap</td><td>Veggie and hummus wrap</td><td>Garden salad and fruit cup</td></tr>\r\n    <tr><td>Tuesday</td><td>Beef and bean burrito</td><td>Cheese and bean burrito</td><td>Rice and corn salad</td></tr>\r\n    <tr><td>Wednesday</td><td>Baked pasta with meat sauce</td><td>Baked pasta with vegetable sauce</td><td>Steamed broccoli and apple</td></tr>\r\n    <tr><td>Thursday</td><td>Chicken biryani</td><td>Vegetable biryani</td><td>Yogurt raita and cucumber slices</td></tr>\r\n    <tr><td>Friday</td><td>Pizza slice</td><td>Cheese pizza</td><td>Side salad and orange wedges</td></tr>\r\n  </tbody>\r\n</table>\r\n<p><em>Menus are subject to change based on availability.</em></p>\r\n\r\n<h2>Prices</h2>\r\n<ul>\r\n  <li><strong>Student lunch:</strong> $3.00</li>\r\n  <li><strong>Breakfast:</strong> $1.50</li>\r\n  <li><strong>Extra milk or juice:</strong> $0.75</li>\r\n  <li><strong>Adult lunch:</strong> $4.50</li>\r\n</ul>\r\n\r\n<h2>Free &amp; Reduced-Price Meals</h2>\r\n<p>Families may qualify for free or reduced-price meals. Applications are confidential and can be submitted at any time during the school year.</p>\r\n<p><a href=\"#\"><strong>Download the Meal Assistance Application</strong></a></p>\r\n\r\n<h2>Payments</h2>\r\n<p>Parents can add money to a student\'s lunch account online or send cash or a check to the cafeteria. Accounts with a low balance will trigger an email reminder.</p>\r\n\r\n<h2>Allergies &amp; Dietary Needs</h2>\r\n<p>If your child has a food allergy or special dietary requirement, please submit a medical statement to the school nurse. We will work with you to provide safe meal options.</p>', 'lunch-menu', 0, 1, '2026-10-10 11:06:56', '2026-10-10 11:06:56'),
(16, 0, '', 'Bus Routes', '<h2>Safe, Reliable Transportation</h2>\r\n<p>Star Model provides bus service to students living more than one mile from campus. Buses run on a fixed schedule each school day.</p>\r\n\r\n<h2>Find Your Route</h2>\r\n<p>Enter your home address in the <a href=\"#\">Route Finder</a> to see your assigned bus, stop location, and pickup times.</p>\r\n\r\n<h2>Route Summary</h2>\r\n<table border=\"1\" cellpadding=\"8\" cellspacing=\"0\">\r\n  <thead>\r\n    <tr><th>Route</th><th>Area Served</th><th>Morning Pickup</th><th>Afternoon Drop-off</th></tr>\r\n  </thead>\r\n  <tbody>\r\n    <tr><td>Route 1</td><td>North Side</td><td>6:45 a.m. to 7:20 a.m.</td><td>3:40 p.m. to 4:15 p.m.</td></tr>\r\n    <tr><td>Route 2</td><td>East Side</td><td>6:50 a.m. to 7:25 a.m.</td><td>3:40 p.m. to 4:20 p.m.</td></tr>\r\n    <tr><td>Route 3</td><td>South Side</td><td>6:40 a.m. to 7:15 a.m.</td><td>3:40 p.m. to 4:10 p.m.</td></tr>\r\n    <tr><td>Route 4</td><td>West Side</td><td>6:55 a.m. to 7:30 a.m.</td><td>3:40 p.m. to 4:25 p.m.</td></tr>\r\n    <tr><td>Route 5</td><td>Downtown and Surrounding Areas</td><td>7:00 a.m. to 7:30 a.m.</td><td>3:40 p.m. to 4:15 p.m.</td></tr>\r\n  </tbody>\r\n</table>\r\n<p><em>Times are approximate. Please be at your stop 5 minutes early.</em></p>\r\n\r\n<h2>Bus Safety Rules</h2>\r\n<ul>\r\n  <li>Remain seated and facing forward while the bus is moving</li>\r\n  <li>Keep aisles and exits clear of bags and belongings</li>\r\n  <li>Use quiet voices so the driver can focus</li>\r\n  <li>No eating or drinking on the bus</li>\r\n  <li>Follow the driver\'s instructions at all times</li>\r\n  <li>Treat everyone with respect</li>\r\n</ul>\r\n\r\n<h2>Delays &amp; Cancellations</h2>\r\n<p>Bus delays and weather-related changes are announced by text message and email, and posted on our <a href=\"/news-events\">News &amp; Events</a> page by 6:30 a.m.</p>\r\n\r\n<h2>Contact Transportation</h2>\r\n<p><strong>Phone:</strong> (555) 123-4570<br>\r\n<strong>Email:</strong> <a href=\"mailto:transportation@starmodelhs.edu\">transportation@starmodelhs.edu</a><br>\r\n<strong>Office hours:</strong> Monday to Friday, 6:00 a.m. to 4:30 p.m.</p>', 'bus-routes', 0, 1, '2026-10-10 11:07:17', '2026-10-10 11:07:17'),
(17, 0, '', 'Student Handbook', '\r\n<h2>Your Guide to Life at Star Model</h2>\r\n<p>The Student Handbook explains our school\'s expectations, policies, and procedures. Students and parents should read it together at the start of each school year.</p>\r\n\r\n<p><a href=\"#\"><strong>Download the Full Handbook (PDF)</strong></a></p>\r\n\r\n<h2>Quick Reference</h2>\r\n\r\n<h3>School Day</h3>\r\n<ul>\r\n  <li><strong>First bell:</strong> 7:45 a.m.</li>\r\n  <li><strong>Classes begin:</strong> 8:00 a.m.</li>\r\n  <li><strong>Dismissal:</strong> 3:30 p.m.</li>\r\n</ul>\r\n\r\n<h3>Attendance</h3>\r\n<ul>\r\n  <li>Students are expected to attend every day and be on time for every class</li>\r\n  <li>Parents should call or email the attendance office by 9:00 a.m. on the day of an absence</li>\r\n  <li>After three unexcused late arrivals, a parent conference may be required</li>\r\n  <li>Students are responsible for making up missed work within one week of returning</li>\r\n</ul>\r\n\r\n<h3>Academic Integrity</h3>\r\n<p>Students are expected to do their own work. Cheating, plagiarism, and misuse of AI tools or other resources on assignments and exams are not allowed and may lead to a zero on the work and disciplinary action.</p>\r\n\r\n<h3>Code of Conduct</h3>\r\n<ul>\r\n  <li>Respect yourself, others, and school property</li>\r\n  <li>Come to class prepared and ready to learn</li>\r\n  <li>Use kind and appropriate language</li>\r\n  <li>Resolve conflicts peacefully and ask for help when needed</li>\r\n</ul>\r\n\r\n<h3>Technology &amp; Phones</h3>\r\n<p>Phones must be silenced and put away during class unless a teacher approves their use for learning. School devices and networks may only be used for educational purposes.</p>\r\n\r\n<h3>Discipline</h3>\r\n<p>Behavior concerns are addressed using a fair, step-by-step approach: a conversation, a parent contact, a detention or conference, and, for serious or repeated issues, suspension or other consequences.</p>\r\n\r\n<h3>Visitors</h3>\r\n<p>All visitors must check in at the main office with a photo ID.</p>\r\n\r\n<h2>Related Pages</h2>\r\n<ul>\r\n  <li><a href=\"/page/dress-code\">Dress Code</a></li>\r\n  <li><a href=\"/page/safety-and-wellness\">Safety &amp; Wellness</a></li>\r\n  <li><a href=\"/page/technology-help-desk\">Technology Help Desk</a></li>\r\n</ul>\r\n\r\n<p>Questions about school policies? Contact the main office at <a href=\"mailto:info@starmodelhs.edu\">info@starmodelhs.edu</a>.</p>', 'student-handbook', 0, 1, '2026-10-10 11:07:50', '2026-10-10 11:38:11'),
(18, 0, '', 'Dress Code', '\r\n<h2>Dress for Success</h2>\r\n<p>Our dress code helps create a safe, focused, and respectful learning environment. It applies on campus, on school buses, and at school-sponsored events unless otherwise noted.</p>\r\n\r\n<h2>Expected Attire</h2>\r\n<ul>\r\n  <li>Shirts, tops, or dresses with sleeves or straps that cover the shoulders</li>\r\n  <li>Pants, skirts, shorts, or dresses of a modest length</li>\r\n  <li>Closed-toe shoes for labs, PE, and workshops, and appropriate footwear at all times</li>\r\n  <li>Clothing that is clean and in good condition</li>\r\n</ul>\r\n\r\n<h2>Not Permitted</h2>\r\n<ul>\r\n  <li>Clothing with offensive, violent, or inappropriate language or images</li>\r\n  <li>Clothing that promotes alcohol, tobacco, drugs, or weapons</li>\r\n  <li>Clothing that is see-through or reveals undergarments</li>\r\n  <li>Hats or hoods worn indoors, except for religious or medical reasons</li>\r\n  <li>Items that could cause injury, such as spiked jewelry or chains</li>\r\n</ul>\r\n\r\n<h2>Special Days</h2>\r\n<table border=\"1\" cellpadding=\"8\" cellspacing=\"0\">\r\n  <thead>\r\n    <tr><th>Occasion</th><th>Attire</th></tr>\r\n  </thead>\r\n  <tbody>\r\n    <tr><td>Spirit Week</td><td>Themed dress days announced in advance</td></tr>\r\n    <tr><td>Fridays</td><td>Star Model spirit wear welcome</td></tr>\r\n    <tr><td>Assemblies and ceremonies</td><td>Formal or business casual</td></tr>\r\n    <tr><td>PE and athletics</td><td>School-issued or appropriate athletic clothing</td></tr>\r\n  </tbody>\r\n</table>\r\n\r\n<h2>Religious &amp; Cultural Attire</h2>\r\n<p>Star Model respects every student\'s religious and cultural traditions. Head coverings and other religious or cultural clothing are always welcome. Families with questions can contact the Dean of Students.</p>\r\n\r\n<h2>If a Student Is Out of Dress Code</h2>\r\n<ol>\r\n  <li>The student will receive a private, respectful reminder from a staff member</li>\r\n  <li>The student will be offered a change of clothes from the main office when possible</li>\r\n  <li>Repeated violations may result in a parent contact</li>\r\n</ol>\r\n\r\n<h2>Uniforms</h2>\r\n<p>Students may be required to wear a uniform for certain programs or events. Financial assistance is available for families who need help.</p>\r\n\r\n<p>Questions? Contact the Dean of Students at <a href=\"mailto:dean@starmodelhs.edu\">dean@starmodelhs.edu</a>.</p>', 'dress-code', 0, 1, '2026-10-10 11:08:18', '2026-10-10 11:08:18'),
(19, 0, '', 'Technology Help Desk', '\r\n<h2>We\'re Here to Help</h2>\r\n<p>Having trouble with a password, school device, or online account? Our technology team supports students, parents, and staff.</p>\r\n\r\n<p><strong>Email:</strong> <a href=\"mailto:helpdesk@starmodelhs.edu\">helpdesk@starmodelhs.edu</a><br>\r\n<strong>Phone:</strong> (555) 123-4575<br>\r\n<strong>In person:</strong> Room 114 (next to the library)<br>\r\n<strong>Hours:</strong> Monday to Friday, 7:30 a.m. to 4:00 p.m.</p>\r\n\r\n<p><a href=\"#\"><strong>Submit a Help Request</strong></a></p>\r\n\r\n<h2>Common Issues</h2>\r\n\r\n<h3>Forgot My Password</h3>\r\n<ol>\r\n  <li>Go to the login page and select \"Forgot password\"</li>\r\n  <li>Enter your school email address</li>\r\n  <li>Follow the link sent to your email to create a new password</li>\r\n</ol>\r\n<p>If you can\'t access your school email, visit the help desk with your student ID.</p>\r\n\r\n<h3>Can\'t Connect to Wi-Fi</h3>\r\n<ul>\r\n  <li>Select the <strong>StarModel-Students</strong> network</li>\r\n  <li>Log in with your school email and password</li>\r\n  <li>Restart your device and try again if the connection fails</li>\r\n</ul>\r\n\r\n<h3>Damaged or Lost School Device</h3>\r\n<p>Report it to the help desk right away. Please do not attempt to repair a school device yourself.</p>\r\n\r\n<h2>Student Accounts</h2>\r\n<ul>\r\n  <li>Every student receives a school email account and access to learning platforms</li>\r\n  <li>Accounts must be used responsibly and in line with the Acceptable Use Policy</li>\r\n  <li>Passwords should never be shared with anyone</li>\r\n</ul>\r\n\r\n<h2>Parent Accounts</h2>\r\n<p>Parents can get help with Grade Portal activation, updating contact information, and accessing school communications. Visit the <a href=\"/page/grade-portal\">Grade Portal</a> page for details.</p>\r\n\r\n<h2>Online Safety Tips</h2>\r\n<ul>\r\n  <li>Use a strong password with a mix of letters, numbers, and symbols</li>\r\n  <li>Never click suspicious links or open unknown attachments</li>\r\n  <li>Log out of shared devices when you are finished</li>\r\n  <li>Report anything suspicious to the help desk right away</li>\r\n</ul>\r\n\r\n<h2>Acceptable Use Policy</h2>\r\n<p>All users of school technology must follow the Acceptable Use Policy. <a href=\"#\">Read the Acceptable Use Policy</a>.</p>', 'technology-help-desk', 0, 1, '2026-10-10 11:08:38', '2026-10-10 11:39:26'),
(20, 0, '', 'Privacy Policy', '\r\n<p><em>Last updated: [Date]</em></p>\r\n\r\n<p>Star Model Public High School (\"Star Model,\" \"we,\" \"us,\" or \"our\") respects your privacy. This policy explains what information we collect through our website, how we use it, and the choices you have. By using this website, you agree to the practices described here.</p>\r\n\r\n<h2>1. Information We Collect</h2>\r\n<h3>Information you give us</h3>\r\n<ul>\r\n  <li>Contact details you submit through forms, such as name, email address, phone number, and message</li>\r\n  <li>Application and enrollment information submitted through admissions forms</li>\r\n  <li>Information you provide when signing up for newsletters, events, volunteering, or donations</li>\r\n  <li>Job application materials submitted through our Careers page</li>\r\n</ul>\r\n\r\n<h3>Information collected automatically</h3>\r\n<ul>\r\n  <li>IP address, browser type, device type, and operating system</li>\r\n  <li>Pages visited, time spent on pages, and referring websites</li>\r\n  <li>Information collected through cookies and similar technologies (see our <a href=\"/cookie-policy\">Cookie Policy</a>)</li>\r\n</ul>\r\n\r\n<h2>2. How We Use Information</h2>\r\n<ul>\r\n  <li>To respond to inquiries and provide requested services</li>\r\n  <li>To process applications, registrations, and donations</li>\r\n  <li>To send school news, alerts, and event information</li>\r\n  <li>To maintain the security and performance of our website</li>\r\n  <li>To understand how visitors use our site so we can improve it</li>\r\n  <li>To meet legal and regulatory obligations</li>\r\n</ul>\r\n\r\n<h2>3. How We Share Information</h2>\r\n<p>We do not sell personal information. We may share information only:</p>\r\n<ul>\r\n  <li>With school staff who need it to carry out their duties</li>\r\n  <li>With trusted service providers who help us operate the website, such as hosting, email, payment, and analytics providers, under agreements that require them to protect your information</li>\r\n  <li>When required by law, court order, or government request</li>\r\n  <li>To protect the safety, rights, or property of students, staff, or the school</li>\r\n</ul>\r\n\r\n<h2>4. Children\'s Privacy</h2>\r\n<p>This website is intended for use by parents, guardians, staff, and students. We do not knowingly collect personal information online from children under 13 without verifiable parental consent. If you believe a child has submitted personal information to us without consent, please contact us so we can delete it. For more details, see our <a href=\"/student-data-privacy\">Student Data Privacy</a> page.</p>\r\n\r\n<h2>5. Data Security</h2>\r\n<p>We use reasonable administrative, technical, and physical safeguards to protect your information. However, no method of transmission or storage is completely secure, and we cannot guarantee absolute security.</p>\r\n\r\n<h2>6. Data Retention</h2>\r\n<p>We keep personal information only as long as needed for the purposes described in this policy or as required by law, and then delete or anonymize it.</p>\r\n\r\n<h2>7. Your Choices and Rights</h2>\r\n<p>Depending on where you live, you may have the right to:</p>\r\n<ul>\r\n  <li>Request access to the personal information we hold about you</li>\r\n  <li>Ask us to correct or delete your information</li>\r\n  <li>Opt out of marketing emails by clicking \"unsubscribe\" in any message</li>\r\n  <li>Control cookies through your browser settings</li>\r\n</ul>\r\n<p>To make a request, contact us using the details below.</p>\r\n\r\n<h2>8. Third-Party Links</h2>\r\n<p>Our website may link to external sites, such as payment processors, social media, or learning platforms. We are not responsible for the privacy practices of those sites and encourage you to read their policies.</p>\r\n\r\n<h2>9. Changes to This Policy</h2>\r\n<p>We may update this policy from time to time. The \"Last updated\" date at the top shows when changes were last made. Continued use of the website after changes means you accept the updated policy.</p>\r\n\r\n<h2>10. Contact Us</h2>\r\n<p>Star Model Public High School<br>\r\n123 Education Avenue<br>\r\n[City, State, ZIP]<br>\r\nEmail: <a href=\"mailto:privacy@starmodelhs.edu\">privacy@starmodelhs.edu</a><br>\r\nPhone: (555) 123-4567</p>', 'privacy-policy', 0, 1, '2026-10-10 11:13:55', '2026-10-10 11:13:55'),
(21, 0, '', 'Terms of Use', '\r\n<p><em>Last updated: [Date]</em></p>\r\n\r\n<p>Welcome to the website of Star Model Public High School. By accessing or using this website, you agree to follow these Terms of Use. If you do not agree, please do not use the site.</p>\r\n\r\n<h2>1. Purpose of the Website</h2>\r\n<p>This website provides information about Star Model Public High School and offers tools for students, parents, staff, and the public. Content is provided for general information and educational purposes.</p>\r\n\r\n<h2>2. Acceptable Use</h2>\r\n<p>When using this website, you agree not to:</p>\r\n<ul>\r\n  <li>Break any law or regulation</li>\r\n  <li>Attempt to gain unauthorized access to accounts, systems, or data</li>\r\n  <li>Upload viruses, malware, or other harmful code</li>\r\n  <li>Interfere with or disrupt the website or its servers</li>\r\n  <li>Harass, threaten, or impersonate any person</li>\r\n  <li>Post or submit false, misleading, offensive, or unlawful content</li>\r\n  <li>Use automated tools to collect data from the site without permission</li>\r\n</ul>\r\n\r\n<h2>3. User Accounts</h2>\r\n<p>Some areas, such as the Grade Portal, require login credentials. You are responsible for keeping your credentials confidential and for all activity under your account. Notify us immediately if you suspect unauthorized use.</p>\r\n\r\n<h2>4. Intellectual Property</h2>\r\n<p>All text, graphics, logos, images, and other content on this website are the property of Star Model Public High School or its licensors and are protected by copyright and other laws. You may view and print content for personal, non-commercial, and educational use. Any other use requires our written permission. See our <a href=\"/copyright-disclaimer\">Copyright &amp; Disclaimer</a> page for more information.</p>\r\n\r\n<h2>5. User Submissions</h2>\r\n<p>If you send us content, such as photos, comments, or forms, you confirm that you have the right to share it. You grant us a non-exclusive, royalty-free license to use it for school purposes. We may remove any content at our discretion.</p>\r\n\r\n<h2>6. Links to Other Websites</h2>\r\n<p>This website may link to third-party sites. We do not control or endorse those sites and are not responsible for their content or practices.</p>\r\n\r\n<h2>7. Disclaimer of Warranties</h2>\r\n<p>We work to keep the information on this site accurate and current, but we make no guarantee that it is complete, accurate, or up to date. The website is provided \"as is\" and \"as available,\" without warranties of any kind.</p>\r\n\r\n<h2>8. Limitation of Liability</h2>\r\n<p>To the fullest extent permitted by law, Star Model Public High School and its employees and officials are not liable for any damages arising from your use of, or inability to use, this website.</p>\r\n\r\n<h2>9. Termination of Access</h2>\r\n<p>We may suspend or restrict access to the website or any account at any time, without notice, if these terms are violated.</p>\r\n\r\n<h2>10. Changes to These Terms</h2>\r\n<p>We may update these terms at any time. The \"Last updated\" date shows the latest revision. Continued use of the website means you accept the updated terms.</p>\r\n\r\n<h2>11. Governing Law</h2>\r\n<p>These terms are governed by the laws of [State/Country]. Any dispute will be handled in the courts of [Jurisdiction].</p>\r\n\r\n<h2>12. Contact</h2>\r\n<p>Questions about these terms? Email <a href=\"mailto:info@starmodelhs.edu\">info@starmodelhs.edu</a> or call (555) 123-4567.</p>', 'terms-of-use', 0, 1, '2026-10-10 11:14:12', '2026-10-10 11:14:12'),
(22, 0, '', 'Cookie Policy', '\r\n<p><em>Last updated: [Date]</em></p>\r\n\r\n<p>This policy explains how Star Model Public High School uses cookies and similar technologies on this website.</p>\r\n\r\n<h2>What Are Cookies?</h2>\r\n<p>Cookies are small text files stored on your device when you visit a website. They help the site work properly, remember your preferences, and understand how visitors use the site.</p>\r\n\r\n<h2>Types of Cookies We Use</h2>\r\n<table border=\"1\" cellpadding=\"8\" cellspacing=\"0\">\r\n  <thead>\r\n    <tr><th>Type</th><th>Purpose</th><th>Can You Opt Out?</th></tr>\r\n  </thead>\r\n  <tbody>\r\n    <tr><td><strong>Essential</strong></td><td>Required for the site to function, such as secure login and page navigation</td><td>No</td></tr>\r\n    <tr><td><strong>Preferences</strong></td><td>Remember choices like language or display settings</td><td>Yes</td></tr>\r\n    <tr><td><strong>Analytics</strong></td><td>Help us understand how visitors use the site so we can improve it</td><td>Yes</td></tr>\r\n    <tr><td><strong>Third-party</strong></td><td>Set by embedded services such as maps, videos, or social media</td><td>Yes</td></tr>\r\n  </tbody>\r\n</table>\r\n\r\n<h2>Third-Party Services</h2>\r\n<p>We may use services such as [Google Analytics] and [Google Maps]. These providers may set their own cookies. Please review their policies for more information.</p>\r\n\r\n<h2>Managing Cookies</h2>\r\n<ul>\r\n  <li><strong>Cookie banner:</strong> Use our cookie banner to accept or decline non-essential cookies</li>\r\n  <li><strong>Browser settings:</strong> Most browsers let you block or delete cookies in their settings menu</li>\r\n  <li><strong>Note:</strong> Blocking essential cookies may affect how the website works</li>\r\n</ul>\r\n\r\n<h2>Changes to This Policy</h2>\r\n<p>We may update this policy from time to time. Please check this page regularly.</p>\r\n\r\n<h2>Contact Us</h2>\r\n<p>Questions about cookies? Email <a href=\"mailto:privacy@starmodelhs.edu\">privacy@starmodelhs.edu</a>. For more on how we handle your data, see our <a href=\"/privacy-policy\">Privacy Policy</a>.</p>', 'cookie-policy', 0, 1, '2026-10-10 11:14:31', '2026-10-10 11:14:31'),
(23, 0, '', 'Accessibility Statement', '\r\n<p><em>Last updated: [Date]</em></p>\r\n\r\n<h2>Our Commitment</h2>\r\n<p>Star Model Public High School is committed to making our website accessible to everyone, including students, parents, and community members with disabilities. We want every visitor to be able to find information and use our services.</p>\r\n\r\n<h2>Standards</h2>\r\n<p>We aim to meet the Web Content Accessibility Guidelines (WCAG) 2.1, Level AA. These guidelines explain how to make web content more accessible to people with visual, hearing, motor, and cognitive disabilities.</p>\r\n\r\n<h2>What We\'re Doing</h2>\r\n<ul>\r\n  <li>Using clear headings and a consistent page structure</li>\r\n  <li>Providing text descriptions (alt text) for images</li>\r\n  <li>Ensuring text has sufficient color contrast</li>\r\n  <li>Making the site usable with a keyboard</li>\r\n  <li>Testing with screen readers and other assistive technologies</li>\r\n  <li>Providing captions or transcripts for video and audio when possible</li>\r\n  <li>Training staff who publish content on accessibility best practices</li>\r\n</ul>\r\n\r\n<h2>Known Limitations</h2>\r\n<p>Despite our efforts, some content may not yet be fully accessible. This may include older PDF documents, third-party tools such as embedded calendars or maps, and some archived news items. We are working to fix these issues.</p>\r\n\r\n<h2>Need Help or an Alternative Format?</h2>\r\n<p>If you have trouble using any part of this website, or need information in a different format such as large print, audio, or a plain-text document, please contact us. We will respond within [2] business days.</p>\r\n<p><strong>Accessibility Coordinator:</strong> [Name]<br>\r\n<strong>Email:</strong> <a href=\"mailto:accessibility@starmodelhs.edu\">accessibility@starmodelhs.edu</a><br>\r\n<strong>Phone:</strong> (555) 123-4567</p>\r\n\r\n<h2>Feedback</h2>\r\n<p>We welcome your comments on the accessibility of this website. Please tell us the page address, the problem you found, and the technology you were using.</p>', 'accessibility-statement', 0, 1, '2026-10-10 11:14:50', '2026-10-10 11:14:50');
INSERT INTO `pages` (`key_pages`, `key_media_banner`, `banner_image_url`, `title`, `page_content`, `url`, `sort`, `is_active`, `entry_date_time`, `update_date_time`) VALUES
(24, 0, '', 'Acceptable Use Policy', '\r\n<p><em>Last updated: [Date]</em></p>\r\n\r\n<p>Star Model Public High School provides computers, networks, internet access, and online accounts to support learning. This policy explains the rules for using school technology. It applies to all students, staff, and guests using school devices, networks, or accounts, on or off campus.</p>\r\n\r\n<h2>Purpose</h2>\r\n<p>School technology exists for educational purposes. Using it is a privilege, not a right, and comes with responsibility.</p>\r\n\r\n<h2>Students Agree To</h2>\r\n<ul>\r\n  <li>Use school technology only for schoolwork and approved activities</li>\r\n  <li>Keep passwords private and never use another person\'s account</li>\r\n  <li>Treat others with respect online, including in emails, messages, and posts</li>\r\n  <li>Give credit for sources and follow the school\'s academic integrity rules, including when using AI tools</li>\r\n  <li>Report cyberbullying, inappropriate content, or security problems to a teacher or the help desk</li>\r\n  <li>Take good care of school devices and report any damage or loss right away</li>\r\n</ul>\r\n\r\n<h2>Students Agree Not To</h2>\r\n<ul>\r\n  <li>Visit, download, or share inappropriate, violent, or illegal content</li>\r\n  <li>Bully, harass, threaten, or impersonate anyone</li>\r\n  <li>Try to bypass filters, security settings, or network restrictions</li>\r\n  <li>Install unauthorized software or change device settings</li>\r\n  <li>Access, change, or delete other people\'s files or accounts</li>\r\n  <li>Share personal information about themselves or others without permission</li>\r\n  <li>Use school technology for commercial purposes, gambling, or illegal activity</li>\r\n  <li>Record, photograph, or share images of others without their consent</li>\r\n</ul>\r\n\r\n<h2>Monitoring and Privacy</h2>\r\n<p>School networks, devices, and accounts may be monitored and filtered to keep students safe and enforce this policy. Users should not expect privacy when using school technology.</p>\r\n\r\n<h2>Personal Devices</h2>\r\n<p>Personal phones, tablets, and laptops must follow the same rules when connected to the school network and may only be used in class with teacher permission.</p>\r\n\r\n<h2>Consequences</h2>\r\n<p>Breaking this policy may lead to loss of access, disciplinary action under the <a href=\"/student-handbook\">Student Handbook</a>, financial responsibility for damage, and, where laws are broken, referral to the authorities.</p>\r\n\r\n<h2>Disclaimer</h2>\r\n<p>The school takes reasonable steps to filter harmful content but cannot guarantee that students will never see inappropriate material. The school is not responsible for the accuracy of information found online or for losses caused by service interruptions.</p>\r\n\r\n<h2>Agreement</h2>\r\n<p>Students and parents or guardians are asked to read and acknowledge this policy each school year. Questions? Contact the <a href=\"/page/technology-help-desk\">Technology Help Desk</a>.</p>', 'acceptable-use-policy', 0, 1, '2026-10-10 11:18:28', '2026-10-10 11:19:15'),
(25, 0, '', 'Non-Discrimination Statement', '\r\n\r\n<h2>Our Commitment to Equal Opportunity</h2>\r\n<p>Star Model Public High School does not discriminate on the basis of race, color, national origin, ethnicity, religion, sex, gender identity, sexual orientation, age, disability, marital or parental status, or any other characteristic protected by law, in its programs, activities, admissions, or employment practices.</p>\r\n\r\n<p>This applies to academics, athletics, extracurricular activities, school facilities, and employment decisions.</p>\r\n\r\n<h2>Harassment</h2>\r\n<p>Harassment of any kind, including sexual harassment, is prohibited. The school will respond promptly to complaints and will protect those who report concerns from retaliation.</p>\r\n\r\n<h2>Accommodations</h2>\r\n<p>The school provides reasonable accommodations for students and staff with disabilities. To request an accommodation or to ask about accessible facilities, please contact the school office.</p>\r\n\r\n<h2>How to File a Complaint</h2>\r\n<p>Anyone who believes they have experienced discrimination or harassment may report it to the school\'s Compliance Officer:</p>\r\n<p><strong>[Name], Compliance Officer</strong><br>\r\nStar Model Public High School<br>\r\n123 Education Avenue, [City, State, ZIP]<br>\r\nEmail: <a href=\"mailto:compliance@starmodelhs.edu\">compliance@starmodelhs.edu</a><br>\r\nPhone: (555) 123-4567</p>\r\n\r\n<p>Complaints will be reviewed promptly, fairly, and as confidentially as possible. You may also contact [relevant government education or civil rights agency] if you wish to file a complaint outside the school.</p>\r\n\r\n<h2>Language Access</h2>\r\n<p>We will provide translation or interpretation to help families who need language support to take part in school programs. Please contact the main office.</p>', 'non-discrimination-statement', 0, 1, '2026-10-10 11:19:49', '2026-10-10 11:19:49'),
(26, 0, '', 'Student Data Privacy', '\r\n<p><em>Last updated: [Date]</em></p>\r\n\r\n<p>Protecting student information is one of our most important responsibilities. This page explains how Star Model Public High School collects, uses, and safeguards student records and data.</p>\r\n\r\n<h2>What Student Information We Keep</h2>\r\n<ul>\r\n  <li>Enrollment and contact information</li>\r\n  <li>Attendance, grades, and transcripts</li>\r\n  <li>Health and immunization records</li>\r\n  <li>Special education and support services records</li>\r\n  <li>Discipline and counseling records</li>\r\n  <li>Information in school-issued online accounts and learning platforms</li>\r\n</ul>\r\n\r\n<h2>Who Can See Student Records</h2>\r\n<p>Access to student records is limited to parents or guardians, eligible students, and school officials with a legitimate educational reason. We do not release identifiable student information to others without written consent, except where the law allows or requires it, such as to a school the student is transferring to, in a health or safety emergency, or in response to a lawful court order.</p>\r\n\r\n<h2>Parent and Student Rights</h2>\r\n<p>Under applicable laws such as the Family Educational Rights and Privacy Act (FERPA), parents and eligible students (generally age 18 or older) have the right to:</p>\r\n<ul>\r\n  <li>Inspect and review the student\'s education records</li>\r\n  <li>Request corrections to records that are inaccurate or misleading</li>\r\n  <li>Consent to the release of personally identifiable information, with certain exceptions</li>\r\n  <li>File a complaint with the appropriate government education agency</li>\r\n</ul>\r\n\r\n<h2>Directory Information</h2>\r\n<p>The school may share limited \"directory information,\" such as a student\'s name, grade level, and participation in activities, in publications like yearbooks, programs, and the school website. Parents may opt out of directory information sharing by submitting a written request to the main office within [30] days of enrollment.</p>\r\n\r\n<h2>Photos and Media</h2>\r\n<p>We may take photos or videos of students at school events for use in school publications, social media, and this website. Parents who do not want their child\'s image used may submit a Media Opt-Out Form to the main office. We do not publish student photos alongside full names without consent.</p>\r\n\r\n<h2>Online Learning Tools</h2>\r\n<p>Before using any educational app or online service that handles student data, the school reviews its privacy practices. We require providers to keep student data secure, use it only for educational purposes, and never sell it or use it for advertising.</p>\r\n\r\n<h2>How We Protect Data</h2>\r\n<ul>\r\n  <li>Password-protected accounts and secure systems</li>\r\n  <li>Limited access based on staff roles</li>\r\n  <li>Staff training on privacy and data security</li>\r\n  <li>Prompt response to any suspected data breach, including notifying affected families as required by law</li>\r\n</ul>\r\n\r\n<h2>Contact Us</h2>\r\n<p>To review a student\'s records, submit an opt-out, or ask a privacy question, contact the Records Office:</p>\r\n<p>Email: <a href=\"mailto:records@starmodelhs.edu\">records@starmodelhs.edu</a><br>\r\nPhone: (555) 123-4567</p>\r\n<p>See also our <a href=\"/page/privacy-policy\">Privacy Policy</a>.</p>', 'student-data-privacy', 0, 1, '2026-10-10 11:20:17', '2026-10-10 11:40:31'),
(27, 0, '', 'Copyright & Disclaimer', '\r\n<p><em>Last updated: [Date]</em></p>\r\n\r\n<h2>Copyright Notice</h2>\r\n<p>&copy; [Year] Star Model Public High School. All rights reserved.</p>\r\n<p>The content of this website, including text, logos, graphics, photographs, and layout, is owned by Star Model Public High School or used with permission, and is protected by copyright and other intellectual property laws.</p>\r\n\r\n<h2>Permitted Use</h2>\r\n<p>You may view, download, and print pages for personal, non-commercial, and educational purposes, provided you keep all copyright notices intact. You may not copy, modify, distribute, sell, or republish any content without our written permission.</p>\r\n\r\n<h2>Trademarks</h2>\r\n<p>\"Star Model Public High School,\" the school logo, and the \"Go Stars\" name and mascot are trademarks of the school. They may not be used without prior written consent.</p>\r\n\r\n<h2>Third-Party Content</h2>\r\n<p>Some images, videos, and materials on this site belong to third parties and are used with permission or under license. Their owners retain all rights.</p>\r\n\r\n<h2>Copyright Complaints</h2>\r\n<p>If you believe content on this site infringes your copyright, please send us the following information:</p>\r\n<ul>\r\n  <li>A description of the work you believe was copied</li>\r\n  <li>The web address of the material on our site</li>\r\n  <li>Your name, address, phone number, and email</li>\r\n  <li>A statement that you have a good-faith belief the use is unauthorized</li>\r\n  <li>A statement that the information is accurate and that you are the owner or authorized to act for the owner</li>\r\n</ul>\r\n<p>Send complaints to <a href=\"mailto:info@starmodelhs.edu\">info@starmodelhs.edu</a>.</p>\r\n\r\n<h2>General Disclaimer</h2>\r\n<p>The information on this website is provided for general informational purposes only. While we try to keep it accurate and current, Star Model Public High School makes no warranties about its completeness or reliability. Dates, schedules, fees, and policies may change without notice. Please contact the school office to confirm important details.</p>\r\n\r\n<h2>External Links</h2>\r\n<p>Links to other websites are provided for convenience. Their inclusion does not mean we endorse them, and we are not responsible for their content or privacy practices.</p>\r\n\r\n<p>See also our <a href=\"/page/terms-of-use\">Terms of Use</a> and <a href=\"/page/privacy-policy\">Privacy Policy</a>.</p>', 'copyright-and-disclaimer', 0, 1, '2026-10-10 11:20:41', '2026-10-10 11:41:04'),
(28, 0, '', 'Page Not Found', '\r\n<h2>Oops! This page seems to have skipped class.</h2>\r\n\r\n<p>The page you\'re looking for doesn\'t exist, may have moved, or the web address may have been typed incorrectly. Don\'t worry, we\'ll help you find your way.</p>\r\n\r\n<h2>Try One of These</h2>\r\n<ul>\r\n  <li><a href=\"/\">Return to the Home page</a></li>\r\n  <li><a href=\"/page/admissions\">Admissions</a>: apply or schedule a tour</li>\r\n  <li><a href=\"/page/academics\">Academics</a>: courses and programs</li>\r\n  <li><a href=\"/page/news-and-events\">News &amp; Events</a>: what\'s happening on campus</li>\r\n  <li><a href=\"/page/parents-and-students-portal\">Parents &amp; Students Portal</a>: grades, menus, and forms</li>\r\n  <li><a href=\"/page/contact-us\">Contact Us</a>: we\'re happy to help</li>\r\n</ul>\r\n\r\n<h2>Still Can\'t Find It?</h2>\r\n<p>Use the search box at the top of the page, or contact the main office at <a href=\"mailto:info@starmodelhs.edu\">info@starmodelhs.edu</a> or (555) 123-4567. If you followed a link on our site that led here, please let us know so we can fix it.</p>\r\n\r\n<p><a href=\"/\"><strong>Back to Home</strong></a></p>', 'page-not-found-404', 0, 1, '2026-10-10 11:21:14', '2026-10-10 11:42:19');

-- --------------------------------------------------------

--
-- Table structure for table `photo_categories`
--

DROP TABLE IF EXISTS `photo_categories`;
CREATE TABLE IF NOT EXISTS `photo_categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_photo_gallery` int(10) UNSIGNED NOT NULL,
  `key_categories` int(10) UNSIGNED NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_pair` (`key_photo_gallery`,`key_categories`),
  KEY `key_categories` (`key_categories`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photo_gallery`
--

DROP TABLE IF EXISTS `photo_gallery`;
CREATE TABLE IF NOT EXISTS `photo_gallery` (
  `key_photo_gallery` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_media_banner` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_url` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `is_active` tinyint(1) DEFAULT '1',
  `entry_date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `available_for_blocks` tinyint(1) DEFAULT '0',
  `css` varchar(500) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `slideshow_enabled` tinyint(1) NOT NULL DEFAULT '1',
  `navigation_type` enum('arrows','slideshow','both','none') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'slideshow',
  PRIMARY KEY (`key_photo_gallery`),
  KEY `fk_photo_gallery_media` (`key_media_banner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `photo_gallery_images`
--

DROP TABLE IF EXISTS `photo_gallery_images`;
CREATE TABLE IF NOT EXISTS `photo_gallery_images` (
  `key_image` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_media_banner` int(10) UNSIGNED DEFAULT NULL,
  `key_photo_gallery` int(10) UNSIGNED NOT NULL,
  `entry_date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `image_mobile_url` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `opacity` float DEFAULT '1',
  `action_button` tinyint(1) DEFAULT '0',
  `action_button_text` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `action_button_link_url` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `animation_type` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'fade',
  `text_position` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'center',
  `text_color` varchar(20) COLLATE utf8_unicode_ci DEFAULT '#ffffff',
  `image_wrapper_class` varchar(100) COLLATE utf8_unicode_ci DEFAULT '',
  `visibility_start` datetime DEFAULT NULL,
  `visibility_end` datetime DEFAULT NULL,
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`key_image`),
  KEY `key_photo_gallery` (`key_photo_gallery`),
  KEY `fk_photo_gallery_images_media` (`key_media_banner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `products`
--

DROP TABLE IF EXISTS `products`;
CREATE TABLE IF NOT EXISTS `products` (
  `key_product` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `product_type` enum('book','stationery','digital','other') COLLATE utf8_unicode_ci NOT NULL,
  `key_books` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `price` decimal(10,2) DEFAULT NULL,
  `stock_quantity` int(11) DEFAULT NULL,
  `discount_percent` tinyint(4) DEFAULT NULL,
  `sku` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `is_active` tinyint(1) DEFAULT '1',
  `sort` smallint(6) DEFAULT NULL,
  `entry_date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`key_product`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_categories`
--

DROP TABLE IF EXISTS `product_categories`;
CREATE TABLE IF NOT EXISTS `product_categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_product` int(10) UNSIGNED NOT NULL,
  `key_categories` int(10) UNSIGNED NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_images`
--

DROP TABLE IF EXISTS `product_images`;
CREATE TABLE IF NOT EXISTS `product_images` (
  `key_image` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_media_banner` int(10) UNSIGNED DEFAULT NULL,
  `key_product` int(10) UNSIGNED NOT NULL,
  `sort_order` smallint(5) UNSIGNED DEFAULT '0',
  `entry_date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_image`),
  KEY `key_product` (`key_product`),
  KEY `fk_product_images_media` (`key_media_banner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_orders`
--

DROP TABLE IF EXISTS `product_orders`;
CREATE TABLE IF NOT EXISTS `product_orders` (
  `key_order` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_number` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_date` datetime DEFAULT CURRENT_TIMESTAMP,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `is_active` tinyint(1) DEFAULT '1',
  PRIMARY KEY (`key_order`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_order_items`
--

DROP TABLE IF EXISTS `product_order_items`;
CREATE TABLE IF NOT EXISTS `product_order_items` (
  `key_item` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_order` int(10) UNSIGNED DEFAULT NULL,
  `key_product` int(10) UNSIGNED DEFAULT NULL,
  `quantity` int(11) DEFAULT NULL,
  `unit_price` decimal(10,2) DEFAULT NULL,
  PRIMARY KEY (`key_item`),
  KEY `key_order` (`key_order`),
  KEY `key_product` (`key_product`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `product_prices_history`
--

DROP TABLE IF EXISTS `product_prices_history`;
CREATE TABLE IF NOT EXISTS `product_prices_history` (
  `key_price` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_product` int(10) UNSIGNED NOT NULL,
  `old_price` decimal(10,2) DEFAULT NULL,
  `new_price` decimal(10,2) DEFAULT NULL,
  `change_date` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_price`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `key_settings` int(10) NOT NULL DEFAULT '0',
  `template_folder` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `home_page_type` varchar(20) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'articles',
  `home_page_html` text COLLATE utf8_unicode_ci NOT NULL,
  `custom_css` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`key_settings`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`key_settings`, `template_folder`, `home_page_type`, `home_page_html`, `custom_css`) VALUES
(1, 'default', 'articles', '<html>\r\n<head><title>Hello World</title></head>\r\n<body>\r\n<h1>Hello World!</h1>\r\n<h2>This is CopilotCMS.</h2>\r\n</body>\r\n</html>', 'body {\r\n\r\n}\r\n');

-- --------------------------------------------------------

--
-- Table structure for table `settings_key_value`
--

DROP TABLE IF EXISTS `settings_key_value`;
CREATE TABLE IF NOT EXISTS `settings_key_value` (
  `key_settings` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `setting_value` text COLLATE utf8_unicode_ci NOT NULL,
  `setting_group` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'general',
  `entry_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_settings`)
) ENGINE=InnoDB AUTO_INCREMENT=104 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings_key_value`
--

INSERT INTO `settings_key_value` (`key_settings`, `setting_key`, `setting_value`, `setting_group`, `entry_date_time`) VALUES
(1, 'site_name', 'Copilot CMS', 'general', '2025-10-06 23:07:08'),
(2, 'site_slogan', 'Clarity. Collaboration. Control.', 'general', '2025-10-06 23:07:08'),
(3, 'base_url', '/', 'general', '2025-10-06 23:18:10'),
(4, 'powered_by', 'Powered by Copilot', 'general', '2025-10-06 23:07:08'),
(11, 'article_show_author', '1', 'article_view', '2025-10-06 23:07:08'),
(12, 'article_show_categories', '1', 'article_view', '2025-10-06 23:07:08'),
(13, 'article_show_related_books', '1', 'article_view', '2025-10-06 23:07:08'),
(14, 'article_snippet_length', '300', 'article_view', '2025-10-06 23:07:08'),
(15, 'article_banner_height', '400px', 'article_view', '2025-10-06 23:07:08'),
(22, 'gallery_items_per_page', '12', 'gallery', '2025-10-06 23:07:08'),
(24, 'template_default_color', '#0055aa', 'css_colors', '2025-10-10 18:01:14'),
(27, 'default_404_message', 'Page not found.', 'php_template', '2025-10-06 23:07:08'),
(38, 'template_default_logo', '/media/images/2026/1791618157_star-model-high-school-logo-low-res.jpg', 'general', '2025-10-15 04:56:36'),
(40, 'max_upload_image_width', '1200', 'media_library', '2025-10-15 22:12:04'),
(41, 'max_upload_image_height', '600', 'media_library', '2025-10-15 22:12:09'),
(42, 'template_text_color', 'black', 'css_colors', '2025-10-20 21:23:28'),
(43, 'template_background_color', '#FFF', 'css_colors', '2025-10-20 21:27:30'),
(45, 'items_brand_color', 'maroon', 'css_colors', '2025-10-20 21:28:26'),
(46, 'sidebar_background_color', '#F6F6F6', 'css_colors', '2025-10-20 23:27:22'),
(47, 'site_direction', 'ltr', 'css_template', '2025-10-22 07:37:19'),
(48, 'google_fonts', 'Noto Kufi Arabic', 'css_fonts', '2025-10-27 21:33:32'),
(49, 'snippets_per_page', '10', 'php_template', '2025-10-30 09:49:38'),
(50, 'snippet_words', '80', 'php_template', '2025-10-30 11:14:33'),
(51, 'module_total_records', '7', 'php_template', '2025-11-06 19:49:34'),
(52, 'pager_next_label', 'Next', 'template_labels', '2025-11-06 19:52:48'),
(53, 'pager_prev_label', 'Prev', 'template_labels', '2025-11-06 19:53:02'),
(54, 'readmore_label', 'Read more', 'template_labels', '2025-11-06 19:54:21'),
(55, 'module_more_label', 'More', 'template_labels', '2025-11-07 16:38:31'),
(57, 'main_menu_font', 'Arial', 'css_fonts', '2025-11-07 18:40:16'),
(58, 'breadcrumb_font', 'Arial', 'css_fonts', '2025-11-07 18:54:58'),
(59, 'block_heading_font', 'Arial', 'css_fonts', '2025-11-07 20:10:46'),
(60, 'pager_font', 'Arial', 'css_fonts', '2025-11-07 20:15:54'),
(61, 'footer_font', 'Arial', 'css_fonts', '2025-11-07 21:16:04'),
(62, 'template_font_size', '15px', 'css_fonts', '2025-11-08 17:44:20'),
(64, 'content_banner_height', '20vh', 'css_template', '2025-11-14 22:02:08'),
(65, 'articles_label', 'Articles', 'template_labels', '2025-11-16 16:37:06'),
(66, 'content_types_label', 'Content Types', 'template_labels', '2025-11-16 16:37:26'),
(67, 'categories_label', 'Categories', 'template_labels', '2025-11-16 16:37:50'),
(68, 'tags_label', 'Tags', 'template_labels', '2025-11-16 16:37:58'),
(69, 'books_label', 'Books', 'template_labels', '2025-11-16 16:38:14'),
(70, 'pages_label', 'Info', 'template_labels', '2025-11-16 16:38:37'),
(71, 'authors_label', 'Authors', 'template_labels', '2025-11-16 16:38:49'),
(72, 'youtube_gallery_label', 'Youtube Gallery', 'template_labels', '2025-11-16 16:39:19'),
(73, 'photo_gallery_label', 'Photo Gallery', 'template_labels', '2025-11-16 16:39:35'),
(74, 'search_label', 'Search', 'template_labels', '2025-11-16 16:40:10'),
(75, 'cache_duration_hours', '2', 'cache', '2025-12-07 18:36:21'),
(76, 'cache_enabled', 'no', 'cache', '2025-12-07 18:36:52'),
(77, 'css_version', '73', 'css_template', '2025-12-09 23:46:37'),
(78, 'article_authors_label', 'Article content', 'template_labels', '2025-12-13 12:54:06'),
(79, 'article_categories_label', 'Categories', 'template_labels', '2025-12-13 12:57:00'),
(80, 'article_content_types_label', 'Article Series', 'template_labels', '2025-12-13 12:57:20'),
(81, 'article_tags_label', 'Tags', 'template_labels', '2025-12-13 12:57:46'),
(82, 'show_article_created_updated', 'yes', 'php_template', '2025-12-20 18:41:46'),
(83, 'site_locale', 'en_US', 'php_template', '2025-12-20 19:06:46'),
(87, 'template_font_rtl', 'Noto Kufi Arabic', 'css_fonts', '2026-01-16 04:42:13'),
(88, 'template_font_ltr', 'calibri', 'css_fonts', '2026-01-16 04:42:37'),
(89, 'template_font_family', 'calibri', 'css_fonts', '2026-01-16 04:45:50'),
(90, 'template_font_rtl_line_height', '1.5', 'css_fonts', '2026-01-22 22:46:07'),
(91, 'template_font_ltr_line_height', '1.5', 'css_fonts', '2026-01-22 22:46:20'),
(92, 'template_font_rtl_size', '1em', 'css_fonts', '2026-01-22 22:46:39'),
(93, 'template_font_ltr_size', '1em', 'css_fonts', '2026-01-22 22:46:59'),
(95, 'article_workers_label', 'Banner image', 'template_labels', '2026-09-11 16:18:06'),
(96, 'articles_by_author_label', 'Author:', 'template_labels', '2026-09-18 05:52:26'),
(97, 'articles_by_worker_label', 'Worker:', 'template_labels', '2026-09-18 05:53:00'),
(98, 'search_results_per_page', '15', 'search', '2026-09-20 08:19:42'),
(99, 'main_max_width', '1400px', 'css_template', '2026-10-01 20:09:12'),
(100, 'body_max_width', '100vw', 'css_template', '2026-10-01 20:09:23'),
(101, 'contact_form_receive_email', 'info@mysite.com', 'general', '2026-10-05 18:43:36'),
(102, 'header_max_width', '1400px', 'css_template', '2026-10-06 13:42:31'),
(103, 'nav_max_width', '100vw', 'css_template', '2026-10-06 13:42:41');

-- --------------------------------------------------------

--
-- Table structure for table `tags`
--

DROP TABLE IF EXISTS `tags`;
CREATE TABLE IF NOT EXISTS `tags` (
  `key_tags` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_media_banner` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `banner_image_url` varchar(2000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) DEFAULT '1',
  `entry_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_tags`)
) ENGINE=InnoDB AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`key_tags`, `key_media_banner`, `name`, `description`, `url`, `banner_image_url`, `sort`, `is_active`, `entry_date_time`) VALUES
(1, 0, 'Tag 1', '', 'tag-1', '', 0, 1, '2026-09-20 15:31:59'),
(2, 0, 'Tag 2', '', 'tag-2', '', 0, 1, '2026-09-20 15:32:03'),
(3, 0, 'Tag 3', '', 'tag-3', '', 0, 1, '2026-09-20 15:32:09');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `key_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_media_banner` int(10) UNSIGNED NOT NULL,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` enum('admin','editor','viewer') COLLATE utf8_unicode_ci DEFAULT 'viewer',
  `is_active` tinyint(1) DEFAULT '1',
  `entry_date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` datetime DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `city` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `banner_image_url` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`key_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`key_user`, `key_media_banner`, `name`, `username`, `password_hash`, `email`, `role`, `is_active`, `entry_date_time`, `update_date_time`, `phone`, `address`, `city`, `state`, `country`, `description`, `url`, `banner_image_url`) VALUES
(1, 0, 'Copilot CMS', 'admin', '$2y$10$NHIqSMqCvTKHb3iDWIA4je/hMEfCWCENb9Pjmm/tckm6gvYAIM0ry', 'admin123@example.com', 'admin', 1, '2025-09-30 23:41:42', '2026-09-01 11:44:19', '', '123 Lions Garden, Old Town', '', '', 'Pakistan', '', 'admin-copilot', '');

-- --------------------------------------------------------

--
-- Table structure for table `workers`
--

DROP TABLE IF EXISTS `workers`;
CREATE TABLE IF NOT EXISTS `workers` (
  `key_workers` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `email` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `phone` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `website` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `social_url_media1` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `social_url_media2` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `social_url_media3` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `city` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `state` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `country` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `banner_image_url` varchar(2000) COLLATE utf8_unicode_ci DEFAULT '',
  `key_media_banner` int(10) UNSIGNED DEFAULT NULL,
  `description` varchar(2000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `is_active` tinyint(1) DEFAULT '1',
  `entry_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`key_workers`) USING BTREE,
  KEY `fk_workers_media` (`key_media_banner`) USING BTREE
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `youtube_categories`
--

DROP TABLE IF EXISTS `youtube_categories`;
CREATE TABLE IF NOT EXISTS `youtube_categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_youtube_gallery` int(10) UNSIGNED NOT NULL,
  `key_categories` int(10) UNSIGNED NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_pair` (`key_youtube_gallery`,`key_categories`),
  KEY `key_categories` (`key_categories`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `youtube_gallery`
--

DROP TABLE IF EXISTS `youtube_gallery`;
CREATE TABLE IF NOT EXISTS `youtube_gallery` (
  `key_youtube_gallery` int(11) NOT NULL AUTO_INCREMENT,
  `key_media_banner` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `youtube_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail_url` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `is_active` tinyint(1) DEFAULT '1',
  `entry_date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`key_youtube_gallery`),
  KEY `fk_youtube_gallery_media` (`key_media_banner`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles` ADD FULLTEXT KEY `title` (`title`,`title_sub`,`article_snippet`,`article_content`);

--
-- Indexes for table `authors`
--
ALTER TABLE `authors` ADD FULLTEXT KEY `name` (`name`,`description`,`city`,`country`,`state`);
ALTER TABLE `authors` ADD FULLTEXT KEY `name_2` (`name`,`city`,`country`,`description`);

--
-- Indexes for table `books`
--
ALTER TABLE `books` ADD FULLTEXT KEY `title` (`title`,`subtitle`,`publisher`,`description`,`author_name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories` ADD FULLTEXT KEY `name` (`name`,`description`);

--
-- Indexes for table `media_library`
--
ALTER TABLE `media_library` ADD FULLTEXT KEY `alt_text` (`alt_text`,`tags`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages` ADD FULLTEXT KEY `title` (`title`,`page_content`);

--
-- Indexes for table `photo_gallery`
--
ALTER TABLE `photo_gallery` ADD FULLTEXT KEY `title` (`title`,`description`);

--
-- Indexes for table `products`
--
ALTER TABLE `products` ADD FULLTEXT KEY `title` (`title`,`description`);

--
-- Indexes for table `settings_key_value`
--
ALTER TABLE `settings_key_value` ADD FULLTEXT KEY `setting_key` (`setting_key`,`setting_value`);

--
-- Indexes for table `workers`
--
ALTER TABLE `workers` ADD FULLTEXT KEY `name` (`name`,`description`,`city`,`country`,`state`);
ALTER TABLE `workers` ADD FULLTEXT KEY `name_2` (`name`,`city`,`country`,`description`);

--
-- Indexes for table `youtube_gallery`
--
ALTER TABLE `youtube_gallery` ADD FULLTEXT KEY `title` (`title`,`description`);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `photo_gallery_images`
--
ALTER TABLE `photo_gallery_images`
  ADD CONSTRAINT `fk_gallery_image` FOREIGN KEY (`key_photo_gallery`) REFERENCES `photo_gallery` (`key_photo_gallery`) ON DELETE CASCADE;
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
