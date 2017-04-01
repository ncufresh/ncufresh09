<?php
require_once ("../../mainfile.php");

if(!$currmodule->isadmin($curruser)){
	_redirect("index.php");
}

$sno=$_GET['sno'];
$ChooseNum=$_GET['ChooseNum'];


$qsttlb=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_quests")."` WHERE SNofGrp='".$sno."' ORDER BY SNinGrp DESC");
$qsts=$currdb->num_rows($qsttlb);

if($qsts!=0){
	$qstSN=$qsts;
	}
else{
	$qstSN=0;
	}
if(empty($ChooseNum))
	$ChooseNum=5;


	
$currtpl->assign('type',$type);
$currtpl->assign('sno',$sno);
$currtpl->assign('QuestionNum',$qstSN+1);
$currtpl->assign('ChooseNum',$ChooseNum);
$currtpl->display('newQuestion.tpl.php');
?>