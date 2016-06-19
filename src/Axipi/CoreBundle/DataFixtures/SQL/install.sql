SET FOREIGN_KEY_CHECKS=0;

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- --------------------------------------------------------

--
-- Table structure for table `comment`
--

DROP TABLE IF EXISTS `comment`;
CREATE TABLE IF NOT EXISTS `comment` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `item_id` int(10) unsigned NOT NULL,
  `author` varchar(255) COLLATE utf8_unicode_ci NOT NULL,
  `email` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `website` varchar(255) COLLATE utf8_unicode_ci DEFAULT NULL,
  `message` longtext COLLATE utf8_unicode_ci NOT NULL,
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL,
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
(8, 'a', 'ba@sdion.net', 'a', 'ert', 1, '2016-06-05 08:06:50', '2016-06-05 08:06:50', 7),
(9, 'sdion', NULL, NULL, 'test', 1, '2016-06-19 03:57:25', '2016-06-19 03:57:25', 7);

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
  `service` varchar(255) DEFAULT NULL,
  `template` varchar(255) DEFAULT NULL,
  `title` varchar(255) NOT NULL,
  `icon` varchar(255) DEFAULT NULL,
  `is_unique` tinyint(1) NOT NULL DEFAULT '0',
  `attributes_schema` longtext,
  `exclude_search` tinyint(1) NOT NULL DEFAULT '0',
  `exclude_sitemap` tinyint(1) NOT NULL DEFAULT '0',
  `is_home` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `service` (`service`),
  KEY `parent` (`parent`),
  KEY `zone_id` (`zone_id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `component`
--

INSERT INTO `component` (`id`, `zone_id`, `parent`, `category`, `service`, `template`, `title`, `icon`, `is_unique`, `attributes_schema`, `exclude_search`, `exclude_sitemap`, `is_active`, `date_created`, `date_modified`, `is_home`) VALUES
(3, NULL, NULL, 'page', 'axipi_content_controller_page', 'AxipiContentBundle:Page:page.html.twig', 'Content / Page', 'file-text-o', 0, '{\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "class":"wysiwyg"\r\n            }\r\n        }\r\n    },\r\n    "image": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": false\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-18 17:44:09', '2016-05-23 20:17:33', 0),
(4, NULL, NULL, 'widget', 'axipi_content_widget_block', 'AxipiContentBundle:Widget:block.html.twig', 'Content / Block', 'file-text-o', 0, '{\r\n    "display_title": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\CheckboxType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "data-default": "false"\r\n            }\r\n        }\r\n    },\r\n    "title_tag": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "data-default": "h3"\r\n            }\r\n        }\r\n    },\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": false,\r\n"attr": {"class":"wysiwyg"}\r\n        }\r\n    },\r\n    "div_class": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": false\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-18 18:10:25', '2016-06-12 20:17:19', 0),
(5, NULL, NULL, 'page', 'axipi_gallery_controller_album', 'AxipiGalleryBundle:Page:album.html.twig', 'Gallery / Album', 'book', 0, '{\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "class":"wysiwyg"\r\n            }\r\n        }\r\n    },\r\n    "image": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": false\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-18 22:35:46', '2016-06-18 18:43:46', 0),
(6, NULL, 5, 'page', 'axipi_gallery_controller_media', 'AxipiGalleryBundle:Page:media.html.twig', 'Gallery / Media', 'picture-o', 0, '{\r\n    "image": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": true\r\n        }\r\n    },\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": false,\r\n"attr": {"class":"wysiwyg"}\r\n        }\r\n    }\r\n}\r\n', 0, 0, 1, '2016-05-18 22:36:09', '2016-05-20 19:00:24', 0),
(7, 2, NULL, 'widget', 'axipi_google_widget_analytics', 'AxipiGoogleBundle:Widget:analytics.html.twig', 'Google / Analytics', 'google', 0, '{\r\n    "code": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": true\r\n        }\r\n    },\r\n    "domain": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": false\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-18 22:36:43', '2016-06-03 11:05:56', 0),
(8, NULL, NULL, 'widget', 'axipi_content_widget_menu', 'AxipiContentBundle:Widget:menu.html.twig', 'Content / Menu', 'bars', 0, '{\r\n    "predefined": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\ChoiceType",\r\n        "options": {\r\n            "placeholder": "-",\r\n            "choices": {\r\n                "Navbar": "nav navbar-nav",\r\n                "Tabs": "nav nav-tabs",\r\n                "Horizontal (pills)": "nav nav-pills",\r\n                "Vertical (pills stacked)": "nav nav-pills nav-stacked"\r\n            },\r\n            "required": false,\r\n            "attr": {\r\n                "data-default": "nav nav-pills"\r\n            }\r\n        }\r\n    },\r\n    "display_title": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\CheckboxType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "data-default": "false"\r\n            }\r\n        }\r\n    },\r\n    "title_tag": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "data-default": "h3"\r\n            }\r\n        }\r\n    },\r\n    "div_class": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "data-default": "col-lg-8 pull-left"\r\n            }\r\n        }\r\n    },\r\n    "ul_class": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "data-default": "nav nav-pills"\r\n            }\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-18 22:37:33', '2016-06-04 07:22:37', 0),
(9, NULL, NULL, 'page', 'axipi_content_controller_link', NULL, 'Content / Link', 'share-square-o', 0, '{\r\n    "url": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": true\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-18 22:38:59', '2016-05-23 20:17:46', 0),
(10, NULL, NULL, 'page', 'axipi_blog_controller_blog', 'AxipiBlogBundle:Page:blog.html.twig', 'Blog', 'pencil-square-o', 0, '{\r\n    "comments_disabled": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\CheckboxType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "data-default": "false"\r\n            }\r\n        }\r\n    },\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "class":"wysiwyg"\r\n            }\r\n        }\r\n    },\r\n    "image": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": false\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-18 22:39:45', '2016-06-19 03:37:01', 0),
(11, NULL, 10, 'page', 'axipi_blog_controller_category', 'AxipiBlogBundle:Page:category.html.twig', 'Blog / Category', 'pencil-square-o', 0, '{\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "class":"wysiwyg"\r\n            }\r\n        }\r\n    },\r\n    "image": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": false\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-18 22:39:51', '2016-05-26 20:11:02', 0),
(12, NULL, 11, 'page', 'axipi_blog_controller_post', 'AxipiBlogBundle:Page:post.html.twig', 'Blog / Post', 'pencil-square-o', 0, '{\r\n    "comments_disabled": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\CheckboxType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "data-default": "false"\r\n            }\r\n        }\r\n    },\r\n    "image": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": false\r\n        }\r\n    },\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "class":"wysiwyg"\r\n            }\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-18 22:40:24', '2016-06-19 03:37:14', 0),
(13, NULL, NULL, 'page', 'axipi_content_controller_home', 'AxipiContentBundle:Page:home.html.twig', 'Content / Home', 'home', 1, '{\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "class":"wysiwyg"\r\n            }\r\n        }\r\n    },\r\n    "image": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": false\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-18 22:44:46', '2016-06-07 17:14:04', 1),
(14, NULL, NULL, 'widget', 'axipi_google_widget_searchconsole', 'AxipiGoogleBundle:Widget:searchconsole.html.twig', 'Google / Search Console', 'google', 0, '{\r\n    "code": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": true\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-20 18:42:10', '2016-05-25 17:23:41', 0),
(15, NULL, NULL, 'page', 'axipi_content_controller_error404', 'AxipiContentBundle:Page:error404.html.twig', 'Content / Error 404', 'times', 1, '{\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "class":"wysiwyg"\r\n            }\r\n        }\r\n    },\r\n    "image": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": false\r\n        }\r\n    }\r\n}', 1, 1, 1, '2016-05-20 23:16:31', '2016-06-01 18:44:46', 0),
(16, NULL, NULL, 'widget', 'axipi_content_widget_breadcrumbs', 'AxipiContentBundle:Widget:breadcrumbs.html.twig', 'Content / Breadcrumbs', 'road', 0, '{\r\n    "div_class": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": false\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-20 23:52:18', '2016-06-04 03:21:27', 0),
(17, NULL, NULL, 'widget', 'axipi_google_widget_tagmanager', 'AxipiGoogleBundle:Widget:tagmanager.html.twig', 'Google / Tag Manager', 'google', 0, '{\r\n    "code": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": true\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-21 20:27:40', '2016-05-25 17:23:44', 0),
(18, 4, NULL, 'widget', 'axipi_content_widget_icon', 'AxipiContentBundle:Widget:icon.html.twig', 'Content / Favicon', 'star-o', 0, '{\r\n    "image": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": true\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-23 20:06:34', '2016-05-31 19:05:27', 0),
(19, 4, NULL, 'widget', 'axipi_twitter_widget_card', 'AxipiTwitterBundle:Widget:card.html.twig', 'Twitter / Card', 'twitter', 0, '{\r\n    "site": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": true\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-25 17:11:49', '2016-05-25 17:26:48', 0),
(20, 4, NULL, 'widget', 'axipi_facebook_widget_opengraph', 'AxipiFacebookBundle:Widget:opengraph.html.twig', 'Facebook / Opengraph', 'facebook', 0, '{\r\n    "site": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": true\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-25 17:13:13', '2016-05-25 17:23:30', 0),
(21, NULL, NULL, 'page', 'axipi_contact_controller_form', 'AxipiContactBundle:Page:form.html.twig', 'Contact / Form', 'envelope-o', 0, '{\r\n    "recipient_name": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": true\r\n        }\r\n    },\r\n    "recipient_email": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": true\r\n        }\r\n    },\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "class":"wysiwyg"\r\n            }\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-25 17:48:30', '2016-06-05 08:42:39', 0),
(23, 6, 10, 'widget', 'axipi_blog_widget_categories', 'AxipiBlogBundle:Widget:categories.html.twig', 'Blog / Categories', 'bars', 0, '{\r\n    "predefined": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\ChoiceType",\r\n        "options": {\r\n            "placeholder": "-",\r\n            "choices": {\r\n                "Navbar": "nav navbar-nav",\r\n                "Tabs": "nav nav-tabs",\r\n                "Horizontal (pills)": "nav nav-pills",\r\n                "Vertical (pills stacked)": "nav nav-pills nav-stacked"\r\n            },\r\n            "required": false,\r\n            "attr": {\r\n                "data-default": "nav nav-pills nav-stacked"\r\n            }\r\n        }\r\n    },\r\n    "display_title": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\CheckboxType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "data-default": "false"\r\n            }\r\n        }\r\n    },\r\n    "title_tag": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "data-default": "h3"\r\n            }\r\n        }\r\n    },\r\n    "div_class": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "data-default": "col-lg-12"\r\n            }\r\n        }\r\n    },\r\n    "ul_class": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "data-default": "nav nav-pills nav-stacked"\r\n            }\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-26 20:01:00', '2016-06-12 07:28:43', 0),
(24, NULL, NULL, 'page', 'axipi_sitemap_controller_xml', 'AxipiSitemapBundle:Page:xml.xml.twig', 'Sitemap / Xml', 'code', 0, NULL, 1, 1, 1, '2016-05-27 09:53:41', '2016-06-01 18:44:38', 0),
(25, NULL, NULL, 'page', 'axipi_content_controller_file', NULL, 'Content / File', 'download', 0, '{\r\n    "file": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": true\r\n        }\r\n    },\r\n    "authentication_enabled": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\CheckboxType",\r\n        "options": {\r\n            "required": false\r\n        }\r\n    },\r\n    "authentication_user": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": false\r\n        }\r\n    },\r\n    "authentication_password": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": false\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-29 16:47:47', '2016-06-05 03:27:03', 0),
(26, NULL, NULL, 'page', 'axipi_search_controller_page', 'AxipiSearchBundle:Page:page.html.twig', 'Search / Page', 'search', 0, '{\r\n    "all_languages": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\CheckboxType",\r\n        "options": {\r\n            "required": false\r\n        }\r\n    },\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "class":"wysiwyg"\r\n            }\r\n        }\r\n    }\r\n}', 1, 0, 1, '2016-05-29 17:30:16', '2016-06-01 18:44:32', 0),
(27, NULL, 26, 'widget', 'axipi_search_widget_form', 'AxipiSearchBundle:Widget:form.html.twig', 'Search / Form', 'search', 0, '{\r\n    "div_class": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "data-default": "col-lg-2 pull-right text-right"\r\n            }\r\n        }\r\n    },\r\n    "form_class": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "data-default": "navbar-form navbar-right"\r\n            }\r\n        }\r\n    },\r\n    "placeholder": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": false\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-05-29 17:31:10', '2016-06-05 04:54:20', 0),
(28, NULL, NULL, 'widget', 'axipi_content_widget_languageselector', 'AxipiContentBundle:Widget:languageselector.html.twig', 'Content / Language Selector', 'flag', 0, '{\r\n  "display_title": {\r\n      "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\CheckboxType",\r\n      "options": {\r\n          "required": false,\r\n          "attr": {\r\n              "data-default": "false"\r\n          }\r\n      }\r\n  },\r\n    "div_class": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "data-default": "col-lg-2 pull-right text-right"\r\n            }\r\n        }\r\n    },\r\n    "button_class": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "data-default": "btn btn-default dropdown-toggle navbar-btn"\r\n            }\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-06-03 20:17:11', '2016-06-05 04:53:54', 0),
(29, 1, NULL, 'widget', 'axipi_facebook_widget_pageplugin', 'AxipiFacebookBundle:Widget:pageplugin.html.twig', 'Facebook / Page Plugin', 'facebook', 0, '{\r\n    "div_class": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "data-default": "col-lg-4"\r\n            }\r\n        }\r\n    },\r\n    "href": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": true\r\n        }\r\n    },\r\n    "tabs": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "data-default": "timeline"\r\n            }\r\n        }\r\n    },\r\n    "width": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": false\r\n        }\r\n    },\r\n    "height": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "data-default": "500"\r\n            }\r\n        }\r\n    },\r\n    "small_header": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\ChoiceType",\r\n        "options": {\r\n            "placeholder": "-",\r\n            "choices": {\r\n                "No": "false",\r\n                "Yes": "true"\r\n            },\r\n            "required": false,\r\n            "attr": {\r\n                "data-default": "No"\r\n            }\r\n        }\r\n    },\r\n    "adapt_container_width": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\ChoiceType",\r\n        "options": {\r\n            "placeholder": "-",\r\n            "choices": {\r\n                "No": "false",\r\n                "Yes": "true"\r\n            },\r\n            "required": false,\r\n            "attr": {\r\n                "data-default": "Yes"\r\n            }\r\n        }\r\n    },\r\n    "hide_cover": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\ChoiceType",\r\n        "options": {\r\n            "placeholder": "-",\r\n            "choices": {\r\n                "No": "false",\r\n                "Yes": "true"\r\n            },\r\n            "required": false,\r\n            "attr": {\r\n                "data-default": "No"\r\n            }\r\n        }\r\n    },\r\n    "show_facepile": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\ChoiceType",\r\n        "options": {\r\n            "placeholder": "-",\r\n            "choices": {\r\n                "No": "false",\r\n                "Yes": "true"\r\n            },\r\n            "required": false,\r\n            "attr": {\r\n                "data-default": "Yes"\r\n            }\r\n        }\r\n    },\r\n    "appId": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": false\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-06-05 05:58:53', '2016-06-11 15:16:06', 0),
(30, 2, NULL, 'widget', 'axipi_facebook_widget_sdk', 'AxipiFacebookBundle:Widget:sdk.html.twig', 'Facebook / Sdk', 'facebook', 0, '{\r\n    "appId": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": false\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-06-05 06:18:52', '2016-06-05 06:18:52', 0),
(31, NULL, NULL, 'widget', 'axipi_content_widget_slideshow', 'AxipiContentBundle:Widget:slideshow.html.twig', 'Slideshow', 'picture-o', 0, NULL, 0, 0, 1, '2016-06-07 18:02:25', '2016-06-07 18:17:03', 0),
(32, NULL, 31, 'widget', NULL, NULL, 'Slideshow / Slide', 'picture-o', 0, '{\r\n    "image": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": true\r\n        }\r\n    },\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": false,\r\n"attr": {"class":"wysiwyg"}\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-06-07 18:02:45', '2016-06-19 04:51:11', 0),
(33, NULL, NULL, 'page', 'axipi_feed_controller_get', 'AxipiFeedBundle:Page:get.html.twig', 'Feed / Get', 'rss', 0, '{\r\n    "url": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": true\r\n        }\r\n    }\r\n}', 0, 1, 1, '2016-06-11 04:23:59', '2016-06-11 04:24:39', 0),
(34, NULL, NULL, 'widget', 'axipi_content_widget_code', 'AxipiContentBundle:Widget:code.html.twig', 'Content / Code', 'code', 0, '{\r\n    "inside_div": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\CheckboxType",\r\n        "options": {\r\n            "required": false\r\n        }\r\n    },\r\n    "div_class": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": false\r\n        }\r\n    },\r\n    "description": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": false\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-06-11 14:30:53', '2016-06-11 20:48:32', 0),
(35, 4, NULL, 'widget', 'axipi_schema_widget_organization', 'AxipiSchemaBundle:Widget:organization.html.twig', 'Schema / Organization', 'code', 0, '{\r\n    "url": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": true\r\n        }\r\n    },\r\n    "logo": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\FileType",\r\n        "options": {\r\n            "required": true\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-06-11 19:31:42', '2016-06-11 19:46:01', 0),
(36, 4, NULL, 'widget', 'axipi_schema_widget_breadcrumblist', 'AxipiSchemaBundle:Widget:breadcrumblist.html.twig', 'Schema / BreadcrumbList', 'code', 0, NULL, 0, 0, 1, '2016-06-11 19:49:02', '2016-06-11 19:49:02', 0),
(37, 4, NULL, 'widget', 'axipi_schema_widget_website', 'AxipiSchemaBundle:Widget:website.html.twig', 'Schema / WebSite', 'code', 0, '{\r\n    "url": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": true\r\n        }\r\n    },\r\n    "name": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": true\r\n        }\r\n    },\r\n    "alternateName": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": false\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-06-11 19:31:42', '2016-06-11 20:09:58', 0),
(38, NULL, NULL, 'widget', 'axipi_app_widget_example', 'AxipiAppBundle:Widget:example.html.twig', 'App / Example', 'birthday-cake', 0, '', 0, 0, 1, '2016-06-11 19:31:42', '2016-06-11 20:09:58', 0),
(39, NULL, NULL, 'page', 'axipi_app_controller_example', 'AxipiAppBundle:Page:example.html.twig', 'App / Example', 'birthday-cake', 0, NULL, 0, 1, 1, '2016-06-11 04:23:59', '2016-06-16 21:24:44', 0),
(40, 6, 10, 'widget', 'axipi_blog_widget_comments', 'AxipiBlogBundle:Widget:comments.html.twig', 'Blog / Comments', 'comments-o', 0, NULL, 0, 0, 1, '2016-06-12 08:46:11', '2016-06-16 21:47:23', 0),
(41, NULL, NULL, 'widget', 'axipi_google_widget_map', 'AxipiGoogleBundle:Widget:map.html.twig', 'Google / Map', 'map-o', 0, '{\r\n    "api_key": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": true\r\n        }\r\n    },\r\n    "zoom": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "data-default": "15"\r\n            }\r\n        }\r\n    },    "latitude": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": true\r\n        }\r\n    },\r\n    "longitude": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": true\r\n        }\r\n    },\r\n    "height": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": false,\r\n            "attr": {\r\n                "data-default": "400"\r\n            }\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-06-19 04:28:29', '2016-06-19 04:45:41', 0),
(42, NULL, 41, 'widget', NULL, NULL, 'Google / Map Marker', 'map-marker', 0, '{\r\n    "latitude": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": true\r\n        }\r\n    },\r\n    "longitude": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextType",\r\n        "options": {\r\n            "required": true\r\n        }\r\n    },\r\n\r\n    "infowindow": {\r\n        "type": "Symfony\\\\Component\\\\Form\\\\Extension\\\\Core\\\\Type\\\\TextareaType",\r\n        "options": {\r\n            "required": false,\r\n"attr": {"class":"wysiwyg"}\r\n        }\r\n    }\r\n}', 0, 0, 1, '2016-06-19 04:40:33', '2016-06-19 04:51:17', 0);

-- --------------------------------------------------------

--
-- Table structure for table `item`
--

DROP TABLE IF EXISTS `item`;
CREATE TABLE IF NOT EXISTS `item` (
  `id` int(10) unsigned NOT NULL AUTO_INCREMENT,
  `language_id` int(10) unsigned DEFAULT NULL,
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
  `style` text,
  `meta` text,
  `script` text,
  `exclude_search` tinyint(1) NOT NULL DEFAULT '0',
  `exclude_sitemap` tinyint(1) NOT NULL DEFAULT '0',
  `is_home` tinyint(1) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL,
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
(2, 1, 15, NULL, NULL, NULL, 'Error 404', 'error404', 0, 'error404', NULL, NULL, NULL, NULL, '{"description":"<p>Quisque fermentum ultricies libero et consequat. Vestibulum finibus ipsum eros, id eleifend ante viverra sed. Vestibulum vel vehicula turpis. Vivamus gravida massa fermentum laoreet sagittis. Aenean interdum vel metus nec laoreet. Donec gravida, sapien ut placerat posuere, urna mauris sodales massa, nec volutpat est felis vel augue. Mauris vitae eros sem.<\\/p>\\r\\n<p>Sed rutrum aliquam metus, quis facilisis tellus malesuada eget. Phasellus nec pulvinar ante, sit amet aliquet nibh. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Sed mollis malesuada magna in ultrices. Fusce aliquam quam ac feugiat fermentum. Aliquam fermentum blandit libero, ac mollis elit lobortis at. Maecenas ut pharetra lectus. Curabitur eget diam lorem. Nullam accumsan dolor et egestas sagittis. Praesent sed aliquam tellus. Vestibulum cursus, eros sed bibendum suscipit, turpis nibh tincidunt leo, ut tempor nisi augue in ex.<\\/p>"}', 0, 0, 1, '2016-05-18 21:45:27', '2016-06-12 08:55:46', NULL, NULL, NULL, 0),
(3, 1, 5, NULL, 183, NULL, 'Album 1', 'en-57661153ee5aa', 0, 'albums/album-1', NULL, NULL, NULL, NULL, '{"description":"<p>Sed viverra felis sit amet dolor <a href=\\"[page:4:axipi]\\">fermentum<\\/a>, vel rhoncus leo hendrerit. Vivamus neque orci, pretium vel dapibus non, eleifend et nulla. Phasellus a ultrices sem. Fusce euismod porta suscipit. Sed eu justo in lectus suscipit luctus. Phasellus sem purus, gravida et arcu quis, ultricies semper ante. Integer quis sapien luctus, dignissim nibh quis, pretium est. Vestibulum id mi fringilla, ullamcorper ipsum nec, mollis quam. Sed vitae lectus a libero tempus posuere. Maecenas eu dapibus risus. Aenean mattis arcu at ligula rhoncus, a iaculis est semper.<\\/p>","thumbnail":"axipi-48x48.jpg","thumbnail_mime":"image\\/jpeg","thumbnail_size":5424,"image":"2016\\/06\\/1260507.jpg","image_mime":"image\\/jpeg","image_size":578527}', 0, 0, 1, '2016-05-18 20:38:09', '2016-06-19 03:28:19', NULL, NULL, NULL, 0),
(4, 1, 9, NULL, NULL, NULL, 'Axipi', 'axipi-link', 0, 'axipi', NULL, NULL, NULL, NULL, '{"url":"http:\\/\\/axipi.com"}', 0, 0, 1, '2016-05-20 19:53:05', '2016-05-23 20:19:02', NULL, NULL, NULL, 0),
(5, 1, 10, NULL, NULL, NULL, 'Blog', 'blog', 0, 'blog', 'a', 'b', 'c', 'd', '{"description":"<p>Quisque ullamcorper mauris nec scelerisque tristique. Nam in finibus ligula. Donec ex lectus, sodales id lobortis et, venenatis et libero. Nulla vel viverra enim, quis pharetra turpis.<\\/p>\\r\\n<p>Quisque fermentum ultricies libero et consequat. Vestibulum finibus ipsum eros, id eleifend ante viverra sed. Vestibulum vel vehicula turpis. Vivamus gravida massa fermentum laoreet sagittis.<\\/p>","comments_disabled":false}', 0, 0, 1, '2016-05-20 23:31:20', '2016-06-19 03:41:18', 'f', 'e', 'g', 0),
(6, 1, 11, NULL, 5, NULL, 'Blog category', 'blog-cat', 0, 'blog/category', NULL, NULL, NULL, NULL, '{"description":"<p>Cum sociis natoque penatibus et magnis dis parturient montes, nascetur ridiculus mus. Donec vehicula porttitor arcu, a ultrices magna tincidunt eu. Maecenas vel hendrerit velit, ut auctor est. Nunc facilisis magna eu elit commodo consequat. Quisque ac felis volutpat, ultrices lectus ut, lobortis erat. Etiam bibendum a est at feugiat. Nulla id sem tristique, auctor nulla quis, consectetur eros. In dignissim gravida velit commodo lobortis. Aenean gravida tellus non ullamcorper laoreet. Donec et massa accumsan, interdum orci non, sagittis velit. Nulla et tristique nulla. Cras ut imperdiet tellus. Nulla tempus eget elit sed feugiat. Nunc turpis risus, luctus id rhoncus ut, sollicitudin eu erat. Sed eu mauris sem.<\\/p>"}', 0, 0, 1, '2016-05-20 23:31:54', '2016-05-27 20:22:43', NULL, NULL, NULL, 0),
(7, 1, 12, NULL, 6, NULL, 'Blog post', 'blog-post', 0, 'blog/category/post', NULL, NULL, NULL, NULL, '{"description":"<p>Suspendisse sagittis finibus ornare. Aenean eleifend pellentesque accumsan. Nulla facilisi. Ut vehicula diam lectus, at porttitor diam tincidunt ut. Suspendisse suscipit, ante quis tristique iaculis, lacus nisl efficitur est, non venenatis tortor lectus quis orci. Nulla facilisi. Sed euismod ipsum scelerisque eros viverra, a consectetur nisl lacinia. Suspendisse potenti. In at urna diam. Aliquam lacinia dictum orci, vel varius est consectetur eu. Aliquam porta pulvinar erat ut pellentesque. Nulla tempor arcu vel aliquet malesuada. Nullam quis sapien lectus. Sed ut metus tincidunt, suscipit nunc a, congue lacus.<\\/p>\\r\\n<p><!-- pagebreak --><\\/p>\\r\\n<p>Suspendisse nec urna condimentum, consectetur dui et, maximus leo. Nunc maximus euismod lorem a sagittis. Vestibulum lorem ex, pharetra ut iaculis sed, fringilla at dolor. Phasellus finibus aliquam ante eget malesuada. Maecenas sed tincidunt justo. Vestibulum luctus tellus eu velit elementum, ac dictum eros tempus. In feugiat porta risus, et mattis tellus. Aliquam velit ex, egestas at dolor aliquet, egestas sollicitudin orci. Cras sed tincidunt mi, sit amet mollis felis. Praesent maximus, diam nec venenatis elementum, augue nisl maximus dolor, ac fringilla augue dui quis nisi. Etiam urna augue, accumsan vel ipsum ac, semper dictum tortor. In porttitor efficitur justo, vel feugiat dui convallis sed. Quisque gravida elit blandit enim tempor accumsan. Nulla et lorem ac ipsum dictum auctor non a risus.<\\/p>\\r\\n<p>Donec tristique scelerisque leo, vitae pellentesque metus convallis non. Praesent ac turpis ac neque sodales elementum et eu tellus. Fusce sodales, est eget tempus suscipit, sem tortor fermentum diam, sit amet mattis lacus nunc non magna. Donec tincidunt, nisl vitae elementum tempor, est purus scelerisque diam, quis posuere mauris ex nec mi. Praesent finibus justo nec urna dignissim congue. Interdum et malesuada fames ac ante ipsum primis in faucibus. Curabitur eget volutpat leo. Pellentesque interdum at diam a venenatis. Nullam et lectus id justo vehicula convallis. Maecenas ut elit tincidunt lorem facilisis tristique eget sed dui. Sed eu urna in diam commodo suscipit. Nam lectus metus, convallis a venenatis sit amet, tempor a purus. Proin magna dolor, scelerisque non quam sed, vehicula venenatis ligula. Sed ultricies sodales viverra.<\\/p>\\r\\n<p>Praesent non tortor quis velit efficitur tincidunt. Mauris venenatis in magna scelerisque sodales. Pellentesque nec convallis velit. Curabitur auctor pellentesque scelerisque. In pellentesque vehicula arcu sit amet placerat. Donec varius nec urna ac feugiat. Vestibulum mauris leo, posuere rhoncus nisi quis, sagittis tristique mi. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Mauris ut cursus leo. Morbi dapibus justo nec rhoncus maximus.<\\/p>\\r\\n<p>Pellentesque maximus dapibus est, sed faucibus diam sagittis condimentum. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. In ante nibh, scelerisque vel nisi vel, faucibus finibus dui. Suspendisse consectetur porttitor elit, vitae lobortis metus eleifend nec. Sed sollicitudin feugiat est, at efficitur leo placerat eget. Fusce dignissim purus non nisl cursus, eu convallis velit tempor. Praesent et eros vitae nunc placerat luctus. Nulla id tempor risus.<\\/p>","summary":null,"thumbnail":"2016\\/06\\/1181692.jpg","thumbnail_mime":"image\\/jpeg","thumbnail_size":397427,"image":"2016\\/06\\/0221360.jpg","image_mime":"image\\/jpeg","image_size":397427}', 0, 0, 1, '2016-05-20 23:32:13', '2016-06-18 19:17:45', NULL, NULL, NULL, 0),
(9, 1, 13, NULL, NULL, NULL, 'Home', 'home', 0, NULL, NULL, NULL, NULL, NULL, '{"description":"<p>Nunc ante enim, consectetur ac elit in, maximus blandit turpis. Praesent facilisis venenatis urna, non porta felis rutrum nec. Fusce at arcu at dui <a href=\\"[page:10:about-us]\\">lobortis<\\/a> tristique in eu leo. Donec rhoncus pharetra lectus id accumsan. Vivamus viverra magna leo, quis hendrerit nisl feugiat eget. Duis ornare justo et mi convallis, vitae ultrices elit ornare. Mauris dignissim, nisi a pretium vehicula, leo neque accumsan sem, non faucibus purus nulla posuere leo.<\\/p>\\r\\n<p>Nunc bibendum hendrerit felis id volutpat. Praesent cursus libero eget tellus convallis, vel iaculis lacus <a href=\\"[page:5:blog]\\">commodo<\\/a>. Vestibulum turpis orci, ultrices eu felis ut, rutrum mollis odio. Maecenas eget ex et elit <a href=\\"[page:18:sitemap.xml]\\">rhoncus<\\/a> eleifend. Aliquam non felis metus. Aenean rutrum, leo eu ultricies molestie, ex felis sodales magna, sed ullamcorper felis ligula gravida quam. Proin at dui leo. Proin iaculis ornare odio non porta.<\\/p>"}', 0, 0, 1, '2016-05-20 23:46:13', '2016-06-19 04:36:21', NULL, NULL, NULL, 1),
(10, 1, 3, NULL, NULL, NULL, 'About Us', 'en-575d276b4efe3', 0, 'about-us', NULL, NULL, NULL, NULL, '{"description":"<p>Sed mollis malesuada magna in ultrices. Fusce aliquam quam ac feugiat fermentum. Aliquam fermentum blandit libero, ac mollis elit lobortis at. Maecenas ut pharetra lectus. Curabitur eget diam lorem. Nullam accumsan dolor et egestas sagittis. Praesent sed aliquam tellus. Vestibulum cursus, eros sed bibendum suscipit, turpis nibh tincidunt leo, ut tempor nisi augue in ex.<\\/p>\\r\\n<p>Nunc quis facilisis nulla. Nunc bibendum bibendum turpis, vel semper sapien. Nullam eu tellus at orci malesuada semper. Aliquam rutrum ultricies eros, eget scelerisque enim maximus at. Aenean quis sollicitudin diam. Ut commodo quam nec orci vulputate volutpat. Praesent laoreet fringilla ante, eget mattis velit faucibus eu. Phasellus tempor efficitur dapibus. Curabitur nec est eu dui lacinia semper. Donec vitae arcu quis sapien fringilla aliquet quis et ex. Phasellus ornare nisi ac urna venenatis lacinia. Curabitur pulvinar elementum lectus, ac sagittis eros rhoncus id. Praesent egestas odio odio, sit amet pulvinar leo iaculis tempus. Proin tristique magna sed eros ullamcorper laoreet. Phasellus in nibh augue. Nullam neque dui, volutpat vel nunc et, egestas placerat mi.<\\/p>\\r\\n<p>Aliquam porta arcu ac est hendrerit tincidunt. Integer luctus nec sapien pharetra dapibus. Cras venenatis enim in mi laoreet ornare. Cras a interdum elit, a condimentum risus. Fusce at porttitor diam, eget lacinia sem. In tincidunt imperdiet leo at accumsan. Sed at maximus mauris. Quisque sed molestie tortor, eu ornare lacus.<\\/p>"}', 0, 0, 1, '2016-05-21 00:08:48', '2016-06-12 09:12:11', NULL, NULL, NULL, 0),
(13, 1, 9, NULL, NULL, NULL, 'Site perso', 'sdion.net', 0, 'sdion', NULL, NULL, NULL, NULL, '{"url":"https:\\/\\/sdion.net"}', 0, 0, 1, '2016-05-21 08:37:22', '2016-05-21 08:37:22', NULL, NULL, NULL, 0),
(18, 1, 24, NULL, NULL, NULL, 'test sitemap.xml', 'sitemap.xml', 0, 'sitemap.xml', NULL, NULL, NULL, NULL, NULL, 0, 0, 1, '2016-05-27 09:53:57', '2016-06-01 18:44:12', NULL, NULL, NULL, 0),
(19, 2, 3, NULL, NULL, NULL, 'Test FR', 'test-fr', 0, 'test-fr', 'title seo', 'description seo', 'title social', 'description social', '{"description":"<p>yopla<\\/p>"}', 0, 0, 1, '2016-05-27 12:43:37', '2016-05-29 19:27:20', NULL, NULL, NULL, 0),
(20, 1, 26, NULL, NULL, NULL, 'Search', 'search', 0, 'search', NULL, NULL, NULL, NULL, '{"all_languages":false,"description":"<p>test<\\/p>"}', 0, 0, 1, '2016-05-29 17:32:20', '2016-06-04 06:08:13', NULL, NULL, NULL, 0),
(21, 2, 26, NULL, NULL, NULL, 'recherche', 'recherche', 0, 'recherche', NULL, NULL, NULL, NULL, '{"all_languages":false,"description":null}', 0, 0, 1, '2016-05-29 19:44:28', '2016-05-29 19:44:28', NULL, NULL, NULL, 0),
(37, 1, 4, 1, NULL, NULL, 'Mention', 'en-575d244889396', 0, NULL, NULL, NULL, NULL, NULL, '{"description":"<p><a href=\\"http:\\/\\/axipi.com\\">Powered by axipi<\\/a><\\/p>","div_class":"col-md-4","display_title":false,"title_tag":null}', 0, 0, 1, '2016-05-18 21:16:37', '2016-06-18 17:15:30', NULL, NULL, NULL, 0),
(38, 1, 8, 3, NULL, NULL, 'Menu', 'widgetmenu', 0, NULL, NULL, NULL, NULL, NULL, '{"display_title":false,"class":"aa","title_tag":null,"div_class":null,"ul_class":null,"predefined":null}', 0, 0, 1, '2016-05-20 18:30:12', '2016-06-19 02:49:44', NULL, NULL, NULL, 0),
(39, NULL, 14, 4, NULL, NULL, 'Search Console', 'widgetsearchconsole', 0, NULL, NULL, NULL, NULL, NULL, '{"code":"test-searchconsole"}', 0, 0, 1, '2016-05-20 19:28:25', '2016-06-13 19:01:26', NULL, NULL, NULL, 0),
(41, NULL, 18, 4, NULL, NULL, 'Fav', 'widgetfav', -10, NULL, NULL, NULL, NULL, NULL, '{"image":"axipi-16x16.jpg","image_mime":"image\\/jpeg","image_size":4186}', 0, 0, 1, '2016-05-23 20:08:02', '2016-06-13 19:10:37', NULL, NULL, NULL, 0),
(42, NULL, 19, 4, NULL, NULL, 'Twitter card', 'widgettwitter-card', 0, NULL, NULL, NULL, NULL, NULL, '{"site":"@axipi"}', 0, 0, 1, '2016-05-25 17:22:47', '2016-06-13 19:07:52', NULL, NULL, NULL, 0),
(43, NULL, 20, 4, NULL, NULL, 'fb-opengraph', 'widgetfb-opengraph', 0, NULL, NULL, NULL, NULL, NULL, '{"site":"Axipi"}', 0, 0, 0, '2016-05-25 17:31:38', '2016-06-13 19:08:16', NULL, NULL, NULL, 0),
(44, 1, 4, 6, NULL, NULL, 'Welcome', 'widgetblog-aside', 0, NULL, NULL, NULL, NULL, NULL, '{"description":"<p>Aenean eleifend justo tellus, vitae lobortis leo accumsan at. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos.<\\/p>","div_class":null,"display_title":true}', 0, 0, 1, '2016-05-26 19:54:38', '2016-06-12 08:25:36', NULL, NULL, NULL, 0),
(45, 1, 23, 6, 5, NULL, 'Categories', 'widgetblog-categories', 1, NULL, NULL, NULL, NULL, NULL, '{"display_title":true,"title_tag":null,"div_class":null,"predefined":null,"ul_class":null}', 0, 0, 1, '2016-05-26 20:01:19', '2016-06-12 07:24:40', NULL, NULL, NULL, 0),
(46, 2, 4, 1, NULL, NULL, 'footer-fr', 'widgetfooter-fr', 0, NULL, NULL, NULL, NULL, NULL, '{"description":"<p>test widget\\u00a0footer FR<\\/p>"}', 0, 0, 1, '2016-05-27 14:50:27', '2016-06-03 18:13:39', NULL, NULL, NULL, 0),
(47, 1, 27, 6, 20, NULL, 'search', 'widgetsearch', -10, NULL, NULL, NULL, NULL, NULL, '{"div_class":null,"placeholder":null,"form_class":null}', 0, 0, 1, '2016-05-29 17:33:32', '2016-06-12 07:29:18', NULL, NULL, NULL, 0),
(48, 1, 12, NULL, 6, NULL, 'post2', 'post2', 0, 'post2', NULL, NULL, NULL, NULL, '{"description":"<p>Aenean eget feugiat justo. Cras sit amet sagittis tellus, sit amet mattis ex. Sed faucibus elit tincidunt, placerat nisl a, dictum magna.<\\/p>\\r\\n<p>Cras a urna massa. Praesent molestie elit eget dui elementum, a venenatis lectus maximus. Nullam sit amet aliquet nunc. Quisque eget sapien blandit, efficitur urna id, tempus lectus. Cras sit amet ex faucibus sem condimentum malesuada ut tristique magna. Nulla varius ac nibh sit amet lacinia. Proin lobortis congue malesuada. Nullam non nisi id lacus congue tempus eget sit amet erat. Fusce vitae consectetur nulla. Donec blandit finibus finibus. Ut posuere faucibus blandit. Aliquam erat volutpat. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae;<\\/p>","thumbnail":"2016\\/06\\/1181869.jpg","thumbnail_mime":"image\\/jpeg","thumbnail_size":12194,"image":"2016\\/06\\/3680468.jpg","image_mime":"image\\/jpeg","image_size":601463,"comments_disabled":false}', 0, 0, 1, '2016-05-30 18:28:51', '2016-06-19 03:39:11', NULL, NULL, NULL, 0),
(51, 1, 11, NULL, 5, NULL, 'category2', 'category2', 0, 'category2', NULL, NULL, NULL, NULL, '{"description":null}', 0, 0, 1, '2016-05-30 19:35:07', '2016-05-30 19:35:07', NULL, NULL, NULL, 0),
(113, 1, 6, NULL, 3, NULL, '5751c23b1f0873.63802174', 'en-5751c23b23e94', 0, 'album/5751c23b1f0873.63802174', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/1181692.jpg","image_mime":"image\\/jpeg","image_size":532987}', 0, 0, 1, '2016-06-03 17:45:31', '2016-06-03 17:45:31', NULL, NULL, NULL, 0),
(114, 1, 6, NULL, 3, NULL, '5751c23b34fc57.92330148', 'en-5751c23b39aff', 0, 'album/5751c23b34fc57.92330148', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/1260507.jpg","image_mime":"image\\/jpeg","image_size":578527}', 0, 0, 1, '2016-06-03 17:45:31', '2016-06-03 17:45:31', NULL, NULL, NULL, 0),
(115, 1, 6, NULL, 3, NULL, '5751c23b4afd55.23730944', 'en-5751c23b4ea0c', 0, 'album/5751c23b4afd55.23730944', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/1447373.jpg","image_mime":"image\\/jpeg","image_size":607789}', 0, 0, 1, '2016-06-03 17:45:31', '2016-06-03 17:45:31', NULL, NULL, NULL, 0),
(116, 2, 13, NULL, NULL, NULL, 'Accueil', 'fr-5751d5eb732e3', 0, NULL, NULL, NULL, NULL, NULL, '{"description":"<p>Accueil FR<\\/p>"}', 0, 0, 1, '2016-06-03 19:09:31', '2016-06-12 21:08:00', NULL, NULL, NULL, 1),
(117, 2, 8, 3, NULL, NULL, 'Menu FR', 'fr-5751d645954af', 0, NULL, NULL, NULL, NULL, NULL, '{"display_title":false,"class":null,"predefined":null,"title_tag":null,"div_class":null,"ul_class":null}', 0, 0, 1, '2016-06-03 19:11:01', '2016-06-12 07:59:16', NULL, NULL, NULL, 0),
(118, 2, 27, 6, 21, NULL, 'Recherche FR', 'fr-5751d84aade57', 100, NULL, NULL, NULL, NULL, NULL, '{"div_class":null,"form_class":null,"placeholder":null}', 0, 0, 1, '2016-06-03 19:19:38', '2016-06-12 07:24:08', NULL, NULL, NULL, 0),
(119, 1, 28, 6, NULL, NULL, 'Select language', 'en-5751e5d70da2a', 0, NULL, NULL, NULL, NULL, NULL, '{"div_class":null,"button_class":null,"display_title":true}', 0, 0, 1, '2016-06-03 20:17:27', '2016-06-12 08:38:15', NULL, NULL, NULL, 0),
(120, 2, 28, 6, NULL, NULL, 'Changer de langue', 'fr-5751e70d4c0eb', 0, NULL, NULL, NULL, NULL, NULL, '{"div_class":null,"button_class":null,"display_title":true}', 0, 0, 1, '2016-06-03 20:22:37', '2016-06-12 21:08:28', NULL, NULL, NULL, 0),
(121, 1, 5, NULL, 183, NULL, 'Album 2', 'en-5766115c64347', 0, 'albums/album-1/album-2', NULL, NULL, NULL, NULL, '{"description":null,"thumbnail":"2016\\/06\\/1181869.jpg","thumbnail_mime":"text\\/x-php","thumbnail_size":12719,"image":"2016\\/06\\/0221357.jpg","image_mime":"image\\/jpeg","image_size":594389}', 0, 0, 1, '2016-06-04 05:50:05', '2016-06-19 03:29:12', NULL, NULL, NULL, 0),
(123, 1, 21, NULL, NULL, NULL, 'Contact Us', 'en-575d2532ec2d6', 0, 'contact-us', NULL, NULL, NULL, NULL, '{"recipient_name":"Test recipient name","recipient_email":"ba@sdion.net","description":"<p>Duis ipsum ligula, malesuada ac nibh a, luctus porttitor leo. Nunc ut pharetra quam. Praesent laoreet quam ullamcorper ultricies posuere. Pellentesque habitant morbi tristique senectus et netus et malesuada fames ac turpis egestas. Morbi aliquet mauris non nulla elementum cursus. In sit amet lacinia risus, non congue ipsum. Proin ornare arcu in sapien molestie, volutpat sollicitudin orci auctor.<\\/p>\\r\\n<p>Mauris aliquet, odio sit amet euismod placerat, tellus nulla vestibulum augue, vitae dignissim orci orci quis odio. Cras eget fringilla ex. Suspendisse interdum nibh eget odio ultrices, ornare sodales risus elementum.<\\/p>\\r\\n<p>[widget:184]<\\/p>"}', 0, 0, 1, '2016-06-05 08:40:42', '2016-06-19 04:36:50', NULL, NULL, NULL, 0),
(149, 1, 6, NULL, 121, NULL, '575c1090800386.39848232', 'en-575c10908462c', 0, 'album/test/575c1090800386.39848232', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/1414696.jpg","image_mime":"image\\/jpeg","image_size":243872}', 0, 0, 1, '2016-06-11 13:22:24', '2016-06-11 13:22:24', NULL, NULL, NULL, 0),
(150, 1, 6, NULL, 121, NULL, '575c10909d2867.46203636', 'en-575c1090a3909', 0, 'album/test/575c10909d2867.46203636', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/3608399.jpg","image_mime":"image\\/jpeg","image_size":442770}', 0, 0, 1, '2016-06-11 13:22:24', '2016-06-11 13:22:24', NULL, NULL, NULL, 0),
(151, 1, 6, NULL, 121, NULL, '575c1090b5eb00.34731247', 'en-575c1090baef7', 0, 'album/test/575c1090b5eb00.34731247', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/0077560.jpg","image_mime":"image\\/jpeg","image_size":560360}', 0, 0, 1, '2016-06-11 13:22:24', '2016-06-11 13:22:24', NULL, NULL, NULL, 0),
(152, 1, 6, NULL, 121, NULL, '575c1090cc1eb9.06216703', 'en-575c1090d07b7', 0, 'album/test/575c1090cc1eb9.06216703', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/1624280.jpg","image_mime":"image\\/jpeg","image_size":232090}', 0, 0, 1, '2016-06-11 13:22:24', '2016-06-11 13:22:24', NULL, NULL, NULL, 0),
(153, 1, 6, NULL, 121, NULL, '575c1090e3cbd4.81762669', 'en-575c1090e8676', 0, 'album/test/575c1090e3cbd4.81762669', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/1260519.jpg","image_mime":"image\\/jpeg","image_size":724354}', 0, 0, 1, '2016-06-11 13:22:24', '2016-06-11 13:22:24', NULL, NULL, NULL, 0),
(154, 1, 6, NULL, 121, NULL, '575c10910cee24.74231053', 'en-575c109114852', 0, 'album/test/575c10910cee24.74231053', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/0221357.jpg","image_mime":"image\\/jpeg","image_size":594389}', 0, 0, 1, '2016-06-11 13:22:25', '2016-06-11 13:22:25', NULL, NULL, NULL, 0),
(155, 1, 6, NULL, 121, NULL, '575c109129deb0.72144443', 'en-575c10912e962', 0, 'album/test/575c109129deb0.72144443', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/1181692.jpg","image_mime":"image\\/jpeg","image_size":532987}', 0, 0, 1, '2016-06-11 13:22:25', '2016-06-11 13:22:25', NULL, NULL, NULL, 0),
(156, 1, 35, 4, NULL, NULL, 'test orga', 'en-575c6987a75df', 0, NULL, NULL, NULL, NULL, NULL, '{"url":"http:\\/\\/www.example.com","logo":"2016\\/06\\/axipi-200x100.jpg","logo_mime":"image\\/jpeg","logo_size":11188}', 0, 0, 1, '2016-06-11 19:41:59', '2016-06-11 19:41:59', NULL, NULL, NULL, 0),
(157, 1, 36, 4, NULL, NULL, 'test bread', 'en-575c6bfa15af4', 0, NULL, NULL, NULL, NULL, NULL, NULL, 0, 0, 1, '2016-06-11 19:52:26', '2016-06-11 19:52:26', NULL, NULL, NULL, 0),
(158, 1, 37, 4, NULL, NULL, 'test website', 'en-575c6f6bc83d4', 0, NULL, NULL, NULL, NULL, NULL, '{"url":"http:\\/\\/www.example.com","name":"Test name","alternateName":null}', 0, 0, 1, '2016-06-11 20:07:07', '2016-06-11 20:11:33', NULL, NULL, NULL, 0),
(160, 1, 4, 7, NULL, NULL, 'Header titles', 'en-575d1c13df456', -10, NULL, NULL, NULL, NULL, NULL, '{"description":"<h1><a href=\\"[page:9:]\\">Example<\\/a><\\/h1>\\r\\n<h2>Maecenas scelerisque rutrum malesuada<\\/h2>","div_class":null,"display_title":false,"title_tag":null}', 0, 0, 1, '2016-06-12 08:23:47', '2016-06-18 17:16:18', NULL, NULL, NULL, 0),
(161, 1, 9, NULL, NULL, NULL, 'Facebook Page', 'en-575d26071f133', 0, 'facebook', NULL, NULL, NULL, NULL, '{"url":"https:\\/\\/www.facebook.com\\/axipi\\/"}', 0, 0, 1, '2016-06-12 09:06:15', '2016-06-12 09:06:24', NULL, NULL, NULL, 0),
(162, 1, 8, 6, NULL, NULL, 'Quick Links', 'en-575d26284d62f', 0, NULL, NULL, NULL, NULL, NULL, '{"predefined":null,"display_title":true,"title_tag":null,"div_class":null,"ul_class":null}', 0, 0, 1, '2016-06-12 09:06:48', '2016-06-12 09:07:36', NULL, NULL, NULL, 0),
(163, 1, 9, NULL, NULL, NULL, 'Source code', 'en-575d27246f2f3', 0, 'source-code', NULL, NULL, NULL, NULL, '{"url":"https:\\/\\/code.sdion.net\\/opensource\\/axipi"}', 0, 0, 1, '2016-06-12 09:11:00', '2016-06-12 09:11:00', NULL, NULL, NULL, 0),
(164, 1, 11, NULL, 5, NULL, 'Category 3', 'en-5761af792ca86', 0, 'blog/category-3', NULL, NULL, NULL, NULL, '{"description":null}', 0, 0, 1, '2016-06-15 19:41:45', '2016-06-15 19:41:45', NULL, NULL, NULL, 0),
(166, 1, 3, NULL, NULL, NULL, 'a', 'en-57631429b48ca', 0, 'a', NULL, NULL, NULL, NULL, '{"description":null}', 0, 0, 1, '2016-06-16 21:03:37', '2016-06-16 21:03:37', NULL, NULL, NULL, 0),
(167, 1, 3, NULL, 166, NULL, 'b', 'en-57631430262e5', 0, 'a/b', NULL, NULL, NULL, NULL, '{"description":null}', 0, 0, 1, '2016-06-16 21:03:44', '2016-06-16 21:03:44', NULL, NULL, NULL, 0),
(168, 1, 3, NULL, 167, NULL, 'c', 'en-5763143bdd792', 0, 'a/b/c', NULL, NULL, NULL, NULL, '{"description":null}', 0, 0, 1, '2016-06-16 21:03:48', '2016-06-16 21:03:55', NULL, NULL, NULL, 0),
(169, 1, 3, NULL, 168, NULL, 'd', 'en-57631441e92b5', 0, 'a/b/c/d', NULL, NULL, NULL, NULL, '{"description":null}', 0, 0, 1, '2016-06-16 21:04:01', '2016-06-16 21:04:01', NULL, NULL, NULL, 0),
(170, 1, 3, NULL, 169, NULL, 'e', 'en-5763144848134', 0, 'a/b/c/d/e', NULL, NULL, NULL, NULL, '{"description":null}', 0, 0, 1, '2016-06-16 21:04:08', '2016-06-16 21:04:08', NULL, NULL, NULL, 0),
(171, 1, 3, NULL, 170, NULL, 'f', 'en-5763144d75cfe', 0, 'a/b/c/d/e/f', NULL, NULL, NULL, NULL, '{"description":null}', 0, 0, 1, '2016-06-16 21:04:13', '2016-06-16 21:04:13', NULL, NULL, NULL, 0),
(172, 1, 12, NULL, 51, NULL, 'test post category 2', 'en-57658438efdfb', 0, 'category2/test-post-category-2', NULL, NULL, NULL, NULL, '{"description":"<p>Quisque gravida consectetur lorem, in rutrum nibh molestie sed. Pellentesque euismod neque sit amet augue finibus tincidunt. Vestibulum ante ipsum primis in faucibus orci luctus et ultrices posuere cubilia Curae; Proin at congue ex, non dignissim mauris. Donec venenatis mattis blandit. Sed ornare tempus ante, eget finibus justo faucibus a. Aliquam scelerisque mi nisl, id tristique est pretium nec. Mauris non efficitur velit, vitae ullamcorper ante. Maecenas cursus augue nec efficitur volutpat. Etiam malesuada, dolor ut tristique lacinia, odio urna dapibus turpis, ut rutrum nibh orci lacinia turpis. Vestibulum lacinia, ex vel lobortis vestibulum, lacus elit euismod turpis, et tincidunt urna elit vel sem. Morbi a ex consequat, commodo libero ac, mattis dolor. Nunc sapien mauris, porttitor in tristique sed, scelerisque et ligula.<\\/p>\\r\\n<p><!-- pagebreak --><\\/p>\\r\\n<p>Sed maximus ligula felis, vel hendrerit enim commodo eu. Vestibulum fermentum turpis ac ornare cursus. Vestibulum ultricies lorem sed nibh semper dapibus. Donec imperdiet ex in mi viverra, eu consectetur mauris tincidunt. Quisque sed risus urna. Sed lacinia nulla eu eleifend condimentum. Nam malesuada justo sed elit varius feugiat et eu velit. Praesent id lectus blandit, facilisis nisl ut, vulputate massa. Phasellus magna leo, rhoncus ut posuere sed, rutrum ut nisi. Integer quis lectus dolor. Nulla non maximus lacus. Donec vitae ultrices enim. Praesent a magna metus. Aenean dapibus varius tristique. Vivamus auctor massa sit amet lectus pharetra, nec tincidunt risus dignissim. Vivamus et mi non risus laoreet dictum.<\\/p>\\r\\n<p>Phasellus euismod congue libero vitae tempus. Nam risus lectus, iaculis vel ligula vel, ultrices pharetra risus. Curabitur condimentum elit sit amet eros malesuada, quis lobortis lacus tempor. Nunc id orci ac nibh ultrices malesuada. Sed vel nulla eget enim scelerisque viverra id non purus. Nullam sit amet porttitor nunc. Aenean at varius dui. Lorem ipsum dolor sit amet, consectetur adipiscing elit. Duis gravida tellus diam, eu blandit tellus ultrices quis. Aliquam id lacus eget elit cursus viverra id a velit. Curabitur enim turpis, feugiat id mi et, gravida egestas metus.<\\/p>","image":"2016\\/06\\/0227618.jpg","image_mime":"image\\/jpeg","image_size":523745}', 0, 0, 1, '2016-06-18 17:26:16', '2016-06-18 19:21:21', NULL, NULL, NULL, 0),
(173, 1, 6, NULL, 3, NULL, '57659a5d715ae0.29015276', 'en-57659a5d759dc', 0, 'album/57659a5d715ae0.29015276', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/1412683.jpg","image_mime":"image\\/jpeg","image_size":399096}', 0, 0, 1, '2016-06-18 19:00:45', '2016-06-18 19:00:45', NULL, NULL, NULL, 0),
(174, 1, 6, NULL, 3, NULL, '57659a5d8ce466.12432142', 'en-57659a5d93161', 0, 'album/57659a5d8ce466.12432142', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/1361898.jpg","image_mime":"image\\/jpeg","image_size":408859}', 0, 0, 1, '2016-06-18 19:00:45', '2016-06-18 19:00:45', NULL, NULL, NULL, 0),
(175, 1, 6, NULL, 3, NULL, '57659a5daa3d89.84355351', 'en-57659a5daf128', 0, 'album/57659a5daa3d89.84355351', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/1260515.jpg","image_mime":"image\\/jpeg","image_size":684670}', 0, 0, 1, '2016-06-18 19:00:45', '2016-06-18 19:00:45', NULL, NULL, NULL, 0),
(176, 1, 6, NULL, 3, NULL, '57659a5dc47853.66567175', 'en-57659a5dc8ede', 0, 'album/57659a5dc47853.66567175', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/1260519.jpg","image_mime":"image\\/jpeg","image_size":724354}', 0, 0, 1, '2016-06-18 19:00:45', '2016-06-18 19:00:45', NULL, NULL, NULL, 0),
(177, 1, 6, NULL, 3, NULL, '57659a5dddd7f5.19651120', 'en-57659a5de2066', 0, 'album/57659a5dddd7f5.19651120', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/1414696.jpg","image_mime":"image\\/jpeg","image_size":243872}', 0, 0, 1, '2016-06-18 19:00:45', '2016-06-18 19:00:45', NULL, NULL, NULL, 0),
(178, 1, 6, NULL, 3, NULL, '57659a5df31821.67886866', 'en-57659a5e0341e', 0, 'album/57659a5df31821.67886866', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/1260521.jpg","image_mime":"image\\/jpeg","image_size":728200}', 0, 0, 1, '2016-06-18 19:00:46', '2016-06-18 19:00:46', NULL, NULL, NULL, 0),
(179, 1, 6, NULL, 3, NULL, '57659a5e13f533.25376859', 'en-57659a5e1848f', 0, 'album/57659a5e13f533.25376859', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/1260471.jpg","image_mime":"image\\/jpeg","image_size":735095}', 0, 0, 1, '2016-06-18 19:00:46', '2016-06-18 19:00:46', NULL, NULL, NULL, 0),
(180, 1, 6, NULL, 3, NULL, '57659a5e2c01d8.43902449', 'en-57659a5e3329e', 0, 'album/57659a5e2c01d8.43902449', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/1256876.jpg","image_mime":"image\\/jpeg","image_size":572493}', 0, 0, 1, '2016-06-18 19:00:46', '2016-06-18 19:00:46', NULL, NULL, NULL, 0),
(181, 1, 6, NULL, 3, NULL, '57659a5e46a766.35712185', 'en-57659a5e4a80c', 0, 'album/57659a5e46a766.35712185', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/1932389.jpg","image_mime":"image\\/jpeg","image_size":405254}', 0, 0, 1, '2016-06-18 19:00:46', '2016-06-18 19:00:46', NULL, NULL, NULL, 0),
(182, 1, 6, NULL, 3, NULL, '57659a5e61ab96.43450994', 'en-57659a5e67e63', 0, 'album/57659a5e61ab96.43450994', NULL, NULL, NULL, NULL, '{"image":"2016\\/06\\/1624280.jpg","image_mime":"image\\/jpeg","image_size":232090}', 0, 0, 1, '2016-06-18 19:00:46', '2016-06-18 19:00:46', NULL, NULL, NULL, 0),
(183, 1, 5, NULL, NULL, NULL, 'Albums', 'en-5766113e1acd8', 0, 'albums', NULL, NULL, NULL, NULL, '{"description":null}', 0, 0, 1, '2016-06-19 03:27:58', '2016-06-19 03:27:58', NULL, NULL, NULL, 0),
(184, 1, 41, NULL, NULL, NULL, 'Test widget map', 'en-57661f9898d87', 0, NULL, NULL, NULL, NULL, NULL, '{"api_key":"AIzaSyA6iB9JEQ4XiEez_dgv3hoJWlAj4DOCGWo","latitude":"48.8099767","longitude":"2.3911679","zoom":"10","height":null,"infowindow":null}', 0, 0, 1, '2016-06-19 04:29:12', '2016-06-19 04:52:10', NULL, NULL, NULL, 0),
(185, 1, 42, NULL, 184, NULL, 'marker 1', 'en-576622b41f82d', 0, NULL, NULL, NULL, NULL, NULL, '{"latitude":"48.8099767","longitude":"2.3911679","infowindow":"<p>test 1<\\/p>"}', 0, 0, 1, '2016-06-19 04:42:28', '2016-06-19 04:52:25', NULL, NULL, NULL, 0),
(186, 1, 42, NULL, 184, NULL, 'marker 2', 'en-5766238b20e5c', 0, NULL, NULL, NULL, NULL, NULL, '{"latitude":"48.8099767","longitude":"2.555555","infowindow":"<p>test 2<\\/p>"}', 0, 0, 1, '2016-06-19 04:46:03', '2016-06-19 04:46:03', NULL, NULL, NULL, 0);

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
  `parent` int(10) unsigned DEFAULT NULL,
  `title` varchar(255) DEFAULT NULL,
  `ordering` int(11) NOT NULL DEFAULT '0',
  `is_active` tinyint(1) NOT NULL DEFAULT '0',
  `date_created` datetime NOT NULL,
  `date_modified` datetime DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `widget_id_page_id` (`widget_id`,`page_id`),
  KEY `widget_id` (`widget_id`),
  KEY `page_id` (`page_id`),
  KEY `IDX_628947493D8E604F` (`parent`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8;

--
-- Dumping data for table `relation`
--

INSERT INTO `relation` (`id`, `widget_id`, `page_id`, `title`, `ordering`, `is_active`, `date_created`, `date_modified`, `parent`) VALUES
(3, 38, 183, NULL, 0, 1, '2016-05-21 19:42:11', '2016-06-19 03:29:52', NULL),
(4, 38, 9, NULL, -10, 1, '2016-05-21 19:42:17', '2016-05-21 19:56:25', NULL),
(5, 3, 5, NULL, 0, 1, '2016-05-21 19:57:12', '2016-05-21 19:57:12', NULL),
(8, 38, 5, NULL, 0, 1, '2016-06-01 18:06:12', '2016-06-15 19:59:34', NULL),
(9, 117, 116, NULL, -10, 1, '2016-06-03 19:11:07', '2016-06-03 19:11:41', NULL),
(10, 117, 19, NULL, 0, 1, '2016-06-03 19:11:22', '2016-06-03 19:11:22', NULL),
(12, 38, 123, NULL, 0, 1, '2016-06-05 09:08:16', '2016-06-05 09:08:16', NULL),
(15, 162, 161, NULL, 0, 1, '2016-06-12 09:07:06', '2016-06-12 09:07:06', NULL),
(16, 162, 163, NULL, 0, 1, '2016-06-12 09:11:09', '2016-06-12 09:11:09', NULL),
(17, 38, 10, NULL, 0, 1, '2016-06-12 09:12:35', '2016-06-12 09:12:35', NULL),
(18, 38, 6, NULL, 0, 1, '2016-06-15 19:15:38', '2016-06-15 19:39:37', 8),
(20, 38, 51, NULL, 0, 1, '2016-06-15 19:40:56', '2016-06-15 19:40:56', 8),
(21, 38, 164, NULL, 0, 1, '2016-06-15 19:41:54', '2016-06-15 19:41:54', 8);

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
(4, 'example@example.com', '$2y$13$rRU8jboUPotlqbCvPpQP/.TUjBYMIB6kYNp9nDB4TmadoVvwE4p1S', 'Example', NULL, '["ROLE_USERS","ROLE_PAGES","ROLE_WIDGETS","ROLE_FILES","ROLE_LANGUAGES","ROLE_COMPONENTS","ROLE_ZONES","ROLE_SEARCH","ROLE_CACHE","ROLE_INFO"]', 1, '2016-05-23 18:59:47', '2016-06-17 14:26:37');

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
(1, 'footer', 6, 1, '2016-05-18 21:17:11', '2016-06-15 06:43:22'),
(2, 'before_content', 4, 1, '2016-05-21 02:01:25', '2016-05-21 21:46:30'),
(3, 'nav', 3, 1, '2016-05-21 02:18:34', '2016-06-12 08:28:36'),
(4, 'head', 1, 1, '2016-05-23 20:12:38', '2016-05-23 20:12:38'),
(6, 'sidebar', 5, 1, '2016-06-12 07:20:28', '2016-06-12 07:20:28'),
(7, 'before_nav', 2, 1, '2016-06-12 08:28:43', '2016-06-13 19:13:42');

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
  ADD CONSTRAINT `FK_628947493D8E604F` FOREIGN KEY (`parent`) REFERENCES `relation` (`id`) ON DELETE SET NULL,
  ADD CONSTRAINT `FK_62894749FBE885E2` FOREIGN KEY (`widget_id`) REFERENCES `item` (`id`) ON DELETE CASCADE,
  ADD CONSTRAINT `FK_8CFDBD9FC4663E4` FOREIGN KEY (`page_id`) REFERENCES `item` (`id`) ON DELETE CASCADE;

SET FOREIGN_KEY_CHECKS=1;
