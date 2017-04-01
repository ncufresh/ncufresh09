<?
require_once("../../mainfile.php");

if (!$curruser->isguest())
{
	$currtpl->setndisplay();						// (ajax)

	$_POST["no"] = intval($_POST["no"]);

	if (isset($_POST["subscr_topic"]) || isset($_POST["unsubscr_topic"]))
	{
		$type = "topic";
		$key = "tno";
		$desc = "主題";
	}
	else
	{
		$type = "question";
		$key = "qno";
		$desc = "問題";
	}

	if (isset($_POST["subscr_topic"]) || isset($_POST["subscr_qanda"]))
	{
		$result = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_".$type)."` WHERE ".$key."='".$_POST["no"]."'");

		if ($currdb->num_rows($result) <= 0)
			echo "找不到".$desc;
		else
		{
			$result = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_subscribe")."` WHERE user_no='".$curruser->uno."' and type='".$type."' and no='".$_POST["no"]."'");

			if ($currdb->num_rows($result) <= 0)
				$currdb->query("INSERT INTO `".$currdb->prefix("wiki_subscribe")."` (user_no, type, no) VALUES ('".$curruser->uno."', '".$type."', '".$_POST["no"]."')");
		}
	}
	else if (isset($_POST["unsubscr_topic"]) || isset($_POST["unsubscr_qanda"]))
	{
		$result = $currdb->query("SELECT * FROM `".$currdb->prefix("wiki_".$type)."` WHERE ".$key."='".$_POST["no"]."'");

		if ($currdb->num_rows($result) <= 0)
			echo "找不到".$desc;
		else
			$currdb->query("DELETE FROM `".$currdb->prefix("wiki_subscribe")."` WHERE user_no='".$curruser->uno."' and type='".$type."' and no='".$_POST["no"]."'");
	}
}
else
	_redirect();
?>
