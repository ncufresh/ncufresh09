<?php

require_once '../../mainfile.php';

if($curruser->isguest()) exit();

$pics = elf_get($_GET['uno']);

$currtpl->assign('pics_num', count($pics));
$currtpl->assign('pics', $pics);
$currtpl->display('elfroom.htm');

?>
