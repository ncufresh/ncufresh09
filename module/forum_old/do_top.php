<?
require_once("../../mainfile.php");

$currtpl->setndisplay();						// (ajax)

if (isset($_POST["toptopic"]))
{
	$forumtopic = new ForumObject("topic", $_POST["tno"]);
	$forumboard = new ForumObject("board", $forumtopic->board_no);

	$bm = bm($forumboard);

	if ($forumtopic->topic_no <= 0)
		echo "找不到主題";
	else if (!$bm)
		echo "找不到主題";
	else
	{
		$forumtopic->type = (intval($forumtopic->type) & intval(TOPIC_TYPE_TOP)) ? 0 : TOPIC_TYPE_TOP;

		$currdb->query("UPDATE `".$currdb->prefix("forum_topic")."` SET type='".$forumtopic->type."' WHERE topic_no='".$forumtopic->topic_no."'");
	}
}

?>
