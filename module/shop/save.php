<?php
require_once("../../mainfile.php");
header("Cache-control: private");;

/*if ($pic != "none") {
   	echo "檔案名稱:".$_FILES['pic']['name']."<br />";
	echo "檔案大小:".$_FILES['pic']['size']."<br />";
	echo "檔案類別:".$_FILES['pic']['type']."<br />";
	echo "暫存名稱:".$_FILES['pic']['tmp_name']."<br />";
    echo "上傳完成";
 } else {
    echo "沒有檔案";
 }*/
 

 
if(is_uploaded_file($_FILES['pic']['tmp_name'])){
	$DestDIR = "items_pic";
	if(!is_dir($DestDIR) || !is_writable($DestDIR))  die("無法寫入");
	
	$File_Extension = explode(".",$_FILES['pic']['name']);
	$File_Extension = $File_Extension[count($File_Extension)-1];
	$ServerFilename = date("YmdHis").".".$File_Extension;
	copy($_FILES['pic']['tmp_name'], $DestDIR."/".$ServerFilename);

	if(empty($ServerFilename) or empty($_POST['name']) or empty($_POST['derict']) or empty($_POST['downd']) or empty($_POST['tag'])){
		
		$currdb->query("INSERT INTO `".$currdb->prefix("shop")."` (item, num, deric, pic, price, type, outdate ) VALUES('".$_POST['name']."' , '".$_POST['number']."' , '".$_POST['derict']."' , '".$ServerFilename."' , '".$_POST['price']."' , '"	.$_POST['tag']."' , '".$_POST['downd']."' )");
		
		$temp = $currdb->query("SELECT `ino` FROM `".$currdb->prefix("shop")."` WHERE item = '".$_POST['name']."' ORDER BY `ino` DESC" );
		$good = $currdb->fetch_array($temp);
	
		header("location:edit_form.php?msg=error&ino=$good[0]");
		}

	else{
		$currdb->query("INSERT INTO `".$currdb->prefix("shop")."` (item, num, deric, pic, price, type, outdate ) VALUES('".$_POST['name']."' , '".$_POST['number']."' , '".$_POST['derict']."' , '".$ServerFilename."' , '".$_POST['price']."' , '"	.$_POST['tag']."' , '".$_POST['downd']."' )");

		header("location:addform.php?msg=gj");
		}
	}
else{
	header("location:addform.php?msg=nopic");
	}
?>
