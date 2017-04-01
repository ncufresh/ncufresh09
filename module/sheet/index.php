<?php
require_once ("../../mainfile.php");

	$shtdb=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_sheet")."` WHERE public='1' ORDER BY SN");

	$SN=array();
	$title=array();
	$anscheck=array();
	
	while($a=$currdb->fetch_array($shtdb)){
		$title[]=$a['Topic'];
		$SN[]=$a['SN'];
		$anschk=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_answer")."` WHERE uno='".$curruser->uno."' AND SNofGrp='".$a['SN']."'");
		$ansed = $currdb->fetch_array($anschk);
		if($a['SN']==$ansed['SNofGrp'])
			array_push($anscheck,1);
		else
			array_push($anscheck,0);
	}
	$sts=$_GET['su'];
	switch($sts){
		case 2:$status='問卷回答完成';break;
		default:$status=NULL;break;
	}
	$currtpl->assign("SU",$status);
	$currtpl->assign("admin",$currmodule->isadmin($curruser));
	$currtpl->assign("SN",$SN);
	$currtpl->assign("title",$title);
	$currtpl->assign("anscheck",$anscheck);
	$currtpl->display("index.tpl.php");

?>