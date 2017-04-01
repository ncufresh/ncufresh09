<?php
require_once ("../../mainfile.php");


if(!$currmodule->isadmin($curruser))_redirect("index.php");

$Qid=$_GET['Qid'];
$sig=$_GET['sig'];
$ChooseNum=$_GET['ChooseNum'];
$Chooses = array();

	$qstdb=$currdb->query("SELECT * FROM ".$currdb->prefix("question_question")." left join ".$currdb->prefix("question_chooses")." on "
		.$currdb->prefix("question_question").".id = ".$currdb->prefix("question_chooses").".id &&"
		.$currdb->prefix("question_question").".gid = ".$currdb->prefix("question_chooses").".gid "
		." where ".$currdb->prefix("question_question").".id = ".$Qid." && "
		.$currdb->prefix("question_chooses").".gid = ".$sig
		." ORDER BY ".$currdb->prefix("question_question").".sort ASC , ".$currdb->prefix("question_chooses").".sort ASC" );

if(empty($ChooseNum))
	$ChooseNum=$currdb->num_rows($qstdb);
		
$Qstdb=$currdb->fetch_array($qstdb);
$qst=$Qstdb['question'];
$type=$Qstdb['type'];


do{
	if($Qstdb['others']==0)
		array_push($Chooses, $Qstdb['content']);
	else
	{
		$ChooseNum--;
		$others=1;
	}
}while($Qstdb=$currdb->fetch_array($qstdb));

$currtpl->assign('Qid',$Qid);
$currtpl->assign('others',$others);
$currtpl->assign('type',$type);
$currtpl->assign('qst',$qst);
$currtpl->assign('Chooses',$Chooses);
$currtpl->assign('QuestionNum',$sig);
$currtpl->assign('ChooseNum',$ChooseNum);
$currtpl->display('editQuestion.tpl.php');
?>
