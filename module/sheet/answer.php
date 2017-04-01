<?php
require_once ("../../mainfile.php");

if($curruser->isguest()){
	echo "請先登入";
	}

$anschk=$_GET['anschk'];
$sno=$_GET['sno'];

$anscheck=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_answer")."` WHERE SNofGrp='".$sno."' AND uno='".$curruser->uno."'");
$anscheck=$currdb->num_rows($anscheck);

if($anscheck!=0){
	$currtpl->display("answerd.tpl.php");
}
	
else{
	$a=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_sheet")."` WHERE SN='".$sno."'");
	$a=$currdb->fetch_array($a);
	$public=$a['public'];
	if($public!=1){
		$currtpl->display("unpublic.tpl.php");
	}
	$topic=$a['Topic'];
	$description=$a['description'];//讀取問卷主題及敘述

	$qstdb=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_quests")."` WHERE SNofGrp='".$sno."' ORDER BY qid" );
	$question=array();
	$type=array();
	$chooseName=array();
	$i=0;
	
	while($qstary=$currdb->fetch_array($qstdb)){
		$question[]=$qstary['question'];
		switch($qstary['type']){
			case 1:array_push($type,"radio"); $s="ans".$i; array_push($chooseName,"ans".$i); break;
			case 2:array_push($type,"checkbox");array_push($chooseName, "ans".$i."[]" ); break;
		}//讀取問券問題
		$choose[$i] = array();
		$chsdb=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_chooses")."` WHERE SNofQst='".$qstary['qid']."'");
		while($chsary=$currdb->fetch_array($chsdb)){
			if($qstary['qid']==$chsary['SNofQst']){
				$choose[$i][]=$chsary['content'];
			}
		}//讀取問券選項
		$i++;
	}

	$currtpl->assign("SheetNumber",$sno);
	$currtpl->assign("chsname",$chooseName);
	$currtpl->assign("type",$type);
	$currtpl->assign("anschk",$anschk);
	$currtpl->assign("choose",$choose);
	$currtpl->assign("questions",$question);
	$currtpl->assign("topic",$topic);
	$currtpl->assign("description",$description);
	$currtpl->display('answer.tpl.php');
}
?>