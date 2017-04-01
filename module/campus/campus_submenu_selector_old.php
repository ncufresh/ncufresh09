<?php
require_once("../../mainfile.php");
$currtpl->setndisplay();
/*if(isset($_GET['selector']))
	$menu_No = $_GET['selector'];
else
	$menu_No = $_GET['menu'];*/
/*
switch($menu_No){
	case 1://行政大樓
		$currtpl->addcss(ROOT_PATH.'/module/'.$currmodule->name.'/templates/styles/maps_admin.css');
		$campus_maps_content = $currtpl->fetch('maps_admin.tpl.php');
		break;
	case 2://中大景點
		$currtpl->addcss(ROOT_PATH.'/module/'.$currmodule->name.'/templates/styles/maps_campus_view.css');
		$campus_maps_content = $currtpl->fetch('maps_campus_view.tpl.php');
		break;
	case 3://系館位置
		$currtpl->addcss(ROOT_PATH.'/module/'.$currmodule->name.'/templates/styles/maps_depart.css');
		$campus_maps_content = $currtpl->fetch('maps_depart.tpl.php');
		break;
	case 4://自學資源
		$currtpl->addcss(ROOT_PATH.'/module/'.$currmodule->name.'/templates/styles/maps_learn.css');
		$campus_maps_content = $currtpl->fetch('maps_learn.tpl.php');
		break;
	case 5://運動場所
		$currtpl->addcss(ROOT_PATH.'/module/'.$currmodule->name.'/templates/styles/maps_sport.css');
		$campus_maps_content = $currtpl->fetch('maps_sport.tpl.php');
		break;
	case 6://全校地圖
		$currtpl->addcss(ROOT_PATH.'/module/'.$currmodule->name.'/templates/styles/maps_full.css');
		$campus_maps_content = $currtpl->fetch('maps_full.tpl.php');
		break;
}
/*$submenu_sql = $currdb->query("SELECT * FROM ".$currtpl->prefix("campus_menu")." CAMPUS_MENU, "
											  .$currtpl->prefix("campus_submenu")." CAMPUS_SUBMENU
							   WHERE CAMPUS_MENU.CMno = CAMPUS_SUBMENU.CMno AND CAMPUS_MENU.CMno");*/
/*$submenu_sql = $currdb->query("SELECT * FROM `".$currdb->prefix("campus_submenu")."` WHERE CMno='".$menu_No."'") or die("ba"); 		   
$submenu_contents=array();
while($submenu_sql_fetch=$currdb->fetch_array($submenu_sql))
	$submenu_contents[]=$submenu_sql_fetch;

$currtpl->assign('submenu_contents',$submenu_contents);
$sub_menu_block = $currtpl->fetch('submenu.tpl.php');

if(isset($_GET['selector'])){
	$currtpl->setndisplay();
	echo $sub_menu_block;
}

*/

?>