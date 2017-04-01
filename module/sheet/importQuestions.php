<?php
require_once ("../../mainfile.php");

if(!$currmodule->isadmin($curruser)){
	_redirect("index.php");
}

$status = $_GET['status'];
$others = $_POST['others'];

if($status == "new"){
	
	if(empty($_POST['select']) || empty($_POST['sno']) || empty($_POST['question']))
		_redirect();
	$currdb->query("INSERT INTO `".$currdb->prefix("sheet_quests")."` (SNofGrp,SNinGrp,question,type) VALUES ('".$_GET['sno']."','".$_POST['SNinGrp']."','".$_POST['question']."','".$_POST['select']."')"); //新增問題

	//插入問題
	
	$sno=$_GET['sno'];
	$SNinGrp=$_POST['SNinGrp'];

	$a=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_quests")."` WHERE SNofGrp='".$sno."'");
	while($b=$currdb->fetch_array($a)){
		if($b['SNinGrp']==$SNinGrp){
			$qid=$b['qid'];
		}
	}
	//echo $SNinGrp;
	$chooseary=$_POST['choose'];
	//抓取SNofQst=$qid

	$SNinQst=0;
	foreach($chooseary as $choose){
		if(!empty($choose)){
			$SNinQst++;
			$currdb->query("INSERT INTO `".$currdb->prefix("sheet_chooses")."` (SNofQst,SNinQst,content) VALUES ('".$qid."','".$SNinQst."','".$choose."')"); //新增選項
		}
	}

	if(isset($others)){
		if($others=="others"){
			$SNinQst++;
			$currdb->query("INSERT INTO `".$currdb->prefix("sheet_chooses")."` (SNofQst,SNinQst,content) VALUES ('".$qid."','".$SNinQst."','".$others."')");//其他選項
		}
	}
}



else if($status == "edit"){
		$question = $_POST['question'];
		$select = $_POST['select'];
		$sno = $_GET['sno'];
		$sig = $_POST['SNinGrp'];
		$oldChooses = $_POST['oldchses'];
		$currdb->query(" UPDATE `".$currdb->prefix("sheet_quests")."` SET question = '".$question."', type = '".$select."' WHERE SNofGrp='".$sno."' AND SNinGrp = ".$sig.""); //更新問題

	
		$a=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_quests")."` WHERE SNofGrp='$sno' AND SNinGrp = '".$sig."'");
		$b=$currdb->fetch_array($a);
		$qid=$b['qid'];
		//抓取SNofQst=$qid

		$chsdb=$currdb->query("SELECT * FROM `".$currdb->prefix("sheet_chooses")."` WHERE SNofQst='".$qid."'");
		$oldchsnum = $currdb->num_rows($chsdb);

		$chooseary=$_POST['choose'];

		$SNinQst=0;
	
		foreach($chooseary as $choose){
			if(!empty($choose)){
				$SNinQst++;
				if($SNinQst > $oldchsnum){
					$currdb->query("INSERT INTO `".$currdb->prefix("sheet_chooses")."` (SNofQst,SNinQst,content) VALUES ('".$qid."','".$SNinQst."','".$choose."')");
				}	
				else{
					$currdb->query("UPDATE `".$currdb->prefix("sheet_chooses")."` SET content = '".$choose."' WHERE SNofQst='".$qid."' AND SNinQst='".$SNinQst."'");
				} //更新選項
			}
		}

		if(isset($others)){
			if($others=="others"){
				$SNinQst++;
				if($SNinQst > $oldchsnum){
					$currdb->query("INSERT INTO `".$currdb->prefix("sheet_chooses")."` (SNofQst,SNinQst,content) VALUES ('".$qid."','".$SNinQst."','".$others."')");
				}
				else{	
					$currdb->query("UPDATE `".$currdb->prefix("sheet_chooses")."` SET content = '".$others."' WHERE SNofQst='".$qid."' AND SNinQst='".$SNinQst."'");//其他選項
				}
			}
		}
	
		$dif = $oldchsnum - $SNinQst;
		if($dif > 0){
			for( $i = 0 ; $i < $dif ; $i++){
				$SNinQst++;
				$currdb->query("DELETE FROM `".$currdb->prefix("sheet_chooses")."` WHERE SNofQst = '".$qid."' AND SNinQst='".$SNinQst."'");
			}
		}
}
	$sno = $_GET['sno'];
	_redirect("editSheet.php?sno=".$sno);

?>
