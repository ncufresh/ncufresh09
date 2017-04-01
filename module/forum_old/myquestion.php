<?php

require_once '../../mainfile.php';

if($curruser->isguest()) _redirect();

$gg = gethandler('block');

$reply_block = $gg->getblockbyno(21)->fetch();
$topic_block = $gg->getblockbyno(8)->fetch();

$currtpl->assign('reply_block', $reply_block);
$currtpl->assign('topic_block', $topic_block);

$currtpl->display('myquestion.htm');

?>
