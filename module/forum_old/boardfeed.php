<?
require_once("./module.php");
require_once("../../mainfile.php");

$forumboard = new ForumObject("board", $_GET["no"]);

if ($forumboard->board_no > 0)
{
	$currtpl->echoxml();

	echo "<rss version=\"2.0\">\n";

	echo "<channel>\n";

	echo "<title>".htmlencode($currconfig->site_name."-".$forumboard->title)."</title>\n";

	echo "<description>".htmlencode($forumboard->title)."</description>\n";

	echo "<link>".htmlencode("viewboard.php?no=".$forumboard->board_no)."</link>\n";

	$criteria = new CriteriaCompo(new Criteria("board_no", $forumboard->board_no));

	$result = $currdb->query("SELECT * FROM `".$currdb->prefix("forum_topic")."` WHERE ".$criteria->render()." and type & '".TOPIC_TYPE_TOP."' ORDER BY topic_no DESC");

	for ($i = 0;$tmp = $currdb->fetch_array($result);$i++)
	{
		$forumtopic[$i] = new Object();
		$forumtopic[$i]->setvars($tmp);
	}

	$result = $currdb->query("SELECT * FROM `".$currdb->prefix("forum_topic")."` WHERE ".$criteria->render()." and type ^ '".TOPIC_TYPE_TOP."' ORDER BY topic_no DESC");

	for ($i = 0;$tmp = $currdb->fetch_array($result);$i++)
	{
		$forumtopic[$i] = new Object();
		$forumtopic[$i]->setvars($tmp);
	}

	for ($i = 0;$i < count($forumtopic);$i++)				// modify data from each topic
	{
		$criteria = new CriteriaCompo(new Criteria("topic_no", $forumtopic[$i]->topic_no));

		$result = $currdb->query("SELECT COUNT(reply_no) FROM `".$currdb->prefix("forum_reply")."` WHERE ".$criteria->render());

		$tmp = $currdb->fetch_array($result);

		$forumtopic[$i]->numreply = $tmp[0];

		$forumtopic[$i]->title = title_type($forumtopic[$i]->title, $forumtopic[$i]->type);

		$forumtopic[$i]->content = str_replace("\n", "<br />", $forumtopic[$i]->content);

		$forumtopic[$i]->posttime = date("D, d M Y H:i:s +0800", $forumtopic[$i]->posttime);

		$poster = $curruser->u_handler->getuserbyno($forumtopic[$i]->poster_no);

		echo "<item>\n";

		echo "<guid isPermaLink=\"true\">".htmlencode("viewtopic.php?no=".$forumtopic[$i]->topic_no)."</guid>\n";

		echo "<title>".htmlencode($forumtopic[$i]->title)."</title>\n";

		echo "<link>".htmlencode("viewtopic.php?no=".$forumtopic[$i]->topic_no)."</link>\n";

		echo "<category>empty</category>\n";

		echo "<author>".htmlencode($poster->name)."</author>\n";

		echo "<pubDate>".htmlencode($forumtopic[$i]->posttime)."</pubDate>\n";

		echo "<description>".htmlencode($forumtopic[$i]->content)."</description>\n";

		echo "</item>\n";
	}

	echo "</channel>\n";

	echo "</rss>\n";
}
?>
