<?php
require_once("./mainfile.php");

$fuckok = true;

$block_handler =& gethandler("block");

$currtpl->assign('news_block', $block_handler->getblockbyno(24)->fetch());
$currtpl->assign('newt_topic', $block_handler->getblockbyno(11)->fetch());
$currtpl->assign('life_block', $block_handler->getblockbyno(25)->fetch());
$currtpl->assign('lnk_block', $block_handler->getblockbyno(29)->fetch());
$currtpl->assign('video', $block_handler->getblockbyno(31)->fetch());

$currtpl->display('indexs.htm');
?>
