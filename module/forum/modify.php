<?php
require_once("../../mainfile.php");
$ano=mysql_real_escape_string($_GET['ano']);
$fno=mysql_real_escape_string($_GET['forum']);
$anoSQL = $currdb->query("SELECT * FROM `".$currdb->prefix("forum_articals")."`
						  WHERE `ano` = '".$ano."'");
$artical = $currdb->fetch_array($anoSQL);
if($curruser->uno != $artical['uno']){
	_redirect();
	exit();
}
$mode = $_POST['mode'];
if(!isset($mode)){
	$anoSQL = $currdb->query("SELECT * FROM `".$currdb->prefix("forum_articals")."`
							  WHERE `ano` = '".$ano."'");

	$artical = $currdb->fetch_array($anoSQL);
	if($curruser->uno != $artical['uno']){
		_redirect();
		exit();
	}
	$modify['title'] = $artical['title'];
	$modify['content']=$artical['content'];
	$currtpl->addcss(ROOT_PATH.'/module/'.$currmodule->name.'/templates/newpage.css');
	$modify['url'] = "modify.php?ano=$ano";
	$modify['ano'] = $ano;
	$currtpl->assign('FNO',$fno);
	$currtpl->assign('modify',$modify);
	$currtpl->display("new.tpl.php");
}
else if($mode=="update"){
	$time = mktime();
	$currdb->query("UPDATE `".$currdb->prefix("forum_articals")."`
					SET `fixtime` = '".$time."', `content` = '".$_POST['content']."',
						`lasttime` = '".$time."'
					WHERE `ano`='".$_POST['ANO']."'");
	_redirect("viewboard.php?forum=".$_POST['FNO']."&ano=".$ano."");
}
?>
