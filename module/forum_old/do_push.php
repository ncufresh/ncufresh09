<?
require_once("../../mainfile.php");

if ($curruser->haveperm($curruser->p_handler->getpermvalid()))
{
	if (isset($_POST["dopush"]))			// push by post (not ajax)
	{
		$forumreply = new ForumObject("reply", $_POST["rno"]);

		if ($forumreply->reply_no <= 0)
			echo "找不到文章";
		else if (!empty($_POST["content"]))
		{
			$posttime = mktime();

			$currdb->query("INSERT INTO `".$currdb->prefix("forum_push")."` (content, reply_no, poster_no, posttime) VALUES ('".$_POST["content"]."', '".$forumreply->reply_no."', '".$curruser->uno."', '".$posttime."')");

			_redirect("viewtopic.php?no=".$forumreply->topic_no);
		}
	}
	else if (isset($_POST["rmpush"]))		// remove push by post (not ajax)
	{
		$forumpush = new ForumObject("push", $_POST["pno"]);

		$forumreply = new ForumObject("reply", $forumpush->reply_no);

		$forumtopic = new ForumObject("topic", $forumreply->topic_no);

		$forumboard = new ForumObject("board", $forumtopic->board_no);

		$bm = bm($forumboard);

		if ($forumpush->push_no <= 0)
			echo "找不到推文";
		else if (($curruser->uno != $forumpush->poster_no) && !$bm)
			echo "找不到推文";
		else
		{
			$currdb->query("DELETE FROM `".$currdb->prefix("forum_push")."` WHERE push_no='".$forumpush->push_no."'");
			echo "已刪除推文";
		}
	}
}
else
	_redirect();
?>
