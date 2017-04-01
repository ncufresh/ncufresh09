<?php
	require_once ("../../mainfile.php");

	if($curruser->isguest())
	{
		echo "請先登入";
		_savePage(URL.'/include/user.php?login_form=1');
	}

	$anschk=intval($_GET['anschk']);
	$Qid=intval($_GET['Qid']);
	$anscheck=intval($_GET['anscheck']);

    $db_chk_answered = $currdb -> fetch_array($currdb -> query("SELECT count(*) FROM `".($currdb -> prefix("question_check"))."` WHERE `uno` = '".($curruser -> uno)."' AND `id` = '".$Qid."'"));
    //echo $db_chk_answered['count(*)'];
    if($db_chk_answered['count(*)'] != 0)
    {
        $anscheck=1;
    }

	if($anscheck!=0)	$currtpl->display("answerd.tpl.php");
	else
	{
		$a=$currdb->query("SELECT * FROM `".$currdb->prefix("question_topic")."` WHERE id='".mysql_real_escape_string($Qid)."'");
		$a=$currdb->fetch_array($a);
		$public=$a['public'];
		if($public!=1)		$currtpl->display("unpublic.tpl.php");
		$topic=$a['topic'];
		$description=$a['description'];

	$qstdb=$currdb->query("SELECT * FROM ".$currdb->prefix("question_question")." left join ".$currdb->prefix("question_chooses")." on "
		.$currdb->prefix("question_question").".id = ".$currdb->prefix("question_chooses").".id &&"
		.$currdb->prefix("question_question").".gid = ".$currdb->prefix("question_chooses").".gid "
		." where ".$currdb->prefix("question_question").".id = ".mysql_real_escape_string($Qid)
		." ORDER BY ".$currdb->prefix("question_question").".sort ASC , ".$currdb->prefix("question_chooses").".sort ASC" );
	
	$question=array();
	$type=array();
	$chooseName=array();
	$i=0;
	
	$qstary=$currdb->fetch_array($qstdb);
	while($qstary['cid']!=NULL)
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
			if($temp!=$qstary['gid'] || $qstary['gid']== NULL) break;
			if($qstary['others']!=1) $choose[$i][]=$qstary['content'];
			else 					 $choose[$i][]="others";
		}
		while($qstary=$currdb->fetch_array($qstdb));
		$i++;
	}

		$currtpl->assign("SheetNumber",$Qid);
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
