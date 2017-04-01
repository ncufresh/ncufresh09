<?php
require_once("../../mainfile.php");
$currtpl->setndisplay();
if($curruser -> isguest() == 1) echo "要登入才可以購買喔";

else{
	$temp = $currdb->query("SELECT * FROM `".$currdb->prefix("shop")."` WHERE ino = '".$_GET['content2']."'");
	$good = $currdb->fetch_array($temp);
	
	if($good['num'] == 0) echo "商品已經沒了...";
	
	else{
		$result = $currdb->query("SELECT * FROM `".$currdb->prefix("shop_buycar")."` WHERE uid = '".$curruser->uid."' AND ino = '".$_GET['content2']."'") or die("失敗");
		if($currdb->num_rows($result) == 0){
			$currdb->query("INSERT INTO `".$currdb->prefix("shop_buycar")."` (uid, ino, much) VALUES( '".$curruser->uid."', '".$_GET['content2']."', '1')");
			echo "已加入購物車";
			}
		
		else{
			$user = $currdb->fetch_array($result);
			$user[2] = $user[2] + 1;
		$currdb->query("UPDATE `".$currdb->prefix("shop_buycar")."` SET much = '".$user[2]."' WHERE `uid` = '".$curruser->uid."' AND ino = '".$_GET['content2']."'");
		
			$good[num] = $good[num] - 1;
		
			$currdb->query("UPDATE `".$currdb->prefix("shop")."` SET num = '".$good[num]."' WHERE `ino` = '".$_GET['content2']."'");
		
			echo "有$user[2] 個 $good[item] 了";
			}
		}
	}
?>