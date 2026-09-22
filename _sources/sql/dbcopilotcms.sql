-- phpMyAdmin SQL Dump
-- version 5.2.0
-- https://www.phpmyadmin.net/
--
-- Host: 127.0.0.1:3306
-- Generation Time: Sep 22, 2026 at 02:55 AM
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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `articles`
--

INSERT INTO `articles` (`key_articles`, `key_media_banner`, `document_code`, `title`, `title_sub`, `article_snippet`, `article_content`, `content_type`, `content_direction`, `book_indent_level`, `url`, `banner_image_url`, `sort`, `entry_date_time`, `update_date_time`, `created_by`, `updated_by`, `is_featured`, `show_on_home`, `show_in_listing`, `is_active`) VALUES
(1, 0, '', 'An Introduction to Javascript', '', 'JavaScript is a high-level, interpreted programming language primarily used to add interactivity and dynamic behavior to websites. ', '    <p>\r\n      JavaScript is one of the most important and widely used programming\r\n      languages in the world. Originally created to make web pages interactive,\r\n      JavaScript has evolved into a powerful, versatile language used for\r\n      websites, web applications, servers, mobile applications, desktop\r\n      software, games, and even artificial intelligence tools.\r\n    </p>\r\n\r\n  <section>\r\n    <h2>What Is JavaScript?</h2>\r\n\r\n    <p>\r\n      JavaScript is a high-level, interpreted programming language primarily\r\n      used to add interactivity and dynamic behavior to websites. While\r\n      <strong>HTML</strong> provides the structure of a web page and\r\n      <strong>CSS</strong> controls its appearance and presentation,\r\n      <strong>JavaScript</strong> provides much of the behavior and logic.\r\n    </p>\r\n\r\n    <p>\r\n      For example, HTML can create a button, CSS can make that button look\r\n      attractive, and JavaScript can determine what happens when a visitor\r\n      clicks it. JavaScript can display messages, validate forms, modify page\r\n      content, create animations, communicate with web servers, process data,\r\n      and respond to user actions.\r\n    </p>\r\n\r\n    <p>\r\n      JavaScript is commonly abbreviated as <strong>JS</strong>. Despite the\r\n      similarity in name, JavaScript is not the same programming language as\r\n      Java. They were developed independently and have different syntax,\r\n      concepts, and uses.\r\n    </p>\r\n  </section>\r\n\r\n  <section>\r\n    <h2>A Brief History of JavaScript</h2>\r\n\r\n    <p>\r\n      JavaScript was created in 1995 by <strong>Brendan Eich</strong> while he\r\n      was working at Netscape Communications. The original goal was to create\r\n      a scripting language that could be used within web browsers to make\r\n      web pages more interactive.\r\n    </p>\r\n\r\n    <p>\r\n      The language was initially developed under the name\r\n      <strong>Mocha</strong>. It was later called <strong>LiveScript</strong>\r\n      and eventually JavaScript. The name was influenced by the popularity of\r\n      Java at the time, although JavaScript itself was not derived from Java.\r\n    </p>\r\n\r\n    <p>\r\n      As web development grew, different browsers began implementing\r\n      JavaScript in their own ways. To promote consistency, JavaScript was\r\n      standardized through <strong>ECMAScript</strong>, a specification\r\n      maintained by <strong>ECMA International</strong>.\r\n    </p>\r\n\r\n    <p>\r\n      Modern JavaScript is therefore closely associated with the ECMAScript\r\n      standard. New versions of the standard have introduced features that\r\n      have made JavaScript more powerful, readable, and suitable for\r\n      large-scale software development.\r\n    </p><p>â€¦â€¦</p></section><section>\r\n  </section>\r\n', '', 'ltr', 0, 'an-introduction-to-javascript', '', 0, '2026-09-05 01:49:44', '2026-09-22 07:54:35', 1, 1, 0, 1, 1, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=6 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `blocks`
--

INSERT INTO `blocks` (`key_blocks`, `key_media_banner`, `key_photo_gallery`, `key_content_types`, `key_categories`, `key_tags`, `module_file`, `block_name`, `title`, `css`, `number_of_records`, `visible_on`, `block_content`, `show_on_pages`, `show_in_region`, `entry_date_time`, `created_by`, `updated_by`, `sort`, `is_dynamic`, `is_active`) VALUES
(1, 0, 0, 0, 0, 0, '', 'Footer Message', '', '', 5, 'large-desktop,desktop,tablet,mobile', '&copy; www.mywebsite.com', '', 'footer', '2026-09-20 15:33:08', 1, 0, 0, 0, 1),
(2, 0, 0, 0, 0, 0, 'content_types_55448', 'Content Types', 'Content Types', '', 5, 'large-desktop,desktop,tablet,mobile', '', '', 'sidebar_right', '2026-09-20 15:33:53', 1, 0, 0, 0, 1),
(3, 0, 0, 0, 0, 0, 'categories_55448', 'Categories', 'Categories', '', 5, 'large-desktop,desktop,tablet,mobile', '', '', 'sidebar_right', '2026-09-20 15:34:45', 1, 0, 0, 0, 1),
(5, 0, 0, 0, 0, 0, 'search6545645', 'Search', 'Search', '', 5, 'large-desktop,desktop,tablet,mobile', '', '', 'sidebar_left', '2026-09-20 15:36:05', 1, 0, 0, 0, 1);

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
) ENGINE=InnoDB AUTO_INCREMENT=2 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `main_menu`
--

INSERT INTO `main_menu` (`key_main_menu`, `parent_id`, `title`, `url_link`, `css_class`, `sort`, `is_active`, `entry_date_time`) VALUES
(1, 0, 'Home', 'https://copilotcms.org', '', 0, 1, '2026-09-20 15:30:28');

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
  `custom_css` text COLLATE utf8_unicode_ci NOT NULL,
  PRIMARY KEY (`key_settings`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `settings`
--

INSERT INTO `settings` (`key_settings`, `template_folder`, `custom_css`) VALUES
(1, 'default', '');

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
) ENGINE=InnoDB AUTO_INCREMENT=99 DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

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
(38, 'template_default_logo', '/templates/default/images/copilogcms.png', 'general', '2025-10-15 04:56:36'),
(40, 'max_upload_image_width', '1200', 'media_library', '2025-10-15 22:12:04'),
(41, 'max_upload_image_height', '600', 'media_library', '2025-10-15 22:12:09'),
(42, 'template_text_color', 'black', 'css_colors', '2025-10-20 21:23:28'),
(43, 'template_background_color', '#FFF', 'css_colors', '2025-10-20 21:27:30'),
(45, 'items_brand_color', '#049b5c', 'css_colors', '2025-10-20 21:28:26'),
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
(56, 'template_max_width', '1300px', 'css_template', '2025-11-07 17:21:27'),
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
(77, 'css_version', '43', 'css_template', '2025-12-09 23:46:37'),
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
(98, 'search_results_per_page', '15', 'search', '2026-09-20 08:19:42');

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
