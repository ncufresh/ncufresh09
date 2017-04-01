<?php
	require_once ("../../mainfile.php");
	
	$Qdb=$currdb->query("SELECT * FROM ".$currdb->prefix("question_topic")." where public='1' ORDER BY sort");	
	
	$id=array();
	$num=array();
	$title=array();
	$anscheck=array();
	$i=1;

	while($a=$currdb->fetch_array($Qdb))
	{
		$title[]=$a['topic'];
		$id[]=$a['id'];
		$num[]=$i++;
		$anschk=$currdb->query("SELECT * FROM `".$currdb->prefix("question_check")."` WHERE uno='".$curruser->uno."' && id ='".$a['id']."'");
		$ansed = $currdb->fetch_array($anschk);
		array_push($anscheck,$ansed['check']);
	}
	$currtpl->assign("admin",$currmodule->isadmin($curruser));
	$currtpl->assign("id",$id);
	$currtpl->assign("num",$num);
	$currtpl->assign("title",$title);
	$currtpl->assign("anscheck",$anscheck);
	$currtpl->display("index.tpl.php");
?>