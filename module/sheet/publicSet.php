<?php
require_once ("../../mainfile.php");

if(!$currmodule->isadmin($curruser)){
	_redirect("index.php");
}

else{
	$shtdb=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_sheet")."` WHERE public != 0 ORDER BY SN");

	$SN=array();
	$title=array();
	$pubcheck=array();
	
	while($a=$currdb->fetch_array($shtdb)){
		$title[]=$a['Topic'];
		$SN[]=$a['SN'];
		$pubcheck[]=$a['public'];		
	}
	
	
	$currtpl->assign("admin",$currmodule->isadmin($curruser));
	$currtpl->assign("SN",$SN);
	$currtpl->assign("title",$title);
	$currtpl->assign("pubcheck",$pubcheck);
	$currtpl->display('publicSet.tpl.php');
}
?>