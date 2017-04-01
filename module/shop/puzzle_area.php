<?php
require_once("../../mainfile.php");
exit();

if($curruser->isguest()) _savePage(URL.'/include/user.php?login_form=1');
else{

$p=(empty($_GET['ino']))?1:$_GET['ino'];

$result3=$currdb->query("SELECT * from `".$currdb->prefix("shop")."` WHERE type = '".$p."_all' ORDER BY `ino` ASC");
$all=$currdb->fetch_array($result3);

$result_check = $currdb->query("SELECT * from `".$currdb->prefix("shop_personal")."` WHERE type = '".$p."_all' AND uid = '".$curruser->uid."' ")or die("失敗");
$total_check = $currdb->num_rows($result_check);
if($total_check != 0){
	if($_GET['msg'] != "again") header("location:puzzle_finish.php?ino=$all[0]&prev=$p");
	else{
		$result=$currdb->query("SELECT * from `".$currdb->prefix("shop")."` WHERE type = 'puzzle_bag' ");

		$result_tem = array();
		$result_puz = array();
		$lazy = array();

		while($data=$currdb->fetch_array($result)){
			$data['deric'] = nl2br($data['deric']);
			array_push($result_tem, $data);
			}
	
		$result2=$currdb->query("SELECT * from `".$currdb->prefix("shop")."` WHERE type = '".$p."' ORDER BY `ino` ASC");
		$total = $currdb->num_rows($result2);
		while($puz=$currdb->fetch_array($result2)){
			$puz['deric'] = nl2br($puz['deric']);
			array_push($result_puz, $puz);
			}
	
		$block = array();
		for($i=1;$i<=$total;$i++){
			$block[$i]['h'] = mt_rand(-200, 540);
			$block[$i]['v'] = mt_rand(-100, 825);
			}
		for($i=$total+1;$i<=16;$i++){
			$block[$i]['h'] = mt_rand(-200, 540);
			$block[$i]['v'] = mt_rand(-500, -200);
			}

		$finish = "puzzle_finish.php?ino=$all[0]&prev=$p";

		$currtpl -> assign('puzzle_area',$result_tem);
		$currtpl -> assign('puzzle',$result_puz);
		$currtpl -> assign('block',$block);
		$currtpl -> assign('lazy_p',$finish);
		$currtpl -> assign('check',$total_check);
		$currtpl -> addjs(ROOT_PATH.'/module/'.$currmodule -> name.'/include/jquery-ui/development-bundle/jquery-1.3.2.js');
		$currtpl -> addjs(ROOT_PATH.'/module/'.$currmodule -> name.'/include/jquery-ui/development-bundle/ui/ui.core.js');
		$currtpl -> addjs(ROOT_PATH.'/module/'.$currmodule -> name.'/include/jquery-ui/development-bundle/ui/ui.draggable.js');
		$currtpl -> addjs(ROOT_PATH.'/module/'.$currmodule -> name.'/include/jquery-ui/development-bundle/ui/ui.droppable.js');
		$currtpl -> display('puzzle_area.tpl.htm');
		}
	}
	
else{

$result=$currdb->query("SELECT * from `".$currdb->prefix("shop")."` WHERE type = 'puzzle_bag' ");

$result_tem = array();
$result_puz = array();
$lazy = array();

while($data=$currdb->fetch_array($result)){
	$data['deric'] = nl2br($data['deric']);
	array_push($result_tem, $data);
	}
	
$result2=$currdb->query("SELECT * from `".$currdb->prefix("shop")."` WHERE type = '".$p."' ORDER BY `ino` ASC");
$total = $currdb->num_rows($result2);
while($puz=$currdb->fetch_array($result2)){
	$puz['deric'] = nl2br($puz['deric']);
	array_push($result_puz, $puz);
	}
	
$block = array();
for($i=1;$i<=$total;$i++){
	$block[$i]['h'] = mt_rand(-200, 540);
	$block[$i]['v'] = mt_rand(-100, 825);
	}
for($i=$total+1;$i<=16;$i++){
	$block[$i]['h'] = mt_rand(-200, 540);
	$block[$i]['v'] = mt_rand(-500, -200);
	}

$finish = "puzzle_finish.php?ino=$all[0]&prev=$p";



$currtpl -> assign('puzzle_area',$result_tem);
$currtpl -> assign('puzzle',$result_puz);
$currtpl -> assign('block',$block);
$currtpl -> assign('lazy_p',$finish);
$currtpl -> assign('check',$total_check);
$currtpl -> addjs(ROOT_PATH.'/module/'.$currmodule -> name.'/include/jquery-ui/development-bundle/jquery-1.3.2.js');
$currtpl -> addjs(ROOT_PATH.'/module/'.$currmodule -> name.'/include/jquery-ui/development-bundle/ui/ui.core.js');
$currtpl -> addjs(ROOT_PATH.'/module/'.$currmodule -> name.'/include/jquery-ui/development-bundle/ui/ui.draggable.js');
$currtpl -> addjs(ROOT_PATH.'/module/'.$currmodule -> name.'/include/jquery-ui/development-bundle/ui/ui.droppable.js');
$currtpl -> display('puzzle_area.tpl.htm');
}

}
?>
