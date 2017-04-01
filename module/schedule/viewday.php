<?php

require_once '../../mainfile.php';

$_GET['type'] = 'day';
$block_handler = gethandler('block');
$c_block = $block_handler->getblockbyno(20)->fetch();

$pattern = '/([\d\D]*)<td [^>]*>([\D\d]*)<\/td>([!\D\d]*)/i';
$replace = '$2';
$c_block = preg_replace($pattern, $replace, $c_block);

$currtpl->assign('c_block', $c_block);

$currtpl->display('viewday.htm');

?>
