<?
if (!defined("MAINFILE_INCLUDED"))
	exit();

function forum_mytopic($dirname = null)
{
	$block = array();

	$result = $GLOBALS["currdb"]->query("SELECT topic_no, title, numread FROM `".$GLOBALS["currdb"]->prefix("forum_topic")."` WHERE poster_no='".$GLOBALS["curruser"]->uno."' ORDER BY topic_no DESC LIMIT 0, 10");

	for ($i = 0;$tmp = $GLOBALS["currdb"]->fetch_array($result);$i++)
	{
		$block["mytopic"][$i] = $tmp;
		$block["mytopic"][$i]["title"] = _substr($block["mytopic"][$i]["title"], 0, 10)."...";
		$block["mytopic"][$i]["num"] = $tmp["numread"];
	}

	return $block;
}
?>
