<?
require_once(ROOT_PATH."/module/".$currmodule->name."/include/DifferenceEngine.php");

$wiki_bbcode = array(
	"/\[b\](.*?)\[\/b\]/is",
	"/\[i\](.*?)\[\/i\]/is",
	"/\[u\](.*?)\[\/u\]/is",
	"/\[t\](.*?)\[\/t\]/is",
	"/\[url\=(.*?)\](.*?)\[\/url\]/is",
	"/\[url\](.*?)\[\/url\]/is",
	"/\[img\](.*?)\[\/img\]/is"
	);

$wiki_htmlcode = array(
	"<strong>$1</strong>",
	"<em>$1</em>",
	"<u>$1</u>",
	"<h1>$1</h1>",
	"<a href=\"$1\" target=\"_blank\">$2</a>",
	"<a href=\"$1\" target=\"_blank\">$1</a>",
	"<img src=\"$1\" border=\"0\" />"
	);

$wiki_chicode = array(
	"b" => "粗體",
	"i" => "斜體",
	"u" => "底線",
	"t" => "標題",
	"url" => "網址",
	"img" => "圖片"
	);

function wikitoolbar()
{
	$GLOBALS["currtpl"]->addjs(ROOT_PATH."/module/".$GLOBALS["currmodule"]->name."/include/edit.js");

	$rc = array();

	$i=0;
	foreach ($GLOBALS["wiki_bbcode"] as $v)
	{
		$v = substr($v, 1, strlen($v) - 4);
		$v = str_replace("\\\\", "\\\\\\", $v);
		$v = stripslashes($v);
		$v = str_replace("(.*?)", "$1", $v);;

		preg_match("/\[([a-z]*).*\]/is", $v, $v);

		$rc[$i]["eng"] = $v[1];
		$rc[$i]["chi"] = $GLOBALS["wiki_chicode"][$v[1]];

		$i++;
	}

	//	return array_unique($rc);	
	unset($rc[5]);
	return $rc;
}

function wikifilter($content)
{
	return preg_replace("/<(\/)?textarea>/is", "", $content);
}

function wikidiff($from, $to)
{
	$from = explode("\n", htmlencode($from));

	$to = explode("\n", htmlencode($to));

	$f_len = count($from);

	$t_len = count($to);

	$i = ($f_len > $t_len) ? $f_len : $t_len;

	for ($i--;$i >= 0;$i--)
	{
		if ($i < $f_len)
			$from[$i] = trim($from[$i]);
		if ($i < $t_len)
			$to[$i] = trim($to[$i]);
	}

	$df = new DiffFormatter();

	$df =  $df->format(new Diff($from, $to));

	$df = explode("\n", $df);

	$result = 0;

	foreach ($df as $op)
	{
		$op = substr($op, strpos($op, " ") - 1);

		if ($op[0] == ">")
		{
			$op = trim(substr($op, 2));

			if (empty($op) || in_array($op, $from))
				continue;
		}
		else
		{
			$op = trim(substr($op, 2));

			if (empty($op) || in_array($op, $to))
				continue;
		}

		$result += 1 + strlen($op);
	}

	return $result;
}
?> 
