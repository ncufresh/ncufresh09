<?php
require_once('../../mainfile.php');

if(!$currmodule -> isadmin($curruser))
	exit();


$cat_src = $currdb -> query("SELECT * FROM `".($currdb -> prefix("nculife_cat"))."` ORDER BY `cat_sort` ASC, `cat_ID` ASC");
$cat_arr = array();
while($cat_arr_processing = $currdb -> fetch_array($cat_src))
{
	array_push($cat_arr, $cat_arr_processing);
}


$topic_src = $currdb -> query("SELECT * FROM `".($currdb -> prefix("nculife_topic"))."` ORDER BY `t_b_cat_ID` ASC, `t_sort` ASC, `t_ID` ASC");
$topic_arr = array();
while($topic_arr_processing = $currdb -> fetch_array($topic_src))
{
	array_push($topic_arr, $topic_arr_processing);
}


$currtpl -> assign('msg', (($_GET['msg']!=NULL) ? $_GET['msg'] : NULL));

$currtpl -> assign('cat_arr', $cat_arr);
$currtpl -> assign('topic_arr', $topic_arr);
$currtpl -> display('admin_index.tpl.htm');
?>