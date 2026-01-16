-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Jan 16, 2026 at 01:06 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=44 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`key_articles`, `key_media_banner`, `document_code`, `title`, `title_sub`, `article_snippet`, `article_content`, `content_type`, `content_direction`, `book_indent_level`, `url`, `banner_image_url`, `sort`, `entry_date_time`, `update_date_time`, `created_by`, `updated_by`, `is_featured`, `show_on_home`, `show_in_listing`, `is_active`) VALUES
(2, 28, '', 'The Rise of Minimal CMS', 'Streamlined Editorial Tools', 'Exploring how minimal CMS platforms empower editorial teams.', 'Full content of article 1...', 'article', 'ltr', 0, 'minimal-cms', '', 1, '2025-09-25 18:11:28', '2026-01-16 04:31:27', 1, 1, 0, 1, 1, 1),
(3, 0, '', 'Designing for Editors', 'UI That Works', 'Why editorial-first design matters in publishing workflows.', 'Full content of article 2 3 4', 'article', 'ltr', 0, 'editorial-ui', '', 2, '2025-09-25 20:13:08', '2026-01-16 04:31:27', NULL, 1, 0, 1, 1, 1),
(4, 122, '', 'PHP Without Frameworks', 'Native Power', 'Building robust apps with native PHP and no frameworks.', 'Full content of article 3...', 'article', 'ltr', 1, 'php-native', '', 3, '2025-09-25 20:13:08', '2026-01-16 04:31:27', NULL, 1, 0, 1, 1, 1),
(5, 129, '', 'Modular CRUD Systems', 'Scalable Architecture', 'How modular CRUD design improves maintainability.', 'Full content of article 4...', 'article', 'ltr', 0, 'modular-crud', '', 4, '2025-09-25 18:11:36', '2026-01-16 04:31:27', NULL, 1, 1, 1, 1, 1),
(6, 123, '', 'Debounce in Search', 'Performance Boosts', 'Using debounce to optimize search-triggered loading.', 'Full content of article 5...', '', 'ltr', 0, 'debounce-search', '', 5, '2025-09-25 20:13:08', '2026-01-16 04:31:27', NULL, 1, 1, 1, 1, 1),
(7, 6, '', 'Pagination Patterns', 'Smart Loading', 'Best practices for implementing pagination in CMS.', 'Full content of article 6...', 'article', 'ltr', 0, 'pagination-patterns', '', 6, '2025-09-25 20:13:08', '2026-01-16 04:31:27', NULL, 1, 0, 1, 1, 1),
(8, 34, '', 'Editorial Workflows', 'From Draft to Publish', 'Mapping out efficient editorial workflows.', 'Full content of article 7...', '', 'ltr', 0, 'editorial-workflows', '', 7, '2025-09-25 20:13:08', '2026-01-16 04:31:27', NULL, 1, 0, 1, 1, 1),
(9, 30, '', 'Category Management', 'Organized Content', 'Tips for managing categories in publishing systems.', 'Full content of article 8...', 'article', 'ltr', 0, 'category-management', '', 8, '2025-09-25 20:13:08', '2026-01-16 04:31:27', NULL, 1, 0, 1, 1, 1),
(10, 121, '', 'Modal-Based Editing', 'Inline Efficiency', 'Using modals for quick article edits.', 'Full content of article 9...', '', 'ltr', 0, 'modal-editing', '', 9, '2025-09-25 20:13:08', '2026-01-16 04:31:27', NULL, 1, 0, 1, 1, 1),
(11, 125, '', 'Search Optimization', 'Fast & Relevant', 'Improving search relevance and speed.', 'Full content of article 10...', '', 'ltr', 0, 'search-optimization1', '', 10, '2025-09-25 20:13:08', '2026-01-16 04:31:27', NULL, 1, 0, 1, 1, 1),
(12, 0, '', 'Legacy CMS Refactor', 'Modernizing Systems', 'Strategies for refactoring legacy CMS platforms.', 'Full content of article 11...', '', 'ltr', 0, 'legacy-refactor', '', 11, '2025-09-25 20:13:08', '2026-01-16 04:31:27', NULL, 1, 0, 1, 1, 1),
(13, 0, '', 'Content Snippets', 'Reusable Blocks', 'Creating reusable content snippets.', 'Full content of article 12...', '', 'ltr', 0, 'content-snippets', 'banner12.jpg', 12, '2025-09-25 20:13:08', '2026-01-16 04:31:27', NULL, NULL, 0, 1, 1, 1),
(14, 0, '', 'Desktop-Only UI', 'Focused Design', 'Why desktop-first UI still matters.', 'Full content of article 13...', 'article', 'ltr', 0, 'desktop-ui2', '', 13, '2025-09-25 18:11:46', '2026-01-16 04:31:27', NULL, 1, 0, 1, 1, 1),
(15, 0, '', 'Error Reporting in PHP', 'Debugging Smartly', 'Enabling error reporting for better debugging.', 'Full content of article 14...', '', 'ltr', 0, 'php-errors', 'banner14.jpg', 14, '2025-09-25 20:13:08', '2026-01-16 04:31:27', NULL, NULL, 0, 1, 1, 1),
(16, 126, '', 'SQL Troubleshooting', 'Root Cause Isolation', 'Finding and fixing SQL issues.', 'Full content of article 15...', '', 'ltr', 0, 'sql-troubleshooting', '', 15, '2025-09-25 20:13:08', '2026-01-16 04:31:27', NULL, 1, 1, 1, 1, 1),
(17, 0, '', 'Advanced Filters', 'Precision Tools', 'Adding advanced filters to editorial tools.', 'Full content of article 16...', '', 'ltr', 0, 'advanced-filters', 'banner16.jpg', 16, '2025-09-25 20:13:08', '2026-01-16 04:31:27', NULL, NULL, 0, 1, 1, 1),
(18, 132, '', 'Scalable CMS Design', 'Future-Proofing', 'Designing CMS for long-term scalability.', 'Full content of article 17...', 'article', 'ltr', 0, 'scalable-cms', '', 17, '2025-09-25 18:11:54', '2026-01-16 04:31:27', NULL, 1, 0, 1, 1, 1),
(19, 0, '', 'Collaborative Development', 'Step-by-Step Builds', 'Working with feedback-driven development.', 'Full content of article 18...', '', 'ltr', 0, 'collab-dev', 'banner18.jpg', 18, '2025-09-25 20:13:08', '2026-01-16 04:31:27', NULL, NULL, 0, 1, 1, 1),
(20, 0, '', 'Clean Code Practices', 'Maintainable Systems', 'Writing clean, maintainable PHP.', 'Full content of article 19...', '', 'ltr', 0, 'clean-code', 'banner19.jpg', 19, '2025-09-25 20:13:08', '2026-01-16 04:31:27', NULL, NULL, 0, 1, 1, 1),
(21, 0, '', 'UI Feedback Loops', 'Iterative Design', 'Using feedback to refine UI.', 'Full content of article 20...', '', 'ltr', 0, 'ui-feedback', 'banner20.jpg', 20, '2025-09-25 20:13:08', '2026-01-16 04:31:27', NULL, NULL, 0, 1, 1, 1),
(22, 0, '', 'CMS Testing Strategies', 'Catch the Bugs', 'Testing CMS workflows effectively.', 'Full content of article 21...', '', 'ltr', 0, 'cms-testing', 'banner21.jpg', 21, '2025-09-25 20:13:08', '2026-01-16 04:31:27', NULL, NULL, 0, 1, 1, 1),
(23, 0, '', 'Content Assignment UX', 'Frictionless Flow', 'Improving article assignment UX.', 'Full content of article 22...', '', 'ltr', 0, 'assignment-ux', 'banner22.jpg', 22, '2025-09-25 20:13:08', '2026-01-16 04:31:27', NULL, NULL, 0, 1, 1, 1),
(24, 0, '', 'Banner Image Tips', 'Visual Impact', 'Choosing effective banner images.', 'Full content of article 23...', '', 'ltr', 0, 'banner-tips', '', 23, '2025-09-25 18:11:10', '2026-01-16 04:31:27', NULL, 1, 0, 1, 1, 1),
(25, 0, '', 'URL Structuring', 'SEO & Clarity', 'Structuring article URLs for clarity and SEO.', 'Full content of article 24...', 'article', 'ltr', 0, 'url-structure', '', 24, '2025-09-25 20:13:08', '2026-01-16 04:31:27', NULL, 1, 0, 1, 1, 1),
(26, 0, '', 'CMS Entry Points', 'Where It Begins', 'Designing intuitive entry points for editors.', 'Full content of article 25...', '', 'ltr', 0, 'cms-entry', 'banner25.jpg', 25, '2025-09-25 20:13:08', '2026-01-16 04:31:27', NULL, NULL, 0, 1, 1, 1),
(36, 113, '', 'True strength begins with self-awareness and the emotional connection', 'Living in a world of Stress, Anxiety and Depression', 'We live in a world where stress, anxiety and depression are becoming increasingly common. ', 'We live in a world where stress, anxiety and depression are becoming increasingly common.   ', 'article', 'ltr', 0, 'true-strength-begins-with-self-awareness-and-emotional-connection', '', 0, '2025-10-05 10:30:29', '2026-01-16 05:20:20', 1, 1, 0, 1, 1, 1),
(38, 122, '', 'PHP+MySQL Combination', 'How it Works', 'The PHP+MySQL combination is a classic and robust stack for building dynamic, data-driven web applications. It consists of two powerful, open-source technologies that work together to create interactive websites, from simple blogs to complex e-commerce platforms. \r\n', 'The PHP+MySQL combination is a classic and robust stack for building dynamic, data-driven web applications. It consists of two powerful, open-source technologies that work together to create interactive websites, from simple blogs to complex e-commerce platforms.\r\n\r\n<p style=\"font-family:Noto Nastaliq Urdu;direction:rtl\">\r\nâ€™â€™Ø«Ø±ÛŒØ§ Ø³Û’ Ø²Ù…ÛŒÚº Ù¾Ø± Ø¢Ø³Ù…Ø§Úº Ù†Û’ ÛÙ… Ú©Ùˆ Ø¯Û’ Ù…Ø§Ø±Ø§â€˜â€˜ Ø¯Ø±Ø§ØµÙ„ Ø§ÛŒÚ© Ø§Ø³ØªØ¹Ø§Ø±Ø§ØªÛŒ Ù…Ù†Ø¸Ø± ÛÛ’Û” Ø§Ù‚Ø¨Ø§Ù„ Ú¯ÙˆÛŒØ§ ÛŒÛ Ú©ÛÛ Ø±ÛÛ’ ÛÛŒÚº Ú©Û ÛÙ… Ø§Ù¾Ù†ÛŒ Ø¨Ù„Ù†Ø¯ÛŒ Ø³Û’ Ø®ÙˆØ¯ Ú¯Ø±Û’ Ù†ÛÛŒÚºØŒ Ø¨Ù„Ú©Û ØªÙ‚Ø¯ÛŒØ± Ù†Û’ ÛŒØ§ Ù‚Ø¯Ø±Øª Ú©Û’ ØªÚ©ÙˆÛŒÙ†ÛŒ Ù†Ø¸Ø§Ù… Ù†Û’ ÛÙ…ÛŒÚº ÛÙ…Ø§Ø±Û’ Ú©Ø±ØªÙˆØªÙˆÚº Ú©ÛŒ ÙˆØ¬Û Ø³Û’ Ø¯Ú¾Ú©ÛŒÙ„ Ø¯ÛŒØ§Û” ÛŒÛ â€™â€™Ø¯Û’ Ù…Ø§Ø±Ø§â€˜â€˜ Ù…Ø­Ø¶ Ø¬Ø³Ù…Ø§Ù†ÛŒ ØªÙ†Ø²Ù„ÛŒ Ù†ÛÛŒÚº Ø¨Ù„Ú©Û Ø§Ø®Ù„Ø§Ù‚ÛŒØŒ ÙÚ©Ø±ÛŒØŒ Ø±ÙˆØ­Ø§Ù†ÛŒ Ø§ÙˆØ± ØªÛØ°ÛŒØ¨ÛŒ Ø§Ù†Ø­Ø·Ø§Ø· Ú©ÛŒ Ø·Ø±Ù Ø§Ø´Ø§Ø±Û ÛÛ’Û”\r\n\r\n</p>\r\n\r\n<p>\r\nThe PHP + MySQL combination is a classic and robust stack for building dynamic, data-driven web applications. It consists of two powerful, open-source technologies that work together to create interactive websites, from simple blogs to complex e-commerce platforms.\r\n</p>\r\n\r\n<h2>How the Combination Works</h2>\r\n<p>\r\nThe interaction between PHP and MySQL is a server-side process, meaning most of the work happens on the web server before the user sees the final page.\r\n</p>\r\n\r\n<div class=\"flow-diagram\">\r\n<div class=\"step\">\r\n<h3>1. Request</h3>\r\n<p>A user\'s web browser sends an HTTP request for a page (e.g., <code>example.com/products.php</code>).</p>\r\n</div>\r\n<div class=\"step\">\r\n<h3>2. Processing (PHP)</h3>\r\n<p>The web server receives the request and executes the PHP script, which performs server-side tasks like processing user input, managing sessions, and building dynamic content.</p>\r\n</div>\r\n<div class=\"step\">\r\n<h3>3. Database Query (PHP + MySQL)</h3>\r\n<p>If data is needed, the PHP script connects to the MySQL database and sends a Structured Query Language (SQL) statement.</p>\r\n</div>\r\n<div class=\"step\">\r\n<h3>4. Database Response (MySQL)</h3>\r\n<p>MySQL processes the SQL query and returns the requested data to the PHP script.</p>\r\n</div>\r\n<div class=\"step\">\r\n<h3>5. Page Generation (PHP)</h3>\r\n<p>The PHP script uses the data from MySQL to generate a final HTML page.</p>\r\n</div>\r\n<div class=\"step\">\r\n<h3>6. Response</h3>\r\n<p>The web server sends the completed HTML page back to the user\'s browser, which then renders it for the user.</p>\r\n</div>\r\n</div>\r\n\r\n<h2>What Each Component Does</h2>\r\n\r\n<h3>PHP (Hypertext Preprocessor)</h3>\r\n<p>PHP is a server-side scripting language designed specifically for web development.</p>\r\n<ul>\r\n<li><b>Role:</b> Acts as the \"middleman,\" connecting the user\'s web browser with the database.</li>\r\n<li><b>Purpose:</b> Used for tasks that happen behind the scenes, such as:\r\n<ul>\r\n<li>Handling form submissions</li>\r\n<li>Communicating with the database</li>\r\n<li>Controlling user access</li>\r\n<li>Generating dynamic content</li>\r\n</ul>\r\n</li>\r\n</ul>\r\n\r\n<h3>MySQL</h3>\r\n<p>MySQL is an open-source relational database management system (RDBMS).</p>\r\n<ul>\r\n<li><b>Role:</b> Used for storing and managing data in a structured way.</li>\r\n<li><b>Purpose:</b> Organizes data into tables, columns, and rows, making it easy for PHP to perform CRUD (Create, Read, Update, Delete) operations.</li>\r\n</ul>\r\n\r\n<h2>How PHP Connects to MySQL</h2>\r\n<p>Modern PHP offers two primary extensions for connecting to a MySQL database:</p>\r\n<ul>\r\n<li>\r\n<b>MySQLi (\"MySQL improved\"):</b> An extension specific to MySQL databases that offers both procedural and object-oriented interfaces.\r\n</li>\r\n<li>\r\n<b>PDO (PHP Data Objects):</b> A versatile database abstraction layer that can work with over 12 different database systems, including MySQL.\r\n</li>\r\n</ul>\r\n<p>Both MySQLi and PDO support *prepared statements*, a security feature that helps prevent SQL injection attacks.</p>', 'translation', 'ltr', 0, 'phpmysql-combination', 'https://images.pexels.com/photos/18287652/pexels-photo-18287652.jpeg?cs=srgb&dl=pexels-fotios-photos-18287652.jpg&fm=jpg', 0, '2025-10-12 07:35:26', '2026-01-16 04:25:22', 1, 1, 1, 1, 1, 1),
(41, 0, '', 'Test 3', '', '', '', '', 'ltr', 0, 'test-3', '', 0, '2016-11-08 00:00:00', '2026-01-16 04:31:27', 1, NULL, 0, 1, 1, 1),
(43, 0, '', 'Ø§Ø±Ø¯Ùˆ Ù…Ø¶Ù…ÙˆÙ† Ø¹Ù†ÙˆØ§Ù†', 'Ø§Ø±Ø¯Ùˆ Ù…Ø¶Ù…ÙˆÙ† Ø°ÛŒÙ„ÛŒ Ø¹Ù†ÙˆØ§Ù† ', 'Ø§Ø±Ø¯Ùˆ Ù…Ø¶Ù…ÙˆÙ† Ù…Ø®ØªØµØ± Ø³Ù…Ø±ÛŒ', 'Ø§Ø±Ø¯Ùˆ Ù…Ø¶Ù…ÙˆÙ† ØªÙØµÛŒÙ„ÛŒ Ù…ÙˆØ§Ø¯ Ø§Ø±Ø¯Ùˆ Ù…Ø¶Ù…ÙˆÙ† ØªÙØµÛŒÙ„ÛŒ Ù…ÙˆØ§Ø¯ Ø§Ø±Ø¯Ùˆ Ù…Ø¶Ù…ÙˆÙ† ØªÙØµÛŒÙ„ÛŒ Ù…ÙˆØ§Ø¯ ', '', 'rtl', 0, 'urdu-mazmoon', '', 0, '2026-01-16 04:47:09', '2026-01-16 04:47:09', 1, NULL, 0, 1, 1, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=37 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `article_authors`
--

INSERT INTO `article_authors` (`id`, `key_articles`, `key_authors`, `article_work_label`) VALUES
(8, 34, 8, ''),
(9, 2, 5, ''),
(10, 33, 11, ''),
(11, 6, 13, ''),
(13, 9, 2, ''),
(14, 5, 6, ''),
(15, 7, 5, ''),
(16, 3, 9, ''),
(17, 36, 14, ''),
(21, 10, 11, ''),
(22, 4, 6, 'Contribution'),
(32, 8, 2, 'Contribution'),
(33, 8, 16, 'Editing'),
(34, 8, 14, 'Translation'),
(35, 38, 10, 'Editing'),
(36, 38, 5, 'Review');

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
) ENGINE=InnoDB AUTO_INCREMENT=261 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `article_categories`
--

INSERT INTO `article_categories` (`id`, `key_articles`, `key_categories`, `url`) VALUES
(3, 27, 4, NULL),
(4, 27, 19, NULL),
(7, 29, 6, NULL),
(8, 29, 8, NULL),
(9, 31, 19, NULL),
(10, 31, 5, NULL),
(11, 0, 5, NULL),
(12, 0, 16, NULL),
(23, 33, 19, NULL),
(24, 33, 8, NULL),
(25, 33, 14, NULL),
(43, 0, 2, NULL),
(44, 0, 15, NULL),
(45, 0, 4, NULL),
(57, 35, 18, NULL),
(63, 34, 1, NULL),
(178, 9, 13, NULL),
(181, 25, 13, NULL),
(182, 2, 13, NULL),
(184, 14, 13, NULL),
(187, 18, 13, NULL),
(188, 5, 13, NULL),
(196, 3, 23, NULL),
(197, 3, 11, NULL),
(198, 4, 5, NULL),
(199, 4, 9, NULL),
(200, 4, 14, NULL),
(218, 6, 8, NULL),
(219, 6, 18, NULL),
(250, 38, 13, NULL),
(251, 38, 4, NULL),
(258, 36, 13, NULL),
(259, 36, 4, NULL),
(260, 36, 6, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=192 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `article_content_types`
--

INSERT INTO `article_content_types` (`id`, `key_articles`, `key_content_types`, `url`) VALUES
(171, 39, 32, NULL),
(172, 39, 31, NULL),
(173, 40, 46, NULL),
(174, 40, 37, NULL),
(175, 2, 32, NULL),
(177, 14, 42, NULL),
(179, 24, 47, NULL),
(181, 18, 39, NULL),
(182, 5, 33, NULL),
(191, 38, 32, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=232 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `article_tags`
--

INSERT INTO `article_tags` (`id`, `key_articles`, `key_tags`, `url`) VALUES
(193, 43, 51, NULL),
(195, 3, 53, NULL),
(196, 4, 53, NULL),
(197, 8, 53, NULL),
(227, 38, 60, NULL),
(228, 38, 59, NULL),
(231, 36, 64, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=17 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`key_authors`, `name`, `email`, `phone`, `website`, `url`, `social_url_media1`, `social_url_media2`, `social_url_media3`, `city`, `state`, `country`, `banner_image_url`, `key_media_banner`, `description`, `is_active`, `entry_date_time`, `update_date_time`, `created_by`, `updated_by`) VALUES
(2, 'Amina Siddiqui', 'amina@contenthub.pk', '0300-1234567', 'https://aminasiddiqui.com', 'amina-siddiqui', 'https://twitter.com/aminasiddiqui', 'https://linkedin.com/in/aminasiddiqui', '', 'Karachi', 'Sindh', 'Pakistan', 'amina.jpg', 24, 'Amina writes on digital culture and editorial ethics.', 1, '2025-09-25 20:19:51', '2025-09-30 03:01:40', NULL, 1),
(3, 'Bilal Khan', 'bilal@techscribe.io', '0312-9876543', 'https://bilalkhan.dev', 'bilal-khan', 'https://github.com/bilalkhan', '', '', 'Lahore', 'Punjab', 'Pakistan', 'bilal.jpg', NULL, 'Bilal specializes in backend systems and CMS architecture.', 1, '2025-09-25 20:19:51', '2025-09-30 03:04:06', NULL, 1),
(4, 'Sana Raza', 'sana@designjournal.org', '0333-1122334', 'https://sanaraza.art', 'sana-raza', 'https://instagram.com/sanaraza', 'https://behance.net/sanaraza', '', 'Islamabad', 'Capital', 'Pakistan', 'sana.jpg', NULL, 'Sana explores editorial design and user experience.', 1, '2025-09-25 20:19:51', '2025-09-25 20:19:51', NULL, NULL),
(5, 'Imran Qureshi', 'imran@datawrite.net', '0345-9988776', 'https://imranqureshi.net', 'imran-qureshi', 'https://twitter.com/imranqureshi', '', '', 'Multan', 'Punjab', 'Pakistan', 'imran.jpg', NULL, 'Imran writes about data-driven journalism and content strategy.', 1, '2025-09-25 20:19:51', '2025-09-25 20:19:51', NULL, 1),
(6, 'Nida Farooq', 'nida@storycraft.pk', '0301-5566778', 'https://nidafarooq.com', 'nida-farooq', 'https://facebook.com/nidafarooq', 'https://linkedin.com/in/nidafarooq', '', 'Peshawar', 'KPK', 'Pakistan', 'nida.jpg', NULL, 'Nida focuses on narrative building and editorial workflows.', 1, '2025-09-25 20:19:51', '2025-09-25 20:19:51', NULL, NULL),
(7, 'Tariq Mehmood', 'tariq@codepen.pk', '0322-3344556', 'https://tariqmehmood.dev', 'tariq-mehmood', 'https://github.com/tariqmehmood', '', '', 'Faisalabad', 'Punjab', 'Pakistan', 'tariq.jpg', NULL, 'Tariq contributes on PHP optimization and modular design.', 1, '2025-09-25 20:19:51', '2025-09-25 20:19:51', NULL, NULL),
(8, 'Hina Javed', 'hina@uxpress.io', '0309-7788990', 'https://hinajaved.com', 'hina-javed', 'https://dribbble.com/hinajaved', 'https://linkedin.com/in/hinajaved', '', 'Rawalpindi', 'Punjab', 'Pakistan', 'hina.jpg', NULL, 'Hina writes about UX patterns and editorial tooling.', 1, '2025-09-25 20:19:51', '2025-09-25 20:19:51', NULL, NULL),
(9, 'Zeeshan Ali', 'zeeshan@devjournal.pk', '0315-6677889', 'https://zeeshanali.dev', 'zeeshan-ali', 'https://twitter.com/zeeshanali', '', '', 'Hyderabad', 'Sindh', 'Pakistan', 'zeeshan.jpg', NULL, 'Zeeshan covers CMS performance and SQL tuning.', 1, '2025-09-25 20:19:51', '2025-09-25 20:19:51', NULL, NULL),
(10, 'Fatima Noor', 'fatima@contentgrid.io', '0331-4455667', 'https://fatimanoor.com', 'fatima-noor', 'https://instagram.com/fatimanoor', 'https://linkedin.com/in/fatimanoor', '', 'Quetta', 'Balochistan', 'Pakistan', 'fatima.jpg', 0, 'Fatima writes on editorial workflows and content curation.', 1, '2025-09-25 20:19:51', '2025-09-25 20:19:51', NULL, 1),
(11, 'Usman Rafiq', 'usman@editorialtech.pk', '0340-2233445', 'https://usmanrafiq.dev', 'usman-rafiq', 'https://github.com/usmanrafiq', '', '', 'Sialkot', 'Punjab', 'Pakistan', 'usman.jpg', NULL, 'Usman focuses on scalable CMS and editorial automation.', 1, '2025-09-25 20:19:51', '2025-09-25 20:19:51', NULL, NULL),
(12, 'Haseena Imtiaz', 'haseenaimtiaz@gmail.com', '123-456-7848', '', 'haseena-imtiaz', '', '', '', '', '', '', '', 35, '', 1, '2025-10-01 22:23:56', '2025-10-01 22:23:56', NULL, 1),
(13, 'Sumrina Khan', 'sumrinakhan@hotmail.com', '548-455-5548', '', '', '', '', '', '', '', '', '', NULL, '', 1, '2025-10-01 22:26:39', '2025-10-01 22:26:39', 1, NULL),
(14, 'Taimur Sarfaraz', 'taimursarfaraz@gmail.com', '', '', 'tamir-sarfaraz-ahmad', '', '', '', 'Karachi', '', '', '', 0, 'What is Lorem Ipsum?\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nWhy do we use it?\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 1, '2025-10-05 10:09:57', '2025-10-05 10:09:57', 1, 1),
(16, 'Ikram Mughal', '', '', '', 'ikram-mughal', '', '', '', '', '', '', '', 112, 'What is Lorem Ipsum?\r\nLorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry\'s standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled it to make a type specimen book. It has survived not only five centuries, but also the leap into electronic typesetting, remaining essentially unchanged. It was popularised in the 1960s with the release of Letraset sheets containing Lorem Ipsum passages, and more recently with desktop publishing software like Aldus PageMaker including versions of Lorem Ipsum.\r\n\r\nWhy do we use it?\r\nIt is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using \'Content here, content here\', making it look like readable English. Many desktop publishing packages and web page editors now use Lorem Ipsum as their default model text, and a search for \'lorem ipsum\' will uncover many web sites still in their infancy. Various versions have evolved over the years, sometimes by accident, sometimes on purpose (injected humour and the like).', 1, '2025-10-12 12:54:52', '2025-10-12 12:54:52', 1, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`key_blocks`, `key_media_banner`, `key_photo_gallery`, `key_content_types`, `key_categories`, `key_tags`, `module_file`, `block_name`, `title`, `css`, `number_of_records`, `visible_on`, `block_content`, `show_on_pages`, `show_in_region`, `entry_date_time`, `created_by`, `updated_by`, `sort`, `is_dynamic`, `is_active`) VALUES
(1, 0, 0, 0, 0, 0, 'authors_91558', 'Authors', 'Authors', '', 5, 'large-desktop,desktop,tablet', '', '', 'sidebar_right', '2025-09-30 03:09:45', 0, 1, 9, 0, 1),
(2, 0, 0, 0, 0, 0, 'photos_56467', 'Photo Galleries', 'Photo Gallery', '', 5, 'large-desktop,desktop,tablet', '', '', 'sidebar_right', '2025-09-24 08:58:17', 0, 1, 7, 0, 1),
(3, 0, 0, 0, 0, 0, 'youtube_15578', 'YouTube Gallery', 'Youtube Gallery', '', 5, 'large-desktop,desktop,tablet', '', '', 'sidebar_right', '2025-09-24 08:58:23', 0, 1, 6, 0, 1),
(4, 0, 0, 0, 0, 0, 'articles_34548', 'Latest Articles', 'Articles', '', 5, 'large-desktop,desktop,tablet', '', '', 'sidebar_right', '2025-09-30 03:10:15', 0, 1, 4, 0, 1),
(5, 0, 0, 0, 0, 0, 'books_84538', 'Latest Books', 'Books', '', 5, 'large-desktop,desktop,tablet', '', '', 'sidebar_right', '2025-10-01 22:49:57', 1, 1, 5, 0, 1),
(6, 0, 0, 0, 0, 0, 'categories_55448', 'Categories', 'Topics', '', 10, 'large-desktop,desktop,tablet', '', '', 'sidebar_right', '2025-10-08 14:37:28', 1, 1, 2, 0, 1),
(8, 0, 0, 0, 0, 0, '', 'Copyright Message', '', '', 0, 'large-desktop,desktop,tablet,mobile', '<div style=\'text-align:center;\'><a href=\"/page/privacy-policy\">Privacy Policy</a> | <a href=\"/page/terms-of-use\">Term of Use</a> â€” Default Template Â© Powered by CopilotCMS </div>', '', 'footer', '2025-10-10 18:40:38', 1, 1, 12, 0, 1),
(9, 0, 0, 0, 0, 0, '', 'Phone Email', '', '', 0, 'large-desktop,desktop,tablet,mobile', '<span>Phone</span><a href=\"tel:1234567890\">(123)456-7890</a>\r\n<span>Email</span><a href=\"mailto:myemail@outlook.com\">myemail@outlook.com</a>', '', 'above_header', '2025-10-10 19:47:52', 1, 1, 0, 0, 0),
(12, 0, 33, 0, 0, 0, 'photo_gallery_carousel_5645645', 'Image Slideshow Home', '', '', 0, 'large-desktop,desktop,tablet,mobile', '', 'home', 'below_header', '2025-10-13 23:11:01', 1, 1, 11, 0, 1),
(14, 0, 29, 0, 0, 0, 'photo_gallery_carousel_5645645', 'Image Slideshow Articles', '', '', 0, 'large-desktop,desktop,tablet,mobile', '', 'articles', 'below_header', '2025-10-15 00:25:45', 1, 1, 0, 0, 1),
(15, 0, 30, 0, 0, 0, 'photo_gallery_carousel_5645645', 'Image Slideshow Categories', '', '', 0, 'large-desktop,desktop,tablet,mobile', '', 'categories', 'below_header', '2025-10-15 00:28:00', 1, 1, 0, 0, 1),
(16, 0, 31, 0, 0, 0, 'photo_gallery_carousel_5645645', 'Image Slideshow Books', '', '', 0, 'large-desktop,desktop,tablet,mobile', '', 'books', 'below_header', '2025-10-15 00:30:41', 1, 1, 0, 0, 1),
(17, 0, 32, 0, 0, 0, 'photo_gallery_carousel_5645645', 'Image Slideshow Authors', '', '', 0, 'large-desktop,desktop,tablet,mobile', '', 'authors', 'below_header', '2025-10-17 00:58:45', 1, 1, 0, 0, 1),
(18, 0, 34, 0, 0, 0, 'photo_gallery_carousel_5645645', 'Sidebar Books to Check', 'Block Title', '', 0, 'large-desktop,desktop,tablet,mobile', 'Block Content', '', 'sidebar_left', '2025-10-17 10:22:11', 1, 1, 0, 0, 1),
(19, 0, 0, 0, 0, 0, 'search6545645', 'Search Block', 'Search', '', 5, 'large-desktop,desktop,tablet,mobile', '', '', 'sidebar_left', '2025-10-28 21:02:04', 1, 1, -1, 0, 1),
(20, 0, 0, 0, 0, 0, 'content_types_55448', 'Content Types', 'Content Types', '', 5, 'large-desktop,desktop,tablet,mobile', '', '', 'sidebar_right', '2025-11-04 00:07:23', 1, 1, 1, 0, 1),
(21, 0, 0, 0, 0, 0, 'tags_55448', 'Tags', 'Tags', '', 5, 'large-desktop,desktop,tablet,mobile', '', '', 'sidebar_right', '2025-11-04 17:06:47', 1, 1, 3, 0, 1),
(22, 0, 0, 0, 0, 0, 'articles_featured_544678786', 'Featured Articles', '', 'height:300px;', 5, 'large-desktop,desktop,tablet,mobile', '', '', 'above_content', '2025-11-14 18:15:04', 1, 1, 0, 0, 1),
(23, 0, 0, 0, 0, 53, 'articles_of_tag565786548', 'Tag \'Ireland\' ', 'Ireland Articles', '', 0, 'large-desktop,desktop,tablet,mobile', '', '', 'sidebar_left', '2025-11-17 10:26:47', 1, 1, 4, 0, 1),
(24, 0, 0, 39, 0, 0, 'articles_of_content_type565786548', 'Content Type \'Interview\' ', 'Interview Articles', '', 0, 'large-desktop,desktop,tablet,mobile', '', '', 'sidebar_left', '2025-11-17 10:48:23', 1, 1, 6, 0, 1),
(25, 0, 0, 0, 6, 0, 'articles_of_categories565786548', 'Category \'Content Strategy\' ', 'Content Strategy Articles', '', 0, 'large-desktop,desktop,tablet,mobile', '', '', 'sidebar_left', '2025-11-17 10:54:31', 1, 1, 6, 0, 1),
(26, 0, 0, 0, 0, 0, 'months_recent4456787818', 'Yearly > Monthly Archive', 'Archive', '', 0, 'large-desktop,desktop,tablet,mobile', '', '', 'sidebar_left', '2025-11-27 20:59:22', 1, 0, 16, 0, 1),
(29, 0, 0, 0, 0, 0, 'articles_random5468741', 'Random Articles', 'Random Articles', '', 10, 'large-desktop,desktop,tablet,mobile', '', '', 'sidebar_left', '2025-12-12 23:39:18', 1, 1, 0, 1, 1),
(30, 0, 0, 0, 0, 0, 'articles_random5468741', 'Article Random', 'Articles Random', '', 7, 'large-desktop,desktop,tablet,mobile', '', '', 'sidebar_right', '2025-12-13 12:25:30', 1, 1, 0, 1, 1),
(31, 0, 0, 0, 0, 0, 'local_weather_time_89465465468', 'Local Weather Time', '', '', 5, 'large-desktop,desktop,tablet,mobile', '', '', 'above_header', '2025-12-15 13:21:08', 1, 0, 0, 0, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=63 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`key_books`, `key_media_banner`, `title`, `subtitle`, `description`, `banner_image_url`, `url`, `author_name`, `publisher`, `publish_year`, `isbn`, `is_featured`, `language`, `format`, `weight_grams`, `sku`, `is_active`, `sort`, `entry_date_time`, `update_date_time`, `created_by`, `updated_by`) VALUES
(2, 0, 'Designing Editorial Syste', 'Workflow & UX', 'A guide to building editorial systems that balance structure with usability.', 'https://images.pexels.com/photos/46216/sunflower-flowers-bright-yellow-46216.jpeg', 'designing-editorial-systems', 'Amina Siddiqui', 'ContentHub Press', '2021', '978-969-0010011', 0, 'Urdu', 'Cover', 0, '', 1, 1, '2025-09-25 20:23:27', '2025-10-16 12:17:50', NULL, 1),
(3, 0, 'PHP for Publisher', 'Backend Essentials', 'Explores PHP techniques tailored for publishing platforms.', 'cover2.jpg', 'php-for-publishers', 'Bilal Khan', 'TechScribe Books', '2020', '978-969-0010012', 0, '', '', 0, '', 1, 2, '2025-09-25 20:23:27', '2025-10-16 12:15:47', NULL, 1),
(4, 126, 'Modular CMS Architecture', 'Scalable Design Through Separation of Concern', 'Strategies for designing modular, maintainable CMS systems.', '', 'modular-cms-architecture', 'Tariq Mehmood', 'CodePen Publishing', '2022', '978-969-0010013', 0, '', '', 0, '', 1, 3, '2025-09-25 20:23:27', '2025-10-22 07:00:53', NULL, 1),
(5, NULL, 'Editorial UX Patterns', 'Designing for Editors', 'Patterns and principles for editorial-first user interfaces.', 'cover4.jpg', 'editorial-ux-patterns', 'Sana Raza', 'DesignJournal Books', '2021', '978-969-0010014', 0, '', '', 0, '', 1, 4, '2025-09-25 20:23:27', '2025-09-30 03:08:39', NULL, NULL),
(6, NULL, 'CMS Debugging Handbook', 'Troubleshooting PHP & SQL', 'A practical guide to debugging CMS workflows.', 'cover5.jpg', 'cms-debugging-handbook', 'Imran Qureshi', 'DataWrite Publishing', '2019', '978-969-0010015', 0, '', '', 0, '', 1, 5, '2025-09-25 20:23:27', '2025-09-28 21:14:44', NULL, NULL),
(7, NULL, 'Content Strategy in Practice', 'Editorial Planning', 'Real-world strategies for content planning and execution.', 'cover6.jpg', 'content-strategy-practice', 'Nida Farooq', 'StoryCraft Books', '2023', '978-969-0010016', 0, 'Urdu', 'Hard', 0, '', 1, 6, '2025-09-25 20:23:27', '2025-09-28 21:12:12', NULL, NULL),
(8, NULL, 'Scalable Publishing Systems', 'Future-Proof CMS', 'Designing CMS platforms that grow with editorial needs.', 'cover7.jpg', 'scalable-publishing-systems', 'Usman Rafiq', 'EditorialTech Press', '2022', '978-969-0010017', 0, '', '', 0, '', 1, 7, '2025-09-25 20:23:27', '2025-09-26 23:45:53', NULL, NULL),
(9, NULL, 'Clean Code for Editors', 'Maintainable PHP', 'Writing clean, maintainable code for editorial tools.', 'cover8.jpg', 'clean-code-editors', 'Bilal Khan', 'TechScribe Books', '2021', '978-969-0010018', 0, '', '', 0, '', 1, 8, '2025-09-25 20:23:27', '2025-10-05 19:00:04', NULL, 1),
(10, NULL, 'Visual Content Design', 'Banner & Layouts', 'Designing impactful visuals for editorial platforms.', 'cover9.jpg', 'visual-content-design', 'Hina Javed', 'UXPress Publishing', '2020', '978-969-0010019', 0, '', '', 0, '', 1, 9, '2025-09-25 20:23:27', '2025-09-28 21:10:45', NULL, NULL),
(11, NULL, 'Advanced CMS Filters', 'Precision Tools', 'Implementing advanced filters for editorial workflows.', 'cover10.jpg', 'advanced-cms-filters', 'Zeeshan Ali', 'DevJournal Books', '2023', '978-969-0010020', 0, '', '', 0, '', 1, 10, '2025-09-25 20:23:27', '2025-09-26 23:45:53', NULL, NULL),
(12, NULL, 'Narrative Building', 'Storytelling in Publishing', 'Techniques for building compelling editorial narratives.', 'cover11.jpg', 'narrative-building', 'Fatima Noor', 'ContentGrid Press', '2021', '978-969-0010021', 0, '', '', 0, '', 1, 11, '2025-09-25 20:23:27', '2025-09-26 23:45:53', NULL, NULL),
(13, NULL, 'SEO for Editorial Teams', 'URL & Structure', 'Optimizing editorial content for search engines.', 'cover12.jpg', 'seo-editorial-teams', 'Usman Rafiq', 'EditorialTech Press', '2020', '978-969-0010022', 0, '', '', 0, '', 1, 12, '2025-09-25 20:23:27', '2025-09-26 23:45:53', NULL, NULL),
(14, NULL, 'CMS Testing Toolkit', 'QA for Editors', 'Testing strategies for editorial CMS workflows.', 'cover13.jpg', 'cms-testing-toolkit', 'Imran Qureshi', 'DataWrite Publishing', '2022', '978-969-0010023', 0, '', '', 0, '', 1, 13, '2025-09-25 20:23:27', '2025-09-26 23:45:53', NULL, NULL),
(15, NULL, 'Collaborative Publishing', 'Team-Based CMS', 'Building CMS systems for collaborative editorial teams.', 'cover14.jpg', 'collaborative-publishing', 'Nida Farooq', 'StoryCraft Books', '2023', '978-969-0010024', 0, '', '', 0, '', 1, 14, '2025-09-25 20:23:27', '2025-09-26 23:45:53', NULL, NULL),
(16, NULL, 'Desktop-First UI Design', 'Focused Editorial Tools', 'Why desktop-first design still matters in publishing.', 'cover15.jpg', 'desktop-ui-design', 'Sana Raza', 'DesignJournal Books', '2021', '978-969-0010025', 0, '', '', 0, '', 1, 15, '2025-09-25 20:23:27', '2025-09-26 23:45:53', NULL, NULL),
(58, 0, 'New World of App Dev with A-I', 'Speed up the Process 10x', '', '', 'new-world-of-app-dev-with-ai', 'Dean Mo', 'Copilot', '2025', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2025-09-30 18:31:13', '2025-10-16 12:12:34', NULL, 1),
(59, 0, 'PHP for Non Publisher', '', '', '', 'php-for-non-publishers', '', 'Hello Pubs', '', NULL, NULL, NULL, NULL, NULL, NULL, 1, 0, '2025-10-01 22:54:52', '2025-10-16 12:09:58', 1, 1),
(62, 119, 'Pink Flowers in the World', '', '', 'https://images.pexels.com/photos/4069088/pexels-photo-4069088.jpeg?cs=srgb&dl=pexels-bilakis-4069088.jpg&fm=jpg', 'pink-flowers-in-the-world', '', '', '', '', NULL, '', '', 0, '0', 1, 0, '2025-10-08 13:24:50', '2025-11-16 10:06:03', 1, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `book_articles`
--

INSERT INTO `book_articles` (`key_book_articles`, `key_books`, `key_articles`, `sort_order`) VALUES
(4, 1, 1, 0),
(9, 5, 7, 0),
(10, 5, 10, 0),
(11, 5, 21, 0),
(12, 5, 24, 0),
(25, 7, 8, 0),
(30, 4, 3, 0),
(31, 4, 4, 0),
(32, 4, 7, 0),
(39, 3, 1, 0),
(40, 3, 3, 0),
(41, 3, 24, 0),
(42, 3, 9, 0),
(43, 2, 6, 0),
(44, 2, 11, 0),
(45, 62, 22, 0);

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
) ENGINE=InnoDB AUTO_INCREMENT=107 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `book_categories`
--

INSERT INTO `book_categories` (`id`, `key_books`, `key_categories`, `url`) VALUES
(17, 29, 0, NULL),
(18, 31, 0, NULL),
(19, 35, 5, NULL),
(20, 35, 8, NULL),
(23, 40, 19, NULL),
(24, 48, 2, NULL),
(25, 48, 8, NULL),
(26, 48, 17, NULL),
(27, 49, 2, NULL),
(28, 49, 8, NULL),
(29, 49, 17, NULL),
(37, 50, 3, NULL),
(38, 50, 5, NULL),
(40, 0, 9, NULL),
(41, 0, 11, NULL),
(42, 51, 3, NULL),
(43, 51, 15, NULL),
(44, 53, 3, NULL),
(45, 53, 15, NULL),
(46, 55, 3, NULL),
(47, 55, 15, NULL),
(48, 57, 3, NULL),
(49, 57, 15, NULL),
(64, 0, 5, NULL),
(73, 0, 10, NULL),
(75, 64, 9, NULL),
(76, 65, 9, NULL),
(87, 58, 1, NULL),
(88, 58, 14, NULL),
(90, 3, 15, NULL),
(93, 2, 8, NULL),
(94, 2, 12, NULL),
(99, 59, 11, NULL),
(106, 62, 9, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=31 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`key_categories`, `key_media_banner`, `name`, `description`, `url`, `banner_image_url`, `sort`, `is_active`, `entry_date_time`, `category_type`) VALUES
(1, 0, 'Education', '', 'category/education', '', 1, 1, '2025-09-24 01:20:39', 'article'),
(2, 0, 'Editorial Design', 'Design principles tailored for editorial platforms.', 'editorial-design', '', 1, 1, '2025-09-25 20:25:13', 'global'),
(3, 0, 'CMS Architecture', 'Structural and modular design of content systems.', 'cms-architecture', '', 2, 1, '2025-09-25 20:25:13', 'global'),
(4, 0, 'PHP Development', 'Native PHP techniques for backend publishing tools.', 'php-development', '', 3, 1, '2025-09-25 20:25:13', 'global'),
(5, 0, 'UX Patterns', 'User experience strategies for editorial workflows.', 'ux-patterns1', '', 4, 1, '2025-09-25 20:25:13', 'book'),
(6, 0, 'Content Strategy', 'Planning and organizing editorial content.', 'content-strategy', '', 5, 1, '2025-09-25 20:25:13', 'global'),
(7, 0, 'Debugging & QA', 'Troubleshooting and testing publishing systems.', 'debugging-qa', '', 6, 1, '2025-09-25 20:25:13', 'book'),
(8, 0, 'Search Optimization', 'Improving search relevance and performance.', 'search-optimization', '', 7, 1, '2025-09-25 20:25:13', 'global'),
(9, 0, 'Modular Design', 'Reusable components and scalable architecture.', 'modular-design', '', 8, 1, '2025-09-25 20:25:13', 'global'),
(10, 3, 'Visual Design', 'Banner images, layout, and visual storytelling.', 'visual-design', '', 9, 1, '2025-09-25 20:25:13', 'global'),
(11, 0, 'Publishing Workflow', 'From draft to publish editorial flow management.', 'publishing-workflow', '', 10, 1, '2025-09-25 20:25:13', 'global'),
(12, 0, 'Database Tuning', 'Optimizing SQL queries and schema for CMS.', 'database-tuning', '', 11, 1, '2025-09-25 20:25:13', 'global'),
(13, 0, 'SEO & URLs', 'Structuring URLs and metadata for search engines.', 'seo-urls', '', 12, 1, '2025-09-25 20:25:13', 'article'),
(14, 0, 'Team Collaboration', 'Tools and practices for editorial teamwork.', 'team-collaboration', '', 13, 1, '2025-09-25 20:25:13', 'global'),
(15, 0, 'Desktop UI', 'Designing for desktop-first editorial tools.', 'desktop-ui', '', 14, 1, '2025-09-25 20:25:13', 'global'),
(16, 0, 'Content Curation', 'Selecting and organizing high-quality content.', 'content-curation', '', 15, 1, '2025-09-25 20:25:13', 'global'),
(17, 0, 'Performance Optimization', 'Speed and efficiency in CMS systems.', 'performance-optimization', '', 16, 1, '2025-09-25 20:25:13', 'global'),
(18, 123, 'Advanced Filters', 'Precision filtering tools for editors.', 'advanced-filter', 'https://images.pexels.com/photos/2120614/pexels-photo-2120614.jpeg?cs=srgb&dl=pexels-padrinan-2120614.jpg&fm=jpg', 17, 1, '2025-09-25 20:25:13', 'global'),
(19, 0, 'Legacy Systems', 'Modernizing and refactoring old CMS platforms.', 'legacy-systems-legacy', '', 18, 1, '2025-09-25 20:25:13', 'global'),
(20, 0, 'Narrative Building', 'Crafting compelling editorial stories.', 'narrative-building', '', 19, 1, '2025-09-25 20:25:13', 'global'),
(21, 0, 'Editorial Automation', 'Automating repetitive editorial tasks.', 'editorial-automation', '', 20, 1, '2025-09-25 20:25:13', 'global'),
(23, 13, 'Modern Architecture', '', 'modern-architecture', '', 0, 1, '2025-10-10 12:48:30', 'photo_gallery'),
(24, 0, 'Ancient Heritage', '', 'ancient-heritage', '', 0, 1, '2025-10-10 12:49:31', 'photo_gallery'),
(25, 0, 'Educational Institutions', '', 'educational-institutions', '', 0, 1, '2025-10-10 12:49:53', 'photo_gallery'),
(26, 0, 'Tourism Attractions', '', 'tourism-attractions', '', 0, 1, '2025-10-10 12:50:36', 'photo_gallery'),
(27, 0, 'Cricket', '', 'cricket', '', 0, 1, '2025-10-10 16:51:49', 'video_gallery'),
(28, 24, 'Soccer', '', 'soccer', '', 0, 1, '2025-10-10 16:51:57', 'video_gallery'),
(29, 0, 'Swimming', '', 'swimming', '', 0, 1, '2025-10-10 16:52:31', 'video_gallery'),
(30, 0, 'Tennis', '', 'tennis', '', 0, 1, '2025-10-10 16:52:52', 'video_gallery');

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
) ENGINE=InnoDB AUTO_INCREMENT=51 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `content_types`
--

INSERT INTO `content_types` (`key_content_types`, `key_media_banner`, `name`, `description`, `url`, `banner_image_url`, `sort`, `is_active`, `entry_date_time`) VALUES
(31, 0, 'Opinion', '', 'opinion', '', 0, 1, '2025-11-03 20:42:59'),
(32, 0, 'Article', '', 'article', '', 0, 1, '2025-11-03 20:43:44'),
(33, 0, 'Blog Post', '', 'blog-post', '', 0, 1, '2025-11-03 20:43:56'),
(34, 0, 'News Release', '', 'news-release', '', 0, 1, '2025-11-03 20:44:06'),
(35, 0, 'News Report', '', 'news-report', '', 0, 1, '2025-11-03 20:44:15'),
(36, 0, 'Translation', '', 'translation', '', 0, 1, '2025-11-03 20:44:23'),
(37, 0, 'Transcript', '', 'transcript', '', 0, 1, '2025-11-03 20:44:32'),
(39, 0, 'Interview', '', 'interview', '', 0, 1, '2025-11-03 20:44:48'),
(40, 0, 'Q&A', '', 'question-answer', '', 0, 1, '2025-11-03 20:48:50'),
(41, 0, 'FAQs', '', 'faqs', '', 0, 1, '2025-11-03 20:49:05'),
(42, 0, 'Review', '', 'review', '', 0, 1, '2025-11-03 20:49:27'),
(43, 0, 'Announcement', '', 'announcement', '', 0, 1, '2025-11-03 20:49:40'),
(44, 0, 'Event', '', 'event', '', 0, 1, '2025-11-03 20:49:47'),
(45, 0, 'Guide', '', 'guide', '', 0, 1, '2025-11-03 20:49:54'),
(46, 0, 'Biography', '', 'biography', '', 0, 1, '2025-11-03 20:50:15'),
(47, 0, 'Profile', '', 'profile', '', 0, 1, '2025-11-03 20:50:22'),
(48, 0, 'Editorial', '', 'editorial', '', 0, 1, '2025-11-03 20:50:32'),
(49, 0, 'Breaking', '', 'breaking', '', 0, 1, '2025-11-03 20:50:39'),
(50, 0, 'Featured', '', 'featured', '', 0, 1, '2025-11-03 20:50:48');

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
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `fonts`
--

INSERT INTO `fonts` (`key_fonts`, `font_label`, `file_name`) VALUES
(11, 'Alqalam', 'Alqalam_1766253707.ttf');

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
  `is_active` tinyint(1) DEFAULT '1',
  `entry_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_main_menu`)
) ENGINE=InnoDB AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `main_menu`
--

INSERT INTO `main_menu` (`key_main_menu`, `parent_id`, `title`, `url_link`, `sort`, `is_active`, `entry_date_time`) VALUES
(12, 0, 'Home', '/home', 0, 1, '2025-10-09 10:23:01'),
(13, 0, 'Articles', '/articles', 1, 1, '2025-10-09 10:23:15'),
(14, 0, 'Topics', '/categories', 2, 1, '2025-10-09 10:23:33'),
(15, 0, 'Books', '/books', 3, 1, '2025-10-09 10:23:50'),
(16, 0, 'Authors', '/authors', 4, 1, '2025-10-09 15:12:54'),
(17, 0, 'Albums', '/photo-gallery', 5, 1, '2025-10-09 15:14:12'),
(18, 0, 'Youtube', '/youtube-gallery', 6, 1, '2025-10-09 15:15:01'),
(19, 0, 'Info', '/pages', 5, 1, '2025-10-09 15:15:38'),
(20, 19, 'About Us', '/page/about-us', 0, 1, '2025-10-10 19:03:19'),
(21, 19, 'Careers', '/page/careers', 0, 1, '2025-10-10 19:03:34');

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
) ENGINE=InnoDB AUTO_INCREMENT=133 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `media_library`
--

INSERT INTO `media_library` (`key_media`, `file_url`, `file_url_thumbnail`, `file_type`, `alt_text`, `tags`, `uploaded_by`, `entry_date_time`) VALUES
(101, '/media/images/2025/1760632521_pexels-ingo-609768.jpg', '/media/thumbnails/images/2025/1760632521_pexels-ingo-609768.jpg', 'images', '', 'tags', 1, '2025-10-16 21:35:22'),
(102, '/media/images/2025/1760632762_0_pexels-polina-kovaleva-5828620.jpg', '/media/thumbnails/images/2025/1760632762_0_pexels-polina-kovaleva-5828620.jpg', 'images', '', 'author', 1, '2025-10-16 21:39:23'),
(103, '/media/images/2025/1760632763_1_pexels-kampus-8430295.jpg', '/media/thumbnails/images/2025/1760632763_1_pexels-kampus-8430295.jpg', 'images', '', 'author', 1, '2025-10-16 21:39:24'),
(104, '/media/images/2025/1760632764_2_pexels-cup-of-couple-7657607.jpg', '/media/thumbnails/images/2025/1760632764_2_pexels-cup-of-couple-7657607.jpg', 'images', '', 'author', 1, '2025-10-16 21:39:25'),
(105, '/media/images/2025/1760632765_3_pexels-fotios-photos-851213.jpg', '/media/thumbnails/images/2025/1760632765_3_pexels-fotios-photos-851213.jpg', 'images', '', 'author', 1, '2025-10-16 21:39:26'),
(106, '/media/images/2025/1760637341_0_pexels-negativespace-34658.jpg', '/media/thumbnails/images/2025/1760637341_0_pexels-negativespace-34658.jpg', 'images', '', 'page', 1, '2025-10-16 22:55:42'),
(107, '/media/images/2025/1760637342_1_pexels-junjira-konsang-31613677-9029751.jpg', '/media/thumbnails/images/2025/1760637342_1_pexels-junjira-konsang-31613677-9029751.jpg', 'images', '', 'page', 1, '2025-10-16 22:55:43'),
(108, '/media/images/2025/1760637343_2_pexels-freephotos-64776.jpg', '/media/thumbnails/images/2025/1760637343_2_pexels-freephotos-64776.jpg', 'images', '', 'page', 1, '2025-10-16 22:55:44'),
(109, '/media/images/2025/1760637344_3_pexels-karolina-grabowska-4195330.jpg', '/media/thumbnails/images/2025/1760637344_3_pexels-karolina-grabowska-4195330.jpg', 'images', '', 'page', 1, '2025-10-16 22:55:45'),
(110, '/media/images/2025/1760637345_4_pexels-goumbik-317355.jpg', '/media/thumbnails/images/2025/1760637345_4_pexels-goumbik-317355.jpg', 'images', '', 'page', 1, '2025-10-16 22:55:46'),
(111, '/media/images/2025/1760637346_5_pexels-mohammad-danish-290641-891059.jpg', '/media/thumbnails/images/2025/1760637346_5_pexels-mohammad-danish-290641-891059.jpg', 'images', '', 'page', 1, '2025-10-16 22:55:47'),
(112, '/media/images/2025/1760643493_0_pexels-nappy-935979.jpg', '/media/thumbnails/images/2025/1760643493_0_pexels-nappy-935979.jpg', 'images', '', 'newspaper', 1, '2025-10-17 00:38:14'),
(113, '/media/images/2025/1760643494_1_pexels-jimmy-liao-3615017-12392803.jpg', '/media/thumbnails/images/2025/1760643494_1_pexels-jimmy-liao-3615017-12392803.jpg', 'images', '', 'newspaper', 1, '2025-10-17 00:38:15'),
(114, '/media/images/2025/1760643495_2_pexels-matreding-14044938.jpg', '/media/thumbnails/images/2025/1760643495_2_pexels-matreding-14044938.jpg', 'images', '', 'newspaper', 1, '2025-10-17 00:38:15'),
(115, '/media/images/2025/1760643495_3_pexels-mographe-15360540.jpg', '/media/thumbnails/images/2025/1760643495_3_pexels-mographe-15360540.jpg', 'images', '', 'newspaper', 1, '2025-10-17 00:38:16'),
(116, '/media/images/2025/1760643496_4_pexels-brotin-biswas-158640-518543.jpg', '/media/thumbnails/images/2025/1760643496_4_pexels-brotin-biswas-158640-518543.jpg', 'images', '', 'newspaper', 1, '2025-10-17 00:38:17'),
(117, '/media/images/2025/1760643533_0_pexels-pixabay-301926.jpg', '/media/thumbnails/images/2025/1760643533_0_pexels-pixabay-301926.jpg', 'images', '', 'books', 1, '2025-10-17 00:38:54'),
(118, '/media/images/2025/1760643534_1_pexels-dlxmedia-hu-215591835-11911071.jpg', '/media/thumbnails/images/2025/1760643534_1_pexels-dlxmedia-hu-215591835-11911071.jpg', 'images', '', 'books', 1, '2025-10-17 00:38:55'),
(119, '/media/images/2025/1760643535_2_pexels-towfiqu-barbhuiya-3440682-11484114.jpg', '/media/thumbnails/images/2025/1760643535_2_pexels-towfiqu-barbhuiya-3440682-11484114.jpg', 'images', '', 'books', 1, '2025-10-17 00:38:56'),
(120, '/media/images/2025/1760643536_3_pexels-pixabay-289738.jpg', '/media/thumbnails/images/2025/1760643536_3_pexels-pixabay-289738.jpg', 'images', '', 'books', 1, '2025-10-17 00:38:57'),
(121, '/media/images/2025/1760643537_4_pexels-atomlaborblog-1090941.jpg', '/media/thumbnails/images/2025/1760643537_4_pexels-atomlaborblog-1090941.jpg', 'images', '', 'books', 1, '2025-10-17 00:38:58'),
(122, '/media/images/2025/1760644207_0_pexels-polina-kovaleva-8100514.jpg', '/media/thumbnails/images/2025/1760644207_0_pexels-polina-kovaleva-8100514.jpg', 'images', '', 'tags', 1, '2025-10-17 00:50:08'),
(123, '/media/images/2025/1760644208_1_pexels-eva-bronzini-8058803.jpg', '/media/thumbnails/images/2025/1760644208_1_pexels-eva-bronzini-8058803.jpg', 'images', '', 'tags', 1, '2025-10-17 00:50:09'),
(124, '/media/images/2025/1760644209_2_pexels-padrinan-1111319.jpg', '/media/thumbnails/images/2025/1760644209_2_pexels-padrinan-1111319.jpg', 'images', '', 'tags', 1, '2025-10-17 00:50:10'),
(125, '/media/images/2025/1760646407_0_pexels-fotios-photos-16129703.jpg', '/media/thumbnails/images/2025/1760646407_0_pexels-fotios-photos-16129703.jpg', 'images', '', 'tech', 1, '2025-10-17 01:26:48'),
(126, '/media/images/2025/1760646409_1_pexels-lalorosas-907489.jpg', '/media/thumbnails/images/2025/1760646409_1_pexels-lalorosas-907489.jpg', 'images', '', 'tech', 1, '2025-10-17 01:26:50'),
(127, '/media/images/2025/1760646410_2_pexels-picjumbo-com-55570-196644.jpg', '/media/thumbnails/images/2025/1760646410_2_pexels-picjumbo-com-55570-196644.jpg', 'images', '', 'tech', 1, '2025-10-17 01:26:51'),
(128, '/media/images/2025/1760646411_3_Copilot_20251017_011751.png', '/media/thumbnails/images/2025/1760646411_3_Copilot_20251017_011751.png', 'images', '', 'tech', 1, '2025-10-17 01:26:54'),
(129, '/media/images/2025/1760678272_0_book-cover-sample4.jpg', '/media/thumbnails/images/2025/1760678272_0_book-cover-sample4.jpg', 'images', '', 'book covers', 1, '2025-10-17 10:17:52'),
(130, '/media/images/2025/1760678272_1_book-cover-sample3.jpg', '/media/thumbnails/images/2025/1760678272_1_book-cover-sample3.jpg', 'images', '', 'book covers', 1, '2025-10-17 10:17:53'),
(131, '/media/images/2025/1760678273_2_book-cover-sample2.jpg', '/media/thumbnails/images/2025/1760678273_2_book-cover-sample2.jpg', 'images', '', 'book covers', 1, '2025-10-17 10:17:53'),
(132, '/media/images/2025/1760678273_3_book-cover-sample1.jpg', '/media/thumbnails/images/2025/1760678273_3_book-cover-sample1.jpg', 'images', '', 'book covers', 1, '2025-10-17 10:17:53');

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
) ENGINE=InnoDB AUTO_INCREMENT=15 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`key_pages`, `key_media_banner`, `banner_image_url`, `title`, `page_content`, `url`, `sort`, `is_active`, `entry_date_time`, `update_date_time`) VALUES
(3, 127, 'https://images.pexels.com/photos/256467/pexels-photo-256467.jpeg?cs=srgb&dl=pexels-pixabay-256467.jpg&fm=jpg', 'About Us', 'We build tools that empower editorial teams through clean design and modular workflows.', 'about-us', 0, 1, '2025-09-25 20:27:07', '2025-11-16 10:05:38'),
(4, 132, '', 'Contact', 'Reach out to us via email or social media. We value your feedback.', 'contact', 1, 1, '2025-09-25 20:27:07', '2025-09-25 20:27:07'),
(5, 0, 'banner-privacy.jpg', 'Privacy Policy', 'This page outlines how we handle user data and respect privacy.', 'privacy-policy', 4, 1, '2025-09-25 20:27:07', '2025-09-25 20:27:07'),
(6, 0, 'banner-terms.jpg', 'Terms of Use', 'By using this site, you agree to our terms and conditions.', 'terms-of-use', 5, 1, '2025-09-25 20:27:07', '2025-09-25 20:27:07'),
(12, 0, '', 'Careers', 'Testing careers', 'careers', 2, 1, '2025-10-07 21:55:28', '2025-10-07 21:55:28'),
(14, 0, '', 'Disclaimer', '', 'disclaimer', 6, 1, '2025-10-12 12:46:09', '2025-10-12 12:46:09');

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
) ENGINE=InnoDB AUTO_INCREMENT=83 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `photo_categories`
--

INSERT INTO `photo_categories` (`id`, `key_photo_gallery`, `key_categories`, `url`) VALUES
(27, 4, 5, NULL),
(28, 4, 12, NULL),
(29, 0, 15, NULL),
(32, 8, 2, NULL),
(35, 7, 12, NULL),
(36, 6, 12, NULL),
(37, 6, 21, NULL),
(38, 9, 4, NULL),
(39, 11, 15, NULL),
(40, 13, 15, NULL),
(42, 15, 13, NULL),
(44, 16, 25, NULL),
(45, 18, 26, NULL),
(46, 19, 26, NULL),
(48, 21, 24, NULL),
(60, 23, 26, NULL),
(74, 17, 26, NULL),
(75, 22, 23, NULL),
(77, 20, 23, NULL),
(79, 24, 26, NULL),
(82, 35, 5, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=35 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `photo_gallery`
--

INSERT INTO `photo_gallery` (`key_photo_gallery`, `key_media_banner`, `title`, `image_url`, `description`, `is_active`, `entry_date_time`, `update_date_time`, `created_by`, `updated_by`, `url`, `available_for_blocks`, `css`, `slideshow_enabled`, `navigation_type`) VALUES
(29, 112, 'Articles', '/media/images/2025/1760643493_0_pexels-nappy-935979.jpg', '', 1, '2025-10-17 00:35:23', '2025-10-17 00:35:23', 1, 1, 'articles-photo-gallery', 1, 'height:500px', 1, 'arrows'),
(30, 122, 'Topics', '/media/images/2025/1760644207_0_pexels-polina-kovaleva-8100514.jpg', '', 1, '2025-10-17 00:44:35', '2025-10-17 00:44:35', 1, 1, 'topics-photo-gallery', 1, 'height:500px;', 1, 'arrows'),
(31, 117, 'Books', '/media/images/2025/1760643533_0_pexels-pixabay-301926.jpg', '', 1, '2025-10-17 00:51:54', '2025-10-17 00:51:54', 1, 1, 'books-photo-gallery', 1, 'height:500px;', 1, 'arrows'),
(32, 108, 'Authors', '/media/images/2025/1760637343_2_pexels-freephotos-64776.jpg', '', 1, '2025-10-17 00:55:58', '2025-10-17 00:55:58', 1, 1, 'authors-photo-gallery', 1, 'height:500px', 1, 'arrows'),
(33, 0, 'Home', '/media/images/2025/1760646411_3_Copilot_20251017_011751.png', '', 1, '2025-10-17 01:27:55', '2025-10-17 01:27:55', 1, 1, 'home-photo-gallery', 1, 'height:550px', 1, 'arrows'),
(34, 0, 'Books to Check', '/media/images/2025/1760678273_2_book-cover-sample2.jpg', '', 1, '2025-10-17 10:18:35', '2025-11-16 10:06:21', 1, 1, 'sidebar-book-covers-slideshow', 1, 'height:300px;', 1, 'arrows');

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
) ENGINE=InnoDB AUTO_INCREMENT=105 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `photo_gallery_images`
--

INSERT INTO `photo_gallery_images` (`key_image`, `key_media_banner`, `key_photo_gallery`, `entry_date_time`, `title`, `description`, `image_mobile_url`, `opacity`, `action_button`, `action_button_text`, `action_button_link_url`, `animation_type`, `text_position`, `text_color`, `image_wrapper_class`, `visibility_start`, `visibility_end`, `sort`, `is_active`) VALUES
(79, 116, 29, '2025-10-17 00:35:59', '<none>', '', NULL, 1, 0, '', '', 'zoom', 'center', '#ffffff', '', NULL, NULL, 0, 1),
(80, 115, 29, '2025-10-17 00:36:11', '<none>', '', NULL, 1, 0, '', '', 'zoom', 'center', '#ffffff', '', NULL, NULL, 0, 1),
(81, 113, 29, '2025-10-17 00:36:23', '<none>', '', NULL, 1, 0, '', '', 'zoom', 'center', '#ffffff', '', NULL, NULL, 0, 1),
(82, 114, 29, '2025-10-17 00:36:35', '<none>', '', NULL, 1, 0, '', '', 'zoom', 'center', '#ffffff', '', NULL, NULL, 0, 1),
(83, 112, 29, '2025-10-17 00:39:35', '<none>', '', NULL, 1, 0, '', '', 'zoom', 'center', '#ffffff', '', NULL, NULL, 0, 1),
(84, 124, 30, '2025-10-17 00:48:30', '<none>', '', NULL, 1, 0, '', '', 'fade', 'center', '#ffffff', '', NULL, NULL, 0, 1),
(85, 123, 30, '2025-10-17 00:48:40', '<none>', '', NULL, 1, 0, '', '', 'fade', 'center', '#ffffff', '', NULL, NULL, 0, 1),
(86, 122, 30, '2025-10-17 00:48:47', '<none>', '', NULL, 1, 0, '', '', 'fade', 'center', '#ffffff', '', NULL, NULL, 0, 1),
(87, 101, 30, '2025-10-17 00:48:53', '<none>', '', NULL, 1, 0, '', '', 'fade', 'center', '#ffffff', '', NULL, NULL, 0, 1),
(88, 119, 31, '2025-10-17 00:52:08', '<none>', '', NULL, 1, 0, '', '', 'fade', 'center', '#ffffff', '', NULL, NULL, 0, 1),
(89, 118, 31, '2025-10-17 00:52:12', '<none>', '', NULL, 1, 0, '', '', 'fade', 'center', '#ffffff', '', NULL, NULL, 0, 1),
(90, 121, 31, '2025-10-17 00:52:15', '<none>', '', NULL, 1, 0, '', '', 'fade', 'center', '#ffffff', '', NULL, NULL, 0, 1),
(91, 120, 31, '2025-10-17 00:52:19', '<none>', '', NULL, 1, 0, '', '', 'fade', 'center', '#ffffff', '', NULL, NULL, 0, 1),
(92, 105, 32, '2025-10-17 00:56:10', '<none>', '0', NULL, 1, 0, '0', '0', 'fade', 'center', '#ffffff', '0', NULL, NULL, 0, 0),
(93, 104, 32, '2025-10-17 00:56:14', '<none>', '', NULL, 1, 0, '', '', 'fade', 'center', '#ffffff', '', NULL, NULL, 0, 1),
(94, 103, 32, '2025-10-17 00:56:19', '<none>', '', NULL, 1, 0, '', '', 'fade', 'center', '#ffffff', '', NULL, NULL, 0, 1),
(95, 109, 32, '2025-10-17 00:56:24', '<none>', '', NULL, 1, 0, '', '', 'fade', 'center', '#ffffff', '', NULL, NULL, 0, 1),
(96, 128, 33, '2025-10-17 01:28:17', '<none>', '', NULL, 1, 0, '', '', 'fade', 'center', '#ffffff', '', NULL, NULL, 2, 1),
(97, 127, 33, '2025-10-17 01:28:23', '<none>', '', NULL, 1, 0, '', '', 'fade', 'center', '#ffffff', '', NULL, NULL, 1, 1),
(98, 126, 33, '2025-10-17 01:28:28', '<none>', '', NULL, 1, 0, '', '', 'fade', 'center', '#ffffff', '', NULL, NULL, 1, 1),
(99, 125, 33, '2025-10-17 01:28:34', '<none>', '', NULL, 1, 0, '', '', 'fade', 'center', '#ffffff', '', NULL, NULL, 1, 1),
(101, 110, 34, '2025-10-17 10:18:59', 'Cover 2', 'Description of book 2', NULL, 1, 0, '', '', 'fade', 'center', '#ffffff', '', NULL, NULL, 0, 1),
(102, 122, 34, '2025-10-17 10:19:03', 'Cover 3', 'Description of book 3', NULL, 1, 0, '', '', 'fade', 'center', '#ffffff', '', NULL, NULL, 0, 1),
(103, 121, 34, '2025-10-17 10:19:13', 'Cover 4', 'Description of book 4', NULL, 1, 0, '0', '0', 'fade', 'center', '#ffffff', '0', NULL, NULL, 0, 1),
(104, 132, 34, '2025-10-19 00:32:11', 'Cover 5', '', NULL, 1, 0, '', '', 'fade', 'center', '#ffffff', '', NULL, NULL, 0, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=13 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `products`
--

INSERT INTO `products` (`key_product`, `product_type`, `key_books`, `title`, `description`, `price`, `stock_quantity`, `discount_percent`, `sku`, `is_featured`, `url`, `is_active`, `sort`, `entry_date_time`, `update_date_time`, `created_by`, `updated_by`) VALUES
(1, 'book', NULL, 'The Art of Foxus', 'A curated guide to deep work and clarity.', '1203.00', 45, 10, '0', 1, 'the-art-of-foxus', 1, 0, '2025-09-30 22:10:39', '2025-10-06 10:44:09', NULL, 1),
(2, 'stationery', NULL, 'Leather Notebook', 'Premium A5 notebook with stitched binding.', '850.00', 200, 5, 'ST-NOTE-002', 0, '', 1, 2, '2025-09-30 22:10:39', '2025-09-30 22:10:39', NULL, NULL),
(3, 'digital', NULL, 'Productivity Toolkit (PDF)', 'Downloadable templates and planners.', '500.00', 9999, 0, 'DG-TOOLKIT-003', 1, '', 1, 3, '2025-09-30 22:10:39', '2025-09-30 22:10:39', NULL, NULL),
(4, 'book', NULL, 'Code & Craft', 'A book for developers who love clean architecture.', '1500.00', 30, 15, 'BK-CODE-004', 1, 'code-and-craft', 1, 0, '2025-09-30 22:10:39', '2025-10-07 06:44:54', NULL, 1),
(5, 'stationery', NULL, 'Gel Pen Set (Pack of 10)', 'Smooth writing pens in assorted colors.', '300.00', 500, 0, 'ST-PENS-005', 0, '', 1, 5, '2025-09-30 22:10:39', '2025-09-30 22:10:39', NULL, NULL),
(6, 'other', NULL, 'Golden Jumpes', 'Some long jumpes ', '600.00', 10, NULL, '0', NULL, 'golden-jumpes', 1, 0, '2025-09-30 22:21:30', '2025-10-06 10:44:28', NULL, 1),
(11, 'other', NULL, 'Navy Shoes', 'Testing shoes', '2000.00', 40, NULL, '', NULL, 'navy-shoes', 1, 0, '2025-10-01 00:48:15', '2025-10-08 20:36:51', 1, 1),
(12, 'other', NULL, 'Robot Car, Racing Car Toy for Kids', '', '900.00', 0, NULL, '', NULL, 'robot-car-racing-car-toy-for-kids', 1, 0, '2025-10-05 06:31:32', '2025-10-15 05:18:51', 1, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=32 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_categories`
--

INSERT INTO `product_categories` (`id`, `key_product`, `key_categories`, `url`) VALUES
(19, 1, 5, NULL),
(22, 6, 13, NULL),
(23, 6, 1, NULL),
(27, 12, 14, NULL),
(28, 12, 19, NULL),
(31, 11, 20, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=46 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_images`
--

INSERT INTO `product_images` (`key_image`, `key_media_banner`, `key_product`, `sort_order`, `entry_date_time`) VALUES
(15, NULL, 4, 0, '2025-10-02 00:45:21'),
(16, NULL, 4, 0, '2025-10-02 00:45:21'),
(20, NULL, 5, 0, '2025-10-02 00:54:32'),
(24, NULL, 5, 0, '2025-10-02 01:28:59'),
(27, NULL, 5, 0, '2025-10-02 01:35:49'),
(45, 3, 11, 0, '2025-10-09 07:29:26');

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
) ENGINE=InnoDB AUTO_INCREMENT=10 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `product_prices_history`
--

INSERT INTO `product_prices_history` (`key_price`, `key_product`, `old_price`, `new_price`, `change_date`) VALUES
(1, 1, '1200.00', '1203.00', '2025-09-30 22:17:14'),
(2, 6, '0.00', '500.00', '2025-09-30 22:21:30'),
(7, 11, '0.00', '2000.00', '2025-10-01 00:48:15'),
(8, 6, '500.00', '600.00', '2025-10-02 16:40:30'),
(9, 12, '0.00', '900.00', '2025-10-05 06:31:32');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `key_settings` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `setting_key` varchar(100) COLLATE utf8_unicode_ci NOT NULL,
  `setting_value` text COLLATE utf8_unicode_ci NOT NULL,
  `setting_group` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'general',
  `is_permanent` tinyint(1) NOT NULL DEFAULT '0',
  `entry_date_time` datetime NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_settings`)
) ENGINE=InnoDB AUTO_INCREMENT=90 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`key_settings`, `setting_key`, `setting_value`, `setting_group`, `is_permanent`, `entry_date_time`) VALUES
(1, 'site_name', 'Copilot CMS', 'general', 0, '2025-10-06 23:07:08'),
(2, 'site_slogan', 'Clarity. Collaboration. Control.', 'general', 0, '2025-10-06 23:07:08'),
(3, 'base_url', 'http://copilot/', 'general', 0, '2025-10-06 23:18:10'),
(4, 'powered_by', 'Powered by Copilot', 'general', 0, '2025-10-06 23:07:08'),
(11, 'article_show_author', '1', 'article_view', 0, '2025-10-06 23:07:08'),
(12, 'article_show_categories', '1', 'article_view', 0, '2025-10-06 23:07:08'),
(13, 'article_show_related_books', '1', 'article_view', 0, '2025-10-06 23:07:08'),
(14, 'article_snippet_length', '300', 'article_view', 0, '2025-10-06 23:07:08'),
(15, 'article_banner_height', '400px', 'article_view', 0, '2025-10-06 23:07:08'),
(22, 'gallery_items_per_page', '12', 'gallery', 0, '2025-10-06 23:07:08'),
(24, 'template_default_color', '#0055aa', 'ui', 0, '2025-10-10 18:01:14'),
(27, 'default_404_message', 'Page not found.', 'ui', 0, '2025-10-06 23:07:08'),
(37, 'template_folder', 'default', 'php_template', 1, '2025-10-06 23:59:28'),
(38, 'template_default_logo', '/templates/default/images/copilogcms.png', 'general', 0, '2025-10-15 04:56:36'),
(39, 'template_default_cover_image', '/templates/default/images/pexels-wasifmehmood997-19442078.jpg', 'ui', 0, '2025-10-10 18:02:14'),
(40, 'max_upload_image_width', '2000', 'media_library', 0, '2025-10-15 22:12:04'),
(41, 'max_upload_image_height', '1000', 'media_library', 0, '2025-10-15 22:12:09'),
(42, 'template_text_color', 'black', 'css_colors', 0, '2025-10-20 21:23:28'),
(43, 'template_background_color', '#FFF', 'css_colors', 0, '2025-10-20 21:27:30'),
(45, 'items_brand_color', 'SeaGreen', 'css_colors', 0, '2025-10-20 21:28:26'),
(46, 'sidebar_background_color', '#F4F4F4', 'css_colors', 0, '2025-10-20 23:27:22'),
(47, 'site_direction', 'ltr', 'css_template', 0, '2025-10-22 07:37:19'),
(48, 'google_fonts', 'Noto Nastaliq Urdu, Gulzar, Noto Kufi Arabic, Noto Naskh Arabic', 'css_fonts', 0, '2025-10-27 21:33:32'),
(49, 'snippets_per_page', '15', 'php_template', 0, '2025-10-30 09:49:38'),
(50, 'snippet_words', '80', 'php_template', 0, '2025-10-30 11:14:33'),
(51, 'module_total_records', '7', 'php_template', 0, '2025-11-06 19:49:34'),
(52, 'pager_next_label', 'Next', 'php_template', 0, '2025-11-06 19:52:48'),
(53, 'pager_prev_label', 'Prev', 'php_template', 0, '2025-11-06 19:53:02'),
(54, 'readmore_label', 'â˜·', 'php_template', 0, '2025-11-06 19:54:21'),
(55, 'module_more_label', 'More', 'php_template', 0, '2025-11-07 16:38:31'),
(56, 'template_max_width', '1300px', 'css_template', 0, '2025-11-07 17:21:27'),
(57, 'main_menu_font', 'Arial', 'css_fonts', 0, '2025-11-07 18:40:16'),
(58, 'breadcrumb_font', 'Arial', 'css_fonts', 0, '2025-11-07 18:54:58'),
(59, 'block_heading_font', 'Arial', 'css_fonts', 0, '2025-11-07 20:10:46'),
(60, 'pager_font', 'Arial', 'css_fonts', 0, '2025-11-07 20:15:54'),
(61, 'footer_font', 'Arial', 'css_fonts', 0, '2025-11-07 21:16:04'),
(62, 'template_font_size', '15px', 'css_fonts', 0, '2025-11-08 17:44:20'),
(64, 'content_banner_height', '20vh', 'css_template', 0, '2025-11-14 22:02:08'),
(65, 'articles_label', 'Articles', 'php_template', 0, '2025-11-16 16:37:06'),
(66, 'content_types_label', 'Content Types', 'php_template', 0, '2025-11-16 16:37:26'),
(67, 'categories_label', 'Categories', 'php_template', 0, '2025-11-16 16:37:50'),
(68, 'tags_label', 'Tags', 'php_template', 0, '2025-11-16 16:37:58'),
(69, 'books_label', 'Books', 'php_template', 0, '2025-11-16 16:38:14'),
(70, 'pages_label', 'Info', 'php_template', 0, '2025-11-16 16:38:37'),
(71, 'authors_label', 'Authors', 'php_template', 0, '2025-11-16 16:38:49'),
(72, 'youtube_gallery_label', 'Youtube Gallery', 'php_template', 0, '2025-11-16 16:39:19'),
(73, 'photo_gallery_label', 'Photo Gallery', 'php_template', 0, '2025-11-16 16:39:35'),
(74, 'search_label', 'Search', 'php_template', 0, '2025-11-16 16:40:10'),
(75, 'cache_duration_hours', '24', 'cache', 0, '2025-12-07 18:36:21'),
(76, 'cache_enabled', 'yes', 'cache', 0, '2025-12-07 18:36:52'),
(77, 'css_version', '1', 'css_template', 0, '2025-12-09 23:46:37'),
(78, 'article_authors_label', 'Authors', 'php_template', 0, '2025-12-13 12:54:06'),
(79, 'article_categories_label', 'Categories', 'php_template', 0, '2025-12-13 12:57:00'),
(80, 'article_content_types_label', 'Content Types', 'php_template', 0, '2025-12-13 12:57:20'),
(81, 'article_tags_label', 'Tags', 'php_template', 0, '2025-12-13 12:57:46'),
(82, 'show_article_created_updated', 'yes', 'php_template', 0, '2025-12-20 18:41:46'),
(83, 'site_locale', 'en_PK', 'php_template', 0, '2025-12-20 19:06:46'),
(87, 'template_font_rtl', 'Noto Kufi Arabic', 'css_fonts', 0, '2026-01-16 04:42:13'),
(88, 'template_font_ltr', 'calibri', 'css_fonts', 0, '2026-01-16 04:42:37'),
(89, 'template_font_family', 'calibri', 'css_fonts', 0, '2026-01-16 04:45:50');

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
) ENGINE=InnoDB AUTO_INCREMENT=65 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `tags`
--

INSERT INTO `tags` (`key_tags`, `key_media_banner`, `name`, `description`, `url`, `banner_image_url`, `sort`, `is_active`, `entry_date_time`) VALUES
(51, 0, 'Pakistan', '', 'pakistan', '', 0, 1, '2025-11-04 16:58:46'),
(52, 0, 'Nepal', '', 'nepal', '', 0, 1, '2025-11-04 16:58:59'),
(53, 0, 'Ireland', '', 'ireland', '', 0, 1, '2025-11-16 10:05:15'),
(54, 0, 'Sri Lanka', '', 'sri-lanka', '', 0, 1, '2025-11-16 15:52:35'),
(55, 0, 'India', '', 'india', '', 0, 1, '2025-11-16 15:52:39'),
(56, 0, 'United Kingdom', '', 'united-kingdom', '', 0, 1, '2025-11-16 15:52:46'),
(57, 0, 'United States', '', 'united-states', '', 0, 1, '2025-11-16 15:52:51'),
(58, 0, 'Afghanistan', '', 'afghanistan', '', 0, 1, '2025-11-16 15:52:57'),
(59, 0, 'Saudi Arabia', '', 'saudi-arabia', '', 0, 1, '2025-11-16 15:53:01'),
(60, 0, 'France', '', 'france', '', 0, 1, '2025-11-16 15:53:04'),
(61, 0, 'Russia', '', 'russia', '', 0, 1, '2025-11-16 15:53:08'),
(62, 0, 'Iraq', '', 'iraq', '', 0, 1, '2025-11-16 15:53:16'),
(63, 0, 'Iran', '', 'iran', '', 0, 1, '2025-11-16 15:53:19'),
(64, 0, 'Egypt', '', 'egypt', '', 0, 1, '2025-11-16 15:53:26');

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
) ENGINE=InnoDB AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `users`
--

INSERT INTO `users` (`key_user`, `key_media_banner`, `name`, `username`, `password_hash`, `email`, `role`, `is_active`, `entry_date_time`, `update_date_time`, `phone`, `address`, `city`, `state`, `country`, `description`, `url`, `banner_image_url`) VALUES
(1, 0, 'NKA', 'admin', '$2y$10$NHIqSMqCvTKHb3iDWIA4je/hMEfCWCENb9Pjmm/tckm6gvYAIM0ry', 'admin123@example.com', 'admin', 1, '2025-09-30 23:41:42', '2025-10-08 18:34:27', '', '123 ABC Street\r\nWoodbridge, VA', '', '', 'Pakistan', '', 'hello', ''),
(2, 121, 'Jane', 'editor_jane', '$2y$10$ZxYkQeW9vXJzYq7gT1xE1eQvZz9YqU8gT1xE1eQvZz9YqU8gT1xE1e', 'jane@example.com', 'editor', 1, '2025-09-30 23:41:42', '2025-10-19 13:55:29', '', '', '', '', '', '', 'jane', ''),
(3, 0, '', 'viewer_ali', '$2y$10$ZxYkQeW9vXJzYq7gT1xE1eQvZz9YqU8gT1xE1eQvZz9YqU8gT1xE1e', 'ali@example.com', 'viewer', 1, '2025-09-30 23:41:42', '2025-09-30 23:41:42', NULL, NULL, NULL, NULL, NULL, NULL, NULL, ''),
(4, 0, 'Lady User', 'ladyuser', '$2y$10$bNMbu9PTVfkl4m.meX1Cgu2V9AcE7sEggdRcFHotoiyZWU26CUnzG', 'lady@mail.com', 'editor', 1, '2025-10-01 00:02:19', '2025-10-05 10:39:06', '123456789148', 'Lady street.', 'Hashmi', 'Punjab', 'Pakistan', '', '', ''),
(5, 0, '', 'newuser', '$2y$10$qLr7i4gCGtsM8Z1aJo.KGekV4JZujBGtx1Wbw6wRtKLwwb93lwL9q', 'newuser@gmail.com', 'editor', 1, '2025-10-05 06:38:46', '2025-10-05 06:38:46', '', '', '', '', '', '', 'newuser', ''),
(6, 129, 'Man User', 'manuser', '$2y$10$04LQ.ah/n/H9cRupn.fD6O5uzfjnVmIfK162xrXP.Os32hk9iDamu', 'manuser@outlook.com', 'viewer', 1, '2025-10-05 10:40:46', '2025-10-19 13:52:14', '', '', '', '', '', '', 'manuser', ''),
(7, 128, 'John Doe', 'johndoe', '$2y$10$oPtF/y5pnziuscR2Wd0V6.GVGjOyQL6LAEhFFR3YckMqETEK791Hy', 'johndoe@gmail.com', 'admin', 1, '2025-10-05 10:43:21', '2025-11-16 10:33:17', '', '', '', '', '', '', 'john-doe', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=56 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `youtube_categories`
--

INSERT INTO `youtube_categories` (`id`, `key_youtube_gallery`, `key_categories`, `url`) VALUES
(7, 7, 2, NULL),
(8, 7, 8, NULL),
(9, 7, 15, NULL),
(11, 9, 19, NULL),
(15, 11, 5, NULL),
(21, 10, 19, NULL),
(23, 12, 8, NULL),
(24, 12, 12, NULL),
(25, 12, 20, NULL),
(26, 13, 8, NULL),
(27, 13, 14, NULL),
(28, 8, 10, NULL),
(29, 8, 21, NULL),
(40, 16, 29, NULL),
(41, 15, 28, NULL),
(42, 14, 27, NULL),
(55, 17, 30, NULL);

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
) ENGINE=InnoDB AUTO_INCREMENT=18 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `youtube_gallery`
--

INSERT INTO `youtube_gallery` (`key_youtube_gallery`, `key_media_banner`, `title`, `youtube_id`, `thumbnail_url`, `description`, `is_active`, `entry_date_time`, `created_by`, `updated_by`, `url`) VALUES
(14, NULL, 'England vs South Africa - Highlights', 'mq4_JpV9qPc', 'https://i.ytimg.com/vi/mq4_JpV9qPc/mqdefault.jpg', '', 1, '2025-10-10 16:50:47', 1, 1, 'england-vs-south-africa-highlights'),
(15, NULL, 'Best Goals in Football', 'XKAV4qRIvJ8', 'https://i.ytimg.com/vi/XKAV4qRIvJ8/mqdefault.jpg', '', 1, '2025-10-10 16:54:57', 1, 1, 'best-goals-in-football'),
(16, NULL, 'The Big Swimming Race', 'bSc0ddvxoec', 'https://i.ytimg.com/vi/bSc0ddvxoec/mqdefault.jpg', '', 1, '2025-10-10 16:56:52', 1, 1, 'the-big-swimming-race'),
(17, NULL, 'Best Set of the Year', 'vel8ekZ8rTs', 'https://i.ytimg.com/vi/vel8ekZ8rTs/maxresdefault.jpg', 'Best Set of the Year', 1, '2025-10-10 16:58:56', 1, 1, 'best-set-of-the-year');

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
-- Indexes for table `settings`
--
ALTER TABLE `settings` ADD FULLTEXT KEY `setting_key` (`setting_key`,`setting_value`);

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
