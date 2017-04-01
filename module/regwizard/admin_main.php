<?php
require_once ("../../mainfile.php");

if($currmodule -> isadmin($curruser))
{
	$opt_list = $currdb -> query("SELECT * FROM `".($currdb -> prefix("regwizard_opt"))."` ORDER BY rwo_date_begin ASC");
	
	if($currdb -> num_rows($opt_list) != 0)
	{
		$opt_list_dis = array();
		
		while($opt_list_dis_processing = $currdb -> fetch_array($opt_list))
		{
			$opt_list_dis_processing['rwo_date_display'] = avail_date_display($opt_list_dis_processing['rwo_datetype'], $opt_list_dis_processing['rwo_date_begin'], $opt_list_dis_processing['rwo_date_end']);
			
			switch($opt_list_dis_processing['rwo_type'])
			{
				case 0:
					$opt_list_dis_processing['rwo_type_display'] = "必要";
					break;
				case 1:
					$opt_list_dis_processing['rwo_type_display'] = "非必要";
					break;
				case 2:
					$opt_list_dis_processing['rwo_type_display'] = "自定義條件";
					break;
				default:
					echo "ERROR!<br />";
			}
			
			array_push($opt_list_dis, $opt_list_dis_processing);
		}
		
		$currtpl -> assign('opt_list_dis', $opt_list_dis);
		$currtpl -> display("admin_main.html");
	}
}
else
{
	echo "欲使用此功能請先登入。";
}
?>