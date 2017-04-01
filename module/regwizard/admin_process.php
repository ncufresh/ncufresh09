<?php
require_once ("../../mainfile.php");

if($currmodule -> isadmin($curruser))
{
	if($_GET['action']=="add" || $_GET['action']=="modify")
	{
		// check the necessary column is not empty
		if(empty($_POST['rwo_name']) || !isset($_POST['rwo_datetype']) || $_POST['rwo_type']=="")
		{
			dies("<p>欄位未填寫完全：請確認選項名稱、選項敘述以及選項出現條件...等，均已完整填寫!</p>", 'admin_manage_add.php');
		}
		else
		if($_POST['rwo_datetype']=="2" && empty($_POST['rwo_date_end']))
		{
			dies("<p>欄位未填寫完全：有限日期區間應確實填寫開始日期與結束日期！</p>", 'admin_manage_add.php');
		}
		else
		if($_POST['rwo_datetype'] != "1" && empty($_POST['rwo_date_begin']))
		{
			dies("<p>欄位未填寫完全：請確實填寫起始日期！</p>", 'admin_manage_add.php');
		}
		else
		if($_POST['rwo_type']=="2" && empty($_POST['rwo_c_column']))
		{
			dies("<p>欄位未填寫完全：自訂條件時請選擇條件欄位</p>", 'admin_manage_add.php');
		}
		else
		if($_POST['rwo_type']=="2" && empty($_POST['rwo_c_value']))
		{
			dies("<p>欄位未填寫完全：自訂條件時請指定條件欄位的值</p>", 'admin_manage_add.php');
		}
		else
		if($_POST['rwo_type']=="2" && empty($_POST['rwo_c_type']))
		{
			dies("<p>欄位未填寫完全：自訂條件時請指定符合條件時的顯示動作<br />(必要、非必要、不顯示且必要於其他使用者、不顯示但非必要於其他使用者...等)</p>", 'admin_manage_add.php');
		}
		else
		if($_GET['action']=="modify" && empty($_GET['rwoID']))
		{
			dies("參數傳遞錯誤，請勿由此路徑執行本程式。", 'admin_main.php');
		}
		else
		{
			// Begin to insert data into MySQL
			if($_POST['rwo_type']=="2")
			{
				echo "Custom: ";
				$temp_c_value = "";
				
				for($i=0; $i < sizeof($_POST['rwo_c_value']); $i++)
				{
					if(empty($temp_c_value))
					{
						$temp_c_value = $_POST['rwo_c_value'][$i];
					}
					else
					{
						$temp_c_value = $temp_c_value.";".$_POST['rwo_c_value'][$i];
					}
				}
				echo $temp_c_value;
				
				switch($_GET['action'])
				{
					case "add":
						$currdb -> query("INSERT INTO `".($currdb -> prefix("regwizard_opt"))."` (rwo_name, rwo_description, rwo_datetype, rwo_date_begin, rwo_date_end, rwo_type, rwo_c_column, rwo_c_value, rwo_c_type) VALUES ('".mysql_real_escape_string($_POST['rwo_name'])."', '".mysql_real_escape_string($_POST['rwo_description'])."', '".mysql_real_escape_string($_POST['rwo_datetype'])."', '".mysql_real_escape_string($_POST['rwo_date_begin'])."', '".mysql_real_escape_string($_POST['rwo_date_end'])."', '".mysql_real_escape_string($_POST['rwo_type'])."', '".mysql_real_escape_string($_POST['rwo_c_column'])."', '".mysql_real_escape_string($temp_c_value)."', '".mysql_real_escape_string($_POST['rwo_c_type'])."')");
						break;
					case "modify":
						$currdb -> query("UPDATE `".($currdb -> prefix("regwizard_opt"))."` set rwo_name='".mysql_real_escape_string($_POST['rwo_name'])."', rwo_description='".mysql_real_escape_string($_POST['rwo_description'])."', rwo_datetype='".mysql_real_escape_string($_POST['rwo_datetype'])."', rwo_date_begin='".mysql_real_escape_string($_POST['rwo_date_begin'])."', rwo_date_end='".mysql_real_escape_string($_POST['rwo_date_end'])."', rwo_type='".mysql_real_escape_string($_POST['rwo_type'])."', rwo_c_column='".mysql_real_escape_string($_POST['rwo_c_column'])."', rwo_c_value='".mysql_real_escape_string($temp_c_value)."', rwo_c_type='".mysql_real_escape_string($_POST['rwo_c_type'])."' WHERE rwoID=".mysql_real_escape_string($_GET['rwoID'])."");
						break;
					default:
						echo "ERROR! <br />";
				}
			}
			else
			{
				switch($_GET['action'])
				{
					case "add":
						$currdb -> query("INSERT INTO `".($currdb -> prefix("regwizard_opt"))."` (rwo_name, rwo_description, rwo_datetype, rwo_date_begin, rwo_date_end, rwo_type, rwo_c_column, rwo_c_value, rwo_c_type) VALUES ('".mysql_real_escape_string($_POST['rwo_name'])."', '".mysql_real_escape_string($_POST['rwo_description'])."', '".mysql_real_escape_string($_POST['rwo_datetype'])."', '".mysql_real_escape_string($_POST['rwo_date_begin'])."', '".mysql_real_escape_string($_POST['rwo_date_end'])."', '".mysql_real_escape_string($_POST['rwo_type'])."', '', '', '')");
						break;
					case "modify":
						$currdb -> query("UPDATE `".($currdb -> prefix("regwizard_opt"))."` set rwo_name='".mysql_real_escape_string($_POST['rwo_name'])."', rwo_description='".mysql_real_escape_string($_POST['rwo_description'])."', rwo_datetype='".mysql_real_escape_string($_POST['rwo_datetype'])."', rwo_date_begin='".mysql_real_escape_string($_POST['rwo_date_begin'])."', rwo_date_end='".mysql_real_escape_string($_POST['rwo_date_end'])."', rwo_type='".mysql_real_escape_string($_POST['rwo_type'])."' WHERE rwoID=".mysql_real_escape_string($_GET['rwoID'])."");
						break;
					default:
						echo "ERROR! <br />";
				}
			}
			
			if($_GET['action']=="modify")
			{
				echo "<p>指定選項已成功修改！</p>";
				echo_go_regwizard_admin();
			}
			else
			{
				echo "<p>選項已成功新增！</p>";
				echo_go_regwizard_admin();
			}

		}
	}
	else
	if($_GET['action']=="delete")
	{
		if(!isset($_GET['checked']))
		{
			echo "<p>請確認刪除此一選項？</p>";
			echo "<form action=\"admin_process.php?action=delete&checked=checked\" method=\"post\"><input name=\"rwoID\" type=\"hidden\" value=".$_GET['rwoID']." /><input name=\"submit\" type=\"submit\" value=\"確定刪除\" /></form>";
			echo "<br /><br />或您也可以";
			echo_go_regwizard_admin();
		}
		else
		{
			if(empty($_POST['rwoID']))
			{
				echo "參數傳遞錯誤，請勿由此路徑執行本程式。";
			}
			else
			{
				$currdb -> query("DELETE FROM `".($currdb -> prefix("regwizard_opt"))."` WHERE rwoID=".$_POST['rwoID']."");
				
				echo "指定選項已經刪除完成。";
				echo_go_regwizard_admin();
			}
		}
	}
	else
	if($_GET['action']=="addurl")
	{
		if(empty($_POST['rwoID']) || empty($_POST['name']) || empty($_POST['url']) || empty($_POST['target']) || $_POST['url']=="http://")
		{
			dies("<p>欄位未填寫完全：請確實填寫連結的名稱以及URL位置！</p>", 'admin_manage_url.php?action=editurl&rwoID='.$_POST['rwoID'].'');
		}
		else
		{
			$currdb -> query("INSERT INTO `".($currdb -> prefix("regwizard_rel_links"))."` (rwoID, name, url, target) VALUES ('".$_POST['rwoID']."','".$_POST['name']."','".$_POST['url']."','".$_POST['target']."')");
			_redirect("admin_manage_url.php?action=editurl&rwoID=".$_POST['rwoID']."");
		}
	}
	else
	if($_GET['action']=="deleteurl")
	{
		if(!isset($_GET['checked']))
		{
			echo "<p>請確認刪除此一URL？</p>";
			echo "<form action=\"admin_process.php?action=deleteurl&checked=checked\" method=\"post\"><input name=\"rel_l_ID\" type=\"hidden\" value=".$_GET['rel_l_ID']." /><input name=\"submit\" type=\"submit\" value=\"確定刪除\" /></form>";
			echo "<br /><br />或您也可以";
			echo_go_regwizard_admin();
		}
		else
		{
			if(empty($_POST['rel_l_ID']))
			{
				echo "參數傳遞錯誤，請勿由此路徑執行本程式。";
			}
			else
			{
				$currdb -> query("DELETE FROM `".($currdb -> prefix("regwizard_rel_links"))."` WHERE rel_l_ID=".$_POST['rel_l_ID']."");
				
				echo "指定URL已經刪除完成。<br /><br />";
				echo_go_regwizard_admin();
			}
		}
	}
	else
	if($_GET['action']=="edit_single_url")
	{
		if(empty($_POST['rwoID']) || empty($_POST['name']) || empty($_POST['url']) || empty($_POST['target']) || $_POST['url']=="http://")
		{
			dies("<p>欄位未填寫完全：請確實填寫連結的名稱以及URL位置！</p>", 'admin_manage_url.php?action=edit_single_url&rel_l_ID='.$_GET['rel_l_ID'].'');
		}
		else
		{
			$currdb -> query("UPDATE `".($currdb -> prefix("regwizard_rel_links"))."` set rwoID='".$_POST['rwoID']."', name='".$_POST['name']."', url='".$_POST['url']."', target='".$_POST['target']."' WHERE rel_l_ID=".$_GET['rel_l_ID']."");
			_redirect("admin_manage_url.php?action=editurl&rwoID=".$_POST['rwoID']."");
		}
	}
}
else
{
	echo "欲使用此功能請先登入。";
}
?>
