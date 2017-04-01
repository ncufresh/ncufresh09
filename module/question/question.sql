-- 伺服器: localhost   資料庫: work2009 
-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- 主機: localhost
-- 建立日期: Jul 22, 2009, 03:54 PM
-- 伺服器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 資料庫: `work2009`
-- 

-- --------------------------------------------------------

-- 
-- 資料表格式： `workv1_question_check`
-- 

CREATE TABLE `workv1_question_check` (
  `id` int(11) NOT NULL,
  `uno` int(11) NOT NULL,
  `check` tinyint(1) NOT NULL default '0',
  `answer` varchar(300) collate utf8_unicode_ci NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;


-- 
-- 資料表格式： `workv1_question_chooses`
-- 

CREATE TABLE `workv1_question_chooses` (
  `id` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `cid` int(11) NOT NULL,
  `sort` double NOT NULL,
  `content` text collate utf8_unicode_ci NOT NULL,
  `others` tinyint(1) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- 資料表格式： `workv1_question_question`
-- 

CREATE TABLE `workv1_question_question` (
  `id` int(11) NOT NULL,
  `gid` int(11) NOT NULL,
  `sort` double NOT NULL,
  `question` text collate utf8_unicode_ci NOT NULL,
  `type` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;

-- 
-- 資料表格式： `workv1_question_topic`
-- 

CREATE TABLE `workv1_question_topic` (
  `id` int(11) NOT NULL,
  `sort` double NOT NULL,
  `topic` text collate utf8_unicode_ci NOT NULL,
  `description` text collate utf8_unicode_ci NOT NULL,
  `public` int(11) NOT NULL,
  `number` int(11) NOT NULL
) ENGINE=MyISAM DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci;
