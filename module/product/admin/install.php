<?php

module_exists('product')&&yun_error('模型已安装');

$DB->query('DROP TABLE IF EXISTS `'.PF.'product'.'`');

$sql="
CREATE TABLE IF NOT EXISTS `".PF."product` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `channel_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `authorid` int(10) NOT NULL DEFAULT '0',
  `post_time` int(10) NOT NULL DEFAULT '0',
  `content` longtext NOT NULL,
  `title` varchar(100) NOT NULL,
  `comments` mediumint(8) NOT NULL DEFAULT '0',
  `hits` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `keywords` varchar(255) NOT NULL,
  `thumb` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `pagetitles` text NOT NULL,
  `pics` text NOT NULL,
  `sign` varchar(250) NOT NULL,
  `link` varchar(100) NOT NULL,
  `tuijian` tinyint(1) NOT NULL DEFAULT '0',
  `cat_0` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `cat_1` tinyint(2) unsigned NOT NULL DEFAULT '0',
  `cat_2` tinyint(2) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `hits` (`hits`),
  KEY `sign` (`sign`),
  KEY `channel_id` (`channel_id`),
  KEY `post_time` (`post_time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;
";

$DB->query($sql);

set_mod('product');

admin::upcache();
yun_succeed('成功安装','f');
?>