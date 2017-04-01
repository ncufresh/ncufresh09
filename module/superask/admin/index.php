<?
require_once("../../../mainfile.php");

if ($currmodule->isadmin($curruser))
{
	echo "<a href=\"".URL."/module/".$currmodule->name."/admin/topic_manage.php\">主題管理</a><br />\n";
	echo "<a href=\"".URL."/module/".$currmodule->name."/admin/category_manage.php\">類別管理</a><br />\n";
	echo "<a href=\"".URL."/module/".$currmodule->name."/admin/impeach_list.php\">檢舉管理</a><br />\n";
}
else
	_redirect();
?>
