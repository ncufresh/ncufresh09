<?php
require_once('../../mainfile.php');
$currtpl->setndisplay();
if(!$curruser->isguest())
{
  $buycar_resource=$currdb->query("SELECT * FROM `".$currdb->prefix("shop_buycar")."` car INNER JOIN `".$currdb->prefix("shop")."` shop ON car.ino=shop.ino WHERE car.uid = '".$curruser->uid."'") or die('抓不到使用者買的東西'); 
  $buycar_head_2D=array();
  $buycar_puzzle_bag_2D=array();
  $buycar_other_2D=array();
  while($buycar_1D=$currdb->fetch_array($buycar_resource))
  {
	 if($buycar_1D['type']=="head")
       array_push($buycar_head_2D,$buycar_1D);
	 if($buycar_1D['type']=="puzzle_bag")
       array_push($buycar_puzzle_bag_2D,$buycar_1D);
     if($buycar_1D['type']=="special")
       array_push($buycar_other_2D,$buycar_1D);
   }
}
else
 _savePage(URL.'/include/user.php?login_form=1');	
//$currdb->lose($db);
$currtpl -> assign('uid', $curruser->uid);
$currtpl -> assign('car_head_arr', $buycar_head_2D);
$currtpl -> assign('coins', $curruser->coins);
$currtpl -> assign('car_puzzle_bag_arr', $buycar_puzzle_bag_2D);
$currtpl -> assign('car_other_arr', $buycar_other_2D);
$currtpl -> display('car.tpl.htm');
?>