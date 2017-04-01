<?php
require_once ("../../mainfile.php");


if(!$currmodule->isadmin($curruser)){
	_redirect("index.php");
}

$sno=$_GET['sno'];
$sig=$_GET['sig'];
$ChooseNum=$_GET['ChooseNum'];
$Chooses = array();

$qstdb=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_quests")."` WHERE SNofGrp='".$sno."' AND SNinGrp='".$sig."'");
$qstdb=$currdb->fetch_array($qstdb);
$qst=$qstdb['question'];
$qstno=$qstdb['qid'];
$type=$qstdb['type'];

$chsdb=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_chooses")."` WHERE SNofQst='".$qstno."' ORDER BY SNinQst");

if(empty($ChooseNum))
	$ChooseNum=$currdb->num_rows($chsdb);

while($chs=$currdb->fetch_array($chsdb)){
	if($chs['content']!="others")
		array_push($Chooses, $chs['content']);
	elseif($chs['content']=="others"){
		$ChooseNum--;
		$others=1;
		}
}

$currtpl->assign('sno',$sno);
$currtpl->assign('others',$others);
$currtpl->assign('type',$type);
$currtpl->assign('qst',$qst);
$currtpl->assign('Chooses',$Chooses);
$currtpl->assign('QuestionNum',$sig);
$currtpl->assign('ChooseNum',$ChooseNum);
$currtpl->display('editQuestion.tpl.php');
?>
