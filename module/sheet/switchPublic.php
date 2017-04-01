<?php
require_once ("../../mainfile.php");

if(!$currmodule->isadmin($curruser)){
	_redirect("index.php");
}

else{
	$SN=$_GET['sno'];
	$shtdb=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_sheet")."` WHERE SN = '".$SN."'");
	$shtdb=$currdb->fetch_array($shtdb);
	if($shtdb['public']==1)
		$currdb->query("UPDATE `".$currdb->prefix("sheet_sheet")."` SET public=2 WHERE SN = '".$SN."'");
	elseif($shtdb['public']==2)
		$currdb->query("UPDATE `".$currdb->prefix("sheet_sheet")."` SET public=1 WHERE SN = '".$SN."'");
	
	_redirect();
}

?>