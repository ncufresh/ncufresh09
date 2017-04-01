<?php 
require_once("../../mainfile.php");
if($_GET['msg'] == "error") echo "有空格，重填";
$result=$currdb->query("SELECT * FROM `".$currdb->prefix("shop")."` WHERE ino = '".$_GET['ino']."'") or die("失敗啦");

$result_tem = array();
$check = array();
while($data=$currdb->fetch_array($result)){
		$data['deric'] = nl2br($data['deric']);
		array_push($result_tem, $data);
		}
		
$re_result=$currdb->query("SELECT * from `".$currdb->prefix("shop")."` WHERE type = 'puzzle_bag' ORDER BY `ino` DESC");
$re_result_tem = array();
	
while($re_data=$currdb->fetch_array($re_result)){
	$re_data['deric'] = nl2br($re_data['deric']);
	array_push($re_result_tem, $re_data);
	}
		

	$currtpl -> assign('contents',$result_tem);
	$currtpl -> assign('re_contents',$re_result_tem);
	$currtpl -> assign('checks',$check);
	$currtpl -> display('edit_form.tpl.htm');

?>
