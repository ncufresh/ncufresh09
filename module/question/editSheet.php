<?php
require("../../mainfile.php");

if(!$currmodule->isadmin($curruser)) _redirect("index.php");

if($_POST['status']=='new'){
	if(empty($_POST['topic']) || empty($_POST['descript']))_redirect();
	$currdb->query("INSERT INTO `".$currdb->prefix("question_topic")."` (id,sort,topic,description) VALUES ('".$_POST['sheetNum']."','".$_POST['sheetNum']."','".$_POST['topic']."','".$_POST['descript']."')");

	$topic=$_POST['topic']; 
	$description=$_POST['descript'];
	$Qid=intval($_GET['Qid']);
}

else{
	$Qid=intval($_GET['Qid']);
	$a=$currdb->query("SELECT * FROM `".$currdb->prefix("question_topic")."` WHERE id='".$Qid."'");
	$a=$currdb->fetch_array($a);    // id = SheetNo
	$topic=$a['topic'];
	$description=$a['description'];
}
	$qstdb=$currdb->query("SELECT * FROM ".$currdb->prefix("question_question")." left join ".$currdb->prefix("question_chooses")." on "
		.$currdb->prefix("question_question").".id = ".$currdb->prefix("question_chooses").".id &&"
		.$currdb->prefix("question_question").".gid = ".$currdb->prefix("question_chooses").".gid "//Gid = GroupNo = QuestionNo
		." where ".$currdb->prefix("question_question").".id = ".$Qid
		." ORDER BY ".$currdb->prefix("question_question").".sort ASC , ".$currdb->prefix("question_chooses").".sort ASC" );
	
	$question=array();
	$type=array();
	$chooseName=array();
	$i=0;
	
	$qstary=$currdb->fetch_array($qstdb);
	while($qstary['cid']!= NULL)
	{
		$question[]=$qstary['question'];
		switch($qstary['type'])
		{
			case 1:array_push($type,"radio"); $s="ans".$i; array_push($chooseName,"ans".$i); break;
			case 2:array_push($type,"checkbox");array_push($chooseName, "ans".$i."[]" ); break;
		}
		$temp=$qstary['gid'];
		$choose[$i] = array();
		
		do
		{
			if($temp!=$qstary['gid']) break;
			if($qstary['others']!=1) $choose[$i][]=$qstary['content'];
			else 					 $choose[$i][]="others";
		}
		while($qstary=$currdb->fetch_array($qstdb));
		$i++;
	}

$newQSTLink='newQuestion.php?Qid='.$Qid;

$currtpl->assign("type",$type);
$currtpl->assign("choose",$choose);
$currtpl->assign("chsname",$chooseName);
$currtpl->assign("questions",$question);
print_r($questions);
$currtpl->assign("sheetNum",$Qid);
$currtpl->assign("topic",$topic);
$currtpl->assign("description",$description);
$currtpl->assign("newQuestLink",$newQSTLink);
$currtpl->display('editSheet.tpl.php');
?>
