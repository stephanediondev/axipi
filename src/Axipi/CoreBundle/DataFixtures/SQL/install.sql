SET FOREIGN_KEY_CHECKS=0;

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------

--
-- Table structure for table `component`
--

DROP TABLE IF EXISTS `component`;
CREATE TABLE IF NOT EXISTS `component` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `zone_id` int(10) unsigned DEFAULT NULL,
  `service` varchar(255) NOT NULL,
  `title` varchar(255) NOT NULL,
  `parent` int(10) unsigned DEFAULT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `is_unique` tinyint(1) NOT NULL DEFAULT '0',
  `is_search` tinyint(1) NOT NULL DEFAULT '0',
  `is_sitemap` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `category` varchar(255) NOT NULL,
  `attributes_schema` longtext,
  PRIMARY KEY (`id`),
  UNIQUE KEY `service` (`service`),
  KEY `parent` (`parent`),
  KEY `zone_id` (`zone_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `component`
--

INSERT INTO `component` (`id`, `zone_id`, `service`, `title`, `parent`, `icon`, `is_unique`, `is_search`, `is_sitemap`, `is_active`, `date_created`, `date_modified`, `category`, `attributes_schema`) VALUES
(3, NULL, 'axipi_content_controller_content', 'Content', NULL, 'file-text-o', 0, 1, 1, 1, '2016-05-18 17:44:09', NULL, 'page', NULL),
(4, NULL, 'axipi_content_widget_content', 'Content', NULL, 'file-text-o', 0, 0, 0, 0, '2016-05-18 18:10:25', NULL, 'widget', NULL),
(5, NULL, 'axipi_gallery_controller_album', 'Gallery / Album', NULL, 'picture-o', 0, 0, 0, 1, '2016-05-18 22:35:46', '2016-05-20 19:00:18', 'page', NULL),
(6, NULL, 'axipi_gallery_controller_media', 'Gallery / Media', 5, 'picture-o', 0, 0, 0, 1, '2016-05-18 22:36:09', '2016-05-20 19:00:24', 'page', NULL),
(7, NULL, 'axipi_google_widget_analytics', 'Google Analytics', NULL, 'google', 0, 0, 0, 1, '2016-05-18 22:36:43', '2016-05-20 20:40:43', 'widget', '{\r\n            type: "object",\r\n            title: "Google Analytics",\r\n            properties: {\r\n                code: {\r\n                    type: "string"\r\n                }\r\n            }\r\n        }'),
(8, NULL, 'axipi_content_widget_menu', 'Menu', NULL, 'bars', 0, 0, 0, 1, '2016-05-18 22:37:33', '2016-05-21 00:12:35', 'widget', NULL),
(9, NULL, 'axipi_content_controller_link', 'Link', NULL, 'share-square-o', 0, 0, 0, 1, '2016-05-18 22:38:59', '2016-05-20 20:46:10', 'page', '{\r\n            type: "object",\r\n            title: "Link",\r\n            properties: {\r\n                url: {\r\n                    type: "string"\r\n                }\r\n            }\r\n        }'),
(10, NULL, 'axipi_blog_controller_blog', 'Blog', NULL, 'pencil-square-o', 0, 0, 0, 1, '2016-05-18 22:39:45', '2016-05-21 00:12:10', 'page', NULL),
(11, NULL, 'axipi_blog_controller_category', 'Blog / Category', 10, 'pencil-square-o', 0, 0, 0, 1, '2016-05-18 22:39:51', '2016-05-21 00:11:53', 'page', NULL),
(12, NULL, 'axipi_blog_controller_post', 'Blog / Post', 11, 'pencil-square-o', 0, 0, 0, 1, '2016-05-18 22:40:24', '2016-05-21 00:12:24', 'page', NULL),
(13, NULL, 'axipi_content_controller_home', 'Home', NULL, 'home', 1, 0, 0, 1, '2016-05-18 22:44:46', '2016-05-20 23:16:11', 'page', NULL),
(14, NULL, 'axipi_google_widget_searchconsole', 'Google Search Console', NULL, 'google', 0, 0, 0, 1, '2016-05-20 18:42:10', '2016-05-20 20:43:24', 'widget', '{\r\n            type: "object",\r\n            title: "Google Search Console",\r\n            properties: {\r\n                code: {\r\n                    type: "string"\r\n                }\r\n            }\r\n        }'),
(15, NULL, 'axipi_content_controller_error404', 'Error 404', NULL, 'times', 1, 0, 0, 1, '2016-05-20 23:16:31', '2016-05-20 23:17:01', 'page', NULL),
(16, NULL, 'axipi_content_widget_breadcrumbs', 'Breadcrumbs', NULL, 'road', 0, 0, 0, 1, '2016-05-20 23:52:18', '2016-05-21 00:01:04', 'widget', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `country`
--

DROP TABLE IF EXISTS `country`;
CREATE TABLE IF NOT EXISTS `country` (
  `id` int(10) unsigned NOT NULL,
  `code` char(2) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `country`
--

INSERT INTO `country` (`id`, `code`, `title`, `date_created`, `date_modified`) VALUES
(250, 'fr', 'France', '2016-05-18 20:24:25', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE IF NOT EXISTS `language` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` char(2) NOT NULL,
  `title` varchar(255) NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `code`, `title`, `date_created`, `date_modified`) VALUES
(1, 'fr', 'Français', '2016-05-18 20:24:38', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
CREATE TABLE IF NOT EXISTS `page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `program_id` int(10) unsigned NOT NULL,
  `component_id` int(10) unsigned NOT NULL,
  `title` varchar(255) NOT NULL,
  `code` varchar(30) NOT NULL,
  `parent` int(10) unsigned DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  `title_seo` varchar(255) DEFAULT NULL,
  `description_seo` text,
  `meta_robots` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `attributes` longtext,
  `date_created` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `program_id_code` (`program_id`,`code`),
  UNIQUE KEY `program_id_slug` (`program_id`,`slug`),
  KEY `component_id` (`component_id`),
  KEY `parent` (`parent`),
  KEY `program_id` (`program_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `program_id`, `component_id`, `title`, `code`, `parent`, `slug`, `title_seo`, `description_seo`, `meta_robots`, `is_active`, `ordering`, `attributes`, `date_created`, `date_modified`) VALUES
(1, 1, 3, 'd', 'd', 12, 'a/b/c/d', NULL, NULL, NULL, 1, 0, NULL, '2016-05-18 18:27:14', '2016-05-21 00:10:11'),
(2, 1, 15, 'Error 404', 'error404', NULL, 'error404', NULL, NULL, NULL, 1, 0, NULL, '2016-05-18 21:45:27', '2016-05-20 23:18:45'),
(3, 1, 5, 'Album', 'album', NULL, 'album', NULL, NULL, NULL, 1, 0, NULL, '2016-05-18 20:38:09', '2016-05-20 23:39:30'),
(4, 1, 9, 'Axipi', 'axipi-link', NULL, 'axipi', NULL, NULL, NULL, 1, 0, '{"url":"https://code.sdion.net/opensource/axipi"}', '2016-05-20 19:53:05', '2016-05-21 00:14:48'),
(5, 1, 10, 'Blog', 'blog', NULL, 'blog', NULL, NULL, NULL, 0, 0, NULL, '2016-05-20 23:31:20', '2016-05-20 23:31:20'),
(6, 1, 11, 'Blog category', 'blog-cat', 5, 'blog/category', NULL, NULL, NULL, 1, 0, NULL, '2016-05-20 23:31:54', '2016-05-21 00:14:08'),
(7, 1, 12, 'Blog post', 'blog-post', 6, 'blog/category/post', NULL, NULL, NULL, 1, 0, NULL, '2016-05-20 23:32:13', '2016-05-21 00:13:55'),
(8, 1, 6, 'Media', 'media', 3, 'album/media', NULL, NULL, NULL, 1, 0, NULL, '2016-05-20 23:39:47', '2016-05-20 23:39:47'),
(9, 1, 13, 'Home', 'home', NULL, 'home', NULL, NULL, NULL, 1, 0, NULL, '2016-05-20 23:46:13', '2016-05-20 23:46:13'),
(10, 1, 3, 'a', 'a', NULL, 'a', NULL, NULL, NULL, 1, 0, NULL, '2016-05-21 00:08:48', '2016-05-21 00:08:48'),
(11, 1, 3, 'b', 'b', 10, 'a/b', NULL, NULL, NULL, 1, 0, NULL, '2016-05-21 00:09:01', '2016-05-21 00:09:30'),
(12, 1, 3, 'c', 'c', 11, 'a/b/c', NULL, NULL, NULL, 0, 0, NULL, '2016-05-21 00:09:16', '2016-05-21 00:09:16');

-- --------------------------------------------------------

--
-- Table structure for table `program`
--

DROP TABLE IF EXISTS `program`;
CREATE TABLE IF NOT EXISTS `program` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` int(10) unsigned NOT NULL,
  `country_id` int(10) unsigned NOT NULL,
  `description_seo` text,
  `timezone` varchar(255) NOT NULL,
  `is_default` tinyint(1) NOT NULL DEFAULT '0',
  `has_maintenance` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `language_id_country_id` (`language_id`,`country_id`),
  KEY `language_id` (`language_id`),
  KEY `country_id` (`country_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `program`
--

INSERT INTO `program` (`id`, `language_id`, `country_id`, `description_seo`, `timezone`, `is_default`, `has_maintenance`, `date_created`, `date_modified`) VALUES
(1, 1, 250, NULL, '', 1, 0, '2016-05-18 20:24:51', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `program_user`
--

DROP TABLE IF EXISTS `program_user`;
CREATE TABLE IF NOT EXISTS `program_user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `program_id` int(10) unsigned NOT NULL,
  `user_id` int(10) unsigned NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `program_id_user_id` (`program_id`,`user_id`),
  KEY `program_id` (`program_id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `program_user`
--


-- --------------------------------------------------------

--
-- Table structure for table `token`
--

DROP TABLE IF EXISTS `token`;
CREATE TABLE IF NOT EXISTS `token` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `user_id` int(10) unsigned NOT NULL,
  `origin` varchar(255) NOT NULL,
  `token` text NOT NULL,
  `date_created` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  KEY `user_id` (`user_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `token`
--


-- --------------------------------------------------------

--
-- Table structure for table `user`
--

DROP TABLE IF EXISTS `user`;
CREATE TABLE IF NOT EXISTS `user` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` char(60) NOT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) DEFAULT NULL,
  `is_authorized` tinyint(1) NOT NULL DEFAULT '0',
  `roles` longtext,
  `date_created` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `firstname`, `lastname`, `is_authorized`, `roles`, `date_created`, `date_modified`) VALUES
(1, 'example@example.com', '$2y$13$5lgE1eupJw7yp1fVuAing.M7Bov4AcopfAmeXhRv3s7EljCzLJm6i', 'Example', NULL, 1, '["ROLE_ADMIN"]', '2016-05-19 22:06:18', NULL);

-- --------------------------------------------------------

--
-- Table structure for table `widget`
--

DROP TABLE IF EXISTS `widget`;
CREATE TABLE IF NOT EXISTS `widget` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `program_id` int(10) unsigned NOT NULL,
  `component_id` int(10) unsigned NOT NULL,
  `zone_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `code` varchar(30) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `attributes` longtext,
  `date_created` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `program_id_code` (`program_id`,`code`),
  KEY `component_id` (`component_id`),
  KEY `zone_id` (`zone_id`),
  KEY `program_id` (`program_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `widget`
--

INSERT INTO `widget` (`id`, `program_id`, `component_id`, `zone_id`, `title`, `code`, `is_active`, `ordering`, `attributes`, `date_created`, `date_modified`) VALUES
(1, 1, 4, 1, 'Footer aa', 'footer', 1, 0, NULL, '2016-05-18 21:16:37', NULL),
(2, 1, 7, 1, 'GA', 'ga', 0, 0, '{"code":"--"}', '2016-05-20 18:29:31', '2016-05-21 00:16:43'),
(3, 1, 8, 3, 'Menu', 'menu', 1, 0, NULL, '2016-05-20 18:30:12', '2016-05-21 00:19:31'),
(4, 1, 14, 1, 'Search Console', 'searchconsole', 0, 0, '{"code":"ee"}', '2016-05-20 19:28:25', '2016-05-20 20:55:50'),
(5, 1, 16, 2, 'Breadcrumbs', 'breadcrumbs', 1, 0, NULL, '2016-05-20 20:56:07', '2016-05-21 00:03:00');

-- --------------------------------------------------------

--
-- Table structure for table `widget_page`
--

DROP TABLE IF EXISTS `widget_page`;
CREATE TABLE IF NOT EXISTS `widget_page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `widget_id` int(10) unsigned NOT NULL,
  `page_id` int(10) unsigned NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `widget_id_page_id` (`widget_id`,`page_id`),
  KEY `widget_id` (`widget_id`),
  KEY `page_id` (`page_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

--
-- Dumping data for table `widget_page`
--


-- --------------------------------------------------------

--
-- Table structure for table `zone`
--

DROP TABLE IF EXISTS `zone`;
CREATE TABLE IF NOT EXISTS `zone` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(30) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `zone`
--

INSERT INTO `zone` (`id`, `code`, `is_active`, `date_created`, `date_modified`) VALUES
(1, 'footer', 1, '2016-05-18 21:17:11', NULL),
(2, 'before_content', 1, '2016-05-21 02:01:25', NULL),
(3, 'navbar-collapse', 1, '2016-05-21 02:18:34', NULL);

--
-- Constraints for dumped tables
--

--
-- Constraints for table `component`
--
ALTER TABLE `component`
  ADD CONSTRAINT `FK_49FEA1573D8E604F` FOREIGN KEY (`parent`) REFERENCES `component` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_49FEA1579F2C3FAB` FOREIGN KEY (`zone_id`) REFERENCES `zone` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `page`
--
ALTER TABLE `page`
  ADD CONSTRAINT `FK_140AB6203D8E604F` FOREIGN KEY (`parent`) REFERENCES `page` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_140AB6203EB8070A` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_140AB620E2ABAFFF` FOREIGN KEY (`component_id`) REFERENCES `component` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `program`
--
ALTER TABLE `program`
  ADD CONSTRAINT `FK_92ED778482F1BAF4` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_92ED7784F92F3E70` FOREIGN KEY (`country_id`) REFERENCES `country` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `program_user`
--
ALTER TABLE `program_user`
  ADD CONSTRAINT `FK_8075834E3EB8070A` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8075834EA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `FK_5F37A13BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `widget`
--
ALTER TABLE `widget`
  ADD CONSTRAINT `FK_85F91ED03EB8070A` FOREIGN KEY (`program_id`) REFERENCES `program` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_85F91ED09F2C3FAB` FOREIGN KEY (`zone_id`) REFERENCES `zone` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_85F91ED0E2ABAFFF` FOREIGN KEY (`component_id`) REFERENCES `component` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `widget_page`
--
ALTER TABLE `widget_page`
  ADD CONSTRAINT `FK_8CFDBD9FC4663E4` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8CFDBD9FFBE885E2` FOREIGN KEY (`widget_id`) REFERENCES `widget` (`id`) ON DELETE CASCADE;

SET FOREIGN_KEY_CHECKS=1;