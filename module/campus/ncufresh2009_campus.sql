-- phpMyAdmin SQL Dump
-- version 2.10.3
-- http://www.phpmyadmin.net
-- 
-- 主機: localhost
-- 建立日期: Jul 31, 2009, 12:29 AM
-- 伺服器版本: 5.0.51
-- PHP 版本: 5.2.6

SET SQL_MODE="NO_AUTO_VALUE_ON_ZERO";

-- 
-- 資料庫: `work2009`
-- 

-- --------------------------------------------------------

-- 
-- 資料表格式： `workv1_campus_menu`
-- 

CREATE TABLE IF NOT EXISTS `workv1_campus_menu` (
  `CMno` int(32) NOT NULL auto_increment,
  `CMtitle` varchar(255) collate utf8_unicode_ci NOT NULL,
  `CMurl` varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`CMno`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=7 ;

-- 
-- 列出以下資料庫的數據： `workv1_campus_menu`
-- 

INSERT INTO `workv1_campus_menu` (`CMno`, `CMtitle`, `CMurl`) VALUES (1, '行政區', '');
INSERT INTO `workv1_campus_menu` (`CMno`, `CMtitle`, `CMurl`) VALUES (2, '中大景點', '');
INSERT INTO `workv1_campus_menu` (`CMno`, `CMtitle`, `CMurl`) VALUES (3, '系館位置', '');
INSERT INTO `workv1_campus_menu` (`CMno`, `CMtitle`, `CMurl`) VALUES (4, '自學資源', '');
INSERT INTO `workv1_campus_menu` (`CMno`, `CMtitle`, `CMurl`) VALUES (5, '運動場所', '');
INSERT INTO `workv1_campus_menu` (`CMno`, `CMtitle`, `CMurl`) VALUES (6, '全校地圖', '');

-- --------------------------------------------------------

-- 
-- 資料表格式： `workv1_campus_submenu`
-- 

CREATE TABLE IF NOT EXISTS `workv1_campus_submenu` (
  `CSMno` int(32) NOT NULL auto_increment,
  `CMno` int(32) NOT NULL,
  `CSMtitle` varchar(255) collate utf8_unicode_ci NOT NULL,
  `CSMurl` varchar(255) collate utf8_unicode_ci NOT NULL,
  `Content` text collate utf8_unicode_ci NOT NULL,
  `PicUrl` varchar(255) collate utf8_unicode_ci NOT NULL,
  PRIMARY KEY  (`CSMno`)
) ENGINE=MyISAM  DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=59 ;

-- 
-- 列出以下資料庫的數據： `workv1_campus_submenu`
-- 

INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (1, 1, '生活輔導組', '', '生活浮島組', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (2, 1, '課外活動組', '', '課外組', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (3, 1, '註冊組', '', '註冊組', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (4, 1, '文書組', '', '文書組', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (5, 1, '教學發展中心', '', '教學中心', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (6, 1, '課務組', '', '課務組', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (7, 1, '軍訓室', '', '軍訓室', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (8, 2, '中大路上', '', '中大路上', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (9, 2, '筆墨紙硯', '', '筆墨紙硯', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (10, 2, '情人步道', '', '情人步道', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (11, 2, '綠草如茵', '', '綠草如茵', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (12, 2, '太極銅雕', '', '太極銅雕', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (13, 2, '烏龜池', '', '烏龜池', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (14, 2, '百花川', '', '百花川', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (15, 2, '總圖加國鼎', '', '哈囉哈囉哈囉123123qrwerqwezxcfdy43', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (16, 2, '女十四舍前廣場', '', '女十四舍前廣場qwe', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (17, 2, '屏風', '', '屏風', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (18, 2, '水滴', '', '水滴', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (19, 2, '石凳', '', '石凳', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (20, 2, 'DNA雕像', '', 'DNA雕像', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (21, 3, '中文系', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (22, 3, '英文系', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (23, 3, '法文系', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (24, 3, '企管系', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (25, 3, '資管系', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (26, 3, '經濟系', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (27, 3, '財金系', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (28, 3, '資工系', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (29, 3, '機械系', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (30, 3, '電機系', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (31, 3, '通訊系', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (32, 3, '土木系', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (33, 3, '化材系', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (34, 3, '化學系', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (35, 3, '大氣系', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (36, 3, '數學系', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (37, 3, '生科系', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (38, 3, '物理系', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (39, 3, '理學院學士班', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (40, 3, '地科系', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (41, 4, '總圖', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (42, 4, '國鼎', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (43, 4, '自學中心', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (44, 4, '藝文中心', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (45, 4, '舊圖二樓', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (46, 4, '閱讀坊', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (47, 4, '107電影院', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (48, 5, '依仁堂', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (49, 5, '機械館旁-排球場', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (50, 5, '機械館旁-籃球場', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (51, 5, '羽球館', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (52, 5, '排球場', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (53, 5, '網球場', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (54, 5, '桌球場', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (55, 5, '溜冰場', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (56, 5, '游泳池', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (57, 5, '攀岩', '', '', '');
INSERT INTO `workv1_campus_submenu` (`CSMno`, `CMno`, `CSMtitle`, `CSMurl`, `Content`, `PicUrl`) VALUES (58, 5, '操場', '', '', '');
