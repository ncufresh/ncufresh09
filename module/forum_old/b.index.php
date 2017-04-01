<?
require_once("./module.php");
require_once("../../mainfile.php");

$result = $currdb->query("SELECT * FROM`".$currdb->prefix("forum_group")."` ORDER BY priority ASC");

if ($currdb->num_rows($result) == 0)
	dies("目前沒有任何群組");

for ($i = 0;$tmp = $currdb->fetch_array($result);$i++)
{
	$forumgroup[$i] = new Object();
	$forumgroup[$i]->setvars($tmp);
}

for ($i = 0;$i < count($forumgroup);$i++)
{
	$result = $currdb->query("SELECT * FROM `".$currdb->prefix("forum_board")."` WHERE group_no='".$forumgroup[$i]->group_no."' ORDER BY priority ASC");

	for ($j = 0;$tmp = $currdb->fetch_array($result);$j++)
	{
		$forumboard[$j] = new Object();

		$forumboard[$j]->setvars($tmp);

		$result2 = $currdb->query("SELECT * FROM `".$currdb->prefix("forum_topic")."` WHERE board_no='".$forumboard[$j]->board_no."' ORDER BY topic_no DESC LIMIT 0, 3");

		$topic = array();

		for ($k = 0;$tmp = $currdb->fetch_array($result2);$k++)
		{

			$topic[$k] = new Object();

			$topic[$k]->setvars($tmp);

			$topic[$k]->titles = htmlencode(_substr($topic[$k]->title, 0, 14));

			$topic[$k]->lasttime = date("Y-m-d", $topic[$k]->lasttime);
		}

		if ($k > 0)
			$forumboard[$j]->topics = $topic;

		$forumboard[$j]->title = htmlencode($forumboard[$j]->title);

		$forumboard[$j]->posttime = date("Y-m-d H:i:s", $forumboard[$j]->posttime);
	}

	$currtpl->assign_by_ref("forumgroup", $forumgroup[$i]);
	$currtpl->assign_by_ref("forumboard", $forumboard);

	$currtpl->display("showgroup.htm");
}
?>
