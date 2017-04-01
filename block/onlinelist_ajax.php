<?
require_once("../mainfile.php");

if (!$curruser->isguest())
{
	function cmp($a, $b)
	{
		return (strcmp($a->uid, $b->uid) > 0) ? 1 : -1;
	}

	$currtpl->echoxml();

	if (isset($_POST["listtype"]))
	{
		echo "<friendlist>\n";

		$listtype = ($_POST["listtype"] == 1) ? 1 : 2;

		$currdb->query("UPDATE `".$currdb->prefix("online")."` SET listtype='".$listtype."' WHERE online_id='".$curruser->uid."'");

		$friend_handler =& gethandler("friend");

		if ($_POST["listtype"] == 1)
			$gfriend = $friend_handler->getgoodfriends();
		else
		{
			$result = $currdb->query("SELECT * FROM `".$currdb->prefix("online")."` ORDER BY `online_id`");
		
			while ($tmp = $currdb->fetch_array($result))
				$gfriend[] = $curruser->u_handler->getuserbyid($tmp["online_id"]);
		}


		//usort($gfriend, "cmp");

		for ($i = 0;$i < count($gfriend);$i++)
		{
			if ($gfriend[$i]->uno > 0 && $gfriend[$i]->isonline())
			{
				if ($friend_handler->checkinlist($gfriend[$i]->uno, $curruser->uno) != -1)
				{
					echo "<friend>\n";
					echo "<fno>".$gfriend[$i]->uno."</fno>\n";
					echo "<fid>".htmlencode($gfriend[$i]->uid)."</fid>\n";
					echo "</friend>\n";
				}
			}
		}

		echo "</friendlist>\n";
	}
}
?>
