<?php
require_once ("../../mainfile.php");

if(!$currmodule->isadmin($curruser)){
	_redirect("index.php");
}

$a=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_sheet")."` ORDER BY SN DESC");
$rows=$currdb->num_rows($a);

if($rows!=0){
	$a=$currdb->fetch_array($a);
	$a=$a['SN'];
	}
else{
	$a=0;
	}
$sheetNum=$a+1;

$link=array();
$linkname=array();
$b=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_sheet")."`");
while($shet=$currdb->fetch_array($b)){
	if($shet['public']==0){
		$link[]="./editSheet.php?sno={$shet['SN']}";
		$linkname[]="{$shet['SN']}.{$shet['Topic']}";
	}
}

$currtpl->assign("link",$link);
$currtpl->assign("linkname",$linkname);
$currtpl->assign("sheetNum",$a+1);
$currtpl->display("newSheet.tpl.php");
?>
