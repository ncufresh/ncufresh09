<?php
require_once'../../mainfile.php';
if(!$curruser->isguest())    //確認已登入
{
$currtpl->setndisplay();
if($_POST['content_much']==""||$_POST['content_much']=="0")
{
  $plus_num_resource=$currdb->query("SELECT * FROM `".$currdb->prefix("shop_buycar")."` WHERE ino = '".$_POST ['content_no']."' and uid = '".$curruser->uid."'");              //抓原先他買的值
  $plus_num_2D=array();
 while($plus_num_1D_array = $currdb->fetch_array($plus_num_resource))
    array_push($plus_num_2D, $plus_num_1D_array);
  $plus_num_num= sizeof ($plus_num_2D);     

  
  $currdb->query("DELETE FROM `".$currdb->prefix("shop_buycar")."` WHERE uid = '".$curruser->uid."' and ino = '".$_POST['content_no']."'")or die("未從資料庫刪除"); //從資料庫刪除


 $num_resource = $currdb->query("SELECT * FROM `".$currdb->prefix("shop")."` WHERE ino = '".$_POST ['content_no']."'");
 $num_2D_array=array();
 while($num_1D_array = $currdb->fetch_array($num_resource))
    array_push($num_2D_array, $num_1D_array);
  $num_num= sizeof ($num_2D_array);   



    echo "您已將".$num_2D_array[0]['item']."丟離購物車了!"; 
    $num_2D_array[0]['num'] = $num_2D_array[0]['num']+$plus_num_2D[0]['much']; 
 $currdb->query("UPDATE `".$currdb->prefix("shop")."` SET `num` = '".$num_2D_array[0]['num']."'   WHERE ino = '".$num_2D_array[0]['ino']."'")or die("沒有加數量");

}

else
{
  $shop_p_re = $currdb->query("SELECT * FROM `".$currdb->prefix("shop_personal")."` WHERE type = '".$_POST ['content_no']."' and uid = '".$curruser->uid."'");
$shop_p_num=$currdb->num_rows($shop_p_re);
	$buy = 16 - $shop_p_num;
	if($_POST['content_much'] > $buy)
       $_POST['content_much'] = $buy;
  
  $plus_num_resource=$currdb->query("SELECT * FROM `".$currdb->prefix("shop_buycar")."` WHERE ino = '".$_POST ['content_no']."' and uid = '".$curruser->uid."'");              //抓原先他買的值
  $plus_num_2D=array();
 while($plus_num_1D_array = $currdb->fetch_array($plus_num_resource))
    array_push($plus_num_2D, $plus_num_1D_array);
  $plus_num_num= sizeof ($plus_num_2D);     

  $currdb->query("UPDATE `".$currdb->prefix("shop_buycar")."` SET `much` = '".$_POST['content_much']."'   WHERE ino = '".$_POST ['content_no']."' and uid = '".$curruser->uid."'")or die("未變更他的值"); 

 $num_resource = $currdb->query("SELECT * FROM `".$currdb->prefix("shop")."` WHERE ino = '".$_POST ['content_no']."'");
 $num_2D_array=array();
 while($num_1D_array = $currdb->fetch_array($num_resource))
    array_push($num_2D_array, $num_1D_array);
  $num_num= sizeof ($num_2D_array);   

$plus_num_2D[0]['much']=$_POST ['content_much']-$plus_num_2D[0]['much'];
    echo "您已改變".$num_2D_array[0]['item']."的數量了!"; 
    $num_2D_array[0]['num'] = $num_2D_array[0]['num']+$plus_num_2D[0]['much']; 
	

 $currdb->query("UPDATE `".$currdb->prefix("shop")."` SET `num` = '".$num_2D_array[0]['num']."'   WHERE ino = '".$num_2D_array[0]['ino']."'")or die("沒有加數量");

}

}

else
 _savePage(URL.'/include/user.php?login_form=1');	
?>