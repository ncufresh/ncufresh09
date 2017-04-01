<?
require_once("../../../mainfile.php");

if (!$curruser->isguest())
{
	if (isset($_POST["subscri_update"]) && isset($_POST["no"]))
	{
		$type = (isset($_POST["board"])) ? "board" : "topic";

		$ctype = (isset($_POST["board"])) ? "topic" : "reply";

		$criteria = new CriteriaCompo(new Criteria("user_no", $curruser->uno));

		$criteria->add(new Criteria("type", $type));

		$criteria->add(new Criteria("no", $_POST["no"]));

		$result = $currdb->query("SELECT * FROM `".$currdb->prefix("forum_subscribe")."` WHERE ".$criteria->render());

		if ($currdb->num_rows($result) == 1)
		{
			$forumobject = new ForumObject($type, $_POST["no"]);

			if ($forumobject->{$type."_no"} > 0)
			{
				$result = $currdb->query("SELECT ".$ctype."_no FROM `".$currdb->prefix("forum_".$ctype)."` WHERE ".$type."_no='".$forumobject->{$type."_no"}."' ORDER BY ".$ctype."_no desc LIMIT 0, 1");

				if ($currdb->num_rows($result) == 1)
				{
					$tmp = $currdb->fetch_array($result);

					$currdb->query("UPDATE `".$currdb->prefix("forum_subscribe")."` SET status='".$tmp[$ctype."_no"]."' WHERE ".$criteria->render());
				}
			}
		}
		else
			$currdb->query("DELETE FROM `".$currdb->prefix("forum_subscribe")."` WHERE ".$criteria->render());
	}
}
?>
