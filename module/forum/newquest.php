<?php
include("../../mainfile.php");
if($curruser->isguest())
	_savePage(URL.'/include/user.php?login_form=1');
//print_r($_POST);
if($_POST['submitVal']=="取消") {
	_redirect("board.php?forum=".$_POST['FNO']);
	exit();
}

else if(empty($_POST['title']) || empty($_POST['content'])){
	$currtpl->addcss(ROOT_PATH.'/module/'.$currmodule->name.'/templates/newpage.css');
	$currtpl->assign('FNO',$_GET['fno']);
	$currtpl->display('new.tpl.php');
}
else{
    $getCoin = strlen($_POST['content']);
    $userCoin=$currdb->query("SELECT `coins` FROM `".$currdb->prefix("user")."` WHERE `uno` = '".$curruser->uno."'");
    $userCoin=$currdb->fetch_array($userCoin);
    $currdb->query("UPDATE `".$currdb->prefix("user")."` SET `coins` = ".($userCoin['coins']+$getCoin)." WHERE uno='".$curruser->uno."'");
    

	if(empty($_POST['FNO']))
		_redirect("index.php");
	$user_IP = ($_SERVER["HTTP_VIA"]) ? $_SERVER["HTTP_X_FORWARDED_FOR"] : $_SERVER["REMOTE_ADDR"];
	$currtime=mktime();
	$SNinF=$currdb->query("SELECT COUNT(*) FROM `".$currdb->prefix("forum_articals")."`
							WHERE fno = '".$_POST['FNO']."'");
	$SNinF=$currdb->fetch_array($SNinF);
	$SNinF=$SNinF['COUNT(*)']+1;
	$currdb->query("INSERT INTO `".$currdb->prefix("forum_articals").
		"` (`fno`,`SNinF`,`uno`,`title`,`content`,`time`,`ip`,`lasttime`) VALUES ('"
			.$_POST['FNO']."','".$SNinF."','".$curruser->uno."','".$_POST['title'].
			"','".$_POST['content']."','".$currtime."','".$user_IP."','".$currtime."')");
	$ano = $currdb->query("SELECT `ano` FROM `".$currdb->prefix("forum_articals")."`
					WHERE uno='".$curruser->uno."' AND time='".$currtime."'");
	$ano = $currdb->fetch_array($ano);
	$ano = $ano['ano'];
	$redArray=array();
	$userSQL = $currdb->query("SELECT uno FROM `".$currdb->prefix("user")."`");
	while($uno_fetch = $currdb->fetch_array($userSQL)){
		$redArray[]="('".$uno_fetch['uno']."','".$ano."','0')";
	}
	$redSQL = implode(", ",$redArray);
	//echo $redSQL;
	//$redSQL -> ('uno','ano','0'),('uno2','ano','0')...
	$currdb->query("INSERT INTO `".$currdb->prefix("forum_redpoint")."`
					(`readuno`,`ano`,`redtime`) VALUES
					".$redSQL."
					") or die(mysql_error());
	_redirect("board.php?forum=".$_POST['FNO']);
}
?>
