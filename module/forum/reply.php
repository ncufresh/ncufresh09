<?php
require_once("../../mainfile.php");
if($curruser->isguest())
	_savePage(URL.'/include/user.php?login_form=1');

if(empty($_POST['content']) || empty($_POST['ano']))
	_redirect();
else{
	 $getCoin = strlen($_POST['content']);
     $userCoin=$currdb->query("SELECT `coins` FROM `".$currdb->prefix("user")."` WHERE `uno` = '".$curruser->uno."'");
     $userCoin=$currdb->fetch_array($userCoin);
     $currdb->query("UPDATE `".$currdb->prefix("user")."` SET `coins` = ".($userCoin['coins']+$getCoin)." WHERE uno='".$curruser->uno."'");

    
    $ano = mysql_real_escape_string($_POST['ano']);
	$fno = mysql_real_escape_string($_POST['fno']);
	$content = mysql_real_escape_string($_POST['content']);
	$uno = $curruser->uno;
	$user_IP = ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
	$time = mktime();
	$currdb->query("INSERT INTO `".$currdb->prefix("forum_reply")."`
				   (`ano`,`uno`,`content`,`time`,`ip`) VALUES
				   ('".$ano."','".$uno."','".$content."','".$time."','".$user_ip."')");
	$currdb->query("UPDATE `".$currdb->prefix("forum_articals")."`
					SET `lasttime` = '".$time."' WHERE `ano`='".$ano."'");
	_redirect("viewboard.php?forum=".$fno."&ano=".$ano."");
}

?>
