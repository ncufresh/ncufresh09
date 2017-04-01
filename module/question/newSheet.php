<?php
require_once ("../../mainfile.php");

if(!$currmodule->isadmin($curruser)) _redirect("index.php");

$a=$currdb->query("SELECT * FROM `".$currdb->prefix("question_topic")."` ORDER BY id DESC");
$rows=$currdb->num_rows($a);

	if($rows!=0)
	{
		$a=$currdb->fetch_array($a);
		$a=$a['id'];
	}
	else
	{
		$a=0;
	}
	$sheetNum=$a+1;

	$link=array();
	$linkname=array();
	$b=$currdb->query("SELECT * FROM `".$currdb->prefix("question_topic")."`");
	while($shet=$currdb->fetch_array($b))
	{
		if($shet['public']==0)
		{
			$link[]="./editSheet.php?Qid={$shet['id']}";
			$linkname[]="{$shet['id']}.{$shet['topic']}";
		}
	}

$currtpl->assign("link",$link);
$currtpl->assign("linkname",$linkname);
$currtpl->assign("sheetNum",$a+1);
$currtpl->display("newSheet.tpl.php");
?>
