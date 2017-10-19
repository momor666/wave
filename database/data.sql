DROP TABLE IF EXISTS `org_type`;
CREATE TABLE IF NOT EXISTS `org_type` (
  `org_type_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_type_name` varchar(50) NOT NULL,
  `org_type_image` text NOT NULL,
  PRIMARY KEY (`org_type_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

INSERT INTO `org_type` (`org_type_id`, `org_type_name`, `org_type_image`) VALUES
(1, 'Төрийн бус байгууллага', 'upload/images/tbb.png'),
(2, 'Цагдаагийн ерөнхий газар', 'upload/images/police.png'),
(3, 'Эмнэлэг', 'upload/images/ambulance.png');

DROP TABLE IF EXISTS `organization`;
CREATE TABLE IF NOT EXISTS `organization` (
  `org_id` int(11) NOT NULL AUTO_INCREMENT,
  `org_name` varchar(255) NOT NULL,
  `org_type_id` int(11) NOT NULL,
  `org_about` text NOT NULL,
  `org_image` varchar(255) NOT NULL,
  `org_email` varchar(255) NOT NULL,
  `org_phone` int(20) NOT NULL,
  `org_fb` varchar(255) NOT NULL,
  `org_web` varchar(255) NOT NULL,
  `org_location` varchar(255) NOT NULL,
  PRIMARY KEY (`org_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

DROP TABLE IF EXISTS `project`;
CREATE TABLE IF NOT EXISTS `project` (
  `project_id` int(11) NOT NULL AUTO_INCREMENT,
  `project_name` varchar(255) NOT NULL,
  `org_id` int(11) NOT NULL,
  `project_about` text NOT NULL,
  `project_image` varchar(255) NOT NULL,
  `project_email` varchar(255) NOT NULL,
  `project_phone` int(20) NOT NULL,
  `project_fb` varchar(255) NOT NULL,
  `project_web` text NOT NULL,
  PRIMARY KEY (`project_id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE `company` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `sort_order` int(11) NOT NULL,
  `icon_image` varchar(255) DEFAULT NULL,
  `is_featured` tinyint(4) DEFAULT NULL,
  `description` longtext NOT NULL,
  `category_id` int(11) DEFAULT NULL,
  `created_user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE `product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `description` longtext NOT NULL,
  `photo_id` int(11) NOT NULL,
  `price` double(18,2) DEFAULT NULL,
  `currency` varchar(10) DEFAULT NULL,
  `company_id` int(11) DEFAULT NULL,
  `category_id` int(11) DEFAULT NULL,
  `info_url` text NOT NULL,
  `sort_order` int(11) NOT NULL,
  `in_stock` tinyint(4) DEFAULT NULL,
  `is_featured` tinyint(4) DEFAULT NULL,
  `created_user_id` int(11) DEFAULT NULL,
  `updated_user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE `category` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `name` varchar(255) NOT NULL,
  `parent_id` int(11) DEFAULT NULL,
  `level` tinyint(4) DEFAULT NULL,
  `image` varchar(255) DEFAULT NULL,
  `description` text NOT NULL,
  `sort_order` int(11) NOT NULL,
  `created_user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE `product_photo` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `product_id` int(11) DEFAULT NULL,
  `caption` varchar(255) NOT NULL,
  `photo_file` varchar(255) DEFAULT NULL,
  `thumb_file` varchar(255) DEFAULT NULL,
  `is_default` tinyint(4) DEFAULT NULL,
  `sort_order` int(11) DEFAULT NULL,
  `created_user_id` int(11) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

CREATE TABLE `user` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `username` varchar(255) NOT NULL,
  `password` varchar(255) DEFAULT NULL,
  `email` varchar(255) DEFAULT NULL,
  `firstname` varchar(255) NOT NULL,
  `lastname` varchar(255) NOT NULL,
  `mobile` varchar(255) NOT NULL,
  `gender` tinyint(4) NOT NULL DEFAULT '1',
  `birthday` date DEFAULT NULL,
  `status` tinyint(4) NOT NULL DEFAULT '1',
  `avatar` varchar(255) DEFAULT NULL,
  `ip_address` varchar(20) DEFAULT NULL,
  `created_at` datetime NOT NULL,
  `updated_at` datetime NOT NULL,
  `type` varchar(255) DEFAULT 'person',
  `website` varchar(255) NOT NULL,
  `fb_id` varchar(255) DEFAULT NULL,
  `slug` varchar(255) DEFAULT NULL,
  PRIMARY KEY (`id`),
  UNIQUE KEY `username` (`username`)
) ENGINE=InnoDB  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1 ;

ALTER TABLE `category`
  ADD FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `company`
  ADD FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD FOREIGN KEY (`category_id`) REFERENCES `category` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;

ALTER TABLE `category`
  ADD FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD FOREIGN KEY (`parent_id`) REFERENCES `category` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

  
ALTER TABLE `product`
  ADD FOREIGN KEY (`company_id`) REFERENCES `company` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD FOREIGN KEY (`photo_id`) REFERENCES `product_photo` (`id`) ON DELETE CASCADE ON UPDATE CASCADE;

ALTER TABLE `product_photo`
  ADD FOREIGN KEY (`created_user_id`) REFERENCES `user` (`id`) ON DELETE SET NULL ON UPDATE CASCADE,
  ADD FOREIGN KEY (`product_id`) REFERENCES `product` (`id`) ON DELETE SET NULL ON UPDATE CASCADE;
