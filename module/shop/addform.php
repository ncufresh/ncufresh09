<?php
require_once("../../mainfile.php");
if(!$currmodule->isadmin($curruser))
    exit();

if($_GET['msg'] == "error") echo "有空格，請重填<br /><br />";
if($_GET['msg'] == "gj") echo "新增完成<br /><br />";
if($_GET['msg'] == "nopic") echo "圖勒<br /><br />";

$result=$currdb->query("SELECT * from `".$currdb->prefix("shop")."` WHERE type = 'puzzle_bag' ORDER BY `ino` DESC");
$result_tem = array();
	
while($data=$currdb->fetch_array($result)){
	$data['deric'] = nl2br($data['deric']);
	array_push($result_tem, $data);
	}

$currtpl -> assign('contents',$result_tem);
$currtpl -> display('addform.tpl.htm');
?>
