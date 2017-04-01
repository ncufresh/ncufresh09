<?php
require_once ("../../mainfile.php");

$submit = $_POST['submit'];

if($submit == "上一頁") { _redirect("index.php"); }

$Qid=$_GET['Qid'];
$qstdb=$currdb->query("SELECT * FROM `".$currdb->prefix("question_question")."` WHERE id='".mysql_real_escape_string($Qid)."'");
$qstnum=$currdb->num_rows($qstdb);

$answer=array();
for($a=0;$a<$qstnum;$a++){
	$s=$_POST["ans"."$a"];
	if(empty($s))
		_redirect("answer.php?Qid=".$Qid."&anschk=1");
	if(!is_array($s)) {
		if($s=="otherson"){
			$s=$_POST["ans".$a."-TEXT"];
			if(empty($s))
				_redirect("answer.php?Qid=".$Qid."&anschk=1");
		}
	}
	
	
	else{
		$arraylentgh=count($s);
		if($s[$arraylentgh-1]=="otherson"){
			$s[$arraylentgh-1]=$_POST["ans".$a."-TEXT"];
			if(empty($s))
				_redirect("answer.php?Qid=".$Qid."&anschk=1");
		}
	}
	
	array_push($answer,$s);
}

$answer=serialize($answer);

$currdb->query("INSERT INTO `".$currdb->prefix("question_check")."` (`id`,`uno`,`answer`,`check`) VALUES ('".mysql_real_escape_string($_GET['Qid'])."','".$curruser->uno."','".$answer."','1')");

_redirect("index.php");
?>
