CREATE TABLE IF NOT EXISTS `#__cfgvideos_videos` (
	`id` int(11) unsigned NOT NULL AUTO_INCREMENT PRIMARY KEY,
  `uuid` char(36) NOT NULL UNIQUE,
	`title` varchar(255) NOT NULL,
	`video_url` varchar(255) 	NOT NULL,
	`img_url` varchar(255) NOT NULL,
	`description` longtext,
	`enabled` tinyint(1) NOT NULL default 1,
	`created_on` datetime NOT NULL default '0000-00-00 00:00:00',
	`created_by` bigint(20) NOT NULL default 0,
	`modified_on` datetime NOT NULL default '0000-00-00 00:00:00',
	`modified_by` bigint(20) NOT NULL default 0,
	`params` text
) DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__cfgvideos_tags` (
  `tag_id` bigint(20) UNSIGNED NOT NULL AUTO_INCREMENT,
  `title` varchar(255) NOT NULL,
  `slug` varchar(255) NOT NULL,
	`count` int(11) DEFAULT '0',
  `created_by` int(10) UNSIGNED DEFAULT NULL,
  `created_on` datetime DEFAULT NULL,
  `modified_by` int(10) UNSIGNED DEFAULT NULL,
  `modified_on` datetime DEFAULT NULL,
  `locked_by` int(10) UNSIGNED DEFAULT NULL,
  `locked_on` datetime DEFAULT NULL,
  `params` text NOT NULL,
  PRIMARY KEY (`tag_id`),
  UNIQUE KEY `slug` (`slug`),
  UNIQUE KEY `title` (`title`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;

CREATE TABLE IF NOT EXISTS `#__cfgvideos_tags_relations` (
  `tag_id` bigint(20) UNSIGNED NOT NULL,
  `row` varchar(36) NOT NULL,
  PRIMARY KEY (`tag_id`, `row`)
) ENGINE=InnoDB DEFAULT CHARSET=utf8;