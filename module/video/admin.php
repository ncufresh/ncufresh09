<?php
require_once("../../mainfile.php");
if(!$currmodule->isadmin($curruser))
    exit();


$sql = "SELECT * FROM `workv1_video` ORDER BY `no` DESC";
$search = $currdb -> query($sql);
$data_array = array();

while ($data_get = $currdb -> fetch_array($search))
{
	$data_get['content'] = nl2br($data_get['content']);
	
	array_push($data_array, $data_get);
}

if ($currmodule->isadmin($curruser))
    $perm = true;
$currtpl -> assign('perm', $perm);
$currtpl -> addjs(ROOT_PATH.'/module/'.$currmodule->name.'/templates/jquery-1.3.2-vsdoc2.js');
$currtpl -> addjs(ROOT_PATH.'/module/'.$currmodule->name.'/templates/js.js');
$currtpl -> assign('data', $data_array);
$currtpl -> display('admin.tpl.htm');
?>
