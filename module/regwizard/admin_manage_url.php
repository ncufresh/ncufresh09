<?php
require_once ("../../mainfile.php");

if($currmodule -> isadmin($curruser))
{
	if($_GET['action']=="editurl")
	{
		if(!empty($_GET['rwoID']))
		{
			$opt_list_url = $currdb -> query("SELECT * FROM `".($currdb -> prefix("regwizard_rel_links"))."` WHERE rwoID = ".mysql_real_escape_string($_GET['rwoID'])."");
			
			if($currdb -> num_rows($opt_list_url) != 0)
			{
				$opt_list_url_dis = array();
				
				while($opt_list_url_processing = $currdb -> fetch_array($opt_list_url))
				{
					array_push($opt_list_url_dis, $opt_list_url_processing);
				}
				
				$currtpl -> assign('link_exist', TRUE);
				$currtpl -> assign('opt_list_url_dis', $opt_list_url_dis);
			}
			else
			{
				$currtpl -> assign('link_exist',FALSE);
			}
			
			$currtpl -> assign('rwoID', $_GET['rwoID']);
			$currtpl -> display("admin_manage_url.editurl.html");
		}
		else
		{
			echo "參數傳遞錯誤，請勿由此路徑執行本程式。";
		}
	}
	else
	if($_GET['action']=="edit_single_url")
	{
		if(!empty($_GET['rel_l_ID']))
		{
			$opt_url = $currdb -> query("SELECT * FROM `".($currdb -> prefix("regwizard_rel_links"))."` WHERE rel_l_ID=".mysql_real_escape_string($_GET['rel_l_ID'])."");
			
			if($currdb -> num_rows($opt_url) != 0)
			{
				$opt_url_dis = $currdb -> fetch_array($opt_url);
				
				$currtpl -> assign('opt_url_dis', $opt_url_dis);
				$currtpl -> display("admin_manage_url.edit_single_url.html");
			}
			else
			{
				echo "參數傳遞錯誤，或該選項不存在，請勿由此路徑執行本程式。";
			}
		}
		else
		{
			echo "參數傳遞錯誤，請勿由此路徑執行本程式。";
		}
	}
	else
	{
		echo "參數傳遞錯誤，請勿由此路徑執行本程式。";
	}
}
else
{
	echo "欲使用此功能請先登入。";
}
?>
