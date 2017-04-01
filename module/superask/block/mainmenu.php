<?
if (!defined("MAINFILE_INCLUDED"))
	exit();

function mainmenu($dirname = null)
{
	$result = $GLOBALS["currdb"]->query("SELECT * FROM `".$GLOBALS["currdb"]->prefix("wiki_category")."` WHERE parent='0' ORDER BY ord");

	for ($i = 0;$tmp = $GLOBALS["currdb"]->fetch_array($result);$i++)
	{
		$result2 = $GLOBALS["currdb"]->query("SELECT * FROM `".$GLOBALS["currdb"]->prefix("wiki_category")."` WHERE parent='".$tmp["cno"]."' ORDER BY ord");

		while ($tmp2 = $GLOBALS["currdb"]->fetch_array($result2))
			$tmp["child"][] = $tmp2;

		$result2 = $GLOBALS["currdb"]->query("SELECT * FROM `".$GLOBALS["currdb"]->prefix("wiki_topic")."` WHERE cno='".$tmp["cno"]."'");

		while ($tmp2 = $GLOBALS["currdb"]->fetch_array($result2))
			$tmp["child"][] = $tmp2;

		$block["cat"][$i] = $tmp;
	}

	return $block;
}
?>
