<?php
require_once'../../mainfile.php';
if(!$curruser->isguest())    //確認已登入
{
$currtpl->setndisplay();
$currdb->query("DELETE FROM `".$currdb->prefix("shop_buycar")."` WHERE uid = '".$curruser->uid."' and ino = '".$_POST['content_no']."'")or die("未從資料庫刪除");

$num_resource = $currdb->query("SELECT * FROM `".$currdb->prefix("shop")."` WHERE ino = '".$_POST['content_no']."'");
$num_2D_array=array();
while($num_1D_array = $currdb->fetch_array($num_resource))
   array_push($num_2D_array, $num_1D_array);
 $num_num= sizeof ($num_2D_array);   

for($i=0;$i<$num_num;$i++)
{
   echo "您已將".$num_2D_array[$i]['item']."丟離購物車了!"; 
   $num_2D_array[$i]['num'] = $num_2D_array[$i]['num']+1; 
$currdb->query("UPDATE `".$currdb->prefix("shop")."` SET `num` = '".$num_2D_array[$i]['num']."' WHERE ino = '".$num_2D_array[$i]['ino']."'")or die("沒有加數量");
}
}

else
 _savePage(URL.'/include/user.php?login_form=1');	
?>