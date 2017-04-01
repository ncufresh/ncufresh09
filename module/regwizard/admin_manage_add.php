<?php
require_once ("../../mainfile.php");

if($currmodule -> isadmin($curruser))
{
	if($_GET['action']=="modify")
	{
		if(!empty($_GET['rwoID']))
		{
			$opt = $currdb -> query("SELECT * FROM `".$currdb -> prefix("regwizard_opt")."` WHERE rwoID = ".mysql_real_escape_string($_GET['rwoID'])." ");
			
			if(($currdb -> num_rows($opt)) != 0)
			{
				$opt_dis = $currdb -> fetch_array($opt);
				
				if($opt_dis['rwo_type']=="2")
				{
					$arr_rwo_c_value = explode(";", $opt_dis['rwo_c_value']);
					
					$sel_rwo_c_value = array();
					
					for($i=0; $i<sizeof($arr_rwo_c_value); $i++)
					{
						if($arr_rwo_c_value[$i] == "男")
						{
							$sel_rwo_c_value['boy'] = "1";
						}
						else
						if($arr_rwo_c_value[$i] == "女")
						{
							$sel_rwo_c_value['girl'] = "1";
						}
						else
						{
							$sel_rwo_c_value[$arr_rwo_c_value[$i]] = "1";
						}
					}
					
					$currtpl -> assign('sel_rwo_c_value', $sel_rwo_c_value);
				}
				
				$currtpl -> assign('opt_dis', $opt_dis);
			}
		}
		else
		{
			echo "參數傳遞錯誤，請勿由此路徑執行本程式。";
			exit();
		}
	}
	
	if($_GET['action']=="modify")
	{
		$currtpl -> assign('form_action', "modify&rwoID=".$_GET['rwoID']."");
		$currtpl -> assign('action', "modify");
	}
	else
	{
		$currtpl -> assign('form_action', "add");
		$currtpl -> assign('action', "add");
	}

	$currtpl -> addjs(ROOT_PATH.'/module/'.$currmodule->name.'/include/admin_ajax.js');
	$currtpl -> display('admin_manage_add.html');
}
else
{
	echo "欲使用此功能請先登入。";
}
?>
