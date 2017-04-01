<?php
require_once ("../../mainfile.php");

if(!$currmodule->isadmin($curruser))_redirect("index.php");

else{
	$shtdb=$currdb->query("SELECT * FROM `".$currdb->prefix("question_topic")."` WHERE public != 0 ORDER BY sort");

	$id=array();
	$title=array();
	$pubcheck=array();
	$num=array();
	$i=1;
	
	while($a=$currdb->fetch_array($shtdb)){
		$title[]=$a['topic'];
		$id[]=$a['id'];
		$num[]=$i++;
		$pubcheck[]=$a['public'];		
	}
	
	$currtpl->assign("admin",$currmodule->isadmin($curruser));
	$currtpl->assign("id",$id);
	$currtpl->assign("num",$num);
	$currtpl->assign("title",$title);
	$currtpl->assign("pubcheck",$pubcheck);
	$currtpl->display('publicSet.tpl.php');
}
?>