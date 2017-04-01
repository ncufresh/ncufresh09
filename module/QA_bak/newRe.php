<?php
	require_once '../../mainfile.php';
	
	if($curruser->isguest()){
		_savePage(URL.'/include/user.php?login_form=1');
	}
	
	if(empty($_POST['descript']))	_redirect();
	
	$getCoin = strlen($_POST['descript']);
    $userCoin=$currdb->query(addslashes("SELECT `coins` FROM `".$currdb->prefix("user")."` WHERE `uno` = '".$curruser->uno."'"));
    $userCoin=$currdb->fetch_array($userCoin);
    $currdb->query("UPDATE `".$currdb->prefix("user")."` SET `coins` = ".($userCoin['coins']+$getCoin)." WHERE uno='".$curruser->uno."'");

	$time = mktime();
	$user_IP = ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
	$RFloor = $currdb->query("SELECT COUNT(*) FROM `".$currdb->prefix("qa_re")."`
					WHERE Rno = '".$_POST['Qno']."'");
	$RFloor = $currdb->fetch_array($RFloor);
	$RFloor = $RFloor['COUNT(*)']+1;
	$currdb->query("INSERT INTO `".$currdb->prefix("qa_re").
		"` (`Rno`,`Rfloor`,`Rtime`,`Runo`,`Rcontent`,`RIP`) VALUES ('"
			.$_POST['Qno']."','".$RFloor."','".$time."','".$curruser->uno.
			"','".$_POST['descript']."','".$user_IP."');");
			
	$currdb->query("UPDATE `".$currdb->prefix("qa_question").
		"` SET Qrenum = '".($RFloor).
		"', Qnewtime = '".$time.
		"' WHERE Qno='".$_POST['Qno']."';"); 

	_redirect("index.php?QAno=".$_POST['Qno']);

?>
