<?
if (!defined("MAINFILE_INCLUDED"))
	exit();

function onlinelist($dirname = null)
{
	if (!$GLOBALS["curruser"]->isguest())
	{
		$block = array();

		$result = $GLOBALS["currdb"]->query("SELECT listtype FROM `".$GLOBALS["currdb"]->prefix("online")."` WHERE online_id='".$GLOBALS["curruser"]->uid."'");

		if ($GLOBALS["currdb"]->num_rows($result) == 1)
			$block = $GLOBALS["currdb"]->fetch_array($result);

		$block["listtype"] = ($block["listtype"] == 1) ? 1 : 2;

		if($block["listtype"]==2)
			$friendTotal=$GLOBALS["currdb"]->query("SELECT o.online_id, u.uno FROM `".$GLOBALS["currdb"]->prefix("online")."`o INNER JOIN `".$GLOBALS["currdb"]->prefix("user")."`u ON online_id=uid");
		else if($block["listtype"]==1)
			$friendTotal = $GLOBALS["currdb"]->query("SELECT DISTINCT u.uno, o.online_id FROM `".$GLOBALS["currdb"]->prefix("online")."` o INNER JOIN `".$GLOBALS["currdb"]->prefix("user")."`u ON o.online_id=u.uid WHERE EXISTS (SELECT g.fno FROM `".$GLOBALS["currdb"]->prefix("friendlist")."`g WHERE g.fno=u.uno AND g.uno=".$GLOBALS["curruser"]->uno." AND g.friendship=2) ORDER BY o.online_id ASC");
			
		if($GLOBALS["currdb"]->num_rows($friendTotal)!=0)
		{
			for($m=0;$m<$GLOBALS["currdb"]->num_rows($friendTotal);$m++)
			{
				$friend=$GLOBALS["currdb"]->fetch_array($friendTotal);
				$block["friend"]=$block["friend"].'<a href="'.URL.'/msgsend.php?fno='.$friend['uno'].'"><img src="'.URL.'/templates/images/mailicon.png" style="border: 0px;" /></a><a href="'.URL.'/show_pfile.php?uno='.$friend['uno'].'">'.$friend['online_id'].'</a><br/>';
			}
		}

		$block['fuckok'] = $GLOBALS['fuckok'];

		return $block;
	}
}
?>
