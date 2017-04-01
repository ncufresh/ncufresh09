<?
if (!defined("MAINFILE_INCLUDED"))
	exit();

function forum_hottopic($dirname = null)
{
	$block = array();

	$block["desc"] = "十大熱門話題";

	$result = $GLOBALS["currdb"]->query("SELECT topic_no, title, numread FROM `".$GLOBALS["currdb"]->prefix("forum_topic")."` ORDER BY numread DESC LIMIT 0, 10");

	for ($i = 0;$tmp = $GLOBALS["currdb"]->fetch_array($result);$i++)
	{
		$block["topten"][$i] = $tmp;
		$block["topten"][$i]["no"] = $i + 1;
		$block["topten"][$i]["titles"] = _substr($block["topten"][$i]["title"], 0, 10)."...";
		$block["topten"][$i]["num"] = $tmp["numread"];
	}

	return $block;
}

function forum_hotreply($dirname = null)
{
	$block = array();

	$block["desc"] = "十大熱門回覆";

	$result = $GLOBALS["currdb"]->query("SELECT topic_no, title, numreply FROM `".$GLOBALS["currdb"]->prefix("forum_topic")."` ORDER BY numreply DESC LIMIT 0, 10");

	for ($i = 0;$tmp = $GLOBALS["currdb"]->fetch_array($result);$i++)
	{
		$block["topten"][$i] = $tmp;
		$block["topten"][$i]["no"] = $i + 1;
		$block["topten"][$i]["titles"] = _substr($block["topten"][$i]["title"], 0, 10)."...";
		$block["topten"][$i]["num"] = $tmp["numreply"];
	}

	return $block;	
}

function forum_hotnewt($dirname = null)
{
	$block = array();

	$block["p"] = 3;
	$block["desc"] = "最新發表主題";

	$result = $GLOBALS["currdb"]->query("SELECT `t`.`topic_no`, `t`.`title`, `t`.`numreply`, `b`.`name` FROM `".$GLOBALS["currdb"]->prefix("forum_topic")."` t INNER JOIN `".$GLOBALS["currdb"]->prefix("forum_board")."` b ON t.board_no=b.board_no WHERE `t`.`die`='0' AND `b`.`name` !='TEST' ORDER BY topic_no DESC LIMIT 0, 5");

	for ($i = 0;$tmp = $GLOBALS["currdb"]->fetch_array($result);$i++)
	{
		$block["topten"][$i] = $tmp;
		$block["topten"][$i]["no"] = $i + 1;
		$block['topten'][$i]['titles'] = '[' . $block['topten'][$i]['name'] . '] ' . $block['topten'][$i]['title'];
		$block['topten'][$i]['titles'] = _substrfix($block['topten'][$i]['titles'], 26);
		$block["topten"][$i]["num"] = $tmp["numreply"];
	}

	return $block;
}

function toptenfix($dirname = null)
{
	$block = array();

	$query = "
		SELECT `ft`.`topic_no`, `ft`.`title`, `ft`.`numreply`, `fb`.`name` as 'board', `fb`.`board_no`
		FROM `".$GLOBALS["currdb"]->prefix("forum_topic")."` ft
		INNER JOIN `".$GLOBALS['currdb']->prefix('forum_board')."` fb ON `fb`.`board_no`=`ft`.`board_no`
		WHERE `ft`.`die`='0' && `ft`.`lasttime` >= '".(time()-86400*3)."' AND `fb`.`name`!='TEST'
		ORDER BY `ft`.`numreply`  DESC , `posttime` DESC LIMIT 0, 8";

	$result = $GLOBALS["currdb"]->query($query);

	for ($i = 0;$tmp = $GLOBALS["currdb"]->fetch_array($result);$i++)
	{
		$block["topten"][$i] = $tmp;
		$block["topten"][$i]["no"] = $i + 1;
		$block["topten"][$i]["title"] = forum_substr($block["topten"][$i]["title"], 16);
		$block["topten"][$i]["num"] = $tmp["numreply"];
	}

	return $block;	
}

function hotboard($dirname = null)
{
	global $currdb;

	$block = array();

	// lasttime 一日內的文章計算篇數 由大到小
	$sql = "SELECT fb.`name`, fb.`board_no` as 'no', count(fb.`board_no`) as count FROM `".$currdb->prefix('forum_board')."` fb INNER JOIN `".$currdb->prefix('forum_topic')."` ft ON ft.`board_no`=fb.`board_no` AND ft.`lasttime` >= '".(time()-86400)."' AND `fb`.`name`!='TEST' GROUP BY fb.`board_no` ORDER BY `count` DESC, fb.`lasttime` DESC LIMIT 0, 5";

	//$sql = "SELECT `name`, `board_no` as 'no' FROM `".$currdb->prefix('forum_board')."` WHERE `lasttime` >= '".(time()-86400*5)."' ORDER BY `numtopic` DESC LIMIT 0, 6";

	$result = $currdb->query($sql);

	while($vars = $currdb->fetch_array($result))
	{
		$block['board'][] = $vars;
	}

	return $block;
}

?>
