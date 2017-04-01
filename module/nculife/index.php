<?php
require_once('../../mainfile.php');

if($_GET['t_ID']!=NULL)
{
	// Step 1. Topic
	$t_ID = $_GET['t_ID'];
	$topic_src = $currdb -> query("SELECT * FROM `".($currdb -> prefix("nculife_topic"))."` WHERE `t_ID` ='".$t_ID."'");
	$topic_arr = array();

	if($currdb -> num_rows($topic_src) != 0)
	{
		$topic_arr = $currdb -> fetch_array($topic_src);
	}
	else
	{
		$topic_arr['t_name'] = "文章不存在";
		$topic_arr['t_b_cat_ID'] = 1;
		$topic_arr['t_contents'] = "此篇文章不存在，請檢查路徑是否正確。<br /><br /><a href=\"index.php\">[回中大生活首頁]</a>";
	}
	
	// Step 2. Topic of current category
	$cat_ID = $topic_arr['t_b_cat_ID'];
	$list_menu_src = $currdb -> query("SELECT `t_ID`, `t_name` FROM `".($currdb -> prefix("nculife_topic"))."` WHERE `t_b_cat_ID`='".$cat_ID."' ORDER BY `t_sort` ASC");
	$list_menu_arr = array();
	while($list_menu_1D_arr = $currdb -> fetch_array($list_menu_src))
	{
		array_push($list_menu_arr, $list_menu_1D_arr);
	}
	// Step 3. Category
	$cat_src = $currdb -> query("SELECT * FROM `".($currdb -> prefix("nculife_cat"))."` WHERE `cat_ID` = '".$cat_ID."'");
	$cat_arr = $currdb -> fetch_array($cat_src);
	
	// -- nav bar ---
	$curr_addr = array();
	
	$curr_addr['name'] = $cat_arr['cat_name'];
	$curr_addr['url'] = $currconfig -> url."/module/nculife/index.php?cat_ID=".$cat_arr['cat_ID'];
	array_push($currsite, $curr_addr);
	
	$curr_addr['name'] = $topic_arr['t_name'];
	$curr_addr['url'] = $currconfig -> url."/module/nculife/index.php?t_ID=".$topic_arr['t_ID'];
	array_push($currsite, $curr_addr);
	// -- nav bar ---
	
	// Step 4. Output the result
	$currtpl -> assign('topic_arr', $topic_arr);
	$currtpl -> assign('list_menu_arr', $list_menu_arr);
	$currtpl -> assign('cat_arr', $cat_arr);
	$currtpl -> display('nculife_contents.tpl.htm');
}
else
if($_GET['cat_ID']!=NULL)
{
	// Step 1. Topic
	$cat_ID = $_GET['cat_ID'];
	$topic_src = $currdb -> query("SELECT * FROM `".($currdb -> prefix("nculife_topic"))."` WHERE `t_b_cat_ID`='".$cat_ID."' ORDER BY `t_sort` ASC LIMIT 0,1");
	$topic_arr = array();
	if($currdb -> num_rows($topic_src) != 0)
	{
		$topic_arr = $currdb -> fetch_array($topic_src);
	}
	else
	{
		$topic_arr['t_name'] = "此分類暫時為空";
		$topic_arr['t_contents'] = "此分類暫時沒有文章，請稍後網站管理員新增。<br /><br /><a href=\"index.php\">[回中大生活首頁]</a>";
	}
	
	// Step 2. Topic of current category
	$list_menu_src = $currdb -> query("SELECT `t_ID`, `t_name` FROM `".($currdb -> prefix("nculife_topic"))."` WHERE `t_b_cat_ID`='".$cat_ID."' ORDER BY `t_sort` ASC");
	$list_menu_arr = array();
	while($list_menu_1D_arr = $currdb -> fetch_array($list_menu_src))
	{
		array_push($list_menu_arr, $list_menu_1D_arr);
	}
	
	// Step 3. Category
	$cat_src = $currdb -> query("SELECT * FROM `".($currdb -> prefix("nculife_cat"))."` WHERE `cat_ID` = '".$cat_ID."'");
	$cat_arr = $currdb -> fetch_array($cat_src);
	
	// -- nav bar ---
	$curr_addr = array();
	
	$curr_addr['name'] = $cat_arr['cat_name'];
	$curr_addr['url'] = $currconfig -> url."/module/nculife/index.php?cat_ID=".$cat_arr['cat_ID'];
	array_push($currsite, $curr_addr);
	
	$curr_addr['name'] = $topic_arr['t_name'];
	$curr_addr['url'] = $currconfig -> url."/module/nculife/index.php?t_ID=".$topic_arr['t_ID'];
	array_push($currsite, $curr_addr);
	// -- nav bar ---
	
	// Step 4. Output the result
	$currtpl -> assign('topic_arr', $topic_arr);
	$currtpl -> assign('list_menu_arr', $list_menu_arr);
	$currtpl -> assign('cat_arr', $cat_arr);
	
	$currtpl -> display('nculife_contents.tpl.htm');
}
else
{
	if($currmodule -> isadmin($curruser))
	{
		$currtpl -> assign('adm_lnk', "<a href=\"admin_index.php\">[管理介面]</a>");
	}
	$currtpl -> display('index.tpl.htm');
}
?>

