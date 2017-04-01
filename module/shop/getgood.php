<?php
require_once'../../mainfile.php';
$currtpl->setndisplay();
if(!$curruser->isguest())    //確認已登入
{

 $yourgood_resource=$currdb->query("SELECT * FROM `".$currdb->prefix("shop_buycar")."` car INNER  JOIN `".$currdb->prefix("shop")."` shop ON car.ino=shop.ino WHERE car.uid = '".$curruser->uid."'")  or die('抓不到使用者買的東西'); 

 $yourgood_2D_array = array();
 while($yourgood_1D_array = $currdb->fetch_array($yourgood_resource))
     array_push ($yourgood_2D_array,$yourgood_1D_array);
 $yourgood_num = sizeof($yourgood_2D_array);

$all=0;
for($u=0;$u<$yourgood_num;$u++)
{
  $all = $all + $yourgood_2D_array[$u]['price']*$yourgood_2D_array[$u]['much'];
}

if($all <= $curruser->coins)
{
 $hadbuygood_resource=$currdb->query("SELECT * FROM `".$currdb->prefix("shop_personal")."` personal INNER  JOIN `".$currdb->prefix("shop")."` shop ON personal.ino=shop.ino WHERE personal.uid = '".$curruser->uid."'")  or die('抓不到使用者買過的東西'); 

 $hadbuygood_2D_array = array();
 while($hadbuygood_1D_array = $currdb->fetch_array($hadbuygood_resource))
     array_push ($hadbuygood_2D_array,$hadbuygood_1D_array);
 $hadbuygood_num = sizeof($hadbuygood_2D_array);


 $money = 0;
 $money_p = 0;
 for($i=0; $i<$yourgood_num; $i++)
 {
   if($yourgood_2D_array[$i]['type']=='head'||$yourgood_2D_array[$i]['type']=='spacial')
   {
      $currdb->query("INSERT INTO `".$currdb->prefix("shop_personal")."` (uid,ino,much,type) 
   VALUES ('".$curruser->uid."','".$yourgood_2D_array[$i]['ino']."','1','".$yourgood_2D_array[$i]['type']."')")or die("未寫入資料庫");
	
	$currdb->query("DELETE FROM `".$currdb->prefix("shop_buycar")."` WHERE uid = '".$curruser->uid."' and ino = '".$yourgood_2D_array[$i]['ino']."'")or die("未從資料庫刪除");   
    
	$money = $money + $yourgood_2D_array[$i]['price'];
   } 



   if($yourgood_2D_array[$i]['type']=='puzzle_bag')
   {

	 $puzzle_buy_resource = $currdb->query("SELECT * FROM `".$currdb->prefix("shop_personal")."`  WHERE type = '".$yourgood_2D_array[$i]['ino']."'")or die("沒有抓出他買過的這種拼圖包裡的拼圖");
     $puzzle_2D_buy_arr = array();
  while($puzzle_1D_arr = $currdb->fetch_array($puzzle_buy_resource))
    array_push($puzzle_2D_buy_arr, $puzzle_1D_arr);
     $puzzle_num= sizeof ($puzzle_2D_buy_arr);  

     $puzzle_shop_re = $currdb->query("SELECT * FROM `".$currdb->prefix("shop")."` WHERE type = '".$yourgood_2D_array[$i]['ino']."'")or die("沒有抓出這種拼圖包的此種拼圖");	 
	 $puzzle_inshop = $currdb->num_rows($puzzle_shop_re);
	 $puzzle_shop_2D = array();
	 while($puzzle_shop_1D_arr = $currdb->fetch_array($puzzle_shop_re))
         {
		   $check = 0;
		   for($j=0;$j<$puzzle_inshop;$j++)
		   {
			for($k=0;$k<$puzzle_num;$k++)
			{
			 if($puzzle_shop_1D_arr['ino']!=$puzzle_2D_buy_arr[$k]['ino'] && $check==0)
			 {
		      $check = 1;
			  array_push($puzzle_shop_2D, $puzzle_shop_1D_arr);
             }
			}
		   }
         }	    
	 shuffle($puzzle_shop_2D); 
	 for($s=0;$s<$yourgood_2D_array[$i]['much'];$s++)
	 {	   
	 $currdb->query("INSERT INTO `".$currdb->prefix("shop_personal")."` (uid,ino,much,type) 
   VALUES ('".$curruser->uid."','".$puzzle_shop_2D[$s]['ino']."','1','".$puzzle_shop_2D[$s]['type']."')")or die(沒有將拼圖加入資料庫);
	 }
	 $currdb->query("DELETE FROM `".$currdb->prefix("shop_buycar")."` WHERE uid = '".$curruser->uid."' and ino = '".$yourgood_2D_array[$i]['ino']."'")or die("未從資料庫刪除");   
   
   $money_p = $money_p + $yourgood_2D_array[$i]['price']*$yourgood_2D_array[$i]['much'];
   }
 }
    $now = $curruser->coins - $money;
  	$now_p = $now - $money_p;
 $currdb->query("UPDATE `".$currdb->prefix("user")."` SET `coins` = '".$now_p."'   WHERE uid = '".$curruser->uid."'")or die("沒有加數量");
  header("location:../../edit_pfile.php");
 }

	if($all >$curruser->coins)
	 {
	   $noenough = $all - $curruser->coins;
	   echo "您尚不足$noenough,請取消購買一些商品喔";
	   header("Refresh:2; URL=car.php");
     }

}

else
 _savePage(URL.'/include/user.php?login_form=1');	
?>