<?php
require("../../mainfile.php");

if(!$currmodule->isadmin($curruser)){
	_redirect("index.php");
}


if($_POST['status']=='new'){
	if(empty($_POST['topic']) || empty($_POST['descript']))
		_redirect();
	$currdb->query("INSERT INTO `".$currdb->prefix("sheet_sheet")."` (SN,Topic,description) VALUES ('".$_POST['sheetNum']."','".$_POST['topic']."','".$_POST['descript']."')"); //新增問卷


	$topic=$_POST['topic']; //問卷主題
	$description=$_POST['descript']; //問卷敘述
	$sno=$_GET['sno']; //問卷編號
}

else{
	$sno=$_GET['sno'];
	$a=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_sheet")."` WHERE SN='".$sno."'");
	$a=$currdb->fetch_array($a);
	$topic=$a['Topic'];
	$description=$a['description'];
}

$qstdb=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_quests")."` WHERE SNofGrp='".$sno."' ORDER BY qid");
$question=array();
$type=array();
$chooseName=array();

while($qstary=$currdb->fetch_array($qstdb)){
	if(empty($i))
		$i=0;
	$question[]=$qstary['question'];
	switch($qstary['type']){
			case 1:array_push($type,"radio"); $s="ans".$i; array_push($chooseName,"ans".$i); break;
			case 2:array_push($type,"checkbox");array_push($chooseName, "ans".$i."[]" ); break;
	}
	$qid=$qstary['qid'];	
	
	$choose[$i] = array();
	$chsdb=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_chooses")."` WHERE SNofQst='".$qstary['qid']."'");
	while($chsary=$currdb->fetch_array($chsdb)){
		if($qstary['qid']==$chsary['SNofQst']){
			$choose[$i][]=$chsary['content'];
			
		}
	}//讀取問券選項
	$i++;
}



$newQSTLink='newQuestion.php?sno='.$sno;

$currtpl->assign("type",$type);
$currtpl->assign("choose",$choose);
$currtpl->assign("chsname",$chooseName);
$currtpl->assign("questions",$question);
$currtpl->assign("sheetNum",$sno);
$currtpl->assign("topic",$topic);
$currtpl->assign("description",$description);
$currtpl->assign("newQuestLink",$newQSTLink);
$currtpl->display('editSheet.tpl.php');
?>