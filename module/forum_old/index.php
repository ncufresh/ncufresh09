<?php

require_once '../../mainfile.php';

$gg =& gethandler('block');
$toptopic = $gg->getblockbyno(22)->fetch();
$hotboard = $gg->getblockbyno(26)->fetch();
$newtopic = $gg->getblockbyno(11)->fetch();

$currtpl->assign('toptopic', $toptopic);
$currtpl->assign('hotboard', $hotboard);
$currtpl->assign('newtopic', $newtopic);

$down = array();
$sql = "SELECT `board_no`, `name` FROM `".$currdb->prefix('forum_board')."` WHERE `group_no`='10'";
$result = $currdb->query($sql);
while($vars = $currdb->fetch_array($result))
{
	$sql = "SELECT `title`, `topic_no` FROM `".$currdb->prefix('forum_topic')."` WHERE `board_no`='{$vars['board_no']}' AND `die`='0' ORDER BY `posttime` DESC LIMIT 0, 5";

	$result2 = $currdb->query($sql);
	while($vars2 = $currdb->fetch_array($result2))
	{
		$vars2['title'] = forum_substr($vars2['title'], 15);
		$vars['topic'][] = $vars2;
	}

	$down[] = $vars;
}

$currtpl->assign('down', $down);
$currtpl->display('index.htm');

?>
