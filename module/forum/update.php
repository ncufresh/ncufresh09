<?php
require_once("../../mainfile.php");
$currtpl->addcss(ROOT_PATH.'/module/'.$currmodule->name.'/templates/board.css');

$type = $_GET['type'];
$fno = $_POST['fno'];
if(!forum_isadmin($fno))
	_redirect('index.php');
if($type=="pic"){
	$file = $_FILES['pic'];
	$faulttype = true;
	$picchecker=$currdb->query("SELECT * FROM `".$currdb->prefix('forum_list')."` WHERE `fno`= ".$fno." LIMIT 1");
    $picchecker=$currdb->fetch_array("$picchecker");
    if($picchecker['pic']!="none")
        unlink("templates/fpic/".$picchecker['fno'].$picchecker['pic']);
	//echo $picchecker['fno'].$picchecker['pic'];
    $allowtype = array('jpg','jpeg','gif','png');
	$ext = explode(".",$file['name']);
	foreach($allowtype as $at){
		if($ext[1]==$at)
		$faulttype = false;
	}
	if(!$faulttype){
		$savefile_name = "templates/fpic/".$fno.".".$ext[1];
		if(file_exists($savefile_name))
            unlink($savefile_name);
        copy($file['tmp_name'],$savefile_name);
		$time = mktime();
		$sql ="UPDATE `".$currdb->prefix('forum_list')."`
		   SET `pic` = '".$ext[1]."' WHERE `fno` = ".$fno."";
		}
		unlink($file['tmp_name']);
}

if($type=="arti"){
	$descripe = mysql_real_escape_string($_POST['descripe']);
	$sql ="UPDATE `".$currdb->prefix('forum_list')."`
		   SET `descripe` = '".$descripe."' WHERE `fno` = ".$fno."";		 
}
$currdb->query($sql);
_redirect("board.php?forum=$fno");
?>
