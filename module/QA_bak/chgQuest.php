<?php
	require_once '../../mainfile.php';
	
	if($curruser->isguest()){
		_savePage(URL.'/include/user.php?login_form=1');
	}
	if($_POST['submit']=="¨ú®ø") _redirect("index.php");
	
	if(empty($_POST['select']) || empty($_POST['title']) || empty($_POST['descript']))	_redirect();
	
	$user_IP = ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
	
	$currdb->query("UPDATE `".$currdb->prefix("qa_question").
		"` SET Qcontent = '".$_POST['descript']."' , Qtitle='".$_POST['title']."' , Qcls='".$_POST['select'].
		"' WHERE Qno='".$_POST['Qno']."';");
	echo "UPDATE `".$currdb->prefix("qa_question").
		"` SET Qcontent = '".$_POST['descript']."' , Qtitle='".$_POST['title']."' , Qcls='".$_POST['select'].
		"' WHERE Qno='".$_POST['Qno']."';";
	
	_redirect("index.php?QAno=".$_POST['Qno']);

?>
