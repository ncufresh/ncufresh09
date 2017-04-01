<?php
require_once("../../mainfile.php");

$result=$currdb->query("SELECT * from `".$currdb->prefix("shop")."` WHERE type = 'puzzle' ");
$result_tem = array();

while($data=$currdb->fetch_array($result)){
	$data['deric'] = nl2br($data['deric']);
	array_push($result_tem, $data);
	}
	
$currtpl -> assign('puzzle',$result_tem);
$currtpl -> addjs(ROOT_PATH.'/module/'.$currmodule -> name.'/include/jquery-ui/development-bundle/jquery-1.3.2.js');
$currtpl -> addjs(ROOT_PATH.'/module/'.$currmodule -> name.'/include/jquery-ui/development-bundle/ui/ui.core.js');
$currtpl -> addjs(ROOT_PATH.'/module/'.$currmodule -> name.'/include/jquery-ui/development-bundle/ui/ui.draggable.js');
//$currtpl -> addjs(ROOT_PATH.'/module/'.$currmodule -> name.'/include/go_p.js');
$currtpl -> display('puzzle.tpl.htm');
?>