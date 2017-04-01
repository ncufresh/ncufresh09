<?php
require_once ("../../mainfile.php");

if(!$currmodule->isadmin($curruser)){
	_redirect("index.php");
}

$Qid=$_GET['Qid'];
$ChooseNum=$_GET['ChooseNum'];


$qsttlb=$currdb->query("SELECT * FROM `".$currdb->prefix("question_question")."` WHERE id='".$Qid."' ORDER BY sort DESC");
$qsts=$currdb->num_rows($qsttlb);

	if($qsts!=0)	$qstSN=$qsts;
	else	$qstSN=0;
	if(empty($ChooseNum))	$ChooseNum=5;


	
$currtpl->assign('type',$type);
$currtpl->assign('Qid',$Qid);
$currtpl->assign('QuestionNum',$qstSN+1);
$currtpl->assign('ChooseNum',$ChooseNum);
$currtpl->display('newQuestion.tpl.php');
?>