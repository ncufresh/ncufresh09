<?php
require_once('mainfile.php');
$currtpl -> setndisplay();

if($_GET['action'] == "detail")
{
	if($_GET['f_name'] != NULL)
	{
		$item_detail_src = $currdb -> query("SELECT * FROM `".($currdb -> prefix("shop"))."` WHERE `pic` = '".mysql_real_escape_string($_GET['f_name']).".jpg"."'");
		$item_detail_arr = $currdb -> fetch_array($item_detail_src);
		
		echo "    名稱：<br />　　".$item_detail_arr['item']."<br /><br />";
    	echo "    敘述：<br />　　".$item_detail_arr['deric']."<br />";
	}
	else
	{
		exit();
	}
}
else
{
	if($_GET['f_name'] != NULL)
	{
		if(file_exists(ROOT_PATH."/module/shop/items_pic/".$_GET['f_name'].".jpg"))
		{
			echo "<img src=\"".($currconfig->url)."/module/shop/items_pic/".$_GET['f_name'].".jpg\" />";
		}
		else
		{
			echo "<img src=\"".($currconfig->url)."/module/shop/items_pic/file_doesnt_exist.jpg\" />";
		}
	}
	else
	{
		exit();
	}
}
?>