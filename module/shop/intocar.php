<?php
require_once'../../mainfile.php';
if(!$curruser->isguest())    //確認已登入
{
$currtpl->setndisplay();
$currdb->query("INSERT INTO `".$currdb->prefix("shop_buycar")."` (uid,ino,much) 
					VALUES ('".$curruser->uid."','".$_POST['content_no']."','1')")or die("未寫入資料庫");

$name_resource = $currdb->query("SELECT * FROM `".$currdb->prefix("shop")."` WHERE ino = '".$_POST['content_no']."'");
$name_2D_array=array();
while($name_1D_array = $currdb->fetch_array($name_resource))
   array_push($name_2D_array, $name_1D_array);
 $name_num= sizeof ($name_2D_array);   

for($i=0;$i<$name_num;$i++)
{
   echo "您已將".$name_2D_array[$i]['item']."放入購物車了!"; 
   $name_2D_array[$i]['num'] = $name_2D_array[$i]['num']-1; 
$currdb->query("UPDATE `".$currdb->prefix("shop")."` SET `num` = '".$name_2D_array[$i]['num']."' WHERE ino = '".$name_2D_array[$i]['ino']."'")or die("沒有扣數量");
}
}

else
 _savePage(URL.'/include/user.php?login_form=1');	
?>