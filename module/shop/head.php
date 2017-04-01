<?php
require_once'../../mainfile.php';
$currtpl->setndisplay();
if(!$curruser->isguest())    //確認已登入
{

 $head_1D_resource = $currdb->query("SELECT * FROM `".$currdb->prefix("shop")."` WHERE 
                                     type = 'head' AND ino != '4' AND ino!='5' ORDER BY `ino` ASC"); //從"shop"裡抓取type為頭像的資料 此為resource
 $head_display_2D_array = array();  //設定一個存放頭像資料的陣列

 
 while($head_1D_array = $currdb->fetch_array($head_1D_resource))  //將來源用fetch_array放入1D陣列
  	array_push($head_display_2D_array, $head_1D_array);  //再將1D陣列一行行擺進2D陣列 
 $head_num = $currdb->num_rows($head_1D_resource);   

  $shop_p_source = $currdb->query("SELECT * FROM `".$currdb->prefix("shop_personal")."` WHERE 
                                   uid ='".$curruser->uid."'"); //將使用者買過的東西全部取出
  $shop_p_head_2D_array = array(); //設定一個存放來自使用者已買過的東西的2D陣列
 
 while($shop_p_head_1D_array = $currdb->fetch_array($shop_p_source)) //將來源fetch進1D陣列 
    array_push($shop_p_head_2D_array,$shop_p_head_1D_array);  //再將1D陣列一行行擺進2D陣列
 $shop_p_num= sizeof ($shop_p_head_2D_array);   


  $buycar_source = $currdb->query("SELECT * FROM `".$currdb->prefix("shop_buycar")."` WHERE 
                                  uid ='".$curruser->uid."'");  //來自購物車裡此人選購的商品
  $buycarhead_2D_array = array();  //設定一個2D陣列來存放
 
 while($buycarhead_1D_array = $currdb->fetch_array($buycar_source)) 
    array_push($buycarhead_2D_array,$buycarhead_1D_array);
 $buycar_num= sizeof ($buycarhead_2D_array);

 
 for($i=0;$i<$head_num;$i++)
  {
    $check=0;
    for($j=0;$j<$shop_p_num;$j++)
	{
	  if($shop_p_head_2D_array[$j]['ino']==$head_display_2D_array[$i]['ino'])
	    $check=1;
	}
	for($k=0;$k<$buycar_num;$k++)
	{
	  if($buycarhead_2D_array[$k]['ino']==$head_display_2D_array[$i]['ino'])
	    $check=1;	 
	}
    $check_arr[$i]=$check;
  }
		

}

else
 _savePage(URL.'/include/user.php?login_form=1');	
 
if($currmodule->isadmin($curruser))  $admin=1;
//$currdb->lose($db);
$currtpl -> assign('uid', $curruser->uid);
$currtpl -> assign('admin',$admin);
$currtpl -> assign('page',$page_tem);
$currtpl -> assign('check_arr', $check_arr);
$currtpl -> assign('coins', $curruser->coins);
$currtpl -> assign('head_arr', $head_display_2D_array);
$currtpl -> display('head.tpl.htm');
?>
