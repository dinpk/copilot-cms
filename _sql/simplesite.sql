-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 30, 2025 at 02:02 PM
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
  `banner_image_url` varchar(2000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `status` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `entry_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_articles`)
) ENGINE=MyISAM AUTO_INCREMENT=34 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`key_articles`, `title`, `title_sub`, `article_snippet`, `article_content`, `content_type`, `url`, `banner_image_url`, `sort`, `status`, `entry_date_time`, `update_date_time`) VALUES
(1, 'Hello Worlds', 'sub title', ' snippet', 'content', 'article', 'my-url', '', 0, 'on', '2025-09-23 20:14:17', '2025-09-24 03:57:19'),
(2, 'The Rise of Minimal CMS', 'Streamlined Editorial Tools', 'Exploring how minimal CMS platforms empower editorial teams.', 'Full content of article 1...', 'article', 'minimal-cms', 'banner1.jpg', 1, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08'),
(3, 'Designing for Editors', 'UI That Works', 'Why editorial-first design matters in publishing workflows.', 'Full content of article 2 3 4', 'article', 'editorial-ui', 'banner2.jpg', 2, 'on', '2025-09-25 15:13:08', '2025-09-27 12:05:22'),
(4, 'PHP Without Frameworks', 'Native Power', 'Building robust apps with native PHP and no frameworks.', 'Full content of article 3...', 'article', 'php-native', 'banner3.jpg', 3, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08'),
(5, 'Modular CRUD Systems', 'Scalable Architecture', 'How modular CRUD design improves maintainability.', 'Full content of article 4...', 'article', 'modular-crud', 'banner4.jpg', 4, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08'),
(6, 'Debounce in Search', 'Performance Boosts', 'Using debounce to optimize search-triggered loading.', 'Full content of article 5...', 'article', 'debounce-search', 'banner5.jpg', 5, 'on', '2025-09-25 15:13:08', '2025-09-30 13:34:45'),
(7, 'Pagination Patterns', 'Smart Loading', 'Best practices for implementing pagination in CMS.', 'Full content of article 6...', 'article', 'pagination-patterns', 'banner6.jpg', 6, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08'),
(8, 'Editorial Workflows', 'From Draft to Publish', 'Mapping out efficient editorial workflows.', 'Full content of article 7...', 'article', 'editorial-workflows', 'banner7.jpg', 7, 'on', '2025-09-25 15:13:08', '2025-09-29 22:11:15'),
(9, 'Category Management', 'Organized Content', 'Tips for managing categories in publishing systems.', 'Full content of article 8...', 'article', 'category-management', 'banner8.jpg', 8, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08'),
(10, 'Modal-Based Editing', 'Inline Efficiency', 'Using modals for quick article edits.', 'Full content of article 9...', 'article', 'modal-editing', 'banner9.jpg', 9, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08'),
(11, 'Search Optimization', 'Fast & Relevant', 'Improving search relevance and speed.', 'Full content of article 10...', 'article', 'search-optimization', 'banner10.jpg', 10, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08'),
(12, 'Legacy CMS Refactor', 'Modernizing Systems', 'Strategies for refactoring legacy CMS platforms.', 'Full content of article 11...', 'article', 'legacy-refactor', 'banner11.jpg', 11, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08'),
(13, 'Content Snippets', 'Reusable Blocks', 'Creating reusable content snippets.', 'Full content of article 12...', 'article', 'content-snippets', 'banner12.jpg', 12, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08'),
(14, 'Desktop-Only UI', 'Focused Design', 'Why desktop-first UI still matters.', 'Full content of article 13...', 'article', 'desktop-ui', 'banner13.jpg', 13, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08'),
(15, 'Error Reporting in PHP', 'Debugging Smartly', 'Enabling error reporting for better debugging.', 'Full content of article 14...', 'article', 'php-errors', 'banner14.jpg', 14, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08'),
(16, 'SQL Troubleshooting', 'Root Cause Isolation', 'Finding and fixing SQL issues.', 'Full content of article 15...', 'article', 'sql-troubleshooting', 'banner15.jpg', 15, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08'),
(17, 'Advanced Filters', 'Precision Tools', 'Adding advanced filters to editorial tools.', 'Full content of article 16...', 'article', 'advanced-filters', 'banner16.jpg', 16, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08'),
(18, 'Scalable CMS Design', 'Future-Proofing', 'Designing CMS for long-term scalability.', 'Full content of article 17...', 'article', 'scalable-cms', 'banner17.jpg', 17, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08'),
(19, 'Collaborative Development', 'Step-by-Step Builds', 'Working with feedback-driven development.', 'Full content of article 18...', 'article', 'collab-dev', 'banner18.jpg', 18, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08'),
(20, 'Clean Code Practices', 'Maintainable Systems', 'Writing clean, maintainable PHP.', 'Full content of article 19...', 'article', 'clean-code', 'banner19.jpg', 19, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08'),
(21, 'UI Feedback Loops', 'Iterative Design', 'Using feedback to refine UI.', 'Full content of article 20...', 'article', 'ui-feedback', 'banner20.jpg', 20, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08'),
(22, 'CMS Testing Strategies', 'Catch the Bugs', 'Testing CMS workflows effectively.', 'Full content of article 21...', 'article', 'cms-testing', 'banner21.jpg', 21, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08'),
(23, 'Content Assignment UX', 'Frictionless Flow', 'Improving article assignment UX.', 'Full content of article 22...', 'article', 'assignment-ux', 'banner22.jpg', 22, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08'),
(24, 'Banner Image Tips', 'Visual Impact', 'Choosing effective banner images.', 'Full content of article 23...', 'article', 'banner-tips', 'banner23.jpg', 23, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08'),
(25, 'URL Structuring', 'SEO & Clarity', 'Structuring article URLs for clarity and SEO.', 'Full content of article 24...', 'article', 'url-structure', 'banner24.jpg', 24, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08'),
(26, 'CMS Entry Points', 'Where It Begins', 'Designing intuitive entry points for editors.', 'Full content of article 25...', 'article', 'cms-entry', 'banner25.jpg', 25, 'on', '2025-09-25 15:13:08', '2025-09-25 15:13:08'),
(33, 'Next Era App Dev', 'New Ways of App Dev in 21st Century', '', '', 'article', '', '', 0, 'on', '2025-09-30 13:56:49', '2025-09-30 13:57:02');

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
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `article_authors`
--

INSERT INTO `article_authors` (`id`, `key_articles`, `key_authors`) VALUES
(2, 8, 8),
(3, 8, 6),
(7, 4, 5),
(6, 4, 3);

-- --------------------------------------------------------

--
-- Table structure for table `article_categories`
--

DROP TABLE IF EXISTS `article_categories`;
CREATE TABLE IF NOT EXISTS `article_categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_articles` int(10) UNSIGNED NOT NULL,
  `key_categories` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_pair` (`key_articles`,`key_categories`),
  KEY `key_categories` (`key_categories`)
) ENGINE=MyISAM AUTO_INCREMENT=20 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `article_categories`
--

INSERT INTO `article_categories` (`id`, `key_articles`, `key_categories`) VALUES
(1, 6, 8),
(2, 6, 18),
(3, 27, 4),
(4, 27, 19),
(8, 29, 8),
(7, 29, 6),
(9, 31, 19),
(10, 31, 5),
(11, 0, 5),
(12, 0, 16),
(17, 33, 19),
(18, 33, 8),
(19, 33, 14);

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
  `image_url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(2000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `entry_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_authors`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `authors`
--

INSERT INTO `authors` (`key_authors`, `name`, `email`, `phone`, `website`, `url`, `social_url_media1`, `social_url_media2`, `social_url_media3`, `city`, `state`, `country`, `image_url`, `description`, `status`, `entry_date_time`, `update_date_time`) VALUES
(1, 'My First Author', 'ndin.pk@gmail.com', '571-247-7818', 'https://techurdu.org', 'ndin-pk', '', '', '', 'Gujranwala', 'Punjab', 'Pakistan', '', '', 'on', '2025-09-24 13:43:17', '2025-09-24 13:45:54'),
(2, 'Amina Siddiqui', 'amina@contenthub.pk', '0300-1234567', 'https://aminasiddiqui.com', 'amina-siddiqui', 'https://twitter.com/aminasiddiqui', 'https://linkedin.com/in/aminasiddiqui', '', 'Karachi', 'Sindh', 'Pakistan', 'amina.jpg', 'Amina writes on digital culture and editorial ethics.', 'on', '2025-09-25 15:19:51', '2025-09-29 22:01:40'),
(3, 'Bilal Khan', 'bilal@techscribe.io', '0312-9876543', 'https://bilalkhan.dev', 'bilal-khan', 'https://github.com/bilalkhan', '', '', 'Lahore', 'Punjab', 'Pakistan', 'bilal.jpg', 'Bilal specializes in backend systems and CMS architecture.', 'on', '2025-09-25 15:19:51', '2025-09-29 22:04:06'),
(4, 'Sana Raza', 'sana@designjournal.org', '0333-1122334', 'https://sanaraza.art', 'sana-raza', 'https://instagram.com/sanaraza', 'https://behance.net/sanaraza', '', 'Islamabad', 'Capital', 'Pakistan', 'sana.jpg', 'Sana explores editorial design and user experience.', 'on', '2025-09-25 15:19:51', '2025-09-25 15:19:51'),
(5, 'Imran Qureshi', 'imran@datawrite.net', '0345-9988776', 'https://imranqureshi.net', 'imran-qureshi', 'https://twitter.com/imranqureshi', '', '', 'Multan', 'Punjab', 'Pakistan', 'imran.jpg', 'Imran writes about data-driven journalism and content strategy.', 'on', '2025-09-25 15:19:51', '2025-09-25 15:19:51'),
(6, 'Nida Farooq', 'nida@storycraft.pk', '0301-5566778', 'https://nidafarooq.com', 'nida-farooq', 'https://facebook.com/nidafarooq', 'https://linkedin.com/in/nidafarooq', '', 'Peshawar', 'KPK', 'Pakistan', 'nida.jpg', 'Nida focuses on narrative building and editorial workflows.', 'on', '2025-09-25 15:19:51', '2025-09-25 15:19:51'),
(7, 'Tariq Mehmood', 'tariq@codepen.pk', '0322-3344556', 'https://tariqmehmood.dev', 'tariq-mehmood', 'https://github.com/tariqmehmood', '', '', 'Faisalabad', 'Punjab', 'Pakistan', 'tariq.jpg', 'Tariq contributes on PHP optimization and modular design.', 'on', '2025-09-25 15:19:51', '2025-09-25 15:19:51'),
(8, 'Hina Javed', 'hina@uxpress.io', '0309-7788990', 'https://hinajaved.com', 'hina-javed', 'https://dribbble.com/hinajaved', 'https://linkedin.com/in/hinajaved', '', 'Rawalpindi', 'Punjab', 'Pakistan', 'hina.jpg', 'Hina writes about UX patterns and editorial tooling.', 'on', '2025-09-25 15:19:51', '2025-09-25 15:19:51'),
(9, 'Zeeshan Ali', 'zeeshan@devjournal.pk', '0315-6677889', 'https://zeeshanali.dev', 'zeeshan-ali', 'https://twitter.com/zeeshanali', '', '', 'Hyderabad', 'Sindh', 'Pakistan', 'zeeshan.jpg', 'Zeeshan covers CMS performance and SQL tuning.', 'on', '2025-09-25 15:19:51', '2025-09-25 15:19:51'),
(10, 'Fatima Noor', 'fatima@contentgrid.io', '0331-4455667', 'https://fatimanoor.com', 'fatima-noor', 'https://instagram.com/fatimanoor', 'https://linkedin.com/in/fatimanoor', '', 'Quetta', 'Balochistan', 'Pakistan', 'fatima.jpg', 'Fatima writes on editorial workflows and content curation.', 'on', '2025-09-25 15:19:51', '2025-09-25 15:19:51'),
(11, 'Usman Rafiq', 'usman@editorialtech.pk', '0340-2233445', 'https://usmanrafiq.dev', 'usman-rafiq', 'https://github.com/usmanrafiq', '', '', 'Sialkot', 'Punjab', 'Pakistan', 'usman.jpg', 'Usman focuses on scalable CMS and editorial automation.', 'on', '2025-09-25 15:19:51', '2025-09-25 15:19:51');

-- --------------------------------------------------------

--
-- Table structure for table `blocks`
--

DROP TABLE IF EXISTS `blocks`;
CREATE TABLE IF NOT EXISTS `blocks` (
  `key_blocks` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `block_content` varchar(10000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `show_on_pages` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `show_in_region` varchar(50) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `module_file` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'on',
  `entry_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_blocks`)
) ENGINE=MyISAM AUTO_INCREMENT=5 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`key_blocks`, `title`, `block_content`, `show_on_pages`, `show_in_region`, `sort`, `module_file`, `status`, `entry_date_time`) VALUES
(1, 'My First Block', 'some content of block', '/starting-wtih-video', 'sidebar_below', 0, '', 'off', '2025-09-29 22:09:45'),
(2, 'My Second Block', 'some content of block', '/starting-wtih-videos', 'sidebar_below', 0, '', 'on', '2025-09-24 03:58:17'),
(3, 'My Third Block', 'some content of block', '/starting-wtih-videoz', 'sidebar_below', 0, '', 'on', '2025-09-24 03:58:23'),
(4, 'Another Block for sidebar', 'Some content', '', 'sidebar_below', 0, '', 'on', '2025-09-29 22:10:15');

-- --------------------------------------------------------

--
-- Table structure for table `books`
--

DROP TABLE IF EXISTS `books`;
CREATE TABLE IF NOT EXISTS `books` (
  `key_books` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `subtitle` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` text COLLATE utf8_unicode_ci NOT NULL,
  `cover_image_url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `author_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `publisher` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `publish_year` varchar(4) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `isbn` varchar(17) COLLATE utf8_unicode_ci DEFAULT '',
  `price` decimal(10,0) DEFAULT NULL,
  `stock_quantity` int(11) DEFAULT NULL,
  `discount_percent` tinyint(4) DEFAULT NULL,
  `is_featured` tinyint(1) DEFAULT NULL,
  `language` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `format` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `weight_grams` int(11) DEFAULT NULL,
  `sku` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `status` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `entry_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP ON UPDATE CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_books`),
  UNIQUE KEY `isbn` (`isbn`)
) ENGINE=MyISAM AUTO_INCREMENT=59 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `books`
--

INSERT INTO `books` (`key_books`, `title`, `subtitle`, `description`, `cover_image_url`, `url`, `author_name`, `publisher`, `publish_year`, `isbn`, `price`, `stock_quantity`, `discount_percent`, `is_featured`, `language`, `format`, `weight_grams`, `sku`, `status`, `sort`, `entry_date_time`, `update_date_time`) VALUES
(2, 'Designing Editorial Systems', 'Workflow & UX', 'A guide to building editorial systems that balance structure with usability.', 'cover1.jpg', 'designing-editorial-systems', 'Amina Siddiqui', 'ContentHub Press', '2021', '978-969-0010011', '1200', 6, 1, 0, 'Urdu', 'Cover', 0, '', 'on', 1, '2025-09-25 15:23:27', '2025-09-30 13:22:09'),
(3, 'PHP for Publishers', 'Backend Essentials', 'Explores PHP techniques tailored for publishing platforms.', 'cover2.jpg', 'php-for-publishers', 'Bilal Khan', 'TechScribe Books', '2020', '978-969-0010012', '0', 0, 0, 0, '', '', 0, '', 'on', 2, '2025-09-25 15:23:27', '2025-09-26 18:45:53'),
(4, 'Modular CMS Architecture', 'Scalable Design', 'Strategies for designing modular, maintainable CMS systems.', 'cover3.jpg', 'modular-cms-architecture', 'Tariq Mehmood', 'CodePen Publishing', '2022', '978-969-0010013', '0', 0, 0, 0, '', '', 0, '', 'on', 3, '2025-09-25 15:23:27', '2025-09-26 18:45:53'),
(5, 'Editorial UX Patterns', 'Designing for Editors', 'Patterns and principles for editorial-first user interfaces.', 'cover4.jpg', 'editorial-ux-patterns', 'Sana Raza', 'DesignJournal Books', '2021', '978-969-0010014', '0', 0, 0, 0, '', '', 0, '', 'off', 4, '2025-09-25 15:23:27', '2025-09-29 22:08:39'),
(6, 'CMS Debugging Handbook', 'Troubleshooting PHP & SQL', 'A practical guide to debugging CMS workflows.', 'cover5.jpg', 'cms-debugging-handbook', 'Imran Qureshi', 'DataWrite Publishing', '2019', '978-969-0010015', '0', 0, 0, 0, '', '', 0, '', 'on', 5, '2025-09-25 15:23:27', '2025-09-28 16:14:44'),
(7, 'Content Strategy in Practice', 'Editorial Planning', 'Real-world strategies for content planning and execution.', 'cover6.jpg', 'content-strategy-practice', 'Nida Farooq', 'StoryCraft Books', '2023', '978-969-0010016', '500', 20, 0, 0, 'Urdu', 'Hard', 0, '', 'on', 6, '2025-09-25 15:23:27', '2025-09-28 16:12:12'),
(8, 'Scalable Publishing Systems', 'Future-Proof CMS', 'Designing CMS platforms that grow with editorial needs.', 'cover7.jpg', 'scalable-publishing-systems', 'Usman Rafiq', 'EditorialTech Press', '2022', '978-969-0010017', '0', 0, 0, 0, '', '', 0, '', 'on', 7, '2025-09-25 15:23:27', '2025-09-26 18:45:53'),
(9, 'Clean Code for Editors', 'Maintainable PHP', 'Writing clean, maintainable code for editorial tools.', 'cover8.jpg', 'clean-code-editors', 'Bilal Khan', 'TechScribe Books', '2021', '978-969-0010018', '0', 0, 0, 0, '', '', 0, '', 'on', 8, '2025-09-25 15:23:27', '2025-09-26 18:45:53'),
(10, 'Visual Content Design', 'Banner & Layouts', 'Designing impactful visuals for editorial platforms.', 'cover9.jpg', 'visual-content-design', 'Hina Javed', 'UXPress Publishing', '2020', '978-969-0010019', '0', 0, 0, 0, '', '', 0, '', 'on', 9, '2025-09-25 15:23:27', '2025-09-28 16:10:45'),
(11, 'Advanced CMS Filters', 'Precision Tools', 'Implementing advanced filters for editorial workflows.', 'cover10.jpg', 'advanced-cms-filters', 'Zeeshan Ali', 'DevJournal Books', '2023', '978-969-0010020', '0', 0, 0, 0, '', '', 0, '', 'on', 10, '2025-09-25 15:23:27', '2025-09-26 18:45:53'),
(12, 'Narrative Building', 'Storytelling in Publishing', 'Techniques for building compelling editorial narratives.', 'cover11.jpg', 'narrative-building', 'Fatima Noor', 'ContentGrid Press', '2021', '978-969-0010021', '0', 0, 0, 0, '', '', 0, '', 'on', 11, '2025-09-25 15:23:27', '2025-09-26 18:45:53'),
(13, 'SEO for Editorial Teams', 'URL & Structure', 'Optimizing editorial content for search engines.', 'cover12.jpg', 'seo-editorial-teams', 'Usman Rafiq', 'EditorialTech Press', '2020', '978-969-0010022', '0', 0, 0, 0, '', '', 0, '', 'on', 12, '2025-09-25 15:23:27', '2025-09-26 18:45:53'),
(14, 'CMS Testing Toolkit', 'QA for Editors', 'Testing strategies for editorial CMS workflows.', 'cover13.jpg', 'cms-testing-toolkit', 'Imran Qureshi', 'DataWrite Publishing', '2022', '978-969-0010023', '0', 0, 0, 0, '', '', 0, '', 'on', 13, '2025-09-25 15:23:27', '2025-09-26 18:45:53'),
(15, 'Collaborative Publishing', 'Team-Based CMS', 'Building CMS systems for collaborative editorial teams.', 'cover14.jpg', 'collaborative-publishing', 'Nida Farooq', 'StoryCraft Books', '2023', '978-969-0010024', '0', 0, 0, 0, '', '', 0, '', 'on', 14, '2025-09-25 15:23:27', '2025-09-26 18:45:53'),
(16, 'Desktop-First UI Design', 'Focused Editorial Tools', 'Why desktop-first design still matters in publishing.', 'cover15.jpg', 'desktop-ui-design', 'Sana Raza', 'DesignJournal Books', '2021', '978-969-0010025', '0', 0, 0, 0, '', '', 0, '', 'on', 15, '2025-09-25 15:23:27', '2025-09-26 18:45:53'),
(58, 'New World of App Dev with AI', 'Speed up the Process 10x', '', '', 'new-world-of-app-dev-with-ai', 'Dean Mo', 'Copilot', '2025', NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, NULL, 'on', 0, '2025-09-30 13:31:13', '2025-09-30 13:31:13');

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
) ENGINE=MyISAM AUTO_INCREMENT=43 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(32, 4, 7, 0);

-- --------------------------------------------------------

--
-- Table structure for table `book_categories`
--

DROP TABLE IF EXISTS `book_categories`;
CREATE TABLE IF NOT EXISTS `book_categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_books` int(10) UNSIGNED NOT NULL,
  `key_categories` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_pair` (`key_books`,`key_categories`),
  KEY `key_categories` (`key_categories`)
) ENGINE=MyISAM AUTO_INCREMENT=52 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `book_categories`
--

INSERT INTO `book_categories` (`id`, `key_books`, `key_categories`) VALUES
(43, 51, 15),
(29, 49, 17),
(28, 49, 8),
(27, 49, 2),
(26, 48, 17),
(25, 48, 8),
(24, 48, 2),
(23, 40, 19),
(39, 2, 12),
(40, 0, 9),
(20, 35, 8),
(19, 35, 5),
(18, 31, 0),
(17, 29, 0),
(42, 51, 3),
(41, 0, 11),
(37, 50, 3),
(38, 50, 5),
(44, 53, 3),
(45, 53, 15),
(46, 55, 3),
(47, 55, 15),
(48, 57, 3),
(49, 57, 15),
(50, 58, 1),
(51, 58, 14);

-- --------------------------------------------------------

--
-- Table structure for table `book_orders`
--

DROP TABLE IF EXISTS `book_orders`;
CREATE TABLE IF NOT EXISTS `book_orders` (
  `key_order` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `order_number` varchar(50) COLLATE utf8_unicode_ci NOT NULL,
  `customer_name` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `customer_email` varchar(100) COLLATE utf8_unicode_ci DEFAULT NULL,
  `order_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  `total_amount` decimal(10,2) DEFAULT NULL,
  `status` varchar(20) COLLATE utf8_unicode_ci DEFAULT 'pending',
  PRIMARY KEY (`key_order`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_order_items`
--

DROP TABLE IF EXISTS `book_order_items`;
CREATE TABLE IF NOT EXISTS `book_order_items` (
  `key_item` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_order` int(10) UNSIGNED NOT NULL,
  `key_books` int(10) UNSIGNED NOT NULL,
  `quantity` int(11) NOT NULL,
  `unit_price` decimal(10,2) NOT NULL,
  PRIMARY KEY (`key_item`),
  KEY `key_order` (`key_order`),
  KEY `key_books` (`key_books`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- --------------------------------------------------------

--
-- Table structure for table `book_prices_history`
--

DROP TABLE IF EXISTS `book_prices_history`;
CREATE TABLE IF NOT EXISTS `book_prices_history` (
  `key_price` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_books` int(10) UNSIGNED NOT NULL,
  `old_price` decimal(10,2) NOT NULL,
  `new_price` decimal(10,2) NOT NULL,
  `change_date` timestamp NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_price`),
  KEY `key_books` (`key_books`)
) ENGINE=MyISAM AUTO_INCREMENT=4 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `book_prices_history`
--

INSERT INTO `book_prices_history` (`key_price`, `key_books`, `old_price`, `new_price`, `change_date`) VALUES
(1, 2, '0.00', '1.00', '2025-09-28 03:14:40'),
(2, 2, '1.00', '1200.00', '2025-09-28 03:14:49'),
(3, 7, '0.00', '500.00', '2025-09-28 03:15:06');

-- --------------------------------------------------------

--
-- Table structure for table `categories`
--

DROP TABLE IF EXISTS `categories`;
CREATE TABLE IF NOT EXISTS `categories` (
  `key_categories` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `description` varchar(1000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `status` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `entry_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `category_type` enum('article','book','photo_gallery','video_gallery','global') COLLATE utf8_unicode_ci NOT NULL DEFAULT 'global',
  PRIMARY KEY (`key_categories`)
) ENGINE=MyISAM AUTO_INCREMENT=22 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `categories`
--

INSERT INTO `categories` (`key_categories`, `name`, `description`, `url`, `sort`, `status`, `entry_date_time`, `category_type`) VALUES
(1, 'Education', '', 'category/education', 1, 'on', '2025-09-23 20:20:39', 'global'),
(2, 'Editorial Design', 'Design principles tailored for editorial platforms.', 'editorial-design', 1, 'on', '2025-09-25 15:25:13', 'book'),
(3, 'CMS Architecture', 'Structural and modular design of content systems.', 'cms-architecture', 2, 'on', '2025-09-25 15:25:13', 'global'),
(4, 'PHP Development', 'Native PHP techniques for backend publishing tools.', 'php-development', 3, 'on', '2025-09-25 15:25:13', 'photo_gallery'),
(5, 'UX Patterns', 'User experience strategies for editorial workflows.', 'ux-patterns', 4, 'on', '2025-09-25 15:25:13', 'global'),
(6, 'Content Strategy', 'Planning and organizing editorial content.', 'content-strategy', 5, 'on', '2025-09-25 15:25:13', 'article'),
(7, 'Debugging & QA', 'Troubleshooting and testing publishing systems.', 'debugging-qa', 6, 'on', '2025-09-25 15:25:13', 'article'),
(8, 'Search Optimization', 'Improving search relevance and performance.', 'search-optimization', 7, 'on', '2025-09-25 15:25:13', 'global'),
(9, 'Modular Design', 'Reusable components and scalable architecture.', 'modular-design', 8, 'on', '2025-09-25 15:25:13', 'global'),
(10, 'Visual Design', 'Banner images, layout, and visual storytelling.', 'visual-design', 9, 'on', '2025-09-25 15:25:13', 'global'),
(11, 'Publishing Workflow', 'From draft to publish—editorial flow management.', 'publishing-workflow', 10, 'on', '2025-09-25 15:25:13', 'global'),
(12, 'Database Tuning', 'Optimizing SQL queries and schema for CMS.', 'database-tuning', 11, 'on', '2025-09-25 15:25:13', 'global'),
(13, 'SEO & URLs', 'Structuring URLs and metadata for search engines.', 'seo-urls', 12, 'on', '2025-09-25 15:25:13', 'article'),
(14, 'Team Collaboration', 'Tools and practices for editorial teamwork.', 'team-collaboration', 13, 'on', '2025-09-25 15:25:13', 'global'),
(15, 'Desktop UI', 'Designing for desktop-first editorial tools.', 'desktop-ui', 14, 'on', '2025-09-25 15:25:13', 'global'),
(16, 'Content Curation', 'Selecting and organizing high-quality content.', 'content-curation', 15, 'on', '2025-09-25 15:25:13', 'global'),
(17, 'Performance Optimization', 'Speed and efficiency in CMS systems.', 'performance-optimization', 16, 'on', '2025-09-25 15:25:13', 'global'),
(18, 'Advanced Filters', 'Precision filtering tools for editors.', 'advanced-filters', 17, 'on', '2025-09-25 15:25:13', 'global'),
(19, 'Legacy Systems', 'Modernizing and refactoring old CMS platforms.', 'legacy-systems', 18, 'on', '2025-09-25 15:25:13', 'article'),
(20, 'Narrative Building', 'Crafting compelling editorial stories.', 'narrative-building', 19, 'on', '2025-09-25 15:25:13', 'global'),
(21, 'Editorial Automation', 'Automating repetitive editorial tasks.', 'editorial-automation', 20, 'on', '2025-09-25 15:25:13', 'global');

-- --------------------------------------------------------

--
-- Table structure for table `main_menu`
--

DROP TABLE IF EXISTS `main_menu`;
CREATE TABLE IF NOT EXISTS `main_menu` (
  `key_main_menu` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `parent_id` int(10) UNSIGNED NOT NULL DEFAULT '0',
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `sort` smallint(6) NOT NULL DEFAULT '0',
  `status` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `entry_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_main_menu`)
) ENGINE=MyISAM AUTO_INCREMENT=11 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `main_menu`
--

INSERT INTO `main_menu` (`key_main_menu`, `parent_id`, `title`, `url`, `sort`, `status`, `entry_date_time`) VALUES
(3, 0, 'Books', 'books', 1, 'on', '2025-09-25 15:32:44'),
(4, 0, 'Articles', 'articles', 2, 'on', '2025-09-25 15:32:44'),
(5, 4, 'Categories', 'book-categories', 1, 'on', '2025-09-25 15:32:44'),
(6, 3, 'Authors', 'book-authors', 2, 'on', '2025-09-25 15:32:44'),
(7, 4, 'Editorial', 'articles-editorial', 1, 'on', '2025-09-25 15:32:44'),
(8, 3, 'Tech', 'articles-tech', 2, 'on', '2025-09-25 15:32:44'),
(9, 0, 'Departments', 'departments', 3, 'on', '2025-09-25 16:08:48'),
(10, 9, 'Education', 'education-department', 0, 'on', '2025-09-25 16:09:10');

-- --------------------------------------------------------

--
-- Table structure for table `pages`
--

DROP TABLE IF EXISTS `pages`;
CREATE TABLE IF NOT EXISTS `pages` (
  `key_pages` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `banner_image_url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `title` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `page_content` text COLLATE utf8_unicode_ci NOT NULL,
  `url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `status` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `entry_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  `update_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_pages`)
) ENGINE=MyISAM AUTO_INCREMENT=12 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `pages`
--

INSERT INTO `pages` (`key_pages`, `banner_image_url`, `title`, `page_content`, `url`, `status`, `entry_date_time`, `update_date_time`) VALUES
(1, '', 'My First page', 'content of the very first page', 'url-of-the-first-page', 'on', '2025-09-24 13:35:42', '2025-09-24 13:35:51'),
(2, 'banner-home.jpg', 'Home', 'Welcome to our editorial platform. Discover articles, books, and more.', 'home', 'on', '2025-09-25 15:27:07', '2025-09-25 15:27:07'),
(3, 'banner-about.jpg', 'About Us', 'We build tools that empower editorial teams through clean design and modular workflows.', 'about-us', 'on', '2025-09-25 15:27:07', '2025-09-25 15:27:07'),
(4, 'banner-contact.jpg', 'Contact', 'Reach out to us via email or social media. We value your feedback.', 'contact', 'on', '2025-09-25 15:27:07', '2025-09-25 15:27:07'),
(5, 'banner-privacy.jpg', 'Privacy Policy', 'This page outlines how we handle user data and respect privacy.', 'privacy-policy', 'on', '2025-09-25 15:27:07', '2025-09-25 15:27:07'),
(6, 'banner-terms.jpg', 'Terms of Use', 'By using this site, you agree to our terms and conditions.', 'terms-of-use', 'on', '2025-09-25 15:27:07', '2025-09-25 15:27:07'),
(7, 'banner-authors.jpg', 'Authors', 'Meet the contributors who shape our editorial voice.', 'authors', 'on', '2025-09-25 15:27:07', '2025-09-29 22:05:39'),
(8, 'banner-books.jpg', 'Books', 'Explore our curated collection of publishing and design books.', 'books', 'on', '2025-09-25 15:27:07', '2025-09-25 15:27:07'),
(9, 'banner-categories.jpg', 'Categories', 'Browse content by editorial categories and themes.', 'categories', 'on', '2025-09-25 15:27:07', '2025-09-25 15:27:07'),
(10, 'banner-editorial.jpg', 'Editorial Philosophy', 'Our approach to content creation, curation, and publishing.', 'editorial-philosophy', 'on', '2025-09-25 15:27:07', '2025-09-25 15:27:07'),
(11, 'banner-feedback.jpg', 'Feedback', 'Tell us what you think. Help us improve the platform.', 'feedback', 'on', '2025-09-25 15:27:07', '2025-09-25 15:27:07');

-- --------------------------------------------------------

--
-- Table structure for table `photo_categories`
--

DROP TABLE IF EXISTS `photo_categories`;
CREATE TABLE IF NOT EXISTS `photo_categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_photo_gallery` int(10) UNSIGNED NOT NULL,
  `key_categories` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_pair` (`key_photo_gallery`,`key_categories`),
  KEY `key_categories` (`key_categories`)
) ENGINE=MyISAM AUTO_INCREMENT=27 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `photo_categories`
--

INSERT INTO `photo_categories` (`id`, `key_photo_gallery`, `key_categories`) VALUES
(26, 6, 21),
(25, 6, 12),
(24, 4, 12),
(23, 4, 5);

-- --------------------------------------------------------

--
-- Table structure for table `photo_gallery`
--

DROP TABLE IF EXISTS `photo_gallery`;
CREATE TABLE IF NOT EXISTS `photo_gallery` (
  `key_photo_gallery` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `image_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entry_date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_photo_gallery`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `photo_gallery`
--

INSERT INTO `photo_gallery` (`key_photo_gallery`, `title`, `image_url`, `description`, `status`, `entry_date_time`) VALUES
(1, 'Mountain Sunrise', 'https://picsum.photos/id/1018/800/600', 'A breathtaking sunrise over the mountains.', 'on', '2025-09-30 03:07:08'),
(2, 'City Reflections', 'https://picsum.photos/id/1025/800/600', 'Urban reflections captured at dusk.k', 'on', '2025-09-30 03:07:02'),
(3, 'Desert Wanderer', 'https://images.unsplash.com/photo-1506744038136-46273834b3fb', 'A lone traveler in the vast desert.', 'on', '2025-09-30 14:41:27'),
(4, 'Modern Architecture', 'https://images.unsplash.com/photo-1758445048994-d337f97acf4c?w=500', 'Modern architecture with a person on a balcony.', 'on', '2025-09-30 14:52:26'),
(5, 'Lined up Trees', 'https://fastly.picsum.photos/id/568/500/250.jpg?hmac=tVgo0DMwBaQM-ZkExvcWJ5Ivj7oM5iAQYy1B4bIc9tM', '', 'on', '2025-09-29 18:37:27'),
(6, 'Yet Another Photo', 'https://picsum.photos/id/1018/800/600', '', 'on', '2025-09-30 14:53:16');

-- --------------------------------------------------------

--
-- Table structure for table `settings`
--

DROP TABLE IF EXISTS `settings`;
CREATE TABLE IF NOT EXISTS `settings` (
  `key_settings` int(10) UNSIGNED NOT NULL,
  `site_name` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `site_slogan` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `logo1_url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `logo2_url` varchar(200) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `base_url` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `banner_height` varchar(5) COLLATE utf8_unicode_ci NOT NULL DEFAULT '400',
  `footer_content` varchar(2000) COLLATE utf8_unicode_ci NOT NULL DEFAULT '',
  `snippet_size` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '500',
  `items_on_page` varchar(3) COLLATE utf8_unicode_ci NOT NULL DEFAULT '50',
  `template_folder` varchar(100) COLLATE utf8_unicode_ci NOT NULL DEFAULT 'templates/basic',
  `entry_date_time` timestamp NOT NULL DEFAULT CURRENT_TIMESTAMP
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`key_settings`, `site_name`, `site_slogan`, `logo1_url`, `logo2_url`, `base_url`, `banner_height`, `footer_content`, `snippet_size`, `items_on_page`, `template_folder`, `entry_date_time`) VALUES
(1, 'My First Sites', '', '', '', '', '300', '', '500', '50', 'templates/basic', '2025-09-23 20:25:46');

-- --------------------------------------------------------

--
-- Table structure for table `youtube_categories`
--

DROP TABLE IF EXISTS `youtube_categories`;
CREATE TABLE IF NOT EXISTS `youtube_categories` (
  `id` int(10) UNSIGNED NOT NULL AUTO_INCREMENT,
  `key_youtube_gallery` int(10) UNSIGNED NOT NULL,
  `key_categories` int(10) UNSIGNED NOT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `unique_pair` (`key_youtube_gallery`,`key_categories`),
  KEY `key_categories` (`key_categories`)
) ENGINE=MyISAM AUTO_INCREMENT=7 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `youtube_categories`
--

INSERT INTO `youtube_categories` (`id`, `key_youtube_gallery`, `key_categories`) VALUES
(6, 7, 15),
(5, 7, 8);

-- --------------------------------------------------------

--
-- Table structure for table `youtube_gallery`
--

DROP TABLE IF EXISTS `youtube_gallery`;
CREATE TABLE IF NOT EXISTS `youtube_gallery` (
  `key_youtube_gallery` int(11) NOT NULL AUTO_INCREMENT,
  `title` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `youtube_id` varchar(20) COLLATE utf8_unicode_ci DEFAULT NULL,
  `thumbnail_url` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `description` text COLLATE utf8_unicode_ci,
  `status` varchar(50) COLLATE utf8_unicode_ci DEFAULT NULL,
  `entry_date_time` datetime DEFAULT CURRENT_TIMESTAMP,
  PRIMARY KEY (`key_youtube_gallery`)
) ENGINE=MyISAM AUTO_INCREMENT=8 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `youtube_gallery`
--

INSERT INTO `youtube_gallery` (`key_youtube_gallery`, `title`, `youtube_id`, `thumbnail_url`, `description`, `status`, `entry_date_time`) VALUES
(7, 'Responsibility (1953)', 'j9TWBV_gKf8', 'https://i.ytimg.com/an_webp/-CBImgCQEKw/mqdefault_6s.webp?du=3000&sqp=CLjK7sYG&rs=AOn4CLA07kasjQiTlivo4pjkyReP6sDDag', '', 'on', '2025-09-30 16:15:47'),
(6, 'Maintaining Classroom Discipline (1947)', 'j9TWBV_gKf8', 'https://i.ytimg.com/vi/j9TWBV_gKf8/hqdefault.jpg?sqp=-oaymwFBCOADEI4CSFryq4qpAzMIARUAAIhCGAHYAQHiAQoIGBACGAY4AUAB8AEB-AH-BIAC4AOKAgwIABABGGUgZShlMA8=&rs=AOn4CLCrEcdHpJcjiibQ2V7gKlqqXmtZHQ', '', 'on', '2025-09-30 16:07:03'),
(4, 'From the Vault: Qadir takes five at the MCG', 'CbOy9J8i1sk', 'https://i3.ytimg.com/vi/CbOy9J8i1sk/maxresdefault.jpg', 'Despite a record-breaking 268 from Australia\'s Graham Yallop, Pakistan leg-spinner Abdul Qadir held firm with five wickets in the 1983 Boxing Day Tests\r\n', 'on', '2025-09-30 16:00:14'),
(5, 'Tony Greg Commentry Gold', '59aoWggycSE', 'https://i.ytimg.com/vi/59aoWggycSE/hq720.jpg?sqp=-oaymwFBCNAFEJQDSFryq4qpAzMIARUAAIhCGAHYAQHiAQoIGBACGAY4AUAB8AEB-AG-B4AC0AWKAgwIABABGGUgVihPMA8=&rs=AOn4CLC1vmDZWpIc0QAsD6f6fdIW8J0mKw', '', 'on', '2025-09-30 16:05:06');

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

--
-- Indexes for table `books`
--
ALTER TABLE `books` ADD FULLTEXT KEY `title` (`title`,`subtitle`,`publisher`,`description`,`author_name`);

--
-- Indexes for table `categories`
--
ALTER TABLE `categories` ADD FULLTEXT KEY `name` (`name`,`description`);

--
-- Indexes for table `pages`
--
ALTER TABLE `pages` ADD FULLTEXT KEY `title` (`title`,`page_content`);

--
-- Indexes for table `photo_gallery`
--
ALTER TABLE `photo_gallery` ADD FULLTEXT KEY `title` (`title`,`description`);

--
-- Indexes for table `youtube_gallery`
--
ALTER TABLE `youtube_gallery` ADD FULLTEXT KEY `title` (`title`,`description`);
COMMIT;

/*!40101 SET CHARACTER_SET_CLIENT=@OLD_CHARACTER_SET_CLIENT */;
/*!40101 SET CHARACTER_SET_RESULTS=@OLD_CHARACTER_SET_RESULTS */;
/*!40101 SET COLLATION_CONNECTION=@OLD_COLLATION_CONNECTION */;
