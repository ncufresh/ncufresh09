<?php
require_once("../../mainfile.php");

if($curruser->isguest()) _savePage(URL.'/include/user.php?login_form=1');
else{

$result = $currdb->query("SELECT * from `".$currdb->prefix("shop")."` WHERE ino = '".$_GET['ino']."' ");
$comp = $currdb->fetch_array($result);
$com_pic = $comp[pic];
$loose = "puzzle_area.php?ino=$_GET[prev]&msg=again";

$result2 = $currdb->query("SELECT * from `".$currdb->prefix("shop_personal")."` WHERE ino = '".$_GET['ino']."' AND uid = '".$curruser->uid."' ")or die("失敗");
$total = $currdb->num_rows($result2);
	if($total == 0){
	$currdb->query("INSERT INTO `".$currdb->prefix("shop_personal")."` (uid, ino, type) VALUES('".$curruser->uid."' , '".$_GET['ino']."' , '".$comp[type]."')");
	}
$currtpl -> assign('complete',$com_pic);
$currtpl -> assign('not_complete',$loose);
$currtpl -> display('puzzle_finish.tpl.htm');

}
?>