
SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";


--
-- 数据库: `new_ayaya`
--

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;


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
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 AUTO_INCREMENT=1 ;

