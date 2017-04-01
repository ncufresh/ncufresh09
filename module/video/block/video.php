<?php
//require_once("../../mainfile.php");


if(!defined("MAINFILE_INCLUDED"))
	exit();

function video($dirname = null)
{
	$block = array();
	
	global $currdb;
	global $curruser;
	
	
	//抓取影片列表資料
	$search = $currdb -> query("SELECT * FROM `workv1_video` ORDER BY `no` DESC LIMIT 3");
	$data_array = array();

	while ($data_get = $currdb -> fetch_array($search))
	{
		$data_get['content'] = nl2br($data_get['content']);
		array_push($data_array, $data_get);
	}
	
	
	//管理端
	if ($curruser -> isadmin())
	{
		$perm = true;
	}
	
	
	//傳入樣版
	$block['perm'] = $perm;
	$block['data'] = $data_array;
	$block['module_path'] = $currmodule -> name;


	return $block;
}
?>