<?php
if (!defined("MAINFILE_INCLUDED"))
	exit();
function forum_isadmin($fno){
	global $curruser,$currdb,$currmodule;
	$check = $currdb->query("SELECT * from `".$currdb->prefix('forum_list')."` WHERE `fno` = '".$fno."'");
	$check = $currdb->fetch_array($check);
	$checker = ($check['admin_uno']==$curruser->uno) ? 1 : 0;
	$checker = ($currmodule->isadmin($curruser) or $checker);
	return $checker;
}

	
?>