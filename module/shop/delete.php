<?php
require_once("../../mainfile.php");

$del_temp = $currdb->query("SELECT `pic` FROM `".$currdb->prefix("shop")."` WHERE ino = '".$_GET['ino']."' ");
$del_pic = $currdb->fetch_array($del_temp);

@unlink("./items_pic/$del_pic[0]");

$currdb->query("DELETE FROM `".$currdb->prefix("shop")."` WHERE ino = '".$_GET['ino']."'") or die("刪除失敗");

$currdb->query("DELETE FROM `".$currdb->prefix("shop_buycar")."` WHERE ino = '".$_GET['ino']."'") or die("刪除失敗");

header("location:index.php");

?>