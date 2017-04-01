<?php
require_once ("../../mainfile.php");

$sno=$_GET['sno'];
$qstdb=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_quests")."` WHERE SNofGrp='".$sno."'");
$qstnum=$currdb->num_rows($qstdb);

$answer=array();
for($a=0;$a<$qstnum;$a++){
	$s=$_POST["ans"."$a"];
	if(empty($s))
		_redirect("answer.php?sno=$sno&anschk=1");
	if(!is_array($s)) {
		if($s=="otherson"){
			$s=$_POST["ans".$a."-TEXT"];
			if(empty($s))
				_redirect("answer.php?sno=".$sno."&anschk=1");
		}
	}
	
	
	else{
		$arraylentgh=count($s);
		if($s[$arraylentgh-1]=="otherson"){
			$s[$arraylentgh-1]=$_POST["ans".$a."-TEXT"];
			if(empty($s))
				_redirect("answer.php?sno=".$sno."&anschk=1");
		}
	}
	
	array_push($answer,$s);
}



$answer=serialize($answer);

$currdb->query("INSERT INTO `".$currdb->prefix("sheet_answer")."` (SNofGrp,answer,uno) VALUES ('".$_GET['sno']."','".$answer."','".$curruser->uno."')"); //新增回答

_redirect(2);
?>