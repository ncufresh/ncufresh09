<?php
require_once ("../../mainfile.php");

if(!$currmodule->isadmin($curruser))	_redirect("index.php");

$status = $_GET['status'];
$others = $_POST['others'];

if($status == "new"){
	
	if(empty($_POST['select']) || empty($_POST['Qid']) || empty($_POST['question']))	_redirect();
	$currdb->query("INSERT INTO `".$currdb->prefix("question_question")."` (`id`,`gid`,`sort`,`question`,`type`) VALUES ('".$_GET['Qid']."','".$_POST['gid']."','".$_POST['gid']."','".$_POST['question']."','".$_POST['select']."')");

	$Qid=$_GET['Qid'];
	$gid=$_POST['gid'];

	$chooseary=$_POST['choose'];

	$i=0;
	foreach($chooseary as $choose)
	{
		if(!empty($choose))
		{
			$i++;
			$currdb->query("INSERT INTO `".$currdb->prefix("question_chooses")."` (`id` , `gid` , `cid` , `sort` , `content` , `others`) VALUES ('".$Qid."', '".$gid."', '".$i."', '".$i."', '".$choose."', '0');");
		}
	}

	if(isset($others)){
		if($others=="others"){
			$i++;
			$currdb->query("INSERT INTO `".$currdb->prefix("question_chooses")."` (`id` , `gid` , `cid`,`sort`,`content`,`others`) VALUES ('".$Qid."','".$gid."','".$i."','".$i."','".$choose."','1');");
		}
	}
}

else if($status == "edit"){
		$question = $_POST['question'];
		$select = $_POST['select'];
		$Qid = $_GET['Qid'];
		$gid = $_POST['gid'];
		$oldChooses = $_POST['oldchses'];
		
		$currdb->query(" UPDATE `".$currdb->prefix("question_question")."` SET question = '".$question."', type = '".$select."' WHERE id='".$Qid."' AND gid = ".$gid.""); 

/*		$qstdb=$currdb->query("SELECT * FROM ".$currdb->prefix("question_question")." left join ".$currdb->prefix("question_chooses")." on "
		.$currdb->prefix("question_question").".id = ".$currdb->prefix("question_chooses").".id &&"
		.$currdb->prefix("question_question").".gid = ".$currdb->prefix("question_chooses").".gid "
		." where ".$currdb->prefix("question_question").".id = ".$Qid
		." ORDER BY ".$currdb->prefix("question_question").".sort ASC , ".$currdb->prefix("question_chooses").".sort ASC" );*/
	
//		$oldchsnum = $currdb->num_rows($qstdb);

        $currdb->query("DELETE FROM ".$currdb->prefix("question_chooses")." WHERE gid = '".$gid."'");
		
        $chooseary=$_POST['choose'];
        $i=0;
	
		foreach($chooseary as $choose){
			if(!empty($choose)){
				$i++;
//				if($i > $oldchsnum){i
                $currdb->query("INSERT INTO `".$currdb->prefix("question_chooses")."` (`id` , `gid` , `cid` , `sort` , `content` , `others`) VALUES ('".$Qid."', '".$gid."', '".$i."', '".$i."', '".$choose."', '0')") or die(mysql_error());
//				}	
//				else{
//					$currdb->query("UPDATE `".$currdb->prefix("question_chooses")."` SET content = '".$choose."' WHERE id='".$Qid."' AND gid='".$gid."' AND cid='".$i."'");
//				} 
			}
		}
        

		if(isset($others)){
			if($others=="others"){
				$i++;
//				if($i > $oldchsnum)
//				{

                $currdb->query("INSERT INTO `".$currdb->prefix("question_chooses")."` (`id` , `gid` , `cid` , `sort` , `others`) VALUES ('".$Qid."', '".$gid."', '".$i."', '".$i."', '1')") or die(mysql_error());
//				}
/*				
				else
				{	
					$currdb->query("UPDATE `".$currdb->prefix("question_chooses")."` SET others = '".$others."' WHERE id='".$Qid."' AND gid='".$gid."'");
				}*/
			}
		}
	
/*		$dif = $oldchsnum - $i;
		if($dif > 0){
			for( $ii = 0 ; $ii < $dif ; $ii++){
				$i++;
				$currdb->query("DELETE FROM `".$currdb->prefix("question_chooses")."` WHERE id = '".$Qid."' AND gid='".$gid."'");
			}
		}*/
}
	$Qid = $_GET['Qid'];
	_redirect("editSheet.php?Qid=".$Qid);

?>
