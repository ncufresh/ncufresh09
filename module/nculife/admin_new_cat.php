<?php
require_once('../../mainfile.php');

if(!$currmodule -> isadmin($curruser))
	exit();

if($_GET['action']=="save")
{
	if($_GET['curr_action']=="edit")
	{
		$currdb -> query("UPDATE `".($currdb -> prefix("nculife_cat"))."` SET
			`cat_name` = 			'".$_POST['cat_name']."',
			`cat_description` =		'".$_POST['cat_description']."',
			`cat_title_image` = 	'".$_POST['cat_title_image']."',
			`cat_end_image` = 		'".$_POST['cat_end_image']."',
			`cat_menuside_image` = 	'".$_POST['cat_menuside_image']."',
			`cat_favicon_image` = 	'".$_POST['cat_favicon_image']."',
			`cat_a_icon` = 			'".$_POST['cat_a_icon']."',
			`cat_a_hover_icon` = 	'".$_POST['cat_a_hover_icon']."'
			WHERE `cat_ID` = '".$_POST['curr_cat_ID']."'");
		_redirect("admin_index.php?msg=分類修改完成");
	}
	else
	if($_GET['curr_action']=="new")
	{
		$currdb -> query("INSERT INTO `".($currdb -> prefix("nculife_cat"))."` (`cat_name`, `cat_sort`, `cat_description`, `cat_title_image`, `cat_end_image`, `cat_menuside_image`, `cat_favicon_image`, `cat_a_icon`, `cat_a_hover_icon`) VALUES ('".$_POST['cat_name']."', '".(0)."', '".$_POST['cat_description']."', '".$_POST['cat_title_image']."', '".$_POST['cat_end_image']."', '".$_POST['cat_menuside_image']."', '".$_POST['cat_favicon_image']."', '".$_POST['cat_a_icon']."', '".$_POST['cat_a_hover_icon']."')");
		_redirect("admin_index.php?msg=分類新增完成");
	}
}
else
if($_GET['action']=="delete" && $_GET['cat_ID']!=NULL)
{
	$currdb -> query("DELETE FROM `".($currdb -> prefix("nculife_cat"))."` WHERE `cat_ID`='".$_GET['cat_ID']."'");
	_redirect("admin_index.php?msg=分類已刪除完成");
}
else
if($_GET['action']=="edit" && $_GET['cat_ID']!=NULL)
{
	$curr_action = "edit";
	$curr_cat_ID = $_GET['cat_ID'];
	
	$curr_cat_src = $currdb -> query("SELECT * FROM `".($currdb -> prefix("nculife_cat"))."` WHERE `cat_ID`='".$curr_cat_ID."'");
	$curr_cat_arr = $currdb -> fetch_array($curr_cat_src);
	
	
	$currtpl -> assign('curr_action', $curr_action);
	$currtpl -> assign('curr_cat_ID', $curr_cat_ID);
	$currtpl -> assign('curr_cat_arr', $curr_cat_arr);
	
	$currtpl -> display('admin_new_cat.tpl.htm');
}
else
{
	$curr_action = "new";
	
	$curr_cat_arr = array();
	
	$currtpl -> assign('curr_action', $curr_action);
	$currtpl -> assign('curr_cat_ID', NULL);
	$currtpl -> assign('curr_cat_arr', $curr_cat_arr);
	
	$currtpl -> display('admin_new_cat.tpl.htm');
}
?>