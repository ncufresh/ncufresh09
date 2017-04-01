<?php
require_once("../../mainfile.php");

if(is_uploaded_file($_FILES['pic']['tmp_name'])){
	$DestDIR = "items_pic";
	if(!is_dir($DestDIR) || !is_writable($DestDIR))  die("無法寫入");
	
	$File_Extension = explode(".",$_FILES['pic']['name']);
	$File_Extension = $File_Extension[count($File_Extension)-1];
	$ServerFilename = date("YmdHis").".".$File_Extension;
	copy($_FILES['pic']['tmp_name'], $DestDIR."/".$ServerFilename);
	}
	
if(empty($ServerFilename) or empty($_POST['name']) or empty($_POST['derict']) or empty($_POST['downd']) or empty($_POST['tag'])){
	
	$del_temp = $currdb->query("SELECT `pic` FROM `".$currdb->prefix("shop")."` WHERE ino = '".$_POST['ino']."' ");
	$del_pic = $currdb->fetch_array($del_temp);

	@unlink("./items_pic/$del_pic[0]");

	$currdb->query("UPDATE `".$currdb->prefix("shop")."` SET item = '".$_POST['name']."', num = '".$_POST['number']."', deric = '"	.$_POST['derict']."', pic = '".$ServerFilename."', price = '".$_POST['price']."', type = '".$_POST['tag']."', outdate =  '".$_POST['downd']."' WHERE `ino` = '".$_POST['ino']."'");
	
	 _redirect("edit_form.php?msg=error&ino=".$_POST['ino']."");
	}

else{
	$del_temp = $currdb->query("SELECT `pic` FROM `".$currdb->prefix("shop")."` WHERE ino = '".$_POST['ino']."' ");
	$del_pic = $currdb->fetch_array($del_temp);

	@unlink("./items_pic/$del_pic[0]");
	
	
	$currdb->query("UPDATE `".$currdb->prefix("shop")."` SET item = '".$_POST['name']."', num = '".$_POST['number']."', deric = '"	.$_POST['derict']."', pic = '".$ServerFilename."', price = '".$_POST['price']."', type = '".$_POST['tag']."', outdate =  '".$_POST['downd']."' WHERE `ino` = '".$_POST['ino']."'") or die('失敗喔');

	header("location:items.php");
	}
?>