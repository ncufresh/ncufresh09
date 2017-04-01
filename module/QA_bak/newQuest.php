<?php
	require_once '../../mainfile.php';
	
	if($curruser->isguest()){
		_savePage(URL.'/include/user.php?login_form=1');
	}
	
	if($_POST['submit']=="取消")	_redirect("index.php");
	
	if(empty($_POST['select']) || empty($_POST['title']) || empty($_POST['descript']))	_redirect();
	$getCoin = strlen($_POST['descript']);
    $userCoin=$currdb->query(addslashes("SELECT `coins` FROM `".$currdb->prefix("user")."` WHERE `uno` = '".$curruser->uno."'"));
    $userCoin=$currdb->fetch_array($userCoin);
    $currdb->query("UPDATE `".$currdb->prefix("user")."` SET `coins` = ".($userCoin['coins']+$getCoin)." WHERE uno='".$curruser->uno."'");
	
	$user_IP = ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
	
	$currdb->query("INSERT INTO `".$currdb->prefix("qa_question").
		"` (`Qtime`,`Quno`,`Qtitle`,`Qcontent`,`Qrenum`,`Qnewtime`,`Qcls`,`QIP`) VALUES ('"
			.mktime()."','".$curruser->uno."','".$_POST['title'].
			"','".$_POST['descript']."','0','".mktime()."','".$_POST['select']."','".$user_IP."')");
	
	_redirect("index.php");

?>
