<?php
require_once ("../../mainfile.php");

if($curruser -> isguest())
{
	//echo "欲使用此功能請先登入。";
	_savePage(URL."/include/user.php?login_form=1");
}
else
{
	if($_GET['action']=="start")
	{
		$user_rf_chk = $currdb -> query("SELECT * FROM `".($currdb -> prefix("regwizard_readfirst"))."` WHERE uno=".($curruser -> uno)."");
		
		if($currdb -> num_rows($user_rf_chk) != 0)
		{
			_redirect("index.php");
		}
		else
		{
			$currdb -> query("INSERT INTO `".($currdb -> prefix("regwizard_readfirst"))."` (uno, finish_time) VALUES ('".($curruser -> uno)."', '".mktime()."')");
			_redirect("index.php");
		}
	}
	else
	{
		$user_rf_chk = $currdb -> query("SELECT * FROM `".($currdb -> prefix("regwizard_readfirst"))."` WHERE uno=".($curruser -> uno)."");
		
		if($currdb -> num_rows($user_rf_chk) == 0)
		{
			$currtpl -> display("index_rw_readfirst.html");
			exit();
		}
	}
}
?>
