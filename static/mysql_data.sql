-- phpMyAdmin SQL Dump
-- version 3.2.4
-- http://www.phpmyadmin.net
--
-- 主机: localhost
-- 生成日期: 2014 年 06 月 17 日 07:41
-- 服务器版本: 5.1.41
-- PHP 版本: 5.3.1

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


--
-- 数据库: `ayacms`
--

-- --------------------------------------------------------

--
-- 表的结构 `dodo_article`
--

DROP TABLE IF EXISTS `dodo_article`;
CREATE TABLE IF NOT EXISTS `dodo_article` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=22 ;

--
-- 转存表中的数据 `dodo_article`
--

INSERT INTO `dodo_article` (`id`, `channel_id`, `authorid`, `post_time`, `content`, `title`, `comments`, `hits`, `keywords`, `thumb`, `description`, `pagetitles`, `sign`, `link`, `tuijian`, `cat_0`, `cat_1`, `cat_2`) VALUES
(1, 2, 1, 1402984229, '<p>AyaCMS2.0,于2014年6月17日发布<br /></p>', 'AyaCMS2.0,于2014年6月17日发布', 0, 0, 'ayacms,发布', '', '', '', '', 'show/1/', 0, 1, 0, 0),
(2, 2, 1, 1402984268, '<p>AyaCMS2.0,于2014年6月17日发布<br /></p>', 'AyaCMS2.0,于2014年6月17日发布', 0, 0, '', '', '', '', '', 'show/2/', 0, 1, 0, 0),
(3, 2, 1, 1402984396, '<p>AyaCMS2.0,于2014年6月17日发布.</p><p><span>测试内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容</span></span></span></span></span></span></span></span><br /></p>', 'AyaCMS2.0,于2014年6月17日发布', 0, 0, '', '', '', '', '', 'show/3/', 0, 0, 0, 0),
(4, 2, 1, 1402984399, '<p>AyaCMS2.0,于2014年6月17日发布.</p><p><span>测试内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容</span></span></span></span></span></span></span></span><br /></p>', 'AyaCMS2.0,于2014年6月17日发布', 0, 0, '', '', '', '', '', 'show/4/', 0, 0, 0, 0),
(5, 2, 1, 1402984401, '<p>AyaCMS2.0,于2014年6月17日发布.</p><p><span>测试内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容</span></span></span></span></span></span></span></span><br /></p>', 'AyaCMS2.0,于2014年6月17日发布', 0, 0, '', '', '', '', '', 'show/5/', 0, 0, 0, 0),
(6, 2, 1, 1402984402, '<p>AyaCMS2.0,于2014年6月17日发布.</p><p><span>测试内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容</span></span></span></span></span></span></span></span><br /></p>', 'AyaCMS2.0,于2014年6月17日发布', 0, 0, '', '', '', '', '', 'show/6/', 0, 0, 0, 0),
(7, 2, 1, 1402984404, '<p>AyaCMS2.0,于2014年6月17日发布.</p><p><span>测试内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容</span></span></span></span></span></span></span></span><br /></p>', 'AyaCMS2.0,于2014年6月17日发布', 0, 0, '', '', '', '', '', 'show/7/', 0, 0, 0, 0),
(8, 2, 1, 1402984405, '<p>AyaCMS2.0,于2014年6月17日发布.</p><p><span>测试内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容</span></span></span></span></span></span></span></span><br /></p>', 'AyaCMS2.0,于2014年6月17日发布', 0, 0, '', '', '', '', '', 'show/8/', 0, 0, 0, 0),
(9, 2, 1, 1402984407, '<p>AyaCMS2.0,于2014年6月17日发布.</p><p><span>测试内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容</span></span></span></span></span></span></span></span><br /></p>', 'AyaCMS2.0,于2014年6月17日发布', 0, 0, '', '', '', '', '', 'show/9/', 0, 0, 0, 0),
(10, 2, 1, 1402984409, '<p>AyaCMS2.0,于2014年6月17日发布.</p><p><span>测试内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容</span></span></span></span></span></span></span></span><br /></p>', 'AyaCMS2.0,于2014年6月17日发布', 0, 0, '', '', '', '', '', 'show/10/', 0, 0, 0, 0),
(11, 2, 1, 1402984410, '<p>AyaCMS2.0,于2014年6月17日发布.</p><p><span>测试内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容</span></span></span></span></span></span></span></span><br /></p>', 'AyaCMS2.0,于2014年6月17日发布', 0, 0, '', '', '', '', '', 'show/11/', 0, 0, 0, 0),
(12, 2, 1, 1402984411, '<p>AyaCMS2.0,于2014年6月17日发布.</p><p><span>测试内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容</span></span></span></span></span></span></span></span><br /></p>', 'AyaCMS2.0,于2014年6月17日发布', 0, 1, '', '', '', '', '', 'show/12/', 0, 0, 0, 0),
(13, 2, 1, 1402984435, '<p>AyaCMS2.0,于2014年6月17日发布.</p><p><span>测试内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容</span></span></span></span></span></span></span></span><br /></p>', 'AyaCMS2.0,于2014年6月17日发布', 0, 0, '', '', '', '', '', 'show/13/', 0, 0, 0, 0),
(14, 2, 1, 1402984439, '<p>AyaCMS2.0,于2014年6月17日发布.</p><p><span>测试内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容</span></span></span></span></span></span></span></span><br /></p>', 'AyaCMS2.0,于2014年6月17日发布', 0, 0, '', '', '', '', '', 'show/14/', 0, 0, 0, 0),
(15, 2, 1, 1402984440, '<p>AyaCMS2.0,于2014年6月17日发布.</p><p><span>测试内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容</span></span></span></span></span></span></span></span><br /></p>', 'AyaCMS2.0,于2014年6月17日发布', 0, 0, '', '', '', '', '', 'show/15/', 0, 0, 0, 0),
(16, 2, 1, 1402984442, '<p>AyaCMS2.0,于2014年6月17日发布.</p><p><span>测试内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容</span></span></span></span></span></span></span></span><br /></p>', 'AyaCMS2.0,于2014年6月17日发布', 0, 0, '', '', '', '', '', 'show/16/', 0, 0, 0, 0),
(17, 2, 1, 1402984443, '<p>AyaCMS2.0,于2014年6月17日发布.</p><p><span>测试内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容</span></span></span></span></span></span></span></span><br /></p>', 'AyaCMS2.0,于2014年6月17日发布', 0, 0, '', '', '', '', '', 'show/17/', 0, 0, 0, 0),
(18, 2, 1, 1402984444, '<p>AyaCMS2.0,于2014年6月17日发布.</p><p><span>测试内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容</span></span></span></span></span></span></span></span><br /></p>', 'AyaCMS2.0,于2014年6月17日发布', 0, 0, '', '', '', '', '', 'show/18/', 0, 0, 0, 0),
(19, 2, 1, 1402984445, '<p>AyaCMS2.0,于2014年6月17日发布.</p><p><span>测试内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容</span></span></span></span></span></span></span></span><br /></p>', 'AyaCMS2.0,于2014年6月17日发布', 0, 0, '', '', '', '', '', 'show/19/', 0, 0, 0, 0),
(20, 2, 1, 1402984459, '<p>AyaCMS2.0,于2014年6月17日发布.</p><p><span>测试内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容</span></span></span></span></span></span></span></span><br /></p>', 'AyaCMS2.0,于2014年6月17日发布', 0, 0, '', '', '', '', '', 'show/20/', 0, 0, 0, 0),
(21, 2, 1, 1402984463, '<p>AyaCMS2.0,于2014年6月17日发布.</p><p><span>测试内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容<span>内容内容</span></span></span></span></span></span></span></span><br /></p>', 'AyaCMS2.0,于2014年6月17日发布', 0, 2, '', '', '', '', '', 'show/21/', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `dodo_channel`
--

DROP TABLE IF EXISTS `dodo_channel`;
CREATE TABLE IF NOT EXISTS `dodo_channel` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `formod` varchar(50) NOT NULL,
  `name` varchar(50) NOT NULL,
  `hide` tinyint(1) NOT NULL DEFAULT '0',
  `home` tinyint(1) NOT NULL DEFAULT '0',
  `sign` varchar(50) NOT NULL,
  `pvs` text NOT NULL,
  `cats` text NOT NULL,
  `tabs` text NOT NULL,
  `configs` text NOT NULL,
  `comment` tinyint(1) NOT NULL DEFAULT '0',
  `o` smallint(6) NOT NULL DEFAULT '0',
  `pid` mediumint(8) NOT NULL DEFAULT '0',
  `link` varchar(100) NOT NULL,
  `keywords` varchar(255) NOT NULL,
  `description` varchar(255) NOT NULL,
  `action_1` varchar(50) NOT NULL,
  `action_1_to` varchar(50) NOT NULL,
  `action_2` varchar(50) NOT NULL,
  `action_2_to` varchar(50) NOT NULL,
  `action_3` varchar(50) NOT NULL,
  `action_3_to` varchar(50) NOT NULL,
  `action_tpl_1` varchar(50) NOT NULL,
  `action_tpl_1_to` varchar(50) NOT NULL,
  `action_tpl_2` varchar(50) NOT NULL,
  `action_tpl_2_to` varchar(50) NOT NULL,
  `action_tpl_3` varchar(50) NOT NULL,
  `action_tpl_3_to` varchar(50) NOT NULL,
  `theme_tpl_1` varchar(50) NOT NULL,
  `theme_tpl_1_to` varchar(50) NOT NULL,
  `theme_tpl_2` varchar(50) NOT NULL,
  `theme_tpl_2_to` varchar(50) NOT NULL,
  `theme_tpl_3` varchar(50) NOT NULL,
  `theme_tpl_3_to` varchar(50) NOT NULL,
  `theme_tpl` varchar(50) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `order` (`o`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `dodo_channel`
--

INSERT INTO `dodo_channel` (`id`, `formod`, `name`, `hide`, `home`, `sign`, `pvs`, `cats`, `tabs`, `configs`, `comment`, `o`, `pid`, `link`, `keywords`, `description`, `action_1`, `action_1_to`, `action_2`, `action_2_to`, `action_3`, `action_3_to`, `action_tpl_1`, `action_tpl_1_to`, `action_tpl_2`, `action_tpl_2_to`, `action_tpl_3`, `action_tpl_3_to`, `theme_tpl_1`, `theme_tpl_1_to`, `theme_tpl_2`, `theme_tpl_2_to`, `theme_tpl_3`, `theme_tpl_3_to`, `theme_tpl`) VALUES
(1, 'webnull', '首页', 0, 1, 'QwMmhP', '', '', '', '', 0, 1, 0, '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', 'home.php'),
(2, 'article', '新闻', 0, 0, 'news', 'a:5:{i:0;a:2:{i:0;i:1;i:1;i:0;}i:1;a:2:{i:0;i:1;i:1;i:1;}i:2;a:2:{i:0;i:1;i:1;i:0;}i:3;a:2:{i:0;i:1;i:1;i:1;}i:4;a:2:{i:0;i:1;i:1;i:1;}}', 'a:1:{i:0;a:3:{s:2:"id";i:0;s:4:"name";s:6:"国别";s:8:"subnames";a:4:{i:0;s:6:"中国";i:1;s:9:"菲律宾";i:2;s:6:"日本";i:3;s:6:"韩国";}}}', 'a:2:{s:4:"diss";a:0:{}s:4:"tpls";a:0:{}}', 'a:3:{s:5:"t_num";i:20;s:5:"c_num";i:40;s:6:"tc_num";i:5;}', 0, 2, 1, 'news/', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(3, 'picture', '图片', 0, 0, 'pics', 'a:5:{i:0;a:2:{i:0;i:1;i:1;i:0;}i:1;a:2:{i:0;i:1;i:1;i:1;}i:2;a:2:{i:0;i:1;i:1;i:0;}i:3;a:2:{i:0;i:1;i:1;i:1;}i:4;a:2:{i:0;i:1;i:1;i:1;}}', 'a:2:{i:0;a:3:{s:2:"id";i:0;s:4:"name";s:6:"镜头";s:8:"subnames";a:5:{i:0;s:3:"1mm";i:1;s:3:"2mm";i:2;s:3:"3mm";i:3;s:3:"4mm";i:4;s:3:"5mm";}}i:1;a:3:{s:2:"id";i:1;s:4:"name";s:6:"类型";s:8:"subnames";a:3:{i:0;s:6:"搞笑";i:1;s:6:"娱乐";i:2;s:6:"爆光";}}}', 'a:2:{s:4:"diss";a:0:{}s:4:"tpls";a:0:{}}', 'a:3:{s:5:"t_num";i:18;s:5:"c_num";i:40;s:6:"tc_num";i:5;}', 0, 3, 1, 'pics/', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(4, 'product', '产品', 0, 0, 'product', 'a:5:{i:0;a:2:{i:0;i:1;i:1;i:0;}i:1;a:2:{i:0;i:1;i:1;i:1;}i:2;a:2:{i:0;i:1;i:1;i:0;}i:3;a:2:{i:0;i:1;i:1;i:1;}i:4;a:2:{i:0;i:1;i:1;i:1;}}', 'a:1:{i:0;a:3:{s:2:"id";i:0;s:4:"name";s:6:"型号";s:8:"subnames";a:3:{i:0;s:3:"大";i:1;s:3:"中";i:2;s:3:"小";}}}', 'a:2:{s:4:"diss";a:0:{}s:4:"tpls";a:0:{}}', 'a:3:{s:5:"t_num";i:20;s:5:"c_num";i:40;s:6:"tc_num";i:5;}', 0, 4, 1, 'product/', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', ''),
(5, 'webpage', '关于', 0, 0, 'about', '', '', '', '', 0, 5, 1, 'about/', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '', '');

-- --------------------------------------------------------

--
-- 表的结构 `dodo_page`
--

DROP TABLE IF EXISTS `dodo_page`;
CREATE TABLE IF NOT EXISTS `dodo_page` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `content` longtext NOT NULL,
  `pv` longtext NOT NULL,
  `post_time` int(10) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=6 ;

--
-- 转存表中的数据 `dodo_page`
--

INSERT INTO `dodo_page` (`id`, `content`, `pv`, `post_time`) VALUES
(5, '<p>测试内容<span>测试内容<span>测试内容<span>测试内容</span></span></span></p><p><span><span><span><span><span><span><span><span><span>测试内容<span>测试内容<span>测试内容<span>测试内容<span>测试内容</span></span></span></span></span><br /></span></span></span></span></span></span></span></span></p><p><span><span><span><span><span><span><span><span><span><span><span><span><span><span>测试内容<span>测试内容<span>测试内容<span>测试内容<span>测试内容<span>测试内容</span></span></span></span></span></span><br /></span></span></span></span></span></span></span></span></span></span></span></span></span></p>', '', 1402979790);

-- --------------------------------------------------------

--
-- 表的结构 `dodo_picture`
--

DROP TABLE IF EXISTS `dodo_picture`;
CREATE TABLE IF NOT EXISTS `dodo_picture` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `dodo_picture`
--

INSERT INTO `dodo_picture` (`id`, `channel_id`, `authorid`, `post_time`, `content`, `title`, `comments`, `hits`, `keywords`, `thumb`, `description`, `pagetitles`, `pics`, `sign`, `link`, `tuijian`, `cat_0`, `cat_1`, `cat_2`) VALUES
(1, 3, 1, 1402985779, '', '小苍', 0, 1, '', 'upload/20140617/picture_OEsAAj.jpg', '', '', 'a:2:{i:0;s:34:"upload/20140617/picture_IFycIj.jpg";i:1;s:34:"upload/20140617/picture_aRpIEr.jpg";}', '', 'show/1/', 0, 0, 0, 0),
(2, 3, 1, 1402985815, '', '小苍2', 0, 1, '', 'upload/20140617/picture_afjmBa.jpg', '', '', 'a:2:{i:0;s:34:"upload/20140617/picture_KsxnCX.jpg";i:1;s:34:"upload/20140617/picture_zWiQrV.jpg";}', '', 'show/2/', 0, 0, 0, 0),
(3, 3, 1, 1402985846, '', '小苍3', 0, 1, '', 'upload/20140617/picture_NdLGde.jpg', '', '', 'a:2:{i:0;s:34:"upload/20140617/picture_UCyHKP.jpg";i:1;s:34:"upload/20140617/picture_gxldnP.jpg";}', '', 'show/3/', 0, 0, 0, 0),
(4, 3, 1, 1402985881, '', '小苍4', 0, 1, '', 'upload/20140617/picture_BElsbR.jpg', '', '', 'a:1:{i:0;s:34:"upload/20140617/picture_kVUpAg.jpg";}', '', 'show/4/', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `dodo_product`
--

DROP TABLE IF EXISTS `dodo_product`;
CREATE TABLE IF NOT EXISTS `dodo_product` (
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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=5 ;

--
-- 转存表中的数据 `dodo_product`
--

INSERT INTO `dodo_product` (`id`, `channel_id`, `authorid`, `post_time`, `content`, `title`, `comments`, `hits`, `keywords`, `thumb`, `description`, `pagetitles`, `pics`, `sign`, `link`, `tuijian`, `cat_0`, `cat_1`, `cat_2`) VALUES
(1, 4, 1, 1402986002, '<p>产品介绍产品介绍产品介绍产品介绍产品介绍产品介绍产品介绍产品介绍</p><p>产品介绍产品介绍产品介绍产品介绍产品介绍产品介绍产品介绍产品介绍产品介绍<br /></p>', '产品1', 0, 2, '', '', '', '', 'a:1:{i:0;s:34:"upload/20140617/product_nToBol.jpg";}', '', 'show/1/', 0, 0, 0, 0),
(2, 4, 1, 1402986102, '<p><span>产品介绍<span>产品介绍<span>产品介绍<span>产品介绍</span></span></span></span><br /></p><p><span><span><span><span><span>产品介绍<span>产品介绍<span>产品介绍<span>产品介绍<span>产品介绍<span>产品介绍</span></span></span></span></span></span><br /></span></span></span></span></p>', '产品2', 0, 1, '', '', '', '', 'a:1:{i:0;s:34:"upload/20140617/product_PNVyOZ.jpg";}', '', 'show/2/', 0, 0, 0, 0),
(3, 4, 1, 1402986117, '<p>产品介绍产品介绍产品介绍产品介绍<br /></p><p>产品介绍产品介绍产品介绍产品介绍产品介绍产品介绍</p>', '产品3', 0, 0, '', '', '', '', 'a:1:{i:0;s:34:"upload/20140617/product_TiOMDg.jpg";}', '', 'show/3/', 0, 0, 0, 0),
(4, 4, 1, 1402986132, '<p>产品介绍产品介绍产品介绍产品介绍<br /></p><p>产品介绍产品介绍产品介绍产品介绍产品介绍产品介绍</p><p><br /></p>', '产品4', 0, 1, '', '', '', '', 'a:1:{i:0;s:34:"upload/20140617/product_OGluWq.jpg";}', '', 'show/4/', 0, 0, 0, 0);

-- --------------------------------------------------------

--
-- 表的结构 `dodo_tab`
--

DROP TABLE IF EXISTS `dodo_tab`;
CREATE TABLE IF NOT EXISTS `dodo_tab` (
  `id` smallint(6) NOT NULL AUTO_INCREMENT,
  `fortab` varchar(20) NOT NULL,
  `type` varchar(20) NOT NULL,
  `conf` text NOT NULL,
  `title` varchar(255) NOT NULL,
  `info` varchar(255) NOT NULL,
  `warning` varchar(255) NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

--
-- 转存表中的数据 `dodo_tab`
--


-- --------------------------------------------------------

--
-- 表的结构 `dodo_tag`
--

DROP TABLE IF EXISTS `dodo_tag`;
CREATE TABLE IF NOT EXISTS `dodo_tag` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `tag` varchar(20) NOT NULL,
  `channel_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `pid` mediumint(8) NOT NULL DEFAULT '0',
  `link` varchar(100) NOT NULL,
  `title` varchar(100) NOT NULL,
  `post_time` int(10) unsigned NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`),
  KEY `tag` (`tag`),
  KEY `post_time` (`post_time`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=3 ;

--
-- 转存表中的数据 `dodo_tag`
--

INSERT INTO `dodo_tag` (`id`, `tag`, `channel_id`, `pid`, `link`, `title`, `post_time`) VALUES
(1, 'ayacms', 2, 1, '', 'AyaCMS2.0,于2014年6月17日发布', 1402984229),
(2, '发布', 2, 1, '', 'AyaCMS2.0,于2014年6月17日发布', 1402984229);

-- --------------------------------------------------------

--
-- 表的结构 `dodo_user`
--

DROP TABLE IF EXISTS `dodo_user`;
CREATE TABLE IF NOT EXISTS `dodo_user` (
  `id` mediumint(8) NOT NULL AUTO_INCREMENT,
  `name` varchar(20) NOT NULL,
  `pass` varchar(64) NOT NULL,
  `reg_time` int(10) NOT NULL DEFAULT '0',
  `sex` tinyint(1) unsigned NOT NULL DEFAULT '0',
  `team` tinyint(2) NOT NULL DEFAULT '1',
  `email` varchar(255) NOT NULL,
  `posts` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `last_post` int(10) NOT NULL DEFAULT '0',
  `a` int(10) NOT NULL DEFAULT '0',
  `b` int(10) NOT NULL DEFAULT '0',
  `c` int(10) NOT NULL DEFAULT '0',
  `face` varchar(50) NOT NULL DEFAULT '',
  `msg` smallint(6) unsigned NOT NULL DEFAULT '0',
  `tabs` text NOT NULL,
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=2 ;

--
-- 转存表中的数据 `dodo_user`
--

INSERT INTO `dodo_user` (`id`, `name`, `pass`, `reg_time`, `sex`, `team`, `email`, `posts`, `last_post`, `a`, `b`, `c`, `face`, `msg`, `tabs`) VALUES
(1, 'admin', 'c3284d0f94606de1fd2af172aba15bf3', 1402973696, 0, 4, '', 0, 0, 0, 0, 0, '', 0, '');

-- --------------------------------------------------------

--
-- 表的结构 `dodo_val`
--

DROP TABLE IF EXISTS `dodo_val`;
CREATE TABLE IF NOT EXISTS `dodo_val` (
  `id` mediumint(6) NOT NULL AUTO_INCREMENT,
  `name` varchar(40) NOT NULL,
  `value` longtext NOT NULL,
  `serialize` tinyint(1) NOT NULL DEFAULT '0',
  PRIMARY KEY (`id`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=9 ;

--
-- 转存表中的数据 `dodo_val`
--

INSERT INTO `dodo_val` (`id`, `name`, `value`, `serialize`) VALUES
(1, 'install_mods', 'a:12:{i:0;s:5:"admin";i:1;s:6:"search";i:2;s:6:"system";i:3;s:3:"tag";i:4;s:8:"template";i:5;s:4:"user";i:6;s:7:"weblink";i:7;s:7:"webnull";i:8;s:7:"webpage";i:9;s:7:"article";i:10;s:7:"picture";i:11;s:7:"product";}', 1),
(2, 'fields', 'a:10:{s:7:"article";a:18:{i:0;s:2:"id";i:1;s:10:"channel_id";i:2;s:8:"authorid";i:3;s:9:"post_time";i:4;s:7:"content";i:5;s:5:"title";i:6;s:8:"comments";i:7;s:4:"hits";i:8;s:8:"keywords";i:9;s:5:"thumb";i:10;s:11:"description";i:11;s:10:"pagetitles";i:12;s:4:"sign";i:13;s:4:"link";i:14;s:7:"tuijian";i:15;s:5:"cat_0";i:16;s:5:"cat_1";i:17;s:5:"cat_2";}s:7:"channel";a:35:{i:0;s:2:"id";i:1;s:6:"formod";i:2;s:4:"name";i:3;s:4:"hide";i:4;s:4:"home";i:5;s:4:"sign";i:6;s:3:"pvs";i:7;s:4:"cats";i:8;s:4:"tabs";i:9;s:7:"configs";i:10;s:7:"comment";i:11;s:1:"o";i:12;s:3:"pid";i:13;s:4:"link";i:14;s:8:"keywords";i:15;s:11:"description";i:16;s:8:"action_1";i:17;s:11:"action_1_to";i:18;s:8:"action_2";i:19;s:11:"action_2_to";i:20;s:8:"action_3";i:21;s:11:"action_3_to";i:22;s:12:"action_tpl_1";i:23;s:15:"action_tpl_1_to";i:24;s:12:"action_tpl_2";i:25;s:15:"action_tpl_2_to";i:26;s:12:"action_tpl_3";i:27;s:15:"action_tpl_3_to";i:28;s:11:"theme_tpl_1";i:29;s:14:"theme_tpl_1_to";i:30;s:11:"theme_tpl_2";i:31;s:14:"theme_tpl_2_to";i:32;s:11:"theme_tpl_3";i:33;s:14:"theme_tpl_3_to";i:34;s:9:"theme_tpl";}s:4:"page";a:4:{i:0;s:2:"id";i:1;s:7:"content";i:2;s:2:"pv";i:3;s:9:"post_time";}s:7:"picture";a:19:{i:0;s:2:"id";i:1;s:10:"channel_id";i:2;s:8:"authorid";i:3;s:9:"post_time";i:4;s:7:"content";i:5;s:5:"title";i:6;s:8:"comments";i:7;s:4:"hits";i:8;s:8:"keywords";i:9;s:5:"thumb";i:10;s:11:"description";i:11;s:10:"pagetitles";i:12;s:4:"pics";i:13;s:4:"sign";i:14;s:4:"link";i:15;s:7:"tuijian";i:16;s:5:"cat_0";i:17;s:5:"cat_1";i:18;s:5:"cat_2";}s:7:"product";a:19:{i:0;s:2:"id";i:1;s:10:"channel_id";i:2;s:8:"authorid";i:3;s:9:"post_time";i:4;s:7:"content";i:5;s:5:"title";i:6;s:8:"comments";i:7;s:4:"hits";i:8;s:8:"keywords";i:9;s:5:"thumb";i:10;s:11:"description";i:11;s:10:"pagetitles";i:12;s:4:"pics";i:13;s:4:"sign";i:14;s:4:"link";i:15;s:7:"tuijian";i:16;s:5:"cat_0";i:17;s:5:"cat_1";i:18;s:5:"cat_2";}s:3:"tab";a:7:{i:0;s:2:"id";i:1;s:6:"fortab";i:2;s:4:"type";i:3;s:4:"conf";i:4;s:5:"title";i:5;s:4:"info";i:6;s:7:"warning";}s:3:"tag";a:7:{i:0;s:2:"id";i:1;s:3:"tag";i:2;s:10:"channel_id";i:3;s:3:"pid";i:4;s:4:"link";i:5;s:5:"title";i:6;s:9:"post_time";}s:4:"user";a:15:{i:0;s:2:"id";i:1;s:4:"name";i:2;s:4:"pass";i:3;s:8:"reg_time";i:4;s:3:"sex";i:5;s:4:"team";i:6;s:5:"email";i:7;s:5:"posts";i:8;s:9:"last_post";i:9;s:1:"a";i:10;s:1:"b";i:11;s:1:"c";i:12;s:4:"face";i:13;s:3:"msg";i:14;s:4:"tabs";}s:3:"val";a:4:{i:0;s:2:"id";i:1;s:4:"name";i:2;s:5:"value";i:3;s:9:"serialize";}s:3:"yun";a:6:{i:0;s:2:"id";i:1;s:10:"channel_id";i:2;s:3:"pid";i:3;s:9:"post_time";i:4;s:5:"title";i:5;s:4:"link";}}', 1),
(3, 'sys_cjcode', 'lifEMq', 0),
(4, 'sys_theme', 'default', 0),
(5, 'sys_debug', '0', 0),
(6, 'sys_rewrite', '0', 0),
(7, 'sys_compress', '0', 0),
(8, 'sys_count', '0', 0);

-- --------------------------------------------------------

--
-- 表的结构 `dodo_yun`
--

DROP TABLE IF EXISTS `dodo_yun`;
CREATE TABLE IF NOT EXISTS `dodo_yun` (
  `id` int(11) NOT NULL AUTO_INCREMENT,
  `channel_id` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `pid` mediumint(8) unsigned NOT NULL DEFAULT '0',
  `post_time` int(10) NOT NULL DEFAULT '0',
  `title` varchar(100) NOT NULL,
  `link` varchar(100) NOT NULL,
  PRIMARY KEY (`id`),
  KEY `post_time` (`post_time`),
  KEY `pid` (`pid`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=30 ;

--
-- 转存表中的数据 `dodo_yun`
--

INSERT INTO `dodo_yun` (`id`, `channel_id`, `pid`, `post_time`, `title`, `link`) VALUES
(1, 2, 1, 1402984229, 'AyaCMS2.0,于2014年6月17日发布', 'show/1/'),
(2, 2, 2, 1402984268, 'AyaCMS2.0,于2014年6月17日发布', 'show/2/'),
(3, 2, 3, 1402984396, 'AyaCMS2.0,于2014年6月17日发布', 'show/3/'),
(4, 2, 4, 1402984399, 'AyaCMS2.0,于2014年6月17日发布', 'show/4/'),
(5, 2, 5, 1402984401, 'AyaCMS2.0,于2014年6月17日发布', 'show/5/'),
(6, 2, 6, 1402984402, 'AyaCMS2.0,于2014年6月17日发布', 'show/6/'),
(7, 2, 7, 1402984404, 'AyaCMS2.0,于2014年6月17日发布', 'show/7/'),
(8, 2, 8, 1402984405, 'AyaCMS2.0,于2014年6月17日发布', 'show/8/'),
(9, 2, 9, 1402984407, 'AyaCMS2.0,于2014年6月17日发布', 'show/9/'),
(10, 2, 10, 1402984409, 'AyaCMS2.0,于2014年6月17日发布', 'show/10/'),
(11, 2, 11, 1402984410, 'AyaCMS2.0,于2014年6月17日发布', 'show/11/'),
(12, 2, 12, 1402984411, 'AyaCMS2.0,于2014年6月17日发布', 'show/12/'),
(13, 2, 13, 1402984435, 'AyaCMS2.0,于2014年6月17日发布', 'show/13/'),
(14, 2, 14, 1402984439, 'AyaCMS2.0,于2014年6月17日发布', 'show/14/'),
(15, 2, 15, 1402984440, 'AyaCMS2.0,于2014年6月17日发布', 'show/15/'),
(16, 2, 16, 1402984442, 'AyaCMS2.0,于2014年6月17日发布', 'show/16/'),
(17, 2, 17, 1402984443, 'AyaCMS2.0,于2014年6月17日发布', 'show/17/'),
(18, 2, 18, 1402984444, 'AyaCMS2.0,于2014年6月17日发布', 'show/18/'),
(19, 2, 19, 1402984445, 'AyaCMS2.0,于2014年6月17日发布', 'show/19/'),
(20, 2, 20, 1402984459, 'AyaCMS2.0,于2014年6月17日发布', 'show/20/'),
(21, 2, 21, 1402984463, 'AyaCMS2.0,于2014年6月17日发布', 'show/21/'),
(22, 3, 1, 1402985779, '小苍', 'show/1/'),
(23, 3, 2, 1402985815, '小苍2', 'show/2/'),
(24, 3, 3, 1402985846, '小苍3', 'show/3/'),
(25, 3, 4, 1402985881, '小苍4', 'show/4/'),
(26, 4, 1, 1402986002, '产品1', 'show/1/'),
(27, 4, 2, 1402986102, '产品2', 'show/2/'),
(28, 4, 3, 1402986117, '产品3', 'show/3/'),
(29, 4, 4, 1402986132, '产品4', 'show/4/');

