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
  `template` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `service` (`service`),
  KEY `parent` (`parent`),
  KEY `zone_id` (`zone_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `component`
--

INSERT INTO `component` (`id`, `zone_id`, `service`, `title`, `parent`, `icon`, `is_unique`, `is_search`, `is_sitemap`, `is_active`, `date_created`, `date_modified`, `category`, `attributes_schema`, `template`) VALUES
(3, NULL, 'axipi_content_controller_page', 'Content / Page', NULL, 'file-text-o', 0, 1, 1, 1, '2016-05-18 17:44:09', '2016-05-23 20:17:33', 'page', '{\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "class":"wysiwyg"\r\n            }\r\n        }\r\n    },\r\n    "thumbnail": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    }\r\n}', 'AxipiContentBundle:Page:page.html.twig'),
(4, NULL, 'axipi_content_widget_block', 'Content / Block', NULL, 'file-text-o', 0, 0, 0, 1, '2016-05-18 18:10:25', '2016-05-25 16:59:33', 'widget', '{\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": "false",\r\n"attr": {"class":"wysiwyg"}\r\n        }\r\n    }\r\n}', 'AxipiContentBundle:Widget:block.html.twig'),
(5, NULL, 'axipi_gallery_controller_album', 'Gallery / Album', NULL, 'picture-o', 0, 0, 0, 1, '2016-05-18 22:35:46', '2016-05-20 19:00:18', 'page', '{\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "class":"wysiwyg"\r\n            }\r\n        }\r\n    },\r\n    "thumbnail": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    }\r\n}', 'AxipiGalleryBundle:Page:album.html.twig'),
(6, NULL, 'axipi_gallery_controller_media', 'Gallery / Media', 5, 'picture-o', 0, 0, 0, 1, '2016-05-18 22:36:09', '2016-05-20 19:00:24', 'page', '{\r\n    "image": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": "true"\r\n        }\r\n    },\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": "false",\r\n"attr": {"class":"wysiwyg"}\r\n        }\r\n    }\r\n}\r\n', 'AxipiGalleryBundle:Page:media.html.twig'),
(7, 2, 'axipi_google_widget_analytics', 'Google / Analytics', NULL, 'google', 0, 0, 0, 1, '2016-05-18 22:36:43', '2016-05-25 17:23:39', 'widget', '{\r\n    "code": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "true"\r\n        }\r\n    }\r\n}', 'AxipiGoogleBundle:Widget:analytics.html.twig'),
(8, NULL, 'axipi_content_widget_menu', 'Content / Menu', NULL, 'bars', 0, 0, 0, 1, '2016-05-18 22:37:33', '2016-05-25 16:59:08', 'widget', '{\r\n    "display_title": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\CheckboxType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    },\r\n    "class": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    }\r\n}', 'AxipiContentBundle:Widget:menu.html.twig'),
(9, NULL, 'axipi_content_controller_link', 'Content / Link', NULL, 'share-square-o', 0, 0, 0, 1, '2016-05-18 22:38:59', '2016-05-23 20:17:46', 'page', '{\r\n    "url": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "true"\r\n        }\r\n    }\r\n}', NULL),
(10, NULL, 'axipi_blog_controller_blog', 'Blog', NULL, 'pencil-square-o', 0, 0, 0, 1, '2016-05-18 22:39:45', '2016-05-26 19:53:10', 'page', '{\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "class":"wysiwyg"\r\n            }\r\n        }\r\n    },\r\n    "thumbnail": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    }\r\n}', 'AxipiBlogBundle:Page:blog.html.twig'),
(11, NULL, 'axipi_blog_controller_category', 'Blog / Category', 10, 'pencil-square-o', 0, 0, 0, 1, '2016-05-18 22:39:51', '2016-05-26 20:11:02', 'page', '{\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "class":"wysiwyg"\r\n            }\r\n        }\r\n    },\r\n    "thumbnail": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    }\r\n}', 'AxipiBlogBundle:Page:category.html.twig'),
(12, NULL, 'axipi_blog_controller_post', 'Blog / Post', 11, 'pencil-square-o', 0, 0, 0, 1, '2016-05-18 22:40:24', '2016-05-26 20:11:37', 'page', '{\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "class":"wysiwyg"\r\n            }\r\n        }\r\n    },\r\n    "thumbnail": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    }\r\n}', 'AxipiBlogBundle:Page:post.html.twig'),
(13, NULL, 'axipi_content_controller_home', 'Content / Home', NULL, 'home', 1, 0, 0, 1, '2016-05-18 22:44:46', '2016-05-25 16:57:43', 'page', '{\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "class":"wysiwyg"\r\n            }\r\n        }\r\n    },\r\n    "thumbnail": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    }\r\n}', 'AxipiContentBundle:Page:home.html.twig'),
(14, NULL, 'axipi_google_widget_searchconsole', 'Google / Search Console', NULL, 'google', 0, 0, 0, 1, '2016-05-20 18:42:10', '2016-05-25 17:23:41', 'widget', '{\r\n    "code": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "true"\r\n        }\r\n    }\r\n}', 'AxipiGoogleBundle:Widget:searchconsole.html.twig'),
(15, NULL, 'axipi_content_controller_error404', 'Content / Error 404', NULL, 'times', 1, 0, 0, 1, '2016-05-20 23:16:31', '2016-05-25 16:58:51', 'page', NULL, 'AxipiContentBundle:Page:error404.html.twig'),
(16, NULL, 'axipi_content_widget_breadcrumbs', 'Content / Breadcrumbs', NULL, 'road', 0, 0, 0, 1, '2016-05-20 23:52:18', '2016-05-25 16:59:43', 'widget', NULL, 'AxipiContentBundle:Widget:breadcrumbs.html.twig'),
(17, NULL, 'axipi_google_widget_tagmanager', 'Google / Tag Manager', NULL, 'google', 0, 0, 0, 1, '2016-05-21 20:27:40', '2016-05-25 17:23:44', 'widget', '{\r\n    "code": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "true"\r\n        }\r\n    }\r\n}', 'AxipiGoogleBundle:Widget:tagmanager.html.twig'),
(18, NULL, 'axipi_content_widget_icon', 'Content / Favicon', NULL, 'star-o', 0, 0, 0, 1, '2016-05-23 20:06:34', '2016-05-25 16:59:20', 'widget', '{\r\n    "image": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": "true"\r\n        }\r\n    }\r\n}', 'AxipiContentBundle:Widget:icon.html.twig'),
(19, 4, 'axipi_twitter_widget_card', 'Twitter / Card', NULL, 'twitter', 0, 0, 0, 1, '2016-05-25 17:11:49', '2016-05-25 17:26:48', 'widget', '{\r\n    "site": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "true"\r\n        }\r\n    }\r\n}', 'AxipiTwitterBundle:Widget:card.html.twig'),
(20, 4, 'axipi_facebook_widget_opengraph', 'Facebook / Opengraph', NULL, 'facebook', 0, 0, 0, 1, '2016-05-25 17:13:13', '2016-05-25 17:23:30', 'widget', '{\r\n    "site": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "true"\r\n        }\r\n    }\r\n}', 'AxipiFacebookBundle:Widget:opengraph.html.twig'),
(21, NULL, 'axipi_contact_controller_form', 'Contact / Form', NULL, 'envelope-o', 0, 0, 0, 1, '2016-05-25 17:48:30', '2016-05-25 17:48:30', 'page', NULL, 'AxipiContactBundle:Page:form.html.twig'),
(22, NULL, 'axipi_google_controller_map', 'Google / Map', NULL, 'map-o', 0, 0, 0, 1, '2016-05-25 20:19:27', '2016-05-25 20:42:42', 'page', '{\r\n    "api_key": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "true"\r\n        }\r\n    },\r\n    "latitude": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "true"\r\n        }\r\n    },\r\n    "longitude": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "true"\r\n        }\r\n    },\r\n    "zoom": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "true"\r\n        }\r\n    },\r\n    "infowindow": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": "false",\r\n"attr": {"class":"wysiwyg"}\r\n        }\r\n    }\r\n}', 'AxipiGoogleBundle:Page:map.html.twig'),
(23, 5, 'axipi_blog_widget_categories', 'Blog / Categories', NULL, 'bars', 0, 0, 0, 1, '2016-05-26 20:01:00', '2016-05-26 20:01:00', 'widget', NULL, 'AxipiBlogBundle:Widget:categories.html.twig'),
(24, NULL, 'axipi_sitemap_controller_xml', 'Sitemap / Xml', NULL, 'code', 0, 0, 0, 1, '2016-05-27 09:53:41', '2016-05-27 09:55:37', 'page', NULL, 'AxipiSitemapBundle:Page:xml.xml.twig');

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
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `code`, `title`, `date_created`, `date_modified`, `is_active`) VALUES
(1, 'en', 'English', '2016-05-18 20:24:38', '2016-05-26 17:36:50', 1),
(2, 'fr', 'Français', '2016-05-26 17:37:14', '2016-05-26 17:37:14', 1);

-- --------------------------------------------------------

--
-- Table structure for table `page`
--

DROP TABLE IF EXISTS `page`;
CREATE TABLE IF NOT EXISTS `page` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` int(10) unsigned NOT NULL,
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
  `template` varchar(255) DEFAULT NULL,
  `title_social` varchar(255) DEFAULT NULL,
  `description_social` text,
  PRIMARY KEY (`id`),
  UNIQUE KEY `language_id_code` (`language_id`,`code`),
  UNIQUE KEY `language_id_slug` (`language_id`,`slug`),
  KEY `component_id` (`component_id`),
  KEY `parent` (`parent`),
  KEY `language_id` (`language_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `page`
--

INSERT INTO `page` (`id`, `language_id`, `component_id`, `title`, `code`, `parent`, `slug`, `title_seo`, `description_seo`, `meta_robots`, `is_active`, `ordering`, `attributes`, `date_created`, `date_modified`, `template`, `title_social`, `description_social`) VALUES
(1, 1, 3, 'd', 'd', 12, 'a/b/c/d', 'title seo', 'description seo', NULL, 1, 0, '{"description":"<h1>test<\\/h1>"}', '2016-05-18 18:27:14', '2016-05-26 19:35:27', NULL, 'title social', 'description social'),
(2, 1, 15, 'Error 404', 'error404', NULL, 'error404', NULL, NULL, NULL, 1, 0, NULL, '2016-05-18 21:45:27', '2016-05-20 23:18:45', NULL, NULL, NULL),
(3, 1, 5, 'Album', 'album', NULL, 'album', NULL, NULL, NULL, 1, 0, '{"description":null,"thumbnail":"axipi-48x48.jpg","thumbnail_mime":"image\\/jpeg","thumbnail_size":5424}', '2016-05-18 20:38:09', '2016-05-27 19:37:45', NULL, NULL, NULL),
(4, 1, 9, 'Axipi', 'axipi-link', NULL, 'axipi', NULL, NULL, NULL, 1, 0, '{"url":"http:\\/\\/axipi.com"}', '2016-05-20 19:53:05', '2016-05-23 20:19:02', NULL, NULL, NULL),
(5, 1, 10, 'Blog', 'blog', NULL, 'blog', NULL, NULL, NULL, 1, 0, '{"description":"<h1>test<\\/h1>"}', '2016-05-20 23:31:20', '2016-05-26 19:53:19', NULL, NULL, NULL),
(6, 1, 11, 'Blog category', 'blog-cat', 5, 'blog/category', NULL, NULL, NULL, 1, 0, '{"description":"<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec vehicula porttitor arcu, a ultrices magna tincidunt eu. Maecenas vel hendrerit velit, ut auctor est. Nunc facilisis magna eu elit commodo consequat. Quisque ac felis volutpat, ultrices lectus ut, lobortis erat. Etiam bibendum a est at feugiat. Nulla id sem tristique, auctor nulla quis, consectetur eros. In dignissim gravida velit commodo lobortis. Aenean gravida tellus non ullamcorper laoreet. Donec et massa accumsan, interdum orci non, sagittis velit. Nulla et tristique nulla. Cras ut imperdiet tellus. Nulla tempus eget elit sed feugiat. Nunc turpis risus, luctus id rhoncus ut, sollicitudin eu erat. Sed eu mauris sem.<\\/p>"}', '2016-05-20 23:31:54', '2016-05-26 20:12:15', NULL, NULL, NULL),
(7, 1, 12, 'Blog post', 'blog-post', 6, 'blog/category/post', NULL, NULL, NULL, 1, 0, '{"description":"<p>Phasellus in nibh eu purus tincidunt posuere at vitae mi. Morbi ut magna et ipsum sagittis feugiat vel in diam. Suspendisse sollicitudin mauris arcu, a tincidunt felis consectetur in. Nullam vel augue enim. Maecenas non consectetur risus, id cursus massa. Vivamus sed sagittis lectus. Praesent in fringilla mi. Proin in quam mauris. Nullam accumsan leo a pulvinar mollis. Vivamus fringilla at neque quis fringilla. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Cras et ultrices nulla.<\\/p>"}', '2016-05-20 23:32:13', '2016-05-26 20:12:27', NULL, NULL, NULL),
(9, 1, 13, 'Home', 'home', NULL, 'home', NULL, NULL, NULL, 1, 0, '{"description":"<p>Nunc ante enim, consectetur ac elit in, maximus blandit turpis. Praesent facilisis venenatis urna, non porta felis rutrum nec. Fusce at arcu at dui lobortis tristique in eu leo. Donec rhoncus pharetra lectus id accumsan. Vivamus viverra magna leo, quis hendrerit nisl feugiat eget. Duis ornare justo et mi convallis, vitae ultrices elit ornare. Mauris dignissim, nisi a pretium vehicula, leo neque accumsan sem, non faucibus purus nulla posuere leo.<\\/p>\\r\\n<p>Nunc bibendum hendrerit felis id volutpat. Praesent cursus libero eget tellus convallis, vel iaculis lacus commodo. Vestibulum turpis orci, ultrices eu felis ut, rutrum mollis odio. Maecenas eget ex et elit rhoncus eleifend. Aliquam non felis metus. Aenean rutrum, leo eu ultricies molestie, ex felis sodales magna, sed ullamcorper felis ligula gravida quam. Proin at dui leo. Proin iaculis ornare odio non porta.<\\/p>\\r\\n<p>{{ getWidgets(''footer'') }}<\\/p>"}', '2016-05-20 23:46:13', '2016-05-25 21:14:17', NULL, NULL, NULL),
(10, 1, 3, 'a', 'a', NULL, 'a', NULL, NULL, NULL, 1, 0, NULL, '2016-05-21 00:08:48', '2016-05-21 00:08:48', NULL, NULL, NULL),
(11, 1, 3, 'b', 'b', 10, 'a/b', NULL, NULL, NULL, 1, 0, '{"description":"<p><strong>test<\\/strong><\\/p>\\r\\n<p><em>test<\\/em> esr<\\/p>"}', '2016-05-21 00:09:01', '2016-05-21 18:50:25', NULL, NULL, NULL),
(12, 1, 3, 'c', 'c', 11, 'a/b/c', NULL, NULL, NULL, 1, 0, '{"description":"<p>t t t<\\/p>\\r\\n<p>g<\\/p>", "test":"test"}', '2016-05-21 00:09:16', '2016-05-21 16:47:38', NULL, NULL, NULL),
(13, 1, 9, 'Site perso', 'sdion.net', NULL, 'sdion', NULL, NULL, NULL, 1, 0, '{"url":"https:\\/\\/sdion.net"}', '2016-05-21 08:37:22', '2016-05-21 08:37:22', NULL, NULL, NULL),
(14, 1, 6, 'Media', 'media', 3, 'album/media', NULL, NULL, NULL, 1, 0, '{"image":"1181907.jpg","description":null,"image_mime":"image\\/jpeg","image_size":607789}', '2016-05-23 19:59:03', '2016-05-27 19:30:28', NULL, NULL, NULL),
(15, 1, 6, 'Test 2', 'test2', 3, 'album/media2', NULL, NULL, NULL, 1, 0, '{"image":"1260521.jpg","image_mime":"image\\/jpeg","image_size":728200,"description":null}', '2016-05-25 10:34:09', '2016-05-25 10:34:09', NULL, NULL, NULL),
(17, 1, 22, 'Map', 'map', NULL, 'map', NULL, NULL, NULL, 1, 0, '{"api_key":"AIzaSyA6iB9JEQ4XiEez_dgv3hoJWlAj4DOCGWo","latitude":"48.8236679","longitude":"2.3761298","zoom":"15","infowindow":"<p><strong>test<\\/strong> test<\\/p>\\r\\n<p><strong>test<\\/strong> test<\\/p>"}', '2016-05-25 20:20:05', '2016-05-25 20:42:47', NULL, NULL, NULL),
(18, 1, 24, 'sitemap.xml', 'sitemap.xml', NULL, 'sitemap.xml', NULL, NULL, NULL, 1, 0, NULL, '2016-05-27 09:53:57', '2016-05-27 09:55:00', NULL, NULL, NULL),
(19, 2, 3, 'Test FR', 'test-fr', NULL, 'test-fr', NULL, NULL, NULL, 1, 0, '{"description":null}', '2016-05-27 12:43:37', '2016-05-27 12:43:37', NULL, NULL, NULL);

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
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `roles` longtext,
  `date_created` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `firstname`, `lastname`, `is_active`, `roles`, `date_created`, `date_modified`) VALUES
(1, 'example@example.com', '$2y$13$RiodLgzy6Mb8HPLzTIGpFueymV1QciZyYxXP0rgN2N11ZR9Hnqdam', 'Example', NULL, 1, '["ROLE_ADMIN"]', '2016-05-19 22:06:18', '2016-05-23 20:19:45'),
(3, 'tset', '$2y$13$oaFueOhXqKOUotCGrPOybOwVKovBZnDhI1512MzaepqJO5SOO4YlO', 'test', 'test', 1, NULL, '2016-05-23 18:58:15', '2016-05-23 18:58:15'),
(4, 'aaff', '$2y$13$GEBMS1QD7q6pccdgGbn1b.ryWvCl1N9retEZydN3KL35xMFz4s03y', 'a', NULL, 1, NULL, '2016-05-23 18:59:47', '2016-05-23 20:19:56');

-- --------------------------------------------------------

--
-- Table structure for table `widget`
--

DROP TABLE IF EXISTS `widget`;
CREATE TABLE IF NOT EXISTS `widget` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` int(10) unsigned NOT NULL,
  `component_id` int(10) unsigned NOT NULL,
  `zone_id` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `code` varchar(30) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `ordering` int(11) NOT NULL DEFAULT '0',
  `attributes` longtext,
  `date_created` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `template` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `language_id_code` (`language_id`,`code`),
  KEY `component_id` (`component_id`),
  KEY `zone_id` (`zone_id`),
  KEY `language_id` (`language_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `widget`
--

INSERT INTO `widget` (`id`, `language_id`, `component_id`, `zone_id`, `title`, `code`, `is_active`, `ordering`, `attributes`, `date_created`, `date_modified`, `template`) VALUES
(1, 1, 4, 1, 'Footer aa', 'footer', 1, 0, '{"description":"<p><em>Morbi aliquam turpis ut dui suscipit, ut accumsan odio elementum.<\\/em><\\/p>"}', '2016-05-18 21:16:37', '2016-05-26 20:13:16', NULL),
(3, 1, 8, 3, 'Menu', 'menu', 1, 0, '{"display_title":true,"class":"aa"}', '2016-05-20 18:30:12', '2016-05-21 18:53:35', NULL),
(4, 1, 14, 4, 'Search Console', 'searchconsole', 1, 0, '{"code":"test-searchconsole"}', '2016-05-20 19:28:25', '2016-05-25 18:06:08', NULL),
(5, 1, 16, 2, 'Breadcrumbs', 'breadcrumbs', 1, 0, NULL, '2016-05-20 20:56:07', '2016-05-21 00:03:00', NULL),
(6, 1, 18, 4, 'Fav', 'fav', 1, -10, '{"image":"axipi-16x16.jpg","image_mime":"image\\/jpeg","image_size":4186}', '2016-05-23 20:08:02', '2016-05-25 19:01:35', NULL),
(7, 1, 19, 4, 'Twitter card', 'twitter-card', 1, 0, '{"site":"@axipi"}', '2016-05-25 17:22:47', '2016-05-25 17:38:09', NULL),
(8, 1, 20, 4, 'fb-opengraph', 'fb-opengraph', 1, 0, '{"site":"Axipi"}', '2016-05-25 17:31:38', '2016-05-25 17:38:18', NULL),
(9, 1, 4, 5, 'blog-aside', 'blog-aside', 1, 0, '{"description":"<h3>Welcome<\\/h3>\\r\\n<p>Aenean eleifend justo tellus, vitae lobortis leo accumsan at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos.<\\/p>"}', '2016-05-26 19:54:38', '2016-05-26 20:06:00', NULL),
(10, 1, 23, 5, 'Categories', 'blog-categories', 1, 1, NULL, '2016-05-26 20:01:19', '2016-05-26 20:01:19', NULL),
(11, 2, 4, 1, 'footer-fr', 'footer-fr', 1, 0, '{"description":null}', '2016-05-27 14:50:27', '2016-05-27 14:50:27', NULL);

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
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `widget_page`
--

INSERT INTO `widget_page` (`id`, `widget_id`, `page_id`, `title`, `is_active`, `ordering`, `date_created`, `date_modified`) VALUES
(3, 3, 3, NULL, 1, 0, '2016-05-21 19:42:11', '2016-05-21 19:42:11'),
(4, 3, 9, NULL, 1, -10, '2016-05-21 19:42:17', '2016-05-21 19:56:25'),
(5, 3, 5, NULL, 1, 0, '2016-05-21 19:57:12', '2016-05-21 19:57:12'),
(6, 3, 1, NULL, 1, 0, '2016-05-21 19:57:19', '2016-05-21 19:57:19'),
(7, 3, 17, 'Map', 1, 0, '2016-05-25 20:20:13', '2016-05-25 20:46:32');

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
  `ordering` int(11) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `zone`
--

INSERT INTO `zone` (`id`, `code`, `is_active`, `date_created`, `date_modified`, `ordering`) VALUES
(1, 'footer', 0, '2016-05-18 21:17:11', '2016-05-21 21:47:49', 4),
(2, 'before_content', 1, '2016-05-21 02:01:25', '2016-05-21 21:46:30', 3),
(3, 'header', 1, '2016-05-21 02:18:34', '2016-05-26 19:41:43', 2),
(4, 'head', 1, '2016-05-23 20:12:38', '2016-05-23 20:12:38', 1),
(5, 'blog_aside', 1, '2016-05-26 19:54:16', '2016-05-26 19:54:16', 0);

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
  ADD CONSTRAINT `FK_140AB62082F1BAF4` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_140AB620E2ABAFFF` FOREIGN KEY (`component_id`) REFERENCES `component` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `token`
--
ALTER TABLE `token`
  ADD CONSTRAINT `FK_5F37A13BA76ED395` FOREIGN KEY (`user_id`) REFERENCES `user` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `widget`
--
ALTER TABLE `widget`
  ADD CONSTRAINT `FK_85F91ED082F1BAF4` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_85F91ED09F2C3FAB` FOREIGN KEY (`zone_id`) REFERENCES `zone` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_85F91ED0E2ABAFFF` FOREIGN KEY (`component_id`) REFERENCES `component` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `widget_page`
--
ALTER TABLE `widget_page`
  ADD CONSTRAINT `FK_8CFDBD9FC4663E4` FOREIGN KEY (`page_id`) REFERENCES `page` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8CFDBD9FFBE885E2` FOREIGN KEY (`widget_id`) REFERENCES `widget` (`id`) ON DELETE CASCADE;

SET FOREIGN_KEY_CHECKS=1;
