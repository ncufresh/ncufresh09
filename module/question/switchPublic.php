<?php
require_once ("../../mainfile.php");

if(!$currmodule->isadmin($curruser)){
	_redirect("index.php");
}

else{
	$id=$_GET['Qid'];
	$shtdb=$currdb->query("SELECT * FROM `".$currdb->prefix("question_topic")."` WHERE id = '".$id."'");
	$shtdb=$currdb->fetch_array($shtdb);
	if($shtdb['public']==1)
		$currdb->query("UPDATE `".$currdb->prefix("question_topic")."` SET public=2 WHERE id = '".$id."'");
	elseif($shtdb['public']==2)
		$currdb->query("UPDATE `".$currdb->prefix("question_topic")."` SET public=1 WHERE id = '".$id."'");
	
	_redirect();
}

?>