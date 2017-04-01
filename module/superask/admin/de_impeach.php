<?
	require_once("../../../mainfile.php");
	
	if($currmodule->isadmin($curruser))
	{
		$currdb->query("update " .$currdb->prefix("wiki_post"). " set impeach='0' where tno='" .$_REQUEST['tno']. "'");
		_redirect();
	}
?>
