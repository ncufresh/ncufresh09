<?php
require_once('../../mainfile.php');

if(!$currmodule -> isadmin($curruser))
	exit();

if($_GET['action']=="save")
{
	if($_GET['curr_action']=="edit")
	{
		$currdb -> query("UPDATE `".($currdb -> prefix("nculife_topic"))."` SET
			`t_name`		= '".$_POST['t_name']."',
			`t_b_cat_ID`	= '".$_POST['t_b_cat_ID']."',
			`t_contents`	= '".$_POST['t_contents']."'
			WHERE `t_ID` = '".$_POST['curr_t_ID']."'");
		_redirect("admin_index.php?msg=文章修改完成");
	}
	else
	if($_GET['curr_action']=="new")
	{
		$currdb -> query("INSERT INTO `".($currdb -> prefix("nculife_topic"))."` (`t_name`, `t_b_cat_ID`, `t_sort`, `t_contents`) VALUES ('".$_POST['t_name']."', '".$_POST['t_b_cat_ID']."', '".(0)."', '".$_POST['t_contents']."')");
		_redirect("admin_index.php?msg=文章新增完成");
	}
}
else
if($_GET['action']=="delete" && $_GET['t_ID']!=NULL)
{
	$currdb -> query("DELETE FROM `".($currdb -> prefix("nculife_topic"))."` WHERE `t_ID`='".$_GET['t_ID']."'");
	_redirect("admin_index.php?msg=文章已刪除完成");
}
else
if($_GET['action']=="edit" && $_GET['t_ID']!=NULL)
{
	$curr_action = "edit";
	$curr_t_ID = $_GET['t_ID'];
	
	$curr_topic_src = $currdb -> query("SELECT * FROM `".($currdb -> prefix("nculife_topic"))."` WHERE `t_ID`='".$curr_t_ID."'");
	$curr_topic_arr = $currdb -> fetch_array($curr_topic_src);
	
	
	$currtpl -> assign('curr_action', $curr_action);
	$currtpl -> assign('curr_t_ID', $curr_t_ID);
	$currtpl -> assign('curr_topic_arr', $curr_topic_arr);
	
	$currtpl -> display('admin_new_topic.tpl.htm');
}
else
{
	$curr_action = "new";
	
	$curr_topic_arr = array();
	$curr_topic_arr['t_b_cat_ID'] = $_GET['cat_ID'];
	
	$currtpl -> assign('curr_action', $curr_action);
	$currtpl -> assign('curr_t_ID', NULL);
	$currtpl -> assign('curr_topic_arr', $curr_topic_arr);
	
	$currtpl -> display('admin_new_topic.tpl.htm');
}
?>