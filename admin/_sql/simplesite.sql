-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Oct 13, 2025 at 07:36 AM
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
-- Database: `simplesite`
--

-- --------------------------------------------------------

--
-- Table structure for table `articles`
--

DROP TABLE IF EXISTS `articles`;
CREATE TABLE IF NOT EXISTS `articles` (
  `key_articles` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(300) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `title_sub` varchar(300) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `article_snippet` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `article_content` mediumtext COLLATE utf8_unicode_ci NOT NULL,
  `content_type` varchar(10) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'article',
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `banner_image_url` varchar(2000) COLLATE utf8_unicode_ci DEFAULT '',
  `key_media_banner` int(10) UNSIGNED DEFAULT '0',
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `status` enum('draft','on','off') COLLATE utf8_unicode_ci DEFAULT 'draft',
  `entry_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`key_articles`),
  KEY `fk_articles_media` (`key_media_banner`),
  KEY `entry_date_time` (`entry_date_time`),
  KEY `update_date_time` (`update_date_time`)
) ENGINE=MyISAM AUTO_INCREMENT=39 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`key_articles`, `title`, `title_sub`, `article_snippet`, `article_content`, `content_type`, `url`, `banner_image_url`, `key_media_banner`, `sort`, `status`, `entry_date_time`, `update_date_time`, `created_by`, `updated_by`) VALUES
(2, 'The Rise of Minimal CMS', 'Streamlined Editorial Tools', 'Exploring how minimal CMS platforms empower editorial teams.', 'Full content of article 1...', 'article', 'minimal-cms', NULL, 28, 1, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08', 1, 1),
(3, 'Designing for Editors', 'UI That Works', 'Why editorial-first design matters in publishing workflows.', 'Full content of article 2 3 4', 'article', 'editorial-ui', NULL, 25, 2, 'on', '2025-09-25 15:13:08', '2025-09-27 12:05:22', NULL, 1),
(4, 'PHP Without Frameworks', 'Native Power', 'Building robust apps with native PHP and no frameworks.', 'Full content of article 3...', 'article', 'php-native', NULL, 11, 3, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08', NULL, 1),
(5, 'Modular CRUD Systems', 'Scalable Architecture', 'How modular CRUD design improves maintainability.', 'Full content of article 4...', 'article', 'modular-crud', NULL, 5, 4, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08', NULL, 1),
(6, 'Debounce in Search', 'Performance Boosts', 'Using debounce to optimize search-triggered loading.', 'Full content of article 5...', 'article', 'debounce-search', NULL, 37, 5, 'on', '2025-09-25 15:13:08', '2025-09-30 13:34:45', NULL, 1),
(7, 'Pagination Patterns', 'Smart Loading', 'Best practices for implementing pagination in CMS.', 'Full content of article 6...', 'article', 'pagination-patterns', NULL, 6, 6, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08', NULL, 1),
(8, 'Editorial Workflows', 'From Draft to Publish', 'Mapping out efficient editorial workflows.', 'Full content of article 7...', 'article', 'editorial-workflows', NULL, 34, 7, 'on', '2025-09-25 15:13:08', '2025-09-29 22:11:15', NULL, 1),
(9, 'Category Management', 'Organized Content', 'Tips for managing categories in publishing systems.', 'Full content of article 8...', 'article', 'category-management', NULL, 30, 8, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08', NULL, 1),
(10, 'Modal-Based Editing', 'Inline Efficiency', 'Using modals for quick article edits.', 'Full content of article 9...', 'article', 'modal-editing', NULL, 39, 9, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08', NULL, 1),
(11, 'Search Optimization', 'Fast & Relevant', 'Improving search relevance and speed.', 'Full content of article 10...', 'article', 'search-optimization', 'banner10.jpg', 0, 10, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08', NULL, NULL),
(12, 'Legacy CMS Refactor', 'Modernizing Systems', 'Strategies for refactoring legacy CMS platforms.', 'Full content of article 11...', 'article', 'legacy-refactor', 'banner11.jpg', 0, 11, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08', NULL, NULL),
(13, 'Content Snippets', 'Reusable Blocks', 'Creating reusable content snippets.', 'Full content of article 12...', 'article', 'content-snippets', 'banner12.jpg', 0, 12, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08', NULL, NULL),
(14, 'Desktop-Only UI', 'Focused Design', 'Why desktop-first UI still matters.', 'Full content of article 13...', 'article', 'desktop-ui', 'banner13.jpg', 0, 13, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08', NULL, NULL),
(15, 'Error Reporting in PHP', 'Debugging Smartly', 'Enabling error reporting for better debugging.', 'Full content of article 14...', 'article', 'php-errors', 'banner14.jpg', 0, 14, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08', NULL, NULL),
(16, 'SQL Troubleshooting', 'Root Cause Isolation', 'Finding and fixing SQL issues.', 'Full content of article 15...', 'article', 'sql-troubleshooting', 'banner15.jpg', 0, 15, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08', NULL, NULL),
(17, 'Advanced Filters', 'Precision Tools', 'Adding advanced filters to editorial tools.', 'Full content of article 16...', 'article', 'advanced-filters', 'banner16.jpg', 0, 16, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08', NULL, NULL),
(18, 'Scalable CMS Design', 'Future-Proofing', 'Designing CMS for long-term scalability.', 'Full content of article 17...', 'article', 'scalable-cms', 'banner17.jpg', 0, 17, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08', NULL, NULL),
(19, 'Collaborative Development', 'Step-by-Step Builds', 'Working with feedback-driven development.', 'Full content of article 18...', 'article', 'collab-dev', 'banner18.jpg', 0, 18, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08', NULL, NULL),
(20, 'Clean Code Practices', 'Maintainable Systems', 'Writing clean, maintainable PHP.', 'Full content of article 19...', 'article', 'clean-code', 'banner19.jpg', 0, 19, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08', NULL, NULL),
(21, 'UI Feedback Loops', 'Iterative Design', 'Using feedback to refine UI.', 'Full content of article 20...', 'article', 'ui-feedback', 'banner20.jpg', 0, 20, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08', NULL, NULL),
(22, 'CMS Testing Strategies', 'Catch the Bugs', 'Testing CMS workflows effectively.', 'Full content of article 21...', 'article', 'cms-testing', 'banner21.jpg', 0, 21, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08', NULL, NULL),
(23, 'Content Assignment UX', 'Frictionless Flow', 'Improving article assignment UX.', 'Full content of article 22...', 'article', 'assignment-ux', 'banner22.jpg', 0, 22, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08', NULL, NULL),
(24, 'Banner Image Tips', 'Visual Impact', 'Choosing effective banner images.', 'Full content of article 23...', 'article', 'banner-tips', 'banner23.jpg', 0, 23, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08', NULL, NULL),
(25, 'URL Structuring', 'SEO & Clarity', 'Structuring article URLs for clarity and SEO.', 'Full content of article 24...', 'article', 'url-structure', 'banner24.jpg', 0, 24, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08', NULL, NULL),
(26, 'CMS Entry Points', 'Where It Begins', 'Designing intuitive entry points for editors.', 'Full content of article 25...', 'article', 'cms-entry', 'banner25.jpg', 0, 25, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08', NULL, NULL),
(36, 'True strength begins with self-awareness and the emotional connection', '', 'We live in a world where stress, anxiety and depression are becoming increasingly common. ', 'We live in a world where stress, anxiety and depression are becoming increasingly common.  We live in a world where stress, anxiety and depression are becoming increasingly common.  We live in a world where stress, anxiety and depression are becoming increasingly common. ', 'article', 'true-strength-begins-with-self-awareness-and-emotional-connection', '', 0, 0, 'on', '2025-10-05 05:30:29', '2025-10-05 05:30:29', 1, 1),
(38, 'PHP+MySQL Combination', 'How it Works', 'The PHP+MySQL combination is a classic and robust stack for building dynamic, data-driven web applications. It consists of two powerful, open-source technologies that work together to create interactive websites, from simple blogs to complex e-commerce platforms. \r\n', 'The PHP+MySQL combination is a classic and robust stack for building dynamic, data-driven web applications. It consists of two powerful, open-source technologies that work together to create interactive websites, from simple blogs to complex e-commerce platforms.\r\n\r\n\r\n<h1>What is the PHP + MySQL Combination?</h1>\r\n\r\n<p>\r\nThe PHP + MySQL combination is a classic and robust stack for building dynamic, data-driven web applications. It consists of two powerful, open-source technologies that work together to create interactive websites, from simple blogs to complex e-commerce platforms.\r\n</p>\r\n\r\n<h2>How the Combination Works</h2>\r\n<p>\r\nThe interaction between PHP and MySQL is a server-side process, meaning most of the work happens on the web server before the user sees the final page.\r\n</p>\r\n\r\n<div class=\"flow-diagram\">\r\n<div class=\"step\">\r\n<h3>1. Request</h3>\r\n<p>A user\'s web browser sends an HTTP request for a page (e.g., <code>example.com/products.php</code>).</p>\r\n</div>\r\n<div class=\"step\">\r\n<h3>2. Processing (PHP)</h3>\r\n<p>The web server receives the request and executes the PHP script, which performs server-side tasks like processing user input, managing sessions, and building dynamic content.</p>\r\n</div>\r\n<div class=\"step\">\r\n<h3>3. Database Query (PHP + MySQL)</h3>\r\n<p>If data is needed, the PHP script connects to the MySQL database and sends a Structured Query Language (SQL) statement.</p>\r\n</div>\r\n<div class=\"step\">\r\n<h3>4. Database Response (MySQL)</h3>\r\n<p>MySQL processes the SQL query and returns the requested data to the PHP script.</p>\r\n</div>\r\n<div class=\"step\">\r\n<h3>5. Page Generation (PHP)</h3>\r\n<p>The PHP script uses the data from MySQL to generate a final HTML page.</p>\r\n</div>\r\n<div class=\"step\">\r\n<h3>6. Response</h3>\r\n<p>The web server sends the completed HTML page back to the user\'s browser, which then renders it for the user.</p>\r\n</div>\r\n</div>\r\n\r\n<h2>What Each Component Does</h2>\r\n\r\n<h3>PHP (Hypertext Preprocessor)</h3>\r\n<p>PHP is a server-side scripting language designed specifically for web development.</p>\r\n<ul>\r\n<li><b>Role:</b> Acts as the \"middleman,\" connecting the user\'s web browser with the database.</li>\r\n<li><b>Purpose:</b> Used for tasks that happen behind the scenes, such as:\r\n<ul>\r\n<li>Handling form submissions</li>\r\n<li>Communicating with the database</li>\r\n<li>Controlling user access</li>\r\n<li>Generating dynamic content</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n\r\n<h3>MySQL</h3>\r\n<p>MySQL is an open-source relational database management system (RDBMS).</p>\r\n<ul>\r\n<li><b>Role:</b> Used for storing and managing data in a structured way.</li>\r\n<li><b>Purpose:</b> Organizes data into tables, columns, and rows, making it easy for PHP to perform CRUD (Create, Read, Update, Delete) operations.</li>\r\n</ul>\r\n\r\n<h2>How PHP Connects to MySQL</h2>\r\n<p>Modern PHP offers two primary extensions for connecting to a MySQL database:</p>\r\n<ul>\r\n<li>\r\n<b>MySQLi (\"MySQL improved\"):</b> An extension specific to MySQL databases that offers both procedural and object-oriented interfaces.\r\n</li>\r\n<li>\r\n<b>PDO (PHP Data Objects):</b> A versatile database abstraction layer that can work with over 12 different database systems, including MySQL.\r\n</li>\r\n</ul>\r\n<p>Both MySQLi and PDO support *prepared statements*, a security feature that helps prevent SQL injection attacks.</p>', 'article', 'phpmysql-combination', 'https://images.pexels.com/photos/3866816/pexels-photo-3866816.jpeg', 0, 0, 'on', '2025-10-12 02:35:26', '2025-10-12 02:35:26', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `article_authors`
--

DROP TABLE IF EXISTS `article_authors`;
CREATE TABLE IF NOT EXISTS `article_authors` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_articles` int(10) UNSIGNED NOT NULL,
  `key_authors` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  KEY `key_articles` (`key_articles`),
  KEY `key_authors` (`key_authors`)
) ENGINE=MyISAM AUTO_INCREMENT=19 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `article_authors`
--

INSERT INTO `article_authors` (`id`, `key_articles`, `key_authors`) VALUES
(2, 8, 8),
(3, 8, 6),
(7, 4, 5),
(6, 4, 3),
(8, 34, 8),
(9, 2, 5),
(10, 33, 11),
(11, 6, 13),
(12, 10, 11),
(13, 9, 2),
(14, 5, 6),
(15, 7, 5),
(16, 3, 9),
(17, 36, 14),
(18, 38, 10);

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
) ENGINE=MyISAM AUTO_INCREMENT=88 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `article_categories`
--

INSERT INTO `article_categories` (`id`, `key_articles`, `key_categories`, `url`) VALUES
(69, 6, 18, NULL),
(68, 6, 8, NULL),
(3, 27, 4, NULL),
(4, 27, 19, NULL),
(8, 29, 8, NULL),
(7, 29, 6, NULL),
(9, 31, 19, NULL),
(10, 31, 5, NULL),
(11, 0, 5, NULL),
(12, 0, 16, NULL),
(23, 33, 19, NULL),
(24, 33, 8, NULL),
(25, 33, 14, NULL),
(70, 3, 11, NULL),
(63, 34, 1, NULL),
(57, 35, 18, NULL),
(83, 36, 6, NULL),
(43, 0, 2, NULL),
(44, 0, 15, NULL),
(45, 0, 4, NULL),
(82, 36, 4, NULL),
(71, 4, 5, NULL),
(72, 4, 9, NULL),
(73, 4, 14, NULL),
(87, 38, 12, NULL),
(86, 38, 4, NULL);

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
  `image_url` varchar(200) COLLATE utf8_unicode_ci DEFAULT '',
  `key_media_banner` int(10) UNSIGNED DEFAULT NULL,
  `description` varchar(2000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `entry_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`key_authors`),
  KEY `fk_authors_media` (`key_media_banner`)
) ENGINE=MyISAM AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`key_authors`, `name`, `email`, `phone`, `website`, `url`, `social_url_media1`, `social_url_media2`, `social_url_media3`, `city`, `state`, `country`, `image_url`, `key_media_banner`, `description`, `status`, `entry_date_time`, `update_date_time`, `created_by`, `updated_by`) VALUES
(2, 'Amina Siddiqui', 'amina@contenthub.pk', '0300-1234567', 'https://aminasiddiqui.com', 'amina-siddiqui', 'https://twitter.com/aminasiddiqui', 'https://linkedin.com/in/aminasiddiqui', '', 'Karachi', 'Sindh', 'Pakistan', 'amina.jpg', 24, 'Amina writes on digital culture and editorial ethics.', 'on', '2025-09-25 15:19:51', '2025-09-29 22:01:40', NULL, 1),
(3, 'Bilal Khan', 'bilal@techscribe.io', '0312-9876543', 'https://bilalkhan.dev', 'bilal-khan', 'https://github.com/bilalkhan', '', '', 'Lahore', 'Punjab', 'Pakistan', 'bilal.jpg', NULL, 'Bilal specializes in backend systems and CMS architecture.', 'on', '2025-09-25 15:19:51', '2025-09-29 22:04:06', NULL, 1),
(4, 'Sana Raza', 'sana@designjournal.org', '0333-1122334', 'https://sanaraza.art', 'sana-raza', 'https://instagram.com/sanaraza', 'https://behance.net/sanaraza', '', 'Islamabad', 'Capital', 'Pakistan', 'sana.jpg', NULL, 'Sana explores editorial design and user experience.', 'on', '2025-09-25 15:19:51', '2025-09-25 15:19:51', NULL, NULL),
(5, 'Imran Qureshi', 'imran@datawrite.net', '0345-9988776', 'https://imranqureshi.net', 'imran-qureshi', 'https://twitter.com/imranqureshi', '', '', 'Multan', 'Punjab', 'Pakistan', 'imran.jpg', NULL, 'Imran writes about data-driven journalism and content strategy.', 'on', '2025-09-25 15:19:51', '2025-09-25 15:19:51', NULL, 1),
(6, 'Nida Farooq', 'nida@storycraft.pk', '0301-5566778', 'https://nidafarooq.com', 'nida-farooq', 'https://facebook.com/nidafarooq', 'https://linkedin.com/in/nidafarooq', '', 'Peshawar', 'KPK', 'Pakistan', 'nida.jpg', NULL, 'Nida focuses on narrative building and editorial workflows.', 'on', '2025-09-25 15:19:51', '2025-09-25 15:19:51', NULL, NULL),
(7, 'Tariq Mehmood', 'tariq@codepen.pk', '0322-3344556', 'https://tariqmehmood.dev', 'tariq-mehmood', 'https://github.com/tariqmehmood', '', '', 'Faisalabad', 'Punjab', 'Pakistan', 'tariq.jpg', NULL, 'Tariq contributes on PHP optimization and modular design.', 'on', '2025-09-25 15:19:51', '2025-09-25 15:19:51', NULL, NULL),
(8, 'Hina Javed', 'hina@uxpress.io', '0309-7788990', 'https://hinajaved.com', 'hina-javed', 'https://dribbble.com/hinajaved', 'https://linkedin.com/in/hinajaved', '', 'Rawalpindi', 'Punjab', 'Pakistan', 'hina.jpg', NULL, 'Hina writes about UX patterns and editorial tooling.', 'on', '2025-09-25 15:19:51', '2025-09-25 15:19:51', NULL, NULL),
(9, 'Zeeshan Ali', 'zeeshan@devjournal.pk', '0315-6677889', 'https://zeeshanali.dev', 'zeeshan-ali', 'https://twitter.com/zeeshanali', '', '', 'Hyderabad', 'Sindh', 'Pakistan', 'zeeshan.jpg', NULL, 'Zeeshan covers CMS performance and SQL tuning.', 'on', '2025-09-25 15:19:51', '2025-09-25 15:19:51', NULL, NULL),
(10, 'Fatima Noor', 'fatima@contentgrid.io', '0331-4455667', 'https://fatimanoor.com', 'fatima-noor', 'https://instagram.com/fatimanoor', 'https://linkedin.com/in/fatimanoor', '', 'Quetta', 'Balochistan', 'Pakistan', 'fatima.jpg', NULL, 'Fatima writes on editorial workflows and content curation.', 'on', '2025-09-25 15:19:51', '2025-09-25 15:19:51', NULL, NULL),
(11, 'Usman Rafiq', 'usman@editorialtech.pk', '0340-2233445', 'https://usmanrafiq.dev', 'usman-rafiq', 'https://github.com/usmanrafiq', '', '', 'Sialkot', 'Punjab', 'Pakistan', 'usman.jpg', NULL, 'Usman focuses on scalable CMS and editorial automation.', 'on', '2025-09-25 15:19:51', '2025-09-25 15:19:51', NULL, NULL),
(12, 'Haseena Imtiaz', 'haseenaimtiaz@gmail.com', '123-456-7848', '', 'haseena-imtiaz', '', '', '', '', '', '', '', 35, '', 'on', '2025-10-01 17:23:56', '2025-10-01 17:23:56', NULL, 1),
(13, 'Sumrina Khan', 'sumrinakhan@hotmail.com', '548-455-5548', '', '', '', '', '', '', '', '', '', NULL, '', 'on', '2025-10-01 17:26:39', '2025-10-01 17:26:39', 1, NULL),
(14, 'Taimur Sarfaraz', 'taimursarfaraz@gmail.com', '', '', 'tamir-sarfaraz-ahmad', '', '', '', 'Karachi', '', '', '', 28, '', 'on', '2025-10-05 05:09:57', '2025-10-05 05:09:57', 1, 1),
(16, 'Ikram Mughal', '', '', '', 'ikram-mughal', '', '', '', '', '', '', '', 0, '', 'on', '2025-10-12 07:54:52', '2025-10-12 07:54:52', 1, 1);

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

DROP TABLE IF EXISTS `blocks`;
CREATE TABLE IF NOT EXISTS `blocks` (
  `key_blocks` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_media_banner` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `block_content` varchar(10000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `show_on_pages` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `show_in_region` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `module_file` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'on',
  `entry_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `key_photo_gallery` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`key_blocks`),
  KEY `fk_blocks_media` (`key_media_banner`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`key_blocks`, `key_media_banner`, `title`, `block_content`, `show_on_pages`, `show_in_region`, `sort`, `module_file`, `status`, `entry_date_time`, `created_by`, `updated_by`, `key_photo_gallery`) VALUES
(1, 0, 'Authors', '', '', 'sidebar_right', 4, 'authors_91558', 'on', '2025-09-29 22:09:45', NULL, 1, NULL),
(2, 0, 'Photo Gallery', '', '', 'sidebar_right', 5, 'photos_56467', 'on', '2025-09-24 03:58:17', NULL, 1, NULL),
(3, 1, 'Youtube Gallery', '', '', 'sidebar_right', 6, 'youtube_15578', 'on', '2025-09-24 03:58:23', NULL, 1, NULL),
(4, 0, 'Articles', '', '', 'sidebar_right', 1, 'articles_34548', 'on', '2025-09-29 22:10:15', NULL, 1, NULL),
(5, 0, 'Books', '', '', 'sidebar_right', 3, 'books_84538', 'on', '2025-10-01 17:49:57', 1, 1, NULL),
(6, 0, 'Topics', '', '', 'sidebar_right', 2, 'categories_55448', 'on', '2025-10-08 09:37:28', 1, 1, 0),
(7, 0, '<none>', '<div id=\"home-banner\" style=\"background-image:url(/templates/default/images/pexels-wasifmehmood997-19442078.jpg)\"   data-animate=\"fade\">', 'home', 'below_header', 1, '', 'on', '2025-10-10 13:13:56', 1, 1, NULL),
(8, 0, '<none>', 'Default Template Â© CopilotCMS', '', 'footer', 10, '', 'on', '2025-10-10 13:40:38', 1, 1, NULL),
(9, 0, '<none>', '<span>Phone</span> <a href=\"tel:1234567890\">(123)456-7890</a> \r\n<span>Email</span> <a href=\"mailto:myemail@outlook.com\">myemail@outlook.com</a> ', '', 'above_header', 0, '', 'on', '2025-10-10 14:47:52', 1, 1, NULL),
(10, 0, '<none>', '<a href=\"/page/privacy-policy\">Privacy Policy</a> | <a href=\"/page/terms-of-use\">Term of Use</a>', '', 'below_footer', 16, '', 'on', '2025-10-10 14:49:16', 1, 1, 19);

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
  `cover_image_url` varchar(200) COLLATE utf8_unicode_ci DEFAULT '',
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
  `status` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `entry_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`key_books`),
  KEY `fk_books_media` (`key_media_banner`)
) ENGINE=MyISAM AUTO_INCREMENT=66 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`key_books`, `key_media_banner`, `title`, `subtitle`, `description`, `cover_image_url`, `url`, `author_name`, `publisher`, `publish_year`, `isbn`, `is_featured`, `language`, `format`, `weight_grams`, `sku`, `status`, `sort`, `entry_date_time`, `update_date_time`, `created_by`, `updated_by`) VALUES
(2, 2, 'Designing Editorial Systems', 'Workflow & UX', 'A guide to building editorial systems that balance structure with usability.', 'https://images.pexels.com/photos/46216/sunflower-flowers-bright-yellow-46216.jpeg', 'designing-editorial-systems', 'Amina Siddiqui', 'ContentHub Press', '2021', '978-969-0010011', 0, 'Urdu', 'Cover', 0, '', 'on', 1, '2025-09-25 15:23:27', '2025-10-08 14:01:48', NULL, 1),
(3, NULL, 'PHP for Publishers', 'Backend Essentials', 'Explores PHP techniques tailored for publishing platforms.', 'cover2.jpg', 'php-for-publishers', 'Bilal Khan', 'TechScribe Books', '2020', '978-969-0010012', 0, '', '', 0, '', 'on', 2, '2025-09-25 15:23:27', '2025-10-01 17:54:20', NULL, 1),
(4, NULL, 'Modular CMS Architecture', 'Scalable Design', 'Strategies for designing modular, maintainable CMS systems.', 'cover3.jpg', 'modular-cms-architecture', 'Tariq Mehmood', 'CodePen Publishing', '2022', '978-969-0010013', 0, '', '', 0, '', 'on', 3, '2025-09-25 15:23:27', '2025-09-26 18:45:53', NULL, NULL),
(5, NULL, 'Editorial UX Patterns', 'Designing for Editors', 'Patterns and principles for editorial-first user interfaces.', 'cover4.jpg', 'editorial-ux-patterns', 'Sana Raza', 'DesignJournal Books', '2021', '978-969-0010014', 0, '', '', 0, '', 'off', 4, '2025-09-25 15:23:27', '2025-09-29 22:08:39', NULL, NULL),
(6, NULL, 'CMS Debugging Handbook', 'Troubleshooting PHP & SQL', 'A practical guide to debugging CMS workflows.', 'cover5.jpg', 'cms-debugging-handbook', 'Imran Qureshi', 'DataWrite Publishing', '2019', '978-969-0010015', 0, '', '', 0, '', 'on', 5, '2025-09-25 15:23:27', '2025-09-28 16:14:44', NULL, NULL),
(7, NULL, 'Content Strategy in Practice', 'Editorial Planning', 'Real-world strategies for content planning and execution.', 'cover6.jpg', 'content-strategy-practice', 'Nida Farooq', 'StoryCraft Books', '2023', '978-969-0010016', 0, 'Urdu', 'Hard', 0, '', 'on', 6, '2025-09-25 15:23:27', '2025-09-28 16:12:12', NULL, NULL),
(8, NULL, 'Scalable Publishing Systems', 'Future-Proof CMS', 'Designing CMS platforms that grow with editorial needs.', 'cover7.jpg', 'scalable-publishing-systems', 'Usman Rafiq', 'EditorialTech Press', '2022', '978-969-0010017', 0, '', '', 0, '', 'on', 7, '2025-09-25 15:23:27', '2025-09-26 18:45:53', NULL, NULL),
(9, NULL, 'Clean Code for Editors', 'Maintainable PHP', 'Writing clean, maintainable code for editorial tools.', 'cover8.jpg', 'clean-code-editors', 'Bilal Khan', 'TechScribe Books', '2021', '978-969-0010018', 0, '', '', 0, '', 'on', 8, '2025-09-25 15:23:27', '2025-10-05 14:00:04', NULL, 1),
(10, NULL, 'Visual Content Design', 'Banner & Layouts', 'Designing impactful visuals for editorial platforms.', 'cover9.jpg', 'visual-content-design', 'Hina Javed', 'UXPress Publishing', '2020', '978-969-0010019', 0, '', '', 0, '', 'on', 9, '2025-09-25 15:23:27', '2025-09-28 16:10:45', NULL, NULL),
(11, NULL, 'Advanced CMS Filters', 'Precision Tools', 'Implementing advanced filters for editorial workflows.', 'cover10.jpg', 'advanced-cms-filters', 'Zeeshan Ali', 'DevJournal Books', '2023', '978-969-0010020', 0, '', '', 0, '', 'on', 10, '2025-09-25 15:23:27', '2025-09-26 18:45:53', NULL, NULL),
(12, NULL, 'Narrative Building', 'Storytelling in Publishing', 'Techniques for building compelling editorial narratives.', 'cover11.jpg', 'narrative-building', 'Fatima Noor', 'ContentGrid Press', '2021', '978-969-0010021', 0, '', '', 0, '', 'on', 11, '2025-09-25 15:23:27', '2025-09-26 18:45:53', NULL, NULL),
(13, NULL, 'SEO for Editorial Teams', 'URL & Structure', 'Optimizing editorial content for search engines.', 'cover12.jpg', 'seo-editorial-teams', 'Usman Rafiq', 'EditorialTech Press', '2020', '978-969-0010022', 0, '', '', 0, '', 'on', 12, '2025-09-25 15:23:27', '2025-09-26 18:45:53', NULL, NULL),
(14, NULL, 'CMS Testing Toolkit', 'QA for Editors', 'Testing strategies for editorial CMS workflows.', 'cover13.jpg', 'cms-testing-toolkit', 'Imran Qureshi', 'DataWrite Publishing', '2022', '978-969-0010023', 0, '', '', 0, '', 'on', 13, '2025-09-25 15:23:27', '2025-09-26 18:45:53', NULL, NULL),
(15, NULL, 'Collaborative Publishing', 'Team-Based CMS', 'Building CMS systems for collaborative editorial teams.', 'cover14.jpg', 'collaborative-publishing', 'Nida Farooq', 'StoryCraft Books', '2023', '978-969-0010024', 0, '', '', 0, '', 'on', 14, '2025-09-25 15:23:27', '2025-09-26 18:45:53', NULL, NULL),
(16, NULL, 'Desktop-First UI Design', 'Focused Editorial Tools', 'Why desktop-first design still matters in publishing.', 'cover15.jpg', 'desktop-ui-design', 'Sana Raza', 'DesignJournal Books', '2021', '978-969-0010025', 0, '', '', 0, '', 'on', 15, '2025-09-25 15:23:27', '2025-09-26 18:45:53', NULL, NULL),
(58, NULL, 'New World of App Dev with A-I', 'Speed up the Process 10x', '', '', 'new-world-of-app-dev-with-ai', 'Dean Mo', 'Copilot', '2025', NULL, NULL, NULL, NULL, NULL, NULL, 'on', 0, '2025-09-30 13:31:13', '2025-09-30 18:00:31', NULL, NULL),
(59, 0, 'PHP for Non Publishers', '', '', '', 'php-for-non-publishers', '', 'Hello Pubs', '', NULL, NULL, NULL, NULL, NULL, NULL, 'on', 0, '2025-10-01 17:54:52', '2025-10-12 08:17:34', 1, 1),
(62, 0, 'Pink Flowers in the World', 'in Pakistan', '', '', 'pink-flowers-in-the-world', '', '', '', '', NULL, '', '', 0, '0', 'on', 0, '2025-10-08 08:24:50', '2025-10-12 08:19:22', 1, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=45 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `book_articles`
--

INSERT INTO `book_articles` (`key_book_articles`, `key_books`, `key_articles`, `sort_order`) VALUES
(4, 1, 1, 0),
(12, 5, 24, 0),
(11, 5, 21, 0),
(10, 5, 10, 0),
(9, 5, 7, 0),
(25, 7, 8, 0),
(41, 3, 24, 0),
(42, 3, 9, 0),
(39, 3, 1, 0),
(30, 4, 3, 0),
(40, 3, 3, 0),
(31, 4, 4, 0),
(32, 4, 7, 0),
(43, 2, 6, 0),
(44, 2, 11, 0);

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
) ENGINE=MyISAM AUTO_INCREMENT=81 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `book_categories`
--

INSERT INTO `book_categories` (`id`, `key_books`, `key_categories`, `url`) VALUES
(43, 51, 15, NULL),
(29, 49, 17, NULL),
(28, 49, 8, NULL),
(27, 49, 2, NULL),
(26, 48, 17, NULL),
(25, 48, 8, NULL),
(24, 48, 2, NULL),
(23, 40, 19, NULL),
(65, 2, 8, NULL),
(40, 0, 9, NULL),
(20, 35, 8, NULL),
(19, 35, 5, NULL),
(18, 31, 0, NULL),
(17, 29, 0, NULL),
(42, 51, 3, NULL),
(41, 0, 11, NULL),
(37, 50, 3, NULL),
(38, 50, 5, NULL),
(44, 53, 3, NULL),
(45, 53, 15, NULL),
(46, 55, 3, NULL),
(47, 55, 15, NULL),
(48, 57, 3, NULL),
(49, 57, 15, NULL),
(53, 58, 14, NULL),
(52, 58, 1, NULL),
(54, 3, 15, NULL),
(77, 59, 11, NULL),
(78, 59, 19, NULL),
(64, 0, 5, NULL),
(66, 2, 12, NULL),
(80, 62, 9, NULL),
(73, 0, 10, NULL),
(75, 64, 9, NULL),
(76, 65, 9, NULL);

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
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `status` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `entry_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_type` enum('article','book','photo_gallery','video_gallery','global') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'global',
  PRIMARY KEY (`key_categories`)
) ENGINE=MyISAM AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`key_categories`, `key_media_banner`, `name`, `description`, `url`, `sort`, `status`, `entry_date_time`, `category_type`) VALUES
(1, 0, 'Education', '', 'category/education', 1, 'on', '2025-09-23 20:20:39', 'global'),
(2, 0, 'Editorial Design', 'Design principles tailored for editorial platforms.', 'editorial-design', 1, 'on', '2025-09-25 15:25:13', 'book'),
(3, 0, 'CMS Architecture', 'Structural and modular design of content systems.', 'cms-architecture', 2, 'on', '2025-09-25 15:25:13', 'global'),
(4, 0, 'PHP Development', 'Native PHP techniques for backend publishing tools.', 'php-development', 3, 'on', '2025-09-25 15:25:13', 'photo_gallery'),
(5, 0, 'UX Patterns', 'User experience strategies for editorial workflows.', 'ux-patterns1', 4, 'on', '2025-09-25 15:25:13', 'global'),
(6, 0, 'Content Strategy', 'Planning and organizing editorial content.', 'content-strategy', 5, 'on', '2025-09-25 15:25:13', 'article'),
(7, 0, 'Debugging & QA', 'Troubleshooting and testing publishing systems.', 'debugging-qa', 6, 'on', '2025-09-25 15:25:13', 'global'),
(8, 0, 'Search Optimization', 'Improving search relevance and performance.', 'search-optimization', 7, 'on', '2025-09-25 15:25:13', 'global'),
(9, 0, 'Modular Design', 'Reusable components and scalable architecture.', 'modular-design', 8, 'on', '2025-09-25 15:25:13', 'global'),
(10, 3, 'Visual Design', 'Banner images, layout, and visual storytelling.', 'visual-design', 9, 'on', '2025-09-25 15:25:13', 'global'),
(11, 0, 'Publishing Workflow', 'From draft to publish—editorial flow management.', 'publishing-workflow', 10, 'on', '2025-09-25 15:25:13', 'global'),
(12, 0, 'Database Tuning', 'Optimizing SQL queries and schema for CMS.', 'database-tuning', 11, 'on', '2025-09-25 15:25:13', 'global'),
(13, 0, 'SEO & URLs', 'Structuring URLs and metadata for search engines.', 'seo-urls', 12, 'on', '2025-09-25 15:25:13', 'article'),
(14, 0, 'Team Collaboration', 'Tools and practices for editorial teamwork.', 'team-collaboration', 13, 'on', '2025-09-25 15:25:13', 'global'),
(15, 0, 'Desktop UI', 'Designing for desktop-first editorial tools.', 'desktop-ui', 14, 'on', '2025-09-25 15:25:13', 'global'),
(16, 0, 'Content Curation', 'Selecting and organizing high-quality content.', 'content-curation', 15, 'on', '2025-09-25 15:25:13', 'global'),
(17, 0, 'Performance Optimization', 'Speed and efficiency in CMS systems.', 'performance-optimization', 16, 'on', '2025-09-25 15:25:13', 'global'),
(18, 0, 'Advanced Filters', 'Precision filtering tools for editors.', 'advanced-filters', 17, 'on', '2025-09-25 15:25:13', 'global'),
(19, 0, 'Legacy Systems', 'Modernizing and refactoring old CMS platforms.', 'legacy-systems-legacy', 18, 'on', '2025-09-25 15:25:13', 'global'),
(20, 0, 'Narrative Building', 'Crafting compelling editorial stories.', 'narrative-building', 19, 'on', '2025-09-25 15:25:13', 'global'),
(21, 0, 'Editorial Automation', 'Automating repetitive editorial tasks.', 'editorial-automation', 20, 'on', '2025-09-25 15:25:13', 'global'),
(23, 13, 'Modern Architecture', '', 'modern-architecture', 0, 'on', '2025-10-10 07:48:30', 'photo_gallery'),
(24, 0, 'Ancient Heritage', '', 'ancient-heritage', 0, 'on', '2025-10-10 07:49:31', 'photo_gallery'),
(25, 0, 'Educational Institutions', '', 'educational-institutions', 0, 'on', '2025-10-10 07:49:53', 'photo_gallery'),
(26, 0, 'Tourism Attractions', '', 'tourism-attractions', 0, 'on', '2025-10-10 07:50:36', 'photo_gallery'),
(27, 0, 'Cricket', '', 'cricket', 0, 'on', '2025-10-10 11:51:49', 'video_gallery'),
(28, 0, 'Soccer', '', 'soccer', 0, 'on', '2025-10-10 11:51:57', 'video_gallery'),
(29, 0, 'Swimming', '', 'swimming', 0, 'on', '2025-10-10 11:52:31', 'video_gallery'),
(30, 0, 'Tennis', '', 'tennis', 0, 'on', '2025-10-10 11:52:52', 'video_gallery');

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
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `status` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `entry_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_main_menu`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `main_menu`
--

INSERT INTO `main_menu` (`key_main_menu`, `parent_id`, `title`, `url_link`, `sort`, `status`, `entry_date_time`) VALUES
(15, 0, 'Books', '/books', 3, 'on', '2025-10-09 05:23:50'),
(14, 0, 'Topics', '/categories', 2, 'on', '2025-10-09 05:23:33'),
(20, 19, 'About Us', '/page/about-us', 0, 'on', '2025-10-10 14:03:19'),
(19, 0, 'Info', '/pages', 5, 'on', '2025-10-09 10:15:38'),
(18, 0, 'Youtube', '/youtube-gallery', 6, 'on', '2025-10-09 10:15:01'),
(17, 0, 'Albums', '/photo-gallery', 5, 'on', '2025-10-09 10:14:12'),
(13, 0, 'Articles', '/articles', 1, 'on', '2025-10-09 05:23:15'),
(16, 0, 'Authors', '/authors', 4, 'on', '2025-10-09 10:12:54'),
(12, 0, 'Home', '/home', 0, 'on', '2025-10-09 05:23:01'),
(21, 19, 'Careers', '/page/careers', 0, 'on', '2025-10-10 14:03:34');

-- --------------------------------------------------------

--
-- Table structure for table `media_library`
--

DROP TABLE IF EXISTS `media_library`;
CREATE TABLE IF NOT EXISTS `media_library` (
  `key_media` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `file_url` varchar(2000) COLLATE utf8_unicode_ci NOT NULL,
  `file_type` enum('image','video','pdf','other') COLLATE utf8_unicode_ci NOT NULL,
  `alt_text` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `tags` varchar(500) COLLATE utf8_unicode_ci DEFAULT NULL,
  `uploaded_by` int(10) UNSIGNED DEFAULT NULL,
  `entry_date_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_media`),
  KEY `uploaded_by` (`uploaded_by`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `media_library`
--

INSERT INTO `media_library` (`key_media`, `file_url`, `file_type`, `alt_text`, `tags`, `uploaded_by`, `entry_date_time`) VALUES
(5, '/media/images/2025/badshahi-mosque-lahore-pakistan.jpg', 'image', 'Badshahi Mosque, Lahore, Pakistan', '', 1, '2025-10-10 05:45:21'),
(6, '/media/images/2025/ferris-wheel-singapore.jpg', 'image', 'Ferris Wheel Singapore', '', 1, '2025-10-10 05:45:55'),
(7, '/media/images/2025/taj-mahal-india.jpg', 'image', 'Taj Mahal India', '', 1, '2025-10-10 06:13:21'),
(8, '/media/images/2025/bosphorus-istanbul-turkey.jpg', 'image', 'Bosphorus, Istanbul, Turkey', '', 1, '2025-10-10 07:17:46'),
(9, '/media/images/2025/eiffel-tower-paris-france.jpg', 'image', 'Eiffel Tower, Paris, France', '', 1, '2025-10-10 07:18:19'),
(10, '/media/images/2025/golden-gate-bridge-san-francisco-california-united-states.jpg', 'image', 'Golden Gate Bridge, San Francisco, California, United States', '', 1, '2025-10-10 07:19:02'),
(11, '/media/images/2025/great-wall-of-china.jpg', 'image', 'Great Wall of China', '', 1, '2025-10-10 07:19:24'),
(12, '/media/images/2025/sydney-opera-house-australia.jpg', 'image', 'Opera House, Sydney, Australia', '', 1, '2025-10-10 07:20:00'),
(13, '/media/images/2025/oxford-london-united-kingdom.jpg', 'image', 'Oxford, London, United Kingdom', '', 1, '2025-10-10 07:22:10'),
(14, '/media/images/2025/taj-mahal-india4.jpg', 'image', 'Taj Mahal India', '', 1, '2025-10-10 10:35:23'),
(15, '/media/images/2025/taj-mahal-india3.jpg', 'image', 'Taj Mahal India', '', 1, '2025-10-10 10:35:48'),
(16, '/media/images/2025/taj-mahal-india4.jpg', 'image', 'Taj Mahal India', '', 1, '2025-10-10 10:36:00'),
(17, '/media/images/2025/sydney-opera-house-australia4.jpg', 'image', 'Sydney Opera House', '', 1, '2025-10-10 10:36:31'),
(18, '/media/images/2025/sydney-opera-house-australia3.jpg', 'image', 'Sydney Opera House', '', 1, '2025-10-10 10:36:46'),
(19, '/media/images/2025/sydney-opera-house-australia2.jpg', 'image', 'Sydney Opera House', '', 1, '2025-10-10 10:36:58'),
(20, '/media/images/2025/oxford-london-united-kingdom3.jpg', 'image', 'Oxford London', '', 1, '2025-10-10 10:37:25'),
(21, '/media/images/2025/oxford-london-united-kingdom2.jpg', 'image', 'Oxford London', '', 1, '2025-10-10 10:37:37'),
(22, '/media/images/2025/oxford-london-united-kingdom2.jpg', 'image', 'Oxford London', '', 1, '2025-10-10 10:37:46'),
(23, '/media/images/2025/great-wall-of-china4.jpg', 'image', 'Great Wall of China', '', 1, '2025-10-10 10:38:04'),
(24, '/media/images/2025/great-wall-of-china3.jpg', 'image', 'Great Wall of China', '', 1, '2025-10-10 10:38:19'),
(25, '/media/images/2025/great-wall-of-china2.jpg', 'image', 'Great Wall of China', '', 1, '2025-10-10 10:38:28'),
(26, '/media/images/2025/golden-gate-bridge-san-francisco-california-united-states4.jpg', 'image', 'Golden Gate Bridge', '', 1, '2025-10-10 10:38:45'),
(27, '/media/images/2025/golden-gate-bridge-san-francisco-california-united-states3.jpg', 'image', 'Golde Gate Bridge', '', 1, '2025-10-10 10:38:55'),
(28, '/media/images/2025/golden-gate-bridge-san-francisco-california-united-states2.jpg', 'image', 'Golden Gate Bridge', '', 1, '2025-10-10 10:39:13'),
(29, '/media/images/2025/ferris-wheel-singapore3.jpg', 'image', 'Ferris Wheel Singapore', '', 1, '2025-10-10 10:39:33'),
(30, '/media/images/2025/ferris-wheel-singapore2.jpg', 'image', 'Ferris Wheel Singapore', '', 1, '2025-10-10 10:39:43'),
(31, '/media/images/2025/eiffel-tower-paris-france4.jpg', 'image', 'Eiffel Tower France', '', 1, '2025-10-10 10:40:09'),
(32, '/media/images/2025/eiffel-tower-paris-france3.jpg', 'image', 'Eiffel Tower France', '', 1, '2025-10-10 10:40:21'),
(33, '/media/images/2025/eiffel-tower-paris-france2.jpg', 'image', 'Eiffel Tower France', '', 1, '2025-10-10 10:40:30'),
(34, '/media/images/2025/bosphorus-istanbul-turkey4.jpg', 'image', 'Istanbul Turkey', '', 1, '2025-10-10 10:40:53'),
(35, '/media/images/2025/bosphorus-istanbul-turkey3.jpg', 'image', 'Istanbul Turkey', '', 1, '2025-10-10 10:41:05'),
(36, '/media/images/2025/bosphorus-istanbul-turkey2.jpg', 'image', 'Istanbul Turkey', '', 1, '2025-10-10 10:41:15'),
(37, '/media/images/2025/badshahi-mosque-lahore4.jpg', 'image', 'Badshahi Mosque Lahore', '', 1, '2025-10-10 10:41:45'),
(38, '/media/images/2025/badshahi-mosque-lahore3.jpg', 'image', 'Badshahi Mosque Lahore', '', 1, '2025-10-10 10:41:53'),
(39, '/media/images/2025/badshahi-mosque-lahore2.jpg', 'image', 'Badshahi Mosque Lahore', '', 1, '2025-10-10 10:42:04');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `key_pages` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_media_banner` int(10) UNSIGNED DEFAULT NULL,
  `banner_image_url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `page_content` text COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `entry_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_pages`),
  KEY `fk_pages_media` (`key_media_banner`)
) ENGINE=MyISAM AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`key_pages`, `key_media_banner`, `banner_image_url`, `title`, `page_content`, `url`, `status`, `entry_date_time`, `update_date_time`) VALUES
(3, 5, 'banner-about.jpg', 'About Us', 'We build tools that empower editorial teams through clean design and modular workflows.', 'about-us', 'on', '2025-09-25 15:27:07', '2025-09-25 15:27:07'),
(4, 0, 'banner-contact.jpg', 'Contact', 'Reach out to us via email or social media. We value your feedback.', 'contact', 'on', '2025-09-25 15:27:07', '2025-09-25 15:27:07'),
(5, NULL, 'banner-privacy.jpg', 'Privacy Policy', 'This page outlines how we handle user data and respect privacy.', 'privacy-policy', 'on', '2025-09-25 15:27:07', '2025-09-25 15:27:07'),
(6, 0, 'banner-terms.jpg', 'Terms of Use', 'By using this site, you agree to our terms and conditions.', 'terms-of-use', 'on', '2025-09-25 15:27:07', '2025-09-25 15:27:07'),
(12, 30, '', 'Careers', 'Testing careers', 'careers', 'on', '2025-10-07 16:55:28', '2025-10-07 16:55:28'),
(14, 27, '', 'Disclaimer', '', 'disclaimer', 'on', '2025-10-12 07:46:09', '2025-10-12 07:46:09');

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
) ENGINE=MyISAM AUTO_INCREMENT=62 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `photo_categories`
--

INSERT INTO `photo_categories` (`id`, `key_photo_gallery`, `key_categories`, `url`) VALUES
(32, 8, 2, NULL),
(35, 7, 12, NULL),
(29, 0, 15, NULL),
(37, 6, 21, NULL),
(27, 4, 5, NULL),
(28, 4, 12, NULL),
(36, 6, 12, NULL),
(38, 9, 4, NULL),
(39, 11, 15, NULL),
(40, 13, 15, NULL),
(42, 15, 13, NULL),
(43, 17, 26, NULL),
(44, 16, 25, NULL),
(45, 18, 26, NULL),
(46, 19, 26, NULL),
(47, 20, 23, NULL),
(48, 21, 24, NULL),
(61, 22, 23, NULL),
(60, 23, 26, NULL),
(59, 24, 26, NULL);

-- --------------------------------------------------------

--
-- Table structure for table `photo_gallery`
--

DROP TABLE IF EXISTS `photo_gallery`;
CREATE TABLE IF NOT EXISTS `photo_gallery` (
  `key_photo_gallery` int(11) NOT NULL AUTO_INCREMENT,
  `key_media_banner` int(10) UNSIGNED DEFAULT NULL,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_url` varchar(2000) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `status` varchar(3) COLLATE utf8_unicode_ci DEFAULT '',
  `entry_date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `available_for_blocks` varchar(3) COLLATE utf8_unicode_ci DEFAULT '',
  PRIMARY KEY (`key_photo_gallery`),
  KEY `fk_photo_gallery_media` (`key_media_banner`)
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `photo_gallery`
--

INSERT INTO `photo_gallery` (`key_photo_gallery`, `key_media_banner`, `title`, `image_url`, `description`, `status`, `entry_date_time`, `update_date_time`, `created_by`, `updated_by`, `url`, `available_for_blocks`) VALUES
(22, 0, 'Sydney Opera House Australia', '/media/images/2025/sydney-opera-house-australia.jpg', '', 'on', '2025-10-10 12:54:56', '2025-10-10 07:54:56', 1, 1, 'sydney-opera-house-australia', 'on'),
(20, 10, 'Golden Gate Bridge San Francisco California United States', '/media/images/2025/golden-gate-bridge-san-francisco-california-united-states.jpg', '', 'on', '2025-10-10 12:53:38', '2025-10-10 07:53:38', 1, NULL, 'golden-gate-bridge-san-francisco-california-united-states', '0'),
(21, 11, 'Great Wall of China', '/media/images/2025/great-wall-of-china.jpg', '', 'on', '2025-10-10 12:54:09', '2025-10-10 07:54:09', 1, NULL, 'great-wall-of-china', '0'),
(17, 0, 'Bosphorus Istanbul Turkey', '/media/images/2025/bosphorus-istanbul-turkey.jpg', '', 'on', '2025-10-10 12:41:00', '2025-10-10 07:41:00', 1, 1, 'bosphorus-istanbul-turkey', '0'),
(18, 9, 'Eiffel Tower Paris France', 'http://copilot/media/images/2025/eiffel-tower-paris-france.jpg', '', 'on', '2025-10-10 12:52:14', '2025-10-10 07:52:14', 1, NULL, 'eiffel-tower-paris-france', '0'),
(19, 6, 'Ferris Wheel Singapore', '/media/images/2025/ferris-wheel-singapore.jpg', '', 'on', '2025-10-10 12:52:51', '2025-10-10 07:52:51', 1, NULL, 'ferris-wheel-singapore', '0'),
(16, 0, 'Oxford University London', '/media/images/2025/oxford-london-united-kingdom.jpg', '', 'on', '2025-10-08 14:47:00', '2025-10-08 09:47:00', 1, 1, 'oxford-university-london', '0'),
(23, 0, 'Taj Mahal India', '/media/images/2025/taj-mahal-india.jpg', '', 'on', '2025-10-10 12:55:31', '2025-10-10 07:55:31', 1, 1, 'taj-mahal-india', 'on'),
(24, 0, 'Badshahi Mosque Lahore, Pakistan', '/media/images/2025/badshahi-mosque-lahore-pakistan.jpg', '', 'on', '2025-10-10 12:55:55', '2025-10-10 07:55:55', 1, 1, 'badshahi-mosque-lahore-pakistan', 'on');

-- --------------------------------------------------------

--
-- Table structure for table `photo_gallery_images`
--

DROP TABLE IF EXISTS `photo_gallery_images`;
CREATE TABLE IF NOT EXISTS `photo_gallery_images` (
  `key_image` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_media_banner` int(10) UNSIGNED DEFAULT NULL,
  `key_photo_gallery` int(10) UNSIGNED NOT NULL,
  `sort_order` smallint(5) UNSIGNED DEFAULT '0',
  `entry_date_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
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
  `button_style` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `visibility_start` datetime DEFAULT NULL,
  `visibility_end` datetime DEFAULT NULL,
  `status` varchar(3) COLLATE utf8_unicode_ci DEFAULT 'on',
  PRIMARY KEY (`key_image`),
  KEY `key_photo_gallery` (`key_photo_gallery`),
  KEY `fk_photo_gallery_images_media` (`key_media_banner`)
) ENGINE=MyISAM AUTO_INCREMENT=70 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `photo_gallery_images`
--

INSERT INTO `photo_gallery_images` (`key_image`, `key_media_banner`, `key_photo_gallery`, `sort_order`, `entry_date_time`, `title`, `description`, `image_mobile_url`, `opacity`, `action_button`, `action_button_text`, `action_button_link_url`, `animation_type`, `text_position`, `text_color`, `button_style`, `visibility_start`, `visibility_end`, `status`) VALUES
(28, 1, 3, 0, '2025-10-09 02:34:35', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(3, 0, 1, 0, '2025-10-08 19:32:33', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(30, 2, 14, 0, '2025-10-09 02:34:48', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(27, 3, 6, 0, '2025-10-09 02:34:13', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(29, 4, 3, 0, '2025-10-09 02:34:38', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(34, 38, 24, 0, '2025-10-10 10:42:37', 'Shahi Mosque Front', '', '', 1, 0, '', '', 'fade', 'center', '#ffffff', '', NULL, NULL, 'on'),
(25, 4, 6, 0, '2025-10-09 02:34:06', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(65, 22, 16, 0, '2025-10-10 10:47:14', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(64, 13, 16, 0, '2025-10-10 10:47:04', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(33, 1, 15, 0, '2025-10-09 02:35:08', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(35, 39, 24, 0, '2025-10-10 10:42:41', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(36, 37, 24, 0, '2025-10-10 10:42:43', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(39, 7, 23, 0, '2025-10-10 10:43:09', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(40, 14, 23, 0, '2025-10-10 10:43:17', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(41, 15, 23, 0, '2025-10-10 10:43:32', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(42, 12, 22, 0, '2025-10-10 10:44:01', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(43, 17, 22, 0, '2025-10-10 10:44:09', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(44, 18, 22, 0, '2025-10-10 10:44:12', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(45, 19, 22, 0, '2025-10-10 10:44:15', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(46, 11, 21, 0, '2025-10-10 10:44:34', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(47, 25, 21, 0, '2025-10-10 10:44:40', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(48, 23, 21, 0, '2025-10-10 10:44:51', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(49, 24, 21, 0, '2025-10-10 10:45:06', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(50, 10, 20, 0, '2025-10-10 10:45:17', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(51, 26, 20, 0, '2025-10-10 10:45:21', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(52, 28, 20, 0, '2025-10-10 10:45:23', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(53, 6, 19, 0, '2025-10-10 10:45:44', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(54, 29, 19, 0, '2025-10-10 10:45:49', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(55, 30, 19, 0, '2025-10-10 10:45:51', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(56, 9, 18, 0, '2025-10-10 10:46:10', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(57, 31, 18, 0, '2025-10-10 10:46:15', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(58, 32, 18, 0, '2025-10-10 10:46:17', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(59, 33, 18, 0, '2025-10-10 10:46:19', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(60, 8, 17, 0, '2025-10-10 10:46:41', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(61, 34, 17, 0, '2025-10-10 10:46:46', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(62, 35, 17, 0, '2025-10-10 10:46:48', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(63, 36, 17, 0, '2025-10-10 10:46:51', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(67, 20, 16, 0, '2025-10-10 10:47:21', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(68, 13, 16, 0, '2025-10-10 10:47:24', NULL, NULL, NULL, 1, 0, NULL, NULL, 'fade', 'center', '#ffffff', NULL, NULL, NULL, 'on'),
(69, NULL, 24, 0, '2025-10-13 06:07:02', 'Badshahi Mosque Aerial View', '', '', 1, 0, '', '', 'fade', 'center', '#ffffff', '', NULL, NULL, 'on');

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
  `status` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  `sort` smallint(6) DEFAULT NULL,
  `entry_date_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  PRIMARY KEY (`key_product`)
) ENGINE=MyISAM AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`key_product`, `product_type`, `key_books`, `title`, `description`, `price`, `stock_quantity`, `discount_percent`, `sku`, `is_featured`, `url`, `status`, `sort`, `entry_date_time`, `update_date_time`, `created_by`, `updated_by`) VALUES
(1, 'book', NULL, 'The Art of Foxus', 'A curated guide to deep work and clarity.', '1203.00', 45, 10, '0', 1, 'the-art-of-foxus', 'on', 0, '2025-09-30 17:10:39', '2025-10-06 05:44:09', NULL, 1),
(2, 'stationery', NULL, 'Leather Notebook', 'Premium A5 notebook with stitched binding.', '850.00', 200, 5, 'ST-NOTE-002', 0, '', 'on', 2, '2025-09-30 17:10:39', '2025-09-30 17:10:39', NULL, NULL),
(3, 'digital', NULL, 'Productivity Toolkit (PDF)', 'Downloadable templates and planners.', '500.00', 9999, 0, 'DG-TOOLKIT-003', 1, '', 'on', 3, '2025-09-30 17:10:39', '2025-09-30 17:10:39', NULL, NULL),
(4, 'book', NULL, 'Code & Craft', 'A book for developers who love clean architecture.', '1500.00', 30, 15, 'BK-CODE-004', 1, 'code-and-craft', 'on', 0, '2025-09-30 17:10:39', '2025-10-07 01:44:54', NULL, 1),
(5, 'stationery', NULL, 'Gel Pen Set (Pack of 10)', 'Smooth writing pens in assorted colors.', '300.00', 500, 0, 'ST-PENS-005', 0, '', 'on', 5, '2025-09-30 17:10:39', '2025-09-30 17:10:39', NULL, NULL),
(6, 'other', NULL, 'Golden Jumpes', 'Some long jumpes ', '600.00', 10, NULL, '0', NULL, 'golden-jumpes', 'on', 0, '2025-09-30 17:21:30', '2025-10-06 05:44:28', NULL, 1),
(11, 'other', NULL, 'Navy Shoes', 'Testing shoes', '2000.00', 40, NULL, '', NULL, 'navy-shoes', 'on', 0, '2025-09-30 19:48:15', '2025-10-08 15:36:51', 1, 1),
(12, 'book', NULL, 'Robot Car, Racing Car Toy for Kids', '', '900.00', 0, NULL, '', NULL, 'robot-car-racing-car-toy-for-kids-', 'on', NULL, '2025-10-05 01:31:32', '2025-10-05 01:31:41', 1, 1);

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
) ENGINE=MyISAM AUTO_INCREMENT=25 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `key_product`, `key_categories`, `url`) VALUES
(19, 1, 5, NULL),
(23, 6, 1, NULL),
(22, 6, 13, NULL),
(24, 11, 20, NULL),
(17, 12, 14, NULL),
(16, 12, 19, NULL);

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
  `entry_date_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_image`),
  KEY `key_product` (`key_product`),
  KEY `fk_product_images_media` (`key_media_banner`)
) ENGINE=MyISAM AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`key_image`, `key_media_banner`, `key_product`, `sort_order`, `entry_date_time`) VALUES
(45, 3, 11, 0, '2025-10-09 02:29:26'),
(15, NULL, 4, 0, '2025-10-01 19:45:21'),
(16, NULL, 4, 0, '2025-10-01 19:45:21'),
(20, NULL, 5, 0, '2025-10-01 19:54:32'),
(24, NULL, 5, 0, '2025-10-01 20:28:59'),
(27, NULL, 5, 0, '2025-10-01 20:35:49');

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
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(3) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`key_order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `change_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_price`)
) ENGINE=MyISAM AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_prices_history`
--

INSERT INTO `product_prices_history` (`key_price`, `key_product`, `old_price`, `new_price`, `change_date`) VALUES
(1, 1, '1200.00', '1203.00', '2025-09-30 17:17:14'),
(2, 6, '0.00', '500.00', '2025-09-30 17:21:30'),
(8, 6, '500.00', '600.00', '2025-10-02 11:40:30'),
(9, 12, '0.00', '900.00', '2025-10-05 01:31:32'),
(7, 11, '0.00', '2000.00', '2025-09-30 19:48:15');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `key_settings` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `setting_value` text COLLATE utf8_unicode_ci NOT NULL,
  `setting_group` varchar(50) COLLATE utf8_unicode_ci DEFAULT 'general',
  `setting_type` enum('text','number','boolean','url','color','json','dropdown') COLLATE utf8_unicode_ci DEFAULT 'text',
  `is_active` tinyint(1) DEFAULT '1',
  `entry_date_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_settings`)
) ENGINE=MyISAM AUTO_INCREMENT=40 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`key_settings`, `setting_key`, `setting_value`, `setting_group`, `setting_type`, `is_active`, `entry_date_time`) VALUES
(1, 'site_name', 'Copilot CMS', 'general', 'text', 1, '2025-10-06 18:07:08'),
(2, 'site_slogan', 'Clarity. Collaboration. Control.', 'general', 'text', 1, '2025-10-06 18:07:08'),
(3, 'base_url', 'https://www.mysite.com', 'general', 'url', 1, '2025-10-06 18:18:10'),
(4, 'powered_by', 'Powered by Copilot', 'general', 'text', 1, '2025-10-06 18:07:08'),
(5, 'homepage_featured_articles_count', '5', 'homepage', 'number', 1, '2025-10-06 18:07:08'),
(6, 'homepage_featured_books_count', '3', 'homepage', 'number', 1, '2025-10-06 18:07:08'),
(7, 'homepage_blocks_region', 'main', 'homepage', 'text', 1, '2025-10-06 18:07:08'),
(8, 'homepage_banner_text', 'Welcome to Our Editorial Hub', 'homepage', 'text', 1, '2025-10-06 18:07:08'),
(9, 'homepage_cta_button_text', 'Explore More', 'homepage', 'text', 1, '2025-10-06 18:07:08'),
(10, 'homepage_cta_button_url', '/books', 'homepage', 'url', 1, '2025-10-06 18:07:08'),
(11, 'article_show_author', '1', 'article_view', 'boolean', 1, '2025-10-06 18:07:08'),
(12, 'article_show_categories', '1', 'article_view', 'boolean', 1, '2025-10-06 18:07:08'),
(13, 'article_show_related_books', '1', 'article_view', 'boolean', 1, '2025-10-06 18:07:08'),
(14, 'article_snippet_length', '300', 'article_view', 'number', 1, '2025-10-06 18:07:08'),
(15, 'article_banner_height', '400px', 'article_view', 'text', 1, '2025-10-06 18:07:08'),
(16, 'book_show_assigned_articles', '1', 'book_view', 'boolean', 1, '2025-10-06 18:07:08'),
(17, 'product_show_price_history', '1', 'product_view', 'boolean', 1, '2025-10-06 18:07:08'),
(18, 'product_gallery_layout', 'grid', 'product_view', 'text', 1, '2025-10-06 18:07:08'),
(19, 'product_default_currency', 'PKR', 'product_view', 'text', 1, '2025-10-06 18:07:08'),
(20, 'photo_gallery_layout', 'grid', 'gallery', 'text', 1, '2025-10-06 18:07:08'),
(21, 'youtube_gallery_embed_style', 'iframe', 'gallery', 'text', 1, '2025-10-06 18:07:08'),
(22, 'gallery_items_per_page', '12', 'gallery', 'number', 1, '2025-10-06 18:07:08'),
(23, 'default_font_family', 'Arial, sans-serif', 'ui', 'text', 1, '2025-10-06 18:07:08'),
(24, 'template_default_color', '#0055aa', 'ui', 'color', 1, '2025-10-10 13:01:14'),
(25, 'default_button_style', 'rounded', 'ui', 'text', 1, '2025-10-06 18:07:08'),
(26, 'default_loading_spinner', 'spinner-circle', 'ui', 'text', 1, '2025-10-06 18:07:08'),
(27, 'default_404_message', 'Page not found.', 'ui', 'text', 1, '2025-10-06 18:07:08'),
(28, 'default_empty_state_message', 'No content available.', 'ui', 'text', 1, '2025-10-06 18:07:08'),
(29, 'menu_max_depth', '3', 'seo', 'number', 1, '2025-10-06 18:07:08'),
(30, 'seo_enable_canonical_links', '1', 'seo', 'boolean', 1, '2025-10-06 18:07:08'),
(31, 'seo_enable_open_graph', '1', 'seo', 'boolean', 1, '2025-10-06 18:07:08'),
(32, 'seo_default_image_url', '/assets/images/default-og.jpg', 'seo', 'url', 1, '2025-10-06 18:07:08'),
(33, 'frontend_debug_mode', '0', 'debug', 'boolean', 1, '2025-10-06 18:07:08'),
(34, 'frontend_cache_ttl', '300', 'debug', 'number', 1, '2025-10-06 18:07:08'),
(35, 'frontend_ajax_timeout', '5000', 'debug', 'number', 1, '2025-10-06 18:07:08'),
(37, 'template_folder', 'editorial', 'ui', 'dropdown', 1, '2025-10-06 18:59:28'),
(38, 'template_default_logo', '/templates/default/images/copilogcms.jpg', 'ui', 'text', 1, '2025-10-10 12:11:50'),
(39, 'template_default_cover_image', '/templates/default/images/pexels-wasifmehmood997-19442078.jpg', 'ui', 'text', 1, '2025-10-10 13:02:14');

-- --------------------------------------------------------

--
-- Table structure for table `users`
--

DROP TABLE IF EXISTS `users`;
CREATE TABLE IF NOT EXISTS `users` (
  `key_user` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `username` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `password_hash` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  `role` enum('admin','editor','viewer') COLLATE utf8_unicode_ci DEFAULT 'viewer',
  `status` varchar(3) COLLATE utf8_unicode_ci DEFAULT 'on',
  `entry_date_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` timestamp NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  `phone` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `address` text COLLATE utf8_unicode_ci,
  `city` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `state` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `country` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`key_user`),
  UNIQUE KEY `username` (`username`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`key_user`, `name`, `username`, `password_hash`, `email`, `role`, `status`, `entry_date_time`, `update_date_time`, `phone`, `address`, `city`, `state`, `country`, `description`, `url`) VALUES
(1, 'NKA', 'admin', '$2y$10$NHIqSMqCvTKHb3iDWIA4je/hMEfCWCENb9Pjmm/tckm6gvYAIM0ry', 'admin123@example.com', 'admin', 'on', '2025-09-30 18:41:42', '2025-10-08 13:34:27', '', '123 ABC Street\r\nWoodbridge, VA', '', '', 'Pakistan', '', 'hello'),
(2, '', 'editor_jane', '$2y$10$ZxYkQeW9vXJzYq7gT1xE1eQvZz9YqU8gT1xE1eQvZz9YqU8gT1xE1e', 'jane@example.com', 'editor', 'on', '2025-09-30 18:41:42', '2025-09-30 18:41:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(3, '', 'viewer_ali', '$2y$10$ZxYkQeW9vXJzYq7gT1xE1eQvZz9YqU8gT1xE1eQvZz9YqU8gT1xE1e', 'ali@example.com', 'viewer', 'on', '2025-09-30 18:41:42', '2025-09-30 18:41:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL),
(4, 'Lady User', 'ladyuser', '$2y$10$bNMbu9PTVfkl4m.meX1Cgu2V9AcE7sEggdRcFHotoiyZWU26CUnzG', 'lady@mail.com', 'editor', 'on', '2025-09-30 19:02:19', '2025-10-05 05:39:06', '123456789148', 'Lady street.', 'Hashmi', 'Punjab', 'Pakistan', '', ''),
(5, '', 'newuser', '$2y$10$qLr7i4gCGtsM8Z1aJo.KGekV4JZujBGtx1Wbw6wRtKLwwb93lwL9q', 'newuser@gmail.com', 'editor', 'on', '2025-10-05 01:38:46', '2025-10-05 01:38:46', '', '', '', '', '', '', 'newuser'),
(6, 'Man User', 'manuser', '$2y$10$04LQ.ah/n/H9cRupn.fD6O5uzfjnVmIfK162xrXP.Os32hk9iDamu', 'manuser@outlook.com', 'viewer', 'on', '2025-10-05 05:40:46', '2025-10-07 16:31:56', '', '', '', '', '', '', 'manuser'),
(7, 'John Doe', 'johndoe', '$2y$10$oPtF/y5pnziuscR2Wd0V6.GVGjOyQL6LAEhFFR3YckMqETEK791Hy', 'johndoe@gmail.com', 'admin', 'on', '2025-10-05 05:43:21', '2025-10-05 05:43:21', '', '', '', '', '', '', 'john-doe');

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
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `youtube_categories`
--

INSERT INTO `youtube_categories` (`id`, `key_youtube_gallery`, `key_categories`, `url`) VALUES
(9, 7, 15, NULL),
(7, 7, 2, NULL),
(8, 7, 8, NULL),
(11, 9, 19, NULL),
(21, 10, 19, NULL),
(15, 11, 5, NULL),
(23, 12, 8, NULL),
(28, 8, 10, NULL),
(24, 12, 12, NULL),
(25, 12, 20, NULL),
(26, 13, 8, NULL),
(27, 13, 14, NULL),
(29, 8, 21, NULL),
(30, 14, 27, NULL),
(31, 15, 28, NULL),
(32, 16, 29, NULL),
(33, 17, 30, NULL);

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
  `status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entry_date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `updated_by` int(10) UNSIGNED DEFAULT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci DEFAULT NULL,
  PRIMARY KEY (`key_youtube_gallery`),
  KEY `fk_youtube_gallery_media` (`key_media_banner`)
) ENGINE=MyISAM AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `youtube_gallery`
--

INSERT INTO `youtube_gallery` (`key_youtube_gallery`, `key_media_banner`, `title`, `youtube_id`, `thumbnail_url`, `description`, `status`, `entry_date_time`, `created_by`, `updated_by`, `url`) VALUES
(14, 0, 'England vs South Africa - Highlights', 'mq4_JpV9qPc', '', '', 'on', '2025-10-10 16:50:47', 1, 1, 'england-vs-south-africa-highlights'),
(15, 0, 'Best Goals in Football', 'XKAV4qRIvJ8', '', '', 'on', '2025-10-10 16:54:57', 1, NULL, 'best-goals-in-football'),
(16, 0, 'The Big Swimming Race', 'bSc0ddvxoec', '', '', 'on', '2025-10-10 16:56:52', 1, NULL, 'the-big-swimming-race'),
(17, 0, 'Best Set of the Year', 'vel8ekZ8rTs', '', '', 'on', '2025-10-10 16:58:56', 1, NULL, 'best-set-of-the-year');

--
-- Indexes for dumped tables
--

--
-- Indexes for table `articles`
--
ALTER TABLE `articles` ADD FULLTEXT KEY `title` (`title`,`title_sub`,`content_type`,`article_snippet`,`article_content`);

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
-- Indexes for table `settings`
--
ALTER TABLE `settings` ADD FULLTEXT KEY `setting_key` (`setting_key`,`setting_value`);

--
-- Indexes for table `youtube_gallery`
--
ALTER TABLE `youtube_gallery` ADD FULLTEXT KEY `title` (`title`,`description`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
