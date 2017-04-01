<?php
require_once('../../mainfile.php');
require_once('tq_block.php');

$currtpl -> assign('currtq', $currdb -> fetch_array($currdb -> query("SELECT * FROM `".($currdb -> prefix("qa_tenquest"))."` WHERE `TQno` = '".((intval($_GET['TQno']) > 0) ? intval($_GET['TQno']) : 1)."'")));
$currtpl -> assign('tq_list_arr', $tq_list_arr);

$currtpl -> display('view_tq.tpl.htm');
?>