<?
require_once("../../mainfile.php");

if (!$curruser->isguest())
{
	$currtpl->setndisplay();						// (ajax)

	if (isset($_POST["subscr_board"]) || isset($_POST["subscr_topic"]))
	{
		$type = (isset($_POST["subscr_board"])) ? "board" : "topic";

		$desc = (isset($_POST["subscr_board"])) ? "看板" : "文章";
		
		/*
		$forumobject = new ForumObject($type, $_POST["no"]);

		if ($forumobject->{$type."_no"} <= 0)
			echo "找不到".$desc;
		else
		{
			$result = $currdb->query("SELECT no FROM `".$currdb->prefix("forum_subscribe")."` WHERE user_no='".$curruser->uno."' and type='".$type."' and no='".$forumobject->{$type."_no"}."'");

			if ($currdb->num_rows($result) <= 0)
				$currdb->query("INSERT INTO `".$currdb->prefix("forum_subscribe")."` (user_no, type, no) VALUES ('".$curruser->uno."', '".$type."', '".$forumobject->{$type."_no"}."')");
		}*/

		if(!func_do_subscr($type, $_POST['no'])) echo "找不到".$desc;
	}
	else if (isset($_POST["unsubscr_board"]) || isset($_POST["unsubscr_topic"]))
	{
		$type = (isset($_POST["unsubscr_board"])) ? "board" : "topic";

		$desc = (isset($_POST["unsubscr_board"])) ? "看板" : "文章";
		
		/*
		$forumobject = new ForumObject($type, $_POST["no"]);

		if ($forumobject->{$type."_no"} <= 0)
			echo "找不到".$desc;
		else
			$currdb->query("DELETE FROM `".$currdb->prefix("forum_subscribe")."` WHERE user_no='".$curruser->uno."' and type='".$type."' and no='".$forumobject->{$type."_no"}."'");
		*/

		if(!func_do_unsubscr($type, $_POST['no'])) echo "找不到".$desc;
	}
}
else
	_redirect();
?>
