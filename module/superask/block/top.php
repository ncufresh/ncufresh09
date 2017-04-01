<?
if (!defined("MAINFILE_INCLUDED"))
	exit();

function recten($dirname = null)
{
	$rc = "(104, 105, 110, 84, 94, 117, 118, 240, 244, 253)";

	$result = $GLOBALS["currdb"]->query("SELECT * FROM `".$GLOBALS["currdb"]->prefix("wiki_topic")."` WHERE tno IN ".$rc);

	for ($i = 0;$tmp = $GLOBALS["currdb"]->fetch_array($result);$i++)
		$block["topic"][$i] = $tmp;

	return $block;
}

function topten($dirname = null)
{
	$result = $GLOBALS["currdb"]->query("SELECT * FROM `".$GLOBALS["currdb"]->prefix("wiki_topic")."` ORDER BY numread DESC LIMIT 0, 10");

	for ($i = 0;$tmp = $GLOBALS["currdb"]->fetch_array($result);$i++)
		$block["topic"][$i] = $tmp;

	return $block;
}

function newten($dirname = null)
{
	$result = $GLOBALS["currdb"]->query("SELECT * FROM `".$GLOBALS["currdb"]->prefix("wiki_question")."` WHERE ano=0 ORDER BY qno DESC LIMIT 0, 10");

	for ($i = 0;$tmp = $GLOBALS["currdb"]->fetch_array($result);$i++)
	{
		$result2 = $GLOBALS["currdb"]->query("SELECT posttime FROM `".$GLOBALS["currdb"]->prefix("wiki_answer")."` WHERE qno='".$tmp["qno"]."' ORDER BY ano DESC LIMIT 0, 1");

		if ($GLOBALS["currdb"]->num_rows($result2) == 1)
			$tmp2 = $GLOBALS["currdb"]->fetch_array($result2);

		$tmp["question"] = _substr($tmp["question"], 0, 24);
		$tmp["posttime"] = date("m/d H:i", ($tmp2["posttime"] > 0) ? $tmp2["posttime"] : $tmp["posttime"]);
		$block["question"][$i] = $tmp;

		unset($tmp2);
	}

	return $block;
}
?>

