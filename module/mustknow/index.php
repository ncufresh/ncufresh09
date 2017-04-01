<?php
require_once('../../mainfile.php');

// Step1. Get the category ID
$cat_id_request;
if(!empty($_GET['csn']))
{
	$menu_src;
	$menu_arr = array();
	
	$topic_src;
	$topic_arr = array();
	
	$cat_id_request_src = $currdb -> query("SELECT * FROM `".($currdb -> prefix("must_category"))."` WHERE `csn` = '".$_GET['csn']."'");
	if($currdb -> num_rows($cat_id_request_src) != 0)
	{
		/*------*/
		$cat_id_request_arr = $currdb -> fetch_array($cat_id_request_src);
		$cat_id_request = $cat_id_request_arr['csn'];
		
		if($cat_id_request_arr['hsn'] == 0)
		{
			// A. Step 1.1 Selected all category which `hsn` is equal to $cat_id_request
			$menu_src = $currdb -> query("SELECT * FROM `".($currdb -> prefix("must_category"))."` WHERE `hsn` = '".$cat_id_request."' ORDER BY `ord` ASC");
			
			while($menu_arr_processing = $currdb -> fetch_array($menu_src))
			{
				array_push($menu_arr, $menu_arr_processing);
			}
			$curr_cat = $cat_id_request;
			
			// A. Step 1.2 Enter to requested category, and select the first topic of the category
			$topic_src = $currdb -> query("SELECT * FROM `".($currdb -> prefix("must_main"))."` WHERE `csn` = '".$menu_arr[0]['csn']."'");
			if($currdb -> num_rows($topic_src) != 0)
			{
				$topic_arr = $currdb -> fetch_array($topic_src);
				
				$temp_arr = array();
				$temp_arr = $currdb -> fetch_array($currdb -> query("SELECT `title` FROM `".($currdb -> prefix("must_category"))."` WHERE `hsn` = '".$curr_cat."'  ORDER BY `ord` ASC LIMIT 0,1"));
				$cat_id_request_arr['title'] = $temp_arr['title'];
			}
			else
			{
				$topic_arr = array();
				$topic_arr['main'] = "此分類尚無文章，請稍後網站管理員新增";
			}
		}
		else
		{
			// B. Step 1.1 Selected all category which `hsn` is equal to $cat_id_request_arr['hsn']
			$menu_src = $currdb -> query("SELECT * FROM `".($currdb -> prefix("must_category"))."` WHERE `hsn` = '".$cat_id_request_arr['hsn']."' ORDER BY `ord` ASC");
			
			while($menu_arr_processing = $currdb -> fetch_array($menu_src))
			{
				array_push($menu_arr, $menu_arr_processing);
			}
			$curr_cat = $cat_id_request_arr['hsn'];
			
			// B. Step 1.2 Enter to requested category, and select the assigning topic
			$topic_src = $currdb -> query("SELECT * FROM `".($currdb -> prefix("must_main"))."` WHERE `csn` = '".$cat_id_request."'");
			if($currdb -> num_rows($topic_src) != 0)
			{
				$topic_arr = $currdb -> fetch_array($topic_src);
			}
			else
			{
				$topic_arr = array();
				$topic_arr['main'] = "指定的文章不存在，請確認路徑是否正確";
			}
			
		}
		/*------*/
	}
	else
	{
		$topic_arr = array();
		$topic_arr['main'] = "指定的文章或分類不存在，請確認路徑是否正確";
	}
	
	$currtpl -> assign('curr_cat', $curr_cat);
	$currtpl -> assign('cat_id_request_arr', $cat_id_request_arr);
	$currtpl -> assign('menu_arr', $menu_arr);
	$currtpl -> assign('topic_arr', $topic_arr);
	
	$currtpl -> display('topic.tpl.htm');
}
// Step2. Enter to the main menu
else
{
	// Designed for NCU Freshweb 2009 ONLY - Please MODIFIED it for the new templates of NCU Freshweb 2010
	//												^^^^^^^^
	$menu_common_src	= $currdb -> query("SELECT * FROM `".($currdb -> prefix("must_category"))."` WHERE `hsn` = '3' ORDER BY `ord` ASC");
	$menu_common_arr	= array();
	while($menu_common_arr_processing = $currdb -> fetch_array($menu_common_src))
	{
		array_push($menu_common_arr, $menu_common_arr_processing);
	}
	
	$menu_fresh_src		= $currdb -> query("SELECT * FROM `".($currdb -> prefix("must_category"))."` WHERE `hsn` = '1' ORDER BY `ord` ASC");
	$menu_fresh_arr		= array();
	while($menu_fresh_arr_processing = $currdb -> fetch_array($menu_fresh_src))
	{
		array_push($menu_fresh_arr, $menu_fresh_arr_processing);
	}
	
	$menu_resume_src	= $currdb -> query("SELECT * FROM `".($currdb -> prefix("must_category"))."` WHERE `hsn` = '2' ORDER BY `ord` ASC");
	$menu_resume_arr	= array();
	while($menu_resume_arr_processing = $currdb -> fetch_array($menu_resume_src))
	{
		array_push($menu_resume_arr, $menu_resume_arr_processing);
	}
	
	$currtpl -> assign('menu_common_arr', $menu_common_arr);	// 3
	$currtpl -> assign('menu_fresh_arr', $menu_fresh_arr);		// 1
	$currtpl -> assign('menu_resume_arr', $menu_resume_arr);	// 2
	
	
	$currtpl -> display('index.tpl.htm');
}
?>
