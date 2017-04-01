<?
require_once("./module.php");
require_once("../../mainfile.php");

$forumtopic = new ForumObject("topic", $_GET["no"]);

$forumboard = new ForumObject("board", $forumtopic->board_no);

if ($forumtopic->topic_no > 0 && $forumtopic->die == 0)
{
	$forumtopic->content = str_replace("\n", "<br />", $forumtopic->content);

	$forumtopic->posttime = date("D, d M Y H:i:s + 0800", $forumtopic->posttime);

	$currtpl->echoxml();

	echo "<rss version=\"2.0\">\n";

	echo "<channel>\n";

	echo "<title>".htmlencode($currconfig->site_name."-".$forumboard->title."-".$forumtopic->title)."</title>\n";

	echo "<description>".htmlencode($forumboard->title)."</description>\n";

	echo "<link>".htmlencode("viewtopic.php?no=".$forumtopic->topic_no)."</link>\n";

	$criteria = new CriteriaCompo(new Criteria("topic_no", $forumtopic->topic_no));

	$result = $currdb->query("SELECT * FROM `".$currdb->prefix("forum_reply")."` WHERE ".$criteria->render()." ORDER BY reply_no ASC");

	for ($i = 0;$tmp = $currdb->fetch_array($result);$i++)
	{
		$forumreply[$i] = new Object();
		$forumreply[$i]->setvars($tmp);
	}

	for ($i = 0;$i < count($forumreply);$i++)			// modify data from each topic
	{
		$criteria = new CriteriaCompo(new Criteria("reply_no", $forumreply[$i]->reply_no));

		$forumreply[$i]->content = str_replace("\n", "<br />", $forumreply[$i]->content);

		$forumreply[$i]->posttime = date("D, d M Y H:i:s +0800", $forumreply[$i]->posttime);

		$poster = $curruser->u_handler->getuserbyno($forumreply[$i]->poster_no);

		echo "<item>\n";

		echo "<guid isPermaLink=\"true\">".htmlencode("viewtopic.php?no=".$forumtopic->topic_no)."</guid>\n";

		echo "<title>Re: ".htmlencode($forumtopic->title)."</title>\n";

		echo "<link>".htmlencode("viewtopic.php?no=".$forumtopic->topic_no)."</link>\n";

		echo "<author>".htmlencode($poster->name)."</author>\n";

		echo "<pubDate>".htmlencode($forumreply[$i]->posttime)."</pubDate>\n";

		echo "<description>".htmlencode($forumreply[$i]->content)."</description>\n";

		echo "</item>\n";
	}

	echo "</channel>\n";

	echo "</rss>\n";
}
?>
