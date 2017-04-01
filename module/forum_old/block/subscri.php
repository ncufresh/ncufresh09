<?
if (!defined("MAINFILE_INCLUDED"))
	exit();

function subscribe_board($dirname = null)
{
	if (!$GLOBALS["curruser"]->isguest())
	{
		$result = $GLOBALS["currdb"]->query("SELECT no, status FROM `".$GLOBALS["currdb"]->prefix("forum_subscribe")."` WHERE user_no='".$GLOBALS["curruser"]->uno."' and type='board'");

		$block = array();

		$block["type"] = "board";
		$block["desc"] = "看板";

		for ($i = 0;$tmp = $GLOBALS["currdb"]->fetch_array($result);$i++)
		{
			$tmp2 = new ForumObject("board", $tmp["no"]);

			$block["subscri"][$i]["no"] = $tmp2->board_no;

			$block["subscri"][$i]["title"] = $tmp2->title;

			$block["subscri"][$i]["num"] = $tmp2->numtopic;

			$block["subscri"][$i]["lasttime"] = date("Y-m-d H:i:s", $tmp2->lasttime);

			$result2 = $GLOBALS["currdb"]->query("SELECT topic_no FROM `".$GLOBALS["currdb"]->prefix("forum_topic")."` WHERE board_no='".$block["subscri"][$i]["no"]."' ORDER BY topic_no desc LIMIT 0, 1");

			$tmp2 = $GLOBALS["currdb"]->fetch_array($result2);

			$block["subscri"][$i]["status"] = ($tmp2["topic_no"] > $tmp["status"]) ? 1 : 0;
		}

		return $block;
	}
}

function subscribe_topic($dirname = null)
{
	if (!$GLOBALS["curruser"]->isguest())
	{
		$sql = "
			SELECT `ft`.`topic_no`, `ft`.`title`, `u`.`name`, `ft`.`lasttime`, `ft`.`numreply` as 'num'
			FROM `".$GLOBALS["currdb"]->prefix("forum_subscribe")."` fs
			INNER JOIN `".$GLOBALS['currdb']->prefix('forum_topic')."` ft ON `ft`.`topic_no`=`fs`.`no`
			INNER JOIN `".$GLOBALS['currdb']->prefix('user')."` u ON `u`.`uno`=`ft`.`poster_no`
			WHERE `fs`.`user_no`='".$GLOBALS["curruser"]->uno."' and `fs`.`type`='topic'
			ORDER BY `ft`.`lasttime` DESC
			";

		$result = $GLOBALS['currdb']->query($sql);

		$topic = array();
		while($vars = $GLOBALS['currdb']->fetch_array($result))
		{
			$vars['title'] = htmlencode(forum_substr($vars['title'], 17));
			$vars['name'] = htmlencode($vars['name']);
			$topic[] = $vars;
		}

		$block['topic'] = $topic;

		return $block;
		/*
		$result = $GLOBALS["currdb"]->query("SELECT no, status FROM `".$GLOBALS["currdb"]->prefix("forum_subscribe")."` WHERE user_no='".$GLOBALS["curruser"]->uno."' and type='topic'");

		$block = array();

		$block["type"] = "topic";
		$block["desc"] = "文章";

		for ($i = 0;$tmp = $GLOBALS["currdb"]->fetch_array($result);$i++)
		{
			$tmp2 = new ForumObject("topic", $tmp["no"]);

			$block["subscri"][$i]["no"] = $tmp2->topic_no;
				
			$block['subscri'][$i]['lasttime'] = $tmp2->lasttime;

			$block["subscri"][$i]["title"] = _substr($tmp2->title, 0, 10);

			$block["subscri"][$i]["num"] = $tmp2->numreply;

			$block["subscri"][$i]["lasttime"] = date("Y-m-d H:i:s", $tmp2->lasttime);

			$result2 = $GLOBALS["currdb"]->query("SELECT rely_no FROM `".$GLOBALS["currdb"]->prefix("forum_reply")."` WHERE topic_no='".$block["subscri"][$i]["no"]."' ORDER BY relpy_no desc LIMIT 0, 1");

			$tmp2 = $GLOBALS["currdb"]->fetch_array($result2);

			$block["subscri"][$i]["status"] = ($tmp2["reply_no"] > $tmp["status"]) ? 1 : 0;
		}
		return $block;
		 */
	}
}

function subscribe_reply($dirname = null)
{
	if (!$GLOBALS["curruser"]->isguest())
	{
		$query = "
			SELECT `fr`.`reply_no`, `ft`.`topic_no`, `ft`.`title`, `u`.`name`, `ft`.`lasttime`, `ft`.`numreply` as 'num'
			FROM `".$GLOBALS["currdb"]->prefix("forum_subscribe")."` fs
			INNER JOIN `".$GLOBALS['currdb']->prefix('forum_reply')."` fr ON `fr`.`reply_no`=`fs`.`no`
			INNER JOIN `".$GLOBALS['currdb']->prefix('forum_topic')."` ft ON `ft`.`topic_no`=`fr`.`topic_no`
			INNER JOIN `".$GLOBALS['currdb']->prefix('user')."` u ON `u`.`uno`=`ft`.`poster_no`
			WHERE `fs`.`user_no`='".$GLOBALS["curruser"]->uno."' and `fs`.`type`='reply'
			ORDER BY `ft`.`lasttime` DESC
			";

		$result = $GLOBALS['currdb']->query($query);

		$reply = array();
		while($vars=$GLOBALS['currdb']->fetch_array($result))
		{
			$vars['title'] = htmlencode(forum_substr($vars['title'], 10));
			$vars['name'] = htmlencode($vars['name']);
			$reply[] = $vars;
		}

		$block['reply'] = $reply;

		return $block;
	}
}

?>
