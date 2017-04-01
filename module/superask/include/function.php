<?
function getref($ref)
{
	$ref = explode(",", $ref);

	$rc = array();

	$j = count($ref);

	for ($i = 0;$i < $j;$i++)
	{
		$_WikiTopic = new WikiTopic();

		$_WikiTopic->getbytitle($ref[$i]);

		if ($_WikiTopic->tno > 0 && $_WikiTopic->unlock(LOCK_QUES) && !in_array($_WikiTopic->title, $rc))
			$rc[] = $_WikiTopic->title;
	}

	$rc = (count($rc) > 0) ? ",".implode(",", $rc)."," : "";

	return $rc;
}

function get_category($cno = 0)
{
	$result = $GLOBALS["currdb"]->query("SELECT * FROM `".$GLOBALS["currdb"]->prefix("wiki_category")."` WHERE cno='".$cno."'");

	if ($GLOBALS["currdb"]->num_rows($result) == 1)
		$rc = $cno.",";

	$result = $GLOBALS["currdb"]->query("SELECT * FROM `".$GLOBALS["currdb"]->prefix("wiki_category")."` WHERE parent='".$cno."' ORDER BY ord ASC");

	while ($tmp = mysql_fetch_array($result))
		$rc .= get_category($tmp["cno"]).",";

	return substr($rc, 0, strlen($rc) - 1);
}

function showwhere($cno = 0)
{
	$cno = intval($cno);

	$result = $GLOBALS["currdb"]->query("SELECT * FROM `".$GLOBALS["currdb"]->prefix("wiki_category")."` WHERE cno='".$cno."'");

	if ($GLOBALS["currdb"]->num_rows($result) == 1)
	{
		$cat = $GLOBALS["currdb"]->fetch_array($result);

		showwhere($cat["parent"]);

		if($cat['parent'] == 0)
		{
			if($cat["cno"] <= 30 && $cat["cno"]!=9)
				$site["url"] = URL."/module/".$GLOBALS["currmodule"]->name."/index.php";
			else
				$site["url"] = URL."/module/".$GLOBALS["currmodule"]->name."/club.php";
//	    	    $site["url"] = URL."/module/".$GLOBALS["currmodule"]->name."/showgroup.php?cno=".$cat["cno"];
			$site["name"] = $cat["name"];
	

			$GLOBALS["currsite"][] = $site;
		}
	}
}
?>
