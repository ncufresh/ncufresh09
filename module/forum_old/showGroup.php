<?php

require_once '../../mainfile.php';

$gno = intval($_GET['gno']);

if($gno == 8) $currtpl->display('deplist.htm');
else if($gno != 9) _redirect('.');
else if($gno == 9) :

gno_currsite($gno);

$forumgroup = new ForumObject('group', $gno);

$result = $currdb->query("SELECT * FROM `".$currdb->prefix("forum_group")."`WHERE `parents`='".$gno."'");

if($currdb->num_rows($result) == 0) $result =$currdb->query("SELECT * FROM `".$currdb->prefix("forum_group")."`WHERE `group_no`='".$gno."'");

$forumgroups = array();
while($vars = $currdb->fetch_array($result))
{
	$result2 = $currdb->query("SELECT * FROM `".$currdb->prefix("forum_board")."` WHERE group_no='".$vars['group_no']."' ORDER BY `board_no`, priority ASC");
	$forumboards = array();
	while($tmp = $currdb->fetch_array($result2))
	{
		$board = new Object();
		$board->setvars($tmp);
		$forumboards[] = $board;
	}
	$vars['forumboards'] = $forumboards;
	
	$group = new Object();
	$group->setvars($vars);

	$forumgroups[] = $group;
}

$currtpl->assign('forumgroup', $forumgroup);
$currtpl->assign('forumgroups', $forumgroups);

$currtpl->display('showGroup.htm');

endif;

?>
