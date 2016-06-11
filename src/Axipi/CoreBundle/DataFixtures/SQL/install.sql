SET FOREIGN_KEY_CHECKS=0;

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `item_id` int(10) unsigned NOT NULL,
  PRIMARY KEY (`id`),
  KEY `IDX_9474526C126F525E` (`item_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

--
-- Dumping data for table `comment`
--

INSERT INTO `comment` (`id`, `author`, `email`, `website`, `message`, `is_active`, `date_created`, `date_modified`, `item_id`) VALUES
(1, 'author', 'email', 'website', 'message', 1, '2016-06-05 06:56:03', '2016-06-05 06:56:03', 7),
(2, 'author', 'email', 'website', 'message', 1, '2016-06-05 06:56:29', '2016-06-05 06:56:29', 7),
(3, 'test', 'test', 'test', 'test', 1, '2016-06-05 06:58:57', '2016-06-05 06:58:57', 7),
(4, 'test', 'test', 'test', 'test', 1, '2016-06-05 06:59:25', '2016-06-05 06:59:25', 7),
(5, 'test', 'test', 'test', 'test', 1, '2016-06-05 07:51:05', '2016-06-05 07:51:05', 7),
(6, 'a', 'a', 'a', 'a', 1, '2016-06-05 07:53:29', '2016-06-05 07:53:29', 7),
(7, 'b', 'ba@sdion.net', 'b', 'b', 1, '2016-06-05 08:02:57', '2016-06-05 08:02:57', 7),
(8, 'a', 'ba@sdion.net', 'a', 'ert', 1, '2016-06-05 08:06:50', '2016-06-05 08:06:50', 7);

-- --------------------------------------------------------

--
-- Table structure for table `component`
--

DROP TABLE IF EXISTS `component`;
CREATE TABLE IF NOT EXISTS `component` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `zone_id` int(10) unsigned DEFAULT NULL,
  `parent` int(10) unsigned DEFAULT NULL,
  `category` varchar(255) NOT NULL,
  `service` varchar(255) NOT NULL,
  `template` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `is_unique` tinyint(1) NOT NULL DEFAULT '0',
  `attributes_schema` longtext,
  `exclude_search` tinyint(1) NOT NULL DEFAULT '0',
  `exclude_sitemap` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `is_home` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `service` (`service`),
  KEY `parent` (`parent`),
  KEY `zone_id` (`zone_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `component`
--

INSERT INTO `component` (`id`, `zone_id`, `parent`, `category`, `service`, `template`, `title`, `icon`, `is_unique`, `attributes_schema`, `exclude_search`, `exclude_sitemap`, `is_active`, `date_created`, `date_modified`, `is_home`) VALUES
(3, NULL, NULL, 'page', 'axipi_content_controller_page', 'AxipiContentBundle:Page:page.html.twig', 'Content / Page', 'file-text-o', 0, '{\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "class":"wysiwyg"\r\n            }\r\n        }\r\n    },\r\n    "thumbnail": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-18 17:44:09', '2016-05-23 20:17:33', 0),
(4, NULL, NULL, 'widget', 'axipi_content_widget_block', 'AxipiContentBundle:Widget:block.html.twig', 'Content / Block', 'file-text-o', 0, '{\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": "false",\r\n"attr": {"class":"wysiwyg"}\r\n        }\r\n    },\r\n    "div_class": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-18 18:10:25', '2016-06-04 03:22:13', 0),
(5, NULL, NULL, 'page', 'axipi_gallery_controller_album', 'AxipiGalleryBundle:Page:album.html.twig', 'Gallery / Album', 'book', 0, '{\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "class":"wysiwyg"\r\n            }\r\n        }\r\n    },\r\n    "thumbnail": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-18 22:35:46', '2016-05-31 14:53:58', 0),
(6, NULL, 5, 'page', 'axipi_gallery_controller_media', 'AxipiGalleryBundle:Page:media.html.twig', 'Gallery / Media', 'picture-o', 0, '{\r\n    "image": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": "true"\r\n        }\r\n    },\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": "false",\r\n"attr": {"class":"wysiwyg"}\r\n        }\r\n    }\r\n}\r\n', 0, 0, 1, '2016-05-18 22:36:09', '2016-05-20 19:00:24', 0),
(7, 2, NULL, 'widget', 'axipi_google_widget_analytics', 'AxipiGoogleBundle:Widget:analytics.html.twig', 'Google / Analytics', 'google', 0, '{\r\n    "code": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "true"\r\n        }\r\n    },\r\n    "domain": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-18 22:36:43', '2016-06-03 11:05:56', 0),
(8, NULL, NULL, 'widget', 'axipi_content_widget_menu', 'AxipiContentBundle:Widget:menu.html.twig', 'Content / Menu', 'bars', 0, '{\r\n    "display_title": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\CheckboxType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "data-default": "false"\r\n            }\r\n        }\r\n    },\r\n    "title_tag": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "data-default": "h3"\r\n            }\r\n        }\r\n    },\r\n    "div_class": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "data-default": "col-lg-8 pull-left"\r\n            }\r\n        }\r\n    },\r\n    "ul_class": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "data-default": "nav navbar-nav"\r\n            }\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-18 22:37:33', '2016-06-04 07:22:37', 0),
(9, NULL, NULL, 'page', 'axipi_content_controller_link', NULL, 'Content / Link', 'share-square-o', 0, '{\r\n    "url": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "true"\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-18 22:38:59', '2016-05-23 20:17:46', 0),
(10, NULL, NULL, 'page', 'axipi_blog_controller_blog', 'AxipiBlogBundle:Page:blog.html.twig', 'Blog', 'pencil-square-o', 0, '{\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "class":"wysiwyg"\r\n            }\r\n        }\r\n    },\r\n    "thumbnail": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-18 22:39:45', '2016-05-26 19:53:10', 0),
(11, NULL, 10, 'page', 'axipi_blog_controller_category', 'AxipiBlogBundle:Page:category.html.twig', 'Blog / Category', 'pencil-square-o', 0, '{\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "class":"wysiwyg"\r\n            }\r\n        }\r\n    },\r\n    "thumbnail": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-18 22:39:51', '2016-05-26 20:11:02', 0),
(12, NULL, 11, 'page', 'axipi_blog_controller_post', 'AxipiBlogBundle:Page:post.html.twig', 'Blog / Post', 'pencil-square-o', 0, '{\r\n    "thumbnail": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    },\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "class":"wysiwyg"\r\n            }\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-18 22:40:24', '2016-06-04 05:19:01', 0),
(13, NULL, NULL, 'page', 'axipi_content_controller_home', 'AxipiContentBundle:Page:home.html.twig', 'Content / Home', 'home', 1, '{\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "class":"wysiwyg"\r\n            }\r\n        }\r\n    },\r\n    "thumbnail": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-18 22:44:46', '2016-06-07 17:14:04', 1),
(14, NULL, NULL, 'widget', 'axipi_google_widget_searchconsole', 'AxipiGoogleBundle:Widget:searchconsole.html.twig', 'Google / Search Console', 'google', 0, '{\r\n    "code": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "true"\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-20 18:42:10', '2016-05-25 17:23:41', 0),
(15, NULL, NULL, 'page', 'axipi_content_controller_error404', 'AxipiContentBundle:Page:error404.html.twig', 'Content / Error 404', 'times', 1, NULL, 1, 1, 1, '2016-05-20 23:16:31', '2016-06-01 18:44:46', 0),
(16, NULL, NULL, 'widget', 'axipi_content_widget_breadcrumbs', 'AxipiContentBundle:Widget:breadcrumbs.html.twig', 'Content / Breadcrumbs', 'road', 0, '{\r\n    "div_class": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-20 23:52:18', '2016-06-04 03:21:27', 0),
(17, NULL, NULL, 'widget', 'axipi_google_widget_tagmanager', 'AxipiGoogleBundle:Widget:tagmanager.html.twig', 'Google / Tag Manager', 'google', 0, '{\r\n    "code": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "true"\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-21 20:27:40', '2016-05-25 17:23:44', 0),
(18, 4, NULL, 'widget', 'axipi_content_widget_icon', 'AxipiContentBundle:Widget:icon.html.twig', 'Content / Favicon', 'star-o', 0, '{\r\n    "image": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": "true"\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-23 20:06:34', '2016-05-31 19:05:27', 0),
(19, 4, NULL, 'widget', 'axipi_twitter_widget_card', 'AxipiTwitterBundle:Widget:card.html.twig', 'Twitter / Card', 'twitter', 0, '{\r\n    "site": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "true"\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-25 17:11:49', '2016-05-25 17:26:48', 0),
(20, 4, NULL, 'widget', 'axipi_facebook_widget_opengraph', 'AxipiFacebookBundle:Widget:opengraph.html.twig', 'Facebook / Opengraph', 'facebook', 0, '{\r\n    "site": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "true"\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-25 17:13:13', '2016-05-25 17:23:30', 0),
(21, NULL, NULL, 'page', 'axipi_contact_controller_form', 'AxipiContactBundle:Page:form.html.twig', 'Contact / Form', 'envelope-o', 0, '{\r\n    "recipient_name": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "true"\r\n        }\r\n    },\r\n    "recipient_email": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "true"\r\n        }\r\n    },\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "class":"wysiwyg"\r\n            }\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-25 17:48:30', '2016-06-05 08:42:39', 0),
(22, NULL, NULL, 'page', 'axipi_google_controller_map', 'AxipiGoogleBundle:Page:map.html.twig', 'Google / Map', 'map-o', 0, '{\r\n    "api_key": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "true"\r\n        }\r\n    },\r\n    "latitude": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "true"\r\n        }\r\n    },\r\n    "longitude": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "true"\r\n        }\r\n    },\r\n    "zoom": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "data-default": "15"\r\n            }\r\n        }\r\n    },\r\n    "height": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "data-default": "400"\r\n            }\r\n        }\r\n    },\r\n    "infowindow": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": "false",\r\n"attr": {"class":"wysiwyg"}\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-25 20:19:27', '2016-06-04 07:41:57', 0),
(23, 5, 10, 'widget', 'axipi_blog_widget_categories', 'AxipiBlogBundle:Widget:categories.html.twig', 'Blog / Categories', 'bars', 0, '{\r\n    "display_title": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\CheckboxType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    },\r\n    "title_tag": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    },\r\n    "div_class": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    },\r\n    "ul_class": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-26 20:01:00', '2016-06-04 03:33:34', 0),
(24, NULL, NULL, 'page', 'axipi_sitemap_controller_xml', 'AxipiSitemapBundle:Page:xml.xml.twig', 'Sitemap / Xml', 'code', 0, NULL, 1, 1, 1, '2016-05-27 09:53:41', '2016-06-01 18:44:38', 0),
(25, NULL, NULL, 'page', 'axipi_content_controller_file', NULL, 'Content / File', 'download', 0, '{\r\n    "file": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": "true"\r\n        }\r\n    },\r\n    "authentication_enabled": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\CheckboxType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    },\r\n    "authentication_user": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    },\r\n    "authentication_password": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-29 16:47:47', '2016-06-05 03:27:03', 0),
(26, NULL, NULL, 'page', 'axipi_search_controller_page', 'AxipiSearchBundle:Page:page.html.twig', 'Search / Page', 'search', 0, '{\r\n    "all_languages": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\CheckboxType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    },\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "class":"wysiwyg"\r\n            }\r\n        }\r\n    }\r\n}', 1, 0, 1, '2016-05-29 17:30:16', '2016-06-01 18:44:32', 0),
(27, NULL, 26, 'widget', 'axipi_search_widget_form', 'AxipiSearchBundle:Widget:form.html.twig', 'Search / Form', 'search', 0, '{\r\n    "div_class": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "data-default": "col-lg-2 pull-right text-right"\r\n            }\r\n        }\r\n    },\r\n    "form_class": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "data-default": "navbar-form navbar-right"\r\n            }\r\n        }\r\n    },\r\n    "placeholder": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-29 17:31:10', '2016-06-05 04:54:20', 0),
(28, NULL, NULL, 'widget', 'axipi_content_widget_languageselector', 'AxipiContentBundle:Widget:languageselector.html.twig', 'Content / Language Selector', 'flag', 0, '{\r\n    "div_class": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "data-default": "col-lg-2 pull-right text-right"\r\n            }\r\n        }\r\n    },\r\n    "button_class": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "data-default": "btn btn-default dropdown-toggle navbar-btn"\r\n            }\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-06-03 20:17:11', '2016-06-05 04:53:54', 0),
(29, 1, NULL, 'widget', 'axipi_facebook_widget_pageplugin', 'AxipiFacebookBundle:Widget:pageplugin.html.twig', 'Facebook / Page Plugin', 'facebook', 0, '{\r\n    "div_class": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "data-default": "col-lg-4"\r\n            }\r\n        }\r\n    },\r\n    "href": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "true"\r\n        }\r\n    },\r\n    "tabs": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "data-default": "timeline"\r\n            }\r\n        }\r\n    },\r\n    "width": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    },\r\n    "height": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "data-default": "500"\r\n            }\r\n        }\r\n    },\r\n    "small_header": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "data-default": "false"\r\n            }\r\n        }\r\n    },\r\n    "adapt_container_width": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "data-default": "true"\r\n            }\r\n        }\r\n    },\r\n    "hide_cover": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "data-default": "false"\r\n            }\r\n        }\r\n    },\r\n    "show_facepile": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false",\r\n            "attr": {\r\n                "data-default": "true"\r\n            }\r\n        }\r\n    },\r\n    "appId": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-06-05 05:58:53', '2016-06-05 06:12:55', 0),
(30, 2, NULL, 'widget', 'axipi_facebook_widget_sdk', 'AxipiFacebookBundle:Widget:sdk.html.twig', 'Facebook / Sdk', 'facebook', 0, '{\r\n    "appId": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-06-05 06:18:52', '2016-06-05 06:18:52', 0),
(31, NULL, NULL, 'widget', 'axipi_content_widget_slideshow', 'AxipiContentBundle:Widget:slideshow.html.twig', 'Slideshow', 'picture-o', 0, NULL, 0, 0, 1, '2016-06-07 18:02:25', '2016-06-07 18:17:03', 0),
(32, NULL, 31, 'widget', 'axipi_content_widget_slide', NULL, 'Slideshow / Slide', 'picture-o', 0, '{\r\n    "image": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": "true"\r\n        }\r\n    },\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": "false",\r\n"attr": {"class":"wysiwyg"}\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-06-07 18:02:45', '2016-06-07 18:19:27', 0),
(33, NULL, NULL, 'page', 'axipi_feed_controller_get', 'AxipiFeedBundle:Page:get.html.twig', 'Feed / Get', 'rss', 0, '{\r\n    "url": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "true"\r\n        }\r\n    }\r\n}', 0, 1, 1, '2016-06-11 04:23:59', '2016-06-11 04:24:39', 0),
(34, NULL, NULL, 'widget', 'axipi_content_widget_code', 'AxipiContentBundle:Widget:code.html.twig', 'Content / Code', 'code', 0, '{\r\n    "inside_div": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\CheckboxType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    },\r\n    "div_class": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    },\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": "false"\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-06-11 14:30:53', '2016-06-11 14:33:18', 0);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` int(10) unsigned NOT NULL,
  `component_id` int(10) unsigned NOT NULL,
  `zone_id` int(10) unsigned DEFAULT NULL,
  `parent` int(10) unsigned DEFAULT NULL,
  `template` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `code` varchar(30) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `slug` varchar(255) DEFAULT NULL,
  `title_seo` varchar(255) DEFAULT NULL,
  `description_seo` text,
  `title_social` varchar(255) DEFAULT NULL,
  `description_social` text,
  `attributes` longtext,
  `exclude_search` tinyint(1) NOT NULL DEFAULT '0',
  `exclude_sitemap` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  `style` text,
  `meta` text,
  `script` text,
  `is_home` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  UNIQUE KEY `language_id_code` (`language_id`,`code`),
  UNIQUE KEY `language_id_slug` (`language_id`,`slug`),
  KEY `component_id` (`component_id`),
  KEY `parent` (`parent`),
  KEY `language_id` (`language_id`),
  KEY `zone_id` (`zone_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `item`
--

INSERT INTO `item` (`id`, `language_id`, `component_id`, `zone_id`, `parent`, `template`, `title`, `code`, `ordering`, `slug`, `title_seo`, `description_seo`, `title_social`, `description_social`, `attributes`, `exclude_search`, `exclude_sitemap`, `is_active`, `date_created`, `date_modified`, `style`, `meta`, `script`, `is_home`) VALUES
(1, 1, 3, NULL, 12, NULL, 'd', 'd', 0, 'a/b/c/d', 'title seo', 'description seo', 'title social', 'description social', '{"description":"<h1>test<\\/h1>\\r\\n<p><a href=\\"[page:1:a\\/b\\/c\\/d]\\">test<\\/a><\\/p>\\r\\n<p><img src=\\"..\\/files\\/test1\\/test2\\/1182308.jpg\\" alt=\\"\\" width=\\"849\\" height=\\"565\\" \\/><\\/p>"}', 0, 0, 1, '2016-05-18 18:27:14', '2016-06-04 08:45:58', NULL, NULL, NULL, 0),
(2, 1, 15, NULL, NULL, NULL, 'Error 404', 'error404', 0, 'error404', NULL, NULL, NULL, NULL, NULL, 0, 0, 1, '2016-05-18 21:45:27', '2016-05-20 23:18:45', NULL, NULL, NULL, 0),
(3, 1, 5, NULL, NULL, NULL, 'Album', 'album', 0, 'album', NULL, NULL, NULL, NULL, '{"description":"<p>Sed viverra felis sit amet dolor <a href=\\"[page:4:axipi]\\">fermentum<\\/a>, vel rhoncus leo hendrerit. Vivamus neque orci, pretium vel dapibus non, eleifend et nulla. Phasellus a ultrices sem. Fusce euismod porta suscipit. Sed eu justo in lectus suscipit luctus. Phasellus sem purus, gravida et arcu quis, ultricies semper ante. Integer quis sapien luctus, dignissim nibh quis, pretium est. Vestibulum id mi fringilla, ullamcorper ipsum nec, mollis quam. Sed vitae lectus a libero tempus posuere. Maecenas eu dapibus risus. Aenean mattis arcu at ligula rhoncus, a iaculis est semper.<\\/p>","thumbnail":"axipi-48x48.jpg","thumbnail_mime":"image\\/jpeg","thumbnail_size":5424}', 0, 0, 1, '2016-05-18 20:38:09', '2016-06-11 13:23:56', NULL, NULL, NULL, 0),
(4, 1, 9, NULL, NULL, NULL, 'Axipi', 'axipi-link', 0, 'axipi', NULL, NULL, NULL, NULL, '{"url":"http:\\/\\/axipi.com"}', 0, 0, 1, '2016-05-20 19:53:05', '2016-05-23 20:19:02', NULL, NULL, NULL, 0),
(5, 1, 10, NULL, NULL, NULL, 'Blog', 'blog', 0, 'blog', 'a', 'b', 'c', 'd', '{"description":"<h1>test<\\/h1>\\r\\n<p><a href=\\"[page:1:a\\/b\\/c\\/d]\\">test<\\/a><\\/p>"}', 0, 0, 1, '2016-05-20 23:31:20', '2016-06-11 13:12:19', 'f', 'e', 'g', 0),
(6, 1, 11, NULL, 5, NULL, 'Blog category', 'blog-cat', 0, 'blog/category', NULL, NULL, NULL, NULL, '{"description":"<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec vehicula porttitor arcu, a ultrices magna tincidunt eu. Maecenas vel hendrerit velit, ut auctor est. Nunc facilisis magna eu elit commodo consequat. Quisque ac felis volutpat, ultrices lectus ut, lobortis erat. Etiam bibendum a est at feugiat. Nulla id sem tristique, auctor nulla quis, consectetur eros. In dignissim gravida velit commodo lobortis. Aenean gravida tellus non ullamcorper laoreet. Donec et massa accumsan, interdum orci non, sagittis velit. Nulla et tristique nulla. Cras ut imperdiet tellus. Nulla tempus eget elit sed feugiat. Nunc turpis risus, luctus id rhoncus ut, sollicitudin eu erat. Sed eu mauris sem.<\\/p>"}', 0, 0, 1, '2016-05-20 23:31:54', '2016-05-27 20:22:43', NULL, NULL, NULL, 0),
(7, 1, 12, NULL, 6, NULL, 'Blog post', 'blog-post', 0, 'blog/category/post', NULL, NULL, NULL, NULL, '{"description":"<p class=\\"lead\\">Phasellus in nibh eu purus tincidunt posuere at vitae mi. Morbi ut magna et ipsum sagittis feugiat vel in diam. Suspendisse sollicitudin mauris arcu, a tincidunt felis consectetur in. Nullam vel augue enim.<\\/p>\\r\\n<p>Maecenas non consectetur risus, id cursus massa. Vivamus sed sagittis lectus. Praesent in fringilla mi. Proin in quam mauris. Nullam accumsan leo a pulvinar mollis. Vivamus fringilla at neque quis fringilla.<\\/p>\\r\\n<p><!-- pagebreak --><\\/p>\\r\\n<p>Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Cras et ultrices nulla.<\\/p>\\r\\n<p>Suspendisse sollicitudin mauris arcu<\\/p>","summary":null,"thumbnail":"2016\\/06\\/1181692.jpg","thumbnail_mime":"image\\/jpeg","thumbnail_size":397427}', 0, 0, 1, '2016-05-20 23:32:13', '2016-06-11 04:27:27', NULL, NULL, NULL, 0),
(9, 1, 13, NULL, NULL, NULL, 'Home', 'home', 0, NULL, NULL, NULL, NULL, NULL, '{"description":"<p>test update 4<\\/p>\\r\\n<p>Nunc ante enim, consectetur ac elit in, maximus blandit turpis. Praesent facilisis venenatis urna, non porta felis rutrum nec. Fusce at arcu at dui <a href=\\"[page:17:map]\\">lobortis<\\/a> tristique in eu leo. Donec rhoncus pharetra lectus id accumsan. Vivamus viverra magna leo, quis hendrerit nisl feugiat eget. Duis ornare justo et mi convallis, vitae ultrices elit ornare. Mauris dignissim, nisi a pretium vehicula, leo neque accumsan sem, non faucibus purus nulla posuere leo.<\\/p>\\r\\n<p>Nunc bibendum hendrerit felis id volutpat. Praesent cursus libero eget tellus convallis, vel iaculis lacus <a href=\\"[page:5:blog]\\">commodo<\\/a>. Vestibulum turpis orci, ultrices eu felis ut, rutrum mollis odio. Maecenas eget ex et elit <a href=\\"[page:18:sitemap.xml]\\">rhoncus<\\/a> eleifend. Aliquam non felis metus. Aenean rutrum, leo eu ultricies molestie, ex felis sodales magna, sed ullamcorper felis ligula gravida quam. Proin at dui leo. Proin iaculis ornare odio non porta.<\\/p>\\r\\n<p>[widgets:footer]<\\/p>\\r\\n<p><img src=\\"..\\/files\\/test1\\/3759312.jpg\\" width=\\"850\\" height=\\"565\\" \\/><\\/p>"}', 0, 0, 1, '2016-05-20 23:46:13', '2016-06-11 13:11:50', NULL, NULL, NULL, 1),
(10, 1, 3, NULL, NULL, NULL, 'a', 'a', 0, 'a', NULL, NULL, NULL, NULL, '{"description":"<p>yopla<\\/p>"}', 0, 0, 1, '2016-05-21 00:08:48', '2016-06-03 16:11:52', NULL, NULL, NULL, 0),
(11, 1, 3, NULL, 10, NULL, 'b', 'b', 0, 'a/b', NULL, NULL, NULL, NULL, '{"description":"<p><strong>test<\\/strong><\\/p>\\r\\n<p><em>test<\\/em> esr<\\/p>"}', 0, 0, 1, '2016-05-21 00:09:01', '2016-05-21 18:50:25', NULL, NULL, NULL, 0),
(12, 1, 3, NULL, 11, NULL, 'c', 'c', 0, 'a/b/c', NULL, NULL, NULL, NULL, '{"description":"<p>Nunc bibendum hendrerit felis id volutpat. Praesent cursus libero eget tellus convallis, vel iaculis lacus <a href=\\"[page:11:a\\/b]\\">commodo<\\/a>. Vestibulum turpis orci, ultrices eu felis ut, rutrum mollis odio. Maecenas eget ex et elit <a href=\\"[page:123:contact-form]\\">rhoncus<\\/a> eleifend. Aliquam non felis metus. Aenean rutrum, leo eu ultricies molestie, ex felis sodales magna, sed ullamcorper felis ligula gravida quam. Proin at dui leo. Proin iaculis ornare odio non porta.<\\/p>\\r\\n<p><img style=\\"background-color: transparent;\\" src=\\"..\\/files\\/1260524.jpg\\" alt=\\"\\" width=\\"850\\" height=\\"565\\" \\/><\\/p>","test":"test"}', 0, 0, 1, '2016-05-21 00:09:16', '2016-06-05 15:47:17', NULL, NULL, NULL, 0),
(13, 1, 9, NULL, NULL, NULL, 'Site perso', 'sdion.net', 0, 'sdion', NULL, NULL, NULL, NULL, '{"url":"https:\\/\\/sdion.net"}', 0, 0, 1, '2016-05-21 08:37:22', '2016-05-21 08:37:22', NULL, NULL, NULL, 0),
(17, 1, 22, NULL, NULL, NULL, 'Map', 'map', 0, 'map', NULL, NULL, NULL, NULL, '{"api_key":"AIzaSyA6iB9JEQ4XiEez_dgv3hoJWlAj4DOCGWo","latitude":"48.8236679","longitude":"2.3761298","zoom":"15","infowindow":"<p><strong>test<\\/strong> test<\\/p>\\r\\n<p><strong>test<\\/strong> <a href=\\"[page:6:blog\\/category]\\">test<\\/a><\\/p>","height":null}', 0, 0, 1, '2016-05-25 20:20:05', '2016-06-04 07:42:31', NULL, NULL, NULL, 0),
(18, 1, 24, NULL, NULL, NULL, 'test sitemap.xml', 'sitemap.xml', 0, 'sitemap.xml', NULL, NULL, NULL, NULL, NULL, 0, 0, 1, '2016-05-27 09:53:57', '2016-06-01 18:44:12', NULL, NULL, NULL, 0),
(19, 2, 3, NULL, NULL, NULL, 'Test FR', 'test-fr', 0, 'test-fr', 'title seo', 'description seo', 'title social', 'description social', '{"description":"<p>yopla<\\/p>"}', 0, 0, 1, '2016-05-27 12:43:37', '2016-05-29 19:27:20', NULL, NULL, NULL, 0),
(20, 1, 26, NULL, NULL, NULL, 'Search', 'search', 0, 'search', NULL, NULL, NULL, NULL, '{"all_languages":false,"description":"<p>test<\\/p>"}', 0, 0, 1, '2016-05-29 17:32:20', '2016-06-04 06:08:13', NULL, NULL, NULL, 0),
(21, 2, 26, NULL, NULL, NULL, 'recherche', 'recherche', 0, 'recherche', NULL, NULL, NULL, NULL, '{"all_languages":false,"description":null}', 0, 0, 1, '2016-05-29 19:44:28', '2016-05-29 19:44:28', NULL, NULL, NULL, 0),
(37, 1, 4, 1, NULL, NULL, 'Footer aa', 'widgetfooter', 0, NULL, NULL, NULL, NULL, NULL, '{"description":"<p><em>Morbi aliquam turpis ut dui suscipit, ut accumsan odio elementum.<\\/em><\\/p>"}', 0, 0, 1, '2016-05-18 21:16:37', '2016-05-30 15:24:13', NULL, NULL, NULL, 0),
(38, 1, 8, 3, NULL, NULL, 'Menu', 'widgetmenu', 0, NULL, NULL, NULL, NULL, NULL, '{"display_title":false,"class":"aa","title_tag":null,"div_class":null,"ul_class":null}', 0, 0, 1, '2016-05-20 18:30:12', '2016-06-04 03:34:09', NULL, NULL, NULL, 0),
(39, 1, 14, 4, NULL, NULL, 'Search Console', 'widgetsearchconsole', 0, NULL, NULL, NULL, NULL, NULL, '{"code":"test-searchconsole"}', 0, 0, 1, '2016-05-20 19:28:25', '2016-05-25 18:06:08', NULL, NULL, NULL, 0),
(40, 1, 16, 2, NULL, NULL, 'Breadcrumbs', 'widgetbreadcrumbs', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, '2016-05-20 20:56:07', '2016-05-21 00:03:00', NULL, NULL, NULL, 0),
(41, 1, 18, 4, NULL, NULL, 'Fav', 'widgetfav', -10, NULL, NULL, NULL, NULL, NULL, '{"image":"axipi-16x16.jpg","image_mime":"image\\/jpeg","image_size":4186}', 0, 0, 1, '2016-05-23 20:08:02', '2016-05-25 19:01:35', NULL, NULL, NULL, 0),
(42, 1, 19, 4, NULL, NULL, 'Twitter card', 'widgettwitter-card', 0, NULL, NULL, NULL, NULL, NULL, '{"site":"@axipi"}', 0, 0, 1, '2016-05-25 17:22:47', '2016-06-11 04:56:12', NULL, NULL, NULL, 0),
(43, 1, 20, 4, NULL, NULL, 'fb-opengraph', 'widgetfb-opengraph', 0, NULL, NULL, NULL, NULL, NULL, '{"site":"Axipi"}', 0, 0, 0, '2016-05-25 17:31:38', '2016-06-02 18:18:04', NULL, NULL, NULL, 0),
(44, 1, 4, 5, NULL, NULL, 'blog-aside', 'widgetblog-aside', 0, NULL, NULL, NULL, NULL, NULL, '{"description":"<h3>Welcome<\\/h3>\\r\\n<p>Aenean eleifend justo tellus, vitae lobortis leo accumsan at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos.<\\/p>"}', 0, 0, 1, '2016-05-26 19:54:38', '2016-05-26 20:06:00', NULL, NULL, NULL, 0),
(45, 1, 23, 5, 5, NULL, 'Categories', 'widgetblog-categories', 1, NULL, NULL, NULL, NULL, NULL, '{"display_title":true,"title_tag":null,"div_class":null}', 0, 0, 1, '2016-05-26 20:01:19', '2016-06-04 03:31:37', NULL, NULL, NULL, 0),
(46, 2, 4, 1, NULL, NULL, 'footer-fr', 'widgetfooter-fr', 0, NULL, NULL, NULL, NULL, NULL, '{"description":"<p>test widget\\u00a0footer FR<\\/p>"}', 0, 0, 1, '2016-05-27 14:50:27', '2016-06-03 18:13:39', NULL, NULL, NULL, 0),
(47, 1, 27, 3, 20, NULL, 'search', 'widgetsearch', 100, NULL, NULL, NULL, NULL, NULL, '{"div_class":null,"placeholder":null}', 0, 0, 1, '2016-05-29 17:33:32', '2016-06-04 03:35:54', NULL, NULL, NULL, 0),
(48, 1, 12, NULL, 6, NULL, 'post2', 'post2', 0, 'post2', NULL, NULL, NULL, NULL, '{"description":"<p>Aenean eget feugiat justo. Cras sit amet sagittis tellus, sit amet mattis ex. Sed faucibus elit tincidunt, placerat nisl a, dictum magna.<\\/p>\\r\\n<p>Cras a urna massa. Praesent molestie elit eget dui elementum, a venenatis lectus maximus. Nullam sit amet aliquet nunc. Quisque eget sapien blandit, efficitur urna id, tempus lectus. Cras sit amet ex faucibus sem condimentum malesuada ut tristique magna. Nulla varius ac nibh sit amet lacinia. Proin lobortis congue malesuada. Nullam non nisi id lacus congue tempus eget sit amet erat. Fusce vitae consectetur nulla. Donec blandit finibus finibus. Ut posuere faucibus blandit. Aliquam erat volutpat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;<\\/p>","thumbnail":"2016\\/06\\/1181869.jpg","thumbnail_mime":"image\\/jpeg","thumbnail_size":12194}', 0, 0, 1, '2016-05-30 18:28:51', '2016-06-11 04:27:35', NULL, NULL, NULL, 0),
(51, 1, 11, NULL, 5, NULL, 'category2', 'category2', 0, 'category2', NULL, NULL, NULL, NULL, '{"description":null}', 0, 0, 1, '2016-05-30 19:35:07', '2016-05-30 19:35:07', NULL, NULL, NULL, 0),
(91, 1, 3, NULL, 1, NULL, 'je fais un test', 'en-5751a1622bfb5', 0, 'a/b/c/d/je-fais-un-test', NULL, NULL, NULL, NULL, '{"description":null}', 0, 0, 1, '2016-06-03 15:25:22', '2016-06-03 15:25:22', NULL, NULL, NULL, 0),
(93, 1, 3, NULL, 1, NULL, 'je fais un test', 'en-5751a3d05f3e3', 0, 'a/b/c/d/je-fais-un-test-5751a3d05f3c8', NULL, NULL, NULL, NULL, '{"description":null}', 0, 0, 1, '2016-06-03 15:35:44', '2016-06-03 15:35:44', NULL, NULL, NULL, 0),
(94, 1, 3, NULL, 1, NULL, 'je fais un test', 'en-5751a3ffd8383', 0, 'a/b/c/d/je-fais-un-test-5751a3ffd8367', NULL, NULL, NULL, NULL, '{"description":null}', 0, 0, 1, '2016-06-03 15:36:31', '2016-06-03 15:36:31', NULL, NULL, NULL, 0),
(113, 1, 6, NULL, 3, NULL, '5751c23b1f0873.63802174', 'en-5751c23b23e94', 0, 'album/5751c23b1f0873.63802174', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/1181692.jpg","image_mime":"image\\/jpeg","image_size":532987}', 0, 0, 1, '2016-06-03 17:45:31', '2016-06-03 17:45:31', NULL, NULL, NULL, 0),
(114, 1, 6, NULL, 3, NULL, '5751c23b34fc57.92330148', 'en-5751c23b39aff', 0, 'album/5751c23b34fc57.92330148', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/1260507.jpg","image_mime":"image\\/jpeg","image_size":578527}', 0, 0, 1, '2016-06-03 17:45:31', '2016-06-03 17:45:31', NULL, NULL, NULL, 0),
(115, 1, 6, NULL, 3, NULL, '5751c23b4afd55.23730944', 'en-5751c23b4ea0c', 0, 'album/5751c23b4afd55.23730944', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/1447373.jpg","image_mime":"image\\/jpeg","image_size":607789}', 0, 0, 1, '2016-06-03 17:45:31', '2016-06-03 17:45:31', NULL, NULL, NULL, 0),
(116, 2, 13, NULL, NULL, NULL, 'Accueil', 'fr-5751d5eb732e3', 0, NULL, NULL, NULL, NULL, NULL, '{"description":"<p>Accueil FR<\\/p>"}', 0, 0, 1, '2016-06-03 19:09:31', '2016-06-03 19:09:31', NULL, NULL, NULL, 0),
(117, 2, 8, 3, NULL, NULL, 'Menu FR', 'fr-5751d645954af', 0, NULL, NULL, NULL, NULL, NULL, '{"display_title":false,"class":null}', 0, 0, 1, '2016-06-03 19:11:01', '2016-06-03 19:11:01', NULL, NULL, NULL, 0),
(118, 2, 27, 3, 21, NULL, 'Recherche FR', 'fr-5751d84aade57', 100, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, '2016-06-03 19:19:38', '2016-06-03 20:24:15', NULL, NULL, NULL, 0),
(119, 1, 28, 3, NULL, NULL, 'Select language', 'en-5751e5d70da2a', 0, NULL, NULL, NULL, NULL, NULL, '{"div_class":null,"button_class":null}', 0, 0, 1, '2016-06-03 20:17:27', '2016-06-04 03:38:52', NULL, NULL, NULL, 0),
(120, 2, 28, 3, NULL, NULL, 'Langue switch', 'fr-5751e70d4c0eb', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, '2016-06-03 20:22:37', '2016-06-03 20:22:37', NULL, NULL, NULL, 0),
(121, 1, 5, NULL, 3, NULL, 'test', 'en-57526c0defa6e', 0, 'album/test', NULL, NULL, NULL, NULL, '{"description":null,"thumbnail":"2016\\/06\\/1181869.jpg","thumbnail_mime":"text\\/x-php","thumbnail_size":12719}', 0, 0, 1, '2016-06-04 05:50:05', '2016-06-11 13:21:03', NULL, NULL, NULL, 0),
(122, 1, 25, NULL, NULL, NULL, 'Test file protected', 'en-57539c2b4a2f6', 0, 'test-file-protected', NULL, NULL, NULL, NULL, '{"file":"2016\\/06\\/lipsum.pdf","file_mime":"application\\/pdf","file_size":22888,"authentication_enabled":false,"authentication_user":"test","authentication_password":"yopla"}', 1, 0, 1, '2016-06-05 03:27:39', '2016-06-11 04:25:36', NULL, NULL, NULL, 0),
(123, 1, 21, NULL, NULL, NULL, 'Contact form', 'en-5753e58a7bd75', 0, 'contact-form', NULL, NULL, NULL, NULL, '{"recipient_name":"Test recipient name","recipient_email":"ba@sdion.net","description":"<p>Duis ipsum ligula, malesuada ac nibh a, luctus porttitor leo. Nunc ut pharetra quam. Praesent laoreet quam ullamcorper ultricies posuere. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi aliquet mauris non nulla elementum cursus. In sit amet lacinia risus, non congue ipsum. Proin ornare arcu in sapien molestie, volutpat sollicitudin orci auctor.<\\/p>\\r\\n<p>Mauris aliquet, odio sit amet euismod placerat, tellus nulla vestibulum augue, vitae dignissim orci orci quis odio. Cras eget fringilla ex. Suspendisse interdum nibh eget odio ultrices, ornare sodales risus elementum.<\\/p>"}', 0, 0, 1, '2016-06-05 08:40:42', '2016-06-05 08:50:58', NULL, NULL, NULL, 0),
(131, 1, 31, 2, NULL, NULL, 'Slideshow test', 'en-57570d83dc69c', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 0, '2016-06-07 18:08:03', '2016-06-11 04:26:09', NULL, NULL, NULL, 0),
(139, 1, 32, NULL, 131, NULL, 'Test 1', 'en-5757104e30368', 0, '/5757104e299736.02600793', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/1181692.jpg","image_mime":"image\\/jpeg","image_size":9294,"description":null}', 0, 0, 1, '2016-06-07 18:19:58', '2016-06-07 18:47:16', NULL, NULL, NULL, 0),
(140, 1, 32, NULL, 131, NULL, 'Test 2', 'en-5757104e53d5a', 0, '/5757104e4eece8.99020138', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/1181869.jpg","image_mime":"image\\/jpeg","image_size":8863,"description":null}', 0, 0, 1, '2016-06-07 18:19:58', '2016-06-07 18:47:24', NULL, NULL, NULL, 0),
(141, 1, 32, NULL, 131, NULL, 'Test 3', 'en-5757104e77f26', 0, '/5757104e72f5d0.56716751', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/1181907.jpg","image_mime":"image\\/jpeg","image_size":9961,"description":null}', 0, 0, 1, '2016-06-07 18:19:58', '2016-06-07 18:47:34', NULL, NULL, NULL, 0),
(146, 1, 32, NULL, 131, NULL, '575b813c73df98.13940079', 'en-575b813c7a5b1', 0, NULL, NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/3680468.jpg","image_mime":"image\\/jpeg","image_size":11862}', 0, 0, 1, '2016-06-11 03:10:52', '2016-06-11 03:10:52', NULL, NULL, NULL, 0),
(147, 1, 32, NULL, 131, NULL, '575b81c307f605.55514419', 'en-575b81c30c3de', 0, NULL, NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/1181692.jpg","image_mime":"image\\/jpeg","image_size":9294}', 0, 0, 1, '2016-06-11 03:13:07', '2016-06-11 03:13:07', NULL, NULL, NULL, 0),
(149, 1, 6, NULL, 121, NULL, '575c1090800386.39848232', 'en-575c10908462c', 0, 'album/test/575c1090800386.39848232', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/1414696.jpg","image_mime":"image\\/jpeg","image_size":243872}', 0, 0, 1, '2016-06-11 13:22:24', '2016-06-11 13:22:24', NULL, NULL, NULL, 0),
(150, 1, 6, NULL, 121, NULL, '575c10909d2867.46203636', 'en-575c1090a3909', 0, 'album/test/575c10909d2867.46203636', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/3608399.jpg","image_mime":"image\\/jpeg","image_size":442770}', 0, 0, 1, '2016-06-11 13:22:24', '2016-06-11 13:22:24', NULL, NULL, NULL, 0),
(151, 1, 6, NULL, 121, NULL, '575c1090b5eb00.34731247', 'en-575c1090baef7', 0, 'album/test/575c1090b5eb00.34731247', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/0077560.jpg","image_mime":"image\\/jpeg","image_size":560360}', 0, 0, 1, '2016-06-11 13:22:24', '2016-06-11 13:22:24', NULL, NULL, NULL, 0),
(152, 1, 6, NULL, 121, NULL, '575c1090cc1eb9.06216703', 'en-575c1090d07b7', 0, 'album/test/575c1090cc1eb9.06216703', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/1624280.jpg","image_mime":"image\\/jpeg","image_size":232090}', 0, 0, 1, '2016-06-11 13:22:24', '2016-06-11 13:22:24', NULL, NULL, NULL, 0),
(153, 1, 6, NULL, 121, NULL, '575c1090e3cbd4.81762669', 'en-575c1090e8676', 0, 'album/test/575c1090e3cbd4.81762669', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/1260519.jpg","image_mime":"image\\/jpeg","image_size":724354}', 0, 0, 1, '2016-06-11 13:22:24', '2016-06-11 13:22:24', NULL, NULL, NULL, 0),
(154, 1, 6, NULL, 121, NULL, '575c10910cee24.74231053', 'en-575c109114852', 0, 'album/test/575c10910cee24.74231053', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/0221357.jpg","image_mime":"image\\/jpeg","image_size":594389}', 0, 0, 1, '2016-06-11 13:22:25', '2016-06-11 13:22:25', NULL, NULL, NULL, 0),
(155, 1, 6, NULL, 121, NULL, '575c109129deb0.72144443', 'en-575c10912e962', 0, 'album/test/575c109129deb0.72144443', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/1181692.jpg","image_mime":"image\\/jpeg","image_size":532987}', 0, 0, 1, '2016-06-11 13:22:25', '2016-06-11 13:22:25', NULL, NULL, NULL, 0);

-- --------------------------------------------------------

--
-- Table structure for table `language`
--

DROP TABLE IF EXISTS `language`;
CREATE TABLE IF NOT EXISTS `language` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` char(2) NOT NULL,
  `title` varchar(255) NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `language`
--

INSERT INTO `language` (`id`, `code`, `title`, `is_active`, `date_created`, `date_modified`) VALUES
(1, 'en', 'English', 1, '2016-05-18 20:24:38', '2016-05-26 17:36:50'),
(2, 'fr', 'Français', 1, '2016-05-26 17:37:14', '2016-06-04 17:14:23');

-- --------------------------------------------------------

--
-- Table structure for table `relation`
--

DROP TABLE IF EXISTS `relation`;
CREATE TABLE IF NOT EXISTS `relation` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `widget_id` int(10) unsigned NOT NULL,
  `page_id` int(10) unsigned NOT NULL,
  `title` varchar(255) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `widget_id_page_id` (`widget_id`,`page_id`),
  KEY `widget_id` (`widget_id`),
  KEY `page_id` (`page_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `relation`
--

INSERT INTO `relation` (`id`, `widget_id`, `page_id`, `title`, `ordering`, `is_active`, `date_created`, `date_modified`) VALUES
(3, 38, 3, NULL, 0, 1, '2016-05-21 19:42:11', '2016-06-01 18:03:35'),
(4, 38, 9, NULL, -10, 1, '2016-05-21 19:42:17', '2016-05-21 19:56:25'),
(5, 3, 5, NULL, 0, 1, '2016-05-21 19:57:12', '2016-05-21 19:57:12'),
(6, 38, 1, NULL, 0, 1, '2016-05-21 19:57:19', '2016-05-21 19:57:19'),
(7, 38, 17, 'Map', 0, 1, '2016-05-25 20:20:13', '2016-05-25 20:46:32'),
(8, 38, 5, NULL, 0, 1, '2016-06-01 18:06:12', '2016-06-01 18:06:12'),
(9, 117, 116, NULL, -10, 1, '2016-06-03 19:11:07', '2016-06-03 19:11:41'),
(10, 117, 19, NULL, 0, 1, '2016-06-03 19:11:22', '2016-06-03 19:11:22'),
(12, 38, 123, NULL, 0, 1, '2016-06-05 09:08:16', '2016-06-05 09:08:16'),
(13, 38, 13, NULL, 0, 1, '2016-06-10 22:01:16', '2016-06-10 22:07:22');

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
  `roles` longtext,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `user`
--

INSERT INTO `user` (`id`, `username`, `password`, `firstname`, `lastname`, `roles`, `is_active`, `date_created`, `date_modified`) VALUES
(1, 'example@example.com', '$2y$13$RiodLgzy6Mb8HPLzTIGpFueymV1QciZyYxXP0rgN2N11ZR9Hnqdam', 'Example', NULL, '["ROLE_USERS","ROLE_PAGES","ROLE_WIDGETS","ROLE_LANGUAGES","ROLE_COMPONENTS","ROLE_ZONES","ROLE_FILES","ROLE_SEARCH","ROLE_INFO","ROLE_CACHE"]', 1, '2016-05-19 22:06:18', '2016-06-11 03:50:30'),
(4, 'install@axipi.com', '$2y$13$gpAnBKy7sty7yk46boLc8ei/vdedb65Yg.dMbpIoPoI64L3R78f7i', 'Install', NULL, '["ROLE_PAGES"]', 1, '2016-05-23 18:59:47', '2016-05-31 20:17:57');

-- --------------------------------------------------------

--
-- Table structure for table `zone`
--

DROP TABLE IF EXISTS `zone`;
CREATE TABLE IF NOT EXISTS `zone` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `code` varchar(30) NOT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `code` (`code`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `zone`
--

INSERT INTO `zone` (`id`, `code`, `ordering`, `is_active`, `date_created`, `date_modified`) VALUES
(1, 'footer', 4, 0, '2016-05-18 21:17:11', '2016-05-21 21:47:49'),
(2, 'before_content', 3, 1, '2016-05-21 02:01:25', '2016-05-21 21:46:30'),
(3, 'header', 2, 1, '2016-05-21 02:18:34', '2016-05-26 19:41:43'),
(4, 'head', 1, 1, '2016-05-23 20:12:38', '2016-05-23 20:12:38'),
(5, 'blog_aside', 0, 1, '2016-05-26 19:54:16', '2016-06-10 21:55:06');

--
-- Constraints for dumped tables
--

--
-- Constraints for table `comment`
--
ALTER TABLE `comment`
  ADD CONSTRAINT `FK_9474526C126F525E` FOREIGN KEY (`item_id`) REFERENCES `item` (`id`) ON DELETE CASCADE;

--
-- Constraints for table `component`
--
ALTER TABLE `component`
  ADD CONSTRAINT `FK_49FEA1573D8E604F` FOREIGN KEY (`parent`) REFERENCES `component` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_49FEA1579F2C3FAB` FOREIGN KEY (`zone_id`) REFERENCES `zone` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `item`
--
ALTER TABLE `item`
  ADD CONSTRAINT `FK_140AB6203D8E604F` FOREIGN KEY (`parent`) REFERENCES `item` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_140AB62082F1BAF4` FOREIGN KEY (`language_id`) REFERENCES `language` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_140AB620E2ABAFFF` FOREIGN KEY (`component_id`) REFERENCES `component` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_1F1B251E9F2C3FAB` FOREIGN KEY (`zone_id`) REFERENCES `zone` (`id`) ON DELETE SET NULL;

--
-- Constraints for table `relation`
--
ALTER TABLE `relation`
  ADD CONSTRAINT `FK_62894749FBE885E2` FOREIGN KEY (`widget_id`) REFERENCES `item` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8CFDBD9FC4663E4` FOREIGN KEY (`page_id`) REFERENCES `item` (`id`) ON DELETE CASCADE;

SET FOREIGN_KEY_CHECKS=1;
